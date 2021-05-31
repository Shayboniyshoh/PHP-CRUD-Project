<?php 

    include('config/db_connect.php');
    
    if(isset($_GET['id'])){

        $id = mysqli_real_escape_string($conn, $_GET['id']);

        $sql = "SELECT * FROM pizzas WHERE id = $id";

        $result = mysqli_query($conn, $sql);

        $pizza = mysqli_fetch_assoc($result);

        // free result from memory
        mysqli_free_result($result);
        // closing the connection to database
        mysqli_close($conn);
    }

?>

<!DOCTYPE html>
<html lang="en">
    <?php include('templates/header.php') ?>

    <div class="container">
        <div class="row my-5">
            <div class="col shadow p-5 text-center">

        <?php if($pizza): ?>

            <h4><?php echo htmlspecialchars($pizza['title']); ?></h4>
            <p>Created by: <?php echo htmlspecialchars($pizza['email']); ?></p>
            <p>Created at: <?php echo date($pizza['created_at']); ?></p>
            <h5>Ingredients:</h5>
            <p><?php echo htmlspecialchars($pizza['ingredients']); ?></p>
        
        <?php else: ?>
            <h5>There is no such pizza exist!</h5>
        <?php endif; ?>
                <a href="index.php" class="btn btn-dark">Back to list</a>
            </div>
        </div>
    </div>

    <?php include('templates/footer.php') ?>
</html>