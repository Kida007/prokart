$("#logout").click(function(){

  $.ajax({
    type : 'POST' ,
    url  : 'addpr1oduct.php'  ,
    data : {'function' : 'logout'}
  });

  alert("hello")  ;
}) ;
