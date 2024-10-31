<x-app-layout>    
    <div class="py-6 w-auto">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                  <a href='{{ route('admin.album.create')}}'>
                  <button class="bg-transparent hover:text-black text-gray-400 font-semibold py-2 px-4 border border-gray-200 mb-2 hover:border-transparent rounded">
                    + ajouter
                  </button>
                  <hr>
                  </a>
                  <table class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
                        <th class='w-1/12 p-2'>nom</th>
                        <th class='w-1/12 p-2'>photos</th>
                        <th class='w-1/12 p-2'>modifier</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($albums as $album)
                          <tr>
                            <td class="p-2">{{ $album->name }}</td>
                            <td class="p-2"><a href="{{ route('admin.photo.index', ['album_id' => $album->id] ) }}">
                              <img class='apercu' src="{{ asset('storage/photos/' . ($albumCoversIndexedByAlbumId[$album->id]->filename ?? '')) }}" style="min-height:30px" alt='empty'></a></td>
                            <td class="p-2"><a href="{{ route('admin.album.edit', ['id' => $album->id] ) }}"><i class="fas fa-edit text-lg" ></i></a></td>
                          </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
