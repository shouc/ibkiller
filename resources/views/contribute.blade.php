@include('header')

@include('nav', ['q' => false])

<!--
Table styles and files
-->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/locale/bootstrap-table-zh-CN.min.js"></script>

<style type="text/css">
  .questionContributionContainer {
    margin-top: 100px;

  }
</style>

<body>
<div class="questionContributionContainer container" style="margin-bottom:50px">
  <div class="jumbotron">
    <h1 style="font-weight: 400">Question Contribution</h1>

    <p style="color: #666">
      <h style="font-size: 15px">for <h>
      <h style="font-size: 30px">{{request()->subject ? request()->subject : 'Chemistry'}}</h>
    </p>
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" style="">Change Subject</button>
    <div class="dropdown-menu" id="dropdown">
      @foreach ($data as $i)
          <a class="dropdown-item" href="/contribute/?subject={{$i->name}}">{{$i->name}}</a>
      @endforeach
    </div>
    <button type="button" class="btn btn-secondary" style="">Help</button>
  </div>

  <div class="alert alert-success">
    <strong>Information</strong>
    <br>
    @if ($isNew)
      Please read the instruction first and start to make money!!
      <br>
    @else
      You have contributed
          <strong>{{$res[0]}}</strong>
      questions
      <br>
      We used
          <strong>{{$res[1]}}</strong>
      of your questions
      <br>
      We paid you 
          <strong>{{$res[2]}}</strong>
      points
      <br>
      <button type="button" class="btn btn-success" style="margin-top:10px">Exchange Points</button>

    @endif

    <button type="button" onclick="window.location.href='/contribute/add?Subject={{request()->subject ? request()->subject : 'Chemistry'}}'" class="btn btn-dark" style="margin-top:10px">Add Questions</button>
  </div>
  @if (!$isNew)
    <table data-toggle="table" 
    data-page-list="[10, 25, 50, 100, ALL]"
    data-pagination="true"
    data-search="true" data-url="/contribute/showContributedQuestion?Subject={{request()->subject ? request()->subject : 'Chemistry'}}" />
      <thead>
        <tr>
            <th data-field="content" data-sortable="true">Content</th>
            <th data-field="answer" data-sortable="true">Answer</th>
            <th data-field="chapter" data-sortable="true">Chapter</th>
            <th data-field="time" data-sortable="true">Time</th>

            <th data-field="type" data-sortable="true">Type</th>
            <th data-field="modify">&nbsp;</th>
        </tr>
      </thead>
    </table>
  @endif
  <br>
  
</div>

<div class="modal fade" id="userQuestionModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="userQuestionModalTitle"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="userQuestionModalBody">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

</body>
<script type="text/javascript">
  //$('#userQuestionModal').modal('show')

</script>
@include('foot')
