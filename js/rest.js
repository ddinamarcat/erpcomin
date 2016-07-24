class OnHTTPResponse{
    constructor(){
        this.onSuccess = null;
        this.onServerError = null;
        this.onClientError = null;
    }
    //para definir que se va hacer cuando se reciba un OK como resultado.
    setOnSuccess(func){
        this.onSuccess = func;
    }
    //para definir que se va hacer cuando se reciba un error 5XX.
    setOnServerError(func){
        this.onServerError = func;
    }
    //para definir que se va hacer cuando se reciba un error 4XX.
    setOnClientError(func){
        this.onClientError = func;
    }

}
class Rest{
    // - host: es la direccion del sitio, sin recurso, que contiene el Web
    //         Service en cuestion.
    constructor(host){
        if(host[host.length-1] != '/') this.host = host+"/";
        else this.host = host;
        this.async = true;
    }
    //realiza una llamada asyncrona de los metodos http
    setAsync(){
        this.async = true;
    }
    //realiza una llamada sincronizada de los metodos http, no es recomendado,
    //a menos que se use en un "window.setTimeout(...)".
    setSync(){
        this.async = false;
    }
    //Usa el metodo POST de http sobre un recurso.
    //  - resource: es el recurso al cual se le quiere aplicar el metodo POST.
    //            (Ej: "/cursos" de "http://www.mydomain.com/cursos")
    //  - postdata: es un objeto que contiene la informacion a ser utilizada por
    //            el recurso. Este objeto sera transformado a JSON
    //  - actions: contiene las acciones que se van a llevar a cabo una vez que
    //             se haya haya realizado un metodo HTTP, haya sido exitosa o
    //             no.
    doPost(resource,postdata,actions){
        var onHTTPResponse = actions;
        var xhr = new XMLHttpRequest();

        xhr.open("POST", this.host+resource, this.async);
        xhr.onreadystatechange = function(){
            if(this.readyState == 4){
                if(this.status < 300) onHTTPResponse.onSuccess();
                else if(this.status < 400) window.alert("End of the world");
                else if(this.status < 500) onHTTPResponse.onClientError();
                else if(this.status < 600) onHTTPResponse.onServerError();
            }
        };
        xhr.setRequestHeader("Content-type","application/json");
        xhr.send();
    }
}
