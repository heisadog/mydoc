<?php
namespace app\api\model;
use think\Model;
use think\Db; 

class Temp extends Model{
	//获取模版列表
	public function getList($param){
		$res = Db::table('temp')->select();
		return $res;
	}
	//模版保存
	public function tempSave($param){
		$temp_name = $param['temp_name'];
		$temp_cont = $param['temp_cont'];
		$data=[
				'temp_name'=>$temp_name,
				'temp_cont'=>$temp_cont,
				'temp_time'=>Date('Y-m-d H:i:s'),
			];
		$res = Db::table('temp')->insert($data);
		return $res;
	}
	//模版删除
	public function tempDelete($param){
		$id = $param['id'];
		$res = Db::table('temp')
		->where('id',$id)
		->delete();
		return $res;
	}
}
?>