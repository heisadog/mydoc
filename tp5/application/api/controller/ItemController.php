<?php
namespace app\api\controller;
use think\Controller;
class ItemController extends BaseCommon{//都继承BaseCommon.php了

	//查项目
	public function myitem(){
		$model = model('Item');
		$param = $this->param;
		$res = $model->getItemList($param);
		if($res){
        	$data = [
	            'state' => 'success',
	            'data' =>$res,
	        ];
        }else{
        	$data = [
	            'state' => 'false',
	            'message' =>'没有任何数据',
	        ];
        }
		return json($data);
	}
	/**
	 * 查项目 
	 * 带分页
	 * 2个关键词......
	 */
	public function adminItem(){
		$model = model('Item');
		$param = $this->param;
		$res = $model->adminItem($param);
		$data = [
	            'state' => 'success',
	            'data' =>$res,
	        ];
        return json($data);
	}
	//获取 某个项目的菜单（包括多级的章节菜单）
	public function itemMenu(){
		$model = model('Item');
		$param = $this->param;
		$res = $model->getItemMenu($param);
		if($res){
        	$data = [
	            'state' => 'success',
	            'data' =>$res,
	        ];
        }else{
        	$data = [
	            'state' => 'false',
	            'message' =>$res,
	        ];
        }
		return json($data);
	}
	//查询某个项目的详情
	public function getItemDtl(){
		$model = model('Item');
		$param = $this->param;
		$res = $model->getItemDtl($param);
		if($res){
        	$data = [
	            'state' => 'success',
	            'data' =>$res,
	        ];
        }else{
        	$data = [
	            'state' => 'false',
	            'message' =>$res,
	        ];
        }
		return json($data);
	}
	//修改项目信息 （仅限项目名字 和 描述）
	public function updateItem(){
		$model = model('Item');
		$param = $this->param;
		$res = $model->updateItem($param);
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
	//新增项目
	public function addItem(){
		$model = model('Item');
		$param = $this->param;
		$users = $this->getUserMessage($param['username']);
		$res = $model->addItem($param,$users);// 查询数据
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
	//删除项目
	public function deleteItem(){
		$model = model('Item');
		$param = $this->param;
		$res = $model->deleteItem($param);// 查询数据
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
	//删除项目 （假的删除 改变状态 不显示而已）









	/**
	 * 获取项目列表
	 * 想动态的根据传的参数查询
	 * */
	public function getlist_param(){
		$model = model('Item');
		//$param = $this->param;
		$key = input('key');
		$val = input('val');
		$res = $model->getlist_param($key,$val);
		if($res){
        	$data = [
	            'state' => 'success',
	            'data' =>$res,
	        ];
        }else{
        	$data = [
	            'state' => 'false',
	            'message' =>$res,
	        ];
        }
		return json($data);
	}
}
?>