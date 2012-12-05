<?php
class News{
	
	private $qPosts, # Количество выводимых новостей на страницу
			$cPosts, # Количество новостей в базе
			$start; # ID первой выводимй новости
	public	$Navig = false; # Вывод пагинации
			
	public function __construct($qPosts)
	{
		$this->qPosts = $qPosts;
		$this->cPosts = $this->PagCount();
	}

	public function AddNews($title,$sn,$fn)
	{
		if(!empty($title) && !empty($sn) && !empty($fn))
		{
			$replace = str_replace(array('<script>','</script>','<script '),'',array($sn,$fn));
			Main::Db()->noResult("INSERT INTO `site_news`(`author`,`date`,`title`,`short_news`,`full_news`) VALUES('".Main::$UserData['site']->name."',NOW(),:title,:short_news,:full_news)",array(':title'=>strip_tags($title),':short_news'=>$replace[0],':full_news'=>$replace[1]));
		}
	}
	
	public function getNews($type,$nid = false)
	{
            switch ($type) {
                case 'short': return Main::Db()->getResult("SELECT `id`,`title`,`author`,`short_news`,DATE_FORMAT(`date`,'%e %M %Y %H:%i:%s') as `date`,`pos_votes`,`neg_votes` FROM `site_news` ORDER BY `id` DESC LIMIT ".$this->start.','.$this->qPosts);

                case 'full': return Main::Db()->getResult("SELECT `id`,`title`,`author`,`full_news`,DATE_FORMAT(`date`,'%e %M %Y %H:%i:%s') as `date`,`pos_votes`,`neg_votes` FROM `site_news` WHERE id = :id ORDER BY `id`",array(':id'=>abs((int)$nid)));
                 
                case 'top': return Main::Db()->getResult('SELECT `id`,`title` FROM `site_news` ORDER BY `pos_votes`-`neg_votes` DESC LIMIT 0,6');
            }
	}
	
	private function PagCount()
	{
		return Main::Db()->getResult('SELECT COUNT(`id`) as `count` FROM `site_news`')[0]['count'];
	}
	
	public function getPagination($page)
	{
            $curpage = ($page > 0) ? $page : 1;
            $this->start = ($curpage-1) * $this->qPosts;

            $ceil = ceil($this->cPosts / $this->qPosts);

            if ($curpage >= 7) {
                $loopstart = $curpage - 3;
                    if ($ceil > $curpage + 3)
                        $loopend = $curpage + 3;
                    elseif ($curpage <= $ceil && $curpage > $ceil - 6) {
                        $loopstart = $ceil - 6;
                    $loopend = $ceil;
                    } else
                        $loopend = $ceil;
            } else {
                $loopstart = 1;
                    if ($ceil > 7)
                        $loopend = 7;
                    else
                        $loopend = $ceil;
            }
            if($ceil > 1) $this->Navig = true;
            $pgn = "";

                if ($curpage > 1)
                    $pgn .= "<a href='/page/1' title='Первая'>&lt;&lt;</a>";
                else
                    $pgn .= "<span>&lt;&lt;</span>";

                if ($curpage > 1) {
                    $pre = $curpage - 1;
                    $pgn .= "<a href='/page/{$pre}' title='Предыдущая'>&nbsp;&lt;&nbsp;</a>";
                } else
                    $pgn .= "<span>&nbsp;&lt;&nbsp;</span>";

                for ($i = $loopstart; $i <= $loopend; $i++) {
                    if ($curpage == $i)
                        $pgn .= "<span>{$i}</span>";
                    else
                        $pgn .= "<a href='/page/{$i}'>{$i}</a>";
                }

                if ($curpage < $ceil) {
                    $nextpage = $curpage + 1;
                    $pgn .= "<a href='/page/{$nextpage}' title='Следующая'>&nbsp;&gt;&nbsp;</a>";
                } else
                    $pgn .= "<span>&nbsp;&gt;&nbsp;</span>";

                if ($curpage < $ceil)
                    $pgn .= "<a href='/page/{$ceil}' title='Последняя'>&gt;&gt;</a>";
                else
                    $pgn .= "<span>&gt;&gt;</span>";

            //$go = "<input type='text' class='goto' size='1' style='margin-top: -1px;margin-left:60px;height: 21px;'/><input type='button' id='go_btn' class='go_button' value='Go'/>";
            $total = "<span>Страница <b>$curpage</b> из <b>$ceil</b></span>";
            $pgn = $pgn . $total;

            return $pgn;
	}
	
	public function RateNews($nid, $vote)
	{
		foreach(explode("\n",file_get_contents($_SERVER['DOCUMENT_ROOT'].'/core/logs/news_voters.txt')) as $v)
		{
			$exp = explode('|',$v);
			if(in_array(Main::$UserData['site']->name,$exp) && $exp[1] == (int)$nid)
			{
				header('Location: http://'.$_SERVER['SERVER_NAME']);
				return false;
			}
		}		
		Main::Db()->noResult('SELECT `id` FROM `site_news` WHERE `id` = :id',array(':id'=>(int)$nid));
		if(!Main::Db()->rcount()) return false;

		if($vote == 'up')
			Main::Db()->noResult('UPDATE `site_news` SET `pos_votes`=`pos_votes`+1 WHERE `id` = :id',array(':id'=>(int)$nid));
		elseif($vote == 'down')
			Main::Db()->noResult('UPDATE `site_news` SET `neg_votes`=`neg_votes`+1 WHERE `id` = :id',array(':id'=>(int)$nid));
		file_put_contents($_SERVER['DOCUMENT_ROOT'].'/core/logs/news_voters.txt',Main::$UserData['site']->name.'|'.$nid."\n",FILE_APPEND | LOCK_EX);
		header('Location: http://'.$_SERVER['SERVER_NAME']);
	}

}
?>