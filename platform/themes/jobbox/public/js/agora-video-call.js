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