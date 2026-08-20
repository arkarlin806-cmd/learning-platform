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
                    CV
                </div>
                <div class="min-w-0">
                    <h1 class="text-slate-900 font-semibold text-base md:text-lg truncate">
                        Computer Vision
                    </h1>
                    <p class="text-xs md:text-sm text-slate-500 truncate">
                        Ask anything, get clean answers instantly
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
        <div id="content" class="overflow-y-auto h-screen ml-14 pr-8 pt-10">

            <section id="object_detection">

                <header class="mb-4">
                    <h1 class="text-xl md:text-3xl font-bold mb-2">Object <span class="bg-gradient-to-r from-indigo-600 via-purple-500 to-pink-500 bg-clip-text text-transparent">
                            Detection
                        </span></h1>
                    <div class="text-slate-500">
                        Object detection is image extract object and predict object with percentage.
                    </div>
                </header>
                <!-- explain -->
                <div class="my-8">
                    <!-- GRID -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                        <!-- LEFT -->
                        <div class="glass p-6 rounded-2xl shadow fade">

                            <h2 class="text-xl font-bold mb-4 text-blue-700">
                                📌 What is Object Detection?
                            </h2>

                            <p class="text-gray-700 mb-4">
                                Object Detection identifies and locates objects inside an image.
                            </p>

                            <ul class="list-disc pl-5 text-gray-700 space-y-2">
                                <li>Finds objects (person, car, phone, etc.)</li>
                                <li>Draws bounding boxes</li>
                                <li>Assigns labels</li>
                                <li>Returns confidence score</li>
                            </ul>

                        </div>

                        <!-- RIGHT PIPELINE -->
                        <div class="glass p-6 rounded-2xl shadow fade">

                            <h2 class="text-xl font-bold mb-4 text-green-700">
                                🔄 Detection Pipeline
                            </h2>

                            <div class="space-y-3 text-gray-700">

                                <div>1️⃣ Upload Image</div>
                                <div>2️⃣ Convert to OpenCV format</div>
                                <div>3️⃣ Load YOLO Model</div>
                                <div>4️⃣ Run Detection</div>
                                <div>5️⃣ Draw Bounding Boxes</div>

                            </div>

                        </div>

                    </div>

                    <!-- CODE SECTION 1 -->
                    <div class="mt-10 fade">

                        <h2 class="text-xl font-bold mb-3 text-gray-800">
                            🧩 Step 1: Load Image (Convert Bytes)
                        </h2>

                        <div class="code-box">

                            <span class="comment"># Convert uploaded image into OpenCV format</span><br><br>

                            <span class="keyword">import</span> cv2<br>
                            <span class="keyword">import</span> numpy <span class="keyword">as</span> np<br><br>

                            <span class="func">def</span> <span class="func">bytes_to_image</span>(file_bytes):<br>
                            &nbsp;&nbsp;nparr = np.frombuffer(file_bytes, np.uint8)<br>
                            &nbsp;&nbsp;image = cv2.imdecode(nparr, cv2.IMREAD_COLOR)<br>
                            &nbsp;&nbsp;<span class="keyword">return</span> image

                        </div>

                    </div>

                    <!-- CODE SECTION 2 -->
                    <div class="mt-10 fade">

                        <h2 class="text-xl font-bold mb-3 text-gray-800">
                            🧠 Step 2: Load YOLO Model
                        </h2>

                        <div class="code-box">

                            <span class="comment"># Load pre-trained YOLO model once</span><br><br>

                            net = cv2.dnn.readNet("yolov3.weights", "yolov3.cfg")<br><br>

                            layer_names = net.getLayerNames()<br>
                            output_layers = [layer_names[i - 1] for i in net.getUnconnectedOutLayers()]<br>

                        </div>

                    </div>

                    <!-- CODE SECTION 3 -->
                    <div class="mt-10 fade">

                        <h2 class="text-xl font-bold mb-3 text-gray-800">
                            🚀 Step 3: Run Detection
                        </h2>

                        <div class="code-box">

                            blob = cv2.dnn.blobFromImage(image, 0.00392, (416,416), (0,0,0), True, crop=False)<br><br>

                            net.setInput(blob)<br>
                            outs = net.forward(output_layers)

                        </div>

                    </div>

                    <!-- CODE SECTION 4 -->
                    <div class="mt-10 fade">

                        <h2 class="text-xl font-bold mb-3 text-gray-800">
                            📦 Step 4: Draw Bounding Boxes
                        </h2>

                        <div class="code-box">

                            for detection in detections:<br>
                            &nbsp;&nbsp;scores = detection[5:]<br>
                            &nbsp;&nbsp;class_id = np.argmax(scores)<br>
                            &nbsp;&nbsp;confidence = scores[class_id]<br><br>&nbsp;&nbsp;if confidence > 0.5:<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;# get box coordinates<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;cv2.rectangle(image, (x,y), (x+w,y+h), (0,255,0), 2)<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;cv2.putText(image, label, (x,y-10), ...)

                        </div>

                    </div>

                    <!-- FUNCTION EXPLANATION -->
                    <div class="mt-10 glass p-6 rounded-2xl shadow fade">

                        <h2 class="text-xl font-bold text-blue-700 mb-3">
                            📊 Function Explanation (Easy)
                        </h2>

                        <ul class="text-gray-700 space-y-3">

                            <li>
                                <b>bytes_to_image()</b><br>
                                👉 Upload image ကို OpenCV format ပြောင်းပေးတယ်
                            </li>

                            <li>
                                <b>readNet()</b><br>
                                👉 YOLO AI model ကို load လုပ်ပေးတယ်
                            </li>

                            <li>
                                <b>blobFromImage()</b><br>
                                👉 Image ကို AI input format ပြောင်းပေးတယ်
                            </li>

                            <li>
                                <b>forward()</b><br>
                                👉 AI model ကို run ပြီး objects detect လုပ်တယ်
                            </li>

                            <li>
                                <b>rectangle()</b><br>
                                👉 detected object ကို box ဆွဲပေးတယ်
                            </li>

                        </ul>

                    </div>

                    <!-- SUMMARY -->
                    <div class="mt-10 glass p-6 rounded-2xl shadow fade">

                        <h2 class="text-xl font-bold text-green-700 mb-3">
                            📌 Summary
                        </h2>

                        <p class="text-gray-700">
                            Object Detection uses YOLO deep learning model to detect objects in images.
                            It processes image → runs AI → returns bounding boxes + labels.
                        </p>

                    </div>

                </div>
            </section>

            <section id="color">

                <h1 class="text-xl md:text-3xl font-bold">
                    Image
                    <span class="bg-gradient-to-r from-indigo-600 via-purple-500 to-pink-500 bg-clip-text text-transparent">
                        Colorization
                    </span>

                </h1>


                <div class="mb-8">
                    <h1 class="text-2xl font-bold text-gray-800 mb-2"> Image Colorization Service </h1>
                    <p class="mt-2 text-gray-600"> ဒီ Page မှာ <strong>colorization_service.py</strong> ရဲ့ အဓိက Code အပိုင်းတွေကို လေ့လာနိုင်ပါတယ်။ Code တစ်ကြောင်းချင်းစီ မရှင်းဘဲ အရေးကြီးတဲ့ Logic နဲ့ Processing Flow ကိုပဲ ရှင်းပြထားပါတယ်။ </p>
                </div>
                <section class="bg-white rounded-2xl shadow-md border mb-8">
                    <div class="px-6 py-4 border-b">
                        <h2 class="text-xl font-bold text-blue-600"> Section 1 - Import Libraries </h2>
                    </div>
                    <div class="p-6">
                        <pre class="bg-slate-900 text-gray-100 rounded-xl p-5 overflow-auto text-sm"><code><span class="text-pink-400">import</span> os <span class="text-pink-400">import</span> uuid <span class="text-pink-400">import</span> cv2 <span class="text-pink-400">import</span> numpy <span class="text-pink-400">as</span> np <span class="text-pink-400">from</span> fastapi <span class="text-pink-400">import</span> UploadFile <span class="text-pink-400">from</span> pathlib <span class="text-pink-400">import</span> Path </code></pre>
                        <h3 class="mt-6 font-bold text-lg"> Explanation </h3>
                        <ul class="list-disc ml-6 mt-3 space-y-2 text-gray-700">
                            <li> <strong>os</strong> ကို Folder နဲ့ File Path တွေကို ကိုင်တွယ်ဖို့ အသုံးပြုပါတယ်။ </li>
                            <li> <strong>uuid</strong> က Output Image တစ်ပုံချင်းစီအတွက် Unique File Name ထုတ်ပေးပါတယ်။ </li>
                            <li> <strong>cv2</strong> က OpenCV Library ဖြစ်ပြီး Image Processing အတွက် အဓိက Library ဖြစ်ပါတယ်။ </li>
                            <li> <strong>numpy</strong> က Image Data ကို Array အဖြစ် ပြောင်းလဲပြီး OpenCV အသုံးပြုနိုင်အောင် လုပ်ပေးပါတယ်။ </li>
                            <li> <strong>UploadFile</strong> က User Upload လုပ်ထားတဲ့ Image File ကို FastAPI မှာ လက်ခံဖို့ အသုံးပြုပါတယ်။ </li>
                        </ul>
                    </div>
                </section>
                <section class="bg-white rounded-2xl shadow-md border mb-8">
                    <div class="px-6 py-4 border-b">
                        <h2 class="text-xl font-bold text-green-600"> Section 2 - Upload Folder </h2>
                    </div>
                    <div class="px-4 py-6">
                        <pre class="bg-slate-900 text-gray-100 rounded-xl p-5 overflow-auto text-sm"><code><span class="text-cyan-300">BASE_DIR</span> = Path(__file__).resolve().parent.parent.parent <span class="text-cyan-300">UPLOAD_DIR</span> = BASE_DIR / "uploads" UPLOAD_DIR.mkdir(exist_ok=True) </code></pre>
                        <h3 class="mt-6 font-bold text-lg"> Explanation </h3>
                        <p class="mt-3 text-gray-700"> ဒီ Code က Output Image တွေကို သိမ်းဖို့ အသုံးပြုမယ့် <strong>uploads Folder</strong> ကို သတ်မှတ်ပေးပါတယ်။ </p>
                        <ul class="list-disc ml-6 mt-4 space-y-2 text-gray-700">
                            <li> Project Root Folder ကို ရှာပါတယ်။ </li>
                            <li> uploads Folder Location ကို သတ်မှတ်ပါတယ်။ </li>
                            <li> uploads Folder မရှိရင် အလိုအလျောက် ဖန်တီးပေးပါတယ်။ </li>
                        </ul>
                    </div>
                </section>
                <section class="bg-white rounded-2xl shadow-md border">
                    <div class="px-6 py-4 border-b">
                        <h2 class="text-xl font-bold text-purple-600"> Section 3 - Read Uploaded Image </h2>
                    </div>
                    <div class="p-6">
                        <pre class="bg-slate-900 text-gray-100 rounded-xl p-5 overflow-auto text-sm"><code>contents = <span class="text-yellow-300">await</span> file.read() np_img = np.frombuffer( contents, np.uint8 ) gray = cv2.imdecode( np_img, cv2.IMREAD_GRAYSCALE ) </code></pre>
                        <h3 class="mt-6 font-bold text-lg"> Explanation </h3>
                        <ul class="list-disc ml-6 mt-3 space-y-2 text-gray-700">
                            <li> User Upload လုပ်ထားတဲ့ Image ကို Memory ထဲ ဖတ်ပါတယ်။ </li>
                            <li> Binary Data ကို NumPy Array အဖြစ် ပြောင်းပါတယ်။ </li>
                            <li> OpenCV အသုံးပြုနိုင်တဲ့ Grayscale Image အဖြစ် Decode လုပ်ပါတယ်။ </li>
                            <li> Image Decode မအောင်မြင်ရင် Error Response ပြန်ပို့နိုင်ပါတယ်။ </li>
                        </ul>
                    </div>
                </section>

                <section class="bg-white rounded-2xl shadow-md border mb-8">
                    <div class="px-6 py-4 border-b">
                        <h2 class="text-xl font-bold text-orange-600"> Section 4 - Image Colorization </h2>
                    </div>
                    <div class="p-6">
                        <pre class="bg-slate-900 text-gray-100 rounded-xl p-5 overflow-auto text-sm"><code><span class="text-cyan-300">colored</span> = cv2.applyColorMap( gray, cv2.COLORMAP_TURBO ) </code></pre>
                        <h3 class="mt-6 text-lg font-bold"> Explanation </h3>
                        <p class="mt-3 text-gray-700"> ဒီအပိုင်းက Image Colorization Service ရဲ့ အဓိက Logic ဖြစ်ပါတယ်။ </p>
                        <ul class="list-disc ml-6 mt-4 space-y-2 text-gray-700">
                            <li> Upload လုပ်ထားတဲ့ Grayscale Image ကို Color Map အသုံးပြုပြီး အရောင်ထည့်ပေးပါတယ်။ </li>
                            <li> Output အနေနဲ့ Colorized Image အသစ်ကို ရရှိပါတယ်။ </li>
                            <li> ဒီဥပမာမှာ OpenCV ရဲ့ <strong>COLORMAP_TURBO</strong> ကို အသုံးပြုထားပါတယ်။ </li>
                            <li> Production Project တွေမှာတော့ DeOldify၊ OpenCV DNN၊ ဒါမှမဟုတ် Deep Learning Model တွေကို အစားထိုးအသုံးပြုနိုင်ပါတယ်။ </li>
                        </ul>
                    </div>
                </section>
                <section class="bg-white rounded-2xl shadow-md border mb-8">
                    <div class="px-6 py-4 border-b">
                        <h2 class="text-xl font-bold text-red-600"> Section 5 - Save Colorized Image </h2>
                    </div>
                    <div class="p-6">
                        <pre class="bg-slate-900 text-gray-100 rounded-xl p-5 overflow-auto text-sm"><code>filename = f"{uuid.uuid4()}.jpg" save_path = UPLOAD_DIR / filename cv2.imwrite( str(save_path), colored ) </code></pre>
                        <h3 class="mt-6 text-lg font-bold"> Explanation </h3>
                        <ul class="list-disc ml-6 mt-3 space-y-2 text-gray-700">
                            <li> UUID ကို အသုံးပြုပြီး Image File Name အသစ် ဖန်တီးပါတယ်။ </li>
                            <li> Output Image ကို uploads Folder ထဲမှာ သိမ်းပေးပါတယ်။ </li>
                            <li> Original Image ကို မထိခိုက်စေဘဲ Result Image အသစ် ဖန်တီးနိုင်ပါတယ်။ </li>
                        </ul>
                    </div>
                </section>
                <section class="bg-white rounded-2xl shadow-md border mb-8">
                    <div class="px-6 py-4 border-b">
                        <h2 class="text-xl font-bold text-emerald-600"> Section 6 - Return Response </h2>
                    </div>
                    <div class="p-6">
                        <pre class="bg-slate-900 text-gray-100 rounded-xl p-5 overflow-auto text-sm"><code>return { "success": True, "image_url": f"/uploads/{filename}" } </code></pre>
                        <h3 class="mt-6 text-lg font-bold"> Explanation </h3>
                        <ul class="list-disc ml-6 mt-3 space-y-2 text-gray-700">
                            <li> Image Colorization အောင်မြင်ကြောင်း Client ကို ပြန်ပို့ပါတယ်။ </li>
                            <li> Colorized Image ရဲ့ URL ကိုပါ Response ထဲထည့်ပေးပါတယ်။ </li>
                            <li> Laravel Controller က ဒီ JSON Response ကို လက်ခံပြီး JavaScript ဆီကို ပြန်ပို့ပေးပါတယ်။ </li>
                        </ul>
                    </div>
                </section>
                <section class="bg-white rounded-2xl shadow-md border">
                    <div class="px-6 py-4 border-b">
                        <h2 class="text-xl font-bold text-blue-600"> Image Colorization Processing Flow </h2>
                    </div>
                    <div class="p-6">
                        <ol class="list-decimal ml-6 space-y-4 text-gray-700">
                            <li> User က Colorization လုပ်လိုတဲ့ Image ကို Upload လုပ်ပါတယ်။ </li>
                            <li> Laravel Controller က Image ကို FastAPI CV Server ဆီ ပို့ပေးပါတယ်။ </li>
                            <li> Colorization Service က Upload Image ကို Memory ထဲ ဖတ်ပါတယ်။ </li>
                            <li> Image Data ကို NumPy Array အဖြစ် ပြောင်းပါတယ်။ </li>
                            <li> OpenCV က Image ကို Decode လုပ်ပါတယ်။ </li>
                            <li> Colorization Logic ကို အသုံးပြုပြီး Colorized Image ဖန်တီးပါတယ်။ </li>
                            <li> Result Image ကို uploads Folder ထဲ သိမ်းပါတယ်။ </li>
                            <li> Image URL ကို JSON Response အဖြစ် Laravel ဆီ ပြန်ပို့ပါတယ်။ </li>
                            <li> JavaScript က Response ကို လက်ခံပြီး No Page Refresh ဖြင့် Result Image ကို Browser မှာ ပြသပါတယ်။ </li>
                        </ol>
                    </div>
                </section>
            </section>

            <section id="negative" class="my-8">
                <div class="mt-10 bg-white rounded-3xl shadow-xl p-8">
                    <h2 class="text-xl md:text-3xl font-bold mb-5">
                        Negative Transformation Explanation
                    </h2>
                    <div class="space-y-4">
                        <p>
                            Gray Level Negative Transformation သည်
                            pixel intensity တန်ဖိုးကို ပြောင်းပြန်လှန်ပေးသော
                            Image Enhancement Method ဖြစ်သည်။
                        </p>

                        <p>
                            Formula
                            <strong>
                                s = 255 − r
                            </strong>
                        </p>
                        <p>
                            r = Original Pixel
                        </p>
                        <p>
                            s = Output Pixel
                        </p>
                        <p>
                            Dark Pixel များသည် Bright ဖြစ်သွားပြီး
                            Bright Pixel များသည် Dark ဖြစ်သွားသည်။
                        </p>
                        <p>
                            X-Ray Image,
                            Medical Image,
                            Satellite Image များတွင်
                            အသုံးများသည်။
                        </p>
                    </div>
                </div>
            </section>

            <section id="log" class="">
                <div class="bg-white rounded-3xl shadow-xl p-8 mt-10">
                    <h2 class="text-xl md:text-3xl font-bold mb-5">
                        Log Transformation Explanation
                    </h2>
                    <div class="space-y-4">
                        <p>
                            Log Transformation သည် Gray Level Transformation
                            နည်းလမ်းတစ်ခုဖြစ်ပြီး
                            Dark Pixel များကို ပိုမိုမြင်သာအောင်
                            Brightness တိုးပေးပါသည်။
                        </p>
                        <p>
                            <strong>Formula</strong>
                        </p>
                        <div class="text-2xl font-bold text-green-600">
                            s = c × log(1 + r)
                        </div>
                        <p>
                            r = Input Pixel Intensity
                        </p>
                        <p>
                            s = Output Pixel Intensity
                        </p>
                        <p>
                            c = Constant Value
                        </p>
                        <p>
                            Dark Area များကို ပိုမိုတောက်ပစေပြီး
                            Bright Area များကို အနည်းငယ်သာ ပြောင်းလဲစေပါသည်။
                        </p>
                        <p>
                            အသုံးများသော နေရာများ -
                        </p>
                        <ul class="list-disc ml-6 space-y-2">
                            <li>Medical Image Processing</li>
                            <li>Satellite Image Enhancement</li>
                            <li>X-Ray Analysis</li>
                            <li>Low-Light Image Enhancement</li>
                        </ul>
                    </div>
                </div>
            </section>

            <section id="power-law" class="my-">
                <div class="bg-white rounded-3xl shadow-xl p-8 mt-10">
                    <h2 class="text-xl md:text-3xl font-bold mb-5">
                        Power Law Transformation Explanation
                    </h2>
                    <div class="space-y-4 text-gray-700">
                        <p>
                            Power Law Transformation ကို Gamma Correction လို့လည်း
                            ခေါ်ကြပြီး Image Brightness ကို Gamma (γ) value နဲ့
                            ထိန်းညှိပေးသော Gray Level Transformation ဖြစ်ပါသည်။
                        </p>
                        <div class="bg-orange-100 rounded-xl p-6 text-center">
                            <h3 class="text-2xl font-bold text-orange-600">
                                s = c × r<sup>γ</sup>
                            </h3>
                        </div>
                        <table class="table-auto w-full border mt-5">
                            <thead>
                                <tr class="bg-orange-100">
                                    <th class="border p-3">Parameter</th>
                                    <th class="border p-3">Meaning</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="border p-3">r</td>
                                    <td class="border p-3">
                                        Input Pixel Intensity
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border p-3">γ</td>
                                    <td class="border p-3">
                                        Gamma Value
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border p-3">s</td>
                                    <td class="border p-3">
                                        Output Pixel Intensity
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="bg-gray-50 rounded-xl p-6">
                            <h3 class="font-bold text-xl mb-3">
                                Gamma Value Effect
                            </h3>
                            <ul class="list-disc ml-6 space-y-2">
                                <li><strong>γ &lt; 1</strong> → Image ပိုတောက်လာသည် (Brighten)</li>
                                <li><strong>γ = 1</strong> → Original Image အတိုင်း</li>
                                <li><strong>γ &gt; 1</strong> → Image ပိုမှောင်လာသည် (Darken)</li>
                            </ul>
                        </div>

                        <div class="bg-orange-50 rounded-xl p-6">
                            <h3 class="font-bold text-xl mb-3">
                                Applications
                            </h3>
                            <ul class="list-disc ml-6 space-y-2">
                                <li>Gamma Correction</li>
                                <li>Medical Image Processing</li>
                                <li>Digital Camera Image Enhancement</li>
                                <li>Display Calibration</li>
                                <li>Satellite Image Processing</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>

            <section id="histogram" class="">
                <div class="bg-white rounded-3xl shadow-xl p-10 mt-10">
                    <h2 class="text-xl md:text-3xl font-bold mb-6">
                        Histogram Equalization Theory
                    </h2>
                    <div class="space-y-5 text-gray-700 leading-8">
                        <p>
                            Histogram Equalization သည်
                            Image Contrast Enhancement Technique
                            တစ်ခုဖြစ်ပြီး Gray Level Distribution ကို
                            ပြန်လည်ဖြန့်ဝေပေးသော နည်းလမ်းဖြစ်သည်။
                        </p>
                        <div class="bg-blue-50 p-6 rounded-xl">
                            <h3 class="text-xl font-bold text-blue-700">
                                Main Idea
                            </h3>
                            <p class="mt-3">
                                Pixel Intensity များကို
                                Histogram တစ်ခုလုံးအနှံ့
                                ပြန်လည်ဖြန့်ဝေပေးခြင်းဖြင့်
                                Contrast ကို မြှင့်တင်ပေးသည်။
                            </p>
                        </div>
                        <table class="table-auto w-full border">
                            <thead>
                                <tr class="bg-blue-100">
                                    <th class="border p-3">
                                        Before
                                    </th>
                                    <th class="border p-3">
                                        After
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="border p-3">
                                        Low Contrast
                                    </td>
                                    <td class="border p-3">
                                        High Contrast
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border p-3">
                                        Narrow Histogram
                                    </td>
                                    <td class="border p-3">
                                        Wide Histogram
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="bg-cyan-50 p-6 rounded-xl">
                            <h3 class="font-bold text-xl mb-4">
                                Applications
                            </h3>
                            <ul class="list-disc ml-6 space-y-2">
                                <li>Medical Images</li>
                                <li>X-Ray Images</li>
                                <li>Satellite Images</li>
                                <li>Security Camera Enhancement</li>
                                <li>Fingerprint Recognition</li>
                                <li>Low Contrast Image Processing</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>

            <section id="image_restore" class="max-w-6xl mx-auto">

                <!-- Explanation Section -->
                <div class="mt-12 mb-16">
                    <div class="bg-white/60 backdrop-blur-xl border border-white rounded-3xl shadow-2xl p-10">
                        <!-- Title -->
                        <div class="text-center mb-10">
                            <h2 class="text-xl md:text-3xl font-black text-purple-700">
                                AI Image Restoration
                            </h2>
                            <p class="mt-4 text-gray-600 text-lg">
                                Restore damaged old photos using Computer Vision techniques
                            </p>
                        </div>
                        <!-- Process Flow -->
                        <div class="grid md:grid-cols-5 gap-5 items-center mb-12">
                            <div class="bg-purple-100 rounded-2xl p-6 text-center">
                                <div class="text-4xl mb-3">
                                    📷
                                </div>
                                <h3 class="font-bold">
                                    Input Image
                                </h3>


                                <p class="text-sm text-gray-600 mt-2">

                                    Old damaged photo

                                </p>


                            </div>




                            <div class="text-center text-3xl hidden md:block">

                                →

                            </div>




                            <div class="bg-blue-100 rounded-2xl p-6 text-center">


                                <div class="text-4xl mb-3">
                                    🧹
                                </div>


                                <h3 class="font-bold">

                                    Noise Removal

                                </h3>


                                <p class="text-sm text-gray-600 mt-2">

                                    Remove unwanted noise

                                </p>


                            </div>





                            <div class="bg-indigo-100 rounded-2xl p-6 text-center">


                                <div class="text-4xl mb-3">
                                    ✨
                                </div>


                                <h3 class="font-bold">

                                    Enhancement

                                </h3>


                                <p class="text-sm text-gray-600 mt-2">

                                    Improve contrast & details

                                </p>


                            </div>





                            <div class="bg-green-100 rounded-2xl p-6 text-center">


                                <div class="text-4xl mb-3">
                                    🖼️
                                </div>


                                <h3 class="font-bold">

                                    Output

                                </h3>


                                <p class="text-sm text-gray-600 mt-2">

                                    Restored image

                                </p>


                            </div>


                        </div>

                        <!-- Algorithm Cards -->
                        <div class="grid md:grid-cols-3 gap-3 md:gap-8">
                            <div class="rounded-3xl bg-purple-50 p-3 md:p-8">
                                <h3 class="text-md md:text-2xl font-bold text-purple-700">
                                    1. Noise Reduction
                                </h3>


                                <p class="mt-4 leading-8 text-gray-700">


                                    Uses OpenCV Non-Local Means Denoising
                                    to remove dust, grain and old photo noise
                                    while preserving important details.


                                </p>


                                <div class="mt-5 bg-white rounded-xl p-4">


                                    <strong>

                                        Method:

                                    </strong>


                                    <br>

                                    cv2.fastNlMeansDenoising()


                                </div>


                            </div>







                            <div class="rounded-3xl bg-blue-50 p-8">


                                <h3 class="text-2xl font-bold text-blue-700">

                                    2. Contrast Enhancement

                                </h3>


                                <p class="mt-4 leading-8 text-gray-700">


                                    CLAHE improves brightness distribution
                                    and makes hidden details visible.


                                </p>


                                <div class="mt-5 bg-white rounded-xl p-4">


                                    <strong>

                                        Method:

                                    </strong>


                                    <br>

                                    CLAHE Histogram Enhancement


                                </div>


                            </div>







                            <div class="rounded-3xl bg-green-50 p-8">


                                <h3 class="text-2xl font-bold text-green-700">

                                    3. Image Sharpening

                                </h3>


                                <p class="mt-4 leading-8 text-gray-700">


                                    Sharpening kernel improves edge details
                                    and makes the restored image clearer.


                                </p>



                                <div class="mt-5 bg-white rounded-xl p-4">


                                    <strong>

                                        Kernel:

                                    </strong>


                                    <br>


                                    0 -1 0

                                    <br>

                                    -1 5 -1

                                    <br>

                                    0 -1 0


                                </div>


                            </div>


                        </div>

                        <!-- Formula -->
                        <div class="mt-12 bg-gray-900 text-white rounded-3xl p-10">
                            <h3 class="text-md md:text-3xl font-black mb-6">
                                Image Enhancement Formula
                            </h3>

                            <div class="grid md:grid-cols-2 gap-8">
                                <div>
                                    <p class="text-gray-300">
                                        Sharpening Operation:
                                    </p>
                                    <p class="md:text-2xl tex-sm font-bold mt-3">
                                        g(x,y)=K*f(x,y)
                                    </p>
                                </div>

                                <div>
                                    <p class="text-gray-300">
                                        Contrast Enhancement:
                                    </p>
                                    <p class="md:text-2xl tex-sm font-bold mt-3">
                                        CLAHE(I)
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Applications -->
                        <div class="mt-12">
                            <h3 class="text-md md:text-3xl font-black mb-8">
                                Real World Applications
                            </h3>
                            <div class="grid md:grid-cols-4 gap-5">
                                <div class="p-6 bg-white rounded-2xl shadow">
                                    👵
                                    <br>
                                    Old Family Photos
                                </div>
                                <div class="p-6 bg-white rounded-2xl shadow">
                                    🏥
                                    <br>
                                    Medical Image Enhancement
                                </div>
                                <div class="p-6 bg-white rounded-2xl shadow">
                                    🕵️
                                    <br>
                                    Forensic Images
                                </div>
                                <div class="p-6 bg-white rounded-2xl shadow">
                                    🏛️
                                    <br>
                                    Historical Documents
                                </div>
                            </div>
                        </div>

                    </div>
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
                            <a href="#" onclick="goToSection('object_detection')">
                                Object Detection
                            </a>
                        </h3>
                    </div>
                </li>

                <li class="group flex items-center gap-4 px-4 py-2 rounded-xl bg-gradient-to-r from-white to-blue-100 shadow hover:shadow-lg transition">
                    <div class="w-2 h-8 bg-purple-500 rounded-full"></div>
                    <div>
                        <h3 class="font-bold text-gray-800 group-hover:text-purple-600">
                            <a href="#" onclick="goToSection('color')">
                                Image Colorization
                            </a>
                        </h3>
                    </div>
                </li>
                <li class="group flex items-center gap-4 px-4 py-2 rounded-xl bg-gradient-to-r from-white to-blue-100 shadow hover:shadow-lg transition">
                    <div class="w-2 h-8 bg-orange-500 rounded-full"></div>
                    <div>
                        <h3 class="font-bold text-gray-800 group-hover:text-orange-600">
                            <a href="#" onclick="goToSection('gray-level')">
                                Gray Level
                            </a>
                        </h3>
                    </div>
                </li>
                <li class="group flex items-center gap-4 px-4 py-2 rounded-xl bg-gradient-to-r from-white to-blue-100 shadow hover:shadow-lg transition">
                    <div class="w-2 h-8 bg-green-500 rounded-full"></div>
                    <div>
                        <h3 class="font-bold text-gray-800 group-hover:text-green-600">
                            <a href="#" onclick="goToSection('image_restore')">
                                Image Restoration
                            </a>
                        </h3>
                    </div>
                </li>
                <li class="group flex items-center gap-4 px-4 py-2 rounded-xl bg-gradient-to-r from-white to-blue-100 shadow hover:shadow-lg transition">
                    <div class="w-2 h-8 bg-yellow-500 rounded-full"></div>
                    <div>
                        <h3 class="font-bold text-gray-800 group-hover:text-yellow-600">
                            <a href="#" onclick="goToSection('object_detection')">
                                Hand Gesture
                            </a>
                        </h3>
                    </div>
                </li>
                <li class="group flex items-center gap-4 px-4 py-2 rounded-xl bg-gradient-to-r from-white to-blue-100 shadow hover:shadow-lg transition">
                    <div class="w-2 h-8 bg-cyan-500 rounded-full"></div>
                    <div>
                        <h3 class="font-bold text-gray-800 group-hover:text-cyan-600">
                            <a href="#" onclick="goToSection('2d3d')">
                                2D to 3D model
                            </a>
                        </h3>
                    </div>
                </li>

            </ul>
        </div>
    </div>

</div>

<script>
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