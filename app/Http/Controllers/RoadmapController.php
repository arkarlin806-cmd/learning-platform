<?php

namespace App\Http\Controllers;

use App\Models\LearningRoadmap;
use App\Models\RoadmapPhase;
use App\Models\RoadmapTask;
use App\Models\LearningGoal;
use App\Models\UserTaskProgress;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Services\AIRoadmapService;

class RoadmapController extends Controller
{
    public function index(Request $request)
    {

        $query = LearningRoadmap::withCount([
            'phases',
            'tasks'
        ]);


        if ($request->search) {

            $query->where(
                'career',
                'LIKE',
                '%' . $request->search . '%'
            );
        }



        if ($request->status !== null) {

            $query->where(
                'is_active',
                $request->status
            );
        }



        $roadmaps = $query
            ->latest()
            ->paginate(12);



        return view(
            'admin.roadmaps.index',
            compact('roadmaps')
        );
    }
    public function  create()
    {
        return view('admin.roadmaps.create');
    }

    public function edit(LearningRoadmap $roadmap)
    {

        $roadmap->load([
            'phases.tasks'
        ]);


        return view(
            'admin.roadmaps.edit',
            compact('roadmap')
        );
    }
    public function show(LearningRoadmap $roadmap)
    {

        $roadmap->load([
            'phases.tasks.course'
        ]);


        return view(
            'admin.roadmaps.show',
            compact('roadmap')
        );
    }

