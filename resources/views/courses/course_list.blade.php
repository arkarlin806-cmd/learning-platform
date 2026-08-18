<div class="grid sm:grid-cols-1 lg:grid-cols-3 gap-10">

    @foreach($courses as $course)


    <!-- Card 1 -->
    <div data-course-card="{{ $course->id }}" class="card-animate relative overflow-hidden rounded-3xl bg-white/10 backdrop-blur-lg border border-gray-300 group transition-all duration-500 hover:-translate-y-4 hover:shadow-[0_20px_60px_rgba(220,130,246,0.5)]">

        <div class="glow bg-blue-500 top-0 right-0 group-hover:scale-150 transition duration-700"></div>

        <div class="relative z-10">

            <div class="relative">

                @if($course->thumbnail_url)
                <img
                    src="{{ $course->thumbnail_url }}"
                    alt="{{ $course->title }}"
                    class="w-full h-48 object-cover">
                @else
                <div class="w-full h-48 flex items-center justify-center">
                    No Image
                </div>
                @endif
                <div class="absolute top-4 left-4">
                    <span class="bg-white/90 text-blue-700 px-4 py-2 rounded-full text-sm font-semibold">
                        {{ $course->level }}
                    </span>
                </div>

            </div>

            <div class="flex justify-between px-6 pt-4">
                <h2 class="text-sm font-semibold text-slate-700 mb-4">
                    {{ $course->title }}
                </h2>

                @php

                $userRating = $course->ratings->first();

                @endphp

                <div class="course-rating" data-course-id="{{ $course->id }}" data-my-rating="{{ $userRating->rating ?? 0 }}">
                    <div class="flex items-center gap-2">
                        <div class="flex rating-stars">
                            @for($i=1;$i<=5;$i++)

                                <button type="button"
                                class="rating-star 
                                                {{ 
                                                ($userRating && $i <= $userRating->rating)
                                                ? 'star-active'
                                                : ''
                                                }}"
                                data-rating="{{ $i }}">
                                <svg class="star-icon w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921
                                                    1.603-.921 1.902 0l1.07
                                                    3.292a1 1 0 00.95.69h3.462
                                                    c.969 0 1.371 1.24.588
                                                    1.81l-2.8 2.034a1 1
                                                    0 00-.364 1.118l1.07
                                                    3.292c.3.921-.755 1.688
                                                    -1.54 1.118l-2.8-2.034a1
                                                    1 0 00-1.176 0l-2.8
                                                    2.034c-.784.57-1.838
                                                    -.197-1.539-1.118l1.07
                                                    -3.292a1 1 0 00-.364
                                                    -1.118L2.98 8.72c-.783
                                                    -.57-.38-1.81.588-1.81h3.461
                                                    a1 1 0 00.951-.69l1.069-3.292z" />

                                </svg>

                                </button>
                                @endfor
                        </div>

                        <span class="average-rating font-bold">

                            {{ number_format($course->ratings_avg_rating ?? 0,1) }}

                        </span>

                    </div>

                    <button
                        class="remove-rating hidden  text-red-500 text-sm mt-2">
                        <!-- $userRating ? '' : 'hidden'  -->
                        Remove Rating
                    </button>
                </div>
            </div>
            <div class="flex justify-between px-6 mb-6">
                <a data-en="Learn More"
                    data-mm="အသေးစိတ်သိရန်" href="{{ route('course.show', $course->id) }}" class="px-5 py-2 border border-blue-300 rounded-xl bg-blue-100/50 dark:bg-white/70 text-blue-700 text-sm font-semibold transition duration-300 hover:bg-blue-100/30 hover:scale-105">
                    Learn More
                </a>
                <p class="mt-5">
                    <span class="text-gray-500 dark:text-white text-xs" data-en="Start date"
                        data-mm="စတင်မည့်ရက်">Start date - </span> <i class="text-sm dark:text-white">{{ $course->start_date }}</i>
                </p>
            </div>
        </div>
    </div>

    @endforeach

</div>

<div class="mt-16">
    {{ $courses->links() }}
</div>