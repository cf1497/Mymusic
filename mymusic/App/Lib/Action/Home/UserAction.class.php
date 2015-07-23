<?php
class UserAction extends CommonAction{
	

	public function loginPage(){

		//is login
		$isLogin = isLogin();
		if($isLogin!=false){
			redirect("/");
			exit;
		}


		$this->display();
	}



	public function login(){

		$name = $this->_post("name");
		$password = $this->_post("password");

		if(!$name || !$password){
			$this->error("please input user name and password.");
			exit;
		}

		//check
		$userInfo = M("user")->where("user_name = '$name' AND user_password = '$password'")->field("id")->find();

		if(!$userInfo){
			$this->error("failed! you maight have some mistakes on user name or the password.");
			exit;
		}

		$_SESSION["home"]["user_name"] = $name;

		//积分+10
		$saveData = array(
			"user_trust"=>array("exp","user_trust+10"),
		);
		M("user")->where("user_name = '$name'")->save($saveData);

		$this->success("welcome!",U("Index/index"));
	}





	public function quit(){

		unset($_SESSION["home"]);
		$this->success("Thank you!",U("Index/index"));
	}




	public function index(){

		if(isLogin()==false){
			$this->error("please login first.",U("User/loginPage"));
			exit;
		}
		$name = $_SESSION["home"]["user_name"];
		$userInfo = M("user")->where("user_name = '$name'")->find();


		//读取content
		$whereContent = array(
			"post_user"=>$name,
		);
		$orderContent = "post_time DESC";
		$contentData = $this->pageSingle("content",array("where"=>$whereContent,"order"=>$orderContent));
		$contentRow = $contentData["data"];
		$page = $contentData["page"];


		$this->assign("page",$page);
		$this->assign("content",$contentRow);
		$this->assign("user",$userInfo);
		$this->assign("cate","ucenter");
		$this->display();
	}



	public function followPage(){

		if(isLogin()==false){
			$this->error("please login first.",U("User/loginPage"));
			exit;
		}
		$name = $_SESSION["home"]["user_name"];
		$userInfo = M("user")->where("user_name = '$name'")->find();

		$watchIds = trim($userInfo["user_watch_id"],",");

		$where["id"] = array("IN",$watchIds);
		$watchRow = M("user")->where($where)->select();

		$this->assign("watch",$watchRow);
		$this->assign("cate","ucenter");
		$this->display();
	}



	public function follow(){
		if(isLogin()==false){
			$this->error("please login first.",U("User/loginPage"));
			exit;
		}
		$name = $_SESSION["home"]["user_name"];
		$userInfo = M("user")->where("user_name = '$name'")->find();

		$userId = $this->_get("id");
		$oldFollow = $userInfo["user_watch_id"];

		$follow = rtrim($oldFollow,",").",$userId,";

		M("user")->where("user_name = '$name'")->save(array("user_watch_id"=>$follow));

		$this->success();
	}


	public function quitFollow(){
		if(isLogin()==false){
			$this->error("please login first.",U("User/loginPage"));
			exit;
		}
		$name = $_SESSION["home"]["user_name"];
		$userInfo = M("user")->where("user_name = '$name'")->find();

		$watch_id = $this->_get("id");
		if(!$watch_id){
			$this->error();
		}

		$watch = str_replace(",$watch_id,","",$userInfo["user_watch_id"]);
		$watch = ",".trim($watch,",").",";
		
		//dump($watch);

		M("user")->where("user_name = '$name'")->save(array("user_watch_id"=>$watch));
		$this->success();
	}





	public function editProfilePage(){
		if(isLogin()==false){
			$this->error("please login first.",U("User/loginPage"));
			exit;
		}
		$name = $_SESSION["home"]["user_name"];
		$userInfo = M("user")->where("user_name = '$name'")->find();

		$this->assign("cate","ucenter");
		$this->assign("user",$userInfo);
		$this->display();
	}



	public function editProfile(){

		if(isLogin()==false){
			$this->error("please login first.",U("User/loginPage"));
			exit;
		}
		$name = $_SESSION["home"]["user_name"];

		$city = $this->_post("city");
		$birthday = $this->_post("birthday");

		if(!$city || !$birthday){
			$this->error("please fill the blanks");
			exit;
		}

		$temp = explode("-",$birthday);
		if(count($temp)!=3){
			$this->error("please write the right birthday");
			exit;
		}

		M("user")->where("user_name = '$name'")->save(array("user_city"=>$city,"user_birthday"=>$birthday));

		$this->success("edit success",U("User/index"));
	}



	public function profile(){
		
		if(isLogin()==false){
			$this->error("please login first.",U("User/loginPage"));
			exit;
		}

		$name = $this->_get("name");
		if(!$name){
			$this->error();
			exit;
		}

		$userInfo = M("user")->where("user_name = '$name'")->find();


		//post
		$content = M("content")->where("post_user = '$name'")->order("post_time DESC")->select();
		
		$this->assign("content",$content);
		$this->assign("user",$userInfo);
		$this->assign("cate","ucenter");
		$this->display();
	}



