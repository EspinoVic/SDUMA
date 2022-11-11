<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Expediente;

/**
 * ExpedienteSearch represents the model behind the search form of `common\models\Expediente`.
 */
class ExpedienteSearch extends Expediente
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'idAnual', 'anio', 'estado', 'id_Persona_Solicita', 'id_User_CreadoPor', 'id_User_modificadoPor', 'id_TipoTramite'], 'integer'],
            [['fechaCreacion', 'fechaModificacion'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Expediente::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'idAnual' => $this->idAnual,
            'anio' => $this->anio,
            'fechaCreacion' => $this->fechaCreacion,
            'fechaModificacion' => $this->fechaModificacion,
            'estado' => $this->estado,
            'id_Persona_Solicita' => $this->id_Persona_Solicita,
            'id_User_CreadoPor' => $this->id_User_CreadoPor,
            'id_User_modificadoPor' => $this->id_User_modificadoPor,
            'id_TipoTramite' => $this->id_TipoTramite,
        ]);

        return $dataProvider;
    }
}
