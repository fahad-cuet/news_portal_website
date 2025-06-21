<?php
require 'config.php';
$stmt = $pdo->query("SELECT * FROM news ORDER BY created_at DESC");
$newsItems = $stmt->fetchAll();
?>
<!doctype html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    
    <link rel="stylesheet" href="index.css">
    
    
  </head>
  <body >
      
    <!-- Top Banner -->
    <div class="top-banner">
      <h1 class="portal-title ">
        <a href="index.php">Voice Of Earth</a>
      </h1>
      
      <div class="top-left animated-info">
        <div>
          <span class="info-item date"><i class="fas fa-calendar-alt"></i> <span id="current-date"></span>
        </div> 
        <div>
          <span class="info-item temp"><i class="fas fa-temperature-high"></i> <span id="temperature"></span>
        </div>
        <div>
          <span class="info-item location"><i class="fas fa-map-marker-alt"></i> <span id="location"></span>
        </div>
        
      </div>
      
      <div class="top-right">
        <button class="login-btn">Login</button>
      </div>
    </div>

    <!--NavBar-->
    <header class="main-nav">
      
      <div class="nav-container">
        <div class="hamburger" id="hamburger">☰</div>
        <div class="nav-logo">
          <a href="index.php">
            <img src="images/en-logo.jpg" alt="EN Logo" class="logo-img">
           </a>
         </div>

         <nav class="nav-links" id="nav-links">
            <ul>
              <li><a href="category.php?name=World">World</a></li>
              <li><a href="category.php?name=business">Business</a></li>
              <li><a href="category.php?name=politics">Politics</a></li>
              <li><a href="category.php?name=war">War</a></li>
              <li><a href="category.php?name=sports">Sports</a></li>
              <li><a href="category.php?name=entertainment">Entertainment</a></li>
              <li><a href="category.php?name=science">Science</a></li>
              <li><a href="category.php?name=climate">Climate</a></li>
              <li><a href="category.php?name=tech">Tech</a></li>
            </ul>
        </nav>
        <div class="nav-search">
          <input type="text" placeholder="Search news...">
          <button type="submit">🔍</button>
        </div>
        
      </div>
      <div class="side-overlay" id="side-overlay"></div>
        <div class="side-menu" id="side-menu">
          <div class="close-btn" id="close-btn">×</div>
          <ul>
            <li><a href="category.php?name=World">World</a></li>
            <li><a href="category.php?name=business">Business</a></li>
            <li><a href="category.php?name=politics">Politics</a></li>
            <li><a href="category.php?name=war">War</a></li>
            <li><a href="category.php?name=sports">Sports</a></li>
            <li><a href="category.php?name=entertainment">Entertainment</a></li>
            <li><a href="category.php?name=science">Science</a></li>
            <li><a href="category.php?name=climate">Climate</a></li>
            <li><a href="category.php?name=tech">Tech</a></li>
          </ul>
        </div>
    </header>

    <!-- News Section -->
    <main class="news-section" style="max-width:900px; margin: 20px auto; padding:0 15px;">
      <h2 style="font-family: 'Playfair Display', serif; font-weight:700; color:#5a3e1b; margin-bottom:20px;">Latest News</h2>

      <?php if (count($newsItems) === 0): ?>
        <p>No news available right now. Please check back later.</p>
      <?php else: ?>
        <?php foreach ($newsItems as $item): ?>
          <article class="news-card" style="border-bottom:1px solid #bfa56a; padding-bottom:20px; margin-bottom:20px;">
          <?php if (!empty($item['image']) && file_exists($item['image'])): ?>
            <img src="<?= htmlspecialchars($item['image']) ?>" alt="News Image" style="max-width:100%; height:auto; margin-bottom:15px; border-radius:8px;">
           <?php endif; ?>

          <h3 style="font-family: 'Libre Baskerville', serif; color:#7a5a1f; margin-bottom:10px;">
           <?= htmlspecialchars($item['title']) ?>
          </h3>
          <p style="color:#4b3a1b; line-height:1.6;"><?= nl2br(htmlspecialchars($item['content'])) ?></p>
          <small style="color:#6b5a32;">
          Posted in <em><?= htmlspecialchars($item['category']) ?></em> by <strong><?= htmlspecialchars($item['author']) ?></strong> on <?= date("F j, Y, g:i a", strtotime($item['created_at'])) ?>
        </small>
          </article>
        <?php endforeach; ?>

         <?php endif; ?>
    </main>

  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    
    <script src="index.js"></script>

    <!-- Login Modal -->
<div id="login-modal" class="modal">
  <div class="modal-content">
    <span class="close" id="login-close">&times;</span>
    <h2>Login</h2>
    <form action="login.php" method="POST">
  <input type="email" name="email" placeholder="Email" required>
  <input type="password" name="password" placeholder="Password" required>
  <button type="submit">Login</button>
</form>
    <p>Don't have an account? <a href="#" id="show-register">Register</a></p>
  </div>
</div>

<!-- Register Modal -->
<div id="register-modal" class="modal">
  <div class="modal-content">
    <span class="close" id="register-close">&times;</span>
    <h2>Register</h2>
    <form action="register.php" method="POST">
      <input type="text" name="name" placeholder="Name" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Register</button>
   </form>

    <p>Already have an account? <a href="#" id="show-login">Login</a></p>
  </div>
</div>

  </body>
</html>
