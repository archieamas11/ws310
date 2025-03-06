document.addEventListener("DOMContentLoaded", function () {
    function setupToggle(inputId, selectId) {
        const select = document.getElementById(selectId);
        const input = document.getElementById(inputId);

        select.style.display = "none";
        input.style.display = "block";

        input.addEventListener("click", function () {
            input.style.display = "none";
            select.style.display = "block";
            select.focus();
            const event = new Event("mousedown");
            select.dispatchEvent(event);
        });

        select.addEventListener("change", function () {
            input.value = select.options[select.selectedIndex].text;
            input.style.display = "block";
            select.style.display = "none";
        });
    }

    setupToggle("edit-region-name", "edit-region");
    setupToggle("edit-province-name", "edit-province");
    setupToggle("edit-municipality-name", "edit-municipality");
    setupToggle("edit-barangay-name", "edit-barangay");
});