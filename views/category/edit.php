<?php
use bl\articles\entities\Category;
use bl\articles\entities\CategoryTranslation;
use dosamigos\tinymce\TinyMce;
use bl\multilang\entities\Language;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $category Category */
/* @var $category_translation CategoryTranslation */
/* @var $languages Language[] */
/* @var $selectedLanguage Language */
/* @var $categories Category[] */

$this->title = Yii::t('bl.articles', 'Panel category');
?>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="glyphicon glyphicon-list"></i>
                <?= Yii::t('bl.articles', 'Category')?>
            </div>
            <div class="panel-body">
                <? $addForm = ActiveForm::begin(['action' => Url::to(['/articles/category/save', 'categoryId' => $category->id, 'languageId' => $selectedLanguage->id]), 'method'=>'post']) ?>
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
                                            'categoryId' => $category->id,
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
                <div class="form-group field-toolscategoryform-parent has-success">
                    <label class="control-label" for="toolscategoryform-parent"><?= Yii::t('bl.articles', 'Parent') ?></label>
                    <select id="category-parent_id" class="form-control" name="Category[parent_id]">
                        <option value="">-- <?= Yii::t('bl.articles', 'Empty') ?> --</option>
                        <? if(!empty($categories)): ?>
                            <? foreach($categories as $cat): ?>
                                <option <?= $category->parent_id == $cat->id ? 'selected' : '' ?> value="<?= $cat->id?>">
                                    <?= $cat->getTranslation($selectedLanguage->id)->name ?>
                                </option>
                            <? endforeach; ?>
                        <? endif; ?>
                    </select>
                    <div class="help-block"></div>
                </div>
                <?= $addForm->field($category_translation, 'name', [
                    'inputOptions' => [
                        'class' => 'form-control'
                    ]
                ])->label(Yii::t('bl.articles', 'Name'))
                ?>
                <?= $addForm->field($category_translation, 'short_text', [
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
                ])->label(Yii::t('bl.articles', 'Short description'))
                ?>
                <?= $addForm->field($category_translation, 'text', [
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

