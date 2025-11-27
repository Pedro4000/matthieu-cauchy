<x-app-layout>    
    <div class="py-6 w-auto">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 container">
                  <div class="flex justify-between mb-2">
                    <div class="inline-block">
                      <h2 class="text-2xl font-bold">Commissions</h2>
                    </div>

                    <div class="inline-block">
                      <button id="commission_mass_edit_cta" class="bg-transparent hover:bg-green-200 text-green-400 font-semibold hover:text-white py-2 px-4 border border-green-200 hover:border-transparent rounded" >
                        enregister
                      </button>
                    </div>
                  </div>
                  <hr>
                  <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg h-100" >
                    <div class="bg-white border-b border-gray-200 container">
                      <div id="commission-photo-container">
                        <form action="{{ route('admin.commission.upload') }}" id="commission-photo-upload" class="dropzone">
                            @csrf
                        </form> 
                        <div id="commissioned-photo-container" class="sortable-container">
                            @foreach($commissionedPhotos as $photo)
                            <div class="photo-slot" data-filename="{{ $photo->filename }}" data-id="{{ $photo->id }}">
                                <img src="{{ asset('storage/commissioned_photos/' . $photo->filename) }}" class="list-photo" alt="Commissioned Photo" data-order="{{ $photo->order }}" data-id="{{ $photo->id }}">
                                <div class="delete-photo" data-filename="{{ $photo->filename }}" data-action='admin/commission/delete'><i class="fa fa-trash" aria-hidden="true"></i></div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                  
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
  // @ts-nocheck
  const reorderUrl = '{{ route('admin.commission.reorder') }}';
  const csrfToken = '{{ csrf_token() }}';
  const commissionContainer = document.getElementById('commissioned-photo-container');

  if (commissionContainer) {
    new Sortable(commissionContainer, {
      animation: 150,
      onEnd: function (evt) {
        const order = [];
        commissionContainer.querySelectorAll('.photo-slot').forEach((slot, index) => {
          order.push({ id: slot.dataset.id, position: index + 1 });
        });

        fetch(reorderUrl, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
          },
          body: JSON.stringify({ order: order })
        })
        .then(response => {
          if (!response.ok) throw new Error('Network response was not ok');
          return response.json();
        })
        .then(data => {
          console.log('Order updated', data);
        })
        .catch(error => {
          console.error('Error updating order:', error);
        });
      }
    });
  }
</script>

