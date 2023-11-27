<!-- Button trigger modal -->
<button type="button" class="btn addbtn"
        data-bs-toggle="modal" title="Add a contestant"
        data-bs-target="#addContestantModal">
    <i class="fa fa-plus"></i>
</button>

  <!-- Modal -->
  <div class="modal fade" id="addContestantModal" tabindex="-1" aria-labelledby="addContestantModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addContestantModalLabel">Add Contestant</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        {!! Form::open(['url'=>'/contests/' . $contest->id . '/contestants', 'method'=>'post']) !!}
        <div class="modal-body">
            <div class="mb-3">
                {!! Form::label("name") !!}
                {!! Form::text("name", null, ['class'=>'form-control']) !!}
            </div>

            <div class="mb-3">
                {!! Form::label("number","Contestant Number") !!}
                {!! Form::number("number", null, ['class'=>'form-control']) !!}
            </div>

            <div class="mb-3">
                {!! Form::label("remarks") !!}
                {!! Form::text("remarks", null, ['class'=>'form-control']) !!}
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add Contestant</button>
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
