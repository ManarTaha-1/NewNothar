
<div class="modal-overlay" id="registerModal">
    <div class="center">
        <div class="modal-content">
            <span class="close-btn" onclick="toggleModal('registerModal')">&times;</span>
            <div class="wrapper">
                <form action="../pages/register_logic.php" method="POST">
                    <h1>Register</h1>
                    <?php if (!empty($_SESSION['register_error'])): ?>
                        <div class="error-message"><?= htmlspecialchars($_SESSION['register_error']); ?></div>
                        <?php unset($_SESSION['register_error']); ?>
                    <?php endif; ?>
    
                    <div class="input-box">
                        <input type="text" name="username" placeholder="Username" required>
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <div class="input-box">
                        <input type="email" name="email" placeholder="Email" required>
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <div class="input-box">
                        <input type="password" name="password" placeholder="Password" required>
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    <div class="input-box">
                        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                        <i class="fa-solid fa-lock"></i>
                    </div>

                   <input type="hidden" name="redirect" value="<?= htmlspecialchars($_SERVER['REQUEST_URI']); ?>">


                    <button type="submit" class="btns">Register</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function toggleModal(modalId) {
    const modal = document.getElementById(modalId);
    modal.classList.toggle('active');
}
</script>

