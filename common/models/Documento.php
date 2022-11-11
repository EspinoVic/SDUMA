<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Documento".
 *
 * @property int $id
 * @property string $nombre
 * @property int $isActivo
 *
 * @property SolicitudConstruccionHasDocumento[] $solicitudConstruccionHasDocumentos
 * @property SolicitudConstruccion[] $solicitudConstruccions
 * @property TipoTramiteHasDocumento[] $tipoTramiteHasDocumentos
 * @property TipoTramite[] $tipoTramites
 */
class Documento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Documento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['isActivo'], 'integer'],
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
            'isActivo' => 'Is Activo',
        ];
    }

    /**
     * Gets query for [[SolicitudConstruccionHasDocumentos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitudConstruccionHasDocumentos()
    {
        return $this->hasMany(SolicitudConstruccionHasDocumento::class, ['id_Documento' => 'id']);
    }

    /**
     * Gets query for [[SolicitudConstruccions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitudConstruccions()
    {
        return $this->hasMany(SolicitudConstruccion::class, ['id' => 'id_SolicitudConstruccion'])->viaTable('SolicitudConstruccion_has_Documento', ['id_Documento' => 'id']);
    }

    /**
     * Gets query for [[TipoTramiteHasDocumentos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTipoTramiteHasDocumentos()
    {
        return $this->hasMany(TipoTramiteHasDocumento::class, ['id_Documento' => 'id']);
    }

    /**
     * Gets query for [[TipoTramites]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTipoTramites()
    {
        return $this->hasMany(TipoTramite::class, ['id' => 'id_TipoTramite'])->viaTable('TipoTramite_has_Documento', ['id_Documento' => 'id']);
    }
}
