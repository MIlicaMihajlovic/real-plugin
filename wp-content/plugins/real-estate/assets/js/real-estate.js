//ajax call

//pozivamo akciju i passujemo vrednosti

(function($) {
    $(document).ready(function() {

        //when user submit data, passing id
        $('#cf').on('submit', function(event) {

        //prevent to reload page
        event.preventDefault();

        //url do back-a

        //submit data
          $.ajax({
            type: 'POST',
            datatype: 'json',
            url: '../../real-estate.php', //var ajaxurl = 'http://'+window.location.host+'/wp-admin/admin-ajax.php';
            data: {
                action: 'prefix_cf'

            }
        })
    })
  })
});



