<!DOCTYPE html>  
<html lang="en"> 
    <head><script type="text/javascript">var NREUMQ=NREUMQ||[];NREUMQ.push(["mark","firstbyte",new Date().getTime()]);</script>
        <script type="text/javascript" src="../../../c761485.ssl.cf2.rackcdn.com/gascript.js"></script>


        <title>AppTestLab</title>
        <link rel="Shortcut Icon" type="image/x-icon" href="../../images/harvest_favicon.png^1332173798" />
        <link rel="author" href="../../../humans.txt" />
        <link href="https://www.getharvest.com/features/time-tracking" rel="canonical" />    <meta name="csrf-param" content="authenticity_token"/>
        <meta name="csrf-token" content="cjZwvQtl3sUl9M3U1BrN&#47;p&#47;+Up&#47;Y5FdRuYqbxOJM+ww="/>
        <link href="<?php echo Yii::app()->baseUrl; ?>/css/application.css" media="all" rel="stylesheet" type="text/css" />
        <!--[if lte IE 8]>
          <style type="text/css">
            @font-face {
              font-family: "ff-dagny-web-pro-light";
              src: url("/fonts/DagnyWebPro-Xlight.eot");
              font-style: normal;
              font-weight: 200;
            }
          </style>
        <![endif]-->
        <meta name="description" content="Simple time tracking available anywhere - online, desktop widget or iPhone and Android. Team timesheets and timesheet approval. Get started for free." /> 

        <!--[if IE]>
          <script type="text/javascript">
    //<![CDATA[
    
          (function(){
            var html5elmeents = "address|article|aside|audio|canvas|command|datalist|details|dialog|figure|figcaption|footer|header|hgroup|keygen|mark|meter|menu|nav|progress|ruby|section|time|video".split('|');
            for(var i = 0; i < html5elmeents.length; i++){
              document.createElement(html5elmeents[i]);
            }
    
          })();
    
    //]]>
    </script>
        <![endif]-->
        <script src="http://code.jquery.com/jquery-latest.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $(".various3").fancybox({
                    'width'    : '57%',
                    'height'   : '80%',
                    'autoScale'   : false,
                    'transitionIn'  : 'none',
                    'transitionOut'  : 'none',
                    'type'    : 'iframe'
                });
        $(".various4").fancybox({
            'width'    : '60%',
            'height'   : '100%',
            'autoScale'   : false,
            'transitionIn'  : 'none',
            'transitionOut'  : 'none',
            'type'    : 'iframe'
        });
            });
        </script>
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl . '/fancybox/jquery.mousewheel-3.0.4.pack.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl . '/fancybox/jquery.fancybox-1.3.4.pack.js'; ?>"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl . '/fancybox/jquery.fancybox-1.3.4.css'; ?>" media="screen" />

    </head>
    <!--[if lte IE 7]>
      <body class="old-ie">
    <![endif]-->
    <!--[if (gt IE 7)|!(IE)]><!-->
    <body>
        <!--<![endif]-->
        <!--[if IE 7]>
    <div id="ie6">
      <div class="wrapper">
        <span>&nbsp;</span>
        Internet Explorer 7 is no longer supported! Please upgrade your web browser now.
        <a href="https://www.getharvest.com/browser-upgrade" rel="nofollow">Learn More</a>  </div>
    </div>
    <![endif]-->
        <!--[if lte IE 6]>
        <div id="ie6">
          <div class="wrapper">
            <span>&nbsp;</span>
            Internet Explorer 6 is no longer supported! Please upgrade your web browser now.
            <a href="https://www.getharvest.com/browser-upgrade" rel="nofollow">Learn More</a>  </div>
        </div>
        <![endif]-->
        <style>#notify{margin:0px auto;font-size:13px;width:100%;text-shadow:0 1px 0 rgba(255,255,255,0.4)}#notify_error{margin:15px 0 5px;border:1px solid #a34625;background-color:#f9d9ce;padding:8px 4px 4px;height:20px;-moz-border-radius:5px;-webkit-border-radius:5px;border-radius:5px}#notify_success{margin:15px 0 5px;border:1px solid #25a336;background-color:#dfffe3;padding:8px 4px 4px;height:20px;-moz-border-radius:5px;-webkit-border-radius:5px;border-radius:5px;}#notify_message{margin:15px 0 5px;border:1px solid #284797;background-color:#cedaf9;padding:8px 4px 4px;height:20px;-moz-border-radius:5px;-webkit-border-radius:5px;border-radius:5px}.flash_icon_container{margin-left: 150px; margin-right: 30px;float:left;width:20px;text-align:right;padding-right:8px;height:20px;position:relative;top:-3px}.flash_messages_container{margin-left: 200px; font-family:'Helvetica Neue', 'Myriad Pro', Calibri, 'trebuchet ms', Tahoma, Arial, Verdana, sans-serif;color:#333}.notify_message{width:400px;height:40px;background-color:#A6D6FF}</style>
        <div id="main_container">
            <div class="wrapper">
                <div id="content_column" class="prepend-4">
                    <?php if (Yii::app()->user->hasFlash('success')) { ?>
                        <div id="notify">
                            <div id="notify_success" style="opacity: 1; ">
                                                       <div class="flash_icon_container">
                                                           <img src="<?php echo Yii::app()->baseUrl ?>/images/icon-success.png" onload="$('#notify_success').animate({opacity: 1.0}, 3000).fadeOut(500)" />
                                                       </div>
                                                       <div class="flash_messages_container"><?php echo Yii::app()->user->getFlash('success'); ?></div><br class="clear">
                                                   </div>
                            </div>                
                        <?php } else if (Yii::app()->user->hasFlash('error')) {
                            ?>
                            <div id="notify">
                                <div id="notify_error" style="opacity: 1; ">
                                <div class="flash_icon_container">
                                    <img src="<?php echo Yii::app()->baseUrl ?>/images/icon-error.png" onload="$('#notify_error').animate({opacity: 1.0}, 3000).fadeOut(500)" />
                                </div>
                                <div class="flash_messages_container"><?php echo Yii::app()->user->getFlash('error'); ?></div><br class="clear">
                            </div>
                        </div> 
                    <?php } ?>
                    <?php echo $content; ?>

                    <!--
                    <h1>Time Tracking Made Easy</h1>
                    <img alt="Time Tracking" class="top_featured_image" height="348" src="../../images/features/time-tracking.jpg^1332173798" title="Time Tracking" width="710" />
                    <div class="feature_item top_featured">
                      <p>
                        Time tracking is simple and lightning fast with Harvest. Set up takes seconds, and there's nothing to install. We've simplified the timesheet and timesheets approval process so you can stay focused on work.
                      </p>
                      <ul class="checklist">
                        <li><strong>Simple to use</strong> &ndash; One click time tracking. It's never been this easy.</li>
                        <li><strong>Simple to access</strong> &ndash; Track time anywhere. From your web browser, mobile phone or desktop.</li>
                        <li><strong>Simple to deploy</strong> &ndash; No installation or lengthy manual to read.</li>
                      </ul>  
                      <a href="https://www.getharvest.com/signup" class="button features-signup" onclick="_gaq.push(['_trackEvent', 'Feature Get Started Click', 'Time Tracking']);">Get Started Now</a>
                    </div>
                    
                    <div class="feature_item testimonials">
                      <p class="quote">
                        <span class="left_quote">“</span>
                        After a long search for a simple but robust time tracking tool that provides a usable interface, ease of implementation and meaningful output of info, we're very pleased to have Harvest be a component of our business tool strategy.
                        <span class="right_quote">”</span>
                      </p>
                      <p class="credit">– Dave Rosen <span>of Big Spaceship</span></p>
                    </div>
                    
                    <div class="feature_item">
                      <div class="span-7">
                        <h3>One-click Time Entry</h3>
                        <p>Start and stop timers throughout the day with the click of a button, or quickly
                          type in your time on the weekly timesheet.
                        </p>
                      </div>
                      <div class="span-5 last">
                        <img alt="Time Tracking Timer" height="116" src="../../images/features/time-tracker.jpg^1332173798" title="Time Tracking Timer" width="280" />
                      </div>
                    </div>
                    
                    <div class="feature_item">
                      <div class="span-7">
                        <h3>Access Anywhere</h3>
                        <p>Track time anytime, anywhere &ndash; on a PC, Mac, mobile device, or desktop widget. You can even track time via Twitter, Gmail, and other popular applications such as Zendesk. 
                        
                        </p>
                      </div>
                      <div class="span-5 last">
                        <img alt="Time Tracking Devices" height="131" src="../../images/features/mobile-twitter-mac-pc-time-tracking.jpg^1332173798" title="Time Tracking Devices" width="280" />
                      </div>
                    </div>
                    
                    <div class="feature_item">
                      <div class="span-7">
                        <h3>Perfect For Teams</h3>
                        <p>
                          Manage your staff's time and approve their timesheets within Harvest. 
                          Set Harvest to <em>automatically remind your employees</em> to submit their timesheets. 
                          You can even adjust staff permissions and roles to meet the needs of your team.</p>
                      </div>
                      <div class="span-5 last">
                        <img alt="Employee Time Tracking" height="141" src="../../images/features/employee-time-tracking.jpg^1332173798" title="Employee Time Tracking" width="280" />
                      </div>
                    </div>
                    
                    <div class="feature_item">
                      <div class="span-7">
                        <h3>Desktop Time Entry <span class="feature-new">NEW!</span></h3>
                        <p>
                          Enter your time straight from your desktop with <a href="https://www.getharvest.com/mac">Harvest for Mac</a> or the <a href="https://www.getharvest.com/widget">Harvest widget</a> for Windows 7/Vista. Simply download, sign-in, and track time effortlessly.
                        </p>
                      </div>
                      <div class="span-5 last">
                        <img alt="Time Tracking Mac App" height="135" src="../../images/features/time-tracking-app.jpg^1332173798" title="Time Tracking Mac App" width="280" />
                      </div>
                    </div>
                    
                    <div class="feature_item">
                      <div class="span-7">
                        <h3>Powerful Reporting</h3>
                        <p>
                          See how your business is distributing its time across your projects, tasks and employees. Turn on filters to highlight just billable, non-billable, employee or contractor hours. <em>Export your reports</em> to CSV, Excel, Google Spreadsheets and more.</p>
                      </div>
                      <div class="span-5 last">
                        <img alt="Time Reporting" height="127" src="../../images/features/time-reporting.jpg^1332173798" title="Time Reporting" width="280" />
                      </div>
                    </div>
                    
                    <div class="feature_item">
                      <div class="span-7">
                        <h3>Seamless Invoice Integration</h3>
                        <p>
                          Create an invoice that automatically pulls in project hours and expenses. 
                          Harvest retrieves and organizes all your billable hours, so 
                          <em>billing is easy, accurate, and fast.</em></p>
                      </div>
                      <div class="span-5 last">
                        <img alt="Invoice Integration" height="139" src="../../images/features/invoice-integration.jpg^1332173798" title="Invoice Integration" width="278" />
                      </div>
                      
                    </div> -->       </div>
                <div id="side_nav_column">
                    <ul id="side_nav">
                        <li <?php if (Yii::app()->controller->action->id == 'index') { ?> class=" nav-selected" <?php } ?> id="footer_nav_simple-time-tracking"><a href="<?php echo Yii::app()->baseUrl . '/index.php/company'; ?>">Dashboard</a></li>
                        <li <?php if (Yii::app()->controller->action->id == 'projects') { ?> class=" nav-selected" <?php } ?> id="footer_nav_powerful-reports"><a href="<?php echo Yii::app()->baseUrl . '/index.php/company/projects'; ?>">Projects</a></li>
                        <li <?php if (Yii::app()->controller->action->id == 'payments') { ?> class=" nav-selected" <?php } ?> id="footer_nav_fast-online-invoicing"><a href="<?php echo Yii::app()->baseUrl.'/index.php/payment/addbalance'; ?>">Payments</a></li>    
                        <li <?php if (Yii::app()->controller->action->id == 'profile') { ?> class=" nav-selected" <?php } ?> id="footer_nav_estimates"><a href="<?php echo Yii::app()->baseUrl . '/index.php/company/profile'; ?>">Profile</a></li>

                    </ul>
                    <a href="https://www.getharvest.com/add-ons" class="side-nav-box">      <div class="side-nav-box-inner">
                            <h4>Add-ons &amp; API</h4>
                            <p>Harvest works great with popular services like Quickbooks, Basecamp &amp; Twitter</p>
                        </div>
                    </a></div>
            </div>
        </div>
        <header >
            <div class="wrapper">

                <div id="logo" style="width:191px;"><a href="#">App-Test Lab</a><img src="<?php echo Yii::app()->baseUrl ?>/images/logo2.png" style="margin-top:-73px" height="145px" width="210px"></div>
                <ul id="top_nav">
                    <li class=" nav-selected" id="nav_features"><a href="https://www.getharvest.com/features/time-tracking" onclick="javascript:void(0);">Features</a></li>          <li class=" " id="nav_pricing"><a href="https://www.getharvest.com/pricing" onclick="javascript:void(0);">Pricing</a></li>
                    <li class=" " id="nav_add-ons"><a href="https://www.getharvest.com/add-ons" onclick="javascript:void(0);">Add-ons</a></li>
                    <li class=" " id="nav_customers"><a href="https://www.getharvest.com/customers" onclick="javascript:void(0);">Customers</a></li>
                    <li class=" " id="nav_about"><a href="https://www.getharvest.com/about" onclick="javascript:void(0);">About</a></li>
                    <li class=" " id="nav_blog"><a href="../../../blog/default.htm" onclick="javascript:void(0);">Blog</a></li>
                </ul>
                <div id="header_logout" style="float:right;margin-top:17px;">
                    <a href="<?php echo Yii::app()->baseUrl . '/index.php/user/logout'; ?>" ><span style="color:#fff;">Logout</span></a>
                </div>
            </div>
        </header>
        <?php include('footer.php'); ?>

</html>

