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

    Посты по тегу : <?= $tag->title ?>

    <? foreach ($posts as $article): ?>
        <article class="post">
            <div class="post-thumb">

                <a href="<?= Url::toRoute(['post/view', 'id' => $article->id]); ?>"
                   class="post-thumb-overlay text-center">
                </a>
            </div>
            <div class="post-content">
                <header class="entry-header text-center text-uppercase">
                    <h1 class="entry-title"><a href="<?= Url::toRoute([
                                'post/view',
                                'id' => $article->id
                        ]); ?>"><?= $article->title ?></a></h1>
                </header>
                <div class="social-share">

                </div>
            </div>
        </article>
    <? endforeach; ?>


</div>
