<?php

    use yii\helpers\Html;
    use yii\helpers\Url;

    /* @var $this yii\web\View */
    /* @var $model app\models\Post */

    $this->title = 'Create Post';
    $this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="post-create">

        <h1><?= Html::encode($this->title) ?></h1>

        <?= $this->render('_form', [
                'model' => $model,
                'tags' => $tags
        ]) ?>
        <a href="<?= Url::toRoute(['/post']); ?>"
           class="btn btn-primary">
            Назад
        </a>
    </div>
</div>
