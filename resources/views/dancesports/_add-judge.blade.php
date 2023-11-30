<!-- Button trigger modal -->
<button type="button" class="addbtn btn" data-bs-toggle="modal" data-bs-target="#addJudgeModal" title="Add a judge">
    <i class="fa-solid fa-user-plus"></i>
  </button>
  
    <!-- Modal -->
    <div class="modal fade" id="addJudgeModal" tabindex="-1" aria-labelledby="addJudgeModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addJudgeModalLabel">Add Judge</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          {!! Form::open(['url'=>'/dancesports/' . $contest->id . '/judges', 'method'=>'post']) !!}
          <div class="modal-body">
              <div class="mb-3">
                  {!! Form::label("Name") !!}
                  {!! Form::text("name", null, ['class'=>'form-control']) !!}
              </div>
  
              <div class="mb-3">
                  {!! Form::label("Passcode") !!}
                  {!! Form::text("passcode", \Illuminate\Support\Str::random(6), ['class'=>'form-control']) !!}
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Add Judge</button>
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