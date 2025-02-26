document.addEventListener("DOMContentLoaded", async function () {
    const regionSelect = document.getElementById("region");
    const provinceSelect = document.getElementById("province");
    const citySelect = document.getElementById("city");
    const barangaySelect = document.getElementById("barangay");

    const regionNameInput = document.getElementById("region_name");
    const provinceNameInput = document.getElementById("province_name");
    const cityNameInput = document.getElementById("city_name");
    const barangayNameInput = document.getElementById("barangay_name");

    if (!regionSelect || !provinceSelect || !citySelect || !barangaySelect || !regionNameInput || !provinceNameInput || !cityNameInput || !barangayNameInput) {
        console.error("Error: Missing required elements");
        return;
    }

    const cache = { regions: {}, provinces: {}, cities: {}, barangays: {} };

    // Helper function to populate select options
    function populateSelect(select, data, selectedValue, nameInput) {
        const fragment = document.createDocumentFragment();
        const defaultOption = document.createElement("option");
        defaultOption.value = "";
        defaultOption.textContent = "Select an option";
        fragment.appendChild(defaultOption);

        data.forEach(item => {
            const option = document.createElement("option");
            option.value = item.code;
            option.textContent = item.name;
            option.dataset.name = item.name;
            if (nameInput && nameInput.value === item.name) {
                option.selected = true;
            }
            fragment.appendChild(option);
        });

        select.innerHTML = "";
        select.appendChild(fragment);
        select.disabled = data.length === 0;
    }

    // Helper function to update hidden name input
    function updateNameInput(select, nameInput) {
        const selectedOption = select.options[select.selectedIndex];
        if (selectedOption && selectedOption.dataset.name) {
            nameInput.value = selectedOption.dataset.name;
        } else {
            nameInput.value = "";
        }
    }

    // Fetch and populate regions
    async function fetchRegions() {
        try {
            if (!cache.regions.list) {
                const response = await fetch("https://psgc.cloud/api/regions");
                if (!response.ok) throw new Error('Failed to fetch regions');
                cache.regions.list = await response.json();
            }
            populateSelect(regionSelect, cache.regions.list, null, regionNameInput);
        } catch (error) {
            console.error("Error fetching regions:", error);
            alert("Failed to load regions. Please try again later.");
        }
    }

    // Fetch and populate provinces
    async function fetchProvinces(regionCode) {
        try {
            if (!cache.provinces[regionCode]) {
                const response = await fetch(`https://psgc.cloud/api/regions/${regionCode}/provinces`);
                if (!response.ok) throw new Error('Failed to fetch provinces');
                cache.provinces[regionCode] = await response.json();
            }
            populateSelect(provinceSelect, cache.provinces[regionCode], null, provinceNameInput);
        } catch (error) {
            console.error("Error fetching provinces:", error);
            alert("Failed to load provinces. Please try again later.");
        }
    }

    // Fetch and populate cities
    async function fetchCities(provinceCode) {
        try {
            if (!cache.cities[provinceCode]) {
                const response = await fetch(`https://psgc.cloud/api/provinces/${provinceCode}/cities-municipalities`);
                if (!response.ok) throw new Error('Failed to fetch cities');
                cache.cities[provinceCode] = await response.json();
            }
            populateSelect(citySelect, cache.cities[provinceCode], null, cityNameInput);
        } catch (error) {
            console.error("Error fetching cities:", error);
            alert("Failed to load cities. Please try again later.");
        }
    }

    // Fetch and populate barangays
    async function fetchBarangays(cityCode) {
        try {
            if (!cache.barangays[cityCode]) {
                const response = await fetch(`https://psgc.cloud/api/cities-municipalities/${cityCode}/barangays`);
                if (!response.ok) throw new Error('Failed to fetch barangays');
                cache.barangays[cityCode] = await response.json();
            }
            populateSelect(barangaySelect, cache.barangays[cityCode], null, barangayNameInput);
        } catch (error) {
            console.error("Error fetching barangays:", error);
            alert("Failed to load barangays. Please try again later.");
        }
    }

    // Event Listeners for cascading selections
    regionSelect.addEventListener("change", async function () {
        const regionCode = this.value;
        updateNameInput(this, regionNameInput);
        
        // Reset dependent fields
        provinceSelect.innerHTML = '<option value="">Select an option</option>';
        citySelect.innerHTML = '<option value="">Select an option</option>';
        barangaySelect.innerHTML = '<option value="">Select an option</option>';
        provinceNameInput.value = '';
        cityNameInput.value = '';
        barangayNameInput.value = '';

        if (regionCode) {
            provinceSelect.innerHTML = '<option value="">Loading...</option>';
            await fetchProvinces(regionCode);
        }
    });

    provinceSelect.addEventListener("change", async function () {
        const provinceCode = this.value;
        updateNameInput(this, provinceNameInput);
        
        // Reset dependent fields
        citySelect.innerHTML = '<option value="">Select an option</option>';
        barangaySelect.innerHTML = '<option value="">Select an option</option>';
        cityNameInput.value = '';
        barangayNameInput.value = '';

        if (provinceCode) {
            citySelect.innerHTML = '<option value="">Loading...</option>';
            await fetchCities(provinceCode);
        }
    });

    citySelect.addEventListener("change", async function () {
        const cityCode = this.value;
        updateNameInput(this, cityNameInput);
        
        // Reset dependent fields
        barangaySelect.innerHTML = '<option value="">Select an option</option>';
        barangayNameInput.value = '';

        if (cityCode) {
            barangaySelect.innerHTML = '<option value="">Loading...</option>';
            await fetchBarangays(cityCode);
        }
    });

    barangaySelect.addEventListener("change", function() {
        updateNameInput(this, barangayNameInput);
    });

    // Initialize region list
    await fetchRegions();

    // If region name is preselected, find and select the matching region
    if (regionNameInput.value) {
        const regionOption = Array.from(regionSelect.options).find(option => option.dataset.name === regionNameInput.value);
        if (regionOption) {
            regionOption.selected = true;
            await fetchProvinces(regionOption.value);

            // If province is preselected
            if (provinceNameInput.value) {
                const provinceOption = Array.from(provinceSelect.options).find(option => option.dataset.name === provinceNameInput.value);
                if (provinceOption) {
                    provinceOption.selected = true;
                    await fetchCities(provinceOption.value);

                    // If city is preselected
                    if (cityNameInput.value) {
                        const cityOption = Array.from(citySelect.options).find(option => option.dataset.name === cityNameInput.value);
                        if (cityOption) {
                            cityOption.selected = true;
                            await fetchBarangays(cityOption.value);

                            // If barangay is preselected
                            if (barangayNameInput.value) {
                                const barangayOption = Array.from(barangaySelect.options).find(option => option.dataset.name === barangayNameInput.value);
                                if (barangayOption) {
                                    barangayOption.selected = true;
                                }
                            }
                        }
                    }
                }
            }
        }
    }
});

document.querySelector("form").addEventListener("submit", function () {
    const regionSelect = document.getElementById("region");
    const provinceSelect = document.getElementById("province");
    const citySelect = document.getElementById("city");
    const barangaySelect = document.getElementById("barangay");

    document.getElementById("region_name").value = regionSelect.options[regionSelect.selectedIndex].text;
    document.getElementById("province_name").value = provinceSelect.options[provinceSelect.selectedIndex].text;
    document.getElementById("city_name").value = citySelect.options[citySelect.selectedIndex].text;
    document.getElementById("barangay_name").value = barangaySelect.options[barangaySelect.selectedIndex].text;
});
