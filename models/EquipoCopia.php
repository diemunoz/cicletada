<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TB_EquiposCopia".
 *
 * @property string $ImeiEquipo
 * @property string $Equipo
 * @property string $CodGrupo
 * @property integer $Estado
 * @property string $LastModified
 */
class EquipoCopia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TB_EquiposCopia';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ImeiEquipo', 'Equipo', 'CodGrupo', 'Estado', 'LastModified'], 'required'],
            [['Estado', 'LastModified'], 'integer'],
            [['ImeiEquipo'], 'string', 'max' => 20],
            [['Equipo'], 'string', 'max' => 50],
            [['CodGrupo'], 'string', 'max' => 36],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ImeiEquipo' => 'Imei Equipo',
            'Equipo' => 'Equipo',
            'CodGrupo' => 'Cod Grupo',
            'Estado' => 'Estado',
            'LastModified' => 'Last Modified',
        ];
    }
}
