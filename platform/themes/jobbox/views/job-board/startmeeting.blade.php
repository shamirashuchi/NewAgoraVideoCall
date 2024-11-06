<!-- <!DOCTYPE html>
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
</html> -->


<!-- Video Call Interface -->
<div id="video-call-container">
    <div id="video-streams">
        <!-- Placeholder for video streams -->
        <div class="video-frame">
            <p>{{ $consultantdetails->first_name }}</p>
            <video autoplay muted></video>
        </div>
        <div class="video-frame">
        @php
        $account = auth('account')->user();
    @endphp
            <p>{{ $account->first_name}}</p>
            <video autoplay></video>
        </div>
    </div>
    <div id="controls">
        <button id="camera-btn" class="control-btn"><i class="bi bi-camera-video"></i> Camera</button>
        <button id="mic-btn" class="control-btn"><i class="bi bi-mic"></i> Mic</button>
        <button id="leave-btn" class="control-btn leave-btn"><i class="bi bi-box-arrow-right"></i> Leave</button>
    </div>
</div>

<!-- Add Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    /* Styling for the video call container */
    #video-call-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin: 20px auto;
        max-width: 90%;
        background-color: #2c2f33;
        border-radius: 12px;
        padding: 15px;
    }

    /* Video streams container */
    #video-streams {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
        justify-content: center;
        margin-bottom: 20px;
        background-color: #23272a;
        border-radius: 8px;
        padding: 10px;
        width: 100%;
    }

    .video-frame {
        display: flex;
        flex-direction: column;
        align-items: center;
        background-color: #2f3136;
        border: 2px solid #7289da;
        border-radius: 8px;
        padding: 5px;
        width: 300px;
        height: 200px;
        position: relative;
        overflow: hidden;
    }

    .video-frame p {
        position: absolute;
        top: 5px;
        left: 5px;
        color: #fff;
        font-size: 14px;
        margin: 0;
    }

    video {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 6px;
    }

    /* Controls container */
    #controls {
        display: flex;
        gap: 15px;
        justify-content: center;
    }

    .control-btn {
        background-color: #7289da;
        color: #fff;
        border: none;
        border-radius: 6px;
        padding: 10px 15px;
        font-size: 16px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 5px;
        transition: background-color 0.3s;
    }

    .control-btn:hover {
        background-color: #5a6cae;
    }

    .leave-btn {
        background-color: #f04747;
    }

    .leave-btn:hover {
        background-color: #d83c3e;
    }
</style>
