<?php include __DIR__.'/../partials/header.php'; ?>

<div class="page-header">

    <h1 class="page-header-title">
        <i class="glyphicon glyphicon-file"></i>
        <a href="/admin/pages" class="text-muted">Pages</a> / <?php echo ($page->name) ?: 'New Page'; ?>
    </h1>

    <div class="page-header-tools pull-right">
        <?php if ($page->exists): ?>
            <a class="btn btn-default tooltipper" data-toggle="modal" href="#delete-page-modal" title="Delete page"><i class="glyphicon glyphicon-trash"></i></a>
        <?php else: ?>
            <a href="/admin/pages" class="btn btn-default" data-toggle="tooltip" title="Cancel">
                <i class="glyphicon glyphicon-ban-circle"></i>
            </a>
        <?php endif; ?>

        <button class="btn btn-default" data-toggle="tooltip" title="Preview Page"
            data-mvp-act="page-preview">
            <i class="glyphicon glyphicon-search"></i>
        </button>

       <button class="btn btn-primary" data-toggle="tooltip" title="Save Page"
            data-act="submit" data-target="#pages-form">
            <i class="glyphicon glyphicon-ok"></i>
        </button>

    </div>
</div>

<div class="page-body container">
    <form class="bypass" id="pages-form" method="post">
        <div class="row">
            <div class="col-md-10">
                <label class="control-label" for="name">Title</label>
                <input class="form-control required" id="name" name="name"
                    placeholder="e.g. Contact, About us, FAQs, etc." type="text"
                    value="<?php echo $page->name; ?>" />
            </div>
            <div class="col-md-2">
                <div class="pull-right">
                    <label class="control-label" for="visible">Visibility</label>
                    <div>
                        <div class="make-switch switch-large" data-on="success" data-off="danger">
                            <input type="checkbox" id="visible" name="visible" value="<?php echo $page->visible; ?>"
                            <?php if ($page->visible): ?>
                                checked="checked"
                            <?php endif; ?>
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <label class="control-label" for="wysihtml">Content</label>
        <textarea class="form-control wysihtml" id="wysihtml" name="content" rows="15" >
            <?php echo $page->content; ?>
        </textarea>
        <input name="page_id" id="page_id" type="hidden" value="<?php echo $page->id; ?>" />
        <input name="_method" type="hidden" value="<?php echo ($page->exists) ? 'PUT' : 'POST'; ?>" />
        <?php echo Form::token(); ?>
        <div class="form-group form-group-actions">


            <button class="btn-wide btn btn-lg btn-xl btn-primary" type="submit">
                <i class="glyphicon glyphicon-ok"></i> Save Page
            </button>
        </div>
        <div>
            <?php if ($page->exists): ?>

            <?php endif; ?>
        </div>
    </form>

</div>

<?php if ($page->exists): ?>
    <div class="modal fade" id="delete-page-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">Delete "<?php echo $page->name; ?>"</h3>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete the page
                        &quot;<b><?php echo $page->name; ?></b>&quot;? This can not be undone!
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Cancel
                    </button>
                    <button type="button" class="btn btn-danger" data-act="delete-page">
                        Delete Page
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<script src="/js/wysihtml5-0.3.0.min.js"></script>

<?php include __DIR__.'/../partials/footer.php'; ?>
