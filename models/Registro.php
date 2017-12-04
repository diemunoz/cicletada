<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TB_Registro".
 *
 * @property string $CodRegistro
 * @property string $CodParticipante
 * @property string $CodActividad
 * @property string $Fecha
 * @property integer $TipoRegistro
 * @property string $ImeiEquipo
 * @property string $Latitud
 * @property string $Longitud
 * @property integer $Estado
 * @property string $LastModified
 * @property string $FechaServer
 * @property string $RowGuidControl
 */
class Registro extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TB_Registro';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CodRegistro', 'CodParticipante', 'CodActividad', 'Fecha', 'TipoRegistro', 'ImeiEquipo', 'Latitud', 'Longitud', 'Estado', 'LastModified', 'FechaServer', 'RowGuidControl'], 'required'],
            [['Fecha', 'FechaServer'], 'safe'],
            [['TipoRegistro', 'Estado', 'LastModified'], 'integer'],
            [['CodRegistro', 'CodActividad', 'RowGuidControl'], 'string', 'max' => 36],
            [['CodParticipante'], 'string', 'max' => 3],
            [['ImeiEquipo', 'Latitud', 'Longitud'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CodRegistro' => 'Cod Registro',
            'CodParticipante' => 'Cod Participante',
            'CodActividad' => 'Cod Actividad',
            'Fecha' => 'Fecha',
            'TipoRegistro' => 'Tipo Registro',
            'ImeiEquipo' => 'Imei Equipo',
            'Latitud' => 'Latitud',
            'Longitud' => 'Longitud',
            'Estado' => 'Estado',
            'LastModified' => 'Last Modified',
            'FechaServer' => 'Fecha Server',
            'RowGuidControl' => 'Row Guid Control',
        ];
    }
}
