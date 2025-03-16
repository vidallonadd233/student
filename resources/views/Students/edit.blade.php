@include('landing.letter')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ isset($student) ? 'Edit Student' : 'Register Student' }}</div>

                <div class="card-body">
                    <!-- Check if we are editing or creating -->
                    <form action="{{ isset($student) ? route('students.update', $student->id) : route('students.store') }}" method="POST">
                        @csrf
                        @if(isset($student))
                            @method('PUT') <!-- Add PUT method for editing -->
                        @endif

                        <div class="mb-3 form-group">
                            <label for="student_number">Student Number:</label>
                            <input type="text" name="student_number" id="student_number" class="form-control" value="{{ old('student_number', isset($student) ? $student->student_number : '') }}" required>
                        </div>

                        <div class="mb-3 form-group">
                            <label for="grade_level">Grade Level:</label>
                            <input type="number" name="grade_level" id="grade_level" class="form-control" value="{{ old('grade_level', isset($student) ? $student->grade_level : '') }}" required>
                        </div>

                        <div class="mb-3 form-group">
                            <label for="age">Age:</label>
                            <input type="number" name="age" id="age" class="form-control" value="{{ old('age', isset($student) ? $student->age : '') }}" required>
                        </div>

                        <div class="mb-3 form-group">
                            <label for="gender">Gender:</label>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="gender" value="male" class="form-check-input" {{ (isset($student) && $student->gender == 'male') ? 'checked' : '' }} required> Male
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="gender" value="female" class="form-check-input" {{ (isset($student) && $student->gender == 'female') ? 'checked' : '' }} required> Female
                            </div>
                        </div>

                        <!-- Student ID field can be hidden or removed for editing, as it's a foreign key, you may use a different approach -->
                        <div class="mb-3 form-group">
                            <label for="student_id">Student ID :</label>
                            <input type="text" name="student_id" id="student_id" class="form-control" value="{{ old('student_id', isset($student) ? $student->student_id : '') }}" {{ isset($student) ? 'readonly' : '' }} required>
                        </div>

                        <button type="submit" class="btn btn-success">{{ isset($student) ? 'Update' : 'Register' }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
