
<!-- Modal for Creating Report -->
<div class="modal fade" id="createReportModal" tabindex="-1" aria-labelledby="createReportModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createReportModalLabel">Create New Report Incident</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('report_incidents.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="student_number">Student Number</label>
                        <input type="number" class="form-control" id="student_number" name="student_number" required>
                    </div>

                    <div class="form-group">
                        <label for="age">Age</label>
                        <input type="number" class="form-control" id="age" name="age" required>
                    </div>

                    <div class="form-group">
                        <label for="report_date">Report Date</label>
                        <input type="date" class="form-control" id="report_date" name="report_date" required>
                    </div>

                    <div class="form-group">
                        <label for="category">Category</label>
                        <select class="form-control" id="category" name="category" required>
                            <option value="">Select Category</option>
                            <option value="Physical">Physical</option>
                            <option value="Verbal">Verbal</option>
                            <option value="Cyberbullying">Cyberbullying</option>
                            <option value="Social">Social</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="location">Location</label>
                        <input type="text" class="form-control" id="location" name="location" required>
                    </div>

                    <div class="form-group">
                        <label for="person_involved">Person Involved</label>
                        <input type="text" class="form-control" id="person_involved" name="person_involved" required>
                    </div>

                    <div class="form-group">
                        <label for="evidence">Evidence (optional)</label>
                        <input type="file" class="form-control" id="evidence" name="evidence">
                    </div>

                    <button type="submit" class="mt-4 btn btn-success">Submit Report</button>
                </form>
            </div>
        </div>
    </div>
</div>


