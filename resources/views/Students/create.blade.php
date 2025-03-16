@include('landing.letter')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Register Student</div>

                <div class="card-body">
                    <form action="{{ route('students.store') }}" method="POST">
                        @csrf
                        <div class="mb-3 form-group">
                            <label for="student_number">Student Number:</label>
                            <input type="text" name="student_number" id="student_number" class="form-control" required>
                        </div>

                        <div class="mb-3 form-group">
                            <label for="grade_level">Grade Level:</label>
                            <input type="number" name="grade_level" id="grade_level" class="form-control" required>
                        </div>

                        <div class="mb-3 form-group">
                            <label for="age">Age:</label>
                            <input type="number" name="age" id="age" class="form-control" required>
                        </div>

                        <div class="mb-3 form-group">
                            <label for="gender">Gender:</label>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="gender" value="male" class="form-check-input" required> Male
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="gender" value="female" class="form-check-input" required> Female
                            </div>
                        </div>

                        <div class="mb-3 form-group">
                            <label for="student_id">Student ID (Foreign Key):</label>
                            <input type="text" name="student_id" id="student_id" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-success">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

