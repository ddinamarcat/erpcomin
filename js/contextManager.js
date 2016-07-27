var contextManager = {
    defaultContext : "c-principal", //the node that will contain the context info
    defaultContextMark : 0,
    actualClass : "actual",
    noActualClass : "no-actual",
    cont : undefined, //the node that will contain the context info
    actual : " ", //actual context
    actualMenuElement : null,
    lock : false,
    animationTime : 400,
    activatedClassName : "c-activado", //used to apply a css animation to the incoming context
    deactivatedClassName : "c-desactivado", //used to apply a css animation to the context going out
    mMenu : null,
    noMenuElements : null,
    mMenuIndex : {},
    changeMark : function(contextId,mark){
        var cm = contextManager;
        if(mark == 0){
            if(cm.actualMenuElement != null){
                    cm.actualMenuElement.classList.remove(cm.actualClass);
                    cm.actualMenuElement.classList.add(cm.noActualClass);
            }
        }
        else{
            if(cm.actualMenuElement != null){
                    cm.actualMenuElement.classList.remove(cm.actualClass);
                    cm.actualMenuElement.classList.add(cm.noActualClass);
            }
            var temp = document.getElementById(contextId);
            temp.classList.remove(cm.noActualClass);
            temp.classList.add(cm.actualClass);
            cm.actualMenuElement = temp;
        }
    },
    setIds : function(){
        var cMenu = contextManager.mMenu;
        var tElems = cMenu.length;
        for(var i=0; i<tElems; i++) cMenu[i].id = ""+cMenu[i].attributes.templateid.value;
    },
    setMainMenuElements : function(){
        contextManager.mMenu = document.getElementsByClassName("main-menu-element");
    },
    setOnClickListeners : function(eList){
        var cm = contextManager;
        var tElems = eList.length;
        var alink = null;
        var el = null;
        for(var i=0; i<tElems; i++){
            var el = eList[i];
            if(el.nodeName.toLowerCase() == "a"){
                el.href = "#"+el.attributes.templateId.value;
            }
            else{
                alink = el.querySelector("a");
                if(alink != null){
                    alink.href = "#"+el.attributes.templateId.value;
                }
                el.addEventListener("click",function(){
                        contextManager.changeHash(this.attributes.templateId.value,this.attributes.mark.value);}
                    );
            }

        }
    },
    setNoMenuElements : function(){
        contextManager.noMenuElements = document.getElementsByClassName("context-changer");
    },
    updateNoMenuElements : function(){
        var cm = contextManager;
        cm.setNoMenuElements();
        cm.setOnClickListeners(cm.noMenuElements);
    },
    changeContext : function(contextId,mark){
        var cm=contextManager, c=cm.cont, ccl=c.classList, acn=cm.activatedClassName, dcn=cm.deactivatedClassName;
        var tcId = "t"+contextId;
        if(cm.lock == true) return false;
        cm.changeMark(contextId,mark);
        ccl.remove(acn);
        ccl.add(dcn);
        cm.lock = true;
        window.setTimeout(function(){
            while (c.firstChild) c.removeChild(c.firstChild);
            var contexto = document.getElementById(tcId).content;
            cm.actual = tcId;
            c.appendChild(document.importNode(contexto,true));
            ccl.remove(dcn);
            ccl.add(acn);
            cm.lock = false;
            cm.updateNoMenuElements();
        },cm.animationTime);
        return true;
    },
    changeHash : function(contextId,mark){
        var hashL = window.location.hash;
        var cm = contextManager;
        if(((hashL.substring(1) != contextId) && (cm.lock == false))||(cm.cont.children.length == 0)){
            history.pushState(null,"","#"+contextId);
            cm.changeContext(contextId,mark);
            return true;
        }
        return false;
    },
    start : function(idContenido){
        var cm = contextManager;
        cm.setMainMenuElements();
        cm.setIds();
        cm.setOnClickListeners(cm.mMenu);
        cm.cont = document.getElementById(idContenido);
        var hashL = window.location.hash;
        var newHashL = cm.defaultContext;
        if(hashL.length > 0) newHashL = hashL.substring(1);
        cm.changeHash(newHashL,1);
        window.onhashchange = function(){
            var hashL = window.location.hash;
            if(hashL.length > 0 && newHashL!=window.location.hash) cm.changeContext(hashL.substring(1),1);
        }
    }
};
