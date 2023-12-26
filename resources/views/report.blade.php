<div class="container-fluid">
  <div class="row">
    <div class="col-md-12"><form class="form-horizontal">
      <div class="card card-outline card-info">
        <div class="card-header">
          <h3 class="card-title"></h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
          </div>
        </div>

        <div class="card-body">

          <form action="#" method="post">
            @csrf
            <div class="row">
            
              <div class="col-md-4">
                <div class="form-group">
                  <label>From Date</label>
                  <input type="date" name="datefrom" id="datefrom" class="form-control" >
                  <span class="help-block">@error('schoolfees'){{ $message }}@enderror</span>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label>To Date</label>
                  <input type="date" name="dateto" id="dateto" class="form-control" >
                  <span class="help-block">@error('schoolfees'){{ $message }}@enderror</span>
                </div>
              </div>

            </div>

              

             <a href="#" id="viewreport" class="btn btn-info">Generate Report</a>


          </form>

            
          </div>

          {{-- <ul data-widget="treeview">
            <li><a href="#">One Level</a></li>
            <li class="treeview">
              <a href="#">Multilevel</a>
              <ul class="treeview-menu">
                <li><a href="#">Level 2</a></li>
              </ul>
            </li>
          </ul> --}}

        </div>

      </div>
    </form>
  </div></div>
</div>
<script type="text/javascript">
  $('document').ready(function(){ 

    require(['select2'],function(){
      $('.select2').select2();
    });

    $(document).on("click","#viewreport",function(e){
     e.preventDefault(); 
     var fromdate = $("#datefrom").val();
     var todate = $("#dateto").val();

     var printurl = `/admin/generated-report/${fromdate}/${todate}`;

    window.open(printurl,"_blank");   

   });

    });

</script>
