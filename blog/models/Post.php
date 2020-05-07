<?php

    namespace app\models;

    use Yii;
    use yii\web\UploadedFile;

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
     * @property string|null $updated_at
     * @property string|null $created_at
     * @property string|null $photo
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
                    [['updated_at', 'created_at'], 'safe'],
                    [['email', 'title', 'description', 'photo'], 'string', 'max' => 255],
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
                    'category_id' => 'Category ID',
                    'updated_at' => 'Updated At',
                    'created_at' => 'Created At',
                    'photo' => 'Photo',
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
        public function getPostTags()
        {
            return $this->hasMany(PostTag::className(), ['post_id' => 'id']);
        }

        public function uploadFile(UploadedFile $file)
        {
            $this->photo = $file;
            $filename = strtolower(md5(uniqid($file->baseName)) . '.' . $file->extension);
            $file->saveAs(Yii::getAlias('@webroot') . '/uploads/' . $filename);
            $this->photo = $filename;
            $this->save(false);
            return $filename;
        }
    }
