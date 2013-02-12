
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">

<head>

<style type="text/css">

html,body {

	background: url('<?=$Path;?>/template/images/bg.png');

	margin:0;

	padding:0;

	padding-top:50px;

}

.blk {

	width: 700px;

	margin: 0 auto;

}

.infobox {

	background: url('<?=$Path;?>/template/images/infobox.png');

	width: 507px;

	height: 84px;

}

.info {

	color: #7d7d7d;

	font-family: Tahoma;

	font-size: 11px;

	text-shadow: 0px 1px 0px #fff;

	padding: 22px;

	padding-top:35px;

}

.birdbg {

	background: url('<?=$Path;?>/template/images/birdbg.png');

	width: 685px;

	height: 302px;

}

.bird {

	padding:180px 0px 0px 50px;

}

.msg1 {

	font-family: Arial Narrow;

	font-size: 30px;

	color:#788a8c;

	text-shadow: 0px 1px 0px #fff;

}

.msg2 {

	font-family: Arial Narrow;

	font-size: 18px;

	color:#8d8d8d;

	text-shadow: 0px 1px 0px #fff;

	text-align:right;

	padding-right:65px;

}

.fl{float:left;}.fr{float:right;}.cl{clear:both;}

.twit {padding-right:68px}

.twit a {

	font-family: Tahoma;

	font-size:11px;

	color:#959595;

	border-bottom: 1px dashed #959595;

	text-decoration:none;

}

</style>

<title>Подтвердите ваш E-mail</title>

</head>

<body>

<div class="blk" align="center">

	<div class="infobox">

		<div class="info">

На указанный Вами при регистрации E-mail выслано письмо с подтверждением.<br />До момента подтверждения Ваш аккаунт будет не активен.

		</div>

	</div>

	<div class="birdbg" align="left">

		<div class="bird">

			<div class="twit" align="right">

				<div class="fr">

					<div class="cl"></div>

				</div>

				<div class="cl"></div>

			</div>

			<div class="msg1">Так же вы можете выйти из своего аккаунта <a href="<?=$Path?>/logout">Выход</a> </div>

		</div>

	</div>

</div>

</body>

</html>