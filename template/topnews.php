<?  foreach ($TopNews as $TopNew):?>
<li class="form-row"><a href="<?=$Path.'/'.$TopNew['id'].'-'.str_replace(' ','-',preg_replace('![^\w\d\s�-��-���]*!','',$TopNew['title'])).'.html';?>"><?=$TopNew['title'];?></a></li>
<? endforeach;?>