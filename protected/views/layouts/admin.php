<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="img/favicon.png">
        
        <title>ReadFiend- An Online Article Stack</title>
        
        <!-- Bootstrap core CSS -->
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-reset.css" rel="stylesheet">
        <!--external css-->
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/font-awesome.min.css" rel="stylesheet" />

        <!-- Custom styles for this template -->
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/style-responsive.css" rel="stylesheet" />
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-multiselect.css" rel="stylesheet" />
        
        <!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/my.css" />
	<link href="/swassets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
          <script src="js/respond.min.js"></script>
        <![endif]-->
    </head>
    
    <body>
        <section id="container" class="">
            <!--header start-->
            <header class="header white-bg"> <div class="sidebar-toggle-box">
                    <div data-original-title="Toggle Navigation" data-placement="right" class="icon-reorder tooltips"></div>
                </div>
                <!--logo start-->
                <a href="/admin" class="logo" >READFIEND</a>
                <!--logo end-->
                <div class="top-nav ">
                    <ul class="nav pull-right top-menu">
                        <li>
                            <input type="text" class="form-control search" placeholder="Search">
                        </li>
                        
                        <!-- user login dropdown start-->
                        <?php $this->widget('application.components.LoginBar');?>
                        <!-- user login dropdown end -->
                    </ul>
                </div>
            </header>
            <!--header end-->
            <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.js"></script>
            <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.dcjqaccordion.2.7.js"></script>
            
            
            <?php echo $content ?>
        </section>  
            
         
        <!-- js placed at the end of the document so the pages load faster -->
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.min.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-datetime.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-datepicker.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-timepicker.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-multiselect.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/common-scripts.js"></script>
        <!--<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.tagsinput.js"></script>-->
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/scheduler.js"></script>
<!--        
        <script src="/js/jquery-1.8.3.min.js"></script>
        
        <script class="include" type="text/javascript" src="/js/jquery.dcjqaccordion.2.7.js"></script>
        <script src="/js/jquery.scrollTo.min.js"></script>
        <script src="/js/jquery.nicescroll.js" type="text/javascript"></script>
        <script src="/js/respond.min.js" ></script>
        <script type="text/javascript" src="/swassets/bootstrap-fileupload/bootstrap-fileupload.js"></script>
        <script src="/js/jquery.isotope.js"></script>
        <script src="/js/bootbox.js"></script>
        <script src="/js/common-scripts.js"></script>
        
       
 packages       
        <script type="text/javascript" src="/js/jquery.form.js" > </script>
        <script type="text/javascript" src="/js/jquery.form.fields.js" > </script>
        <script type="text/javascript" src="/js/jquery.sortable.js" > </script>
         <script type="text/javascript" src="/js/jquery.dataTables.js" > </script>
         <script src="/js/MyJs.js"></script>
         <link href="/css/crm/table.css" rel="stylesheet" />-->
<!--        -->
        
    </body>
</html>
