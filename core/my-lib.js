var EL_OPTION = {
    ID: "id",
    CLASS: "class",
    VALUE: "value",
    METHOD: "method",
    ACTION: "action",
    SRC: "src",
    HREF: "href",
    TYPE: "type",
    SELECTED: "selected",
    PLACEHOLDER: "placeholder",
    DATATOGGLE: "data-toggle",
    DATAROLE: "data-role",
    DATAMINI: "data-mini",
    PARENT: "parent",
    MAXLENGTH: "maxlength",
    ACCEPT: "accept"
};

// function yang di gunakan untuk membuat class seperti di java
function Class() {}
;
Class.prototype.construct = function () {};
Class.extend = function (def) {
    var classDef = function () {
        if (arguments[0] !== Class) {
            this.construct.apply(this, arguments);
        }
    };
    var proto = new this(Class);
    var superClass = this.prototype;
    for (var n in def) {
        var item = def[n];
        item.super = superClass;
        proto[n] = item;
    }
    classDef.prototype = proto;
    classDef.extend = this.extend;
    return classDef;
};

// turunan dari class yang di gunakan untuk membuat suatu element/tag html
var BaseComponent = Class.extend({
    construct: function (p_tagname) {
        this.element = document.createElement(p_tagname);
    },
    getById: function (p_id) {
        this.id = p_id;
        this.element = document.getElementById(this.id);
    },
    setId: function (p_id) {
        this.id = p_id;
        this.element.setAttribute(EL_OPTION.ID, this.id);
    },
    addAttribute: function (pName, pValue) {
        this.element.setAttribute(pName, pValue);
    },
    setClass: function (p_class) {
        this.class = p_class;
        this.element.setAttribute(EL_OPTION.CLASS, this.class);
    },
    setOnClick: function (p_onclick) {
        if (typeof (p_onclick) !== "function") {
            p_onclick = function () {
            };
        }
        this.element.onclick = p_onclick;
    },
    setOnChange: function (p_change) {
        if (typeof (p_change) !== "function") {
            p_change = function () {
            };
        }
        this.element.onchange = p_change;
    },
    getElement: function () {
        return this.element;
    },
    // add function for jquery mobile
    setDataRole: function (p_datarole) {
        this.datarole = p_datarole;
        this.element.setAttribute(EL_OPTION.DATAROLE, this.datarole);
    },
    setDataMini: function (p_datamini) {
        this.datamini = p_datamini;
        this.element.setAttribute(EL_OPTION.DATAMINI, this.datamini);
    },
    setDataInsert: function (p_datainset) {
        this.datainset = p_datainset;
        this.element.setAttribute("data-inset", this.datainset);
    },
    hide: function () {
        this.setClass("invisible");
    },
    show: function () {
        this.setClass("visible");
    },
    tagName: '',
    id: '',
    element: '',
    class: '',
    datarole: '',
    datamini: false,
    datainset: false
});

// turunan dari BaseComponent tapi di khusus kan untum membuat element yang sifat nya container
var BaseContainer = BaseComponent.extend({
    construct: function (p_tagname) {
        arguments.callee.super.construct.call(this, p_tagname);
    },
    setText: function (p_text) {
        this.text = p_text;
        this.element.innerHTML = this.text;
    },
    addElement: function (p_element) {
        this.element.appendChild(p_element);
    },
    addElementAt: function (p_element, index) {
        var parentGuest = this.element.childNodes[index];
        if (parentGuest.nextSibling) {
            parentGuest.parentNode.insertBefore(p_element, parentGuest.nextSibling);
        } else {
            parentGuest.parentNode.appendChild(p_element);
        }
    },
    empty: function () {
        this.text = "";
        this.element.innerHTML = "";
    },
    text: ''
});

// turunan dari BaseComponent tapi di khusus kan untum membuat element yang sifat nya form
var BaseForm = BaseComponent.extend({
    construct: function (p_tagname) {
        arguments.callee.super.construct.call(this, p_tagname);
    },
    setValue: function (p_value) {
        this.value = p_value;
        this.element.setAttribute(EL_OPTION.VALUE, this.value);
    },
    getValue: function () {
        return $(this.element).val();
    },
    isDisable: function (p_disable) {
        if (p_disable) {
            this.element.disabled = true;
        } else {
            this.element.disabled = false;
        }
    },
    isReadonly: function (p_read) { //dihapus
        if (p_read) {
            this.element.readOnly = true;
        } else {
            this.element.readOnly = false;
        }
        this.setClass(this.class + " readonly");
    },
    setReadonly: function (p_read) {
        if (p_read) {
            this.element.readOnly = true;
            this.setClass(this.class + " readonly");
        } else {
            this.element.removeAttribute("readonly");
            var classz = this.class.replace("readonly", "");
            this.setClass(classz);
        }
    },
    isRequired: function (p_requir) { //dibuang
        if (p_requir) {
            this.element.required = true;
        } else {
            this.element.required = false;
        }
    },
    setRequired: function (p_requir) {
        if (p_requir) {
            this.element.required = true;
        } else {
            this.element.required = false;
        }
    },
    setOnkeypress: function (p_type) {
        switch (p_type) {
            case TYPEINPUT.ALPHANUMBERIC:
                this.element.onkeypress = function (event)
                {
                    return doFieldFilter(event, 'alphanumeric', true);
                };
                break;
            case TYPEINPUT.NUMBER:
//                this.setType("number");
                this.element.onkeypress = function (event)
                {
                    return doFieldFilter(event, 'number', true);
                };
                break;
            case TYPEINPUT.EMAIL:
                this.element.onkeypress = function (event)
                {
                    return doFieldFilter(event, 'email', true);
                };
                break;
            case TYPEINPUT.USERNAME:
                this.element.onkeypress = function (event)
                {
                    return doFieldFilter(event, 'username', true);
                };
                break;
            case TYPEINPUT.ADDRESS:
                this.element.onkeypress = function (event)
                {
                    return doFieldFilter(event, 'address', true);
                };
                break;
            default:
                break;
        }
    },
    save: function () {
        return this.element.value;
    },
    open: function (p_data) {

    },
    getText: function () {
        return this.element.value;
    },
    submit: function () {
        return this.element.value;
    },
    addArgs: function (p_arg) {
        this.marg.push(p_arg);
    },
    setArgs: function (p_arg) {
        this.marg = p_arg;
    },
    getArgs: function () {
        return this.marg;
    },
    getArg: function (p_index) {
        return this.marg[p_index];
    },
    value: '',
    marg: []
});

