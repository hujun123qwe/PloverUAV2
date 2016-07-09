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
use User\Model\ReserveModel;

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
            $reserve_info = array();
            $reserve_info['_place'] = I('post._place');
            $reserve_info['_type'] = I('post._type');
            $reserve_info['_area'] = I('post._area');
            $reserve_info['_time'] = I('post._time');
            $reserve_info['_name'] = I('post._name');
            $reserve_info['_phone'] = I('post._phone');
            $reserve_info['_mark'] = I('post._mark');
            $reserve_info['is_pay'] = 0;
            $reserve_info['add_time'] = time();

            $reserve_db = D('Reserve');
            if($reserve_db->insert($reserve_info)){
                $this->display('reserve_success');
            }else{
                echo "预约失败，请重新预约";
                $this->display();
            }
//          var_dump($reserve_info);

        }else{
            $this->display();
        }
    }

    public function protocol(){
        $this->display();
    }
}
