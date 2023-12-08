<div class="modal fade" id="editModal{{$event->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editModal{{$event->id}}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="editModal{{$event->id}}Label">Edit Event</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('events.update', ['id' => $event->id]) }}" method="POST" class="max-w-lg mx-auto p-4 rounded-lg" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-4 mt-2">
                    <label for="title" class="block text-gray-700 font-semibold mb-2">Event Name</label>
                    <input type="text" name="event_name" id="event_name" value="{{ $event->event_name }}" class="w-full px-3 py-2 border rounded-lg" placeholder="Enter your full name">
                    @error('event_name')
                        <div class="text-sm text-red-500 italic">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex justify-content-between">
                  <div class="text-center">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                  </div>
                  <div class="text-center mt-1">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
                </div>
            </form>
        </div>
        {{-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save Changes</button>
        </div> --}}
      </div>
    </div>
  </div>
