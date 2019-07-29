//Ajax call

(function ($) {
    //when user submit data, passing form id
    $('#cf').on('submit', function (e) {

        //prevent to reload page
        e.preventDefault();

        //get data and put in variable
        let post_title = $('#post_title').val();
        let subtitle = $('#subtitle').val();
        let location = $('#taxonomy-location').val();
        let type = $('#taxonomy-type').val();


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
                subtitle: subtitle,
                location: location,
                type: type,
                _wpnonce: $('#wpnonce').val()
            },
            //receives response
            success: function (response) {
                $('.entry-header > h1').text(response.data.post_title);
                $('.title-post > h3').text(response.data.subtitle);
                $('.js-location-terms-wrapper').html(response.data.location_link);
                $('.js-type-terms-wrapper').html(response.data.type_link);
            },
            error: function (error) {
                console.log(error);
            }
        })
    })
})(jQuery);



