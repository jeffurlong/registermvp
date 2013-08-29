<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Reset Your Password</h2>

		<p>We received a request to reset the password associated with this e-mail address. If you
        made this request, please follow the instructions below.</p>

        <p>Click the link below to reset your password. The link is valid for one hour.</p>
        <p>{{ URL::to('account/reset', array($token)) }}</p>

        <p>If you did not request to reset your password, please disregard this email.</p>
        <p>Thanks,<br />MVP Registration</p>
	</body>
</html>
