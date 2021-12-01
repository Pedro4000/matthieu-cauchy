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
                  <div class='pt-4'>
                    {{ $photos->links() }}                  
                  </div>
                  <table class="table-auto photo-index-table">
                    <thead>
                      <tr>
                        <th class='w-1/6'>nom</th>
                        <th class='w-1/12'>album</th>
                        <th class='w-1/6'>nom du fichier</th>
                        <th class='w-1/6'>description</th>
                        <th class='w-1/12'>ordre</th>
                        <th class='w-1/12'>accueil</th>
                        <th class='w-1/12'>couverture</th>
                        <th class='w-1/6 text-center'>apercu</th>
                      </tr>
                    </thead>
                    <tbody>
                      <form method="POST" action="{{ route('admin.photo.mass_edit') }}" id="photo_mass_edit_form">
                        @csrf
                        @foreach($photos as $photo)                      
                          <tr>
                            <td><a href="{{ route('admin.photo.show', [ 'id' => $photo->id ] ) }}">{{ $photo->nom }}</a>
                            </td>
                            
                            <td>{{ $photo->album->nom }}
                            </td>
                            
                            <td>{{ $photo->nom_fichier }}
                            </td>
                            
                            <td>{{ $photo->description }}
                            </td>
                            
                            <td>
                              <select class='appearance-none text-xs pl-0 pr-4' name="{{ 'ordrePhoto_'.$photo->id }}">
                                  <option value="0">0</option>
                                @for ($i = 1; $i <= $photo->nombre_photos; $i ++)
                                  <option value="{{ $i }}" {{ $photo->ordre == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                              </select>
                            </td>


                            <td>
                              <select class='appearance-none text-xs pl-0 pr-5' name="{{ 'accueil_'.$photo->id }}">
                                <option value='0' {{ $photo->accueil == 0 ? 'selected' : '' }}>non</option>
                                <option value='1' {{ $photo->accueil == 1 ? 'selected' : '' }}>oui</option>
                              </select>
                            </td>

                            <td>
                              <select class='appearance-none text-xs pl-0 pr-5' name="{{ 'couverture_'.$photo->id }}">
                                <option value='0' {{ $photo->couverture == 0 ? 'selected' : '' }}>non</option>
                                <option value='1' {{ $photo->couverture == 1 ? 'selected' : '' }}>oui</option>
                              </select>
                            </td>
                            
                            <td class='text-center'><a href="{{ route('admin.photo.show', [ 'id' => $photo->id ] ) }}"><img class='apercu' style='display:inline' src="{{ asset('storage/images/'.$photo->album->type->nom.'/'.$photo->album->nom_route.'/'.$photo->nom_fichier) }}"></a>
                            </td>
                          </tr>                    
                        @endforeach
                      </form>
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
