<x-app-layout>    
    <div class="py-6 w-auto">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href='{{ route('admin.a_propos.create')}}'>
                    <button class="bg-transparent hover:bg-gray-200 text-gray-400 font-semibold hover:text-white py-2 px-4 border border-gray-200 hover:border-transparent rounded mb-2">
                    + ajouter
                    </button>
                    <hr>
                    </a>
                    <table class="list-table table-auto photo-index-table text-left mt-2 border border-gray-200">
                    <thead>
                        <tr>
                        <th class='w-1/12 p-2'>langue</th>
                        <th class='w-1/12 p-2'>modifier</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($aproposTous as $apropos)                      
                            <tr>
                            <td class="p-2">{{ $apropos->langue }}</td>
                            <td class="p-2"><a href="{{ route('admin.a_propos.edit', ['id' => $apropos->id] ) }}"><i class="fas fa-edit text-lg" ></i></a></td>
                            </tr>                    
                        @endforeach
                    </tbody>
                    </table>                
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
