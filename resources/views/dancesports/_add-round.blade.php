<!-- Button trigger modal -->
<button type="button" class="btn addbtn"
        data-bs-toggle="modal" title="Add a Round"
        data-bs-target="#addRoundModal">
    <i class="fa fa-plus"></i>
</button>

  <!-- Modal -->
  <div class="modal fade" id="addRoundModal" tabindex="-1" aria-labelledby="addRoundModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addRoundModalLabel">Add Rounds</h5>
          <button type="button" class="text-white btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        {!! Form::open(['url'=>'/dancesports/' . $contest->id, 'method'=>'post']) !!}
        <div class="modal-body">
            <div class="mb-3">
                {!! Form::label("Round") !!}
                {!! Form::number("number", null, ['class'=>'form-control']) !!}
            </div>

            <div class="mb-3">
                {!! Form::label("Description") !!}
                {!! Form::textarea("description", null, ['class'=>'form-control', 'rows' => 3]) !!}
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add Round</button>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>

  <style scoped>
    .addbtn {
    background-color: #ffbd59 !important;
    }

    .addbtn:hover {
        background-color: #080d32 !important;
        color: #ffbd59 !important;

    }

    .modal-content {
      background-color: #1a202c;
      color: white;
    }
  </style>