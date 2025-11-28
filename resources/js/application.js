$('#stage img').css('display', 'none');
$('#stage img').first().css('display', 'block');  

$(document).ready(function() {


    /********************************************
    *   Pour la diapo des images
    */


    var imagesArray = [];
    let images = $('#stage .slider_component');
    for(keys in images) {
        imagesArray[keys] = images[keys];
    }

    $('#stage .slider_component').css('display', 'none');
    $('#stage .slider_component').eq(1).css('display', 'block');      

    $('#stage').click(prochaineImage);
    $(document).keydown(prochaineImage);
    let autoChange = setInterval(prochaineImage, 10000, "suivante");
    var sens_carrousel = 'suivante';

    function prochaineImage (event) {

        if (event.which == 37) {
            sens_carrousel = 'precedent'
        }

        if (event.which  == 1 || event.which == 39){
            sens_carrousel = 'suivant';
        }

        if (!sens_carrousel || sens_carrousel == 'suivant') {
            console.log('ok');
            lastElement = imagesArray.shift();
            imagesArray.push(lastElement);
              $('#stage .slider_component').eq(1).animate({
                opacity: "toggle",
              }, 50, "linear", function() {
                $('#stage .slider_component').first().remove();
                $('#stage .slider_component').css('display', 'none');
                $('#stage .slider_component').eq(1).css('display', 'block');                      
                //$('#stage .slider_component').append().remove();
                $('#stage').append(imagesArray.last()); 
              });                    
        }

        if (sens_carrousel == 'precedent') {
            lastElement = imagesArray.pop();
            imagesArray.unshift(lastElement);
              $('#stage .slider_component').eq(1).animate({
                opacity: "toggle",
              }, 50, "linear", function() {
                $('#stage .slider_component').css('display', 'none');
                $('#stage .slider_component').last().remove();
                $('#stage').prepend(imagesArray.first()); 
                $('#stage .slider_component').eq(1).css('display', 'block');                      
                //$('.slider_component').append().remove();
              });                    
        }
    }


    /**********************************************************************
    *   Pour les effets de transition dans la homepage
    */

    $('.project_click_background').click(function(){
        $('body').addClass('bottom-right-class');

         setTimeout(function(){ 
            $('body').removeClass('bottom-right-class');
          }, 1000);

         setTimeout(function(){ 
            $('.projects_div').removeClass('hidden-away');
            $('.projects_div').addClass('opaque');
            $('.projects_div').addClass('de-transparant-a-visible');
          }, 2000);         

    });

    // Note: The main navigation logic with color changes is in public/js/application.js
    // This file is for album slideshow functionality

}); 