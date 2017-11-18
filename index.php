<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>HW4 Webprogramming - 5988014</title>
  </head>
  <body>

    <h1>Please upload a file</h1>
    <!-- Form -->
    <form id="form" action="upload.php" method="POST" enctype="multipart/form-data">
      <input type="file" name="file" />
      <input type="submit" value="submit" />
    </form>
    <!-- End Form -->

    <!-- contentHere -->
    <div id="contentHere"></div>
    <!-- End ContentHere -->

    <script src="js/vendor/jquery-3.2.1.min.js"></script>
    <script src="js/app.js"></script>
    
  </body>
</html>