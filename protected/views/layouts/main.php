<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE9" /> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="description" content="Stereotribes Case Study">
    <meta name="author" content="">
    <link rel="shortcut icon" href="favicon.ico">

    <title>Stereo Tribes - Home</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="/css/bootstrap.css">

    <!-- Custom CSS for this Template -->
    <link rel="stylesheet" href="/css/animate.css">

    <link rel="stylesheet" href="/css/owl.carousel.css">
    <link rel="stylesheet" href="/css/owl.theme.css">

    <!-- Custom CSS for this Template -->
    <link rel="stylesheet" href="/css/stereotribes.css">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="/js/html5shiv.js"></script>
      <script src="/js/respond.min.js"></script>
    <![endif]-->

    <!--[if lt IE 9]>
		<script>
		document.createElement('video');
		</script>
	<![endif]-->

  </head>

  <body class="home">
	
  	<!-- ==================== Main Navigation ====================== -->

  	<?php  $this->renderPartial('//layouts/nav') ; ?> 


<!--	 ==================== Video Section ====================== 

	
    <video id="bgvid" autoplay loop preload="none" poster="/img/video-poster.jpg" data-setup="{}">
	  <source src="/videos/st.webm" type="video/webm">
	  <source src="/videos/st.mp4" type="video/mp4">
      <source src="/videos/st.ogv" type="video/ogg">
      <source src="/videos/st.ogg" type="video/ogg">
      <source src="/videos/st.mov" type="video/mov">
	</video>
	<div class="video-poster"></div>

	<div class="main-wrapper">

		 ==================== Secondary Navigation ====================== 

	    <nav id="secondary-nav" class="secondary-nav" role="navigation">

	    	<div class="container">

	    		<div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1 text-center secnav">

				    <ul id="sec-navigation" class="navigate">
					    <li id="all" class="active" data-filter=".all">All</li>
					    <li id="new" data-filter=".new">New</li>
					    <li id="featured" class="mobhide" data-filter=".featured">Featured</li>
					    <li id="popular" data-filter=".popular">Popular</li>
					    <li id="endingSoon" data-filter=".endingSoon">Ending Soon</li>
					    <li id="staffPicks" class="mobhide" data-filter=".staffPicks">Staff Picks</li>
				    </ul>

				</div>   

			</div>-->

		<!--</nav>-->
            
                     
            <?php echo $content ?>
         
            
         
       <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/jquery.validity.min.js"></script>
    <script src="/js/video.js"></script>
    <script src="/js/waypoints.min.js"></script>
    <script src="/js/waypoints-sticky.min.js"></script>
    <script src="/js/freewall.js"></script>
    <script src="/js/skrollr.js"></script>
    <script src="/js/custom/utils.js"></script>
    <script src="/js/init.js"></script>
    <script src="/js/stereotribes.js"></script>
    <script src="/js/owl.carousel.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
          $("#owl-demo").owlCarousel({
              navigation : false,
              slideSpeed : 300,
              paginationSpeed : 400,
              singleItem : true,
              items : 1,
              autoPlay: true
          });
        });
    </script>

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