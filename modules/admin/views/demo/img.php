<?php 
use common\services\StaticService;
use common\admin\AdminAsset;
    StaticService::includeAppJsStatic( "/statics/admin/js/upload.js",AdminAsset::className() );
    StaticService::includeAppCssStatic( "/statics/admin/css/upload.css",AdminAsset::className() );
?>
 
<div class="layui-upload">
  <button type="button" class="layui-btn" id="single">图片上传</button> 
    <input type="hidden" nametext="Demo['s']" class="layui-img">
  <div class="layui-upload-list">
     <!-- 展示图片的地方 -->
  </div>
</div>   
 
 
<div class="layui-upload">
  <button type="button" class="layui-btn" id="test2">多图片上传</button> 
  <blockquote class="layui-elem-quote layui-quote-nm" style="margin-top: 10px;">
    <input type="hidden" nametext="Demo['s']" class="layui-imgs">
    预览图：
    <div class="layui-upload-lists">
         <!-- 展示图片的地方 -->
    </div>
 </blockquote>
</div>
