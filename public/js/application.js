$(document).ready(function() {


    var imagesArray = [];
    let images = $('img');
    for(keys in images) {
        imagesArray[keys] = images[keys];
    }

    $('#stage').click({param1: "suivante"}, prochaineImage);
    window.setInterval(prochaineImage('suivante'), 2000);

    function prochaineImage (event) {
        if (event == 'suivante'){
            event.data.param1 = 'suivante';
        }
        if (event.data.param1 == 'suivante') {
            lastElement = imagesArray.shift();
            imagesArray.push(lastElement);
            $('img').first().remove();                     
            //$('img').append().remove();
            $('#stage').append(imagesArray.last());                     
        }
    }


}); 