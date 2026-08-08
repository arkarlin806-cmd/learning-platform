@extends('layout.course_ins')
@section("title","Live Room")
@section("page","Grouop Video Call Live Room")

@section('content')
<div class="mx-auto max-w-7xl px-3 py-4 sm:px-4 lg:px-6">
    {{-- Header --}}
    <div class="mb-4 flex flex-col gap-3 lg:flex-row lg:items-start lg:justify-between">
        <div class="min-w-0">
            <h1 class="text-2xl font-extrabold tracking-tight text-slate-900 sm:text-3xl">
                {{ $session->title }}
            </h1>

            <div class="mt-3 flex flex-wrap items-center gap-2">
                <span class="inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1.5 text-xs font-bold text-emerald-700 sm:text-sm">
                    <span class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    Live Session
                </span>
                @if(auth()->user()->role == 2)
                <span class="inline-flex items-center rounded-full border border-slate-200 bg-white px-3 py-1.5 text-xs font-semibold text-slate-700 sm:text-sm">
                    Room: {{ $session->room_name }}
                </span>
                @endif
                @if(!empty($session->scheduled_at))
                <span class="inline-flex items-center rounded-full border border-slate-200 bg-white px-3 py-1.5 text-xs font-semibold text-slate-700 sm:text-sm">
                    Schedule: {{ \Carbon\Carbon::parse($session->scheduled_at)->format('Y-m-d H:i') }}
                </span>
                @endif
            </div>
        </div>

        <div class="flex flex-wrap items-center gap-2">
            <a href="{{ route('courses.live.show', [$course, $session]) }}"
                class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:-translate-y-0.5 hover:bg-slate-50">
                Back
            </a>

            @if($isModerator)
            <form action="{{ route('courses.live.end', [$course, $session]) }}" method="POST" id="manualEndForm">
                @csrf
                <button type="submit"
                    id="manualEndBtn"
                    class="inline-flex items-center justify-center rounded-xl bg-red-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:-translate-y-0.5 hover:bg-red-700">
                    End Session
                </button>
            </form>
            @endif
        </div>
    </div>

    {{-- Grid --}}
    <div class="grid grid-cols-1 gap-4 xl:grid-cols-12">
        {{-- Left / Video --}}
        <div class="xl:col-span-9">
            <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
                {{-- top status bar --}}
                <div class="flex flex-col gap-3 border-b border-slate-200 p-4 sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="inline-flex items-center rounded-full bg-indigo-50 px-3 py-1.5 text-xs font-bold text-indigo-700">
                            Course VC Room
                        </span>

                        <span id="connectionStateChip"
                            class="inline-flex items-center rounded-full border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs font-semibold text-slate-700">
                            Connecting...
                        </span>

                        <span id="participantChip"
                            class="inline-flex items-center rounded-full border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs font-semibold text-slate-700">
                            Participants: --
                        </span>
                    </div>
                    <div>
                        <span id="reconnectChip"
                            class="inline-flex items-center rounded-full border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs font-semibold text-slate-700">
                            Stable connection
                        </span>
                    </div>
                </div>

                {{-- video area --}}
                <div class="relative p-2 sm:p-3">
                    {{-- Warning Banner --}}
                    <div id="banner-warning"
                        class="hidden absolute left-3 right-3 top-3 z-20 rounded-2xl border border-amber-200 bg-amber-50 px-4 py-3 text-amber-800 shadow-lg">
                        <div class="text-sm font-extrabold">Connection lost</div>
                        <div id="banner-warning-text" class="mt-1 text-sm">
                            Trying to reconnect...
                        </div>
                    </div>

                    {{-- Error Banner --}}
                    <div id="banner-error"
                        class="hidden absolute left-3 right-3 top-3 z-20 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-red-800 shadow-lg">
                        <div class="text-sm font-extrabold">Video call disconnected</div>
                        <div id="banner-error-text" class="mt-1 text-sm">
                            The connection could not be restored.
                        </div>
                    </div>

                    {{-- Success Banner --}}
                    <div id="banner-success"
                        class="hidden absolute left-3 right-3 top-3 z-20 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-800 shadow-lg">
                        <div class="text-sm font-extrabold">Connected</div>
                        <div id="banner-success-text" class="mt-1 text-sm">
                            You are now connected to the live session.
                        </div>
                    </div>

                    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-slate-100">
                        <div id="jitsi-container" class="h-[62vh] min-h-[420px] w-full sm:h-[70vh] xl:h-[76vh]"></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right / Info --}}
        <div class="xl:col-span-3">
            <div class="space-y-4">
                {{-- Session overview --}}
                <div class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm">
                    <h3 class="text-base font-extrabold text-slate-900">Session overview</h3>

                    <div class="mt-4 space-y-3">
                        <div class="flex items-center justify-between rounded-2xl border border-slate-200 bg-slate-50 p-3">
                            <div class="min-w-0">
                                <div class="text-[11px] font-bold uppercase tracking-wide text-slate-500">Your role</div>
                                <div class="truncate text-sm font-extrabold text-slate-900">
                                    {{ $isModerator ? 'Instructor / Moderator' : 'Student / Participant' }}
                                </div>
                            </div>

                            <span class="ml-3 inline-flex rounded-full px-3 py-1 text-xs font-bold {{ $isModerator ? 'bg-blue-100 text-blue-700' : 'bg-emerald-100 text-emerald-700' }}">
                                {{ $isModerator ? 'Moderator' : 'Participant' }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between rounded-2xl border border-slate-200 bg-slate-50 p-3">
                            <div class="min-w-0">
                                <div class="text-[11px] font-bold uppercase tracking-wide text-slate-500">Session status</div>
                                <div class="truncate text-sm font-extrabold text-slate-900">Live</div>
                            </div>

                            <span id="sessionStateBadge"
                                class="ml-3 inline-flex rounded-full bg-emerald-100 px-3 py-1 text-xs font-bold text-emerald-700">
                                Connected
                            </span>
                        </div>

                        <div class="flex items-center justify-between rounded-2xl border border-slate-200 bg-slate-50 p-3">
                            <div class="min-w-0">
                                <div class="text-[11px] font-bold uppercase tracking-wide text-slate-500">Reconnect timeout</div>
                                <div class="truncate text-sm font-extrabold text-slate-900">15 seconds</div>
                            </div>

                            <span id="countdownBadge"
                                class="ml-3 inline-flex rounded-full bg-amber-100 px-3 py-1 text-xs font-bold text-amber-700">
                                Idle
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Details --}}
                <div class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm">
                    <h3 class="text-base font-extrabold text-slate-900">Details</h3>

                    <div class="mt-4 space-y-3">
                        @if(auth()->user()->role == 2)
                        <div class="rounded-2xl border border-slate-200 p-3">
                            <div class="text-[11px] font-bold uppercase tracking-wide text-slate-500">Join URL</div>
                            <div class="mt-1 break-all text-sm text-slate-800">{{ $meeting['join_url'] }}</div>
                        </div>
                        @endif
                        <div class="rounded-2xl border border-slate-200 p-3">
                            <div class="text-[11px] font-bold uppercase tracking-wide text-slate-500">User</div>
                            <div class="mt-1 text-sm font-semibold text-slate-800">{{ $meeting['display_name'] }}</div>
                        </div>

                        <div class="rounded-2xl border border-slate-200 p-3">
                            <div class="text-[11px] font-bold uppercase tracking-wide text-slate-500">Email</div>
                            <div class="mt-1 break-all text-sm text-slate-800">{{ $meeting['email'] ?: '-' }}</div>
                        </div>

                        <div class="rounded-2xl border border-slate-200 p-3">
                            <div class="text-[11px] font-bold uppercase tracking-wide text-slate-500">Recording</div>
                            <div class="mt-1 text-sm font-semibold text-slate-800">
                                {{ !empty($session->recording_enabled) ? 'Enabled' : 'Disabled' }}
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 rounded-2xl border border-dashed border-slate-300 bg-slate-50 p-3 text-xs leading-6 text-slate-600">
                        If the connection is lost, the room will try to reconnect automatically.
                        If reconnection does not recover within <span class="font-bold text-slate-900">15 seconds</span>:
                        <br>• <span class="font-bold text-slate-900">Instructor</span>: the live session will be ended automatically.
                        <br>• <span class="font-bold text-slate-900">Student</span>: the student will leave the room automatically and return to the session page.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Hidden values --}}
