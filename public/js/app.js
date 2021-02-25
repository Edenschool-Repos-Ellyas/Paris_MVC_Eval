let more = document.querySelector(".more");
let more_link = document.querySelector(".more-link");

more.addEventListener("click", ()=>{
    more_link.classList.toggle("show");
    more_link.classList.toggle("hide");
    console.log(more_link);
});
console.log(more);