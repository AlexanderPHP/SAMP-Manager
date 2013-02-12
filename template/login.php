<div class="mbl">
	<div class="login-block">
		<div class="login-ear"></div>
<?if($Auth):?>
		<h2 class="mbl">������ <span id="user_name"><?=$User['site']->name?></span>!</h2>
		<ul class="loginbox clearfix">
			<li class="loginava">
				<a href="<?=$Path.'/profile/'.$User['site']->name?>" title="������� � �������" id="user_avatar">
					<img src="/template/images/noavatar.png" alt="<?=$User['site']->name?>}" />
				</a>
			</li>

			<?if($User['site']->group >= 3):?>
			<li><a class="button positive mbm mtm" href="/news_add.html">�������� �������</a></li>
			<li><a class="button firm mbm" href="<?=$Path?>/admin/" title="�����������"><b>����������</b></a></li>
			<?endif;?>
			
			<li class="lvsep"><a href="<?=$Path.'/profile/'.$User['site']->name?>">��� �������</a></li>
			<!--<li class="lvsep"><a href="{pm-link}">{new-pm} ���������</a></li>
			<li class="lvsep"><a href="{newposts-link}">�������������</a></li>-->
			<li><a class="button neutral mtm" href="/logout">�����</a></li>	
			
		</ul>
<?else:?>
		<h2 class="mbl">�����</h2>
		<form method="post" action="/?action=login">
			<div class="mbm">
				<div class="text-rounded light">
					<input placeholder="�����" name="login_name" id="login_name"  type="text" />
				</div>
			</div>
			<div class="pts">
				<div class="text-rounded light">
					<input placeholder="������" type="password" name="login_password" id="login_password">
				</div>
			</div>
			<div class="ptl clearfix">
				<div class="right	">
					<input class="button positive" onclick="submit();" type="submit" value="�����" />			
					<input name="login" type="hidden" id="login" value="submit" />
				</div>
			</div>
			
		</form>
		<div class="ptl clearfix">
			<a class="left pts" href="{lostpassword-link}">������?</a>
			<a class="button firm right" href="/registration.html">����������</a>
		</div>

<?endif;?>
	</div>
</div>