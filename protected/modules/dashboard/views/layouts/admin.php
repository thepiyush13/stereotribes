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
                    <a  href="/dashboard/" class="<?php echo $dashboardActive ?>">
                        <i class="icon-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                      <a  href="/dashboard/reporting" class="<?php echo $dashboardActive ?>">
                        <i class="icon-dashboard"></i>
                        <span>reporting</span>
                    </a>
                      <a  href="/dashboard/users" class="<?php echo $dashboardActive ?>">
                        <i class="icon-dashboard"></i>
                        <span>users</span>
                    </a>
                      <a  href="/dashboard/projects" class="<?php echo $dashboardActive ?>">
                        <i class="icon-dashboard"></i>
                        <span>projects</span>
                    </a>
                      <a  href="/dashboard/categories" class="<?php echo $dashboardActive ?>">
                        <i class="icon-dashboard"></i>
                        <span>categories</span>
                    </a>
                      <a  href="/dashboard/financial" class="<?php echo $dashboardActive ?>">
                        <i class="icon-dashboard"></i>
                        <span>financial</span>
                    </a>
                     <a  href="/dashboard/tribes" class="<?php echo $dashboardActive ?>">
                        <i class="icon-dashboard"></i>
                        <span>tribes</span>
                    </a>
                    
                     <a  href="/newsletter/" class="<?php echo $dashboardActive ?>">
                        <i class="icon-dashboard"></i>
                        <span>Newsletter</span>
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
<!--SCRIPTS FOR CHARTS,GRPAHS,DATATABLES-->
<script type="text/javascript" language="javascript" src="http://www.datatables.net/release-datatables/media/js/jquery.dataTables.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="http://cdn.oesmith.co.uk/morris-0.4.1.min.js"></script>