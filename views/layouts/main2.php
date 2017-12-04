<?php

/* @var $this \yii\web\View */
/* @var $content string */

use macgyer\yii2materializecss\lib\Html;
use macgyer\yii2materializecss\widgets\navigation\Nav;
use macgyer\yii2materializecss\widgets\navigation\SideNav;
use macgyer\yii2materializecss\widgets\navigation\NavBar;
use macgyer\yii2materializecss\widgets\navigation\Breadcrumbs;
use macgyer\yii2materializecss\widgets\Alert;

\macgyer\yii2materializecss\assets\MaterializeAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">

    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>

        <style>
            body {
                display: flex;
                min-height: 100vh;
                flex-direction: column;
            }

            main {
                flex: 1 0 auto;
            }
            nav {
                height: 45px;
                line-height: 45px;
            }
        </style>
        
    </head>

    <body>
    <?php $this->beginBody() ?>

        <header class="page-header">
            <?php
            /*NavBar::begin([
                'brandLabel' => 'Cicletada 2017',
                'brandUrl' => Yii::$app->homeUrl,
                'fixed' => true,
                'wrapperOptions' => [
                    'class' => 'indigo'
                ],
            ]);

            $menuItems = [
                ['label' => 'Home', 'url' => ['/site/index']],
                ['label' => 'About', 'url' => ['/site/about']],
                ['label' => 'Contact', 'url' => ['/site/contact']],
            ];
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
                $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
            } else {
                $menuItems[] = '<li>'
                    . Html::beginForm(['/site/logout'], 'post')
                    . Html::submitButton(
                        'Logout (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'btn btn-flat indigo lighten-1']
                    )
                    . Html::endForm()
                    . '</li>';
            }
            
            echo Nav::widget([
                'options' => ['class' => 'top-nav right indigo lighten-1'],
                'items' => $menuItems,
            ]);

            NavBar::end();*/
            ?>
            <nav class="light-blue lighten-1" role="navigation">
                <div class="nav-wrapper container"><a id="logo-container" href="<?= Yii::$app->homeUrl ?>" class="brand-logo"><img src="images/horti.png" style="display:inline; vertical-align: top; height:64px;">VII Cicletada</a>
                <ul class="right hide-on-med-and-down">
                    <li><a href="<?php echo Yii::$app->homeUrl; ?>?r=participante/index">Participante</a></li>
                    <li><a href="<?php echo Yii::$app->homeUrl; ?>?r=grupo/index">Grupo</a></li>
                    <li><a href="<?php echo Yii::$app->homeUrl; ?>?r=actividad/index">Actividad</a></li>
                    <?= Yii::$app->user->isGuest ? (
                        '<li><a href="<?php echo Yii::$app->homeUrl; ?>?r=site/login">Contacto</a></li>'
                    ) : (
                        '<li>'
                        . Html::beginForm(['/site/logout'], 'post')
                        . Html::submitButton(
                            'Logout (' . Yii::$app->user->identity->username . ')',
                            ['class' => 'btn btn-flat logout']
                        )
                        . Html::endForm()
                        . '</li>'
                    ) ?>
                </ul>
            
                <ul id="nav-mobile" class="side-nav" style="transform: translateX(-100%);">
                <li><a href="<?php echo Yii::$app->homeUrl; ?>?r=participante/index">Participante</a></li>
                    <li><a href="<?php echo Yii::$app->homeUrl; ?>?r=grupo/index">Grupo</a></li>
                    <li><a href="<?php echo Yii::$app->homeUrl; ?>?r=actividad/index">Actividad</a></li>
                    <?= Yii::$app->user->isGuest ? (
                        '<li><a href="<?php echo Yii::$app->homeUrl; ?>?r=site/login">Contacto</a></li>'
                    ) : (
                        '<li>'
                        . Html::beginForm(['/site/logout'], 'post')
                        . Html::submitButton(
                            'Logout (' . Yii::$app->user->identity->username . ')',
                            ['class' => 'btn btn-flat logout']
                        )
                        . Html::endForm()
                        . '</li>'
                    ) ?>
                </ul>
                <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
                </div>
            </nav>
        </header>

        <main class="content">
            <div class="container">
                <?php /* Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) */?>

                <?= Alert::widget() ?>

                <?= $content ?>
            </div>
        </main>

        <footer class="footer page-footer orange">
            <div class="container">
                <div class="row">
                    <div class="col l6 s12">
                        <h5 class="white-text">Footer Content</h5>
                        <p class="grey-text text-lighten-4">You can use rows and columns here to organize your footer content.</p>
                    </div>
                </div>
            </div>
            <div class="footer-copyright">
                <div class="container orange-text text-lighten-3">
                    &copy; Hortifrut <?= date('Y') ?> Desarrollado por <a href="http://www.agroid.cl"> Agroid</a>
                </div>
            </div>
        </footer>
          <!--  Scripts-->
        <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="js/materialize.js"></script>
        <script src="js/init.js"></script>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>
