<?php

include('config/db_connect.php');

$sql = 'SELECT title, ingredients, id FROM pizzas  ORDER BY created_at ';

$result = mysqli_query($conn, $sql );

$pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_free_result($result);

mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">

<?php include('template/header.php'); ?>

<h4 class="center brand-text">PIZZAS</h4>
<div class="container">
  <div class="row">
    <?php foreach($pizzas as $pizza):?>
      <div class="col s6 md3">
      <div class="card z-depth-0">
        <img src="img/pizza.png.png" alt="" class="pizza">

        <div class="card-content center">
          <h6><?php echo htmlspecialchars($pizza['title']); ?></h6>
							<ul>
                <?php foreach(explode(',', $pizza['ingredients']) as $ing):?>
                <li><?php echo htmlspecialchars($ing); ?></>
                <?php endforeach; ?>
                </ul>
        </div>
         <div class="card-action right-align">
          <a href="details.php?id=<?php echo $pizza['id'] ?>" class="brand-text">More Info</a>
         </div>
      </div>
      
    </div>
    <?php endforeach; ?>
    
    <?php if(count($pizzas) >= 3):?>
      <p>There are 3 or more pizzas </p>
    <?php else :?>  
      <p> There are less than 3 pizzas</p>
    <?php endif; ?>  
  </div>
</div>
<?php include('template/footer.php'); ?>
  



</html>