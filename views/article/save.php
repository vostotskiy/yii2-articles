<?php
use bl\articles\entities\Article;
use bl\articles\entities\ArticleTranslation;
use bl\articles\entities\Category;
use bl\multilang\entities\Language;
use dosamigos\tinymce\TinyMce;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $languages Language[] */
/* @var $selectedLanguage Language */
/* @var $article Article */
/* @var $article_translation ArticleTranslation */
/* @var $categories Category[] */

$this->title = Yii::t('bl.articles', 'Panel material');
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="glyphicon glyphicon-list"></i>
                <?= Yii::t('bl.articles', 'Article')?>
            </div>
            <div class="panel-body">
                <? $form = ActiveForm::begin(['method'=>'post']) ?>
                <? if(count($languages) > 1): ?>
                    <div class="dropdown">
                        <button class="btn btn-warning btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <?= $selectedLanguage->name ?>
                            <span class="caret"></span>
                        </button>
                        <? if(count($languages) > 1): ?>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <? foreach($languages as $language): ?>
                                    <li>
                                        <a href="
                                            <?= Url::to([
                                            'articleId' => $article->id,
                                            'languageId' => $language->id])?>
                                            ">
                                            <?= $language->name?>
                                        </a>
                                    </li>
                                <? endforeach; ?>
                            </ul>
                        <? endif; ?>
                    </div>
                <? endif; ?>
                <div class="form-group field-validarticleform-category_id required has-success">
                    <label class="control-label" for="validarticleform-category_id"><?= Yii::t('bl.articles', 'Category') ?></label>
                    <select id="article-category_id" class="form-control" name="Article[category_id]">
                        <option value="">-- <?= Yii::t('bl.articles', 'Empty') ?> --</option>
                        <? if(!empty($categories)): ?>
                            <? foreach($categories as $category): ?>
                                <option <?= $article->category_id == $category->id ? 'selected' : '' ?> value="<?= $category->id?>">
                                    <?= $category->getTranslation($selectedLanguage->id)->name ?>
                                </option>
                            <? endforeach; ?>
                        <? endif; ?>
                    </select>
                    <div class="help-block"></div>
                </div>
                <?= $form->field($article_translation, 'name', [
                    'inputOptions' => [
                        'class' => 'form-control'
                    ]
                ])->label(Yii::t('bl.articles', 'Name'))
                ?>

                <?= $form->field($article_translation, 'short_text', [
                    'inputOptions' => [
                        'class' => 'form-control'
                    ]
                ])->widget(TinyMce::className(), [
                    'options' => ['rows' => 10],
                    'language' => 'ru',
                    'clientOptions' => [
                        'plugins' => [
                            'textcolor colorpicker',
                            "advlist autolink lists link charmap print preview anchor",
                            "searchreplace visualblocks code fullscreen",
                            "insertdatetime media table contextmenu paste"
                        ],
                        'toolbar' => "undo redo | forecolor backcolor | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
                    ]
                ])
                    ->label(Yii::t('bl.articles', 'Short description'))
                ?>
                <?= $form->field($article_translation, 'text', [
                    'inputOptions' => [
                        'class' => 'form-control'
                    ]
                ])->widget(TinyMce::className(), [
                    'options' => ['rows' => 20],
                    'language' => 'ru',
                    'clientOptions' => [
                        'plugins' => [
                            'textcolor colorpicker',
                            "advlist autolink lists link charmap print preview anchor",
                            "searchreplace visualblocks code fullscreen",
                            "insertdatetime media table contextmenu paste"
                        ],
                        'toolbar' => "undo redo | forecolor backcolor | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
                    ]
                ])->label(Yii::t('bl.articles', 'Full description'))
                ?>
                <input type="submit" class="btn btn-primary pull-right" value="<?= Yii::t('bl.articles', 'Save') ?>">
                <? ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
