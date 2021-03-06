<?php include __DIR__.'/../partials/header.php'; ?>

<div class="page-header">

    <h1 class="page-header-title">
        <i class="glyphicon glyphicon-lock"></i> Account Settings
    </h1>

</div>

<div class="page-body container">
            <h2 class="panel-title">Staff Members</h2>
            <h3 class="panel-subtitle">
                You can give other people admin access to your application.
            </h3>
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
                        <td class="cell-width-sm">
                            <button class="btn btn-default delete-admin-toggle"
                                data-target="#delete-admin-modal" data-admin-id="<?php echo $admin->id; ?>">
                                <i class="glyphicon glyphicon-trash"></i> Delete
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <button class="btn btn-default pull-right" data-toggle="modal"
                data-target="#add-admin-modal">
                Add a Staff Member
            </button>
</div>

<?php  include __DIR__.'/../partials/footer.php'; ?>
