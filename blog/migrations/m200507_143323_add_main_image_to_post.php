<?php

use yii\db\Migration;

/**
 * Class m200507_143323_add_main_image_to_post
 */
class m200507_143323_add_main_image_to_post extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(
                'post',
                'photo',
                $this->string(255)->defaultValue(null)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('post', 'photo');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200507_143323_add_main_image_to_post cannot be reverted.\n";

        return false;
    }
    */
}
