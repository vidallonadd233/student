
    @include('landing.letter')

    @extends('layouts.app')


    @section('title', 'Calendar')

    @section('content')

    <!-- Calendar Section -->
    <div id='calendar'>

        @if(session('toast_success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: "{{ session('toast_success') }}",
                timer: 3000,
                showConfirmButton: false,
                toast: true,
                position: 'center'
            });
        </script>
    @endif
    </div>



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




    @endsection
    <script>
        $(document).ready(function () {
            var booking = @json($schedules);

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
                        end: event.date + 'T' + event.time,
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
                        <form id="eventForm" action="{{ route('admin.schedules.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="student_number" class="form-label">Student Number</label>
                                <input type="number" class="form-control" id="student_number" name="student_number" required>
                            </div>
                            <div class="mb-3">
                                <label for="grade_level" class="form-label">Grade Level</label>
                                <select class="form-control" name="grade_level" id="grade_level" required>
                                    <option value="" disabled selected>Select your grade level</option>
                                    <option value="11">Grade 11</option>
                                    <option value="12">Grade 12</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="age" class="form-label">Age</label>
                                <input type="number" class="form-control" id="age" name="age" required>
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
                    `);
                    $('#eventModal').modal('show');

                    // Ensure only one event listener is attached
                    $('#eventForm').off('submit').on('submit', function (e) {
                        e.preventDefault();
                        var formData = new FormData(this);

                        $.ajax({
                            url: "{{ route('admin.schedules.store') }}",
                            method: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            headers: {
                                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
                            },
                            success: function (response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: 'Schedule successfully created!',
                                    timer: 3000,
                                    showConfirmButton: false,
                                    toast: true,
                                    position: 'top-end'
                                });

                                $('#eventModal').modal('hide');
                                $('#calendar').fullCalendar('refetchEvents'); // Reload calendar events
                            },
                            error: function (xhr) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: 'Failed to create the schedule. Please try again.',
                                    showConfirmButton: true
                                });
                            }
                        });
                    });
                }
            });
        });

        document.addEventListener("DOMContentLoaded", function () {
        const form = document.querySelector("#eventModal form");

        form.addEventListener("submit", function (event) {
            event.preventDefault(); // Prevent default form submission

            // Perform AJAX request (optional) or submit the form normally
            fetch(form.action, {
                method: "POST",
                body: new FormData(form),
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Schedule successfully created!"); // Success alert

                    // Optionally, close the modal
                    let modal = bootstrap.Modal.getInstance(document.getElementById("eventModal"));
                    modal.hide();

                    // Reset the form
                    form.reset();
                } else {
                    alert("An error occurred. Please try again.");
                }
            })
            .catch(error => console.error("Error:", error));
        });
    });
    </script>
