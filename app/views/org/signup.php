<?php include 'partials/header.php'; ?>


<h1 class="page-header text-center">Create your account</h1>

<div class="row">

    <div class="col-md-6 col-md-offset-3">

        <form class="placeholders mbx" method="post">
            <div class="row">
                <div class="col-md-6">
                        <label for="first_name">First Name</label>
                        <input class="form-control required" id="first_name" name="first_name"
                            placeholder="First Name" type="text" />

                </div>
                <div class="col-md-6">
                        <label for="last_name">Last Name</label>
                        <input class="form-control required" id="last_name" name="last_name"
                            placeholder="Last Name" type="text" />

                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="email">Email</label>
                    <input class="form-control email required" id="email" name="email"
                        placeholder="Email" type="email" />
                </div>
                <div class="col-md-6">
                    <label for="phone">Phone #</label>
                    <input class="form-control equired" id="phone" name="phone"
                        placeholder="Phone #" type="tel" />
                </div>
            </div>

            <label for="password">Password</label>
            <input class="form-control required" data-mvp-role="confirm-input"
                data-mvp-target="#confirm" id="password" minlength="8" name="password"
                placeholder="Password" type="password" />

            <div class="hider" id="confirm">
                <label for="confirm_password">Confirm Your Password</label>
                <input class="form-control required" equalto="#password" id="confirm_password"
                    name="confirm_password" placeholder="Confirm Your Password" type="password" />
            </div>

            <button class="btn btn-block btn-lg btn-primary" type="submit">Sign Up</button>

            <?php echo Form::token(); ?>

        </form>

        <hr class="mb" />

        <p class="lead text-center">
            <span class="text-muted">Already have an account?</span> <a href="/account/login">Log In</a>
        </p>
    </div>
</div>

<?php include 'partials/footer.php'; ?>
