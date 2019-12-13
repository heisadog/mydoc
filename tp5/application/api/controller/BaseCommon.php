<?php
/**
 * 这是一个基础的类
 * 它继承 common/controller/Conmon.php类
 * 然后 所有的项目控制器 继承这个
 * */
namespace app\api\controller;

use think\Controller;
use think\Request;
use app\api\common\controller\Common; //应用 common/controller/Conmon.php类

class BaseCommon extends Common //继承
{
//  public $return;
//  public function _initialize()
//  {
//      parent::_initialize(); 
//      //$return = 'dsdsd';
//      $this->return = 'avc';  
//  }
	
}
?>