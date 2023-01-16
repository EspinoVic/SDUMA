<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "SolicitudGenerica".
 *
 * @property int $id
 * @property int $superficieTotal
 * @property int $niveles
 * @property float $superficiePorConstruir
 * @property float $areaPreExistente
 * @property float|null $altura
 * @property float|null $metrosLineales
 * @property string|null $firmaMetrosLinealesDRO
 * @property string|null $firmaAlturaDRO
 * @property int|null $id_PersonaFisica
 * @property int|null $id_PersonaMoral
 * @property int $id_Contacto
 * @property int $id_DomicilioNotificaciones
 * @property int $id_MotivoConstruccion
 * @property int $id_SolicitudGenericaCuentaCon
 * @property int|null $id_Escritura
 * @property int|null $id_ConstanciaEscritura
 * @property int|null $id_ConstanciaPosecionEjidal
 * @property int|null $id_TipoPredio
 * @property int $id_GeneroConstruccion
 * @property int|null $id_SubGeneroConstruccion
 * @property int $id_DomicilioPredio
 * @property int|null $id_DirectorResponsableObra
 * @property int $id_Documento_MemoriaCalculo
 * @property int $id_Documento_MecanicaSuelos
 * @property int $id_Documento_LicenciaConstruccionAreaPreexistenteFile
 * @property int $id_User_CreadoPor
 * @property int $id_User_ModificadoPor
 * @property string $fechaCreacion
 * @property string $fechaModificacion
 *
 * @property ConstanciaEscritura $constanciaEscritura
 * @property ConstanciaPosecionEjidal $constanciaPosecionEjidal
 * @property Contacto $contacto
 * @property DirectorResponsableObra $directorResponsableObra
 * @property Domicilio $domicilioNotificaciones
 * @property Domicilio $domicilioPredio
 * @property Escritura $escritura
 * @property GeneroConstruccion $generoConstruccion
 * @property MotivoConstruccion $motivoConstruccion
 * @property Persona $personaFisica
 * @property PersonaMoral $personaMoral
 * @property SolicitudGenericaCuentaCon $solicitudGenericaCuentaCon
 * @property SubGeneroConstruccion $subGeneroConstruccion
 * @property TipoPredio $tipoPredio
 * @property User $userCreadoPor
 * @property User $userModificadoPor
 */
