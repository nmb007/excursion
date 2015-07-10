<?php

use yii\db\Schema;


class m150710_094222_create_admin_user extends webtoucher\migrate\components\Migration
{
   public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') 
        {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->insert('{{%user}}', [
            'id' => '1',
            'user_name' => 'admin',
            'email' => 'rehan.ali@coeus-solutions.de',
            'password_hash' => '$2y$13$3dj/4Z1gGgfNTnCGO2U26.xRyhe2IGYvYiXuB6algwEerbNMm/rc6',
            'status' => '10',
            'auth_key' => 'ASEYsJSDasFzEIsljaJg_qxNyudu5zvD',
            'password_reset_token' => NULL,
            'account_activation_token' => NULL,          
            'created_at' => 1436520740,
            'updated_at' => 1436520740,
        ]);
    }

    public function down()
    {
        $this->delete('{{%user}}',
                "id = '1'"
        );
    }
}