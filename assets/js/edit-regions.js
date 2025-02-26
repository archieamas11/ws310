// Load initial regions
document.addEventListener('DOMContentLoaded', loadRegions);

async function loadRegions() {
    try {
        const response = await fetch('https://psgc.cloud/api/regions');
        const regions = await response.json();
        const regionSelect = document.getElementById('edit-region');
        const regionNameInput = document.getElementById('edit-region-name');

        regionSelect.innerHTML = '<option value="">Select Region</option>';
        regions.forEach(region => {
            const option = document.createElement('option');
            option.value = region.code;
            option.textContent = region.name;
            option.dataset.name = region.name;
            regionSelect.appendChild(option);
        });

        regionSelect.addEventListener('change', () => {
            const selectedOption = regionSelect.options[regionSelect.selectedIndex];
            regionNameInput.value = selectedOption.value === '' ? '' : selectedOption.dataset.name;
        });

    } catch (error) {
        console.error('Error loading regions:', error);
    }
}

async function loadProvinces(regionCode) {
    try {
        const response = await fetch(`https://psgc.cloud/api/regions/${regionCode}/provinces`);
        const provinces = await response.json();
        const provinceSelect = document.getElementById('edit-province');
        const provinceNameInput = document.getElementById('edit-province-name');

        provinceSelect.innerHTML = '<option value="">Select Province</option>';
        provinces.forEach(province => {
            const option = document.createElement('option');
            option.value = province.code;
            option.textContent = province.name;
            option.dataset.name = province.name;
            provinceSelect.appendChild(option);
        });

        provinceSelect.addEventListener('change', () => {
            const selectedOption = provinceSelect.options[provinceSelect.selectedIndex];
            provinceNameInput.value = selectedOption.value === '' ? '' : selectedOption.dataset.name;
        });

    } catch (error) {
        console.error('Error loading provinces:', error);
    }
}

async function loadMunicipalities(provinceCode) {
    try {
        const response = await fetch(`https://psgc.cloud/api/provinces/${provinceCode}/municipalities`);
        const municipalities = await response.json();
        const municipalitySelect = document.getElementById('edit-municipality');
        const municipalityNameInput = document.getElementById('edit-municipality-name');

        municipalitySelect.innerHTML = '<option value="">Select Municipality</option>';
        municipalities.forEach(municipality => {
            const option = document.createElement('option');
            option.value = municipality.code;
            option.textContent = municipality.name;
            option.dataset.name = municipality.name;
            municipalitySelect.appendChild(option);
        });

        municipalitySelect.addEventListener('change', () => {
            const selectedOption = municipalitySelect.options[municipalitySelect.selectedIndex];
            municipalityNameInput.value = selectedOption.value === '' ? '' : selectedOption.dataset.name;
        });

    } catch (error) {
        console.error('Error loading municipalities:', error);
    }
}

async function loadBarangays(municipalityCode) {
    try {
        const response = await fetch(`https://psgc.cloud/api/municipalities/${municipalityCode}/barangays`);
        const barangays = await response.json();
        const barangaySelect = document.getElementById('edit-barangay');
        const barangayNameInput = document.getElementById('edit-barangay-name');

        barangaySelect.innerHTML = '<option value="">Select Barangay</option>';
        barangays.forEach(barangay => {
            const option = document.createElement('option');
            option.value = barangay.code;
            option.textContent = barangay.name;
            option.dataset.name = barangay.name;
            barangaySelect.appendChild(option);
        });

        barangaySelect.addEventListener('change', () => {
            const selectedOption = barangaySelect.options[barangaySelect.selectedIndex];
            barangayNameInput.value = selectedOption.value === '' ? '' : selectedOption.dataset.name;
        });

    } catch (error) {
        console.error('Error loading barangays:', error);
    }
}