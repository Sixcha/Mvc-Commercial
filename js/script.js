"use strict"

if (document.querySelector("#search") !== null){
    let searchbar = document.querySelector("#search")


searchbar.addEventListener("keyup",() => {
    
    let searched = document.querySelector("#search").value;
    
    let data = { sendSearched : searched };
    
    data = JSON.stringify(data);
    
    let options = {
        method: 'POST',
        body :  data
    }
    
    let send = new Request("models/searchArticles.php", options);
    
    fetch(send)
        
        .then(dat => dat.text())
        
        .then(dat => {
            document.getElementById("articles").innerHTML = dat
        })
    
})

}