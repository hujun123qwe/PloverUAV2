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
 * 用户字段模型
 * 该类参考了OneThink的部分实现
 * @author huajie <banhuajie@163.com>
 */
class ReserveModel extends Model{
    
    public function insert($item){
        if(empty($item)){
            return 0;
        }else{
            return $this->add($item);
        }
    }

    public function getItemInfo(){
        return $this->select()->where(1);
    }

}