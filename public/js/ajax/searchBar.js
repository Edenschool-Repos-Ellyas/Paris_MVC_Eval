let searchInput = document.getElementById("search");
// let searchInput = document.getElementById("searchContainer");

searchInput.addEventListener("keyup", getArticleHint);

function getArticleHint(str) {
    
    str = searchInput.value;
    str = str.trim();
    if(str === '') return;

    let xhr = new XMLHttpRequest();
    xhr.responseType = "text";
    xhr.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200){
            // ici c'est quand je recup les donnée de ma requete
            
            // let html = "";
            // let animes = this.response;
            // animes.forEach(anime => {
                
            //     let a = `<a href="?page=home_page&anime=${anime.anime_id}">${anime.anime_name.trim().length < 20 ? anime.anime_name.trim() : anime.anime_name.substring(0, 20) + "[...]"}</a>`;
            //     html += a;
            // });
            let ok = this.responseText;
            console.log(ok);
            // // html = html.slice(0, -3)
            // animeContainerHint.innerHTML = html;
        }
    }

    // xhr.open("GET", "./app/ajax/searchBar.php&q=" + str);
    xhr.open("POST", "./searchBar.php&q=" + str);
    xhr.send();
}
