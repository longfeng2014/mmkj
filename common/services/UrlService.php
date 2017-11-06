<?php
namespace  common\services;

use yii\helpers\Url;

class UrlService {
	public static function buildMUrl( $path,$params = [] ){
		$domain_config = \Yii::$app->params['domain'];
		$path = Url::toRoute(array_merge([ $path ],$params));
		return $domain_config['wechat'] .$path;
	}

	/*public static function buildWebUrl( $path,$params = [] ){
		$domain_config = \Yii::$app->params['domain'];
		$path = Url::toRoute(array_merge([ $path ],$params));
		return $domain_config['admin'] .$path;
	}*/

	public static function buildWwwUrl( $path,$params = [] ){
		// $domain_config = \Yii::$app->params['domain'];
		$path = Url::toRoute(array_merge([ $path ],$params));
		return $path;
	}

	public static function buildNullUrl(){
		return "javascript:void(0);";
	}


	/*public static function buildPicUrl( $bucket,$file_key ){
		$domain_config = \Yii::$app->params['domain'];
		$upload_config = \Yii::$app->params['upload'];
		return $domain_config['www'].$upload_config[ $bucket ]."/".$file_key;
	}*/
}
