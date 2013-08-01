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
            <li><a href="/org/login">Log In</a></li>
            <li><a href="/org/signup">Sign up</a></li>
        </ul>
    </div>
</nav>

<div class="container">

<?php if($message): ?>
    <div class="alert">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <?php echo $message; ?>
    </div>
<?php endif; ?>
