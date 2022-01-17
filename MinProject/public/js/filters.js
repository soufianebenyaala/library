window.onload = () => {
    const FiltersForm = document.querySelector("#filters")

    //On Boucle sur les input
    document.querySelectorAll("#filters input").forEach(input => {
        input.addEventListener("change",() => {
            // Ici on intercepte les clics
            // On recupere les donnee du formulaire
            const From = new FormData(FiltersForm)

            // On fabrique l'url
            const Params = new URLSearchParams();

            From.forEach((value,key) => {
                Params.append(key,value);
            });

            // Pn recupere l'url active
            const url = new URL(window.location.href) 

            // On lance la requete ajax
            fetch(url.pathname + "?" + Params.toString() + "&ajax=1",{
                headers:{
                    "X-Requested-with" : "XMLHttpRequest"
                }
            }).then(response => {
                console.log(response);
            }).catch(e => alert(e))
        })
    })
}
