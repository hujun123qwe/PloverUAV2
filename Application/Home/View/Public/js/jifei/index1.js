var eValue3,eValue4,price=0;
var auth_code='';
var bod_trans_time,bod_id,bod_area,bod_farm,bod_size,bod_status,bod_price,bod_linkman_name,bod_linkman_mobile,bod_linkman_address,bod_serverman_name,bod_serverman_mobile,bod_serverman_address;
var href=window.location.href;
var local=href.split("payment", 1);
auth_code=href.split("auth_code=")[1];
  $(function(){
	$(".down").click(function(){
		$(".blog").hide();
	});
	$(".ok").click(function(){
		$(".blog").hide();
	});
  	$.ajax({
     url : local+"payment/order/orderPubData.do?tradeId=orderPubData",
     type : "POST",
     data : {
	     },
	     success: function(xml) { // 请求成功后回调函数 参数：服务器返回数据,数据格式.
                    $("#times").empty();
//                    console.log(xml);
                    // 用Jquery处理xml数据
                    $("#area2").empty();
                        var level2 = $(xml).find("level2").text();
                        sessionStorage.eValue3 = $(xml).find("level3").text();
                        sessionStorage.eValue4= $(xml).find("level4").text();
                        var eValue2 = JSON.parse(level2);
                        for(var o in eValue2){
					       $("#area2").append("<option value =" + o + ">" + eValue2[o] + "</option>");
					    }
                        changeArea();
                    $("#crops").empty();
                        var crops = $(xml).find("farmString").text();
                        var cropsAll = JSON.parse(crops);
                         for(var o in cropsAll){
					       $("#crops").append("<option value =" + o + ">" + cropsAll[o] + "</option>");
					    }
					 sessionStorage.price = $(xml).find("price").text();
					$("#money").val(sessionStorage.price+"元");
                },
		});
  	});
function submit(){
	var vArea2=document.getElementById("area2");
	var vArea3=document.getElementById("area3");
	var vArea4=document.getElementById("area4");
	var v2=vArea2.options[vArea2.selectedIndex].text;
	var v3=vArea3.options[vArea3.selectedIndex].text;
	var v4=vArea4.options[vArea4.selectedIndex].text;
	var vArea2Value=document.getElementById("area2").value;
	var vArea3Value=document.getElementById("area3").value;
	var vArea4Value=document.getElementById("area4").value;
	var vAreaValue=vArea2Value+"|"+vArea3Value+"|"+vArea4Value;
	if(vArea2==""){
		alert("请选择省份");
		return;
	}
	if(vArea3==""){
		alert("请选择市区");
		return;
	}
	var areatext=v2+v3+v4;//30
	var crops=document.getElementById("crops");
	var cropsValue=document.getElementById("crops").value;//作物值
	var cropsName=crops.options[crops.selectedIndex].text;//作物名称
	var proportion=document.getElementById("proportion").value;//面积
	var payDate=document.getElementById("selDate").value;
	var callName=document.getElementById("callName").value;
	var callTel=document.getElementById("callTel").value;
	var callAddr=document.getElementById("callAdd").value;
	var serName=document.getElementById("serName").value;
	var serTel=document.getElementById("serTel").value;
	var serAddr=document.getElementById("serAdd").value;
	var mark=document.getElementById("mark").value;
	var pattern = new RegExp("^\\d+(\\.\\d)?$");
	if(!pattern.test(proportion) ){
		alert("请输入正确的作物面积！");
		return;
	}else if(proportion==""){
		alert("请输入作物面积！");
		return;
	}else if(parseInt(proportion)<100){
		alert("作物面积不能少于100亩！");
		return;
	}
	if(callName==""){//30
		alert("请输入联系人姓名！");
		return;
	}
	if(payDate==""){//30
		alert("请选择作业日期！");
		return;
	}
	if(callAddr=="" && serAdd.length()>20){
		alert("请输入联系人地址！");//200
		return;
	}
	if(serName==""){
		alert("请输入服务对象姓名！");
		return;
	}
	if(serAddr==""){
		alert("请输入服务对象地址！");
		return;
	}
	var patternPH = /^1[3|5|8][0-9]\d{4,8}$/;
	if(callTel.trim().length !=11 || serTel.trim().length !=11){
		alert("请输入正确的11位手机号");
		return;
	}else if(!patternPH.test(callTel) || !patternPH.test(serTel)){
		alert("请输入正确的11位手机号");
		return;
	}
	if(auth_code=="" || auth_code==undefined){
		alert("未能正常获取到您的id信息，请重新进入页面");
		return;
	}
	sessionStorage.vAreaValue=vAreaValue;
	sessionStorage.areatext=areatext;
	sessionStorage.cropsValue=cropsValue;
	sessionStorage.cropsName=cropsName;
	sessionStorage.bod_size=proportion;
	sessionStorage.bod_trans_time=payDate;
	sessionStorage.bod_linkman_name=callName;
	sessionStorage.bod_linkman_mobile=callTel;
	sessionStorage.bod_linkman_address=callAddr;
	sessionStorage.bod_serverman_name=serName;
	sessionStorage.bod_serverman_mobile=serTel;
	sessionStorage.bod_serverman_address=serAddr;
	sessionStorage.bod_user_mark=mark;

	window.location.href="confirm.html?auth_code="+auth_code;
 };
//计算金额
function changeMoney(){
  	var puerAmt =$.trim($("#proportion").val());
  	var price1=sessionStorage.price;
	puerAmt = parseInt(puerAmt)*parseInt(price1);
	$("#money").empty();
	$("#money").val(puerAmt+"元");
}
//市区方法
function changeArea(){
	var vArea2=document.getElementById("area2").value;
	var d=vArea2.substring(0,2);
	$("#area3").empty();
	$("#area4").empty();
	var are3 = Array();
	are3 = [1,[],]
// 		  		console.log(are3);
    for(var o in are3){
    var vArea3=o.substring(0,2);
    	if(vArea3==d){
    		$("#area3").append("<option value =" + o + ">" + are3[o] + "</option>");
    	}
    }
    changeMuni();
}
//县区方法
function changeMuni() {
	var vArea3 = document.getElementById("area3").value;
	var d = vArea3.substring(0, 4);
	$("#area4").empty();
	var level4 = sessionStorage.eValue4;
	var are4 = JSON.parse(level4);
	for ( var o in are4) {
		var vArea4 = o.substring(0, 4);
		if (vArea4 == d) {
			$("#area4").append(
					"<option value =" + o + ">" + are4[o] + "</option>");
		}
	}
}
//根据手机号 确定运营商类型
function defineYYT(){
	var pattern = /^1[3|5|8][0-9]\d{4,8}$/;
	var phoneNo= document.getElementById("callTel").value;
	if(phoneNo.trim().length !=11){
		alert("请输入正确的11位手机号");
	}else if(!pattern.test(phoneNo)){
		alert("请输入正确的11位手机号");
	}
}
function defineYYS(){
	var pattern = /^1[3|5|8][0-9]\d{4,8}$/;
	var phoneNo= document.getElementById("serTel").value;
	if(phoneNo.trim().length !=11){
		alert("请输入正确的11位手机号");
	}else if(!pattern.test(phoneNo)){
		alert("请输入正确的11位手机号");
	}
}
//提示弹窗alert
function popup(val){
	$(".b_txt").html(val);
	$(".blog").show();
}