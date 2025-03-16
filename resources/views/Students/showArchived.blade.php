@extends('layout.app')
<style>
        .success-alert {
        width: 50%;
        margin: 0 auto;
        text-align: center;
    }
</style>

@section('content')
<div class="container ">
    <h1 class="fw-normal fs-5 text-center">Archived Students</h1>

    @if(session('success'))
    <div class="alert alert-success text-center mx-auto w-50">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped mt-5">
        <thead>


                    <th class="fw-normal text-center">Student Number</th>
                    <th class="fw-normal text-center">Grade Level</th>
                    <th class="fw-normal text-center">Age</th>
                    <th class="fw-normal text-center">Gender</th>

                    <th class="fw-normal text-center">Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($student as $student)
                <tr>
                    <td class="fs-6 text-center">{{ $student->student_number }}</td>
                    <td class="fs-6 text-center">{{ $student->grade_level }}</td>
                    <td class="fs-6 text-center">{{ $student->age }}</td>
                    <td class="fs-6 text-center">{{ $student->gender }}</td>

                    <td class="fs-6 text-center">
                        <form action="{{ route('students.restore', $student->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-warning">
                                <i class="bi bi-arrow-clockwise"></i>
                            </button>
                        </form>


                        <form action="{{ route('students.destroy',  $student->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to permanently delete this student?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>



    </table>

</div>
@endsection
