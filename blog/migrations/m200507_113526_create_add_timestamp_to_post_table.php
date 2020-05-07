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
            $this->addColumn(
                    'post',
                    'updated_at',
                    $this->timestamp()->defaultValue(null)->append('ON UPDATE CURRENT_TIMESTAMP')
            );
            $this->addColumn(
                    'post',
                    'created_at',
                    $this->timestamp()->defaultValue(null)->Null()->append('DEFAULT CURRENT_TIMESTAMP')
            );
        }

        /**
         * {@inheritdoc}
         */
        public function safeDown()
        {
            $this->dropColumn('post', 'created_at');
            $this->dropColumn('post', 'updated_at');
        }
    }
