<?php

use yii\db\Schema;


class m150715_103158_create_testimonial_table extends webtoucher\migrate\components\Migration
{
    public function up()
    {
        $this->createTable('{{%testimonial}}', [
            'id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'content' => Schema::TYPE_TEXT . ' NOT NULL',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'FOREIGN KEY (user_id) REFERENCES {{%user}}(id)
                ON DELETE CASCADE ON UPDATE CASCADE',
        ]);

    }

    public function down()
    {
        $this->dropTable('{{%testimonial}}');
    }
}