<?php include __DIR__.'/../partials/header.php'; ?>

<div class="page-header">
    <h1 class="page-header-title">
        <i class="glyphicon glyphicon-calendar"></i> Seasons
    </h1>
    <?php if ( ! $seasons->isEmpty()): ?>
        <div class="page-header-tools">
            <a class="btn btn-primary" data-toggle="tooltip" title="New season"
                href="/admin/seasons/new">
                <i class="glyphicon glyphicon-plus"></i>
            </a>
        </div>
    <?php endif; ?>
</div>

<div class="page-body">
    <?php if (! $seasons->isEmpty()): ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</ht>
                    <th class="cell-width-md"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($seasons as $season): ?>
                    <tr >
                        <td>
                            <a href="/admin/seasons/edit/<?php echo $season->id; ?>">
                                <?php echo $season->name; ?>
                            </a>
                        </td>
                        <td></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="blank-slate">
            <h1><i class="glyphicon glyphicon-calendar"></i></h1>
            <h2>You haven't added any seasons yet.</h2>
            <a class="mt btn btn-primary btn-lg" href="/admin/seasons/new">Add a season</a>
        </div>
    <?php endif; ?>
</div>

<?php include __DIR__.'/../partials/footer.php'; ?>
