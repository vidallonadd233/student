@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Archived Students</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Student Number</th>
                <th>Grade Level</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
            <tr>
                <td>{{ $student->student_number }}</td>
                <td>{{ $student->grade_level }}</td>
                <td>{{ $student->age }}</td>
                <td>{{ $student->gender }}</td>
                <td>
                    <a href="{{ route('students.restore', $student->id) }}" class="btn btn-success">Restore</a>
                    <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Permanently Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $students->links() }}
</div>
@endsection
