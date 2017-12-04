<?php 
include 'PHPExcel-1.8/Classes/PHPExcel.php';  
include 'PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';
include 'PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php';
/* @var $this yii\web\View */
use yii\helpers\Url;

use app\models\Grupo;
use app\models\Actividad;
//use app\models\Provincia;
//use app\models\Comuna;
//use app\models\Camion;

$this->title = 'Informe de Labor';

?>

<?php
try {
    date_default_timezone_set('America/Santiago');
    if (PHP_SAPI == 'cli'){
        die('Este archivo solo se puede ver desde un navegador web');
    }

    //echo $chofer.','.$region.','.$provincia.','.$comuna.','.$fecha;

    // Creamos el nuevo objeto de PHPExcel

    set_time_limit(0);
    ini_set('memory_limit','64M');

    $objPHPExcel = PHPExcel_IOFactory::load(Yii::$app->basePath.'/web/templates/ReporteCicletada.xlsx');

    $hoja = 0;

    $objPHPExcel->setActiveSheetIndex($hoja);  //set first sheet as active


    // Set properties
    //echo date('H:i:s') . " Set properties\n";
    $objPHPExcel->getProperties()->setCreator("Agroid");
    $objPHPExcel->getProperties()->setLastModifiedBy("Agroid");
    $objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
    $objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");

    $modelActividad = Actividad::find()->where(['CodActividad' => $actividad])->one();

    $grupos = Grupo::find()->where(['Estado' => 1])->all();

    foreach ($grupos as $grupo) {
        $sql = "select c.Actividad,
                    (case b.TipoRegistro when 1 then 'IDA' when 2 then 'REGRESO' end) as TipoRegistro,
                    a.Nro,
                    concat(a.Nombres,' ',a.ApellidoPaterno,' ',a.ApellidoMaterno) as NombreCompleto,
                    a.Rut,
                    b.Fecha,
                    d.Grupo as MiGrupo,
                    (select Grupo from TB_Grupo where CodGrupo=e.CodGrupo) as RealGrupo
                from TB_Participante a
                    left join TB_Registro b on b.CodParticipante=a.Nro 
                    left join TB_Actividad c on c.CodActividad=b.CodActividad
                    left join TB_Grupo d on d.CodGrupo=a.CodGrupo
                    left join TB_Equipos e on e.ImeiEquipo=b.ImeiEquipo 
                where b.CodActividad='".$actividad."' and d.CodGrupo = '".$grupo->CodGrupo."'
                order by b.CodActividad,a.Nro,b.TipoRegistro";

        //echo $sql;

        $sql2 = "select Nro,
                    concat(Nombres,' ',ApellidoPaterno,' ',ApellidoMaterno) as NombreCompleto,
                    Rut,
                    Zona
                from TB_Participante
                where Nro not in (select CodParticipante from TB_Registro where CodActividad = '".$actividad."')
                and CodGrupo = '".$grupo->CodGrupo."'
                order by Nro";

        $objPHPExcel->setActiveSheetIndex($hoja)->mergeCells('C1:E1');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Asistentes actividad: '.$modelActividad->Actividad);
        $objPHPExcel->getActiveSheet()->getStyle('C1:E1')->applyFromArray(array(
            'alignment' =>  array(
                'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'wrap'      => TRUE
            ),
        ));


        $objPHPExcel->getActiveSheet()->SetCellValue('A3', 'Tipo Registro');
        $objPHPExcel->getActiveSheet()->SetCellValue('B3', 'Nro');
        $objPHPExcel->getActiveSheet()->SetCellValue('C3', 'Nombre Completo');
        $objPHPExcel->getActiveSheet()->SetCellValue('D3', 'Rut');
        $objPHPExcel->getActiveSheet()->SetCellValue('E3', 'Fecha');
        $objPHPExcel->getActiveSheet()->SetCellValue('F3', 'Mi Grupo');
        $objPHPExcel->getActiveSheet()->SetCellValue('G3', 'Grupo Real');
        $objPHPExcel->getActiveSheet()->getStyle('A3:G3')->applyFromArray(getEstiloTituloColumna());

        $i = 4; //Numero de fila donde se va a comenzar a rellenar

        $model = Yii::$app->db->createCommand($sql);
    
        foreach($model->query() as $fila) {
    
            // Add some data
            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, $fila['TipoRegistro']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, $fila['Nro']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, $fila['NombreCompleto']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D'.$i, $fila['Rut']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i, $fila['Fecha']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i, $fila['MiGrupo']);
            $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i, $fila['RealGrupo']);
    
            $i++;
        }

        $i++;
        $i++;

        $objPHPExcel->setActiveSheetIndex($hoja)->mergeCells('C'.$i.':E'.$i);
        $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, 'Ausentes actividad: '.$modelActividad->Actividad);
        $objPHPExcel->getActiveSheet()->getStyle('C'.$i.':E'.$i)->applyFromArray(array(
            'alignment' =>  array(
                'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'wrap'      => TRUE
            ),
        ));

        $i++;
        $i++;

        $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, 'Nro');
        $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, 'Nombre Completo');
        $objPHPExcel->getActiveSheet()->SetCellValue('D'.$i, 'Rut');
        $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i, 'Zona');
        $objPHPExcel->getActiveSheet()->getStyle('B'.$i.':E'.$i)->applyFromArray(getEstiloTituloColumna());
        $i++;

        $model = Yii::$app->db->createCommand($sql2);
        
        foreach($model->query() as $fila) {
    
            // Add some data
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, $fila['Nro']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, $fila['NombreCompleto']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D'.$i, $fila['Rut']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i, $fila['Zona']);
    
            $i++;
        }

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(TRUE);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(TRUE);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(TRUE);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(TRUE);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(TRUE);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(TRUE);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(TRUE);

        // Rename sheet
        $objPHPExcel->getActiveSheet()->setTitle($grupo->Grupo);
        $hoja++;
        $objPHPExcel->createSheet();
        $objPHPExcel->setActiveSheetIndex($hoja);  //set first sheet as active
    }

    $objPHPExcel->setActiveSheetIndex(0);  //set first sheet as active
    

    // Save Excel 2007 file
    $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
    $fecha = date("Ymd");
    $nombreArchivo = 'informe.xlsx';
    $objWriter->save(str_replace('.php', '.xlsx', __FILE__));
    //rename(Yii::$app->basePath.'/views/site/informe.xlsx',Yii::$app->basePath.'/views/site/'.$nombreArchivo);

    header('Location: /cicletada/views/site/'.$nombreArchivo);

    $this->render("index");
    
    die();

} catch (PDOException $e) {
    print "¡Error PDO!: " . $e->getMessage() . "<br/>";
    die();
} catch (exception $e){
    print "¡Error OTRO!: " . $e->getMessage() . "<br>";
}

function getEstiloTituloColumna(){
    $estiloTituloColumnas = array(
        'font' => array(
            'name'  => 'Arial',
            'bold'  => true,
            'color' => array(
                'rgb' => 'FFFFFF'
            )
        ),
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('argb' => 'FFff471a')
        ),
        'borders' => array(
            'top' => array(
                'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
                'color' => array(
                    'rgb' => '143860'
                )
            ),
            'bottom' => array(
                'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
                'color' => array(
                    'rgb' => '143860'
                )
            )
        ),
        'alignment' =>  array(
            'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            'wrap'      => TRUE
        )
    );
    return $estiloTituloColumnas;
}
?>