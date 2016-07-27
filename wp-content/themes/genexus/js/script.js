// Modified http://paulirish.com/2009/markup-based-unobtrusive-comprehensive-dom-ready-execution/
// Only fires on body class (working off strictly WordPress body_class)

var GenexusSite = {
  // All pages
  common: {
    init: function() {
        
        jQuery(function($) {

            $(document).ready(function() {

                // USER HDR NAV ICON
                var $userNav = $(document).find('.user-nav');

                $userNav.hover(function() {
                    var $button, $menu;
                    $button = $(this);
                    $menu = $button.children('.dropdown');
                    $menu.toggleClass('show-me hide-me');
                    $menu.children('li').click(function() {
                        $menu.removeClass('show-me hide-me');
                        $button.html($(this).html());
                    });
                });

                // SEARCH HDR NAV ICON
                var $searchNav = $(document).find('.search-nav');
                
                $searchNav.click(function() {
                    var $button;
                    $button = $(this);
                    var $sBar = $(document).find('.header-widget-area .searchbar');
                    var $sForm = $sBar.children('.searchbar-form');
                    $sBar.removeClass('hide-me');
                    $sForm.removeClass('hide-me');
                    $sBar.toggleClass('search-hide search-show');

                });


                // MOBILE SLIDING NAV
                // code from sliding panel component from bourbon refills
                $('.mobile-nav-btn,.sliding-panel-fade-screen,.sliding-panel-close').on('click touchstart',function (e) {
                    $('.sliding-panel-content,.sliding-panel-fade-screen').toggleClass('is-visible');
                    e.preventDefault();
                });


            });
        });
        
    },
    finalize: function() { }
  },
  // Home page
  home: {
    init: function() {

        jQuery(function($) {

            $(document).ready(function() {

                // home page station tile listen btns
                $('.station-tile').hover(function(){
                    var $blockBtn = jQuery(this).children("[class*=block-btn-]");
                    $blockBtn.toggleClass('block-btn-show block-btn-hide');
                });

                //var $spkrIcon = jQuery(document).find('div.spkrIcon');
                //$('.block-btn-listen').hover(function(){
                //    $spkrIcon.stop().animate({ left: 7 }, 100);
                //}, function(){
                //    $spkrIcon.stop().animate({ left: 0 });
                //});

            });

        });
    }
  },
  // About page
  about: {
    init: function() {
      // JS here
    }
  }

};

var UTIL = {
  fire: function(func, funcname, args) {
    var namespace = GenexusSite;
    funcname = (funcname === undefined) ? 'init' : funcname;
    if (func !== '' && namespace[func] && typeof namespace[func][funcname] === 'function') {
      namespace[func][funcname](args);
    }
  },
  loadEvents: function() {

    UTIL.fire('common');

    jQuery.each(document.body.className.replace(/-/g, '_').split(/\s+/),function(i,classnm) {
      UTIL.fire(classnm);
    });

    UTIL.fire('common', 'finalize');
  }
};

jQuery(document).ready(UTIL.loadEvents);

//# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm1haW4uanMiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0EiLCJmaWxlIjoic2NyaXB0LmpzIiwic291cmNlc0NvbnRlbnQiOlsiLy8gTW9kaWZpZWQgaHR0cDovL3BhdWxpcmlzaC5jb20vMjAwOS9tYXJrdXAtYmFzZWQtdW5vYnRydXNpdmUtY29tcHJlaGVuc2l2ZS1kb20tcmVhZHktZXhlY3V0aW9uL1xyXG4vLyBPbmx5IGZpcmVzIG9uIGJvZHkgY2xhc3MgKHdvcmtpbmcgb2ZmIHN0cmljdGx5IFdvcmRQcmVzcyBib2R5X2NsYXNzKVxyXG5cclxudmFyIEdlbmV4dXNTaXRlID0ge1xyXG4gIC8vIEFsbCBwYWdlc1xyXG4gIGNvbW1vbjoge1xyXG4gICAgaW5pdDogZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgXHJcbiAgICAgICAgalF1ZXJ5KGZ1bmN0aW9uKCQpIHtcclxuXHJcbiAgICAgICAgICAgICQoZG9jdW1lbnQpLnJlYWR5KGZ1bmN0aW9uKCkge1xyXG5cclxuICAgICAgICAgICAgICAgIC8vIFVTRVIgSERSIE5BViBJQ09OXHJcbiAgICAgICAgICAgICAgICB2YXIgJHVzZXJOYXYgPSAkKGRvY3VtZW50KS5maW5kKCcudXNlci1uYXYnKTtcclxuXHJcbiAgICAgICAgICAgICAgICAkdXNlck5hdi5ob3ZlcihmdW5jdGlvbigpIHtcclxuICAgICAgICAgICAgICAgICAgICB2YXIgJGJ1dHRvbiwgJG1lbnU7XHJcbiAgICAgICAgICAgICAgICAgICAgJGJ1dHRvbiA9ICQodGhpcyk7XHJcbiAgICAgICAgICAgICAgICAgICAgJG1lbnUgPSAkYnV0dG9uLmNoaWxkcmVuKCcuZHJvcGRvd24nKTtcclxuICAgICAgICAgICAgICAgICAgICAkbWVudS50b2dnbGVDbGFzcygnc2hvdy1tZSBoaWRlLW1lJyk7XHJcbiAgICAgICAgICAgICAgICAgICAgJG1lbnUuY2hpbGRyZW4oJ2xpJykuY2xpY2soZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICRtZW51LnJlbW92ZUNsYXNzKCdzaG93LW1lIGhpZGUtbWUnKTtcclxuICAgICAgICAgICAgICAgICAgICAgICAgJGJ1dHRvbi5odG1sKCQodGhpcykuaHRtbCgpKTtcclxuICAgICAgICAgICAgICAgICAgICB9KTtcclxuICAgICAgICAgICAgICAgIH0pO1xyXG5cclxuICAgICAgICAgICAgICAgIC8vIFNFQVJDSCBIRFIgTkFWIElDT05cclxuICAgICAgICAgICAgICAgIHZhciAkc2VhcmNoTmF2ID0gJChkb2N1bWVudCkuZmluZCgnLnNlYXJjaC1uYXYnKTtcclxuICAgICAgICAgICAgICAgIFxyXG4gICAgICAgICAgICAgICAgJHNlYXJjaE5hdi5jbGljayhmdW5jdGlvbigpIHtcclxuICAgICAgICAgICAgICAgICAgICB2YXIgJGJ1dHRvbjtcclxuICAgICAgICAgICAgICAgICAgICAkYnV0dG9uID0gJCh0aGlzKTtcclxuICAgICAgICAgICAgICAgICAgICB2YXIgJHNCYXIgPSAkKGRvY3VtZW50KS5maW5kKCcuaGVhZGVyLXdpZGdldC1hcmVhIC5zZWFyY2hiYXInKTtcclxuICAgICAgICAgICAgICAgICAgICB2YXIgJHNGb3JtID0gJHNCYXIuY2hpbGRyZW4oJy5zZWFyY2hiYXItZm9ybScpO1xyXG4gICAgICAgICAgICAgICAgICAgICRzQmFyLnJlbW92ZUNsYXNzKCdoaWRlLW1lJyk7XHJcbiAgICAgICAgICAgICAgICAgICAgJHNGb3JtLnJlbW92ZUNsYXNzKCdoaWRlLW1lJyk7XHJcbiAgICAgICAgICAgICAgICAgICAgJHNCYXIudG9nZ2xlQ2xhc3MoJ3NlYXJjaC1oaWRlIHNlYXJjaC1zaG93Jyk7XHJcblxyXG4gICAgICAgICAgICAgICAgfSk7XHJcblxyXG5cclxuICAgICAgICAgICAgICAgIC8vIE1PQklMRSBTTElESU5HIE5BVlxyXG4gICAgICAgICAgICAgICAgLy8gY29kZSBmcm9tIHNsaWRpbmcgcGFuZWwgY29tcG9uZW50IGZyb20gYm91cmJvbiByZWZpbGxzXHJcbiAgICAgICAgICAgICAgICAkKCcubW9iaWxlLW5hdi1idG4sLnNsaWRpbmctcGFuZWwtZmFkZS1zY3JlZW4sLnNsaWRpbmctcGFuZWwtY2xvc2UnKS5vbignY2xpY2sgdG91Y2hzdGFydCcsZnVuY3Rpb24gKGUpIHtcclxuICAgICAgICAgICAgICAgICAgICAkKCcuc2xpZGluZy1wYW5lbC1jb250ZW50LC5zbGlkaW5nLXBhbmVsLWZhZGUtc2NyZWVuJykudG9nZ2xlQ2xhc3MoJ2lzLXZpc2libGUnKTtcclxuICAgICAgICAgICAgICAgICAgICBlLnByZXZlbnREZWZhdWx0KCk7XHJcbiAgICAgICAgICAgICAgICB9KTtcclxuXHJcblxyXG4gICAgICAgICAgICB9KTtcclxuICAgICAgICB9KTtcclxuICAgICAgICBcclxuICAgIH0sXHJcbiAgICBmaW5hbGl6ZTogZnVuY3Rpb24oKSB7IH1cclxuICB9LFxyXG4gIC8vIEhvbWUgcGFnZVxyXG4gIGhvbWU6IHtcclxuICAgIGluaXQ6IGZ1bmN0aW9uKCkge1xyXG5cclxuICAgICAgICBqUXVlcnkoZnVuY3Rpb24oJCkge1xyXG5cclxuICAgICAgICAgICAgJChkb2N1bWVudCkucmVhZHkoZnVuY3Rpb24oKSB7XHJcblxyXG4gICAgICAgICAgICAgICAgLy8gaG9tZSBwYWdlIHN0YXRpb24gdGlsZSBsaXN0ZW4gYnRuc1xyXG4gICAgICAgICAgICAgICAgJCgnLnN0YXRpb24tdGlsZScpLmhvdmVyKGZ1bmN0aW9uKCl7XHJcbiAgICAgICAgICAgICAgICAgICAgdmFyICRibG9ja0J0biA9IGpRdWVyeSh0aGlzKS5jaGlsZHJlbihcIltjbGFzcyo9YmxvY2stYnRuLV1cIik7XHJcbiAgICAgICAgICAgICAgICAgICAgJGJsb2NrQnRuLnRvZ2dsZUNsYXNzKCdibG9jay1idG4tc2hvdyBibG9jay1idG4taGlkZScpO1xyXG4gICAgICAgICAgICAgICAgfSk7XHJcblxyXG4gICAgICAgICAgICAgICAgLy92YXIgJHNwa3JJY29uID0galF1ZXJ5KGRvY3VtZW50KS5maW5kKCdkaXYuc3Brckljb24nKTtcclxuICAgICAgICAgICAgICAgIC8vJCgnLmJsb2NrLWJ0bi1saXN0ZW4nKS5ob3ZlcihmdW5jdGlvbigpe1xyXG4gICAgICAgICAgICAgICAgLy8gICAgJHNwa3JJY29uLnN0b3AoKS5hbmltYXRlKHsgbGVmdDogNyB9LCAxMDApO1xyXG4gICAgICAgICAgICAgICAgLy99LCBmdW5jdGlvbigpe1xyXG4gICAgICAgICAgICAgICAgLy8gICAgJHNwa3JJY29uLnN0b3AoKS5hbmltYXRlKHsgbGVmdDogMCB9KTtcclxuICAgICAgICAgICAgICAgIC8vfSk7XHJcblxyXG4gICAgICAgICAgICB9KTtcclxuXHJcbiAgICAgICAgfSk7XHJcbiAgICB9XHJcbiAgfSxcclxuICAvLyBBYm91dCBwYWdlXHJcbiAgYWJvdXQ6IHtcclxuICAgIGluaXQ6IGZ1bmN0aW9uKCkge1xyXG4gICAgICAvLyBKUyBoZXJlXHJcbiAgICB9XHJcbiAgfVxyXG5cclxufTtcclxuXHJcbnZhciBVVElMID0ge1xyXG4gIGZpcmU6IGZ1bmN0aW9uKGZ1bmMsIGZ1bmNuYW1lLCBhcmdzKSB7XHJcbiAgICB2YXIgbmFtZXNwYWNlID0gR2VuZXh1c1NpdGU7XHJcbiAgICBmdW5jbmFtZSA9IChmdW5jbmFtZSA9PT0gdW5kZWZpbmVkKSA/ICdpbml0JyA6IGZ1bmNuYW1lO1xyXG4gICAgaWYgKGZ1bmMgIT09ICcnICYmIG5hbWVzcGFjZVtmdW5jXSAmJiB0eXBlb2YgbmFtZXNwYWNlW2Z1bmNdW2Z1bmNuYW1lXSA9PT0gJ2Z1bmN0aW9uJykge1xyXG4gICAgICBuYW1lc3BhY2VbZnVuY11bZnVuY25hbWVdKGFyZ3MpO1xyXG4gICAgfVxyXG4gIH0sXHJcbiAgbG9hZEV2ZW50czogZnVuY3Rpb24oKSB7XHJcblxyXG4gICAgVVRJTC5maXJlKCdjb21tb24nKTtcclxuXHJcbiAgICBqUXVlcnkuZWFjaChkb2N1bWVudC5ib2R5LmNsYXNzTmFtZS5yZXBsYWNlKC8tL2csICdfJykuc3BsaXQoL1xccysvKSxmdW5jdGlvbihpLGNsYXNzbm0pIHtcclxuICAgICAgVVRJTC5maXJlKGNsYXNzbm0pO1xyXG4gICAgfSk7XHJcblxyXG4gICAgVVRJTC5maXJlKCdjb21tb24nLCAnZmluYWxpemUnKTtcclxuICB9XHJcbn07XHJcblxyXG5qUXVlcnkoZG9jdW1lbnQpLnJlYWR5KFVUSUwubG9hZEV2ZW50cyk7XHJcbiJdLCJzb3VyY2VSb290IjoiL3NvdXJjZS8ifQ==
