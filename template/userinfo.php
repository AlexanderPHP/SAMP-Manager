
<div class="news-header"><h1>������������: <?=$pUser['name']?></h1></div>
<div class="tabbox mbl">
	<ul class="tabbox-tabs">
		<li class="active">���������� � ������������</li>
		<? /*<li>������������� �������</li>*/?>
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
							<li><br /><span class="grey">������ ���:</span> <b><?=$pUser['name']?></b></li>
							<!--<li><span class="grey">������:</span> {status} </li>
							<li><span class="grey">ICQ:</span> <b>{icq}</b></li>-->
						</ul>
						<hr />
						<ul>
							<li><span class="grey">���:</span> <b><?=$pUser['sex']==1? '�������' : '�������'?></b></li><br />
							<li><span class="grey">� ����� ���:</span> <b><?=$pUser['level']?> ���(�).</b></li><br />
						<!--<ul>
							<li><span class="grey">����� ����������:</span> {land}</li><br />
							<li><span class="grey">������� � ����:</span> {info}</li><br />
						</ul>-->
							<li><span class="grey">���� �����������:</span> <b><?=$pUser['pdatareg']?></b></li>
							<br />
							<li><span class="grey">��������� ���������:</span> <b><?=$pUser['last_visit']?></b></li><br />
						</ul>
					</div>
				</div>
			
	</div>
	<? /*<div class="tabbox-stuff clearfix">
		� ����������...
		<div class="edit-user">
					<div class="addnews-item">
						<b>���� ���</b>
						<input type="text" name="fullname" value="{fullname}" class="f_input" /> <br />
						<label>{hidemail}</label> <br />
						<input type="checkbox" id="subscribe" name="subscribe" value="1" /> <label for="subscribe">���������� �� ����������� ��������</label>
					</div>
					<div class="addnews-item">
						<b>��� E-Mail</b>
						<input type="text" name="email" value="{editmail}" class="f_input" />
					</div>
					<div class="addnews-item">
						<b>����� ����������</b>
						<input type="text" name="land" value="{land}" class="f_input" />
						
					</div>
					<div class="addnews-item">
						<b>������ ������������ �������������</b>
						<p>{ignore-list}</p>
					</div>
					<div class="addnews-item">
						<b>����� ICQ</b>
						<input type="text" name="icq" value="{icq}" class="f_input" />
					</div>
					<div class="addnews-item">
						<b>������ ������</b>
						<input type="password" name="altpass" class="f_input" />
					</div>
					<div class="addnews-item">
						<b>����� ������</b>
						<input type="password" name="password1" class="f_input" />
					</div>
					<div class="addnews-item">
						<b>��������� ����� ������</b>
						<input type="password" name="password2" class="f_input" />
					</div>
					<div class="addnews-item">
						<b>���������� �� IP (��� IP: {ip})</b>
						<textarea name="allowed_ip" rows="5" class="f_textarea">{allowed-ip}</textarea>
						<p class="small" style="color:red;">
							* ��������! ������ ��������� ��� ��������� ������ ���������.
							������ � ������ �������� ����� �������� ������ � ���� IP-������ ��� �������, ������� �� �������.
							�� ������ ������� ��������� IP �������, �� ������ ������ �� ������ �������.
							<br />
							������: 192.48.25.71 ��� 129.42.*.*
						</p>
					</div>
					<div class="addnews-item">
						<b>������</b>
						<input type="file" name="image" class="f_input" /> <br />
						<input type="checkbox" name="del_foto" id="del_foto" value="yes" />�<label for="del_foto">������� ������</label>
					</div>
					<div class="addnews-item">
						<b>� ����</b>
						<textarea name="info" rows="5" class="f_textarea">{editinfo}</textarea>
					</div>
					<div class="addnews-item">
						<b>�������</b>
						<textarea name="signature" rows="5" class="f_textarea">{editsignature}</textarea>
					</div>
					<table>
					</table>
				</div>
				<div class="fieldsubmit">
					<input class="button positive mtl" type="submit" name="submit" value="���������" />
					<input name="submit" type="hidden" id="submit" value="submit" />
				</div>
	</div>*/ ?>
</div>
<script type="text/javascript" src="<?=$Path?>/template/js/jquery-1.8.0.min.js"></script>
<script src="<?=$Path;?>/template/js/SCF.ui.js"></script>