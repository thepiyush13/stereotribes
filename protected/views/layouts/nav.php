<!--NAVIGATION LINKS AND HEADER FOR GLOBAL--> 


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
                        <?php
                        //get the categort data 
                                $sql = 'SELECT * FROM category limit 0,10';
                                $cats = Yii::app()->db->createCommand($sql)->queryAll();
                        //generate category links
                                foreach ($cats as $key => $cat) {  ?>
                        <div class="menucat-wrap col-md-3"><a class="menuplay-categories color-<?php  echo strtolower($cat['name'] )?>" href="<?php echo Yii::app()->createUrl("/category/{$cat['category_id']}");  ?>"><?php  echo $cat['name'] ?></a></div>
                               <?php  } ?>
                        

                        <div class="menucat-wrap col-md-6" id="find-by-location" style="color: black;"><input type="search" style="color: black;" class="menuplay-categories find-by-location typeahead"  placeholder="...OR FIND BY LOCATION" /></div>
<!--                        <div id="the-basics">
  <input class="typeahead" type="text" placeholder="States of USA">
</div>-->
   <?php
//
$dataProvider = new CActiveDataProvider('Project');

            $dataArray = $dataProvider->getData();
            $myarray = array();

            foreach ($dataArray as $value){
                array_push($myarray, CHtml::encode($value->city));
            } 
                    $source = json_encode($myarray);
   
   $js = <<< EOD
  $(document).ready(function() {
          //js code here 
           
           //search box 
           
           $('#main_search').bind("enterKey",function(e){
               var keyword = $(this).val();
               var url  = '/search?keyword='+keyword+'&type=default';
           window.location = url;
           
            });
            $('#main_search').keyup(function(e){
                if(e.keyCode == 13)
                {
                    $(this).trigger("enterKey");
                }
            });
          
           
           //typeahead code 
           var substringMatcher = function(strs) {
  return function findMatches(q, cb) {
    var matches, substringRegex;
 
    // an array that will be populated with substring matches
    matches = [];
 
    // regex used to determine if a string contains the substring `q`
    substrRegex = new RegExp(q, 'i');
 
    // iterate through the pool of strings and for any string that
    // contains the substring `q`, add it to the `matches` array
    $.each(strs, function(i, str) {
      if (substrRegex.test(str)) {
        // the typeahead jQuery plugin expects suggestions to a
        // JavaScript object, refer to typeahead docs for more info
        matches.push({ value: str });
      }
    });
 
    cb(matches);
  };
};
 
var states = $source;
 
$('#find-by-location .typeahead').typeahead({
  hint: true,
  highlight: true,
  minLength: 1
},
{
  name: 'states',
  displayKey: 'value',
  source: substringMatcher(states)
}).bind('typeahead:selected', function (obj, datum) {
console.log(datum);
    window.location.href = '/search?keyword='+datum.value+'&type=location';


});
        });
EOD;
    
Yii::app()->clientScript->registerScript('id', $js);
?>
                        
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
	      <li class="dropdown mobilehide">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-join"></i></a>
                  <div class="dropdown-menu joinblock">
                      <div class="row">
                          <div class="container menublk">
                              
                              <div class="col-md-6">
                                  <img src="/img/join-tribes.png" class="img-responsive" />
                              </div>
                              
                              <div class="col-md-6 joinsocial-block">
                                  <div class="col-md-2 join-icons"><a href="#"><i class="icon-facebook"></i></a></div>
                                  <div class="col-md-2 join-icons"><a href="#"><i class="icon-twitter"></i></a></div>
                                  <div class="col-md-2 join-icons"><a href="#"><i class="icon-instagram"></i></a></div>
                                  <div class="col-md-2 join-icons"><a href="#"><i class="icon-vimeo2"></i></a></div>
                                  <div class="col-md-2 join-icons"><a href="#"><i class="icon-googleplus"></i></a></div>
                                  <div class="col-md-2 join-icons"><a href="#"><i class="icon-youtube-play"></i></a></div>
                              </div>
                              
                          </div>
                      </div>
                  </div>
              </li>
	      <li class="dropdown mobilehide">
                <a a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-search"></i></a>
                <div class="dropdown-menu">
                        <div class="row">
                                <div class="container menublk">
                                        <input type="search" id="main_search" class="form-control menu-search" placeholder="Search...">
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


