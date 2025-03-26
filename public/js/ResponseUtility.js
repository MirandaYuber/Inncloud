var ResponseUtility= (function () {

    var processFaillRequest= function(jqXHR, textStatus, errorThrown){

        if (jqXHR.status== 419)
            parent.location.reload();
        else if(jqXHR.status==422)
            alert(_.pluck(jqXHR.responseJSON.errors, '0').join("\n"));
        else if(jqXHR.status==500)
            alert("Error de conexion con el servidor.\nRevise su conexion a internet.");
        else if(jqXHR.status==403)
            alert('Acceso denegado.');
        else if(jqXHR.status==401)
            alert('Usuario sin autorización. Revise que la sesión no haya finalizado.');
        else
            alert("No se han podido cargar los datos. Intente mas tarde.--" + textStatus);

    };

    var processFailFetchRequest= function(response){
        if (response.abort)
            parent.location.reload();
        else if('errors' in  response)
            Swal.fire({
                icon: 'error',
                title: 'Error',
                html:  "<ul class='text-justify'><li>"+ _.pluck(response.errors, '0').join("</li><li>") + "</li></ul>",
                confirmButtonText:'Aceptar',
            })
        else if (response.code === 422)
            Swal.fire({
                icon: 'error',
                title: 'Error',
                html:  "<ul class='text-justify'><li>"+response.message+"</li><ul>",
                confirmButtonText:'Aceptar',
            })
        else if (response.code === 401)
            Swal.fire({
                icon: 'error',
                title: 'Error',
                html:  "<ul class='text-justify'><li>"+response.message+"</li><ul>",
                confirmButtonText:'Aceptar',
            })
        else
            alert("No se han podido cargar los datos. Intente mas tarde.--");
    };

    var add_csrfToken= function(data){
        data.push({
            name: "_token",
            value: window.Laravel.csrfToken
        });
        return data;
    }

    function construct(){//Funcion que controla cuales son los metodos publicos
        return {
            processFaillRequest    : processFaillRequest,
            processFailFetchRequest: processFailFetchRequest,
            add_csrfToken          : add_csrfToken
        }
    }
    return {construct:construct};//retorna los metodos publicos
})().construct();
