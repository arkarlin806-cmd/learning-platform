<?php

namespace App\Services;

use App\Models\CourseLiveSession;
use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Support\Str;

class JitsiService
{
    protected string $domain;
    protected string $appId;
    protected string $kid;
    protected string $privateKey;
    protected string $defaultLang;
    protected bool $enablePrejoin;

    public function __construct()
    {
        $this->domain = (string) config('services.jitsi.domain', '8x8.vc');
        $this->appId = (string) config('services.jitsi.app_id');
        $this->kid = (string) config('services.jitsi.kid');
        $this->privateKey = (string) config('services.jitsi.private_key');
        $this->defaultLang = (string) config('services.jitsi.default_lang', 'en');
        $this->enablePrejoin = (bool) config('services.jitsi.enable_prejoin', true);
    }

    public function generateRoomName(CourseLiveSession $session): string
    {
        // JaaS room format => APP_ID/room-name
        return $this->appId . '/' . $session->room_name;
    }

    public function generateJwt(User $user, CourseLiveSession $session, bool $isModerator = false): string
    {
        $now = time();
        $exp = $now + (60 * 60 * 4); // 4 hours

        $payload = [
            'aud' => 'jitsi',
            'iss' => 'chat',
            'sub' => $this->appId,
            'room' => $session->room_name,
            'nbf' => $now - 10,
            'exp' => $exp,
            'context' => [
                'user' => [
                    'id' => (string) $user->id,
                    'name' => $user->name ?? 'User',
                    'email' => $user->email ?? '',
                    'moderator' => $isModerator ? 'true' : 'false',
                ],
                'features' => [
                    'recording' => (bool) $session->recording_enabled,
                    'livestreaming' => false,
                    'transcription' => false,
                    'outbound-call' => false,
                ],
                'room' => [
                    'regex' => false,
                ],
            ],
        ];

        return JWT::encode($payload, $this->privateKey, 'RS256', $this->kid);
    }

    public function buildJoinUrl(CourseLiveSession $session): string
    {
        return 'https://' . $this->domain . '/' . $this->generateRoomName($session);
    }

    public function buildMeetingPayload(User $user, CourseLiveSession $session, bool $isModerator = false): array
    {
        $jwt = $this->generateJwt($user, $session, $isModerator);

        return [
            'domain' => $this->domain,
            'room_name' => $this->generateRoomName($session),
            'jwt' => $jwt,
            'join_url' => $this->buildJoinUrl($session),
            'display_name' => $user->name ?? 'User',
            'email' => $user->email ?? '',
            'lang' => $this->defaultLang,
            'config' => [
                'prejoinPageEnabled' => $this->enablePrejoin,
                'startWithAudioMuted' => false,
                'startWithVideoMuted' => false,
                'disableInviteFunctions' => false,
                'toolbarButtons' => [
                    'microphone',
                    'camera',
                    'closedcaptions',
                    'desktop',
                    'fullscreen',
                    'fodeviceselection',
                    'hangup',
                    'chat',
                    'recording',
                    'tileview',
                    'settings',
                    'raisehand',
                    'videoquality',
                    'filmstrip',
                    'participants-pane',
                    'select-background',
                ],
            ],
            'interface_config' => [
                'DISABLE_JOIN_LEAVE_NOTIFICATIONS' => false,
            ],
        ];
    }

    public function generateUniqueRoomName(int $courseId): string
    {
        return 'course-' . $courseId . '-' . Str::lower(Str::random(12));
    }
}
