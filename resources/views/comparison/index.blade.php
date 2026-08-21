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
                    CC
                </div>
                <div class="min-w-0">
                    <h1 class="text-slate-900 font-semibold text-base md:text-lg truncate">
                        Code Compare
                    </h1>
                    <p class="text-xs md:text-sm text-slate-500 truncate">
                        PHP laravel, Java spring, C sharp Asp.Net Framework code compare.
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

    <div class="flex justify-between gap-2">

        <!-- left site -->
        <div id="content" class="overflow-y-auto h-screen space-y-16 ml-14 pr-8 pt-10 pb-24 w-full">

            <section id="Registration"
                class="glass rounded-3xl shadow-xl p-8 fade">
                <h2
                    class="text-lg md:text-3xl text-slate-600 font-semibold mb-8 ">
                    Feature 01 :
                    <span class="bg-gradient-to-r from-indigo-600 via-purple-500 to-pink-500 bg-clip-text text-transparent">
                        Registration
                    </span>
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8 ">
                    <button
                        onclick="changeLanguage('laravel')"
                        class="bg-red-100 rounded-2xl p-5 font-bold hover:scale-105 transition ">
                        PHP Laravel
                    </button>
                    <button
                        onclick="changeLanguage('java')"
                        class="bg-orange-100 rounded-2xl p-5 font-bold hover:scale-105 transition">
                        Java Spring
                    </button>
                    <button
                        onclick="changeLanguage('csharp')"
                        class="bg-blue-100 rounded-2xl p-5 font-bold hover:scale-105 transition ">
                        C# ASP.NET
                    </button>
                </div>
                <div
                    class="grid grid-cols-1 lg:grid-cols-2 gap-8 fade ">
                    <div>
                        <h3
                            class="text-xl font-bold mb-4">
                            Code
                        </h3>
                        <div
                            id="codeArea"
                            class="code-box h-100">
                        </div>
                        <button
                            onclick="copyCode()"
                            class="mt-4 bg-slate-900 text-white px-5 py-2 rounded-xl ">
                            Copy Code
                        </button>
                    </div>
                    <div>
                        <h3
                            class="text-xl font-bold mb-4 ">
                            Explanation
                        </h3>
                        <div
                            id="explainArea"
                            class="bg-slate-100 rounded-3xl p-6 min-h-[250px] ">
                        </div>
                    </div>
                </div>
            </section>

            <section id="CRUD"
                class="glass rounded-3xl shadow-xl p-8 fade ">
                <h2
                    class="text-lg md:text-3xl text-slate-600 font-semibold mb-8">
                    Feature 02 :
                    <span class="bg-gradient-to-r from-indigo-600 via-purple-500 to-pink-500 bg-clip-text text-transparent">
                        CRUD
                    </span>
                </h2>
                <div
                    class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
                    <button
                        onclick="changeCrud('laravel')"
                        class="bg-red-100 rounded-2xl p-5 font-bold hover:scale-105 transition">
                        PHP Laravel
                    </button>
                    <button
                        onclick="changeCrud('java')"
                        class="bg-orange-100 rounded-2xl p-5 font-bold hover:scale-105 transition">
                        Java Spring
                    </button>
                    <button
                        onclick="changeCrud('csharp')"
                        class="bg-blue-100 rounded-2xl p-5 font-bold hover:scale-105 transition ">
                        C# ASP.NET
                    </button>
                </div>
                <div
                    class="grid grid-cols-1 lg:grid-cols-2 gap-8 ">
                    <div>
                        <h3
                            class="text-xl font-bold mb-4">
                            CRUD Code
                        </h3>
                        <div
                            id="crudCodeArea"
                            class="code-box h-100">
                        </div>
                        <button
                            onclick="copyCrudCode()"
                            class="mt-4 bg-slate-900 text-white px-5 py-2 rounded-xl ">
                            Copy Code
                        </button>
                    </div>
                    <div>
                        <h3
                            class="text-xl font-bold mb-4">
                            CRUD Explanation
                        </h3>
                        <div
                            id="crudExplainArea"
                            class="bg-slate-100 rounded-3xl p-6 min-h-[250px] ">
                        </div>
                    </div>
                </div>
            </section>
            <section id="Chat"
                class="glass rounded-3xl shadow-xl p-8 fade ">
                <h2
                    class="text-lg md:text-3xl text-slate-600 font-semibold mb-8">
                    Feature 03 :
                    <span class="bg-gradient-to-r from-indigo-600 via-purple-500 to-pink-500 bg-clip-text text-transparent">
                        Chat
                    </span>
                </h2>
                <div
                    class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
                    <button
                        onclick="changeChat('laravel')"
                        class="bg-red-100 rounded-2xl p-5 font-bold hover:scale-105 transition">
                        PHP Laravel
                    </button>
                    <button
                        onclick="changeChat('java')"
                        class="bg-orange-100 rounded-2xl p-5 font-bold hover:scale-105 transition">
                        Java Spring
                    </button>
                    <button
                        onclick="changeChat('csharp')"
                        class="bg-blue-100 rounded-2xl p-5 font-bold hover:scale-105 transition ">
                        C# ASP.NET
                    </button>
                </div>
                <div
                    class="grid grid-cols-1 lg:grid-cols-2 gap-8 ">
                    <div>
                        <h3
                            class="text-xl font-bold mb-4">
                            CRUD Code
                        </h3>
                        <div
                            id="chatCodeArea"
                            class="code-box h-100">
                        </div>
                        <button
                            onclick="copyChatCode()"
                            class="mt-4 bg-slate-900 text-white px-5 py-2 rounded-xl ">
                            Copy Code
                        </button>
                    </div>
                    <div>
                        <h3
                            class="text-xl font-bold mb-4">
                            CRUD Explanation
                        </h3>
                        <div
                            id="chatExplainArea"
                            class="bg-slate-100 rounded-3xl p-6 min-h-[250px] ">
                        </div>
                    </div>
                </div>
            </section>


            <section id="OTP"
                class="glass rounded-3xl shadow-xl p-8 fade">

                <h2
                    class="text-lg md:text-3xl text-slate-600 font-semibold mb-8">
                    Feature 03 :
                    <span
                        class="bg-gradient-to-r from-indigo-600 via-purple-500 to-pink-500 bg-clip-text text-transparent">
                        Send OTP Gmail
                    </span>
                </h2>

                <div
                    class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">

                    <button
                        onclick="changeOtp('laravel')"
                        class="bg-red-100 rounded-2xl p-5 font-bold hover:scale-105 transition">
                        PHP Laravel
                    </button>

                    <button
                        onclick="changeOtp('java')"
                        class="bg-orange-100 rounded-2xl p-5 font-bold hover:scale-105 transition">
                        Java Spring
                    </button>

                    <button
                        onclick="changeOtp('csharp')"
                        class="bg-blue-100 rounded-2xl p-5 font-bold hover:scale-105 transition">
                        C# ASP.NET
                    </button>

                </div>

                <div
                    class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                    <div>

                        <h3 class="text-xl font-bold mb-4">
                            Send OTP Code
                        </h3>

                        <div
                            id="otpCodeArea"
                            class="code-box h-100">
                        </div>

                        <button
                            onclick="copyOtpCode()"
                            class="mt-4 bg-slate-900 text-white px-5 py-2 rounded-xl">
                            Copy Code
                        </button>

                    </div>

                    <div>

                        <h3 class="text-xl font-bold mb-4">
                            OTP Explanation
                        </h3>

                        <div
                            id="otpExplainArea"
                            class="bg-slate-100 rounded-3xl p-6 min-h-[250px]">
                        </div>

                    </div>

                </div>

            </section>

            <section id="JWT"
                class="glass rounded-3xl shadow-xl p-8 fade">

                <h2
                    class="text-lg md:text-3xl text-slate-600 font-semibold mb-8">
                    Feature 04 :
                    <span
                        class="bg-gradient-to-r from-indigo-600 via-purple-500 to-pink-500 bg-clip-text text-transparent">
                        JWT Login Authentication
                    </span>
                </h2>

                <div
                    class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">

                    <button onclick="changeJwt('laravel')"
                        class="bg-red-100 rounded-2xl p-5 font-bold">
                        PHP Laravel
                    </button>

                    <button onclick="changeJwt('java')"
                        class="bg-orange-100 rounded-2xl p-5 font-bold">
                        Java Spring
                    </button>

                    <button onclick="changeJwt('csharp')"
                        class="bg-blue-100 rounded-2xl p-5 font-bold">
                        C# ASP.NET
                    </button>

                </div>

                <div
                    class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                    <div>
                        <h3 class="text-xl font-bold mb-4">
                            JWT Login Code
                        </h3>
                        <div id="jwtCodeArea" class="code-box h-100"></div>
                    </div>

                    <div>
                        <h3 class="text-xl font-bold mb-4">
                            Authentication Explanation
                        </h3>
                        <div id="jwtExplainArea"
                            class="bg-slate-100 rounded-3xl p-6 min-h-[250px]"></div>
                    </div>

                </div>
            </section>
            <section id="ImageUpload"
                class="glass rounded-3xl shadow-xl p-8 fade">

                <h2
                    class="text-lg md:text-3xl text-slate-600 font-semibold mb-8">
                    Feature 05 :
                    <span
                        class="bg-gradient-to-r from-indigo-600 via-purple-500 to-pink-500 bg-clip-text text-transparent">
                        Image Upload
                    </span>
                </h2>

                <div
                    class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">

                    <button
                        onclick="changeImageUpload('laravel')"
                        class="bg-red-100 rounded-2xl p-5 font-bold hover:scale-105 transition">
                        PHP Laravel
                    </button>

                    <button
                        onclick="changeImageUpload('java')"
                        class="bg-orange-100 rounded-2xl p-5 font-bold hover:scale-105 transition">
                        Java Spring
                    </button>

                    <button
                        onclick="changeImageUpload('csharp')"
                        class="bg-blue-100 rounded-2xl p-5 font-bold hover:scale-105 transition">
                        C# ASP.NET
                    </button>

                </div>

                <div
                    class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                    <div>

                        <h3 class="text-xl font-bold mb-4">
                            Image Upload Code
                        </h3>

                        <div
                            id="imageUploadCodeArea"
                            class="code-box h-100">
                        </div>

                        <button
                            onclick="copyImageUploadCode()"
                            class="mt-4 bg-slate-900 text-white px-5 py-2 rounded-xl">
                            Copy Code
                        </button>

                    </div>

                    <div>

                        <h3 class="text-xl font-bold mb-4">
                            Upload Explanation
                        </h3>

                        <div
                            id="imageUploadExplainArea"
                            class="bg-slate-100 rounded-3xl p-6 min-h-[250px]">
                        </div>

                    </div>

                </div>

            </section>
            <section id="Summary"
                class="glass rounded-3xl shadow-xl p-8 ">
                <h2
                    class="text-lg md:text-3xl font-black mb-8">
                    Feature <span class="bg-gradient-to-r from-indigo-600 via-purple-500 to-pink-500 bg-clip-text text-transparent">
                        Summary
                    </span>
                </h2>
                <div
                    class="overflow-x-auto">
                    <table
                        class="w-full text-left">
                        <thead>
                            <tr
                                class="bg-white/60">
                                <th class="p-4">
                                    Feature
                                </th>
                                <th class="p-4">
                                    Laravel
                                </th>
                                <th class="p-4">
                                    Java
                                </th>
                                <th class="p-4">
                                    C#
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                class="border-b">
                                <td class="p-4 font-bold">
                                    Registration
                                </td>
                                <td class="p-4">
                                    Hash::make()
                                </td>
                                <td class="p-4">
                                    BCrypt Encoder
                                </td>
                                <td class="p-4">
                                    PasswordHasher
                                </td>
                            </tr>
                            <tr>

                                <td class="p-4 font-bold">
                                    CRUD
                                </td>
                                <td class="p-4">
                                    Eloquent
                                </td>
                                <td class="p-4">
                                    JPA Repository
                                </td>
                                <td class="p-4">
                                    EF Core
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

        </div>


        <!-- right site  -->
        <div class="w-70 h-screen bg-gradient-to-br from-indigo-200 via-white to-purple-300 pt-8 pl-5 hidden md:flex">

            <ul class="space-y-3">

                <li class="group flex items-center gap-4 px-4 py-2 rounded-xl bg-gradient-to-r from-white to-blue-100 shadow hover:shadow-lg transition">
                    <div class="w-2 h-8 bg-blue-500 rounded-full"></div>
                    <div>
                        <h3 class="font-bold text-gray-800 group-hover:text-blue-600">
                            <a href="#" onclick="goToSection('Registration')">
                                Registration
                            </a>
                        </h3>
                    </div>
                </li>
                <li class="group flex items-center gap-4 px-4 py-2 rounded-xl bg-gradient-to-r from-white to-blue-100 shadow hover:shadow-lg transition">
                    <div class="w-2 h-8 bg-green-500 rounded-full"></div>
                    <div>
                        <h3 class="font-bold text-gray-800 group-hover:text-green-600">
                            <a href="#" onclick="goToSection('CRUD')">
                                CRUD
                            </a>
                        </h3>
                    </div>
                </li>
                <li class="group flex items-center gap-4 px-4 py-2 rounded-xl bg-gradient-to-r from-white to-blue-100 shadow hover:shadow-lg transition">
                    <div class="w-2 h-8 bg-purple-500 rounded-full"></div>
                    <div>
                        <h3 class="font-bold text-gray-800 group-hover:text-purple-600">
                            <a href="#" onclick="goToSection('Chat')">
                                Chat
                            </a>
                        </h3>
                    </div>
                </li>
                <li class="group flex items-center gap-4 px-4 py-2 rounded-xl bg-gradient-to-r from-white to-blue-100 shadow hover:shadow-lg transition">
                    <div class="w-2 h-8 bg-orange-500 rounded-full"></div>
                    <div>
                        <h3 class="font-bold text-gray-800 group-hover:text-orange-600">
                            <a href="#" onclick="goToSection('OTP')">
                                OTP
                            </a>
                        </h3>
                    </div>
                </li>
                <li class="group flex items-center gap-4 px-4 py-2 rounded-xl bg-gradient-to-r from-white to-blue-100 shadow hover:shadow-lg transition">
                    <div class="w-2 h-8 bg-yellow-500 rounded-full"></div>
                    <div>
                        <h3 class="font-bold text-gray-800 group-hover:text-yellow-600">
                            <a href="#" onclick="goToSection('JWT')">
                                JWT
                            </a>
                        </h3>
                    </div>
                </li>
                <li class="group flex items-center gap-4 px-4 py-2 rounded-xl bg-gradient-to-r from-white to-blue-100 shadow hover:shadow-lg transition">
                    <div class="w-2 h-8 bg-yellow-500 rounded-full"></div>
                    <div>
                        <h3 class="font-bold text-gray-800 group-hover:text-yellow-600">
                            <a href="#" onclick="goToSection('ImageUpload')">
                                Image Upload
                            </a>
                        </h3>
                    </div>
                </li>
                <li class="group flex items-center gap-4 px-4 py-2 rounded-xl bg-gradient-to-r from-white to-blue-100 shadow hover:shadow-lg transition">
                    <div class="w-2 h-8 bg-cyan-500 rounded-full"></div>
                    <div>
                        <h3 class="font-bold text-gray-800 group-hover:text-cyan-600">
                            <a href="#" onclick="goToSection('Summary')">
                                Summary
                            </a>
                        </h3>
                    </div>
                </li>

            </ul>
        </div>


    </div>

