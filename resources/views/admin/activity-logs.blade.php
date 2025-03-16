@extends('layout.jam') <!-- Extends the main layout -->

@section('title', 'Incident Reports') <!-- Override title for this page -->

@section('content') <!-- Page-specific content -->
<div class="container ">
    @if(session('success'))
        <!-- Success Message -->
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <h2 class="mb-5 text-center fs-5">Activity Logs</h2> <!-- Section Heading -->

    <!-- Search Bar with Live Preview -->
    <form method="GET" action="{{ route('admin.activity-log') }}">
        <div class="mb-4 row">
            <div class="col-md-6"> <!-- Aligns the form to the left side -->
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search by Description or Date..." name="search" value="{{ request('search') }}" />
                    <button class="btn btn-primary" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </form>


    <!-- Real-time Preview of Search Results -->
    <div id="logResults" class="table-responsive">
        <table class="table align-middle table-striped table-hover" id="logsTable">
            <thead class="table-light">
                <tr>
                    <th class="fw-normal">#</th> <!-- ID Column -->
                    <th class="fw-normal">Description</th> <!-- Description Column -->
                    <th class="fw-normal">Created At</th>
                    <th class="fw-normal">Action</th><!-- Created At Column -->
                </tr>
            </thead>
            <tbody>
                @forelse ($logs as $log)
                    <tr class="logRow">
                        <td>{{ $log->id }}</td> <!-- Log ID -->
                        <td>{{ $log->description }}</td> <!-- Log Description -->
                        <td>{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                            <td>

                                    <button class="btn btn-danger btn-sm delete-log">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">No activity logs found.</td> <!-- No Logs Message -->
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination Links -->
    <div class="mt-4 d-flex justify-content-center">
        {{ $logs->links('vendor.pagination.bootstrap-5') }}
    </div>
</div>

<script>
    // Search Function for Live Preview
    function searchLogs() {
        let input = document.getElementById("searchBar");
        let filter = input.value.toLowerCase();
        let rows = document.querySelectorAll(".logRow");
        rows.forEach(row => {
            let description = row.cells[1].textContent.toLowerCase();
            let createdAt = row.cells[2].textContent.toLowerCase();
            if (description.indexOf(filter) > -1 || createdAt.indexOf(filter) > -1) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }

    document.addEventListener("DOMContentLoaded", function () {
        // Attach click event to all delete buttons
        document.querySelectorAll('.delete-log').forEach(button => {
            button.addEventListener('click', function () {
                if (confirm("Are you sure you want to delete this log?")) {
                    this.closest('tr').remove(); // Remove the row from the table
                }
            });
        });
    });


</script>

@endsection
