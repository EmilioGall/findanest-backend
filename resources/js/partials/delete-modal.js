document.addEventListener("DOMContentLoaded", function () {
    // Test
    // console.log("Hello World!");

    // Intercept all the delete buttons
    const deleteBtns = document.querySelectorAll(".delete-btn");

    if (deleteBtns.length > 0) {
        // For each button, set up the click listener
        deleteBtns.forEach((trashButton) => {
            trashButton.addEventListener("click", function (e) {
                e.preventDefault();

                // Retrieve the title and ID of the house through data attributes
                const houseTitle = trashButton.dataset.houseTitle;
                const houseId = trashButton.dataset.houseId;

                // Dynamically populate the message based on the title of the house to be deleted
                document.getElementById(
                    "modal-message"
                ).innerHTML = `Stai per cancellare la casa <span class="fw-bold text-danger">${houseTitle}</span>, vuoi proseguire?`;

                // Add the listener to the confirm delete button
                document.getElementById("confirm-delete").onclick =
                    function () {
                        document
                            .getElementById(`delete-form-${houseId}`)
                            .submit();
                    };

                // Show modal
                modal.show();
            });
        });
    }
});
