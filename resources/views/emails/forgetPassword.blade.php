<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>
    <p>Hello!</p>
    <p>You requested to reset your password.</p>
    <p>Click on the link below to reset your password:</p>
    <a href="{{ url('http://localhost:5174/forget-password/' . $user->token_forget_password) }}">Reset Password</a>
    <p>If you did not request a password reset, you can ignore this email.</p>
</body>
</html>