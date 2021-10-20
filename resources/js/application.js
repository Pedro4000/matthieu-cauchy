$('img').css('display', 'none');
$('img').first().css('display', 'block');  

$(document).ready(function() {


    var imagesArray = [];
    let images = $('img');
    for(keys in images) {
        imagesArray[keys] = images[keys];
    }

    $('img').css('display', 'none');
    $('img').eq(1).css('display', 'block');      

    $('#stage').click(prochaineImage);
    $(document).keydown(prochaineImage);
    let autoChange = setInterval(prochaineImage, 10000, "suivante");

    function prochaineImage (event) {

        if (event.which == 37) {
            sens_carrousel = 'precedent'
        }

        if (event.which  == 1 || event.which == 39){
            sens_carrousel = 'suivant';
        }

        if (sens_carrousel == 'suivant') {
            console.log('ok');
            lastElement = imagesArray.shift();
            imagesArray.push(lastElement);
              $('img').eq(1).animate({
                opacity: "toggle",
              }, 50, "linear", function() {
                $('img').first().remove();
                $('img').css('display', 'none');
                $('img').eq(1).css('display', 'block');                      
                //$('img').append().remove();
                $('#stage').append(imagesArray.last()); 
              });                    
        }

        if (sens_carrousel == 'precedent') {
            lastElement = imagesArray.pop();
            imagesArray.unshift(lastElement);
              $('img').eq(1).animate({
                opacity: "toggle",
              }, 50, "linear", function() {
                $('img').css('display', 'none');
                $('img').last().remove();
                $('#stage').prepend(imagesArray.first()); 
                $('img').eq(1).css('display', 'block');                      
                //$('img').append().remove();
              });                    
        }
    }

    console.log('ok');

}); 