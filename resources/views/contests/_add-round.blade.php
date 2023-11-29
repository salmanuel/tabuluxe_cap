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
        {!! Form::open(['url'=>'/contests/' . $contest->id . '/rounds', 'method'=>'post']) !!}
        <div class="modal-body">
            <div class="mb-3">
                {!! Form::label("Number of Rounds") !!}
                {!! Form::number("rounds", null, ['class'=>'form-control']) !!}
            </div>

            <div class="mb-3">
                {!! Form::label("Number of Contestants per Round") !!}
                {!! Form::select("no_of_contestants",["half" => "1/2", "one_third" => "1/3", "one_fourth"=> "1/4"], null, ['class'=>'form-control']) !!}
            </div>
{{-- 
            <div class="mb-3">
                {!! Form::label("weight") !!}
                {!! Form::number("weight", null, ['class'=>'form-control']) !!}
            </div> --}}

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