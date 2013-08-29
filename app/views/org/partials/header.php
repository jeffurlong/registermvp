<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title><?php echo $_title; ?></title>
    <meta name="description" content="<?php echo $_description; ?>">

    <link href="/css/org.min.css" rel="stylesheet">
    <?php if ($_org['theme']): ?>
        <link href="/css/custom/<?php echo $_org['theme']; ?>" rel="stylesheet">
    <?php endif; ?>

    <script src="/js/modernizr.custom.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <a class="navbar-brand" href="/"><?php echo $_org['name']; ?></a>
        <ul class="nav navbar-nav pull-right">
            <li><a href="/account/login">Log In</a></li>
            <li><a href="/account/signup">Sign up</a></li>
        </ul>
    </div>
</nav>

<div class="container">

<?php if(Session::has('error')): ?>

    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <span class="glyphicon glyphicon-exclamation-sign"></span> <?php echo Lang::get(Session::has('reason') ? Session::get('reason') : 'alerts.error'); ?>
    </div>

<?php elseif(Session::has('success')): ?>

    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <?php echo Lang::get(Session::has('reason') ? Session::get('reason') : 'alerts.success'); ?>
    </div>

<?php elseif(Session::has('message')): ?>

    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <?php echo Session::get('message'); ?>
    </div>

<?php endif; ?>
