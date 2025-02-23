<div class="modal fade modal-xl" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog" role="document">
        <div class="modal-content p-5">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Edit User </h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form class="record-form" id="editForm" action="function/function.php?action=update" method="POST">
                <div class="modal-body">
                    <input type="text" name="user_id" id="edit-user-id" placeholder="Empty" hidden>
                    <div class="row gy-3">
                            <div class="col-12 col-md-4">
                                <label>Full Name</label>
                                <input type="text" name="name" id="edit-name" class="form-control form-control-lg" placeholder="Empty">
                            </div>
                            <div class="col-12 col-md-4">
                                <label>Date of Birth</label>
                                <input type="date" name="dob" id="edit-dob" class="form-control form-control-lg" placeholder="Empty">
                            </div>
                            <div class="col-12 col-md-4">
                                <label>Place of Birth</label>
                                <input type="text" name="birth_place" id="edit-birth-place" class="form-control form-control-lg" placeholder="Empty">
                            </div>
                            <div class="col-12 col-md-4">
                                <label>Nationality</label>
                                <input type="text" name="nationality" id="edit-nationality" class="form-control form-control-lg" placeholder="Empty">
                            </div>
                            <div class="col-12 col-md-4">
                                <label>Religion</label>
                                <input type="text" name="religion" id="edit-religion" class="form-control form-control-lg" placeholder="Empty">
                                <span class="error-feedback text-danger"><?php echo $errors['religion'] ?? ''; ?></span>
                            </div>
                            <div class="col-12 col-md-4">
                                <label>Tax Number</label>
                                <input type="numbers" name="tax_number" id="edit-tax-number" class="form-control form-control-lg" placeholder="Empty">
                            </div>
                            <div class="col-12 col-md-4">
                                <label>Sex</label>
                                <div class="radio-group">
                                    <input type="radio" name="sex" value="male" id="edit-sex-male">
                                    <label for="edit-sex-male">Male</label>
                                    <input type="radio" name="sex" value="female" id="edit-sex-female">
                                    <label for="edit-sex-female">Female</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <label>Civil Status</label>
                                <select name="status" id="edit-status" class="form-select form-control-lg">
                                    <option value="single">Single</option>
                                    <option value="married">Married</option>
                                    <option value="widowed">Widowed</option>
                                    <option value="divorced">Divorced</option>
                                    <option value="others">Others</option>
                                </select>
                                <input type="text" id="otherStatus" name="otherStatus" placeholder="Enter civil status" style="display: none;" onblur="resetDropdown()" class="form-control form-control-lg" />
                            </div>
                            <div class="col-12 col-md-4">
                                <label>Phone Number</label>
                                <input type="text" name="phone" id="edit-phone" class="form-control form-control-lg" placeholder="Empty">
                            </div>
                            <div class="col-12 col-md-4">
                                <label>Telephone Number</label>
                                <input type="text" name="telephone" id="edit-telephone" class="form-control form-control-lg" placeholder="Empty">
                            </div>
                            <div class="col-12 col-md-4">
                                <label>Email Address</label>
                                <input type="email" name="email" id="edit-email" class="form-control form-control-lg" placeholder="Empty">
                            </div>
                            <div class="col-12 col-md-4">
                                <label>Region</label>
                                <select id="edit-region" name="region_code" class="form-select form-control-lg"onchange="loadProvinces(this.value)">
                                    <option value="">Select region</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-4">
                                <label>Province</label>
                                <select id="edit-province" name="province_code" class="form-control form-control-lg" onchange="loadMunicipalities(this.value)">
                                    <option value="">Select region first</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-4">
                                <label>Municipality</label>
                                <select id="edit-municipality" name="municipality_code" class="form-control form-control-lg" onchange="loadBarangays(this.value)">
                                    <option value="">Select province first</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-4">
                                <label>Barangay</label>
                                <select id="edit-barangay" name="barangay_code" class="form-control form-control-lg">
                                    <option value="">Select municipality first</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-4">
                                <label>Home Address</label>
                                <input type="text" name="home_address" id="edit-home-address" class="form-control form-control-lg" placeholder="Empty">
                            </div>
                            <div class="col-12 col-md-4">
                                <label>Zip Code</label>
                                <input type="text" name="zipcode" id="edit-zipcode" class="form-control form-control-lg" placeholder="Empty">
                            </div>
                            <div class="col-12 col-md-4">
                                <label>Father's Full Name</label>
                                <input type="text" name="father_name" id="edit-father-name" class="form-control form-control-lg" placeholder="Empty">
                            </div>
                            <div class="col-12 col-md-4">
                                <label>Mother's Full Name</label>
                                <input type="text" name="mother_name" id="edit-mother-name" class="form-control form-control-lg" placeholder="Empty">
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                    <button type="submit" class="btn btn-primary ms-1" name="btn-submit">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Save Changes</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
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
</script>
