<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "options".
 *
 * @property int $id
 * @property string $key
 * @property string $value
 * @property int|null $status
 * @property int|null $question_id
 *
 * @property Question $question
 */
class Options extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'options';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['key', 'value'], 'required'],
            [['status', 'question_id'], 'integer'],
            [['key'], 'string', 'max' => 255],
            [['value'], 'string', 'max' => 500],
            [['question_id'], 'exist', 'skipOnError' => true, 'targetClass' => Question::className(), 'targetAttribute' => ['question_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'key' => 'Ключ',
            'value' => 'Вариант',
            'status' => 'Статус',
            'question_id' => 'Вопрос',
        ];
    }

    /**
     * Gets query for [[Question]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuestion()
    {
        return $this->hasOne(Question::className(), ['id' => 'question_id']);
    }
}
