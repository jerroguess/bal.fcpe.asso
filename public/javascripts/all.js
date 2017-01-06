/*
 --------------------------------------------------------------------
 all.js
 --------------------------------------------------------------------
 Creator : X.ROUILLY 10/02/2015
 --------------------------------------------------------------------
 (c) 2013. All Rights Reserved.  FCPE
 --------------------------------------------------------------------
 */

 jQuery(function() {

	$.reject({  
		reject: {
			all: false,
			msie: 8
		}, // Reject all renderers for demo  
		close: false, // Prevent closing of window 
		header: 'Votre navigateur n\'est plus supportÈ', // Header Text  
		paragraph1: 'Vous utilisez actuellement un navigateur non supportÈ', // Paragraph 1  
		paragraph2: 'S\'il vous plaÓt installer l\'un de ces nombreux navigateurs ci-dessous avant de continuer',  
		closeMessage: 'Fermez cette fenÍtre ‡ vos risques' // Message below close window link  
	}); // Customized Text  

});
	
// Remplace les caractËres accentuÈs (+ espace)
function PurgeAccent(strAccents){
    strAccents = strAccents.split('');
    strAccentsOut = new Array();
    strAccentsLen = strAccents.length;
    var accents = '¿¡¬√ƒ≈‡·‚„‰Â“”‘’’÷ÿÚÛÙıˆ¯»… ÀËÈÍÎ«Á–ÃÕŒœÏÌÓÔŸ⁄€‹˘˙˚¸—Ò¶®æˇ˝¥∏';
    var accentsOut = ['A','A','A','A','A','A','a','a','a','a','a','a','O','O','O','O','O','O','O','o','o','o','o','o','o','E','E','E','E','e','e','e','e','e','C','c','D','I','I','I','I','i','i','i','i','U','U','U','U','u','u','u','u','N','n','S','s','Y','y','y','Z','z'];
    for (var y = 0; y < strAccentsLen; y++) {
        if (accents.indexOf(strAccents[y]) != -1) {
            strAccentsOut[y] = accentsOut[accents.indexOf(strAccents[y])];
        }
        else
            strAccentsOut[y] = strAccents[y];
    }
    strAccentsOut = strAccentsOut.join('');
    return strAccentsOut;
}

//--------------------------------
// Fonctions de remplacements.
//--------------------------------
// Remplace toutes les occurences d'une chaine
function ReplaceAll(str, search, repl) {
    while (str.indexOf(search) != - 1)
        str = str.replace(search, repl);
    return str;
}
    
