<?php
use yii\helpers\Html;
use common\services\StaticService;
use common\admin\AdminAsset;
    StaticService::includeAppJsStatic( "/statics/admin/js/jquery.validate.min.js",AdminAsset::className() );
    StaticService::includeAppJsStatic( "/statics/admin/js/jquery.validate.js",AdminAsset::className() );
    StaticService::includeAppJsStatic( "/statics/admin/js/jquery.validate.bootstrap.js",AdminAsset::className() );
    StaticService::includeAppCssStatic( "/statics/admin/css/upload.css",AdminAsset::className() );
    $this->title = '会员管理';
    $this->params['breadcrumbs'][] = ['label' => '会员编辑', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-update">
    <?=$this->render('_tab_menu');?>
    <div class="admin-form">
        <form id="w1" action="/admin/member/edit?id=<?=$model['id']?>" method="post" class="validate">
            <!-- <input type="hidden" name="data['id']" value="<?=$model['id']?>"> -->
            <div class="form-group ">
                <label class="control-label" >昵称</label>
                <input type="text"  class="form-control required" name="data[username]" maxlength="15" style="" value="<?=$model['username']?>">
            </div>
            <div class="form-group">
                <label class="control-label">真实姓名</label>
                <input type="realname"  class="form-control required" name="data[realname]" style="" value="<?=$model['realname']?>">
                <div class="help-block"></div>
            </div>
            <div class="form-group">
                <label class="control-label">手机号</label>
                <input type="text" class="form-control required mobile" name="data[mobile]" style="" value="<?=$model['mobile']?>">
                <div class="help-block"></div>
            </div>
            <div class="form-group">
                <label class="control-label">性别</label>
                <input type="hidden" name="data[sex]" value="<?php echo $model['sex']?>">
                <div id="admin-sex">
                    <label><input type="radio" name="data[sex]" value="0" <?php echo $model['sex'] == 0 ? "checked" : "";?>> 未知</label>
                    <label><input type="radio" name="data[sex]" value="1" <?php echo $model['sex'] === 1 ? "checked" : "";?>> 男</label>
                    <label><input type="radio" name="data[sex]" value="2" <?php echo $model['sex'] === 2 ? "checked" : "";?>> 女</label>
                </div>
                <div class="help-block"></div>
            </div>
            <div class="form-group field-admin-email required">
                <label class="control-label" for="admin-email">Email</label>
                <input type="text" id="admin-email" class="form-control email" name="data[email]" style="" value="<?=$model['email']?>">
                <div class="help-block"></div>
            </div>
            <div class="form-group">
                <label class="control-label">头像上传</label>
                <div class="layui-upload">
                    <button type="button" class="layui-btn" id="headimgurl" style="margin-top: 23px; background-color: #5CB85C;">选择图片</button> 
                    <input type="hidden" nametext="data[headimgurl]" class="layui-img">
                    <div class="layui-upload-list headimgurl" style="float: right;"><!-- 展示图片的地方 -->
                        <span class="item_img">
                            <img src="<?php echo SITE_URL.$model['headimgurl']?>" class="img">
                            <input type="hidden" name="data['headimgurl']" value="<?php echo $model['headimgurl']?>">
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label">学生证上传</label>
                <div class="layui-upload">
                    <button type="button" class="layui-btn" id="student_img" style="margin-top: 23px; background-color: #5CB85C;">选择图片</button> 
                    <input type="hidden" nametext="data[student_img]" class="layui-img">
                    <div class="layui-upload-list student_img" style="float: right;"><!-- 展示图片的地方 -->
                        <span class="item_img">
                            <img src="<?php echo SITE_URL.$model['student_img']?>" class="img">
                            <input type="hidden" name="data['student_img']" value="<?php echo $model['student_img']?>">
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label">学生认证</label>
                <select class="form-control" name="data[student_status]" value="<?=$model['student_status']?>">
                    <option value="0" <?php echo $model['student_status'] === 0 ? "selected" : ""?>>未认证</option>
                    <option value="1" <?php echo $model['student_status'] === 1 ? "selected" : ""?>>已认证</option>
                </select>
            </div>
            <div class="form-group">
                <label class="control-label">身份证号码</label>
                <input type="text" class="form-control idcard" name="data[id_number]" style="" value="<?=$model['id_number']?>">
                <div class="help-block"></div>
            </div>
            
            <div class="form-group">
                <label class="control-label">消费额度积分</label>
                <input type="text" class="form-control" name="" style="" value="<?=$model['expense_points']?>">
                <div class="help-block"></div>
            </div>
            <!-- <div class="form-group">
                <label class="control-label">消费等级</label>
                <input type="text" class="form-control" name="" style="" value="<?=$model['level']?>">
                <div class="help-block"></div>
            </div> -->
            <div class="form-group">
                <label class="control-label">信用积分</label>
                <input type="text" class="form-control" name="data[credit_grade]" style="" value="<?php echo $model['credit_grade']?:0?>">
                <div class="help-block"></div>
            </div>
            <div class="form-group">
                <label class="control-label">状态</label>
                <input type="hidden" name="data[status]" value="<?php echo $model['status']?>">
                <label><input type="radio" name="data[status]" value="0" <?php echo $model['status'] == 0 ? "checked" : "";?>> 正常</label>
                <label><input type="radio" name="data[status]" value="1" <?php echo $model['status'] === 1 ? "checked" : "";?>> 禁用</label>
            </div>
            <div class="form-group button-su"><button type="submit" class="btn btn-success">保存</button></div>
        </form>
    </div>

</div>
<script type="text/javascript">
$(function($) {
    layui.use('upload', function(){
        var $ = layui.jquery,
        upload = layui.upload;
        //上传头像
        upload.render({
            elem: '#headimgurl',
            url: '/admin/upload/uploadimage',
            data: {},
            done: function(res){
                var imgName = 'data[headimgurl]';
                $('.headimgurl').html('<span class="item_img" id="' + res.imgid + '"><img src="/' + res.url + '" class="img" ><input type="hidden" name="'+imgName+'" value="' + res.url + '" /></span>')
            }
        });
        //上传学生证
        upload.render({
            elem: '#student_img',
            url: '/admin/upload/uploadimage',
            data: {},
            done: function(res){
                var imgName = 'data[student_img]';
                $('.student_img').html('<span class="item_img" id="' + res.imgid + '"><img src="/' + res.url + '" class="img" ><input type="hidden" name="'+imgName+'" value="' + res.url + '" /></span>')
            }
        });
    });
})
</script>
