<?php
/***
 * 用户
 * 
 * */
namespace app\api\model;

use think\Model;
use think\Db;
class User extends Model{
	//登录
	public function login($param){
		$username = $param['username'];
		$res = Db::name('users')->field('username,password')->where('username', $username)->select();
		return $res;
	}
	//获取所有的用户
	public function getUserList($param){
		//三个参数  名字 like搜索 
		//分页
		$username = $param['username'];
		$page = $param['page'];
		$count = $param['count'];
		if($username == ''){
			$res = Db::name('users')
			->field('password',true)
			->limit(($page-1)*$count,($page-1)*$count+$count)
			->select();
			$total = Db::name('users')->count();
		}else{
			$res = Db::name('users')
			->field('password',true)
			->where('username','like',$username.'%')
			->limit(($page-1)*$count,($page-1)*$count+$count)
			->select();
			$total = Db::name('users')->where('username','like',$username.'%')->count();
		}
		$data =[
			'total'=>$total,
			'data'=>$res,
		];
        return $data;
	}
	//删除用户
	public function deleteUser($param){
		$uid = $param['uid'];
		$res = Db::table('users')
		->where('uid',$uid)
		->delete();
		return $res;
	}
	//新增用户
	public function addUser($param){
		$username = $param['username'];
		$password =  md5(md5($param['password']));
		$data = [
			'username' => $username,
			'password' => $password, 
			'groupid' =>'2',
			'reg_time'=>time(),
		];
		$res = Db::name('users')->insert($data);
		return $res;
	} 
	//修改密码
	public function userUpdatePassword($param){
		$uid = $param['uid'];
		$password = md5(md5($param['new_password']));
		$res = Db::table('users')
		->where('uid',$uid)
		->data([
			'password'=>$password,
		])
		->update();
		return $res;
	}
}	