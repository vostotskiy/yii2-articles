<?php
namespace bl\articles\entities;

use bl\multilang\entities\Language;
use Yii;
use yii\db\ActiveRecord;

/**
 * ArticleTranslation
 *
 * @property integer $id
 * @property integer $article_id
 * @property integer $language_id
 * @property string $name
 * @property string $text
 * @property string $short_text
 */
class ArticleTranslation extends ActiveRecord
{
    public function rules()
    {
        return [
            [['language_id', 'article_id'], 'number'],
            [['name', 'text', 'short_text'], 'string']
        ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article_translation';
    }

    public static function getOneArticle($id){
        $model = Category::find()
            ->andWhere(['id' => $id])->one();
        if(empty($model->id))
            return $id;
        return $model;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Language::className(), ['id' => 'language_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticle()
    {
        return $this->hasOne(Article::className(), ['id' => 'article_id']);
    }
}
