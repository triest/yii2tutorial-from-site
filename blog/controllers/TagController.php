<?php

    namespace app\controllers;

    use Yii;
    use app\models\Tag;
    use app\models\TagSearch;
    use yii\data\Pagination;
    use yii\web\Controller;
    use yii\web\NotFoundHttpException;
    use yii\filters\VerbFilter;

    /**
     * TagController implements the CRUD actions for Tag model.
     */
    class TagController extends Controller
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
            ];
        }

        /**
         * Lists all Tag models.
         * @return mixed
         */
        public function actionIndex()
        {
            $searchModel = new TagSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        }

        /**
         * Displays a single Tag model.
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

        public function actionPosts($id)
        {
            $tag = $this->findModel($id);

            $posts = $tag->getPosts();

            $pagination = new Pagination(['totalCount' => $posts, 'pageSize' => 1]);
            $articles = $posts->offset($pagination->offset)
                    ->limit($pagination->limit)
                    ->all();
            return $this->render('index', [
                    'tag' => $tag,
                    'posts' => $articles,
            ]);

        }

        /**
         * Finds the Tag model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         * @param integer $id
         * @return Tag the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id)
        {
            if (($model = Tag::findOne($id)) !== null) {
                return $model;
            }

            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
