<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Documento".
 *
 * @property int $id
 * @property string $nombre
 * @property int $isActivo
 * @property int $soloEntregaFisica
 *
 * @property ConfigTramiteMotivoCuentaconDoc[] $configTramiteMotivoCuentaconDocs
 * @property SolicitudConstruccionHasDocumento[] $solicitudConstruccionHasDocumentos
 * @property SolicitudConstruccion[] $solicitudConstruccions
 * @property SolicitudGenericaHasDocumento[] $solicitudGenericaHasDocumentos
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
            [['isActivo', 'soloEntregaFisica'], 'integer'],
            [['nombre'], 'string', 'max' => 255],
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
            'soloEntregaFisica' => 'Solo Entrega Fisica',
        ];
    }

    /**
     * Gets query for [[ConfigTramiteMotivoCuentaconDocs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConfigTramiteMotivoCuentaconDocs()
    {
        return $this->hasMany(ConfigTramiteMotivoCuentaconDoc::class, ['id_Documento' => 'id']);
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
     * Gets query for [[SolicitudGenericaHasDocumentos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitudGenericaHasDocumentos()
    {
        return $this->hasMany(SolicitudGenericaHasDocumento::class, ['id_Documento' => 'id']);
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
