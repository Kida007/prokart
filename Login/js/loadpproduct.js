$().ready(function(){

      var username =  $.cookie("Hello");
     console.log("loading seller products , "+username);




    $.ajax({
      type:'POST',
      url : 'fl_includes/fetchsellerproduct.php' ,
      data :  {'productSeller' : 'devan' },
      success :function(data){
        console.log(data);
        $('.row').append(data) ;
      }
    });
})
