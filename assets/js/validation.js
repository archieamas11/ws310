document.addEventListener("DOMContentLoaded", function() {
    // Get form and submit button
    const form = document.getElementById("editForm");
    const submitButton = form.querySelector('button[type="submit"]');
    
    // Initially disable the submit button
    submitButton.disabled = true;

    // Add error span elements if missing
    function ensureErrorSpans() {
        const requiredInputs = form.querySelectorAll('input[type="text"], input[type="date"], input[type="email"], input[type="number"], select');
        requiredInputs.forEach(input => {
            const parentDiv = input.parentElement;
            if (!parentDiv.querySelector('.error-feedback')) {
                const errorSpan = document.createElement('span');
                errorSpan.className = 'error-feedback text-danger';
                parentDiv.appendChild(errorSpan);
            }
        });
    }
    
    // Called when validation is run
    function showError(input, message) {
        const parentDiv = input.parentElement;
        const errorSpan = parentDiv.querySelector('.error-feedback');
        if (errorSpan) {
            errorSpan.textContent = message;
            input.classList.add('is-invalid');
        }
        return false;
    }
    
    function clearError(input) {
        const parentDiv = input.parentElement;
        const errorSpan = parentDiv.querySelector('.error-feedback');
        if (errorSpan) {
            errorSpan.textContent = '';
            input.classList.remove('is-invalid');
        }
        return true;
    }
    
    // Validate specific field based on rules
    function validateField(input) {
        const value = input.value.trim();
        const name = input.name;
        const id = input.id;
        
        // Required fields
        const requiredFields = ['name', 'dob', 'nationality', 'birth_place', 'home_address', 'zipcode'];
        
        if (requiredFields.includes(name) && value === '') {
            return showError(input, 'This field is required.');
        }
        
        // Check for consecutive white spaces
        if (value.match(/\s{2,}/)) {
            return showError(input, 'Cannot contain consecutive spaces.');
        }
        
        // Special validators
        switch (name) {
            case 'name':
                if (/[^a-zA-Z\s\.\-']/.test(value)) {
                    return showError(input, 'Full name should only contain letters, spaces, dots, hyphens and apostrophes.');
                }
                break;
                
            case 'dob':
                if (value) {
                    const birthDate = new Date(value);
                    const today = new Date();
                    let age = today.getFullYear() - birthDate.getFullYear();
                    const m = today.getMonth() - birthDate.getMonth();
                    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                        age--;
                    }
                    if (age < 18) {
                        return showError(input, 'You must be at least 18 years old.');
                    }
                }
                break;
                
            case 'phone':
                if (value && !value.match(/^09[0-9]{9}$/)) {
                    return showError(input, 'Phone number must be in format 09XXXXXXXXX.');
                }
                break;
                
            case 'telephone':
                if (value && !value.match(/^(\+?\d{1,4}[\s-]?)?(\(?\d{1,4}\)?[\s-]?)?\d{3,4}[\s-]?\d{3,4}$/)) {
                    return showError(input, 'Invalid telephone number format.');
                }
                break;
                
            case 'zipcode':
                if (value && !value.match(/^\d{4}$/)) {
                    return showError(input, 'Zip code must be exactly 4 digits.');
                }
                break;
                
            case 'tax_number':
                if (value && !value.match(/^\d{9,12}$/) && value !== '') {
                    return showError(input, 'TIN must be 9 to 12 digits.');
                }
                break;
                
            case 'email':
                if (value && !validateEmail(value)) {
                    return showError(input, 'Please enter a valid email address.');
                }
                break;
                
            case 'nationality':
            case 'religion':
                if (value && /[^a-zA-Z\s\-]/.test(value)) {
                    return showError(input, 'Should only contain letters, spaces and hyphens.');
                }
                break;
                
            // Only home address and place of birth can have both letters and numbers
            default:
                if (name !== 'home_address' && name !== 'birth_place' && name !== 'barangay_name' && value && /\d/.test(value) && /[a-zA-Z]/.test(value)) {
                    return showError(input, 'Cannot contain both letters and numbers.');
                }
                break;
        }
        
        // Specific validation for dropdown fields
        if (id === 'edit-region' || id === 'edit-province' || id === 'edit-municipality' || id === 'edit-barangay') {
            if (!value) {
                return showError(input, 'Please select an option.');
            }
        }
        
        // Validate sex (radio buttons)
        if (name === 'sex') {
            const maleRadio = document.getElementById('edit-sex-male');
            const femaleRadio = document.getElementById('edit-sex-female');
            if (!maleRadio.checked && !femaleRadio.checked) {
                return showError(maleRadio, 'Please select a gender.');
            }
        }
        
        return clearError(input);
    }
    
    // Email validation
    function validateEmail(email) {
        const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }
    
    // Check if all fields are valid
    function validateForm() {
        const inputs = form.querySelectorAll('input:not([hidden]), select');
        let isValid = true;
        
        inputs.forEach(input => {
            if (!validateField(input)) {
                isValid = false;
            }
        });
        
        // Radio buttons need special handling
        const maleRadio = document.getElementById('edit-sex-male');
        const femaleRadio = document.getElementById('edit-sex-female');
        if (!maleRadio.checked && !femaleRadio.checked) {
            isValid = false;
            const errorSpan = maleRadio.parentElement.querySelector('.error-feedback') || document.createElement('span');
            errorSpan.className = 'error-feedback text-danger';
            errorSpan.textContent = 'Please select a gender.';
            maleRadio.parentElement.appendChild(errorSpan);
        } else {
            const errorSpan = maleRadio.parentElement.querySelector('.error-feedback');
            if (errorSpan) errorSpan.textContent = '';
        }
        
        // Enable or disable submit button
        submitButton.disabled = !isValid;
        
        return isValid;
        
        // Expose validateForm globally
        window.validateForm = validateForm;
    }
    
    // Ensure all needed error spans exist
    ensureErrorSpans();
    
    // Add real-time validation to all inputs
    const inputs = form.querySelectorAll('input:not([hidden]), select');
    inputs.forEach(input => {
        // For radio buttons, attach event to parent div
        if (input.type === 'radio') {
            input.addEventListener('change', function() {
                validateForm();
            });
        } else {
            // For regular inputs
            input.addEventListener('input', function() {
                validateField(this);
                validateForm();
            });
            
            input.addEventListener('blur', function() {
                validateField(this);
                validateForm();
            });
        }
    });
    
    // Special handling for civil status dropdown and "others" text field
    const statusDropdown = document.getElementById('edit-status');
    const otherStatusInput = document.getElementById('otherStatus');
    
    statusDropdown.addEventListener('change', function() {
        if (this.value === 'others') {
            otherStatusInput.style.display = 'block';
            // Add validation for the "other" field
            otherStatusInput.addEventListener('input', validateForm);
            otherStatusInput.addEventListener('blur', validateForm);
        } else {
            otherStatusInput.style.display = 'none';
        }
        validateForm();
    });
    
    // Handle form submission
    form.addEventListener('submit', function(e) {
        if (!validateForm()) {
            e.preventDefault();
        }
    });
    
    // Initial validation on page load
    validateForm();
});