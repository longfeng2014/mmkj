<?php
namespace modules\admin\controllers;

use Yii;
use common\models\member\Member;
use yii\data\Pagination;
use common\helpers\Helper;

/**
 * 会员管理
 */
class MemberController extends BaseController {

    /*
    首页列表
     */
    public function actionIndex() {
        return $this->actionList();
    }

    /**
     * 会员列表
     * @return [type] [description]
     */
    public function actionList() {
        $query = Member::find()->where(['status'=>[0,1]]);
        $pages = new Pagination([
                                'pageSize' => 10,//每页显示条数
                                'totalCount' => $query->count(),//总条数
                                ]);
        $modelList = $query->offset($pages->offset)->limit($pages->limit)->asArray()->all();

// print_r($modelList);die;
        return $this->render('list', [
            'modelList' => $modelList,
             'pages'=>$pages,
        ]);
    }

    /**
     * 会员编辑添加
     * @return [type] [description]
     */
    public function actionEdit() {
        $id = $this->get("id",0);
        $data = $this->post("data","");
        $model = new Member();
        if ($id) {
            $model = $this->findModel($id);
        }
        if (Yii::$app->request->post()) {
        // print_r($data);die;
            if (!$id) {
                $data['create_time'] = time();
            }
            $data['update_time'] = time();
            $model->setAttributes($data);
            if ($model->save()) {
                Helper::redirectMessage('操作成功','success','/admin/member/index');
            }else{
                // print_r($model->getErrors());die;
                Helper::redirectMessage('操作失败','errno','/admin/member/index');
            }
        }
        return $this->render('edit', [
                                 "model" =>$model
                                ]);
    }

    /**
     * 禁用，删除
     * @return [type] [description]
     */
    public function actionStatus() {
        $id = $this->get("id",0);
        $status = $this->get("status",0);
        if (!$id) {
            Helper::redirectMessage('未获取到ID','errno','/admin/member/index');
        }
        $model = $this->findModel($id);
        $model->status = (int)$status;
        if($model->save()){
            Helper::redirectMessage('操作成功','success','/admin/member/index');
        }else{
            Helper::redirectMessage('操作失败','errno','/admin/member/index');
        }
    }

    /**
     * 根据id查询
     * @author longkui <jianglongkui@mmkongjian.com>
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    protected function findModel($id)
    {
        if (($model = Member::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('请求的数据不存在~~');
        }
    }

}