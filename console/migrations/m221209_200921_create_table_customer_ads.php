<?php

use yii\db\Migration;

/**
 * Class m221209_200921_create_table_customer_ads
 */
class m221209_200921_create_table_customer_ads extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%customer_ads}}', [
            'customer_id' => $this->integer()->notNull(),
            'ads_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey(
            'FK_customer_ads_customer_customer_id',
            '{{%customer_ads}}',
            'customer_id',
            '{{%customer}}',
            'id'
        );

        $this->addForeignKey(
            'FK_customer_ads_ads_ads_id',
            '{{%customer_ads}}',
            'ads_id',
            '{{%ads}}',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('FK_customer_ads_customer_customer_id', '{{%customer_ads}}');
        $this->dropForeignKey('FK_customer_ads_ads_ads_id', '{{%customer_ads}}');
        $this->dropTable('{{%customer_ads}}');
    }
}
