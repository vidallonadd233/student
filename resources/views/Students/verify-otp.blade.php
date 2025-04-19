@include('')

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="col-md-6">
        <div class="card shadow rounded-4">
            <div class="card-body p-5">
                <h4 class="text-center mb-4">OTP Verification</h4>

                <form method="POST" action="{{ route('otp.verify') }}">
                    @csrf

                    <input type="hidden" name="student_number" value="{{ $student_number }}">

                    <div class="form-floating mb-4">
                        <input type="text" name="otp" id="otp" class="form-control" placeholder="Enter OTP" required>
                        <label for="otp">Enter OTP</label>
                    </div>

                    <button type="submit" class="btn btn-success w-100">Verify OTP</button>

                    @if(isset($otp))
                        <div class="mt-3 text-center text-muted">
                            <small><strong>Test OTP:</strong> {{ $otp }}</small>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
