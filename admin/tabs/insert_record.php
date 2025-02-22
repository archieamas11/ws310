
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Add New Record</h3>
                <p class="text-subtitle text-muted">
                    Add a new record to the database using the form below.
                </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?php echo web_root; ?>pages/admin/index.php?page=dashboard">
                                Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Add New Record
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <form class="record-form" action="function/function.php?action=add" method="POST">
        <!-- <form class="record-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST"> -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title">Personal Data</h5>      
                </div>
                <div class="card-body">
                    <div class="row gy-3">
                        <div class="col-12 col-md-4">
                            <label for="first_name" class="form-label label mt-3">First Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="e.g. Juan" value="<?php echo htmlspecialchars($form_data['first_name'] ?? ''); ?>">
                            <span class="error-feedback text-danger" <?php if (empty($errors['first_name'] ?? '')) { echo 'hidden'; } ?>><?php echo $errors['first_name'] ?? ''; ?></span>
                        </div>  
                        <div class="col-12 col-md-4">
                            <label for="middle_name" class="form-label label mt-3">Middle Name</label>
                            <input type="text" class="form-control" id="middle_name" name="middle_name" placeholder="e.g. Pedro" value="<?php echo htmlspecialchars($form_data['middle_name'] ?? ''); ?>">
                            <span class="error-feedback text-danger" <?php if (empty($errors['middle_name'] ?? '')) { echo 'hidden'; } ?>><?php echo $errors['middle_name'] ?? ''; ?></span>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="last_name" class="form-label label mt-3">Last Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="e.g. Dela Cruz" value="<?php echo htmlspecialchars($form_data['last_name'] ?? ''); ?>">
                            <span class="error-feedback text-danger" <?php if (empty($errors['last_name'] ?? '')) { echo 'hidden'; } ?>><?php echo $errors['last_name'] ?? ''; ?></span>
                        </div>
                    </div>

                    <div class="row gy-3">
                        <div class="col col-md-4">
                            <label for="dob" class="form-label label mt-3">Date of Birth <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="dob" name="dob" value="<?php echo htmlspecialchars($form_data['dob'] ?? ''); ?>">
                            <span class="error-feedback text-danger" <?php if (empty($errors['dob'] ?? '')) { echo 'hidden'; } ?>><?php echo $errors['dob'] ?? ''; ?></span>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="sex" class="form-label label mt-3">Sex <span class="text-danger">*</span></label>
                            <div style="width: 100%; height: 38px;" class="d-flex align-items-center gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sex" id="male" value="male" <?php echo ($form_data['sex'] ?? '') === 'male' ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sex" id="female" value="female" <?php echo ($form_data['sex'] ?? '') === 'female' ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="female">Female</label>
                                </div>
                                <span class="error-feedback text-danger" <?php if (empty($errors['sex'] ?? '')) { echo 'hidden'; } ?>><?php echo $errors['sex'] ?? ''; ?></span>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="civil_status" class="form-label label mt-3">Civil Status <span class="text-danger">*</span></label>
                            <select class="form-select" aria-label="Default select example" name="civil_status">
                                <option value="">Select an option</option>
                                <option value="single" <?php echo ($form_data['civil_status'] ?? '') === 'single' ? 'selected' : ''; ?>>Single</option>
                                <option value="married" <?php echo ($form_data['civil_status'] ?? '') === 'married' ? 'selected' : ''; ?>>Married</option>
                                <option value="widowed" <?php echo ($form_data['civil_status'] ?? '') === 'widowed' ? 'selected' : ''; ?>>Widowed</option>
                                <option value="separated" <?php echo ($form_data['civil_status'] ?? '') === 'separated' ? 'selected' : ''; ?>>Legally Separated</option>
                                <option value="others" <?php echo ($form_data['civil_status'] ?? '') === 'others' ? 'selected' : ''; ?>>Others</option>
                            </select>
                            <span class="error-feedback text-danger" <?php if (empty($errors['civil_status'] ?? '')) { echo 'hidden'; } ?>><?php echo $errors['civil_status'] ?? ''; ?></span>
                        </div>
                    </div>
                    <div class="row gy-3">
                        <div class="col-12 col-md-4">
                            <label for="tin" class="form-label label mt-3">Tax Identification Number</label>
                            <input type="number" class="form-control" id="tin" name="tin" placeholder="e.g. 123-456-7890" value="<?php echo htmlspecialchars($form_data['tin'] ?? ''); ?>">
                            <span class="error-feedback text-danger" <?php if (empty($errors['tin'] ?? '')) { echo 'hidden'; } ?>><?php echo $errors['tin'] ?? ''; ?></span>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="nationality" class="form-label label mt-3">Nationality <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nationality" name="nationality" placeholder="e.g. Filipino" value="<?php echo htmlspecialchars($form_data['nationality'] ?? ''); ?>">
                            <span class="error-feedback text-danger" <?php if (empty($errors['nationality'] ?? '')) { echo 'hidden'; } ?>><?php echo $errors['nationality'] ?? ''; ?></span>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="religion" class="form-label label mt-3">Religion</label>
                            <input type="text" class="form-control" id="religion" name="religion" placeholder="e.g. Roman Catholic" value="<?php echo htmlspecialchars($form_data['religion'] ?? ''); ?>">
                            <span class="error-feedback text-danger" <?php if (empty($errors['religion'] ?? '')) { echo 'hidden'; } ?>><?php echo $errors['religion'] ?? ''; ?></span>
                        </div>
                    </div>

                    <div class="row gy-3">
                        <div class="col-12 col-md-4">
                            <label for="place_of_birth" class="form-label label mt-3">Place of Birth</label>
                            <input type="text" class="form-control" id="place_of_birth" name="place_of_birth" placeholder="e.g. Manila" value="<?php echo htmlspecialchars($form_data['place_of_birth'] ?? ''); ?>">
                            <span class="error-feedback text-danger" <?php if (empty($errors['place_of_birth'] ?? '')) { echo 'hidden'; } ?>><?php echo $errors['place_of_birth'] ?? ''; ?></span>
                        </div>     
                    </div>
                </div>
            </div>


            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title">Home Address</h5>      
                </div>
                <div class="card-body">
                    <div class="row gy-3">
                        <div class="col-12 col-md-4">
                            <label for="region" class="form-label label mt-3">Region <span class="text-danger">*</span></label>
                            <select class="form-select" aria-label="Default select example" name="region_code" id="region">
                                <option value="">Select an option</option>  
                            </select>
                            <input type="hidden" name="region_name" id="region_name" value="<?php echo htmlspecialchars($form_data['region_name'] ?? ''); ?>">
                            <span class="error-feedback text-danger" <?php if (empty($errors['region_code'] ?? '')) { echo 'hidden'; } ?>><?php echo $errors['region_code'] ?? ''; ?></span>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="province" class="form-label label mt-3">Province <span class="text-danger">*</span></label>
                            <select class="form-select" aria-label="Default select example" name="province_code" id="province">
                                <option value="">Select an option</option>  
                            </select>
                            <input type="hidden" name="province_name" id="province_name" value="<?php echo htmlspecialchars($form_data['province_name'] ?? ''); ?>">
                            <span class="error-feedback text-danger" <?php if (empty($errors['province_code'] ?? '')) { echo 'hidden'; } ?>><?php echo $errors['province_code'] ?? ''; ?></span>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="city" class="form-label label mt-3">City/Municipality<span class="text-danger">*</span></label>
                            <select class="form-select" aria-label="Default select example" name="city_code" id="city">
                                <option value="">Select an option</option>  
                            </select>
                            <input type="hidden" name="city_name" id="city_name" value="<?php echo htmlspecialchars($form_data['city_name'] ?? ''); ?>">
                            <span class="error-feedback text-danger" <?php if (empty($errors['city_code'] ?? '')) { echo 'hidden'; } ?>><?php echo $errors['city_code'] ?? ''; ?></span>
                        </div>
                    </div>

                    <div class="row gy-3">
                        <div class="col-12 col-md-4">
                            <label for="barangay" class="form-label label mt-3">Barangay <span class="text-danger">*</span></label>
                            <select class="form-select" aria-label="Default select example" name="barangay_code" id="barangay">
                                <option value="">Select an option</option>  
                            </select>
                            <input type="hidden" name="barangay_name" id="barangay_name" value="<?php echo htmlspecialchars($form_data['barangay_name'] ?? ''); ?>">
                            <span class="error-feedback text-danger" <?php if (empty($errors['barangay_code'] ?? '')) { echo 'hidden'; } ?>><?php echo $errors['barangay_code'] ?? ''; ?></span>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="zipcode" class="form-label label mt-3">Zip Code <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="zipcode" name="zipcode" placeholder="e.g. 1234" value="<?php echo htmlspecialchars($form_data['zipcode'] ?? ''); ?>">
                            <span class="error-feedback text-danger" <?php if (empty($errors['zipcode'] ?? '')) { echo 'hidden'; } ?>><?php echo $errors['zipcode'] ?? ''; ?></span>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="home_address" class="form-label label mt-3">Home Address <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="home_address" name="home_address" placeholder="e.g. 123 Main Street" value="<?php echo htmlspecialchars($form_data['home_address'] ?? ''); ?>">
                            <span class="error-feedback text-danger" <?php if (empty($errors['home_address'] ?? '')) { echo 'hidden'; } ?>><?php echo $errors['home_address'] ?? ''; ?></span>
                        </div>
                    </div>

                    <div class="row gy-3">
                        <div class="col-12 col-md-4">
                            <label for="email_address" class="form-label label mt-3">Email Address</label>
                            <input type="email" class="form-control" id="email_address" name="email_address" placeholder="e.g. example@email.com" value="<?php echo htmlspecialchars($form_data['email_address'] ?? ''); ?>">
                            <span class="error-feedback text-danger" <?php if (empty($errors['email_address'] ?? '')) { echo 'hidden'; } ?>><?php echo $errors['email_address'] ?? ''; ?></span>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="contact_number" class="form-label label mt-3">Contact Number <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="contact_number" name="contact_number" placeholder="e.g. 09123456789" value="<?php echo htmlspecialchars($form_data['contact_number'] ?? ''); ?>">
                            <span class="error-feedback text-danger" <?php if (empty($errors['contact_number'] ?? '')) { echo 'hidden'; } ?>><?php echo $errors['contact_number'] ?? ''; ?></span>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="telephone_number" class="form-label label mt-3">Telephone Number</label>
                            <input type="number" class="form-control" id="telephone_number" name="telephone_number" placeholder="e.g. 02-123456789" value="<?php echo htmlspecialchars($form_data['telephone_number'] ?? ''); ?>">
                            <span class="error-feedback text-danger" <?php if (empty($errors['telephone_number'] ?? '')) { echo 'hidden'; } ?>><?php echo $errors['telephone_number'] ?? ''; ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title">Parents Information <span class="text-muted">(Optional)</span></h5>      
                </div>
                <div class="card-body">
                    <div class="row gy-3">
                        <div class="col-12 col-md-4">
                            <label for="father_first_name" class="form-label label mt-3">Father's First Name</label>
                            <input type="text" class="form-control" id="father_first_name" name="father_first_name" placeholder="e.g. Juan" value="<?php echo htmlspecialchars($form_data['father_first_name'] ?? ''); ?>">
                            <span class="error-feedback text-danger" <?php if (empty($errors['father_first_name'] ?? '')) { echo 'hidden'; } ?>><?php echo $errors['father_first_name'] ?? ''; ?></span>
                        </div>  
                        <div class="col-12 col-md-4">
                            <label for="father_middle_name" class="form-label label mt-3">Father's Middle Name</label>
                            <input type="text" class="form-control" id="father_middle_name" name="father_middle_name" placeholder="e.g. Pedro" value="<?php echo htmlspecialchars($form_data['father_middle_name'] ?? ''); ?>">
                            <span class="error-feedback text-danger" <?php if (empty($errors['father_middle_name'] ?? '')) { echo 'hidden'; } ?>><?php echo $errors['father_middle_name'] ?? ''; ?></span>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="father_last_name" class="form-label label mt-3">Father's Last Name</label>
                            <input type="text" class="form-control" id="father_last_name" name="father_last_name" placeholder="e.g. Dela Cruz" value="<?php echo htmlspecialchars($form_data['father_last_name'] ?? ''); ?>">
                            <span class="error-feedback text-danger" <?php if (empty($errors['father_last_name'] ?? '')) { echo 'hidden'; } ?>><?php echo $errors['father_last_name'] ?? ''; ?></span>
                        </div>
                    </div>

                    <div class="row gy-3">
                        <div class="col-12 col-md-4">
                            <label for="mother_first_name" class="form-label label mt-3">Mother's First Name</label>
                            <input type="text" class="form-control" id="mother_first_name" name="mother_first_name" placeholder="e.g. Juan" value="<?php echo htmlspecialchars($form_data['mother_first_name'] ?? ''); ?>">
                            <span class="error-feedback text-danger" <?php if (empty($errors['mother_first_name'] ?? '')) { echo 'hidden'; } ?>><?php echo $errors['mother_first_name'] ?? ''; ?></span>
                        </div>  
                        <div class="col-12 col-md-4">
                            <label for="mother_middle_name" class="form-label label mt-3">Mother's Middle Name</label>
                            <input type="text" class="form-control" id="mother_middle_name" name="mother_middle_name" placeholder="e.g. Pedro" value="<?php echo htmlspecialchars($form_data['mother_middle_name'] ?? ''); ?>">
                            <span class="error-feedback text-danger" <?php if (empty($errors['mother_middle_name'] ?? '')) { echo 'hidden'; } ?>><?php echo $errors['mother_middle_name'] ?? ''; ?></span>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="mother_last_name" class="form-label label mt-3">Mother's Last Name</label>
                            <input type="text" class="form-control" id="mother_last_name" name="mother_last_name" placeholder="e.g. Dela Cruz" value="<?php echo htmlspecialchars($form_data['mother_last_name'] ?? ''); ?>">
                            <span class="error-feedback text-danger" <?php if (empty($errors['mother_last_name'] ?? '')) { echo 'hidden'; } ?>><?php echo $errors['mother_last_name'] ?? ''; ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <button type="submit" class="btn btn-primary btn-block mt-5" name="btn-submit">Submit</button>
            </div>
        </form>
    </section>
</div>