<?php
header("Content-type: text/html; charset=utf-8");     
$appId = "wxac8239c9b56dfd72";
$appSecret = "185b3a37fa371480f5abeafa1c1ca2d5"; 
$code = $_GET['code']; 
//echo "code:  $code <br>";
//$data = json_decode(file_get_contents("access_token2.json"));
$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appId&secret=$appSecret&code=$code&grant_type=authorization_code";
$html = file_get_contents ( $url );
$res = json_decode($html,TRUE);
$openid = $res['openid'];
//$access_token = $res['access_token']; 
//echo "openid: $openid <br>";
 
//https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxac8239c9b56dfd72&redirect_uri=http://51touxi.com/mgj/query.php&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect

$access_token = $res['access_token'];

$url="https://api.weixin.qq.com/sns/userinfo?access_token=$access_token&openid=$openid&lang=zh_CN";
$html = file_get_contents ( $url );
$res2 = json_decode($html,TRUE);

$nickname=$res2['nickname'];
$sex=$res2['sex'];
$province=$res2['province'];
$city=$res2['city'];
$country=$res2['country'];
$headimgurl=$res2['headimgurl'];
//将这些信息存入数据库

	$sql="insert into authinfo(nickname,sex,province,city,country,headimgurl,openid) values ('".$nickname."','".$sex.
				"','".$province."','".$city."','".$country."','".$headimgurl."','".$openid."'".")"; 
	$link = mysqli_connect("hdm144528528.my3w.com","hdm144528528","zwxl123456","hdm144528528_db");
	if (!$link) {
		printf("数据库连接不上，请检查是否用户名与密码是否改变，Connect failed: %s\n", mysqli_connect_error());
		exit();
	} 
	mysqli_query($link, "SET NAMES UTF8");
	//printf(" $sql .\n");
	/* Create table doesn't return a resultset */
	if (mysqli_query($link,$sql) === TRUE) {
	//	printf(" 插入查询记录信息成功 .\n");
	}else
	{
	//	echo "   插入查询记录信息失败";
	}	
/**
   "openid":" OPENID",
   " nickname": NICKNAME,
   "sex":"1",
   "province":"PROVINCE"
   "city":"CITY",
   "country":"COUNTRY",
    "headimgurl":    "http://wx.qlogo.cn/mmopen/g3MonUZtNHkdmzicIlibx6iaFqAc56vxLSUfpb6n5WKSYVY0ChQKkiaJSgQ1dZuTOgvLLrhJbERQQ4eMsv84eavHiaiceqxibJxCfHe/46", 
**/

?>

