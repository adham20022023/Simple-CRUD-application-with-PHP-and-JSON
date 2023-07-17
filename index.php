<?php
// for header of the page 
include "parts/header.php";

// php actions CRUD
require_once "PHP_Actions/users.php";

$all_users=read_users();

?>
<div class="container">
<p>
        <a class="btn btn-success" href="create.php">Create new User</a>
    </p>

    <table class='table'>
        <!--- Table header --->
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Website</th>
                <th>Actions</th>
            </tr>
        </thead>
        <!--- Table Body --->
        <tbody>
            <?php foreach ($all_users as $user): ?>
                  <tr>
                      <td>
                      <?php if (isset($user['extension'])): ?>
                        <img style="width: 60px" src="<?php echo "PHP_Actions/images/${user['id']}.${user['extension']}" ?>" alt="">
                      <?php endif; ?>
                          </td>
                      <td><?php echo $user['name']; ?></td>
                      <td><?php echo $user['username']; ?></td>
                      <td><?php echo $user['email']; ?></td>
                      <td><?php echo $user['phone']; ?></td>
                      <td><a target="_blank" href="http://<?php echo $user['website']; ?>"><?=$user['website']?></a> </td>
                      <td>
                          <a class="btn btn-sm btn-outline-info" href='read.php?id=<?php echo $user['id']; ?>'>Read</a>
                          <a class="btn btn-sm btn-outline-success" href='update.php?id=<?php echo $user['id']; ?>'>Update</a>
                          <form method="POST" action="delete.php">
                                <input type="hidden" name="id" value="<?php echo $user['id'] ?>">
                                <button class="btn btn-sm btn-outline-danger">Delete</button>
                          </form> 
                      </td>
                  </tr>
                  <?php endforeach;?>
        </tbody>
    </table>
</div>
<?php include "parts/footer.php"?>