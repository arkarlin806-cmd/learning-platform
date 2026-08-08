@extends('layout.ai')

@section('content')

<div class="app-shell w-full flex-1">

    <!-- Header -->
    <header class="top-fade header-glass">
        <div class="max-w-6xl mx-auto px-3 md:px-2 h-16 flex items-center justify-between">
            <div class="flex items-center gap-3 min-w-0">
                <button id="openSidebar"
                    class="lg:hidden w-11 h-11 rounded-2xl bg-white border border-slate-200 shadow-sm flex items-center justify-center text-slate-700 hover:scale-105 transition">
                    ☰
                </button>
                <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 text-white flex items-center justify-center font-bold shadow-md shrink-0">
                    JS
                </div>
                <div class="min-w-0">
                    <h1 class="text-slate-900 font-semibold text-base md:text-lg truncate">
                        JavaScript ( fronted language )
                    </h1>
                    <p class="text-xs md:text-sm text-slate-500 truncate">
                        Learn frontend JavaScript language. Useful for UI/UX design.
                    </p>
                </div>
            </div>

            <div class="hidden sm:flex items-center gap-2">
                <span class="status-pill text-xs px-3 py-1.5 rounded-full">
                    Smart Chat
                </span>
            </div>
        </div>
    </header>

    <div class="flex justify-between gap-2 overflow-y-auto p-12">
        <style>
            textarea {
                tab-size: 4;
            }

            ::-webkit-scrollbar {
                width: 8px;
                height: 8px;
            }

            ::-webkit-scrollbar-thumb {
                background: #94a3b8;
                border-radius: 999px;
            }

            .glass {
                backdrop-filter: blur(18px);
                background: rgba(255, 255, 255, .75);
            }

            .animate-card {
                transition: .35s;
            }

            .animate-card:hover {
                transform: translateY(-6px);
                box-shadow: 0 30px 60px rgba(0, 0, 0, .12);
            }

            .fullscreen-editor {

                position: fixed;

                inset: 0;

                z-index: 9999;

                background: #020617;

                border-radius: 0;

            }

            .previewWrapper {
                transition: all .35s ease;
            }

            .previewCard {
                transition: all .35s cubic-bezier(.22, 1, .36, 1);
            }

            .previewWrapper.show {
                display: flex;
                animation: fadeIn .35s ease forwards;
            }

            .previewWrapper.show .previewCard {
                opacity: 1;
                transform: scale(1);
            }

            .previewWrapper.hide .previewCard {
                opacity: 0;
                transform: scale(.75);
            }

            @keyframes fadeIn {

                from {
                    opacity: 0;
                }

                to {
                    opacity: 1;
                }

            }
        </style>


        @php

        $sections=[
        [
        'id'=>'js-introduction',

        'title'=>'JavaScript Introduction',

        'description'=>'JavaScript သည် Web Page များကို Interactive ဖြစ်စေရန် အသုံးပြုသော Programming Language ဖြစ်သည်။ HTML သည် Structure, CSS သည် Design, JavaScript သည် Behavior ကို ထိန်းချုပ်သည်။',

        'points'=>[
        'JavaScript ကို HTML ထဲတွင် အသုံးပြုခြင်း',
        'layout',
        'Console Output',
        'Button Click Event',
        'Dynamic Content Change'
        ],

        'code'=><<<HTML
            <!DOCTYPE html>
            <html>

            <body>

                <h2 id="title">
                    Hello JavaScript
                </h2>

                <button onclick="changeText()">

                    Click Me

                </button>


                <script>
                    function changeText() {

                        document.getElementById("title").innerHTML =
                            "JavaScript is Working!";

                    }

                    console.log("JavaScript Started");
                </script>


            </body>

            </html>
            HTML
            ]
            , [
            'id'=>'js-variables',

            'title'=>'JavaScript Variables',

            'description'=>'Variable များသည် Data များကို သိမ်းဆည်းရန် အသုံးပြုသည်။ JavaScript တွင် var, let, const ဆိုပြီး အသုံးပြုနိုင်သည်။',

            'points'=>[
            'var',
            'let',
            'const',
            'Variable Naming',
            'Value Change'
            ],

            'code'=><<<HTML
                <!DOCTYPE html>
                <html>

                <body>

                    <h2>
                        JavaScript Variables
                    </h2>

                    <p id="result"></p>


                    <script>
                        let name = "ArKar";

                        const age = 25;

                        var course = "JavaScript";


                        document.getElementById("result")
                            .innerHTML =

                            "Name : " +
                            name +
                            "<br>Age : " +
                            age +
                            "<br>Course : " +
                            course;
                    </script>


                </body>

                </html>
                HTML
                ]
                ,[
                'id'=>'js-data-types',

                'title'=>'JavaScript Data Types',

                'description'=>'JavaScript တွင် Data Type အမျိုးမျိုးရှိပြီး Value များ၏ အမျိုးအစားကို သတ်မှတ်သည်။',

                'points'=>[
                'String',
                'Number',
                'Boolean',
                'Array',
                'Object',
                'Null & Undefined'
                ],

                'code'=><<<HTML
                    <!DOCTYPE html>
                    <html>

                    <body>

                        <h2>
                            JavaScript Data Types
                        </h2>

                        <p id="output"></p>


                        <script>
                            let username = "John";

                            let score = 95;

                            let passed = true;


                            let skills = [

                                "HTML",
                                "CSS",
                                "JS"

                            ];


                            let user = {

                                name: "John",

                                age: 20

                            };


                            document.getElementById("output")
                                .innerHTML =

                                typeof username +
                                "<br>" +
                                typeof score +
                                "<br>" +
                                typeof passed +
                                "<br>" +
                                skills +
                                "<br>" +
                                user.name;
                        </script>


                    </body>

                    </html>
                    HTML
                    ]
                    ,[
                    'id'=>'js-operators',

                    'title'=>'JavaScript Operators',

                    'description'=>'Operator များသည် Calculation, Comparison နှင့် Logic Operation များ ပြုလုပ်ရန် အသုံးပြုသည်။',

                    'points'=>[
                    'Arithmetic Operators',
                    'Assignment Operators',
                    'Comparison Operators',
                    'Logical Operators',
                    'Increment & Decrement'
                    ],

                    'code'=><<<HTML
                        <!DOCTYPE html>
                        <html>

                        <body>

                            <h2>
                                JavaScript Operators
                            </h2>


                            <p id="result"></p>


                            <script>
                                let a = 10;

                                let b = 5;


                                let sum = a + b;

                                let multiply = a * b;

                                let compare = a > b;


                                document.getElementById("result")
                                    .innerHTML =

                                    "Addition : " +
                                    sum +
                                    "<br>Multiply : " +
                                    multiply +
                                    "<br>Is 10 bigger? " +
                                    compare;
                            </script>


                        </body>

                        </html>
                        HTML
                        ]
                        ,[
                        'id'=>'js-functions',

                        'title'=>'JavaScript Functions',

                        'description'=>'Function သည် Code များကို ပြန်လည်အသုံးပြုနိုင်အောင် စုစည်းထားသော Block တစ်ခုဖြစ်သည်။',

                        'points'=>[
                        'Function Declaration',
                        'Parameters',
                        'Return Value',
                        'Arrow Function',
                        'Reusable Code'
                        ],

                        'code'=><<<HTML
                            <!DOCTYPE html>
                            <html>

                            <body>


                                <h2>
                                    JavaScript Functions
                                </h2>


                                <button onclick="calculate()">

                                    Calculate

                                </button>


                                <p id="result"></p>



                                <script>
                                    function add(a, b) {

                                        return a + b;

                                    }



                                    const multiply = (a, b) => {

                                        return a * b;

                                    }



                                    function calculate() {


                                        let total = add(10, 20);


                                        let result = multiply(5, 4);



                                        document.getElementById("result")
                                            .innerHTML =

                                            "Add : " +
                                            total +
                                            "<br>Multiply : " +
                                            result;



                                    }
                                </script>


                            </body>

                            </html>
                            HTML
                            ]
                            ,[
                            'id'=>'js-conditions',

                            'title'=>'JavaScript Conditions',

                            'description'=>'Condition များကို အသုံးပြုပြီး အခြေအနေအလိုက် Code များကို လုပ်ဆောင်နိုင်သည်။ if, else if, else နှင့် switch များကို အသုံးပြုသည်။',

                            'points'=>[
                            'if Statement',
                            'else Statement',
                            'else if Statement',
                            'Comparison Operators',
                            'switch Statement'
                            ],

                            'code'=><<<HTML
                                <!DOCTYPE html>
                                <html>

                                <body>

                                    <h2>
                                        JavaScript Conditions
                                    </h2>

                                    <input id="age"
                                        placeholder="Enter Age">

                                    <button onclick="checkAge()">
                                        Check
                                    </button>

                                    <p id="result"></p>


                                    <script>
                                        function checkAge() {

                                            let age =
                                                Number(document.getElementById("age").value);


                                            let message;


                                            if (age >= 18) {

                                                message = "You can access this website";

                                            } else if (age > 0) {

                                                message = "You are under 18";

                                            } else {

                                                message = "Please enter valid age";

                                            }


                                            document.getElementById("result")
                                                .innerHTML = message;


                                        }
                                    </script>

                                </body>

                                </html>
                                HTML
                                ]
                                ,[
                                'id'=>'js-loops',

                                'title'=>'JavaScript Loops',

                                'description'=>'Loop များကို Code တစ်ခုကို အကြိမ်များစွာ ပြန်လည်လုပ်ဆောင်ရန် အသုံးပြုသည်။',

                                'points'=>[
                                'for Loop',
                                'while Loop',
                                'do while Loop',
                                'break',
                                'continue'
                                ],

                                'code'=><<<HTML
                                    <!DOCTYPE html>
                                    <html>

                                    <body>


                                        <h2>
                                            JavaScript Loops
                                        </h2>


                                        <button onclick="showNumbers()">

                                            Generate Numbers

                                        </button>


                                        <p id="output"></p>


                                        <script>
                                            function showNumbers() {


                                                let result = "";


                                                for (let i = 1; i <= 10; i++) {


                                                    result += i + "<br>";


                                                }



                                                document.getElementById("output")
                                                    .innerHTML = result;


                                            }
                                        </script>


                                    </body>

                                    </html>
                                    HTML
                                    ]
                                    ,[
                                    'id'=>'js-arrays',

                                    'title'=>'JavaScript Arrays',

                                    'description'=>'Array သည် Multiple Data များကို Variable တစ်ခုအတွင်း သိမ်းဆည်းရန် အသုံးပြုသည်။',

                                    'points'=>[
                                    'Create Array',
                                    'Access Items',
                                    'push()',
                                    'pop()',
                                    'map()',
                                    'filter()'
                                    ],

                                    'code'=><<<HTML
                                        <!DOCTYPE html>
                                        <html>

                                        <body>


                                            <h2>
                                                JavaScript Arrays
                                            </h2>


                                            <p id="result"></p>


                                            <script>
                                                let courses = [

                                                    "HTML",
                                                    "CSS",
                                                    "JavaScript",
                                                    "Laravel"

                                                ];



                                                // Add Item

                                                courses.push("React");



                                                let output = "";



                                                courses.forEach(function(course) {


                                                    output += course + "<br>";


                                                });



                                                document.getElementById("result")
                                                    .innerHTML = output;
                                            </script>


                                        </body>

                                        </html>
                                        HTML
                                        ]
                                        ,[
                                        'id'=>'js-objects',

                                        'title'=>'JavaScript Objects',

                                        'description'=>'Object သည် Key နှင့် Value ပုံစံဖြင့် Data များကို သိမ်းဆည်းရန် အသုံးပြုသည်။',

                                        'points'=>[
                                        'Object Creation',
                                        'Properties',
                                        'Methods',
                                        'Access Values',
                                        'Object Update'
                                        ],

                                        'code'=><<<HTML
                                            <!DOCTYPE html>
                                            <html>

                                            <body>


                                                <h2>
                                                    JavaScript Objects
                                                </h2>


                                                <p id="output"></p>


                                                <script>
                                                    let student = {


                                                        name: "John",

                                                        age: 21,

                                                        course: "JavaScript",


                                                        introduce: function() {

                                                            return "Hello " + this.name;

                                                        }


                                                    };



                                                    document.getElementById("output")
                                                        .innerHTML =

                                                        "Name : " +
                                                        student.name +
                                                        "<br>Age : " +
                                                        student.age +
                                                        "<br>Course : " +
                                                        student.course +
                                                        "<br>" +
                                                        student.introduce();
                                                </script>


                                            </body>

                                            </html>
                                            HTML
                                            ]
                                            ,[
                                            'id'=>'js-dom',

                                            'title'=>'JavaScript DOM Manipulation',

                                            'description'=>'DOM ကို အသုံးပြုပြီး HTML Element များကို JavaScript ဖြင့် ပြောင်းလဲနိုင်သည်။',

                                            'points'=>[
                                            'getElementById()',
                                            'querySelector()',
                                            'innerHTML',
                                            'style Change',
                                            'Create Element'
                                            ],

                                            'code'=><<<HTML
                                                <!DOCTYPE html>
                                                <html>

                                                <head>

                                                    <style>
                                                        .box {

                                                            width: 250px;

                                                            padding: 20px;

                                                            background: #2563eb;

                                                            color: white;

                                                            border-radius: 15px;

                                                        }
                                                    </style>

                                                </head>


                                                <body>


                                                    <h2>
                                                        DOM Manipulation
                                                    </h2>


                                                    <div id="box" class="box">

                                                        Hello User

                                                    </div>


                                                    <br>


                                                    <button onclick="changeBox()">

                                                        Change

                                                    </button>



                                                    <script>
                                                        function changeBox() {


                                                            let box =
                                                                document.getElementById("box");


                                                            box.innerHTML =
                                                                "DOM Changed Successfully";


                                                            box.style.background =
                                                                "#16a34a";


                                                            box.style.transform =
                                                                "scale(1.1)";


                                                        }
                                                    </script>


                                                </body>

                                                </html>
                                                HTML
                                                ]
                                                ,[
                                                'id'=>'js-events',

                                                'title'=>'JavaScript Events',

                                                'description'=>'JavaScript Events များသည် User ၏ Action များဖြစ်သော Click, Input, Mouse Move, Keyboard Action များကို Handle ပြုလုပ်ရန် အသုံးပြုသည်။',

                                                'points'=>[
                                                'click Event',
                                                'input Event',
                                                'mouseover Event',
                                                'keydown Event',
                                                'addEventListener()'
                                                ],

                                                'code'=><<<HTML
                                                    <!DOCTYPE html>
                                                    <html>

                                                    <head>

                                                        <style>
                                                            .box {

                                                                width: 250px;
                                                                padding: 30px;
                                                                background: #2563eb;
                                                                color: white;
                                                                border-radius: 15px;
                                                                text-align: center;

                                                            }
                                                        </style>

                                                    </head>

                                                    <body>


                                                        <h2>
                                                            JavaScript Events
                                                        </h2>


                                                        <div id="box" class="box">

                                                            Hover Or Click Me

                                                        </div>


                                                        <p id="result"></p>


                                                        <script>
                                                            let box =
                                                                document.getElementById("box");


                                                            box.addEventListener(
                                                                "click",
                                                                function() {

                                                                    document.getElementById("result")
                                                                        .innerHTML =
                                                                        "You clicked the box";

                                                                }
                                                            );



                                                            box.addEventListener(
                                                                "mouseover",
                                                                function() {

                                                                    box.style.background = "#16a34a";

                                                                }
                                                            );



                                                            box.addEventListener(
                                                                "mouseout",
                                                                function() {

                                                                    box.style.background = "#2563eb";

                                                                }
                                                            );
                                                        </script>


                                                    </body>

                                                    </html>
                                                    HTML
                                                    ]
                                                    ,[
                                                    'id'=>'js-form-validation',

                                                    'title'=>'JavaScript Form Validation',

                                                    'description'=>'Form Validation ကို အသုံးပြုပြီး User ထည့်သွင်းသော Data များ မှန်ကန်မှု ရှိမရှိ စစ်ဆေးနိုင်သည်။',

                                                    'points'=>[
                                                    'Input Checking',
                                                    'Required Validation',
                                                    'Email Validation',
                                                    'Error Message',
                                                    'Submit Control'
                                                    ],

                                                    'code'=><<<HTML
                                                        <!DOCTYPE html>
                                                        <html>

                                                        <body>


                                                            <h2>
                                                                Register Form
                                                            </h2>


                                                            <form onsubmit="return validate()">


                                                                <input
                                                                    id="name"
                                                                    placeholder="Name">


                                                                <br><br>


                                                                <input
                                                                    id="email"
                                                                    placeholder="Email">


                                                                <br><br>


                                                                <button>

                                                                    Submit

                                                                </button>


                                                            </form>


                                                            <p id="message"></p>



                                                            <script>
                                                                function validate() {


                                                                    let name =
                                                                        document.getElementById("name").value;


                                                                    let email =
                                                                        document.getElementById("email").value;



                                                                    if (name == "") {

                                                                        show("Name is required");

                                                                        return false;

                                                                    }



                                                                    if (!email.includes("@")) {

                                                                        show("Invalid Email");

                                                                        return false;

                                                                    }



                                                                    show("Form Submitted Successfully");


                                                                    return false;


                                                                }



                                                                function show(text) {


                                                                    document.getElementById("message")
                                                                        .innerHTML = text;


                                                                }
                                                            </script>


                                                        </body>

                                                        </html>
                                                        HTML
                                                        ]
                                                        ,[
                                                        'id'=>'js-fetch-api',

                                                        'title'=>'JavaScript JSON & Fetch API',

                                                        'description'=>'Fetch API ကို အသုံးပြုပြီး Server မှ Data များကို ရယူနိုင်ပြီး JSON Format ဖြင့် အသုံးပြုနိုင်သည်။',

                                                        'points'=>[
                                                        'JSON Object',
                                                        'fetch()',
                                                        'Promise',
                                                        'Response JSON',
                                                        'API Data Display'
                                                        ],

                                                        'code'=><<<HTML
                                                            <!DOCTYPE html>
                                                            <html>

                                                            <body>


                                                                <h2>
                                                                    Fetch API Example
                                                                </h2>


                                                                <button onclick="loadData()">

                                                                    Load Users

                                                                </button>


                                                                <div id="result"></div>



                                                                <script>
                                                                    function loadData() {


                                                                        fetch(
                                                                                "https://jsonplaceholder.typicode.com/users"
                                                                            )


                                                                            .then(response => response.json())


                                                                            .then(data => {


                                                                                let html = "";


                                                                                data.slice(0, 5)
                                                                                    .forEach(user => {


                                                                                        html +=

                                                                                            "<p>" +
                                                                                            user.name +
                                                                                            " - " +
                                                                                            user.email +
                                                                                            "</p>";


                                                                                    });


                                                                                document.getElementById("result")
                                                                                    .innerHTML = html;


                                                                            });


                                                                    }
                                                                </script>


                                                            </body>

                                                            </html>
                                                            HTML
                                                            ]
                                                            ,[
                                                            'id'=>'js-async',

                                                            'title'=>'Async JavaScript',

                                                            'description'=>'Async JavaScript ကို အသုံးပြုပြီး Asynchronous Operation များကို Handle ပြုလုပ်နိုင်သည်။ Promise နှင့် async/await ကို အသုံးပြုသည်။',

                                                            'points'=>[
                                                            'Promise',
                                                            'async function',
                                                            'await',
                                                            'try catch',
                                                            'API Request'
                                                            ],

                                                            'code'=><<<HTML
                                                                <!DOCTYPE html>
                                                                <html>

                                                                <body>


                                                                    <h2>
                                                                        Async Await
                                                                    </h2>


                                                                    <button onclick="getData()">

                                                                        Load Data

                                                                    </button>


                                                                    <p id="result"></p>



                                                                    <script>
                                                                        async function getData() {


                                                                            try {


                                                                                let response =
                                                                                    await fetch(
                                                                                        "https://jsonplaceholder.typicode.com/todos/1"
                                                                                    );



                                                                                let data =
                                                                                    await response.json();



                                                                                document.getElementById("result")
                                                                                    .innerHTML =

                                                                                    data.title;



                                                                            } catch (error) {


                                                                                document.getElementById("result")
                                                                                    .innerHTML =
                                                                                    "Error Loading Data";


                                                                            }



                                                                        }
                                                                    </script>


                                                                </body>

                                                                </html>
                                                                HTML
                                                                ]
                                                                ,[
                                                                'id'=>'js-es6',

                                                                'title'=>'Modern JavaScript ES6+',

                                                                'description'=>'ES6+ သည် JavaScript အသစ်များဖြစ်ပြီး Modern Web Development တွင် အသုံးများသည်။',

                                                                'points'=>[
                                                                'let & const',
                                                                'Arrow Function',
                                                                'Template Literals',
                                                                'Destructuring',
                                                                'Spread Operator',
                                                                'Modules'
                                                                ],

                                                                'code'=><<<HTML
                                                                    <!DOCTYPE html>
                                                                    <html>

                                                                    <body>


                                                                        <h2>
                                                                            Modern JavaScript ES6+
                                                                        </h2>


                                                                        <p id="result"></p>



                                                                        <script>
                                                                            const user = {


                                                                                name: "Alex",

                                                                                age: 25,

                                                                                skill: "JavaScript"


                                                                            };



                                                                            const {

                                                                                name,
                                                                                age,
                                                                                skill

                                                                            } = user;



                                                                            const skills = [

                                                                                "HTML",
                                                                                "CSS"

                                                                            ];



                                                                            const newSkills = [

                                                                                ...skills,
                                                                                "JavaScript"

                                                                            ];



                                                                            const message =


                                                                                Name: $ {
                                                                                    name
                                                                                } <
                                                                                br >
                                                                                Age: $ {
                                                                                    age
                                                                                } <
                                                                                br >
                                                                                Skill: $ {
                                                                                    skill
                                                                                } <
                                                                                br >
                                                                                All Skills: $ {
                                                                                    newSkills
                                                                                };



                                                                            document.getElementById("result")
                                                                                .innerHTML = message;
                                                                        </script>


                                                                    </body>

                                                                    </html>
                                                                    HTML
                                                                    ]
                                                                    ];

                                                                    @endphp

                                                                    <div class="grid grid-cols-1">
                                                                        @foreach($sections as $section)

                                                                        <section id="{{ $section['id'] }}" class="animate-card mb-14 relative">
                                                                            <div class="glass rounded-3xl overflow-hidden border border-white/60 shadow-xl">

                                                                                <!-- Header -->
                                                                                <div class="bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 p-7">
                                                                                    <div class="flex items-center justify-between">
                                                                                        <div>
                                                                                            <h2 class="text-3xl  font-black text-white">
                                                                                                {{ $section['title'] }}
                                                                                            </h2>
                                                                                            <p class="text-blue-100 mt-2">
                                                                                                Learn · Practice · Live Preview
                                                                                            </p>
                                                                                        </div>
                                                                                        <div class="w-16 h-16 rounded-2xl bg-white/20 flex items-center justify-center text-3xl">
                                                                                            💻
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="grid lg:grid-cols-2">

                                                                                    <!-- LEFT -->

                                                                                    <div class="p-8">
                                                                                        <h3 class="font-bold text-xl">
                                                                                            Explanation
                                                                                        </h3>
                                                                                        <p class="mt-4 text-slate-600 leading-8">
                                                                                            {{ $section['description'] }}
                                                                                        </p>
                                                                                        <div class="space-y-4 mt-8">

                                                                                            @foreach($section['points'] as $point)
                                                                                            <div class="rounded-2xl bg-slate-50 p-4 flex gap-3 items-center hover:bg-blue-50 duration-300">
                                                                                                <div class="w-9 h-9 rounded-full bg-blue-600 text-white flex items-center justify-center">
                                                                                                    ✓
                                                                                                </div>
                                                                                                <div>
                                                                                                    {!! $point !!}
                                                                                                </div>
                                                                                            </div>
                                                                                            @endforeach
                                                                                        </div>
                                                                                    </div>

                                                                                    <!-- RIGHT -->

                                                                                    <div class="bg-slate-950 ">
                                                                                        <!-- Toolbar -->
                                                                                        <div class="editorToolbar flex flex-wrap items-center justify-between gap-3 px-5 py-3 bg-[#1e1e1e] border-b border-slate-800">

                                                                                            <div class="flex items-center gap-2">

                                                                                                <span class="w-3 h-3 rounded-full bg-red-500"></span>
                                                                                                <span class="w-3 h-3 rounded-full bg-yellow-500"></span>
                                                                                                <span class="w-3 h-3 rounded-full bg-green-500"></span>

                                                                                                <span class="ml-4 text-slate-400 text-sm">
                                                                                                    index.html
                                                                                                </span>

                                                                                            </div>

                                                                                            <div class="flex flex-wrap gap-2">

                                                                                                <button class="fontMinus px-3 py-2 rounded-lg bg-slate-700 text-white">
                                                                                                    A-
                                                                                                </button>

                                                                                                <button class="fontPlus px-3 py-2 rounded-lg bg-slate-700 text-white">
                                                                                                    A+
                                                                                                </button>

                                                                                                <button class="fullscreenBtn px-3 py-2 rounded-lg bg-indigo-600 text-white">
                                                                                                    Fullscreen
                                                                                                </button>

                                                                                                <button class="runBtn px-4 py-2 rounded-lg bg-green-600 text-white">
                                                                                                    ▶ Run
                                                                                                </button>

                                                                                                <button class="copyBtn px-4 py-2 rounded-lg bg-sky-600 text-white">
                                                                                                    Copy
                                                                                                </button>

                                                                                                <button class="resetBtn px-4 py-2 rounded-lg bg-amber-500 text-white">
                                                                                                    Reset
                                                                                                </button>

                                                                                                <button class="downloadBtn px-4 py-2 rounded-lg bg-purple-600 text-white">
                                                                                                    Download
                                                                                                </button>

                                                                                            </div>

                                                                                        </div>
                                                                                        <!-- HTML Editor -->

                                                                                        <textarea class="editor w-full h-full bg-slate-950 text-green-400 font-mono text-sm p-5 outline-none resize-y"
                                                                                            spellcheck="false">{{ trim($section['code']) }}
                                                                                        </textarea>

                                                                                        <div class="previewWrapper absolute inset-0 hidden items-center justify-center bg-black/60 backdrop-blur-sm z-30">

                                                                                            <div class="previewCard w-[90%] max-w-5xl bg-white rounded-3xl shadow-2xl overflow-hidden scale-75 opacity-0">

                                                                                                <!-- Header -->
                                                                                                <div class="flex items-center justify-between px-6 py-4 bg-slate-900">

                                                                                                    <div>
                                                                                                        <h3 class="text-white text-xl font-bold">
                                                                                                            Live Preview
                                                                                                        </h3>
                                                                                                        <p class="text-green-400 text-xs">
                                                                                                            HTML Output
                                                                                                        </p>
                                                                                                    </div>

                                                                                                    <button
                                                                                                        class="closePreview w-10 h-10 rounded-full bg-red-500 hover:bg-red-600 text-white transition">
                                                                                                        ✕
                                                                                                    </button>

                                                                                                </div>

                                                                                                <iframe
                                                                                                    class="preview w-full h-[600px] bg-white">
                                                                                                </iframe>

                                                                                            </div>

                                                                                        </div>

                                                                                    </div>

                                                                                </div>

                                                                            </div>

                                                                        </section>

                                                                        @endforeach
                                                                    </div>
    </div>
    <script>
        document
            .querySelectorAll("section")
            .forEach(section => {

                const editor =
                    section.querySelector(".editor");

                const preview =
                    section.querySelector(".preview");

                const runBtn =
                    section.querySelector(".runBtn");

                const copyBtn =
                    section.querySelector(".copyBtn");

                const resetBtn =
                    section.querySelector(".resetBtn");

                const downloadBtn =
                    section.querySelector(".downloadBtn");
                const previewWrapper = section.querySelector(".previewWrapper");
                const closePreview = section.querySelector(".closePreview");

                const defaultCode =
                    editor.value;

                const previewCard = section.querySelector(".previewCard");


                function render() {

                    preview.srcdoc = editor.value;

                }

                // Run
                runBtn.onclick = () => {

                    render();

                    previewWrapper.classList.remove("hidden", "hide");

                    previewWrapper.classList.add("show");

                    runBtn.innerHTML = "✓ Running";

                    showToast("Running");

                    setTimeout(() => {

                        runBtn.innerHTML = "▶ Run";

                    }, 1000);

                };


                // Close
                closePreview.onclick = () => {

                    previewWrapper.classList.remove("show");

                    previewWrapper.classList.add("hide");

                    setTimeout(() => {

                        previewWrapper.classList.add("hidden");

                        preview.srcdoc = "";

                    }, 300);

                };

                // ======================
                // Copy
                // ======================

                copyBtn.onclick = async () => {

                    await navigator
                        .clipboard
                        .writeText(
                            editor.value
                        );

                    copyBtn.innerHTML = "✓ Copied";

                    setTimeout(() => {

                        copyBtn.innerHTML = "Copy";

                    }, 1500);

                };

                // ======================
                // Reset
                // ======================

                resetBtn.onclick = () => {

                    editor.value =
                        defaultCode;

                    render();

                };

                // ======================
                // Download
                // ======================

                downloadBtn.onclick = () => {

                    const blob =
                        new Blob(

                            [editor.value],

                            {
                                type: "text/html"
                            }

                        );

                    const url =
                        URL.createObjectURL(
                            blob
                        );

                    const a =
                        document.createElement("a");

                    a.href = url;

                    a.download = "index.html";

                    a.click();

                    URL.revokeObjectURL(url);

                };

            });
        document.querySelectorAll("section").forEach(section => {

            const editor = section.querySelector(".editor");

            const runBtn = section.querySelector(".runBtn");

            const copyBtn = section.querySelector(".copyBtn");

            const resetBtn = section.querySelector(".resetBtn");

            const downloadBtn = section.querySelector(".downloadBtn");

            const wrapBtn = section.querySelector(".wrapBtn");

            const plus = section.querySelector(".fontPlus");

            const minus = section.querySelector(".fontMinus");

            const fullscreen = section.querySelector(".fullscreenBtn");

            let size = 14;

            plus.onclick = () => {

                size++;

                editor.style.fontSize = size + "px";

            };

            minus.onclick = () => {

                if (size > 10) {

                    size--;

                    editor.style.fontSize = size + "px";

                }

            };

            let wrap = true;

            wrapBtn.onclick = () => {

                wrap = !wrap;

                editor.style.whiteSpace = wrap ? "pre-wrap" : "pre";

                showToast("Word Wrap");

            };

            fullscreen.onclick = () => {

                const panel = editor.parentElement;

                panel.classList.toggle("fullscreen-editor");

                fullscreen.innerHTML =

                    panel.classList.contains("fullscreen-editor")

                    ?
                    "Exit"

                    :
                    "Fullscreen";

            };

            copyBtn.addEventListener("click", () => {

                showToast("Copied");

            });

            resetBtn.addEventListener("click", () => {

                showToast("Reset");

            });

            downloadBtn.addEventListener("click", () => {

                showToast("Downloaded");

            });

            runBtn.addEventListener("click", () => {

                showToast("Running");

            });

            // editor.addEventListener("keydown", (e) => {

            //     if (e.ctrlKey && e.key === "Enter") {

            //         e.preventDefault();

            //         runBtn.click();

            //     }

            //     if (e.ctrlKey && e.key === "s") {

            //         e.preventDefault();

            //         downloadBtn.click();

            //     }

            // });
            // Keyboard Shortcut
            editor.addEventListener("keydown", (e) => {

                if (e.ctrlKey && e.key === "Enter") {

                    e.preventDefault();

                    runBtn.click();

                }

                if (e.ctrlKey && e.key.toLowerCase() === "s") {

                    e.preventDefault();

                    downloadBtn.click();

                }

            });

        });
    </script>


</div>

@endsection