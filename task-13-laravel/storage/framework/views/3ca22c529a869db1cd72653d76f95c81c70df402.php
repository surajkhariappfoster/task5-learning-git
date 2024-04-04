<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <title>Laravel CRUD</title>
</head>
<body class="body">
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid d-flex justify-content-center">
    <a class="navbar-brand" href="<?php echo e(route('users.index')); ?>">All Users</a>
  </div>
</nav>

<div class="container">
  
<div class="row">
        <div class="mt-2">
            <!-- Button to trigger modal -->
            <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addUserModal">Add User</button>
        </div>
    </div>
    <table class="table table-hover mt-2 ">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($user->id); ?></td>
                <td><?php echo e($user->name); ?></td>
                <td><?php echo e($user->email); ?></td>
                
                <td>
                    <button type="submit" class="btn btn-danger" onclick="deleteUser(<?php echo e($user->id); ?>)">Delete</button>


                    <!-- Edit button -->
<button type="button" class="btn btn-dark" onclick="openEditModal('<?php echo e($user->id); ?>')">Edit</button>

<!-- Modal for editing user -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Form for editing user -->
        <form id="editUserForm" method="POST" action="<?php echo e(route('users.update', ['id' => $user->id])); ?>">
          <?php echo csrf_field(); ?>
          <?php echo method_field('PUT'); ?>

          <div class="form-group">
            <label for="editId">ID</label>
            <input type="number" name="id" class="form-control" id="editId" />
          </div>
          <div class="form-group">
            <label for="editName">Name</label>
            <input type="text" name="name" class="form-control" id="editName" />
          </div>
          <div class="form-group">
            <label for="editEmail">Email</label>
            <input type="text" name="email" class="form-control" id="editEmail" />
          </div>
          <div class="form-group">
            <label for="editGender">Gender</label>
            <input type="text" name="gender" class="form-control" id="editGender" />
          </div>
          <div class="form-group">
            <label for="editStatus">Status</label>
            <input type="text" name="status" class="form-control" id="editStatus" />
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="submitEditForm()">Save changes</button>
      </div>
    </div>
  </div>
</div>


                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal<?php echo e($user->id); ?>">
                        Details
                    </button>
                    <!-- Modal for User Details -->
                     <div class="modal fade" id="userModal<?php echo e($user->id); ?>" tabindex="-1" aria-labelledby="userModalLabel<?php echo e($user->id); ?>" aria-hidden="true">
                     <div class="modal-dialog modal-dialog-centered">
                       <div class="modal-content">
                         <div class="modal-header">
                           <h5 class="modal-title" id="userModalLabel<?php echo e($user->id); ?>">User Details</h5>
                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                         </div>
                         <div class="modal-body">
                           <!-- Add the user details content here -->
                           <p><strong>ID : </strong> <?php echo e($user->id); ?></p>
                           <p><strong>Name : </strong><?php echo e($user->name); ?></p>
                           <p><strong>Email : </strong><?php echo e($user->email); ?></p>
                           <p><strong>Gender : </strong><?php echo e($user->gender); ?></p>
                           <p><strong>Status : </strong><?php echo e($user->status); ?></p>
                           <!-- Add other user details as needed -->
                         </div>
                         <div class="modal-footer">
                           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                       </div>
                   </div>
                   </div>
                   </div>

                    <a href="<?php echo e(route('users.projects', ['id' => $user->id])); ?>" class="btn btn-secondary">Project</a>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>



<!-- Modal for adding user -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Form for adding a new user -->
        <form id="addUserForm" method="POST" action="<?php echo e(route('users.store')); ?>">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label for="id">ID</label>
                <input type="number" name="id" class="form-control" id="id" value="<?php echo e(old('id')); ?>"/>
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name" value="<?php echo e(old('name')); ?>"/>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" class="form-control" id="email" value="<?php echo e(old('email')); ?>"/>
            </div>
            <div class="form-group">
                <label for="gender">Gender</label>
                <input type="text" name="gender" class="form-control" id="gender" value="<?php echo e(old('gender')); ?>"/>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <input type="text" name="status" class="form-control" id="status" value="<?php echo e(old('status')); ?>"/>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="submitForm()">Add User</button>
      </div>
    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


<script>
    function deleteUser(userId) {
        fetch(`/api/users/${userId}/delete`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
            },
        })
        .then(response => {
            if (response.ok) {
                // User deleted successfully, now reload the table
                reloadTable();
                console.log('User deleted successfully');
            } else {
                console.error('Error deleting user');
            }
        })
        .catch(error => {
            console.error('Error deleting user:', error);
        });
    }

    function reloadTable() {
        fetch('<?php echo e(route('users.index')); ?>')
            .then(response => response.text())
            .then(html => {
                document.querySelector('.body').innerHTML = html;
            })
            .catch(error => console.error('Error reloading table:', error));
    }

    function submitForm() {
        // Submit the form within the modal
        document.getElementById('addUserForm').submit();
    }

    function openEditModal(userId) {
    // Fetch user data from the server
    fetch(`/api/users/${userId}`)
        .then(response => response.json())
        .then(userData => {
            // Populate form fields with user data
            document.getElementById('editId').value = userData.id;
            document.getElementById('editName').value = userData.name;
            document.getElementById('editEmail').value = userData.email;
            document.getElementById('editGender').value = userData.gender;
            document.getElementById('editStatus').value = userData.status;

            // Show the modal
            var modal = new bootstrap.Modal(document.getElementById('editUserModal'));
            modal.show();
        })
        .catch(error => console.error('Error fetching user data:', error));
}

  function submitEditForm() {
    // Submit the form within the modal
    document.getElementById('editUserForm').submit();
  }
</script>

</body>
</html>
<?php /**PATH C:\Users\suraj\Desktop\Testing\laravelCRUD\resources\views/users/index.blade.php ENDPATH**/ ?>