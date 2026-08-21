@extends('layout.course_ins')
@section("title","Certificate")
@section("page","Instructor create certificate.")
@section('content')

@if($course->status == 'completed')

<div class="max-w-7xl mx-auto px-4 py-2">


    <div class="mb-8 flex justify-between">

        <div class="">
            <h1 class="text-3xl font-bold text-slate-800 ">

                Create Certificates

            </h1>
            <p class="text-slate-500 mt-2">

                Course:

                <span class="font-semibold text-indigo-600">

                    {{ $course?->title }}

                </span>

            </p>
        </div>
        <a href="{{ route('instructor.certificate.create',$course) }}" class="group h-10 inline-flex items-center justify-center gap-2 rounded-lg bg-indigo-700 px-5 py-3 text-sm sm:text-base font-semibold text-white shadow-lg shadow-blue-500/25 transition-all duration-300 hover:-translate-y-0.5 hover:shadow-xl hover:shadow-indigo-500/30">
            <svg class="h-5 w-5 transition-transform duration-300 group-hover:rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>Create</a>

    </div>

    <div class="flex gap-3 mb-6">
        <button
            class="tabBtn bg-indigo-600 text-white px-5 py-2 rounded-xl"
            data-tab="awarded">
            Awarded ({{ $awarded->total() }})
        </button>

        <button
            class="tabBtn bg-orange-100 text-orange-700 px-5 py-2 rounded-xl"
            data-tab="pending">
            No Certificate ({{ $notAwarded->total() }})
        </button>
    </div>

    {{-- Awarded --}}

    <div id="awarded">

        <div class="overflow-x-auto rounded-2xl shadow bg-white">

            <table class="min-w-full">

                <thead class="bg-indigo-600 text-white">

                    <tr>

                        <th class="p-4">Photo</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Details</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($awarded as $item)

                    <tr
                        class="border-b hover:bg-blue-50 transition">

                        <td class="p-3">

                            <img
                                src="https://ui-avatars.com/api/?name={{ $item->user->name }}"
                                class="w-12 h-12 rounded-full">

                        </td>

                        <td class="">{{ $item->user->name }}</td>

                        <td class="px-4">{{ $item->user->email }}</td>



                        <td>

                            <span
                                class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">

                                Awarded

                            </span>

                        </td>

                        <td>

                            <a
                                href="{{ route('instructor.learner.profile', [
                                'course' => $course,
                                'user' => $item->user
                            ]) }}"
                                class="px-4 py-2 mr-3 rounded-lg bg-indigo-600 text-white">

                                View

                            </a>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

        <div class="mt-5">
            {{ $awarded->links() }}
        </div>

    </div>


    {{-- Pending --}}

    <div id="pending" class="hidden">

        <div class="overflow-x-auto rounded-2xl shadow bg-white">

            <table class="min-w-full">

                <thead class="bg-orange-500 text-white">

                    <tr>

                        <th class="p-4">Photo</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Joined</th>
                        <th>Status</th>
                        <th>Details</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($notAwarded as $item)

                    <tr
                        class="border-b hover:bg-orange-50 transition">

                        <td class="p-3">

                            <img
                                src="https://ui-avatars.com/api/?name={{ $item->user->name }}"
                                class="w-12 h-12 rounded-full">

                        </td>

                        <td>{{ $item->user->name }}</td>

                        <td class="w-120 px-4">{{ $item->user->email }}</td>

                        <td>{{ $item->created_at->format('d M Y') }}</td>

                        <td>

                            <span
                                class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">

                                Not Awarded

                            </span>

                        </td>

                        <td>

                            <a
                                href="{{ route('instructor.learner.profile', [
                                        'course' => $course,
                                        'user' => $item->user
                                    ]) }}"
                                class="px-4 py-2 rounded-lg bg-blue-600 text-white">

                                View

                            </a>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

        <div class="mt-5">
            {{ $notAwarded->links() }}
        </div>

    </div>


    <div class="
bg-white/80
backdrop-blur-xl
rounded-3xl
shadow-xl
p-6
">



        <!-- Header -->









        <div class="
