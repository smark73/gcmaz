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

                // NAU HDR NAV ICON
                var $nauNav = $(document).find('.nau-nav');

                $nauNav.hover(function() {
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
                    $blockBtn.toggleClass('btns-show btns-hide');
                    var $stationLogo = jQuery(this).children('.logo-block');
                    $stationLogo.removeClass('logo-norm');
                    $stationLogo.addClass('logo-tilt');
                });

                $('.station-tile').mouseleave(function(){
                    var $stationLogo = jQuery(this).children('.logo-block');
                    $stationLogo.toggleClass('logo-tilt logo-norm');
                });

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

//# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm1haW4uanMiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0EiLCJmaWxlIjoic2NyaXB0LmpzIiwic291cmNlc0NvbnRlbnQiOlsiLy8gTW9kaWZpZWQgaHR0cDovL3BhdWxpcmlzaC5jb20vMjAwOS9tYXJrdXAtYmFzZWQtdW5vYnRydXNpdmUtY29tcHJlaGVuc2l2ZS1kb20tcmVhZHktZXhlY3V0aW9uL1xyXG4vLyBPbmx5IGZpcmVzIG9uIGJvZHkgY2xhc3MgKHdvcmtpbmcgb2ZmIHN0cmljdGx5IFdvcmRQcmVzcyBib2R5X2NsYXNzKVxyXG5cclxudmFyIEdlbmV4dXNTaXRlID0ge1xyXG4gIC8vIEFsbCBwYWdlc1xyXG4gIGNvbW1vbjoge1xyXG4gICAgaW5pdDogZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgXHJcbiAgICAgICAgalF1ZXJ5KGZ1bmN0aW9uKCQpIHtcclxuXHJcbiAgICAgICAgICAgICQoZG9jdW1lbnQpLnJlYWR5KGZ1bmN0aW9uKCkge1xyXG5cclxuICAgICAgICAgICAgICAgIC8vIFVTRVIgSERSIE5BViBJQ09OXHJcbiAgICAgICAgICAgICAgICB2YXIgJHVzZXJOYXYgPSAkKGRvY3VtZW50KS5maW5kKCcudXNlci1uYXYnKTtcclxuXHJcbiAgICAgICAgICAgICAgICAkdXNlck5hdi5ob3ZlcihmdW5jdGlvbigpIHtcclxuICAgICAgICAgICAgICAgICAgICB2YXIgJGJ1dHRvbiwgJG1lbnU7XHJcbiAgICAgICAgICAgICAgICAgICAgJGJ1dHRvbiA9ICQodGhpcyk7XHJcbiAgICAgICAgICAgICAgICAgICAgJG1lbnUgPSAkYnV0dG9uLmNoaWxkcmVuKCcuZHJvcGRvd24nKTtcclxuICAgICAgICAgICAgICAgICAgICAkbWVudS50b2dnbGVDbGFzcygnc2hvdy1tZSBoaWRlLW1lJyk7XHJcbiAgICAgICAgICAgICAgICAgICAgJG1lbnUuY2hpbGRyZW4oJ2xpJykuY2xpY2soZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICRtZW51LnJlbW92ZUNsYXNzKCdzaG93LW1lIGhpZGUtbWUnKTtcclxuICAgICAgICAgICAgICAgICAgICAgICAgJGJ1dHRvbi5odG1sKCQodGhpcykuaHRtbCgpKTtcclxuICAgICAgICAgICAgICAgICAgICB9KTtcclxuICAgICAgICAgICAgICAgIH0pO1xyXG5cclxuICAgICAgICAgICAgICAgIC8vIE5BVSBIRFIgTkFWIElDT05cclxuICAgICAgICAgICAgICAgIHZhciAkbmF1TmF2ID0gJChkb2N1bWVudCkuZmluZCgnLm5hdS1uYXYnKTtcclxuXHJcbiAgICAgICAgICAgICAgICAkbmF1TmF2LmhvdmVyKGZ1bmN0aW9uKCkge1xyXG4gICAgICAgICAgICAgICAgICAgIHZhciAkYnV0dG9uLCAkbWVudTtcclxuICAgICAgICAgICAgICAgICAgICAkYnV0dG9uID0gJCh0aGlzKTtcclxuICAgICAgICAgICAgICAgICAgICAkbWVudSA9ICRidXR0b24uY2hpbGRyZW4oJy5kcm9wZG93bicpO1xyXG4gICAgICAgICAgICAgICAgICAgICRtZW51LnRvZ2dsZUNsYXNzKCdzaG93LW1lIGhpZGUtbWUnKTtcclxuICAgICAgICAgICAgICAgICAgICAkbWVudS5jaGlsZHJlbignbGknKS5jbGljayhmdW5jdGlvbigpIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgJG1lbnUucmVtb3ZlQ2xhc3MoJ3Nob3ctbWUgaGlkZS1tZScpO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAkYnV0dG9uLmh0bWwoJCh0aGlzKS5odG1sKCkpO1xyXG4gICAgICAgICAgICAgICAgICAgIH0pO1xyXG4gICAgICAgICAgICAgICAgfSk7XHJcblxyXG4gICAgICAgICAgICAgICAgLy8gU0VBUkNIIEhEUiBOQVYgSUNPTlxyXG4gICAgICAgICAgICAgICAgdmFyICRzZWFyY2hOYXYgPSAkKGRvY3VtZW50KS5maW5kKCcuc2VhcmNoLW5hdicpO1xyXG4gICAgICAgICAgICAgICAgXHJcbiAgICAgICAgICAgICAgICAkc2VhcmNoTmF2LmNsaWNrKGZ1bmN0aW9uKCkge1xyXG4gICAgICAgICAgICAgICAgICAgIHZhciAkYnV0dG9uO1xyXG4gICAgICAgICAgICAgICAgICAgICRidXR0b24gPSAkKHRoaXMpO1xyXG4gICAgICAgICAgICAgICAgICAgIHZhciAkc0JhciA9ICQoZG9jdW1lbnQpLmZpbmQoJy5oZWFkZXItd2lkZ2V0LWFyZWEgLnNlYXJjaGJhcicpO1xyXG4gICAgICAgICAgICAgICAgICAgIHZhciAkc0Zvcm0gPSAkc0Jhci5jaGlsZHJlbignLnNlYXJjaGJhci1mb3JtJyk7XHJcbiAgICAgICAgICAgICAgICAgICAgJHNCYXIucmVtb3ZlQ2xhc3MoJ2hpZGUtbWUnKTtcclxuICAgICAgICAgICAgICAgICAgICAkc0Zvcm0ucmVtb3ZlQ2xhc3MoJ2hpZGUtbWUnKTtcclxuICAgICAgICAgICAgICAgICAgICAkc0Jhci50b2dnbGVDbGFzcygnc2VhcmNoLWhpZGUgc2VhcmNoLXNob3cnKTtcclxuXHJcbiAgICAgICAgICAgICAgICB9KTtcclxuXHJcblxyXG4gICAgICAgICAgICAgICAgLy8gTU9CSUxFIFNMSURJTkcgTkFWXHJcbiAgICAgICAgICAgICAgICAvLyBjb2RlIGZyb20gc2xpZGluZyBwYW5lbCBjb21wb25lbnQgZnJvbSBib3VyYm9uIHJlZmlsbHNcclxuICAgICAgICAgICAgICAgICQoJy5tb2JpbGUtbmF2LWJ0biwuc2xpZGluZy1wYW5lbC1mYWRlLXNjcmVlbiwuc2xpZGluZy1wYW5lbC1jbG9zZScpLm9uKCdjbGljayB0b3VjaHN0YXJ0JyxmdW5jdGlvbiAoZSkge1xyXG4gICAgICAgICAgICAgICAgICAgICQoJy5zbGlkaW5nLXBhbmVsLWNvbnRlbnQsLnNsaWRpbmctcGFuZWwtZmFkZS1zY3JlZW4nKS50b2dnbGVDbGFzcygnaXMtdmlzaWJsZScpO1xyXG4gICAgICAgICAgICAgICAgICAgIGUucHJldmVudERlZmF1bHQoKTtcclxuICAgICAgICAgICAgICAgIH0pO1xyXG5cclxuXHJcbiAgICAgICAgICAgIH0pO1xyXG4gICAgICAgIH0pO1xyXG4gICAgICAgIFxyXG4gICAgfSxcclxuICAgIGZpbmFsaXplOiBmdW5jdGlvbigpIHsgfVxyXG4gIH0sXHJcbiAgLy8gSG9tZSBwYWdlXHJcbiAgaG9tZToge1xyXG4gICAgaW5pdDogZnVuY3Rpb24oKSB7XHJcblxyXG4gICAgICAgIGpRdWVyeShmdW5jdGlvbigkKSB7XHJcblxyXG4gICAgICAgICAgICAkKGRvY3VtZW50KS5yZWFkeShmdW5jdGlvbigpIHtcclxuXHJcbiAgICAgICAgICAgICAgICAvLyBob21lIHBhZ2Ugc3RhdGlvbiB0aWxlIGxpc3RlbiBidG5zXHJcbiAgICAgICAgICAgICAgICAkKCcuc3RhdGlvbi10aWxlJykuaG92ZXIoZnVuY3Rpb24oKXtcclxuICAgICAgICAgICAgICAgICAgICB2YXIgJGJsb2NrQnRuID0galF1ZXJ5KHRoaXMpLmNoaWxkcmVuKFwiW2NsYXNzKj1ibG9jay1idG4tXVwiKTtcclxuICAgICAgICAgICAgICAgICAgICAkYmxvY2tCdG4udG9nZ2xlQ2xhc3MoJ2J0bnMtc2hvdyBidG5zLWhpZGUnKTtcclxuICAgICAgICAgICAgICAgICAgICB2YXIgJHN0YXRpb25Mb2dvID0galF1ZXJ5KHRoaXMpLmNoaWxkcmVuKCcubG9nby1ibG9jaycpO1xyXG4gICAgICAgICAgICAgICAgICAgICRzdGF0aW9uTG9nby5yZW1vdmVDbGFzcygnbG9nby1ub3JtJyk7XHJcbiAgICAgICAgICAgICAgICAgICAgJHN0YXRpb25Mb2dvLmFkZENsYXNzKCdsb2dvLXRpbHQnKTtcclxuICAgICAgICAgICAgICAgIH0pO1xyXG5cclxuICAgICAgICAgICAgICAgICQoJy5zdGF0aW9uLXRpbGUnKS5tb3VzZWxlYXZlKGZ1bmN0aW9uKCl7XHJcbiAgICAgICAgICAgICAgICAgICAgdmFyICRzdGF0aW9uTG9nbyA9IGpRdWVyeSh0aGlzKS5jaGlsZHJlbignLmxvZ28tYmxvY2snKTtcclxuICAgICAgICAgICAgICAgICAgICAkc3RhdGlvbkxvZ28udG9nZ2xlQ2xhc3MoJ2xvZ28tdGlsdCBsb2dvLW5vcm0nKTtcclxuICAgICAgICAgICAgICAgIH0pO1xyXG5cclxuICAgICAgICAgICAgfSk7XHJcblxyXG4gICAgICAgIH0pO1xyXG4gICAgfVxyXG4gIH0sXHJcbiAgLy8gQWJvdXQgcGFnZVxyXG4gIGFib3V0OiB7XHJcbiAgICBpbml0OiBmdW5jdGlvbigpIHtcclxuICAgICAgLy8gSlMgaGVyZVxyXG4gICAgfVxyXG4gIH1cclxuXHJcbn07XHJcblxyXG52YXIgVVRJTCA9IHtcclxuICBmaXJlOiBmdW5jdGlvbihmdW5jLCBmdW5jbmFtZSwgYXJncykge1xyXG4gICAgdmFyIG5hbWVzcGFjZSA9IEdlbmV4dXNTaXRlO1xyXG4gICAgZnVuY25hbWUgPSAoZnVuY25hbWUgPT09IHVuZGVmaW5lZCkgPyAnaW5pdCcgOiBmdW5jbmFtZTtcclxuICAgIGlmIChmdW5jICE9PSAnJyAmJiBuYW1lc3BhY2VbZnVuY10gJiYgdHlwZW9mIG5hbWVzcGFjZVtmdW5jXVtmdW5jbmFtZV0gPT09ICdmdW5jdGlvbicpIHtcclxuICAgICAgbmFtZXNwYWNlW2Z1bmNdW2Z1bmNuYW1lXShhcmdzKTtcclxuICAgIH1cclxuICB9LFxyXG4gIGxvYWRFdmVudHM6IGZ1bmN0aW9uKCkge1xyXG5cclxuICAgIFVUSUwuZmlyZSgnY29tbW9uJyk7XHJcblxyXG4gICAgalF1ZXJ5LmVhY2goZG9jdW1lbnQuYm9keS5jbGFzc05hbWUucmVwbGFjZSgvLS9nLCAnXycpLnNwbGl0KC9cXHMrLyksZnVuY3Rpb24oaSxjbGFzc25tKSB7XHJcbiAgICAgIFVUSUwuZmlyZShjbGFzc25tKTtcclxuICAgIH0pO1xyXG5cclxuICAgIFVUSUwuZmlyZSgnY29tbW9uJywgJ2ZpbmFsaXplJyk7XHJcbiAgfVxyXG59O1xyXG5cclxualF1ZXJ5KGRvY3VtZW50KS5yZWFkeShVVElMLmxvYWRFdmVudHMpO1xyXG4iXSwic291cmNlUm9vdCI6Ii9zb3VyY2UvIn0=
