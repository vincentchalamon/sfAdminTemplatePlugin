

(function($){
    $.fn.validationEngineLanguage = function(){
    };
    $.validationEngineLanguage = {
        newLang: function(){
            $.validationEngineLanguage.allRules = {
                "required": {
                    "regex": "none",
                    "alertText": "* Ce champs est requis",
                    "alertTextCheckboxMultiple": "* Choisir une option",
                    "alertTextCheckboxe": "* Cette option est requise"
                },
                "minSize": {
                    "regex": "none",
                    "alertText": "* Minimum ",
                    "alertText2": " caracteres requis"
                },
                "maxSize": {
                    "regex": "none",
                    "alertText": "* Maximum ",
                    "alertText2": " caracteres requis"
                },
                "min": {
                    "regex": "none",
                    "alertText": "* Valeur minimum requise "
                },
                "max": {
                    "regex": "none",
                    "alertText": "* Valeur maximum requise "
                },
                "past": {
                    "regex": "none",
                    "alertText": "* Date antérieure au "
                },
                "future": {
                    "regex": "none",
                    "alertText": "* Date postérieure au "
                },
                "maxCheckbox": {
                    "regex": "none",
                    "alertText": "* Nombre max de choix excédé"
                },
                "minCheckbox": {
                    "regex": "none",
                    "alertText": "* Veuillez choisir ",
                    "alertText2": " options"
                },
                "equals": {
                    "regex": "none",
                    "alertText": "* Votre champs n'est pas identique"
                },
                "phone": {
                    // credit: jquery.h5validate.js / orefalo
                    "regex": /^([\+][0-9]{1,3}[ \.\-])?([\(]{1}[0-9]{2,6}[\)])?([0-9 \.\-\/]{3,20})((x|ext|extension)[ ]?[0-9]{1,4})?$/,
                    "alertText": "* Numéro de téléphone invalide"
                },
                "email": {
                    // Shamelessly lifted from Scott Gonzalez via the Bassistance Validation plugin http://projects.scottsplayground.com/email_address_validation/
                    "regex": /^((([A-z|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([A-z|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([A-z|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([A-z|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([A-z|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([A-z|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([A-z|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([A-z|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([A-z|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([A-z|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/,
                    "alertText": "* Adresse email invalide"
                },
                "integer": {
                    "regex": /^[\-\+]?\d+$/,
                    "alertText": "* Nombre entier invalide"
                },
                "number": {
                    // Number, including positive, negative, and floating decimal. credit: orefalo
                    "regex": /^[\-\+]?(([0-9]+)([\.,]([0-9]+))?|([\.,]([0-9]+))?)$/,
                    "alertText": "* Nombre flottant invalide"
                },
                "date_custom": {
                    // Date in ISO format. Credit: bassistance
                    "regex": /^(0[1-9]|[12][0-9]|3[01])([\-\/]{1})(0[1-9]|1[012])([\-\/]{1})(19[0-9]{2}|20[0-9]{2})$/,
                    "alertText": "* Date invalide, format DD/MM/YYYY requis"
                },
                "timestamp": {
                    "regex": /^(0[1-9]|[12][0-9]|3[01])([\-\/]{1})(0[1-9]|1[012])([\-\/]{1})(19[0-9]{2}|20[0-9]{2}) ([0-1]\d|2[0-3])h([0-5]\d)$/,
                    "alertText": "* Temps invalide, format DD/MM/YYYY HHhII requis"
                },
                "date": {
                    // Date in ISO format. Credit: bassistance
                    "regex": /^\d{4}[\/\-]\d{1,2}[\/\-]\d{1,2}$/,
                    "alertText": "* Date invalide, format YYYY-MM-DD requis"
                },
                "ipv4": {
                    "regex": /([1-9][0-9]{0,2})+\.([1-9][0-9]{0,2})+\.([1-9][0-9]{0,2})+\.([1-9][0-9]{0,2})+/,
                    "alertText": "* Adresse IP invalide"
                },
                "url": {
                    "regex": /^((\/([A-z\d\_\-\/#]+)?|(@[A-z\_\-\d]+)|([A-z\_\-\d]+\/[A-z\_\-\d]+)))|((http|https|ftp|ftps):\/\/(([a-z0-9-]+\.)+[a-z]{2,6}|\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3})(:[0-9]+)?(\/?|\/\S+))$/,
                    "alertText": "* URL invalide"
                },
                "url_custom": {
                    "regex": /^(http|https|ftp|ftps):\/\/(([a-z0-9-]+\.)+[a-z]{2,6}|\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3})(:[0-9]+)?(\/?|\/\S+)$/i,
                    "alertText": "* URL invalide"
                },
                "url_symfony": {
                    "regex": /^(\/([A-z\d\_\-\/#]+)?|(@[A-z\_\-\d]+)|([A-z\_\-\d]+\/[A-z\_\-\d]+))$/,
                    "alertText": "* URL invalide"
                },
                "facebook": {
                    "regex": /^http:\/\/www\.facebook\.(fr|com)\/?.*$/,
                    "alertText": "* URL invalide"
                },
                "onlyNumberSp": {
                    "regex": /^[0-9\ ]+$/,
                    "alertText": "* Seules les chiffres sont acceptées"
                },
                "onlyLetterSp": {
                    "regex": /^[a-zA-Z\ \']+$/,
                    "alertText": "* Seules les lettres sont acceptées"
                },
                "onlyLetterNumber": {
                    "regex": /^[0-9a-zA-Z]+$/,
                    "alertText": "* Aucun caractère spécial n'est accepté"
                }
            };
        }
    };
    $.validationEngineLanguage.newLang();
})(jQuery);

