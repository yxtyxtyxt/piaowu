<?php
	require_once "jssdk.php";
	$jssdk = new JSSDK("wxcf909f561285fcb9", "b3b2360f266828754bd7b418cdbcd0c4");
	$signPackage = $jssdk->GetSignPackage();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
  <title></title>
  <link rel="stylesheet" href="http://cdn.amazeui.org/amazeui/2.7.2/css/amazeui.min.css">
  
</head>
<body>
  	<button type="button" class="am-btn am-btn-primary am-btn-block" id="btn">扫一扫</button>
  	<button type="button" class="am-btn am-btn-primary am-btn-block" id="locBtn">获取地理位置</button>
</body>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>


<script>
  /*
   * 注意：
   * 1. 所有的JS接口只能在公众号绑定的域名下调用，公众号开发者需要先登录微信公众平台进入“公众号设置”的“功能设置”里填写“JS接口安全域名”。
   * 2. 如果发现在 Android 不能分享自定义内容，请到官网下载最新的包覆盖安装，Android 自定义分享接口需升级至 6.0.2.58 版本及以上。
   * 3. 常见问题及完整 JS-SDK 文档地址：http://mp.weixin.qq.com/wiki/7/aaa137b55fb2e0456bf8dd9148dd613f.html
   *
   * 开发中遇到问题详见文档“附录5-常见错误及解决办法”解决，如仍未能解决可通过以下渠道反馈：
   * 邮箱地址：weixin-open@qq.com
   * 邮件主题：【微信JS-SDK反馈】具体问题
   * 邮件内容说明：用简明的语言描述问题所在，并交代清楚遇到该问题的场景，可附上截屏图片，微信团队会尽快处理你的反馈。
   */
  wx.config({
    debug: false,
    appId: '<?php echo $signPackage["appId"];?>',
    timestamp: '<?php echo $signPackage["timestamp"];?>',
    nonceStr: '<?php echo $signPackage["nonceStr"];?>',
    signature: '<?php echo $signPackage["signature"];?>',
    jsApiList: [
      // 所有要调用的 API 都要加到这个列表中
      'scanQRCode',
      'getLocation',
      'openLocation'
    ]
  });
  wx.ready(function(){
    // 在这里调用 API
    var btn=document.querySelector("#btn");
    btn.addEventListener("touchstart",function(element){
			    wx.scanQRCode({
					    needResult: 0, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
					    scanType: ["qrCode","barCode"], // 可以指定扫二维码还是一维码，默认二者都有
			    success: function (res) {
			    		var result = res.resultStr; // 当needResult 为 1 时，扫码返回的结果
					}
				});
			})
  });
  
  //地理位置的接口
  wx.ready(function(){
  	var locBtn=document.querySelector("#locBtn");
		 locBtn.addEventListener("touchstart",function(element){
		 	    wx.getLocation({
			    	type: 'wgs84', // 默认为wgs84的gps坐标，如果要返回直接给openLocation用的火星坐标，可传入'gcj02'
			    	success: function (res) {
				        var latitude = res.latitude; // 纬度，浮点数，范围为90 ~ -90
				        var longitude = res.longitude; // 经度，浮点数，范围为180 ~ -180。
				        var speed = res.speed; // 速度，以米/每秒计
				        var accuracy = res.accuracy; // 位置精度
				        wx.openLocation({
								    latitude: latitude, // 纬度，浮点数，范围为90 ~ -90								
								    longitude: longitude, // 经度，浮点数，范围为180 ~ -180。								
								    name: '大房子', // 位置名								
								    address: '大房子', // 地址详情说明								
								    scale: 25, // 地图缩放级别,整形值,范围从1~28。默认为最大								
								    infoUrl: 'http://www.baidu.com' // 在查看位置界面底部显示的超链接,可点击跳转
								});
			     	}
		    });
		 });
 });
</script>
</html> 