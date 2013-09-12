<?php include __DIR__.'/../partials/header.php'; ?>

<div class="page-header">

    <h1 class="page-header-title">
        <i class="glyphicon glyphicon-cog"></i> General Settings
    </h1>

</div>

<div class="page-body container">
    <form class="bypass" id="settings-form" method="post">
        <div class="row">
            <div class="col-md-6">
                <label class="control-label" for="org_name">Organization Name</label>
                <input class="form-control required" id="org_name" name="org_name"
                    type="text" value="<?php echo $org['name']; ?>" />
                <label class="control-label" for="org_customer_email">Customer Email</label>
                <input class="form-control required" id="org_customer_email" name="org_customer_email"
                    type="text" value="<?php echo $org['customer_email']; ?>" />
                <div class="help-block">The email where customers can reach you</div>
            </div>
        </div>
    </form>

</div>


<?php  include __DIR__.'/../partials/footer.php'; ?>
