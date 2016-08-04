<?php
// +----------------------------------------------------------------------
// | OpenCMF [ Simple Efficient Excellent ]
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://www.opencmf.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: jry <598821125@qq.com>
// +----------------------------------------------------------------------
namespace Home\Model;
use Think\Model;
/**
 * 预约统计信息模型
 * @author 胡军 <hujun123qwe@163.com>
 */
class ReserveModel extends Model{

    /*
     * 预约信息插入数据库方法
     * 参数: $item
     *       得到预约信息
     * 使用模型的add方法
     */
    public function insert($item){
        if(empty($item)){
            return 0;
        }else{
            return $this->add($item);
        }
    }

    /*
     * 预约信息全选择方法
     * 返回：得到的信息（二维数组）
     */
    public function getItemInfo(){
        return $this->select();
    }

}