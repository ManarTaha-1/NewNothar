<?php
$saved_username = $_COOKIE['remembered_username'] ?? '';
$saved_email = $_COOKIE['remembered_email'] ?? '';
?>

<!-- Login Modal -->
<div class="modal-overlay" id="loginModal">
  <div class="middle">
    <div class="modal-content">
      <span class="close-btn" onclick="toggleModal('loginModal')">&times;</span>
      <div class="wrapper">
        <form action="login_logic.php" method="POST">
          <h1>Login</h1>
  
          <!-- Error message from session -->
          <?php if (isset($_SESSION['login_error'])): ?>
            <div class="error-message">
              <p><?= htmlspecialchars($_SESSION['login_error']); ?></p>
            </div>
            <?php unset($_SESSION['login_error']); ?>
          <?php endif; ?>
  
          <div class="input-box">
            <input type="text" name="username" placeholder="Username" value="<?= htmlspecialchars($saved_username); ?>" required>
            <i class="fa-solid fa-user"></i>
          </div> 
  
          <div class="input-box">
            <input type="email" name="email" placeholder="Email" value="<?= htmlspecialchars($saved_email); ?>" required>
            <i class="fa-solid fa-envelope"></i>
          </div> 
  
          <div class="input-box">
            <input type="password" name="password" placeholder="Password" required>
            <i class="fa-solid fa-lock"></i>
          </div>
  
          <div class="remember-forget">
            <label><input type="checkbox" name="remember">Remember Me</label>
          </div>
  
          <button type="submit" class="btns">Login</button>
  
          <div class="register-link">
            <p>Don't have an account? 
              <a href="#" onclick="toggleModal('loginModal'); toggleModal('registerModal');">Register</a>
            </p>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
