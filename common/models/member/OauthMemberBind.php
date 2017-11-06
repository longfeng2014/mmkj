<?php

namespace common\models\member;

use Yii;

/**
 * This is the model class for table "mm_oauth_member_bind".
 *
 * @property string $id
 * @property integer $member_id
 * @property string $client_type
 * @property integer $type
 * @property string $openid
 * @property string $unionid
 * @property string $extra
 * @property integer $updated_time
 * @property integer $created_time
 */
class OauthMemberBind extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['member_id', 'type', 'updated_time', 'created_time'], 'integer'],
            [['extra'], 'required'],
            [['extra'], 'string'],
            [['client_type'], 'string', 'max' => 20],
            [['openid', 'unionid'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'member_id' => 'Member ID',
            'client_type' => 'Client Type',
            'type' => 'Type',
            'openid' => 'Openid',
            'unionid' => 'Unionid',
            'extra' => 'Extra',
            'updated_time' => 'Updated Time',
            'created_time' => 'Created Time',
        ];
    }
}
