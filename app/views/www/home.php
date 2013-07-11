<?php include 'partials/header.php'; ?>

<h1>Sign In to Your Account</h1>


<form method="post">
    <label for="email">Email Address</label>
    <input class="required email mb" id="email" name="email" placeholder="Email Address" type="email" value="">
    <label for="password">Password</label>
    <input class="required" id="password" name="password" placeholder="Password" type="password">
    <small class="help-block mb"><a href="/org/forgot">Forgot your password?</a></small>
    <button class="btn btn-large btn-block btn-primary" type="submit">Sign In</button>
</form>

<div>Need an account? <a href="/org/signup">Sign Up Now.</a></div>

<?php include 'partials/footer.php'; ?>

