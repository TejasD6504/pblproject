let signin = document.querySelector("#signin");
let forform = document.querySelector("#forform");
let login = document.querySelector("#mainbtn");
let forform2 = document.querySelector("#forform2");
let forform1 = document.querySelector("#forform1");
let signinlogin = document.querySelector("#signinlogin");


function hide(){
signin.addEventListener("click",function(){
    forform1.style.display = "none";
    forform2.style.display="flex";  
});
}

hide();

function New(){
    signinlogin.addEventListener("click",function(){
        forform1.style.display = "flex";
        forform2.style.display="none";  
    });
    }

New();