<?php
include("db.php");

// CREATE (Insert)
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $qualification = $_POST['qualification'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $references = $_POST['references'];
    $gender = $_POST['gender'];
    $profile_image = $_POST['profile_image']; // storing image link

    $query = "INSERT INTO applicants (name, qualification, mobile, email, age, reference_name, gender, profile_image) 
              VALUES ('$name', '$qualification', '$mobile', '$email', '$age', '$references', '$gender', '$profile_image')";

    if(mysqli_query($con, $query)){     
        header("Location: test.php?"); // PRG pattern to avoid duplicate insert on refresh
        exit();
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Web Developer Application</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Form -->
    <form method="POST" action="" style="display:grid;">
        <label>Name</label>
        <input type="text" name="name" placeholder="enter your name *" required>

        <label>Qualification</label>
        <input type="text" name="qualification" placeholder="enter your qualification *" required>

        <label>Mobile</label>
        <input type="text" name="mobile" placeholder="mobile number *" required>

        <label>Email</label>
        <input type="email" name="email" placeholder="email id *" required>

        <label>Age</label>
        <input type="number" name="age" placeholder="age *" required>

        <label>References</label>
        <input type="text" name="references" placeholder="Any references *" required>

        <label>Gender</label>
        <select name="gender" required>
            <option value="">Select</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Others">Others</option>
        </select>

        <label>Profile Image Link</label>
        <input type="text" name="profile_image" placeholder="Paste image URL *" required>

        <br>
        <input type="submit" name="submit" value="Save" style="background-color: aquamarine;">
    </form>

    <!-- READ (Display Table) -->
    <?php
    $result = mysqli_query($con, "SELECT * FROM applicants");
    ?>

    <table border="1" cellpadding="10" style="margin-top:20px;">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Qualification</th>
            <th>Mobile</th>
            <th>Email</th>
            <th>Age</th>
            <th>References</th>
            <th>Gender</th>
            <th>Profile Image</th>
            <th>Actions</th>
        </tr>

        <?php 
        while($row = mysqli_fetch_assoc($result)){ ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['qualification']; ?></td>
            <td><?php echo $row['mobile']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['age']; ?></td>
            <td><?php echo $row['reference_name']; ?></td>
            <td><?php echo $row['gender']; ?></td>
            <td><img src="<?php echo $row['profile_image']; ?>" width="80" height="80"></td>
            <td>
                <form method="POST" action="edit.php">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <input type="submit" name="update" value="Edit">
                </form>
                <form method="POST" action="edit.php">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <input type="submit" name="delete" value="Delete">
                </form>
            </td>
        </tr>
        <?php } ?>
    </table>

</body>
</html>
