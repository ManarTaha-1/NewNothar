document.addEventListener("DOMContentLoaded", loadArticles);

document.getElementById('addArticleForm').addEventListener('submit', async function (e) {
  e.preventDefault();

  const data = {
    title: document.getElementById('title').value,
    content: document.getElementById('content').value,
    image: document.getElementById('image').value,
    category: document.getElementById('category').value
  };

  const response = await fetch('api/add_article.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(data)
  });

  const result = await response.json();
  if (result.success) {
    loadArticles();  // Refresh list
    document.getElementById('addArticleForm').reset();
  } else {
    alert(result.message);
  }
});

async function loadArticles() {
  const res = await fetch('api/get_articles.php');
  const articles = await res.json();

  const container = document.getElementById('articlesContainer');
  container.innerHTML = '';

  articles.forEach(article => {
    const card = document.createElement('div');
    card.classList.add('card');
    card.innerHTML = `
      <img src="${article.image}" alt="Article Image">
      <div class="card-body">
        <h5 class="card-title">${article.title}</h5>
        <p class="card-text">${article.content.substring(0, 150)}...</p>
        <p class="card-footer"><small>${article.category}</small></p>
        <button class="delete-btn" onclick="deleteArticle(${article.id})">Delete</button>
      </div>`;
    container.appendChild(card);
  });
}

async function deleteArticle(id) {
  if (!confirm("Are you sure you want to delete this article?")) return;

  const response = await fetch(`api/delete_article.php?id=${id}`, { method: 'DELETE' });
  const result = await response.json();

  if (result.success) {
    loadArticles();
  } else {
    alert(result.message);
  }
}


