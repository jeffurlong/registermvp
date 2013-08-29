<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>

    <h1>Welcome to {{$org}}!</h1>
    <h2>Your account has been created. Below is your account information.</h2>
    <p>Your account login page: <a href="{{$url}}/account/login">{{$url}}/account/login</a></p>
    <p>Your email address: {{$email}}</p>
    <p>Your password: ******** (<a href="{{$url}}/account/forgot">Forgot it?</a>)</p>
    <p>
        Thanks,<br />
        {{$org}}
    </p>
 </body>
</html>
