$(function(){
	$.ajax({
	  type: 'POST',
	  url: "../php/notes.php",
	  data: "type = notes",
	  async: false,
	  dataType: "json",
	  success: function(date){
	  	$('.n-title').html(date.title)
	  }
	});
	function upLoad(){
		alert(editor.txt.html())
	}
});