	public function comment(){
		if(isLogin()==false){
			$this->error("please login first.",U("User/loginPage"));
			exit;
		}
		$name = $_SESSION["home"]["user_name"];

		$content_id = $this->_post("id");
		$comment = $this->_post("comment");
		if($content_id==false or !$comment){
			$this->error();
		}

		$addData = array(
			"content_id"=>$content_id,
			"comment"=>$comment,
			"comment_user"=>$name,
		);

		M("comment")->add($addData);

		$this->success();
	} 



	public function like(){
		if(isLogin()==false){
			$this->error("please login first.",U("User/loginPage"));
			exit;
		}
		$name = $_SESSION["home"]["user_name"];

		$content_id = $this->_get("id");
		if(!$content_id){
			$this->error();
		}

		$saveData = array(
			"like_num"=>array("exp","like_num+1"),
		);

		M("content")->where("id = $content_id")->save($saveData);

		$addData = array(
			"like_user"=>$name,
			"content_id"=>$content_id,
		);
		M("comment")->add($addData);

		$this->success();
	}



	/**
	 * rate乐队
	 */
	public function rateBand(){
		if(isLogin()==false){
			$this->error("please login first.",U("User/loginPage"));
			exit;
		}
		$name = $_SESSION["home"]["user_name"];
		$userInfo = M("user")->where("user_name = '$name'")->find();


		$bandId = $this->_get("id");
		if(!$bandId){
			$this->error();
		}

		$addData = array(
			"type_id"=>2,
			"rate_id"=>$bandId,
			"rate_user_id"=>$userInfo["id"],
			"rate_user_name"=>$name,
		);

		M("rate")->add($addData);

		M("band")->where("id = $bandId")->save(array("band_recommend_num"=>array("exp","band_recommend_num+1")));


		$this->success();
	}


	/**fan a band*/
	public function fanBand(){
		if(isLogin()==false){
			$this->error("please login first.",U("User/loginPage"));
			exit;
		}
		$name = $_SESSION["home"]["user_name"];
		$userInfo = M("user")->where("user_name = '$name'")->find();


		$bandId = $this->_get("id");
		if(!$bandId){
			$this->error();
		}

		//band
		$band = M("band")->where("id = $bandId")->find();

		$addData = array(
			"band_id"=>$bandId,
			"band_name"=>$band["band_name"],
			"user_name"=>$name,
			"user_id"=>$userInfo["id"],
		);


		M("fans")->add($addData);

		$this->success();
	}



	public function myBand(){
		if(isLogin()==false){
			$this->error("please login first.",U("User/loginPage"));
			exit;
		}
		$name = $_SESSION["home"]["user_name"];
		$userInfo = M("user")->where("user_name = '$name'")->find();

		//fans band
		$fans = M("fans")->where("user_name = '$name'")->select();

		$this->assign("cate","ucenter");
		$this->assign("band",$fans);
		$this->display();
	}


	public function quitFans(){
		if(isLogin()==false){
			$this->error("please login first.",U("User/loginPage"));
			exit;
		}
		$name = $_SESSION["home"]["user_name"];
		$userInfo = M("user")->where("user_name = '$name'")->find();

		$id = $this->_get("id");
		if($id==false){
			$this->error();
		}

		M("fans")->where("id = $id")->delete();

		$this->success();
	}


	public function addConcertPage(){
		if(isLogin()==false){
			$this->error("please login first.",U("User/loginPage"));
			exit;
		}
		$name = $_SESSION["home"]["user_name"];
		$userInfo = M("user")->where("user_name = '$name'")->find();

		//get style
		$style = M("style")->select();

		//get band
		$band = M("band")->select();

		$this->assign("style",$style);
		$this->assign("band",$band);
		$this->assign("cate","ucenter");
		$this->display();
	}



	public function addConcert(){
		if(isLogin()==false){
			$this->error("please login first.",U("User/loginPage"));
			exit;
		}
		$name = $_SESSION["home"]["user_name"];
		$userInfo = M("user")->where("user_name = '$name'")->find();

		if($userInfo["user_trust"]<100){
			$this->error("you don't have enough trust");
		}

		$name = $this->_post("name");
		$band = $this->_post("band");
		$style = ",".implode(",",$this->_post("style")).",";
		$city = $this->_post("city");
		$date = $this->_post("date");
		$time = $this->_post("time");

		$addData = array(
			"concert_name"=>$name,
			"concert_band_id"=>$band,
			"concert_style_id"=>$style,
			"concert_city"=>$city,
			"concert_play_date"=>$date,
			"concert_play_time"=>$time,
			"is_posted"=>1,
		);

		// dump($addData);
		M("concert")->add($addData);

		$this->success("",U("User/index"));
	}


	/**
	 * 发表状态
	 */
	public function postPage(){
		if(isLogin()==false){
			$this->error("please login first.",U("User/loginPage"));
			exit;
		}
		$name = $_SESSION["home"]["user_name"];
		$userInfo = M("user")->where("user_name = '$name'")->find();

		$this->assign("cate","ucenter");
		$this->display();
	}

