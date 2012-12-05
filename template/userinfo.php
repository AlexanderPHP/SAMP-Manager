
<div class="news-header"><h1>Пользователь: <?=$pUser['name']?></h1></div>
<div class="tabbox mbl">
	<ul class="tabbox-tabs">
		<li class="active">Информация о пользователе</li>
		<? /*<li>Редактировать профиль</li>*/?>
	</ul>
	<div class="tabbox-stuff clearfix">
		<div class="userinfo-info clearfix">				
					<div class="fleft">
						<div class="avatar">
							<img src="<?=$Path;?>/template/images/noavatar.png" alt=""/>
						</div>
						<!--<p>{email}</p>
						<p>{pm}</p>-->
					</div>
					<div class="right-info">
						<ul>
							<li><br /><span class="grey">Полное имя:</span> <b><?=$pUser['name']?></b></li>
							<!--<li><span class="grey">Группа:</span> {status} </li>
							<li><span class="grey">ICQ:</span> <b>{icq}</b></li>-->
						</ul>
						<hr />
						<ul>
							<li><span class="grey">Пол:</span> <b><?=$pUser['sex']==1? 'Мужчина' : 'Женщина'?></b></li><br />
							<li><span class="grey">В штате уже:</span> <b><?=$pUser['level']?> Год(а).</b></li><br />
						<!--<ul>
							<li><span class="grey">Место жительства:</span> {land}</li><br />
							<li><span class="grey">Немного о себе:</span> {info}</li><br />
						</ul>-->
							<li><span class="grey">Дата регистрации:</span> <b><?=$pUser['pdatareg']?></b></li>
							<br />
							<li><span class="grey">Последнее посещение:</span> <b><?=$pUser['last_visit']?></b></li><br />
						</ul>
					</div>
				</div>
			
	</div>
	<? /*<div class="tabbox-stuff clearfix">
		В разработке...
		<div class="edit-user">
					<div class="addnews-item">
						<b>Ваше Имя</b>
						<input type="text" name="fullname" value="{fullname}" class="f_input" /> <br />
						<label>{hidemail}</label> <br />
						<input type="checkbox" id="subscribe" name="subscribe" value="1" /> <label for="subscribe">Отписаться от подписанных новостей</label>
					</div>
					<div class="addnews-item">
						<b>Ваш E-Mail</b>
						<input type="text" name="email" value="{editmail}" class="f_input" />
					</div>
					<div class="addnews-item">
						<b>Место жительства</b>
						<input type="text" name="land" value="{land}" class="f_input" />
						
					</div>
					<div class="addnews-item">
						<b>Список игнорируемых пользователей</b>
						<p>{ignore-list}</p>
					</div>
					<div class="addnews-item">
						<b>Номер ICQ</b>
						<input type="text" name="icq" value="{icq}" class="f_input" />
					</div>
					<div class="addnews-item">
						<b>Старый пароль</b>
						<input type="password" name="altpass" class="f_input" />
					</div>
					<div class="addnews-item">
						<b>Новый пароль</b>
						<input type="password" name="password1" class="f_input" />
					</div>
					<div class="addnews-item">
						<b>Повторите новый пароль</b>
						<input type="password" name="password2" class="f_input" />
					</div>
					<div class="addnews-item">
						<b>Блокировка по IP (Ваш IP: {ip})</b>
						<textarea name="allowed_ip" rows="5" class="f_textarea">{allowed-ip}</textarea>
						<p class="small" style="color:red;">
							* Внимание! Будьте бдительны при изменении данной настройки.
							Доступ к Вашему аккаунту будет доступен только с того IP-адреса или подсети, который Вы укажете.
							Вы можете указать несколько IP адресов, по одному адресу на каждую строчку.
							<br />
							Пример: 192.48.25.71 или 129.42.*.*
						</p>
					</div>
					<div class="addnews-item">
						<b>Аватар</b>
						<input type="file" name="image" class="f_input" /> <br />
						<input type="checkbox" name="del_foto" id="del_foto" value="yes" /> <label for="del_foto">Удалить аватар</label>
					</div>
					<div class="addnews-item">
						<b>О себе</b>
						<textarea name="info" rows="5" class="f_textarea">{editinfo}</textarea>
					</div>
					<div class="addnews-item">
						<b>Подпись</b>
						<textarea name="signature" rows="5" class="f_textarea">{editsignature}</textarea>
					</div>
					<table>
					</table>
				</div>
				<div class="fieldsubmit">
					<input class="button positive mtl" type="submit" name="submit" value="Сохранить" />
					<input name="submit" type="hidden" id="submit" value="submit" />
				</div>
	</div>*/ ?>
</div>
<script type="text/javascript" src="<?=$Path?>/template/js/jquery-1.8.0.min.js"></script>
<script src="<?=$Path;?>/template/js/SCF.ui.js"></script>