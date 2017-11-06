<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\admin\AdminAsset;
use common\widgets\Alert;
use modules\admin\models\Menu;
use common\services\UrlService;
use common\services\StaticService;
    StaticService::includeAppJsStatic( "/statics/admin/js/bootstrap.min.js",AdminAsset::className() );
    StaticService::includeAppJsStatic( "/statics/admin/js/scripts.js",AdminAsset::className() );
AdminAsset::register($this);
$allMenus = Menu::getMenu();
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Yii::$app->params['basic']['sitename'].' - '.Html::encode($this->title) ?></title>
    <?php $this->head() ?>

<body>
<?php $this->beginBody() ?>
<style type="text/css">
    .form-control{width: 30%;}
    div.button-su{padding: 20px 13%;}
</style>
<div class="left-side sticky-left-side">
    <div class="logo">
        <a href="<?php echo Yii::$app->request->hostInfo.'/admin';?>"><img style="width: 80%;" src="<?= UrlService::buildWwwUrl("/statics/admin/images/logo.png"); ?>" alt=""></a>
    </div>

    <div class="left-side-inner">
        <ul class="nav nav-pills nav-stacked custom-nav">
            <?php
            foreach ($allMenus as $menus) {
            ?>
            <li class="menu-list">
                <a href="<?=$menus['url'];?>">
                    <i class="fa <?=$menus['icon_style'];?>"></i>
                    <span><?=$menus['name'];?></span>
                </a>
                <ul class="sub-menu-list">
                    <?php
                    if(!isset($menus['_child'])) break;
                    $menuArr = [];
                    foreach ($menus['_child'] as $menu) {
                        $menuArr = explode('/', $menu['url']);
                        $controller = count($menuArr) > 3 ? $menuArr[2] : '';
                    ?>
                    <li class="<?=Yii::$app->controller->id == $controller ? 'active' : '';?>"><a href="<?=$menu['url']?>"> <?=$menu['name'];?></a></li>
                    <?php }?>
                </ul>
            </li>
            <?php }?>
        </ul>
    </div>
</div>

<div class="main-content" >
    <div class="header-section">
    <?php
        NavBar::begin([
            'brandLabel' => '<i class="fa fa-dedent"></i>',
            'brandOptions' => ['class' => 'toggle-btn'],
            'brandUrl' => '#',
            'renderInnerContainer' => false,
            'options' => [
                'class' => 'navbar navbar-default',
            ],
        ]);

    $menuItems = [];
    if (!\Yii::$app->user->isGuest) {
        $menuItems[] = '<li class="dropdown notification-menu">'
            . '<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="/statics/admin/images/user-avatar.png" alt="" />'
            . Yii::$app->user->identity->username
            . '<span class="caret"></span></a>'
            . '<ul class="dropdown-menu dropdown-menu-usermenu pull-right" role="menu">'
            // . '<li><a href="#"><i class="fa fa-user"></i>  Profile</a></li>'
            . '<li><a href="/admin/admin/update?id='.Yii::$app->user->identity->id.'"><i class="fa fa-cog"></i>  个人中心</a></li>'
            . '<li>'
            . Html::beginForm(['/admin/index/logout'], 'post')
            . Html::submitButton(
                '<i class="fa fa-sign-out"></i> '.Yii::t('backend', '退出'),
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</ul>'
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>
    </div>

    <div class="page-heading">
        <?php echo Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
             ]) 
        ?>
    </div>
    <?= Alert::widget() ?>
    <div class="wrapper">
        <div class="panel">
            <div class="panel-body">
            <?= $content ?>
            </div>
        </div>
    </div>

</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
