<?php
namespace modules\admin\controllers;

use Yii;
use modules\admin\models\Menu;
use yii\log\FileTarget;
use app\common\services\applog\ApplogService;

class IndexController extends BaseController {

    public function actionIndex() {
        return $this->render('index');
    }



    /**
     * test
     */
    public function actionSelect() {
        // $modelList = Menu::find()->asArray()->all();

        // print_r($modelList);die;
        // $this->renderJson($modelList);

        return $this->render('index');
    }



}
