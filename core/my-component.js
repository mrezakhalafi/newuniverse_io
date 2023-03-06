//============================== Turunan BaseContainer =========================

var Div = BaseContainer.extend({
    construct: function () {
        arguments.callee.super.construct.call(this, "div");
    }
});

var Form = BaseContainer.extend({
    construct: function () {
        arguments.callee.super.construct.call(this, "form");
    },
    setMethod: function (pMethod) {
        this.method = pMethod;
        this.element.setAttribute(EL_OPTION.METHOD, pMethod);
    },
    setAction: function (p_action) {
        this.action = p_action;
        this.element.setAttribute(EL_OPTION.ACTION, p_action);
    },
    method: '',
    action: ''
});

var Canvas = BaseContainer.extend({
    construct: function () {
        arguments.callee.super.construct.call(this, "canvas");
    },
    setHeight: function (pHeight) {
        this.addAttribute('height', pHeight);
    },
    setWidth: function (pWidth) {
        this.addAttribute('width', pWidth);
    }
});

var Img = BaseContainer.extend({
    construct: function () {
        arguments.callee.super.construct.call(this, "img");
    },
    setResource: function (pResource) {
        this.src = pResource;
        this.element.setAttribute(EL_OPTION.SRC, pResource);
    },
    setMaxWidth: function () {
        this.element.setAttribute("width", "100%");
    },
    getResource: function () {
        return this.element.getAttribute(EL_OPTION.SRC);
    },
    setWidth: function (pWidth) {
        this.element.setAttribute("width", pWidth);
    },
    submit: function () {
        return this.src;
    },
    src: ''
});

var Label = BaseContainer.extend({
    construct: function () {
        arguments.callee.super.construct.call(this, "label");
    },
    setFor: function (p_id) {
        this.element.setAttribute("for", p_id);
    },
    sfor: ''
});

var TagH1 = BaseContainer.extend({
    construct: function () {
        arguments.callee.super.construct.call(this, "h1");
    }
});

var TagH3 = BaseContainer.extend({
    construct: function () {
        arguments.callee.super.construct.call(this, "h3");
    }
});

var TagH5 = BaseContainer.extend({
    construct: function () {
        arguments.callee.super.construct.call(this, "h5");
    }
});

var TagP = BaseContainer.extend({
    construct: function () {
        arguments.callee.super.construct.call(this, "p");
    }
});

var Br = BaseContainer.extend({
    construct: function () {
        arguments.callee.super.construct.call(this, "br");
    }
});

var Hr = BaseContainer.extend({
    construct: function () {
        arguments.callee.super.construct.call(this, "hr");
    }
});

var TagA = BaseContainer.extend({
    construct: function () {
        arguments.callee.super.construct.call(this, "a");
    },
    setResource: function (pResource) {
        this.src = pResource;
        this.element.setAttribute(EL_OPTION.SRC, pResource);
    },
    setHref: function (p_href) {
        this.href = p_href;
        this.element.setAttribute(EL_OPTION.HREF, p_href);
    },
    setDatatoggle: function (p_toggle) {
        this.datatoggle = p_toggle;
        this.element.setAttribute(EL_OPTION.DATATOGGLE, this.datatoggle);
    },
    setOnClick: function (p_onclick) {
        if (typeof (p_onclick) !== "function") {
            p_onclick = function () {
            };
        }
        this.element.onclick = p_onclick;
    },
    setName: function (p_href) {
        this.element.setAttribute("name", p_href);
    },
    datatoggle: '',
    href: ''
});

var Span = BaseContainer.extend({
    construct: function () {
        arguments.callee.super.construct.call(this, "span");
    },
    setParent: function (p_parent) {
        this.parent = p_parent;
        this.element.setAttribute(EL_OPTION.PARENT, this.parent);
    },
    parent: ''
});

var Ul = BaseContainer.extend({
    construct: function () {
        arguments.callee.super.construct.call(this, "ul");
    }
});

var Li = BaseContainer.extend({
    construct: function () {
        arguments.callee.super.construct.call(this, "li");
    }
});

var Table = BaseContainer.extend({
    construct: function () {
        arguments.callee.super.construct.call(this, "table");
    },
    setCellspacing: function (pCellSpacing) {
        this.cellspacing = pCellSpacing;
        this.element.setAttribute("cellspacing", this.cellspacing);
    },
    cellspacing: ''
});

var Thead = BaseContainer.extend({
    construct: function () {
        arguments.callee.super.construct.call(this, "thead");
    }
});

var Tbody = BaseContainer.extend({
    construct: function () {
        arguments.callee.super.construct.call(this, "tbody");
    }
});

var Tr = BaseContainer.extend({
    construct: function () {
        arguments.callee.super.construct.call(this, "tr");
    }
});

var Td = BaseContainer.extend({
    construct: function () {
        arguments.callee.super.construct.call(this, "td");
    },
    setRowspan: function (pRowspan) {
        this.rowspan = pRowspan;
        this.element.setAttribute("rowspan", this.rowspan);
    },
    setColspan: function (pColspan) {
        this.colspan = pColspan;
        this.element.setAttribute("colspan", this.colspan);
    },
    rowspan: '',
    colspan: ''
});

var Th = BaseContainer.extend({
    construct: function () {
        arguments.callee.super.construct.call(this, "th");
    },
    setRowspan: function (pRowspan) {
        this.rowspan = pRowspan;
        this.element.setAttribute("rowspan", this.rowspan);
    },
    setColspan: function (pColspan) {
        this.colspan = pColspan;
        this.element.setAttribute("colspan", this.colspan);
    },
    rowspan: '',
    colspan: ''
});

var Paging = Div.extend({
    construct: function () {
        arguments.callee.super.construct.call(this);
        this.setClass("container");
        this.navigation = new Div();
        this.navigation.setClass("paging_header");
        this._img_11 = new TagA();
        this._img_12 = new TagA();
        var _span_11 = new Span();
        var _span_12 = new Span();

//        this._img_11.setResource("/main/image/add.png");
//        this._img_12.setResource("/main/image/min.png");
        this._img_11.setText("+");
        this._img_12.setText("-");

        _span_11.setClass("addButton");
        _span_11.addElement(this._img_11.getElement());
        _span_12.setClass("delButton");
        _span_12.addElement(this._img_12.getElement());
        this.navigation.addElement(_span_11.getElement());
        this.navigation.addElement(_span_12.getElement());

        this.list = new Ul();
        this.list.setClass("content");
        this.navigation_paging = new Div();
        this.navigation_paging.setClass("page_navigation");

        var clear = new Div();
        clear.setClass("clear");

        this.addElement(this.navigation.getElement());
        this.addElement(clear.getElement());
        this.addElement(this.list.getElement());
        this.addElement(this.navigation_paging.getElement());
    },
    addDetail: function (pElement) {
        this.list.addElement(pElement);
    },
    onAdd: function (pAdd) {
        if (typeof (pAdd) !== "function") {
            pAdd = function () {
            };
        }
        this._img_11.setOnClick(pAdd);
    },
    onRemove: function (pRemove) {
        if (typeof (pRemove) !== "function") {
            pRemove = function () {
            };
        }
        this._img_12.setOnClick(pRemove);
    },
    list: '',
    navigation: '',
    navigation_paging: ''
});


//============================== Turunan BaseContainer =========================

