<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "job_match".
 *
 * @property int $id
 * @property int $resume_id
 * @property int $vacancy_id
 * @property int $type
 *
 * @property Resume $resume
 * @property Vacancy $vacancy
 */
class JobMatch extends \yii\db\ActiveRecord
{
    /** @inheritDoc */
    public static function tableName()
    {
        return '{{%job_match}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['resume_id', 'vacancy_id', 'type'], 'required'],
            [['resume_id', 'vacancy_id', 'type'], 'integer'],
            [['resume_id'], 'exist', 'skipOnError' => true, 'targetClass' => Resume::className(), 'targetAttribute' => ['resume_id' => 'id']],
            [['vacancy_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vacancy::className(), 'targetAttribute' => ['vacancy_id' => 'id']],
        ];
    }

    /**
     * Gets query for [[Resume]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResume()
    {
        return $this->hasOne(Resume::className(), ['id' => 'resume_id']);
    }

    /**
     * Gets query for [[Vacancy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVacancy()
    {
        return $this->hasOne(Vacancy::className(), ['id' => 'vacancy_id']);
    }
}
