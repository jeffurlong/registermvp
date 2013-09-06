<?php include 'partials/header.php'; ?>
<div class="page-header">
    <h1 class="page-header-title">
        <i class="glyphicon glyphicon-file"></i> <a href="/admin/pages" class="text-muted">Pages</a> / <?php echo $page->name; ?>
    </h1>

    <div class="page-header-tools pull-right">
        <button class="btn btn-primary" data-toggle="tooltip" title="Preview Page" data-act="page-preview">
            <i class="glyphicon glyphicon-eye-open"></i> Preview
        </button>

        <button class="btn btn-secondary" data-toggle="tooltip" title="Save Page" data-act="page-save">
            <i class="glyphicon glyphicon-ok-sign"></i> Save Page
        </button>



    </div>
</div>

<div class="page-body container">

    <form method="post">
        <label class="control-label" for="name">Title</label>
        <input class="form-control" id="name" name="name" type="text" value="<?php echo $page->name; ?>" />


        <label class="control-label" for="wysihtml-content">Content</label>

        <div id="wysihtml-toolbar" class="btn-toolbar wysihtml-toolbar" style="display: none;">

                <div class="btn-group">
                    <a class="btn btn-sm btn-default" data-wysihtml5-command="bold"><i class="glyphicon glyphicon-bold"></i></a>
                    <a class="btn btn-sm btn-default" data-wysihtml5-command="italic"><i class="glyphicon glyphicon-italic"></i></a>
                </div>
                <div class="btn-group">
                    <a class="btn btn-sm btn-default" data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h1">H1</a>
                    <a class="btn btn-sm btn-default" data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h2">H2</a>
                    <a class="btn btn-sm btn-default" data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h3">H3</a>
                </div>
                <div class="btn-group">
                    <a class="btn btn-sm btn-default" data-wysihtml5-command="insertOrderedList">UL</a>
                    <a class="btn btn-sm btn-default" data-wysihtml5-command="insertUnorderedList">OL</a>
                </div>
                <div class="btn-group">
                    <a  class="btn btn-sm btn-default" data-wysihtml5-command="createLink">insert link</a>
                    <div data-wysihtml5-dialog="createLink" style="display: none;">
                        <label>Link: <input data-wysihtml5-dialog-field="href" value="http://" class="text"></label>
                        <a class="btn btn-sm btn-secondary" data-wysihtml5-dialog-action="save">OK</a>
                        <a class="btn btn-sm btn-default" data-wysihtml5-dialog-action="cancel">Cancel</a>
                    </div>
                    <a class="btn btn-sm btn-default" data-wysihtml5-command="insertImage">insert image</a>
                    <div data-wysihtml5-dialog="insertImage" style="display: none;">
                        <label>Image: <input data-wysihtml5-dialog-field="src" value="http://"></label>
                        <a class="btn btn-sm btn-secondary" data-wysihtml5-dialog-action="save">OK</a>
                        <a class="btn btn-sm btn-default" data-wysihtml5-dialog-action="cancel">Cancel</a>
                    </div>
                </div>

        </div>

        <textarea class="form-control wysihtml-content" id="wysihtml-content" name="content" rows="5"><?php echo $page->content; ?></textarea>

        <button class="pull-right btn btn-secondary" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save Page</button>
    </form>

</div>

<script src="/js/wysihtml5.min.js"></script>

<script>
    var editor = new wysihtml5.Editor("wysihtml-content", { // id of textarea element
      toolbar:      "wysihtml-toolbar", // id of toolbar element
      parserRules:  wysihtml5ParserRules // defined in parser rules set
    });
</script>

<?php include 'partials/footer.php'; ?>
