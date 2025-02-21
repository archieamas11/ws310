<!-- Update Record-->
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edit Record</h3>
                <p class="text-subtitle text-muted">Edit the Deceased Records</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo web_root; ?>pages/admin/index.php?page=map">Map</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Record</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
                <?php 
                    $id = $_GET['id'];
                    $query = mysqli_query($mysqli, "SELECT * FROM tbl_users WHERE user_id = '$id'");
                    $row = mysqli_fetch_assoc($query);
                    if ($row) {
                ?>
                <form class="record-form" action="function/function.php?user_id=<?php echo $id; ?>&action=update" method="POST">

                <input type="text" name="user_id" id="edit-user-id" placeholder="Empty" hidden value="<?php echo $row['user_id']; ?>">
                <div class="row">
                    <div class="col-md-6 p-4">
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" name="name" id="edit-name" required class="form-control form-control-lg" placeholder="Empty" value="<?php echo $row['user_full_name']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Date of Birth</label>
                            <input type="date" name="dob" id="edit-dob" required class="form-control form-control-lg" placeholder="Empty" value="<?php echo $row['date_of_birth']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Place of Birth</label>
                            <input type="text" name="birth_place" id="edit-birth-place" required class="form-control form-control-lg" placeholder="Empty" value="<?php echo $row['place_of_birth']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Nationality</label>
                            <input type="text" name="nationality" id="edit-nationality" required class="form-control form-control-lg" placeholder="Empty" value="<?php echo $row['nationality']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Tax Number</label>
                            <input type="text" name="tax_number" id="edit-tax-number" required class="form-control form-control-lg" placeholder="Empty" value="<?php echo $row['tax_identification_number']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Sex</label>
                            <div class="radio-group">
                                <input type="radio" name="sex" value="male" id="edit-sex-male" <?php echo ($row['sex']==='male' ) ? 'checked' : '' ; ?> required>
                                <label for="edit-sex-male">Male</label>
                                <input type="radio" name="sex" value="female" id="edit-sex-female" <?php echo ($row['sex']==='female' ) ? 'checked' : '' ; ?> required>
                                <label for="edit-sex-female">Female</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Civil Status</label>
                            <select name="status" id="edit-status" required class="form-select form-control-lg">
                                <option value="single" <?php echo ($row['civil_status']==='single' ) ? 'selected' : '' ; ?>>Single</option>
                                <option value="married" <?php echo ($row['civil_status']==='married' ) ? 'selected' : '' ; ?>>Married</option>
                                <option value="widowed" <?php echo ($row['civil_status']==='widowed' ) ? 'selected' : '' ; ?>>Widowed</option>
                                <option value="divorced" <?php echo ($row['civil_status']==='divorced' ) ? 'selected' : '' ; ?>>Divorced</option>
                                <option value="others" <?php echo ($row['civil_status']==='others' ) ? 'selected' : '' ; ?>>Others</option>
                            </select>
                            <input type="text" id="otherStatus" name="otherStatus" placeholder="Enter civil status" style="display: none;" onblur="resetDropdown()" class="form-control form-control-lg" />
                        </div>
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="text" name="phone" id="edit-phone" required class="form-control form-control-lg" placeholder="Empty" value="<?php echo $row['phone_number']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Telephone Number</label>
                            <input type="text" name="telephone" id="edit-telephone" placeholder="Empty" class="form-control form-control-lg" value="<?php echo $row['telephone_number']; ?>">
                        </div>
                    </div>
                    <div class="col-md-6 p-4">
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" name="email" id="edit-email" required class="form-control form-control-lg" placeholder="Empty" value="<?php echo $row['email_address']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Region</label>
                            <select id="edit-region" name="region_code" class="form-select form-control-lg" onchange="loadProvinces(this.value)">
                                <option value="">Loading regions...</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Province</label>
                            <select id="edit-province" name="province_code" class="form-control form-control-lg" onchange="loadMunicipalities(this.value)">
                                <option value="">Select region first</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Municipality</label>
                            <select id="edit-municipality" name="municipality_code" class="form-control form-control-lg" onchange="loadBarangays(this.value)">
                                <option value="">Select province first</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Barangay</label>
                            <select id="edit-barangay" name="barangay_code" class="form-control form-control-lg">
                                <option value="">Select municipality first</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Home Address</label>
                            <input type="text" name="home_address" id="edit-home-address" required class="form-control form-control-lg" placeholder="Empty" value="<?php echo $row['home_address']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Zip Code</label>
                            <input type="text" name="zipcode" id="edit-zipcode" required class="form-control form-control-lg" placeholder="Empty" value="<?php echo $row['zip_code']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Father's Full Name</label>
                            <input type="text" name="father_name" id="edit-father-name" required class="form-control form-control-lg" placeholder="Empty" value="<?php echo $row['fathers_full_name']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Mother's Full Name</label>
                            <input type="text" name="mother_name" id="edit-mother-name" required class="form-control form-control-lg" placeholder="Empty" value="<?php echo $row['mothers_full_name']; ?>">
                        </div>
                    </div>
                </div>
                <?php } else {
                        echo 'not found';
                    } 
                ?>
                <div class="mt-4 text-end">
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
