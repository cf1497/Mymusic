<?php
class BandAction extends CommonAction{

	public function loginPage(){



		$this->style = $style;
		$this->cate = "ucenter";
		$this->display();
	}



	public function login(){

		if(isBandLogin()){
			$this->error();
		}

		$name = $this->_post("name");
		$pass = $this->_post("password");


		$band = M("band")->where("band_name = '$name' AND band_password = '$pass'")->find();

		if($band==false){
			$this->error("login fail");
		}else{

			$_SESSION["band_name"] = $name;

			$this->success("",U('Index/band'));
		}
	}


	public function quit(){

		unset($_SESSION["band_name"]);
		$this->success("",U("Index/band"));
	}



	public function registPage(){

		//style
		$style = M("style")->select();

		$this->cate="band";
		$this->style = $style;
		$this->display();
	}


	public function regist(){


		$name = $this->_post("name");
		$pass = $this->_post("password");
		$r_pass = $this->_post("r_pass");
		if($pass!=$r_pass){
			$this->error("password not the same.");
		}

		$style = ",".implode(",",$this->_post("style")).",";
		

		$addData = array(
			"band_name"=>$name,
			"band_password"=>$pass,
			"band_style_id"=>$style,
		);

		M("band")->add($addData);

		$this->success("",U("Index/band"));
	}



	function addConcertPage(){

		if(isBandLogin()==false){
			$this->error("please login first.",U("Band/loginPage"));
			exit;
		}
		$name = $_SESSION["band_name"];
		$band = M("band")->where("band_name = '$name'")->find();

		//get style
		$style = M("style")->select();


		$this->assign("style",$style);
		$this->assign("band",$band);
		$this->assign("cate","ucenter");

		$this->display();
	}



	public function addConcert(){

		if(isBandLogin()==false){
			$this->error("please login first.",U("Band/loginPage"));
			exit;
		}
		$bandname = $_SESSION["band_name"];
		$bandInfo = M("band")->where("band_name = '$bandname'")->find();

		$name = $this->_post("name");
		$band = $bandInfo['id'];
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
		);

		// dump($addData);
		M("concert")->add($addData);

		$this->success("",U("Index/concert"));
	}


	//available to post
	public function bandConcert(){

		if(isBandLogin()==false){
			$this->error("please login first.",U("Band/loginPage"));
			exit;
		}
		$bandname = $_SESSION["band_name"];
		$bandInfo = M("band")->where("band_name = '$bandname'")->find();

		$where = array(
			"band_id"=>array("LIKE","%,".$bandInfo['id'].",%"),
		);
		$concert = M("concert")->where($where)->select();

		$this->concert = $concert;
		$this->cate = "band";
		$this->display();
	}



	public function post(){
		if(isBandLogin()==false){
			$this->error("please login first.",U("Band/loginPage"));
			exit;
		}
		$bandname = $_SESSION["band_name"];
		$bandInfo = M("band")->where("band_name = '$bandname'")->find();

		$id = $this->_get("id");

		M("concert")->where("id = $id")->save(array("is_posted"=>1,"is_v"=>1));

		$this->success();
	}
}
?>