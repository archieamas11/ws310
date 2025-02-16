<!-- Dashboard for the admin user -->

<section class="section">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>User Table</h3>
            <div class="buttons">
                <a href="index.php?page=insert"><button class="btn btn-primary rounded shadow">+ Add New Record</button></a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="table1">
                    <?php
                        $result = mysqli_query($mysqli, "SELECT * FROM tbl_users");
                        if ($result):
                    ?>
                    <thead>
                            <th>ID #</th>
                            <th>Name</th>
                            <th>Date of Birth</th>
                            <th>Age</th>
                            <th>Sex</th>
                            <th>Home Address</th>
                            <th>Contacts</th>
                            <th>Action</th>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_array($result)):
                                $nametrim     = str_replace(',', '</br>', $row['user_full_name']);
                                $birthtrim    = str_replace(',', '</br>', $row['date_of_birth']);
                                $current_year = date('Y');
                                $birth_year   = date('Y', strtotime($row['date_of_birth']));
                                $age          = $current_year - $birth_year;
                                $home_address = $row['region'] . ', ' . $row['province'] . ',</br> ' . $row['municipality'] . ', ' . $row['barangay'] . ',</br> ' . $row['zip_code'];
                                $contact_information = $row['phone_number'] . ',</br> ' . $row['email_address'] . ',</br> ' . $row['telephone_number'];
                            ?>
			                        <tr>
		                                <td><?php echo $row['user_id']; ?></td>
			                            <td><?php echo ucwords($nametrim); ?></td>
		                                <td><?php echo $birthtrim; ?></td>
		                                <td><?php echo $age; ?></td>
		                                <td><?php echo ucwords($row['sex']); ?></td>
			                            <td><?php echo ucwords($home_address); ?></td>
			                            <td><?php echo ucwords($contact_information); ?></td>
			                            <td>
		                                <div class="buttons">
                                            <a href="#" class="btn icon"><i class="bi bi-pencil-square"></i></a>
                                            <a href="#" class="btn icon"><i class="bi bi-trash3"></i></a>
                                            <a href="#" class="btn icon"><i class="bi bi-eye"></i></a>
		                                </div>
			                            </td>
			                        </tr>
			                        <?php endwhile; ?>
                    </tbody>
                    <?php endif; ?>
                </table>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
                    role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Contact Person</h5>
                            <button type="button" class="close" data-bs-dismiss="modal"
                                aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <div class="modal-body" style="padding: 20px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<script>
// Get the modal
const modal = document.getElementById('exampleModalCenter');
// Add event listener for modal show
modal.addEventListener('show.bs.modal', function (event) {
    // Get the button that triggered the modal
    const button = event.relatedTarget;

    // Get the data attributes for contact info
    const name = button.getAttribute('data-name');
    const contactName = button.getAttribute('data-contact-name');
    const contactPhone = button.getAttribute('data-contact-phone');
    const contactEmail = button.getAttribute('data-contact-email');

    // Find the modal elements to display contact info
    const modalTitle = modal.querySelector('.modal-title');
    const modalBody = modal.querySelector('.modal-body');

    // Update modal content with the contact information
    modalTitle.textContent = `Contact Person for ${name}`;
    modalBody.innerHTML = `
        <div class="d-flex align-items-center mb-2">
            <i class="bi bi-person-circle me-2"></i>
            <span>${contactName}</span>
        </div>
        <div class="d-flex align-items-center mb-2">
            <i class="bi bi-telephone-fill me-2"></i>
            <span>${contactPhone}</span>
        </div>
        <div class="d-flex align-items-center">
            <i class="bi bi-envelope-fill me-2"></i>
            <span>${contactEmail}</span>
        </div>
    `;
});
</script>
