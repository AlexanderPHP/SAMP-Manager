<div class="mbl">
	<div class="login-block">
		<div class="login-ear"></div>
<?if($Auth):?>
		<h2 class="mbl">Привет <span id="user_name"><?=$User['site']->name?></span>!</h2>
		<ul class="loginbox clearfix">
			<li class="loginava">
				<a href="<?=$Path.'/profile/'.$User['site']->name?>" title="Перейти в профиль" id="user_avatar">
					<img src="/template/images/noavatar.png" alt="<?=$User['site']->name?>}" />
				</a>
			</li>

			<?if($User['site']->group >= 3):?>
			<li><a class="button positive mbm mtm" href="/news_add.html">Добавить новость</a></li>
			<li><a class="button firm mbm" href="<?=$Path?>/admin/" title="Админпанель"><b>Админцентр</b></a></li>
			<?endif;?>
			
			<li class="lvsep"><a href="<?=$Path.'/profile/'.$User['site']->name?>">Мой профиль</a></li>
			<!--<li class="lvsep"><a href="{pm-link}">{new-pm} Сообщений</a></li>
			<li class="lvsep"><a href="{newposts-link}">Непрочитанное</a></li>-->
			<li><a class="button neutral mtm" href="/logout">Выход</a></li>	
			
		</ul>
<?else:?>
		<h2 class="mbl">Войти</h2>
		<form method="post" action="/?action=login">
			<div class="mbm">
				<div class="text-rounded light">
					<input placeholder="Логин" name="login_name" id="login_name"  type="text" />
				</div>
			</div>
			<div class="pts">
				<div class="text-rounded light">
					<input placeholder="Пароль" type="password" name="login_password" id="login_password">
				</div>
			</div>
			<div class="ptl clearfix">
				<div class="right	">
					<input class="button positive" onclick="submit();" type="submit" value="Войти" />			
					<input name="login" type="hidden" id="login" value="submit" />
				</div>
			</div>
			
		</form>
		<div class="ptl clearfix">
			<a class="left pts" href="{lostpassword-link}">Забыли?</a>
			<a class="button firm right" href="/registration.html">Реистрация</a>
		</div>

<?endif;?>
	</div>
</div>