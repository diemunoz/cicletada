<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use app\models\Actividad;

$this->title = 'Asignación a grupo "Todos"';
?>

<div class="site-index">

    <div class="body-content">
        <div class="col-md-3"></div>

        <div class="col-md-6">
            <legend><h3 class="text-center"><?= Html::encode($this->title) ?></h3></legend>

            <br>

            <form class="form-horizontal" action="index.php?r=site%2Fasigna" method="post">
                <div class="form-group">
                    <p class="text-center"><strong>SELECCIONE</strong></p>
                    <div class="radio">
                        <label>
                        <input type="radio" name="opcion" id="todos" value="0" checked="">
                        ASIGNAR TODOS LOS PARTICIPANTES AL GRUPO "TODOS"
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                        <input type="radio" name="opcion" id="real" value="1">
                        ASIGNAR TODOS LOS PARTICIPANTES A SU GRUPO "REAL"
                        </label>
                    </div>
                </div>

                <div class="form-group text-center">
                    <input class="btn btn-danger" type="submit" value="Aceptar" onclick="return confirm('¿Esta seguro de realizar esta acción?');"/>
                </div>
            </form>
        </div>
        <div class="col-md-3"></div>

    </div>
</div>
