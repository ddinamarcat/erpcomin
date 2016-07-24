var noticiasManager = {
    noticias : null,
    noticiasDestacadas : null,
    noticiasPrincipal: null,
    noticiaActual : null,
    noticiasHome : [],
    maxNoticias: null,
    lockNoticia: 0,

    generarListaNoticiasHome : function(){
        var cont = 0;
        var l = noticias.length;
        var max = 3;
        this.maxNoticias = max;
        var lista = this.noticiasPrincipal;
        for(var i = 0; i<l; i++){
            if(noticias[i].destacado == 1){
                this.noticiasHome.push(noticias[i]);
                cont++;
            }
            if(cont == max) break;
        }
    },

    iniciarCambioDeNoticiasAutomatico : function(){
        var nt = noticiasManager;
        this.noticiaActual = 0;
        while(this.noticiasPrincipal.firstElementChild) this.noticiasPrincipal.remove(this.noticiasPrincipal.firstElementChild);
        noticiasManager.cambioDeNoticiasAutomatico();

    },
    cambioDeNoticiasAutomatico: function(){
        if(noticiasManager.lockNoticia > 0) return;
        var lp = this.noticiasPrincipal;
        if(lp.firstElementChild){
            lp.firstElementChild.classList.remove("mostrar");
            lp.firstElementChild.classList.add("oculto");
            this.noticiaActual = (this.noticiaActual+1)%this.maxNoticias;
            lp.appendChild(this.generarNoticiaHome(this.noticiasHome[this.noticiaActual]));
            window.setTimeout(function(){
                lp.removeChild(lp.firstElementChild);
                lp.firstElementChild.classList.remove("oculto");
                lp.firstElementChild.classList.add("mostrar");

            },100);
        }
        else{
            lp.appendChild(this.generarNoticiaHome(this.noticiasHome[this.noticiaActual]));
            lp.firstElementChild.classList.remove("oculto");
            lp.firstElementChild.classList.add("mostrar");
        }

        window.setTimeout(function(){
            noticiasManager.cambioDeNoticiasAutomatico();

        },6000);

    },
    cambioDeNoticiaManual : function(){
        this.lockNoticia += 1;
        var lp = noticiasManager.noticiasPrincipal;
        var actualT = lp.firstElementChild;
        if(actualT.classList.contains("mostrar"))actualT.classList.remove("mostrar");
        if(!actualT.classList.contains("oculto"))actualT.classList.add("oculto");

        this.noticiaActual = (this.noticiaActual+1)%this.maxNoticias;

        var proxT = this.generarNoticiaHome(this.noticiasHome[this.noticiaActual]);
        lp.appendChild(proxT);
        window.setTimeout(function(){
            lp.removeChild(lp.firstElementChild);
            if(lp.firstElementChild.classList.contains("oculto"))lp.firstElementChild.classList.remove("oculto");
            if(!lp.firstElementChild.classList.contains("mostrar"))lp.firstElementChild.classList.add("mostrar");

        },100);
        window.setTimeout(function(){
            noticiasManager.lockNoticia -= 1;
            noticiasManager.cambioDeNoticiasAutomatico();

        },6000);
    },

    generarLista: function(){
        var l = noticias.length;
        var i = 0;
        var noti = this.noticias;
        var notid = this.noticiasDestacadas;
        while(noti.firstChild) noti.removeChild(noti.firstChild);
        while(notid.firstChild) notid.removeChild(notid.firstChild);
        for(i = 0; i < l; i++){
            this.noticias.appendChild(this.generarNoticia(noticias[i]));
            if(noticias[i].destacado == 1){
                notid.appendChild(this.generarNoticiaDestacada(noticias[i]));
            }
        }
    },

    generarNoticiaDestacada : function(nt){
        var noti = document.createElement("li");
        var header = document.createElement("div");
        noti.appendChild(header);

        var titulo = document.createElement("h3");
        var tit = null;
        if(nt.titulo.length > 31) tit = nt.titulo.substr(0,31)+"...";
        else tit = nt.titulo;
        titulo.innerHTML = tit;
        header.appendChild(titulo);

        var fechaSpan = document.createElement("span");
        var fecha = new Date(nt.fechaPublicacion.replace(/-/g,"/"));
        fechaSpan.innerHTML = "("+calendarioManager.generarStringFecha(fecha)+")";
        header.appendChild(fechaSpan);

        var descripcion = document.createElement("p");
        var desc = null;
        if(nt.descripcion.length > 160) desc = nt.descripcion.substr(0,160)+"...";
        else desc = nt.descripcion;
        descripcion.innerHTML = desc;
        noti.appendChild(descripcion);
        return noti;
    },

    generarNoticia : function(nt){
        var noti = document.createElement("li");
        var divImagen = document.createElement("div");

        noti.appendChild(divImagen);
        var imag = document.createElement("img");
        imag.src = nt.urlThumbnail;

        divImagen.appendChild(imag);

        var divContenido = document.createElement("div");
        noti.appendChild(divContenido);

        var titulo = document.createElement("h3");
        titulo.innerHTML = nt.titulo;
        divContenido.appendChild(titulo);

        var descrip = document.createElement("p");
        var desc = null;
        if(nt.descripcion.length > 170) desc = nt.descripcion.substr(0,170)+"...";
        else desc = nt.descripcion;
        descrip.innerHTML = desc;
        divContenido.appendChild(descrip);

        var fechaParrafo = document.createElement("p");
        var fecha = new Date(nt.fechaPublicacion.replace(/-/g,"/"));
        fechaParrafo.innerHTML = "("+calendarioManager.generarStringFecha(fecha)+")";
        divContenido.appendChild(fechaParrafo);

        var publicaParrafo = document.createElement("p");
        publicaParrafo.innerHTML = "Publicado por: ";
        var autor = document.createElement("span");
        autor.innerHTML = nt.idUsuario;
        publicaParrafo.appendChild(autor);
        divContenido.appendChild(publicaParrafo);

        return noti;

    },

    generarNoticiaHome: function(nt){
        var noti = document.createElement("article");
        noti.classList.add("oculto");
        var spanImg = document.createElement("span");
        spanImg.classList.add("small-box");
        spanImg.classList.add("imagen-patron");
        noti.appendChild(spanImg);
        var foto = document.createElement("img");
        foto.src = nt.urlImagenHome;
        spanImg.appendChild(foto);
        spanImg.appendChild(document.createElement("div"));
        var titulo = document.createElement("h3");
        titulo.innerHTML = nt.titulo;
        if(nt.titulo.length > 36) titulo.innerHTML = nt.titulo.substr(0,36)+"...";
        noti.appendChild(titulo);
        var divParrafo = document.createElement("div");
        noti.appendChild(divParrafo);
        var descrip = document.createElement("p");
        descrip.innerHTML = nt.descripcion;
        if(nt.descripcion.length > 260) descrip.innerHTML = nt.descripcion.substr(0,260)+"...";
        divParrafo.appendChild(descrip);
        var fecha = document.createElement("span");
        fecha.innerHTML = calendarioManager.generarStringFecha(new Date(nt.fechaPublicacion.replace(/-/g,"/")));
        noti.appendChild(fecha);

        return noti;
    },

    inicializar : function(){
        noticiasManager.noticias = document.getElementById("lista-noticias");
        noticiasManager.noticiasDestacadas = document.getElementById("noticias-destacadas");
        noticiasManager.generarLista();
    },

    inicializarNoticiasPrincipal : function(){
        noticiasManager.noticiasPrincipal = document.getElementById("noticias-principal");
        noticiasManager.generarListaNoticiasHome();
        noticiasManager.iniciarCambioDeNoticiasAutomatico();
    }

}
