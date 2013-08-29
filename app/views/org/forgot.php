<?php include 'partials/header.php'; ?>


<div class="row">
    <div class="col-lg-6 col-lg-offset-3">
        <h1 class="page-header text-center mn">Forgot your password?</h1>
        <p class="lead">No problem! Enter your email address below, and we'll send you instructions on how to reset it.</p>

        <form class="placeholders mbx" method="post">

            <label for="email">Email Address</label>
            <input class="form-control required email" id="email" name="email"
                placeholder="Email Address" type="email" >

            <button class="btn btn-block btn-lg btn-primary" type="submit">Send Email</button>

            <?php echo Form::token(); ?>

        </form>

        <hr class="mb" />

        <p class="lead text-center">
            <span class="text-muted">Don't have an account?</span> <a href="/account/signup">Sign Up</a>
        </p>

    </div>
</div>

<?php include 'partials/footer.php'; ?>
