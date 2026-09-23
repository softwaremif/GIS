document.addEventListener("DOMContentLoaded", function () {
    var namaInput = document.getElementById("item1");
    var suggestionsContainer = document.getElementById("suggestions-container1");

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
        suggestionsContainer.innerHTML = ""; // clear first

        var ul = document.createElement("ul");

        suggestions.forEach(function (suggestion) {
            var li = document.createElement("li");
            li.textContent = suggestion.item;

            // Simpan spec di attribute data
            li.dataset.spec = suggestion.spec || "";

            li.addEventListener("click", function () {
                namaInput.value = suggestion.item;
                suggestionsContainer.innerHTML = "";

                // Ambil spec dari data attribute
                const specValue = this.dataset.spec;
                document.getElementById("spec2b").value = specValue;
                console.log("Item klik:", suggestion.item);
                console.log("Spec terisi:", specValue);

                if (specValue.trim() !== "") {
                    $('#spec2b').validatebox({ required: false });
                } else {
                    $('#spec2b').validatebox({ required: true });
                }
            });

            ul.appendChild(li);
        });

        suggestionsContainer.appendChild(ul);

        document.addEventListener("click", function closeOnClickOutside(e) {
            if (!suggestionsContainer.contains(e.target) && e.target !== namaInput) {
                suggestionsContainer.innerHTML = "";
                document.removeEventListener("click", closeOnClickOutside); // supaya tidak double binding
            }
        });
    }
});