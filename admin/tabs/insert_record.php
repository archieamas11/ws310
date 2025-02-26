<style>
    .error-feedback{
        font-size: 0.9rem;
    }
</style>
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
                            <a href="index.php?page=dashboard">
                                DataTable
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
        <!-- <form class="record-form" action="function/function.php?action=add" method="POST"> -->
        <form action="index.php?page=insert" method="POST">
            <div class="card p-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title">Personal Data</h5>
                    <button class="btn btn-outline-secondary" type="button" onclick="fillForm()">Fill All Fields</button>
                </div>
                <div class="card-body">
                    <div class="row gy-3">
                        <div class="col-12 col-md-4">
                            <label for="first_name" class="form-label label mt-3">First Name<span class="text-danger">*</span></label>
                            <input type="text" id="first_name" name="first_name" placeholder="e.g. Juan" value="<?php echo htmlspecialchars($_POST['first_name'] ?? ''); ?>" class="form-control <?php echo (!empty($errors['first_name'])) ? 'is-invalid' : ''; ?>">
                            <span class="error-feedback text-danger"><?php echo $errors['first_name'] ?? ''; ?></span>
                        </div>  
                        <div class="col-12 col-md-4">
                            <label for="middle_name" class="form-label label mt-3">Middle Name</label>
                            <input type="text" id="middle_name" name="middle_name" placeholder="e.g. Pedro" value="<?php echo htmlspecialchars($_POST['middle_name'] ?? ''); ?>" class="form-control <?php echo (!empty($errors['middle_name'])) ? 'is-invalid' : ''; ?>">
                            <span class="error-feedback text-danger"><?php echo $errors['middle_name'] ?? ''; ?></span>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="last_name" class="form-label label mt-3">Last Name <span class="text-danger">*</span></label>
                            <input type="text" id="last_name" name="last_name" placeholder="e.g. Dela Cruz" value="<?php echo htmlspecialchars($_POST['last_name'] ?? ''); ?>" class="form-control <?php echo (!empty($errors['last_name'])) ? 'is-invalid' : ''; ?>">
                            <span class="error-feedback text-danger"><?php echo $errors['last_name'] ?? ''; ?></span>
                        </div>
                    </div>

                    <div class="row gy-3">
                        <div class="col col-md-4">
                            <label for="dob" class="form-label label mt-3">Date of Birth <span class="text-danger">*</span></label>
                            <input type="date" id="dob" name="dob" value="<?php echo htmlspecialchars($_POST['dob'] ?? '') ?>" class="form-control <?php echo (!empty($errors['dob'])) ? 'is-invalid' : ''; ?>">
                            <span class="error-feedback text-danger"><?php echo $errors['dob'] ?? ''; ?></span>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="sex" class="form-label label mt-3">Sex <span class="text-danger">*</span></label>
                            <div style="width: 100%; height: 38px;" class="d-flex align-items-center gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sex" id="sex" value="male" <?php echo ($_POST['sex'] ?? '') === 'male' ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sex" id="sex" value="female" <?php echo ($_POST['sex'] ?? '') === 'female' ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="female">Female</label>
                                </div>
                            </div>
                            <span class="error-feedback text-danger"><?php echo $errors['sex'] ?? ''; ?></span>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="civil_status" class="form-label label mt-3">Civil Status <span class="text-danger">*</span></label>
                            <select aria-label="Default select example" name="civil_status" id="civil_status" class="form-select <?php echo (!empty($errors['civil_status'])) ? 'is-invalid' : ''; ?>">
                                <option value="">Select an option</option>
                                <option value="single" <?php echo ($_POST['civil_status'] ?? '') === 'single' ? 'selected' : ''; ?>>Single</option>
                                <option value="married" <?php echo ($_POST['civil_status'] ?? '') === 'married' ? 'selected' : ''; ?>>Married</option>
                                <option value="widowed" <?php echo ($_POST['civil_status'] ?? '') === 'widowed' ? 'selected' : ''; ?>>Widowed</option>
                                <option value="separated" <?php echo ($_POST['civil_status'] ?? '') === 'separated' ? 'selected' : ''; ?>>Legally Separated</option>
                                <option value="otherStatus" <?php echo ($_POST['civil_status'] ?? '') === 'others' ? 'selected' : ''; ?>>Others</option>
                            </select>
                            <span class="error-feedback text-danger"><?php echo $errors['civil_status'] ?? ''; ?></span>
                        </div>
                    </div>
                    <div class="row gy-3">
                        <div class="col-12 col-md-4">
                            <label for="tin" class="form-label label mt-3">Tax Identification Number</label>
                            <input type="number" id="tin" name="tin" placeholder="e.g. 123-456-7890" value="<?php echo htmlspecialchars($_POST['tin'] ?? ''); ?>" class="form-control <?php echo (!empty($errors['tin'])) ? 'is-invalid' : ''; ?>">
                            <span class="error-feedback text-danger"><?php echo $errors['tin'] ?? ''; ?></span>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="nationality" class="form-label label mt-3">Nationality <span class="text-danger">*</span></label>
                            <input type="text" id="nationality" name="nationality" placeholder="e.g. Filipino" value="<?php echo htmlspecialchars($_POST['nationality'] ?? ''); ?>" class="form-control <?php echo (!empty($errors['nationality'])) ? 'is-invalid' : ''; ?>">
                            <span class="error-feedback text-danger"><?php echo $errors['nationality'] ?? ''; ?></span>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="religion" class="form-label label mt-3">Religion</label>
                            <input type="text" id="religion" name="religion" placeholder="e.g. Roman Catholic" value="<?php echo htmlspecialchars($_POST['religion'] ?? ''); ?>" class="form-control <?php echo (!empty($errors['religion'])) ? 'is-invalid' : ''; ?>">
                            <span class="error-feedback text-danger"><?php echo $errors['religion'] ?? ''; ?></span>
                        </div>
                    </div>

                    <div class="row gy-3">
                        <div class="col-12">
                            <label for="place_of_birth" class="form-label label mt-3">Place of Birth</label>
                            <input type="text" id="place_of_birth" name="place_of_birth" placeholder="e.g. Manila" value="<?php echo htmlspecialchars($_POST['place_of_birth'] ?? ''); ?>" class="form-control <?php echo (!empty($errors['place_of_birth'])) ? 'is-invalid' : ''; ?>">
                            <span class="error-feedback text-danger"><?php echo $errors['place_of_birth'] ?? ''; ?></span>
                        </div>     
                    </div>
                </div>
            </div>
            <div class="card p-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title">Home Address</h5>      
                </div>
                <div class="card-body">
                    <div class="row gy-3">
                        <div class="col-12 col-md-4">
                            <label for="region" class="form-label label mt-3">Region <span class="text-danger">*</span></label>
                            <select aria-label="Default select example" name="region_code" id="region" class="form-select <?php echo (!empty($errors['region_code'])) ? 'is-invalid' : ''; ?>">
                                <option value="">Select an option</option>  
                            </select>
                            <input type="hidden" name="region_name" id="region_name" value="<?php echo htmlspecialchars($_POST['region_name'] ?? ''); ?>">
                            <span class="error-feedback text-danger"><?php echo $errors['region_code'] ?? ''; ?></span>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="province" class="form-label label mt-3">Province <span class="text-danger">*</span></label>
                            <select aria-label="Default select example" name="province_code" id="province" class="form-select <?php echo (!empty($errors['province_code'])) ? 'is-invalid' : ''; ?>">
                                <option value="">Select an option</option>  
                            </select>
                            <input type="hidden" name="province_name" id="province_name" value="<?php echo htmlspecialchars($_POST['province_name'] ?? ''); ?>">
                            <span class="error-feedback text-danger"><?php echo $errors['province_code'] ?? ''; ?></span>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="city" class="form-label label mt-3">City/Municipality<span class="text-danger">*</span></label>
                            <select aria-label="Default select example" name="city_code" id="city" class="form-select <?php echo (!empty($errors['city_code'])) ? 'is-invalid' : ''; ?>">
                                <option value="">Select an option</option>  
                            </select>
                            <input type="hidden" name="city_name" id="city_name" value="<?php echo htmlspecialchars($_POST['city_name'] ?? ''); ?>">
                            <span class="error-feedback text-danger"><?php echo $errors['city_code'] ?? ''; ?></span>
                        </div>
                    </div>

                    <div class="row gy-3">
                        <div class="col-12 col-md-4">
                            <label for="barangay" class="form-label label mt-3">Barangay <span class="text-danger">*</span></label>
                            <select aria-label="Default select example" name="barangay_code" id="barangay" class="form-select <?php echo (!empty($errors['barangay_code'])) ? 'is-invalid' : ''; ?>">
                                <option value="">Select an option</option>  
                            </select>
                            <input type="hidden" name="barangay_name" id="barangay_name" value="<?php echo htmlspecialchars($_POST['barangay_name'] ?? ''); ?>">
                            <span class="error-feedback text-danger"><?php echo $errors['barangay_code'] ?? ''; ?></span>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="zipcode" class="form-label label mt-3">Zip Code <span class="text-danger">*</span></label>
                            <input type="number" id="zipcode" name="zipcode" placeholder="e.g. 1234" value="<?php echo htmlspecialchars($_POST['zipcode'] ?? ''); ?>" class="form-control <?php echo (!empty($errors['zipcode'])) ? 'is-invalid' : ''; ?>">
                            <span class="error-feedback text-danger"><?php echo $errors['zipcode'] ?? ''; ?></span>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="home_address" class="form-label label mt-3">Home Address <span class="text-danger">*</span></label>
                            <input type="text" id="home_address" name="home_address" placeholder="e.g. 123 Main Street" value="<?php echo htmlspecialchars($_POST['home_address'] ?? ''); ?>" class="form-control <?php echo (!empty($errors['home_address'])) ? 'is-invalid' : ''; ?>">
                            <span class="error-feedback text-danger"><?php echo $errors['home_address'] ?? ''; ?></span>
                        </div>
                    </div>

                    <div class="row gy-3">
                        <div class="col-12 col-md-4">
                            <label for="email_address" class="form-label label mt-3">Email Address</label>
                            <input type="email" id="email_address" name="email_address" placeholder="e.g. example@email.com" value="<?php echo htmlspecialchars($_POST['email_address'] ?? ''); ?>" class="form-control <?php echo (!empty($errors['email_address'])) ? 'is-invalid' : ''; ?>">
                            <span class="error-feedback text-danger"><?php echo $errors['email_address'] ?? ''; ?></span>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="contact_number" class="form-label label mt-3">Contact Number <span class="text-danger">*</span></label>
                            <input type="number" id="contact_number" name="contact_number" placeholder="e.g. 09123456789" value="<?php echo htmlspecialchars($_POST['contact_number'] ?? ''); ?>" class="form-control <?php echo (!empty($errors['contact_number'])) ? 'is-invalid' : ''; ?>">
                            <span class="error-feedback text-danger"><?php echo $errors['contact_number'] ?? ''; ?></span>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="telephone_number" class="form-label label mt-3">Telephone Number</label>
                            <input type="tel" id="telephone_number" name="telephone_number" placeholder="e.g. 02-81234567 or 074-4425678" value="<?php echo htmlspecialchars($_POST['telephone_number'] ?? ''); ?>" class="form-control <?php echo (!empty($errors['telephone_number'])) ? 'is-invalid' : ''; ?>">
                            <span class="error-feedback text-danger"><?php echo $errors['telephone_number'] ?? ''; ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card p-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title">Parents Information <span class="text-muted">(Optional)</span></h5>      
                </div>
                <div class="card-body">
                    <div class="row gy-3">
                        <div class="col-12 col-md-4">
                            <label for="father_first_name" class="form-label label mt-3">Father's First Name</label>
                            <input type="text" id="father_first_name" name="father_first_name" placeholder="e.g. Juan" value="<?php echo htmlspecialchars($_POST['father_first_name'] ?? ''); ?>" class="form-control <?php echo (!empty($errors['father_first_name'])) ? 'is-invalid' : ''; ?>">
                            <span class="error-feedback text-danger"><?php echo $errors['father_first_name'] ?? ''; ?></span>
                        </div>  
                        <div class="col-12 col-md-4">
                            <label for="father_middle_name" class="form-label label mt-3">Father's Middle Name</label>
                            <input type="text" id="father_middle_name" name="father_middle_name" placeholder="e.g. Pedro" value="<?php echo htmlspecialchars($_POST['father_middle_name'] ?? ''); ?>" class="form-control <?php echo (!empty($errors['father_middle_name'])) ? 'is-invalid' : ''; ?>">
                            <span class="error-feedback text-danger"><?php echo $errors['father_middle_name'] ?? ''; ?></span>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="father_last_name" class="form-label label mt-3">Father's Last Name</label>
                            <input type="text" id="father_last_name" name="father_last_name" placeholder="e.g. Dela Cruz" value="<?php echo htmlspecialchars($_POST['father_last_name'] ?? ''); ?>" class="form-control <?php echo (!empty($errors['father_last_name'])) ? 'is-invalid' : ''; ?>">
                            <span class="error-feedback text-danger"><?php echo $errors['father_last_name'] ?? ''; ?></span>
                        </div>
                    </div>

                    <div class="row gy-3">
                        <div class="col-12 col-md-4">
                            <label for="mother_first_name" class="form-label label mt-3">Mother's First Name</label>
                            <input type="text" id="mother_first_name" name="mother_first_name" placeholder="e.g. Juan" value="<?php echo htmlspecialchars($_POST['mother_first_name'] ?? ''); ?>" class="form-control <?php echo (!empty($errors['mother_first_name'])) ? 'is-invalid' : ''; ?>">
                            <span class="error-feedback text-danger"><?php echo $errors['mother_first_name'] ?? ''; ?></span>
                        </div>  
                        <div class="col-12 col-md-4">
                            <label for="mother_middle_name" class="form-label label mt-3">Mother's Middle Name</label>
                            <input type="text" id="mother_middle_name" name="mother_middle_name" placeholder="e.g. Pedro" value="<?php echo htmlspecialchars($_POST['mother_middle_name'] ?? ''); ?>" class="form-control <?php echo (!empty($errors['mother_middle_name'])) ? 'is-invalid' : ''; ?>">
                            <span class="error-feedback text-danger"><?php echo $errors['mother_middle_name'] ?? ''; ?></span>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="mother_last_name" class="form-label label mt-3">Mother's Last Name</label>
                            <input type="text" id="mother_last_name" name="mother_last_name" placeholder="e.g. Dela Cruz" value="<?php echo htmlspecialchars($_POST['mother_last_name'] ?? ''); ?>" class="form-control <?php echo (!empty($errors['mother_last_name'])) ? 'is-invalid' : ''; ?>">
                            <span class="error-feedback text-danger"><?php echo $errors['mother_last_name'] ?? ''; ?></span>
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