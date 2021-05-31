<?php 

    include('config/db_connect.php');

    $email = $title = $ingredients = '';
    $errors = array('email' => '', 'title' => '', 'ingredients' => '');
        
    if(isset($_POST['submit'])){
        if(empty($_POST['email'])){
            $errors['email'] = 'an email is required. <br>';
    }   else{
         $email = $_POST['email'];
         if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors['email'] = 'email must be a valid email address!';
         }
     }
     if(empty($_POST['title'])){
         $errors['title'] = 'a title is required. <br>';
     }else{
         $title = $_POST['title'];
         if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
             $errors['title'] = 'title must be letter and spaces only!';
         }
     }
     if(empty($_POST['ingredients'])){
         $errors['ingredients'] = 'at least one ingredient is required. <br>';
     }else{
         $ingredients = $_POST['ingredients'];
         if(!preg_match('/^([a-zA-Z\s]+)(,[a-zA-Z\s]*)*$/', $ingredients)){
             $errors['ingredients'] = 'ingredients must be comma separated!';
         }                
     }

     $email = mysqli_real_escape_string($conn, $_POST['email']);
     $title = mysqli_real_escape_string($conn, $_POST['title']);
     $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);

     $sql = "INSERT INTO pizzas(title, email, ingredients) VALUES('$title', '$email', '$ingredients')";

     if(mysqli_query($conn, $sql)){
        header('Location: index.php');
     }else{
         echo 'query error: ' . mysqli_error($conn);
     }
 }

?>

<!DOCTYPE html>
<html lang="en">
    <?php include('templates/header.php') ?>
    
    <section class="container add_piz">
        <h2 class="text-danger text-center my-2 text-uppercase">Add a Pizza</h2>
        <form action="create.php" method="POST" class="shadow p-5 my-4">
        <div class="form-group">
            <label>Your Email:</label>
            <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($email) ?>" placeholder="JohnDoe@gmail.com" >
            <span class="text-danger d-block"><?php echo $errors['email'] ?></span>
        </div>
        <div class="form-group">
            <label>Pizza Title:</label>
            <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($title) ?>" placeholder="Belissimo" >
            <span class="text-danger d-block"><?php echo $errors['title'] ?></span>
        </div>
        <div class="form-group">
            <label>Ingredients (comma seperated):</label>
            <input type="text" name="ingredients" class="form-control" value="<?php echo htmlspecialchars($ingredients) ?>" placeholder="Carrot, Sauge" >
            <span class="text-danger d-block"><?php echo $errors['ingredients'] ?></span>
        </div>
        <input type="submit" value="Submit" name="submit" class="btn btn-success">
        </form>
    </section>

    <?php include('templates/footer.php') ?>
</html>