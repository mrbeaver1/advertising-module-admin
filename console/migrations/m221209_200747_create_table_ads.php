<?php

use yii\db\Migration;

/**
 * Class m221209_200747_create_table_ads
 */
class m221209_200747_create_table_ads extends Migration
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
        $this->createTable('{{%ads}}', [
            'id' => $this->primaryKey(),
            'image' => $this->text()->null(),
            'start_date' => $this->date()->null(),
            'end_date' => $this->date()->null(),
            'redirect_to' => $this->text()->null(),
            'clicks' => $this->integer()->null(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%ads}}');
    }
}
