<x-app-layout>    
    <div class="py-12 w-auto">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                <a href='{{ route('admin.photo.create')}}'>
                <button class="bg-transparent hover:bg-gray-200 text-gray-400 font-semibold hover:text-white py-2 px-4 border border-gray-200 hover:border-transparent rounded">
                  + ajouter
                </button>
                </a>
                <table class="table-auto">
                  <thead>
                    <tr>
                      <th class='w-1/6'>nom</th>
                      <th class='w-1/6'>album</th>
                      <th class='w-1/6'>nom du fichier</th>
                      <th class='w-1/6'>couverture</th>
                      <th class='w-1/6'>description</th>
                      <th class='w-1/6 text-center'>apercu</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($photos as $photo)                      
                        <tr>
                          <td><a href="{{ route('admin.photo.show', [ 'id' => $photo->id ] ) }}">{{ $photo->nom }}</a></td>
                          <td>{{ $photo->album->nom }}</td>
                          <td>{{ $photo->nom_fichier }}</td>
                          <td>{{ $photo->couverture }}</td>
                          <td>{{ $photo->description }}</td>
                          <td ><a href="{{ route('admin.photo.show', [ 'id' => $photo->id ] ) }}"><img class='apercu' src="{{ asset('storage/images/'.$photo->album->nom_route.'/'.$photo->nom_fichier) }}"></a></td>
                        </tr>                    
                    @endforeach
                  </tbody>
                </table>
                <div class='pt-4'>
                  {{ $photos->links() }}                  
                </div>

                     
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
