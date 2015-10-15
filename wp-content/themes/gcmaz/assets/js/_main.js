// Modified http://paulirish.com/2009/markup-based-unobtrusive-comprehensive-dom-ready-execution/
// Only fires on body class (working off strictly WordPress body_class)

var GcmazSite = {
  // All pages
  common: {
    init: function() {

        // ****  START PAGE TAKEOVER
        // page takeover header shrink from 250 to 100
        // hdr wraps hdr1 and hdr2
        var $tkohdr = jQuery(document).find('.takeover-hdr');
        var $tkohdr1 = jQuery(document).find('.takeover-hdr1');
        var $tkohdr2 = jQuery(document).find('.takeover-hdr2');
        
        //create the object to store hdr vars
        function Tko($tkohdr, $tkohdr1, $tkohdr2){
            this.tkohdr = $tkohdr;
            this.tkohdr1 = $tkohdr1;
            this.tkohdr2 = $tkohdr2;
            this.h1 = this.tkohdr1.height();
            this.h2 = this.tkohdr2.height();
            this.set_h = function(p){ this.h2 = Math.round(150*p); this.tkohdr2.height = this.h; this.tkohdr.height = this.h1 + this.h2; };
        }
        var t = new Tko($tkohdr, $tkohdr1, $tkohdr2);
        
        //initialize percentage then heights
        var p = t.tkohdr2.innerWidth()/1000;
        t.set_h(p);
        
        //window resize funx
        jQuery(window).resize(function(){
            //set timer cuz window.resize needs to wait to get final heights
            function resizedw(){
                //reset percentage then height
                var p = t.tkohdr2.innerWidth()/1000;
                t.set_h(p);
            }
            var wait;
            clearTimeout(wait);
            wait = setTimeout(resizedw , 1000);
        });

        //hover funx
        jQuery(function(){
           t.tkohdr2.delay(10000).animate({ height:0, bottom:0, marginTop:0},
            function(){
                t.tkohdr.mouseover(function(){
                    t.tkohdr2.stop().animate({ height: t.h2, bottom: t.h2, marginTop:0});
                });
                t.tkohdr.mouseout(function(){
                    t.tkohdr2.stop().animate({ height:0, bottom:0, marginTop:0});
                });
            });
        });
        // **** END PAGE TAKEOVER
        
        //****  START exp leaderboard banner 
        var $exp = jQuery(document).find('.expldrbrd');
        jQuery(function(){
            $exp.delay(10000).animate({ height:20, bottom:0}, function(){
                //show hide funx
                $exp.mouseover(function(){
                    $exp.stop().animate({ height:150, bottom:150});
                });
                $exp.mouseout(function(){
                    $exp.stop().animate({ height:18, bottom:0});
                });
            });
        });
        //***** END exp leaderboard
        
        
        // START toggle searchbox in navbar
        jQuery(function(){
            //store our targets in vars
            var $searchboxToggle = jQuery(document).find('.searchbox-toggle');
            var $searchbox = jQuery(document).find('.searchbox-nav');
            var $searchform = jQuery(document).find('.searchbox-nav').children('.search-form');
            
            //init search-form styles and classes
            //$searchform.addClass('hidden');
            $searchform.css({opacity:0});
            $searchbox.hide();
            
            //toggle function
            $searchboxToggle.click(function(){
                $searchboxToggle.hide();
                //searchbox-nav is hidden until first click (otherwise shows on slow page loads)
                $searchbox.removeClass('hidden');
                $searchbox.show();
                //
                $searchbox.toggleClass('searchbox-hide searchbox-show');
                //jQuery('.searchbox-toggle span').toggleClass('glyphicon-search glyphicon-remove');
                
                //if(($searchform).hasClass('hidden')){
                    var searchformWait;
                    clearTimeout(searchformWait);
                    searchformWait = setTimeout(function(){$searchform.toggleClass('hidden visible').animate({opacity:1});} , 10);
                //} else {
                    //$searchform.animate({opacity:0}).toggleClass('hidden visible');
                //}
            });
        });
        // END
        
        //****  START user message

        jQuery(function(){
            var $gcmazUserLogout = jQuery(document).find('.logout-link');
            var $gcmazUserMsg = jQuery(document).find('.gcmaz-user-msg');
            $gcmazUserLogout.hide();
            
            //$gcmazUserLogout.animate({ width:0, left:0 }, function(){
                //show hide funx
                $gcmazUserMsg.mouseover(function(){
                    //$gcmazUserLogout.stop().animate({ width:0, left:0  });
                    $gcmazUserLogout.show();
                });
                $gcmazUserMsg.mouseout(function(){
                    //$gcmazUserLogout.stop().animate({ width:0, left:0  });
                    $gcmazUserLogout.hide();
                });
            //});
        });
        //***** END user
        
    },
    finalize: function() { }
  },
  // Home page
  home: {
    init: function() {
        // listen live stream window
        //jQuery('#kaffBtn').click(function(){
              //window.open('http://player.listenlive.co/36581', 'KAFFFM', 'width=800,height=600');
        //});
        //jQuery('#kmgnBtn').click(function(){
              //window.open('http://player.tritondigital.com/8061', 'KMGNFM', 'width=800,height=600');
        //});
        //jQuery('#kaffamBtn').click(function(){
              //window.open('http://player.tritondigital.com/8041', 'KAFFAM', 'width=800,height=600');
        //});
        //jQuery('#kfszBtn').click(function(){
              //window.open('http://player.tritondigital.com/14981', 'KFSZFM', 'width=800,height=600');
        //});
        //jQuery('#ktmgBtn').click(function(){
            //window.open('http://player.tritondigital.com/8071', 'KTMGFM', 'width=800,height=600');
        //});
        //jQuery('#knotBtn').click(function(){
            //window.open('http://player.tritondigital.com/14991', 'KNOTAM', 'width=800,height=600');
        //});
        
        // animatronix
//        var animationName = 'animated pulse';
//        var animationend = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
//        
//        function animateMe(thing){
//            jQuery(thing).addClass(animationName).one(animationend, function(){
//                jQuery(thing).removeClass(animationName);
//            });
//        }
//        
//        function Kaff(){
//            this.block = jQuery(document).find('#kaffBlock');
//            this.logo = jQuery(document).find('#kaffLogo');
//            this.btn = jQuery(document).find('#kaffBtn');
//            this.block.on('mouseenter', function(){animateMe(kaff.btn);});
//        }
//        var kaff = new Kaff();
//        
//        function Kmgn(){
//            this.block = jQuery(document).find('#kmgnBlock');
//            this.logo = jQuery(document).find('#kmgnLogo');
//            this.btn = jQuery(document).find('#kmgnBtn');
//            this.block.on('mouseenter', function(){animateMe(kmgn.btn);});
//        }
//        var kmgn = new Kmgn();
//        
//        function Kaffam(){
//            this.block = jQuery(document).find('#kaffamBlock');
//            this.logo = jQuery(document).find('#kaffamLogo');
//            this.btn = jQuery(document).find('#kaffamBtn');
//            this.block.on('mouseenter', function(){animateMe(kaffam.btn);});
//        }
//        var kaffam = new Kaffam();
//
//        function Kfsz(){
//            this.block = jQuery(document).find('#kfszBlock');
//            this.logo = jQuery(document).find('#kfszLogo');
//            this.btn = jQuery(document).find('#kfszBtn');
//            this.block.on('mouseenter', function(){animateMe(kfsz.btn);});
//        }
//        var kfsz = new Kfsz();
//
//        function Ktmg(){
//            this.block = jQuery(document).find('#ktmgBlock');
//            this.logo = jQuery(document).find('#ktmgLogo');
//            this.btn = jQuery(document).find('#ktmgBtn');
//            this.block.on('mouseenter', function(){animateMe(ktmg.btn);});
//        }
//        var ktmg = new Ktmg();
//        
//        function Knot(){
//            this.block = jQuery(document).find('#knotBlock');
//            this.logo = jQuery(document).find('#knotLogo');
//            this.btn = jQuery(document).find('#knotBtn');
//            this.block.on('mouseenter', function(){animateMe(knot.btn);});
//        }
//        var knot = new Knot();
        
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
    var namespace = GcmazSite;
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
