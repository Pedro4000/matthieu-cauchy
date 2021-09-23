<x-app-layout>    
    <div class="py-5 w-auto">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="w-full ">
                        <div class="mb-4">
                          <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                            nom de la photo
                          </label>
                          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" disabled value="{{ $photo->nom }}">
                        </div>

                        <div class="mb-4">
                          <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                            album
                          </label>
                          <input type='text' disabled value="{{ $photo->album->nom }}">
                          <p class="text-red-500 text-xs italic">.</p>
                        </div>
                        <div class="flex items-center justify-between mb-4">
                          <img class="photo-frame" src="{{ asset('storage/images/'.$photo->album->nom_route.'/'.$photo->nom_fichier) }}">
                        </div>

                        <div class="mb-4">
                          <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                            description
                          </label>                          
                          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="description" name="description" type="text" disabled value='{{ $photo->description }}'>
                        </div>

                        <div class="flex items-center justify-between">

                          <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                            edit
                          </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
