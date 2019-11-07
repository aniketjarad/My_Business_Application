$(document).ready(function(){

	$('#url-form').on('submit', function (e) {
    e.preventDefault();
	$.ajax({
      type: 'post',
      url: BASE_URL+'shortner/save',
      data: $('#url-form').serialize(),
      success: function (res) {
        if (res.status == 'success') {  
        	$('#long_url').val('');
          $('#show').show();
          $('#short_url').html('<a href="'+BASE_URL+'shortner/decode/'+res.data+'">http://bit.ly/'+res.data+'</a>');
        }
      }
    });
  });
});
