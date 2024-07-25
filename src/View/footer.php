<script>
    let htmlElement = document.querySelector("html");
    let themeBtn = document.getElementById("themeBtn");
    let theme = window.localStorage.getItem("data-theme");

    if(theme) {
        htmlElement.setAttribute("data-theme", theme);
        themeBtn.checked = theme == "dark";
    }




    themeBtn.addEventListener("change",function(e){
        if(e.target.checked) {
            localStorage.setItem("data-theme", "dark");
            htmlElement.setAttribute("data-theme", "dark");
        }else {
            localStorage.setItem("data-theme", "light");
            htmlElement.setAttribute("data-theme", "light");
        }
    })


</script>
</body>
</html>
