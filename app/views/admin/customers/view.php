<?php include __DIR__.'/../partials/header.php'; ?>

<div class="page-header">

    <h1 class="page-header-title">
        <i class="glyphicon glyphicon-user"></i>
        <a href="/admin/customers" class="text-muted">Customers</a> /
        <?php echo $customer->first_name.' '.$customer->last_name; ?>
    </h1>

    <div class="page-header-tools pull-right">
        <a class="btn btn-default tooltipper" data-toggle="modal" href="#disable-account-modal"
            title="Disable customer account">
            <i class="glyphicon glyphicon-remove"></i>
        </a>
        <a class="btn btn-default" data-toggle="tooltip"
            href="/admin/customers/edit/<?php echo $customer->id; ?>" title="Edit customer">
            <i class="glyphicon glyphicon-pencil"></i>
        </a>
    </div>
</div>


<div class="page-body">
    <div class="row">
        <div class="col-md-8">
            <?php if ( ! $history): ?>
                 <div class="blank-slate mn">
                    <h1><i class="glyphicon glyphicon-shopping-cart"></i></h1>
                    <h2>This customer hasn't placed any orders yet.</h2>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title">Contact Info</h2>
                </div>
                <div class="panel-body">
                    <div><?php echo $customer->first_name.' '.$customer->last_name; ?></div>
                    <div><?php echo $customer->street; ?></div>
                    <div><?php echo $customer->city.' '.$customer->state.' '.$customer->zip; ?></div>
                    <div><i class="glyphicon glyphicon-phone-alt"></i> <?php echo $customer->phone; ?></div>
                    <div><i class="glyphicon glyphicon-envelope"></i> <?php echo $customer->email; ?></div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <h2 class="pull-left panel-title">Account Members</h2>
                    <a class="pull-right btn btn-default btn-sm" data-toggle="tooltip"
                        href="/admin/customers/add/<?php echo $customer->id; ?>"
                        title="Add new member to this account">
                        <i class="glyphicon glyphicon-plus"></i>
                    </a>
                </div>

                <div class="list-group">
                    <?php foreach($members as $member): ?>
                        <div class="list-group-item">
                            <span class="badge"><?php echo age($member->dob); ?></span>
                            <a class="u"
                            href="/admin/customers/edit/<?php echo $member->id; ?>">
                                <?php echo $member->first_name.' '.$member->last_name; ?>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="disable-account-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">Disable Account</h3>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to disable the account for this customer? Customers are
                    not able to log in to disabled account.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Cancel
                </button>
                <button type="button" class="btn btn-danger" data-act="disable-account">
                    Disable account
                </button>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__.'/../partials/footer.php'; ?>
