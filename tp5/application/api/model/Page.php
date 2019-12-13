<?php
namespace app\api\model;
use think\Model;
use think\Db; 

class Page extends Model{
	//根据pageid查询文章内容
	public function getPageCont($param){
		$page_id = $param['page_id'];
		$res = Db::table('page')->where('page_id',$page_id)->select();
		return $res;
	}
	//根据文章id 获取 文章的章节信息 
	public function getDefaultCat($param){
		$page_id = $param['page_id'];
		$cat_id =  Db::table('page')->field('cat_id')->where('page_id',$page_id)->select();
		$cat_title = Db::table('cat')->field('cat_title')->where('cat_id',$cat_id[0]['cat_id'])->select();
		$data = [
			'cat_id'=>$cat_id[0]['cat_id'],
			'cat_title'=>$cat_title[0]['cat_title'],
		];
		return $data;
	}
	//文章的 更新 或者新增
	public function pageSave($param,$users){
		//根据 page_id 是否为0 判断是新增还是保存
		$page_id = $param['page_id'];
		$cat_id = $param['cat_id'];
		$item_id = $param['item_id'];
		$page_title = $param['page_title'];
		$page_content = $param['page_content'];
		$number = $param['number'];

		$author_name = $users['username'];
		$author_id = $users['uid'];
		if($page_id == 0){
			// 新增
			$data=[
				'item_id'=>$item_id,
				'cat_id'=>$cat_id,
				'page_title'=>$page_title,
				'page_content'=>$page_content,
				'number'=>$number,
				'author_name'=>$author_name,
				'author_id'=>$author_id,
				'addtime'=>time(),
				'is_del'=>0
			];
			$res = Db::table('page')->insert($data);
		}else{
			$res = Db::table('page')
			->where('page_id',$page_id)
			->data([
				'item_id'=>$item_id,
				'cat_id'=>$cat_id,
				'page_title'=>$page_title,
				'page_content'=>$page_content,
				'number'=>$number,
			])
			->update();
		};
		return $res;
	}









	//查询bug
	public function qrybug_m($itemid,$appointid,$state){
		//$sql ="SELECT * FROM bugs where ('' ='".$itemid."' or itemid ='".$itemid."') ";
		//原始语句
		//SELECT *,bugappoint.appointuid FROM bugs,bugappoint WHERE bugs.itemid ='4' AND bugs.state ='activation' and bugappoint.buguid =bugs.uid and bugappoint.appointuid = '6'
		$sqls ="SELECT *,bugappoint.appointuid,users.username as appointname FROM bugs,bugappoint,users WHERE users.uid = bugappoint.appointuid AND bugappoint.buguid = bugs.uid AND ('' ='".$itemid."' or bugs.itemid ='".$itemid."') AND ('' ='".$state."' or bugs.state ='".$state."') AND ('' ='".$appointid."' or bugappoint.appointuid = '".$appointid."')";
		$res = Db::query($sqls);
		return $res;
	}
}
?>