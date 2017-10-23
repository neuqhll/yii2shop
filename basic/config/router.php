<?php
//路由规则
return[
        'enablePrettyUrl' => true,
        'showScriptName' => false,
        // 'rules' => [  
        // ],   yii2默认首页  SiteContorller.php 中设置的
        'rules' => [
            "/" => "/default/index",   //设置默认主页 DefaultController.php 中设置
        ],
];
