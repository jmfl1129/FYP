<?php

$redirect_uri="http://你的微信开放平台绑定域名下处理扫码事件的方法";
$redirect_uri=urlencode($redirect_uri);//该回调需要url编码
$appID="你的appid";
$scope="snsapi_login";//写死，微信暂时只支持这个值
//准备向微信发请求
$url = "https://open.weixin.qq.com/connect/qrconnect?appid=" . $appID."&redirect_uri=".$redirect_uri
."&response_type=code&scope=".$scope."&state=STATE#wechat_redirect";
//请求返回的结果(实际上是个html的字符串)
$result = file_get_contents($url);
//替换图片的src才能显示二维码
$result = str_replace("/connect/qrcode/", "https://open.weixin.qq.com/connect/qrcode/", $result);
return $result; //返回页面

?>