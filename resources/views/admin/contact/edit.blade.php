<x-app-layout> 
    <div class="py-6 w-auto">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg h-100" >
                <div class="bg-white border-b border-gray-200 container">
                <h1>Edit Contact Page</h1>

                @if(session('success'))
                    <p style="color: green;">{{ session('success') }}</p>
                @endif
            
                <form action="{{ route('admin.contact.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <textarea id="editor" name="content">{{ old('content', $contact->content) }}</textarea>
            
                    <button class="bg-blue-400 hover:bg-blue-500 text-white font-bold py-2 px-4 my-3 rounded focus:outline-none focus:shadow-outline mr-2" type="submit">
                        enregistrer
                      </button>
                </form>
            
                <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
                <script>
                    CKEDITOR.replace('editor', {
                        filebrowserUploadUrl: "{{ route('admin.contact.upload-image') . '?_token=' . csrf_token() }}",
                        filebrowserImageBrowseUrl: '/storage/public/uploads',
                        filebrowserUploadMethod: 'form',
                        height: window.innerHeight - 400 // Adjust height dynamically
                    });
                </script>
            </div>
        </div>
    </div>
    @push('scripts')
     @endpush
</x-app-layout>
