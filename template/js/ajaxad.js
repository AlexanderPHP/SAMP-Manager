$(document).ready(function(){

function onAjaxSuccess(data)
{
	if(data) {
		$("#notice_msg").html(data).show();
		setTimeout(function() {$("#notice_msg").fadeOut();}, 3000);
	}
}

$(':checkbox').click(function() {
        $.post('/ajax', {action:this.name,uname:$(this).parent().prevAll('td:last').text(),type:'usereditaction'},onAjaxSuccess);
});

$('td>img').click(function() {
	var user = $(this).parent().prevAll('td:last').text();
	if(this.alt == 'warn' || this.alt == 'unwarn') {
		$.post('/ajax', {action:this.alt,uname:user,type:'usereditaction'},onAjaxSuccess);
	} else if(this.alt == 'delete' && confirm('Вы действительно хотите удалить '+user+'?\nВосстановить данные будет невозможно!')) {
		$(this).parents("tr").animate({ opacity: "hide" }, "slow",function(){
			$.post('/ajax', {action:'delete',uname:user,type:'usereditaction'},onAjaxSuccess)
		});
	}
});

});
