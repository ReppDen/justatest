<!DOCTYPE html>
<html>
<head>
    <link href="/css/bootstrap-combined.min.css" rel="stylesheet"/>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="span8 offset2">
            <?php
            //Include the subview
            include($subview.'.php');
            ?>
        </div>
    </div>
</div>
</body>
</html>