<x-app-layout>    
    <div class="py-5 w-auto">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="w-full ">
                      <form method="post" action="{{ route('admin.album.store') }}">
                        @csrf
                          <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="album_nom">
                              nom de l'album
                            </label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="album_nom" type="text" name="nom">
                          </div>

                          <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="album_route">
                              nom de la route (sans espaces avec des - pour a la place)
                            </label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="album_route" type="text" name="nom_route">
                          </div>


                          <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                              type
                            </label>
                            <select name='type'>
                              @foreach($types as $type)
                                <option value='{{ $type->id }}'>{{ $type->nom }}</option>
                              @endforeach
                            </select>
                            <p class="text-red-500 text-xs italic">.</p>
                          </div>

                          <div class="flex items-center justify-between pb-4 w-1/2">
                            <button class="bg-blue-400 hover:bg-blue-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                              enregistrer
                            </button>
                          </div>
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
