document.getElementById("fav").addEventListener("click", function() {
    var status = document.getElementById("fav").className;

    if (status.includes("selected")) {
        document.getElementById("fav").classList.remove("selected");
    } else {
        document.getElementById("fav").classList.add("selected");
        document.getElementById("favoriteForm").submit();
    }
})