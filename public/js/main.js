window.addEventListener('load', function(){
	//like button
	function like() {
		$('.btn-like').unbind('click').click(function(){
			console.log('like');
			$(this).addClass('btn-danger').removeClass('btn-outline-danger');
			dislike();
		});
	}
	like();

	//like button
	function dislike() {
		$('.btn-like').unbind('click').click(function(){
			console.log('dislike');
			$(this).addClass('btn-outline-danger').removeClass('btn-danger');
			like();
		});
	}
	dislike();
});