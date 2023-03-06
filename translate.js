

import { index } from './language/index_dict.js?v=70';
import { usecase } from './language/usecase_dict.js?v=13';
import { usocial } from './language/usocial_dict.js?v=698';
import { livestream } from './language/livestream_dict.js?v=1';
import { videocall } from './language/videocall_dict.js?v=1';
import { audiocall } from './language/audiocall_dict.js?v=1';
import { screenshare } from './language/screenshare_dict.js?v=1';
import { unifiedmessage } from './language/unifiedmessage_dict.js?v=1';
import { smartfeatures } from './language/smartfeatures_dict.js?v=75';
import { whiteboard } from './language/whiteboard_dict.js?v=1';
import { newpricing } from './language/newpricing_dict.js?v=5';
import { indexnav } from './language/index-nav_dict.js?v=10';
import { contactalt } from './language/contact-alt_dict.js?v=1';
import { contactaltproducts } from './language/contact-alt-products_dict.js?v=1';
import { footeralt } from './language/footer-alt_dict.js?v=1';
import { contactus } from './language/contactus_dict.js?v=1';
import { login } from './language/login_dict.js?v=3';
import { signup } from './language/signup_dict.js?v=3';
import { forgot } from './language/forgot_dict.js?v=1';
import { palioButton } from './language/palio-button_dict.js?v=6';
import { blogindex } from './language/blog-index_dict.js?v=78';
import { dashindex } from '../language/dash-index_dict.js?v=4';
import { dashside } from '../language/dash-side_dict.js?v=1';
import { dashbill } from '../language/dash-bill_dict.js?v=1';
import { dashport } from '../language/dash-support_dict.js?v=1';
import { dashdf } from '../language/dash-df_dict.js?v=1';
import { dashnf } from '../language/dash-nf_dict.js?v=1';
import { dashform } from '../language/dash-form_dict.js?v=7';

if(localStorage.lang == null){
    localStorage.lang = 0;
}

var dictionary = Object.assign({}, index, palioButton, login, usecase, usocial, livestream, videocall, audiocall, screenshare, unifiedmessage, smartfeatures, whiteboard, newpricing, indexnav, contactalt, contactaltproducts, footeralt, contactus, signup, forgot, blogindex, dashindex, dashside, dashbill, dashport, dashdf, dashnf, dashform);

var langs = ['en', 'id'];
var current_lang_index = localStorage.lang;
var current_lang = langs[current_lang_index];

window.change_lang = function () {
    current_lang = langs[localStorage.lang];
    translate();
}

function translate() {
    $("[data-translate]").each(function () {
        var key = $(this).data('translate');
        $(this).html(dictionary[key][current_lang] || "N/A");
    });
}
 
translate();

$('body').removeClass('d-none');