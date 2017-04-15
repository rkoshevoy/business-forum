  var navLi = $("nav li");

  $('.tracked').waypoint( function(dir) {
   if ( dir === 'down' ) {
     var hash = $(this).attr('id');
     console.log(hash);
     $('nav li').removeClass("active");
     $.each(navLi, function(){
       href = $(this).children('a').attr('href').slice(1);
       if (href==hash) {
        $(this).addClass("active");
      };
    });
   };
 }, {offset:'5%'});

  $('.tracked').waypoint( function(dir) {
   if ( dir === 'up' ) {
     var hash = $(this).attr('id');
     console.log(hash);
     $('nav li').removeClass("active");
     $.each(navLi, function(){
       href = $(this).children('a').attr('href').slice(1);
       if (href==hash) {
        $(this).addClass("active");
      };
    });
   };
 }, {offset:'-20'});
 
 
 
