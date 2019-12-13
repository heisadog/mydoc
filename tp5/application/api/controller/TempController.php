<?php
namespace app\api\controller;//注意写准确命名空间
use think\Controller;
class TempController extends BaseCommon{
	//获取模版列表
	public function getList(){
		$model = model('Temp');
		$param = $this->param;
		$res = $model->getList($param);
		$data = [
	            'state' => 'success',
	            'data' =>$res,
	        ];
		return json($data);
	}
	//模版保存
	public function tempSave(){
		$model = model('Temp');
		$param = $this->param;
		$res = $model->tempSave($param);
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
	//模版删除
	public function tempDelete(){
		$model = model('Temp');
		$param = $this->param;
		$res = $model->tempDelete($param);
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