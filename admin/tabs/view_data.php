<div class="modal fade modal-xl" id="viewForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content p-5">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">View User Data</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row gy-3">
                    <div class="col-12 col-md-6 col-lg-4">
                        <p><strong>Full Name:</strong><br><span id="view_full_name"></span></p>
                        <p><strong>Date of Birth:</strong><br><span id="view_dob"></span></p>
                        <p><strong>Age:</strong><br><span id="view_age"></span></p>
                        <p><strong>Sex:</strong><br> <span id="view_sex"></span></p>
                        <p><strong>Civil Status:</strong><br> <span id="view_civil_status"></span></p>
                        <p><strong>Place of Birth:</strong><br> <span id="view_pob"></span></p>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <p><strong>Nationality:</strong><br> <span id="view_nationality"></span></p>
                        <p><strong>Religion:</strong><br> <span id="view_religion"></span></p>
                        <p><strong>TIN:</strong><br> <span id="view_tin"></span></p>
                        <p><strong>Phone Number:</strong><br> <span id="view_phone"></span></p>
                        <p><strong>Telephone Number:</strong><br> <span id="view_telephone"></span></p>
                        <p><strong>Email:</strong><br> <span id="view_email"></span></p>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <p><strong>Region:</strong><br> <span id="view_region"></span></p>
                        <p><strong>Province:</strong><br> <span id="view_province"></span></p>
                        <p><strong>Municipality:</strong><br> <span id="view_municipality"></span></p>
                        <p><strong>Barangay:</strong><br> <span id="view_barangay"></span></p>
                        <p><strong>Home Address:</strong><br> <span id="view_address"></span></p>
                        <p><strong>Zip Code:</strong><br> <span id="view_zip"></span></p>
                    </div>
                    <div class="col-12 col-md-6">
                        <p><strong>Father's Name:</strong><br> <span id="view_father"></span></p>
                    </div>
                    <div class="col-12 col-md-6">
                        <p><strong>Mother's Name:</strong><br> <span id="view_mother"></span></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<style>
    #viewForm .modal-content {
        border: none;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        background: #f8f9fa;
    }

    #viewForm .modal-body {
        padding: 2rem;
        font-size: 1.05rem;
    }

    #viewForm .modal-body p {
        margin-bottom: 1.2rem;
        padding: 0.8rem 1.2rem;
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        transition: all 0.2s ease;
    }

    #viewForm .modal-body p:hover {
        transform: translateX(5px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
    }

    #viewForm span {
        color: #6c757d;
        font-weight: 400;
    }

    #viewForm .modal-footer {
        border-top: 2px solid #dee2e6;
        padding: 1.5rem 2rem;
    }
</style>
