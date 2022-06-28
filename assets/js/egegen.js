


"use strict";

var EGEGEN = null, st, html, breakpoints = {
            sm: 568,
            md: 768,
            lg: 992,
            xl: 1200,
            xxl: 1800
        },
mobileWidth = 992;

EGEGEN = {
    init: function() {
        html = document.documentElement;
        var _t = this;
        
        _t.isDevice();
        _t.loader();
        _t.alertBrowser.init();
        _t.backTop();
        _t.lazy();
        _t.picker();
        _t.inputMask();
        
    },
    el: function (q) {
        var el;
        if (q === document) {
            return document;
        }
        if (!!(q && q.nodeType === 1)) {
            return q;
        }
        if (el = document.querySelector(q)) {
            return el;
        } else if (el = document.getElementsByTagName(q)) {
            return el[0];
        } else if (el = document.getElementsByClassName(q)) {
            return el[0];
        } else {
            return null;
        }
    },
    els: function (q) {
        var el;
        if (q === document) {
            return document;
        }
        if (!!(q && q.nodeType === 1)) {
            return q;
        }
        if (el = document.querySelectorAll(q)) {
            return el;
        }  else {
            return null;
        }
    },
    getByID: function (q) {
        if (!!(q && q.nodeType === 1)) {
            return q;
        }
        return document.getElementById(q);
    },  
    find: function (parent, query) {
        parent = EGEGEN.el(parent);
        if (parent) {
            return parent.querySelector(query);
        }
    },
    findAll: function (parent, query) {
        parent = EGEGEN.el(parent);
        if (parent) {
            return parent.querySelectorAll(query);
        }
    },
    trim: function(string) {
            return string.trim();
    },
    findClosest: function(el,cls) {
        var matchesFn;

        // find vendor prefix
        ['matches','webkitMatchesSelector','mozMatchesSelector','msMatchesSelector','oMatchesSelector'].some(function(fn) {
            if (typeof document.body[fn] == 'function') {
                matchesFn = fn;
                return true;
            }
            return false;
        })

        var parent;

        // traverse parents
        while (el) {
            parent = el.parentElement;
            if (parent && parent[matchesFn](cls)) {
                return parent;
            }
            el = parent;
        }

        return null;
    },
    hasClass: function (el, className) {
            if (!el) {
                return;
            }
            return el.classList ? el.classList.contains(className) : new RegExp(' ' + className + ' ').test(' ' + el.className + ' ');
        },
        addClass: function (el, className) {
            if (!el || typeof className === 'undefined') {
                return;
            }
            var classNames = className.split(' ');

            if (el.classList) {
                for (var i = 0; i < classNames.length; i++) {
                    if (classNames[i] && classNames[i].length > 0) {
                        el.classList.add(EGEGEN.trim(classNames[i]));
                    }
                }
            } else if (!EGEGEN.hasClass(el, className)) {
                for (var x = 0; x < classNames.length; x++) {
                    el.className += ' ' + EGEGEN.trim(classNames[x]);
                }
            }
        },
        removeClass: function (el, className) {
            if (!el || typeof className === 'undefined') {
                return;
            }
            var classNames = className.split(' ');
            if (el.classList) {
                for (var i = 0; i < classNames.length; i++) {
                    el.classList.remove(EGEGEN.trim(classNames[i]));
                }
            } else if (EGEGEN.hasClass(el, className)) {
                for (var x = 0; x < classNames.length; x++) {
                    el.className = el.className.replace(new RegExp('\\b' + EGEGEN.trim(classNames[x]) + '\\b', 'g'), '');
                }
            }
        },
    formatMoney: function(str) {
        var price = str.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
        return price;
    },
    formatNumberFromMoney: function(str) {
        var price =  str.replace(",","");
        return parseFloat(price);
    },  
    scroll: function() {
        st = window.scrollY || window.scrollTop || document.getElementsByTagName("html")[0].scrollTop;
    },
    slick: function(el,opt){
        if ($.fn.slick()) {
            if (el !== null) {
                var newObj = {},
                        defaultOpt = {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            dots: true,
                            infinite: true,
                            arrows: true,
                            pauseOnHover: true,
                            focusOnSelect: true,
                            speed: 500,
                            prevArrow: '<button type="button" class="slick-arrow slick-prev"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z"/></svg></button>',
                            nextArrow: '<button type="button" class="slick-arrow slick-next"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M5 3l3.057-3 11.943 12-11.943 12-3.057-3 9-9z"/></svg></button>', 
                        };
                if (opt !== null) {
                    newObj = $.extend({}, defaultOpt, opt);
                } else {
                    newObj = EGEGEN.addObj(defaultOpt, newObj);
                }
                $(el).slick(newObj);
            }
        }
    },
    parallax: function () {
        if (window.innerWidth >= breakpoints.md) {
            var elements = document.querySelectorAll(".parallax");
            if (elements.length < 1) {
                return false;
            }
            for (var i = 0; i < elements.length; i++) {
                var wBottomOffset = st + window.innerHeight,
                        itemTop = $(elements[i]).offset().top,
                        itemBottom = itemTop + $(elements[i]).height();
                if (wBottomOffset >= itemBottom) {
                    var vid = elements[i].querySelector(".parallax-item");
                    $(vid).css('transform', 'translate(0, -' + ((wBottomOffset - itemBottom) * 0.25) + 'px)');
                }
            }
        }
    },
    inputMask: function p() {
        if ($.fn.mask()) {
            var element = document.querySelectorAll(".mask"),
                    maskARRAY = {
                        "date": "00.00.0000",
                        "phone": "0 (000) 000 0000",
                        "card":"0000 0000 0000 0000"
                    };
            if (element.length > 0) {
                for (var i = 0; i < element.length; i++) {
                    var el = element[i],
                            maskType = el.getAttribute("data-mask");
                    $(el).mask(maskARRAY[maskType]);
                }
            }
        }
    },
    lazy: function() {
        var lazyElements = [].slice.call(document.querySelectorAll(".lazy"));
        var loadVideo = function(element) {
            for (var source in element.children) {
                var videoSource = element.children[source];
                if (typeof videoSource.tagName === "string" && videoSource.tagName === "SOURCE") {
                    videoSource.src = videoSource.dataset.src;
                }
            }
            element.load();
        };
        if ("IntersectionObserver" in window) {
            var lazyImageObserver = new IntersectionObserver(function(entries, observer) {
                entries.forEach(function(entry) {
                  if (entry.isIntersecting) {
                    var lazyElement = entry.target;
                    if(lazyElement.tagName =="VIDEO") {
                        loadVideo(lazyElement);
                    } else {
                        lazyElement.src = lazyElement.dataset.src;
                    }
                    setTimeout(function() {
                        lazyElement.classList.add("loading");
                    },350);
                    lazyImageObserver.unobserve(lazyElement);
                  }
                });
            });
            lazyElements.forEach(function(lazyElement) {
                lazyImageObserver.observe(lazyElement);
            });
        } else {
            lazyElements.forEach(function(lazyElement) {
                if(lazyElement.tagName =="VIDEO") {
                    loadVideo(lazyElement);
                } else {
                    lazyElement.src = lazyElement.dataset.src;
                }
            });
        }
    },
    fancy: {
        init: function p() {
            if ($.fn.fancybox()) {
                var element = document.querySelectorAll(".fancybox");
                if (element !== null || element.length > 0) {
                    for (var i = 0; i < element.length; i++) {
                        var el = element[i];
                        $(el).fancybox();
                    }
                    $('[data-fancybox]').fancybox({
                        afterShow: function (instance, current) {}
                    });
                }
            }
        },
        open: function (el, type,isProtect) {
            type = (type !== "") ? type : "inline";
            var element = (typeof el === "object") ? el : EGEGEN.getByID(el);
            isProtect = (isProtect !== null) ? isProtect : false;
            $.fancybox.open({
                src: element,
                type: type,
                opts : {
                    transitionDuration: 2000,
                    protect: isProtect,
                    keyboard: isProtect,
                    touch: isProtect,
                    smallBtn : false,
                    clickSlide:false,
                    beforeLoad  : function( instance, current ) {
                        instance.showLoading();
                        instance.$refs.toolbar.show();
                    },
                    afterClose: function( instance, current ) {
                        $(el).remove();
                        return false;
                    }
                }
            });
        }
    },
    picker: function(element, opt) {
        
            element = element || document.querySelectorAll(".picker");
            if(!element || element.length < 1) {return false;}
            var mFormat = 'MM/DD/YYYY',
                    dateFormat = 'DD/MM/YYYY',
                    monthFormat = "MM/YYYY",
                    timezone = "Europe/Istanbul",
                    today = moment(new Date(),["MM-DD-YYYY", "YYYY-MM-DD"]).format(mFormat),
                    defaultOpt = {
                        language: (LANG ? "tr" : "tr"),
                        todayHighlight: true,
                        toggleActive:false,
                        enableOnReadonly:true
                    };
            if (element.length > 0) {
                for (var i = 0; i < element.length; i++) {
                    var el = element[i],
                            newObj = {};
                    if (el.getAttribute("value")) {
                        defaultOpt["today"] = moment(el.getAttribute("value")).format(mFormat);
                    }
                    if (typeof $(el).attr("data-min") !== "undefined") {
                        defaultOpt["startDate"] =  new Date(el.getAttribute("data-min"));
                    }
                    if (typeof $(el).attr("data-max") !== "undefined") {
                        defaultOpt["endDate"] =  new Date(el.getAttribute("data-max"));
                    }
                    if (opt !== null) {
                        newObj = $.extend({}, defaultOpt, opt);
                    } else {
                        newObj = EGEGEN.addObj(defaultOpt, newObj);
                    }
                    $(el).datepicker(newObj);
                }
            }

    },
    formValidation: function (form, callback, opt) {
            var newObj = {},
                    defaultOpt = {
                        errorPlacement: function (error, element) {
                            error.addClass("help-block");

                            if (element.prop("type") === "checkbox") {
                                error.insertAfter(element.parent("label"));
                            } else {
                                error.insertAfter(element.closest(".input, .select, .textarea"));
                            }
                        },
                        highlight: function (element, errorClass, validClass) {
                            $(element).parents(".form-group").addClass("has-error").removeClass("has-success");
                        },
                        unhighlight: function (element, errorClass, validClass) {
                            $(element).parents(".form-group").addClass("has-success").removeClass("has-error");
                        }
                    };
            if (opt !== null) {
                newObj = $.extend({}, defaultOpt, opt);
            } else {
                newObj = EGEGEN.addObj(defaultOpt, newObj);
            }
            $(form).validate({
                ignore: ':hidden:not(:checkbox)',
                errorPlacement: function (error, element) {
                    error.addClass("help-block");
                            if (element.prop("type") === "checkbox") {
                                error.insertAfter(element.parent("label"));
                            } else {
                                element.closest(".form-group").append(error);
                            }
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).parents(".form-group").addClass("has-error").removeClass("has-success");
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).parents(".form-group").addClass("has-success").removeClass("has-error");
                },
                submitHandler: callback,
                showErrors: function (errorMap, errorList) {
                    var errors = this.numberOfInvalids();  // <- NUMBER OF INVALIDS
                    //console.log(errorList);
                    this.defaultShowErrors(); // <- ENABLE default MESSAGES
                }
            });
        },
    isNumber:function(evt){
            var theEvent = evt || window.event;

            // Handle paste
            if (theEvent.type === 'paste') {
                key = event.clipboardData.getData('text/plain');
            } else {
            // Handle key press
                var key = theEvent.keyCode || theEvent.which;
                key = String.fromCharCode(key);
            }
            var regex = /[0-9]|\./;
            if( !regex.test(key) ) {
              theEvent.returnValue = false;
              if(theEvent.preventDefault) theEvent.preventDefault();
            }
        },    
    getSpace: function() {
        var ww = parseInt(window.innerWidth),
                header = document.getElementById('footer'),
                container = header.querySelector(".container"),
                space = (ww - parseInt(container.offsetWidth)) / 2;
        return space;
    },
    getOffset: function(el) {
        var rect = el.getBoundingClientRect();
        return {
          left: parseInt(rect.left) + parseInt(window.scrollX),
          top: parseInt(rect.top) + parseInt(window.scrollY)
        };
    },
    setAttr: function(el,attrs) {
        for(var key in attrs) {
            el.setAttribute(key, attrs[key]);
          }
    },
    addObj: function p(defaultObj, newObj) {
        for (var prop in newObj) {
            defaultObj[prop] = newObj[prop];
        }
        return defaultObj;
    },
    isDevice: function p() {
        var check = false,
                userClass = "",
                isMac = navigator.appVersion.indexOf("Mac") >= 0,
                isIpad = navigator.userAgent.match(/iPad/i) != null;
        (function (a) {
            if (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0, 4)))
                check = true;
        })(navigator.userAgent || navigator.vendor || window.opera);

        if (isMac) {
            userClass += " mac ";
        }
        if (isIpad) {
            userClass += " ipad ";
        }
        if (check) {
            userClass = " mobile ";
        }
        var browserARR = this.browserSpecs(),
                bName = (browserARR.name).toLowerCase(),
                bVersion = browserARR.version;
        if (bName === 'msie' && browserARR.version < 10) {
            bVersion = "old";
        }
        userClass += bName + " " + bName + "_" + bVersion;
        document.documentElement.className += userClass.trim();
    },
    loader: function () {
        var loader = EGEGEN.getByID("loader"),
            lSVG = '<svg class="loader-svg" height="48px" width="48px"><circle class="path-bg" cx="24" cy="24" fill="none" r="22" stroke="#eeeeee" stroke-width="4"></circle><circle class="path" cx="24" cy="24" fill="none" r="22" stroke="#d50032" stroke-miterlimit="10" stroke-width="4"></circle></svg></div>',
            active = "show",
            timeOut = parseInt(performance.now()) + 100,
            browserARR = EGEGEN.browserSpecs();
            if(loader === null) {
                loader = document.createElement("DIV");
                loader.id = "loader";
                loader.className = "fullscreen";
                loader.className += " " + active;
                loader.innerHTML = lSVG;
                document.body.appendChild(loader);
            }
        if (browserARR.version < 10) {
            loader.parentNode.removeChild(loader);
        } else {
            setTimeout(function() {
                //EGEGEN.removeClass(loader,active)
                var reg = new RegExp('(\\s|^)' + active + '(\\s|$)');
                loader.className = loader.className.replace(reg, ' ');
            },timeOut);
        }
    },
    backTop: function() {
        var el = EGEGEN.el(".back-to-top");
        if (!el) {return false;}
        el.addEventListener("click", function () {
            $('html, body').animate({
                scrollTop: 0
            }, 300);
        });   
    },
    alertBrowser: {
        init: function () {
            var sb = {
                host: (BASE_URL !== "") ? BASE_URL : window.location.host,
                asset_host: "assets/img/browser/",
                message: "Tarayıcınızın versiyonu çok eski ve sitemiz tarafından desteklenmemektedir.<br />Sitemizi düzgün görüntülemek istiyorsanız aşağıdak tarayıcılardan birini bilgisayarınıza yükleyerek devam edebilirsiniz.",
                br: [
                    {
                        icon: "firefox.png",
                        text: "Mozilla Firefox",
                        url: "https://www.mozilla.org/tr/firefox/"
                    },
                    {
                        icon: "chrome.png",
                        text: "Google Chrome",
                        url: "https://www.google.com/chrome/"
                    },
                    {
                        icon: "opera.png",
                        text: "Opera",
                        url: "https://www.opera.com/tr"
                    },
                    {
                        icon: "edge.png",
                        text: "Internet Explorer (10+)",
                        url: "https://www.microsoft.com/tr-tr/windows/microsoft-edge"
                    }
                ]
            },
                    browserARR = EGEGEN.browserSpecs(),
                    bName = (browserARR.name).toLowerCase();

            if (bName === 'msie' && browserARR.version < 10) {
                this.addPopupCSS();

                var pHTML = '<p>' + sb.message + '</p>',
                        pb = sb.br;

                pHTML += '<div class="e-p-browsers">';
                for (var i = 0; i < pb.length; i++) {
                    var bIMG_URL = sb.host + sb.asset_host + pb[i].icon;
                    pHTML += '<div class="e-browser-item"><a href="' + pb[i].url + '" target="_blank"><b>' + pb[i].text + '</b><div><img src="' + bIMG_URL + '" alt="" /></div></a></div>';
                }

                pHTML += '</div>';
                this.addPopupHTML(pHTML);
                document.body.style.overflow = "hidden";
            }
        },
        addPopupHTML: function (c) {
            var popupHTML = '<div class="e-popup"><div class="e-popup-body"><div class="e-popup-content">' + c + '</div></div><div class="e-popup-bg"></div></div>';
            document.body.innerHTML += popupHTML;
        },
        addPopupCSS: function () {
            var sheet = '.e-popup {position:fixed;display:table;top:0;left:0;bottom:0;right:0;width:100%;height:100%;z-index:9990;}.e-popup-bg{display:block;position:fixed;top:0;left:0;width:100%;height:100%;background-color:#000000; opacity: 0.9;filter: alpha(opacity=90)} .e-popup-body {display: table-cell;width: 100%;height: 100%;vertical-align: middle;position:relative;z-index:99999;}.e-popup-content{text-align: center;background: #ffffff;margin: 0 auto;max-width: 800px;padding:50px 30px;font-size:18px;}.e-popup-content p {margin-bottom:35px;}.e-p-browsers{display: table;width:100%;}.e-browser-item{display: table-cell;text-align:center;}',
                    sheetEl = document.createElement('style');
            document.getElementsByTagName('head')[0].appendChild(sheetEl);
            sheetEl.setAttribute('type', 'text/css');
            sheetEl.styleSheet.cssText = sheet;
        }
    },
    browserSpecs: function () {
        var ua = navigator.userAgent, tem,
                M = ua.match(/(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*(\d+)/i) || [];
        if (/trident/i.test(M[1])) {
            tem = /\brv[ :]+(\d+)/g.exec(ua) || [];
            return {name: 'IE', version: (tem[1] || '')};
        }
        if (M[1] === 'Chrome') {
            tem = ua.match(/\b(OPR|Edge)\/(\d+)/);
            if (tem != null)
                return {name: tem[1].replace('OPR', 'Opera'), version: tem[2]};
        }
        M = M[2] ? [M[1], M[2]] : [navigator.appName, navigator.appVersion, '-?'];
        if ((tem = ua.match(/version\/(\d+)/i)) != null)
            M.splice(1, 1, tem[1]);
        return {name: M[0], version: M[1]};
    }
};   

document.addEventListener("DOMContentLoaded", function () {
    EGEGEN.init();
});

