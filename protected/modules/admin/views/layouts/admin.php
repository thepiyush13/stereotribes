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
                <li class="sub-menu" class="">
                    <a href="javascript:;" class="<?php echo $feedActive ?>">
                        <i class="icon-cogs"></i>
                        <span>Manage Content</span>
                    </a>
                    <ul class="sub">
                        <!--<li class="<?php echo $feedsValidateActive ?>"><a  href="/admin/feeds/validate">Validate Feeds</a></li>-->
                        <!--<li class="<?php echo $feedsAddfeedurlsActive ?>"><a  href="/admin/feeds/addfeedurls">Add Feed URL</a></li>-->
                         <!--<li class="<?php echo $feedsScheduleActive ?>"><a  href="/admin/feeds/schedule">Schedule Feeds</a></li>-->
                        <!--<li class="<?php echo $feedsAddsourcesActive ?>"><a  href="/admin/feeds/addsources">Add Providers</a></li>-->
                        <li class="<?php echo $feedsProvidersActive ?>"><a  href="/admin/feeds/providers">Providers</a></li>
                        <li class="<?php echo $feedsIndexActive ?>"><a  href="/admin/feeds/">Feeds</a></li>
                        <li class="<?php echo $articlesIndexActive ?>"><a  href="/admin/articles">Articles</a></li>
                        <li class="<?php echo $categoryIndexActive ?>"><a  href="/admin/category">Category</a></li>
                       
                    </ul>
                </li>
		<li class="sub-menu" class="">
                    <a href="javascript:;" class="<?php echo $toolsActive ?>">
                        <i class="icon-cogs"></i>
                        <span>Tools</span>
                    </a>
                    <ul class="sub">
                        <li class="<?php echo $toolsActive ?>"><a  href="/admin/feeds/validate">Validator</a></li>

                    </ul>
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
