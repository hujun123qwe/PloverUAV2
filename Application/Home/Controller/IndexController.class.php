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
     * /home/index/reserve
    */
    public function reserve(){
        if(IS_POST){            //是否通过POST方式提交
            $reserve_info = array();            //定义一个数组用于存储预约信息
            $province = I('post.province');     //省份
            $city = I('post.city');              //城市
            $county = I('post.county');           //区/县
            $reserve_info['_place'] = $province.$city.$county;      //将地址合并存储
            $reserve_info['_type'] = I('post._type');       //农作物种类
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
            $reserve_info['_area'] = I('post._area');       //作业面积
            $reserve_info['_time'] = I('post._time');       //作业时间
            $reserve_info['_name'] = I('post._name');       //联系人姓名
            $reserve_info['_phone'] = I('post._phone');     //联系人手机号
            $reserve_info['_mark'] = I('post._mark');        //押金
            $reserve_info['is_pay'] = 0;                     //是否支付押金
            $reserve_info['add_time'] = time();             //添加时间

            $reserve_db = D('Reserve');                     //调用数据库Reserve类
            if($reserve_db->insert($reserve_info)){         //方法insert插入一条信息到数据库Reserve，如果成功返回true
                $this->display('reserve_success');          //成功，显示成功页面
            }else{
                echo "预约失败，请重新预约";                  //失败，显示失败页面
                $this->display();
            }
        }else{
            $this->display();                           //不是POST提交方式，则显示预约界面
        }
    }

    /*
     * 后台预约信息统计
     * 2016-07-08 18:02
     * /home/index/data
    */
    public function data(){
        $reserve_db = D('Reserve');         //实例化Reserve数据库对象
        $data = $reserve_db->getItemInfo();     //调用getItemInfo()方法，得到信息赋值给data变量
        if($data){
            $this->assign('reserve_data',$data);    //使用assign方法实现data在html页面显示
        }
        $this->display();           //显示后台预约信息统计界面
    }

    public function protocol(){
        $this->display();
    }
}
