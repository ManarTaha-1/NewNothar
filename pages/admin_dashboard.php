<?php 
require_once '../config.php';
require '../includes/header.php';
require_once '../includes/session_control.php';
requireAdmin()
?>
<link rel="stylesheet" href="../css/styles.css">
<body>
    <section class="admin-dashboard">
        <div class="admin-header">
            <div class="user-info">
                <i class="fa-solid fa-user fa-2x"></i>
                <p><?php echo htmlspecialchars($_SESSION['username']); ?></p>
            </div>
            <h1>Admin Dashboard</h1>
        </div>

        <div class="dashboard-table">
            <table>
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Number of Articles</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Tech</td>
                        <td>5</td>
                    </tr>
                    <tr>
                        <td>Space</td>
                        <td>5</td>
                    </tr>
                    <tr>
                        <td>Science</td>
                        <td>5</td>
                    </tr>
                    <tr>
                        <td>Future</td>
                        <td>5</td>
                    </tr>
                    <tr>
                        <td>Energy</td>
                        <td>5</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

<section class="add-article-section">
  <h2>Add New Article</h2>
  <form action="../add_article.php" method="POST" enctype="multipart/form-data" class="article-form">
    <input type="text" name="title" placeholder="Title" required><br>
    <textarea class="cont" name="content" placeholder="Content" required></textarea><br>
    <input type="file" name="image" accept="image/*" required><br>
    <select name="category"> 
      <option value="tech">Tech</option>
      <option value="space">Space</option>
      <option value="Future">Future</option>
      <option value="energy">Energy</option>
      <option value="science">Science</option>
    </select><br>
    <button type="submit">Add Article</button>
  </form>
</section>

<hr>

<h4 data-aos="flip-right">All Articles</h4>
<div class="all">

<?php
$stmt = $pdo->query("SELECT * FROM articles ORDER BY created_at DESC");
while ($row = $stmt->fetch()):
?>
<div class="dash-container"  data-aos="flip-down" data-aos-delay="400" data-aos-duration="1000">
    <div class="dash-box" >
        <div class="image"><img src="../<?= htmlspecialchars($row['image_url']) ?>" alt="Article Image" ></div>
        <div class="text-line"><?= htmlspecialchars($row['title']) ?></div>
    </div>
    <div class="delete">
        <form action="../delete_article.php" method="POST">
                <p><strong>Category:</strong> <?= htmlspecialchars($row['category']) ?></p>
        <input type="hidden" name="id" value="<?= $row['id'] ?>">
        <button type="submit" >Delete</button></form>
    </div>

</div>
<?php endwhile; ?>

</div>

<?php 
    include('login_modal.php');   
    include('register_madal.php');   
?>

<?php include('../includes/indexfooter.php'); ?>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init({once:true});</script>
<script src="../js/scripts.js"></script>

