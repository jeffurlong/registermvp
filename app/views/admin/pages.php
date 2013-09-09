<?php include 'partials/header.php'; ?>
<div class="page-header">
    <h1 class="page-header-title">
        <i class="glyphicon glyphicon-file"></i> Pages
    </h1>

    <div class="page-header-tools">
         <a class="btn btn-trans" data-toggle="tooltip" title="New Page"
            href="/admin/page/new">
            <i class="glyphicon glyphicon-plus"></i>
        </a>
    </div>
</div>

<div class="page-body">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Page</ht>
                <th class="th-updated-at">Updated</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pages as $page): ?>
                <tr class="pointer" data-href="/admin/pages/<?php echo $page->id; ?>/edit">
                    <td>
                        <div class="text-large"><b><?php echo $page->name; ?></b></div>
                        <div class="text-small text-muted"><?php echo $page->preview; ?></div>
                    </td>
                    <td><?php echo $page->updated_at->toFormattedDateString(); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'partials/footer.php'; ?>
