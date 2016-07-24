function cambiarAcercaDe(el){
    var tid = el.attributes.templateId.value;
    var temp = document.getElementById(tid);
    var cont = document.getElementById("contenido-ad");
    cont.classList.remove("anim-in");
    cont.classList.add("anim-out");
    window.setTimeout(function(){
        while (cont.firstChild) cont.removeChild(cont.firstChild);
        var contexto = temp.content;
        cont.appendChild(document.importNode(contexto,true));
        cont.classList.remove("anim-out");
        cont.classList.add("anim-in");
    },400);


}
