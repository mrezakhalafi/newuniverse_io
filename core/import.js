var PATHFILE = {
    LIB_JS: "/lib/jquery/js",
    LIB_ENCRYPT: "/lib/encrypt",
    LIB_QRCODE: "/lib/qrcode",
    LIB_BOOTS_CSS: "/lib/bootstrap/css",
    LIB_BOOTS_JS: "/lib/bootstrap/js",
    LIB_SIGNATURE: "/lib/signature",
    CORE: "/main/js/core",
    MAIN: "/main/js",
    THEME: "/main/css",
    LIB_THEME: "/lib/jquery/css",
    LIB_EU: "/lib/easyui",
    IMAGE: "/main/image",
    TRANSACTION: "/transaction/js",
    PURCHASE: "/transaction/js/purchase",
    PAYMENT: "/transaction/js/payment",
    INCENTIVE: "/transaction/js/incentive",
    HD: "/transaction/js/hd",
    TRANSCOMBINE: "/transaction/js/transcombine",
};

var JS_LIB = [
    {PATH: PATHFILE.LIB_JS, FILENAME: "jquery-1.8.3.min"},
    {PATH: PATHFILE.LIB_BOOTS_JS, FILENAME: "bootbox.min"},
    {PATH: PATHFILE.LIB_BOOTS_JS, FILENAME: "bootstrap.min"},
    {PATH: PATHFILE.LIB_SIGNATURE, FILENAME: "signature_pad"},
//    {PATH: PATHFILE.LIB_JS, FILENAME: "jquery.easyui.min"},
//    {PATH: PATHFILE.LIB_JS, FILENAME: "jquery.mobile-1.4.2"},
    {PATH: PATHFILE.LIB_JS, FILENAME: "jquery.pajinate"},
    {PATH: PATHFILE.LIB_ENCRYPT, FILENAME: "md5"},
    {PATH: PATHFILE.LIB_ENCRYPT, FILENAME: "esencrypt"},
    {PATH: PATHFILE.LIB_QRCODE, FILENAME: "qrcode"},
    {PATH: PATHFILE.CORE, FILENAME: "my-lib"},
    {PATH: PATHFILE.CORE, FILENAME: "my-component"},
    {PATH: PATHFILE.CORE + "/message", FILENAME: "message"},
    {PATH: PATHFILE.CORE + "/message", FILENAME: "sender"},
    {PATH: PATHFILE.MAIN, FILENAME: "combine-view"},
    {PATH: PATHFILE.MAIN, FILENAME: "constant"},
    {PATH: PATHFILE.MAIN, FILENAME: "submitform"}
];

var CSS_LIB = [
//    {PATH: PATHFILE.LIB_THEME, FILENAME: "jquery.mobile-1.4.2"},
    {PATH: PATHFILE.LIB_BOOTS_CSS, FILENAME: "bootstrap.min"},
//    {PATH: PATHFILE.LIB_EU, FILENAME: "gray/easyui"},
    {PATH: PATHFILE.THEME, FILENAME: "global"},
    {PATH: PATHFILE.THEME, FILENAME: "home"},
    {PATH: PATHFILE.THEME, FILENAME: "menu"},
    {PATH: PATHFILE.THEME, FILENAME: "formstyle"},
    {PATH: PATHFILE.THEME, FILENAME: "tablestyle"},
//    {PATH: PATHFILE.THEME, FILENAME: "transaction"}
];

function Import() {
    this.JavasriptLibraries = importJsLibraries;
    this.CssLibraries = importCssLibraries;
    this.JavascriptFile = includeJsFile;
    this.CssFile = includeCss;
    this.CurrentPath = getCurrentPath;


    function importChainJs(p_index, p_loaded) {
        includeJsFile(JS_LIB[p_index].PATH, JS_LIB[p_index].FILENAME, function() {
            p_index++;
            if (p_index === JS_LIB.length) {
                if (p_loaded !== undefined) {
                    p_loaded();
                }
            }
            else {
                importChainJs(p_index, p_loaded);
            }
        });
    }

    function importJsLibraries(p_loaded) {
        importChainJs(0, p_loaded);
    }

    function importCssLibraries() {
        for (var i = 0; i < CSS_LIB.length; i++) {
            includeCss(CSS_LIB[i].PATH, CSS_LIB[i].FILENAME);
        }
    }

    var head = document.getElementsByTagName('head')[0];
    function includeJsFile(p_pathfile, p_file, p_onload, p_version) {
        try {
            var onloaded = function() {
            };
            if (typeof (p_onload) === "function")
                onloaded = p_onload;
            var imported = document.createElement('script');
            imported.type = 'text/javascript';
            imported.src = p_pathfile + "/" + p_file + ".js" + (p_version !== undefined ? "?v=" + p_version : "");
            imported.onload = onloaded;
            imported.onerror = function(e) {
                console.log(e);
            };
            head.appendChild(imported);
        } catch (e) {
        }
    }

    function includeCss(p_pathfile, p_file, p_onload) {
        try {
            var onloaded = function() {
            };
            if (typeof (p_onload) === "function")
                onloaded = p_onload;

            var imported = document.createElement('link');
            imported.rel = 'stylesheet';
            imported.href = p_pathfile + "/" + p_file + ".css";
            imported.onload = onloaded;
            imported.onerror = function(e) {
            };
            head.appendChild(imported);
        } catch (e) {
        }
    }

    function getCurrentPath() {
        var arrPath = document.URL.split("/");
        var path = "";
        for (var i = 0; i < (arrPath.length - 1); i++) {
            path += arrPath[i] + "/";
        }
        return path;
    }

    return this;
}