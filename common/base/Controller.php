<?php
/**
 * 控制器基类
 *
 */

namespace common\base;

use Yii;
use common\helpers\Helper;

class Controller extends \yii\web\Controller
{
    public $enableCsrfValidation = false;

    public function post($key, $default = "") {
        return \Yii::$app->request->post($key, $default);
    }

    public function get($key, $default = "") {
        return \Yii::$app->request->get($key, $default);
    }

    protected function setCookie($name,$value,$expire = 0){
        $cookies = \Yii::$app->response->cookies;
        $cookies->add( new \yii\web\Cookie([
            'name' => $name,
            'value' => $value,
            'expire' => $expire
        ]));
    }

    protected  function getCookie($name,$default_val=''){
        $cookies = \Yii::$app->request->cookies;
        return $cookies->getValue($name, $default_val);
    }


    protected function removeCookie($name){
        $cookies = \Yii::$app->response->cookies;
        $cookies->remove($name);
    }

    protected function renderJSON($data=[], $msg ="ok", $code = 200)
    {
        header('Content-type: application/json');
        echo json_encode([
            "code" => $code,
            "msg"   =>  $msg,
            "data"  =>  $data,
            "req_id" =>  uniqid()
        ]);

        return \Yii::$app->end();
    }

    //统一js提醒
    /*protected  function renderJS($msg,$url = "/")
    {
        return $this->renderPartial("@app/views/common/js", ['msg' => $msg, 'location' => $url]);
    }*/

}
