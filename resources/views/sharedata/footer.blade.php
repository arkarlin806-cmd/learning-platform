<footer class="bg-slate-950 text-white py-14">

    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 lg:grid-cols-3 gap-12">

        <div>
            <h2 class="font-bold text-3xl bg-gradient-to-r from-indigo-600 via-purple-500 to-pink-500 bg-clip-text text-transparent">
                AI Power Learning Platform
            </h2>

            <p class="text-gray-400 mt-5 leading-relaxed">
                Modern online learning platform for future creators and developers.
            </p>
        </div>

        <div>
            <h3 class="text-xl font-semibold mb-5">
                Platform
            </h3>

            <ul class="space-y-3 text-gray-400">
                <li><a href="{{ route('courses.index') }}" data-en="Courses"
                        data-mm="သင်ခန်းစာများ" class="hover:text-white transition">Courses</a></li>
                <li><a href="{{ route('instructors.all_ins') }}"
                        data-en="Instructors"
                        data-mm="ဆရာများ" class="hover:text-white transition">Teachers</a></li>
                <li><a href="{{ route('about') }}"
                        data-en="About"
                        data-mm="အကြောင်းအရာ" class="hover:text-white transition">About</a></li>
            </ul>
        </div>
        <div>
            <h3 class="text-xl font-semibold mb-5">
                Support
            </h3>

            <ul class="space-y-3 text-gray-400">
                <li><a href="{{ route('contact.inbox') }}" data-en="Contact"
                        data-mm="ဆက်သွယ်ရန်" class="hover:text-white transition">Contact</a></li>
                <li><a href="#" class="hover:text-white transition">Privacy</a></li>
            </ul>
        </div>


    </div>

    <div class="border-t border-white/10 mt-14 pt-8 text-center text-gray-500">
        © 2026 Learnify. All rights reserved.
    </div>

</footer>


<!-- AOS -->
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

<script>
    AOS.init({
        duration: 1000,
        once: true
    });
</script>