<div>
  <div id="load_data"></div>
  <div id="load_data_message"></div>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    var limit = 80;
    var start = 0;
    var catId = 1;
    var filterQuery = "";
        var sortQuery = "refreshDate DESC";
    var action = 'inactive';
    
    function loadData(limit, start){
      $.ajax({
        url:"https://efiewura.com/properties/get.php",
        method:"POST",
        data:{limit:limit, start:start, catId:catId, filterQuery:filterQuery, sortQuery:sortQuery},
        cache:false,
        success:function(getProperties){
          $('#load_data').append(getProperties);
          if(getProperties == ''){
            $('#load_data_message').html("");
            action = 'active';
          }else{
            $('#load_data_message').html("<button type='button' class='btn btn-info btn-sm'>Loading more products. Please Wait....</button>");
            action = "inactive";
          }
        }
      });
    }

    loadData(limit, start);
  
    if(action == 'inactive'){
      action = 'active';
      loadData(limit, start);
    }
    
    $(window).scroll(function(){
      if($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == 'inactive'){
        action = 'active';
        start = start + limit;
        setTimeout(function(){
          loadData(limit, start);
        }, 1000);
      }
    });
  });
</script>