grid
md:grid-cols-2
xl:grid-cols-3
gap-6
">





            @forelse($certificates as $certificate)



            <div
                class="
group
rounded-3xl
bg-white
border
shadow-md
p-5

hover:-translate-y-2
transition
duration-300
">





                <!-- Learner -->

                <div class="
flex
items-center
gap-4
mb-5
">


                    @if($certificate->user->avatar)

                    <img
                        src="{{ asset('storage/'.$certificate->user->avatar) }}"
                        class="
w-14
h-14
rounded-full
object-cover
">

                    @else

                    <div class="
w-14
h-14
rounded-full
bg-indigo-100
flex
items-center
justify-center
font-bold
text-indigo-600
">

                        {{ strtoupper(substr($certificate->user->name,0,1)) }}

                    </div>

                    @endif





                    <div>

                        <h3 class="
font-bold
text-slate-800
">

                            {{ $certificate->user->name }}

                        </h3>


                        <p class="text-sm text-slate-500">

                            {{ $certificate->user->email }}

                        </p>


                    </div>


                </div>








                <!-- Certificate Info -->


                <div class="space-y-2 text-sm">


                    <div class="flex justify-between">

                        <span class="text-slate-500">
                            Certificate ID
                        </span>


                        <span class="font-semibold">

                            {{ $certificate->certificate_id }}

                        </span>


                    </div>





                    <div class="flex justify-between">

                        <span class="text-slate-500">
                            Issued Date
                        </span>


                        <span>

                            {{ $certificate->issued_at?->format('d M Y') }}

                        </span>


                    </div>






                    <div class="flex justify-between">


                        <span class="text-slate-500">
                            Status
                        </span>



                        @if($certificate->status == 'valid')


                        <span class="
px-3
py-1
rounded-full
bg-green-100
text-green-700
text-xs
font-bold
">

                            VALID

                        </span>


                        @else


                        <span class="
px-3
py-1
rounded-full
bg-red-100
text-red-700
text-xs
font-bold
">

                            REVOKED

                        </span>


                        @endif



                    </div>


                </div>








                <!-- Actions -->

                <div class="
mt-5
flex
gap-3
">



                    <a
                        href="{{ route('instructor.certificates.show',$certificate) }}"
                        class="
flex-1
text-center
py-2
rounded-xl
bg-blue-600
text-white
text-sm
font-semibold
hover:bg-indigo-700
">

                        View

                    </a>






                </div>






            </div>



            @empty


            <div class="
col-span-full
text-center
py-20
text-slate-500
">

                No certificates issued yet.

            </div>


            @endforelse




        </div>





        <div class="mt-6">

            {{ $certificates->links() }}

        </div>




    </div>




</div>

<script>
    document.querySelectorAll('.tabBtn').forEach(btn => {

        btn.onclick = function() {

            document.getElementById('awarded').classList.add('hidden');

            document.getElementById('pending').classList.add('hidden');

            document.getElementById(this.dataset.tab).classList.remove('hidden');

            document.querySelectorAll('.tabBtn').forEach(b => {

                b.classList.remove('bg-indigo-600', 'text-white');

                b.classList.add('bg-gray-100');

            });

            this.classList.remove('bg-gray-100');

            this.classList.add('bg-indigo-600', 'text-white');

        }

    });
</script>


@else

<div class="max-w-7xl mx-auto px-4 py-8">


    {{-- Section Heading --}}
    <div class="text-center mb-12" data-aos="fade-up">
        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/70 backdrop-blur-md border border-white shadow-sm text-sm font-semibold text-indigo-600">
            ✨ Certificate
        </span>

        <h1 class="mt-5 text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-slate-800">
            Certificate
            <span class="bg-gradient-to-r from-indigo-600 via-purple-500 to-pink-500 bg-clip-text text-transparent">
                Not Created
            </span>
        </h1>

        <p class="mt-4 max-w-2xl mx-auto text-slate-500 text-sm sm:text-base leading-7">
            Now, This course certificate not created. So, your couse do completed in course information page.
        </p>
    </div>


</div>


@endif


@endsection