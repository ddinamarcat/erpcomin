var ola = null;
var calendarioManager = {
    mes : ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],
    dia : ["Lunes","Martes","Mi\u00e9rcoles","Jueves","Viernes","S\u00e1bado","Domingo"],
    calendario : null,
    diaSeleccionado : null,
    mueveCalendario : function(){
        var pos = 0;
        if(window.scrollY<201) pos = 271-window.scrollY;
        else pos = 80;
        var cal = calendarioManager.calendario;
        if(cal != null) cal.style="top:"+pos+"px;height:0px;";
    },
    //retorna el numero de dia de la semana de la fecha pasada como parametro,
    //donde 0 corresponde a lunes y 7 a domingo
    getNumDia : function(fecha){
        var ndia = fecha.getDay();
        if(ndia == 0) ndia = 7;
        return ndia-1;
    },
    //retorna un string con el nombre completo del dia de la fecha pasada como parametro
    getNombreDia : function(fecha){
        return calendarioManager.dia[calendarioManager.getNumDia(fecha)];
    },
    //retorna un string con el nombre completo del dia de la fecha pasada como parametro
    getNombreDiaCorto : function(fecha){
        return calendarioManager.dia[calendarioManager.getNumDia(fecha)].substr(0,2);
    },
    //retorna un string con el nombre completo del mes de la fecha pasada como parametro
    getNombreMes : function(fecha){
        return calendarioManager.mes[fecha.getMonth()];
    },
    //genera la vista del calendario en el nodo que apunta calendarioManager.calendario
    generarCalendario : function(dia){
        var cm = calendarioManager;
        var cal = cm.calendario;
        while(cal.firstChild) cal.removeChild(cal.firstChild);
        cal.appendChild(document.createElement("div"));
        cal.children[0].appendChild(document.createElement("article"));
        cal = cal.children[0].children[0];
        cal.classList.add("calendario");
        //section header
        cal.appendChild(document.createElement("div"));
        cal.children[0].appendChild(document.createElement("h2"));
        var hc = cal.children[0].children[0];
        hc.innerHTML = cm.getNombreMes(dia)+" - "+dia.getFullYear();
        //section dias
        //aqui se agregan los nombres de los dias de la semana
        var sem = document.createElement("div");
        cal.appendChild(sem);
        var sdias = document.createElement("div")
        var i = 0;
        var nds = null;
        for(i=0; i<7; i++){
            nds = document.createElement("div");
            nds.appendChild(document.createElement("p"));
            nds.children[0].innerHTML = cm.dia[i].substr(0,2);
            sem.appendChild(nds);
        }
        cal.appendChild(sdias);
        var prim = new Date(new Date().toDateString());
        var diasprev = 0; //dias del mes anterior para rellenar la primera fila
        prim.setDate(1);
        //cuenta los dias del mes anterior para rellenar
        while(cm.getNumDia(prim) != 0){
            prim.setDate(prim.getDate()-1);
            ++diasprev;
        }
        //ahora se agregan los div correspondientes a los dias y se puede
        //agregar la opcion de cambiar el estilo
        var cdia = null;
        while(diasprev != 0){
            sdias.appendChild(cm.crearVistaDia(prim,"mes-pre"));
            prim.setDate(prim.getDate()+1);
            --diasprev;
        }
        //ahora se agregan los dias del mes correspondiente
        do{
            if(dia.getDate() == prim.getDate()){
                cdia = cm.crearVistaDia(prim,"dia-seleccionado");
                sdias.appendChild(cdia);
                cm.diaSeleccionado = cdia;
            }else sdias.appendChild(cm.crearVistaDia(prim,""));
            prim.setDate(prim.getDate()+1);
        }while(prim.getDate() != 1)
        //ahora se agregan los dias de relleno del mes siguiente
        while(cm.getNumDia(prim) != 0){
            sdias.appendChild(cm.crearVistaDia(prim,"mes-sig"));
            prim.setDate(prim.getDate()+1);
        }
    },
    crearVistaDia : function(prim,className){
        var cdia = document.createElement("div");
        //cdia.setAttributeNode(attr);
        cdia.attributes.dia = new Date(prim);
        if(className != "")cdia.classList.add(className);
        cdia.appendChild(document.createElement("p"));
        cdia.children[0].innerHTML = prim.getDate();
        return cdia;
    },

    setOnClickListeners : function(){
        var cal = calendarioManager.calendario.children[0].children[0].children[2];
        var l = cal.children.length;
        var i = 0;
        var primero = cal.children[0].attributes.dia;
        var ultimo = cal.children[l-1].attributes.dia;
        for(i=0; i<l; i++){
            cal.children[i].addEventListener("click",function(){
                var cm = calendarioManager;
                cm.generarEventosDelDia(this);
                cm.diaSeleccionado.classList.remove("dia-seleccionado");
                cm.diaSeleccionado = this;
                cm.diaSeleccionado.classList.add("dia-seleccionado");
                //cambia titulo
                var titulo = eventosManager.diaEventos.parentElement.children[0].children[0];
                titulo.innerHTML = "Eventos del d&iacute;a "+cm.generarStringFecha(this.attributes.dia);

            });
        }
    },
    generarStringFecha : function(dia){
        var cm = calendarioManager;
        return cm.getNombreDia(dia)+" "+dia.getDate()+" de "+cm.getNombreMes(dia)+" de "+dia.getFullYear();
    },
    //generar los eventos del dia seleccionado, representado por 'dia'
    generarEventosDelDia : function(divdia){
        eventosManager.generarListaDeEventosDelDia(divdia);
        var contEv = eventosManager.diaEventos.parentElement;
        if(contEv.classList.contains("hidden") == true) contEv.classList.remove("hidden");
    },
    inicializar : function(id){
        calendarioManager.calendario = document.getElementById(id);
        calendarioManager.generarCalendario(new Date());
        calendarioManager.setOnClickListeners();
    }

};
