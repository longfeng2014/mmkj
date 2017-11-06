<?php
use yii\bootstrap\Nav;

echo Nav::widget([
    'items' => [
        [
            'label' => '会员列表',
            'url' => ['member/index'],
        ],
        [
            'label' => '添加会员',
            'url' => ['member/edit'],
        ],
    ],
    'options' => ['class' => 'nav-tabs'],
]);