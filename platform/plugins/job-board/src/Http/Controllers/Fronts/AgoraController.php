<?php

namespace Botble\JobBoard\Http\Controllers\Fronts;
use App\Http\Controllers\Controller;
use App\Salon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Pusher\Pusher;
use TaylanUnutmazble\AgoraTokenBuilder\RtcTokenBuilder;
use App\Models\Event;

class AgoraController extends Controller
{
    public function showVideoCallRoom()
{
    return view('themes.jobbox.views.job-board.startmeeting');
}

    public function createmeeting(Request $request,$id)
{
  
    try {
          // Retrieve the 'channel' parameter from the JSON body
          $channel = $request->json('channel');
         
          if (!$channel) {
              return response()->json(['error' => 'Channel parameter missing'], 400);
          }
        // Logic for creating the meeting
        $meetingLink = "generated_meeting_link"; // replace with actual meeting link logic
        $token = "generated_token"; // replace with actual token generation logic

        return response()->json([
            'meeting_link' => $meetingLink,
            'token' => $token
        ]);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Unable to create meeting'], 500);
    }
}
    public function getToken(Request $request,$id)
{
    $appId = env('AGORA_APP_ID');
    $appCertificate = env('AGORA_APP_CERTIFICATE');
    // $appId = "d68157674b73485e8ce461ae2af71003";
    // $appCertificate = "4cef74db59ff4244bb14a26dbd62cf47";
    // $channelName = $request->query('channel');
    $channelName = $request->json('channel');
 
    $uid = $request->json('account');
    $expirationTimeInSeconds = 86400;
    $currentTimeStamp = time();
 
    $privilegeExpiredTs = $currentTimeStamp + $expirationTimeInSeconds;
    $role = $request->json('role', 2);
    // $token = RtcTokenBuilder::buildTokenWithUid($appId, $appCertificate, $channelName, $uid,$role,$privilegeExpiredTs);

    // // Notify clients using Pusher
    // $this->notifyClients('video-call-channel', 'client-video-call-started', [
    //     'callLink' => url("/room?channel=$channelName&token=$token"),
    //     'actionValue' => $request->get('reciver_user_id')
    // ]);
    $token = $this->generateAgoraToken($appId, $appCertificate, $channelName, $uid, $role, $privilegeExpiredTs);
    $callLink = url("/room?channel=$channelName&token=$token");
    // return response()->json(['token' => $token, 'uid' => $uid]);
    $event = new Event();
        $event->jobseekertoken = $token;
        $event->user_id = $uid;
        $event->consultant_id = $id;
        $event->jobseekermeetlink = $callLink;
        $event->save();
    return response()->json([
        'token' => $token,
        'uid' => $uid,
        'callLink' => $callLink,  // Include call link in the response
        'success' => true,
        'message' => 'Token and call link generated successfully'
    ]);
}

private function generateAgoraToken($appId, $appCertificate, $channelName, $uid, $role, $privilegeExpiredTs)
{
    // Step 1: Set the token expiration timestamp
    $currentTimestamp = time();

    // Step 2: Create a message with the information to encode
    $msg = [
        'appid' => $appId,
        'channel' => $channelName,
        'uid' => $uid,
        'role' => $role,
        'expire' => $privilegeExpiredTs,
    ];

    // Step 3: Build the token signature using HMAC
    $msgJson = json_encode($msg);
    $compressedMsgJson = gzcompress($msgJson);
    // $signature = hash_hmac('sha256', $msgJson, $appCertificate);
    $signature = substr(hash_hmac('sha256', $msgJson, $appCertificate), 0, 16); // Shorten to 16 characters
    // Step 4: Create the token
    $token = base64_encode($compressedMsgJson . '.' . $signature);

    return $token;
}


public function getTokenSalon(Request $request, $salon)
{
    $salonInfo = Salon::where('name', $salon)->first();
    $appId = "d68157674b73485e8ce461ae2af71003";
    $appCertificate = "4cef74db59ff4244bb14a26dbd62cf47";
    $channelName = $salon;
    $uid = Auth::user()->id;
    $expirationTimeInSeconds = 86400;
    $currentTimeStamp = time();
    $privilegeExpiredTs = $currentTimeStamp + $expirationTimeInSeconds;

    $token = RtcTokenBuilder::buildTokenWithUid($appId, $appCertificate, $channelName, $uid, RtcTokenBuilder::RolePublisher, $privilegeExpiredTs);

    // Notify clients using Pusher
    $this->notifyClients('video-call-group-' . $salonInfo->name, 'client-group-video-call-started', [
        'callLink' => url("/room?channel={$salonInfo->id}&token=$token"),
        'actionValue' => $request->get('receiver_user_id')
    ]);

    return response()->json(['token' => $token, 'uid' => $uid]);
}

private function notifyClients($channel, $event, $data)
{
    $pusher = new Pusher(
        config('broadcasting.connections.pusher.key'),
        config('broadcasting.connections.pusher.secret'),
        config('broadcasting.connections.pusher.app_id'),
        [
            'cluster' => config('broadcasting.connections.pusher.options.cluster'),
            'useTLS' => false,
        ]
    );

    $pusher->trigger($channel, $event, $data);
}
}
