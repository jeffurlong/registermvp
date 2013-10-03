<?php include __DIR__.'/../partials/header.php'; ?>

<div class="page-header">
    <h1 class="page-header-title">
        <i class="glyphicon glyphicon-user"></i> Customers
    </h1>
    <?php if ( ! $customers->isEmpty()): ?>
        <div class="page-header-tools">
            <a class="btn btn-primary" data-toggle="tooltip" title="New customer account"
                href="/admin/customers/new">
                <i class="glyphicon glyphicon-plus"></i>
            </a>
        </div>
    <?php endif; ?>
</div>

<?php if ($customers->isEmpty()): ?>
    <div class="page-body">
        <div class="blank-slate">
            <h1><i class="glyphicon glyphicon-user"></i></h1>
            <h2>You don't have any customers yet.</h2>
            <a class="mt btn btn-primary btn-lg" href="/admin/customers/new">
                Create a customer account
            </a>
        </div>
    </div>
<?php else: ?>
<div class="page-subheader">
    <ul class="nav nav-tabs" id="myTab">
        <li class="active"><a href="#all-customers" data-toggle="tab">All customers</a></li>
        <li><a href="#account-owners"  data-toggle="tab">Account owners</a></li>
    </ul>
</div>

<div class="page-body">

    <div class="tab-content">
        <div class="tab-pane active" id="all-customers">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</ht>
                        <th>Phone</th>
                        <th>Email</th>
                        <th class="th-150"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($customers as $customer): ?>
                        <tr >
                            <td><a href="/admin/customers/show/<?php echo $customer->id; ?>">
                                <?php echo $customer->first_name.' '.$customer->last_name; ?></a>
                            </td>
                            <td><?php echo $customer->phone; ?></td>
                            <td><?php echo $customer->email; ?></td>
                            <td>
                                <?php if($customer->id === $customer->master_id): ?>
                                    <i class="glyphicon glyphicon-star"></i> Account Owner
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="tab-pane" id="account-owners">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</ht>
                        <th>Phone</th>
                        <th>Email</th>
                        <th class="th-150"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($customers as $customer): ?>
                        <?php if($customer->isMaster()): ?>
                            <tr >
                                <td><a href="/admin/customers/show/<?php echo $customer->id; ?>">
                                    <?php echo $customer->first_name.' '.$customer->last_name; ?></a>
                                </td>
                                <td><?php echo $customer->phone; ?></td>
                                <td><?php echo $customer->email; ?></td>
                                <td>
                                    <?php if($customer->id === $customer->master_id): ?>
                                        <i class="glyphicon glyphicon-star"></i> Account Owner
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<?php endif; ?>
<?php include __DIR__.'/../partials/footer.php'; ?>
