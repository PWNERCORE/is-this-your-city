<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%review}}`.
 */
class m210731_144924_create_review_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%review}}', [
            'id' => $this->primaryKey(),
            'city_id' => $this->integer(),
            'title' => $this->string(),
            'text' => $this->text(),
            'rating' => $this->integer(),
            'img' => $this->string(),
            'author_id' => $this->integer(),
            'creation_date' => $this->integer()
        ]);

        $this->addForeignKey(
            'fk-review-city_id',
            'review',
            'city_id',
            'city',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-review-author_id',
            'review',
            'author_id',
            'user',
            'id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropForeignKey(
            'fk-review-author_id',
            'review'
        );

        $this->dropForeignKey(
            'fk-review-city_id',
            'review'
        );

        $this->dropTable('{{%review}}');
    }
}
