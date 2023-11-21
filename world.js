document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("lookup").addEventListener("click", function () {
        lookup("country");
    });

    document.getElementById("clookup").addEventListener("click", function () {
        lookup("cities");
    });

    function lookup(type) {
        var countryInput = encodeURIComponent(document.getElementById("country").value);
        var url = "world.php?country=" + countryInput + "&lookup=" + type;

        var xhr = new XMLHttpRequest();
        xhr.open("GET", url, true);

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                document.getElementById("result").innerHTML = xhr.responseText;
            }
        };

        xhr.send();
    }
});
