<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\bootstrap\ActiveForm;
use app\components\Login;


/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!--web-font-->
    <link href='http://fonts.googleapis.com/css?family=Playfair+Display:400,700,900,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300italic,400italic,700italic,400,300,700' rel='stylesheet' type='text/css'>
    
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
    
	<!--navigation-->
	<div class="top-nav">
		<nav class="navbar navbar-default">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
                                

                            
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                    <?php
                                    NavBar::begin([
                                        //'brandLabel' => Yii::t('app', Yii::$app->name),
                                        //'brandUrl' => Yii::$app->homeUrl,
                                        'options' => [
                                            'class' => 'nav navbar-nav navbar-left',
                                        ],
                                    ]);

                                    // everyone can see Home page
                                    $menuItems[] = ['label' => Yii::t('app', 'Home'), 'url' => ['/']];

                                    // display Post admin page to editor+ roles
                                    if (Yii::$app->user->can('editor')) {
                                        $menuItems[] = ['label' => Yii::t('app', 'Posts'), 'url' => ['/post/admin']];
                                    }

                                    // display Users to admin+ roles
                                    if (Yii::$app->user->can('admin')) {
                                        $menuItems[] = ['label' => Yii::t('app', 'Users'), 'url' => ['/user/index']];
                                    }

                                    // display Signup and Login pages to guests of the site
                                    if (Yii::$app->user->isGuest) {
                                        $menuItems[] = ['label' => Yii::t('app', 'Tours'), 'url' => ['/tours']];
                                        $menuItems[] = ['label' => Yii::t('app', 'Gallery'), 'url' => ['/gallery']];
                                        $menuItems[] = ['label' => Yii::t('app', 'Testimonials'), 'url' => ['/testimonials']];
                                        $menuItems[] = ['label' => Yii::t('app', 'Blog'), 'url' => ['/blog']];
                                        $menuItems[] = ['label' => Yii::t('app', 'Contact Us'), 'url' => ['/contact']];
                                    }
                                    // display Logout to all logged in users
                                    else {
                                        
                                    }

                                    echo Nav::widget([
                                        'options' => ['class' => 'navbar-nav navbar-right'],
                                        'items' => $menuItems,
                                    ]);

                                    NavBar::end();
                                    ?>
					<div class="social-icons">
						<ul>
							<li><a href="#"></a></li>
							<li><a href="#" class="fb"></a></li>
							<li><a href="#" class="gg"></a></li>
						</ul>	
					</div>
					<div class="clearfix"> </div>
				</div>
			</div>	
		</nav>		
	</div>	
	<!--navigation-->
    
    	<!--header-->
	<div class="header">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="index.html"><img src="images/logo.png" alt=""></a>
			</div>	
                    
                        <div class="navbar-form navbar-right">
                            <?php
                            if (Yii::$app->user->isGuest) {
                                echo Login::widget();
                            } else {
                                ?>
                                <a href="/logout">Logout</a>
                            <?php }
                            ?>
                        </div>
		</div>	
	</div>
	<!--//header-->
    
        <?php echo $content ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