<html charset=utf-8>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=0.8,user-scalable=no">
	<link rel="shortcut icon" href="/images/favicon.ico/images/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="a.css?t3652528403.02361" />
	<link rel="stylesheet" type="text/css" href="b.css?t3652528403.02361" />
	<link rel="stylesheet" type="text/css" href="public.css" />
    <link rel="stylesheet" type="text/css" href="mycss.css?20150921-2" />
	
	<link rel="stylesheet" type="text/css" href="./date/mobile-select-date.min.css">
	
	<script type="text/javascript">
			(function () { window.LF = { G: { ENV:7, DATA: {}, DM: { CK: "", STATIC: "", DYNAMIC: "", RES: "" } } }; }());
	</script>

   <style type="text/css">
		.td{color:#f00;  background-color: #0033FF;}
		input
		{
			BACKGROUND-COLOR: transparent;
			BORDER-BOTTOM: #ffffff 1px solid;
			BORDER-LEFT: #ffffff 1px solid;
			BORDER-RIGHT: #ffffff 1px solid;
			BORDER-TOP: #ffffff 1px solid;
			COLOR: #ffffff;
			HEIGHT: 22px;
			border:none;
			font-color:#fff;
			placeholder:#000;
			margin-left :10px;
			border-color: #ffffff #ffffff #ffffff #ffffff; font-size: 12pt
		}
		hr
		{
			border-bottom:0.45px solid #fff;
			font-size:14sp; 
			margin-top:0.5px;
			align:center;
			text-align:center;
			margin-left:25%;
			margin-right:25%;
			width:50%;color:#f0f; 
		}

		input::-webkit-input-placeholder, textarea::-webkit-input-placeholder { 
			color:    #feebb8;
		}
		input:-moz-placeholder, textarea:-moz-placeholder { 
			color:    #feebb8;
		}
		input::-moz-placeholder, textarea::-moz-placeholder { 
			color:    #feebb8;
		}
		input:-ms-input-placeholder, textarea:-ms-input-placeholder { 
			color:    #feebb8;
		}
	</style>


<script type="text/javascript">
 var CheckIdCard={  
	//Wi 加权因子 Xi 余数0~10对应的校验码 Pi省份代码  
	Wi:[7,9,10,5,8,4,2,1,6,3,7,9,10,5,8,4,2],  
	Xi:[1,0,"X",9,8,7,6,5,4,3,2],  
	Pi:[11,12,13,14,15,21,22,23,31,32,33,34,35,36,37,41,42,43,44,45,46,50,51,52,53,54,61,62,63,64,65,71,81,82,91],  

	//检验18位身份证号码出生日期是否有效  
	//parseFloat过滤前导零，年份必需大于等于1900且小于等于当前年份，用Date()对象判断日期是否有效。  
	brithday18:function(sIdCard){  
		var year=parseFloat(sIdCard.substr(6,4));  
		var month=parseFloat(sIdCard.substr(10,2));  
		var day=parseFloat(sIdCard.substr(12,2));  
		var checkDay=new Date(year,month-1,day);  
		var nowDay=new Date();  
		if (1900<=year && year<=nowDay.getFullYear() && month==(checkDay.getMonth()+1) && day==checkDay.getDate()) {  
			return true;  
		};  
	},  

	//检验15位身份证号码出生日期是否有效  
	brithday15:function(sIdCard){  
		var year=parseFloat(sIdCard.substr(6,2));  
		var month=parseFloat(sIdCard.substr(8,2));  
		var day=parseFloat(sIdCard.substr(10,2));  
		var checkDay=new Date(year,month-1,day);  
		if (month==(checkDay.getMonth()+1) && day==checkDay.getDate()) {  
			return true;  
		};  
	},  

	//检验校验码是否有效  
	validate:function(sIdCard){  
		var aIdCard=sIdCard.split("");  
		var sum=0;  
		for (var i = 0; i < CheckIdCard.Wi.length; i++) {  
			sum+=CheckIdCard.Wi[i]*aIdCard[i]; //线性加权求和  
		};  
		var index=sum%11;//求模，可能为0~10,可求对应的校验码是否于身份证的校验码匹配  
		if (CheckIdCard.Xi[index]==aIdCard[17].toUpperCase()) {  
			return true;  
		};  
	},  

	//检验输入的省份编码是否有效  
	province:function(sIdCard){  
		var p2=sIdCard.substr(0,2);  
		for (var i = 0; i < CheckIdCard.Pi.length; i++) {  
			if(CheckIdCard.Pi[i]==p2){  
				return true;  
			};  
		};  
	}  
};  

function valid(){
     var text1 = document.getElementById("text1").value;
     var text2 = document.getElementById("text2").value;
	 var text3 = document.getElementById("txt_date").value;
	if(text1==""){
		alert("身份证不能为空");
		return false;
	}
	 if(text2==""){
        alert("宝宝姓名不能为空");
        return false;
    }
	if(text3==""){
        alert("宝宝出身年月不能为空");
        return false;
     }
	 if(text3.length<10){
        alert("宝宝出身年月请填写完整");
        return false;
     }
	if(text1.length<18){
        alert("身份证长度不能低于18位");
        return false;
    }
	if(text1.length>19){
        alert("身份证长度不能大于19位");
        return false;
    }
	if(text2.length<2 ){
		alert("宝宝姓名长度不能低于2位");
		return false;
	} 
	if (text1.match(/^\d{14,17}(\d|X)$/gi)==null) {//判断是否全为18或15位数字，最后一位可以是大小写字母X  
            alert("身份证号码须为18位或15位数字");      //允许用户输入大小写X代替罗马数字的Ⅹ 
			return false;			
	}  
	else if (text1.length==18) {  
		if (CheckIdCard.province(text1)&&CheckIdCard.brithday18(text1)&&CheckIdCard.validate(text1)) {  
			//alert("身份证号码合法");  
		}  
		else{  
			alert("请输入有效的身份证号码");  
			return false;
		};  
	}  
	else if (text1.length==15) {  
		if (CheckIdCard.province(text1)&&CheckIdCard.brithday15(text1)) {  
		   // alert("身份证号码合法");  
		}  
		else{  
			alert("请输入有效的身份证号码"); 
			return false;				
		};  
	};
	 
    
    
     return true;
}
</script>
</head>
<body style=" padding:0px;margin:0px;align:center; ">


<form action ="query_result.php" onsubmit ="return valid();">
 <div class="container" style="width:auto;align:center;">
	
 <section class="top-bar2" style="background-color: #fff">
 <div style="background:  #f6f6ea fixed center center   no-repeat ; display:block;   text-align:center;	
	  background-position: center;    background-size: cover;   width:auto;"   />
	<!--儿童基因库文字-->
	<div class="theme" style="padding-top:120px">
		<img  id="DetialImg" src="2/1.png">
	</div>
	
	<!--信封-->	
	<div style="background:  url('2/2.png') center center	  no-repeat  scroll;
		background-attachment:scroll;
		padding-bottom:250px;		 
		text-align:center;
		margin-top:20px" >
		 
		<span class="top-bar2" style=" align:center; "  >
			<img src="2/4.png" style="margin-top:120px;margin-left:8%; "/>
			<input type= "text" placeholder="父亲或母亲身份证"  name="text1" id = "text1"  /> 
			<hr color="#fff" style="padding-bottom:5dp " >
		</span>
		
		<span class="top-bar2" style=" align:center; "  >
			<img src="2/5.png" style="margin-top:6px;margin-left:8%;  "/>
			<input  type= "text" placeholder="宝宝姓名"  name="text2" id = "text2"/> 
			<hr color="#fff" style="padding-bottom:5dp " >
		</span>
		
		<span class="top-bar2" style=" align:center; "  >
			<img src="2/6.png" style="margin-top:6px;margin-left:8%; "/>
		 
			<input type="text" id="txt_date"  name="text3"  placeholder="出生年月" value="2014-05-12"/>
		
					<script type="text/javascript" src="./date/zepto.min.js"></script>
					<script type="text/javascript" src="./date/dialog.min.js"></script>
					<script type="text/javascript" src="./date/mobile-select-date.js"></script>
					<script>
					var selectDate = new MobileSelectDate();
					selectDate.init({trigger:'#txt_date',value:'2011-03-02',min:'1990-01-01',max:'2016-02-11'});
					</script>
			<hr color="#fff" style="padding-bottom:5dp  " >
		</span>
		
		<input type=hidden name=openid value="<?php echo $openid?>">
		
		<!--查询-->	
		<span class="top-bar2" style=" align:center;padding-top:200px;
						margin-bottom:200px "  >
	
			
			<!--	<img src="2/3.png" 
					style="padding-top:20px;width:143px;height:30px;"/>
					查询按钮如何替换成图片	-->			
			<input type="submit"   value="" class="button orange"  
			style="padding-top:20px;width:143px;height:30px;background:url('2/3.png');background-size:cover"
		/>
		</span>
		

		
		
	</div>
 </div>
 </section> 
  </div>
  
</form> 
 

</body>
</html>

  
 