<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>

    <h1>Welcome to {{$org}}!</h1>
    <h2>An account has been created for you. Below is your account information.</h2>
    <p>Your account login page: <a href="{{$url}}/account/login">{{$url}}/account/login</a></p>
    <p>Your email address: {{$email}}</p>
    <p>Your password: {{$password}}</p>
    <p>
        Thanks,<br />
        {{$org}}
    </p>
 </body>
</html>
