<?php

    use yii\helpers\Html;
    use yii\grid\GridView;
    use yii\helpers\Url;

    /* @var $this yii\web\View */
    /* @var $searchModel app\models\PostSearch */
    /* @var $dataProvider yii\data\ActiveDataProvider */

    $this->title = 'Posts';
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Post', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <? foreach ($posts as $article): ?>
        <img class="card-img-top" src="http://placehold.it/750x300" alt="Card image cap">
        <div class="card-body">
            <h2 class="card-title"><?= $article->title ?></h2>
            <a href="<?= Url::to(['/post/view', 'id' => $article->id]); ?>" class="btn btn-primary">Read More &rarr;</a>
        </div>
        <div class="card-footer text-muted">

        </div>
    <? endforeach; ?>


</div>
