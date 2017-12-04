<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TB_Actividad".
 *
 * @property string $CodActividad
 * @property string $Actividad
 * @property integer $Estado
 * @property string $LastModified
 */
class Actividad extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TB_Actividad';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CodActividad', 'Actividad', 'EstadoActividad', 'Estado', 'LastModified'], 'required'],
            [['EstadoActividad', 'Estado', 'LastModified'], 'integer'],
            [['CodActividad'], 'string', 'max' => 36],
            [['Actividad'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CodActividad' => 'Cod Actividad',
            'Actividad' => 'Actividad',
            'EstadoActividad' => 'Estado Actividad',
            'Estado' => 'Estado',
            'LastModified' => 'Last Modified',
        ];
    }
}
