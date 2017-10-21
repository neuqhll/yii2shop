<?php
use app\assets\UserAsset;
UserAsset::register($this);
?>
<?php $this->beginPage();?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <!-- Set render engine for 360 browser -->
    <meta name="renderer" content="webkit">
    <title>微信图书商城</title>
    <?php $this->head();?>
    </head>
<body>
<?php $this->beginBody();?>
<div style="min-height: 500px;">
<?=$content;?>
</div>
<div class="copyright clearfix">
    <p class="name">欢迎您,HLL</p>
    <p class="copyright">由<a href="/" target="_blank">HLL</a>提供技术支持</p>
</div>
<div class="footer_fixed clearfix">
    <span><a href="/user/" class="default"><i class="home_icon"></i><b>首页</b></a></span>
    <span><a href="/user/product/index" class="product"><i class="store_icon"></i><b>图书</b></a></span>
    <span><a href="/user/user/index" class="user"><i class="member_icon"></i><b>我的</b></a></span>
</div>
<?php $this->endBody();?>
</body>
</html>
<?php $this->endPage();?>

