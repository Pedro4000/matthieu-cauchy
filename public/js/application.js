$('img').css('display', 'none');
$('img').first().css('display', 'block');  

$(document).ready(function() {


    var imagesArray = [];
    let images = $('img');
    for(keys in images) {
        imagesArray[keys] = images[keys];
    }

    $('img').css('display', 'none');
    $('img').first().css('display', 'block');                      

    $('#stage').click({param1: "suivante"}, prochaineImage);
    $(document).keydown(prochaineImage);
    let autoChange = setInterval(prochaineImage, 10000, "suivante");

    function prochaineImage (event) {

        if (typeof event.which == 39) {
            event = []
            event.data = [];
            event.data.param1 = 'suivante';
        }
        if (typeof event.which == 37) {
            event = []
            event.data = [];
            event.data.param1 = 'suivante';
        }

        if (event == 'suivante'){
            event = []
            event.data = [];
            event.data.param1 = 'suivante';
        }
        if (event.data.param1 == 'suivante') {
            lastElement = imagesArray.shift();
            imagesArray.push(lastElement);
              $('img').first().animate({
                opacity: "toggle",
              }, 50, "linear", function() {
                $('img').first().remove();
                $('img').css('display', 'none');
                $('img').first().css('display', 'block');                      
                //$('img').append().remove();
                $('#stage').append(imagesArray.last()); 
              });                    
        }
        if (event == 'precedente'){
            event = []
            event.data = [];
            event.data.param1 = 'precedente';
        }
        if (event.data.param1 == 'precedente') {
            lastElement = imagesArray.shift();
            imagesArray.push(lastElement);
              $('img').first().animate({
                opacity: "toggle",
              }, 50, "linear", function() {
                $('img').first().remove();
                $('img').css('display', 'none');
                $('img').first().css('display', 'block');                      
                //$('img').append().remove();
                $('#stage').append(imagesArray.last()); 
              });                    
        }
    }


}); 