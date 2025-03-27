<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #f9f9f9;">
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card shadow-lg" style="max-width: 500px; width: 100%; border-radius: 10px;">
            <div class="card-body text-center p-4">
                <h2 class="text-primary fw-bold">Proton</h2>
                <h5 class="mt-3 fw-semibold">Verify your email to continue to Proton</h5>
                <div class="my-3">
                    <img src="https://via.placeholder.com/150" alt="Email Verification" class="img-fluid">
                </div>
                <p class="mb-3">Your account <strong>{{ $email }}</strong> is almost ready to use.</p>
                <p>To continue to Proton, please secure your account by verifying your email address.</p>
                <a href="{{ $verificationUrl }}" class="btn btn-primary btn-lg mt-2">Verify email address</a>
                <p class="mt-4 text-muted">Thank you for choosing Proton.<br>Stay secure,<br>The Proton Team</p>
                <hr>
                <p class="text-muted">You are receiving this email because you created a Proton account.<br>
                Didn't create a Proton Account? <a href="#">Report here</a></p>
                <p class="text-muted small">&copy; 2025 Proton AG, Switzerland<br>
                Route de la Galaise 32, 1228 Plan-les-Ouates, Geneva, Switzerland</p>
            </div>
        </div>
    </div>
</body>
</html>
