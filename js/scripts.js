function toggleContent(element) {
    const content = element.closest('.box').nextElementSibling;
    const isVisible = content.style.display === 'block';
    content.style.display = isVisible ? 'none' : 'block';
}
AOS.init({once:true
});
const checkbox = document.getElementById("checkbox")
checkbox.addEventListener("change", () => {
  document.body.classList.toggle("dark")
})
function showMenu() {
  const menu = document.getElementById("dropdown");
  menu.style.display = menu.style.display === "block" ? "none" : "block";
}
document.addEventListener('click', function (event) {
  const dropdown = document.getElementById('dropdown');
  const icon = document.querySelector('.menu-icon');

  if (!dropdown.contains(event.target) && !icon.contains(event.target)) {
    dropdown.style.display = 'none';
  }
});

function switchModals() {
    document.getElementById('registerModal').classList.toggle('active');
    document.getElementById('loginModal').classList.toggle('active');
}