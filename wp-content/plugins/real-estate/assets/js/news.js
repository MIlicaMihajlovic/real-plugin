//jQuery for load more

jQuery(function($){

	//wrapper for posts
	let $wrapper = $('.js-news-wrapper');
	//always use class and must have js- prefix
	let $button = $('.js-load-more-btn');

	let ppp = $button.data('ppp');
	let current = ppp;
	let page = 1;


	$button.on('click',function(event) {

		let _self = $(this);

		if (_self.hasClass('disabled')) {
			return;
		}

		_self.addClass('disabled');

		event.preventDefault();

		$.ajax({
			datatype: 'json',
			type: 'post',
			url : news_loadmore_params.ajaxurl,
			data: {
				action: 'loadmore_news_ajax',
				posts_per_page: ppp,
				current_posts: current,
				page: page
			},
			success : function( response ){
				current = current + ppp;
				page ++;

				console.log(response.data);

				$wrapper.append($(response.data.html).hide().fadeIn());

				if (response.data.has_more) {
					_self.removeClass('disabled');
				} else {
					_self.fadeOut();
				}
			},
			error: function (error) {
				console.log(error);
			}
		});
	});
});
