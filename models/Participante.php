<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TB_Participante".
 *
 * @property string $Nro
 * @property string $CodGrupo
 * @property string $ApellidoPaterno
 * @property string $ApellidoMaterno
 * @property string $Nombres
 * @property string $Zona
 * @property string $Rut
 * @property string $Edad
 * @property string $Telefono
 * @property string $TallaPolera
 * @property string $CategoriaKms
 * @property string $Observaciones
 * @property integer $Estado
 * @property string $LastModified
 */
class Participante extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TB_Participante';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Nro', 'ApellidoPaterno', 'ApellidoMaterno', 'Nombres', 'Zona', 'Rut', 'Edad', 'Telefono', 'TallaPolera', 'CategoriaKms', 'Observaciones', 'Estado', 'LastModified'], 'required'],
            [['Estado', 'LastModified'], 'integer'],
            [['Nro'], 'string', 'max' => 3],
            [['CodGrupo'], 'string', 'max' => 36],
            [['ApellidoPaterno', 'ApellidoMaterno', 'Nombres', 'Zona', 'Rut', 'Edad', 'Telefono', 'TallaPolera', 'CategoriaKms'], 'string', 'max' => 45],
            [['Observaciones'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Nro' => 'Nro',
            'CodGrupo' => 'Cod Grupo',
            'ApellidoPaterno' => 'Apellido Paterno',
            'ApellidoMaterno' => 'Apellido Materno',
            'Nombres' => 'Nombres',
            'Zona' => 'Zona',
            'Rut' => 'Rut',
            'Edad' => 'Edad',
            'Telefono' => 'Telefono',
            'TallaPolera' => 'Talla Polera',
            'CategoriaKms' => 'Categoria Kms',
            'Observaciones' => 'Observaciones',
            'Estado' => 'Estado',
            'LastModified' => 'Last Modified',
        ];
    }

    public function getNombreCompleto()
    {
        return $this->Nombres.' '.$this->ApellidoPaterno.' '.$this->ApellidoMaterno;
    }
}
