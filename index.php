
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product List</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <style>
    .product-card {
      height: 100%;
    }
    .product-card img {
      max-width: 100%;
      height: 200px;
      object-fit: cover;
    }
  </style>
</head>
<body>

<?php

    require 'conn.php';

    // Fetch products
    $sql = 'SELECT id, name, price, image FROM products';
    $stmt = $db->prepare($sql);
    $stmt->execute();

    // Fetch the results
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

  <div class="container">
    <div class="row">
    <?php 
    // Output the products
    foreach ($products as $product) {
    ?>
      <div class="col-sm-6 col-md-4 col-lg-3">
        <div class="card product-card">
          <img src="<?php echo $product['image']; ?>" class="card-img-top" alt="<?php echo $product['name']; ?>">
          <div class="card-body">
            <h5 class="card-title"><?php echo $product['name']; ?></h5>
            <p class="card-text">$<?php echo $product['price']; ?></p>
            <a href="product.php?id=<?php echo $product['id']; ?>" class="btn btn-primary">View Product</a>
          </div>
        </div>
      </div>
    <?php 
    } 
    ?>
    </div>
  </div>
</body>
</html>
