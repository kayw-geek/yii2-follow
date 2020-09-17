<?php
/**
 * Created by PhpStorm.
 * @name:
 * @author: weikai
 * @date: dt
 */

namespace kaywGeek\follow;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "user_follower".
 *
 * @property int $id
 * @property int $user_id 用户id
 * @property int $follower_id 追随者id
 * @property string|null $follow_at 关注事件
 */
class Follower extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'follower';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'follower_id'], 'required'],
            [['user_id', 'follower_id'], 'integer'],
            [['follow_at'], 'default','value' => date('Y-m-d H:i:s')],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'follower_id' => 'Follower ID',
            'follow_at' => 'Follow At',
        ];
    }
}