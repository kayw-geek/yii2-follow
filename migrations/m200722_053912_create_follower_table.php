<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_follower}}`.
 */
class m200722_053912_create_follower_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%follower}}', [
            'id' => $this->primaryKey(),
            'user_id'=>$this->integer(11)->unsigned()->notNull()->comment('用户id'),
            'follower_id'=>$this->integer(11)->unsigned()->notNull()->comment('追随者id'),
            'follow_at'=>$this->dateTime()->comment('关注时间'),
        ]);
        $this->createIndex('f-follower_id','{{%follower}}','follower_id');
        $this->createIndex('f-user_id','{{%follower}}','user_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%follower}}');
    }
}