    public function search(Request $request)    //Course
    {

        $keyword = $request->q;


        $courses = Course::where(
            'title',
            'LIKE',
            "%$keyword%"
        )
            ->limit(10)
            ->get([
                'id',
                'title'
            ]);


        return response()->json($courses);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'career' => 'required|string|max:255|unique:learning_roadmaps,career',
            'description' => 'nullable|string',
            'source' => 'required|in:default,ai',
            'is_active' => 'required|boolean',

            'phases' => 'required|array|min:1',
            'phases.*.title' => 'required|string|max:255',
            'phases.*.description' => 'nullable|string',
            'phases.*.estimated_days' => 'required|integer|min:1',

            'phases.*.tasks' => 'required|array|min:1',
            'phases.*.tasks.*.title' => 'required|string|max:255',
            'phases.*.tasks.*.description' => 'nullable|string',
            'phases.*.tasks.*.course_id' => 'nullable|exists:courses,id',
            'phases.*.tasks.*.estimated_minutes' => 'required|integer|min:1',
            'phases.*.tasks.*.lesson_count' => 'nullable|integer|min:0',
            'phases.*.tasks.*.practice_count' => 'nullable|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        DB::beginTransaction();

        try {

            $roadmap = LearningRoadmap::create([
                'career' => $request->career,
                'description' => $request->description,
                'source' => $request->source,
                'is_active' => $request->is_active,
            ]);

            foreach ($request->phases as $phaseIndex => $phaseData) {

                $phase = RoadmapPhase::create([
                    'roadmap_id' => $roadmap->id,
                    'phase_no' => $phaseIndex + 1,
                    'title' => $phaseData['title'],
                    'description' => $phaseData['description'] ?? null,
                    'estimated_days' => $phaseData['estimated_days'],
                    'sort_order' => $phaseIndex + 1,
                ]);

                foreach ($phaseData['tasks'] as $taskIndex => $taskData) {

                    RoadmapTask::create([
                        'phase_id' => $phase->id,
                        'title' => $taskData['title'],
                        'description' => $taskData['description'] ?? null,
                        'course_id' => $taskData['course_id'] ?? null,
                        'estimated_minutes' => $taskData['estimated_minutes'],
                        'lesson_count' => $taskData['lesson_count'] ?? 0,
                        'practice_count' => $taskData['practice_count'] ?? 0,
                        'sort_order' => $taskIndex + 1,
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Roadmap created successfully.'
            ]);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
    public function update(Request $request, LearningRoadmap $roadmap)
    {
        $validator = Validator::make($request->all(), [

            'career' => 'required|string|max:255|unique:learning_roadmaps,career,' . $roadmap->id,

            'description' => 'nullable|string',

            'source' => 'required|in:default,ai',

            'is_active' => 'required|boolean',

            'phases' => 'required|array|min:1',

            'phases.*.title' => 'required|string',
            'phases.*.estimated_days' => 'required|integer|min:1',

            'phases.*.tasks' => 'required|array|min:1',

            'phases.*.tasks.*.title' => 'required|string',

            'phases.*.tasks.*.course_id' => 'nullable|exists:courses,id',

            'phases.*.tasks.*.estimated_minutes' => 'required|integer|min:1',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        DB::beginTransaction();

        try {

            $roadmap->update([
                'career' => $request->career,
                'description' => $request->description,
                'source' => $request->source,
                'is_active' => $request->is_active,
            ]);

            // Delete Old Tasks
            foreach ($roadmap->phases as $phase) {

                RoadmapTask::where('phase_id', $phase->id)->delete();
            }

            // Delete Old Phases
            RoadmapPhase::where('roadmap_id', $roadmap->id)->delete();

            // Insert New Data
            foreach ($request->phases as $phaseIndex => $phaseData) {

                $phase = RoadmapPhase::create([

                    'roadmap_id' => $roadmap->id,
                    'phase_no' => $phaseIndex + 1,
                    'title' => $phaseData['title'],
                    'description' => $phaseData['description'] ?? null,
                    'estimated_days' => $phaseData['estimated_days'],
                    'sort_order' => $phaseIndex + 1,

                ]);

                foreach ($phaseData['tasks'] as $taskIndex => $task) {

                    RoadmapTask::create([

                        'phase_id' => $phase->id,
                        'title' => $task['title'],
                        'description' => $task['description'] ?? null,
                        'course_id' => $task['course_id'] ?? null,
                        'estimated_minutes' => $task['estimated_minutes'],
                        'lesson_count' => $task['lesson_count'] ?? 0,
                        'practice_count' => $task['practice_count'] ?? 0,
                        'sort_order' => $taskIndex + 1,

                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Roadmap updated successfully.'
            ]);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
    public function destroy(LearningRoadmap $roadmap)
    {

        DB::beginTransaction();

        try {

            foreach ($roadmap->phases as $phase) {

                RoadmapTask::where('phase_id', $phase->id)->delete();
            }

            RoadmapPhase::where('roadmap_id', $roadmap->id)->delete();

            $roadmap->delete();

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Roadmap deleted successfully.'
            ]);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    //learner roadmap
    public function learner_roadmap_create()
    {
        return view('home.create');
    }
    public function learner_roadmap_store(Request $request)
    {


        $request->validate([

            'goal_name' => 'required',
            'current_level' => 'required',
            'target_role' => 'required',
            'daily_hours' => 'required|integer',

        ]);



        DB::beginTransaction();


        try {


            // 1. Create Goal


            $goal = LearningGoal::create([

                'user_id' => auth()->id(),

                'goal_name' => $request->goal_name,

                'current_level' => $request->current_level,

                'target_role' => $request->target_role,

                'daily_hours' => $request->daily_hours,

                'daily_lessons' => $request->daily_lessons ?? 1,

                'study_days_per_week' => $request->study_days_per_week ?? 5,

                'status' => 'active'


            ]);





            // 2. Find Default Roadmap


            $roadmap =
                LearningRoadmap::where(
                    'career',
                    $request->target_role
                )
                ->where(
                    'is_active',
                    1
                )
                ->first();





            if (!$roadmap) {


                // AI Generate


                $roadmap =
                    $this->generateAIRoadmap(
                        $request
                    );
            }





            // 3. Create User Progress


            foreach (
                $roadmap->phases as $phase
            ) {


                foreach (
                    $phase->tasks as $task
                ) {


                    UserTaskProgress::create([

                        'user_id' => auth()->id(),

                        'goal_id' => $goal->id,

                        'task_id' => $task->id,

                        'completed' => false

                    ]);
                }
            }





            DB::commit();



            return response()->json([

                'status' => true,

                'message' => 'Roadmap created',

                'redirect' =>
                route('learner.roadmap')

            ]);
        } catch (\Exception $e) {


            DB::rollBack();


            return response()->json([

                'status' => false,

                'message' => $e->getMessage()

            ], 500);
        }
    }
    private function generateAIRoadmap($goal)
    {


        $service =
            new AIRoadmapService();



        $data =
            $service->generate(
                $goal
            );





        $roadmap =
            LearningRoadmap::create([


                'career' =>
                $data['career'],


                'description' =>
                $data['description'],


                'source' => 'ai',


                'is_active' => 1


            ]);






        foreach (
            $data['phases']
            as $index => $phaseData
        ) {



            $phase =
                RoadmapPhase::create([


                    'roadmap_id' =>
                    $roadmap->id,


                    'phase_no' =>
                    $index + 1,


                    'title' =>
                    $phaseData['title'],


                    'description' =>
                    $phaseData['description'],


                    'estimated_days' =>
                    $phaseData['estimated_days'],


                    'sort_order' =>
                    $index + 1


                ]);





            foreach (
                $phaseData['tasks']
                as $taskIndex => $taskData
            ) {



                RoadmapTask::create([


                    'phase_id' =>
                    $phase->id,


                    'title' =>
                    $taskData['title'],


                    'description' =>
                    $taskData['description'],


                    'estimated_minutes' =>
                    $taskData['estimated_minutes'],


                    'lesson_count' =>
                    $taskData['lesson_count'],


                    'practice_count' =>
                    $taskData['practice_count'],


                    'sort_order' =>
                    $taskIndex + 1


                ]);
            }
        }




        return $roadmap;
    }

    //roadmap show in learner
    public function learner_roadmap_index()

    {
        $goal = LearningGoal::where(
            'user_id',
            auth()->id()
        )
            ->latest()
            ->first();
        $progress =
            UserTaskProgress::with([
                'task.phase'
            ])
            ->where(
                'user_id',
                auth()->id()
            )
            ->where(
                'goal_id',
                $goal->id
            )
            ->get();
        $total = $progress->count();
        $completed = $progress
            ->where(
                'completed',
                true
            )
            ->count();
        $percentage =
            $total > 0
            ?
            round(
                ($completed / $total) * 100
            )
            : 0;

        return view(
            'home.roadmap',
            compact(
                'goal',
                'progress',
                'percentage'
            )
        );
    }
    public function completeTask(
        Request $request,
        $userTask
    ) {


        $progress =
            UserTaskProgress::where(
                'user_id',
                auth()->id()
            )
            ->where(
                'task_id',
                $userTask->id
            )
            ->firstOrFail();



        $progress->update([

            'completed' => true,

            'completed_at' => now()

        ]);





        return response()->json([

            'status' => true,

            'message' => 'Task Completed'

        ]);
    }

    // User ရဲ့ Roadmap အားလုံး
    public function learner_all_roadmap()
    {
        $goals = LearningGoal::where('user_id', auth()->id())
            ->latest()
            ->get();

        foreach ($goals as $goal) {
            // $goal->roadmap = LearningRoadmap::where('career', $goal->target_role)
            //     ->active()
            //     ->first();
            $goal->roadmap = LearningRoadmap::with('phases')
                ->where('career', $goal->target_role)
                ->active()
                ->first();
        }

        return view('home.all_roadmap', compact('goals'));
    }

    // Roadmap Detail
    public function learner_single_roadmap(LearningGoal $goal)
    {
        abort_if($goal->user_id != auth()->id(), 403);

        $roadmap = LearningRoadmap::with([
            'phases.tasks.course'
        ])
            ->where('career', $goal->target_role)
            ->active()
            ->firstOrFail();

        return view('home.single_roadmap', compact(
            'goal',
            'roadmap'
        ));
    }
}
