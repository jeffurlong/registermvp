<?php include __DIR__.'/../partials/header.php'; ?>

<div class="page-header">
    <h1 class="page-header-title">
        <i class="glyphicon glyphicon-shopping-cart"></i> Orders
    </h1>
</div>

<div class="page-body">
    <?php if (! $orders->isEmpty()): ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Order</ht>
                    <th>Date</th>
                    <th>Placed By</th>
                    <th>Payment Status</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr >
                        <td><a href="/orders/<?php echo $order->id; ?>">#<?php echo $order->id; ?></a></td>
                        <td><?php echo $order->created_at->toFormattedDateString(); ?></td>
                        <td><?php echo $order->first_name.' '.$order->last_name; ?></td>
                        <td>
                            <?php if($order->amount > $order->payments->amount): ?>
                                Pending
                            <?php else: ?>
                                Paid
                            <?php endif; ?>
                        </td>
                        <td><?php echo $order->amount; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="blank-slate">
            <h1><i class="glyphicon glyphicon-shopping-cart"></i></h1>
            <h2>You haven't received any orders yet.</h2>
        </div>
    <?php endif; ?>
</div>
<?php include __DIR__.'/../partials/footer.php'; ?>
