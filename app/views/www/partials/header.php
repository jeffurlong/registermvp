<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo $_title; ?></title>
    <meta name="description" content="<?php echo $_description; ?>">
    <link href="/css/main.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <style>
    .show-grid {
  margin-bottom: 15px;
}
.show-grid [class^="col-"] {
  padding-top: 10px;
  padding-bottom: 10px;
  background-color: #eee;
  border: 1px solid #ddd;
  /* Todo: reconcile these */
  background-color: rgba(185,74,72,.15);
  border: 1px solid rgba(185,74,72,.2);
}
</style>
</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <a class="navbar-brand" href="/">MVP REGISTRATION</a>
        <ul class="nav navbar-nav pull-right">
            <li><a class="btn-link" data-mvp-act="request-beta-invite">Request Beta Invite</a></li>
        </ul>
    </div>
</nav>

