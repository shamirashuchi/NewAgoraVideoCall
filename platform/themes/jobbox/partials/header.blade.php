<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=5, user-scalable=1"
        name="viewport" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        . {
            margin-top: 100px;
            height: 100px;
            background-color: white;
        }
    </style>
    {!! Theme::partial('theme-meta') !!}
    {!! Theme::header() !!}

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    {{-- @include('sweetalert::alert') --}}
    <script src="https://download.agora.io/sdk/release/AgoraRTC_N-4.17.0.js"></script>
    <script>
        const APP_ID = "YOUR_AGORA_APP_ID";
const TOKEN = sessionStorage.getItem('token');
const CHANNEL = sessionStorage.getItem('room');
let UID = sessionStorage.getItem('UID');
let NAME = sessionStorage.getItem('name');

const client = AgoraRTC.createClient({ mode: 'rtc', codec: 'vp8' });

let localTracks = {
    audioTrack: null,
    videoTrack: null,
};
let remoteUsers = {};

// Initialize and join the channel
async function initializeCall() {
    await joinAndDisplayLocalStream();
    setupEventListeners();
}

// Join the channel and display local stream
async function joinAndDisplayLocalStream() {
    try {
        UID = await client.join(APP_ID, CHANNEL, TOKEN, UID);
        console.log(`Joined channel with UID: ${UID}`);
        
        localTracks.audioTrack = await AgoraRTC.createMicrophoneAudioTrack();
        localTracks.videoTrack = await AgoraRTC.createCameraVideoTrack();
        
        displayLocalStream();
        await client.publish(Object.values(localTracks));
    } catch (error) {
        console.error('Error joining Agora channel:', error);
    }
}

// Display local stream
function displayLocalStream() {
    let player = `<div class="video-container" id="user-container-${UID}">
                     <div class="video-player" id="user-${UID}"></div>
                     <div class="username-wrapper"><span class="user-name">${NAME}</span></div>
                  </div>`;
    document.getElementById('video-streams').insertAdjacentHTML('beforeend', player);
    localTracks.videoTrack.play(`user-${UID}`);
}

// Set up event listeners
function setupEventListeners() {
    client.on('user-published', handleUserJoined);
    client.on('user-left', handleUserLeft);
    document.getElementById('leave-btn').addEventListener('click', leaveAndRemoveLocalStream);
    document.getElementById('camera-btn').addEventListener('click', toggleCamera);
    document.getElementById('mic-btn').addEventListener('click', toggleMic);
}

// Handle remote user joining
async function handleUserJoined(user, mediaType) {
    remoteUsers[user.uid] = user;
    await client.subscribe(user, mediaType);

    if (mediaType === 'video') {
        displayRemoteStream(user);
    }

    if (mediaType === 'audio') {
        user.audioTrack.play();
    }
}

// Display remote stream
function displayRemoteStream(user) {
    let player = `<div class="video-container" id="user-container-${user.uid}">
                    <div class="video-player" id="user-${user.uid}"></div>
                    <div class="username-wrapper"><span class="user-name">Remote User</span></div>
                  </div>`;
    document.getElementById('video-streams').insertAdjacentHTML('beforeend', player);
    user.videoTrack.play(`user-${user.uid}`);
}

// Handle remote user leaving
function handleUserLeft(user) {
    delete remoteUsers[user.uid];
    document.getElementById(`user-container-${user.uid}`).remove();
}

// Leave the channel and remove local stream
async function leaveAndRemoveLocalStream() {
    for (let track of Object.values(localTracks)) {
        if (track) {
            track.stop();
            track.close();
        }
    }
    await client.leave();
    document.getElementById(`user-container-${UID}`).remove();
}

// Toggle camera
async function toggleCamera(e) {
    if (localTracks.videoTrack) {
        await localTracks.videoTrack.setEnabled(!localTracks.videoTrack.enabled);
        e.target.style.backgroundColor = localTracks.videoTrack.enabled ? '#fff' : 'rgb(255, 80, 80, 1)';
    }
}

// Toggle microphone
async function toggleMic(e) {
    if (localTracks.audioTrack) {
        await localTracks.audioTrack.setEnabled(!localTracks.audioTrack.enabled);
        e.target.style.backgroundColor = localTracks.audioTrack.enabled ? '#fff' : 'rgb(255, 80, 80, 1)';
    }
}

// Initialize the call when the page loads
initializeCall();
    </script>







</head>

<body @if (BaseHelper::siteLanguageDirection() == 'rtl') dir="rtl" @endif>
    {!! apply_filters(THEME_FRONT_BODY, null) !!}

    <div id="alert-container"></div>

    @if (empty($withoutNavbar))
        {!! Theme::partial('navbar') !!}
    @endempty

    <main class="main">
