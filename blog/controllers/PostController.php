<?php

    namespace app\controllers;

    use app\models\Tag;
    use Yii;
    use app\models\Post;
    use app\models\PostSearch;
    use yii\data\Pagination;
    use yii\filters\AccessControl;
    use yii\helpers\ArrayHelper;
    use yii\web\Controller;
    use yii\web\NotFoundHttpException;
    use yii\filters\VerbFilter;
    use yii\web\UploadedFile;

    /**
     * PostController implements the CRUD actions for Post model.
     */
    class PostController extends Controller
    {
        /**
         * {@inheritdoc}
         */
        public function behaviors()
        {
            return [
                    'verbs' => [
                            'class' => VerbFilter::className(),
                            'actions' => [
                                    'delete' => ['POST'],
                            ],
                    ],
                    'access' => [
                            'class' => \yii\filters\AccessControl::className(),
                            'only' => ['create', 'update'],
                            'rules' => [
                                // deny all POST requests
                                    [
                                            'allow' => false,
                                            'verbs' => ['POST']
                                    ],
                                // allow authenticated users
                                    [
                                            'allow' => true,
                                            'roles' => ['@'],
                                    ],
                                // everything else is denied
                            ],
                    ]
            ];
        }

        /**
         * Lists all Post models.
         * @return mixed
         */
        public function actionIndex()
        {
            $qwurt = Post::find()->where(['=', 'status', 1]);
            $pagination = new Pagination(['totalCount' => $qwurt, 'pageSize' => 10]);
            $posts = $qwurt->offset($pagination->offset)
                    ->limit($pagination->limit)
                    ->all();
            return $this->render('index', [
                    'posts' => $posts,
            ]);
        }

        /**
         * Displays a single Post model.
         * @param integer $id
         * @return mixed
         * @throws NotFoundHttpException if the model cannot be found
         */
        public function actionView($id)
        {
            return $this->render('view', [
                    'model' => $this->findModel($id),
            ]);
        }

        /**
         * Creates a new Post model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         * @return mixed
         */
        public function actionCreate()
        {
            $model = new Post();

            if ($model->load(Yii::$app->request->post()) && $model->savePost()) {
                $tags = Yii::$app->request->post('tags');
                if ($tags != null) {
                    $model->saveTags($tags);
                }
                $file = UploadedFile::getInstance($model, 'photo');
                if ($file != null) {
                    $file = $model->uploadFile($file);
                }

                return $this->redirect(['post/view', 'id' => $model->id]);
            }
            $tags = ArrayHelper::map(Tag::find()->all(), 'id', 'title');

            return $this->render('create', [
                    'model' => $model,
                    'tags' => $tags
            ]);
        }

        /**
         * Updates an existing Post model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id
         * @return mixed
         * @throws NotFoundHttpException if the model cannot be found
         */
        public function actionUpdate($id)
        {
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }

            return $this->render('update', [
                    'model' => $model,
            ]);
        }

        /**
         * Deletes an existing Post model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         * @param integer $id
         * @return mixed
         * @throws NotFoundHttpException if the model cannot be found
         */
        public function actionDelete($id)
        {
            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        }

        /**
         * Finds the Post model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         * @param integer $id
         * @return Post the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id)
        {
            if (($model = Post::findOne($id)) !== null && $model->status == 1) {
                return $model;
            }

            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
