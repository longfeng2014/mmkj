<?php
namespace modules\admin\controllers;

use Yii;
use modules\admin\models\Menu;

class OrderController extends BaseController {

    public function actionIndex() {

        $key = 'key_10';
        $cache = Yii::$app->cache;
        // 尝试从缓存中取回 $data 
        $data = $cache->get($key);
        if ($data === false) {
            // $data 在缓存中没有找到，则重新获取这个值
            $data = Menu::find()->asArray()->all();
            // 将 $data 存放到缓存供下次使用
            $cache->set($key, $data);
        }
        // var_dump(44);die;

        // $this->renderJson($modelList);

        return $this->render('index');
    }

    /**
     * [actionIndex description]
     * @author longkui <jianglongkui@mmkongjian.com>
     * @return [type] [description]
     */
    public function actionSelect() {
        $modelList = Menu::find()->asArray()->all();

        print_r($modelList);die;
        // $this->renderJson($modelList);

        return $this->render('index');
    }

    /**
     * [actionIndex description]
     * @author longkui <jianglongkui@mmkongjian.com>
     * @return [type] [description]
     */
    public function actionList() {
        // $modelList = Menu::find()->asArray()->all();

        print_r('list1111');die;
        // $this->renderJson($modelList);

        return $this->render('index');
    }

}
