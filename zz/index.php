<?php
//QQ收款码的内容
$QQcode='https://i.qianbao.qq.com/wallet/sqrcode.htm?m=tenpay&f=wallet&a=1&ac=CAEQ2pGchgoYrp35iwY%3D_xxx_sign&u=2697398490&n=%E5%87%8C%E5%AF%92.%E5%B0%8F%E5%A4%A9%E5%B7%A5%E4%BD%9C%E5%AE%A4';

//微信收款码的内容
$wechat='https://payapp.weixin.qq.com/qrpay/order/home2?key=idc_CHNDVI_O0tZYzNZIWMzT.EdMY63Cw--';

//支付宝的收款内容
$alipay='https://qr.alipay.com/fkx09571h6osds8wmdcalfd';

//QQ号(用于显示头像)
$qq='972227772';

error_reporting(0);
include 'phpqrcode.php';
$ua=$_SERVER['HTTP_USER_AGENT'];
$errorCorrectionLevel = 'L';//容错级别 
$matrixPointSize = 6;//生成图片大小 
if(strpos($ua,'QQ/')!==FALSE){
	$form='QQ支付';
	$rgb='18,199,240';//蓝色背景
	QRcode::png($QQcode, false, $errorCorrectionLevel, $matrixPointSize,1); 
}else
if(strpos($ua,'MicroMessenger')!==FALSE){
	$form='微信支付';
	$rgb='50,205,50';//绿色背景
	QRcode::png($wechat, false, $errorCorrectionLevel, $matrixPointSize,1); 
}else
if(strpos($ua,'AlipayClient')!==FALSE){
	$form='支付宝支付';
	$rgb='0,178,238';//天蓝背景
	header("location:".$alipay);//支付宝直接跳转就行了
	QRcode::png($alipay, false, $errorCorrectionLevel, $matrixPointSize,1); 
}else{
	$form='请在手机端打开';//默认微信支付
	$rgb=rand(0,255).','.rand(0,255).','.rand(0,255);//默认随机验证
	QRcode::png($wechat, false, $errorCorrectionLevel, $matrixPointSize,1); 
}
$imgstr = 'data:png;base64,' .base64_encode(ob_get_contents());
ob_end_clean();
?>
<html><head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title><? echo $form;?></title>
<meta itemprop="name" content="三合一收款码">
<meta itemprop="image" content="https://ae01.alicdn.com/kf/HTB1d1g2d2WG3KVjSZFP760aiXXaq.png">
<meta name="description" itemprop="description" content="将支付宝.微信.QQ收款码集合到一起，打造最简洁的收款服务。">
<link href="http://api.lhxt.xyz/%E9%B9%B0%E6%BD%AD%E6%8A%80%E5%B7%A5%E8%A1%A8%E7%99%BD%E5%A2%99%E5%AE%98%E7%BD%91/zz/css/style.css" rel="stylesheet">
</head>
<body id="color" style="background-color: rgb(<?echo$rgb;?>);">
<div class="code-item" id="code-all" style="display: block; height: 574px;">
  <div id="ui-head" class="ui-panel ui-flex-pack-center ui-flex-align-center">
    <img class="ui-qlogo" id="qlogo" src="https://q2.qlogo.cn/headimg_dl?spec=100&amp;dst_uin=<?php echo $qq;?>">
    <div><h1>扫码支付</h1><h2 id="qnick"><? echo $form;?></h2></div>
  </div>
  <div class="ui-box ui-panel ui-flex-align-center">
    <div id="ui-content" class="ui-panel ui-flex-ver ui-flex-pack-center">
      <div class="ui-tips">手机<? echo $form;?></div>
      <br>
      <div class="ui-qrcode"><img id="page-url" src="<?php echo $imgstr; ?>"></div>
      <div class="ui-paytext"></div>
      <div id="ui-setps" class="ui-panel ui-flex-pack-center">
        <div>
          <div class="ui-circle">1</div>
          <i class="icon iconfont icon-changan"></i>
          <div class="ui-padtop10">长按二维码</div>
        </div>
        <div>
          <div class="ui-circle">2</div>
          <i class="icon iconfont icon-erweima"></i>
          <div class="ui-padtop10">扫描二维码</div>
        </div>
        <div>
          <div class="ui-circle">3</div>
          <i class="icon iconfont icon-icon-check-solid"></i>
          <div class="ui-padtop10">输入金额支付</div>
        </div>
      </div>
    </div>
  </div>
</div>
</body></html>