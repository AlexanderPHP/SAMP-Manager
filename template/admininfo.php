<div class="news-header"><h1>Admin Control Panel: </h1></div>
<div class="tabbox mbl">
	<ul class="tabbox-tabs">
		<li class="active">������������:</li>
		<?if($User['site']->group >= 6):?><li>�������:</li><?endif;?>
	</ul>
	<div class="tabbox-stuff clearfix">
		<div class="userinfo-info clearfix">				
			<table class="nice_table" width="712">
				<tbody>
					<tr>
						<th>Name:</th>
						<th>Level:</td>
						<th>IP:</th>
						<th>Warn:</th>
						<th>Mute:</th>
						<th>Jail:</th>
						<th>Ban:</th>
						<?if($User['site']->group >= 4):?><th>Delete:</th><?endif;?>
					</tr>
					<? foreach($Users as $U):?>
					<tr style='text-align: center;'>
						<td style='text-align: left;'><a href='<?=$Path?>/profile/<?=$U['name']?>'><?=$U['name']?></td>
						<td><?=$U['level'] ?></td>
						<td><?=$U['pip'] ?></td>
						<td><img alt="warn" src='<?=$Path?>/template/images/warning.png' style="cursor: pointer;" title='������� �������������� ������������.'>
						<img alt="unwarn" src='<?=$Path?>/template/images/unwarning.png' style="cursor: pointer;" title='����� �������������� � ������������.'></td>
						<td><input type="checkbox" name="mute" <?=$U['muted']?'checked title="�������� ���� ��� ��� ;)"':' title="�������� ������������."'?>></td>
						<td><input type="checkbox" name="jail" <?=$U['jailed']?'checked title="���������� �� ������."':' title="�������� � ������."'?>></td>
						<td><input type="checkbox" name="ban" <?=$U['ban']?'checked title="��������� ������������."':' title="�������� ������������."'?>></div></td>
						<?if($User['site']->group >= 4):?><td><img alt='delete' src='<?=$Path?>/template/images/delete.png' title="������� ������� ������������." style="cursor: pointer;"></td><?endif;?>
					</tr>
					<? endforeach; ?>
				</tbody>
			</table>
		</div>

	</div>
	<?if($User['site']->group >= 6):?>
	<div class="tabbox-stuff clearfix">
		<div class="userinfo-info clearfix">				
					<div class="fleft">
						<div class="avatar">
							<img src="<?=$Path;?>/template/images/noavatar.png" alt=""/>
						</div>
						<p>{email}</p>
						<p>{pm}</p>
					</div>
					<div class="right-info">
						<ul>
							<li><br /><span class="grey">������ ���:</span> <b></b></li>
							<li><span class="grey">������:</span> {status} </li>
							<li><span class="grey">ICQ:</span> <b>{icq}</b></li>
						</ul>
						<hr />
						<ul>
							<li><span class="grey">���:</span> <b></b></li><br />
							<li><span class="grey">� ����� ���:</span> <b></b></li><br />
						<ul>
							<li><span class="grey">����� ����������:</span> {land}</li><br />
							<li><span class="grey">������� � ����:</span> {info}</li><br />
						</ul>
							<li><span class="grey">���� �����������:</span> <b></b></li>
							<br />
							<li><span class="grey">��������� ���������:</span> <b></b></li><br />
						</ul>
					</div>
				</div>
			
	</div>
	<?endif;?>
</div>
<script src="<?=$Path;?>/template/js/SCF.ui.js"></script>