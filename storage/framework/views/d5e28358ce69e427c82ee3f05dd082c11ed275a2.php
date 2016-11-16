<!DOCTYPE html>
<html lang="zh-hans">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="测试页面">
    <title>App Name</title>
    <link rel="stylesheet" href="<?php echo e(asset('bootstrap/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('bootstrap/css/style.css')); ?>">
    </head>
<body>
<div class="container">
    <ul class="nav nav-pills">
        <li class="nav-item">
            <a href="#" class="nav-link active">Active</a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">Link</a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">Another link</a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link disabled">Disabled</a>
        </li>
    </ul>
</div>


<script src="<?php echo e(asset('bootstrap/js/bootstrap.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('bootstrap/js/jquery-2.0.3.min.js')); ?>" type="text/javascript"></script>
</body>
</html>
