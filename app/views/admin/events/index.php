<?php include __DIR__.'/../partials/header.php'; ?>

<div class="page-header">
    <h1 class="page-header-title">
        <i class="glyphicon glyphicon-calendar"></i> Events
    </h1>
    <?php if ( ! $events->isEmpty()): ?>
        <div class="page-header-tools">
            <a class="btn btn-primary" data-toggle="tooltip" title="New event"
                href="/admin/events/new">
                <i class="glyphicon glyphicon-plus"></i>
            </a>
        </div>
    <?php endif; ?>
</div>

<div class="page-body">
    <?php if (! $events->isEmpty()): ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</ht>

                    <th class="th-150"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($events as $event): ?>
                    <tr >
                        <td><a href="/admin/events/<?php echo $event->id; ?>"><?php echo $event->name; ?></a></td>

                        <td>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="blank-slate">
            <h1><i class="glyphicon glyphicon-calendar"></i></h1>
            <h2>You haven't added any events yet.</h2>
            <a class="mt btn btn-primary btn-lg" href="/admin/events/new">Add an event</a>
        </div>
    <?php endif; ?>
</div>

<?php include __DIR__.'/../partials/footer.php'; ?>
