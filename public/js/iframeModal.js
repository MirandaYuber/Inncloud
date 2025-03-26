var IframeModal= (function () {

    var destroy= function() {
        $('[data-toggle="iframeModal"]').each(function(index){
            $("body").off("click", '#'+$(this).attr('id'));
            var modalTarget= $(this).attr('data-modal-target');
            /** Cuando se oculte el iframe descargar el src **/
            $(modalTarget).off('hidden.bs.modal');
            /** Cuando cargue el contenido limpiar cargador html **/
            $(modalTarget).find('.modal-body>iframe').off('load');
        });
    };

    var initialize= function(){
        var index_id= 0;
        $('[data-toggle="iframeModal"]').each(function(index){

            var id= $(this).attr('id');

            if(id === undefined){
                do{
                    index_id++;
                    id= 'link-iframe-modal'+index_id;
                    $(this).attr('id', id);
                }while($('#'+id).legth>0)
            }

            $("body").off("click", '#'+id);
            $("body").on("click", '#'+id, function(event){

                event.preventDefault();
                var modalTarget= $(this).attr('data-modal-target');
                $(modalTarget).find('.modal-body').prepend(
                    '<div class="IframeModalCargador" style="padding-top:2em; text-align: center;">' +
                    '<i class="fa fa-spinner fa-spin fa-3x fa-fw" style="font-size: 16px"></i> Cargando' +
                    '</div>'
                );
                var url= $(this).attr('data-url');
                var title= $(this).attr('data-title');
                $(modalTarget).find('.modal-title').html(title);
                $(modalTarget).find('.modal-body>iframe').prop('src', url);
                $(modalTarget).modal('show');
            });

            var modalTarget= $(this).attr('data-modal-target');
            /** Cuando se oculte el iframe descargar el src **/
            $(modalTarget).off('hidden.bs.modal');
            $(modalTarget).on('hidden.bs.modal', function (e) {
                $(modalTarget).find('.modal-body>iframe').prop('src', '');
            });
            /** Cuando cargue el contenido limpiar cargador html **/
            $(modalTarget).find('.modal-body>iframe').on('load', function (){
                $('iframe').prev('.IframeModalCargador').remove();
            });
            //$(modalTarget).find('.modal-body>iframe').off('load');
            /*$(modalTarget).find('.modal-body>iframe').load(function(){
                $('iframe').prev('.IframeModalCargador').remove();
            });*/
        })

    };

    function construct(){//Funcion que controla cuales son los metodos publicos
        return {
            initialize     : initialize,
            destroy        : destroy,
        }
    };
    return {construct:construct};//retorna los metodos publicos
})().construct();
$(document).ready(function(){
    IframeModal.initialize();
});
