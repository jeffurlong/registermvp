<?php include __DIR__.'/../partials/header.php'; ?>

<div class="page-header">

    <h1 class="page-header-title">
        <i class="glyphicon glyphicon-cog"></i> General Settings
    </h1>

</div>

<div class="page-body page-body-narrow container">

    <form class="" id="settings-form" method="post">

        <div class="form-group">
            <label class="control-label" for="org_name">Organization Name</label>
            <input class="form-control required" id="org_name" name="name"
                type="text" value="<?php echo $org['name']; ?>" />
        </div>

        <div class="form-group">
            <label class="control-label" for="org_email">Customer Email</label>
            <input class="form-control required email" id="org_email" name="email"
                type="email" value="<?php echo $org['email']; ?>" />
            <div class="help-block">The email address where customers can reach you</div>
        </div>

        <div class="form-group">
            <label class="control-label" for="org_email">Customer Phone</label>
            <input class="form-control required" id="org_phone" name="phone"
                type="tel" value="<?php echo $org['phone']; ?>" />
            <span class="help-block">The phone number where customers can reach you</span>
        </div>

        <div class="form-group">
            <label class="control-label" for="org_name">Street Address</label>
            <input class="form-control required" id="org_street" name="street"
                type="text" value="<?php echo $org['street']; ?>" />

            <div class="row">
                <div class="col-md-5">
                    <label class="control-label" for="org_city">City</label>
                    <input class="form-control required" id="org_city" name="city"
                        type="text" value="<?php echo $org['city']; ?>" />
                </div>

                <div class="col-md-3">
                    <label class="control-label" for="org_state">State</label>
                    <select class="form-control required" id="org_state" name="state">
                        <option value=""></option>
                        <?php foreach($states as $k => $v): ?>
                            <option value="<?php echo $k; ?>" <?php if($org['state'] === $k) echo 'selected'; ?>>
                                <?php echo $v; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="control-label" for="org_zip">Zip Code</label>
                    <input class="form-control required" id="org_zip" name="zip"
                        type="text" value="<?php echo $org['zip']; ?>" />
                </div>
            </div>
            <?php echo Form::token(); ?>
            <input name="_method" type="hidden" value="PUT" />
        </div>

        <div class="form-group form-group-actions">
            <button class="btn btn-lg btn-xl btn-block btn-success" type="submit">
                <i class="glyphicon glyphicon-ok"></i> Save Settings
            </button>
        </div>

    </form>

</div>


<?php  include __DIR__.'/../partials/footer.php'; ?>
