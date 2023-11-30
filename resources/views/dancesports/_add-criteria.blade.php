<!-- Button trigger modal -->
<button type="button" class="btn addbtn"
        data-bs-toggle="modal" title="Add a criteria"
        data-bs-target="#addCriteriaModal">
    <i class="fa fa-plus"></i>
</button>

  <!-- Modal -->
  <div class="modal fade" id="addCriteriaModal" tabindex="-1" aria-labelledby="addCriteriaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addCriteriaModalLabel">Add Criteria</h5>
          <button type="button" class="text-white btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        {!! Form::open(['url'=>'/dancesports/' . $contest->id . '/criterias', 'method'=>'post']) !!}
        <div class="modal-body">
            <div class="mb-3">
                {!! Form::label("name") !!}
                {!! Form::text("name", null, ['class'=>'form-control']) !!}
            </div>

            <div class="mb-3">
                {!! Form::label("description") !!}
                {!! Form::text("description", null, ['class'=>'form-control']) !!}
            </div>

            <div class="mb-3">
                {!! Form::label("weight") !!}
                {!! Form::number("weight", null, ['class'=>'form-control']) !!}
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add Criteria</button>
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