import "./bootstrap";

// Import link for app.scss
import "~resources/scss/app.scss";

// Import link for Bootstrap(front-end framework)
import * as bootstrap from "bootstrap";

// Import link for images insertion
import.meta.glob(["../img/**"]);

// Autocomplete di TomTom
import "./autocomplete.js";

// validation
document
    .getElementById("registrationForm")
    .addEventListener("submit", function (event) {
        let isValid = true; // Usa 'let' invece di 'const'
        const errors = [];

        // Validazione dei campi facoltativi (se presenti)
        const name = document.getElementById("name").value;
        if (name && name.length < 3) {
            isValid = false;
            errors.push("Il nome deve essere lungo almeno 3 caratteri.");
        }
        console.log("Nome:", name);

        const surname = document.getElementById("surname").value;
        if (surname && surname.length < 3) {
            isValid = false;
            errors.push("Il cognome deve essere lungo almeno 3 caratteri.");
        }
        console.log("Cognome:", surname);

        const date_of_birth = document.getElementById("date_of_birth").value;
        if (date_of_birth && isNaN(Date.parse(date_of_birth))) {
            isValid = false;
            errors.push("Inserisci una data di nascita valida.");
        }
        console.log("Data di Nascita:", date_of_birth);

        // Validazione del campo email
        const email = document.getElementById("email").value;
        if (!email.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
            isValid = false;
            errors.push("Inserisci un'email valida.");
        }
        console.log("Email:", email);

        // Validazione delle password
        const password = document.getElementById("password").value;
        const passwordConfirm =
            document.getElementById("password-confirm").value;
        if (password.length < 8) {
            isValid = false;
            errors.push("La password deve essere lunga almeno 8 caratteri.");
        }
        if (password !== passwordConfirm) {
            isValid = false;
            errors.push("Le password non corrispondono.");
        }
        console.log("Password:", password);
        console.log("Conferma Password:", passwordConfirm);

        if (!isValid) {
            event.preventDefault();
            alert(errors.join("\n"));
        }

        console.log("isValid:", isValid); // Questo per vedere se isValid è false quando ci sono errori
    });
