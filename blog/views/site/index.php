<?php

    /* @var $this yii\web\View */

    use yii\helpers\Url;

    $this->title = 'My Yii Application';
?>
<div class="site-index">
    <a class="btn btn-primary" href="<?= Url::toRoute(['/post']); ?>">Посты</a>
</div>
