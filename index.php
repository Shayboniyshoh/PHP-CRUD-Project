<?php 

    include('config/db_connect.php');
    
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
                    <div class="card-footer bg-white ml-auto mb-2">
                        <a href="details.php?id=<?php echo $pizza['id']; ?>" class="text-dark text-uppercase text-muted">More Info</a>
                    </div>
                </div>
            </div>
        
        <?php endforeach; ?>
        
        </div>
    </div>

    <?php include('templates/footer.php') ?>
</html>