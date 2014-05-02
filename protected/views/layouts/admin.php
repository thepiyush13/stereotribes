<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="img/favicon.png">
        
        <title>Stereo Tribes - Admin Panel</title>
        
        <!-- Bootstrap core CSS -->
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/adassets/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/adassets/css/bootstrap-reset.css" rel="stylesheet">
        <!--external css-->
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/adassets/css/font-awesome.min.css" rel="stylesheet" />

        <!-- Custom styles for this template -->
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/adassets/css/style.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/adassets/css/style-responsive.css" rel="stylesheet" />
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/adassets/css/bootstrap-multiselect.css" rel="stylesheet" />
        
        <!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/adassets/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/adassets/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/adassets/css" href="<?php echo Yii::app()->request->baseUrl; ?>/adassets/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/adassets/css/form.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/adassets/css/my.css" />
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/adassets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
          <script src="js/respond.min.js"></script>
        <![endif]-->
    </head>
    
    <body>
        <section id="container" class="">
            <!--header start-->
            <header class="header stereo-bg"> <div class="sidebar-toggle-box">
                    <div data-original-title="Toggle Navigation" data-placement="right" class="icon-reorder tooltips"></div>
                </div>
                <!--logo start-->
                <a href="/admin" class="logo" >STEREOTRIBES</a>
                <!--logo end-->
                <div class="top-nav pull-right">
                    <ul class="nav top-menu pull-left search-menu">
                        <li>
                            <input type="text" class="form-control" placeholder="Search">
                        </li>
                    </ul>
                    <div class="pull-right log"> 
                        <!-- user login dropdown start-->
                        <?php $this->widget('application.components.LoginBar');?>
                        <!-- user login dropdown end -->  
                    </div>                  
                </div>
            </header>
            <!--header end-->
            <script src="<?php echo Yii::app()->request->baseUrl; ?>/adassets/js/jquery.js"></script>
            <script src="<?php echo Yii::app()->request->baseUrl; ?>/adassets/js/jquery.dcjqaccordion.2.7.js"></script>
            
            
            <?php echo $content ?>
        </section>  
            
         
        <!-- js placed at the end of the document so the pages load faster -->
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/adassets/js/bootstrap.min.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/adassets/js/bootstrap-datetime.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/adassets/js/bootstrap-datepicker.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/adassets/js/bootstrap-timepicker.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/adassets/js/bootstrap-multiselect.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/adassets/js/common-scripts.js"></script>
        <!--<script src="<?php echo Yii::app()->request->baseUrl; ?>/adassets/js/jquery.tagsinput.js"></script>-->
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/adassets/js/scheduler.js"></script>
<!--        
        <script src="/adassets/js/jquery-1.8.3.min.js"></script>
        
        <script class="include" type="text/javascript" src="/adassets/js/jquery.dcjqaccordion.2.7.js"></script>
        <script src="/adassets/js/jquery.scrollTo.min.js"></script>
        <script src="/adassets/js/jquery.nicescroll.js" type="text/javascript"></script>
        <script src="/adassets/js/respond.min.js" ></script>
        <script type="text/javascript" src="/swassets/bootstrap-fileupload/bootstrap-fileupload.js"></script>
        <script src="/adassets/js/jquery.isotope.js"></script>
        <script src="/adassets/js/bootbox.js"></script>
        <script src="/adassets/js/common-scripts.js"></script>
        
       
 packages       
        <script type="text/javascript" src="/adassets/js/jquery.form.js" > </script>
        <script type="text/javascript" src="/adassets/js/jquery.form.fields.js" > </script>
        <script type="text/javascript" src="/adassets/js/jquery.sortable.js" > </script>
         <script type="text/javascript" src="/adassets/js/jquery.dataTables.js" > </script>
         <script src="/adassets/js/MyJs.js"></script>
         <link href="/adassets/css/crm/table.css" rel="stylesheet" />-->
<!--        -->
        
    </body>
</html>