var Input = BaseForm.extend({
    construct: function () {
        arguments.callee.super.construct.call(this, "input");
    },
    setAccept: function (p_acc) {
        this.accept = p_acc;
        this.element.setAttribute(EL_OPTION.ACCEPT, this.accept);
    },
    setType: function (p_type) {
        this.type = p_type;
        this.element.setAttribute(EL_OPTION.TYPE, this.type);
    },
    setPlaceHolder: function (p_text) {
        this.placeholder = p_text;
        this.element.setAttribute(EL_OPTION.PLACEHOLDER, this.placeholder);
    },
    setValue: function (p_value) {
        this.value = p_value;
        this.element.setAttribute(EL_OPTION.VALUE, this.value);
    },
    setHeight: function (p_height) {
        this.height = p_height;
        this.element.setAttribute(EL_OPTION.HEIGHT, this.height);
    },
    setWidth: function (p_width) {
        this.width = p_width;
        this.element.setAttribute(EL_OPTION.WIDTH, this.width);
    },
    setTitle: function (p_title) {
        this.title = p_title;
        this.element.setAttribute(EL_OPTION.TITLE, this.width);
    },
    placeholder: '',
    type: '',
    accept : ''
});

var Checkbox = Input.extend({
    construct: function () {
        arguments.callee.super.construct.call(this);
        this.setType("checkbox");
    },
    setCheck: function (p_check) {
        this.value = p_check;
        this.element.checked = this.value;
    },
    setOnClick: function (p_onclick) {
        if (typeof (p_onclick) !== "function") {
            p_onclick = function () {
            };
        }
        this.element.onclick = p_onclick;
    }
});

var Radiobox = Input.extend({
    construct: function () {
        arguments.callee.super.construct.call(this);
        this.setType("radio");
    },
    setCheck: function (p_check) {
        this.value = p_check;
        this.element.checked = this.value;
    },
    setOnClick: function (p_onclick) {
        if (typeof (p_onclick) !== "function") {
            p_onclick = function () {
            };
        }
        this.element.onclick = p_onclick;
    }
});

var Button = Input.extend({
    construct: function () {
        arguments.callee.super.construct.call(this);
        this.setType("button");
    },
    setOnClick: function (p_onclick) {
        if (typeof (p_onclick) !== "function") {
            p_onclick = function () {
            };
        }
        this.element.onclick = p_onclick;
    }
});

var File = Input.extend({
    construct: function () {
        arguments.callee.super.construct.call(this);
        this.setType("file");
    },
    setOnChange: function (p_onchange) {
        if (typeof (p_onchange) !== "function") {
            p_onchange = function () {
            };
        }
        this.element.onchange = p_onchange;
    }
})

var FilePicture = Input.extend({
    construct: function () {
        arguments.callee.super.construct.call(this);
        this.setType("file");
        this.setAccept('image/*');
        this.setaccept;
    },
    setOnChange: function (p_onchange) {
        if (typeof (p_onchange) !== "function") {
            p_onchange = function () {
            };
        }
        this.element.onchange = p_onchange;
    },
    setAccept : function (){
        this.setaccept = document.createElement("FILE").accept = "audio/*";
        
    }
})


var Select = BaseForm.extend({
    construct: function () {
        arguments.callee.super.construct.call(this, "select");
        this.setClass("select");
        this.options = new Array();
    },
    addOption: function (p_param) {
        var coption = {
            value: "",
            label: "",
            selected: false
        };
        p_param = merge_object(coption, p_param);
        this.option = document.createElement("option");
        this.option.setAttribute(EL_OPTION.VALUE, p_param.value);
        this.option.innerHTML = p_param.label;
        if (p_param.selected) {
            this.option.setAttribute(EL_OPTION.SELECTED, "selected");
        }
        this.element.appendChild(this.option);
        this.options.push(p_param);
    },
    addOptions: function (p_params) {
        for (var i = 0; i < p_params.length; i++) {
            this.addOption(p_params[i]);
        }
    },
    setOptions: function (p_params) {
        this.clearOption();
        this.addOptions(p_params);
    },
    clearOption: function () {
        this.options = new Array();
        this.element.innerHTML = "";
    },
    url: function (msg) {
        var sender = new Sender(msg);
        sender.send(function (data) {
            var ret = eval(data);
            for (var i = 0; i < ret.length; i++) {
                this.addOption({value: ret[i][0], label: ret[i][1]});
            }
        }.bind(this));
    },
    getOptions: function () {
        return this.options;
    },
    getText: function () {
        var result = "";
        for (var i = 0; i < this.options.length; i++) {
            if (this.options[i].value + "" === this.submit() + "") {
                result = this.options[i].label;
                break;
            }
        }
        return result;
    }
});

var TextArea = BaseForm.extend({
    construct: function () {
        arguments.callee.super.construct.call(this, "textarea");
        this.setClass("textarea");
    },
    setValue: function (p_value) {
        arguments.callee.super.setValue.call(this, p_value);
        this.element.innerHTML = this.value;
    },
    setOnInput: function (p_onkeydown) {
        if (typeof (p_onkeydown) !== "function") {
            p_onkeydown = function () {
                var tmpHeight = $(this).prop('scrollHeight');
                $(this).height(1);
                var totalHeight = $(this).prop('scrollHeight') - parseInt($(this).css('padding-top')) - parseInt($(this).css('padding-bottom'));
                $(this).height(totalHeight);
            };
        }
        this.element.oninput = p_onkeydown;
    },
});

var DatePicker = Div.extend({
    construct: function () {
        arguments.callee.super.construct.call(this);
        this.date = new Select();
        this.month = new Select();
        this.year = new Select();

        this.date.setClass("date");
        this.month.setClass("date");
        this.year.setClass("date");

        var d29 = new Array();
        var d30 = new Array();
        var d31 = new Array();

        var d = new Date();
        var curDate = d.getDate() + "";
        var curMonth = d.getMonth() + "";
        var curYear = d.getFullYear() + "";

        this.minyear = parseInt(curYear) - 2;
        this.maxyear = parseInt(curYear);

        for (var i = 1; i < 32; i++) {
            if (i < 30) {
                d29.push({value: i, label: i + '', selected: curDate === i + ""});
            }
            if (i < 31) {
                d30.push({value: i, label: i + '', selected: curDate === i + ""});
            }
            d31.push({value: i, label: i + '', selected: curDate === i + ""});
        }

        this.monthOption = [
            {value: 1, label: 'Januari', d: d31},
            {value: 2, label: 'Pebruari', d: d29},
            {value: 3, label: 'Maret', d: d31},
            {value: 4, label: 'April', d: d30},
            {value: 5, label: 'Mei', d: d31},
            {value: 6, label: 'Juni', d: d30},
            {value: 7, label: 'Juli', d: d31},
            {value: 8, label: 'Agustus', d: d31},
            {value: 9, label: 'September', d: d30},
            {value: 10, label: 'Oktober', d: d31},
            {value: 11, label: 'Nopember', d: d30},
            {value: 12, label: 'Desember', d: d31}
        ];
        for (var i = 0; i < d31.length; i++) {
            this.date.addOption(d31[i]);
        }
        for (var i = 0; i < this.monthOption.length; i++) {
            this.month.addOption({value: this.monthOption[i].value, label: this.monthOption[i].label, selected: curMonth === (this.monthOption[i].value - 1) + ""});
        }
        try {
            this.month.setOnChange(this.setDateOption.bind(this));
        } catch (e) {
            console.log(e);
        }
        for (var j = this.minyear; j <= this.maxyear; j++) {
            this.year.addOption({value: j, label: j + "", selected: j + "" === curYear});
        }


        var spanDate = new Span();
        spanDate.addElement(this.date.getElement());
        var spanMonth = new Span();
        spanMonth.addElement(this.month.getElement());
        var spanYear = new Span();
        spanYear.addElement(this.year.getElement());

        this.addElement(spanDate.getElement());
        this.addElement(spanMonth.getElement());
        this.addElement(spanYear.getElement());
    },
    setMinYear: function (pYear) {
        var d = new Date();
        var curYear = d.getFullYear() + "";
        this.minyear = pYear;
        this.year.clearOption();
        for (var j = this.minyear; j <= this.maxyear; j++) {
            this.year.addOption({value: j, label: j + "", selected: j + "" === curYear});
        }
    },
    setMaxYear: function (pYear) {
        var d = new Date();
        var curYear = d.getFullYear() + "";
        this.maxyear = pYear;
        this.year.clearOption();
        for (var j = this.minyear; j <= this.maxyear; j++) {
            this.year.addOption({value: j, label: j + "", selected: j + "" === curYear});
        }
    },
    setDateOption: function () {
        console.log("setDateOption");
        console.log(this.monthOption[this.month.submit() - 1].d);
        this.date.setOptions(this.monthOption[this.month.submit() - 1].d, this);
    },
    setDate: function (pDate) {
        this.date.setValue(pDate);
    },
    submit: function () {
        return (this.date.submit() + "-" + this.month.submit() + "-" + this.year.submit());
    },
    date: new Select(),
    month: new Select(),
    year: new Select()
});

