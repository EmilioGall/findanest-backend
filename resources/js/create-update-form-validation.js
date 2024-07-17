document.addEventListener("DOMContentLoaded", function () {
    // Validation
    document
        .getElementById("houseForm")
        .addEventListener("submit", function (event) {
            let isValid = true;
            const errors = {};

            // Remove existing errors
            document
                .querySelectorAll(".invalid-feedback")
                .forEach((element) => {
                    element.textContent = "";
                    element.previousElementSibling.classList.remove(
                        "is-invalid"
                    );
                });

            //validation field title
            const title = document.getElementById("title").value;
            if (title && title.length < 3) {
                isValid = false;
                errors.title = "Il titolo deve essere lungo almeno 3 caratteri.";
            }

            //validation field address
            const address = document.getElementById("address").value;
            if (address && address.length < 3) {
                isValid = false;
                errors.address = "L'indirizzo deve essere lungo almeno 3 caratteri.";
            }

            //validation field rooms
            const rooms = document.getElementById("rooms").value;
            if (rooms && rooms <= 1 || rooms > 99) {
                isValid = false;
                errors.rooms = "Il numero di stanze deve essere compreso tra 1 e 99";
            }

            //validation field bathrooms
            const bathrooms = document.getElementById("bathrooms").value;
            if (bathrooms && bathrooms < 0 || bathrooms > 99) {
                isValid = false;
                errors.bathrooms = "Il numero di bagni deve essere compreso tra 1 e 99";
            }

            //validation field beds
            const beds = document.getElementById("beds").value;
            if (beds && beds <= 1 || beds > 99) {
                isValid = false;
                errors.beds = "Il numero di letti deve essere compreso tra 1 e 99";
            }

            //validation field sqm
            const sqm = document.getElementById("sqm").value;
            if (sqm && sqm <= 1) {
                isValid = false;
                errors.sqm = "La dimensione della casa non può essere inferiore a 1 mq";
            }

            // validation field price
            const price = document.getElementById("price").value;
            if (price && price <= 0) {
                isValid = false;
                errors.price = "Il prezzo non può essere inferiore o uguale a 0";
            }

            if (!isValid) {
                event.preventDefault();

                // Show errors
                Object.keys(errors).forEach((key) => {
                    const errorElement = document.getElementById(`${key}Error`);
                    if (errorElement) {
                        errorElement.textContent = errors[key];
                        document
                            .getElementById(key)
                            .classList.add("is-invalid");
                    }
                });
            }
        });
});
