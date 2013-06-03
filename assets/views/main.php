<!DOCTYPE html>
<html>
<head>
    <link href="/css/bootstrap-combined.min.css" rel="stylesheet"/>
    <link href="/css/my.css" rel="stylesheet" />
    <script src="/js/jquery.js"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="span8 offset2">
            <?php
            if ($logged) {
                echo '<div class="btnpanel">
                    <a href="/" class="btn" style="float: left;">Домой</a>
                    <a href="/login/logout" class="btn" style="float: right;">Выход</a>
                </div>';
            }
            ?>

            <?php
            //Include the subview
            include($subview.'.php');
            ?>
        </div>
    </div>
</div>
</body>
</html>