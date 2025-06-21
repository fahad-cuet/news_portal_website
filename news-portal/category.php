<?php
require 'config.php';

// Check if category is passed
if (!isset($_GET['name']) || empty($_GET['name'])) {
  header('Location: index.php');
  exit;
}

$category = $_GET['name'];

// Category → Emoji/Icon mapping
$categoryIcons = [
  'World' => '🌍',
  'Business' => '💼',
  'Politics' => '🏛️',
  'War' => '🪖',
  'Sports' => '🏅',
  'Entertainment' => '🎬',
  'Science' => '🔬',
  'Climate' => '🌦️',
  'Tech' => '💻',
];

// Validate category
$allowed_categories = array_keys($categoryIcons);
if (!in_array($category, $allowed_categories)) {
  die("Invalid category.");
}

// Get the icon for the current category
$categoryIcon = $categoryIcons[$category] ?? '📰';

// Fetch news
$stmt = $pdo->prepare("SELECT * FROM news WHERE category = ? ORDER BY created_at DESC");
$stmt->execute([$category]);
$newsItems = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($category) ?> News | Voice Of Earth</title>
  <link rel="stylesheet" href="index.css">
</head>
<body>

<!-- Header and Nav -->
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
          <?php foreach ($allowed_categories as $cat): ?>
            <li><a href="category.php?name=<?= urlencode($cat) ?>" <?= $cat == $category ? 'class="active"' : '' ?>><?= $cat ?></a></li>
          <?php endforeach; ?>
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
        <?php foreach ($allowed_categories as $cat): ?>
          <li><a href="category.php?name=<?= urlencode($cat) ?>"><?= $cat ?></a></li>
        <?php endforeach; ?>
      </ul>
  </div>
</header>

<!-- Category Title -->
<section class="category-hero">
  <h2><?= $categoryIcon ?> <?= htmlspecialchars($category) ?> News</h2>
</section>

<!-- News List -->
<section class="news-grid" style="max-width:900px; margin: 20px auto; padding:0 15px;">
  <?php if (count($newsItems) === 0): ?>
    <p>No news available in this category.</p>
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
          Posted by <strong><?= htmlspecialchars($item['author']) ?></strong> on <?= date("F j, Y, g:i a", strtotime($item['created_at'])) ?>
        </small>
      </article>
    <?php endforeach; ?>
  <?php endif; ?>
</section>

<script src="index.js"></script>
</body>
</html>