$(function() {  
                
    $("[rel='tooltip']").tooltip();    
    $('.thumbnail').hover(
        function(){
            $(this).find('.caption').slideDown(250); //.fadeIn(250)
        },
        function(){
            $(this).find('.caption').slideUp(250); //.fadeOut(205)
        }
    );
        
    $("#username").keypress(function(event) {
        saisieMDP(event);
    });
    
    $("#password").keypress(function(event) {
        saisieMDP(event);
    });
	
	$("#commune_Saisie").keyup(function(event) {
        if($('#commune_Saisie').val().length == 0){
			$('#codepostal_Saisie').val("");
		}
    });
    
    $("#btnLogin").click(function() {
        $("#menu_HCnxLog").val($('#username').val());
        $("#menu_HCnxPas").val(calcMD5($('#password').val()));
        $('#menu_HCnxForm').submit();
    });
    
    if (jQuery('#fileuploadAvatar').length > 0){
        jQuery('#fileuploadAvatar').fileupload({
            url: strUrlModifierAvatar,
            dataType: 'json',
            done: function (e, data) {
                var llst_Image = jQuery('img.' + strNomImageAvatar + '');
                jQuery.each(llst_Image, function(index, lobj_Image) {
                    var llst_NomImage = strCheminImageAvatar.split('?');
                    strCheminImageAvatar = llst_NomImage[0] + '?v=' + guid();
                    lobj_Image.src = strCheminImageAvatar;
                });
                if (jQuery('#avatarPositionner_Saisie')) {
                    jQuery('#avatarPositionner_Saisie').val('1');
                }
            },
            submit: function (e, data) {
                jQuery('#progressAvatar').show();
            },
            progressall: function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                jQuery('#progressAvatar .progress-bar').css(
                    'width',
                    progress + '%'
                );
                if (progress == 100) setTimeout("jQuery('#progressAvatar').hide();jQuery('#progressAvatar .progress-bar').css('width','0%');", 1000);
            }
        }).prop('disabled', !jQuery.support.fileInput).parent().addClass(jQuery.support.fileInput ? undefined : 'disabled');
    }
    
    if (jQuery('#fileuploadIllustration').length > 0){
        jQuery('#fileuploadIllustration').fileupload({
            url: strUrlModifierIllustration,
            dataType: 'json',
            done: function (e, data) {
                var llst_Image = jQuery('img.' + strNomImageIllustration + '');
                jQuery.each(llst_Image, function(index, lobj_Image) {
                    var llst_NomImage = strCheminImageIllustration.split('?');
                    strCheminImageIllustration = llst_NomImage[0] + '?v=' + guid();
                    lobj_Image.src = strCheminImageIllustration;
                });
                if (jQuery('#illustrationPositionner_Saisie')) {
                    jQuery('#illustrationPositionner_Saisie').val('1');
                }
            },
            submit: function (e, data) {
                jQuery('#progressIllustration').show();
            },
            progressall: function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                jQuery('#progressIllustration .progress-bar').css(
                    'width',
                    progress + '%'
                );
                if (progress == 100) setTimeout("jQuery('#progressIllustration').hide();jQuery('#progressIllustration .progress-bar').css('width','0%');", 1000);
            }
        }).prop('disabled', !jQuery.support.fileInput).parent().addClass(jQuery.support.fileInput ? undefined : 'disabled');
    }
    
    if (jQuery('#commune_Saisie').length > 0){
        jQuery('#commune_Saisie').autocomplete({
            source: function( request, response ) {
				
                jQuery.ajax({
                    url: "ajax/commune",
                    dataType: "jsonp",
                    data: {
                        commune: jQuery('#commune_Saisie').val()
                    },
                    success: function(aobj_Data) {

                        // Ajout des nouveaux ÈlÈments de la liste.
                        response( jQuery.map( aobj_Data.communes, function( item ) {
                            if (typeof item != "undefined"){
                                return {
                                    label: item.commune +  " - " + (item.code_postal),
                                    value: item.commune,
                                    id: item.id,
                                    latitude:item.latitude,
                                    longitude:item.longitude,
                                    codepostal:item.code_postal
                                }
                            }
                        }));
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                      // Une erreur s'est produite lors de la requete
                    }
                });
            },
            minLength: 2,
            select: function( event, ui ) {
                jQuery('.commune_Saisie').val(ui.item.value);
                jQuery('.id_commune_Saisie').val(ui.item.id);
                jQuery('.codepostal_Saisie').val(ui.item.codepostal);
            },
            open: function() {
                jQuery( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
            },
            close: function() {
                jQuery( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
            }
        });
    }
});

function s4() {
    return Math.floor((1 + Math.random()) * 0x10000).toString(16).substring(1);
};

function guid() {
    return s4() + s4() + '-' + s4() + '-' + s4() + '-' + s4() + '-' + s4() + s4() + s4();
}

//Fonction de contrÙle de saisie.
function saisieMDP(objTouche) {

    // Suivant la touche appuyÈe.
    switch (objTouche.event.keyCode) {

        case 13 :
            // L'utilisateur a appuyÈ sur entrÈ, execution de la connexion. 
            $("#menu_HCnxLog").val($('#username').val());
            $("#menu_HCnxPas").val(calcMD5($('#password').val()));
            $('#menu_HCnxForm').submit();
            break;

        default :
            break;
    }
}

//-----------------------------------------------------------------------------
//Fonctions MD5.
//-----------------------------------------------------------------------------
/*
 * A JavaScript implementation of the RSA Data Security, Inc. MD5 Message
 * Digest Algorithm, as defined in RFC 1321.
 * Copyright (C) Paul Johnston 1999 - 2000.
 * Updated by Greg Holt 2000 - 2001.
 * See http://pajhome.org.uk/site/legal.html for details.
 */

