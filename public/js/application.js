$('#stage img').css('display', 'none');
$('#stage img').first().css('display', 'block');  

$(document).ready(function() {

      
    /**********************************************************************
    *   fonction pour detecter le swipe en vanilla js
    */

     document.addEventListener('touchstart', handleTouchStart, false);        
     document.addEventListener('touchmove', handleTouchMove, false);
     
     var xDown = null;                                                        
     var yDown = null;
     
     function getTouches(evt) {
       return evt.touches ||             // browser API
              evt.originalEvent.touches; // jQuery
     }                                                     
                                                                              
     function handleTouchStart(evt) {
         const firstTouch = getTouches(evt)[0];                                      
         xDown = firstTouch.clientX;                                      
         yDown = firstTouch.clientY;                                      
     };                                                
                                                                              
     function handleTouchMove(evt) {
         if ( ! xDown || ! yDown ) {
             return;
         }
     
         var xUp = evt.touches[0].clientX;                                    
         var yUp = evt.touches[0].clientY;
         var swipe;
     
         var xDiff = xDown - xUp;
         var yDiff = yDown - yUp;
                                                                              
         if ( Math.abs( xDiff ) > Math.abs( yDiff ) ) {/*most significant*/
             if ( xDiff > 0 ) {
              swipe = {which : 1};
              $('#stage').click(prochaineImage.call(this, swipe)); 
            } else {
              swipe = {which : 37};
              $('#stage').click(prochaineImage.call(this, swipe));
             }                       
         } else {
             if ( yDiff > 0 ) {
                 /* down swipe */ 
             } else { 
                 /* up swipe */
             }                                                                 
         }
         /* reset values */
         xDown = null;
         yDown = null;                                             
     };

    /********************************************
    *   Pour la diapo des images
    */

    var imagesArray = [];
    let images = $('#stage .slider_component');
    for(keys in images) {
        imagesArray[keys] = images[keys];
    }

    $('#stage .slider_component').css('display', 'none');
    $('#stage .slider_component').eq(0).css('display', 'block');      

    $('#stage').click(prochaineImage);
    $(document).keydown(prochaineImage);
    
    //let autoChange = setInterval(prochaineImage, 16000, "suivante");
    var sens_carrousel = 'suivante';

    function prochaineImage (event) {

      if (event.which == 37) {
            sens_carrousel = 'precedent'
        }

        if (event.which  == 1 || event.which == 39){
            sens_carrousel = 'suivant';
        }

        if (!sens_carrousel || sens_carrousel == 'suivant') {
            lastElement = imagesArray.shift();
            imagesArray.push(lastElement);
              $('#stage .slider_component').eq(0).animate({
                opacity: "toggle",
              }, 50, "linear", function() {
                
                $('#stage .slider_component').first().remove();
                $('#stage .slider_component').css('display', 'none');
                $('#stage .slider_component').eq(0).css('display', 'block');                      
                $('#stage').append(imagesArray.last()); 
              });                    
        }

        if (sens_carrousel == 'precedent') {
            lastElement = imagesArray.pop();
            imagesArray.unshift(lastElement);
              $('#stage .slider_component').eq(0).animate({
                opacity: "toggle",
              }, 50, "linear", function() {
                $('#stage .slider_component').css('display', 'none');
                $('#stage .slider_component').last().remove();
                $('#stage').prepend(imagesArray.first()); 
                $('#stage .slider_component').eq(0).css('display', 'block');                      
              });                    
        }
    }


    /**********************************************************************
    *   Pour les effets de transition dans la homepage
    */

    var tableauCouleurFond = {
      'project_click_background' : 
      {
        couleur : 'pink',
        divPasLiees : '.contact_form_div, .a_propos_div',
        divLiee : '.projects_div',
      },
      'bio_click' : 
      {
        couleur : '#AFA59B',
        divPasLiees : '.contact_form_div, .projects_div',
        divLiee : '.a_propos_div',
      },
      'contact_click' : 
      {
        couleur : '#FFB612',
        divPasLiees : '.a_propos_div, .projects_div',
        divLiee : '.contact_form_div',
      },
    };

    var navItemClique = '';

    $('.project_click_background, .bio_click, .contact_click').click(function(){

        // la première fois, on cache l'image d'accueil
        $(".active").removeClass('active');
        $(this).addClass('active');
        if (!$('#stageAccueil').hasClass('opaque')) {
          $('#stageAccueil').addClass('opaque');
          setTimeout(function(){ 
            $('#stageAccueil').css('position', 'absolute');
            $('#stageAccueil').addClass('hidden-away');        
          }, 800);          
        }

        if ($(this).attr('class').match('project_click_background')) {
          navItemClique = 'project_click_background';
        } else if ($(this).attr('class').match('bio_click')) {
          navItemClique = 'bio_click';
        } else {
          navItemClique = 'contact_click';
        }

        // on cache et on affiche les bonnes div
        $(tableauCouleurFond[navItemClique].divPasLiees).addClass('opaque');
        $(tableauCouleurFond[navItemClique].divPasLiees).removeClass('de-transparant-a-visible');

        setTimeout(function(){ 

          $(tableauCouleurFond[navItemClique].divPasLiees).addClass('hidden-away');
          $(tableauCouleurFond[navItemClique].divLiee).removeClass('hidden-away opaque');                    
          $(tableauCouleurFond[navItemClique].divLiee).addClass('de-transparant-a-visible');     
          
          $('.premiere-galerie-lien').height($('.premiere-galerie-lien').width())
          $('.premiere_galerie').height($('.premiere_galerie').width())
        }, 800);    

      let couleurFond = $('body').css('background-image');
      let couleurGauche = couleurFond.split('to right, ')[1].split(' 50%')[0];
      let couleurDroite = couleurFond.split('to right, ')[1].split(' 50%')[1].substr(2);

      //$('body').css('background-image', 'linear-gradient(to right, #FFB612 50%, rgb(255, 255, 0) 50%)');


      if ($('body').hasClass('bottom-left-class')) {
        $('body').css('background-image', 'linear-gradient(to right, '+couleurGauche+' 50%, '+tableauCouleurFond[navItemClique].couleur+' 50%)');
      } else {
        $('body').css('background-image', 'linear-gradient(to right, '+tableauCouleurFond[navItemClique].couleur+' 50%, '+couleurDroite+' 50%)');
      }
      $('body').toggleClass('bottom-left-class');


        /* ici pour les liens des coucous mags
        $('.coucou_liens').removeClass('hidden-away');
        $('coucou_liens a').each(function(){
            hide($(this));
        })
        */

    });
  

    /**********************************************************************
    *   Pour enregister le mass edit formulaire
    */

    $('#photo_mass_edit_cta').click(function(){
      $('#photo_mass_edit_form').submit();
    });


    /**********************************************************************
    *   Pour l'affichage des liens vers les coucou mags
    */

    $('#coucou_image').click(function(){
        var i = 1;
        $('.coucou_liens').removeClass('hidden-away');
        $('.coucou_liens a').each(function(){
            reveal($(this), i);
            i++;
        });
        $("html, body").animate({ scrollTop: $(document).height() }, 1000);
    });

    function reveal (element, i) {
        setTimeout(function() { 
            element.removeClass('opaque');     
            element.addClass('de-transparant-a-visible');
        },i*500);
    };

    function hide (element) {
        element.addClass('opaque');     
        element.removeClass('de-transparant-a-visible');        
    }

    
    /**********************************************************************
    *   Pour le calcul de la hauteru du menu hamburger
    */

    $('.hamburger-click, .navhamburger > .pate-hamburger').click(function() {
      if ($('.navhamburger').hasClass('expanded')) {
        $('.hamburger-expand, .hamburger-shrink').toggleClass('hidden');
        $('.navhamburger').height(0);
      } else {
        $('.hamburger-expand, .hamburger-shrink').toggleClass('hidden');
        $('.navhamburger').height($(window).height()-$('header').height());
      }
      $('.navhamburger').toggleClass('expanded');
    })   

    /**********************************************************************
    *   Pour afficher la bonne langue de la bio
    */

    $('.a-propos-langue').click(function(){
      var nouvelleLangue = $(this).data('langue');
      $('.a-propos-langue').removeClass('hidden');
      $(this).addClass('hidden');
      $('.a-propos-texte').addClass('hidden');
      $(".a-propos-texte[data-langue='"+nouvelleLangue+"']").removeClass('hidden');
    });


}); 