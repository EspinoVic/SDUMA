<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "SolicitudConstruccion".
 *
 * @property int $id
 * @property int|null $superficieTotal
 * @property int|null $superficiePorConstruir
 * @property int|null $superficiePreexistente
 * @property int|null $niveles
 * @property int|null $cajones
 * @property string|null $COS
 * @property string|null $CUS
 * @property string|null $RPP
 * @property string|null $tomo
 * @property string|null $folioElec
 * @property string|null $cuentaCatastral
 * @property string $fechaCreacion
 * @property string $fechaModificacion
 * @property int $isDeleted
 * @property int $id_Persona_CreadoPor
 * @property int $id_Persona_ModificadoPor
 * @property int $id_Persona_DomicilioNotificaciones
 * @property int $id_DomicilioPredio
 * @property int $id_MotivoConstruccion
 * @property int|null $id_Contacto
 * @property int|null $id_TipoPredio
 * @property int $id_TipoConstruccion
 * @property int $id_GeneroConstruccion
 * @property int|null $id_SubGeneroConstruccion
 * @property int|null $id_DirectorResponsableObra
 * @property int|null $id_CorrSeguridadEstruc
 * @property int $id_Expediente
 *
 * @property Contacto $contacto
 * @property CorrSeguridadEstruc $corrSeguridadEstruc
 * @property DirectorResponsableObra $directorResponsableObra
 * @property Documento[] $documentos
 * @property Domicilio $domicilioPredio
 * @property Expediente $expediente
 * @property GeneroConstruccion $generoConstruccion
 * @property MotivoConstruccion $motivoConstruccion
 * @property User $personaCreadoPor
 * @property Domicilio $personaDomicilioNotificaciones
 * @property User $personaModificadoPor
 * @property Persona[] $personas
 * @property SolicitudConstruccionHasDocumento[] $solicitudConstruccionHasDocumentos
 * @property SolicitudConstruccionHasPersona[] $solicitudConstruccionHasPersonas
 * @property SubGeneroConstruccion $subGeneroConstruccion
 * @property TipoConstruccion $tipoConstruccion
 * @property TipoPredio $tipoPredio
 */
