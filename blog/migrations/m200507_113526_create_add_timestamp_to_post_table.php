<?php

    use yii\db\Migration;

    /**
     * Handles the creation of table `{{%add_timestamp_to_post}}`.
     */
    class m200507_113526_create_add_timestamp_to_post_table extends Migration
    {
        /**
         * {@inheritdoc}
         */
        public function safeUp()
        {
            $this->addColumn('post', 'date', $this->date());
        }

        /**
         * {@inheritdoc}
         */
        public function safeDown()
        {
            $this->dropColumn('post', 'date');
        }
    }