var SingleInputAttachment = Input.extend({
    construct: function () {
        arguments.callee.super.construct.call(this);
        this.setType("text");
        this.setClass("input");

        this.combine = new CBVertical();
        this.label = new Span();
        this.label.setClass("label");
        this.label.setText("&nbsp;");
        this.combine.settitle(this.label.element);
        this.combine.setdetail(this.element);
        this.combine.setHelp(false, "");
        this.combine.setBottomBorder(true);
    },
    setBottomBorder: function (pBorder) {
        this.combine.setBottomBorder(pBorder);
    },
    setHelp: function (pHelp, pValue) {
        this.combine.setHelp(pHelp, pValue);
    },
    setValue: function (pValue) {
        this.combine.setValue(pValue);
    },
    setMaxLength: function (pMaxLength) {
        this.maxlength = pMaxLength;
        this.element.setAttribute(EL_OPTION.MAXLENGTH, this.maxlength);
    },
    setAccept: function (pAccept) {
        this.accept = pAccept;
        this.element.setAttribute(EL_OPTION.ACCEPT, this.accept);
    },
    setText: function (p_text) {
        this.label.setText(p_text);
    },
    clear: function () {
        this.combine.clear();
    },
    getElement: function () {
        return this.combine.element;
    },
    label: '',
    maxlength: '',
    accept: ''
})


var SingleInput = Input.extend({
    construct: function () {
        arguments.callee.super.construct.call(this);
        this.setType("text");
        this.setClass("input");

        this.combine = new CBVertical();
        this.label = new Span();
        this.label.setClass("label");
        this.label.setText("&nbsp;");
        this.combine.settitle(this.label.element);
        this.combine.setdetail(this.element);
        this.combine.setHelp(false, "");
        this.combine.setBottomBorder(true);
    },
    setBottomBorder: function (pBorder) {
        this.combine.setBottomBorder(pBorder);
    },
    setHelp: function (pHelp, pValue) {
        this.combine.setHelp(pHelp, pValue);
    },
    setValue: function (pValue) {
        this.combine.setValue(pValue);
    },
    setMaxLength: function (pMaxLength) {
        this.maxlength = pMaxLength;
        this.element.setAttribute(EL_OPTION.MAXLENGTH, this.maxlength);
    },
    setText: function (p_text) {
        this.label.setText(p_text);
    },
    clear: function () {
        this.combine.clear();
    },
    getElement: function () {
        return this.combine.element;
    },
    label: '',
    maxlength: ''
});

var SingleInputDigform = Input.extend({
    construct: function () {
        arguments.callee.super.construct.call(this);
        this.setType("text");
        this.setClass("input");

        this.combine = new CBVertical();
//        this.label = new Span();
//        this.label.setClass("label");
//        this.label.setText("&nbsp;");
//        this.combine.settitle(this.label.element);
//        this.combine.setdetail(this.element);
//        this.combine.setHelp(false, "");
//        this.combine.setBottomBorder(true);
    },
    setBottomBorder: function (pBorder) {
        this.combine.setBottomBorder(pBorder);
    },
    setHelp: function (pHelp, pValue) {
        this.combine.setHelp(pHelp, pValue);
    },
    setValue: function (pValue) {
        this.combine.setValue(pValue);
    },
    setMaxLength: function (pMaxLength) {
        this.maxlength = pMaxLength;
        this.element.setAttribute(EL_OPTION.MAXLENGTH, this.maxlength);
    },
    setText: function (p_text) {
        this.label.setText(p_text);
    },
    clear: function () {
        this.combine.clear();
    },
    getElement: function () {
        return this.combine.element;
    },
    label: '',
    maxlength: ''
});



var SingleButton = Button.extend({
    construct: function () {
        arguments.callee.super.construct.call(this);

        this.combine = new CBVertical();
        this.label = new Span();
        this.label.setClass("label");
        this.label.setText("&nbsp;");
        this.combine.settitle(this.label.element);
        this.combine.setdetail(this.element);
        this.combine.setHelp(false, "");
        this.combine.setBottomBorder(true);
    },
    setBottomBorder: function (pBorder) {
        this.combine.setBottomBorder(pBorder);
    },
    setHelp: function (pHelp, pValue) {
        this.combine.setHelp(pHelp, pValue);
    },
    setText: function (p_text) {
        if (p_text === undefined || p_text === "") {
            this.label.hide();
        } else {
            this.label.show()
            this.label.setText(p_text);
        }
    },
    clear: function () {
        this.combine.clear();
    },
    getElement: function () {
        return this.combine.element;
    },
    label: ''
});




var SingleInputAutoComplete = Input.extend({
    construct: function () {
        arguments.callee.super.construct.call(this);
        this.setType("text");
        this.setClass("input");
        this.combine = new CBVertical();
        this.label = new Span();
        this.label.setClass("label");
        this.label.setText("&nbsp;");
        this.setPlaceHolder('Set Participants');
        this.combine.settitle(this.label.element);
        this.combine.setdetail(this.element);
        this.combine.setHelp(false, "");
        this.combine.setBottomBorder(true);
    },
    setBottomBorder: function (pBorder) {
        this.combine.setBottomBorder(pBorder);
    },
    setHelp: function (pHelp, pValue) {
        this.combine.setHelp(pHelp, pValue);
    },
    setValue: function (pValue) {
        this.combine.setValue(pValue);
    },
    setMaxLength: function (pMaxLength) {
        this.maxlength = pMaxLength;
        this.element.setAttribute(EL_OPTION.MAXLENGTH, this.maxlength);
    },
    setText: function (p_text) {
        this.label.setText(p_text);
    },
    clear: function () {
        this.combine.clear();
    },
    getElement: function () {
        return this.combine.element;
    },
    label: '',
    maxlength: ''
});

