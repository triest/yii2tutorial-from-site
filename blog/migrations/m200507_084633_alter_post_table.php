<?php

use yii\db\Migration;

/**
 * Class m200507_084633_alter_post_table
 */
class m200507_084633_alter_post_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('post', 'title', $this->string());
        $this->addColumn('post', 'description', $this->string());
        $this->addColumn('post', 'category_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('post', 'title');
        $this->dropColumn('post', 'description');
        $this->dropColumn('post', 'category_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200507_084633_alter_post_table cannot be reverted.\n";

        return false;
    }
    */
}
