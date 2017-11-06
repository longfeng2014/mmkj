<?php
namespace modules\admin\controllers;

use Yii;
use modules\admin\models\Config;
use modules\admin\models\search\ConfigSearch;
use yii\web\NotFoundHttpException;

/**
 * 网站配置控制器
 */
class ConfigController extends BaseController
{

    public function actionBasic() {
        /*$model = Config::find()->where(['keyid' => 'basic'])->one();
        if(Yii::$app->request->isPost) {
            if(empty($model)) {
                $model = new Config();
                $model->keyid = 'basic';
            }
            $form = Yii::$app->request->post('form');
            $model->data = json_encode($form);
            $model->save();
        }
        if(!isset($model->data)) $formParams = [];
        else $formParams = json_decode($model->data, true);
        if(!isset($formParams['close'])) $formParams['close'] = 0;
        if(!isset($formParams['close_reason'])) $formParams['close_reason'] = '站点升级中, 请稍后访问!';*/
        return $this->render('basic', [
            // 'formParams' => $formParams,
        ]);
    }

    public function actionSendMail() {
        
        return $this->render('send-mail', [
            // 'formParams' => $formParams,
            // 'supportSsl' => $supportSsl,
        ]);
    }

    public function actionAttachment() {
        
        return $this->render('attachment', [
            // 'formParams' => $formParams,
            //'supportSsl' => $supportSsl,
        ]);
    }


    public function actionIndex()
    {

        return $this->render('index', [
            // 'searchModel' => $searchModel,
            // 'dataProvider' => $dataProvider,
        ]);
    }


    protected function findModel($id)
    {
        if (($model = Config::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