var SingleButtonAutoComplete = Div.extend({
    construct: function () {
        arguments.callee.super.construct.call(this);
        this.setClass("container");
        this.navigation = new Div();
        this.navigation.setClass("paging_header");
        this._input_11 = new SingleInputAutoComplete();
        this._input_11.setId("addInputId_9");
        this._input_11.setClass('InputAutoComplete');
        this._button_11 = new Button();
        this._button_11.setId("addButtonId");
        this._button_11.setClass('ButtonAutoComplete');
        this._button_11.setValue("Add");
        this._button_11.addAttribute('title', 'Add People');
        this.navigation.addElement(this._input_11.getElement());
        this.navigation.addElement(this._button_11.getElement());
        this.addElement(this.navigation.getElement());
    },
    addDetail: function (pElement) {
    },
    getButtonValue: function () {
        return this._button_11.getValue();
    },
    getInputValue: function () {
        return this._input_11.getValue();
    },
    onAdd: function (pAdd) {
        if (typeof (pAdd) !== "function") {
            pAdd = function () {
            };
        }
        this._img_11.setOnClick(pAdd);
    },
    navigation: '',
    _input_11: '',
    _button_11: ''
});

var SingleButtonAutoComplete1 = Div.extend({
    construct: function () {
        arguments.callee.super.construct.call(this);
        this.setClass("container");
        this.navigation = new Div();
        this.navigation.setClass("paging_header");
        this._input_11 = new SingleInputAutoComplete();
        this._input_11.setId("addInputId_15");
        this._button_11 = new Button();
        this._button_11.setId("addButtonId");
        this._button_11.setClass('addButtonClass');
        this._button_11.setValue("Add");
        this._button_11.addAttribute('title', 'Add People');
        this.navigation.addElement(this._input_11.getElement());
        this.navigation.addElement(this._button_11.getElement());
        this.addElement(this.navigation.getElement());
    },
    addDetail: function (pElement) {
    },
    getButtonValue: function () {
        return this._button_11.getValue();
    },
    getInputValue: function () {
        return this._input_11.getValue();
    },
    onAdd: function (pAdd) {
        if (typeof (pAdd) !== "function") {
            pAdd = function () {
            };
        }
        this._img_11.setOnClick(pAdd);
    },
    setAttribute: function () {

    },
    navigation: '',
    _input_11: '',
    _button_11: ''
});



var SingleImg = Img.extend({
    construct: function () {
        arguments.callee.super.construct.call(this);
        this.combine = new CBVertical();
        this.label = new Span();
        this.label.setClass("label");
        this.label.setText("&nbsp;");
        this.combine.settitle(this.label.element);
        this.combine.setdetail(this.element);
        this.combine.setHelp(false, "");
        this.combine.setBottomBorder(true);
    },
    setBottomBorder: function (pBorder) {
        this.combine.setBottomBorder(pBorder);
    },
    setHelp: function (pHelp, pValue) {
        this.combine.setHelp(pHelp, pValue);
    },
    setText: function (p_text) {
        if (p_text === undefined || p_text === "") {
            this.label.hide();
        } else {
            this.label.show()
            this.label.setText(p_text);
        }
    },
    getElement: function () {
        return this.combine.element;
    },
    label: ''
});

var SingleInputPassword = SingleInput.extend({
    construct: function () {
        arguments.callee.super.construct.call(this);
        this.setType("password");
        this.setClass("input");
    },
    getText: function () {
        var result = "";
        for (var i = 0; i < this.submit().length; i++) {
            result += "*";
        }
        return result;
    }
});

var SingleCheckBox = Checkbox.extend({
    construct: function () {
        arguments.callee.super.construct.call(this);

        this.combine = new CBCheckbox();
        this.span = new Span();
        this.span.setText("&nbsp;");
        this.combine.setdetail(this.element);
        this.combine.setdetail(this.span.element);
        this.combine.setBottomBorder(true);
    },
    setBottomBorder: function (pBorder) {
        this.combine.setBottomBorder(pBorder);
    },
    setId: function (p_id) {
        arguments.callee.super.setId.call(this, p_id);
        this.span.setFor(this.id);
    },
    setText: function (p_text) {
        this.span.setText(p_text);
    },
    getElement: function () {
        return this.combine.element;
    },
    span: ''
});

var SingleRadiobox = Radiobox.extend({
    construct: function () {
        arguments.callee.super.construct.callt(his);

        this.combine = new CBRadio();
        this.label = new Label();
        this.label.setText("&nbsp;");
        this.combine.settitle(this.element);
        this.combine.settitle(this.label.element);
        this.combine.setBottomBorder(true);
    },
    setId: function (p_id) {
        arguments.callee.super.setId.call(this, p_id);
        this.label.setFor(this.id);
    },
    setText: function (p_text) {
        this.label.setText(p_text);
    },
    getElement: function () {
        return this.combine.element;
    },
    label: ''
});

var SingleTextArea = TextArea.extend({
    construct: function () {
        arguments.callee.super.construct.call(this);

        this.combine = new CBVertical();
        this.label = new Span();
        this.label.setClass("label");
        this.label.setText("&nbsp;");
        this.combine.settitle(this.label.element);
        this.combine.setdetail(this.element);
        this.combine.setBottomBorder(true);
    },
    setText: function (p_text) {
        this.label.setText(p_text);
    },
    getElement: function () {
        return this.combine.element;
    },
    setBottomBorder: function (pBorder) {
        this.combine.setBottomBorder(pBorder);
    },
    label: ''
});

var SingleSelect = Select.extend({
    construct: function () {
        arguments.callee.super.construct.call(this);

        this.combine = new CBVertical();
        this.label = new Span();
        this.label.setClass("label");
        this.label.setText("&nbsp;");
        this.combine.settitle(this.label.element);
        this.combine.setdetail(this.element);
        this.combine.setBottomBorder(true);
    },
    setBottomBorder: function (pBorder) {
        this.combine.setBottomBorder(pBorder);
    },
    setText: function (p_text) {
        this.label.setText(p_text);
    },
    setHelp: function (pHelp, pValue) {
        this.combine.setHelp(pHelp, pValue);
    },
    getElement: function () {
        return this.combine.element;
    },
    label: ''
});


var SingleDatepicker = DatePicker.extend({
    construct: function () {
        arguments.callee.super.construct.call(this);
        this.setClass("input");

        this.combine = new CBVertical();
        this.label = new Span();
        this.label.setClass("label");
        this.label.setText("&nbsp;");
        this.combine.settitle(this.label.element);
        this.combine.setdetail(this.element);
        this.combine.setHelp(false, "");
        this.combine.setBottomBorder(true);
    },
    setBottomBorder: function (pBorder) {
        this.combine.setBottomBorder(pBorder);
    },
    setHelp: function (pHelp, pValue) {
        this.combine.setHelp(pHelp, pValue);
    },
    setValue: function (pValue) {
//        this.combine.setValue(pValue);
    },
    setText: function (p_text) {
        this.label.setText(p_text);
    },
    clear: function () {
        this.combine.clear();
    },
    getElement: function () {
        return this.combine.element;
    },
    label: ''
});

