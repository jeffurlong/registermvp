<?php include __DIR__.'/../partials/header.php'; ?>

<div class="page-header">

    <h1 class="page-header-title">
        <i class="glyphicon glyphicon-lock"></i> Account Settings
    </h1>

</div>

<div class="page-body container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title">Staff Members</h2>
            <h3 class="panel-subtitle">
                You can give other people admin access to your application.
            </h3>
        </div>
        <div class="panel-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($admins as $admin): ?>
                    <tr>
                        <td>
                           <?php echo $admin->first_name.' '.$admin->last_name; ?>
                        </td>
                        <td><?php echo $admin->email; ?></td>
                        <td class="button-cell">
                            <button class="btn btn-default delete-admin-toggle"
                                data-target="#delete-admin-modal" data-admin-id="<?php echo $subscription->id; ?>">
                                <i class="glyphicon glyphicon-trash"></i> Delete
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
        <div class="panel-footer clearfix">
            <button class="btn btn-default pull-right" data-toggle="modal"
                data-target="#add-admin-modal">
                Add a Staff Member
            </button>
        </div>
    </div>
</div>

<?php  include __DIR__.'/../partials/footer.php'; ?>
