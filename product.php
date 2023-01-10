<?php
require_once 'conn.php';
include 'vendor/autoload.php';

ini_set('display_errors', 1); error_reporting(E_ALL);

// Get the product id from the query string
$product_id = $_GET['id'];

// Fetch the product details
$sql = 'SELECT id, name, price, image FROM products WHERE id = :id';
$stmt = $db->prepare($sql);
$stmt->bindParam(':id', $product_id, PDO::PARAM_INT);
$stmt->execute();
$product = $stmt->fetch(PDO::FETCH_ASSOC);

// Fetch the comments for the product
$sql = 'SELECT name, comment, ratings FROM comments WHERE product_id = :id ORDER BY id DESC';
$stmt = $db->prepare($sql);
$stmt->bindParam(':id', $product_id, PDO::PARAM_INT);
$stmt->execute();
$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Check if the form has been submitted
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $comment = $_POST['comment'];

    // Insert the comment into the database
    
    $sql = 'INSERT INTO comments (name, comment, product_id) VALUES (:name, :comment, :product_id)';
    
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':comment', $comment);
    $stmt->bindParam(':product_id', $product_id);
    $stmt->execute();

    $comment_id = $db->lastInsertId();
    echo $comment_id;

    $command = escapeshellcmd("python3 textblob/python.py $comment_id");
    shell_exec($command);

    // include 'vendor/autoload.php';

    // Use Sentiment\Analyzer;
    // $analyzer = new Analyzer(); 

    // $output_text = $analyzer->getSentiment($comment);

    // $sql = 'UPDATE comments SET ratings = :ratings WHERE id = :id';
    // $stmt = $db->prepare($sql);
    // $stmt->bindParam(':ratings', $output);
    // $stmt->bindParam(':id', $comment_id);
    // $stmt->execute();

    // // Redirect to the same page to refresh the comments and ratings
    // header('Location: product.php?id=' . $product_id);
    // exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $product['name']; ?></title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <h1 class="text-center"><?php echo $product['name']; ?></h1>
        <div class="text-center">
          <img src="<?php echo $product['image']; ?>" class="img-thumbnail" alt="<?php echo $product['name']; ?>">
        </div>
        <p class="text-center">Price: $<?php echo $product['price']; ?></p>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <h2>Comments</h2>
        <?php foreach ($comments as $comment) { ?>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title"><?php echo $comment['name']; ?></h5>
              <p class="card-text"><?php echo $comment['comment']; ?></p>
              <p class="card-text">ratings: <?php echo $comment['ratings']; ?></p>
            </div>
          </div>
        <?php } ?>
        <hr>
        <form action="product.php?id=<?php echo $product_id; ?>" method="post">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
          <div class="form-group">
            <label for="comment">Comment</label>
            <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
          </div>
          <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
