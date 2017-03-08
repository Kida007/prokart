$(".rating").starRating({
    starSize: 25,
    starShape	:'rounded',
    initialRating : 4.5 ,
    readOnly :true ,
    useGradient :true , 
    starGradient : {start: '#F99400', end: '#F99400'},
    callback: function(currentRating, $el){
        // make a server call here
    }
});
