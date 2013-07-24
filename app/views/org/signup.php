<?php include 'partials/header.php'; ?>


<h1 class="page-header text-center">Sign up for your FREE account</h1>

<div class="row">

    <div class="col-lg-8 col-offset-2">

        <form class="placeholders mbx" method="post">

            <label for="email">Email Address</label>
            <input class="required email" id="email" name="email" placeholder="Email Address"
                type="text" >

            <label for="password">Password</label>
            <input class="required" id="password" name="password" placeholder="Password"
                type="password">

            <div class="row">
                <div class="col-lg-5">
                    <a class="link-btn btn-large btn-block text-muted" href="/org/forgot">
                        <small>Forgot your password?</small>
                    </a>
                 </div>

                <div class="col-lg-7">
                    <button class="btn btn-block btn-large btn-primary" type="submit">
                        Log In
                    </button>
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
