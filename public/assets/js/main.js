$( document ).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#add_comment").click(function(){
        var comment_data = $('#add_new_comment').val();
        var post = $(this).attr('data-post');
        var author_name = $('.logged_user_info').attr('data-name');
        var author_image = $('.logged_user_info').attr('data-image');

        if (comment_data.length > 1){
            jQuery.post("/api/post_comments/",
                {
                    data: comment_data,
                    post: post,
                },
                function(data,status){
                    if ( data === 'success' && status === 'success' ){
                        $('.new_comments')
                            .append("<div class='blog-comment'>"+
                                "<img src='"+ author_image +"'>"+
                                "<a>"+ author_name +"</a>"+
                                "<p>"+ comment_data +"</p>"+
                                "<div class='clear'></div>"+
                                "</div>");

                        $('#add_new_comment').val('');
                    }
                });
        }
    });
});