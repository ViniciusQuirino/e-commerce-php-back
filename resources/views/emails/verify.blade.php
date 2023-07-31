<!DOCTYPE html>
<html>
<head>
    <title>Email Verification</title>
</head>
<body>
    <h2>Hello {{ $user->name }},</h2>
    <p>Thank you for registering. Please click the link below to verify your email address:</p>
    <a href="{{ url('http://localhost:5174/verify-email/' . $user->email_verification_token) }}">Verify Email</a>
</body>
</html>