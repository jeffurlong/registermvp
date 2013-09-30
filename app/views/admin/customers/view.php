<?php include __DIR__.'/../partials/header.php'; ?>

<div class="page-header">

    <h1 class="page-header-title">
        <i class="glyphicon glyphicon-user"></i>
        <a href="/admin/customers" class="text-muted">Customers</a> /
        <?php echo $customer->first_name.' '.$customer->last_name; ?>
    </h1>

    <div class="page-header-tools pull-right">
        <a class="btn btn-default tooltipper" data-toggle="modal" href="#delete-customer-modal"
            title="Delete customer">
            <i class="glyphicon glyphicon-trash"></i>
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
            <hr />
             <table class="table mt">
                <thead>
                    <tr>
                        <th>Account member</th>
                        <th class="th-150">Age</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($members as $member): ?>
                    <tr >
                        <td>
                            <a class="text-lg u" href="/admin/customers/edit/<?php echo $member->id; ?>">
                                <?php echo $member->first_name.' '.$member->last_name; ?>
                            </a>
                        </td>
                        <td><?php echo age($member->dob); ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
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
        </div>
    </div>
</div>

<div class="modal fade" id="delete-customer-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">Delete "<?php echo $customer->first_name.' '.$customer->last_name; ?>"</h3>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete the account of
                    &quot;<b><?php echo $customer->first_name.' '.$customer->last_name; ?></b>&quot;?
                    This can not be undone!
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Cancel
                </button>
                <button type="button" class="btn btn-danger" data-act="delete-page">
                    Delete Customer Account
                </button>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__.'/../partials/footer.php'; ?>
