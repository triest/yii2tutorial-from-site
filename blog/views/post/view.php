<?php

    use yii\helpers\Url;
    use yii\widgets\ActiveForm;
    use yii\helpers\Html;

?>
<!--main content start-->
<div class="main-content">
    <div class="container">
        <div class="row">
            <article class="post">
                <div class="post-thumb">
                </div>
                <div class="post-content">

                    <header class="entry-header text-center text-uppercase">
                        <h1 class="entry-title"><?= $model->title ?></h1>
                        <br>
                        <img src="<?= Yii::$app->request->baseUrl . $model->getImage(); ?>"
                        <p>
                            <small><?= $model->created_at ?></small>
                        </p>
                        <? if ($model->updated_at != null) { ?>
                            <?= $model->updated_at ?>
                        <? } ?>
                    </header>
                    <div class="entry-content">
                        <?= $model->description ?>
                    </div>
                    Теги:
                    <? $tags = $model->tags;
                        foreach ($tags as $tag): ?>
                            <a href="<?= Url::toRoute(['/tag/posts', 'id' => $tag->id]); ?>"> <?= $tag->title ?> </a>,
                        <? endforeach; ?>
                </div>
            </article>
            <a href="<?= Url::toRoute(['/post']); ?>"
               class="btn btn-primary">
                Назад
            </a>

        </div>
    </div>
</div>
<!-- end main content-->