<?php
namespace app\api\model;
use think\Model;
use think\Db; 

class Cat extends Model{
	//获取 某个item的章节
	public function getItemCatList($param){
		$item_id = $param['item_id'];
		$res = Db::table('cat')->where('item_id',$item_id)->order('s_number', 'asc')->select();
		return $res;
	}
	//保存
	public function saveCat($param){
		$item_id = $param['item_id'];
		$parent_cat_id = $param['parent_cat_id'];
		$s_number = $param['s_number'] || "99";
		$cat_title = $param['cat_title'];
		//只有两级
		//如果 parent_cat_id 为0 则 level =1 不为0 level 为2
		$parent_cat_id == 0 ? ($level =1):($level= 2); 
		$data=[
				'item_id'=>$item_id,
				's_number'=>$s_number,
				'cat_title'=>$cat_title,
				'parent_cat_id'=>$parent_cat_id,
				'addtime'=>Date('Y-m-d H:i:s'),
				'level'=> $level,
			];
		$res = Db::table('cat')->insert($data);
		return $res;
	}
	//更新
	public function updateCat($param){
		$cat_id = $param['cat_id'];
		$parent_cat_id = $param['parent_cat_id'];
		$s_number = $param['s_number'];
		$cat_title = $param['cat_title'];
		$res = Db::table('cat')
			->where('cat_id',$cat_id)
			->data([
				'parent_cat_id'=>$parent_cat_id,
				's_number'=>$s_number,
				'cat_title'=>$cat_title,
			])
			->update();
		return $res;
	}
	//删除
	public function catDelete($param){
		$item_id = $param['item_id'];
		$cat_id = $param['cat_id'];
		$res = Db::table('cat')
		->where('cat_id',$cat_id)
		->delete();
		return $res;
	}
}
?>