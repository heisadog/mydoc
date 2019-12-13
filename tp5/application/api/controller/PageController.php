<?php
namespace app\api\controller;
use think\Controller;
class PageController extends BaseCommon{
	//根据pageid查询文章内容
	public function getPageCont(){
		$model = model('Page');
		$param = $this->param;
		$res = $model->getPageCont($param);
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
	//根据文章id 获取 文章的章节信息 
	public function getDefaultCat(){
		$model = model('Page');
		$param = $this->param;
		$res = $model->getDefaultCat($param);
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
	//文章的 更新 或者新增
	public function pageSave(){
		$model = model('Page');
		$param = $this->param;
		$users = $this->getUserMessage($param['username']);
		$res = $model->pageSave($param,$users);
		//卧槽 存在一个问题 当更新的数据与原来的数据相同的时候，返回的结果为0；所以 这里换了验证方式
		if($res !== false){
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
}

?>