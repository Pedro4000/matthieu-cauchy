<x-app-layout> 
    <div class="py-6 w-auto">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg h-100" >
                <div class="bg-white border-b border-gray-200 container">
                  <div id="business-container">
                    <form action="/admin/business/upload" id="business-photo-upload" class="dropzone">
                        @csrf
                    </form>

                    <div id="business-photo-container" class="sortable-container">
                        @foreach($photos as $photo)
                        <div class="photo-slot" data-filename={{ $photo->filename }}>
                            <img src="{{ asset('storage/business-photos/' . $photo->filename) }}" class="list-photo" alt="Saved Photo" data-order="{{ $photo->order }}" data-id="{{ $photo->id }}">
                            <div class="delete-photo" data-filename="{{ $photo->filename }}" data-action='admin/business/delete'><i class="fa fa-trash" aria-hidden="true" ></i></div>
                            <div class="cover-site" data-filename="{{ $photo->filename }}" data-action='admin/business/cover'><i class="fa fa-images" aria-hidden="true" ></i></div>
                        </div>
                        @endforeach
                    </div>

                    <button id="saveOrder" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
     @endpush
</x-app-layout>
