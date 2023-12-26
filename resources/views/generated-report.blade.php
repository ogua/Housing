<link rel="stylesheet" href="{{ URL::to('css/bootstrap.mins.css')}}">


<div class="card">
  <div class="card-header">
    <h4></h4>
  </div>
  <div class="card-body">
    <div class="card table-card card-info card-outline">
    </div>
    <div class="card-body table-responsive p-0">
      <table class="table table-hover table-table table-head-fixed">
        <thead>
          <tr>
            <th>Report Generated From {{ $fromdate }} To {{ $todate }}</th>
          </tr>
          <tr>
            <th>ID</th>
            <th>Img</th>
            <th>Title</th>
            <th>Type</th>
            <th>price</th>
            <th>Location</th>
            <th>Details</th>
            <th>Agent Name</th>
            <th>Agent Number</th>
            <th>Created_at</th>
          </tr>
        </thead>
        <tbody>
        @foreach($houses as $house)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $house->img }}</td>
            <td>{{ $house->title }}</td>
            <td>{{ $house->ctype }}</td>
            <td>{{ $house->px }}</td>
            <td>{{ $house->location }}</td>
            <td>{{ $house->details }}</td>
            <td>{{ $house->housedetail->agentname }}</td>
            <td>{{ $house->housedetail->agentcontact }}</td>
            <td>{{ $house->created_at }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>