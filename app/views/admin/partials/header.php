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
<body class="<?php echo $_template; ?>">

<?php if(Session::has('error')): ?>
    <div id="flash-error">
        <div id="growls">
            <div class="growl growl-error">
                <div class="growl-title"><?php echo Session::get('error'); ?></div>
                <button class="close growl-close">&times;</button>
            </div>
        </div>
    </div>
<?php elseif(Session::has('message')): ?>
    <div id="flash-message">
        <div id="growls">
            <div class="growl">
                <div class="growl-title"><?php echo Session::get('message'); ?></div>
                <button class="close growl-close">&times;</button>
            </div>
        </div>
    </div>
<?php endif; ?>

<nav class="navbar navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/admin/"><?php echo $_org['name']; ?></a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="mailto:support@mvpreg.com">Help &amp; Support</a></li>
                <li><a href="#">Your Account</a></li>
            </ul>
        </div>
    </div>
</nav>


<div class="container page-container">


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
        <li><span class="sidebar-text">YOUR SETTINGS</span></li>
        <li>
            <a href="/admin/settings/general">
                <i class="glyphicon glyphicon-cog"></i> General
            </a>
        </li>
        <li>
            <a href="/admin/settings/payments">
                <i class="glyphicon glyphicon-credit-card"></i> Payments
            </a>
        </li>
        <li>
            <a href="/admin/settings/notifications">
                <i class="glyphicon glyphicon-send"></i> Notifications
            </a>
        </li>
         <li>
            <a href="/admin/settings/account">
                <i class="glyphicon glyphicon-lock"></i> Account
            </a>
        </li>
    </ul>

</nav>
<div class="content">

