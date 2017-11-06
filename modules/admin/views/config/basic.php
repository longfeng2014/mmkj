<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = '基本配置';
$this->params['breadcrumbs'][] = ['label' => '站点配置', 'url' => ['basic']];
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="config-form">
        <?=$this->render('_tab_menu');?>
        <?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal tasi-form']]); ?>
            <div class="form-group">
                <label class="col-sm-2 col-xs-4 control-label">网站名称</label>
                <div class="col-lg-4 col-sm-6 col-xs-6 input-group pull-left">
                    <input type="text" class="form-control" name="form[sitename]" value="<?=isset($formParams['sitename']) ? $formParams['sitename'] : '';?>">
                </div>
                <div class="col-sm-4 col-xs-10"><span class="help-block"><i class="fa fa-info-circle"></i> 一般不超过80个字符</span></div>
            </div>
        <?php ActiveForm::end(); ?>

    </div>