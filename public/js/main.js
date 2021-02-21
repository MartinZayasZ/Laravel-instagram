var url = 'http://cursos.local.com';

window.addEventListener('load', function(){

    $('.btn-like').css('cursor', 'pointer');
    $('.btn-dislike').css('cursor', 'pointer');

    function like(){
        //like function
        $('.btn-like').unbind('click').click(function(){
            $(this).addClass('btn-dislike').removeClass('btn-like');
            $(this).attr('src',url+'/img/hearts-red.ico');

            $.ajax({
                'type': 'GET',
                'url': `${url}/like/` + $(this).data('id'),
                success:function(response){
                    console.log(response);
                }
            });

            dislike();
        });
    }
    like();

    function dislike(){
        //dislike function
        $('.btn-dislike').unbind('click').click(function(){
            $(this).addClass('btn-like').removeClass('btn-dislike');
            $(this).attr('src',url+'/img/hearts-gray.ico');

            $.ajax({
                'type': 'GET',
                'url': `${url}/dislike/` + $(this).data('id'),
                success:function(response){
                    console.log(response);
                }
            });

            like();
        });
    }
    dislike();

});
