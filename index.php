<?php 

    include('config/db_connect.php');

    if(isset($_POST['delete'])){
        
        $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

        $sql = "DELETE FROM pizzas where id = $id_to_delete";

        if(mysqli_query($conn, $sql)){
            // header('Location: index.php');
            echo '<script>alert("Deleted successfully!")</script>';
        }else{
            echo 'error query: ' . mysqli_error($conn);
        }

    }
    
    $sql = 'SELECT id, title, ingredients FROM pizzas ORDER BY created_at';

    $result = mysqli_query($conn, $sql);

    $pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // free result from memory
    mysqli_free_result($result);
    // closing the connection to database
    mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
    <?php include('templates/header.php') ?>
    <h4 class="text-center text-secondary my-4">Pizzas</h4>
    <div class="container my-5">
        <div class="row">
        
        <?php foreach($pizzas as $pizza): ?>
        
            <div class="col col-lg-4 col-md-2 col-sm-1 px-2">
                <div class="card">
                    <img class="card-img-top" src="https://www.delonghi.com/Global/recipes/multifry/pizza_fresca.jpg" alt="pizza img">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($pizza['title']); ?></h5>
                        <ul>
        
                            <?php foreach(explode(',', $pizza['ingredients']) as $ing): ?>
                                <li><?php echo htmlspecialchars($ing); ?></li>
                            <?php endforeach; ?>
        
                        </ul>
                    </div>
                    <div class="card-footer bg-white ml-auto mb-2 d-flex justify-content-between w-100">
                        <a href="details.php?id=<?php echo $pizza['id']; ?>" class="btn w-100 mr-1 btn-outline-primary text-uppercase">More Info</a>
                       <form action="index.php" method="POST">
                        <input type="hidden" name="id_to_delete" value="<?php echo $pizza['id'] ?>">
                        <input type="submit" name="delete" class="btn btn-outline-danger ml-1 text-uppercase w-100" value="Delete">
                       </form>
                    </div>
                </div>
            </div>
        
        <?php endforeach; ?>
        
        </div>
    </div>

    <?php include('templates/footer.php') ?>
</html>