<input type="hidden" id="jitsi_domain" value="{{ $meeting['domain'] }}">
<input type="hidden" id="jitsi_room_name" value="{{ $meeting['room_name'] }}">
<input type="hidden" id="jitsi_jwt" value="{{ $meeting['jwt'] }}">
<input type="hidden" id="jitsi_display_name" value="{{ $meeting['display_name'] }}">
<input type="hidden" id="jitsi_email" value="{{ $meeting['email'] }}">
<input type="hidden" id="jitsi_lang" value="{{ $meeting['lang'] }}">
<input type="hidden" id="jitsi_is_moderator" value="{{ $isModerator ? '1' : '0' }}">
<input type="hidden" id="jitsi_prejoin_enabled" value="{{ !empty($meeting['config']['prejoinPageEnabled']) ? '1' : '0' }}">
<input type="hidden" id="jitsi_recording_enabled" value="{{ !empty($session->recording_enabled) ? '1' : '0' }}">
<input type="hidden" id="auto_end_url" value="{{ route('courses.live.autoEnd', [$course, $session]) }}">
<input type="hidden" id="show_url" value="{{ route('courses.live.show', [$course, $session]) }}">

<script src="https://8x8.vc/external_api.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var warningBanner = document.getElementById('banner-warning');
        var errorBanner = document.getElementById('banner-error');
        var successBanner = document.getElementById('banner-success');
        var warningText = document.getElementById('banner-warning-text');
        var errorText = document.getElementById('banner-error-text');
        var successText = document.getElementById('banner-success-text');

        var connectionStateChip = document.getElementById('connectionStateChip');
        var reconnectChip = document.getElementById('reconnectChip');
        var participantChip = document.getElementById('participantChip');
        var sessionStateBadge = document.getElementById('sessionStateBadge');
        var countdownBadge = document.getElementById('countdownBadge');

        function hideAllBanners() {
            warningBanner.classList.add('hidden');
            errorBanner.classList.add('hidden');
            successBanner.classList.add('hidden');
        }

        function showBanner(type, text) {
            hideAllBanners();

            if (type === 'warning') {
                warningText.innerText = text;
                warningBanner.classList.remove('hidden');
            } else if (type === 'error') {
                errorText.innerText = text;
                errorBanner.classList.remove('hidden');
            } else if (type === 'success') {
                successText.innerText = text;
                successBanner.classList.remove('hidden');

                setTimeout(function() {
                    successBanner.classList.add('hidden');
                }, 2400);
            }
        }

        function setText(el, text) {
            if (el) {
                el.innerText = text;
            }
        }

        function setBadgeState(type, text) {
            if (!sessionStateBadge) return;

            sessionStateBadge.className = 'ml-3 inline-flex rounded-full px-3 py-1 text-xs font-bold';

            if (type === 'green') {
                sessionStateBadge.classList.add('bg-emerald-100', 'text-emerald-700');
            } else if (type === 'yellow') {
                sessionStateBadge.classList.add('bg-amber-100', 'text-amber-700');
            } else if (type === 'red') {
                sessionStateBadge.classList.add('bg-red-100', 'text-red-700');
            } else {
                sessionStateBadge.classList.add('bg-slate-100', 'text-slate-700');
            }

            sessionStateBadge.innerText = text;
        }

        function setCountdownBadge(type, text) {
            if (!countdownBadge) return;

            countdownBadge.className = 'ml-3 inline-flex rounded-full px-3 py-1 text-xs font-bold';
            if (type === 'yellow') {
                countdownBadge.classList.add('bg-amber-100', 'text-amber-700');
            } else if (type === 'red') {
                countdownBadge.classList.add('bg-red-100', 'text-red-700');
            } else if (type === 'green') {
                countdownBadge.classList.add('bg-emerald-100', 'text-emerald-700');
            } else {
                countdownBadge.classList.add('bg-slate-100', 'text-slate-700');
            }

            countdownBadge.innerText = text;
        }

        if (typeof JitsiMeetExternalAPI === 'undefined') {
            showBanner('error', 'Jitsi external_api.js could not be loaded.');
            setText(connectionStateChip, 'Load failed');
            setBadgeState('red', 'Load failed');
            return;
        }

        var domain = document.getElementById('jitsi_domain').value;
        var roomName = document.getElementById('jitsi_room_name').value;
        var jwt = document.getElementById('jitsi_jwt').value;
        var displayName = document.getElementById('jitsi_display_name').value;
        var email = document.getElementById('jitsi_email').value;
        var lang = document.getElementById('jitsi_lang').value;
        var prejoinEnabled = document.getElementById('jitsi_prejoin_enabled').value === '1';
        var recordingEnabled = document.getElementById('jitsi_recording_enabled').value === '1';
        var isModerator = document.getElementById('jitsi_is_moderator').value === '1';
        var autoEndUrl = document.getElementById('auto_end_url').value;
        var showUrl = document.getElementById('show_url').value;

        if (!domain || !roomName || !jwt) {
            showBanner('error', 'Missing Jitsi configuration. domain / room / jwt is empty.');
            setText(connectionStateChip, 'Config error');
            setBadgeState('red', 'Config error');
            return;
        }

        var reconnectTimer = null;
        var reconnectCountdown = 15;
        var reconnecting = false;
        var autoEnding = false;
        var api = null;
        var participantCount = 1;

        function updateParticipantChip() {
            setText(participantChip, 'Participants: ' + participantCount);
        }

        function resetReconnectUI() {
            reconnecting = false;
            reconnectCountdown = 15;

            if (reconnectTimer) {
                clearInterval(reconnectTimer);
                reconnectTimer = null;
            }

            setText(connectionStateChip, 'Connected');
            setText(reconnectChip, 'Stable connection');
            setBadgeState('green', 'Connected');
            setCountdownBadge('yellow', 'Idle');
            warningBanner.classList.add('hidden');
        }

        function beginReconnectCountdown(reasonText) {
            if (reconnecting || autoEnding) return;

            reconnecting = true;
            reconnectCountdown = 15;

            setText(connectionStateChip, 'Reconnecting...');
            setText(reconnectChip, 'Recovering connection...');
            setBadgeState('yellow', 'Reconnecting');
            setCountdownBadge('yellow', reconnectCountdown + 's');

            showBanner('warning', reasonText + ' Reconnecting... 15 seconds remaining.');

            reconnectTimer = setInterval(function() {
                reconnectCountdown--;

                setCountdownBadge('yellow', reconnectCountdown + 's');
                showBanner('warning', reasonText + ' Reconnecting... ' + reconnectCountdown + ' seconds remaining.');

                if (reconnectCountdown <= 0) {
                    clearInterval(reconnectTimer);
                    reconnectTimer = null;
                    handleReconnectTimeout();
                }
            }, 1000);
        }

        function postAutoEnd() {
            if (autoEnding) return;
            autoEnding = true;

            setText(connectionStateChip, 'Disconnected');
            setText(reconnectChip, 'Session closing...');
            setBadgeState('red', 'Disconnected');
            setCountdownBadge('red', 'Expired');

            if (isModerator) {
                showBanner('error', 'Connection was not restored within 15 seconds. This live session is being ended automatically.');
                fetch(autoEndUrl, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(function(response) {
                        return response.json().catch(function() {
                            return {};
                        });
                    })
                    .then(function() {
                        setTimeout(function() {
                            window.location.href = showUrl;
                        }, 1600);
                    })
                    .catch(function() {
                        setTimeout(function() {
                            window.location.href = showUrl;
                        }, 1600);
                    });
            } else {
                showBanner('error', 'Connection was not restored within 15 seconds. You are being returned to the live session page.');

                setTimeout(function() {
                    window.location.href = showUrl;
                }, 1600);
            }
        }

        function handleReconnectTimeout() {
            postAutoEnd();
        }

        var options = {
            roomName: roomName,
            parentNode: document.querySelector('#jitsi-container'),
            width: '100%',
            height: '100%',
            jwt: jwt,
            lang: lang,
            userInfo: {
                displayName: displayName,
                email: email
            },
            configOverwrite: {
                prejoinPageEnabled: prejoinEnabled,
                startWithAudioMuted: false,
                startWithVideoMuted: false,
                disableInviteFunctions: false,
                toolbarButtons: [
                    'microphone',
                    'camera',
                    'closedcaptions',
                    'desktop',
                    'fullscreen',
                    'fodeviceselection',
                    'hangup',
                    'chat',
                    'tileview',
                    'settings',
                    'raisehand',
                    'videoquality',
                    'filmstrip',
                    'participants-pane',
                    'select-background'
                ]
            },
            interfaceConfigOverwrite: {
                DISABLE_JOIN_LEAVE_NOTIFICATIONS: false
            }
        };

        if (recordingEnabled) {
            options.configOverwrite.toolbarButtons.push('recording');
        }

        api = new JitsiMeetExternalAPI(domain, options);

        updateParticipantChip();

        api.addListener('videoConferenceJoined', function(event) {
            participantCount = 1;
            updateParticipantChip();
            resetReconnectUI();
            showBanner('success', 'You are connected to the live class.');
            console.log('Joined conference', event);
        });

        api.addListener('participantJoined', function(event) {
            participantCount++;
            updateParticipantChip();
            console.log('Participant joined', event);
        });

        api.addListener('participantLeft', function(event) {
            participantCount = Math.max(1, participantCount - 1);
            updateParticipantChip();
            console.log('Participant left', event);
        });

        api.addListener('readyToClose', function() {
            window.location.href = showUrl;
        });

        api.addListener('conferenceError', function(error) {
            console.error('conferenceError', error);
            beginReconnectCountdown('Conference error detected.');
        });

        api.addListener('videoConferenceLeft', function(event) {
            if (!autoEnding) {
                beginReconnectCountdown('You have been disconnected from the meeting.');
            }
            console.log('videoConferenceLeft', event);
        });

        window.addEventListener('offline', function() {
            beginReconnectCountdown('Your internet connection appears to be offline.');
        });

        window.addEventListener('online', function() {
            if (reconnecting && !autoEnding) {
                resetReconnectUI();
                showBanner('success', 'Internet connection restored.');
            }
        });
        var manualEndForm = document.getElementById('manualEndForm');
        if (manualEndForm) {
            manualEndForm.addEventListener('submit', function() {
                autoEnding = true;
            });
        }

        window.addEventListener('beforeunload', function() {
            if (reconnectTimer) {
                clearInterval(reconnectTimer);
            }

            if (api) {
                try {
                    api.dispose();
                } catch (e) {}
            }
        });
    });
</script>


<script>
    const leaveUrl = "{{ route('courses.live.leave', [$course, $session]) }}";

    let alreadySent = false;

    function leaveRoom() {

        if (alreadySent) return;

        alreadySent = true;

        const token = document
            .querySelector('meta[name="csrf-token"]')
            .content;

        const data = new FormData();

        data.append('_token', token);

        navigator.sendBeacon(leaveUrl, data);
    }

    // Browser Close
    window.addEventListener('beforeunload', leaveRoom);

    // Mobile Browser
    window.addEventListener('pagehide', leaveRoom);

    // Back Button
    window.addEventListener('popstate', leaveRoom);

    // Tab Hidden
    document.addEventListener('visibilitychange', function() {

        if (document.visibilityState === 'hidden') {
            leaveRoom();
        }

    });
</script>
@endsection