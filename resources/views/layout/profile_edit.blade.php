<div
    id="avatarModal"
    class="fixed inset-0 z-[9999] hidden">

    <!-- BACKDROP -->
    <div
        class="absolute inset-0 bg-black/40 backdrop-blur-sm"
        onclick="closeAvatarModal()"
    ></div>


    <!-- CENTER MODAL -->
    <div class="relative min-h-screen flex items-center justify-center px-4">

        <div
            id="avatarModalBox"
            class="w-full max-w-[520px]
                   bg-white
                   rounded-2xl
                   shadow-2xl
                   border border-slate-200
                   overflow-hidden
                   transform scale-95 opacity-0
                   transition-all duration-200"
        >

            <!-- HEADER -->
            <div class="px-7 pt-7 pb-5">

                <div class="flex items-start justify-between">

                    <div>
                        <h2 class="text-[22px] font-medium text-slate-800">
                            Choose a profile picture
                        </h2>

                        <p class="text-sm text-slate-500 mt-2">
                            Select an avatar for your profile
                        </p>
                    </div>


                    <!-- CLOSE -->
                    <button
                        type="button"
                        onclick="closeAvatarModal()"
                        class="w-9 h-9 rounded-full
                               flex items-center justify-center
                               text-slate-500
                               hover:bg-slate-100
                               transition"
                    >
                        ✕
                    </button>

                </div>

            </div>


            <!-- CURRENT PREVIEW -->
            <div class="flex justify-center pb-7">

                <img
                    id="avatarPreview"
                    src="{{ auth()->user()->avatar
                        ? asset('images/avatars/' . auth()->user()->avatar)
                        : asset('images/avatars/avatar1.png') }}"
                    class="w-24 h-24 rounded-full
                           object-cover
                           border border-slate-200
                           shadow-sm"
                >

            </div>


            <!-- AVATARS -->
            <div class="px-7 pb-7">

                <p class="text-sm font-medium text-slate-700 mb-5">
                    Choose an avatar
                </p>


                <div class="grid grid-cols-5 gap-y-6 gap-x-5">

                    @for($i = 1; $i <= 10; $i++)

                        @php
                            $avatarName = "avatar{$i}.png";
                            $avatarUrl = asset("images/avatars/{$avatarName}");
                            $isSelected = auth()->user()->avatar === $avatarName;
                        @endphp

                        <button
                            type="button"
                            class="avatar-choice flex justify-center"
                            data-avatar="{{ $avatarName }}"
                            data-image="{{ $avatarUrl }}"
                        >

                            <div
                                class="avatar-circle relative
                                       w-[68px] h-[68px]
                                       rounded-full
                                       p-[3px]
                                       transition-all duration-200
                                       {{ $isSelected
                                            ? 'ring-4 ring-blue-100 bg-blue-600'
                                            : '' }}"
                            >

                                <img
                                    src="{{ $avatarUrl }}"
                                    class="w-full h-full rounded-full object-cover"
                                >


                                <!-- CHECK -->
                                <span
                                    class="avatar-check
                                           absolute -right-1 -bottom-1
                                           w-6 h-6
                                           rounded-full
                                           bg-blue-600
                                           border-[3px]
                                           border-white
                                           text-white
                                           text-xs
                                           font-bold
                                           items-center
                                           justify-center
                                           {{ $isSelected ? 'flex' : 'hidden' }}"
                                >
                                    ✓
                                </span>

                            </div>

                        </button>

                    @endfor

                </div>

            </div>


            <!-- DIVIDER -->
            <div class="border-t border-slate-200"></div>


            <!-- FOOTER -->
            <div class="px-7 py-4 flex justify-end gap-3">

                <button
                    type="button"
                    onclick="closeAvatarModal()"
                    class="px-5 py-2.5
                           rounded-lg
                           text-sm font-medium
                           text-slate-700
                           hover:bg-slate-100"
                >
                    Cancel
                </button>


                <button
                    type="button"
                    id="saveAvatarBtn"
                    onclick="saveAvatar()"
                    class="px-5 py-2.5
                           rounded-lg
                           bg-blue-600
                           hover:bg-blue-700
                           text-white
                           text-sm font-medium
                           transition"
                >
                    Save
                </button>

            </div>

        </div>

    </div>

</div>


<script>

let selectedAvatar = "{{ auth()->user()->avatar ?? 'avatar1.png' }}";


// =====================================
// OPEN MODAL
// =====================================

