<x-app-layout>    
    <div class="py-6 w-auto">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                <a href='{{ route('admin.album.create')}}'>
                <button class="bg-transparent hover:bg-gray-200 text-gray-400 font-semibold hover:text-white py-2 px-4 border border-gray-200 hover:border-transparent rounded">
                  + ajouter
                </button>
                </a>
                <table class="table-auto photo-index-table">
                  <thead>
                    <tr>
                      <th class='w-1/12'>nom</th>
                      <th class='w-1/12'>nom route</th>
                      <th class='w-1/12'>type</th>
                      <th class='w-1/12'>photos</th>
                      <th class='w-1/12'>modifier</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($albums as $album)                      
                        <tr>
                          <td>{{ $album->nom }}</td>
                          <td>{{ $album->nom_route }}</td>
                          <td>{{ $album->type->nom }}</td>
                          <td><a href="{{ route('admin.photo.index', ['album_id' => $album->id] ) }}"><img class='apercu' src="{{ count($album->photos) > 0 ? asset('storage/images/'.$album->type->nom.'/'.$album->nom_route.'/'.$album->photos->first()->nom_fichier) : '' }}"></a></td>
                          <td><a href="{{ route('admin.album.edit', ['id' => $album->id] ) }}"><i class="fas fa-edit text-lg" ></i></a></td>
                        </tr>                    
                    @endforeach
                  </tbody>
                </table>

                
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
