
@extends(JobBoardHelper::viewPath('dashboard.layouts.master'))

@section('content')
<form action="" method="POST">
    @csrf
    <div class="mb-3">
        <label for="day" class="form-label">Day</label>
        <select id="day" name="day" class="form-select" required>
            <option value="Sunday">Sunday</option>
            <option value="Monday">Monday</option>
            <option value="Tuesday">Tuesday</option>
            <option value="Wednesday">Wednesday</option>
            <option value="Thursday">Thursday</option>
            <option value="Friday">Friday</option>
            <option value="Saturday">Saturday</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="year" class="form-label">Year</label>
        <input type="number" id="year" name="year" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="date" class="form-label">Date</label>
        <input type="date" id="date" name="date" class="form-control" required onchange="updateDayAndYear()">
    </div>

    <div class="mb-3">
        <label for="time" class="form-label">Time</label>
        <input type="time" id="time" name="time" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<script>
function updateDayAndYear() {
    const dateInput = document.getElementById('date').value;
    if (dateInput) {
        const date = new Date(dateInput);
        
        document.getElementById('year').value = date.getFullYear();

        const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        const dayName = days[date.getDay()];

        document.getElementById('day').value = dayName;
    }
}
</script>

@endsection
