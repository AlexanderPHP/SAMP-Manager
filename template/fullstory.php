<? foreach($FullNews as $Post):?>
<div class="news">
	<div class="inner">
		<div class="news-header clearfix">
			<h1 class="left"><?=$Post['title']?></h1>						
		</div>
		<div class="news-info clearfix">		
			<div class="news-author right"><a href="<?=$Path.'/profile/'.$Post['author'];?>"><?=$Post['author']?></a> - <?=$Post['date']?></div>
		</div>
		<div class="news-text clearfix">
			<?=$Post['full_news']?>
		</div>
		<?/*<div class="news-footer clearfix">
			<?if($Auth && $User['site']->group > 3):?><div class="editnews left">[edit]������[/edit]</div><?endif;?>
				<div class="views left">{views}</div>
				<div class="comm-num left" title="���������� ������������: {comments-num}">[com-link]{comments-num}[/com-link]</div>		
		</div>*/?>				
		<div class="news-footer2 clearfix">
			<div class="starbar left">
                            <div style="display: inline-table; margin: 0 3px 0 -6px;">
                                <a href="<?=$Path?>/ratenews/up/<?=$Post['id']?>" style="background: url('<?=$Path?>/template/images/icons_vote_posts.gif') no-repeat scroll left top transparent;width: 11px;height: 15px;position: absolute;" title="<?=$Auth ? '��������' : '���������� ����� ������ ������������������ ������������';?>"></a>
                                    <span style="font-weight: bold;color: <?=($Post['pos_votes']-$Post['neg_votes'] >= 0)? 'green' : 'red'?>;font-size: 14px;padding: 0 5px 0 16px;" title="����� <?=$Post['pos_votes']+$Post['neg_votes']?>: ����������� <?=$Post['pos_votes']?> � �� ����������� <?=$Post['neg_votes']?> �����."><?=$Post['pos_votes']-$Post['neg_votes']?></span>
                                <a href="<?=$Path?>/ratenews/down/<?=$Post['id']?>" style="background: url('<?=$Path?>/template/images/icons_vote_posts.gif') no-repeat scroll right top transparent;width: 11px;height: 15px;position: absolute;" title="<?$Auth ? '�� ��������' : '���������� ����� ������ ������������������ ������������';?>"></a>
                            </div>
			</div>
			<a class="fulllink goback right" href="javascript:history.go(-1)" title="��������� �����">��������� �����</a>
		</div>
		
	</div>
</div>
<?  endforeach; ?>
<?if(!$Auth):?>
<div class="currently-playing">
	<h2>�� �� ������ ��������� �����������.</h2> 
	������� ��� ����������������� �� �����.
</div>
<?else:?>
<h2 class="comm-header">����������� ������������</h2>
� ����������...
<?endif;?>