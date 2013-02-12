<script type="text/javascript" src="<?=$Path?>/template/js/jquery-1.8.0.min.js"></script>
<script src="<?=$Path?>/template/js/ru.js"></script>
<link rel="stylesheet" href="/template/style/redactor.css" />
<script src="<?=$Path?>/template/js/redactor.min.js"></script>
<script type="text/javascript">$(document).ready(function(){$("textarea").redactor({ fixed: true,  focus: true, lang: 'ru'});});</script>
<div class="news">
	<div class="news-header">
		<h1>Добавить новость</h1>
	</div>
	<form method="post" action="/news_add.html">
	<div class="addnews">	
	<div class="addnews-item">
		<b>Заголовок</b>
		<input type="text" name="title" value="" maxlength="150" class="f_input" />
	</div>
	<div class="addnews-item">
		<b>Краткое описание</b>
		<div class="addnews-editor">
			<textarea name="short_news" id="short_story" class="f_textarea" ></textarea>
		</div>
	</div>
	<div class="addnews-item">
		<b>Полное описание </b>
		<div class="addnews-editor">
			<textarea name="full_news" id="full_story" class="f_textarea" ></textarea>
		</div>
	</div>
	</div>
		<div class="news-footer">
		<input name="add" class="button positive" type="submit" value="Отправить"/>
		</div>
	</form>
</div>