var SingleCanvas = Canvas.extend({
    construct: function () {
        arguments.callee.super.construct.call(this);
        this.setClass("input");

        this.combine = new CBVertical();
        this.label = new Span();
        this.label.setClass("label");
        this.label.setText("&nbsp;");
        this.combine.settitle(this.label.element);
        this.combine.setdetail(this.element);
        this.combine.setHelp(false, "");
        this.combine.setBottomBorder(true);
    },
    setBottomBorder: function (pBorder) {
        this.combine.setBottomBorder(pBorder);
    },
    setHelp: function (pHelp, pValue) {
        this.combine.setHelp(pHelp, pValue);
    },
    setText: function (p_text) {
        this.label.setText(p_text);
    },
    getElement: function () {
        return this.combine.element;
    },
    label: ''
});

var SingleInputDatepicker = Input.extend({
    construct: function () {
        arguments.callee.super.construct.call(this);
        this.setType("date");
        this.setClass("input");

        this.combine = new CBVertical();
        this.label = new Span();
//        this.label.setClass("label");
//        this.label.setText("&nbsp;");
        this.combine.settitle(this.label.element);
        this.combine.setdetail(this.element);
        this.combine.setHelp(false, "");
        this.combine.setBottomBorder(true);
    },
    setBottomBorder: function (pBorder) {
        this.combine.setBottomBorder(pBorder);
    },
    setHelp: function (pHelp, pValue) {
        this.combine.setHelp(pHelp, pValue);
    },
    setValue: function (pValue) {
        this.combine.setValue(pValue);
    },
    setMaxLength: function (pMaxLength) {
        this.maxlength = pMaxLength;
        this.element.setAttribute(EL_OPTION.MAXLENGTH, this.maxlength);
    },
    setText: function (p_text) {
        this.label.setText(p_text);
    },
    clear: function () {
        this.combine.clear();
    },
    getElement: function () {
        return this.combine.element;
    },
    label: '',
    maxlength: ''
});

var SingleInputDateTimepicker = Input.extend({
    construct: function () {
        arguments.callee.super.construct.call(this);
        this.setType("datetime-local");
        this.setClass("input");

        this.combine = new CBVertical();
        this.label = new Span();
//        this.label.setClass("label");
//        this.label.setText("&nbsp;");
//        this.combine.settitle(this.label.element);
        this.combine.setdetail(this.element);
        this.combine.setHelp(false, "");
        this.combine.setBottomBorder(true);
    },
    setBottomBorder: function (pBorder) {
        this.combine.setBottomBorder(pBorder);
    },
    setHelp: function (pHelp, pValue) {
        this.combine.setHelp(pHelp, pValue);
    },
    setValue: function (pValue) {
        this.combine.setValue(pValue);
    },
    setMaxLength: function (pMaxLength) {
        this.maxlength = pMaxLength;
        this.element.setAttribute(EL_OPTION.MAXLENGTH, this.maxlength);
    },
    setText: function (p_text) {
        this.label.setText(p_text);
    },
    clear: function () {
        this.combine.clear();
    },
    getElement: function () {
        return this.combine.element;
    },
    label: '',
    maxlength: ''
});


var SingleInputDateTimepickerJQ = Input.extend({
    construct: function () {
        arguments.callee.super.construct.call(this);
        this.setType("text");
        this.setId("mydtpicker");
        this.combine = new CBVertical();
        this.label = new Span();
//        this.label.setClass("label");
//        this.label.setText("&nbsp;");
        this.combine.settitle(this.label.element);
        this.combine.setdetail(this.element);
        this.combine.setHelp(false, "");
        this.combine.setBottomBorder(true);
    },
    setBottomBorder: function (pBorder) {
        this.combine.setBottomBorder(pBorder);
    },
    setHelp: function (pHelp, pValue) {
        this.combine.setHelp(pHelp, pValue);
    },
    setValue: function (pValue) {
        this.combine.setValue(pValue);
    },
    setMaxLength: function (pMaxLength) {
        this.maxlength = pMaxLength;
        this.element.setAttribute(EL_OPTION.MAXLENGTH, this.maxlength);
    },
    setText: function (p_text) {
        this.label.setText(p_text);
    },
    clear: function () {
        this.combine.clear();
    },
    getElement: function () {
        return this.combine.element;
    },
    label: '',
    maxlength: ''
});


var SingleInputDateTimepicker2 = Div.extend({
    construct: function () {
        arguments.callee.super.construct.call(this);
        this.setClass("container-datetimepicker");
        this.input1 = new Input();
        this.input2 = new Input();
        this.input1.setClass('');
        this.input2.setClass('');
        this.input1.setType('date');
        this.input2.setType('time');
        this.input1.setValue(gen_fillDatePicker());
        this.input2.setValue(gen_fillTimePicker());
        console.log("value date : " + this.input1.getValue());
        console.log("value time : " + this.input2.getValue());
        this.addElement(this.input1.getElement());
        this.addElement(this.input2.getElement());
    },
    onAdd: function () {
        // note this
    },
    input1: '',
    input2: ''
});

var SingleInputTime = Input.extend({
    construct: function () {
        arguments.callee.super.construct.call(this);
        this.setType("time");
        this.setClass("input");

        this.combine = new CBVertical();
        this.label = new Span();
//        this.label.setClass("label");
//        this.label.setText("&nbsp;");
        this.combine.settitle(this.label.element);
        this.combine.setdetail(this.element);
        this.combine.setHelp(false, "");
        this.combine.setBottomBorder(true);
    },
    setBottomBorder: function (pBorder) {
        this.combine.setBottomBorder(pBorder);
    },
    setHelp: function (pHelp, pValue) {
        this.combine.setHelp(pHelp, pValue);
    },
    setValue: function (pValue) {
        this.combine.setValue(pValue);
    },
    setMaxLength: function (pMaxLength) {
        this.maxlength = pMaxLength;
        this.element.setAttribute(EL_OPTION.MAXLENGTH, this.maxlength);
    },
    setText: function (p_text) {
        this.label.setText(p_text);
    },
    clear: function () {
        this.combine.clear();
    },
    getElement: function () {
        return this.combine.element;
    },
    label: '',
    maxlength: ''
});