function openAvatarModal() {

    const modal = document.getElementById('avatarModal');
    const box = document.getElementById('avatarModalBox');

    modal.classList.remove('hidden');

    document.body.classList.add('overflow-hidden');

    setTimeout(() => {

        box.classList.remove('scale-95', 'opacity-0');
        box.classList.add('scale-100', 'opacity-100');

    }, 10);
}


// =====================================
// CLOSE MODAL
// =====================================

function closeAvatarModal() {

    const modal = document.getElementById('avatarModal');
    const box = document.getElementById('avatarModalBox');

    box.classList.remove('scale-100', 'opacity-100');

    box.classList.add('scale-95', 'opacity-0');

    setTimeout(() => {

        modal.classList.add('hidden');

        document.body.classList.remove('overflow-hidden');

    }, 200);
}


// =====================================
// SELECT AVATAR
// =====================================

document.querySelectorAll('.avatar-choice').forEach(button => {

    button.addEventListener('click', function () {

        selectedAvatar = this.dataset.avatar;

        const image = this.dataset.image;

        // Update big preview
        document.getElementById('avatarPreview').src = image;


        // Remove selection from all
        document.querySelectorAll('.avatar-choice').forEach(item => {

            const circle = item.querySelector('.avatar-circle');
            const check = item.querySelector('.avatar-check');

            circle.classList.remove(
                'ring-4',
                'ring-blue-100',
                'bg-blue-600'
            );

            check.classList.remove('flex');
            check.classList.add('hidden');

        });


        // Add selection
        const circle = this.querySelector('.avatar-circle');
        const check = this.querySelector('.avatar-check');

        circle.classList.add(
            'ring-4',
            'ring-blue-100',
            'bg-blue-600'
        );

        check.classList.remove('hidden');
        check.classList.add('flex');

    });

});


// =====================================
// SAVE AVATAR
// =====================================

async function saveAvatar() {

    const button = document.getElementById('saveAvatarBtn');

    button.disabled = true;
    button.innerText = 'Saving...';


    try {

        const response = await fetch(
            "{{ route('profile.avatar.update') }}",
            {
                method: 'POST',

                headers: {
                    'Content-Type': 'application/json',

                    'Accept': 'application/json',

                    'X-CSRF-TOKEN':
                        document.querySelector(
                            'meta[name="csrf-token"]'
                        )?.getAttribute('content')
                        || "{{ csrf_token() }}"
                },

                body: JSON.stringify({
                    avatar: selectedAvatar
                })
            }
        );


        const data = await response.json();


        if (!response.ok) {

            throw new Error(
                data.message || 'Failed to update avatar.'
            );

        }


        // =================================
        // UPDATE ALL AVATAR IMAGES
        // =================================

        document.querySelectorAll('.current-user-avatar').forEach(img => {

            img.src = data.avatar;

        });


        // =================================
        // CLOSE MODAL
        // =================================

        closeAvatarModal();


        // =================================
        // SUCCESS MESSAGE
        // =================================

        showAvatarSuccess();


    } catch (error) {

        console.error(error);

        alert(
            error.message || 'Failed to update profile picture.'
        );

    } finally {

        button.disabled = false;
        button.innerText = 'Save';

    }

}


// =====================================
// SUCCESS TOAST
// =====================================

function showAvatarSuccess() {

    const toast = document.createElement('div');

    toast.className = `
        fixed
        top-5
        right-5
        z-[10000]
        bg-white
        border
        border-slate-200
        shadow-xl
        rounded-xl
        px-5
        py-3
        flex
        items-center
        gap-3
        animate-[fadeIn_.2s_ease-out]
    `;

    toast.innerHTML = `
        <div class="w-8 h-8 rounded-full
                    bg-green-100 text-green-600
                    flex items-center justify-center">
            ✓
        </div>

        <div>
            <p class="font-semibold text-slate-800">
                Profile picture updated
            </p>

            <p class="text-xs text-slate-500">
                Your new avatar has been saved.
            </p>
        </div>
    `;

    document.body.appendChild(toast);


    setTimeout(() => {

        toast.remove();

    }, 3000);

}


// =====================================
// ESC KEY
// =====================================

document.addEventListener('keydown', function(e) {

    if (e.key === 'Escape') {

        const modal = document.getElementById('avatarModal');

        if (!modal.classList.contains('hidden')) {

            closeAvatarModal();

        }

    }

});

</script>