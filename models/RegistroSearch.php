<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Registro;

/**
 * RegistroSearch represents the model behind the search form about `app\models\Registro`.
 */
class RegistroSearch extends Registro
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CodRegistro', 'CodParticipante', 'CodActividad', 'Fecha', 'ImeiEquipo', 'Latitud', 'Longitud', 'FechaServer', 'RowGuidControl'], 'safe'],
            [['TipoRegistro', 'Estado', 'LastModified'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Registro::find();

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
            'Fecha' => $this->Fecha,
            'TipoRegistro' => $this->TipoRegistro,
            'Estado' => $this->Estado,
            'LastModified' => $this->LastModified,
            'FechaServer' => $this->FechaServer,
        ]);

        $query->andFilterWhere(['like', 'CodRegistro', $this->CodRegistro])
            ->andFilterWhere(['like', 'CodParticipante', $this->CodParticipante])
            ->andFilterWhere(['like', 'CodActividad', $this->CodActividad])
            ->andFilterWhere(['like', 'ImeiEquipo', $this->ImeiEquipo])
            ->andFilterWhere(['like', 'Latitud', $this->Latitud])
            ->andFilterWhere(['like', 'Longitud', $this->Longitud])
            ->andFilterWhere(['like', 'RowGuidControl', $this->RowGuidControl]);

        return $dataProvider;
    }
}