var counterAddAction = 2;
var indexing = 0;
var SingleButtonAddAction = Div.extend({
    construct: function () {
        arguments.callee.super.construct.call(this);
        this.navigation = new Div();
        this.navigation.setText("");

        this.table = new Table();
        this.table.setClass('component_form');
        this.tr_header = new Tr();

        this.tr_1 = new Tr();
        this.tr_2 = new Tr();
        this.tr_3 = new Tr();
        this.tr_4 = new Tr();

        this.label_header = new Label();
        this.label_header.setText('Next Action');
        this.td_header = new Td();
        this.td_header.setClass('field_header');
        this.td_header.setColspan('3');
        this.td_icon_1 = new Td();
        this.td_icon_2 = new Td();
        this.td_icon_3 = new Td();
        this.td_icon_4 = new Td();

        this.icon_1 = new Img();
        this.icon_2 = new Img();
        this.icon_3 = new Img();
        this.icon_4 = new Img();

        this.icon_1.setClass("img-item");
        this.icon_1.setResource("../kren/img/digitalform/item/icon_item_view_0.png");
        this.icon_2.setClass("img-item");
        this.icon_2.setResource("../kren/img/digitalform/item/icon_item_person_0.png");
        this.icon_3.setClass("img-item");
        this.icon_3.setResource("../kren/img/digitalform/item/icon_item_date_0.png");
        this.icon_4.setClass("img-item");
        this.icon_4.setResource("../kren/img/digitalform/item/icon_item_date_0.png");


        this.td_content_1 = new Td();
        this.td_content_2 = new Td();
        this.td_content_3 = new Td();
        this.td_content_4 = new Td();

        this.navigation.setClass("paging_header");

//        this._button_12 = new Button();
//        this._button_12.setId("deleteButtonId");
//        this._button_12.setClass('delete_button');
//        this._button_12.setValue("Delete Action");

        this._input_11 = new Input();
        this._input_11.hide();

        this.label_action_item = new Label();
        this.label_action_item.setText('Action Item');
        this.action_item = new SingleInput();

        this.label_pic = new Label();
        this.label_pic.setText('PIC');
        this.pic = new SingleInput();

        this.label_deadline = new Label();
        this.label_deadline.setText('Deadline');
        this.deadline = new SingleInputDatepicker();

        this.label_start = new Label();
        this.label_start.setText('Start');
        this.start = new SingleInputDatepicker();

        this.td_header.addElement(this.label_header.getElement());
        this.tr_header.addElement(this.td_header.getElement());

        this.td_icon_1.addElement(this.icon_1.getElement());
        this.td_content_1.addElement(this.label_action_item.getElement());
        this.td_content_1.addElement(this.action_item.getElement());
        this.tr_1.addElement(this.td_icon_1.getElement());
        this.tr_1.addElement(this.td_content_1.getElement());

        this.td_icon_2.addElement(this.icon_2.getElement());
        this.td_content_2.addElement(this.label_pic.getElement());
        this.td_content_2.addElement(this.pic.getElement());
        this.tr_2.addElement(this.td_icon_2.getElement());
        this.tr_2.addElement(this.td_content_2.getElement());

        this.td_icon_3.addElement(this.icon_3.getElement());
        this.td_content_3.addElement(this.label_deadline.getElement());
        this.td_content_3.addElement(this.deadline.getElement());
        this.tr_3.addElement(this.td_icon_3.getElement());
        this.tr_3.addElement(this.td_content_3.getElement());

        this.td_icon_4.addElement(this.icon_4.getElement());
        this.td_content_4.addElement(this.label_start.getElement());
        this.td_content_4.addElement(this.start.getElement());
        this.tr_4.addElement(this.td_icon_4.getElement());
        this.tr_4.addElement(this.td_content_4.getElement());


        this.table.addElement(this.tr_header.getElement());
        this.table.addElement(this.tr_1.getElement());
        this.table.addElement(this.tr_2.getElement());
        this.table.addElement(this.tr_3.getElement());
        this.table.addElement(this.tr_4.getElement());


        /*
         this.navigation.addElement(this._button_11.getElement());
         this.navigation.addElement(this._input_11.getElement());
         
         this.navigation.addElement(this.label_action_item.getElement());
         this.navigation.addElement(this.action_item.getElement());
         
         this.navigation.addElement(this.label_pic.getElement());
         this.navigation.addElement(this.pic.getElement());
         
         this.navigation.addElement(this.label_deadline.getElement());
         this.navigation.addElement(this.deadline.getElement());
         
         this.navigation.addElement(this.label_start.getElement());
         this.navigation.addElement(this.start.getElement());
         
         this.addElement(this.navigation.getElement());
         */
    },
    setOnClick: function (p_Click) {
        this.navigation.setOnClick(p_Click);
    },
    addDetail: function (pElement) {
    },
    onAdd: function (pAdd) {
        if (typeof (pAdd) !== "function") {
            pAdd = function () {
            };
        }
        this._img_11.setOnClick(pAdd);
    },
    addAction: function () {
        var date = new Date();

        var day = date.getDate();
        var month = date.getMonth() + 1;
        var year = date.getFullYear();

        if (month < 10)
            month = "0" + month;
        if (day < 10)
            day = "0" + day;

        var h = date.getHours() < 10 ? "0" + date.getHours() : date.getHours();
        var m = date.getMinutes() < 10 ? "0" + date.getMinutes() : date.getMinutes();
        var time_now = h + ':' + m;
        var today_time = year + "-" + month + "-" + day + " " + time_now;
        
        var max_month = date.getMonth() + 2;
        var max_date = year + "-" + max_month + "-" + day + " " + time_now;
        
        var arr_nextACT = new Array('<form id="data_addaction"><table border="0" class="component_form" id="next_' + counterAddAction + '">\n\
                    <tr>\n\
                        <td align="center" colspan="3" class="field_header"><label class="label_header">NEXT ACTION ' + counterAddAction + '</label></td>\n\
                    </tr>\n\
                    <tr>\n\
                        <td class="td_item_content">\n\
                            <label class="mandatory_label">Action Item*</label>\n\
                            <input type="text" id="nx_action_item_' + indexing + '" class="input_digform">\n\
                        </td>\n\
                        <td></td>\n\
                    </tr>\n\
                    <tr>\n\
                        <td class="td_item_content">\n\
                            <label class="nonmandatory_label">PIC</label><br>\n\
                            <ul class="ul_pic" id="ul_pic_'+indexing+'"></ul>\n\
                            <input type="text" oninput="autocomplitePIC(this.value,' + indexing + ')" id="nx_pic_' + indexing + '" class="input_digform" placeholder="Type here to add PIC">\n\
                            <span id="list_add_' + indexing + '" ></span>\n\
                        </td>\n\
                    </tr>\n\
                    <tr>\n\
                        <td class="td_item_content">\n\
                            <label class="nonmandatory_label">Start</label><br>\n\
                            <input type="text" value="'+today_time+'" id="nx_start_' + indexing + '" onchange="dateValidationNextAction(\'nx_start_\',\'nx_deadline_\',\'start\',\'' + indexing + '\')" class="input_digform">\n\
                        </td>\n\
                    </tr>\n\
                    <tr>\n\
                        <td class="td_item_content">\n\
                            <label class="nonmandatory_label">Deadline</label><br>\n\
                            <input type="text" value="'+today_time+'" id="nx_deadline_' + indexing + '" onchange="dateValidationNextAction(\'nx_start_\',\'nx_deadline_\',\'end\',\'' + indexing + '\')" class="input_digform">\n\
                        </td>\n\
                    </tr>\n\
                </table></form>\n\
                '
                );
        $('#div_container_11').append(arr_nextACT);
        console.log('count : ' + counterAddAction);
        $('#nx_start_'+indexing).bootstrapMaterialDatePicker({ format : 'YYYY-MM-DD HH:mm' });
        $('#nx_deadline_'+indexing).bootstrapMaterialDatePicker({ format : 'YYYY-MM-DD HH:mm' });
        
//        $('#nx_start_'+indexing).on('change', function(){
//            alert("here (start)"+indexing);
//            var sc_date = $('#nx_start_'+indexing).val();
//            var ec_date = $('#nx_deadline_'+indexing).val();
//            dateValidation(sc_date+":59", ec_date,"start", indexing);
//        })
//        
//        $('#nx_deadline_'+indexing).on('change', function(){
//            alert("here (end)"+indexing);
//            var sc_date = $('#nx_start_'+indexing).val();
//            var ec_date = $('#nx_deadline_'+indexing).val();
//            dateValidation(sc_date+":59", ec_date,"end", indexing);
//        })
        
        counterAddAction++;
        indexing++;
        
        
        
        
//        var ARR_PIC = [];
//        var availableTags = [
//                 {"f_pin":"abcd1234", "label":"Awal Muhib Halim","mail":"123@example.com"},
//                 {"f_pin":"abcd5678", "label":"Wildan","mail":"456@example.com"},
//                 {"f_pin":"abcd9101", "label":"Sigit","mail":"789@example.com"},
//             ]
//              $( ".pic_autocomplitee").autocomplete({
//                source: availableTags,
//                select: function(event, ui) {
//                var piclist = ui.item.f_pin;
//                        ARR_PIC.indexOf(piclist) == - 1 ? ARR_PIC.push(piclist) : console.log("Maaf item serupa sudah ditambakan");
//                        console.log("arrpic : " + ARR_PIC);
////                        $('#list_add_'+counterAddAction).text(ARR_PIC);
//                        ArrayPIC.ARR_MULTIPLE.indexOf(piclist) == - 1 ? ArrayPIC.ARR_MULTIPLE.push(piclist) : console.log("Maaf item serupa sudah ditambakan");
//                        console.log("ArrayPIC.ARR_MULTIPLE : " + ArrayPIC.ARR_MULTIPLE);
//                return false;
//                }
//            });
//            
//            ArrayPIC.ARR_COUNTER.push(counterAddAction);




    },
    list: '',
    navigation: '',
    navigation_paging: ''
});

