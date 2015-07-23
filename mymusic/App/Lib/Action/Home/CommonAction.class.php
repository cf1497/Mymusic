<?php
class CommonAction extends Action{



	/**
	 * 一张表分页
	 * 不能关联查询
	 * @param string $table 表名称
	 * @param string $listRows 每页显示的记录数
	 * @param string/array $where 查询条件
	 * @param string/array $field 字段
	 * @param string $order 排序
	 * @return array(data=>数据,page=>分页变量)
	 */
	protected function pageSingle($table,$param=array()){

		$listRows = empty($param['listRows'])? 20 : $param['listRows'];
		$where    = empty($param['where'])? array() : $param['where'];
		$field    = empty($param['field'])? "*" : $param['field'];
		$order    = empty($param['order'])? "" : $param["order"];

		//获取总记录数
		$total = M($table)->where($where)->count();

		//初始化分页类
		import("@.ext.Page");
		$page = new page(array("total_rows"=>$total,"list_rows"=>20));

		//分页查询
		$row = M($table)->field($field)->where($where)->limit($page->first_rows,$page->list_row)->order($order)->select();

		//分页变量
		$p = $page->show(1);

		return array(
			"data"=>$row,
			"page"=>$p,
		);
	}

}
?>