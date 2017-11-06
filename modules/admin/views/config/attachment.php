<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = '附件配置';
$this->params['breadcrumbs'][] = ['label' => '站点配置', 'url' => ['basic']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
    .watermark_pos td{border: 1px solid #e5e1dd; padding: 10px 22px;}
    .watermark_pos label{font-weight: 400;}
</style>
    <div class="config-form">
        <?=$this->render('_tab_menu');?>
        <?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal tasi-form']]); ?>
            <div class="form-group">
                <label class="col-sm-2 col-xs-4 control-label">允许上传附件大小</label>
                <div class="col-lg-3 col-sm-4 col-xs-4 input-group pull-left">
                    <input type="text" value="<?=isset($formParams['attachment_size']) ? $formParams['attachment_size'] : '';?>" class="form-control" name="form[attachment_size]" size="100">
                </div>
                <div class="col-sm-4 col-xs-10"><span class="help-block"><i class="fa fa-info-circle"></i> KB</span></div>
            </div>
            
        <?php ActiveForm::end(); ?>

    </div>