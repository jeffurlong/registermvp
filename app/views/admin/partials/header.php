<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_title; ?></title>
    <meta name="description" content="<?php echo $_description; ?>">
    <link href="/css/admin.min.css" rel="stylesheet">
    <script src="/js/modernizr.custom.min.js"></script>
    <!--[if lt IE 9]>
        <script src="/js/html5shiv.js"></script>
        <script src="/js/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container full-container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#home"><?php echo $_org['name']; ?></a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="mailto:support@mvpreg.com">Help &amp; Support</a></li>
                <li><a href="#">Your Account</a></li>
            </ul>
        </div>
    </div>
</nav>


<div class="container full-container">

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

<nav class="sidebar">
    <ul class="nav">
        <li><span class="sidebar-text">YOUR BUSINESS</span></li>
        <li>
            <a href="/admin/dashboard">
                <span class="glyphicon glyphicon-dashboard"></span> Dashboard
            </a>
        </li>
        <li><span class="sidebar-text">YOUR WEBSITE</span></li>
        <li>
            <a href="/admin/pages">
                <i class="glyphicon glyphicon-file"></i> Pages
            </a>
        </li>
    </ul>

</nav>

<div class="content">

