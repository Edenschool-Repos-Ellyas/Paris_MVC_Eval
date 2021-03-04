let more = document.querySelectorAll(".more");
let more_link = document.querySelectorAll(".more-link");


// creer une fonction d'affichage de la NAV

function dropDownNav(btnNav, linksContainer) {
    btnNav.addEventListener("click", ()=>{
        linksContainer.classList.toggle("hide");
        console.log(linksContainer);
    });
}

for (let i = 0; i < more.length; i++) {
    dropDownNav(more[i], more_link[i]);
}


