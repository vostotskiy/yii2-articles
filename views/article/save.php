<?php
use bl\articles\models\ValidArticleForm;
use dosamigos\tinymce\TinyMce;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 23.02.2016
 * Time: 18:46
 */
/* @var $child_id integer*/
/* @var $model ValidArticleForm*/
/* @var $baseLanguage \common\entities\Language*/
/* @var $languages \common\entities\Language[] */
/* @var $category array Category */
$this->title = Yii::t('article.view', 'Panel material');
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                    <i class="glyphicon glyphicon-list"></i>
                    <?= Yii::t('article.view', 'Article')?>
            </div>
            <div class="panel-body">
                <? $form = ActiveForm::begin(['method'=>'post']) ?>
                    <div class="btn-group">
                        <button data-toggle="dropdown" class="btn btn-warning btn-xs dropdown-toggle"> <?= $baseLanguage->name ?> <span class="<?= is_array($languages) ? 'caret' : ''?>"></span></button>
                        <? if(is_array($languages)): ?>
                            <ul class="dropdown-menu">
                                <? foreach($languages as $language): ?>
                                    <li>
                                        <a href="
                                        <?= Url::to([
                                            'articleId' => Yii::$app->request->get('articleId'),
                                            'languageId' => $language->id])?>
                                        ">
                                            <?= $language->name?>
                                        </a>
                                    </li>
                                <? endforeach; ?>
                            </ul>
                        <? endif; ?>
                    </div>
                    <?= Html::activeHiddenInput($model, 'id', ['value' => $model->id]) ?>
                    <?= Html::activeHiddenInput($model, 'language_id', ['value' => $baseLanguage->id]) ?>
                    <div class="form-group field-validarticleform-category_id required has-success">
                        <label class="control-label" for="validarticleform-category_id"><?= Yii::t('article.view', 'Category') ?></label>
                        <select id="validarticleform-category_id" class="form-control" name="ValidArticleForm[category_id]">
                            <option value="">-- <?= Yii::t('article.view', 'Empty') ?> --</option>
                            <? foreach($categories as $value): ?>
                                <? if(!empty($value->name)): ?>
                                <option <?= $baseCategory == $value->category_id ? 'selected' : '' ?> value="<?= $value->category_id?>"><?= $value->name?></option>
                                <? endif; ?>
                            <? endforeach; ?>
                        </select>

                        <div class="help-block"></div>
                    </div>
                    <?= $form->field($model, 'name', [
                        'inputOptions' => [
                            'class' => 'form-control'
                        ]
                    ])->label(Yii::t('article.view', 'Name'))
                    ?>

                    <?= $form->field($model, 'short_text', [
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
                        ->label(Yii::t('article.view', 'Short description'))
                    ?>
                    <?= $form->field($model, 'text', [
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
                    ])->label(Yii::t('article.view', 'Full description'))
                    ?>
                    <input type="submit" class="btn btn-primary pull-right" value="<?= Yii::t('article.view', 'Save') ?>">
                <? ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
