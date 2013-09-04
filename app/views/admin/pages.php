<?php include 'partials/header.php'; ?>
<div class="page-header">
    <h1 class="page-header-title">
        <i class="glyphicon glyphicon-file"></i> Pages
    </h1>
   <div class="page-header-tools">
        <a class="btn btn-sm btn-secondary" href="/admin/page/new">New Page</a>
    </div>
</div>

<div class="page-body">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Title</ht>
                <th class="th-updated-at">Updated</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pages as $page): ?>
                <tr class="pointer" data-href="/admin/pages/edit/<?php echo $page->id; ?>">
                    <td>
                        <div class="text-large"><b><?php echo $page->name; ?></b></div>
                        <div class="text-small text-muted"><?php echo substr(strip_tags($page->content), 0, 150); ?>...</div>
                    </td>
                    <td><?php echo $page->updated_at->toFormattedDateString(); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'partials/footer.php'; ?>
