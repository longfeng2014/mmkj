<html lang="zh" class="no-js">

<head>
    <meta charset="utf-8" />
    <title><?=Yii::t('yii', '提示消息')?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <meta name="MobileOptimized" content="320">
<?php if($url && $delay>=0){ ?>
<meta http-equiv="refresh" content="<?php echo $delay ?>; url=<?php echo $url ?>" />
<?php }; ?>

    <link rel="shortcut icon" href="/favicon.ico" />
<style>
body { color: #000; font-family: Microsoft YaHei, "微软雅黑", "宋体", Arial;padding: 0px !important;margin: 0px !important;font-size:13px; direction: ltr;}
.page-error {text-align: center;}
.page-error .number {position: relative;top: 35px;display: inline-block;letter-spacing: -10px;margin-top: 0px;margin-bottom: 10px;line-height: 128px;font-size: 128px;font-weight: 300;color: #7bbbd6;text-align: right;}
.page-error .details { background:url(/statics/common/admin/admin/img/error.png) no-repeat left #F2DEDE; border:1px solid #EED3D7;  border-radius:5px;color: #B94A48; margin: 0 auto; padding: 20px 30px 15px 90px; width: 360px;text-align:left;}
.type_success .details{ background:url(/statics/common/admin/admin/img/success.png) no-repeat left #DFF0D8;border:1px solid #D6E9C6;border-radius:5px; color: #468847; margin: 0 auto; padding: 20px 30px 15px 90px; width:360px;text-align:left;}
.type_info .details{ background:url(/statics/common/admin/admin/img/info.png) no-repeat left #D9EDF7;border:1px solid #BCE8F1;border-radius:5px; color: #3A87AD; margin: 0 auto; padding: 20px 30px 15px 90px; width:360px;text-align:left;}

.page-error-full-page {overflow: hidden;padding: 20px;background-color: #fafafa !important;}
.page-error-full-page .details input {background-color: #ffffff;}
.page-error-full-page .page-error {margin-top: 100px;}

@media (max-width: 480px) {
    .page-error .number,.page-error .details {text-align: center;margin-left: 0px;}
    .page-error-full-page .page-error {margin-top: 30px;}
}
</style>
    <?php if($script){ ?>
<script type="text/javascript">
    <?php echo $script ?>
</script>
<?php }; ?>
</head>

<body class="page-error-full-page">
   <div class="row">
      <div class="page-error type_<?php echo $type ?>">
         <div class="details">
            <h3><?php echo $message; ?><br /></h3>
            <?php if($url && $delay>=0){ ?>
            <p>
               系统将在<?php echo $delay ?>秒后自动<a href="<?php echo $url ?>">跳转</a>！
            </p>
            <?php } ?>
         </div>
      </div>
   </div>
</body>
</html>
