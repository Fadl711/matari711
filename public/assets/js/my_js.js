function disSection()
    {
var mc=document.getElementById("form1");
var mc2=document.getElementById("form2");
    if(mc.style.display=="none"){

    mc.style.display="block";
    if(mc2.style.display=="block"){
        mc2.style.display="none";

    }
}

else if(mc.style.display=="block"){
    mc.style.display="none";
}
}


    function disSection1()
    {
var mc=document.getElementById("form1");
var mc2=document.getElementById("form2");
    if(mc2.style.display=="none"){
        mc2.style.display="block";
        if(mc.style.display=="block"){
            mc.style.display="none";
}

}else mc2.style.display="none";
}


// ______________________________________________________-

function dis1()
    {

var mc=document.getElementById("fileVid");
var mc2=document.getElementById("link");
    if(mc.style.display=="none"){

    mc.style.display="block";
    if(mc2.style.display=="block"){
        mc2.style.display="none";

    }
}

else if(mc.style.display=="block"){
    mc.style.display="none";
}
}


    function dis2()
    {
var mc=document.getElementById("fileVid");
var mc2=document.getElementById("link");
    if(mc2.style.display=="none"){
        mc2.style.display="block";
        if(mc.style.display=="block"){
            mc.style.display="none";
}

}else mc2.style.display="none";
}
