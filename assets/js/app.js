"use strict";

var APP;
APP = {
    init: function() {
        var _t = this;
        _t.header();
        _t.menu();
        _t.sliderHome();
        _t.sliderHero();
        _t.hero();
        
        var forms = document.querySelectorAll("FORM");
        if(forms.length >0) {
            for(var i=0;i<forms.length;i++) {
                EGEGEN.formValidation(forms[i], function(form) {
                    forms[i].submit();
                });
            }
        }
        
        window.addEventListener('scroll', function(e) {
            _t.scroll();
            _t.header();
        });
    },
    scroll: function() {
    },
    header: function() {
        var header = document.getElementById('header');
        if(!header) {
            return false;
        }
        if(st > 60) {
            $(html).addClass("header--fixed");
        } else {
            $(html).removeClass("header--fixed");
        }
    },
    /* Rezervasyon butonu tıklandığında anasayfa rezervasyon formuna yönlendirir */
    hero: function() {
        var hash = window.location.hash;
        if(hash === "#reservation") {
            var heroSearch =document.getElementById("homeSearch");
            if(!heroSearch) {return false;}
            setTimeout(function() {
                $('html, body').animate({
                    scrollTop: $(heroSearch).offset().top
                }, 300);
            },1000);
            
        }
    },
    menu: function() {
        var toggleBtn = EGEGEN.el('.navbar-toggler'),
            bgNavbar = EGEGEN.el('.bg-navbar'),    
            mainMenu =  EGEGEN.getByID("mainMenu"),
            setTop = function() {
                if(mainMenu) {
                    if(window.innerWidth < breakpoints.lg) {
                        var off = EGEGEN.getByID("header").offsetHeight;
                        mainMenu.style.marginTop = off + "px";
                        //mainMenu.style.height = (window.innerHeight - off) + "px";
                        //bgNavbar.style.marginTop = off + "px";
                    } else {
                        mainMenu.removeAttribute("style");
                    }
                }
            };
           
        if(toggleBtn) {
            toggleBtn.addEventListener("click", function () {
                $(html).toggleClass("menu--open");
                setTop();
            });
        }
        if(bgNavbar) {
            bgNavbar.addEventListener("click", function () {
                $(html).removeClass("menu--open");
            });
        }
        
        setTop(); 
        window.addEventListener('resize', function(e) {
            setTop(); 
        });
    },
    sliderHome: function() {
        var el = document.getElementById('sliderHome');
        if(!el) {return false;}
        
        var opt = {
            dots: false,
            arrows: true,
            fade: true,
            speed: 300,
            cssEase: 'linear'
        };
        EGEGEN.slick(el,opt);
    },
    sliderHero: function() {
        var el = document.getElementById('sliderHero');
        if(!el) {return false;}
        
        var opt = {
            dots: false,
            arrows: true,
            fade: true,
            speed: 300,
            infinite: true,
            autoplay: true,
            cssEase: 'linear'
        };
        EGEGEN.slick(el,opt);
    }
};


$(document).ready(function() {
    APP.init();
});

