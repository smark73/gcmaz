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
                    var $sBar = $(document).find('.searchbar');
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

//# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm1haW4uanMiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0EiLCJmaWxlIjoic2NyaXB0LmpzIiwic291cmNlc0NvbnRlbnQiOlsiLy8gTW9kaWZpZWQgaHR0cDovL3BhdWxpcmlzaC5jb20vMjAwOS9tYXJrdXAtYmFzZWQtdW5vYnRydXNpdmUtY29tcHJlaGVuc2l2ZS1kb20tcmVhZHktZXhlY3V0aW9uL1xyXG4vLyBPbmx5IGZpcmVzIG9uIGJvZHkgY2xhc3MgKHdvcmtpbmcgb2ZmIHN0cmljdGx5IFdvcmRQcmVzcyBib2R5X2NsYXNzKVxyXG5cclxudmFyIEdlbmV4dXNTaXRlID0ge1xyXG4gIC8vIEFsbCBwYWdlc1xyXG4gIGNvbW1vbjoge1xyXG4gICAgaW5pdDogZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgXHJcbiAgICAgICAgalF1ZXJ5KGZ1bmN0aW9uKCQpIHtcclxuXHJcbiAgICAgICAgICAgICQoZG9jdW1lbnQpLnJlYWR5KGZ1bmN0aW9uKCkge1xyXG5cclxuICAgICAgICAgICAgICAgIC8vIFVTRVIgSERSIE5BViBJQ09OXHJcbiAgICAgICAgICAgICAgICB2YXIgJHVzZXJOYXYgPSAkKGRvY3VtZW50KS5maW5kKCcudXNlci1uYXYnKTtcclxuXHJcbiAgICAgICAgICAgICAgICAkdXNlck5hdi5ob3ZlcihmdW5jdGlvbigpIHtcclxuICAgICAgICAgICAgICAgICAgICB2YXIgJGJ1dHRvbiwgJG1lbnU7XHJcbiAgICAgICAgICAgICAgICAgICAgJGJ1dHRvbiA9ICQodGhpcyk7XHJcbiAgICAgICAgICAgICAgICAgICAgJG1lbnUgPSAkYnV0dG9uLmNoaWxkcmVuKCcuZHJvcGRvd24nKTtcclxuICAgICAgICAgICAgICAgICAgICAkbWVudS50b2dnbGVDbGFzcygnc2hvdy1tZSBoaWRlLW1lJyk7XHJcbiAgICAgICAgICAgICAgICAgICAgJG1lbnUuY2hpbGRyZW4oJ2xpJykuY2xpY2soZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICRtZW51LnJlbW92ZUNsYXNzKCdzaG93LW1lIGhpZGUtbWUnKTtcclxuICAgICAgICAgICAgICAgICAgICAgICAgJGJ1dHRvbi5odG1sKCQodGhpcykuaHRtbCgpKTtcclxuICAgICAgICAgICAgICAgICAgICB9KTtcclxuICAgICAgICAgICAgICAgIH0pO1xyXG5cclxuICAgICAgICAgICAgICAgIC8vIFNFQVJDSCBIRFIgTkFWIElDT05cclxuICAgICAgICAgICAgICAgIHZhciAkc2VhcmNoTmF2ID0gJChkb2N1bWVudCkuZmluZCgnLnNlYXJjaC1uYXYnKTtcclxuICAgICAgICAgICAgICAgIFxyXG4gICAgICAgICAgICAgICAgJHNlYXJjaE5hdi5jbGljayhmdW5jdGlvbigpIHtcclxuICAgICAgICAgICAgICAgICAgICB2YXIgJGJ1dHRvbjtcclxuICAgICAgICAgICAgICAgICAgICAkYnV0dG9uID0gJCh0aGlzKTtcclxuICAgICAgICAgICAgICAgICAgICB2YXIgJHNCYXIgPSAkKGRvY3VtZW50KS5maW5kKCcuc2VhcmNoYmFyJyk7XHJcbiAgICAgICAgICAgICAgICAgICAgdmFyICRzRm9ybSA9ICRzQmFyLmNoaWxkcmVuKCcuc2VhcmNoYmFyLWZvcm0nKTtcclxuICAgICAgICAgICAgICAgICAgICAkc0Jhci5yZW1vdmVDbGFzcygnaGlkZS1tZScpO1xyXG4gICAgICAgICAgICAgICAgICAgICRzRm9ybS5yZW1vdmVDbGFzcygnaGlkZS1tZScpO1xyXG4gICAgICAgICAgICAgICAgICAgICRzQmFyLnRvZ2dsZUNsYXNzKCdzZWFyY2gtaGlkZSBzZWFyY2gtc2hvdycpO1xyXG5cclxuICAgICAgICAgICAgICAgIH0pO1xyXG5cclxuXHJcbiAgICAgICAgICAgICAgICAvLyBNT0JJTEUgU0xJRElORyBOQVZcclxuICAgICAgICAgICAgICAgIC8vIGNvZGUgZnJvbSBzbGlkaW5nIHBhbmVsIGNvbXBvbmVudCBmcm9tIGJvdXJib24gcmVmaWxsc1xyXG4gICAgICAgICAgICAgICAgJCgnLm1vYmlsZS1uYXYtYnRuLC5zbGlkaW5nLXBhbmVsLWZhZGUtc2NyZWVuLC5zbGlkaW5nLXBhbmVsLWNsb3NlJykub24oJ2NsaWNrIHRvdWNoc3RhcnQnLGZ1bmN0aW9uIChlKSB7XHJcbiAgICAgICAgICAgICAgICAgICAgJCgnLnNsaWRpbmctcGFuZWwtY29udGVudCwuc2xpZGluZy1wYW5lbC1mYWRlLXNjcmVlbicpLnRvZ2dsZUNsYXNzKCdpcy12aXNpYmxlJyk7XHJcbiAgICAgICAgICAgICAgICAgICAgZS5wcmV2ZW50RGVmYXVsdCgpO1xyXG4gICAgICAgICAgICAgICAgfSk7XHJcblxyXG5cclxuICAgICAgICAgICAgfSk7XHJcbiAgICAgICAgfSk7XHJcbiAgICAgICAgXHJcbiAgICB9LFxyXG4gICAgZmluYWxpemU6IGZ1bmN0aW9uKCkgeyB9XHJcbiAgfSxcclxuICAvLyBIb21lIHBhZ2VcclxuICBob21lOiB7XHJcbiAgICBpbml0OiBmdW5jdGlvbigpIHtcclxuXHJcbiAgICAgICAgalF1ZXJ5KGZ1bmN0aW9uKCQpIHtcclxuXHJcbiAgICAgICAgICAgICQoZG9jdW1lbnQpLnJlYWR5KGZ1bmN0aW9uKCkge1xyXG5cclxuICAgICAgICAgICAgICAgIC8vIGhvbWUgcGFnZSBzdGF0aW9uIHRpbGUgbGlzdGVuIGJ0bnNcclxuICAgICAgICAgICAgICAgICQoJy5zdGF0aW9uLXRpbGUnKS5ob3ZlcihmdW5jdGlvbigpe1xyXG4gICAgICAgICAgICAgICAgICAgIHZhciAkYmxvY2tCdG4gPSBqUXVlcnkodGhpcykuY2hpbGRyZW4oXCJbY2xhc3MqPWJsb2NrLWJ0bi1dXCIpO1xyXG4gICAgICAgICAgICAgICAgICAgICRibG9ja0J0bi50b2dnbGVDbGFzcygnYmxvY2stYnRuLXNob3cgYmxvY2stYnRuLWhpZGUnKTtcclxuICAgICAgICAgICAgICAgIH0pO1xyXG5cclxuICAgICAgICAgICAgICAgIC8vdmFyICRzcGtySWNvbiA9IGpRdWVyeShkb2N1bWVudCkuZmluZCgnZGl2LnNwa3JJY29uJyk7XHJcbiAgICAgICAgICAgICAgICAvLyQoJy5ibG9jay1idG4tbGlzdGVuJykuaG92ZXIoZnVuY3Rpb24oKXtcclxuICAgICAgICAgICAgICAgIC8vICAgICRzcGtySWNvbi5zdG9wKCkuYW5pbWF0ZSh7IGxlZnQ6IDcgfSwgMTAwKTtcclxuICAgICAgICAgICAgICAgIC8vfSwgZnVuY3Rpb24oKXtcclxuICAgICAgICAgICAgICAgIC8vICAgICRzcGtySWNvbi5zdG9wKCkuYW5pbWF0ZSh7IGxlZnQ6IDAgfSk7XHJcbiAgICAgICAgICAgICAgICAvL30pO1xyXG5cclxuICAgICAgICAgICAgfSk7XHJcblxyXG4gICAgICAgIH0pO1xyXG4gICAgfVxyXG4gIH0sXHJcbiAgLy8gQWJvdXQgcGFnZVxyXG4gIGFib3V0OiB7XHJcbiAgICBpbml0OiBmdW5jdGlvbigpIHtcclxuICAgICAgLy8gSlMgaGVyZVxyXG4gICAgfVxyXG4gIH1cclxuXHJcbn07XHJcblxyXG52YXIgVVRJTCA9IHtcclxuICBmaXJlOiBmdW5jdGlvbihmdW5jLCBmdW5jbmFtZSwgYXJncykge1xyXG4gICAgdmFyIG5hbWVzcGFjZSA9IEdlbmV4dXNTaXRlO1xyXG4gICAgZnVuY25hbWUgPSAoZnVuY25hbWUgPT09IHVuZGVmaW5lZCkgPyAnaW5pdCcgOiBmdW5jbmFtZTtcclxuICAgIGlmIChmdW5jICE9PSAnJyAmJiBuYW1lc3BhY2VbZnVuY10gJiYgdHlwZW9mIG5hbWVzcGFjZVtmdW5jXVtmdW5jbmFtZV0gPT09ICdmdW5jdGlvbicpIHtcclxuICAgICAgbmFtZXNwYWNlW2Z1bmNdW2Z1bmNuYW1lXShhcmdzKTtcclxuICAgIH1cclxuICB9LFxyXG4gIGxvYWRFdmVudHM6IGZ1bmN0aW9uKCkge1xyXG5cclxuICAgIFVUSUwuZmlyZSgnY29tbW9uJyk7XHJcblxyXG4gICAgalF1ZXJ5LmVhY2goZG9jdW1lbnQuYm9keS5jbGFzc05hbWUucmVwbGFjZSgvLS9nLCAnXycpLnNwbGl0KC9cXHMrLyksZnVuY3Rpb24oaSxjbGFzc25tKSB7XHJcbiAgICAgIFVUSUwuZmlyZShjbGFzc25tKTtcclxuICAgIH0pO1xyXG5cclxuICAgIFVUSUwuZmlyZSgnY29tbW9uJywgJ2ZpbmFsaXplJyk7XHJcbiAgfVxyXG59O1xyXG5cclxualF1ZXJ5KGRvY3VtZW50KS5yZWFkeShVVElMLmxvYWRFdmVudHMpO1xyXG4iXSwic291cmNlUm9vdCI6Ii9zb3VyY2UvIn0=
