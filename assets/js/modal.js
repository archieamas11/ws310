document.addEventListener("DOMContentLoaded", function() {
    // Configuration
    const API_BASE_URL = window.location.origin + "/ws310";
    // const FETCH_USER_ENDPOINT = `${API_BASE_URL}/fetch_user.php`;
    const FETCH_USER_ENDPOINT = `${API_BASE_URL}/admin/function/function.php?action=get`;

    console.log(`API_BASE_URL: ${API_BASE_URL}`);
    console.log(`FETCH_USER_ENDPOINT: ${FETCH_USER_ENDPOINT}`);

    
    // Helper function to set select value and handle async dropdown relationships
    async function setSelectValue(selectId, value) {
        const select = document.getElementById(selectId);
        if (!select) {
            console.warn(`Select element with ID '${selectId}' not found`);
            return false;
        }

        // Wait for options to be populated if empty
        let attempts = 0;
        while (select.options.length <= 1 && attempts < 10) {
            await new Promise(resolve => setTimeout(resolve, 100));
            attempts++;
        }
        
        for (let i = 0; i < select.options.length; i++) {
            if (select.options[i].value === value) {
                select.selectedIndex = i;
                // Use a proper event that bubbles
                select.dispatchEvent(new Event('change', { bubbles: true }));
                return true;
            }
        }
        
        console.warn(`Value '${value}' not found in select '${selectId}'`);
        return false;
    }
    
    // Helper to safely set form field values
    function setFormValue(elementId, value) {
        const element = document.getElementById(elementId);
        if (element) {
            element.value = value || '';
        } else {
            console.warn(`Element with ID '${elementId}' not found`);
        }
    }
    
    // Handle edit button clicks
    document.querySelectorAll(".edit-btn").forEach(button => {
        button.addEventListener("click", async function() {
            const userId = this.dataset.id;
            if (!userId) {
                console.error("No user ID provided");
                return;
            }
            
            try {
                // Fetch user data
                const response = await fetch(FETCH_USER_ENDPOINT, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded",
                        "X-Requested-With": "XMLHttpRequest" // CSRF protection
                    },
                    body: `user_id=${encodeURIComponent(userId)}`
                });
                
                if (!response.ok) {
                    throw new Error(`Server returned ${response.status}: ${response.statusText}`);
                }
                
                const data = await response.json();
                
                if (data.error) {
                    throw new Error(data.error);
                }
                
                // Populate form fields
                populateForm(data);
            } catch (error) {
                console.error("Error fetching user data:", error);
                alert(`Failed to load user data: ${error.message}`);
            }
        });
    });
    
    // Populate form with user data
    async function populateForm(data) {
        // Basic text fields
        const textFields = {
            "edit-user-id": data.user_id,
            "edit-name": data.user_full_name,
            "edit-dob": data.date_of_birth,
            "edit-birth-place": data.place_of_birth,
            "edit-nationality": data.nationality,
            "edit-religion": data.religion,
            "edit-tax-number": data.tax_identification_number,
            "edit-phone": data.phone_number,
            "edit-telephone": data.telephone_number,
            "edit-email": data.email_address,
            "edit-home-address": data.home_address,
            "edit-zipcode": data.zip_code,
            "edit-father-name": data.fathers_full_name,
            "edit-barangay-name": data.barangay,
            "edit-region-name": data.region,
            "edit-province-name": data.province,
            "edit-municipality-name": data.municipality,
            "edit-mother-name": data.mothers_full_name
        };
        
        // Populate text fields and trigger input event
        Object.entries(textFields).forEach(([id, value]) => {
            const element = document.getElementById(id);
            if (element) {
                element.value = value || '';
                // Trigger input event to notify validation
                element.dispatchEvent(new Event('input', { bubbles: true }));
            } else {
                console.warn(`Element with ID '${id}' not found`);
            }
        });
        
        // Handle radio buttons for sex
        const maleRadio = document.getElementById("edit-sex-male");
        const femaleRadio = document.getElementById("edit-sex-female");
        if (maleRadio && femaleRadio) {
            maleRadio.checked = data.sex === "male";
            femaleRadio.checked = data.sex === "female";
            // Trigger change event on the checked radio
            const checkedRadio = data.sex === "male" ? maleRadio : femaleRadio;
            checkedRadio.dispatchEvent(new Event('change', { bubbles: true }));
        }
        
        // Handle civil status and conditional fields
        const statusSelect = document.getElementById("edit-status");
        const otherStatus = document.getElementById("otherStatus");
        if (statusSelect) {
            statusSelect.value = data.civil_status || "";
            // Trigger change event for civil status
            statusSelect.dispatchEvent(new Event('change', { bubbles: true }));

            if (otherStatus) {
                if (data.civil_status === "others") {
                    otherStatus.style.display = "block";
                    otherStatus.value = data.other_status || "";
                    // Trigger input event for otherStatus
                    otherStatus.dispatchEvent(new Event('input', { bubbles: true }));
                } else {
                    otherStatus.style.display = "none";
                }
            }
        }
        
        // Handle location dropdowns with proper dependency chain
        try {
            // Set region first and wait
            const regionSet = await setSelectValue('edit-region', data.region_code);
            if (regionSet) {
                // Wait for province options to load after region change event
                await new Promise(resolve => setTimeout(resolve, 300));
                const provinceSet = await setSelectValue('edit-province', data.province_code);
                
                if (provinceSet) {
                    // Wait for municipality options to load after province change event
                    await new Promise(resolve => setTimeout(resolve, 300));
                    const municipalitySet = await setSelectValue('edit-municipality', data.municipality_code);
                    
                    if (municipalitySet) {
                        // Wait for barangay options to load after municipality change event
                        await new Promise(resolve => setTimeout(resolve, 300));
                        await setSelectValue('edit-barangay', data.barangay_code);
                    }
                }
            }
        } catch (err) {
            console.warn("Error setting location dropdown values:", err);
        }
    }
    
    // After all fields are populated, manually trigger form validation
    const form = document.getElementById("editForm");
    if (form) {
        const validateForm = window.validateForm || form.validateForm;
        if (typeof window.validateForm === 'function') {
            window.validateForm();
        } else {
            console.warn("validateForm function not found");
            // Fallback: Trigger input on all fields
            form.querySelectorAll('input, select').forEach(element => {
                element.dispatchEvent(new Event('input', { bubbles: true }));
            });
        }
    }
});