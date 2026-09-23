document.addEventListener("DOMContentLoaded", function () {
    var namaInput = document.getElementById("srno");
    var suggestionsContainer = document.getElementById("suggestions-container");

    namaInput.addEventListener("input", function () {
        var inputText = this.value.trim();

        if (inputText !== "") {
            // Ajax request to get suggestions from the server
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    var suggestions = JSON.parse(this.responseText);
                    displaySuggestions(suggestions);
                }
            };

            xhr.open("GET", "view/get_data.php?dt=srno&input=" + inputText, true);
            xhr.send();
        } else {
            // Clear suggestions if input is empty
            suggestionsContainer.innerHTML = "";
        }
    });

    function displaySuggestions(suggestions) {
        var html = "<ul>";
        for (var i = 0; i < suggestions.length; i++) {
            html += "<li onclick='selectSuggestion(\"" + suggestions[i] + "\")'>" + suggestions[i] + "</li>";
        }
        html += "</ul>";

        suggestionsContainer.innerHTML = html;
    }

    window.selectSuggestion = function (value) {
        namaInput.value = value;
        suggestionsContainer.innerHTML = "";
    };
});