<?php
class IndexAction extends CommonAction{

	public function index(){



		//部分推荐band"
				$bandRow = M('band')->order("band_recommend_num DESC")->limit(5)->select();
		//部分推荐concert
		$concertRow = M("concert")->where("is_posted = 1")->order("concert_recommend_num DESC")->limit(5)->select();


		//获取热门用户
		$name = $_SESSION["home"]["user_name"];
		if($name){
			$where = "user_name <> '$name'";
		}else{
			$where="";
		}
		$popUser = M("user")->where($where)->order("user_trust DESC")->limit(50)->select();



		$this->assign("popUser",$popUser);
		$this->assign("band",$bandRow);
		$this->assign("concert",$concertRow);
		$this->assign("cate","index");
		$this->display();
	}




	/**
	 * concert
	 */
	public function concert(){
		$city = $this->_get("city");
		$style = $this->_get("style");
		$date = $this->_get("date");
		$band_id = $this->_get("band_id");
		$name  = $this->_get("name");

		//get concert
		$where = array("is_posted"=>1);
		if($city){
			$where['concert_city'] = array("LIKE","%".$city."%");
		}
		if($style){
			$where['concert_style_id'] = array("LIKE","%,".$style.",%");
		}
		if($date){
			$where['concert_play_date'] = array("LIKE","%".$date."%");
		}
		if($band_id){
			$where['concert_band_id'] = array("LIKE","%,".$band_id.",%");
		}
		if($name){
			$where['concert_name'] = array("LIKE","%".$name."%");
		}
		

		$order = "concert_recommend_num DESC";
		$temp = $this->pageSingle("concert",array("where"=>$where,"order"=>$order));
		$concertRow = $temp['data'];
		$page = $temp['page'];

		//style
		$style = M("style")->select();

		//band
		$band = M("band")->select();

		// dump($concertRow);
		$this->assign("style",$style);
		$this->assign("band",$band);
		$this->assign("concert",$concertRow);
		$this->assign("page",$page);
		$this->assign("cate","concert");
		$this->display();
	}




	/**
	 * band
	 */
	public function band(){

		$id = $this->_get("id");
		$style = $this->_get("style");
		$name = $this->_get("name");

		//get concert
		$where = array();
		if($id){
			$where['id'] = $id;
		}
		if($style){
			$where['band_style_id'] = array("LIKE","%,".$style.",%");
		}
		if($name){
			$where['band_name'] = array("LIKE","%".$name."%");
		}

		$order = "band_recommend_num DESC";
		$temp = $this->pageSingle("band",array("where"=>$where,"order"=>$order));
		$concertRow = $temp['data'];
		$page = $temp['page'];


		//style
		$style = M("style")->select();

		// dump($concertRow);
		$this->assign("style",$style);
		$this->assign("band",$concertRow);
		$this->assign("page",$page);
		$this->assign("cate","band");
		$this->display();
	}
}
?>