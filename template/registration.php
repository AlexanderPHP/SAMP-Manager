<div class="pheading" style="color:#3AA1BF;"><h2>Регистрация нового персонажа</h2></div>
<div class="baseform" style="color:#3AA1BF;">
	<form method="post" action="/?action=register">
		<table class="tableform">
			<tr>
				<td colspan="2" style="padding-bottom: 10px;">
				<br />В случае возникновения проблем с регистрацией, обратитесь к <a href="/index.php?do=feedback">администратору</a> сайта.<br />
				Регистрируясь на сайте, вы регистрируете своего персонажа. В дальнейшем вам не нужно будет проходить регистрацию в игре.<br />
				</td>
			</tr>
			<tr>
				<td class="label">
					Логин:<span class="impot">*</span>
				</td>
				<td>
					<input type="text" name="name" id='name' style="width:175px; margin-right: 6px; border: 1px solid rgb(192, 31, 47); width: 190px; border-radius: 30px; margin-bottom: 5px;" class="f_input"/>
					<div id='result-registration'></div>
				</td>
			</tr>
			<tr>
				<td class="label">
					Пароль:<span class="impot">*</span>
				</td>
				<td><input type="password" name="password" class="f_input " style="border: 1px solid rgb(192, 31, 47); width: 190px; border-radius: 30px; margin-bottom: 5px;"/></td>
			</tr>
			<tr>
				<td class="label">Ваш E-Mail:<span class="impot">*</span></td>
				<td><input type="text" name="email" class="f_input" style="border: 1px solid rgb(192, 31, 47); width: 190px; border-radius: 30px; margin-bottom: 5px;"/></td>
			</tr>
		</table>
		<div class="fieldsubmit">
			<button name="submit" class="bbcodes" type="submit"><span>Отправить</span></button>
		</div>
	</form>
</div>