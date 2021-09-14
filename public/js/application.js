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
    $(document).keydown({param1: "suivante"}, prochaineImage);
    var intervalId = setInterval(prochaineImage('suivante'), 2000);

    function prochaineImage (event) {
        console.log(event.which);
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
              }, 300, "linear", function() {
                $('img').first().remove();
                $('img').css('display', 'none');
                $('img').first().css('display', 'block');                      
                //$('img').append().remove();
                $('#stage').append(imagesArray.last()); 
              });                    
        }
    }


}); 