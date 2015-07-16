<?php

use yii\db\Schema;


class m150716_043447_create_page_table extends webtoucher\migrate\components\Migration
{
    public function up()
    {
        $this->createTable('{{%page}}', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'value' => Schema::TYPE_TEXT . ' NOT NULL',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);

    }

    public function down()
    {
        $this->dropTable('{{%page}}');
    }
}