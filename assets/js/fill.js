async function fillForm() {
    const formData = {
        last_name: "albarico",
        first_name: "archie",
        middle_name: "amas",
        dob: "2000-10-24",
        place_of_birth: "vicente sotto memorial medical center",
        sex: "male",
        civil_status: "married",
        tin: "123456789",
        region: "0700000000",
        province: "0702200000",
        city: "0702232000",
        barangay: "0702232013",
        nationality: "filipino",
        religion: "roman catholic",
        email_address: "archiealbarico@gmail.com",
        contact_number: "09123456789",
        telephone_number: "021234567",
        zipcode: "6046",
        home_address: "Tunghaan, Minglanilla, Cebu",
        father_last_name: "albarico",
        father_first_name: "mario",
        father_middle_name: "beduya",
        mother_last_name: "luna",
        mother_first_name: "jessie",
        mother_middle_name: "amas"
    };

    // Utility functions
    const delay = ms => new Promise(resolve => setTimeout(resolve, ms));
    
    const setInputValue = (selector, value) => {
        const element = document.querySelector(selector);
        if (element) {
            element.value = value;
            element.dispatchEvent(new Event('change', { bubbles: true }));
        }
    };

    const setRadioGroup = (name, value) => {
        const selector = `input[name="${name}"]`;
        const radios = document.querySelectorAll(selector);
        let found = false;
        
        radios.forEach(radio => {
            if (radio.value === value.toLowerCase()) {
                radio.checked = true;
                found = true;
            }
        });
        
        if (!found) console.warn(`Radio group ${name} missing option: ${value}`);
    };

    const setSelectValue = async (selector, value, wait = 0) => {
        const element = document.querySelector(selector);
        if (element) {
            element.value = value;
            element.dispatchEvent(new Event('change', { bubbles: true }));
            await delay(wait);
        }
    };

    // Fill standard input fields and radio buttons
    Object.entries(formData).forEach(([key, value]) => {
        const inputSelector = `input[name="${key}"]`;
        const input = document.querySelector(inputSelector);
        
        if (input) {
            input.type === 'radio' 
                ? setRadioGroup(key, value) 
                : setInputValue(inputSelector, value);
        }
    });

    // Handle dependent dropdowns sequentially
    await setSelectValue('#region', formData.region, 500);
    await setSelectValue('#province', formData.province, 500);
    await setSelectValue('#city', formData.city, 500);
    await setSelectValue('#barangay', formData.barangay);

    // Handle special dropdowns
    const specialSelects = [
        ['select[name="civil_status"]', formData.civil_status],
        ['#nationality', formData.nationality],
        ['#home_address', formData.home_address],
        ['#zipcode', formData.zipcode],
        ['#dob', formData.dob]
    ];

    specialSelects.forEach(([selector, value]) => {
        setInputValue(selector, value);
        
        // Handle civil status special case
        if (selector === 'select[name="civil_status"]') {
            const otherStatusInput = document.getElementById('otherStatus');
            if (otherStatusInput) {
                otherStatusInput.style.display = 
                    value === 'others' ? 'inline-block' : 'none';
            }
        }
    });

    // Add safety delay for final UI updates
    await delay(100);
}