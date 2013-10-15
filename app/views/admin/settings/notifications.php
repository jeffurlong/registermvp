<?php include __DIR__.'/../partials/header.php'; ?>

<div class="page-header">

    <h1 class="page-header-title">
        <i class="glyphicon glyphicon-send"></i> Notification Settings
    </h1>

</div>

<div class="page-body container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title">Order Notifications</h2>
            <h3 class="panel-subtitle">
                When an order is placed you can have a notification sent to any email address
            </h3>
        </div>
        <div class="panel-body">
            <?php if ($subscriptions->isEmpty()): ?>
                <p>You haven't created any order notifications yet.</p>
            <?php else: ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Notification</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($subscriptions as $subscription): ?>
                        <tr>
                            <td>
                                <div class="text-large">
                                    Send email to <b><?php echo $subscription->address; ?></b>
                                </div>
                            </td>
                            <td class="cell-width-sm">
                                <button class="btn btn-default delete-notification-toggle"
                                    data-target="#delete-notification-modal" data-notification="<?php echo $subscription->id; ?>">
                                    <i class="glyphicon glyphicon-trash"></i> Delete
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            <?php endif; ?>
        </div>
        <div class="panel-footer clearfix">
            <button class="btn btn-default pull-right" data-toggle="modal"
                data-target="#add-notification-modal">
                Add Order Notification
            </button>
        </div>
    </div>


    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title">Email Templates</h2>
            <h3 class="panel-subtitle">
                These emails are sent out automatically. You can edit the content of each one.
            </h3>
        </div>
        <div class="panel-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Template</th>
                        <th>Description</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Order confirmation</td>
                        <td>Sent to the customer when an order is placed</td>
                        <td class="cell-width-sm">
                            <button class="btn btn-default edit-email-toggle"
                                data-target="#edit-email-modal">
                                <i class="glyphicon glyphicon-pencil"></i> Edit
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>Order notification</td>
                        <td>Sent to email addresses added to order notifications</td>
                        <td class="cell-width-sm">
                            <button class="btn btn-default edit-email-toggle"
                                data-target="#edit-email-modal">
                                <i class="glyphicon glyphicon-pencil"></i> Edit
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</div>

<div class="modal fade" id="add-notification-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">Add a new order notification</h3>
            </div>
            <form method="post" class="bypass" id="add-notification-form">
                <div class="modal-body">
                    <label class="control-label" for="notification_address">Email Address</label>
                    <input class="email required form-control" type="email" name="address" id="notification_address" />
                    <input type="hidden" name="type" value="order" />
                    <?php echo Form::token(); ?>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-success">
                        Add Notification
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="delete-notification-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">Delete order notification</h3>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this order notification? This can not be undone!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn pull-left btn-default" data-dismiss="modal">
                    Cancel
                </button>
                <button type="button" class="btn btn-danger" data-act="delete-order-notification"
                    data-target="" value="1">
                    <i class="glyphicon glyphicon-trash"></i> Delete Notification
                </button>
            </div>
        </div>
    </div>
</div>

<?php  include __DIR__.'/../partials/footer.php'; ?>
