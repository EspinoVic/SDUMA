<?php

namespace frontend\models;

use common\models\Domicilio;
use Yii;
use yii\base\Model;

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
 
 */
class SolicitudConstruccionCreateForm extends Model
{
   // public $id;
    public $superficieTotal;
    public $superficiePorConstruir;
    public $superficiePreexistente;
    public $niveles;
    public $cajones;
    public $COS;
    public $CUS;
    public $RPP;
    public $tomo;
    public $folioElec;
    public $cuentaCatastral;
    public $fechaCreacion;
    public $fechaModificacion;
    public $isDeleted;

    //Id del usuario que inició sesión
    //public $id_Persona_CreadoPor;
    //public $id_Persona_ModificadoPor;

    //public $id_DomicilioPredio;
    public $domicilioPredio_id;
    public $domicilioPredio_coloniaFraccBarrio;
    public $domicilioPredio_calle;
    public $domicilioPredio_cp;
    public $domicilioPredio_numExt;
    public $domicilioPredio_numInt;
    public $domicilioPredio_entreCallesH;
    public $domicilioPredio_entreCallesV;

    //public $id_Persona_DomicilioNotificaciones;

    public $persona_DomicilioNotificaciones_id;
    public $persona_DomicilioNotificaciones_coloniaFraccBarrio;
    public $persona_DomicilioNotificaciones_calle;
    public $persona_DomicilioNotificaciones_cp;
    public $persona_DomicilioNotificaciones_numExt;
    public $persona_DomicilioNotificaciones_numInt;
    public $persona_DomicilioNotificaciones_entreCallesH;
    public $persona_DomicilioNotificaciones_entreCallesV;

    //public $id_Contacto;
    public $contacto_email;
    public $contacto_telefono;


    public $id_MotivoConstruccion;
    public $id_TipoPredio;
    public $id_TipoConstruccion;
    public $id_GeneroConstruccion;
    public $id_SubGeneroConstruccion;
    public $id_Expediente;


    //public $id_DirectorResponsableObra;
    public $directorResponsableObra_cedula;
    public $directorResponsableObra_titulo;
    public $directorResponsableObra_abreviacion;
    public $directorResponsableObra_isActivo;
    public $directorResponsableObra_nombre;
    public $directorResponsableObra_apelidoP;
    public $directorResponsableObra_apelidoM;
    
    //public $id_CorrSeguridadEstruc;
    public $corrSeguridadEstruc_cedula;
    public $corrSeguridadEstruc_titulo;
    public $corrSeguridadEstruc_abreviacion;
    public $corrSeguridadEstruc_isActivo;
    public $corrSeguridadEstruc_nombre;
    public $corrSeguridadEstruc_apelidoP;
    public $corrSeguridadEstruc_apelidoM;
    

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['superficieTotal', 'superficiePorConstruir', 'superficiePreexistente', 'niveles', 'cajones', 'isDeleted', 'id_Persona_CreadoPor', 'id_Persona_ModificadoPor', 'id_Persona_DomicilioNotificaciones', 'id_DomicilioPredio', 'id_MotivoConstruccion', 'id_Contacto', 'id_TipoPredio', 'id_TipoConstruccion', 'id_GeneroConstruccion', 'id_SubGeneroConstruccion', 'id_DirectorResponsableObra', 'id_CorrSeguridadEstruc', 'id_Expediente'], 'integer'],
            
            [[ 'id_MotivoConstruccion', 'id_TipoConstruccion', 'id_GeneroConstruccion', 'id_Expediente'], 'required'],
            [['domicilioPredio_coloniaFraccBarrio', 'domicilioPredio_calle','domicilioPredio_cp', ], 'required'],
            [['persona_DomicilioNotificaciones', 'persona_DomicilioNotificaciones','persona_DomicilioNotificaciones', ], 'required'],
            [[
                'directorResponsableObra_titulo',
                'directorResponsableObra_abreviacion',
                'directorResponsableObra_isActivo',
                'directorResponsableObra_nombre',
                'directorResponsableObra_apelidoP',

                'corrSeguridadEstruc_titulo',
                'corrSeguridadEstruc_abreviacion',
                'corrSeguridadEstruc_isActivo',
                'corrSeguridadEstruc_nombre',
                'corrSeguridadEstruc_apelidoP',
            ], 'required'],

          


            [['COS', 'CUS', 'RPP', 'tomo', 'folioElec', 'cuentaCatastral'], 'string', 'max' => 45],
            [['domicilioPredio_coloniaFraccBarrio', 'domicilioPredio_calle','domicilioPredio_cp', ], 'string', 'max' => 45],
            [['persona_DomicilioNotificaciones', 'persona_DomicilioNotificaciones','persona_DomicilioNotificaciones', ], 'string', 'max' => 45],
            [['contacto_email','contacto_telefono'], 'string', 'max' => 45],
            [[
                'directorResponsableObra_titulo',
                'directorResponsableObra_cedula',

                'corrSeguridadEstruc_titulo',
                'corrSeguridadEstruc_cedula', 
            ], 'string', 'max' => 45],

            [[
                'directorResponsableObra_abreviacion',            
                'corrSeguridadEstruc_abreviacion',
             ], 'string', 'max' => 10],
        
           
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
            'COS' => 'Cos',
            'CUS' => 'Cus',
            'RPP' => 'Rpp',
            'tomo' => 'Tomo',
            'folioElec' => 'Folio Elec',
            'cuentaCatastral' => 'Cuenta Catastral',
            'fechaCreacion' => 'Fecha Creacion',
            'fechaModificacion' => 'Fecha Modificacion',
            'isDeleted' => 'Is Deleted',
            'id_Persona_CreadoPor' => 'Id Persona Creado Por',
            'id_Persona_ModificadoPor' => 'Id Persona Modificado Por',
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
        return $this->hasOne(Contacto::class, ['id' => 'id_Contacto']);
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
