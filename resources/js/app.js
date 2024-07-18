import "./bootstrap";

// Import link for app.scss
import "~resources/scss/app.scss";

// Import link for Bootstrap(front-end framework)
import * as bootstrap from "bootstrap";

// Registration form validation
import "./partials/validations/registration-form-validation.js";

// Create and update form validation
import "./partials/validations/create-update-form-validation.js";

// Import link for images insertion
import.meta.glob(["../img/**"]);

// Import delete modal
import "./partials/delete-modal.js";

// Autocomplete TomTom
import "./partials/autocomplete.js";
