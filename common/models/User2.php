<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $id_Datos_Persona
 * @property int $id_Horario
 * @property int $id_UserLevel
 * @property string|null $verification_token
 *
 * @property Persona $datosPersona
 * @property Expediente[] $expedientes
 * @property Expediente[] $expedientes0
 * @property Horario $horario
 * @property Rol[] $rols
 * @property Solicitudconstruccion[] $solicitudconstruccions
 * @property Solicitudconstruccion[] $solicitudconstruccions0
 * @property UserHasRol[] $userHasRols
 * @property Userlevel $userLevel
 */
class User2 extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at', 'id_Datos_Persona'], 'required'],
            [['status', 'created_at', 'updated_at', 'id_Datos_Persona', 'id_Horario', 'id_UserLevel'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'verification_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['id_Horario'], 'exist', 'skipOnError' => true, 'targetClass' => Horario::class, 'targetAttribute' => ['id_Horario' => 'id']],
            [['id_UserLevel'], 'exist', 'skipOnError' => true, 'targetClass' => Userlevel::class, 'targetAttribute' => ['id_UserLevel' => 'id']],
            [['id_Datos_Persona'], 'exist', 'skipOnError' => true, 'targetClass' => Persona::class, 'targetAttribute' => ['id_Datos_Persona' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'id_Datos_Persona' => 'Id Datos Persona',
            'id_Horario' => 'Id Horario',
            'id_UserLevel' => 'Id User Level',
            'verification_token' => 'Verification Token',
        ];
    }

    /**
     * Gets query for [[DatosPersona]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDatosPersona()
    {
        return $this->hasOne(Persona::class, ['id' => 'id_Datos_Persona']);
    }

    /**
     * Gets query for [[Expedientes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExpedientes()
    {
        return $this->hasMany(Expediente::class, ['id_User_CreadoPor' => 'id']);
    }

    /**
     * Gets query for [[Expedientes0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExpedientes0()
    {
        return $this->hasMany(Expediente::class, ['id_User_modificadoPor' => 'id']);
    }

    /**
     * Gets query for [[Horario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHorario()
    {
        return $this->hasOne(Horario::class, ['id' => 'id_Horario']);
    }

    /**
     * Gets query for [[Rols]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRols()
    {
        return $this->hasMany(Rol::class, ['id' => 'Id_Rol'])->viaTable('user_has_rol', ['Id_User' => 'id']);
    }

    /**
     * Gets query for [[Solicitudconstruccions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitudconstruccions()
    {
        return $this->hasMany(Solicitudconstruccion::class, ['id_Persona_CreadoPor' => 'id']);
    }

    /**
     * Gets query for [[Solicitudconstruccions0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitudconstruccions0()
    {
        return $this->hasMany(Solicitudconstruccion::class, ['id_Persona_ModificadoPor' => 'id']);
    }

    /**
     * Gets query for [[UserHasRols]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserHasRols()
    {
        return $this->hasMany(UserHasRol::class, ['Id_User' => 'id']);
    }

    /**
     * Gets query for [[UserLevel]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserLevel()
    {
        return $this->hasOne(Userlevel::class, ['id' => 'id_UserLevel']);
    }
}
