$('#stage img').css('display', 'none');
$('#stage img').first().css('display', 'block');  

$(document).ready(function() {


    /********************************************
    *   Pour la diapo des images
    */


    var imagesArray = [];
    let images = $('#stage img');
    for(keys in images) {
        imagesArray[keys] = images[keys];
    }

    $('#stage img').css('display', 'none');
    $('#stage img').eq(1).css('display', 'block');      

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
              $('#stage img').eq(1).animate({
                opacity: "toggle",
              }, 50, "linear", function() {
                $('#stage img').first().remove();
                $('#stage img').css('display', 'none');
                $('#stage img').eq(1).css('display', 'block');                      
                //$('#stage img').append().remove();
                $('#stage').append(imagesArray.last()); 
              });                    
        }

        if (sens_carrousel == 'precedent') {
            lastElement = imagesArray.pop();
            imagesArray.unshift(lastElement);
              $('#stage img').eq(1).animate({
                opacity: "toggle",
              }, 50, "linear", function() {
                $('#stage img').css('display', 'none');
                $('#stage img').last().remove();
                $('#stage').prepend(imagesArray.first()); 
                $('#stage img').eq(1).css('display', 'block');                      
                //$('img').append().remove();
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
            $('.projects_div').removeClass('d-none');
            $('.projects_div').addClass('opaque');
            $('.projects_div').addClass('de-transparant-a-visible');
          }, 2000);         

    });



    /**********************************************************************
    *   Pour enregister le mass edit formulaire
    */

    $('#photo_mass_edit_cta').click(function(){
      $('#photo_mass_edit_form').submit();
    });



}); 