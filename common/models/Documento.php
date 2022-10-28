<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "documento".
 *
 * @property int $id
 * @property string $nombre
 * @property bool $deleted
 */
class Documento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'documento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['deleted'], 'boolean'],
            [['nombre'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'deleted' => 'Deleted',
        ];
    }
}
