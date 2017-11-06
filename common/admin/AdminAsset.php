<?php
namespace common\admin;

use common\services\UrlService;
use yii\web\AssetBundle;

class AdminAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
    ];
	public function registerAssetFiles( $view ){
		//加一个版本号,目的 ： 是浏览器获取最新的css 和 js 文件
        $admin_version = \Yii::$app->params['module_version']['admin'];
		$this->css = [
			UrlService::buildWwwUrl( "/statics/admin/css/style.css",[ 'ver' => $admin_version ] ),
			UrlService::buildWwwUrl( "/statics/admin/layui/css/layui.css"),
		];
		$this->js = [
            UrlService::buildWwwUrl( "/statics/admin/js/jquery.min.js"),
            UrlService::buildWwwUrl( "/statics/admin/layui/layui.js"),
			UrlService::buildWwwUrl( "/statics/admin/js/jquery.nicescroll.js"),
            UrlService::buildWwwUrl( "/statics/admin/js/jquery-ui-1.9.2.custom.min.js"),
            // UrlService::buildWwwUrl( "/statics/admin/js/bootstrap.min.js"),
			// UrlService::buildWwwUrl( "/js/web/common.js",[ 'ver' => $admin_version ] ),
		];
		parent::registerAssetFiles( $view );
	}

    public $depends = [
        "yii\web\YiiAsset",
        "yii\bootstrap\BootstrapAsset",
        "yii\web\AssetBundle",
    ];

    public $jsOptions = [
            'position' => \yii\web\View::POS_HEAD,
    ];


}
