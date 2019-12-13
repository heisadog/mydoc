<?php
namespace app\api\controller;//注意写准确命名空间
use think\Controller;
class CatController extends BaseCommon{
	//获取 某个item的章节
	public function getItemCatList(){
		$model = model('Cat');
		$param = $this->param;
		$res = $model->getItemCatList($param);
		$data = [
	            'state' => 'success',
	            'data' =>$res,
	        ];
		return json($data);
	}
	//章节 保存
	public function saveCat(){
		$model = model('Cat');
		$param = $this->param;
		$res = $model->saveCat($param);
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
	//章节 更新
	public function updateCat(){
		$model = model('Cat');
		$param = $this->param;
		$res = $model->updateCat($param);
		if($res !== false){
        	$data = [
	            'state' => 'success',
	            'message' =>'保存成功',
	        ];
        }else{
        	$data = [
	            'state' => 'false',
	            'message' =>'保存成功'.$res,
	        ];
        }
        return json($data);
	}
	//删除
	public function catDelete(){
		$model = model('Cat');
		$param = $this->param;
		$res = $model->catDelete($param);
		if($res !== false){
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
}
?>