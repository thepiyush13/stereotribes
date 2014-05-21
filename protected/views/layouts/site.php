<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE9" /> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="format-detection" content="telephone=no">
        <meta name="description" content="Stereo Tribes Case Study">
        <meta name="author" content="">
        <link rel="shortcut icon" href="favicon.ico">

        <title>Stereo Tribes - Home - </title>

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="/css/bootstrap.css">

        <!-- Custom CSS for this Template -->
        <link rel="stylesheet" href="/css/animate.css">

        <link type="text/css" rel="stylesheet" href="/css/jquery-te-1.4.0.css">

        <!-- Custom CSS for this Template -->
         <link rel="stylesheet" href="/css/category.css">
        <link rel="stylesheet" href="/css/stereotribes.css">
       
        

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
          <script src="js/respond.min.js"></script>
        <![endif]-->

    </head>

    <body class="playpage">

        <!-- ==================== Main Navigation ====================== -->

        <?php  $this->renderPartial('//layouts/nav') ; ?> 
        
        <script src="/js/jquery.min.js"></script>
        <script src="/js/campaign.js"></script>
        <?php echo $content ?>



        <!-- Bootstrap core JavaScript
      ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/typeahead.bundle.js"></script>
        <script src="/js/holder.js"></script>
        <script type="text/javascript" src="/js/date.js"></script>
        <script type="text/javascript" src="/js/jquery.datePicker.js"></script>
        <script type="text/javascript" src="/js/jquery-te-1.4.0.min.js" charset="utf-8"></script>
        <script src="/js/stereopage.js"></script>
        <script src="/js/campaign.js"></script>

        <script src="/js/angular/angular.js"></script>
        <script src="/js/app/app.js"></script>
        <script src="/js/app/controllers.js"></script>
        <script src="/js/app/controllers/step4.js"></script>
        <script src="/js/app/controllers/step5.js"></script>
<!--<script src="/js/freewall.js"></script>-->
        <script src="/js/app/models.js"></script>
        <script src="/js/app/services.js"></script>
        <script src="/js/campaign.js"></script>
        <script src="/js/app/directives.js"></script>
         <script src="/js/jquery.validity.min.js"></script>
        <!--<script src="/js/init.js"></script>-->
        <script type="text/javascript">
        $.validity.setup({ outputMode:"label" });
        </script>
        <style type="text/css">
            label.error {
                color: red;
                font-weight: normal;
            }
        </style>
    </body>
</html>