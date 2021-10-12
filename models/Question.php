<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "question".
 *
 * @property int $id
 * @property string $lable
 * @property int|null $status
 * @property int|null $sort
 * @property int|null $type
 *
 * @property Options[] $options
 */
class Question extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'question';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lable'], 'required'],
            [['status', 'sort', 'type'], 'integer'],
            [['lable'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lable' => 'Вопрос',
            'status' => 'Статус',
            'sort' => 'Сортировка',
            'type' => 'Тип вопроса',
        ];
    }

    /**
     * Gets query for [[Options]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOptions()
    {
        return $this->hasMany(Options::className(), ['question_id' => 'id']);
    }
}
