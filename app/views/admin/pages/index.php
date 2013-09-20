<?php include __DIR__.'/../partials/header.php'; ?>

<div class="page-header">
    <h1 class="page-header-title">
        <i class="glyphicon glyphicon-file"></i> Pages
    </h1>

    <div class="page-header-tools">
         <a class="btn btn-primary" data-toggle="tooltip" title="New Page"
            href="/admin/pages/new">
            <i class="glyphicon glyphicon-plus"></i>
        </a>
    </div>
</div>

<div class="page-body">
    <table class="table table-hoover">
        <thead>
            <tr>
                <th>Page</ht>
                <th class="th-updated-at">Updated</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pages as $page): ?>
                <tr >
                    <td>
                        <div>
                            <a class="text-lg u" href="/admin/pages/edit/<?php echo $page->id; ?>">
                                <?php echo $page->name; ?>
                            </a>
                        </div>
                        <div class="text-muted"><?php echo $page->description; ?></div>
                    </td>
                    <td><?php echo $page->updated_at->toFormattedDateString(); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include __DIR__.'/../partials/footer.php'; ?>
