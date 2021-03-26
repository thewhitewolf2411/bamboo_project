$('.cms-blog').on('click', function(){

    var blogid = $(this).data('value');

    $.ajax({
        url: "/portal/getblogcontent",
        type:"GET",
        data:{
            blogid:blogid,
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success:function(response){
            console.log(response);

            $('#blog_type').html(response.blog_type);
            $('#blog_author').html(response.author);
            $('#blog_title').html(response.blog_title);
            $('#blog_created').html(response.created);
            $('#blog_modified').html(response.updated);

            $('#image_1').prop('src', "/storage/news_images/" + response.image_1);
            $('#image_2').prop('src', "/storage/news_images/" + response.image_2);
            $('#image_3').prop('src', "/storage/news_images/" + response.image_3);

            $('#parag_1').html(response.parag_1);
            $('#parag_2').html(response.parag_2);
            $('#parag_3').html(response.parag_3);

            $('#deleteblog').attr('data-value', response.blog_id);
            $('#editblog').attr('href', '/portal/edit/' + response.blog_id)

            $('#blogModal').modal('show');
        }
    });

});

$('#deleteblog').on('click', function(){

    var blogid = $(this).data('value');

    var c = confirm('Are you sure you want to remove this CMS Content?');

    if(c){
        $.ajax({
            url: "/portal/cms/delete",
            type:"POST",
            data:{
                blogid:blogid,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(){
                alert('Blog was succesfully deleted');
                location.reload();
            }
        });
    }

});