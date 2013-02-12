<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="ru"> <![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8" lang="ru"> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9" lang="ru"> <![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" lang="ru"> <!--<![endif]-->

<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<title>BeautifulLife Role Play</title>
<meta name="description" content="" />
<meta name="keywords" content="" />
<link href="<?=$Path?>/template/style/styles.css" rel="stylesheet" />
</head>
<body>
<img alt="" class="background-light" src="<?=$Path?>/template/images/background-light.png">
<div class="container">
	<div class="wrapper clearfix">
		<div class="col1of2">
			<div class="futurico-content">
				<div class="site-info">
					<div class="sitename"><a href="/" title="BeautifulLife Role Play">BeautifulLife Role Play</a></div>
					<div class="about">
						<span class="legend-left"></span>
						<span class="legend-center">Прекрасная жизнь</span>
						<span class="legend-right"></span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="content">
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

		<div class="wrapper clearfix">
			<div class="col1of4">
				<? include_once(__DIR__ . '/login.php') ?>
				<div class="paragraph sharp topnews">
					<h3>Топ новостей</h3>
					<ul><?include_once(__DIR__ .'/topnews.php')?></ul>
				</div>
			</div>
			<div class="futurico-content last-col">
<?
if(isset($_GET['action']))
{
    switch($_GET['action'])
    {
        case 'fullnews': if($Auth){include_once(__DIR__ . '/fullstory.php');break;}

        case 'register': if(!$Auth)include_once(__DIR__ . '/registration.php');break;

        case 'addnews': if($Auth)include_once(__DIR__ . '/addnews.php');break;

        case 'viewprofile': include_once(__DIR__ . '/userinfo.php');break;
		
		case 'about': include_once(__DIR__ . '/static.php');break;

        default: include_once(__DIR__ . '/shortstory.php');
    }
} else include_once(__DIR__ . '/shortstory.php');
 ?>
			</div>
		</div>
	</div>
	<!-- noindex -->
	<div class="footer">
		<div class="wrapper clearfix">
			<div class="col1of4 left by-left ptm site-info-credentials">

			</div>
			<div class="futurico-content last-col">
				<div class="news">
					&copy;BeautifullLife-RP.ru <br />
					<?=date('Y')?>
				</div>
			</div>
		</div>
	</div>
	<!-- /noindex -->
</div>
</body>
</html>