<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Dashboard</title>
<style>
  body {
    background: #f4ede2; /* warm beige paper-like background */
    font-family: 'Georgia', serif;
    color: #5a3e1b; /* dark brown */
    margin: 40px;
  }
  h2 {
    font-size: 2.4em;
    border-bottom: 2px solid #bfa56a;
    padding-bottom: 8px;
    margin-bottom: 30px;
    font-weight: normal;
  }
  a {
    text-decoration: none;
    color: #7a5a1f;
    border: 1.5px solid #7a5a1f;
    padding: 10px 18px;
    border-radius: 6px;
    font-weight: 600;
    transition: background-color 0.3s ease, color 0.3s ease;
  }
  a:hover {
    background-color: #7a5a1f;
    color: #f4ede2;
  }
  .container {
    max-width: 600px;
    background: #fff8e1;
    padding: 40px;
    border: 1px solid #d2c3a3;
    box-shadow: 5px 5px 15px rgba(183, 154, 70, 0.3);
    border-radius: 10px;
  }
</style>
</head>
<body>
  <div class="container">
  <h2>Welcome, <?php echo htmlspecialchars($_SESSION['user']); ?>!</h2>
  <p><a href="logout.php">Logout</a></p>

  <h2 style="margin-top: 40px;">Add News</h2>
  <form action="add_news.php" method="POST" enctype="multipart/form-data">
  <input type="text" name="title" placeholder="Title" required style="width: 100%; padding: 10px; margin-bottom: 15px;"><br>
  
  <textarea name="content" placeholder="Content" rows="6" required style="width: 100%; padding: 10px; margin-bottom: 15px;"></textarea><br>
  
  <select name="category" required style="width: 100%; padding: 10px; margin-bottom: 15px;">
      <option value="">-- Select Category --</option>
      <option value="World">World</option>
      <option value="Business">Business</option>
      <option value="Politics">Politics</option>
      <option value="War">War</option>
      <option value="Sports">Sports</option>
      <option value="Entertainment">Entertainment</option>
      <option value="Science">Science</option>
      <option value="Climate">Climate</option>
      <option value="Tech">Tech</option>
  </select><br>

  <input type="file" name="image" accept="image/*" style="margin-bottom: 15px;"><br>

  <button type="submit" style="padding: 10px 20px; background-color: #7a5a1f; color: white; border: none; border-radius: 5px;">Post</button>
</form>

</div>

</body>
</html>
