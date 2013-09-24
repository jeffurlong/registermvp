<?php include __DIR__.'/../partials/header.php'; ?>

<div class="page-header">
    <h1 class="page-header-title">
        <i class="glyphicon glyphicon-user"></i> Customers
    </h1>
</div>

<div class="page-body">
    <?php if (! $customers->isEmpty()): ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</ht>
                    <th>Location</th>
                    <th>Orders</th>
                    <th>Last order</th>
                    <th>Total spent</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($customers as $customer): ?>
                    <tr >
                        <td><a href="/customers/<?php echo $customer->id; ?>"><?php echo $customer->first_name.' '.$customer->last_name; ?></a></td>
                        <td><?php echo $customer->city.', '.$customer->state; ?></td>
                        <td><?php echo $customer->orders; ?></td>
                        <td><?php echo $customer->last_order; ?></td>
                        <td><?php echo $customer->total_spent; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="blank-slate">
            <h1><i class="glyphicon glyphicon-user"></i></h1>
            <h2>You don't have any customers yet.</h2>
        </div>
    <?php endif; ?>
</div>
<?php
$queries = DB::getQueryLog();
$last_query = end($queries);
echo '<pre>';
var_dump($customers);
var_dump($queries);
echo '</pre>';
?>
<?php include __DIR__.'/../partials/footer.php'; ?>
