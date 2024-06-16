
const openModal = document.querySelector('.open-modal');
const closeModal = document.querySelector('.close-modal');
const dialogModal = document.querySelector('.dialog');
const { body } = document;
const MODAL_CLASS = 'is-modal';

openModal.addEventListener('click', () => {
  body.classList.add(MODAL_CLASS);
  dialogModal.showModal();
});

closeModal.addEventListener('click', () => {
  body.classList.remove(MODAL_CLASS);
  dialogModal.close();
});

dialogModal.addEventListener('cancel', () => {
  body.classList.remove(MODAL_CLASS);
});

dialogModal.addEventListener('click', (event) => {
  if (!event.target.closest('.dialog-inner')) {
    body.classList.remove(MODAL_CLASS);
    dialogModal.close();
  }
})
