<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Call Room</title>
    <script src="https://download.agora.io/sdk/release/AgoraRTC_N-4.17.0.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div id="video-streams"></div>
    <div id="controls">
        <button id="camera-btn">Toggle Camera</button>
        <button id="mic-btn">Toggle Mic</button>
        <button id="leave-btn">Leave Call</button>
    </div>
    <script src="{{ asset('js/agora-video-call.js') }}"></script>
</body>
</html>