<style>
    .left-side {
        border: 1px solid rgba(200, 200, 200, 0.5); /* Softer gray for a modern touch */
        border-radius: 8px; /* Rounded corners for a premium feel */
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Softer shadow for depth */
        background-color: #ffffff; /* Clean white background for contrast */
        padding: 15px; /* Add padding for better content spacing */
        transition: transform 0.3s ease, box-shadow 0.3s ease; /* Smooth transitions */
    }

    .left-side:hover {
        transform: translateY(-2px); /* Slight lift effect on hover */
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.2); /* Enhanced shadow on hover */
    }
</style>
<?php
    $account = auth('account')->user()->id;
?>

<div class="container" style="margin-top:80px;">
    <div class="row justify-content-center">

        <div class="col-md-3 text-center mb-3 mb-md-0">
            <div class="left-side mb-80">
                <img src="{{ $consultantdetails->avatar_url }}" alt="User Profile Picture" class="img-fluid">
                <p class="mt-10">Name: {{ $consultantdetails->first_name }} {{ $consultantdetails->last_name }}</p>
                <p class="mt-10">Gender: {{ $consultantdetails->gender }} </p>
                <div>
                <h6 id="start-meeting-btn" class="btn rounded-pill fw-bold text-white mt-20 mb-10 px-4 py-2" style="background: rgba(5, 38, 78, 1);">
    <a id="meeting-link" class="text-white" href="#" target="_blank" rel="noopener noreferrer">
        Meet
    </a>
</h6>
                    <!-- id="start-meeting-btn" -->
                    <!-- {{ route('startmeeting', ['id' => $consultantdetails->id]) }} -->
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div>
            <h2>Available Times for Consultants</h2>
            <hr>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Available Date</th>
            <th>Available Times</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>November 6, 2024</td>
            <td>
                <ul>
                    <li>09:00 AM</li>
                    <li>10:00 AM</li>
                    <li>01:00 PM</li>
                    <li>03:00 PM</li>
                </ul>
            </td>
        </tr>
        <tr>
            <td>November 7, 2024</td>
            <td>
                <ul>
                    <li>10:00 AM</li>
                    <li>12:00 PM</li>
                    <li>02:00 PM</li>
                    <li>04:00 PM</li>
                </ul>
            </td>
        </tr>
        <tr>
            <td>November 8, 2024</td>
            <td>
                <ul>
                    <li>09:00 AM</li>
                    <li>11:00 AM</li>
                    <li>01:00 PM</li>
                    <li>05:00 PM</li>
                </ul>
            </td>
        </tr>
        <tr>
            <td>November 9, 2024</td>
            <td>
                <ul>
                    <li>10:00 AM</li>
                    <li>12:00 PM</li>
                    <li>03:00 PM</li>
                    <li>04:00 PM</li>
                </ul>
            </td>
        </tr>
    </tbody>
</table>

                <h2>Schedule a Meeting</h2>
                <hr>
                <!-- <p class="mt-6 fw-bold">Introduction</p>
                <p style="text-align: justify;">{{ $consultantdetails->description }}</p>
                <p class="mt-6 fw-bold pt-10">Objectives</p>
                <p style="text-align: justify;">{!! $consultantdetails->bio !!}</p> -->
                <form action="/schedule-meeting" method="POST">
    @csrf <!-- Include this for Laravel CSRF protection -->
    
    <div class="form-group">
        <label for="meeting-date">Select Date:</label>
        <input type="date" class="form-control" id="meeting-date" name="meeting_date" required>
    </div>
    
    <div class="form-group">
        <label for="meeting-time">Select Time:</label>
        <input type="time" class="form-control" id="meeting-time" name="meeting_time" required>
    </div>
    
    <div class="form-group">
        <label for="additional-notes">Additional Notes:</label>
        <textarea class="form-control" id="additional-notes" name="additional_notes" rows="4" placeholder="Any additional information..."></textarea>
    </div>
    
    <button type="submit" class="btn btn-primary">Schedule Meeting</button>
</form>
            </div>
            
            <script>
document.getElementById('start-meeting-btn').addEventListener('click', async (event) => {
    event.preventDefault();

    console.log("hello");

    const channel = Date.now();
 
    const consultantId =  '{{ $consultantdetails->id }}';
    await createMeeting(consultantId,channel);
});

async function createMeeting(consultantId,channel) {
    try {
        let account = {!! json_encode($account) !!};
        console.log(account);
        const endpoint = `/consultantdetails/${consultantId}/createmeeting`;
        const response = await fetch(endpoint, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
    channel: channel,
    account: account  // Correctly embedding PHP variable into JavaScript
})
        });

        const data = await response.json();
        console.log('Meeting created:', data.callLink);
        console.log('Meeting created:', data.uid);

        // Update the href of the <a> tag with the generated meeting link
        const meetingLinkElement = document.getElementById('meeting-link');
        meetingLinkElement.href = data.meeting_link;

        // Store data in sessionStorage or use it as needed
        sessionStorage.setItem('token', data.token);
        sessionStorage.setItem('room', channel);
        sessionStorage.setItem('meetingLink', data.calllink);
        sessionStorage.setItem('uid', data.uid);
    } catch (error) {
        console.error('Error creating meeting:', error);
    }
}
</script>

