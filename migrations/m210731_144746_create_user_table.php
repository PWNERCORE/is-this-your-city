<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m210731_144746_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'fio' => $this->string(),
            'email' => $this->string(),
            'phone' => $this->bigInteger(),
            'creation_date' => $this->integer(),
            'password' => $this->string(),
            'token' => $this->string(),
            'status' => $this->smallInteger()->defaultValue('0')
        ]);


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
