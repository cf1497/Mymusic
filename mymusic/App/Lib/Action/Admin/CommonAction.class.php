<?php
/**
 * 通用控制器
 */
class CommonAction extends Action{

	/**
	 * 初始方法
	 */
	public function _initialize(){

		//判断登录
		$isLogin = $this->isLogin();
		if($isLogin==false){
			unset($_SESSION["admin"]);//清空后台session
			redirect("login/index");//跳转到后台登录页面
			exit;
		}
	}


	/**
	 * 判断是否已经登录
	 * 根据session来判断
	 * @return bool 已登录-true 未登录-false
	 */
	private function isLogin(){
		if(!$_SESSION['admin']["name"]){
			return false;
		}else{
			return true;
		}
	}
}
?>