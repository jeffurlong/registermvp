<?php include 'partials/header.php'; ?>

<div class="page-header">

    <h1 class="page-header-title">
        <i class="glyphicon glyphicon-file"></i>
        <a href="/admin/pages" class="text-muted">Pages</a> / <?php echo ($page->name) ?: 'New Page'; ?>
    </h1>

    <div class="page-header-tools pull-right">
        <?php if ( ! $page->exists): ?>
            <a href="/admin/pages" class="btn btn-default" data-toggle="tooltip" title="Cancel">
                <i class="glyphicon glyphicon-ban-circle"></i>
            </a>
        <?php endif; ?>

        <button class="btn btn-default" data-toggle="tooltip" title="Preview Page"
            data-mvp-act="page-preview">
            <i class="glyphicon glyphicon-search"></i>
        </button>

       <button class="btn btn-default" data-toggle="tooltip" title="Save Page"
            data-mvp-act="submit" data-target="#pages-form">
            <i class="glyphicon glyphicon-ok"></i>
        </button>

    </div>
</div>

<div class="page-body container">

    <form class="bypass" id="pages-form" method="post">
        <label class="control-label" for="name">Title</label>
        <input class="form-control" id="name" name="name" placeholder="e.g. Contact, About us, FAQs, etc." type="text"
            value="<?php echo $page->name; ?>" />

        <label class="control-label" for="wysihtml">Content</label>
        <textarea class="form-control wysihtml" id="wysihtml" name="content" rows="15">
            <?php echo $page->content; ?>
        </textarea>
         <input name="page_id" id="page_id" type="hidden" value="<?php echo $page->id; ?>" />
        <input name="_method" type="hidden" value="<?php echo ($page->exists) ? 'PUT' : 'POST'; ?>" />
        <div class="control-group">
            <?php if ($page->exists): ?>
                <button class="pull-left btn btn-default" type="button" data-toggle="modal"
                    data-target="#page-delete-modal">
                    <i class="glyphicon glyphicon-trash"></i> Delete Page
                </button>
            <?php endif; ?>

            <button class="pull-right btn btn-success" type="submit">
                <i class="glyphicon glyphicon-ok"></i> Save Page
            </button>
        </div>
    </form>

</div>


<div class="modal fade" id="page-delete-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title">Delete "<?php echo $page->name; ?>"</h3>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete the page "<b><?php echo $page->name; ?></b>"? This can not be undone!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger">Delete Page</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<script src="/js/wysihtml5-0.3.0.min.js"></script>

<?php include 'partials/footer.php'; ?>
