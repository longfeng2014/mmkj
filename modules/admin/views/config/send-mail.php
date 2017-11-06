<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = '邮箱配置';
$this->params['breadcrumbs'][] = ['label' => '站点配置', 'url' => ['basic']];
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="config-form">
        <?=$this->render('_tab_menu');?>
        <?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal tasi-form']]); ?>
            <div class="form-group group-smtp">
                <label class="col-sm-2 col-xs-4 control-label">SMTP 身份验证</label>
                <div class="col-lg-3 col-sm-4 col-xs-4 input-group">
                    <label class="radio-inline">
                        <input type="radio" name="form[auth]" value="1" <?php if(isset($formParams['auth']) && $formParams['auth'] == 1) echo 'checked';?> >是
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="form[auth]" value="0" <?php if(isset($formParams['auth']) && $formParams['auth'] == 0) echo 'checked';?> >否
                    </label>
                </div>
            </div>
        <?php ActiveForm::end(); ?>

    </div>