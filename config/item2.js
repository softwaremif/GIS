document.addEventListener("DOMContentLoaded", function () {
    var namaInput = document.getElementById("item");
    var suggestionsContainer = document.getElementById("suggestions-container");

    namaInput.addEventListener("input", function () {
        var inputText = this.value.trim();

        if (inputText !== "") {
            // Ajax request to get suggestions from the server
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (this.responseText.trim() !== "") {
                    try {
                        var suggestions = JSON.parse(this.responseText);
                        displaySuggestions(suggestions);
                    } catch (e) {
                        console.error("Gagal parse JSON:", e);
                        console.log("Respon mentah:", this.responseText);
                    }
                } else {
                    console.warn("Respon kosong dari server");
                    suggestionsContainer.innerHTML = "";
                }
            };

            xhr.open("GET", "view/get_data.php?dt=item&input=" + inputText, true);
            xhr.send();
        } else {
            // Clear suggestions if input is empty
            suggestionsContainer.innerHTML = "";
        }
    });


    function displaySuggestions(suggestions) {
    suggestionsContainer.innerHTML = ""; // clear list

    var ul = document.createElement("ul");

    suggestions.forEach(function (suggestion) {
        var li = document.createElement("li");
        li.textContent = suggestion.item;

        // simpan spec di data attribute
        li.dataset.spec = suggestion.spec || "";

        li.addEventListener("click", function () {
            namaInput.value = suggestion.item;
            suggestionsContainer.innerHTML = "";

            // ambil spec dari data attribute
            const specValue = this.dataset.spec || "";
            document.getElementById("spec2").value = specValue;

            console.log("Item klik:", suggestion.item);
            console.log("Spec terisi:", specValue);

            if (specValue.trim() !== "") {
                $('#spec2').validatebox({ required: false });
            } else {
                $('#spec2').validatebox({ required: true });
            }
        });

        ul.appendChild(li);
    });

    suggestionsContainer.appendChild(ul);
}
});