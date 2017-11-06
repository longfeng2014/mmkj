<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\components\Func;
use yii\widgets\LinkPager;

$this->title = '数据库管理';
$this->params['breadcrumbs'][] = ['label' => '数据库设置', 'url' => ['basic']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="database-index">
    <?=$this->render('_tab_menu');?>
    <div id="w1" class="grid-view">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>昵称/真实姓名</th>
                    <th>手机号</th>
                    <th>身份证号</th>
                    <th>性别</th>
                    <th>学生认证</th>
                    <th>消费额度积分/等级</th>
                    <th>信用积分</th>
                    <th>状态</th>
                    <th>注册时间</th>
                    <th class="action-column">操作</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($modelList as $key=>$info) { ?>
                    <tr>
                        <td><?php echo $info['id'];?></td>
                        <td><?php echo $info['username'].'/'.$info['realname'];?></td>
                        <td><?php echo $info['mobile'];?></td>
                        <td><?php echo $info['id_number'];?></td>
                        <td><?php if($info['sex'] === 1){echo '男';}elseif($info['sex'] === 2){echo '女';}else{echo '未知';};?></td>
                        <td><?php echo $info['student_status'] === 1 ? '已认证' : '未认证';?></td>
                        <td><?php echo $info['expense_points'].'/'.$info['expense_points'];?></td>
                        <td><?php echo $info['credit_grade'];?></td>
                        <td><?php echo $info['status'] == 0 ? '正常' : '禁用';?></td>
                        <td><?php echo date('Y-m-d H:i',$info['create_time']);?></td>
                        <td>
                            <a class="btn btn-primary btn-xs" href="/admin/member/edit?id=<?php echo $info['id']?>" title="编辑" aria-label="编辑">
                                <span class="fa fa-edit"></span> 编辑
                            </a>
                            <?php if($info['status'] == 0){?>
                                <a class="btn btn-success btn-xs" href="/admin/member/status?id=<?php echo $info['id']?>&status=1" title="禁用" aria-label="禁用"><span class="fa fa-user"></span> 禁用</a> 
                            <?php }else{?>
                                <a class="btn btn-success btn-xs" href="/admin/member/status?id=<?php echo $info['id']?>&status=0" title="禁用" aria-label="禁用"><span class="fa fa-user"></span> 启用</a> 
                            <?php }?>
                            <a class="btn btn-danger btn-xs" href="/admin/member/status?id=<?php echo $info['id']?>&status=-1" title="删除" aria-label="删除" data-confirm="您确定要删除此项吗？" data-method="post">
                                <span class="fa fa-times"></span> 删除
                            </a>
                        </td>
                    </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
    <div class="pull-right">
        <?php if(isset($modelList)){?>
            <?= LinkPager::widget([
                                "pagination" => $pages,
                                "firstPageCssClass"=>"first"])
            ?>
        <?php } ?>
    </div>
</div>
