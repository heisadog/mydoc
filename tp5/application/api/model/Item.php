<?php
namespace app\api\model;
use think\Model;
use think\Db;
class Item extends Model{
	//查询项目
	public function getItemList($param){
		$item_type = $param['item_type'];
		if(empty($item_type)){
			$res = Db::table('item')->where('is_del','0')->select();
		}else {
			# code...
			$res = Db::table('item')->where('item_type',$item_type)->where('is_del','0')->select();
		}
		return $res;
	}
	//查项目
	public function adminItem($param){
		$item_name = $param['item_name'];
		$username = $param['username'];
		$page = $param['page'];
		$count = $param['count'];
		$res = Db::name('item')
			->where('item_name','like','%'.$item_name.'%')
			->where('username','like','%'.$username.'%')	
			->limit(($page-1)*$count,($page-1)*$count+$count)
			->select();
		$total = Db::name('item')
		->where('item_name','like','%'.$item_name.'%')
		->where('username','like','%'.$username.'%')
		->count();
		//处理时间
		if($res){
			foreach ($res as $key => $value) {
				# code...
				//$res[$key]['addtime'] = date('Y-m-d H:i:s',$value["addtime"]);
			};
		};
		$data =[
			'total'=>$total,
			'data'=>$res,
		];
        return $data;
	}

	// 查询项目菜单
	public function getItemMenu($param){
		$item_id = $param['item_id'];
		$keyword = $param['keyword'] || '';
		//查两个表的信息 章节表 和 文章表 
		$item = Db::table('item')->where('item_id',$item_id)->select();
		$cat = Db::table('cat')->where('item_id',$item_id)->select();
		$page = Db::table('page')->where('item_id',$item_id)->where('page_title','like','%'.$keyword.'%')->select();
		foreach ($cat as $key => $value) {
			# code...
			$cat[$key]['children'] = [];
		}
		$data =[
			'cat'=>$cat,
			'page'=>$page,
			'item'=>$item,
		];
		return $data;
	}
	//查询某个项目的详情
	public function getItemDtl($param){
		$item_id = $param['item_id'];
		$item = Db::table('item')->where('item_id',$item_id)->select();
		return $item;
	}
	//修改项目信息 
	public function updateItem($param){
		$item_id = $param['item_id'];
		$item_name = $param['item_name'];
		$item_description = $param['item_description'];
		$res = Db::table('item')
		->where('item_id',$item_id)
		->data([
			'item_name'=>$item_name,
			'item_description'=>$item_description,
		])
		->update();
		return $res;
	}

	//新增项目
	public function addItem($param,$users){
		$data = [
		'item_name' =>$param['item_name'],
		'item_type' =>$param['item_type'],
		'item_description' =>$param['item_description'],
		'username' => $users['username'],
		'uid' => $users['uid'],
		'is_del' =>0,
		'addtime' =>Date('Y-m-d H:i:s'),
		];
		$res = Db::table('item')->insert($data);
		return $res;
	}
	//删除项目
	public function deleteItem($param){
		$item_id = $param['item_id'];
		$res = Db::table('item')
		->where('item_id',$item_id)
		->delete();
		return $res;
	}











	//根据条件 动态查项目
	public function getlist_param($key,$val){
		$res = Db::table('item')->where($key,$val)->where('state','J')->select();
		return $res;
		
	}
}
?>