<?php

namespace app\models;

use app\jobs\SendSmsJob;
use Yii;
use yii\base\InvalidConfigException;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

class Book extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'books';
    }

    public function rules(): array
    {
        return [
            [['title', 'year', 'description', 'isbn'], 'required'],
            [['year'], 'integer'],
            [['title', 'isbn', 'cover_image'], 'string', 'max' => 255],
            [['description'], 'string'],
        ];
    }

    /**
     * @throws InvalidConfigException
     */
    public function getAuthors(): ActiveQuery
    {
        return $this->hasMany(Author::class, ['id' => 'author_id'])
            ->viaTable('book_author', ['book_id' => 'id']);
    }

    public function afterSave($insert, $changedAttributes): void
    {
        parent::afterSave($insert, $changedAttributes);

        if ($insert) {
            Yii::$app->queue->push(new SendSmsJob(['book' => $this]));
        }
    }
}