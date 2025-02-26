<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Table</h3>
                <p class="text-subtitle text-muted">
                    A table of all users with their respective information.
                </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.php">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            DataTable
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title">Users Datatable</h5>
                <a href="index.php?page=insert" class="btn btn-primary ms-1">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-sm-block">+ Add New Record</span>
                </a>
            </div>
            <div class="card-body">
                <table id="table1" class="table table-striped">
                    <?php
                    $result = mysqli_query($mysqli, "SELECT * FROM tbl_users");
                    if ($result) :
                    ?>
                    <thead>
                        <tr>
                            <th>📝 ID</th>
                            <th>👨‍👩‍👧‍👦 Name</th>
                            <th>🎂 Date of Birth</th>
                            <th>📆 Age</th>
                            <th>🚹 Sex</th>
                            <th>🏠 Home Address</th>
                            <th>📞 Contacts</th>
                            <th>🔧 Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_array($result)):
                            $nametrim     = str_replace(",", "</br>", $row["user_full_name"]);
                            $birthtrim    = str_replace(",", "</br>", $row["date_of_birth"]);
                            $current_year = date("Y");
                            $birth_year   = date("Y", strtotime($row["date_of_birth"]));
                            $age          = $current_year - $birth_year;
                            $home_address =
                                $row["region"] .
                                ", " .
                                $row["province"] .
                                ",</br> " .
                                $row["municipality"] .
                                ", " .
                                $row["barangay"] .
                                ",</br> " .
                                $row["zip_code"];
                            $contact_information =
                                $row["phone_number"] .
                                ",</br> " .
                                $row["email_address"] .
                                ",</br> " .
                                $row["telephone_number"];
                        ?>
                        <tr>
                            <td><?php echo $row["user_id"]; ?></td>
                            <td><?php echo ucwords($nametrim); ?></td>
                            <td><?php echo $birthtrim; ?></td>
                            <td><?php echo $age; ?></td>
                            <td><?php echo ucwords($row["sex"]); ?></td>
                            <td><?php echo ucwords($home_address); ?></td>
                            <td>
                                <?php
                                // Format contact information with icons
                                $contacts_html = '';
                                
                                if (!empty($row["phone_number"])) {
                                    $contacts_html .= '<div class="contact-item">';
                                    $contacts_html .= '<i class="fa-solid fa-phone-volume"></i>' . $row["phone_number"];
                                    $contacts_html .= '</div>';
                                }
                                
                                if (!empty($row["email_address"])) {
                                    $contacts_html .= '<div class="contact-item">';
                                    $contacts_html .= '<i class="fa-solid fa-envelope-open-text"></i>' . $row["email_address"];
                                    $contacts_html .= '</div>';
                                }
                                
                                if (!empty($row["telephone_number"])) {
                                    $contacts_html .= '<div class="contact-item">';
                                    $contacts_html .= '<i class="fa-solid fa-voicemail"></i>' . $row["telephone_number"];
                                    $contacts_html .= '</div>';
                                }
                                
                                echo $contacts_html;
                                ?>
                            </td>
                            <td>
                                <div class="btn-group me-1 mb-1 dropstart">
                                    <!-- Edit Button -->
                                    <!-- <form action="index.php?id=<?php echo $row['user_id']; ?>&page=edit_record"
                                        method="POST">
                                        <button type="submit" class="btn edit-btn">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </form> -->

                                    <button type="button" class="btn edit-btn" data-bs-toggle="modal"
                                        data-bs-target="#inlineForm"
                                        data-id="<?php echo $row['user_id']; ?>">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <!-- Delete Button -->
                                    <a href="function/function.php?user_id=<?php echo $row['user_id']; ?>&action=delete" 
                                        class="btn icon delete-btn" 
                                        onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i>
                                    </a>

                                    <!-- View Button -->
                                    <button type="button" class="btn view-btn" data-bs-toggle="modal"
                                        data-bs-target="#viewForm" 
                                        data-id="<?php echo $row['user_id']; ?>"
                                        onclick="viewData(<?php echo $row['user_id']; ?>)">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </section>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get all view buttons
    const viewButtons = document.querySelectorAll('.view-btn');
    
    viewButtons.forEach(button => {
        button.addEventListener('click', function() {
            const userId = this.getAttribute('data-id');
            
            // Make AJAX request to get user data
            fetch('function/function.php?action=get', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'user_id=' + encodeURIComponent(userId)
            })
            .then(response => response.json())
            .then(data => {
                // Populate modal with data
                document.getElementById('view_full_name').textContent = data.user_full_name ? data.user_full_name : 'N/A';
                document.getElementById('view_dob').textContent = data.date_of_birth ? data.date_of_birth : 'N/A';
                const dob = new Date(data.date_of_birth);
                const age = new Date().getFullYear() - dob.getFullYear();
                document.getElementById('view_age').textContent = age ? age : 'N/A';
                document.getElementById('view_sex').textContent = data.sex ? data.sex : 'N/A';
                document.getElementById('view_civil_status').textContent = data.civil_status ? data.civil_status : 'N/A';
                document.getElementById('view_pob').textContent = data.place_of_birth ? data.place_of_birth : 'N/A';
                document.getElementById('view_nationality').textContent = data.nationality ? data.nationality : 'N/A';
                document.getElementById('view_religion').textContent = data.religion ? data.religion : 'N/A';
                document.getElementById('view_tin').textContent = data.tax_identification_number ? data.tax_identification_number : 'N/A';
                document.getElementById('view_phone').textContent = data.phone_number ? data.phone_number : 'N/A';
                document.getElementById('view_telephone').textContent = data.telephone_number ? data.telephone_number : 'N/A';
                document.getElementById('view_email').textContent = data.email_address ? data.email_address : 'N/A';
                document.getElementById('view_region').textContent = data.region ? data.region : 'N/A';
                document.getElementById('view_province').textContent = data.province ? data.province : 'N/A';
                document.getElementById('view_municipality').textContent = data.municipality ? data.municipality : 'N/A';
                document.getElementById('view_barangay').textContent = data.barangay ? data.barangay : 'N/A';
                document.getElementById('view_address').textContent = data.home_address ? data.home_address : 'N/A';
                document.getElementById('view_zip').textContent = data.zip_code ? data.zip_code : 'N/A';
                document.getElementById('view_father').textContent = data.fathers_full_name ? data.fathers_full_name : 'N/A';
                document.getElementById('view_mother').textContent = data.mothers_full_name ? data.mothers_full_name : 'N/A';
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to load user data');
            });
        });
    });
});
</script>

<style>
    .contact-item {
        display: flex;
        align-items: center;
        margin-bottom: 5px;
        gap: .5rem;
    }

    .contact-item i {
        font-size: 16px;
        width: 20px;
        color: #666;
    }

    @media (max-width: 768px) {
        .contact-item {
            font-size: 14px;
        }
        
        .contact-item i {
            font-size: 14px;
        }
    }
</style>