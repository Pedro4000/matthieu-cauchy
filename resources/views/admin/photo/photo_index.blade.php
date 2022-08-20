<x-app-layout>    
    <div class="py-6 w-auto">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 container">
                  <div class="flex justify-between">
                    <div class="inline-block">
                      <a href="{{ route('admin.photo.create')}}" class="text-danger">
                        <button class="bg-transparent hover:bg-gray-200 text-gray-400 font-semibold hover:text-white py-2 px-4 border border-gray-200 hover:border-transparent rounded">
                          + ajouter
                        </button>
                      </a>
                    </div>

                    <div class="inline-block">
                      <button id="photo_mass_edit_cta" class="bg-transparent hover:bg-green-200 text-green-400 font-semibold hover:text-white py-2 px-4 border border-green-200 hover:border-transparent rounded" >
                        enregister
                      </button>
                    </div>
                    
                  </div>
                  <form method="POST" action="{{ route('admin.photo.mass_edit') }}" id="photo_mass_edit_form">
                    @csrf
                    <div class='grid grid-cols-2 lg:grid-cols-6 mt-2 dropzone'>
                      @php 
                        $i = 0;
                        $ordre = 1;
                      @endphp
                      @foreach ($photos as $photo) 
                        <div class="flex flex-col items-center bloc_photo_pour_ordre relative">
                          <div class="absolute w-full h-full flex">
                            <span class='w-1/2 h-full drag-left span-photo-order' data-number="{{ $i }}">
                            </span>
                            @php $i++ @endphp
                            <span class='w-1/2 h-full drag-right span-photo-order' data-number="{{ $i }}">
                            </span>     
                            @php $i++ @endphp                 
                          </div>
                          <a draggable="true" href="{{ route('admin.photo.edit', ['id' => $photo->id]) }}" class='photo-link-box'>
                            <i class="fa-solid fa-xmark absolute"></i>
                            <img src="{{ asset('storage/images/'.$photo->album->type->nom.'/'.$photo->album->nom_route.'/'.$photo->nom_fichier) }}" class="bg-center h-100 photo-thumb">
                          </a>
                          <div class="flex justify-around my-2">
                            <div class="flex flex-col">
                              <input type="checkbox" name="{{ 'couverture_'.$photo->id }}" id="{{ 'couverture_'.$photo->id }}" class="">
                              <label class="form-check-label inline-block text-gray-800" for="{{ 'couverture_'.$photo->id }}" aria-describedby="label">
                                Couverture
                              </label>
                              <input type="checkbox" name="{{ 'accueil'.$photo->id }}" id="{{ 'accueil'.$photo->id }}" class="">
                              <label class="form-check-label inline-block text-gray-800 " for="{{ 'accueil'.$photo->id }}" aria-describedby="label">
                                Accueil
                              </label>
                              <input class="ordrePhotoInput" name="{{ 'ordre_'.$photo->id }}" id="{{ 'ordre_'.$photo->id }}" value="{{ $ordre }}" class="">
                            </div>
                          </div>
                        </div>
                        @php 
                          $ordre++;
                        @endphp
                      @endforeach
                    </div>
                  </form>
                  
                </div>
            </div>
        </div>
    </div>
  
  @push('scripts')
    <script>
  
      $(document).ready(function() {

        let x = 0;
        let y = 0;
        var element = false;
        var numeroSpan;
        var blocPris;

        $(".photo-thumb").on('mousedown', function(e) {
          blocPris = $(this).closest('.bloc_photo_pour_ordre');
        });
        
        $(".dropzone").on('drop', function(e) {
          e.preventDefault();  
          $('.span-photo-order').css('z-index', '2');
          x = event.pageX;
          y = event.pageY;
          element = document.elementFromPoint(x, y);
          if(element.dataset) {
            numeroSpan = element.dataset.number;
            blocWhereDrop = $('span[data-number="'+numeroSpan+'"]').closest('.bloc_photo_pour_ordre');
  
            if (numeroSpan % 2) {
              blocPris.insertAfter(blocWhereDrop)
            } else if (numeroSpan % 2 == 0) {
              blocPris.insertBefore(blocWhereDrop)
            }
          }
          $('.span-photo-order').css('z-index', '-1');
          $('.ordrePhotoInput').each(function(){
            var ordre = 1;
            $(this).val(ordre);
            ordre++;
            console.log($(this).val());
          });
          // il faut actualiser l ordre des photos
        });

        $(".dropzone").on('dragover', function(e) {
          e.preventDefault();  
        });      
        
      });

    </script>
  @endpush
</x-app-layout>
