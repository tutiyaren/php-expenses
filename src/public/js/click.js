
const kakeiboTitle = document.querySelector('.kakeibo');

kakeiboTitle.addEventListener('click', () => {
  kakeiboTitle.classList.add('animate');
  setTimeout(() => {
    kakeiboTitle.classList.remove('animate');
  }, 1000);
});
