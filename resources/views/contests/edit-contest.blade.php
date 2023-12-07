<div class="modal fade" id="editModal{{$contest->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editModal{{$contest->id}}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="editModal{{$contest->id}}Label">Edit Contest</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('contests.update', ['id' => $contest->id, 'eventId' =>$contest->event_id]) }}" method="POST" class="max-w-lg mx-auto p-4 bg-white shadow-md rounded-lg" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-4 mt-2">
                    <label for="title" class="block text-gray-700 font-semibold mb-2">Title</label>
                    <input type="text" name="title" id="title" value="{{ $contest->title }}" class="w-full px-3 py-2 border rounded-lg" placeholder="Enter title">
                    @error('title')
                        <div class="text-sm text-red-500 italic">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4 mt-2">
                    <label for="title" class="block text-gray-700 font-semibold mb-2">Schedule</label>
                    <input type="date" name="schedule" id="schedule" value="{{ $contest->schedule }}" class="w-full px-3 py-2 border rounded-lg" >
                    @error('schedule')
                        <div class="text-sm text-red-500 italic">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4 mt-2">
                    <label for="title" class="block text-gray-700 font-semibold mb-2">Venue</label>
                    <input type="text" name="venue" id="venue" value="{{ $contest->venue }}" class="w-full px-3 py-2 border rounded-lg" placeholder="Enter venue">
                    @error('venue')
                        <div class="text-sm text-red-500 italic">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4 mt-2">
                    <label for="title" class="block text-gray-700 font-semibold mb-2">Computation</label>
                    <select name="computation" id="computation">
                        <option value="{{$contest->computation}}" selected>{{$contest->computation}}</option>
                        <option value="Average">Average</option>
                        <option value="Ranking">Ranking</option>
                        <option value="Complex">Complex</option>
                    </select>
                    @error('computation')
                        <div class="text-sm text-red-500 italic">{{ $message }}</div>
                    @enderror
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
                <div class="text-center mt-1">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
