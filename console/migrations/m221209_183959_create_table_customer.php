<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m221209_183959_create_tablecustomer
 */
class m221209_183959_create_table_customer extends Migration
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

        $this->createTable('{{%customer}}', [
            'id' => $this->primaryKey(),
            'url' => $this->text()->null(),
            'active' => $this->tinyInteger()->null(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $this->dropTable('{{%customer}}');
    }
}
