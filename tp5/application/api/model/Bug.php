<?php
namespace app\api\model;
use think\Model;
use think\Db; 

class Bug extends Model{
	//新增bug
	public function addbug_m($param){
		$res;
		$data = [
		'itemid' =>$param['itemid'],
		'bugtype' =>$param['bugtype'],
		'bugtitle' =>$param['bugtitle'],
		'bugdesc' =>$param['bugdesc'],
		'buglevel' =>$param['buglevel'],
		'prioritylevel' =>$param['prioritylevel'],
		'createtime' =>time(),
		'createname' =>$param['createname'],
		'state' =>'activation',//激活状态的
		];
		// 启动事务
		Db::startTrans();
		////添加数据后如果需要返回新增数据的自增主键，可以使用insertGetId方法新增数据并返回主键值：
		$bugId = Db::name('bugs')->insertGetId($data);//
	    $appoint = [
			'appointuid' => $param['appoint'],
			'buguid' => $bugId,
			];
		$res2 = Db::table('bugappoint')->insert($appoint);
		if($bugId && $res2){
			$res = 1;
			Db::commit();
		}else{
			// 回滚事务
		    Db::rollback();
		}
		return $res2;
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