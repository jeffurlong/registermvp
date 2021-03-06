<?php include __DIR__.'/../partials/header.php'; ?>

<div class="page-header">

    <h1 class="page-header-title">
        <i class="glyphicon glyphicon-user"></i>
        <a href="/admin/customers" class="text-muted">Customers</a> /
        <?php if($customer->exists): ?>
            <?php echo $customer->first_name.' '.$customer->last_name; ?>
        <?php elseif( ! $customer->master_id): ?>
            New customer account
        <?php else: ?>
            Add member to <?php echo $master->first_name.' '.possessive($master->last_name); ?> account
        <?php endif; ?>
    </h1>

    <div class="page-header-tools pull-right">
        <a href="/admin/customers<?php if ($customer->exists) echo'/show/'.$customer->id; ?>" class="btn btn-default" data-toggle="tooltip" title="Cancel">
            <i class="glyphicon glyphicon-ban-circle"></i>
        </a>
       <button class="btn btn-primary" data-toggle="tooltip" title="Save customer"
            data-act="submit" data-target="#customer-form">
            <i class="glyphicon glyphicon-ok"></i>
        </button>
    </div>
</div>

<div class="page-body container">

    <form id="customer-form" method="post">

        <div class="form-group row">
            <div class="col-md-4">
                <label class="control-label" for="first_name">First Name <span class="required">(required)</span></label>
                <input class="form-control required" id="first_name" name="first_name" type="text"
                    value="<?php echo $customer->first_name; ?>" />
            </div>

            <div class="col-md-4">
                 <label class="control-label" for="last_name">Last Name <span class="required">(required)</span></label>
                <input class="form-control required" id="last_name" name="last_name" type="text"
                    value="<?php echo $customer->last_name; ?>" />
            </div>

            <div class="col-md-4">
                <label class="control-label" for="gender">Gender</label>
                <select class="form-control" id="gender" name="gender">
                    <option value=""></option>
                    <option vlaue="M" <?php if($customer->gender === "M") echo "selected"; ?>>Male</option>
                    <option vlaue="F" <?php if($customer->gender === "F") echo "selected"; ?>>Female</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-4">
                <label class="control-label" for="email">Email Address <?php if($is_master) echo '<span class="required">(required)</span>'; ?></label>
                <input class="form-control email <?php if($is_master) echo 'required'; ?>" id="email" name="email" type="email"
                    value="<?php echo $customer->email; ?>" <?php if (Session::has('error')) echo 'autofocus'; ?>/>
            </div>

            <div class="col-md-4">
                 <label class="control-label" for="phone">Phone Number <?php if($is_master) echo '<span class="required">(required)</span>'; ?></label>
                <input class="form-control <?php if($is_master) echo 'required'; ?>" id="phone" name="phone" type="tel"
                    value="<?php echo $customer->phone; ?>" />
            </div>

             <div class="col-md-4">
                    <label class="control-label" for="dob">Date of Birth</label>
                    <input class="form-control date datepicker-dob" id="dob" name="dob" type="text"
                        value="<?php echo $customer->dob; ?>" />
                </div>
        </div>


        <div class="form-group">
            <label class="control-label" for="street">Street Address <?php if($is_master) echo '<span class="required">(required)</span>'; ?></label>
            <input class="form-control <?php if($is_master) echo 'required'; ?>" id="street" name="street"
                type="text" value="<?php echo $customer->street; ?>" />

            <div class="row">
                <div class="col-md-5">
                    <label class="control-label" for="city">City <?php if($is_master) echo '<span class="required">(required)</span>'; ?></label>
                    <input class="form-control <?php if($is_master) echo 'required'; ?>" id="city" name="city"
                        type="text" value="<?php echo $customer->city; ?>" />
                </div>

                <div class="col-md-3">
                    <label class="control-label" for="state">State <?php if($is_master) echo '<span class="required">(required)</span>'; ?></label>
                    <select class="form-control <?php if($is_master) echo 'required'; ?>" id="state" name="state">
                        <option value=""></option>
                        <?php foreach(form_states() as $k => $v): ?>
                            <option value="<?php echo $k; ?>"
                                <?php if($customer->state === $k) echo 'selected'; ?>>
                                <?php echo $v; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="control-label" for="zip">Zip Code <?php if($is_master) echo '<span class="required">(required)</span>'; ?></label>
                    <input class="form-control <?php if($is_master) echo 'required'; ?>" id="zip" name="zip"
                        type="text" value="<?php echo $customer->zip; ?>" />
                </div>
            </div>
        </div>

        <input name="id" id="record_id" type="hidden" value="<?php echo $customer->id; ?>" />
        <input name="master_id" id="master_id" type="hidden" value="<?php echo $customer->master_id; ?>" />

        <input name="_method" type="hidden" value="<?php echo ($customer->exists) ? 'PUT' : 'POST'; ?>" />
        <?php echo Form::token(); ?>

        <div class="form-group form-group-actions">
            <button class="btn-wide btn btn-lg btn-xl btn-primary" type="submit">
                <i class="glyphicon glyphicon-ok"></i> Save Customer
            </button>
        </div>
    </form>

</div>

<?php if ($customer->exists): ?>
    <div class="modal fade" id="delete-customer-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">Delete "<?php echo $customer->first_name.' '.$customer->last_name; ?>"</h3>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete <?php echo $customer->first_name.' '.$customer->last_name; ?>? This can not be undone!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Cancel
                    </button>
                    <button type="button" class="btn btn-danger" data-act="delete-customer">
                        Delete Customer
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php include __DIR__.'/../partials/footer.php'; ?>
