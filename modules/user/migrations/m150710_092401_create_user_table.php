<?php

use yii\db\Schema;


class m150710_092401_create_user_table extends webtoucher\migrate\components\Migration
{
   public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') 
        {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => Schema::TYPE_PK,
            'user_name' => Schema::TYPE_STRING . ' NOT NULL UNIQUE',
            'email' => Schema::TYPE_STRING . ' NOT NULL UNIQUE',
            'password_hash' => Schema::TYPE_STRING . ' NOT NULL',
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL',
            'auth_key' => Schema::TYPE_STRING . '(32) NOT NULL',
            'password_reset_token' => Schema::TYPE_STRING . ' UNIQUE',
            'account_activation_token' => Schema::TYPE_STRING,          
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}