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
                    class="text-3xl text-slate-600 font-semibold mb-8 ">
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
                    class="text-3xl text-slate-600 font-semibold mb-8">
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
                    class="text-3xl text-slate-600 font-semibold mb-8">
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

            <section id="Summary"
                class="glass rounded-3xl shadow-xl p-8 ">
                <h2
                    class="text-3xl font-black mb-8">
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
                            <a href="#" onclick="goToSection('API')">
                                API
                            </a>
                        </h3>
                    </div>
                </li>
                <li class="group flex items-center gap-4 px-4 py-2 rounded-xl bg-gradient-to-r from-white to-blue-100 shadow hover:shadow-lg transition">
                    <div class="w-2 h-8 bg-yellow-500 rounded-full"></div>
                    <div>
                        <h3 class="font-bold text-gray-800 group-hover:text-yellow-600">
                            <a href="#" onclick="goToSection('error')">
                                Error handling
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