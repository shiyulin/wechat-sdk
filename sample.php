<?php
require_once "jssdk/jssdk.php"; // sae平台下直接换成 jssdk-sae.php 即可
$jssdk = new JSSDK("appId", "appSecret"); // 请更换成自己的微信公众号的 $appId 和 $appSecret
$signPackage = $jssdk->GetSignPackage();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initital-scale=1">
  <title>测试JS-SDK</title>
</head>
<body>
      <button id="btn">点击选图</button>
</body>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
  // 注意：所有的JS接口只能在公众号绑定的域名下调用，公众号开发者需要先登录微信公众平台进入“公众号设置”的“功能设置”里填写“JS接口安全域名”。 
  // 如果发现在 Android 不能分享自定义内容，请到官网下载最新的包覆盖安装，Android 自定义分享接口需升级至 6.0.2.58 版本及以上。
  // 完整 JS-SDK 文档地址：http://mp.weixin.qq.com/wiki/7/aaa137b55fb2e0456bf8dd9148dd613f.html
	wx.config({
		debug:true,
		appId: '<?php echo $signPackage["appId"];?>',
		timestamp: <?php echo $signPackage["timestamp"];?>,
		nonceStr: '<?php echo $signPackage["nonceStr"];?>',
		signature: '<?php echo $signPackage["signature"];?>',
		jsApiList: [
			// 所有要调用的 API 都要加到这个列表中
			"onMenuShareTimeline",
			"chooseImage",
			"previewImage",
			"uploadImage"
		]
	});
	wx.ready(function () {
		document.getElementById("btn").onclick = function(){
			
			wx.chooseImage({
				success:function(res){
					var localIds = res.localIds;
				}
			});
		}
	});
</script>
</html>
