// Listen for clicks on edit buttons
document.addEventListener("click", function (e) {
    if (e.target.closest(".edit-btn")) {
        const button = e.target.closest(".edit-btn");
        const userId = button.getAttribute("data-id");

        // Sample AJAX (or mock data) to load user data based on the userId
        fetch(`get_user.php?user_id=${userId}`)
            .then(response => response.json())
            .then(data => {
                // Fill modal fields with user data
                document.getElementById("edit-user-id").value = data.user_id;
                document.getElementById("edit-name").value = data.user_full_name;
                document.getElementById("edit-dob").value = data.date_of_birth;
                document.getElementById("edit-birth-place").value = data.place_of_birth;
                document.getElementById("edit-nationality").value = data.nationality;
                document.getElementById("edit-tax-number").value = data.tax_identification_number;
                document.getElementById("edit-phone").value = data.phone_number;
                document.getElementById("edit-telephone").value = data.telephone_number;
                document.getElementById("edit-email").value = data.email_address;
                document.getElementById("edit-home-address").value = data.home_address;
                document.getElementById("edit-zipcode").value = data.zip_code;
                document.getElementById("edit-father-name").value = data.fathers_full_name;
                document.getElementById("edit-mother-name").value = data.mothers_full_name;

                // Set gender and civil status options
                document.getElementById(`edit-sex-${data.sex}`).checked = true;
                document.getElementById("edit-status").value = data.status;
            })
            .catch(error => console.error("Error fetching user data:", error));
    }
});
