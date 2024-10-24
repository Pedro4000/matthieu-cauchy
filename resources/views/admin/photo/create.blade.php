<x-app-layout>
    <div class="py-5 w-auto">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="w-full ">
                      <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4"  method="post" action="{{ route('admin.photo.store') }}" enctype="multipart/form-data">
                        @csrf
                      <div class="mb-4">
                          <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                            nom de la photo
                          </label>
                          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="" name="nom">
                        </div>
                        <div class="mb-4">
                          <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                            album
                          </label>
                          <select name='album'>
                            @foreach($albums as $album)
                              <option value='{{ $album->id }}'>{{ $album->nom }}</option>
                            @endforeach
                          </select>
                          <p class="text-red-500 text-xs italic">.</p>
                        </div>
                        <div class="flex items-center justify-between mb-4">
                          <input type="file" name="file" id="file" class="" accept="jpg, jpeg, png"/>
                        </div>
                        <div class="flex items-center justify-between">
                          <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                            ajouter
                          </button>
                        </div>
                      </form>
                      <p class="text-center text-gray-500 text-xs">
                      </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
