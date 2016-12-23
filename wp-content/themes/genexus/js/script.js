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
                        //$button.html($(this).html());
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
                        //$button.html($(this).html());
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

//# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm1haW4uanMiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0EiLCJmaWxlIjoic2NyaXB0LmpzIiwic291cmNlc0NvbnRlbnQiOlsiLy8gTW9kaWZpZWQgaHR0cDovL3BhdWxpcmlzaC5jb20vMjAwOS9tYXJrdXAtYmFzZWQtdW5vYnRydXNpdmUtY29tcHJlaGVuc2l2ZS1kb20tcmVhZHktZXhlY3V0aW9uL1xyXG4vLyBPbmx5IGZpcmVzIG9uIGJvZHkgY2xhc3MgKHdvcmtpbmcgb2ZmIHN0cmljdGx5IFdvcmRQcmVzcyBib2R5X2NsYXNzKVxyXG5cclxudmFyIEdlbmV4dXNTaXRlID0ge1xyXG4gIC8vIEFsbCBwYWdlc1xyXG4gIGNvbW1vbjoge1xyXG4gICAgaW5pdDogZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgXHJcbiAgICAgICAgalF1ZXJ5KGZ1bmN0aW9uKCQpIHtcclxuXHJcbiAgICAgICAgICAgICQoZG9jdW1lbnQpLnJlYWR5KGZ1bmN0aW9uKCkge1xyXG5cclxuICAgICAgICAgICAgICAgIC8vIFVTRVIgSERSIE5BViBJQ09OXHJcbiAgICAgICAgICAgICAgICB2YXIgJHVzZXJOYXYgPSAkKGRvY3VtZW50KS5maW5kKCcudXNlci1uYXYnKTtcclxuXHJcbiAgICAgICAgICAgICAgICAkdXNlck5hdi5ob3ZlcihmdW5jdGlvbigpIHtcclxuICAgICAgICAgICAgICAgICAgICB2YXIgJGJ1dHRvbiwgJG1lbnU7XHJcbiAgICAgICAgICAgICAgICAgICAgJGJ1dHRvbiA9ICQodGhpcyk7XHJcbiAgICAgICAgICAgICAgICAgICAgJG1lbnUgPSAkYnV0dG9uLmNoaWxkcmVuKCcuZHJvcGRvd24nKTtcclxuICAgICAgICAgICAgICAgICAgICAkbWVudS50b2dnbGVDbGFzcygnc2hvdy1tZSBoaWRlLW1lJyk7XHJcbiAgICAgICAgICAgICAgICAgICAgJG1lbnUuY2hpbGRyZW4oJ2xpJykuY2xpY2soZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICRtZW51LnJlbW92ZUNsYXNzKCdzaG93LW1lIGhpZGUtbWUnKTtcclxuICAgICAgICAgICAgICAgICAgICAgICAgLy8kYnV0dG9uLmh0bWwoJCh0aGlzKS5odG1sKCkpO1xyXG4gICAgICAgICAgICAgICAgICAgIH0pO1xyXG4gICAgICAgICAgICAgICAgfSk7XHJcblxyXG4gICAgICAgICAgICAgICAgLy8gTkFVIEhEUiBOQVYgSUNPTlxyXG4gICAgICAgICAgICAgICAgdmFyICRuYXVOYXYgPSAkKGRvY3VtZW50KS5maW5kKCcubmF1LW5hdicpO1xyXG5cclxuICAgICAgICAgICAgICAgICRuYXVOYXYuaG92ZXIoZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgICAgICAgICAgICAgdmFyICRidXR0b24sICRtZW51O1xyXG4gICAgICAgICAgICAgICAgICAgICRidXR0b24gPSAkKHRoaXMpO1xyXG4gICAgICAgICAgICAgICAgICAgICRtZW51ID0gJGJ1dHRvbi5jaGlsZHJlbignLmRyb3Bkb3duJyk7XHJcbiAgICAgICAgICAgICAgICAgICAgJG1lbnUudG9nZ2xlQ2xhc3MoJ3Nob3ctbWUgaGlkZS1tZScpO1xyXG4gICAgICAgICAgICAgICAgICAgICRtZW51LmNoaWxkcmVuKCdsaScpLmNsaWNrKGZ1bmN0aW9uKCkge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAkbWVudS5yZW1vdmVDbGFzcygnc2hvdy1tZSBoaWRlLW1lJyk7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIC8vJGJ1dHRvbi5odG1sKCQodGhpcykuaHRtbCgpKTtcclxuICAgICAgICAgICAgICAgICAgICB9KTtcclxuICAgICAgICAgICAgICAgIH0pO1xyXG5cclxuICAgICAgICAgICAgICAgIC8vIFNFQVJDSCBIRFIgTkFWIElDT05cclxuICAgICAgICAgICAgICAgIHZhciAkc2VhcmNoTmF2ID0gJChkb2N1bWVudCkuZmluZCgnLnNlYXJjaC1uYXYnKTtcclxuICAgICAgICAgICAgICAgIFxyXG4gICAgICAgICAgICAgICAgJHNlYXJjaE5hdi5jbGljayhmdW5jdGlvbigpIHtcclxuICAgICAgICAgICAgICAgICAgICB2YXIgJGJ1dHRvbjtcclxuICAgICAgICAgICAgICAgICAgICAkYnV0dG9uID0gJCh0aGlzKTtcclxuICAgICAgICAgICAgICAgICAgICB2YXIgJHNCYXIgPSAkKGRvY3VtZW50KS5maW5kKCcuaGVhZGVyLXdpZGdldC1hcmVhIC5zZWFyY2hiYXInKTtcclxuICAgICAgICAgICAgICAgICAgICB2YXIgJHNGb3JtID0gJHNCYXIuY2hpbGRyZW4oJy5zZWFyY2hiYXItZm9ybScpO1xyXG4gICAgICAgICAgICAgICAgICAgICRzQmFyLnJlbW92ZUNsYXNzKCdoaWRlLW1lJyk7XHJcbiAgICAgICAgICAgICAgICAgICAgJHNGb3JtLnJlbW92ZUNsYXNzKCdoaWRlLW1lJyk7XHJcbiAgICAgICAgICAgICAgICAgICAgJHNCYXIudG9nZ2xlQ2xhc3MoJ3NlYXJjaC1oaWRlIHNlYXJjaC1zaG93Jyk7XHJcblxyXG4gICAgICAgICAgICAgICAgfSk7XHJcblxyXG5cclxuICAgICAgICAgICAgICAgIC8vIE1PQklMRSBTTElESU5HIE5BVlxyXG4gICAgICAgICAgICAgICAgLy8gY29kZSBmcm9tIHNsaWRpbmcgcGFuZWwgY29tcG9uZW50IGZyb20gYm91cmJvbiByZWZpbGxzXHJcbiAgICAgICAgICAgICAgICAkKCcubW9iaWxlLW5hdi1idG4sLnNsaWRpbmctcGFuZWwtZmFkZS1zY3JlZW4sLnNsaWRpbmctcGFuZWwtY2xvc2UnKS5vbignY2xpY2sgdG91Y2hzdGFydCcsZnVuY3Rpb24gKGUpIHtcclxuICAgICAgICAgICAgICAgICAgICAkKCcuc2xpZGluZy1wYW5lbC1jb250ZW50LC5zbGlkaW5nLXBhbmVsLWZhZGUtc2NyZWVuJykudG9nZ2xlQ2xhc3MoJ2lzLXZpc2libGUnKTtcclxuICAgICAgICAgICAgICAgICAgICBlLnByZXZlbnREZWZhdWx0KCk7XHJcbiAgICAgICAgICAgICAgICB9KTtcclxuXHJcblxyXG4gICAgICAgICAgICB9KTtcclxuICAgICAgICB9KTtcclxuICAgICAgICBcclxuICAgIH0sXHJcbiAgICBmaW5hbGl6ZTogZnVuY3Rpb24oKSB7IH1cclxuICB9LFxyXG4gIC8vIEhvbWUgcGFnZVxyXG4gIGhvbWU6IHtcclxuICAgIGluaXQ6IGZ1bmN0aW9uKCkge1xyXG5cclxuICAgICAgICBqUXVlcnkoZnVuY3Rpb24oJCkge1xyXG5cclxuICAgICAgICAgICAgJChkb2N1bWVudCkucmVhZHkoZnVuY3Rpb24oKSB7XHJcblxyXG4gICAgICAgICAgICAgICAgLy8gaG9tZSBwYWdlIHN0YXRpb24gdGlsZSBsaXN0ZW4gYnRuc1xyXG4gICAgICAgICAgICAgICAgJCgnLnN0YXRpb24tdGlsZScpLmhvdmVyKGZ1bmN0aW9uKCl7XHJcbiAgICAgICAgICAgICAgICAgICAgdmFyICRibG9ja0J0biA9IGpRdWVyeSh0aGlzKS5jaGlsZHJlbihcIltjbGFzcyo9YmxvY2stYnRuLV1cIik7XHJcbiAgICAgICAgICAgICAgICAgICAgJGJsb2NrQnRuLnRvZ2dsZUNsYXNzKCdidG5zLXNob3cgYnRucy1oaWRlJyk7XHJcbiAgICAgICAgICAgICAgICAgICAgdmFyICRzdGF0aW9uTG9nbyA9IGpRdWVyeSh0aGlzKS5jaGlsZHJlbignLmxvZ28tYmxvY2snKTtcclxuICAgICAgICAgICAgICAgICAgICAkc3RhdGlvbkxvZ28ucmVtb3ZlQ2xhc3MoJ2xvZ28tbm9ybScpO1xyXG4gICAgICAgICAgICAgICAgICAgICRzdGF0aW9uTG9nby5hZGRDbGFzcygnbG9nby10aWx0Jyk7XHJcbiAgICAgICAgICAgICAgICB9KTtcclxuXHJcbiAgICAgICAgICAgICAgICAkKCcuc3RhdGlvbi10aWxlJykubW91c2VsZWF2ZShmdW5jdGlvbigpe1xyXG4gICAgICAgICAgICAgICAgICAgIHZhciAkc3RhdGlvbkxvZ28gPSBqUXVlcnkodGhpcykuY2hpbGRyZW4oJy5sb2dvLWJsb2NrJyk7XHJcbiAgICAgICAgICAgICAgICAgICAgJHN0YXRpb25Mb2dvLnRvZ2dsZUNsYXNzKCdsb2dvLXRpbHQgbG9nby1ub3JtJyk7XHJcbiAgICAgICAgICAgICAgICB9KTtcclxuXHJcbiAgICAgICAgICAgIH0pO1xyXG5cclxuICAgICAgICB9KTtcclxuICAgIH1cclxuICB9LFxyXG4gIC8vIEFib3V0IHBhZ2VcclxuICBhYm91dDoge1xyXG4gICAgaW5pdDogZnVuY3Rpb24oKSB7XHJcbiAgICAgIC8vIEpTIGhlcmVcclxuICAgIH1cclxuICB9XHJcblxyXG59O1xyXG5cclxudmFyIFVUSUwgPSB7XHJcbiAgZmlyZTogZnVuY3Rpb24oZnVuYywgZnVuY25hbWUsIGFyZ3MpIHtcclxuICAgIHZhciBuYW1lc3BhY2UgPSBHZW5leHVzU2l0ZTtcclxuICAgIGZ1bmNuYW1lID0gKGZ1bmNuYW1lID09PSB1bmRlZmluZWQpID8gJ2luaXQnIDogZnVuY25hbWU7XHJcbiAgICBpZiAoZnVuYyAhPT0gJycgJiYgbmFtZXNwYWNlW2Z1bmNdICYmIHR5cGVvZiBuYW1lc3BhY2VbZnVuY11bZnVuY25hbWVdID09PSAnZnVuY3Rpb24nKSB7XHJcbiAgICAgIG5hbWVzcGFjZVtmdW5jXVtmdW5jbmFtZV0oYXJncyk7XHJcbiAgICB9XHJcbiAgfSxcclxuICBsb2FkRXZlbnRzOiBmdW5jdGlvbigpIHtcclxuXHJcbiAgICBVVElMLmZpcmUoJ2NvbW1vbicpO1xyXG5cclxuICAgIGpRdWVyeS5lYWNoKGRvY3VtZW50LmJvZHkuY2xhc3NOYW1lLnJlcGxhY2UoLy0vZywgJ18nKS5zcGxpdCgvXFxzKy8pLGZ1bmN0aW9uKGksY2xhc3NubSkge1xyXG4gICAgICBVVElMLmZpcmUoY2xhc3NubSk7XHJcbiAgICB9KTtcclxuXHJcbiAgICBVVElMLmZpcmUoJ2NvbW1vbicsICdmaW5hbGl6ZScpO1xyXG4gIH1cclxufTtcclxuXHJcbmpRdWVyeShkb2N1bWVudCkucmVhZHkoVVRJTC5sb2FkRXZlbnRzKTtcclxuIl0sInNvdXJjZVJvb3QiOiIvc291cmNlLyJ9
