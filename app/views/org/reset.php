<?php include 'partials/header.php'; ?>

<div class="row">
    <div class="col-md-6 col-md-offset-3">

        <h1 class="page-header text-center">Reset Your Password</h1>

        <form class="placeholders" method="post">

            <label for="email">Your Email Address</label>
            <input class="form-control email required" id="email" name="email"
                placeholder="Your email address" type="email"  />

            <label for="password">Enter a New Password</label>
            <input class="form-control required" data-mvp-role="confirm-input"
                data-mvp-target="#confirm" id="password" minlength="8" name="password"
                placeholder="Enter a New password" type="password"  />

            <div class="hider" id="confirm">
                <label for="password_confirmation">Confirm Your New Password</label>
                <input class="form-control required" equalto="#password" id="password_confirmation"
                    name="password_confirmation" placeholder="Confirm Your New Password"
                    type="password" />
            </div>

            <button class="btn btn-block btn-primary btn-lg" type="submit">
                Reset Password and Sign In
            </button>

            <input type="hidden" name="token" value="<?php echo $token; ?>" />

            <?php echo Form::token(); ?>
        </form>

    </div>
</div>

<?php include 'partials/footer.php'; ?>
