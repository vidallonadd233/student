@include('landing.letter')
@extends('layout.app')

@section('title', 'Incident Reports')

@section('content')




@if(session('success'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: @json(session('success')),
                timer: 3000,
                showConfirmButton: false,
                toast: true,
                position: 'top-center'
            });
        });
    </script>

<!-- Calendar Section -->
<div id='calendar'></div>


<!-- Modal for Event Details -->
<div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="eventModalLabel">Guidance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.schedules.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="student_number" class="form-label">Student Number</label>
                        <input type="number" class="form-control" id="student_number" name="student_number" required>
                    </div>
                    <div class="mb-3">
                        <label for="grade_level" class="form-label">Grade Level</label>
                        <select class="form-control @error('grade_level') is-invalid @enderror" name="grade_level" id="grade_level" required>
                            <option value="" disabled selected>Select your grade level</option>
                            <option value="11">Grade 11</option>
                            <option value="12">Grade 12</option>
                        </select>
                        @error('grade_level')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="age" class="form-label">Age</label>
                        <input type="number" class="form-control @error('age') is-invalid @enderror" id="age" name="age" required>
                        @error('age')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="mb-3 w-45">
                            <label for="date" class="form-label">Date</label>
                            <input type="date" class="form-control" id="date" name="date" required>
                        </div>
                        <div class="mb-3 w-45">
                            <label for="time" class="form-label">Time</label>
                            <input type="time" class="form-control" id="time" name="time" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-control" id="gender" name="gender" required>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    var booking = @json($schedules);

    $(document).ready(function () {
        $('#calendar').fullCalendar({
            editable: true,
            header: {
                left: 'prev,next',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            events: booking.map(function (event) {
                return {
                    title: event.description,
                    start: event.date + 'T' + event.time,
                    student_number: event.student_number,
                    section: event.section,
                    age: event.age,
                    gender: event.gender,
                    description: event.description,
                    status: event.status
                };
            }),
            eventRender: function (event, element) {
                if (event.status === 'free') {
                    element.css('background-color', 'green');
                } else if (event.status === 'reschedule') {
                    element.css('background-color', 'yellow');
                } else if (event.status === 'done') {
                    element.css('background-color', '');
                }
                element.find('.fc-title, .fc-content').css('font-weight', 'normal');
            },
            selectable: true,
            select: function (start, end) {
                $('#eventModal').modal('show');
                $('#eventStart').val(start.format('YYYY-MM-DDTHH:mm'));
                $('#eventEnd').val(end.format('YYYY-MM-DDTHH:mm'));
            },
            eventClick: function (event) {
                $('#eventModal .modal-body').html(`
                    <form id="eventForm">
                        <div class="mb-3">
                            <label class="form-label">Student Number</label>
                            <input type="text" class="form-control" name="student_number" value="${event.student_number}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Gender</label>
                            <select class="form-control" name="gender" required>
                                <option value="male" ${event.gender == 'male' ? 'selected' : ''}>Male</option>
                                <option value="female" ${event.gender == 'female' ? 'selected' : ''}>Female</option>
                                <option value="other" ${event.gender == 'other' ? 'selected' : ''}>Other</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Age</label>
                            <input type="text" class="form-control" name="age" value="${event.age}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <input type="text" class="form-control" name="description" value="${event.description}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                `);
                $('#eventModal').modal('show');
            }
        });

        $('#eventForm').on('submit', function (e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: '/calendar-events',
                method: 'POST',
                data: formData,
                success: function () {
                    $('#eventModal').modal('hide');
                    location.reload();
                }
            });
        });
    });
</script>
@endsection
