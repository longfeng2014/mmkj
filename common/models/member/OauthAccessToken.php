<?php

namespace common\models\member;

use Yii;

/**
 *OauthAccessToken模型
 */
class OauthAccessToken extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['expired_time', 'created_time'], 'integer'],
            [['access_token'], 'string', 'max' => 600],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'access_token' => 'Access Token',
            'expired_time' => 'Expired Time',
            'created_time' => 'Created Time',
        ];
    }
}
