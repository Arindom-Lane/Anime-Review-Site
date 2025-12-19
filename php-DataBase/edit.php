<?php
include("db.php");

// 1. Fetch data for the form (Received from test.php)
if(isset($_POST['id'])) {
    $id = $_POST['id'];
    $result = mysqli_query($con, "SELECT * FROM applicants WHERE id=$id");
    $row = mysqli_fetch_assoc($result);
} else {
    header("Location: test.php"); // Redirect if accessed directly without ID
    exit();
}

// 2. Handle the Update logic
if(isset($_POST['update_record'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $qualification = $_POST['qualification'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $ref = $_POST['reference_name'];
    $gender = $_POST['gender'];
    $img = $_POST['profile_image'];

    $query = "UPDATE applicants SET 
              name='$name', qualification='$qualification', mobile='$mobile', 
              email='$email', age='$age', reference_name='$ref', 
              gender='$gender', profile_image='$img' 
              WHERE id=$id";

    if(mysqli_query($con, $query)){
        header("Location: test.php?updated=1");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Edit Applicant</title></head>
<body>
    <h2>Edit Applicant #<?php echo $row['id']; ?></h2>
    <form method="POST" action="edit.php" style="display:grid; width: 300px;">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        
        <label>Name</label>
        <input type="text" name="name" value="<?php echo $row['name']; ?>">
        
        <label>Reference</label>
        <input type="text" name="reference_name" value="<?php echo $row['reference_name']; ?>">
        
        <label>Image Link</label>
        <input type="text" name="profile_image" value="<?php echo $row['profile_image']; ?>">
        
        <input type="submit" name="update_record" value="Save Changes">
        <a href="test.php">Cancel</a>
    </form>
</body>
</html>