<?php include __DIR__.'/../partials/header.php'; ?>

<div class="page-header">

    <h1 class="page-header-title">
        <i class="glyphicon glyphicon-calendar"></i>
        <a href="/admin/events" class="text-muted">Sessions</a> / <?php echo ($event->exists) ? 'Edit session': 'New session'; ?>
    </h1>

    <div class="page-header-tools pull-right">
        <?php if ($event->exists): ?>
            <a class="btn btn-default tooltipper" data-toggle="modal" href="#delete-event-modal" title="Delete session">
                <i class="glyphicon glyphicon-trash"></i>
            </a>
        <?php else: ?>
            <a href="/admin/events" class="btn btn-default" data-toggle="tooltip" title="Cancel">
                <i class="glyphicon glyphicon-ban-circle"></i>
            </a>
        <?php endif; ?>



       <button class="btn btn-primary" data-toggle="tooltip" title="Save session"
            data-act="submit" data-target="#event-form">
            <i class="glyphicon glyphicon-ok"></i>
        </button>

    </div>
</div>


<div class="page-body container">
    <form id="event-form" method="post">
        <div class="form-group row">
            <div class="col-md-10">
                <label class="control-label" for="name">Session Name</label>
                <input class="form-control required" id="name" name="name" type="text"
                    value="<?php echo $event->name; ?>" />
            </div>

            <div class="col-md-2">
                <div class="pull-right">
                    <label class="control-label" for="has_teams">Teams</label>
                    <div>
                        <div class="make-switch switch-large" data-on="success" data-off="danger">
                            <input type="checkbox" id="visible" name="visible" value="<?php echo $event->has_teams; ?>"
                            <?php if ($event->has_teams): ?>
                                checked="checked"
                            <?php endif; ?>
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <label class="control-label" for="start_dt">Session Starts</label>
                <div class="input-group date">
                    <input class="form-control required" id="start_dt" name="start_dt"
                        type="text" value="<?php echo $event->start_dt; ?>" />
                    <span class="input-group-addon add-on pointer"><i class="glyphicon glyphicon-calendar"></i></span>
              </div>
            </div>
            <div class="col-md-6">
                <label class="control-label" for="end_dt">Session Ends</label>
                <div class="input-group date">
                    <input class="form-control required datepicker" id="end_dt" name="end_dt" type="text"
                        value="<?php echo $event->end_dt; ?>" />
                     <span class="input-group-addon add-on pointer"><i class="glyphicon glyphicon-calendar"></i></span>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <label class="control-label" for="reg_start_dt">Registration Opens</label>
                <div class="input-group date">
                    <input class="form-control required datepicker" id="reg_start_dt" name="reg_start_dt" type="text"
                        value="<?php echo $event->reg_start_dt; ?>" />
                     <span class="input-group-addon add-on pointer"><i class="glyphicon glyphicon-calendar"></i></span>
                </div>
            </div>
            <div class="col-md-6">
                <label class="control-label" for="reg_end_dt">Registration Closes</label>
                <div class="input-group date">
                    <input class="form-control required" id="reg_end_dt" name="reg_end_dt" type="text"
                        value="<?php echo $event->reg_end_dt; ?>" />
                    <span class="input-group-addon add-on pointer"><i class="glyphicon glyphicon-calendar"></i></span>
                </div>
            </div>

        </div>
        <div class="form-group">
             <label class="control-label" for="wysihtml">Description</label>
            <textarea class="form-control wysihtml" id="wysihtml" name="description" rows="15" >
                <?php echo $event->description; ?>
            </textarea>
        </div>
<!-- <div class="col-md-3">
                 <label class="control-label" for="cost">Cost</label>
                <input class="form-control required" id="cost" name="cost" type="text"
                    value="<?php echo $event->cost; ?>" />
            </div> -->
        <input name="id" id="record_id" type="hidden" value="<?php echo $event->id; ?>" />
        <input name="_method" type="hidden" value="<?php echo ($event->exists) ? 'PUT' : 'POST'; ?>" />
        <?php echo Form::token(); ?>
        <div class="form-group form-group-actions">
            <button class="btn-wide btn btn-lg btn-xl btn-primary" type="submit">
                <i class="glyphicon glyphicon-ok"></i> Save Session
            </button>
        </div>
    </form>

</div>


<script src="/js/wysihtml5-0.3.0.min.js"></script>

<?php include __DIR__.'/../partials/footer.php'; ?>