class SolicitudGenerica extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'SolicitudGenerica';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['superficieTotal', 'superficiePorConstruir', 'areaPreExistente', 'id_Contacto', 'id_DomicilioNotificaciones', 'id_MotivoConstruccion', 'id_SolicitudGenericaCuentaCon', 'id_GeneroConstruccion', 'id_DomicilioPredio', 'id_Documento_MemoriaCalculo', 'id_Documento_MecanicaSuelos', 'id_Documento_LicenciaConstruccionAreaPreexistenteFile', 'id_User_CreadoPor', 'id_User_ModificadoPor', 'fechaCreacion', 'fechaModificacion'], 'required'],
            [['superficieTotal', 'niveles', 'id_PersonaFisica', 'id_PersonaMoral', 'id_Contacto', 'id_DomicilioNotificaciones', 'id_MotivoConstruccion', 'id_SolicitudGenericaCuentaCon', 'id_Escritura', 'id_ConstanciaEscritura', 'id_ConstanciaPosecionEjidal', 'id_TipoPredio', 'id_GeneroConstruccion', 'id_SubGeneroConstruccion', 'id_DomicilioPredio', 'id_DirectorResponsableObra', 'id_Documento_MemoriaCalculo', 'id_Documento_MecanicaSuelos', 'id_Documento_LicenciaConstruccionAreaPreexistenteFile', 'id_User_CreadoPor', 'id_User_ModificadoPor'], 'integer'],
            [['superficiePorConstruir', 'areaPreExistente', 'altura', 'metrosLineales'], 'number'],
            [['fechaCreacion', 'fechaModificacion'], 'safe'],
            [['firmaMetrosLinealesDRO', 'firmaAlturaDRO'], 'string', 'max' => 100],
            [['id_PersonaFisica'], 'exist', 'skipOnError' => true, 'targetClass' => Persona::class, 'targetAttribute' => ['id_PersonaFisica' => 'id']],
            [['id_PersonaMoral'], 'exist', 'skipOnError' => true, 'targetClass' => PersonaMoral::class, 'targetAttribute' => ['id_PersonaMoral' => 'id']],
            [['id_Contacto'], 'exist', 'skipOnError' => true, 'targetClass' => Contacto::class, 'targetAttribute' => ['id_Contacto' => 'id']],
            [['id_DomicilioNotificaciones'], 'exist', 'skipOnError' => true, 'targetClass' => Domicilio::class, 'targetAttribute' => ['id_DomicilioNotificaciones' => 'id']],
            [['id_MotivoConstruccion'], 'exist', 'skipOnError' => true, 'targetClass' => MotivoConstruccion::class, 'targetAttribute' => ['id_MotivoConstruccion' => 'id']],
            [['id_SolicitudGenericaCuentaCon'], 'exist', 'skipOnError' => true, 'targetClass' => SolicitudGenericaCuentaCon::class, 'targetAttribute' => ['id_SolicitudGenericaCuentaCon' => 'id']],
            [['id_Escritura'], 'exist', 'skipOnError' => true, 'targetClass' => Escritura::class, 'targetAttribute' => ['id_Escritura' => 'id']],
            [['id_ConstanciaEscritura'], 'exist', 'skipOnError' => true, 'targetClass' => ConstanciaEscritura::class, 'targetAttribute' => ['id_ConstanciaEscritura' => 'id']],
            [['id_ConstanciaPosecionEjidal'], 'exist', 'skipOnError' => true, 'targetClass' => ConstanciaPosecionEjidal::class, 'targetAttribute' => ['id_ConstanciaPosecionEjidal' => 'id']],
            [['id_TipoPredio'], 'exist', 'skipOnError' => true, 'targetClass' => TipoPredio::class, 'targetAttribute' => ['id_TipoPredio' => 'id']],
            [['id_GeneroConstruccion'], 'exist', 'skipOnError' => true, 'targetClass' => GeneroConstruccion::class, 'targetAttribute' => ['id_GeneroConstruccion' => 'id']],
            [['id_SubGeneroConstruccion'], 'exist', 'skipOnError' => true, 'targetClass' => SubGeneroConstruccion::class, 'targetAttribute' => ['id_SubGeneroConstruccion' => 'id']],
            [['id_DomicilioPredio'], 'exist', 'skipOnError' => true, 'targetClass' => Domicilio::class, 'targetAttribute' => ['id_DomicilioPredio' => 'id']],
            [['id_DirectorResponsableObra'], 'exist', 'skipOnError' => true, 'targetClass' => DirectorResponsableObra::class, 'targetAttribute' => ['id_DirectorResponsableObra' => 'id']],
            [['id_User_CreadoPor'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_User_CreadoPor' => 'id']],
            [['id_User_ModificadoPor'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_User_ModificadoPor' => 'id']],
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
            'niveles' => 'Niveles',
            'superficiePorConstruir' => 'Superficie Por Construir',
            'areaPreExistente' => 'Area Pre Existente',
            'altura' => 'Altura',
            'metrosLineales' => 'Metros Lineales',
            'firmaMetrosLinealesDRO' => 'Firma Metros Lineales Dro',
            'firmaAlturaDRO' => 'Firma Altura Dro',
            'id_PersonaFisica' => 'Id Persona Fisica',
            'id_PersonaMoral' => 'Id Persona Moral',
            'id_Contacto' => 'Id Contacto',
            'id_DomicilioNotificaciones' => 'Id Domicilio Notificaciones',
            'id_MotivoConstruccion' => 'Id Motivo Construccion',
            'id_SolicitudGenericaCuentaCon' => 'Id Solicitud Generica Cuenta Con',
            'id_Escritura' => 'Id Escritura',
            'id_ConstanciaEscritura' => 'Id Constancia Escritura',
            'id_ConstanciaPosecionEjidal' => 'Id Constancia Posecion Ejidal',
            'id_TipoPredio' => 'Id Tipo Predio',
            'id_GeneroConstruccion' => 'Id Genero Construccion',
            'id_SubGeneroConstruccion' => 'Id Sub Genero Construccion',
            'id_DomicilioPredio' => 'Id Domicilio Predio',
            'id_DirectorResponsableObra' => 'Id Director Responsable Obra',
            'id_Documento_MemoriaCalculo' => 'Id Documento Memoria Calculo',
            'id_Documento_MecanicaSuelos' => 'Id Documento Mecanica Suelos',
            'id_Documento_LicenciaConstruccionAreaPreexistenteFile' => 'Id Documento Licencia Construccion Area Preexistente File',
            'id_User_CreadoPor' => 'Id User Creado Por',
            'id_User_ModificadoPor' => 'Id User Modificado Por',
            'fechaCreacion' => 'Fecha Creacion',
            'fechaModificacion' => 'Fecha Modificacion',
        ];
    }

    /**
     * Gets query for [[ConstanciaEscritura]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConstanciaEscritura()
    {
        return $this->hasOne(ConstanciaEscritura::class, ['id' => 'id_ConstanciaEscritura']);
    }

    /**
     * Gets query for [[ConstanciaPosecionEjidal]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConstanciaPosecionEjidal()
    {
        return $this->hasOne(ConstanciaPosecionEjidal::class, ['id' => 'id_ConstanciaPosecionEjidal']);
    }

    /**
     * Gets query for [[Contacto]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getContacto()
    {
        return $this->hasOne(Contacto::class, ['id' => 'id_Contacto']);
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
     * Gets query for [[DomicilioNotificaciones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDomicilioNotificaciones()
    {
        return $this->hasOne(Domicilio::class, ['id' => 'id_DomicilioNotificaciones']);
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
     * Gets query for [[Escritura]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEscritura()
    {
        return $this->hasOne(Escritura::class, ['id' => 'id_Escritura']);
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
     * Gets query for [[PersonaFisica]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPersonaFisica()
    {
        return $this->hasOne(Persona::class, ['id' => 'id_PersonaFisica']);
    }

    /**
     * Gets query for [[PersonaMoral]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPersonaMoral()
    {
        return $this->hasOne(PersonaMoral::class, ['id' => 'id_PersonaMoral']);
    }

    /**
     * Gets query for [[SolicitudGenericaCuentaCon]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitudGenericaCuentaCon()
    {
        return $this->hasOne(SolicitudGenericaCuentaCon::class, ['id' => 'id_SolicitudGenericaCuentaCon']);
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
     * Gets query for [[TipoPredio]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTipoPredio()
    {
        return $this->hasOne(TipoPredio::class, ['id' => 'id_TipoPredio']);
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
        return $this->hasOne(User::class, ['id' => 'id_User_ModificadoPor']);
    }
}
