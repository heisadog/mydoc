<?php
/**
 * 这是一个基础公共的类
 * 功能之一 解决跨域问题
 * */
namespace app\api\common\controller;

use think\Controller;
use think\Request;
use think\Db; 

class Common extends Controller
{
    public $param;
    public function initialize()
    {
//      parent::initialize();
        /*防止跨域*/      
//	    header('Access-Control-Allow-Origin: '.$_SERVER['HTTP_ORIGIN']);
//	    header('Access-Control-Allow-Credentials: true');
//	    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
//	    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, authKey, sessionId ");
        $param =  $this->request->param();//一次性获取所有参数写法           
        //$param = 'd';       
        $this->param = $param;
	}
	public function getUserMessage($username){
		$res = Db::name('users')->field('uid,username')->where('username', $username)->select();
		return $res[0];
	}

    
}
?>