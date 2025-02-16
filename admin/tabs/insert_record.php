<!-- Dashboard for the admin user -->

<section class="section">
    <div class="card">
        <!-- <div class="card-header d-flex justify-content-between align-items-center">

        </div> -->
        <div class="card-body">
            <?php $count = 0; ?>
            <form class="record-form" action="function/function.php?count=<?php echo $count; ?>& action=add"
                method="POST">
                <div class="row g-2">
                    <!-- Personal Information Section -->
                    <div class="col-12">
                        <h6 class="text-muted"><i class="bi bi-person-fill me-2 fs-5"></i> Deceased Information</h6>
                        <hr>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <label for="deceased-firstname" class="form-label label mt-3">First Name <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="deceased-firstname" name="deceased-firstname"
                            required placeholder="e.g. Juan">
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="deceased-middlename" class="form-label label mt-3">Middle Name</label>
                        <input type="text" class="form-control" id="deceased-middlename" name="deceased-middlename"
                            placeholder="e.g. Dela">
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="deceased-lastname" class="form-label label mt-3">Last Name <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="deceased-lastname" name="deceased-lastname" required
                            placeholder="e.g. Cruz">
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <label for="deceased-birthday" class="form-label label mt-3">Date of Birth <span
                                class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="deceased-birthday" name="deceased-birthday"
                            required>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="deceased-deathday" class="form-label label mt-3">Date of Death <span
                                class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="deceased-deathday" name="deceased-deathday"
                            required>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="deceased-gender" class="form-label label mt-3">Gender <span
                                class="text-danger">*</span></label>
                        <select name="deceased-gender" id="deceased-gender" class="form-select" required>
                            <option value="" hidden>Select gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="deceased-agegroup" class="form-label label mt-3">Age Group <span
                                class="text-danger">*</span></label>
                        <select name="deceased-agegroup" id="deceased-agegroup" class="form-select" required>
                            <option value="" hidden>Select age group</option>
                            <option value="Child">Child (0-12)</option>
                            <option value="Teen">Teen (13-19)</option>
                            <option value="Adults">Adults (20-59)</option>
                            <option value="Seniors">Seniors (60+)</option>
                        </select>
                    </div>


                    <!-- Contact Information Section -->
                    <div class="col-md-4 col-sm-12">
                        <label for="deceased-contactname" class="form-label label mt-3">Contact Person <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="deceased-contactname" name="deceased-contactname"
                            required placeholder="Full Name">
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="deceased-contactno" class="form-label label mt-3">Contact Number</label>
                        <input type="tel" class="form-control" id="deceased-contactno" name="deceased-contactno"
                            placeholder="09xxxxxxxxx">
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="deceased-contactemail" class="form-label label mt-3">Email Address</label>
                        <input type="email" class="form-control" id="deceased-contactemail" name="deceased-contactemail"
                            placeholder="example@gmail.com">
                    </div>
                                        <div class="col-md-4 col-sm-12">
                        <label for="deceased-contactemail" class="form-label label mt-3">Email Address</label>
                        <input type="email" class="form-control" id="deceased-contactemail" name="deceased-contactemail"
                            placeholder="example@gmail.com">
                    </div>

                    <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-primary" name="btn-submit">Save Record</button>
                </div>


                </div>


            </form>
        </div>
    </div>
</section>