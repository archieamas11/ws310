document.addEventListener('DOMContentLoaded', function() {
    // Get all view buttons
    const viewButtons = document.querySelectorAll('.view-btn');
    
    viewButtons.forEach(button => {
        button.addEventListener('click', function() {
            const userId = this.getAttribute('data-id');
            
            // Make AJAX request to get user data
            fetch('function/function.php?action=get', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'user_id=' + encodeURIComponent(userId)
            })
            .then(response => response.json())
            .then(data => {
                // Populate modal with data
                document.getElementById('view_full_name').textContent = data.user_full_name ? data.user_full_name : 'N/A';
                document.getElementById('view_dob').textContent = data.date_of_birth ? data.date_of_birth : 'N/A';
                const dob = new Date(data.date_of_birth);
                const age = new Date().getFullYear() - dob.getFullYear();
                document.getElementById('view_age').textContent = age ? age : 'N/A';
                document.getElementById('view_sex').textContent = data.sex ? data.sex : 'N/A';
                document.getElementById('view_civil_status').textContent = data.civil_status ? data.civil_status : 'N/A';
                document.getElementById('view_pob').textContent = data.place_of_birth ? data.place_of_birth : 'N/A';
                document.getElementById('view_nationality').textContent = data.nationality ? data.nationality : 'N/A';
                document.getElementById('view_religion').textContent = data.religion ? data.religion : 'N/A';
                document.getElementById('view_tin').textContent = data.tax_identification_number ? data.tax_identification_number : 'N/A';
                document.getElementById('view_phone').textContent = data.phone_number ? data.phone_number : 'N/A';
                document.getElementById('view_telephone').textContent = data.telephone_number ? data.telephone_number : 'N/A';
                document.getElementById('view_email').textContent = data.email_address ? data.email_address : 'N/A';
                document.getElementById('view_region').textContent = data.region ? data.region : 'N/A';
                document.getElementById('view_province').textContent = data.province ? data.province : 'N/A';
                document.getElementById('view_municipality').textContent = data.municipality ? data.municipality : 'N/A';
                document.getElementById('view_barangay').textContent = data.barangay ? data.barangay : 'N/A';
                document.getElementById('view_address').textContent = data.home_address ? data.home_address : 'N/A';
                document.getElementById('view_zip').textContent = data.zip_code ? data.zip_code : 'N/A';
                document.getElementById('view_father').textContent = data.fathers_full_name ? data.fathers_full_name : 'N/A';
                document.getElementById('view_mother').textContent = data.mothers_full_name ? data.mothers_full_name : 'N/A';
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to load user data');
            });
        });
    });
});