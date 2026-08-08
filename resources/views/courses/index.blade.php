@extends('layout.master')

@section('content')

<style>
    .rating-star {
        outline: none;
        border: none;
        background: none;
        cursor: pointer;
        padding: 0;
    }

    .star-icon {
        color: #d1d5db;
        transition: all .28s ease;
    }

    /* Filled */

    .star-active .star-icon {
        color: #fbbf24;
        filter:
            drop-shadow(0 0 8px rgba(251, 191, 36, .65));
    }

    /* Hover */

    .rating-star:hover .star-icon {
        color: #fbbf24;
        transform:
            scale(1.22) rotate(-8deg);
    }

    /* Click */

    .star-pop {
        animation: pop .45s;
    }

    @keyframes pop {

        0% {
            transform: scale(.6);
        }

        50% {
            transform: scale(1.45);
        }

        100% {
            transform: scale(1);
        }

    }

    /* Ripple */

    .rating-star::after {

        content: '';

        position: absolute;

        width: 12px;

        height: 12px;

        border-radius: 999px;

        background: #fde68a;

        opacity: 0;

        left: 50%;

        top: 50%;

        transform: translate(-50%, -50%);

    }

    .rating-star:active::after {

        animation: ripple .55s;

    }

    @keyframes ripple {

        0% {
            opacity: .8;
            width: 12px;
            height: 12px;
        }

        100% {
            opacity: 0;
            width: 70px;
            height: 70px;
        }

    }

    /* Average */

    .average-rating {

        background: linear-gradient(90deg, #f59e0b, #facc15);

        -webkit-background-clip: text;

        -webkit-text-fill-color: transparent;

        font-weight: 800;

    }

    /* Thanks */

    .rating-message {

        animation: fadeUp .45s;

    }

    @keyframes fadeUp {

        from {

            opacity: 0;

            transform: translateY(10px);

        }

        to {

            opacity: 1;

            transform: translateY(0);

        }

    }

    /* Remove */

    .remove-rating {

        transition: .25s;

    }

    .remove-rating:hover {

        transform: translateX(5px);

    }

    /* Mobile */

    @media(max-width:640px) {

        .star-icon {

            width: 22px;

            height: 22px;

        }

        .average-rating {

            font-size: 15px;

        }

    }
</style>

<!-- Hero -->
<section class="relative overflow-hidden bg-gradient-to-r from-blue-700 via-indigo-700 to-pink-700 py-20">

    <div class="absolute w-96 h-96 bg-white/10 rounded-full blur-3xl -top-20 -left-20"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">

        <div class="text-center">

            <h1 data-en="Explore Amazing Courses"
                data-mm="သင်တန်းများကို ရှာရန်"
                class="text-4xl md:text-6xl font-bold text-white"
                data-aos="fade-up">
                Explore Amazing Courses
            </h1>

            <p data-en="Upgrade your skills with premium modern courses from professional instructors."
                data-mm="ကျွမ်းကျင်ပညာရှင် နည်းပြများထံမှ အဆင့်မြင့် ခေတ်မီသင်တန်းများဖြင့် သင့်ကျွမ်းကျင်မှုများကို မြှင့်တင်လိုက်ပါ။"
                class="text-white/80 text-lg mt-6 max-w-2xl mx-auto"
                data-aos="fade-up"
                data-aos-delay="100">
                Upgrade your skills with premium modern courses
                from professional instructors.
            </p>

        </div>

    </div>

</section>

<!-- Alerts -->
<div class="max-w-7xl mx-auto px-6 mt-10">

    @if(session('success'))
    <div class="bg-green-500 text-white px-6 py-4 rounded-2xl mb-6 shadow-lg">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-500 text-white px-6 py-4 rounded-2xl mb-6 shadow-lg">
        {{ session('error') }}
    </div>
    @endif

</div>

@php
$c = [
"Backend Language",
"Frontend Language",
"Web Development",
"Mobile Development",
"Artificial Intelligence",
"Data Science",
"Cyber Security",
"UI/UX Design",
"Graphic Design",
"Business",
"Photography",
"Video Editing",
"Language",
"Other"
];
@endphp

<div class="flex flex-wrap justify-center gap-3 mb-10 max-w-7xl mx-auto">

    <button
        class="course-filter bg-indigo-600 border border-slate-300 text-white shadow-lg scale-105 ring-2 ring-indigo-300 px-5 py-2 rounded-full transition-all duration-300"
        data-category="all">
        All
    </button>
    @foreach ($c as $category )
    <button
        class="course-filter bg-white/70 border border-slate-300 text-slate-700 px-5 py-2 rounded-full transition-all duration-300"
        data-category="{{ $category }}">
        {{ $category }}
    </button>
    @endforeach


</div>
<!-- Course Section -->
<section class="py-20">

    <div class="max-w-7xl mx-auto px-6">

        <div id="courseList">
            @include('courses.course_list')
        </div>

    </div>

</section>

<!-- CTA -->
<section class="py-24">

    <div class="max-w-6xl mx-auto px-6">

        <div
            class="gradient-bg rounded-[40px] p-16 text-center shadow-2xl floating"
            data-aos="zoom-in">

            <h2 data-en="Start Learning Today"
                data-mm="ယနေ့မှစ၍ လေ့လာရန်" class="text-4xl font-bold text-white">
                Start Learning Today
            </h2>

            <p data-en="Learn from top instructors and grow your career."
                data-mm="ထိပ်တန်း နည်းပြများထံမှ လေ့လာသင်ယူပြီး သင့်လုပ်ငန်းခွင် အခွင့်အလမ်းများကို တိုးတက်စေပါ။" class="text-white/80 text-lg mt-6">
                Learn from top instructors and grow your career.
            </p>

            <button
                class="mt-10 bg-white text-indigo-700 px-10 py-4 rounded-2xl font-bold hover:scale-105 transition">
                <a href="{{ route('courses.index') }}">Explore More</a>
            </button>

        </div>

    </div>

</section>

<script>
    document.addEventListener("DOMContentLoaded", () => {


        let ratingProcessing = false;


        /*
        -----------------------------------
        Toast Notification
        -----------------------------------
        */
        function showToast(message, type = "success") {

            Swal.fire({

                toast: true,
                position: "top-end",
                icon: type,
                title: message,
                showConfirmButton: false,
                timer: 1800,
                timerProgressBar: true

            });

        }



        /*
        -----------------------------------
        CSRF Token
        -----------------------------------
        */
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
        /*
        -----------------------------------
        Paint Stars
        -----------------------------------
        */
        function paintStars(container, rating) {


            const stars =
                container.querySelectorAll(
                    ".rating-star"
                );


            stars.forEach(star => {


                const value =
                    Number(
                        star.dataset.rating
                    );


                star.classList.remove(
                    "star-active",
                    "star-selected"
                );


                if (value <= rating) {

                    star.classList.add(
                        "star-active"
                    );

                }


                if (value === rating) {

                    star.classList.add(
                        "star-selected"
                    );

                }


            });


        }




        /*
        -----------------------------------
        Update All Course Cards
        -----------------------------------
        */
        function updateAllCourseCards(
            courseId,
            average,
            count
        ) {


            document
                .querySelectorAll(`
        [data-course-card="${courseId}"]`)
                .forEach(card => {


                    let avg =
                        card.querySelector(
                            ".average-rating"
                        );


                    let total =
                        card.querySelector(
                            ".rating-count"
                        );


                    if (avg) {
                        avg.textContent =
                            Number(average)
                            .toFixed(1);
                    }


                    if (total) {
                        total.textContent =
                            count;
                    }


                });


        }



        window.courseRatingRoutes = {

            store: "{{ route('courses.rating.store', ':course') }}",

            destroy: "{{ route('courses.rating.destroy', ':course') }}",

            show: "{{ route('courses.rating.show', ':course') }}"

        };
        const ratingRoutes = window.courseRatingRoutes;


        function buildRoute(route, courseId) {
            return route.replace(':course', courseId);
        }
        /*
        -----------------------------------
        Star Click
        Save / Update Rating
        -----------------------------------
        */
        document.addEventListener(
            "click",
            async (e) => {


                const star =
                    e.target.closest(
                        ".rating-star"
                    );


                if (!star)
                    return;



                if (ratingProcessing)
                    return;



                ratingProcessing = true;



                const wrapper =
                    star.closest(
                        ".course-rating"
                    );



                const courseId =
                    wrapper.dataset.courseId;



                const rating =
                    star.dataset.rating;




                star.classList.add(
                    "star-click"
                );



                try {


                    const response = await fetch(buildRoute(ratingRoutes.store, courseId), {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": csrfToken,
                            "Accept": "application/json"
                        },
                        body: JSON.stringify({
                            rating: rating
                        })
                    });
                    const data =
                        await response.json();
                    if (data.success) {
                        paintStars(
                            wrapper,
                            data.my_rating
                        );
                        wrapper.dataset.myRating =
                            data.my_rating;
                        wrapper
                            .querySelector(
                                ".average-rating"
                            )
                            .textContent =
                            Number(data.average)
                            .toFixed(1);



                        wrapper
                            .querySelector(
                                ".rating-count"
                            )
                            .textContent =
                            data.count;



                        wrapper
                            .querySelector(
                                ".remove-rating"
                            )
                            .classList
                            .remove("hidden");




                        updateAllCourseCards(
                            courseId,
                            data.average,
                            data.count
                        );



                        showToast(
                            "Rating saved successfully ❤️"
                        );

                    }


                } catch (error) {

                    console.error(error);


                    showToast(
                        "Something went wrong!",
                        "error"
                    );


                } finally {


                    ratingProcessing = false;


                    setTimeout(() => {

                        star.classList.remove(
                            "star-click"
                        );

                    }, 500);


                }



            });




        /*
        -----------------------------------
        Remove Rating
        -----------------------------------
        */
        document.addEventListener(
            "click",
            async (e) => {


                const removeBtn =
                    e.target.closest(
                        ".remove-rating"
                    );


                if (!removeBtn)
                    return;



                if (ratingProcessing)
                    return;



                ratingProcessing = true;



                const wrapper =
                    removeBtn.closest(
                        ".course-rating"
                    );


                const courseId =
                    wrapper.dataset.courseId;




                try {


                    const response =
                        await fetch(buildRoute(ratingRoutes.destroy, courseId), {

                            method: "DELETE",

                            headers: {

                                "X-CSRF-TOKEN": csrfToken,

                                "Accept": "application/json"

                            }

                        });

                    const data =
                        await response.json();



                    if (data.success) {


                        paintStars(
                            wrapper,
                            0
                        );



                        wrapper
                            .querySelector(
                                ".average-rating"
                            )
                            .textContent =
                            Number(data.average)
                            .toFixed(1);



                        wrapper
                            .querySelector(
                                ".rating-count"
                            )
                            .textContent =
                            data.count;



                        removeBtn
                            .classList
                            .add(
                                "hidden"
                            );



                        updateAllCourseCards(
                            courseId,
                            data.average,
                            data.count
                        );



                        showToast(
                            "Rating removed"
                        );

                    }



                } catch (error) {

                    console.error(error);


                    showToast(
                        "Remove failed",
                        "error"
                    );

                } finally {

                    ratingProcessing = false;

                }



            });


    });

    const filterButtons = document.querySelectorAll(".course-filter");

    filterButtons.forEach(button => {

        button.addEventListener("click", function() {

            // Remove active from all buttons
            filterButtons.forEach(btn => {
                btn.classList.remove(
                    "bg-indigo-600",
                    "text-white",
                    "shadow-lg",
                    "scale-105",
                    "ring-2",
                    "ring-indigo-300"
                );

                btn.classList.add(
                    "bg-white/70",
                    "text-gray-700"
                );
            });

            // Active current button
            this.classList.remove(
                "bg-white/70",
                "text-gray-700"
            );

            this.classList.add(
                "bg-indigo-600",
                "text-white",
                "shadow-lg",
                "scale-105",
                "ring-2",
                "ring-indigo-300"
            );

            const category = this.dataset.category;

            fetch("{{ route('courses.index') }}?category=" + encodeURIComponent(category), {
                    headers: {
                        "X-Requested-With": "XMLHttpRequest",
                        "Accept": "text/html"
                    }
                })
                .then(res => res.text())
                .then(html => {
                    document.getElementById("courseList").innerHTML = html;
                });

        });

    });

    // document.querySelectorAll(".course-filter").forEach(btn => {

    //     btn.addEventListener("click", function() {

    //         const category = this.dataset.category;
    //         fetch("{{ route('courses.index') }}?category=" + encodeURIComponent(category))
    //             .then(res => res.text())
    //             .then(html => {
    //                 document.getElementById("courseList").innerHTML = html;
    //             });

    //     });

    // });
</script>
@endsection