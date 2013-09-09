<?php include 'partials/header.php'; ?>

<div class="page-header">

    <h1 class="page-header-title">
        <i class="glyphicon glyphicon-file"></i>
        <a href="/admin/pages" class="text-muted">Pages</a> / <?php echo $page->name; ?>
    </h1>

    <div class="page-header-tools pull-right">
        <button class="btn btn-trans" data-toggle="tooltip" title="Preview Page"
            data-act="page-preview">
            <i class="glyphicon glyphicon-eye-open"></i> Preview
        </button>

        <button class="btn btn-secondary" data-toggle="tooltip" title="Save Page"
            data-act="page-save">
            <i class="glyphicon glyphicon-ok-sign"></i> Save Page
        </button>

    </div>
</div>

<div class="page-body container">

    <form class="bypass" id="pages-edit-form" method="post">
        <label class="control-label" for="name">Title</label>
        <input class="form-control" id="name" name="name" type="text"
            value="<?php echo $page->name; ?>" />

        <label class="control-label" for="wysihtml">Content</label>
        <textarea class="form-control wysihtml" id="wysihtml" name="content" rows="15">
            <?php echo $page->content; ?>
        </textarea>
         <input name="page_id" id="page_id" type="hidden" value="<?php echo $page->id; ?>" />
        <input name="_method" type="hidden" value="PUT" />

        <button class="pull-right btn btn-secondary" type="submit">
            <i class="glyphicon glyphicon-ok-sign"></i> Save Page
        </button>
    </form>

</div>

<script src="/js/wysihtml5-0.3.0.min.js"></script>

<?php include 'partials/footer.php'; ?>
