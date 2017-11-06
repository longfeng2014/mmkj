<?php
namespace modules\admin\controllers;

use Yii;
use yii\rbac\Item;
use modules\admin\models\Menu;
use common\libs\Tree;
use modules\admin\models\AuthRule;
use modules\admin\models\AuthItem;
use modules\admin\models\search\AuthItemSearch;

/**
 * 角色管理
 */
class RoleController extends BaseController {

    public $type = Item::TYPE_ROLE;

    /**
     * 列表
     * @return [type] [description]
     */
    public function actionIndex() {
        $searchModel = new AuthItemSearch();
        $searchModel->type = $this->type;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //var_dump($dataProvider);exit();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * 添加
     * @author longkui <jianglongkui@mmkongjian.com>
     * @return [type] [description]
     */
    public function actionCreate() {
        $model = new AuthItem(null);
        $model->type = $this->type;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * 更新
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        if($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * 删除
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function actionDelete($id) {
        $model = $this->findModel($id);
        Yii::$app->authManager->remove($model->item);
        return $this->redirect(['index']);
    }

    /**
     * 授权
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function actionAuth($id) {
        $authManager = Yii::$app->authManager;
        if(Yii::$app->request->isPost) {
            $rules = Yii::$app->request->post('rules', []);
            if(!$role = $authManager->getRole($id)) {
                Yii::$app->session->setFlash('error', '角色不存在');
            }
            //删除角色所有child
            $authManager->removeChildren($role);
            foreach ($rules as $rule) {
                //auth_rule表
                $ruleModel = new AuthRule();
                $ruleModel->name = $rule;
                $ruleModel->save();
                //auth_item表
                $itemModel = new AuthItem($authManager->getPermission($rule));
                $itemModel->name = $rule;
                $itemModel->type = Item::TYPE_PERMISSION;
                $itemModel->ruleName = $rule;
                $itemModel->save();
                //auth_item_child表
                if(!$authManager->hasChild($role, $itemModel)) {
                    $authManager->addChild($role, $itemModel);
                }
            }
            Yii::$app->session->setFlash('success', '操作成功');
        }
        $arr = Menu::find()->asArray()->all();
        $treeObj = new Tree($arr);
        $authRules = $authManager->getChildren($id);
        $authRules = array_keys($authRules); //var_dump($authRules); exit();
        //var_dump($treeObj->getTreeArray()); exit();
        return $this->render('auth', [
            'treeArr' => $treeObj->getTreeArray(),
            'authRules' => $authRules,
            'role' => $id,
        ]);
    }

    protected function findModel($id) {
        $authManager = Yii::$app->authManager;
        $item = $this->type === Item::TYPE_ROLE ? $authManager->getRole($id) : $authManager->getPermission($id);
        if($item) return new AuthItem($item);
        else throw new NotFoundHttpException("The requested page does not exist.");
    }

}