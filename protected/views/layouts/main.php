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

  	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
	  <!-- Brand and toggle get grouped for better mobile display -->
	  <div class="navbar-header">

	    <a class="navbar-brand stereologo" href="/">Stereotribes</a>

	    <a class="navbar-brand stereologo-mob" href="/">Stereotribes</a>		  

	    <ul class="nav navbar-nav navbar-left nav-center">

	      <li class="dropdown">
	      	<a href="/campaign/create/">
		      	<span class="play">Play</span>
		      	<span class="belowtext">Create Campaigns</span>
	      	</a>
	      </li>

	      <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span class="find">Find</span>
                <span class="belowtext">Music Campaigns</span>
            </a>
            <div class="dropdown-menu">
                <div class="row">
                    <div class="container menublk">                         
                        <div class="menucat-wrap col-md-12"><span class="menuplay-categories musicplusfont">Music+</span></div>
                        <div class="menucat-wrap col-md-3"><a class="menuplay-categories color-arts" href="#">Arts</a></div>
                        <div class="menucat-wrap col-md-3"><a class="menuplay-categories color-technology" href="#">Technology</a></div>
                        <div class="menucat-wrap col-md-3"><a class="menuplay-categories color-research" href="#">Research</a></div>
                        <div class="menucat-wrap col-md-3"><a class="menuplay-categories color-commercial" href="#">Commercial</a></div>
                        <div class="menucat-wrap col-md-3"><a class="menuplay-categories color-imaginative" href="#">Imaginative</a></div>
                        <div class="menucat-wrap col-md-3"><a class="menuplay-categories color-performance" href="#">Performance</a></div>
                        <div class="menucat-wrap col-md-3"><a class="menuplay-categories color-film" href="#">Film</a></div>
                        <div class="menucat-wrap col-md-3"><a class="menuplay-categories color-games" href="#">Games</a></div>
                        <div class="menucat-wrap col-md-3"><a class="menuplay-categories color-publishing" href="#">Publishing</a></div>
                        <div class="menucat-wrap col-md-3"><a class="menuplay-categories color-production" href="#">Production</a></div>
                        <div class="menucat-wrap col-md-3"><a class="menuplay-categories color-community" href="#">Community</a></div>
                        <div class="menucat-wrap col-md-3"><a class="menuplay-categories color-education" href="#">Education</a></div>
                        <div class="menucat-wrap col-md-3"><a class="menuplay-categories color-therapy" href="#">Therapy</a></div>
                        <div class="menucat-wrap col-md-3"><a class="menuplay-categories color-fashion" href="#">Fashion</a></div>
                        <div class="menucat-wrap col-md-6"><input type="search" class="menuplay-categories find-by-location" placeholder="...OR FIND BY LOCATION" /></div>
                    </div>
                </div>
            </div>
          </li>

	      <li class="dropdown">
	      	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span class="love">Love</span>
                <span class="belowtext">Tribal World</span>
	      	</a>
	      	<ul class="dropdown-menu">
	          <li><a href="#">Tribes</a></li>
	          <li><a href="#">Another action</a></li>
	          <li><a href="#">Something else here</a></li>
	        </ul>
	      </li>
              <?php if(Yii::app()->user->isGuest) { ?>

              <li>
                  <a href="/login" class="love">Login</a>
              </li>
              <?php } else { ?>
              <li>
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                          <span class="belowtext"><?php echo Yii::app()->user->name; ?></span>
                  </a>
                  <ul class="dropdown-menu">
                    <li>
                        <a href="/Appuser/profile">Profile</a>
                    </li>
                    <li>
                        <a href="/Appuser/changePassword">Reset Password</a>
                    </li>
                    <li>
                        <a href="/login/logout">Logout</a>
                    </li>
	    </ul>
              </li>
              <?php } ?>
	    </ul>

	    <ul class="nav navbar-nav navbar-right">
	      <li class="mobilehide"><a href="#"><i class="icon-join"></i></a></li>
	      <li class="dropdown mobilehide">
                <a a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-search"></i></a>
                <div class="dropdown-menu">
                        <div class="row">
                                <div class="container menublk">
                                        <input type="search" class="form-control menu-search" placeholder="Search...">
                                </div>
                        </div>
                </div>
            </li>
	      <li class="mobilehide"><a href="/profile"><i class="icon-user"></i></a></li>
	      <li class="dropdown usericon">
	        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-list"></i></a>
	        <div class="dropdown-menu menuanimate">
	        <div class="row">
	        <div class="container menublk">
	          	
                        <div class="menublock signin-block col-sm-4 col-md-3">
                                <ul>
                                        <li>
                                                <a href="#"><i class="icon-search"></i> Search</a>
                                        </li>
                                        <li>
                                                <a href="/profile"><i class="icon-user"></i> sign in</a>
                                        </li>
                                </ul>
                        </div>

                        <div class="menublock col-sm-4 col-md-3">
                                <ul>
                                        <li>
                                                <span class="menuh">Play</span>
                                                <a href="/campaign/create/">Create Campaigns</a>
                                        </li>
                                        <li>
                                                <span class="menuh">Find</span>
                                                <a href="#">Music Campaigns</a>
                                        </li>
                                        <li>
                                                <span class="menuh">Love</span>
                                                <a href="#">Tribe World</a>
                                        </li>
                                </ul>
                        </div>

                        <div class="menublock col-sm-4 col-md-2">
                                        <ul>
                                        <li>
                                                <h4 class="menuheading">Getting Started</h4>
                                        </li>
                                        <li>
                                                <a href="#">Pricing</a>	          					
                                        </li>
                                        <li>
                                                <a href="#">Non-Profits</a>
                                        </li>
                                        <li>
                                                <a href="#">FAQ</a>
                                        </li>
                                        <li>
                                                <a href="#">Tribe Play Quiz</a>
                                        </li>
                                </ul>
                        </div>

                        <div class="menublock col-sm-4 col-md-2">
                                <ul>
                                        <li>
                                                <h4 class="menuheading">Passion Amplifier</h4>
                                        </li>
                                        <li>
                                                <a href="#">Benefits of Stereotribes</a>
                                        </li>
                                        <li>
                                                <a href="#">Stereotribes Press</a>
                                        </li>
                                </ul>
                        </div>

                        <div class="menublock col-sm-4 col-md-2">
                                        <ul>
                                        <li>
                                                <h4 class="menuheading">Explore</h4>
                                        </li>
                                        <li>
                                                <a href="#">Backstage Access</a>
                                        </li>
                                        <li>
                                                <a href="#">Staff Mixed Tape</a>
                                        </li>
                                        <li>
                                                <a href="#">Careers</a>
                                        </li>
                                </ul>
                        </div>

                        <div class="menublocklast col-sm-4 col-md-2">
                                        <ul>
                                        <li>
                                                <h4 class="menuheading">Connect</h4>
                                        </li>
                                        <li>
                                                <a href="#">Contact Us</a>
                                        </li>
                                        <li>
                                                <ul class="socialmenu">
                                                        <li><a href="#" class="icon-soundcloud"></a></li>
                                                        <li><a href="#" class="icon-youtube"></a></li>
                                                        <li><a href="#" class="icon-facebook3"></a></li>
                                                        <li><a href="#" class="icon-twitter3"></a></li>
                                                </ul>
                                        </li>
                                </ul>
                        </div>
	          	</div>
	          </div>
	        </div>
	      </li>
	    </ul>
	  </div>
	</nav>


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
   
    <script src="/js/custom/utils.js"></script>
    <script src="/js/init.js"></script>
     <script src="/js/stereotribes.js"></script>

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