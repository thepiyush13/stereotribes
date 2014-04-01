<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/admin');
?>


<?php
$currentController = yii::app()->controller->id;
$currentAction = yii::app()->controller->action->id;


$feedActive = $dashboardActive = $toolsActive = '';

$navs = array(
    'dashboard' => array(
        'dashboard' => array('index'),
    ),
    'feed' => array(
        'feeds' => array('index', 'addsources', 'addfeedurls', 'providers', 'schedule', 'validate'),
    ),
    'article' => array(
        'articles' => array('index')
    ),
 
    'category' => array (
        'category' => array('index'),
    )
);

foreach ($navs as $group => $nav) {
    foreach ($nav as $controller => $actions) {
        if ($currentController == $controller) {
            ${$group . 'Active'} = ' active ';
        }
        foreach ($actions as $action) {
            $_action = ucfirst($action);
            if (($action == $currentAction ) && ($controller == $currentController)) {

                ${$currentController . $_action . 'Active'} = 'active';
            } else {
                ${$controller . $_action . 'Active'} = '';
            }
        }
    }
}
?>

<?php if (Yii::app()->user) { ?>

    <!--sidebar start-->
    <aside>
        <div id="sidebar"  class="nav-collapse ">
            <!-- sidebar menu start-->
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a  href="/admin/dashboard/" class="<?php echo $dashboardActive ?>">
                        <i class="icon-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
            </ul>
            <!-- sidebar menu end-->
        </div>
    </aside>
    <!--sidebar end-->

<?php } ?>
<!--main content start-->
<section id="main-content">
    <header class="tab-head">
<?php //$this->widget('application.components.ToolMenu');  ?>
    </header>
    <section class="wrapper tab-container">
        <!-- page start-->
        <div class="tab-content">
            <div class="tab-pane active" id="site">
<?php echo $content; ?>
            </div>
        </div>
        <!-- page end-->
    </section>
</section>
<!--main content end-->



<?php $this->endContent(); ?>
