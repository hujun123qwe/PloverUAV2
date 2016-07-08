<?php
// +----------------------------------------------------------------------
// | OpenCMF [ Simple Efficient Excellent ]
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://www.opencmf.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: jry <598821125@qq.com>
// +----------------------------------------------------------------------
namespace Home\Controller;
use Think\Controller;
/**
 * 前台默认控制器
 * @author jry <598821125@qq.com>
 */
class IndexController extends HomeController {
    /**
     * 默认方法
     * @author jry <598821125@qq.com>
     */
    public function index() {
        Cookie('__forward__', C('HOME_PAGE'));
        if (C('INDEX_URL')) {
            if (stristr(C('INDEX_URL'), 'http://') || stristr(C('INDEX_URL'), 'https://')) {
                redirect(C('INDEX_URL'));
            } else {
                $this->redirect(C('INDEX_URL'));
            }
        }
        $this->assign('meta_title', L('home_page'));
        $this->display();
    }

    /*
     * 申请无人机植保服务表单后台响应
     * 2016-07-08 09:21
     * /index.php?s=/cms/cate/9.html
    */
    public function reserve(){
        if(IS_POST){

        }else{
            $this->display();
        }
    }

    public function protocol(){
        $this->display();
    }
}
