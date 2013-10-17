<?php include __DIR__.'/../partials/header.php'; ?>

<div class="page-header">

    <h1 class="page-header-title">
        <i class="glyphicon glyphicon-calendar"></i>
        <a href="/admin/seasons" class="text-muted">Seasons</a> /
        <?php echo $season->name; ?>
    </h1>

    <div class="page-header-tools pull-right">
        <a class="btn btn-default tooltipper" data-toggle="modal" href="#delete-season-modal"
            title="Delete season">
            <i class="glyphicon glyphicon-trash"></i>
        </a>
         <a class="btn btn-default" data-toggle="tooltip"
            href="/admin/seasons/edit/<?php echo $season->id; ?>" title="Edit season">
            <i class="glyphicon glyphicon-pencil"></i>
        </a>
    </div>
</div>


<div class="page-body">
    <div class="row">
        <div class="col-md-6">
            <h4 class="clearfix">
                Seasons Divisions
                <a class="tooltipper btn btn-primary btn-xs pull-right" data-toggle="modal"
                    data-target="#division-modal" title="Add new division">
                    <i class="glyphicon glyphicon-plus"></i>
                </a>
            </h4>
            <?php if ($season->divisions->isEmpty()): ?>
                <p>You haven't created any divisions yet.</p>
            <?php endif; ?>
            <ul class="list-group sortable" data-target="/admin/seasons/sort-divisions">
                <?php foreach($season->divisions as $division): ?>
                    <li class="list-group-item" data-key="<?php echo $division->id; ?>"
                        draggable="true">
                        <i class="sortable-handle glyphicon glyphicon-align-justify"></i>
                        <a data-target="#division-modal" data-toggle="modal"
                            href="/admin/seasons/load-division/<?php echo $division->id; ?>">
                            <?php echo $division->name; ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
            <div class="clearfix">

            </div>
            <!-- <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title">Season Divisions</h2>
                </div>
                <div class="panel-body">
                    <?php if ($season->divisions->isEmpty()): ?>
                        <p>You haven't created any divisions yet.</p>
                    <?php endif; ?>
                    <ul class="sortable">
                        <?php foreach($season->divisions as $division): ?>
                            <li draggable="true"><?php echo $division->name; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

            </div> -->
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title">Registration Questions</h2>
                </div>
                <div class="panel-body">
                    <?php if ($season->questions->isEmpty()): ?>
                        <p>You haven't added any registration questions yet.</p>
                    <?php endif; ?>
                </div>
                <div class="panel-footer clearfix">
                    <button class="btn btn-default pull-right" data-toggle="modal"
                        data-target="#add-question-modal">
                        Add Registration Question
                    </button>
                </div>
            </div>
        </div>
</div>





<div class="modal fade" id="division-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">Add a new division</h3>
            </div>
            <form method="post" class="bypass" id="add-division-form">
                <div class="modal-body">

                    <div class="form-group row">
                        <div class="col-md-9">
                            <label for="program-name">
                                Division name <span class="required">(required)</span>
                            </label>
                            <input class="form-control required" id="division-name" name="name"
                                type="text"/>
                        </div>
                        <div class="col-md-3">
                            <label for="division-has-teams">Has Teams</label>
                            <div>
                                <div class="make-switch switch-large" data-on="success"
                                    data-off="danger" data-on-label="YES" data-off-label="NO">
                                    <input type="checkbox" id="division-has-teams" name="has_teams"
                                        value="1" checked/>
                                </div>
                            </div>
                        </div>
                    </div>

                     <div class="form-group row">
                        <div class="col-md-6">
                            <label class="control-label" for="reg-start-dt">Registration Opens</label>
                            <div class="input-group date">
                                <input class="form-control required" id="reg-start-dt"
                                    name="reg_start_dt" type="text" value="" />
                                <span class="input-group-addon add-on pointer">
                                    <i class="glyphicon glyphicon-calendar"></i>
                                </span>
                          </div>
                        </div>
                        <div class="col-md-6">
                            <label class="control-label" for="reg-end-dt">Registration Closes</label>
                            <div class="input-group date">
                                <input class="form-control required datepicker" id="reg-end-dt"
                                    name="reg_end_dt" type="text" value="" />
                                 <span class="input-group-addon add-on pointer">
                                    <i class="glyphicon glyphicon-calendar"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <label class="control-label" for="start_dt">Play Starts</label>
                            <div class="input-group date">
                                <input class="form-control required" id="start_dt" name="start_dt"
                                    type="text" value="" />
                                <span class="input-group-addon add-on pointer">
                                    <i class="glyphicon glyphicon-calendar"></i>
                                </span>
                          </div>
                        </div>
                        <div class="col-md-6">
                            <label class="control-label" for="end_dt">Play Ends</label>
                            <div class="input-group date">
                                <input class="form-control required datepicker" id="end_dt"
                                    name="end_dt" type="text" value="" />
                                 <span class="input-group-addon add-on pointer">
                                    <i class="glyphicon glyphicon-calendar"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="season_id" value="<?php echo $season->id; ?>" />
                    <?php echo Form::token(); ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-success">
                        Add Division
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__.'/../partials/footer.php'; ?>
