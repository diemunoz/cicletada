<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Participante;

/**
 * ParticipanteSearch represents the model behind the search form about `app\models\Participante`.
 */
class ParticipanteSearch extends Participante
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Nro', 'CodGrupo', 'ApellidoPaterno', 'ApellidoMaterno', 'Nombres', 'Zona', 'Rut', 'TallaPolera', 'CategoriaKms', 'Observaciones'], 'safe'],
            [['Edad', 'Telefono', 'Estado', 'LastModified'], 'integer'],
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
        $query = Participante::find();

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
            'Edad' => $this->Edad,
            'Telefono' => $this->Telefono,
            'Estado' => $this->Estado,
            'LastModified' => $this->LastModified,
        ]);

        $query->andFilterWhere(['like', 'Nro', $this->Nro])
            ->andFilterWhere(['like', 'CodGrupo', $this->CodGrupo])
            ->andFilterWhere(['like', 'ApellidoPaterno', $this->ApellidoPaterno])
            ->andFilterWhere(['like', 'ApellidoMaterno', $this->ApellidoMaterno])
            ->andFilterWhere(['like', 'Nombres', $this->Nombres])
            ->andFilterWhere(['like', 'Zona', $this->Zona])
            ->andFilterWhere(['like', 'Rut', $this->Rut])
            ->andFilterWhere(['like', 'TallaPolera', $this->TallaPolera])
            ->andFilterWhere(['like', 'CategoriaKms', $this->CategoriaKms])
            ->andFilterWhere(['like', 'Observaciones', $this->Observaciones]);

        return $dataProvider;
    }
}
