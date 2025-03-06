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
                    $result = getData($mysqli, "tbl_users");
                    if ($result) : ?>
                    <thead>
                        <tr>
                            <th>📝 ID#</th>
                            <th>👨‍👩‍👧‍👦 Name</th>
                            <th>🎂 Date of Birth</th>
                            <th>📆 Age</th>
                            <th>🚹 Sex</th>
                            <th>🏠 Home Address</th>
                            <th><img width="20" height="20" src="https://img.icons8.com/3d-fluency/94/contacts.png" alt="contacts"/> Contacts</th>
                            <th>🔧 Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($result as $row): ?>
                            <?php
                            $nametrim     = str_replace(",", "</br>", $row["user_full_name"]);
                            $birthtrim    = str_replace(",", "</br>", $row["date_of_birth"]);
                            $current_year = date("Y");
                            $birth_year   = date("Y", strtotime($row["date_of_birth"]));
                            $age          = $current_year - $birth_year;
                            $home_address = sprintf(
                                '%s, %s,</br> %s, %s,</br> %s',
                                $row["region"],
                                $row["province"],
                                $row["municipality"],
                                $row["barangay"],
                                $row["zip_code"]
                            );
                            $contact_information = sprintf(
                                '%s,</br> %s,</br> %s',
                                $row["phone_number"],
                                $row["email_address"],
                                $row["telephone_number"]
                            );
                            ?>

                            <tr>
                                <td style="text-align: center;"><?php echo $row["user_id"]; ?></td>
                                <td><?php echo ucwords($nametrim); ?></td>
                                <td style="text-align: center;"><?php echo $birthtrim; ?></td>
                                <td style="text-align: center;"><?php echo $age; ?></td>
                                <td style="text-align: center;"><?php echo ucwords($row["sex"]); ?></td>
                                <td><?php echo ucwords($home_address); ?></td>
                                <td>
                                    <?php
                                    $contacts_html = '';

                                    if (!empty($row["phone_number"])) {
                                        $contacts_html .= '<div class="contact-item"><i class="fa-solid fa-square-phone"></i> ' . $row["phone_number"] . '</div>';
                                    }

                                    if (!empty($row["email_address"])) {
                                        $contacts_html .= '<div class="contact-item"><i class="fa-solid fa-envelope-open-text"></i> ' . $row["email_address"] . '</div>';
                                    }

                                    if (!empty($row["telephone_number"])) {
                                        $contacts_html .= '<div class="contact-item"><i class="fa-solid fa-tty"></i> ' . $row["telephone_number"] . '</div>';
                                    }

                                    echo $contacts_html;
                                    ?>
                                </td>
                                <td style="text-align: center;">
                                    <div class="btn-group-vertical me-1 mb-1 dropstart">
                                        <button type="button" class="btn edit-btn" data-bs-toggle="modal"
                                            data-bs-target="#inlineForm"
                                            data-id="<?php echo $row['user_id']; ?>" data-toggle="tooltip" data-placement="top" title="Edit data">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <a href="#" class="btn icon delete-btn" data-bs-toggle="modal" 
                                            data-bs-target="#deleteModal" 
                                            data-userid="<?php echo $row['user_id']; ?>" title="Delete data">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </a>

                                        <button type="button" class="btn view-btn" data-bs-toggle="modal"
                                            data-bs-target="#viewForm" 
                                            data-id="<?php echo $row['user_id']; ?>"
                                            onclick="viewData(<?php echo $row['user_id']; ?>)"
                                            data-toggle="tooltip" data-placement="top" title="View data">
                                            <i class="fa-regular fa-circle-question"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </section>
</div>