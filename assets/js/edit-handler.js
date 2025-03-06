document.addEventListener("DOMContentLoaded", function () {
    const editButtons = document.querySelectorAll(".edit-btn");

    editButtons.forEach(button => {
        button.addEventListener("click", function () {
            let userId = this.getAttribute("data-id"); // Get user_id from button
            let form = document.getElementById("editForm");

            // Update form action dynamically
            form.action = `function/function.php?user_id=${userId}&action=update`;

            // Also update the hidden input field
            document.getElementById("edit-user-id").value = userId;
        });
    });
});