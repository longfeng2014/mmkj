<?php
namespace modules\wechat\controllers;

use common\helpers\HttpClient;
use common\services\ConstantMapService;
use common\services\QueueListService;
use common\services\UrlService;
use common\models\member\Member;
use common\models\member\OauthMemberBind;
use models\QueueList;

class OauthController extends BaseController {
	/**
	 * 登录
	 * @return [type] [description]
	 */
	public function actionLogin(){
		$scope = $this->get( "scope","snsapi_base" );//默认静默登录
		$appid = \Yii::$app->params['weixin']['appid'];
		$redirect_uri = UrlService::buildMUrl( "/oauth/callback" );
		$url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$appid}&redirect_uri={$redirect_uri}&response_type=code&scope={$scope}&state=#wechat_redirect";

		return $this->redirect( $url );
	}

	public function actionCallback(){
		$code = $this->get( "code","" );
		if( !$code ){
			return $this->goHome();
		}

		//通过code 获取网页授权的access_token
		$appid = \Yii::$app->params['weixin']['appid'];
		$sk = \Yii::$app->params['weixin']['sk'];
		$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$appid}&secret={$sk}&code={$code}&grant_type=authorization_code";

		$ret = HttpClient::get( $url );
		$ret = @json_decode( $ret,true );
		$ret_token = isset( $ret['access_token'] )?$ret['access_token']:'';
		if( !$ret_token ){
			return $this->goHome();
		}

		$openid = isset( $ret['openid'] )?$ret['openid']:'';
		$scope = isset( $ret['scope'] )?$ret['scope']:'';

		$this->setCookie( $this->auth_cookie_current_openid,$openid );


		// $reg_bind = OauthMemberBind::find()->where([ 'openid' => $openid,'type' => ConstantMapService::$client_type_wechat ])->one();

		// if( $reg_bind ){
		// 	$member_info = Member::findOne( [ 'id' => $reg_bind['member_id'],'status' => 1 ] );
		// 	if( !$member_info ){
		// 		$reg_bind->delete();
		// 		return $this->goHome();
		// 	}
			if( $scope == "snsapi_userinfo" ){
				$url = "https://api.weixin.qq.com/sns/userinfo?access_token={$ret_token}&openid={$openid}&lang=zh_CN";
				$wechat_user_info = HttpClient::get( $url );
				var_dump($wechat_user_info);die;
				// $wechat_user_info = @json_decode( $wechat_user_info,true );
				// //这个时候做登录特殊处理，例如更新用户名和头像等等新
				// if( $member_info->avatar == ConstantMapService::$default_avatar ){
				// 	//需要做一个队列数据库了
				// 	//$wechat_user_info['headimgurl']
				// 	QueueListService::addQueue( "member_avatar",[
				// 		'member_id' => $member_info['id'],
				// 		'avatar_url' => $wechat_user_info['headimgurl'],
				// 	] );
				// }

				// if( $member_info['nickname'] == $member_info['mobile'] ){
				// 	$member_info->nickname = isset( $wechat_user_info['nickname'] )?$wechat_user_info['nickname']:$member_info->nickname;
				// 	$member_info->update( 0 );
				// }
			}
		// 	//设置登录态
		// 	$this->setLoginStatus( $member_info );
		// }else{
		// 	$this->removeLoginStatus();
		// }

		return $this->redirect( UrlService::buildMUrl( "/default/index" ) );
	}

	public function actionLogout(){
		$this->removeLoginStatus();
		$this->removeCookie( $this->auth_cookie_current_openid );
		return $this->goHome();
	}
}