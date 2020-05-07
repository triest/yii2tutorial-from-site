<?php

    use yii\db\Migration;

    /**
     * Handles the creation of table `{{%comment}}`.
     */
    class m200507_071621_create_comment_table extends Migration
    {
        /**
         * {@inheritdoc}
         */
        public function safeUp()
        {
            $this->createTable('comment', [
                    'id' => $this->primaryKey(),
                    'text' => $this->string(),
                    'user_id' => $this->integer(),
                    'post_id' => $this->integer(),
                    'status' => $this->integer(),
                    'updated_at' => 'timestamp on update current_timestamp',
                    'created_at' => $this->timestamp()->defaultValue(0),
            ]);

            // creates index for column `user_id`
            $this->createIndex(
                    'idx-post-user_id',
                    'comment',
                    'user_id'
            );

            // add foreign key for table `user`
            $this->addForeignKey(
                    'fk-post-user_id',
                    'comment',
                    'user_id',
                    'user',
                    'id',
                    'CASCADE'
            );

            // creates index for column `article_id`
            $this->createIndex(
                    'idx-post_id',
                    'comment',
                    'post_id'
            );

            // add foreign key for table `article`
            $this->addForeignKey(
                    'fk-article_id',
                    'comment',
                    'post_id',
                    'post',
                    'id',
                    'CASCADE'
            );
        }

        /**
         * {@inheritdoc}
         */
        public function safeDown()
        {
            $this->dropTable('{{%comment}}');
        }
    }
