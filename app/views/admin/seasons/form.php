<?php include __DIR__.'/../partials/header.php'; ?>

<div class="page-header">

    <h1 class="page-header-title">
        <i class="glyphicon glyphicon-calendar"></i>
        <a href="/admin/seasons" class="text-muted">Seasons</a> / <?php echo ($season->exists) ? 'Edit season': 'New season'; ?>
    </h1>

    <div class="page-header-tools pull-right">
        <?php if ($season->exists): ?>
            <a class="btn btn-default tooltipper" data-toggle="modal" href="#delete-season-modal" title="Delete season">
                <i class="glyphicon glyphicon-trash"></i>
            </a>
        <?php else: ?>
            <a href="/admin/seasons" class="btn btn-default" data-toggle="tooltip" title="Cancel">
                <i class="glyphicon glyphicon-ban-circle"></i>
            </a>
        <?php endif; ?>



       <button class="btn btn-primary" data-toggle="tooltip" title="Save season"
            data-act="submit" data-target="#season-form">
            <i class="glyphicon glyphicon-ok"></i>
        </button>

    </div>
</div>

<div class="page-body container">
    <form id="season-form" method="post">
        <div class="form-group row">
            <div class="col-md-6">
                <label class="control-label" for="name">Season Name</label>
                <input class="form-control required" id="name" name="name" type="text"
                    value="<?php echo $season->name; ?>" />
            </div>
            <div class="col-md-6">
                 <label class="control-label" for="program_id">Program</label>
                    <select class="form-control chosen-select" id="program_id" name="program_id">
                        <option value=""></option>
                        <?php foreach($programs as $program): ?>
                            <option value="<?php echo $program->id; ?>"
                                <?php if($season->program_id === $program->id) echo "selected"; ?>>
                                <?php echo $program->name; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
            </div>
        </div>
        <div class="form-group">
             <label class="control-label" for="wysihtml">Description</label>
            <textarea class="form-control wysihtml" id="wysihtml" name="description" rows="15" >
                <?php echo $season->description; ?>
            </textarea>
        </div>

        <input name="id" type="hidden" value="<?php echo $season->id; ?>" />
        <input name="_method" type="hidden" value="<?php echo ($season->exists) ? 'PUT' : 'POST'; ?>" />
        <?php echo Form::token(); ?>
        <div class="form-group form-group-actions">
            <button class="btn-wide btn btn-lg btn-xl btn-primary" type="submit">
                <i class="glyphicon glyphicon-ok"></i> Save Season
            </button>
        </div>
    </form>
</div>


<script src="/js/wysihtml5-0.3.0.min.js"></script>

<?php include __DIR__.'/../partials/footer.php'; ?>
