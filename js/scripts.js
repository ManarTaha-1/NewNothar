// Toggle the visibility of article content
function toggleContent(element) {
  const content = element.closest('.box').nextElementSibling;
  if (!content) return;
  const isVisible = content.style.display === 'block';
  content.style.display = isVisible ? 'none' : 'block';
}

// Toggle dropdown menu (if used for admin/user navigation)
function showMenu() {
  const menu = document.getElementById("dropdown");
  if (menu) {
    menu.style.display = menu.style.display === "block" ? "none" : "block";
  }
}

// Close dropdown if clicked outside
document.addEventListener('click', function (event) {
  const dropdown = document.getElementById('dropdown');
  const icon = document.getElementById('menu-icon'); // Assuming this is your toggle icon

  if (dropdown && icon && !dropdown.contains(event.target) && !icon.contains(event.target)) {
    dropdown.style.display = 'none';
  }
});
