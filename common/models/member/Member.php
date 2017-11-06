<?php

namespace common\models\member;

use Yii;

/**
 * 会员表模型
 */
class Member extends \common\base\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sex', 'wxstatus', 'expense_points', 'level', 'create_time', 'last_login_time', 'update_time', 'parentid', 'status', 'number_status', 'credit_grade', 'student_status', 'inviter'], 'integer'],
            [['user_money', 'frozen_money'], 'number'],
            [['username', 'password', 'realname', 'nickname', 'latlng', 'id_number'], 'string', 'max' => 50],
            [['mobile'], 'string', 'max' => 15],
            [['openid', 'headimgurl', 'student_img'], 'string', 'max' => 255],
            [['email'], 'string', 'max' => 100],
            [['reg_ip', 'last_login_ip'], 'string', 'max' => 20],
            [['mobile'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '用户名',
            'password' => '密码',
            'realname' => '真实姓名',
            'nickname' => '昵称',
            'mobile' => '手机号',
            'openid' => 'Openid',
            'sex' => '性别',
            'headimgurl' => '头像',
            'wxstatus' => '关注状态',
            'email' => 'Email',
            'expense_points' => '消费额度积分',
            'level' => '级别',
            'user_money' => 'User Money',
            'frozen_money' => 'Frozen Money',
            'create_time' => '创建时间',
            'reg_ip' => 'Reg Ip',
            'last_login_time' => 'Last Login Time',
            'last_login_ip' => 'Last Login Ip',
            'update_time' => '更新时间',
            'latlng' => 'Latlng',
            'parentid' => 'Parentid',
            'status' => '用户状态（0：默认正常：1：禁用；-1：删除）',
            'id_number' => '用户状态（0：默认正常：1：禁用；-1：删除）',
            'number_status' => '用户状态（0：默认正常：1：禁用；-1：删除）',
            'credit_grade' => '信用积分',
            'student_img' => '学生证---图片',
            'student_status' => '学生认证：0未认证；1认证成功',
            'inviter' => 'Inviter',
        ];
    }
}
