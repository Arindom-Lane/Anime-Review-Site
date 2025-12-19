<?php
include("db.php");

// CREATE: Handle new entry
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $qualification = $_POST['qualification'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $references = $_POST['references'];
    $gender = $_POST['gender'];
    $profile_image = $_POST['profile_image'];

    // Using backticks for 'reference_name' to avoid reserved word issues
    $query = "INSERT INTO applicants (`name`, `qualification`, `mobile`, `email`, `age`, `reference_name`, `gender`, `profile_image`) 
              VALUES ('$name', '$qualification', '$mobile', '$email', '$age', '$references', '$gender', '$profile_image')";

    if(mysqli_query($con, $query)){ 
        header("Location: test.php?success=1");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD Application</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Add New Applicant</h2>
    <form method="POST" style="display:grid; width: 300px;">
        <input type="text" name="name" placeholder="Name" required>
        <input type="text" name="qualification" placeholder="Qualification" required>
        <input type="text" name="mobile" placeholder="Mobile" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="number" name="age" placeholder="Age" required>
        <input type="text" name="references" placeholder="Reference" required>
        <select name="gender" required>
            <option value="">Select Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>
        <input type="text" name="profile_image" placeholder="Image URL" required>
        <input type="submit" name="submit" value="Save" style="background-color: aquamarine;">
    </form>

    <table border="1" cellpadding="10" style="margin-top:20px;">
        <tr>
            <th>ID</th><th>Name</th><th>Email</th><th>Image</th><th>Actions</th>
        </tr>
        <?php 
        $result = mysqli_query($con, "SELECT * FROM applicants");
        while($row = mysqli_fetch_assoc($result)){ ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><img src="<?php echo $row['profile_image']; ?>" width="50"></td>
            <td>
                <form method="POST" action="edit.php" style="display:inline;">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <input type="submit" name="edit_btn" value="Edit">
                </form>
                
                <form method="POST" action="delete.php" style="display:inline;" onsubmit="return confirm('Delete this record?');">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <input type="submit" name="delete_btn" value="Delete">
                </form>
            </td>
        </tr>
        <?php } ?>
    </table>
    <?php
if (isset($_GET['success'])) {
    echo "<p style='color: green;'>Record added successfully!</p>";
}
if (isset($_GET['updated'])) {
    echo "<p style='color: blue;'>Record updated successfully!</p>";
}
// How would you write the code for the 'deleted' message?
?>
</body>
</html>