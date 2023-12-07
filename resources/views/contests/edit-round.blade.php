<div class="modal fade" id="editRndModal{{ $round->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editRndModal{{ $round->id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editRndModal{{ $round->id }}Label">Edit Round {{$round->number}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('rounds.update', ['round' => $round->id, 'contest' => $round->contest->id]) }}" method="POST" class="max-w-lg mx-auto p-4 shadow-md rounded-lg" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-4 mt-2">
                        <label for="number" class="block text-gray-700 font-semibold mb-2">Number</label>
                        <input type="text" name="number" id="number" value="{{ $round->number }}" class="w-full px-3 py-2 border rounded-lg" placeholder="Enter round number">
                        @error('number')
                        <div class="text-sm text-red-500 italic">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4 mt-2">
                        <label for="description" class="block text-gray-700 font-semibold mb-2">Description</label>
                        <input type="text" name="description" id="description" value="{{ $round->description }}" class="w-full px-3 py-2 border rounded-lg">
                        @error('description')
                        <div class="text-sm text-red-500 italic">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteRndModal{{$round->id}}">Delete Round</button>
                        @include('contests.delete-round')
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
