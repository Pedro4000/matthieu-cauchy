<x-app-layout>    
    <div class="py-5 w-auto">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="w-full ">
                        <form method="post" action="{{ route('admin.album.update') }}">
                          @csrf
                          <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="album_nom">
                              nom de l'album
                            </label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="album_nom" type="text" value="{{ $album->nom }}" name="nom">
                            <input type="number" value="{{ $album->id }}" name="id" class="hidden"> 
                          </div>

                          <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="album_route">
                              nom de la route (ne pas toucher)
                            </label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="album_route" type="text" value="{{ $album->nom_route }}" name="nom_route" readonly>
                          </div>


                          <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                              type
                            </label>
                            <select name='type'>
                              @foreach($types as $type)
                                <option value='{{ $type->id }}' {{ !$album->type ? '' : ( $album->type->id == $type->id ? 'selected' :'') }}>{{ $type->nom }}</option>
                              @endforeach
                            </select>
                            <p class="text-red-500 text-xs italic">.</p>
                          </div>


                          <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                              description
                            </label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="description" type="text" value="{{ $album->description }}" name="description" >
                          </div>


                          <div class="flex items-center justify-between pb-4">
                            <div class="flex">
                              <a class="bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-2" href="{{ url()->previous() }}">annuler</a>          
                              <button class="bg-blue-400 hover:bg-blue-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-2" type="submit">
                                enregistrer
                              </button>
                            </div>
                            <div class="flex">
                              <button id="modalButton" type="button" class="bg-red-400 hover:bg-red-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-2">supprimer</button>                                
                            </div>
                          </div>

                        </form>
                        <div class="flex items-center justify-between w-1/2">
                        </div>
                      </div>
                    </div>
            </div>
          </div>

        <!-- Modal suppression -->
        <div id="myModal" class="modal">
          <div class="modal-content">
            <div class="modal-header">
              <h2>Attention</h2>
              <span class="close">&times;</span>
            </div>
            <div class="modal-body">
              <p class='m-2'>Confirmez vous la suppression, cela va supprimer toutes les photos de l'album ?</p>
              <div class="flex justify-end">
                <button type="button" class="fermer bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-2">annuler</button>   
                <form method="post" action="{{ route('admin.album.destroy') }}">
                @csrf
                  <input class="hidden" name="id" value="{{ $album->id }}">
                  <button class="bg-red-400 hover:bg-red-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    supprimer
                  </button>
                </form>
              </div>
            </div>
            {{--<div class="modal-footer">
              <h3></h3>
            </div>--}}
          </div>
        </div>            

        </div>
      </x-app-layout>
      