<?php include 'partials/header.php'; ?>

<div class="text-center">

    <?php if(Session::has('reset')): ?>

        <h1><?php echo Lang::get('reminders.success'); ?></h1>

    <?php else: ?>

        <h1>You are now logged out.</h1>
        <p class="lead">Thanks for using MVP.</p>

    <?php endif; ?>

    <p class="lead"><a href="/org/login">Log back in</a></p>

</div>

<?php include 'partials/footer.php'; ?>
