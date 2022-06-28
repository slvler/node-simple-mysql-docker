<?php
    /*
     * posnetoos_config.php
     *
     */

    /**
     * @package posnet oos
     */

    //Configuration parameters

    // canlı
    define('MID', '0000000000');
    define('TID', '00000000');
    define('POSNETID', '00000');
    define('ENCKEY', '10,10,10,10,10,10,10,10');

    //test
    // define('MID', '6797752273');
    // define('TID', '67554479');
    // define('POSNETID', '28972');
    // define('ENCKEY', '10,10,10,10,10,10,10,10');

    //Posnet Sistemi ile ilgili parametreler
    define('USERNAME', 'user');
    define('PASSWORD', 'pass');

    //OOS/TDS sisteminin web adresi
    define('OOS_TDS_SERVICE_URL', 'https://posnet.yapikredi.com.tr/3DSWebService/YKBPaymentService');
    // define('OOS_TDS_SERVICE_URL', 'https://setmpos.ykb.com/3DSWebService/YKBPaymentService');
    //Posnet XML Servisinin web adresi
    define('XML_SERVICE_URL', 'https://posnet.yapikredi.com.tr/PosnetWebService/XML');
    // define('XML_SERVICE_URL', 'https://setmpos.ykb.com/PosnetWebService/XML');
    
    //Üye iþyeri sayfasý baþlangýç web adresi (hata durumunda bu sayfaya dönülür.)
    define('MERCHANT_INIT_URL', 'https://localhost/reservation');
    //Üye Ýþyeri dönüþ sayfasýnýn web adresi
    define('MERCHANT_RETURN_URL', 'https://localhost/reservation/completed');
    
    //Þifreleme için PHP MCrypt modülünü kullan
	define('USEMCRYPTLIBRARY', false);
    define('OPEN_NEW_WINDOW', '0');
    
    //3D-Secure kontrolleri
    define('TD_SECURE_CHECK', true);
    define('USE_OOS_PAGE', false);
    define('TD_SECURE_CHECK_MASK', '1');
    // define('TD_SECURE_CHECK_MASK', '9');
?>