<div class="modal fade" id="delete{{$round->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="delete{{$round->id}}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="delete{{$round->id}}Label">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p>Are you sure you want to delete this judge?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <form method="POST" action="{{ route('rounds.destroy', ['round' => $round->id, 'contest' =>$round->contest->id]) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger text-dark">Delete</button>
        </form>
        </div>
      </div>
    </div>
  </div>
