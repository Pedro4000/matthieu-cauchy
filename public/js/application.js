$('#stage img').css('display', 'none');
$('#stage img').first().css('display', 'block');  

$(document).ready(function() {

    var imagesArray = [];
    let images = $('img');
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


}); 