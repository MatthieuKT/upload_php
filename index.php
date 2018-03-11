<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>upload d'images</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  </head>
  <body>
    <?php
    // database and object files
    include_once "config/database.php";
    include_once "objects/image.php";

    // database connection
    $database = new Database();
    $conn = $database->getConnection();

    if (isset($_POST['upload'])){
      // the path top store the uploaded image
      $target = "images" . basename($_FILES['image']['name']);

      // write query
      $query = "INSERT INTO
                  images
                SET
                  name=:name, description=:description";

      $stmt = $conn->prepare($query);

      // posted values
      $image = htmlspecialchars(strip_tags($_FILES['image']['name']));
      $description = htmlspecialchars(strip_tags($_POST['description']));
      var_dump($description);

      // bind values;
      $stmt->bindParam(':name', $image);
      $stmt->bindParam(':description', $description);

      $stmt->execute();
    }

     ?>

    <div class="container">
      <div class="col-md-6">
        <h1>Image uploader</h1>
        <hr>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="size" value="1000000">

          <div class="form-group">
            <input type="file" name="image" class="form-control">
          </div>

          <div class="form-group">
            <textarea name="description" cols="40" rows="4" placeholder="image description" class="form-control"></textarea>
          </div>

          <input type="submit" name="upload" value="Upload image" class="btn btn-primary">
        </form>
      </div>
    <div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
