<x-app-layout>    
    <div class="py-5 w-auto">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="w-full ">
                        <form method="post" action="{{ route('admin.a_propos.store') }}">
                          @csrf

                          @php $champ = 'langue' @endphp
                          <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="{{ $champ }}">
                              langue
                            </label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="{{ $champ }}" type="text" value="" name="{{ $champ }}">
                          </div>

                          <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="a_propos_editor">
                              texte
                            </label>
                            <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="textarea" name="a_propos_editor" id="a_propos_editor"></textarea>
                          </div>

                          <div class="flex items-center justify-between pb-4">
                            <div class="flex">
                              <a class="bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-2" href="{{ url()->previous() }}">annuler</a>          
                              <button class="bg-blue-400 hover:bg-blue-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-2" type="submit">
                                enregistrer
                              </button>
                            </div>
                            <div class="flex">                            
                            </div>
                          </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>

  $(document).ready(function() {

    ClassicEditor
        .create( document.querySelector( '#a_propos_editor' ) )
        .catch( error => {
            console.error( error );
        } );
  });

</script>
