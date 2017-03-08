$().ready(function(){

      var username =  $.cookie("Hello");
     console.log("loading seller products , "+username);

     $('.main-panel').append('<div class="spinner"></div>)');

    $.ajax({
      type:'POST',
      url : 'fl_includes/fetchsellerproduct.php' ,
      data :  {'productSeller' : 'devan' },
      success :function(data){
        console.log(data);
        $('.row').append(data) ;
        $( ".spinner" ).remove();
        $('.lazy').Lazy();

      }
    });
})
