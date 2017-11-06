<?php
namespace common\services\weixin;

use common\components\HttpClient;
use common\models\member\OauthAccessToken;
use common\services\BaseService;

class RequestService extends  BaseService {
	private  static $app_token = "";
	private  static $appid = "";
	private  static $app_secret = "";

	private static $url = "https://api.weixin.qq.com/cgi-bin/";

	/**
	 * 获取AccessToken
	 * @return [type] [description]
	 */
	public static function getAccessToken(){
		$date_now = time();
		$access_token_info = OauthAccessToken::find()->where([ '>','expired_time' , $date_now ])->limit(1)->one();
		if( $access_token_info ){
			return $access_token_info['access_token'];
		}

		$path = 'token?grant_type=client_credential&appid='.self::getAppId().'&secret='.self::getAppSecret();
		$res = self::send($path);
		if( !$res ){
			return self::_err( self::getLastErrorMsg() );
		}

		//存入accesstoken
		$model_access_token = new OauthAccessToken();
		$model_access_token->access_token = $res['access_token'];
		$model_access_token->expired_time = integer($res['expires_in'] + time() - 200);			//有效期减200秒
		$model_access_token->created_time = $date_now;
		$model_access_token->save( 0 );
		return $res['access_token'];
	}

	/**
	 * 微信发送http请求接口方法
	 * @param  [type] $path   路径后缀
	 * @param  array  $data   发送数据
	 * @param  string $method 发送方式
	 * @return [type]         [description]
	 */
	public static function send($path,$data=[],$method = "GET"){

		$request_url = self::$url.$path;

		if( $method == "POST"){
			$res = HttpClient::post($request_url,$data);
		}else{
			$res = HttpClient::get($request_url,[]);
		}

		$ret = @json_decode( $res,true );
		if( !$ret || ( isset( $res['errcode'] ) && $res['errcode'] )  ){
			return self::_err( $res['errmsg'] );
		}
		return $ret;
	}

	/**
	 * 设置公众号配置参数
	 * @param  [type] $appid      [description]
	 * @param  [type] $app_token  [description]
	 * @param  [type] $app_secret [description]
	 */
	public static function setConfig($appid ,$app_token,$app_secret){
		self::$appid = $appid;
		self::$app_token = $app_token;
		self::$app_secret = $app_secret;
	}

	public static function getAppId(){
		return self::$appid;
	}

	public static function getAppSecret(){
		return self::$app_secret;
	}

	public static function getAppToken(){
		return self::$app_token;
	}
}