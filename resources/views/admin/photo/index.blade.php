<x-app-layout>    
    <div class="py-6 w-auto">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 container">
                  <div class="flex justify-between mb-2">
                    <div class="inline-block">
                    </div>

                    <div class="inline-block">
                      <button id="photo_mass_edit_cta" class="bg-transparent hover:bg-green-200 text-green-400 font-semibold hover:text-white py-2 px-4 border border-green-200 hover:border-transparent rounded" >
                        enregister
                      </button>
                    </div>
                  </div>
                  <hr>
                  <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg h-100" >
                    <div class="bg-white border-b border-gray-200 container">
                      <div id="photo-container">
                        <form action="/admin/photo/upload" id="album-photo-upload" class="dropzone" data-album-id={{ $albumId }}>
                            @csrf
                        </form> 
                        <div id="album-photo-container" class="sortable-container" data-album-id={{ $albumId }}>
                            @foreach($photos as $photo)
                            <div class="photo-slot" data-filename={{ $photo->filename }}>
                                <img src="{{ asset('storage/photos/' . $photo->filename) }}" class="list-photo" alt="Saved Photo" data-order="{{ $photo->order }}" data-id="{{ $photo->id }}">
                                <div class="delete-photo" data-filename="{{ $photo->filename }}" data-action='admin/photo/delete'><i class="fa fa-trash" aria-hidden="true"></i></div>
                                <div class="cover-album" data-filename="{{ $photo->filename }}" data-action='admin/photo/cover-album'><i class="far fa-star" aria-hidden="true" ></i></div>
                                <div class="cover-site" data-filename="{{ $photo->filename }}" data-action='admin/photo/cover-site'><i class="fa fa-images" aria-hidden="true" ></i></div>
                            </div>
                            @endforeach
                        </div>
    
                        <button id="saveOrder" class="btn btn-primary">Save</button>
                    </div>
                </div>
                  
                </div>
            </div>
        </div>
    </div>
  
  @push('scripts')
    </script>
    </script>
  @endpush
</x-app-layout>
