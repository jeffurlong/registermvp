<?php include __DIR__.'/../partials/header.php'; ?>

<div class="page-header">

    <h1 class="page-header-title">
        <i class="glyphicon glyphicon-calendar"></i>
        <a href="/admin/seasons" class="text-muted">Seasons</a> /
        <?php echo ($season->exists) ? 'Edit season': 'New season'; ?>
    </h1>

    <div class="page-header-tools pull-right">
        <?php if ($season->exists): ?>
            <a class="btn btn-default tooltipper" data-toggle="modal" href="#delete-season-modal"
                title="Delete season">
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
        <section>
            <?php if ($season->exists): ?>
                <h2 class="section-heading">Season Details</h2>
            <?php endif; ?>
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label class="control-label" for="name">
                                Season Name <span class="required">(required)</span>
                            </label>
                            <input class="form-control required" id="name" name="name"
                                placeholder="eg. Boys Fall Soccer 2014" type="text"
                                value="<?php echo $season->name; ?>" />
                        </div>
                        <div class="col-md-6">
                            <label class="control-label" for="program-id">
                                Program <span class="required">(required)</span>
                            </label>
                            <select class="form-control required" id="program-id" name="program_id">
                                <option></option>
                                <?php foreach($programs as $program): ?>
                                    <option value="<?php echo $program->id; ?>"
                                        <?php if($season->program_id === $program->id): ?>
                                            selected
                                        <?php endif; ?>
                                        >
                                        <?php echo $program->name.' ('.$program->gender.')'; ?>
                                    </option>
                                <?php endforeach; ?>
                                <option id="new-program-option" value="new">
                                    + Add New Program
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                         <label class="control-label" for="wysihtml">Description</label>
                        <textarea class="form-control wysihtml" id="wysihtml" name="description"
                            rows="10">
                            <?php echo $season->description; ?>
                        </textarea>
                    </div>
                </div>
            </div>
        </section>

        <?php if ($season->exists): ?>
            <section class="mbx">
                <h2 class="section-heading">
                    Season Divisions
                    <button data-toggle="modal" href="#add-division-modal" title="Add Division"
                        class="btn btn-sm btn-default pull-right tooltipper">
                        <i class="glyphicon glyphicon-plus"></i>
                    </button>
                </h2>
                <?php if ( ! $season->divisions->isEmpty()): ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</ht>
                                <th>Phone</th>
                                <th>Email</th>
                                <th class="th-150"></th>
                            </tr>
                        </thead>
                        <tbody id="divisions">
                            <?php foreach($season->divisions as $division): ?>
                                <tr>
                                    <td>
                                        <a data-toggle="modal" data-target="#add-division-modal">
                                            <?php echo $division->name; ?>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <div class="blank-slate blank-slate-sm">
                        <h1><i class="glyphicon glyphicon-list"></i></h1>
                        <h2>This season doesn't have any divisons yet.</h2>
                        <button class="btn btn-default" type="button" data-toggle="modal"
                            data-target="#add-division-modal">
                            Add the first division
                        </button>
                    </div>
                <?php endif; ?>
            </section>

            <section>
                <h2 class="section-heading">Registration Questions</h2>
                <?php if ( ! $season->questions->isEmpty()): ?>
                    <?php foreach($season->questions as $question): ?>
                        <div><?php echo $question->name; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="blank-slate blank-slate-sm">
                        <h1><i class="glyphicon glyphicon-question-sign"></i></h1>
                        <h2>This season doesn't have any registration questions yet.</h2>
                        <button class="btn btn-default" data-toggle="modal"
                            data-target="#add-question-modal">
                            Add the first question
                        </button>
                    </div>
                <?php endif; ?>
            </section>
        <?php endif; ?>

        <div class="form-group form-group-actions">
            <button class="btn-wide btn btn-lg btn-xl btn-primary" type="submit">
                <i class="glyphicon glyphicon-ok"></i> Save Season
            </button>
        </div>

        <input name="id" type="hidden" value="<?php echo $season->id; ?>" />
        <input name="_method" type="hidden"
            value="<?php echo ($season->exists) ? 'PUT' : 'POST'; ?>" />
        <?php echo Form::token(); ?>

    </form>
</div>

<div class="modal fade" id="add-program-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">Add a new program</h3>
            </div>
            <form method="post" class="bypass" id="add-program-form">
                <div class="modal-body">
                    <label for="program-name">
                        Program name <span class="required">(required)</span>
                    </label>
                    <input class="form-control required" id="program-name" name="name" type="text"/>

                    <label for="program-gender">
                        Gender <span class="required">(required)</span>
                    </label>
                    <select class="form-control required" id="program-gender" name="gender">
                        <option></option>
                        <option value="CoEd">CoEd</option>
                        <option value="Female">Female</option>
                        <option value="Male">Male</option>
                    </select>
                    <?php echo Form::token(); ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-success">
                        Add Program
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="add-division-modal">
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

            <!--
            <form method="post" class="bypass" id="adds-division-form">
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-md-9">
                            <label for="program-name">
                                Division name <span class="required">(required)</span>
                            </label>
                            <input class="form-control required" id="division-name" name="name" type="text"/>
                        </div>
                        <div class="col-md-3">
                            <label for="division-has-teams">Has Teams</label>
                            <div>
                                <div class="make-switch switch-large" data-on="success" data-off="danger">
                                    <input type="checkbox" id="division-has-teams" name="has_teams" value="true" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <label class="control-label" for="start_dt">Play Starts</label>
                            <div class="input-group date">
                                <input class="form-control required" id="start_dt" name="start_dt"
                                    type="text" value="" />
                                <span class="input-group-addon add-on pointer"><i class="glyphicon glyphicon-calendar"></i></span>
                          </div>
                        </div>
                        <div class="col-md-6">
                            <label class="control-label" for="end_dt">Play Ends</label>
                            <div class="input-group date">
                                <input class="form-control required datepicker" id="end_dt" name="end_dt" type="text"
                                    value="" />
                                 <span class="input-group-addon add-on pointer"><i class="glyphicon glyphicon-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label class="control-label" for="reg_start_dt">Registration Opens</label>
                            <div class="input-group date">
                                <input class="form-control required datepicker" id="reg_start_dt" name="reg_start_dt" type="text"
                                    value="" />
                                 <span class="input-group-addon add-on pointer"><i class="glyphicon glyphicon-calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="control-label" for="reg_end_dt">Registration Closes</label>
                            <div class="input-group date">
                                <input class="form-control required" id="reg_end_dt" name="reg_end_dt" type="text"
                                    value="" />
                                <span class="input-group-addon add-on pointer"><i class="glyphicon glyphicon-calendar"></i></span>
                            </div>
                        </div>

                    </div>
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
            </form>
        </div>
    </div>
</div>
-->

<script src="/js/wysihtml5-0.3.0.min.js"></script>

<?php include __DIR__.'/../partials/footer.php'; ?>
