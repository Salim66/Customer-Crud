(function($){
    $(document).ready( function() {

        // Profile photo upload
        $(document).on('change', '#profile_photo', function(event){
            let image_url = URL.createObjectURL(event.target.files[0]);
            $('#profile_photo_load').attr('src', image_url);
        });

        // customer information show
        $(document).on('click', '#show_customer', function(e){
            e.preventDefault();
            let id = $(this).attr('data-id');
            
            $.ajax({
                header: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                },
                type: 'GET',
                url: '/customers/view/'+id,
                success: function(data){
                    $('#customer_details_modal img').attr('src', '/uploads/customers/'+data.profile_photo);
                    $('#customer_details_modal .name').html(data.name);
                    $('#customer_details_modal .email').html(data.email);
                    $('#customer_details_modal .phone').html(data.phone);
                    $('#customer_details_modal .gender').html(data.gender);
                    $('#customer_details_modal').modal('show');
                }
            });
        });

        //user status update
        $('.status_customer').change(function (event) { 
            let id = $(this).attr('data-id');
            
            //Input checkbox checked or uncheck under jquery prop() function
            if($(this).prop('checked') == true){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                    },
                    type: "POST",
                    url: '/customers/status',
                    data: {id: id, status: 1},
                    success: function(data) {
                       console.log(data);
                    }
                });
            }else {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                    },
                    type: "POST",
                    url: '/customers/status',
                    data: {id: id, status: 0},
                    success: function(data) {
                        console.log(data);
                    }
                });
            }
        });


    });
})(jQuery);