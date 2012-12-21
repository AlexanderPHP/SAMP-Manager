<?xml version="1.0"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <!-- This website template was downloaded from http://www.nuviotemplates.com - visit us for more templates -->
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="content-language" content="en" />
    <meta name="robots" content="all,follow" />
    <meta name="description" content="..." />
    <meta name="keywords" content="..." />
    
    <link rel="stylesheet" media="screen,projection" type="text/css" href="{{path}}/css/main.css" />
    <!--[if lte IE 6]><link rel="stylesheet" type="text/css" href="css/main-msie.css" /><![endif]-->
    <link rel="stylesheet" media="screen,projection" type="text/css" href="{{path}}/css/scheme.css" />
    <link rel="stylesheet" media="print" type="text/css" href="{{path}}/css/print.css" />

    <title>Your website name | Homepage</title>
</head>

<body>

<!-- Header -->
<div id="header">
    <div class="main">

        <!-- Your logo -->
        <h3 id="logo"><a href="#">Your <span>website</span> name</a></h3>
        <!-- Your slogan -->
        <p id="slogan">Place for your business slogan</p>    

        <hr class="noscreen" />
    
        <!-- Hidden navigation -->
        <p class="noscreen noprint"><em>Quick links: <a href="#content">content</a>, <a href="#nav">navigation</a>, <a href="#search">search</a>.</em></p>
        
        <hr class="noscreen" />

        <!-- Search form -->     
        <div id="search">
            <form action="" method="get">
            	<div>
                    <span class="noscreen">Fulltext:</span>
                    <input type="text" size="30" name="query" id="search-input" /><input type="submit" value="Search" id="search-submit" />
            	</div>
            </form>
        </div> <!-- /search -->

    </div> <!-- /main -->
</div> <!-- /header -->

<hr class="noscreen" />

<!-- Horizontal navigation -->
<div id="nav" class="box">
    <div class="main">
    
        <h3 class="noscreen">Navigation</h3>  
              
        <ul>
            <li id="nav-active"><a href="#">Homepage</a></li> <!-- Active page (highlighted) -->
            <li><a href="#">About</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Products</a></li>
            <li class="last"><a href="#">Contact</a></li>
        </ul>

    </div> <!-- /main -->
</div> <!-- /nav -->

<hr class="noscreen" />

<!-- 2 columns (Content and Sidebar) -->
<div id="cols">
    <div class="main box">
    
        <!-- Content -->
        <div id="content">
        
            <!-- Perex -->            
            <div id="perex" class="box">
            
                <h1>Lorem ipsum dolor sit amet</h1>
                
                <p><img src="{{path}}/tmp/image.gif" width="200" height="150" alt="" class="f-right" />
                Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Suspendisse sem massa, semperese vel, tempus nec, pretium ut, urna.
				</p>
                
            </div> <!-- /perex -->

            <div id="content-in" class="box">
        
                <!-- 3 sections -->
                <div class="box">
                
                    <!-- Section I -->
                    <div class="section">
                        <h3><a href="#">Section ONE</a></h3>
                        <p class="t-center"><a href="#"><img src="{{path}}/tmp/image.gif" width="200" height="150" alt="" /></a></p>
                    </div> <!-- /section -->
                    
                    <!-- Section II -->
                    <div class="section margin">
                        <h3><a href="#">Section TWO</a></h3>
                        <p class="t-center"><a href="#"><img src="{{path}}/tmp/image.gif" width="200" height="150" alt="" /></a></p>
                    </div> <!-- /section -->
                    
                    <!-- Section III -->
                    <div class="section fix">
                        <h3><a href="#">Section THREE</a></h3>
                        <p class="t-center"><a href="#"><img src="{{path}}/tmp/image.gif" width="200" height="150" alt="" /></a></p>
                    </div> <!-- /section -->
                
                </div> <!-- /box -->
    
                <h2>Lorem ipsum dolor sit amet</h2>

                <h3>Lorem ipsum dolor sit amet</h3>
                
                <ul class="ul-style01">
                    <li>Lorem ipsum dolor sit amet</li>
                    <li>Lorem ipsum dolor sit amet</li>
                    <li>Lorem ipsum dolor sit amet
                        <ul>
                            <li>Lorem ipsum dolor sit amet</li>
                            <li>Lorem ipsum dolor sit amet
                                <ul>
                                    <li>Lorem ipsum dolor sit amet</li>
                                    <li>Lorem ipsum dolor sit amet</li>
                                    <li>Lorem ipsum dolor sit amet</li>
                                </ul>
                            </li>
                            <li>Lorem ipsum dolor sit amet</li>
                        </ul>
                    </li>
                    <li>Lorem ipsum dolor sit amet</li>
                    <li>Lorem ipsum dolor sit amet</li>
                </ul>
    
                <h3>Lorem ipsum sit dolor amet</h3>
                
                <table class="table-style01">
                    <tr class="bg">
                        <td>Lorem ipsum</td>
                        <td>Lorem ipsum</td>
                        <td>Lorem ipsum</td>
                        <td>Lorem ipsum</td>
                        <td>Lorem ipsum</td>
                    </tr>
                    <tr>
                        <td>Lorem ipsum</td>
                        <td>Lorem ipsum</td>
                        <td>Lorem ipsum</td>
                        <td>Lorem ipsum</td>
                        <td>Lorem ipsum</td>
                    </tr>
                </table>
        
            </div> <!-- /content-in -->
                    
        </div> <!-- /content -->

        <hr class="noscreen" />

        <!-- Sidebar -->
        <div id="aside">
            <div class="section">
				<h3>Авторизация</h3>
					<div class="in">
						<form action="/auth" method="post">
							<table class="nom">
								<tr>
									<td><label for="inp-user">Login:</label></td>
									<td colspan="2"><input type="text" size="30" style="width:127px;" name="login" id="inp-user" /></td>
								</tr>
								<tr>
									<td><label for="inp-pass">Password:</label></td>
									<td colspan="2"><input type="text" size="30" style="width:127px;" name="password" id="inp-pass" /></td>
								</tr>
								<tr>
									<td></td>
									<td class="smaller"><input type="checkbox" name="" id="inp-remember" /> <label for="inp-remember" title="Remember me for 14 days" class="help">Remember</label></td>
									<td class="t-right"><input type="image" value="Login" src="{{path}}/design/signup-button.gif" /></td>
								</tr>
							</table>
						</form>
                    </div>
			</div> <!-- /section -->
            <hr class="noscreen" />
            
            <h3>Contact</h3>
            
            <address>
                <strong>Your website name</strong><br />
                Our Street 1557, Our City<br />
                <a href="#">your@email.com</a>
            </address>
        
        </div> <!-- /aside -->
    
    </div> <!-- /main -->
</div> <!-- /cols -->

<hr class="noscreen" />

<!-- Footer -->
<div id="footer">
    <div class="main">

        <!-- Do you want remove this backlinks? Look at www.nuviotemplates.com/payment.php -->            
        <p class="f-right"><a href="http://www.nuviotemplates.com/">Free web templates</a> by <a href="http://www.nuvio.cz/">Nuvio</a> &ndash; visit <a href="http://free-templates.ru/">free-templates.ru</a></p>
        <!-- Do you want remove this backlinks? Look at www.nuviotemplates.com/payment.php -->
        
        <p>&copy;&nbsp;2008 <a href="#">Your website name</a></p>

    </div> <!-- /main -->
</div> <!-- /footer -->

</body>
</html>
