var modalManager = {
    showModal : function(){
        var mw = document.getElementById("modal-section");
        mw.classList.remove("hidden");
        mw.classList.remove("fadeout-modal");
        window.setTimeout(function(){
            mw.classList.add("fadein-modal");
        },10);
    },
    hideModal : function(){
        var mw = document.getElementById("modal-section");
        mw.classList.remove("fadein-modal");
        mw.classList.add("fadeout-modal");
        window.setTimeout(function(){
            mw.classList.add("hidden");
        },400);
    }
};
