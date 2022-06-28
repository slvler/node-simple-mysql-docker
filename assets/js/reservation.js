
'use strict';
var GenReservation = {
    init: function() {
        var _self = this;
        _self.ReservationSearch.init();
    },
    ReservationSearch: {
        init: function() {
            var _self = this,
               
            form = EGEGEN.getByID("formReservationSearch");  
             _self.installmentTable = "";  
            _self.initDateRange();
            _self.setRoomGuest(form);
            _self.selectPackage(form);
            _self.setAgencyCode();
            _self.setInsurance();
            _self.setDiscount();
            _self.setPaymentHotel();
            _self.calcTotal();
            


        },
        setRoomGuest: function(form) {
            var _self = this,
            formGuest = form,
            jsFormPanel = ".js-r-rooms-guests-panel", 
            formPanel = EGEGEN.find(formGuest,jsFormPanel),
            btnMinus= ".js-minus",
            btnPlus = ".js-plus",
            tempAdultChildrenArea = ".js-adult-children-wrapper",
            tempChildrenCountArea = ".js-adult-children-block",
            tempAdultChildren = EGEGEN.getByID("temp_adult_children"),
            tempChildrenCount = EGEGEN.getByID("temp_children_count"),
            roomNumber = '.js-number-of-rooms',
            adultNumber = '.js-number-of-adults',
            childrenNumber = '.js-number-of-children',
            childrenCountArea = '.js-children-count-area',
            jsGuestErr = '.js-r-search-guest-err',
            guestMessage = ".js-room-guest-message",
            guestWrapper = ".rooms-guest-wrapper",
            jsRooms = 'js-rooms',
            jsAdults = 'js-adults',
            jsChildren = 'js-children',
            jsChild = '.js-child',
            jsAdultMax = '.js-adult-max',
            jsChildrenMax = '.js-children-max',
            formGroup = '.form-group',
            input = '.form-control',
            isHidden = 'is-hidden',
            inactive = 'is-inactive';
            
            if(!formGuest) {return false;}
            /* 
             * Oda,yetişkin,çocuk yaşı değiştiğinde her bir alanı(oda,yetişkin,çocuk) 
             * gruplayarak toplamlarını yazdırır. 
             * */
             var setGuestRoomNumber = function(btn) {
                var panel = EGEGEN.findClosest(btn,jsFormPanel),
                formInput = panel.previousElementSibling,
                roomNumb = EGEGEN.find(formInput, roomNumber),
                adultNumb = EGEGEN.find(formInput, adultNumber),
                childrenNumb = EGEGEN.find(formInput, childrenNumber),
                setValue = function(el,inputs) {
                    var total = 0;
                    for(var i=0;i<inputs.length;i++) {
                        total += parseInt(inputs[i].value);
                    }
                    el.innerHTML = total;
                },
                roomGroups = EGEGEN.find(panel, "."+ jsRooms),
                roomInputs =  EGEGEN.findAll(roomGroups, input),
                adultGroups = EGEGEN.findAll(panel,"."+jsAdults),
                adultInputs = [],
                childrenGroups = EGEGEN.findAll(panel,"."+jsChildren),
                childrenInputs = [];
                
                adultGroups.forEach(function(group) {
                    adultInputs.push(EGEGEN.find(group, input));
                }); 
                childrenGroups.forEach(function(group) {
                    childrenInputs.push(EGEGEN.find(group, input));
                }); 
                setValue(roomNumb,roomInputs); 
                setValue(adultNumb,adultInputs); 
                setValue(childrenNumb,childrenInputs); 
            },
            setRoomMax = function(group,sGroup,step) {
                var isReturn = false,
                tempMaxCapacity = function(g,c) {
                    var elMessage = EGEGEN.find(g,guestMessage),
                    wrapper = EGEGEN.find(g,guestWrapper),    
                    childTemp = '<div class="alert alert-danger js-room-guest-message" role="alert">' +msgGuestMaxRoomCapacity + '</div>',
                    div = document.createElement('div');    
                    if(elMessage) {
                        elMessage.parentNode.removeChild(elMessage);
                    }
                    if(c) {
                        div.innerHTML = childTemp.trim();
                        wrapper.appendChild(div.firstChild);  
                    }
                },        
                /* Seçilen yetişkin ve çocuk sayısının max değerlerini ve olması gereken değerlerini düzenler */        
                setMaxInput = function(g,i,s) {
                    var elGroupBlock = EGEGEN.findClosest(i,tempChildrenCountArea),
                    thisGroup = EGEGEN.findClosest(i,formGroup);
                    if(EGEGEN.hasClass(thisGroup,jsRooms)) {return false;};
                            //elRoomGroup = EGEGEN.find(elGroupBlock,'.' + jsRooms),
                            //elRoomInput = EGEGEN.find(elRoomGroup, input),
                            //elRoomVal = parseInt(elRoomInput.value),
                            var elAdultGroup = EGEGEN.find(elGroupBlock,'.' + jsAdults),
                            elAdultInput = EGEGEN.find(elAdultGroup, input),
                            elAdultVal = (elAdultInput === i) ? parseInt(elAdultInput.value) + s : parseInt(elAdultInput.value),
                            elChildrenGroup = EGEGEN.find(elGroupBlock,'.' + jsChildren),
                            elChildrenInput = EGEGEN.find(elChildrenGroup, input),
                            elChildrenVal = (elChildrenInput === i) ? parseInt(elChildrenInput.value) + s : parseInt(elChildrenInput.value),
                            totalAdultChild = elAdultVal + elChildrenVal,
                            thisForm = EGEGEN.findClosest(g,"FORM"),
                            elGuestErr = EGEGEN.find(thisForm,jsGuestErr),
                            isRet = false;  
                            

                            $(elAdultInput).attr("data-max",3);
                            $(elChildrenInput).attr("data-max",2);
                            
                            var btnC = $(elChildrenGroup).find(".js-plus");
                            EGEGEN.removeClass(btnC[0],inactive);
                            var btnA = $(elAdultGroup).find(".js-plus");
                            EGEGEN.removeClass(btnA[0],inactive);  
                            
                            if(elAdultVal >= 3) {
                                $(elAdultInput).attr("data-max",3);
                                $(elChildrenInput).attr("data-max",1);
                                if(elChildrenVal === 1) {
                                    var btn = $(elChildrenGroup).find(".js-plus");
                                    EGEGEN.addClass(btn[0],inactive);
                                }
                            }
                            if(elChildrenVal >= 2) {
                                $(elAdultInput).attr("data-max",2);
                                $(elChildrenInput).attr("data-max",2);
                                if(elAdultVal === 2) {
                                    var btnPlus = EGEGEN.find(elAdultGroup,".js-plus");
                                    EGEGEN.addClass(btnPlus,inactive);
                                }
                            }
                            
                            /* Seçilen yetişkin ve çocuk sayısı toplamı, oda kapasitesinden küçük ise */  
                            if(totalAdultChild < 4 ) {
                                tempMaxCapacity(group,false);
                                isRet = false;
                            } 
                            
                            
                            /* seçilen yetişkin ve çocuk sayısı toplamı, Oda kapasitesine eşit ise */ 
                            else if(totalAdultChild === 4 && elAdultVal >= 2 && elChildrenVal >= 2) {
                                tempMaxCapacity(group,true);
                                isRet = false;
                                
                            } else if(totalAdultChild === 4 && elAdultVal >= 3 && elChildrenVal >= 1) {
                                tempMaxCapacity(group,true);
                                isRet = false;
                            } 
                            /* seçilen yetişkin ve çocuk sayısı toplamı, Oda kapasitesinden büyük ise */ 
                            else {
                                tempMaxCapacity(group,true);
                                isRet = true;
                            } 
                            if (4 === totalAdultChild) {
                                elGuestErr.innerHTML = msgGuestMaxRoom;
                            } else {
                                elGuestErr.innerHTML = "";
                            }
                            return isRet;
                            
                        };
                        isReturn = setMaxInput(group,sGroup,step);
                        
                        return isReturn;
                    },
            /* 
             * Yetişkin-Çocuk ve Çocuk sayısı template kontrollerini yapar 
             * */       
             setChildrenText = function(group,val, min, btn) {
                /* 
                 * Oda seçimine göre yeni yetişkin ve çocuk input oluşturur/siler. 
                 * */
                 if(EGEGEN.hasClass(group,jsRooms)) {
                    var elInput = EGEGEN.find(group,input),
                    datas = {
                        index: elInput.value
                    };
                    
                    if(btn === "remove") {
                        var adultChildrenWrapper = group.nextElementSibling,
                        lastElement = adultChildrenWrapper.lastElementChild;
                        if(lastElement) {
                            lastElement.parentNode.removeChild(lastElement);
                        }
                    }
                    if(btn === "add") {    
                        createTemplate(group,datas); 
                    }  
                }
                
                /* 
                 * Çocuk seçimine göre yeni çocuk yaşı oluşturur/siler. 
                 * */
                 if(EGEGEN.hasClass(group,jsChildren)) {
                    var childrenNumb = EGEGEN.find(form, childrenNumber);
                    childrenNumb.innerHTML = val;
                    if(val === min) {
                        var childs = EGEGEN.findAll(form,jsChild);
                        for(var i =0;i<childs.length;i++) {
                            EGEGEN.addClass(childs[i],isHidden);
                        }
                    }
                    if(val > min) {
                        var childs = EGEGEN.findAll(form,jsChild);
                        for(var i =0;i<childs.length;i++) {
                            EGEGEN.removeClass(childs[i],isHidden);
                        }
                    }
                    var elCountArea = group.nextElementSibling,
                    elInput = EGEGEN.find(group,input),
                    groupParent = group.parentNode,
                    groupAdult = group.previousElementSibling,
                    inputAdult = EGEGEN.find(groupAdult,input),
                    lastElement = groupParent.lastElementChild,
                    datas = {
                        index: val,
                        adult: groupParent.getAttribute("data-id")
                    };
                    if(btn === "remove") {
                        if(elCountArea) {
                            lastElement.parentNode.removeChild(lastElement);
                        }
                    }
                    if(btn === "add") {    
                        var elInput = EGEGEN.find(group,input);
                        createTemplate(group,datas); 
                    }  
                }
            },
            /* 
             * Yetişkin-Çocuk ve Çocuk sayısı template'lerini projele ekler 
             * */
             createTemplate = function(group,datas) {
                /* Template'i oluşturarak alana ekler */
                var addTemp = function(tempEL,data,addedTemp) {
                    var template = $(tempEL).html();
                    Mustache.parse(template);
                    var rendered = Mustache.render(template,data);
                    $(addedTemp).append(rendered);
                };
                if(EGEGEN.hasClass(group,jsRooms)) {
                    addTemp(tempAdultChildren,datas,EGEGEN.find(formPanel,tempAdultChildrenArea));
                }
                if(EGEGEN.hasClass(group,jsChildren)) {
                    addTemp(tempChildrenCount,datas,EGEGEN.findClosest(group,tempChildrenCountArea));
                }
            };
            $(formGuest).on("click",btnPlus, function (e) {
                var _self = this;
                var elGroup = EGEGEN.findClosest(_self, formGroup),
                elInput = EGEGEN.find(elGroup, input),
                inputVal = parseInt(elInput.getAttribute('value'));
                
                var elGroupPanel = EGEGEN.findClosest(_self,jsFormPanel);
                if(setRoomMax(elGroupPanel,elInput,+1)) {return false;} 
                var elDataMin = parseInt(elInput.getAttribute("data-min")),
                elDataMax = parseInt(elInput.getAttribute("data-max"));
                if (inputVal <= elDataMax) {
                    inputVal = inputVal + 1;
                    elInput.setAttribute("value",inputVal);
                    
                    EGEGEN.removeClass(this.previousElementSibling, inactive);
                }  
                if (inputVal >=  elDataMax) {
                    EGEGEN.addClass(_self, inactive);
                } 
                
                setChildrenText(elGroup,inputVal,elDataMin,"add");
                setGuestRoomNumber(_self);
            });
            $(formGuest).on("click",btnMinus, function(e) {
                var _self = this;
                var elGroup = EGEGEN.findClosest(_self,formGroup),
                elInput = EGEGEN.find(elGroup, input),
                inputVal = parseInt(elInput.getAttribute('value'));
                
                var elGroupPanel = EGEGEN.findClosest(_self,jsFormPanel);
                if(setRoomMax(elGroupPanel,elInput,-1)) {return false;} 
                var elDataMin = parseInt(elInput.getAttribute("data-min")),
                elDataMax = parseInt(elInput.getAttribute("data-max")); 
                if(inputVal > elDataMin) {
                    inputVal = inputVal - 1;
                    elInput.setAttribute("value",inputVal);
                } 
                
                if(inputVal <= elDataMax) {
                    EGEGEN.removeClass(this.nextElementSibling,inactive);
                }
                if(inputVal >= elDataMax) {
                    EGEGEN.addClass(_self,inactive);
                }
                
                setChildrenText(elGroup,inputVal,elDataMin,"remove");
                setGuestRoomNumber(_self);
            }); 
        },
        initDateRange: function(inputRange) {
            inputRange = EGEGEN.el(inputRange) || EGEGEN.el(".daterange");
            if(!inputRange) {return false;}
            function cb(start, end) {
                $('#reportrange span').html(start.format('MMMM D') + ' - ' + end.format('MMMM D'));
            }
            cb(moment().subtract(29, 'days'), moment());
            return $(inputRange).daterangepicker({
                opens: 'right',
                
                    //"autoApply": true,
                    "applyClass": "btn btn-xs btn-primary",
                    "cancelClass": "btn btn-xs btn-warning", 
                    "minDate": moment(new Date()),
                    locale: rangeLocale,
                    firstDayOfWeek:1
                },cb);
        },
        /* Paket ve teklifleri seçer */
        selectPackage: function(copyForm) {
            var _self = this,
            formPackage = EGEGEN.getByID('formPackageSelect'),
            packageItem = ".PackageSearchItem",
            btnPackageSelect = ".btn-package-select",
            activeClass = "package--active",
            tempSearchForm = EGEGEN.getByID("temp_package_search_form"),
            setPackage = function(clickedBtn,item) {
                var datas =  clickedBtn.dataset,
                isActiveClicked = false;    
                $(formPackage).find(packageItem).each(function() {
                    var btn = $(this).find(btnPackageSelect)[0];
                    if(btn === clickedBtn && $(this).hasClass(activeClass)) {
                        isActiveClicked = true;
                    } else {
                        $(this).removeClass(activeClass);
                    }
                });
                if(isActiveClicked) {
                    return false;
                }  else {
                    var searchForm = EGEGEN.find(formPackage,".PackageSearchForm");
                    if(searchForm) {
                        searchForm.parentNode.removeChild(searchForm);
                    }
                    
                }
                
                $(item).addClass(activeClass);
                
                var copyDiv = document.createElement("DIV");
                copyDiv.className= "tblRow PackageSearchForm";
                var template = $(tempSearchForm).html();
                Mustache.parse(template);
                var rendered = Mustache.render(template,datas);
                $(item).after(rendered);
                
                _self.setRoomGuest(formPackage);
                
            };
            
            if(!formPackage) {return false;}
            $(btnPackageSelect).on("click", function(e) {
                e.preventDefault();
                setPackage(this,$(this).closest(packageItem));
            });
        },
        /* Acente Kodu  değiştiğinde çalışır */
        setAgencyCode:function() {
            var form = EGEGEN.getByID("formReservationDetail"),
            agencyCode = EGEGEN.el(".agency-code");
            if(!agencyCode) {return false;}
            var agencyHidden = EGEGEN.find(form,"[name=agency_code]");
            $(agencyCode).bind('input change paste keyup mouseup',function(e){
                var val = this.value;
                agencyHidden.value = val.trim();
            });
        },
        /* İptal ve İade sigortası değiştiğinde çalışır */
        setInsurance: function(){
            var _self = this,
            checkInsurance = EGEGEN.el("[name=return_insurance]"),
            inputHidTotalInsurance = EGEGEN.el("[name=total_insurance]");  
            if(!checkInsurance) {return false;} 
            checkInsurance.addEventListener("change", function() {
                var jsInsurance = EGEGEN.el(".js-price-insurance");
                $(jsInsurance).toggleClass("hide");
                if(this.checked) {
                    inputHidTotalInsurance.value = this.value;
                } else {
                    inputHidTotalInsurance.value ="";
                }
                _self.calcTotal();
            });
        },
        /* Otelde ödeme yapmak istiyorum değiştiğinde çalışır */
        setPaymentHotel: function() {
            var _self = this,
                checkOteldeOdeme = EGEGEN.el("[name=pay_hotel]"),
                tblInstallmentTable = EGEGEN.el(".monthly-payment");
                if(!checkOteldeOdeme) {return false}
                
            checkOteldeOdeme.addEventListener("change", function(e) {
                e.preventDefault();
                var selectedInstallment = EGEGEN.el('input[name="hire_purchase"]:checked').getAttribute("data-installment");
                
                /* Eğer taksit seçenekleri tek çekim değilse hata ver */
                if(selectedInstallment !== "1") {
                    $.toast().reset('all');
                    $("body").removeAttr('class');
                    $.toast({
                        heading: text_payment_option_title,
                        text: text_payment_option_message,
                        position: 'top-right',
                        loaderBg:'#e69a2a',
                        icon: 'error',
                        hideAfter: 3500
                    });
                    checkOteldeOdeme.checked = false;
                    return false;
                }
                _self.calcTotal();

            });
            
        },
        setDiscount: function() {
            var _self = this,
            radioDiscount = EGEGEN.els("[name=hire_purchase]"),
            jsPriceDiscount = EGEGEN.el(".js-price-discount"),
            inputHidTotalDiscount = EGEGEN.el("[name=total_discount]");
            
            $(radioDiscount).on("click", function() {
                if(radioDiscount[0].id === this.id) {
                    $(jsPriceDiscount).removeClass("hide");
                } else {
                    $(jsPriceDiscount).addClass("hide");
                }
                _self.calcTotal();
            });
        },
        /* Ödeme tablosunu tek çekim toplam fiyat yap */
        setInstallmentTable: function(is) {
        	var _self = this;
                var total = EGEGEN.getByID("txtTotalPrice"),
                    valTotal = total.innerHTML,
                    tblInstallmentTable = EGEGEN.el(".monthly-payment"),

                    installmentTbl = EGEGEN.find(tblInstallmentTable,"TABLE"),

                    /* Taksit tablosunu oluşturur */
                    createTable = function(tbl,val) {
                    	for (var i = 0, row; row = tbl.rows[i]; i++) {
	                        if(i>0) {
	                            for (var j = 0, col; col = row.cells[j]; j++) {
	                                if(j>0) {
	                                	var total = (typeof val === "object") ? val[j-1] : val;
	                                    col.innerHTML = total;
	                                }
	                            }
	                        }
	                        
	                    }

                    };
                 if(is) {
                 	createTable(installmentTbl,valTotal);

                 } else {
                 	var radioTaksitler = EGEGEN.els("[name=hire_purchase]"),
                 		inputHidCurrency = EGEGEN.el("[name=currency]"),
                 		taksitARR = [];
                 		radioTaksitler.forEach(function(taksitELement){
                 			taksitARR.push(taksitELement.value);
                 		});

                 	createTable(installmentTbl,taksitARR); 
                 		
                 	if(!_self.installmentTable) {
                 		_self.installmentTable = tblInstallmentTable.innerHTML;
                 	}	

                    tblInstallmentTable.innerHTML = _self.installmentTable;
                 }  
        },
        calcTotal: function() {
        	var _self = this;
            var radioTaksitler = EGEGEN.els("[name=hire_purchase]"),
            radioTotalTaksit = EGEGEN.el("[name=hire_purchase]:checked"),
            inputHidCurrency = EGEGEN.el("[name=currency]"),
            inputHidAgencyPrice = EGEGEN.el("[name=agency_price]"),
            inputHidTotalAmount = EGEGEN.el("[name=total_amount]"),
            inputHidTotalInsurance = EGEGEN.el("[name=total_insurance]"),
            inputHidInsuranceRate = EGEGEN.el("[name=insurance_rate]"),
            inputHidTotalDiscount = EGEGEN.el("[name=total_discount]"),
            inputHidDiscountType = EGEGEN.el("[name=discount_type]"),
            inputHidTotalTax = EGEGEN.el("[name=total_tax]"),
            inputHidTotalPrice = EGEGEN.el("[name=total_price]"),
            inputHidDepositPercent = EGEGEN.el("[name=deposit_percent]"),
            inputHidDepositTotal = EGEGEN.el("[name=deposit_total]"),
            checkIadeSigorta = EGEGEN.el("[name=return_insurance]"),
            checkOteldeOdeme = EGEGEN.el("[name=pay_hotel]"),
            inputHidBankName = EGEGEN.getByID("bank_name"),
            txtTaxPrice = EGEGEN.getByID("txtTaxPrice"),
            txtDiscountPrice = EGEGEN.getByID("txtDiscountPrice"),
            txtInsurancePrice = EGEGEN.getByID("txtInsurancePrice"),
            installment = EGEGEN.getByID("installment"),
            txtsubTotalPrice = EGEGEN.getByID("txtsubTotalPrice"),
            txtTotalPrice = EGEGEN.getByID("txtTotalPrice");

            if(radioTaksitler.length < 1) {return false;}

            installment.value = $(radioTotalTaksit).data("installment");
            
            var vCurrency =  inputHidCurrency.value,
            vTotalAmount =  inputHidTotalAmount.value,
            vAgencyPrice =  inputHidAgencyPrice.value,
            vTotalTax = inputHidTotalTax.value,
            vTotalInsurance =  inputHidTotalInsurance.value,
            vInsuranceRate = inputHidInsuranceRate.value,
            vTotalDiscount =  inputHidTotalDiscount.value,
            vDepositPercent= inputHidDepositPercent.value,
             /* 
             	0: Peşinat indirimi
             	1: Erken rezervasyon indirimi 
             */
            vDiscountType = parseInt(inputHidDiscountType.value),
            vBankName = inputHidBankName.value, 
            vTotalCheckedInsurance = 0,
            vTotal = null;

            var vTotalTaksit = radioTotalTaksit.value;
            
            vTotalAmount = (vTotalAmount) ? EGEGEN.formatNumberFromMoney(vTotalAmount) : 0;
            vAgencyPrice = (vAgencyPrice) ? EGEGEN.formatNumberFromMoney(vAgencyPrice) : 0;
            vTotalInsurance = (vTotalInsurance) ? EGEGEN.formatNumberFromMoney(vTotalInsurance) : 0;

            vTotalTaksit = (vTotalTaksit) ? EGEGEN.formatNumberFromMoney(vTotalTaksit) : 0;
            vTotalDiscount = (vTotalDiscount) ? EGEGEN.formatNumberFromMoney(vTotalDiscount) : 0;
            vTotalTax = (vTotalTax) ? EGEGEN.formatNumberFromMoney(vTotalTax) : 0;
            /* Peşinat indirimi (discount_Type 0) sa otelde ödeme yapmak istiyorum seçiliyse dil trden farklıysa banka other sa indirim uygulama. */
            if(vDiscountType == 1) {
                
            } else if(vDiscountType == 0) {
                if (checkOteldeOdeme.checked || LANG !=="tr" || vBankName === "Other" || vAgencyPrice) {
                    vTotalDiscount = 0;
                }
                
            }


            /* Taksitlerin fiyatlarını oluşturuyor */
            var i=0;
            radioTaksitler.forEach(function(taksitELement){
                var vTotal = 0;
                if(i==0) {

                    vTotal = vAgencyPrice + vTotalAmount + vTotalDiscount + vTotalTax;
                    
                } else {
                    var discount = (vDiscountType === 1) ?  vTotalDiscount : 0;
                    vTotal = vAgencyPrice + vTotalAmount + vTotalTax + discount;
                }
                if(checkIadeSigorta.checked) {

                    vTotalInsurance = (vTotal*parseInt(vInsuranceRate))/100;
                    vTotal = vTotal + vTotalInsurance;
                    if(taksitELement === radioTotalTaksit) {
                        vTotalCheckedInsurance = vTotalInsurance;
                    }
                } else {
                    vTotalInsurance = 0;
                }

                taksitELement.value = EGEGEN.formatMoney(vTotal);
                var label = taksitELement.nextElementSibling,
                span = label.querySelector(".hirePurchaseAmount");

                span.innerHTML = EGEGEN.formatMoney(vTotal)  + " " + vCurrency;    

                if(checkOteldeOdeme.checked || LANG !=="tr" || vBankName === "Other" || vAgencyPrice) {
                    if(i==0) {
                        taksitELement.checked = true;
                    }
                    if(i>0) {
                        $(taksitELement).closest(".hirePurchaseItem").addClass("hide");
                    }
                } else {
                    $(taksitELement).closest(".hirePurchaseItem").removeClass("hide");

                }

                i++;
            });

            /* Tek çekim seçilmişse peşinat indirimi uyguluyor */
            var seciliTaksit = EGEGEN.formatNumberFromMoney(radioTotalTaksit.value);

            if(radioTaksitler[0] !== radioTotalTaksit) {
                vTotalDiscount = 0;
            }



            /* Peşinay indirimi yoksa gösterme */
            if(vTotalDiscount===0) {
                EGEGEN.addClass(EGEGEN.el(".js-price-discount"),"hide");
            } else {
                EGEGEN.removeClass(EGEGEN.el(".js-price-discount"),"hide");
            }
            if(vDiscountType===1) {
                EGEGEN.addClass(EGEGEN.el(".js-price-discount"),"hide");
            }
            
            /* Toplamı oluşturuyor */
            //vTotal = vAgencyPrice + vTotalInsurance + vTotalAmount + vTotalDiscount + vTotalTax;
            
            vTotal = seciliTaksit;

            /* Otelde ödeme seçildiğinde toplam fiyatın deposito yüzdesi hesaplanarak otelde ödeme yapacağı tutar oluşturulur. */
            if (checkOteldeOdeme.checked) {
                txtsubTotalPrice.innerHTML = EGEGEN.formatMoney(vTotal);
                vTotal = (vTotal / 100) *  vDepositPercent;
                inputHidDepositTotal.value = EGEGEN.formatMoney(vTotal);
                /* Tek çekim değerlerini düzenliyor */
                radioTaksitler[0].value = EGEGEN.formatMoney(vTotal);
                var lblTekCekim = radioTaksitler[0].nextElementSibling,
                txtTekCekimAmount = EGEGEN.find(lblTekCekim,".hirePurchaseAmount");
                txtTekCekimAmount.innerHTML = EGEGEN.formatMoney(vTotal)  + " " + vCurrency
                $(txtsubTotalPrice.parentNode).removeClass("hide");
            } else {
                $(txtsubTotalPrice.parentElement).addClass("hide");
                inputHidDepositTotal.value = 0;
            }
            
            /* Sigorta Fiyatı */
            txtInsurancePrice.innerHTML = EGEGEN.formatMoney(vTotalCheckedInsurance);
            /* İndirim Fiyatı */
            txtDiscountPrice.innerHTML = EGEGEN.formatMoney(vTotalDiscount)  + " " + vCurrency;
            /* Toplam Fiyat */
            inputHidTotalPrice.value = EGEGEN.formatMoney(seciliTaksit);

            inputHidTotalInsurance.value = EGEGEN.formatMoney(vTotalCheckedInsurance);
            
            txtTotalPrice.innerHTML = EGEGEN.formatMoney(vTotal);

            /* Peşinat indirimi (discount_Type 0) sa otelde ödeme yapmak istiyorum seçiliyse dil trden farklıysa banka other sa taksit seçeneklerini tekrar oluştur. */
            if(vDiscountType == 1) {
                _self.setInstallmentTable(false);
            } else if(vDiscountType == 0) {
                if (checkOteldeOdeme.checked || LANG !=="tr" || vBankName === "Other" || vAgencyPrice) {
                    vTotalDiscount = 0;
                _self.setInstallmentTable(true);
                }else{
                    _self.setInstallmentTable(false);
                }
            }
        }
        
    },
    updateCardNumber: function(e) {
        var val = e.target.value;
        if (val.length >= 6) {
            $.ajax({
                type:"POST",
                url:"reservation/card_control",
                data: {"bin_number": val},
                success: function(msg){
                    var result = JSON.parse(msg);
                    $('#bank_name').val(result.bank_name);
                    if (result.bank_name != "Other") {
                        $('#card_type').val(result.card_type);
                    }
                    GenReservation.ReservationSearch.calcTotal();
                }
            });
        }
        if(val.length === 19) {

        } 
    },
    updateAgencyCode: function(e) {
        var _self = this,
        code = $('#agency_code').val(),
        txtAgencyPrice = EGEGEN.getByID("txtAgencyPrice"),
        txtTotalPrice = EGEGEN.getByID("txtTotalPrice"),
        inputHidAgencyPrice = EGEGEN.el("[name=agency_price]"),
        inputHidTotalDiscount = EGEGEN.el("[name=total_discount]"),
        agencyHidden = EGEGEN.el("[name=agency_code]"),
        radioTaksitler = EGEGEN.els("[name=hire_purchase]");
        if (code != "" || code != null) {
            $.ajax({
                type:"POST",
                url:"reservation/agency_code_control",
                data: {"agency_code": code, "total_price": e},
                success: function(msg){
                    if (msg == "empty") {
                        $.toast().reset('all');
                        $("body").removeAttr('class');
                        $.toast({
                            heading: agent_code_is_incorrect,
                            text: enter_the_agency_code,
                            position: 'top-right',
                            loaderBg:'#e69a2a',
                            icon: 'error',
                            hideAfter: 3500
                        });
                        return false;
                    }else{
                        inputHidAgencyPrice.value = msg;
                        agencyHidden.value = code;

                        txtAgencyPrice.innerHTML = msg;
                        GenReservation.ReservationSearch.calcTotal();
                        document.getElementById("button-addon2").disabled = true;

                        $.toast().reset('all');
                        $("body").removeAttr('class');
                        $.toast({
                            heading: agency_discount_has_been_made,
                            text: agency_success_text,
                            position: 'top-right',
                            loaderBg:'#e69a2a',
                            icon: 'success',
                            hideAfter: 3500, 
                            stack: 6
                        });
                        $('.agency-price-div').removeClass("hide");
                        return false;
                    }
                }
            });
        }
    }
};

document.addEventListener("DOMContentLoaded", function () {
    GenReservation.init();
});

