//Making ajax call

(function ($) {
    //when user submit data, passing form id
    $('#cf').on('submit', function (e) {

        //prevent to reload page
        e.preventDefault();

        //get data and put in variable
        let post_title = $('#post_title').val();
        //let subtitle = $('#subtitle').val();

        //submit data
        $.ajax({
            datatype: 'json',
            //object
            url: real_estate.ajaxurl,
            data: {
                //action from main php file
                action: 'prefix_cf',
                post_id: $(this).data('post-id'),
                post_title: post_title,
                //subtitle: subtitle
            },
            //receives response
            success: function (data) {
                //just checking display response
                $('.site-main > div > h3').text(post_title);

            },
            error: function (error) {
                console.log(error);
            }
        })
    })
})(jQuery);



