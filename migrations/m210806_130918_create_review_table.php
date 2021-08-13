<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%review}}`.
 */
class m210806_130918_create_review_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
            $this->createTable('{{%review}}', [
                'id' => $this->primaryKey(),
                'city_id' => $this->string(),
                'title' => $this->string(),
                'text' => $this->text(),
                'rating' => $this->integer(),
                'img' => $this->string(),
                'author_id' => $this->integer(),
                'creation_date' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%review}}');
    }
}