	public function post(){
		if(isLogin()==false){
			$this->error("please login first.",U("User/loginPage"));
			exit;
		}
		$name = $_SESSION["home"]["user_name"];
		$userInfo = M("user")->where("user_name = '$name'")->find();

		$content = $this->_post("content");
		if($content==false){
			$this->error();
		}

		$addData = array(
			"post_user"=>$name,
			"content"=>$content,
			"post_time"=>date("Y-m-d H:i:s",time()),
		);

		M("content")->add($addData);

		$this->success("",U("User/index"));
	}



	public function reviewPage(){

		// if(isLogin()==false){
		// 	$this->error("please login first.",U("User/loginPage"));
		// 	exit;
		// }
		// $name = $_SESSION["home"]["user_name"];
		// $userInfo = M("user")->where("user_name = '$name'")->find();

		$concert_id = $this->_get("id");

		if(!$concert_id){
			$this->error();
		}

		//concert
		$concert = M("concert")->where("id = $concert_id")->find();

		//review
		$review = M("review")->where("concert_id = $concert_id")->order("post_time DESC")->select();

		$this->assign("review",$review);
		$this->assign("concert",$concert);
		$this->assign("cate","concert");
		$this->display("/Index/reviewPage");
	}



	public function review(){

		if(isLogin()==false){
			$this->error("please login first.",U("User/loginPage"));
			exit;
		}
		$name = $_SESSION["home"]["user_name"];
		$userInfo = M("user")->where("user_name = '$name'")->find();

		$concert_id = $this->_post("concert_id");

		if(!$concert_id){
			$this->error();
		}

		$addData = array(
			"concert_id"=>$concert_id,
			"content" =>$this->_post("content"),
			"user_id" =>$userInfo["id"],
			"user_name"=>$name,
			"post_time" => date("Y-m-d H:i:s",time()),
			"concert_name" => $this->_post("concert_name"),
		);

		M("review")->add($addData);

		$this->success();
	}



	public function rateConcert(){

		if(isLogin()==false){
			$this->error("please login first.",U("User/loginPage"));
			exit;
		}
		$name = $_SESSION["home"]["user_name"];
		$userInfo = M("user")->where("user_name = '$name'")->find();

		$concert_id = $this->_get("id");

		if(!$concert_id){
			$this->error();
		}

		$addData = array(
			"type_id"=>1,
			"rate_id"=>$concert_id,
			"rate_user_id"=>$userInfo['id'],
			"rate_user_name"=>$name,
		);

		M("rate")->add($addData);

		M("concert")->where("id = $concert_id")->save(array("concert_recommend_num"=>array("exp","concert_recommend_num+1")));

		$this->success();
	}



	//add concert to a list
	public function listConcert(){

		if(isLogin()==false){
			$this->error("please login first.",U("User/loginPage"));
			exit;
		}
		$name = $_SESSION["home"]["user_name"];
		$userInfo = M("user")->where("user_name = '$name'")->find();

		$concert_id = $this->_get("id");

		if(!$concert_id){
			$this->error();
		}

		$concert = M("concert")->where("id = $concert_id")->find();

		$addData = array(
			"concert_id"=>$concert_id,
			"concert_name"=>$concert["concert_name"],
			"user_id"=>$userInfo['id'],
			"user_name"=>$name,
		);

		M("list")->add($addData);

		$this->success();

	}



	//my concert in the list
	public function concertList(){
		if(isLogin()==false){
			$this->error("please login first.",U("User/loginPage"));
			exit;
		}
		$name = $_SESSION["home"]["user_name"];
		$userInfo = M("user")->where("user_name = '$name'")->find();

		$list = M("list")->where("user_name = '$name'")->select();

		$this->assign("concert",$list);
		$this->assign("cate","ucenter");
		$this->display();
	}


	//get the concert out of the list
	public function outList(){
		if(isLogin()==false){
			$this->error("please login first.",U("User/loginPage"));
			exit;
		}
		$name = $_SESSION["home"]["user_name"];
		$userInfo = M("user")->where("user_name = '$name'")->find();

		$id = $this->_get("id");

		if ($id==false) {
			$this->error();
		}

		M("list")->where("id = $id")->delete();

		$this->success();
	}



	//regist page
	public function registPage(){
		if(isLogin()==true){
			$this->error("please logout first.",U("User/index"));
			exit;
		}


		$this->assign("cate","ucenter");
		$this->display();
	}


	//regist
	public function regist(){

		if(isLogin()==true){
			$this->error("please logout first.",U("User/index"));
			exit;
		}

		if($this->_post("password")!=$this->_post("r_pass")){
			$this->error("password are not the same.");
		}

		$name = $this->_post("name");
		$password = $this->_post("password");
		$mail = $this->_post("mail");
		$birthday = $this->_post("birthday");
		$city = $this->_post("city");

		$addData = array(
			"user_name"=>$name,
			"user_password"=>$password,
			"user_mail"=>$mail,
			"user_birthday"=>$birthday,
			"user_city"=>$city,
		);

		M("User")->add($addData);

		$this->success("",U("User/loginPage"));
	}
}
?>