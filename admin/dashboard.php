<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>DataTable</h3>
                <p class="text-subtitle text-muted">A sortable, searchable, paginated table without
                    dependencies thanks to simple-datatables.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">DataTable</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5 class="card-title">
                    Simple Datatable
                </h5>
                <button type="submit" class="btn btn-primary ms-1">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">+ Add New Record</span>
                </button>
            </div>
            <div class="card-body">
                <table id="table1" class="table table-striped">
                    <?php
                require_once "../config/database.php";
                $sql    = "SELECT * FROM tbl_users";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0): ?>
                    <thead>
                        <tr>
                            <th>ID #</th>
                            <th>Name</th>
                            <th>Date of Birth</th>
                            <th>Age</th>
                            <th>Sex</th>
                            <th>Home Address</th>
                            <th>Contacts</th>
                            <th>Action</th>
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
        $contacts_html .= '<i class="fas fa-phone mr-2">  </i>' . $row["phone_number"];
        $contacts_html .= '</div>';
    }
    
    if (!empty($row["email_address"])) {
        $contacts_html .= '<div class="contact-item">';
        $contacts_html .= '<i class="fas fa-envelope mr-2"></i>' . $row["email_address"];
        $contacts_html .= '</div>';
    }
    
    if (!empty($row["telephone_number"])) {
        $contacts_html .= '<div class="contact-item">';
        $contacts_html .= '<i class="fas fa-phone-alt mr-2"></i>' . $row["telephone_number"];
        $contacts_html .= '</div>';
    }
    
    echo $contacts_html;
    ?>
                            </td>
                            <td>
                                <div class="btn-group me-1 mb-1 dropstart">
                                    <!-- Edit Button -->
                                    <form action="index.php?id=<?php echo $row['user_id']; ?>&page=edit_record"
                                        method="POST">
                                        <button type="submit" class="btn edit-btn">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </form>

                                    <!-- Delete Button -->
                                    <form action="delete_user.php" method="POST"
                                        onsubmit="return confirm('Are you sure?');">
                                        <input type="hidden" name="user_id" value="<?php echo $row["user_id"]; ?>">
                                        <button type="submit" class="btn icon delete-btn"><i
                                                class="fas fa-trash"></i></button>
                                    </form>

                                    <!-- View Button -->
                                    <form action="">
                                        <button type="button" class="btn edit-btn" data-bs-toggle="modal"
                                            data-bs-target="#inlineForm" data-id="<?php echo $row['user_id']; ?>">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </form>
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