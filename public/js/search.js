const searchInput = document.getElementById("search");

search.addEventListener("keyup", getArticleHint);

function getArticleHint(str) {
    
    str = searchInput.value;
    str = str.trim();
    if(str === "") return;

    let xhr = new XMLHttpRequest();
    xhr.responseType = "json";

    xhr.onreadystatechange = () => {
        if (this.readyState === 4 && this.status === 200) {
            
            let articles = this.response;
            let resultContainer = document.getElementById("search-container");
            let html = "";

            articles.map((article)=>{
                let contentHtml = `
                    <div class="search-results">
                        <h5><a href="http://localhost/Paris_MVC_Eval/articles/show/${article.art_id}">${article.title}</a></h5>
                    </div>
                `;

                html.innerHTML += contentHtml;
            });

            resultContainer.innerHTML = html;
        }
    }

    xhr.open("GET", "http://localhost/Paris_MVC_Eval/ajaxs/hintAjax/" + str);
    xhr.send();
}