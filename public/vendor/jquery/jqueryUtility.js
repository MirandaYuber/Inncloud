//Convierte a primer letra en mayuscula el resto en minuscula
String.prototype.capitalizeFirstLetter = function() {
    return this.charAt(0).toUpperCase() + this.slice(1);
}
//El :contains de Jquery diferencia entre minusculas y mayusculas, esta sección crea :icontains que no hace distinción.
jQuery.expr[':'].icontains = function(a, i, m) {
    return jQuery(a).text().toUpperCase()
        .indexOf(m[3].toUpperCase()) >= 0;
};

$.fn.sumValues = function() {
    var sum = 0;
    this.each(function() {
        if ( $(this).is(':input') ) {
            var val = $(this).val();
        } else {
            var val = $(this).text();
        }
        sum += parseFloat( ('0' + val).replace(/[^0-9-\.]/g, ''), 10 );
    });
    return accounting.formatNumber(sum,2);
};

$.fn.loading = function(label) {
    if(label==undefined)label='';
    this.each(function(index, element) {
        /* Examina si es un contenedor, en ese caso busca todos los submit dentro del mismo para ponerlos a cargar*/
        if($(element).is("div") || $(element).is("form")){
            elementsToLoading= $(element).find('[type="submit"], .submit');
        }else{
            elementsToLoading= [element];
        }
        /* Agrega la animación de cargador a cada elemento */
        $.each(elementsToLoading, function(index2, elementToLoading){
            $(elementToLoading).unloading();
            $(elementToLoading).prop('disabled', true);
            $(elementToLoading).prop('readonly', true);
            $(elementToLoading).prepend(
                '<span class="__loading__"><i class="fa fa-spinner fa-spin fa-3x fa-fw" style="font-size: 16px"></i>'+
                '<span>'+label+'</span></span>'
            );
        });
    });
};

$.fn.unloading = function() {
    this.each(function(index, element) {
        /* Examina si es un contenedor, en ese caso busca todos los submit dentro del mismo para removerles cargador*/
        if($(element).is("div") || $(element).is("form")){
            elementsToUnloading= $(element).find('[type="submit"], .submit');
        }else{
            elementsToUnloading= [element];
        }
        /* Retira la animación de cargador a cada elemento */
        $.each(elementsToUnloading, function(index2, elementToLoading){
            $(elementToLoading).find('.__loading__').remove();
            $(elementToLoading).prop('disabled', false);
            $(elementToLoading).prop('readonly', false);
        });
    });
};

$.fn.disabled = function() {
    this.each(function(index, element) {
        $(element).find('*').prop('disabled', true);
        $(element).prop('disabled', true);
    });
};

$.fn.enabled= function() {
    this.each(function(index, element) {
        $(element).find('*').prop('disabled', false);
        $(element).prop('disabled', false);
    });
};

$.fn.renderTpl= function(data) {
    var tpl= '';
    this.each(function(index, element) {
        var template= _.template($(this).html());
        tpl+= template(data);
    });
    return tpl;
};

$.fn.select2AddTag= function(data) {
    this.each(function(index, element) {
        $.each(data, function(indexItem, item){
            $(element).append('<option selected>'+item+'</option>');
        });
    });
};

$.fn.submitWithValidator= function(callback) {
    this.each(function(index, element) {
        $(element).validator().on('submit', function (event) {
            if (event.isDefaultPrevented()){
                event.preventDefault();
                return false;
            }
            event.preventDefault();
            callback(event, $(element));
        });

    });
};


$.fn.serializeObject= function() {
    var data = {};
    this.each(function(index, form) {
        var formdata = $(form).serializeArray();
        $(formdata ).each(function(index, obj){
            data[obj.name] = obj.value;
        });
    });
    return data;
};



$.fn.sum = function(key) {
    var sum = 0;
    return _.reduce(this, function(memo, num){
        if(key === undefined){
            return memo + num*1;
        }
        else{
            return memo + num[key]*1;
        }
    }, 0);
};
