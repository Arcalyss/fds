let img=document.getElementById("serie_image");
img.addEventListener("change", function(event){
    console.log(event.target.value)
let image = event.target.value;
let regex= new RegExp("(.jpg)$|(.png)$"); 
let span = document.getElementById("erreurImage");
let btn = document.getElementById("ajout");
if(!regex.test(image)){
    console.log("L'image doit être au format jpg ou png");
    span.innerHTML="L'image doit être au format jpg ou png";
    btn.disabled=true;
}else{
    console.log("L'image est au format jpg ou png");
    span.innerHTML="";
    btn.disabled=false;
}
});

