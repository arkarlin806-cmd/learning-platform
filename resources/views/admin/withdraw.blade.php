 @extends('layout.admin')
 @section('page_title', 'Withdraw Requests')
 @section('page', 'Admin analysis accept and reject instructor withdraw requests')
 @section('content')

 <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5 mb-8">
     <div>
         <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-sky-200/50 border border-sky-300 text-sky-800 text-sm font-semibold"> <i class="ri-bank-card-line"></i> Withdrawal Management </span>
         <h1 class="mt-4 text-2xl lg:text-4xl font-black text-gray-800"> Instructor Withdraw Requests </h1>
         <p class="text-gray-500 mt-2"> Review, approve or reject instructor withdrawal requests. </p>
     </div>
 </div>
 <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
     <div class="rounded-3xl bg-white/70 backdrop-blur-xl border border-white shadow-xl px-6 py-4 hover:-translate-y-2 duration-300">
         <div class="flex justify-between items-center">
             <div class="h-14 w-14 rounded-2xl bg-yellow-100 flex items-center justify-center">
                 <i class="ri-loader-4-line text-3xl text-yellow-600"></i>
             </div>
             <span class="px-3 py-1 rounded-full bg-yellow-100/50 border border-yellow-300 text-yellow-700 text-sm font-semibold animate-pulse"> Pending </span>
         </div>
         <p class="my-3 text-gray-500 text-sm"> Pending Requests </p>
         <h2 class="text-2xl sm:text-lg font-black text-yellow-800"> {{ $pendingCount }} </h2>
     </div> {{-- Total Amount --}}
     <div class="rounded-3xl bg-white/70 backdrop-blur-xl border border-white shadow-xl px-6 py-4 hover:-translate-y-2 duration-300">
         <div class="flex justify-between items-center">
             <div class="h-14 w-14 rounded-2xl bg-sky-100 flex items-center justify-center">
                 <i class="ri-money-dollar-circle-line text-3xl text-sky-600"></i>
             </div>
             <span class="px-5 py-1 rounded-full bg-sky-100/50 text-sky-700 border border-sky-300 text-sm font-semibold"> Total </span>
         </div>
         <p class="my-3 text-gray-500 text-sm"> Pending Amount </p>
         <h2 class="text-2xl sm:text-lg font-black text-sky-700"> Ks {{ number_format($pendingAmount,2) }} </h2>
     </div> {{-- Paid Today --}}
     <div class="rounded-3xl bg-white/70 backdrop-blur-xl border border-white shadow-xl px-6 py-4 hover:-translate-y-2 duration-300">
         <div class="flex justify-between items-center">
             <div class="h-14 w-14 rounded-2xl bg-green-100 flex items-center justify-center">
                 <i class="ri-check-double-line text-3xl text-green-600"></i>
             </div>
             <span class="px-6 py-1 rounded-full bg-green-100/50 border border-green-300 text-green-700 text-sm font-semibold"> Paid </span>
         </div>
         <p class="my-3 text-gray-500 text-sm"> Paid Today </p>
         <h2 class="text-2xl sm:text-lg font-black text-green-700"> Ks {{ number_format($todayPaid,2) }} </h2>
     </div> {{-- Rejected --}}
     <div class="rounded-3xl bg-white/70 backdrop-blur-xl border border-white shadow-xl px-6 py-4 hover:-translate-y-2 duration-300">
         <div class="flex justify-between items-center">
             <div class="h-16 w-16 rounded-2xl bg-red-100 flex items-center justify-center">
                 <i class="ri-close-circle-line text-3xl text-red-600"></i>
             </div>
             <span class="px-3 py-1 rounded-full bg-red-100/50 border border-red-200 text-red-700 text-sm font-semibold"> Rejected </span>
         </div>
         <p class="my-3 text-sm text-gray-500"> Rejected Requests </p>
         <h2 class="text-2xl sm:text-lg font-black text-red-700"> {{ $rejectedCount }} </h2>
     </div>
 </div>
 <div class="mt-8 flex justify-between rounded-3xl bg-white/70 backdrop-blur-xl border border-white shadow-xl px-6 py-4">
     <form action="" method="GET" class="flex gap-2"> {{-- Search --}}
         <div class="xl:col-span-2"> <label class="text-sm font-semibold text-gray-600"> Search Instructor </label>
             <div class="relative mt-2"> <i class="ri-search-line absolute left-4 top-4 text-gray-400"></i> <input type="text" name="search" value="{{ request('search') }}" placeholder="Instructor name..." class="w-70 rounded-2xl border border-gray-200 bg-white pl-12 pr-4 py-4 focus:ring-2 focus:ring-sky-500 focus:outline-none"> </div>
         </div> {{-- Status --}}
         <div> <label class="text-sm font-semibold text-gray-600"> Status </label> <select name="status" class="mt-2 w-full rounded-2xl border border-gray-200 bg-white px-4 py-4 focus:ring-2 focus:ring-sky-500">
                 <option value="">All Status</option>
                 <option value="pending" {{ request('status')=='pending'?'selected':'' }}> Pending </option>
                 <option value="paid" {{ request('status')=='paid'?'selected':'' }}> Paid </option>
                 <option value="rejected" {{ request('status')=='rejected'?'selected':'' }}> Rejected </option>
             </select>
         </div> {{-- Date --}}
         <div>
             <label class="text-sm font-semibold text-gray-600"> Request Date </label>
             <input type="date" name="date" value="{{ request('date') }}"
                 class="mt-2 w-full rounded-2xl border border-gray-200 px-4 py-4 focus:ring-2 focus:ring-sky-500">
         </div> {{-- Button --}}
         <div class="mt-8">
             <button class="w-40 rounded-2xl py-4 bg-gradient-to-r from-sky-500 to-cyan-500 text-white font-bold shadow-lg hover:scale-105 duration-300">
                 <i class="ri-filter-3-line mr-2"></i> Apply Filter
             </button>
         </div>
     </form>
     <div class="w-40 h-40 flex items-end">
         <canvas id="walletChart"></canvas>
     </div>
 </div>
 <div class="mt-8">
     <div class="flex items-center justify-between mb-6">
         <div>
             <h2 class="text-2xl font-black text-gray-800"> Withdrawal Requests </h2>
             <p class="text-gray-500"> Review instructor payment requests. </p>
         </div> <span class="px-5 py-2 rounded-full bg-sky-200/50 border border-sky-300 text-sky-700 font-semibold"> {{ $withdrawals->total() }} Requests </span>
     </div> {{-- Desktop Cards --}}
     <div class="hidden lg:block space-y-6">
         @forelse($withdrawals as $withdraw)
         <div class="group bg-white/80 backdrop-blur-xl border border-white rounded-[30px] shadow-xl p-7 hover:-translate-y-1 duration-300">
             <div class="grid grid-cols-12 gap-6 items-center"> {{-- Instructor --}}
                 <div class="col-span-3">
                     <div class="flex items-center gap-4">
                         <img src="{{ $withdraw->instructor->avatar ? asset('storage/'.$withdraw->instructor->avatar) : 
                        asset('images/default-avatar.png') }}" class="h-16 w-16 rounded-2xl object-cover shadow">
                         <div>
                             <h3 class="font-bold text-gray-800"> {{ $withdraw->instructor->name }} </h3>
                             <p class="text-sm text-gray-500"> {{ $withdraw->instructor->email }} </p>
                             <span class="inline-flex mt-2 px-3 py-1 rounded-full bg-purple-100 text-purple-700 text-xs">
                                 Instructor
                             </span>
                         </div>
                     </div>
                 </div> {{-- Amount --}}
                 <div class="col-span-2">
                     <p class="text-sm text-gray-500"> Amount </p>
                     <h3 class="mt-2 text-2xl font-black text-sky-600"> Ks {{ number_format($withdraw->amount,2) }} </h3>
                 </div> {{-- Payment --}}
                 <div class="col-span-2">
                     <p class="text-sm text-gray-500"> Payment </p>
                     <div class="flex items-center gap-2 mt-2">
                         <div class="h-10 w-10 rounded-xl bg-green-100 flex items-center justify-center"> <i class="ri-wallet-3-line text-green-600"></i> </div> <span class="font-semibold"> {{ $withdraw->payment_method }} </span>
                     </div>
                 </div> {{-- Account --}}
                 <div class="col-span-2">
                     <p class="text-sm text-gray-500"> Account </p>
                     <p class="font-semibold mt-2"> {{ $withdraw->account_name }} </p>
                     <p class="text-sm text-gray-500"> {{ $withdraw->account_number }} </p>
                 </div> {{-- Status --}}
                 <div class="col-span-1">
                     @if($withdraw->status=='pending')
                     <span class="px-3 py-2 rounded-full bg-yellow-100 text-yellow-700 text-xs font-bold animate-pulse"> Pending </span>
                     @elseif($withdraw->status=='paid')
                     <span class="px-6 py-2 rounded-full bg-green-100 text-green-700 text-xs font-bold"> Paid </span>
                     @else
                     <span class="px-3 py-2 rounded-full bg-red-100 text-red-700 text-xs font-bold"> Rejected </span>
                     @endif
                 </div> {{-- Action --}}
                 <div class="col-span-2">
                     @if($withdraw->status=='pending')
                     <div class="flex gap-2">
                         <button onclick="openApproveModal('{{ $withdraw->id }}')"
                             class="h-10 w-8 mt-2 flex-1 px-4 py-1 rounded-xl bg-gradient-to-r from-green-700 to-emerald-200 text-white font-semibold hover:scale-105 duration-300">
                             <i class="ri-check-line"></i>
                         </button>
                         <button onclick="openRejectModal('{{ $withdraw->id }}')"
                             class="h-10 w-8 mt-2 flex-1 px-4 py-1 font-bold rounded-xl bg-gradient-to-r from-red-700 to-rose-300 text-white font-semibold hover:scale-105 duration-300">
                             <i class="ri-close-line"></i>
                         </button>
                     </div>
                     @else
                     @if($withdraw->status=='rejected')
                     <span class="text-gray-400"> {{ $withdraw->rejected_reason }}</span>
                     @else
                     <span class="text-gray-400"> Completed </span>
                     @endif
                     @endif
                 </div>
             </div> {{-- Note --}}
             @if($withdraw->note)
             <div class="mt-6 rounded-2xl bg-sky-50 p-4">
                 <div class="flex gap-3">
                     <i class="ri-message-3-line text-sky-500 text-xl"></i>
                     <p class="text-gray-600"> {{ $withdraw->note }} </p>
                 </div>
             </div>
             @endif
         </div>
         @empty
         <div class="bg-white rounded-3xl p-20 text-center shadow"> <i class="ri-inbox-line text-6xl text-gray-300"></i>
             <h3 class="mt-5 text-2xl font-bold"> No Withdrawal Requests </h3>
             <p class="text-gray-500 mt-2"> There are currently no requests. </p>
         </div>
         @endforelse
     </div>
     <!-- mobile card  -->
     <div class="lg:hidden space-y-5"> @foreach($withdrawals as $withdraw) <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-lg border border-white p-5">
             <div class="flex items-center gap-4"> <img src="{{ $withdraw->instructor->avatar ? asset('storage/'.$withdraw->instructor->avatar) : asset('images/default-avatar.png') }}" class="h-14 w-14 rounded-2xl object-cover">
                 <div>
                     <h3 class="font-bold"> {{ $withdraw->instructor->name }} </h3>
                     <p class="text-sm text-gray-500"> {{ $withdraw->payment_method }} </p>
                 </div>
             </div>
             <div class="mt-5">
                 <h2 class="text-xl font-black text-sky-600"> Ks {{ number_format($withdraw->amount,2) }} </h2>
             </div>
             <div class="mt-5 flex justify-between">
                 @if($withdraw->status=='pending')
                 <span class="px-4 py-2 text-xs rounded-full bg-yellow-100 text-yellow-700 animate-pulse"> Pending </span>
                 @elseif($withdraw->status=='paid')
                 <span class="px-6 py-2 text-xs rounded-full bg-green-100 text-green-700"> Paid </span>
                 @else
                 <span class="px-4 py-2 text-xs rounded-full bg-red-100 text-red-700"> Rejected </span>
                 @endif
                 @if($withdraw->status=='pending') <div class="flex gap-2">
                     <button onclick="openApproveModal('{{ $withdraw->id }}')"
                         class="h-6 w-6 rounded-xl bg-green-700 text-white">
                         <i class="ri-check-line"></i>
                     </button>
                     <button onclick="openRejectModal('{{ $withdraw->id }}')"
                         class="h-6 w-6 rounded-xl bg-red-500 text-white"> <i class="ri-close-line"></i>
                     </button>
                 </div>
                 @endif
             </div>
         </div>
         @endforeach
     </div>
 </div>
 <div class="mt-8">
     <div class="bg-white/70 backdrop-blur-xl rounded-3xl p-5 shadow-lg"> {{ $withdrawals->links() }} </div>
 </div>
 <div id="approveModal" class="hidden fixed inset-0 z-50 bg-black/40 backdrop-blur-sm flex items-center justify-center px-4">
     <div class="bg-white rounded-[30px] shadow-2xl w-full max-w-md p-8 animate-[fadeIn_.3s_ease]">
         <div class="text-center">
             <div class="mx-auto h-20 w-20 rounded-full bg-green-100 flex items-center justify-center"> <i class="ri-check-double-line text-5xl text-green-600"></i> </div>
             <h2 class="mt-5 text-2xl font-black text-gray-800"> Approve Withdrawal? </h2>
             <p class="mt-2 text-gray-500"> Confirm that payment has been completed. </p>
         </div>
         <form id="approveForm" method="POST" class="mt-8">
             @csrf
             <button type="submit" class="w-full py-4 rounded-2xl bg-gradient-to-r from-green-500 to-emerald-500 text-white font-bold shadow-lg hover:scale-105 duration-300"> <i class="ri-check-line mr-2"></i> Confirm Payment </button> <button type="button" onclick="closeApproveModal()" class="mt-3 w-full py-4 rounded-2xl bg-gray-100 text-gray-700 font-semibold"> Cancel </button>
         </form>
     </div>
 </div>
 <div id="rejectModal" class="hidden fixed inset-0 z-50 bg-black/40 backdrop-blur-sm flex items-center justify-center px-4">
     <div class="bg-white rounded-[30px] shadow-2xl w-full max-w-md p-8">
         <div class="text-center">
             <div class="mx-auto h-20 w-20 rounded-full bg-red-100 flex items-center justify-center"> <i class="ri-close-circle-line text-5xl text-red-600"></i> </div>
             <h2 class="mt-5 text-2xl font-black"> Reject Withdrawal? </h2>
             <p class="text-gray-500 mt-2"> Please provide rejection reason. </p>
         </div>
         <form id="rejectForm" method="POST" class="mt-7">
             @csrf
             <textarea name="reason" required rows="4" placeholder="Reason..." class="w-full rounded-2xl border border-gray-200 p-4 focus:ring-2 focus:ring-red-400"></textarea> <button type="submit" class="mt-5 w-full py-4 rounded-2xl bg-gradient-to-r from-red-500 to-rose-500 text-white font-bold hover:scale-105 duration-300"> <i class="ri-close-line mr-2"></i> Reject Request </button> <button type="button" onclick="closeRejectModal()" class="mt-3 w-full py-4 rounded-2xl bg-gray-100"> Cancel </button>
         </form>
     </div>
 </div>


 <script>
     let walletChart = null;

     loadWalletAnalytics();

     async function loadWalletAnalytics() {

         try {

             const response = await fetch(
                 "{{ route('admin.withdraw.wallet.analytics') }}"
             );
             const result = await response.json();
             if (!result.success) return;
             const data = result.data;
             drawWalletChart(data);
         } catch (error) {
             console.log(error);
         }

     }

     function drawWalletChart(data) {

         if (walletChart) {

             walletChart.destroy();

         }

         walletChart = new Chart(

             document.getElementById("walletChart"),

             {

                 type: 'doughnut',

                 data: {

                     labels: [
                         "Withdraw",
                         "Available Balance"
                     ],

                     datasets: [{

                         data: [
                             data.total_withdraw,
                             data.total_balance,
                             data.total_earnings
                         ],

                         backgroundColor: [
                             "#e68a00",
                             "#e600e6",
                             "#2eb82e"
                         ],

                         borderWidth: 0,

                         hoverOffset: 12

                     }]

                 },
                 options: {

                     responsive: true,

                     cutout: '72%',

                     animation: {

                         animateRotate: true,

                         duration: 1500

                     },

                     plugins: {

                         legend: {

                             position: 'bottom'

                         }

                     }

                 }

             }

         );

     }


     let withdrawId = null;

     function openApproveModal(id) {
         withdrawId = id;
         let modal = document.getElementById('approveModal');
         let form = document.getElementById('approveForm');
         form.action = `{{ route('admin.withdraw.approve',':id') }}`.replace(':id', id);
         modal.classList.remove('hidden');
     }

     function closeApproveModal() {
         document.getElementById('approveModal').classList.add('hidden');
     }

     function openRejectModal(id) {
         withdrawId = id;
         let modal = document.getElementById('rejectModal');
         let form = document.getElementById('rejectForm');
         form.action = `{{ route('admin.withdraw.reject',':id') }}`.replace(':id', id);
         modal.classList.remove('hidden');
     }

     function closeRejectModal() {
         document.getElementById('rejectModal').classList.add('hidden');
     }
     //close when click outside 
     window.onclick = function(e) {
         let approve = document.getElementById('approveModal');
         let reject = document.getElementById('rejectModal');
         if (e.target == approve) {
             closeApproveModal();
         }
         if (e.target == reject) {
             closeRejectModal();
         }
     }
 </script>
 @endsection