
$(function(){

  var form = $('#form') ;
  var isvalid = true ;

  $(form).submit(function(event){
    event.preventDefault() ;

    isvalid=true ;

    $("input").each(function(){
      var element = $(this);
      if(element.val()==""){
        $(element).removeClass("sel").addClass('sel-red');
        isvalid=false ;
        console.log('failing badly');
      }

      else {
        $(element).removeClass("sel-red").addClass("sel");

      }
    });

    $("textarea").each(function(){
      var element = $(this);
      if(element.val()==""){
        $(element).removeClass("sel").addClass('sel-red');
        isvalid=false ;
        console.log('failing badly');
      }
    });


    if (isvalid) {


    var formData = $(form).serialize();

    $.ajax({
      type : 'POST' ,
      url : $(form).attr('action') ,
      data : formData
    }).done(function(response){
      $('#productName').val('') ;
      $('#productDetails').val('') ;
      $('#productsale').val('') ;
      $('#productQuantity').val('') ;
      $('#productSubCategory').val('') ;
      $('#productImages').val('') ;
      $('#productPrice').val('') ;
    });

    $("input").each(function(){
      var element = $(this);
        $(element).removeClass("sel-red").addClass('sel');
    });

    $("textarea").each(function(){
      var element = $(this);
        $(element).removeClass("sel-red").addClass('sel');
    });


  }

  else {
    var n = noty({
      text: 'Please fill the Required fields' ,
      animation: {
        open: {height: 'toggle'},
        close: {height: 'toggle'},
        easing: 'swing',
        speed: 500 // opening & closing animation speed
    } ,
  });
  }

  });
});
