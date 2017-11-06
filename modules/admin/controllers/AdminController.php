<?php
namespace modules\admin\controllers;

use Yii;
use modules\admin\models\Admin;
use modules\admin\models\search\AdminSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\rbac\Item;
use modules\admin\models\search\AuthItemSearch;
use common\helpers\Helper;

/**
 *后台管理员控制器
 */
class AdminController extends BaseController
{

    public $type = Item::TYPE_ROLE;

    /**
     * 管理员列表
     * @return [type] [description]
     */
    public function actionIndex()
    {
        $searchModel = new AdminSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setSort(false); //禁止表头排序

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * 添加管理员
     * @return [type] [description]
     */
    /*public function actionCreate()
    {
        $model = new Admin();
        $model->scenario = 'create';
        $model->status = Admin::STATUS_ACTIVE;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }*/

    /**
     * 添加、编辑
     */
    public function actionUpdate()
    {
        $id = $this->get("id",0);
        $data = $this->post("Admin");
        $model = new Admin();
        if (!empty($id)) {
            $model = $this->findModel($id);
        }
        //查询角色
        $roleList = Yii::$app->db->createCommand("select id,name from {{%auth_item}} where type = 1")->queryAll();
        //查询门店
        // $shopList = Outlet::find()->select()->where()->asArray()->orderBy("id asc")->all()
        // flog($shopList);
        if (Yii::$app->request->post()) {
            $model->username = trim($data['username']);
            if (!empty($data['password'])) {
                $model->password_hash = Yii::$app->security->generatePasswordHash(trim($data['password']));
            }
            $model->email = trim($data['email']);
            $model->mobile = trim($data['mobile']);
            $model->role_id = (int)$data['role_id'];
            $model->shop_ids = trim($data['shop_ids']);
            $model->status = (int)$data['status'];
            $model->updated_at = time();
            if (empty($id)) {
                $model->created_at = time();
            }
            if ($model->save()) {
                Helper::redirectMessage('操作成功','success','/admin/admin/index');
            }else{
                Helper::redirectMessage('操作失败','success','/admin/admin/index');
            }
        }

        return $this->render('update', [
                                        'model' => $model,
                                        'roleList' => $roleList,
                                    ]);
    }

    /**
     * 删除
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * 授权
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function actionAuth($id) {
        $authManager = Yii::$app->authManager;
        $adminModel = $this->findModel($id);
        if(Yii::$app->request->isPost) {
            $roleName = Yii::$app->request->post('roleName', '');
            //删除用户所在的用户组
            $authManager->revokeAll($id);
            //添加用户组
            $authManager->assign($authManager->getRole($roleName), $id);
            Yii::$app->session->setFlash('success', '操作成功');
        }
        $searchModel = new AuthItemSearch();
        $searchModel->type = $this->type;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //获取当前用户的所有用户组
        $adminGroups = array_keys($authManager->getAssignments($id));
        //var_dump($dataProvider);exit();
        return $this->render('auth', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'adminGroups' => $adminGroups,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Admin::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
