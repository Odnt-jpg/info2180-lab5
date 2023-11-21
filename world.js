document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("lookup").addEventListener("click", function () {
        var countryInput = encodeURIComponent(document.getElementById("country").value);
        var url = "world.php?country=" + countryInput;

        var xhr = new XMLHttpRequest();
        xhr.open("GET", url, true);

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                document.getElementById("result").innerHTML = xhr.responseText;
                console.log (xhr.responseText)
            }
        };

        xhr.send();
    });
});
