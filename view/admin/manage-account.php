            <?php
            // var_dump($getAcc);
            require_once("././model/accountManageModel.php");
            if(isset($_POST["save"])){

<<<<<<< Updated upstream
                $newAcc = new AccountManageModel();
                // sanitize
                $newAcc->username = htmlentities($_POST["uname"]);
                $newAcc->password = htmlentities($_POST["pw"]);
                $newAcc->firstName = htmlentities($_POST["fname"]);
                $newAcc->middleName = htmlentities($_POST["mname"]);
                $newAcc->lastName = htmlentities($_POST["lname"]);
                $newAcc->nameExt = htmlentities($_POST["nameExt"]);
                $newAcc->role = htmlentities($_POST["role"]);

                if($newAcc->addAccount()){
                    header('location: manage-account.php');
                }else{
                    echo'An error occured while adding in the database.';
                }
                
            }
            ?>
            <script>
                $('.js-example-basic-single').select2({
                    placeholder: 'Select An Option'
                    dropdownParent: '#addAccountModal'
                });
            </script>
            <!-- Modal -->
            <div class="modal fade" id="addAccountModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Admin Account Form</h1>
=======
            <main class="content px-3 py-2">
                <div class="container-fluid">
                    <div class="row text-start py-3 px-2">
                        <div class="col-md-8 col-12 align-items-center d-flex justify-content-start">
                            <div class="card-header">
                                <h2>Account Management</h2>
                            </div>
                        </div>
                        <div class="col-md-4 col-12 align-items-center d-flex justify-content-end">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#addAccountModal">
                                <i class="fa-solid fa-circle-plus"></i> Account
                            </button>
                        </div>
                        <div class="col-md-12 col-12 align-items-center py-4 px-0 text-center d-flex justify-content-center"
                            style="width: 100%;">
                            <div class="table-responsive">
                                <table class="table caption-top table-striped table-hover" id="user"
                                    style="width: 100%;">
                                    <thead class="table-dark">
                                        <th scope="col">ID</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Password</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Photo</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Date Added</th>
                                        <th scope="col">Action</th>
                                    </thead>
                                    <tbody class="table-group-divider" id="">
                                        <?php
                                            if ($getAcc) {
                                                foreach ($getAcc as $item) {
                                         ?>
                                        <tr>
                                            <td id="accID" style="width: 40px;"><?= $item['id'] ?></td>
                                            <td style="max-width: 70px; overflow: hidden; text-overflow: ellipsis;"
                                                title="<?= $item['username'] ?>">
                                                <?= strlen($item['username']) > 10 ? substr($item['username'], 0, 10) . '...' : $item['username'] ?>
                                            </td>
                                            <td style="max-width: 80px; overflow: hidden; text-overflow: ellipsis;"
                                                title="<?= $item['password'] ?>">
                                                <?= strlen($item['password']) > 15 ? substr($item['password'], 0, 15) . '...' : $item['password'] ?>
                                            </td>
                                            <td style="max-width: 60px; overflow: hidden; text-overflow: ellipsis;"
                                                title="<?= $item['firstName']." ".$item['middleName']." ".$item['lastName']." ".$item['nameExt'] ?>">
                                                <?= strlen($item['firstName']." ".$item['middleName']." ".$item['lastName']." ".$item['nameExt']) > 15 ?
                                                substr($item['firstName']." ".$item['middleName']." ".$item['lastName']." ".$item['nameExt'], 0, 15) . '...' :
                                                $item['firstName']." ".$item['middleName']." ".$item['lastName']." ".$item['nameExt'] ?>
                                            </td>
                                            <td><?= $item['role'] ?></td>
                                            <td><img src="uploads/account/<?= $item['accountPhoto'] ?>"
                                                    style="max-height: 60px; max-width: 60px;"></td>
                                            <td>
                                                <?php
                                                    if ($item['status'] == 0) {
                                                        $item['status'] = 'active';
                                                    } else if ($item['status'] == 1) {
                                                        $item['status'] = 'inactive';
                                                    }
                                                ?>
                                                <span
                                                    class="badge text-bg-<?= $item['status'] == 'active' ? 'success' : 'danger' ?>">
                                                    <?= $item['status'] == 'active' ? 'Active' : 'Inactive' ?>
                                                </span>
                                            </td>
                                            <td style="width: 80px !important;"><?= $item['createdAt'] ?></td>
                                            <td>
                                                <div class="row">
                                                    <div class="col">
                                                        <button type="button"
                                                            class="btn btn-info btn-cirlce btn-sm view-btn"
                                                            data-bs-toggle="modal" data-bs-target="">
                                                            <i class="fa-solid fa-eye" style="padding: 0;"></i>
                                                            <!-- view -->
                                                        </button>
                                                        <button type="button"
                                                            class="btn btn-success btn-cirlce btn-sm edit-btn"
                                                            data-id="<?= $item['id']; ?>" data-bs-toggle="modal"
                                                            data-bs-target="#editAccountModal">
                                                            <i class="fa-solid fa-pen-to-square"
                                                                style="padding: 0;"></i>
                                                            <!-- edit -->
                                                        </button>

                                                        <button type="button"
                                                            class="btn btn-danger btn-cirlce btn-sm delete-btn"
                                                            data-id="<?= $item['id'] ?>">
                                                            <i class="fa-solid fa-trash" style="padding: 0;"></i>
                                                            <!-- delete -->
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                                }   
                                            } else {
                                        ?>
                                        <tr>
                                            <td colspan="9" class="text-center">No data available</td>
                                        </tr>
                                        <?php
                                            }
                                            ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <script src="../../node_modules/jquery/dist/jquery.min.js"></script>

            <!-- Add Modal -->
            <div class="modal fade" id="addAccountModal" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <?= include('message.php'); ?>
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Account</h1>
>>>>>>> Stashed changes
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post" action="" id="addStudent">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="" class="form-label">Username</label>
                                    <input type="text" name="uname" class="form-control" placeholder="e.g. admin?">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Password</label>
                                    <input type="password" name="pw" class="form-control" placeholder="********">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">First name</label>
                                    <input type="text" name="fname" class="form-control" placeholder="e.g. Sanicare">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Middle name</label>
                                    <input type="text" name="mname" class="form-control" placeholder="e.g. Plastic">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Last name</label>
                                    <input type="text" name="lname" class="form-control" placeholder="e.g. Stem">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Name Ext.</label>
                                    <input type="text" name="nameExt" class="form-control" placeholder="e.g. Sr./Jr.">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Role</label>
                                    <select class="form-control js-example-basic-single" name="role" id="role" style="width: 100%;">
                                        <option value="">Select Role</option>
                                        <option value="admin">Admin</option>
                                        <option value="super_admin">Super Admin</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Insert your photo</label>
                                    <input class="form-control" type="file" id="formFile">
                                </div>
                            </div>
                        
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="save" class="btn btn-primary">Save Account</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
<<<<<<< Updated upstream
            <main class="content px-3 py-2">
                <div class="container-fluid">
                    <div class="row text-start py-3 px-2">
                        <div class="col-md-8 col-12 align-items-center d-flex justify-content-start">
                            <div class="card-header">
                                <h2>Account Management</h2>
                            </div>
                        </div>
                        <div class="col-md-4 col-12 align-items-center d-flex justify-content-center">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addAccountModal">
                                Add Account
                            </button>
                        </div>
                        <div class="col-md-12 col-12 align-items-center py-4 px-0 text-center d-flex justify-content-center" 
                        style="width: 100%; height: 490px;">
                            <div class="table-responsive">
                                <table class="table caption-top table-striped table-hover" id="user">
                                    <caption>List of Admin Users</caption>
                                    <thead class="table-dark">
                                        <th scope="col">ID</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Password</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Photo</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Date Added</th>
                                        <th scope="col">Action</th>
                                    </thead>
                                    <tbody class="table-group-divider" id="">
                                        <?php
                                        if($getAcc) {
                                            foreach($getAcc as $item) {
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?= $item['id'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $item['username'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $item['password'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $item['firstName']." ".$item['middleName']." ".$item['lastName']." ".$item['nameExt']  ?>
                                                    </td>
                                                    <td>
                                                        <?= $item['role'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $item['accountPhoto'] ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if($item['status'] == 0) {
                                                            $item['status'] = "Active";
                                                        } else {
                                                            $item["status"] = "Inactive";
                                                        }
                                                        ?>
                                                        <?= $item['status'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $item['createdAt'] ?>
                                                    </td>
                                                    <td>
                                                        action
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
=======
            <!-- Edit Modal -->
            <!-- <div class="modal fade" id="editAccountModal" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Account</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="editAccountForm" action="/edit-account" method="post">
                            <div class="modal-body">
                                <input type="hidden" id="id" name="id">
                                <div class="mb-3">
                                    <label for="edit_uname">Username</label>
                                    <input type="text" id="edit_uname" name="uname" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="edit_pw">Password</label>
                                    <input type="password" id="edit_pw" name="pw" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="edit_fname">First Name</label>
                                    <input type="text" id="edit_fname" name="fname" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="edit_mname">Middle Name</label>
                                    <input type="text" id="edit_mname" name="mname" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="edit_lname">Last Name</label>
                                    <input type="text" id="edit_lname" name="lname" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="edit_nameExt">Name Extension</label>
                                    <input type="text" id="edit_nameExt" name="nameExt" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="edit_role">Role</label>
                                    <select id="edit_role" name="role" class="form-control js-example-basic-single">
                                        <option value="admin">Admin</option>
                                        <option value="super_admin">Super Admin</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_accountPhoto">Account Photo</label>
                                    <div class="current-photo mb-2">
                                        <img id="currentPhoto" src="uploads/account/<?= $item['accountPhoto']; ?>"
                                            style="max-height: 60px; max-width: 60px;">
                                    </div>
                                    <input type="file" id="edit_accountPhoto" name="accountPhoto[]"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> -->
            <div class="modal fade" id="editAccountModal" tabindex="-1" aria-labelledby="editAccountModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="editAccountForm" method="post" enctype="multipart/form-data">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editAccountModalLabel">Edit Account</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <?php
                                
                                ?>
                                <!-- <input type="hidden" id="editId" name="id"> -->
                                <div class="mb-3">
                                    <label for="editUname" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="editUname" name="uname" required>
                                </div>
                                <div class="mb-3">
                                    <label for="editPw" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="editPw" name="pw" required>
                                </div>
                                <div class="mb-3">
                                    <label for="editFname" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="editFname" name="fname" required>
                                </div>
                                <div class="mb-3">
                                    <label for="editMname" class="form-label">Middle Name</label>
                                    <input type="text" class="form-control" id="editMname" name="mname">
                                </div>
                                <div class="mb-3">
                                    <label for="editLname" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="editLname" name="lname" required>
                                </div>
                                <div class="mb-3">
                                    <label for="editNameExt" class="form-label">Name Extension</label>
                                    <input type="text" class="form-control" id="editNameExt" name="nameExt">
                                </div>
                                <div class="mb-3">
                                    <label for="editRole" class="form-label">Role</label>
                                    <input type="text" class="form-control" id="editRole" name="role" required>
                                </div>
                                <div class="mb-3">
                                    <label for="editAccountPhoto" class="form-label">Account Photo</label>
                                    <input type="file" class="form-control" id="editAccountPhoto" name="accountPhoto[]"
                                        accept="image/*">
                                </div>
                                <input type="hidden" name="type" value="save">
>>>>>>> Stashed changes
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
<<<<<<< Updated upstream
            </main>
=======
            </div>

            <script>
$(document).ready(function() {
    $('#addAccountModal .js-example-basic-single').select2({
        placeholder: 'Select An Option',
        dropdownParent: $('#addAccountModal')
    });

    // Initialize Select2 for Edit Account Modal
    $('#editAccountModal .js-example-basic-single').select2({
        placeholder: 'Select An Option',
        dropdownParent: $('#editAccountModal')
    });
    var table = $('#user').DataTable({
        // dom: 'Bfrtip',
        layout: {
            topStart: {
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            }
        }
    });

    $('#addAccount').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        formData.append("type", "add"); // Add the additional field
        console.log(formData);
        $.ajax({
            type: 'POST',
            url: '/add-account',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response);
                $("#uname").val("");
                $("#pw").val("");
                $("#fname").val("");
                $("#mname").val("");
                $("#lname").val("");
                $("#nameExt").val("");
                $("#role").val("");
                $("#accountPhoto").val("");

                $('#addAccountModal').modal('hide');
            },
            error: function(error) {
                console.log(error);
                alert('Error submitting form');
            }
        });
    });

    // $('#editAccountForm').on('submit', function(e) {
    //     e.preventDefault();
    //     var formData = new FormData($('#editAccountForm')[0]);
    //     formData.append("type", "save"); // Add the additional field
    //     console.log(formData);
    //     $.ajax({
    //         type: 'POST',
    //         url: '/edit-account',
    //         data: formData,
    //         contentType: false,
    //         processData: false,
    //         success: function(response) {
    //             console.log(response);
    //             alert('Updated successfully');
    //             // location.reload(); //refresh page
    //         },
    //         error: function(error) {
    //             console.log(error);
    //             alert('Error submitting form');
    //         }
    //     });
    // });
    $('.edit-btn').click(function(e) {
        e.preventDefault();
        var id = $(this).closest('tr').find('#accID').text();
        console.log(id);

        $.ajax {}
    });
    // $('.edit-btn').click(function() {
    //     // Fetch data attributes from the clicked edit button
    //     var id = $(this).data('id');
    //     var username = $(this).data('username');
    //     var password = $(this).data('password');
    //     var firstname = $(this).data('firstname');
    //     var middlename = $(this).data('middlename');
    //     var lastname = $(this).data('lastname');
    //     var nameext = $(this).data('nameext');
    //     var role = $(this).data('role');
    //     var accountphoto = $(this).data('accountphoto');

    //     var currentPhoto = "uploads/account/" + accountPhoto;
    //     $('#currentPhoto').attr('src', currentPhoto);
    //     // Populate the edit modal fields with fetched data
    //     $('#id').val(id);
    //     $('#edit_uname').val(username);
    //     $('#edit_pw').val(password);
    //     $('#edit_fname').val(firstname);
    //     $('#edit_mname').val(middlename);
    //     $('#edit_lname').val(lastname);
    //     $('#edit_nameExt').val(nameext);
    //     $('#edit_role').val(role).trigger('change'); // Trigger change to update Select2
    //     // You might need to handle the account photo display separately
    // });

    $('.delete-btn').click(function(e) {
        e.preventDefault();
        var id = $(this).data('id');

        if (confirm('Are you sure you want to delete this account?')) {
            var formData = new FormData();
            formData.append('id', id);
            formData.append('type', 'delete');
            $.ajax({
                url: 'del-account',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log(response);
                    var res = JSON.parse(response);
                    if (res.success) {
                        alert('Account deleted successfully');
                        location.reload(); // Reload the page to reflect changes
                    } else {
                        alert('Failed to delete account: ' + res
                            .message); // Log the specific error message
                    }
                },
                error: function() {
                    alert('Error occurred while deleting the account');
                }
            });
        }
    });

});
            </script>
>>>>>>> Stashed changes