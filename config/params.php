<?php

return [
	'title' => '秘密空间',
	'configGroup' => [
				        1 => '基本配置',
				        2 => '邮箱配置',
				        3 => '附件配置',
				    ],
	'user.passwordResetTokenExpire' => 3600,
    'availableLocales' => [
        'en-US'=>'English (US)',
        'zh-CN' => '简体中文',
    ],
    'module_version' => [
        'admin' => '2017',
        'wechat' => '2017',
    ],
    'domain' => [
        // 'www' => 'http://www.mmkongjian.com',
        'wechat' => 'http://mmkj.com/wechat',
        'admin' => 'http://mmkj.com/admin'
    ],
	'weixin' => [
		'appid' => 'wxffc0246f2001ef21',
		'sk' => 'b6b89f1ce8a6e3e86e53ce6b0c5998bf',   //appsecret
		'token' => '6da0d35f150d4d5f9ee3708901aeb652',
		'aeskey' => '',
		/*'pay' => [
			'key' => '根据实际情况填写',
			'mch_id' => '根据实际情况填写',
			'notify_url' => [
				'm' => '/pay/callback'
			]
		]*/
	]
];
