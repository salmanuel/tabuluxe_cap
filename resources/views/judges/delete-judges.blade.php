<div class="modal fade" id="deleteModal{{$judge->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteModal{{$judge->id}}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5 text-dark" id="deleteModal{{$judge->id}}Label">Delete {{$judge->name}}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-dark">
            <p>Are you sure you want to delete this appointment?</p>
        </div>
        <div class="modal-footer text-dark">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <form method="POST" action="{{ route('judges.destroy', ['judge' => $judge->id, 'contest' => $judge->contest->id]) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger text-dark">Delete</button>
        </form>
        </div>
      </div>
    </div>
</div>
