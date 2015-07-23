<?php

function getStyle($id){

	$id = trim($id,",");

	$where['id'] = array("in",$id);

	$styleRow = M("style")->where($where)->field("id,style_name")->select();

	return $styleRow;
}


function isLogin(){

	$user_name = $_SESSION["home"]["user_name"];

	if($user_name){
		return true;
	}else{
		unset($_SESSION['home']);
		return false;
	}
}


function getBand($id){
	$id = explode(",",trim($id,","));
	$where['id'] = array("IN",$id);
	$bandInfo = M("band")->where($where)->find();
	return $bandInfo["band_name"];
}




function isFollowed($id){
	$user_name = $_SESSION["home"]["user_name"];
	$self = M("user")->where("user_name = '$user_name'")->find();
	$oldFollow = explode(",",trim($self["user_watch_id"],","));

	if(in_array($id,$oldFollow)){
		return true;
	}else{
		return false;
	}
}

function getComment($id){
	$comment = M("comment")->where("content_id = $id and like_user is null")->select();

	//dump(M("comment")->getLastSql());
	//dump($comment) ;
	return $comment;
}


function isLiked($id){
	$user_name = $_SESSION["home"]["user_name"];
	$islike = M("comment")->where("content_id = $id and like_user = '$user_name'")->find();
	//dump($islike);
	if($islike){
		return true;
	}else{
		return false;
	}
}



function isRated($type,$rate_id){
	if($type=="concert"){
		$type_id = 1;
	}else{
		$type_id = 2;
	}

	$user_name = $_SESSION["home"]["user_name"];

	$where["rate_user_name"] = $user_name;
	$where["type_id"]=$type_id;
	$where["rate_id"]=$rate_id;
	$rate = M("rate")->where($where)->find();

	if($rate){
		return true;
	}else{
		return false;
	}
}


function isAdded($concert_id){

	$user_name = $_SESSION["home"]["user_name"];

	$where["concert_id"] = $concert_id;
	$where["user_name"] = $user_name;
	$list = M("list")->where($where)->find();
	if($list){
		return true;
	}else{
		return false;
	}
}



function isFans($band_id){

	$user_name = $_SESSION["home"]["user_name"];

	$where["band_id"] = $band_id;
	$where["user_name"] = $user_name;
	$fan = M("fans")->where($where)->find();
	if($fan){
		return true;
	}else{
		return false;
	}
}


function isBandLogin(){

	$band_name = $_SESSION["band_name"];

	if($band_name){
		return true;
	}else{
		unset($_SESSION['band_name']);
		return false;
	}
}


function isPosted($id){

	$concert = M("concert")->where("id = $id AND is_posted = 1")->find();


	if($concert){
		return true;
	}else{
		return false;
	}
}


function isV($id){
	$concert = M("concert")->where("id = $id AND is_v = 1")->find();

	// dump($concert);

	if($concert){
		return true;
	}else{
		return false;
	}
}

?>