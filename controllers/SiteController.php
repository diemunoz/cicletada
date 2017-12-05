<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\FormRegister;
use app\models\User;
use app\models\Users;
use yii\widgets\ActiveForm;
use yii\web\Response;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\swiftmailer\Mailer;
use yii\data\ArrayDataProvider;
use app\models\Participante;
use app\models\ParticipanteCopia;
use app\models\Equipo;
use app\models\EquipoCopia;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
     public function behaviors()
     {
         return [
             'access' => [
                 'class' => AccessControl::className(),
                 'only' => ['logout', 'user', 'admin'],
                 'rules' => [
                     [
                         //El administrador tiene permisos sobre las siguientes acciones
                         'actions' => ['logout', 'admin'],
                         //Esta propiedad establece que tiene permisos
                         'allow' => true,
                         //Usuarios autenticados, el signo ? es para invitados
                         'roles' => ['@'],
                         //Este método nos permite crear un filtro sobre la identidad del usuario
                         //y así establecer si tiene permisos o no
                         'matchCallback' => function ($rule, $action) {
                             //Llamada al método que comprueba si es un administrador
                             return User::isUserAdmin(Yii::$app->user->identity->id);
                         },
                     ],
                     [
                        //Los usuarios simples tienen permisos sobre las siguientes acciones
                        'actions' => ['logout', 'user'],
                        //Esta propiedad establece que tiene permisos
                        'allow' => true,
                        //Usuarios autenticados, el signo ? es para invitados
                        'roles' => ['@'],
                        //Este método nos permite crear un filtro sobre la identidad del usuario
                        //y así establecer si tiene permisos o no
                        'matchCallback' => function ($rule, $action) {
                           //Llamada al método que comprueba si es un usuario simple
                           return User::isUserSimple(Yii::$app->user->identity->id);
                       },
                    ],
                 ],
             ],
      //Controla el modo en que se accede a las acciones, en este ejemplo a la acción logout
      //sólo se puede acceder a través del método post
             'verbs' => [
                 'class' => VerbFilter::className(),
                 'actions' => [
                     //'logout' => ['post'],
                     //'setcampo' => ['post'],
                 ],
             ],
         ];
     }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if(Yii::$app->user->isGuest){
            return $this->redirect(["site/login"]);
        }else{
            return $this->render('index');
        }
        
    }

    /**
     * Login action.
     *
     * @return string
     */
     public function actionLogin()
      {
        if (!\Yii::$app->user->isGuest) {
            if (User::isUserAdmin(Yii::$app->user->identity->id))
            {
                return $this->redirect(["site/index"]);
            }
            else
            {
                return $this->redirect(["site/index"]);
            }
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {

            $user = Users::findOne(Yii::$app->user->identity->id);
            $user->lastlogin = date('Y-m-d g:i:00');
            $user->save();

            if (User::isUserAdmin(Yii::$app->user->identity->id))
            {
                return $this->redirect(["site/index"]);
            }
            else
            {
                return $this->redirect(["site/index"]);
            }
        } else {
            return $this->renderPartial('login', ['model' => $model]);
        }
      }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    private function randKey($str='', $long=0)
    {
        $key = null;
        $str = str_split($str);
        $start = 0;
        $limit = count($str)-1;
        for($x=0; $x<$long; $x++)
        {
            $key .= $str[rand($start, $limit)];
        }
        return $key;
    }

    public function actionConfirm()
    {
        $table = new Users;
        if (Yii::$app->request->get())
        {
            //Obtenemos el valor de los parámetros get
            $id = Html::encode($_GET["id"]);
            $authKey = $_GET["authKey"];

            if ((int) $id)
            {
                //Realizamos la consulta para obtener el registro
                $model = $table
                ->find()
                ->where("id=:id", [":id" => $id])
                ->andWhere("authKey=:authKey", [":authKey" => $authKey]);

                //Si el registro existe
                if ($model->count() == 1)
                {
                    $activar = Users::findOne($id);
                    $activar->activate = 1;
                    if ($activar->update())
                    {
                        echo '<!-- Latest compiled and minified CSS -->
                            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

                            <!-- Optional theme -->
                            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

                            <!-- Latest compiled and minified JavaScript -->
                            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
                            
                            <div class="alert alert-dismissible alert-success">
                                 <button type="button" class="close" data-dismiss="alert">&times;</button>
                                 <strong>Felicidades!</strong>, registro llevado a cabo correctamente. Debe esperar la aprobacion del Administrador, redireccionando ...</a>.
                             </div>';
                        echo "<meta http-equiv='refresh' content='8; ".Url::toRoute("site/login")."'>";

                        $subject = "Confirmar registro Informes Agroid";
                        $body = "<!-- Latest compiled and minified CSS -->
                            <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' integrity='sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u' crossorigin='anonymous'>

                            <!-- Optional theme -->
                            <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css' integrity='sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp' crossorigin='anonymous'>

                            <!-- Latest compiled and minified JavaScript -->
                            <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js' integrity='sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa' crossorigin='anonymous'></script>
                            
                            <div class='panel panel-info'>
                            <div class='panel-heading'>
                                <h3 class='panel-title'>Confirmación de registro</h3>
                            </div>
                            <div class='panel-body'>
                                <h3>El usuario ".$activar->username." se ha registrado correctamente, para confirmar su registro haga click en el siguiente enlace </h3>
                                <a href='http://agroid.cl/InformesAgroid/web/index.php?r=site/confirmadmin&id=".$activar->id."&authKey=".$activar->authKey."'>Confirmar usuario</a>
                            </div>
                            
                                <h3> Si no decea confirmar el registro notifique el motivo desde el siguiente enlace </h3>
                                <a href='mailto:".$activar->email."?subject=Desaprobación%20registro%20informes%20Agroid'>Desaprobar usuario</a>
                            </div>
                            </div>";
                        //$body = "<h3>El usuario ".$activar->username." se ha registrado correctamente, para confirmar su registro haga click en el siguiente enlace </h3>";
                        //$body .= "<a href='http://agroid.cl/InformesAgroid/web/index.php?r=site/confirmadmin&id=".$activar->id."&authKey=".$activar->authKey."'>Confirmar usuario</a>";
                        //$body .= "<h3> Si no decea confirmar el registro notifique el motivo desde el siguiente enlace </h3>";
                        //$body .= "<a href='mailto:".$activar->email."?subject=Desaprobación%20registro%20informes%20Agroid'>Desaprobar usuario</a>";

                        //Enviamos el correo
                        Yii::$app->mailer->compose()
                        ->setTo(Yii::$app->params["adminEmail"])
                        ->setFrom([Yii::$app->params["adminEmail"] => Yii::$app->params["title"]])
                        ->setSubject($subject)
                        ->setHtmlBody($body)
                        ->send();
                    }
                    else
                    {
                        echo '<!-- Latest compiled and minified CSS -->
                                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

                                <!-- Optional theme -->
                                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

                                <!-- Latest compiled and minified JavaScript -->
                                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
                                <div class="alert alert-dismissible alert-danger">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Lo sentimos :(</strong>, Ha ocurrido un error al realizar el registro, redireccionando ...</a>.
                                </div>';
                        echo "<meta http-equiv='refresh' content='8; ".Url::toRoute("site/login")."'>";
                    }
                }
                else //Si no existe redireccionamos a login
                {
                    return $this->redirect(["site/login"]);
                }
            }
            else //Si id no es un número entero redireccionamos a login
            {
                return $this->redirect(["site/login"]);
            }
        }
    }

    public function actionRegister()
    {
        //Creamos la instancia con el model de validación
        $model = new FormRegister;

        //Mostrará un mensaje en la vista cuando el usuario se haya registrado
        $msg = null;

        //Validación mediante ajax
        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax)
        {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        //Validación cuando el formulario es enviado vía post
        //Esto sucede cuando la validación ajax se ha llevado a cabo correctamente
        //También previene por si el usuario tiene desactivado javascript y la
        //validación mediante ajax no puede ser llevada a cabo
        if ($model->load(Yii::$app->request->post()))
        {
            if($model->validate())
            {
                //Preparamos la consulta para guardar el usuario
                $table = new Users;
                $table->username = $model->username;
                $table->email = $model->email;
                //Encriptamos el password
                $table->password = crypt($model->password, Yii::$app->params["salt"]);
                //Creamos una cookie para autenticar al usuario cuando decida recordar la sesión, esta misma
                //clave será utilizada para activar el usuario
                $table->authKey = $this->randKey("abcdef0123456789", 200);
                //Creamos un token de acceso único para el usuario
                $table->accessToken = $this->randKey("abcdef0123456789", 200);

                //Si el registro es guardado correctamente
                if ($table->insert())
                {
                    //Nueva consulta para obtener el id del usuario
                    //Para confirmar al usuario se requiere su id y su authKey
                    $user = $table->find()->where(["email" => $model->email])->one();
                    $id = urlencode($user->id);
                    $authKey = urlencode($user->authKey);

                    $subject = "Confirmar registro";
                    $body = "<!-- Latest compiled and minified CSS -->
                            <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' integrity='sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u' crossorigin='anonymous'>

                            <!-- Optional theme -->
                            <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css' integrity='sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp' crossorigin='anonymous'>

                            <!-- Latest compiled and minified JavaScript -->
                            <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js' integrity='sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa' crossorigin='anonymous'></script>
                            
                            <div class='panel panel-info'>
                            <div class='panel-heading'>
                                <h3 class='panel-title'>Confirmación de registro</h3>
                            </div>
                            <div class='panel-body'>
                                <h3>Haga click en el siguiente enlace para finalizar tu registro</h3>
                                <a href='http://agroid.cl/InformesAgroid/web/index.php?r=site/confirm&id=".$id."&authKey=".$authKey."'>Confirmar</a>
                            </div>
                            </div>";
                    //$body .= "<h3>Haga click en el siguiente enlace para finalizar tu registro</h3>";
                    //$body .= "<a href='http://agroid.cl/InformesAgroid/web/index.php?r=site/confirm&id=".$id."&authKey=".$authKey."'>Confirmar</a>";

                    //Enviamos el correo
                    Yii::$app->mailer->compose()
                    ->setTo($user->email)
                    ->setFrom([Yii::$app->params["adminEmail"] => Yii::$app->params["title"]])
                    ->setSubject($subject)
                    ->setHtmlBody($body)
                    ->send();

                    $model->username = null;
                    $model->email = null;
                    $model->password = null;
                    $model->password_repeat = null;

                    $msg = '<div class="alert alert-dismissible alert-success">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Felicidades!</strong>, ahora sólo falta que confirmes tu registro en tu cuenta de correo</a>.
                    </div>';
                }
                else
                {
                    $msg = '<div class="alert alert-dismissible alert-danger">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Lo sentimos :(</strong>, ha ocurrido un error al llevar a cabo tu registro</a>.
                    </div>';
                }

            }
            else
            {
                $model->getErrors();
            }
        }
        return $this->renderPartial("register", ["model" => $model, "msg" => $msg]);
    }

    public function actionConfirmadmin()
    {
        $table = new Users;
        if (Yii::$app->request->get()){
            //Obtenemos el valor de los parámetros get
            $id = Html::encode($_GET["id"]);
            $authKey = $_GET["authKey"];

            if ((int) $id){
                //Realizamos la consulta para obtener el registro
                $model = $table
                    ->find()
                    ->where("id=:id", [":id" => $id])
                    ->andWhere("authKey=:authKey", [":authKey" => $authKey]);

                //Si el registro existe
                if ($model->count() == 1){
                    $activar = Users::findOne($id);
                    $activar->activateAdmin = 1;
                    if ($activar->update()){
                        echo '<!-- Latest compiled and minified CSS -->
                            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

                            <!-- Optional theme -->
                            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

                            <!-- Latest compiled and minified JavaScript -->
                            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
                            
                            <div class="alert alert-dismissible alert-success">
                                 <button type="button" class="close" data-dismiss="alert">&times;</button>
                                 <strong>Activación del usuario <strong>'.$activar->username.'</strong> llevado a cabo correctamente. Puede cerrar esta pagina</a>.
                             </div>';
                        //echo "<meta http-equiv='refresh' content='8; ".Url::toRoute("site/login")."'>";
                    }else{
                        echo '<!-- Latest compiled and minified CSS -->
                            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

                            <!-- Optional theme -->
                            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

                            <!-- Latest compiled and minified JavaScript -->
                            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
                            <div class="alert alert-dismissible alert-danger">
                                 <button type="button" class="close" data-dismiss="alert">&times;</button>
                                 <strong>Lo sentimos :(</strong>, Ha ocurrido un error al realizar la activación. Por favor realizarla manualmente. Puede cerrar esta pagina</a>.
                             </div>';
                        //echo "<meta http-equiv='refresh' content='8; ".Url::toRoute("site/login")."'>";
                    }
                }else{//Si no existe redireccionamos a login
                    return $this->redirect(["site/login"]);
                }
            }else{//Si id no es un número entero redireccionamos a login
                return $this->redirect(["site/login"]);
            }
        }
    }

    public function actionUser()
    {
        return $this->render("user");
    }

    public function actionAdmin()
    {
        return $this->render("admin");
    }

    public function beforeAction($action)
    {
        if (Yii::$app->user->isGuest && Yii::$app->controller->action->id != 'login') {
            return $this->redirect(\Yii::$app->urlManager->createUrl("site/login"));
        }else{
            //something code right here if user valid
            return true;
        }
    }

    public function actionAsignacion()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(["site/login"]);
        }else{
            return $this->render("asignacion");
        }
    }

    public function LastModified(){
        list($Mili, $bot) = explode(" ", microtime());
        $DM=substr(strval($Mili),2,4);
        return strval(date("Y").date("m").date("d").date("H").date("i").date("s") . $DM);
    }

    public function actionAsigna(){
        if(Yii::$app->request->post()){

            $participantes = Participante::find()->where(['Estado' => 1])->all();

            $equipos = Equipo::find()->where(['Estado' => 1])->all();

            if($_POST['opcion'] == 0){
                foreach ($participantes as $p) {
                    $p->CodGrupo = '00000000-0000-0000-0000-000000000000';
                    $p->LastModified = $this->LastModified();
                    $p->save();
                }
                foreach ($equipos as $e) {
                    $e->CodGrupo = '00000000-0000-0000-0000-000000000000';
                    $e->LastModified = $this->LastModified();
                    $e->save();
                }
            }else{
                foreach ($participantes as $p) {
                    $copia = ParticipanteCopia::find()->where(['Nro' => $p->Nro])->one();
                    $p->CodGrupo = $copia->CodGrupo;
                    $p->LastModified = $this->LastModified();
                    $p->save();
                }
                foreach ($equipos as $e) {
                    $copia = EquipoCopia::find()->where(['ImeiEquipo' => $e->ImeiEquipo])->one();
                    $e->CodGrupo = $copia->CodGrupo;
                    $e->LastModified = $this->LastModified();
                    $e->save();
                }
            } 
            
            return $this->redirect(['site/asignacion']);
        }else{
            return $this->redirect(['site/asignacion']);
        }
    }

    //*************************************************************************
    //*************************************************************************
    //ACTIONS PARA LOS INFORMES
    //*************************************************************************
    //*************************************************************************

    public function actionInforme(){
        if (Yii::$app->user->isGuest) {
            return $this->redirect(["site/login"]);
        }else{
            if (Yii::$app->request->post()){
                $this->layout = false;
                $actividad = $_POST['actividad'];
                return $this->render("informe", ["actividad" => $actividad]);
            }else{
                return $this->render("index");
            }
        }
    }

}