/*
 * Convert a 32-bit number to a hex string with ls-byte first
 */
var hex_chr = "0123456789abcdef";
function rhex(num) {
    str = "";
    for (j = 0; j <= 3; j++)
        str += hex_chr.charAt((num >> (j * 8 + 4)) & 0x0F) +
                hex_chr.charAt((num >> (j * 8)) & 0x0F);
    return str;
}

/*
 * Convert a string to a sequence of 16-word blocks, stored as an array.
 * Append padding bits and the length, as described in the MD5 standard.
 */
function str2blks_MD5(str) {
    nblk = ((str.length + 8) >> 6) + 1;
    blks = new Array(nblk * 16);
    for (i = 0; i < nblk * 16; i++)
        blks[i] = 0;
    for (i = 0; i < str.length; i++)
        blks[i >> 2] |= str.charCodeAt(i) << ((i % 4) * 8);
    blks[i >> 2] |= 0x80 << ((i % 4) * 8);
    blks[nblk * 16 - 2] = str.length * 8;
    return blks;
}

/*
 * Add integers, wrapping at 2^32. This uses 16-bit operations internally 
 * to work around bugs in some JS interpreters.
 */
function add(x, y) {
    var lsw = (x & 0xFFFF) + (y & 0xFFFF);
    var msw = (x >> 16) + (y >> 16) + (lsw >> 16);
    return (msw << 16) | (lsw & 0xFFFF);
}

/*
 * Bitwise rotate a 32-bit number to the left
 */
function rol(num, cnt) {
    return (num << cnt) | (num >>> (32 - cnt));
}

/*
 * These functions implement the basic operation for each round of the
 * algorithm.
 */
function cmn(q, a, b, x, s, t) {
    return add(rol(add(add(a, q), add(x, t)), s), b);
}
function ff(a, b, c, d, x, s, t) {
    return cmn((b & c) | ((~b) & d), a, b, x, s, t);
}
function gg(a, b, c, d, x, s, t) {
    return cmn((b & d) | (c & (~d)), a, b, x, s, t);
}
function hh(a, b, c, d, x, s, t) {
    return cmn(b ^ c ^ d, a, b, x, s, t);
}
function ii(a, b, c, d, x, s, t) {
    return cmn(c ^ (b | (~d)), a, b, x, s, t);
}

/*
 * Take a string and return the hex representation of its MD5.
 */
