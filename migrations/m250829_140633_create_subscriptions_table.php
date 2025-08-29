<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%subscriptions}}`.
 */
class m250829_140633_create_subscriptions_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('subscriptions', [
            'id' => $this->primaryKey(),
            'author_id' => $this->integer()->notNull(),
            'phone' => $this->string()->notNull()->unique(),
        ]);

        $this->createIndex(
            'idx-authors-book_id',
            'subscriptions',
            'author_id'
        );

        $this->addForeignKey(
            'fk-subscriptions-author_id',
            'subscriptions',
            'author_id',
            'authors',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('subscriptions');
    }
}
