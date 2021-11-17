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
    let autoChange = setInterval(prochaineImage, 16000, "suivante");
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

        $('.contact_form_div').addClass('opaque');
        $('.contact_form_div').removeClass('de-transparant-a-visible');
        $('.a_propos_div').addClass('opaque');
        $('.a_propos_div').removeClass('de-transparant-a-visible');

       setTimeout(function(){ 
          $('body').removeClass('bottom-right-class');
          $('.contact_form_div').addClass('hidden-away');
          $('.a_propos_div').addClass('hidden-away');          
        }, 800);

       setTimeout(function(){ 
          $('.projects_div').removeClass('hidden-away');
          $('.projects_div').addClass('opaque');
          $('.projects_div').addClass('de-transparant-a-visible');
        }, 1600); 

        setTimeout(function(){ 
          $('.projects_div').removeClass('hidden-away');
          $('.projects_div').addClass('opaque');
          $('.projects_div').addClass('de-transparant-a-visible');
        }, 1600); 
    });


    $('.bio_click').click(function(){

        $('.contact_form_div').removeClass('de-transparant-a-visible');
        $('.contact_form_div').addClass('opaque');
        $('.projects_div').removeClass('de-transparant-a-visible');        
        $('.projects_div').addClass('opaque');
        
        setTimeout(function(){ 
          $('.contact_form_div').addClass('hidden-away');
          $('.projects_div').addClass('hidden-away');
          $('.a_propos_div').removeClass('hidden-away');                    
          $('.a_propos_div').removeClass('opaque');                    
          $('.a_propos_div').addClass('de-transparant-a-visible');                              
        }, 800);                

    });

    $('.contact_click').click(function(){

        $('.a_propos_div').removeClass('de-transparant-a-visible');
        $('.projects_div').removeClass('de-transparant-a-visible');        
        $('.a_propos_div').addClass('opaque');
        $('.projects_div').addClass('opaque');
        
        setTimeout(function(){ 
          $('.projects_div').addClass('hidden-away');
          $('.a_propos_div').addClass('hidden-away');
          $('.contact_form_div').removeClass('hidden-away');                    
          $('.contact_form_div').removeClass('opaque');                    
          $('.contact_form_div').addClass('de-transparant-a-visible');                              
        }, 800);                

    });


// contact_form_div
// a_propos_div


    /**********************************************************************
    *   Pour enregister le mass edit formulaire
    */

    $('#photo_mass_edit_cta').click(function(){
      $('#photo_mass_edit_form').submit();
    });

    console.log('ok');

}); 