<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Admin */

$this->title = '编辑管理员';
$this->params['breadcrumbs'][] = ['label' => '管理员设置', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-update">

    <?=$this->render('_tab_menu');?>
    <div class="admin-form">
        <form id="w1" action="/admin/admin/update?id=<?=$model['id']?>" method="post">
            <!-- <input type="hidden" name="Admin['id']" value="<?=$model['id']?>"> -->
            <div class="form-group field-admin-username required has-error">
                <label class="control-label" for="admin-username">用户名</label>
                <input type="text" id="admin-username" class="form-control" name="Admin[username]" maxlength="15" style="" value="<?=$model['username']?>">
                <div class="help-block">用户名应该包含至少6个字符。</div>
            </div>
            <div class="form-group field-admin-password required has-success">
                <label class="control-label" for="admin-password">密码</label>
                <input type="password" id="admin-password" class="form-control" name="Admin[password]" style="" value="<?=$model['password']?>">
                <div class="help-block"></div>
            </div>
            <div class="form-group field-admin-mobile required">
                <label class="control-label" for="admin-mobile">手机号</label>
                <input type="text" id="admin-mobile" class="form-control" name="Admin[mobile]" style="" value="<?=$model['mobile']?>">
                <div class="help-block"></div>
            </div>
            <div class="form-group field-admin-email required">
                <label class="control-label" for="admin-email">Email</label>
                <input type="text" id="admin-email" class="form-control" name="Admin[email]" style="" value="<?=$model['email']?>">
                <div class="help-block"></div>
            </div>
            <div class="form-group field-admin-role_id required">
                <label class="control-label" for="admin-role_id">角色</label>
                <select class="form-control" name="Admin[role_id]" value="">
                    <option value="0">请选择角色</option>
                    <?php foreach ($roleList as $key => $value) {?>
                        <option value="<?php echo $value['id']?>"><?php echo $value['name']?></option>
                    <?php }?>
                </select>
            </div>
            <div class="form-group field-admin-shop_ids required">
                <label class="control-label" for="admin-shop_ids">门店</label>
                <select class="form-control" name="Admin[shop_ids]" value="">
                    <option value="3">1</option>
                    <option value="4">2</option>
                </select>
            </div>
            <div class="form-group field-admin-status">
                <label class="control-label">状态</label>
                    <input type="hidden" name="Admin[status]" value="<?php echo $model['status']?>">
                    <div id="admin-status">
                        <label><input type="radio" name="Admin[status]" value="0" <?php echo $model['status'] === 0 ? "checked" : "";?>> 禁用</label>
                        <label><input type="radio" name="Admin[status]" value="1" <?php echo $model['status'] === 1 ? "checked" : "";?>> 启用</label>
                    </div>
                <div class="help-block"></div>
            </div>
            <div class="form-group"><button type="submit" class="btn btn-success">保存</button></div>
        </form>
    </div>

</div>
