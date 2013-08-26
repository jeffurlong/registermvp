<?php include 'partials/header.php'; ?>


<h1 class="page-header text-center">Log in to your account</h1>

<div class="row">

    <div class="col-lg-6 col-lg-offset-3">

        <form class="placeholders mbx" method="post">
            <div class="form-group">
                <label for="email">Email Address</label>
                <input class="form-control required email" id="email" name="email"
                    placeholder="Email Address" type="email" value="<?php echo $email; ?>" />
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control required" id="password" name="password"
                    placeholder="Password" type="password" />
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <a class="link-forgot" href="/org/forgot">Forgot your password?</a>
                 </div>

                <div class="col-lg-8">
                    <button class="btn btn-block btn-lg btn-primary" type="submit">Log In</button>
                </div>
            </div>

            <?php echo Form::token(); ?>

        </form>

        <hr class="mb" />

        <p class="lead text-center">
            <span class="text-muted">Don't have an account?</span> <a href="/org/signup">Sign Up</a>
        </p>
    </div>
</div>

<?php include 'partials/footer.php'; ?>
