<?php

include('config/db_connect.php');

$title = $email = $ingredients = '';
$errors = array('email' =>'', 'title' => '', 'ingredients' => '');
// this code if(isset($_POST['submit'])) get the input from the user 
  if(isset($_POST['submit'])){
    
  if(empty($_POST['email'])){
    $errors['email'] = 'An email is required <br />';
  }else{
    $email = $_POST['email'];
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
      $errors['email'] ='email must be valid email address';
    }
   }

  if(empty($_POST['title'])){
    $errors['title'] = 'A title is required <br />';
  }else{
    $title = $_POST['title'];
    if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
      $errors['title'] ='Title must be letters and spaces only';
    }
  }

  if(empty($_POST['ingredients'])){
    $errors['ingredients']  = 'An ingredient is required <br />';
  }else{
    $ingredients = $_POST['ingredients'];
    if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)){
      $errors['ingredients']  = 'ingredient must be letters and spaces only';
    }
  }

  if(array_filter($errors)){

  }else {
    $email = mysqli_real_escape_string($conn, $_POST['email'] );
    $title = mysqli_real_escape_string($conn, $_POST['title'] );
    $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients'] );
    
    $sql = "INSERT INTO pizzas(title,email,ingredients) VALUES('$title', '$email', '$ingredients')";
    
    if(mysqli_query($conn, $sql)){
      header('Location: index.php');
    } else {
      echo 'query error: '. mysqli_error($conn);
    }
    
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include('template/header.php'); ?>

<section class="container grey-text">
  <h4 class="center">Add your sweet Pizza</h4>
  <form action="add.php" method="POST" class="white">
    <label>Your Email:</label>
    <input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
    <div class="red-text"><?php echo $errors['email'];?></div>
    <label>Your Sweet Pizza title:</label value="<?php echo $email ?>">
    <input type="text" name="title" value='<?php echo htmlspecialchars($title) ?>'>
    <div class="red-text"><?php echo $errors['title'];?></div>
    <label>Ingredients where dey burst brain(Use Comma, Senior Man):</label>
    <input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients) ?>">
    <div class="red-text"><?php echo $errors['ingredients'];?></div>
    <div class="center">
      <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
    </div>
  </form>

</section>
<?php include('template/footer.php'); ?>
  


</html>