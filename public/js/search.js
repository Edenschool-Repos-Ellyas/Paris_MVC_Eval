const searchInput = document.getElementById("search");
let resultContainer = document.getElementById("search-container");

searchInput.addEventListener("keyup", getArticleHint);
searchInput.parentNode.addEventListener("submit", (e)=>{e.preventDefault() });

function getArticleHint(str) {
    // console.log(this);
    
    
    str = searchInput.value;
    str = str.trim();
    if(str === "") {
        resultContainer.innerHTML = "";
        return;
    };
    // console.log(str);

    let xhr = new XMLHttpRequest();
    xhr.responseType = "json";

    xhr.onreadystatechange = function() {

        if(this.readyState != 4){
            // pendant le chargement
            
            resultContainer.innerHTML = "<img src='http://localhost/Paris_MVC_Eval/public/img/img_site/ajax-loader.gif' alt='ajax-loader' class='ajax-loader'>";
            console.log(resultContainer.innerHTML);

        }else if (this.readyState == 4 && this.status == 200) {
            
            let articles = this.response;
            let html = "";

            articles.map((article)=>{
                // console.log(article);
                
                let contentHtml = `
                    <div class="search-results">
                        <h5><a href="http://localhost/Paris_MVC_Eval/articles/show/${article.art_id}">${article.title}</a></h5>
                    </div>
                `;

                
                html += contentHtml;
                // console.log(html);
            });

            resultContainer.innerHTML = html;


        }
    }

    xhr.open("GET", "http://localhost/Paris_MVC_Eval/ajaxs/hintAjax/" + str, true);
    xhr.send();
}

// bidule
