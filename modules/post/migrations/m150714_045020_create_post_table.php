<?php

use yii\db\Schema;


class m150714_045020_create_post_table extends webtoucher\migrate\components\Migration
{
    public function up()
    {
        $this->createTable('{{%post}}', [
            'id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'title' => Schema::TYPE_STRING . ' NOT NULL',
            'content' => Schema::TYPE_TEXT . ' NOT NULL',
            'status' => Schema::TYPE_INTEGER . ' NOT NULL',
            'type' => Schema::TYPE_INTEGER . ' NOT NULL',          
            'image' => Schema::TYPE_STRING . ' NOT NULL',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'FOREIGN KEY (user_id) REFERENCES {{%user}}(id)
                ON DELETE CASCADE ON UPDATE CASCADE',
        ]);

    }

    public function down()
    {
        $this->dropTable('{{%post}}');
    }
}