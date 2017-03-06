/**
 * Created by jrey on 06/03/2017.
 */

$('.portada').on('click', function(){

    $(this).toggleClass('portada_clicked');

    /*
    var open = $(this).attr('data-open');
    console.log(open);
    if(open==false){
        $(this).addClass('portada_clicked');
        $(this).attr('data-open',true);
    }else{
        $(this).removeClass('portada_clicked');
        $(this).attr('data-open',false);
    }
    */

});