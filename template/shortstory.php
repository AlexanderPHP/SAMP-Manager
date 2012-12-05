<?foreach($ShortNews as $Post):
$titlehref = $Path.'/'.$Post['id'].'-'.preg_replace('/(\s){1,}/','-',preg_replace('![^\w\d\sА-Яа-яЁё]*!','',$Post['title'])).'.html';?>
<div class="news">
    <div class="inner">
        <div class="news-header clearfix">
            <h2 class="left"><a href="<?=$titlehref;?>" title="<?=$Post['title']?>"><?=$Post['title']?></a></h2>						
        </div>
        <div class="news-info clearfix">			
            <div class="news-author right"><a href="<?=$Path.'/profile/'.$Post['author'];?>"><?=$Post['author']?></a> - <?=$Post['date']?></div>
        </div>
        <div class="news-text clearfix">
            <?=$Post['short_news']?>
        </div>
        <?/*<div class="news-footer clearfix">
            if($Auth && $User['site']->group > 3):?><div class="editnews left">[edit]Правка[/edit]</div><?endif;
            <div class="views left">{views}</div>
            <div class="comm-num left" title="Количество комментариев: {comments-num}">[com-link]{comments-num}[/com-link]</div>		
        </div>*/?>				
        <div class="news-footer2 clearfix">
            <div class="starbar left">
                <div style="display: inline-table; margin: 0 3px 0 -6px;">
                    <a href="<?=$Path?>/ratenews/up/<?=$Post['id']?>" style="background: url('<?=$Path?>/template/images/icons_vote_posts.gif') no-repeat scroll left top transparent;width: 11px;height: 15px;position: absolute;" title="<?=$Auth ? 'Нравится' : 'Голосовать могут только зарегистрированные пользователи';?>"></a>
                            <span style="font-weight: bold;color: <?=($Post['pos_votes']-$Post['neg_votes'] >= 0)? 'green' : 'red'?>;font-size: 14px;padding: 0 5px 0 16px;" title="Всего <?=$Post['pos_votes']+$Post['neg_votes']?>: Понравилось <?=$Post['pos_votes']?> и Не понравилось <?=$Post['neg_votes']?> людям."><?=$Post['pos_votes']-$Post['neg_votes']?></span>
                    <a href="<?=$Path?>/ratenews/down/<?=$Post['id']?>" style="background: url('<?=$Path?>/template/images/icons_vote_posts.gif') no-repeat scroll right top transparent;width: 11px;height: 15px;position: absolute;" title="<?=$Auth ? 'Не нравится' : 'Голосовать могут только зарегистрированные пользователи';?>"></a>
                </div>
            </div>
            <a class="fulllink right" href="<?=$titlehref;?>" title="<?=$Post['title']?>">Читать далее</a>
        </div>
    </div>
</div>
<?endforeach;?>
<?if($Navig) include_once(__DIR__ . '/navigation.php')?>
