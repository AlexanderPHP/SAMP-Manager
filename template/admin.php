<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="ru"> <![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8" lang="ru"> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9" lang="ru"> <![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" lang="ru"> <!--<![endif]-->

<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<title>BeautifulLife Role Play :: Admin Panel</title>
<meta name="description" content="" />
<meta name="keywords" content="" />
<link href="<?=$Path?>/template/style/styles.css" rel="stylesheet" /> 
  <style type="text/css">
.nice_table tr td {padding: 5px 10px; border: 1px solid #555; color: #000;}
.nice_table tr:nth-child(odd) {background: #666}
.nice_table tr:nth-child(even) {background: #777}
.nice_table tr:hover {background: #999}
.nice_table tr th {padding: 10px 15px; border: 1px solid #555; color: #000;}
  </style>
<script type="text/javascript" src="<?=$Path?>/template/js/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="<?=$Path?>/template/js/ajaxad.js"></script>
</head>
<body>
<img alt="" class="background-light" src="<?=$Path?>/template/images/background-light.png">
<div id="notice_msg" style="position: fixed; z-index: 300; top: 0px; right: 0px; color: rgb(51, 51, 51); background-color: rgb(255, 204, 204); font-family: Tahoma; font-size: 12px; padding: 7px 10px; border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 4px; text-shadow: rgb(243, 243, 243) 0px 1px 0px; display: none; "></div>
<div class="container">
	<div class="content">
		<div class="mbl">
		<div class="mbl">
			<div class="header">
				<div class="wrapper nopad clearfix">
					<div class="col3of5">
						<ul class="header-navigation">
						    <li>
							<a href="/">Главная</a>
							</li>
							<li>
							<a href="http://forum.beautifullife-rp.ru/">Форум</a>
							</li>
							<li>
							<a href="/about">О сервере</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		</div>
		
		<div class="wrapper clearfix">
			<div class="col1of4">
				<? include_once(__DIR__ . '/login.php') ?>
			</div>
			<div class="futurico-content last-col">
<?include_once(__DIR__ . '/admininfo.php');?>
	</div>
		</div>
	</div>
</div>
</body>
</html>