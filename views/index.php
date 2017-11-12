<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Upload File Week 12 - 5988014</title>
</head>
<body>

  <h1>Please upload a file</h1>
  <form id="form" action="<?= $GLOBALS['ROOT']; ?>/upload" method="POST" enctype="multipart/form-data">
    <input type="file" name="file" />
    <input type="submit" value="submit" />
  </form>

  <div id="contentHere"></div>

  <script src="<?= $GLOBALS['ROOT']; ?>/static/js/vendor/jquery-3.2.1.min.js"></script>
  <script src="<?= $GLOBALS['ROOT']; ?>/static/js/app.js"></script>
  
</body>
</html>