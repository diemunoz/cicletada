<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TB_Grupo".
 *
 * @property string $CodGrupo
 * @property string $CodBus
 * @property string $Grupo
 * @property string $ImeiEquipo
 * @property integer $Estado
 * @property string $LastModified
 */
class Grupo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TB_Grupo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CodGrupo', 'Grupo', 'Estado', 'LastModified'], 'required'],
            [['Estado', 'LastModified'], 'integer'],
            [['CodGrupo', 'CodBus'], 'string', 'max' => 36],
            [['Grupo'], 'string', 'max' => 45],
            [['ImeiEquipo'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CodGrupo' => 'Cod Grupo',
            'CodBus' => 'Bus',
            'Grupo' => 'Nombre Grupo',
            'ImeiEquipo' => 'Imei Equipo',
            'Estado' => 'Estado',
            'LastModified' => 'Last Modified',
        ];
    }

    public function getParticipantes(){
        $select = '<div class="col-md-4">';
        $model = Participante::find()->where(['NOT IN','CodGrupo',$this->CodGrupo])->andWhere(['CodGrupo'=>''])->orderBy(['ApellidoPaterno'=>SORT_ASC,'Nombres'=>SORT_ASC])->all();
        $count = Participante::find()->where(['NOT IN','CodGrupo',$this->CodGrupo])->andWhere(['CodGrupo'=>''])->orderBy(['ApellidoPaterno'=>SORT_ASC,'Nombres'=>SORT_ASC])->count();
        $i=0;
        foreach ($model as $p) {
            $select .= '<input type="checkbox" name="'.$p->Nro.'">'.$p->Nro.' - '.$p->ApellidoPaterno.' '.$p->Nombres.'<br>';
            if(($count/2) <= $i){
                $select .='</div>';
                $select .='<div class="col-md-4">';
                $i =0;
            }
            $i++;
        }
        $select .= '</div>';

        return $select;
    }
}
