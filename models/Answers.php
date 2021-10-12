<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "answers".
 *
 * @property int $id
 * @property string $uuid
 * @property int $question_id
 * @property int $option_id
 * @property int|null $status
 * @property int|null $type
 * @property string $option_text
 */
class Answers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'answers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['uuid', 'question_id'], 'required'],
            [['uuid'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uuid' => 'uuid',
            'question_id' => 'Вопрос',
            'option_id' => 'Ответ',
            'status' => 'Статус',
            'type' => 'Тип',
            'option_text' => 'Текст',
        ];
    }
}
