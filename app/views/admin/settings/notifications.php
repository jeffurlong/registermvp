<?php include __DIR__.'/../partials/header.php'; ?>

<div class="page-header">

    <h1 class="page-header-title">
        <i class="glyphicon glyphicon-send"></i> Notification Settings
    </h1>

</div>

<div class="page-body container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Order Confirmations</h4>
            <h5>When an order is placed you can have a notification sent to any email address</h5>
        </div>
        <div class="panel-body">

            <?php if ($subscriptions->isEmpty()): ?>
                <p>You haven't created any order notifications yet.</p>
            <?php else: ?>
                <table class="table table-hover">
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
                                <div class="text-large">Send email to <b><?php echo $subscription->address; ?></b></div>
                            </td>
                            <td class="button-cell">
                                <button class="btn btn-default">
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
            <button class="btn btn-default pull-right" data-toggle="modal" data-target="#add-notification-modal">Add Order Notification</button>
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

<?php  include __DIR__.'/../partials/footer.php'; ?>