</div>


<script>
    // Registration
    const registration = {
        laravel: {
            code: `
public function register(
    Request $request
)
    {

        $data =
        $request->validate([
            'name'=>'required',

            'email'=>'required',

            'password'=>'required'

        ]);

        User::create([

            'name'=>$data['name'],

            'email'=>$data['email'],

            'password'=>
                Hash::make(
                $data['password']
            )

        ]);
        
    return "Success";

}
`,


            explain: `
                    <ul class="list-disc ml-5 space-y-3">

                    <li>
                    validate() checks user input
                    </li>

                    <li>
                    Hash::make encrypts password
                    </li>

                    <li>
                    Eloquent creates user record
                    </li>

                    <li>
                    Controller handles request
                    </li>

                    </ul>

                    `

        },

        java: {
            code: `
@PostMapping("/register")
public ResponseEntity register(

    @RequestBody User user

)
    {
        user.setPassword(

            encoder.encode(
                 user.getPassword()
            )
        );


        repository.save(user);

        return ResponseEntity.ok(
            "Success"
        );

    }
`,

            explain: `
                    <ul class="list-disc ml-5 space-y-3">

                    <li>
                    @PostMapping receives request
                    </li>

                    <li>
                    Encoder secures password
                    </li>

                    <li>
                    Repository saves entity
                    </li>

                    <li>
                    Spring handles dependency injection
                    </li>

                    </ul>

                    `

        },

        csharp: {
            code: `
[HttpPost]
public IActionResult Register(
    RegisterModel model
)
    {

    if(ModelState.IsValid)
    {

        model.Password =_hash.HashPassword(model.Password);

                _db.Users.Add(model);

                _db.SaveChanges();

    }

    return Ok();

}
`,

            explain: `
                    <ul class="list-disc ml-5 space-y-3">

                    <li>
                    ModelState validates data
                    </li>

                    <li>
                    PasswordHasher protects password
                    </li>

                    <li>
                    Entity Framework saves data
                    </li>

                    <li>
                    Controller handles HTTP request
                    </li>

                    </ul>`

        }
    };

    function changeLanguage(language) {
        let data =
            registration[language];



        let code =
            document.getElementById(
                "codeArea"
            );



        let explain =
            document.getElementById(
                "explainArea"
            );




        code.classList.remove("fade");

        explain.classList.remove("fade");



        setTimeout(() => {


            code.innerHTML =
                "<pre>" + data.code + "</pre>";



            explain.innerHTML =
                data.explain;



            code.classList.add("fade");

            explain.classList.add("fade");



        }, 100);




    }


    function copyCode() {


        let text =
            document
            .getElementById("codeArea")
            .innerText;


        navigator.clipboard.writeText(text);


        alert(
            "Code Copied"
        );


    }

    changeLanguage('laravel');

    // CRUD

    const crudData = {
        laravel: {
            code: `
class ProductController extends Controller
{

    public function store(Request $request)
    {
         Product::create([

            'name'=>$request->name,

            'price'=>$request->price

        ]);


    }

    public function index()
    {

        return Product::all();

    }

    public function update(
    Request $request,
    $id
    )
    {

        $product = Product::find($id);

        $product->update(
            $request->all()
        );

    }

    public function destroy($id)
    {
        Product::destroy($id);


    }


}
                    `,

            explain: `
                <ul class="list-disc ml-5 space-y-3">

                <li>
                create() creates new record
                </li>

                <li>
                all() reads data
                </li>

                <li>
                update() modifies data
                </li>

                <li>
                destroy() removes data
                </li>

                <li>
                Eloquent ORM handles database
                </li>

                </ul>

                `

        },

        java: {
            code: `
@RestController
@RequestMapping("/products")

public class ProductController
{

    @Autowired
    ProductRepository repository;
    @PostMapping

    public Product create(
        @RequestBody Product product
        )
    {
        return repository.save(product);
    }

    @GetMapping
    public List<Product> read()
    {
        return repository.findAll();
    }

    @DeleteMapping("/{id}")
    public void delete(Long id)
    {

        repository.deleteById(id);

    }
}
                        `,


            explain: `
                    <ul class="list-disc ml-5 space-y-3">
                    <li>
                    Controller receives request
                    </li>
                    <li>
                    JpaRepository provides CRUD
                    </li>
                    <li>
                    save() creates and updates
                    </li>
                    <li>
                    findAll() reads records
                    </li>
                    <li>
                    deleteById() deletes data
                    </li>
                    </ul>
                    `


        },


        csharp: {

            code: `
                [ApiController]

                [Route("api/products")]

                public class ProductController :
                ControllerBase
                {

                private readonly AppDbContext _db;

                [HttpPost]

                public IActionResult Create(
                Product product
                )
                {

                _db.Products.Add(product);


                _db.SaveChanges();


                return Ok(product);


                }


                [HttpGet]

                public IActionResult Read()
                {


                return Ok(
                _db.Products.ToList()
                );


                }


                [HttpDelete("{id}")]

                public IActionResult Delete(
                int id
                )
                {


                var item =
                _db.Products.Find(id);



                _db.Products.Remove(item);


                _db.SaveChanges();



                return Ok();


                }


                }
                `,


            explain: `
                <ul class="list-disc ml-5 space-y-3">


                <li>
                Controller handles API
                </li>


                <li>
                Entity Framework maps database
                </li>


                <li>
                Add() inserts data
                </li>


                <li>
                LINQ reads records
                </li>


                <li>
                Remove() deletes data
                </li>


                </ul>

                `

        }


    };

    function changeCrud(language) {
        let data =
            crudData[language];
        let codeBox =
            document.getElementById(
                "crudCodeArea"
            );
        let explainBox =
            document.getElementById(
                "crudExplainArea"
            );
        codeBox.classList.remove(
            "fade"
        );
        explainBox.classList.remove(
            "fade"
        );
        setTimeout(() => {
            codeBox.innerHTML =
                "<pre>" +
                data.code +
                "</pre>";

            explainBox.innerHTML =
                data.explain;

            codeBox.classList.add(
                "fade"
            );

            explainBox.classList.add(
                "fade"
            );

        }, 150);

    }
    changeCrud('laravel');

    function copyCrudCode() {


        let text =
            document
            .getElementById("crudCodeArea")
            .innerText;


        navigator.clipboard.writeText(text);


        alert(
            "Code Copied"
        );


    }

    // Chat

    const chatData = {
        laravel: {
            code: `
                    // app/Events/MessageSent.php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    // Define which channel to broadcast on
    public function broadcastOn()
    {
        return new Channel('chat-room');
    }
}
                    `,

            explain: `

                <ul class="list-disc ml-5 space-y-3">

                <li>
                broadcastOn() Method: This specifies the routing channel
                </li>

                <li>
                the data travels through a public channel named chat-room
                </li>

                <li>
                The frontend client must subscribe and listen to this exact channel name
                </li>


                </ul>

                `

        },

        java: {
            code: `
import org.springframework.messaging.handler.annotation.MessageMapping;
import org.springframework.messaging.handler.annotation.SendTo;
import org.springframework.stereotype.Controller;

@Controller
public class ChatController {

    // 1. Listen for messages sent to /app/sendMessage
    @MessageMapping("/sendMessage")
    // 2. Broadcast the return value to all subscribers of /topic/messages
    @SendTo("/topic/messages")
    public ChatMessage broadcastMessage(ChatMessage message) {
        return message; // Multi-cast to all connected clients
    }
}
                        `,


            explain: `
                    <ul class="list-disc ml-5 space-y-3">
                    <li>
                    @MessageMapping("/sendMessage"): This annotation maps incoming messages sent by the client to this specific controller method (similar to @PostMapping in standard REST APIs). 
                    </li>
                    <li>
                    @SendTo("/topic/messages"): Once the method processes the incoming data, the return value is automatically broadcasted to all users subscribed to the /topic/messages destination.
                    </li>
                    </ul>
                    `


        },


        csharp: {

            code: `
using Microsoft.AspNetCore.SignalR;
using System.Threading.Tasks;

public class ChatHub : Hub
{
    // Method called by clients to send message
    public async Task SendMessage(string user, string message)
    {
        // Broadcast to ALL connected clients
        await Clients.All.SendAsync("ReceiveMessage", user, message);
    }
}
                `,


            explain: `
                <ul class="list-disc ml-5 space-y-3">

                <li>
                 Hub Class: The Hub is the central pipeline. It manages connections, groups, and incoming messages from the frontend clients.
                </li>

                <li>
                 Clients.All.SendAsync(): This targets every single active connection on the server.
                </li>


                <li>
                 It remotely triggers a JavaScript function called ReceiveMessage on the frontend, instantly passing the user and message data to them.
                </li>

                </ul>

                `

        }


    };

    function changeChat(language) {
        let data =
            chatData[language];
        let codeBox =
            document.getElementById(
                "chatCodeArea"
            );
        let explainBox =
            document.getElementById(
                "chatExplainArea"
            );
        codeBox.classList.remove(
            "fade"
        );
        explainBox.classList.remove(
            "fade"
        );
        setTimeout(() => {
            codeBox.innerHTML =
                "<pre>" +
                data.code +
                "</pre>";

            explainBox.innerHTML =
                data.explain;

            codeBox.classList.add(
                "fade"
            );

            explainBox.classList.add(
                "fade"
            );

        }, 150);

    }
    changeChat('laravel');

    function copyChatCode() {


        let text =
            document
            .getElementById("chatCodeArea")
            .innerText;


        navigator.clipboard.writeText(text);


        alert(
            "Code Copied"
        );


    }



    //otp send
    const otpData = {

        laravel: {

            code: `
<pre><code>
use Illuminate\\Support\\Facades\\Mail;

public function sendOtp(Request $request)
{
$otp = rand(100000, 999999);

session([
    'otp' => $otp,
    'otp_expires_at' => now()->addMinutes(5)
]);

Mail::raw(
    "Your OTP Code is: {$otp}",
    function ($message) use ($request) {
        $message->to($request->email)
                ->subject('Your OTP Code');
    }
);

return response()->json([
    'message' => 'OTP sent successfully'
]);
}
</code></pre>
    `,

            explanation: `
        <p class="mb-4">
            <strong>PHP Laravel</strong>
        </p>

        <ul class="list-disc ml-5 space-y-2">
            <li>Laravel generates a 6-digit OTP.</li>
            <li>The OTP is stored temporarily in the session.</li>
            <li>The OTP expires after 5 minutes.</li>
            <li>Laravel Mail sends the OTP to Gmail.</li>
            <li>Mail configuration is handled through Laravel's mail system.</li>
        </ul>
    `
        },


        java: {

            code: `
<pre><code>
@Service
public class OtpService {

private final JavaMailSender mailSender;

public OtpService(JavaMailSender mailSender) {
    this.mailSender = mailSender;
}

public void sendOtp(String email) {

    int otp =
        ThreadLocalRandom.current()
            .nextInt(100000, 1000000);

    SimpleMailMessage message =
        new SimpleMailMessage();

    message.setTo(email);
    message.setSubject("Your OTP Code");
    message.setText(
        "Your OTP Code is: " + otp
    );

    mailSender.send(message);
}
}
</code></pre>
    `,

            explanation: `
        <p class="mb-4">
            <strong>Java Spring</strong>
        </p>

        <ul class="list-disc ml-5 space-y-2">
            <li>Spring uses <strong>JavaMailSender</strong> to send email.</li>
            <li>A random 6-digit OTP is generated.</li>
            <li>The email address is passed to the mail service.</li>
            <li>Spring Boot handles the SMTP configuration.</li>
            <li>OTP storage and expiration can be implemented with Session, Redis or Database.</li>
        </ul>
    `
        },


        csharp: {

            code: `
<pre><code>
public async Task SendOtp(string email)
{
var random = new Random();

int otp =
    random.Next(100000, 1000000);

using var message =
    new MailMessage();

message.To.Add(email);
message.Subject = "Your OTP Code";
message.Body =
    $"Your OTP Code is: {otp}";

using var smtp =
    new SmtpClient("smtp.gmail.com", 587);

smtp.EnableSsl = true;
smtp.Credentials =
    new NetworkCredential(
        "your@gmail.com",
        "APP_PASSWORD"
    );

await smtp.SendMailAsync(message);
}
</code></pre>
    `,

            explanation: `
        <p class="mb-4">
            <strong>C# ASP.NET</strong>
        </p>

        <ul class="list-disc ml-5 space-y-2">
            <li>ASP.NET generates a random 6-digit OTP.</li>
            <li><strong>SmtpClient</strong> is used to connect to Gmail SMTP.</li>
            <li>Gmail SMTP uses port 587 with SSL/TLS.</li>
            <li>An App Password should be used instead of the normal Gmail password.</li>
            <li>OTP can be stored using Session, Cache, Redis or Database.</li>
        </ul>
    `
        }

    };


    function changeOtp(type) {

        document.getElementById('otpCodeArea').innerHTML =
            otpData[type].code;

        document.getElementById('otpExplainArea').innerHTML =
            otpData[type].explanation;
    }


    function copyOtpCode() {

        const code =
            document.getElementById('otpCodeArea').innerText;

        navigator.clipboard.writeText(code);

        alert('Code copied!');
    }


    // Default
    changeOtp('laravel');



    //jwt
    const jwtData = {

        laravel: {
            code: `<pre><code>
public function login(Request $request)
{
    if(!Auth::attempt($request->only('email','password')))
    {
        return response()->json([
            'message'=>'Invalid credentials'
        ],401);
    }

    $token = auth()->user()->createToken('API')->plainTextToken;

    return response()->json([
        'token'=>$token
    ]);
}
</code></pre>`,

            explanation: `
<h4 class="font-bold mb-3">Laravel JWT</h4>
<ul class="list-disc ml-5 space-y-2">
<li>User login with email & password</li>
<li>Laravel verifies credentials</li>
<li>Sanctum generates API token</li>
<li>Client stores token for future requests</li>
</ul>`
        },

        java: {
            code: `<pre><code>
@PostMapping("/login")
public ResponseEntity< ?> login(
    @RequestBody LoginRequest request){

    authenticationManager.authenticate(
        new UsernamePasswordAuthenticationToken(
            request.getEmail(),
            request.getPassword()
        )
    );

    String token =
        jwtService.generateToken(request.getEmail());

    return ResponseEntity.ok(token);
}
</code></pre>`,

            explanation: `
<h4 class="font-bold mb-3">Spring Security JWT</h4>
<ul class="list-disc ml-5 space-y-2">
<li>AuthenticationManager validates login</li>
<li>JWT Service creates secure token</li>
<li>Token returned to frontend</li>
<li>Every API request includes Bearer Token</li>
</ul>`
        },

        csharp: {
            code: `<pre><code>
[HttpPost("login")]
public IActionResult Login(LoginModel model)
{
    if(model.Email=="admin@test.com"
        && model.Password=="123456")
    {
        var token = GenerateJwtToken(model.Email);

        return Ok(new { token });
    }

    return Unauthorized();
}
</code></pre>`,

            explanation: `
<h4 class="font-bold mb-3">ASP.NET JWT</h4>
<ul class="list-disc ml-5 space-y-2">
<li>Validate user credentials</li>
<li>Create JWT token</li>
<li>Return token to client</li>
<li>Protect APIs with Authorize attribute</li>
</ul>`
        }

    };

    function changeJwt(type) {

        document.getElementById("jwtCodeArea").innerHTML =
            jwtData[type].code;

        document.getElementById("jwtExplainArea").innerHTML =
            jwtData[type].explanation;

    }

    changeJwt("laravel");

    //image Upload
    const imageUploadData = {

        laravel: {

            code: `
<pre><code>
public function upload(Request $request)
{
$request->validate([
    'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048'
]);

$path = $request->file('image')
    ->store('images', 'public');

return response()->json([
    'message' => 'Image uploaded successfully',
    'path' => $path
]);
}
</code></pre>
    `,

            explanation: `
        <h4 class="font-bold mb-4">
            PHP Laravel
        </h4>

        <ul class="list-disc ml-5 space-y-2">
            <li>Laravel validates the uploaded file.</li>
            <li>Only image formats such as JPG, PNG and WebP are accepted.</li>
            <li>Maximum file size is 2 MB.</li>
            <li>The image is stored using Laravel Storage.</li>
            <li>The returned path can be saved in the database.</li>
        </ul>
    `
        },


        java: {

            code: `
<pre><code>
@PostMapping("/upload")
public ResponseEntity< ?> upload(
    @RequestParam("image")
    MultipartFile image)
    throws IOException {

if (image.isEmpty()) {
    return ResponseEntity.badRequest()
        .body("Image is required");
}

String fileName =
    UUID.randomUUID() + "_" +
    image.getOriginalFilename();

Path path = Paths.get(
    "uploads/images/" + fileName
);

Files.createDirectories(path.getParent());

Files.copy(
    image.getInputStream(),
    path,
    StandardCopyOption.REPLACE_EXISTING
);

return ResponseEntity.ok(
    "Image uploaded successfully"
);
}
</code></pre>
    `,

            explanation: `
        <h4 class="font-bold mb-4">
            Java Spring
        </h4>

        <ul class="list-disc ml-5 space-y-2">
            <li>Spring receives the image using MultipartFile.</li>
            <li>The uploaded file is checked before saving.</li>
            <li>A unique filename is generated using UUID.</li>
            <li>The image is stored inside the uploads folder.</li>
            <li>The file path can be stored in the database.</li>
        </ul>
    `
        },


        csharp: {

            code: `
<pre><code>
[HttpPost("upload")]
public async Task<IActionResult>
Upload(IFormFile image)
{
if (image == null || image.Length == 0)
    return BadRequest("Image is required");

var fileName =
    Guid.NewGuid() +
    Path.GetExtension(image.FileName);

var folder =
    Path.Combine(
        Directory.GetCurrentDirectory(),
        "wwwroot/images"
    );

Directory.CreateDirectory(folder);

var filePath =
    Path.Combine(folder, fileName);

using var stream =
    new FileStream(
        filePath,
        FileMode.Create
    );

await image.CopyToAsync(stream);

return Ok(
    "Image uploaded successfully"
);
}
</code></pre>
    `,

            explanation: `
        <h4 class="font-bold mb-4">
            C# ASP.NET
        </h4>

        <ul class="list-disc ml-5 space-y-2">
            <li>ASP.NET receives the image using IFormFile.</li>
            <li>The uploaded file is checked for empty values.</li>
            <li>A unique filename is generated using Guid.</li>
            <li>The image is saved inside wwwroot/images.</li>
            <li>The image can then be accessed as a static web resource.</li>
        </ul>
    `
        }

    };


    function changeImageUpload(type) {

        document.getElementById(
                "imageUploadCodeArea"
            ).innerHTML =
            imageUploadData[type].code;

        document.getElementById(
                "imageUploadExplainArea"
            ).innerHTML =
            imageUploadData[type].explanation;
    }


    function copyImageUploadCode() {

        const code =
            document.getElementById(
                "imageUploadCodeArea"
            ).innerText;

        navigator.clipboard.writeText(code);

        alert("Image Upload code copied!");
    }


    // Default
    changeImageUpload("laravel");
    //right side section
    function goToSection(id) {
        const container = document.getElementById('content');
        const target = document.getElementById(id);

        container.scrollTo({
            top: target.offsetTop,
            behavior: 'smooth'
        });
    }
</script>


@endsection