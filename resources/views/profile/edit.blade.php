<div class="modal fade" id="editModal{{auth()->user()->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editModal{{auth()->user()->id}}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="editModal{{auth()->user()->id}}Label">Edit Contest</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('profile.update', ['id' => auth()->user()->id]) }}" method="POST" class="max-w-lg mx-auto p-4 rounded-lg" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-4 mt-2">
                    <label for="name" class="block text-gray-700 font-semibold mb-2 text-dark">Name</label>
                    <input type="text" name="name" id="name" value="{{ auth()->user()->name }}" class="w-full px-3 py-2 border rounded-lg text-dark" placeholder="Enter name">
                    @error('name')
                        <div class="text-sm text-red-500 italic">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4 mt-2">
                    <label for="email" class="block text-gray-700 font-semibold mb-2 text-dark">Email</label>
                    <input type="email" name="email" id="email" value="{{ auth()->user()->email }}" class="w-full px-3 py-2 border rounded-lg text-dark" >
                    @error('email')
                        <div class="text-sm text-red-500 italic">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4 mt-2">
                    <label for="photo" class="block text-gray-700 font-semibold mb-2 text-dark">Logo</label>
                    <input type="file" name="photo" id="photo" class="w-full px-3 py-2 border rounded-lg text-dark" >
                    @error('photo')
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
      </div>
    </div>
  </div>
