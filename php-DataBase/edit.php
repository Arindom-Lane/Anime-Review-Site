
<?php
include("db.php");



if(isset($_POST['update'])){
    setcookie("e_id",$_POST['id'], time()+ 3600) ;
    
    $result = mysqli_query($con, "SELECT * FROM applicants WHERE id=$id");
    $row = mysqli_fetch_assoc($result);

    $id = $_COOKIE['e_id'];
    $name = $_POST['name'];
    $qualification = $_POST['qualification'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $reference_name = $_POST['reference_name'];
    $gender = $_POST['gender'];
    $profile_image = $_POST['profile_image'];

    $query = "UPDATE applicants 
              SET name='$name', qualification='$qualification', mobile='$mobile', email='$email', 
                  age='$age', reference_name='$reference_name', gender='$gender', profile_image='$profile_image' 
              WHERE id=$id";

    if(mysqli_query($con, $query)){
        header("Location: test.php?updated=1");
        exit;
    } else {
        echo "Error updating record: " . mysqli_error($con);
    }
}
?>

<form method="POST" action="">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

    <label>Name</label>
    <input type="text" name="name" value="<?php echo $row['name']; ?>" required>

    <label>Qualification</label>
    <input type="text" name="qualification" value="<?php echo $row['qualification']; ?>" required>

    <label>Mobile</label>
    <input type="text" name="mobile" value="<?php echo $row['mobile']; ?>" required>

    <label>Email</label>
    <input type="email" name="email" value="<?php echo $row['email']; ?>" required>

    <label>Age</label>
    <input type="number" name="age" value="<?php echo $row['age']; ?>" required>

    <label>Reference</label>
    <input type="text" name="reference_name" value="<?php echo $row['reference_name']; ?>" required>

    <label>Gender</label>
    <select name="gender" required>
        <option value="Male" <?php if($row['gender']=="Male") echo "selected"; ?>>Male</option>
        <option value="Female" <?php if($row['gender']=="Female") echo "selected"; ?>>Female</option>
        <option value="Others" <?php if($row['gender']=="Others") echo "selected"; ?>>Others</option>
    </select>

    <label>Profile Image Link</label>
    <input type="text" name="profile_image" value="<?php echo $row['profile_image']; ?>" required>

    <br>
    <input type="submit" name="update" value="Update">
</form>
