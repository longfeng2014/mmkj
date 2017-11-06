<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="YES" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no"/>
    <?php if($url && $delay>=0){ ?>
<meta http-equiv="refresh" content="<?php echo $delay ?>; url=<?php echo $url ?>" />
<?php }; ?>
    <title>提示信息</title>
    <link class="base-css" href="http://cdn.bangongyi.com/statics/common/wechat/css/common.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="/favicon.ico"/>
    <style type="text/css">
        .status{ padding: 60px 30px 0 30px;}
        .status dd{ padding: 30px 0; line-height: 25px; font-family: "microsoft yahei"; font-size: 16px; text-align: center;}
        .status dt{
            height: 70px;width: 70px; margin: 0 auto; background-repeat: no-repeat; background-size: 70px 70px; background-position: 0 0;}
        .success dt{ background-image: url(<?=CDN_URL?>statics/common/wechat/img/success.png?v=<?=STATIC_VERSION?>); }
        .error dt{ background-image: url(<?=CDN_URL?>statics/common/wechat/img/error.png?v=<?=STATIC_VERSION?>); }
        .info dt{ background-image: url(<?=CDN_URL?>statics/common/wechat/img/tip.png?v=<?=STATIC_VERSION?>); }
        .warning dt{ background-image: url(<?=CDN_URL?>statics/common/wechat/img/warning.png?v=<?=STATIC_VERSION?>); }
    </style>
    <?php if($script){ ?>
    <script type="text/javascript">
        <?php echo $script ?>
    </script>
    <?php }; ?>
    <?php if (!empty($this->context) and !empty($this->context->jsApiList)) {
        $wxInfo = \common\helpers\Helper::share($_GET['aid']?intval($_GET['aid']):Yii::$app->session['weaccount']['id']);
    ?>
    <script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.1.0.js"></script>
    <script>
        wx.config({
            debug: false,
            appId: "<?=$wxInfo['appId']?>",
            timestamp: "<?=$wxInfo['timestamp']?>",
            nonceStr: "<?=$wxInfo['nonceStr']?>",
            signature: "<?=$wxInfo['signature']?>",
            jsApiList: <?php if(count($this->context->jsApiList?:[])>0){echo "['".implode("','", $this->context->jsApiList)."','hideMenuItems','showMenuItems']";}else{echo "['hideMenuItems','showMenuItems']";}?>
        });
    <?php if (isset($scriptCode)) { ?>
    wx.ready(function() {
        setTimeout(function() {
            <?=$scriptCode?>;
        }, (parseInt('<?=$delay?>') || 0));
    });
    <?php } ?>
    </script>
    <?php } ?>
</head>
    <body>
        <dl class="status <?php echo $type ?>"<?php if($url){ echo ' onclick="location.href=\''.$url.'\'"';} ?>>
            <dt></dt>
            <dd><?php echo $message; ?></dd>
        </dl>
    </body>
</html>
