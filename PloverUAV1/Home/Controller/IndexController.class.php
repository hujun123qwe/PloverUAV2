<?php
namespace Home\Controller;
use Think\Controller;

class IndexController extends Controller
{
    public function index()
    {
        $this->display();
    }

    public function about(){
        $this->display();
    }

    public function forum(){
        $this->display();
    }
    public function video(){
        $this->display();
    }
    public function news(){
        $this->display();
    }
}