// function untuk menggabung 2 object
function merge_object(p_obj1, p_obj2) {
    var obj = {};
    for (var attrname in p_obj1)
        obj[attrname] = p_obj1[attrname];

    for (var attrname in p_obj2)
        obj[attrname] = p_obj2[attrname];

    return obj;
}

function doFieldFilter(e, type, xtra, strict) {
    var re, rex = "";

    if (xtra !== null && xtra.constructor === Boolean) {
        strict = xtra;
        xtra = '';
    }

    var key = 0;
    if (window.event)
        key = e.keyCode; // IE
    else if (e.which)
        key = e.which; // Netscape/Firefox/Opera

    if (key && key !== "undefined") {
        var chr = String.fromCharCode(e.charCode ? e.charCode : (key) ? key : 0);
        var editKeys = "0,9,8,13,63232,63233,63235,63235";

        var editKeys2 = "92";
        var rek = new RegExp("^" + key.toString() + "\\,|\\," + key.toString() + "$|\\," + key.toString() + "\\,");

        if (key == editKeys2) {
            return false;
        }

        if (rek.test(editKeys)) {
            return true;
        }

        if (("character,alpha,number,numeric,alphanumeric,alphanum").indexOf(type) > -1 && typeof xtra !== "undefined" && xtra !== "") {
            rex = "";
            for (var i = 0; i < xtra.length; i++) {
                rex += "\\" + xtra.charAt(i);
            }
        } else if (typeof strict === "undefined" || strict === "" || strict !== true) {
            strict = false;
        }

        switch (type) {
            case "character":
            case "alpha":
                re = strict ? /^[a-zA-Z]$/ : ((rex === "") ? /^[a-zA-Z \.\,\-]$/ : new RegExp("^[a-zA-Z" + rex + "]$"));
                return re.test(chr);
            case "number":
            case "numeric":
                re = strict ? /^[0-9]$/ : ((rex === "") ? /^[0-9\,\.\-]$/ : new RegExp("^[0-9" + rex + "]$"));
                return re.test(chr);
            case "alphanumeric":
            case "alphanum":
                re = strict ? /^[a-zA-Z0-9 ]$/ : ((rex === "") ? /^[a-zA-Z0-9 \.\,\-]$/ : new RegExp("^[a-zA-Z0-9 " + rex + "]$"));
                return re.test(chr);
            case "address":
                re = strict ? /^[a-zA-Z0-9 \.\,\-\"]$/ : ((rex === "") ? /^[a-zA-Z0-9 \.\,\-\"]$/ : new RegExp("^[a-zA-Z0-9.,-\" " + rex + "]$"));
                return re.test(chr);
            case "username":
                re = strict ? /^[a-zA-Z0-9]$/ : ((rex === "") ? /^[a-zA-Z0-9\.\-\_]$/ : new RegExp("^[a-zA-Z0-9" + rex + "]$"));
                return re.test(chr);
            case "incentivename":
                re = strict ? /^[a-zA-Z0-9]$/ : ((rex === "") ? /^[a-zA-Z0-9 \-\_]$/ : new RegExp("^[a-zA-Z0-9" + rex + "]$"));
                return re.test(chr);
            case "mail":
            case "email":
                re = /^[a-zA-Z0-9\+\-\.\_\@]$/;
                return re.test(chr);
            case "code":
                re = strict ? /^[a-zA-Z0-9\_\-]$/ : ((rex === "") ? /^[a-zA-Z0-9\_\-]$/ : new RegExp("^[0-9" + rex + "]$"));
                return re.test(chr);
            default:
                return false;
        }
        return false;
    } else {
        return true;
    }
}

/**
 * Number.prototype.format(n, x)
 * 
 * @param integer n: length of decimal
 * @param integer x: length of sections
 */
Number.prototype.format = function (n, x) {
    var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
    return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
}

var getKeys = function (obj) {
    var keys = [];
    for (var key in obj) {
        keys.push(key);
    }
    return keys;
}