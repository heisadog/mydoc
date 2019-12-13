<?php
namespace app\api\controller;
use think\Controller;
class BugController extends BaseCommon{
	//新增bugs
	public function addbug(){
		$model = model('Bug');
		$param = $this->param;
		//验证指派人员 是否为空 
		if(empty($param['appoint'])){
			$data = [
	            'state' => 'false',
	            'message' =>'新增失败，指派文员不能为空！',
	        ];
	        return json($data);
		}
		if(empty($param['bugtitle'])){
			$data = [
	            'state' => 'false',
	            'message' =>'新增失败，问题名称不能为空！',
	        ];
	        return json($data);
		}
		$res = $model ->addbug_m($param);
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
	//查询 bug
	public function qrybug(){
		$model = model('Bug');
		$param = $this->param;
		//三个参数 项目的id 指派人员  状态
		//这里涉及到2个表 查询 （人员是另一个表的）
		//当然 这里可以全部放在一个 表中，这是为了练习 所以多个表
		$itemid = !empty($param['itemid']) ? $param['itemid'] : '';
		$appointid = !empty($param['appointid']) ? $param['appointid']: '';
		$state = !empty($param['state']) ? $param['state']: '';
		$res = $model ->qrybug_m($itemid,$appointid,$state);
		if($res || $res ==[]){
			$data = [
	            'state' => 'success',
	            'data' =>$res,
	            'cont' =>[$itemid,$appointid,$state],
	        ];
			
		}else{
			$data = [
	            'state' => 'false',
	            'message' =>'查询失败',
	        ];
		}
		
		return json($data);
	}
}
?>