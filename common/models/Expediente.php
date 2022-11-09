<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Expediente".
 *
 * @property int $id
 * @property int $idAnual
 * @property int $anio
 * @property string $fechaCreacion
 * @property string $fechaModificacion
 * @property int $estado
 * @property int $id_Persona_Solicita
 * @property int $id_User_CreadoPor
 * @property int $id_User_modificadoPor
 * @property int $id_TipoTramite
 *
 * @property Persona $personaSolicita
 * @property SolicitudConstruccion[] $solicitudConstruccions
 * @property TipoTramite $tipoTramite
 * @property User $userCreadoPor
 * @property User $userModificadoPor
 */
class Expediente extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Expediente';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idAnual', 'anio', 'fechaCreacion', 'fechaModificacion', 'id_Persona_Solicita', 'id_User_CreadoPor', 'id_User_modificadoPor', 'id_TipoTramite'], 'required'],
            [['idAnual', 'anio', 'estado', 'id_Persona_Solicita', 'id_User_CreadoPor', 'id_User_modificadoPor', 'id_TipoTramite'], 'integer'],
            [['fechaCreacion', 'fechaModificacion'], 'safe'],
            [['id_User_CreadoPor'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_User_CreadoPor' => 'id']],
            [['id_User_modificadoPor'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_User_modificadoPor' => 'id']],
            [['id_TipoTramite'], 'exist', 'skipOnError' => true, 'targetClass' => TipoTramite::class, 'targetAttribute' => ['id_TipoTramite' => 'id']],
            [['id_Persona_Solicita'], 'exist', 'skipOnError' => true, 'targetClass' => Persona::class, 'targetAttribute' => ['id_Persona_Solicita' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idAnual' => 'Id Anual',
            'anio' => 'Anio',
            'fechaCreacion' => 'Fecha Creacion',
            'fechaModificacion' => 'Fecha Modificacion',
            'estado' => 'Estado',
            'id_Persona_Solicita' => 'Id Persona Solicita',
            'id_User_CreadoPor' => 'Id User Creado Por',
            'id_User_modificadoPor' => 'Id User Modificado Por',
            'id_TipoTramite' => 'Id Tipo Tramite',
        ];
    }

    /**
     * Gets query for [[PersonaSolicita]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPersonaSolicita()
    {
        return $this->hasOne(Persona::class, ['id' => 'id_Persona_Solicita']);
    }

    /**
     * Gets query for [[SolicitudConstruccions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitudConstruccions()
    {
        return $this->hasMany(SolicitudConstruccion::class, ['id_Expediente' => 'id']);
    }

    /**
     * Gets query for [[TipoTramite]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTipoTramite()
    {
        return $this->hasOne(TipoTramite::class, ['id' => 'id_TipoTramite']);
    }

    /**
     * Gets query for [[UserCreadoPor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserCreadoPor()
    {
        return $this->hasOne(User::class, ['id' => 'id_User_CreadoPor']);
    }

    /**
     * Gets query for [[UserModificadoPor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserModificadoPor()
    {
        return $this->hasOne(User::class, ['id' => 'id_User_modificadoPor']);
    }
}
