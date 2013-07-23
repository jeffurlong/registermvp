<?php include 'partials/header.php'; ?>


<h1 class="page-header">Log in to your account</h1>

<div class="row">
<div class="col-lg-6 col-offset-3">
<form class="placeholders" method="post">
    <label for="email">Email Address</label>
    <input class="required email mb" id="email" name="email" placeholder="Email Address" type="text" value="<?php //echo $email; ?>">
    <label for="password">Password</label>
    <input class="required" id="password" name="password" placeholder="Password" type="password">
    <small class="help-block mbx">
    <a href="/org/forgot">Forgot your password?</a>
    </small>
    <button class="btn btn-block btn-large btn-primary" type="submit">Sign In</button>
    <?php echo Form::token(); ?>
</form>
</div>
</div>
<?php include 'partials/footer.php'; ?>