var SingleButtonDeleteAction = Div.extend({
    construct: function () {
        arguments.callee.super.construct.call(this);
        this.navigation = new Div();
    },
    setOnClick: function (p_Click) {
        this.navigation.setOnClick(p_Click);
    },
    showButtonDelete: function () {
        $('#div_del').show();
    },
    hideButtonDelete: function () {
        this.navigation.hide();
    },
    addDetail: function (pElement) {
    },
    onAdd: function (pAdd) {
        if (typeof (pAdd) !== "function") {
            pAdd = function () {
            };
        }
        this._img_11.setOnClick(pAdd);
    },
    deleteNextAction: function () {
        $('#next_' + counterAddAction).remove();
        console.log("counter delete :" + counterAddAction);
        counterAddAction--;
        if (counterAddAction < 2) {
            counterAddAction = 2;
            $('#div_del').hide();
        }
    },
    list: '',
    navigation: '',
    navigation_paging: ''
});


function gen_fillDatePicker() { // set date picker
    var date = new Date();

    var day = date.getDate();
    var month = date.getMonth() + 1;
    var year = date.getFullYear();

    if (month < 10)
        month = "0" + month;
    if (day < 10)
        day = "0" + day;

    var today = year + "-" + month + "-" + day;
    return today;
}

function gen_fillTimePicker() { // set time picker
    var date = new Date(),
            h = date.getHours(),
            m = date.getMinutes();
    if (h < 10)
        h = '0' + h;
    if (m < 10)
        m = '0' + m;
    var time_now = h + ':' + m;
    return time_now;
}

