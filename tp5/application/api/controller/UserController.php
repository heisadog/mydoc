<?php
/*
 * 用户控制器
 * 
 * */
namespace app\api\controller;//注意写准确命名空间
use think\Controller;
class UserController extends BaseCommon
{
	//登录
	public function login(){
		$model = model('User');
		$param = $this->param;
		$username = $param['username'];
		$password = $param['password'];
		$res = $model->login($param);// 查询数据
		if ($res) {
			if($res[0]['password']==md5(md5($password))){
				$state = 'success';
				$message = '登录成功';
				$username = $res[0]['username'];
			}else {
				# code...
				$state = 'false';
				$message = '用户密码错误';
			}
        } else {
			$state = 'false';
			$message = '查询用户失败';
			$username = '';
		}
		$data = [
            'state' => $state,
			'message' => $message,
			'username'=>$username,
        ];
        return json($data);
	}
	/**
	 * 获取所有人员()
	 * 带有人员姓名的查询
	 * 带有分页
	 */
    public function getUserList()
    {
        $param = $this->param;
        $model = model('User');
		$res = $model->getUserList($param);// 查询数据
        $data = [
	            'state' => 'success',
	            'data' =>$res,
	        ];
        return json($data);
	}
	//删除用户
	public function deleteUser(){
		$param = $this->param;
        $model = model('User');
		$res = $model->deleteUser($param);
		if($res == '1'){
        	$data = [
	            'state' => 'success',
	            'message' =>'删除成功',
	        ];
        }else{
        	$data = [
	            'state' => 'false',
	            'message' =>'删除失败'.$res,
	        ];
        }
        return json($data);
	}
    //新增用户
    public function addUser(){
    	$model = model('User');
        $param = $this->param;
        $res = $model->addUser($param);// 查询数据
        if($res == '1'){
        	$data = [
	            'state' => 'success',
	            'message' =>'添加成功',
	        ];
        }else{
        	$data = [
	            'state' => 'false',
	            'message' =>'添加失败'.$res,
	        ];
        }
        
        return json($data);
	}
	
	//修改密码  管理员直接设置新密码的那种 就一个参数 新密码
	public function userUpdatePassword(){
		$model = model('User');
        $param = $this->param;
		$res = $model->userUpdatePassword($param);
		if($res == '1'){
        	$data = [
	            'state' => 'success',
	            'message' =>'修改成功',
	        ];
        }else{
        	$data = [
	            'state' => 'false',
	            'message' =>'修改失败'.$res,
	        ];
        }
        
        return json($data);
	}
}