
(function($) {

    "use strict";
    //scroll
    var scrollWindow = function() {
          $(window).scroll(function(){
              var $w = $(this),
                      st = $w.scrollTop(),
                      navbar = $('.fixed-navbar-light'),
                      sd = $('.js-scroll-wrap');
  
              if (st > 150) {
                  if ( !navbar.hasClass('scrolled') ) {
                      navbar.addClass('scrolled');  
                  }
              } 
              if (st < 150) {
                  if ( navbar.hasClass('scrolled') ) {
                      navbar.removeClass('scrolled sleep');
                  }
              } 
              if ( st > 350 ) {
                  if ( !navbar.hasClass('awake') ) {
                      navbar.addClass('awake'); 
                  }
                  
                  if(sd.length > 0) {
                      sd.addClass('sleep');
                  }
              }
              if ( st < 350 ) {
                  if ( navbar.hasClass('awake') ) {
                      navbar.removeClass('awake');
                      navbar.addClass('sleep');
                  }
                  if(sd.length > 0) {
                      sd.removeClass('sleep');
                  }
              }
          });
      };
      scrollWindow();


    //Stop del video al cerrar el modal
      $("#modal-video").on('hidden.bs.modal', function (e) {
        $("#modal-video iframe").attr("src", $("#modal-video iframe").attr("src"));
    });

    $("#modal-video-tutorial").on('hidden.bs.modal', function (e) {
        $("#modal-video-tutorial iframe").attr("src", $("#modal-video-tutorial iframe").attr("src"));
    });
   
   
   AOS.init({
        duration: 1200,
      })
  
    
  })(jQuery);