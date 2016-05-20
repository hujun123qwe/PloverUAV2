<?php
return array(
	//'配置项'=>'配置值'
    '__UAV_CSS__'   =>  __ROOT__.'/'.APP_PATH.'Home/View/Public/css',
    '__UAV_JS__'    =>  __ROOT__.'/'.APP_PATH.'Home/View/Public/js',
    '__UAV_IMG__'   =>  __ROOT__.'/'.APP_PATH.'Home/View/Public/img',
    '__UAV_BTSP__'  =>  __ROOT__.'/'.APP_PATH.'Home/View/Public/bootstrap',

    'URL_ROUTER_ON'  =>  true,
    'URL_MAP_RULES' =>  array(
        'about' => 'Index/about',
        'news'  => 'Index/news',
        'video' => 'Index/video',
        'contact' => 'Index/contact',
        'forum'  => 'Index/forum',
    ),
);