<x-app-layout>    
    <div class="py-6 w-auto">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                <a href='{{ route('admin.type.create')}}'>
                <button class="bg-transparent hover:bg-gray-200 text-gray-400 font-semibold hover:text-white py-2 px-4 border border-gray-200 mb-2 hover:border-transparent rounded">
                  + ajouter
                </button>
                <hr>
                </a>
                <table class="table-auto photo-index-table text-left border border-gray-200 mt-2">
                  <thead>
                    <tr>
                      <th class='w-1/12 p-2'>nom</th>
                      <th class='w-1/12 p-2'>description</th>
                      <th class='w-1/12 p-2'>modifier</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($types as $type)                      
                        <tr>
                          <td class="p-2">{{ $type->nom }}</td>
                          <td class="p-2">{{ $type->description }}</td>
                          <td class="p-2"><a href="{{ route('admin.type.edit', ['id' => $type->id] ) }}"><i class="fas fa-edit text-lg" ></i></a></td>
                        </tr>                    
                    @endforeach
                  </tbody>
                </table>

                
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
