/**
 * Created by jrey on 06/03/2017.
 */
var clicked = false;
$('div[class*="pag-"]').on('click touchstart', function(){

    if(clicked==false){

        clicked=true;

        var elem = $(this);

        // hay que cambiar los z-index
        if(elem.hasClass('pag_clicked')){// pag abierta

            // si está abirta le ponemos index rápidamente
            elem.css('z-index', elem.attr('data-zindexclosed')).toggleClass('pag_clicked');
            clicked=false;

        }else{// pagina cerrada

            // si está cerrada esperamos animación hasta poner index
            elem.toggleClass('pag_clicked');
            setTimeout(function(){
                elem.css('z-index', elem.attr('data-zindexopen'));
                clicked=false;
            }, 1500);

        }

    }// fin if clicked


});