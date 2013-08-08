<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo $_title; ?></title>
<meta name="description" content="<?php echo $_description; ?>">
<link href="/css/admin.min.css" rel="stylesheet">
<script src="/js/modernizr.custom.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <a class="navbar-brand" href="/"><?php echo $_org['name']; ?></a>
        <ul class="nav navbar-nav pull-right">
            <li><a href="mailto:support@mvpreg.com">Help &amp; Support</a></li>
            <li><a href="#">Your Account</a></li>
        </ul>
    </div>
</nav>

<div class="container">

<?php if(isset($message)): ?>
    <div class="alert">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <?php echo $message; ?>
    </div>
<?php endif; ?>
