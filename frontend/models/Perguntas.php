<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "perguntas".
 *
 * @property int $id
 * @property string $pergunta
 * @property string|null $materia
 * @property string|null $instituicao
 * @property string $created_at
 * @property string $updated_at
 * @property int|null $user_id
 *
 * @property Resposta[] $respostas
 */
class Perguntas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'perguntas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pergunta'], 'required'],
            [['pergunta'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['user_id'], 'integer'],
            [['materia', 'instituicao'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pergunta' => 'Pergunta',
            'materia' => 'Materia',
            'instituicao' => 'Instituicao',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_id' => 'User ID',
        ];
    }

    /**
     * Gets query for [[Respostas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRespostas()
    {
        return $this->hasMany(Respostas::className(), ['perguntas_id' => 'id']);
    }

    public static function getLastAnswer()
    {
        $last = Perguntas::find()
            ->limit(5)
            ->orderBy('id DESC')
            ->all();

        return $last;
    }
}
