<?php

    namespace app\models;

    use Yii;
    use yii\helpers\ArrayHelper;

    /**
     * This is the model class for table "post".
     *
     * @property int $id
     * @property string|null $email
     * @property int|null $status
     * @property int|null $author_id
     * @property string|null $title
     * @property string|null $description
     * @property int|null $category_id
     *
     * @property Comment[] $comments
     * @property PostTag[] $postTags
     */
    class Post extends \yii\db\ActiveRecord
    {
        /**
         * {@inheritdoc}
         */
        public static function tableName()
        {
            return 'post';
        }

        /**
         * {@inheritdoc}
         */
        public function rules()
        {
            return [
                    [['status', 'author_id', 'category_id'], 'integer'],
                    [['email', 'title', 'description'], 'string', 'max' => 255],
                    [['title', 'description'], 'required'],
                    [['title', 'description'], 'string', 'min' => 5],
            ];
        }

        /**
         * {@inheritdoc}
         */
        public function attributeLabels()
        {
            return [
                    'id' => 'ID',
                    'email' => 'Email',
                    'status' => 'Status',
                    'author_id' => 'Author ID',
                    'title' => 'Title',
                    'description' => 'Description',
            ];
        }

        public function saveTags($tags)
        {
            if (is_array($tags)) {
                $this->clearCurrentTags();

                foreach ($tags as $tag_id) {
                    $tag = Tag::findOne($tag_id);
                    $this->link('tags', $tag);
                }
            }
        }

        public function clearCurrentTags()
        {
            PostTag::deleteAll(['post_id' => $this->id]);
        }

        /**
         * Gets query for [[Comments]].
         *
         * @return \yii\db\ActiveQuery
         */
        public function getComments()
        {
            return $this->hasMany(Comment::className(), ['post_id' => 'id']);
        }

        public function getTags()
        {

            return $this->hasMany(Tag::className(), ['id' => 'tag_id'])
                    ->viaTable('post_tag', ['post_id' => 'id']);


        }


        public function getSelectedTags()
        {
            $selectedIds = $this->getTags()->select('id')->asArray()->all();
            return ArrayHelper::getColumn($selectedIds, 'id');
        }

        public function savePost()
        {
            $this->status = 0;
            $this->author_id = Yii::$app->user->identity->id;
            return $this->save();
        }

        /**
         * Gets query for [[PostTags]].
         *
         * @return \yii\db\ActiveQuery
         */

    }
