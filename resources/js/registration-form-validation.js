document.addEventListener("DOMContentLoaded", function () {
    // Validation
    document
        .getElementById("registrationForm")
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

            // Optional fields validation
            const name = document.getElementById("name").value;
            if (name && name.length < 3) {
                isValid = false;
                errors.name = "Il nome deve essere lungo almeno 3 caratteri..";
            }

            const surname = document.getElementById("surname").value;
            if (surname && surname.length < 3) {
                isValid = false;
                errors.surname =
                    "Il cognome deve essere lungo almeno 3 caratteri..";
            }

            const date_of_birth =
                document.getElementById("date_of_birth").value;
            const today = new Date();
            const hundredYearsAgo = new Date();
            hundredYearsAgo.setFullYear(today.getFullYear() - 100);

            // Convert dates to Date objects
            const dob = new Date(date_of_birth);

            if (!date_of_birth || isNaN(dob.getTime())) {
                isValid = false;
                errors.date_of_birth = "Inserisci una data di nascita valida.";
            } else if (dob < hundredYearsAgo) {
                isValid = false;
                errors.date_of_birth =
                    "La data di nascita non può essere inferiore a 100 anni fa.";
            } else if (dob > today) {
                isValid = false;
                errors.date_of_birth =
                    "La data di nascita non può essere futura.";
            }

            // Email field validation
            const email = document.getElementById("email").value;
            if (!email.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
                isValid = false;
                errors.email = "Inserisci un'email valida.";
            }

            // Password validation
            const password = document.getElementById("password").value;
            const passwordConfirm =
                document.getElementById("password-confirm").value;
            if (password.length < 8) {
                isValid = false;
                errors.password =
                    "La password deve essere lunga almeno 8 caratteri.";
            }
            if (password !== passwordConfirm) {
                isValid = false;
                errors.passwordConfirm = "Le password non corrispondono.";
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
