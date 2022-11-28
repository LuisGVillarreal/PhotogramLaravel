var url = "http://photogram-laravel.com";
window.addEventListener('load', function(){
	//like button
	function like() {
		$('.btn-like').unbind('click').click(function(){
			console.log('like');
			$(this).addClass('btn-dislike').removeClass('btn-like');
			$(this).addClass('btn-danger').removeClass('btn-outline-danger');
			$.ajax({
				url: url+'/like/'+$(this).data('id'),
				type: 'GET',
				success: function(response) {
					if (response.like) {
						console.log('Has dado Like');
					}else{
						console.log('Error en Like');
					}
				}
			});
			dislike();
		});
	}
	like();

	//like button
	function dislike() {
		$('.btn-dislike').unbind('click').click(function(){
			console.log('dislike');
			$(this).addClass('btn-like').removeClass('btn-dislike');
			$(this).addClass('btn-outline-danger').removeClass('btn-danger');
			$.ajax({
				url: url+'/dislike/'+$(this).data('id'),
				type: 'GET',
				success: function(response) {
					if (response.like) {
						console.log('Has dado Dis-Like');
					}else{
						console.log('Error en Dis-Like');
					}
				}
			});
			like();
		});
	}
	dislike();
});