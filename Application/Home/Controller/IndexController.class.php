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
     * /home/index/reserve
    */
    public function reserve(){
        if(IS_POST){
            $reserve_info = array();
            $province = I('post.province');
            $city = I('post.city');
            $county = I('post.county');
            $reserve_info['_place'] = $province.$city.$county;

            $reserve_info['_type'] = I('post._type');
            if($reserve_info['_type'] == '00'){
                $reserve_info['_type'] = "水稻";
            }else if($reserve_info['_type'] == '01'){
                $reserve_info['_type'] = "小麦";
            }else if($reserve_info['_type'] == '02'){
                $reserve_info['_type'] = "棉花";
            }else if($reserve_info['_type'] == '03'){
                $reserve_info['_type'] = "玉米";
            }else{
                $reserve_info['_type'] = "其他";
            }
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

    /*
     * /home/index/data
     */
    public function data(){
        $reserve_db = D('Reserve');
        $data = $reserve_db->getItemInfo();
        if($data){
            $this->assign('reserve_data',$data);
        }
        $this->display();
    }

    public function protocol(){
        $this->display();
    }
}