function gen_fillDateTimePicker() { // set date tie picker
    var date = new Date();

    var day = date.getDate();
    var month = date.getMonth() + 1;
    var year = date.getFullYear();

    if (month < 10)
        month = "0" + month;
    if (day < 10)
        day = "0" + day;

    h = date.getHours(),
            m = date.getMinutes();
    if (h < 10)
        h = '0' + h;
    if (m < 10)
        m = '0' + m;
    var time_now = h + ':' + m;

    var today_time = year + "-" + month + "-" + day + "T" + time_now;

    return today_time;
}
var ARR_PIC = [];
var arr = [[],[],[],[],[],[],[],[],[],[]];
function autocomplitePIC(value, index){
//    ARR_PIC=[];
    
    
//        var availableTags = [
//                 {"f_pin":"abcd1234", "label":"Awal Muhib Halim","mail":"123@example.com", "img":"img/digitalform/item/icon_item_person_1.png"},
//                 {"f_pin":"abcd5678", "label":"Wildan","mail":"456@example.com","img":"img/digitalform/item/icon_item_person_1.png"},
//                 {"f_pin":"abcd9101", "label":"Sigit","mail":"789@example.com","img":"img/digitalform/item/icon_item_person_1.png"},
//             ]

//              var availableTags = [{"id": 80, "f_pin":"abcd1231", "childs": "[]", "level": 2, "collapse": true, "label": "Abdur Rosyid (Business Solution)", "subTitle": "Offline", "thumbnail": "0bba9090-162496A42DB.jpg", "thumb_resource": 2130903091, "type": 2, "node_id": "0bba9090", "indicator_status": "4", "last_update": "1523988091882", "parent": "friend"}, {"id": 97, "childs": "[]", "level": 2, "collapse": true, "label": "Abrar Bensar (Business Solution)", "subTitle": "Offline", "thumbnail": "http:\/\/202.158.33.28:2807\/file\/image\/abrar.jpg", "thumb_resource": 2130903091, "type": 2, "node_id": "0bbb96ed", "indicator_status": "4", "last_update": "1523988091885", "parent": "friend"}, {"id": 83, "f_pin":"abcd1232", "childs": "[]", "level": 2, "collapse": true, "label": "Agus Haryanto (Product Solution\/Staff)", "subTitle": "Offline", "thumbnail": "barong_5.png", "thumb_resource": 2130903091, "type": 2, "node_id": "0bbb1ce0", "indicator_status": "4", "last_update": "1523988091881", "parent": "friend"}, {"id": 35, "f_pin":"abcd1233", "childs": "[]", "level": 2, "collapse": true, "label": "Ahmad Nafis Shoba (Product Solution\/Group Leader)", "subTitle": "@PT easySoft Indonesia", "thumbnail": "http:\/\/202.158.33.28:2807\/file\/image\/1-1602a08938e.jpg", "thumb_resource": 2130903091, "type": 2, "node_id": "0bb99f8f", "indicator_status": "1", "last_update": "1524016604087", "parent": "friend"}, {"id": 103, "f_pin":"abcd1234", "childs": "[]", "level": 2, "collapse": true, "label": "Ahmad Hidayat (Product Solution\/Staff)", "subTitle": "V x t", "thumbnail": "http:\/\/202.158.33.28:2807\/file\/image\/1-15f4de1d532.jpg", "thumb_resource": 2130903091, "type": 2, "node_id": "0bbbb603", "indicator_status": "4", "last_update": "1523988091884", "parent": "friend"}, {"id": 38, "f_pin":"abcd1235", "childs": "[]", "level": 2, "collapse": true, "label": "Ahmad Rizqi Pratama (Product Solution\/Staff)", "subTitle": "Offline", "thumbnail": "http:\/\/202.158.33.28:2807\/file\/image\/1-15dcb3c3d42.jpg", "thumb_resource": 2130903091, "type": 2, "node_id": "0bb9b39d", "indicator_status": "4", "last_update": "1524019594099", "parent": "friend"}, {"id": 10, "f_pin":"abcd1235", "childs": "[]", "level": 2, "collapse": true, "label": "Akhmad Muntako (Product Solution\/Staff)", "subTitle": "Offline", "thumbnail": "http:\/\/202.158.33.28:2807\/file\/image\/1-15e27b2ac7d.jpg", "thumb_resource": 2130903091, "type": 2, "node_id": "02273a9dae", "indicator_status": "4", "last_update": "1523988091890", "parent": "friend"}, {"id": 46, "f_pin":"abcd1237", "childs": "[]", "level": 2, "collapse": true, "label": "Aldi Hardiansyah (Implementation Support)", "subTitle": "Excellent", "thumbnail": "0bb9de24-162951EF7F5.jpg", "thumb_resource": 2130903091, "type": 2, "node_id": "0bb9de24", "indicator_status": "1", "last_update": "1524020816422", "parent": "friend"}, {"id": 22, "f_pin":"abcd1238", "childs": "[]", "level": 2, "collapse": true, "label": "Andri Laulata (Implementation Support)", "subTitle": "Offline", "thumbnail": "barong_5.png", "thumb_resource": 2130903091, "type": 2, "node_id": "0293ca68a3", "indicator_status": "4", "last_update": "1523988091894", "parent": "friend"}, {"id": 57, "f_pin":"abcd1239", "childs": "[]", "level": 2, "collapse": true, "label": "Asep Muprodin (General Affair)", "subTitle": "@Pegangsaan, Central Jakarta City", "thumbnail": "0bba1339-161ADE9B4C9.jpg", "thumb_resource": 2130903091, "type": 2, "node_id": "0bba1339", "indicator_status": "1", "last_update": "1524021326112", "parent": "friend"}, {"id": 18, "f_pin":"abcd12310", "childs": "[]", "level": 2, "collapse": true, "label": "Aulia Rahman (Business Solution)", "subTitle": "Offline", "thumbnail": "barong_7.png", "thumb_resource": 2130903091, "type": 2, "node_id": "026f0122f7", "indicator_status": "4", "last_update": "1523988091891", "parent": "friend"}, {"id": 42, "f_pin":"abcd12311", "childs": "[]", "level": 2, "collapse": true, "label": "Awal Muhib Halim (Product Solution\/Staff)", "subTitle": "Excellent", "thumbnail": "http:\/\/202.158.33.28:2807\/file\/image\/1-15e1c1df604.jpg", "thumb_resource": 2130903091, "type": 2, "node_id": "0bb9ca42", "indicator_status": "1", "last_update": "1524020094621", "parent": "friend"}, {"id": 13, "f_pin":"abcd12312", "childs": "[]", "level": 2, "collapse": true, "label": "Bagus Prasetyo (Implementation Support)", "subTitle": "Offline", "thumbnail": "025067badd-161B13133E2.jpg", "thumb_resource": 2130903091, "type": 2, "node_id": "025067badd", "indicator_status": "4", "last_update": "1524018513841", "parent": "friend"}];
             var availableTags = friendmap;
             
              $( "#nx_pic_"+index).autocomplete({
                source: availableTags,
                select: function(event, ui) {
                var piclist = ui.item.f_pin;
                var piclistname = ui.item.label;
                        // this array multidimensional from digfrom.js
//                        ArrayPIC.ARR_MULTIPLE[index].indexOf(piclist) == - 1 ? ArrayPIC.ARR_MULTIPLE[index].push(piclist) : console.log("Maaf item serupa sudah ditambakan");
                        if(ArrayPIC.ARR_MULTIPLE[index].length == 0){
                            var highlight = "background-color:#abdff2;";
                            ArrayPIC.ARR_MULTIPLE[index].push(piclist + "," + piclistname + ",*");
                            var argument = piclist + "," + piclistname + ",*";
                            $('#ul_pic_' + index).append('<div style="padding:5px;"><div id="nxx_piclist_'+index+piclist+ '" class="div_add_party nxx_piclist_'+index+'" style='+highlight+' onclick="setmainPIC(\'nxx_piclist_\',\''+piclist+'\',\''+index+'\')">' + getImage(ui.item.f_pin) + '<label class="label_add_party">' + piclistname + '</label><img class="img_del_party" src="img/unify_asset/md-close-circle-orange.png" onclick="deleteItemPIC(\''+piclist+'\',\''+argument+'\',\'nxx_piclist_\',\''+index+'\')"></div></div>');
                            $("#nx_pic_" + index).val("");
                            var plus = index + 1;
                                if(ArrayPIC.ARR_COUNTER.indexOf(plus) == -1){
                                    ArrayPIC.ARR_COUNTER.push(plus);
                                    console.log("array counter : "+ArrayPIC.ARR_COUNTER)
                                    console.log("array counter lenght : "+ArrayPIC.ARR_COUNTER.length)
                                }
                        }else{
                            var check_value = piclist + "," + piclistname + ","; 
                            if(ArrayPIC.ARR_MULTIPLE[index].indexOf(check_value) == -1){
                                var check_main_person = piclist + "," + piclistname + ",*";
                                if(ArrayPIC.ARR_MULTIPLE[index].indexOf(check_main_person) == -1){
                                    ArrayPIC.ARR_MULTIPLE[index].push(piclist + "," + piclistname + ",");
                                    var argument = piclist + "," + piclistname + ",";
                                    $('#ul_pic_' + index).append('<div style="padding:5px;"><div id="nxx_piclist_'+index+piclist+ '" class="div_add_party nxx_piclist_'+index+'" onclick="setmainPIC(\'nxx_piclist_\',\''+piclist+'\',\''+index+'\')">' + getImage(ui.item.f_pin) + '<label class="label_add_party">' + piclistname + '</label><img class="img_del_party" src="img/unify_asset/md-close-circle-orange.png" onclick="deleteItemPIC(\''+piclist+'\',\''+argument+'\',\'nxx_piclist_\',\''+index+'\')"></div></div>');
                                    $("#nx_pic_" + index).val("");
                                    
                                    var plus = index + 1;
                                    if (ArrayPIC.ARR_COUNTER.indexOf(plus) == -1) {
                                        ArrayPIC.ARR_COUNTER.push(plus);
                                        console.log("array counter : " + ArrayPIC.ARR_COUNTER)
                                        console.log("array counter lenght : " + ArrayPIC.ARR_COUNTER.length)
                                    }
                                }else{
                                    console.log("Maaf item serupa (main person) sudah ditambakan");
                                }
                            }else{
                                console.log("Maaf item serupa sudah ditambakan");
                                $( "#nx_pic_"+index).val("");
                            }
                        }
                        
                        /*
                            if(ArrayPIC.ARR_MULTIPLE[index].indexOf(piclist) == -1){
                                ArrayPIC.ARR_MULTIPLE[index].push(piclist);
                                console.log("arrpic : " + ArrayPIC.ARR_MULTIPLE[index]);
                                console.log("arrpic .length : " + ArrayPIC.ARR_MULTIPLE[index].length);
                            // getImageThumbnails(). this method was called from dgiform.js
                                $('#ul_pic_'+index).append('<li id="nxx_piclist_'+index+'"><div style="padding:5px;"><div class="div_add_party">'+ getImage(ui.item.f_pin) +'<label class="label_add_party">'+piclistname+'</label><img class="img_del_party" src="img/assetall/close.png" onclick="deleteList(\''+index+'\',\'pic_autocomplitee_\')"></div></div></li>');
                                $( "#pic_autocomplitee_"+index).val("");
                                var plus = index + 1;
                                if(ArrayPIC.ARR_COUNTER.indexOf(plus) == -1){
                                    ArrayPIC.ARR_COUNTER.push(plus);
                                    console.log("array counter : "+ArrayPIC.ARR_COUNTER)
                                    console.log("array counter lenght : "+ArrayPIC.ARR_COUNTER.length)
                                }else{
                                    console.log("array counter is same value "+index)
                                }
                            }else{
                               console.log("Maaf item serupa sudah ditambakan"); 
                               $( "#pic_autocomplitee_"+index).val("");
                            }
                            
                        */    
                return false;
                }
            });
            
           
            
            
        }
