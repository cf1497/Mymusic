// JavaScript Document by Richbox

/************************
 * left页面树状结构效果 *
 ************************/
/*function initTree(t) {
	var tree=document.getElementById(t);
	tree.style.display="none";
	var lis=tree.getElementsByTagName("li");
	//alert(lis.length);
	for(var i=0;i<lis.length;i++) {
		lis[i].id="li"+i;
		var uls=lis[i].getElementsByTagName("ul");
		if(uls.length!=0) {
			uls[0].id="ul"+i;
			uls[0].style.display="none";
			var as=lis[i].getElementsByTagName("a");
			as[0].id="a"+i;
			as[0].className="folder";
			as[0].href="#this";
			as[0].tget=uls[0];
			as[0].onclick=function() {
				openTag(this,this.tget);
			}
		}
	}
	tree.style.display="block";
}
function openTag(a,t) {
	if(t.style.display=="block") {
		t.style.display="none";
		a.className="folder";
	} else {
		t.style.display="block";
		a.className="";
	}

window.onload=function() {
	initTree("globalNav");
}

}*/

/***************************/

/*********************************
 * left页面树状结构效果 @wangrui *
 *********************************/
function initTree(t){
	
	var tree=$("#"+t);
	var folder = tree.find("li .first");
	var file = tree.find("div");
	var flag = folder.find(".flag");
	file.find("p a").prepend("<span>|----</span>")
	file.hide();//先让所有内容隐藏

	var lastIndex;//上一次点击的文件夹位置

	var status="hide";

	//点击文件夹
	folder.click(function(){
		var _folder = $(this).parent().parent();//当前点击的文件夹
		var _file = _folder.find("div");//当前点击的文件夹所对应的内容
		var _flag = _folder.find(".flag");
		//如果点击了同一个文件夹
		if(lastIndex == _folder.index()){
			//_file.slideToggle("fast");//让内容展示/收起
			if(status=="show"){
				_file.slideUp("fast",function(){});
				_flag.removeClass("open");status="hide";
			}else{
				_file.slideDown("fast",function(){});
				_flag.addClass("open");status="show";
			}
		}else{
			file.slideUp("fast",function(){});//先让所有文件收起来
			flag.removeClass("open");
			_file.slideDown("fast",function(){});//让内容展示
			_flag.addClass("open");status="show";
			lastIndex = _folder.index();//赋值给上一次点击的文件夹位置
		}
	})
}

//window就绪后调用
window.onload=function() {
	initTree("globalNav");
}
/***************************/



/************************
 * 定义操作cookie的方法 *
 ************************/
function setcookie(name,value,day){  
    var Days = day||30;  
    var exp  = new Date();  
    exp.setTime(exp.getTime() + Days*24*60*60*1000);  
    document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString();  
}  

function getcookie(name){  
    var arr = document.cookie.match(new RegExp("(^| )"+name+"=([^;]*)(;|$)"));  
    if(arr != null){  
        return (arr[2]);  
    }else{  
        return "";  
    }  
}  

function delcookie(name){  
    var exp = new Date();  
    exp.setTime(exp.getTime() - 1);  
    var cval=getCookie(name);  
    if(cval!=null) document.cookie= name + "="+cval+";expires="+exp.toGMTString();  
}
/***************************/