function calcMD5(str) {
    x = str2blks_MD5(str);
    a = 1732584193;
    b = -271733879;
    c = -1732584194;
    d = 271733878;

    for (i = 0; i < x.length; i += 16) {
        olda = a;
        oldb = b;
        oldc = c;
        oldd = d;

        a = ff(a, b, c, d, x[i + 0], 7, -680876936);
        d = ff(d, a, b, c, x[i + 1], 12, -389564586);
        c = ff(c, d, a, b, x[i + 2], 17, 606105819);
        b = ff(b, c, d, a, x[i + 3], 22, -1044525330);
        a = ff(a, b, c, d, x[i + 4], 7, -176418897);
        d = ff(d, a, b, c, x[i + 5], 12, 1200080426);
        c = ff(c, d, a, b, x[i + 6], 17, -1473231341);
        b = ff(b, c, d, a, x[i + 7], 22, -45705983);
        a = ff(a, b, c, d, x[i + 8], 7, 1770035416);
        d = ff(d, a, b, c, x[i + 9], 12, -1958414417);
        c = ff(c, d, a, b, x[i + 10], 17, -42063);
        b = ff(b, c, d, a, x[i + 11], 22, -1990404162);
        a = ff(a, b, c, d, x[i + 12], 7, 1804603682);
        d = ff(d, a, b, c, x[i + 13], 12, -40341101);
        c = ff(c, d, a, b, x[i + 14], 17, -1502002290);
        b = ff(b, c, d, a, x[i + 15], 22, 1236535329);

        a = gg(a, b, c, d, x[i + 1], 5, -165796510);
        d = gg(d, a, b, c, x[i + 6], 9, -1069501632);
        c = gg(c, d, a, b, x[i + 11], 14, 643717713);
        b = gg(b, c, d, a, x[i + 0], 20, -373897302);
        a = gg(a, b, c, d, x[i + 5], 5, -701558691);
        d = gg(d, a, b, c, x[i + 10], 9, 38016083);
        c = gg(c, d, a, b, x[i + 15], 14, -660478335);
        b = gg(b, c, d, a, x[i + 4], 20, -405537848);
        a = gg(a, b, c, d, x[i + 9], 5, 568446438);
        d = gg(d, a, b, c, x[i + 14], 9, -1019803690);
        c = gg(c, d, a, b, x[i + 3], 14, -187363961);
        b = gg(b, c, d, a, x[i + 8], 20, 1163531501);
        a = gg(a, b, c, d, x[i + 13], 5, -1444681467);
        d = gg(d, a, b, c, x[i + 2], 9, -51403784);
        c = gg(c, d, a, b, x[i + 7], 14, 1735328473);
        b = gg(b, c, d, a, x[i + 12], 20, -1926607734);

        a = hh(a, b, c, d, x[i + 5], 4, -378558);
        d = hh(d, a, b, c, x[i + 8], 11, -2022574463);
        c = hh(c, d, a, b, x[i + 11], 16, 1839030562);
        b = hh(b, c, d, a, x[i + 14], 23, -35309556);
        a = hh(a, b, c, d, x[i + 1], 4, -1530992060);
        d = hh(d, a, b, c, x[i + 4], 11, 1272893353);
        c = hh(c, d, a, b, x[i + 7], 16, -155497632);
        b = hh(b, c, d, a, x[i + 10], 23, -1094730640);
        a = hh(a, b, c, d, x[i + 13], 4, 681279174);
        d = hh(d, a, b, c, x[i + 0], 11, -358537222);
        c = hh(c, d, a, b, x[i + 3], 16, -722521979);
        b = hh(b, c, d, a, x[i + 6], 23, 76029189);
        a = hh(a, b, c, d, x[i + 9], 4, -640364487);
        d = hh(d, a, b, c, x[i + 12], 11, -421815835);
        c = hh(c, d, a, b, x[i + 15], 16, 530742520);
        b = hh(b, c, d, a, x[i + 2], 23, -995338651);

        a = ii(a, b, c, d, x[i + 0], 6, -198630844);
        d = ii(d, a, b, c, x[i + 7], 10, 1126891415);
        c = ii(c, d, a, b, x[i + 14], 15, -1416354905);
        b = ii(b, c, d, a, x[i + 5], 21, -57434055);
        a = ii(a, b, c, d, x[i + 12], 6, 1700485571);
        d = ii(d, a, b, c, x[i + 3], 10, -1894986606);
        c = ii(c, d, a, b, x[i + 10], 15, -1051523);
        b = ii(b, c, d, a, x[i + 1], 21, -2054922799);
        a = ii(a, b, c, d, x[i + 8], 6, 1873313359);
        d = ii(d, a, b, c, x[i + 15], 10, -30611744);
        c = ii(c, d, a, b, x[i + 6], 15, -1560198380);
        b = ii(b, c, d, a, x[i + 13], 21, 1309151649);
        a = ii(a, b, c, d, x[i + 4], 6, -145523070);
        d = ii(d, a, b, c, x[i + 11], 10, -1120210379);
        c = ii(c, d, a, b, x[i + 2], 15, 718787259);
        b = ii(b, c, d, a, x[i + 9], 21, -343485551);

        a = add(a, olda);
        b = add(b, oldb);
        c = add(c, oldc);
        d = add(d, oldd);
    }
    return rhex(a) + rhex(b) + rhex(c) + rhex(d);
}

function htmlDecode(value) {
    if (value) {
        return $('<div />').html(value).text();
    } else {
        return '';
    }
}