class SolicitudConstruccion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'SolicitudConstruccion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['superficieTotal', 'superficiePorConstruir', 'superficiePreexistente', 'niveles', 'cajones', 'isDeleted', 'id_Persona_CreadoPor', 'id_Persona_ModificadoPor', 'id_Persona_DomicilioNotificaciones', 'id_DomicilioPredio', 'id_MotivoConstruccion', 'id_Contacto', 'id_TipoPredio', 'id_TipoConstruccion', 'id_GeneroConstruccion', 'id_SubGeneroConstruccion', 'id_DirectorResponsableObra', 'id_CorrSeguridadEstruc', 'id_Expediente'], 'integer'],
            [['fechaCreacion', 'fechaModificacion', 'id_Persona_CreadoPor', 'id_Persona_ModificadoPor', 'id_Persona_DomicilioNotificaciones', 'id_DomicilioPredio', 'id_MotivoConstruccion', 'id_TipoConstruccion', 'id_GeneroConstruccion', 'id_Expediente'], 'required'],
            [['fechaCreacion', 'fechaModificacion'], 'safe'],
            [['COS', 'CUS', 'RPP', 'tomo', 'folioElec', 'cuentaCatastral'], 'string', 'max' => 45],
            [['id_Persona_CreadoPor'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_Persona_CreadoPor' => 'id']],
            [['id_Persona_ModificadoPor'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_Persona_ModificadoPor' => 'id']],
            [['id_MotivoConstruccion'], 'exist', 'skipOnError' => true, 'targetClass' => MotivoConstruccion::class, 'targetAttribute' => ['id_MotivoConstruccion' => 'id']],
            [['id_Persona_DomicilioNotificaciones'], 'exist', 'skipOnError' => true, 'targetClass' => Domicilio::class, 'targetAttribute' => ['id_Persona_DomicilioNotificaciones' => 'id']],
            [['id_DomicilioPredio'], 'exist', 'skipOnError' => true, 'targetClass' => Domicilio::class, 'targetAttribute' => ['id_DomicilioPredio' => 'id']],
            [['id_TipoPredio'], 'exist', 'skipOnError' => true, 'targetClass' => TipoPredio::class, 'targetAttribute' => ['id_TipoPredio' => 'id']],
            [['id_Contacto'], 'exist', 'skipOnError' => true, 'targetClass' => Contacto::class, 'targetAttribute' => ['id_Contacto' => 'Id']],
            [['id_GeneroConstruccion'], 'exist', 'skipOnError' => true, 'targetClass' => GeneroConstruccion::class, 'targetAttribute' => ['id_GeneroConstruccion' => 'id']],
           // ['id_GeneroConstruccion', 'compare', 'compareValue' => 1, 'operator' => '>='],

            [['id_SubGeneroConstruccion'], 'exist', 'skipOnError' => true, 'targetClass' => SubGeneroConstruccion::class, 'targetAttribute' => ['id_SubGeneroConstruccion' => 'id']],
/*             ['id_GeneroConstruccion', 'compare', 'compareValue' => 1, 'operator' => '>='],
 */
            [['id_TipoConstruccion'], 'exist', 'skipOnError' => true, 'targetClass' => TipoConstruccion::class, 'targetAttribute' => ['id_TipoConstruccion' => 'id']],
            [['id_CorrSeguridadEstruc'], 'exist', 'skipOnError' => true, 'targetClass' => CorrSeguridadEstruc::class, 'targetAttribute' => ['id_CorrSeguridadEstruc' => 'id']],
            [['id_DirectorResponsableObra'], 'exist', 'skipOnError' => true, 'targetClass' => DirectorResponsableObra::class, 'targetAttribute' => ['id_DirectorResponsableObra' => 'id']],
            [['id_Expediente'], 'exist', 'skipOnError' => true, 'targetClass' => Expediente::class, 'targetAttribute' => ['id_Expediente' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'superficieTotal' => 'Superficie Total',
            'superficiePorConstruir' => 'Superficie Por Construir',
            'superficiePreexistente' => 'Superficie Preexistente',
            'niveles' => 'Niveles',
            'cajones' => 'Cajones',
            'COS' => 'COS',
            'CUS' => 'CUS',
            'RPP' => 'RPP',
            'tomo' => 'Tomo',
            'folioElec' => 'Folio Electrónico',
            'cuentaCatastral' => 'Cuenta Catastral',
            'fechaCreacion' => 'Fecha Creación',
            'fechaModificacion' => 'Fecha Modificación',
            'isDeleted' => 'Is Deleted',
            'id_Persona_CreadoPor' => 'Creado Por',
            'id_Persona_ModificadoPor' => 'Modificado Por',
            'id_Persona_DomicilioNotificaciones' => 'Id Persona Domicilio Notificaciones',
            'id_DomicilioPredio' => 'Id Domicilio Predio',
            'id_MotivoConstruccion' => 'Id Motivo Construccion',
            'id_Contacto' => 'Id Contacto',
            'id_TipoPredio' => 'Id Tipo Predio',
            'id_TipoConstruccion' => 'Id Tipo Construccion',
            'id_GeneroConstruccion' => 'Id Genero Construccion',
            'id_SubGeneroConstruccion' => 'Id Sub Genero Construccion',
            'id_DirectorResponsableObra' => 'Id Director Responsable Obra',
            'id_CorrSeguridadEstruc' => 'Id Corr Seguridad Estruc',
            'id_Expediente' => 'Id Expediente',
        ];
    }

    /**
     * Gets query for [[Contacto]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getContacto()
    {
        return $this->hasOne(Contacto::class, ['Id' => 'id_Contacto']);
    }

    /**
     * Gets query for [[CorrSeguridadEstruc]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCorrSeguridadEstruc()
    {
        return $this->hasOne(CorrSeguridadEstruc::class, ['id' => 'id_CorrSeguridadEstruc']);
    }

    /**
     * Gets query for [[DirectorResponsableObra]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDirectorResponsableObra()
    {
        return $this->hasOne(DirectorResponsableObra::class, ['id' => 'id_DirectorResponsableObra']);
    }

    /**
     * Gets query for [[Documentos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentos()
    {
        return $this->hasMany(Documento::class, ['id' => 'id_Documento'])->viaTable('SolicitudConstruccion_has_Documento', ['id_SolicitudConstruccion' => 'id']);
    }

    /**
     * Gets query for [[DomicilioPredio]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDomicilioPredio()
    {
        return $this->hasOne(Domicilio::class, ['id' => 'id_DomicilioPredio']);
    }

    /**
     * Gets query for [[Expediente]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExpediente()
    {
        return $this->hasOne(Expediente::class, ['id' => 'id_Expediente']);
    }

    /**
     * Gets query for [[GeneroConstruccion]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGeneroConstruccion()
    {
        return $this->hasOne(GeneroConstruccion::class, ['id' => 'id_GeneroConstruccion']);
    }

    /**
     * Gets query for [[MotivoConstruccion]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMotivoConstruccion()
    {
        return $this->hasOne(MotivoConstruccion::class, ['id' => 'id_MotivoConstruccion']);
    }

    /**
     * Gets query for [[PersonaCreadoPor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPersonaCreadoPor()
    {
        return $this->hasOne(User::class, ['id' => 'id_Persona_CreadoPor']);
    }

    /**
     * Gets query for [[PersonaDomicilioNotificaciones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPersonaDomicilioNotificaciones()
    {
        return $this->hasOne(Domicilio::class, ['id' => 'id_Persona_DomicilioNotificaciones']);
    }

    /**
     * Gets query for [[PersonaModificadoPor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPersonaModificadoPor()
    {
        return $this->hasOne(User::class, ['id' => 'id_Persona_ModificadoPor']);
    }

    /**
     * Gets query for [[Personas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPersonas()
    {
        return $this->hasMany(Persona::class, ['id' => 'Persona_id'])->viaTable('SolicitudConstruccion_has_Persona', ['SolicitudConstruccion_Id' => 'id']);
    }

    /**
     * Gets query for [[SolicitudConstruccionHasDocumentos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitudConstruccionHasDocumentos()
    {
        return $this->hasMany(SolicitudConstruccionHasDocumento::class, ['id_SolicitudConstruccion' => 'id']);
    }

    /**
     * Gets query for [[SolicitudConstruccionHasPersonas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitudConstruccionHasPersonas()
    {
        return $this->hasMany(SolicitudConstruccionHasPersona::class, ['SolicitudConstruccion_Id' => 'id']);
    }

    /**
     * Gets query for [[SubGeneroConstruccion]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubGeneroConstruccion()
    {
        return $this->hasOne(SubGeneroConstruccion::class, ['id' => 'id_SubGeneroConstruccion']);
    }

    /**
     * Gets query for [[TipoConstruccion]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTipoConstruccion()
    {
        return $this->hasOne(TipoConstruccion::class, ['id' => 'id_TipoConstruccion']);
    }

    /**
     * Gets query for [[TipoPredio]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTipoPredio()
    {
        return $this->hasOne(TipoPredio::class, ['id' => 'id_TipoPredio']);
    }
}
