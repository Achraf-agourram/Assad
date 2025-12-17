const authModal = document.getElementById('auth-modal');
const btnLogin = document.getElementById('btn-login');
const btnRegister = document.getElementById('btn-register');
const modalTitle = document.getElementById('modal-title');
const roleField = document.getElementById('role-field');
const toggleAuth = document.getElementById('toggle-auth');
let isLoginMode = true;

function openModal(mode) {
    isLoginMode = (mode === 'login');
    modalTitle.textContent = isLoginMode ? 'Connexion' : 'Inscription';
    roleField.classList.toggle('hidden', isLoginMode);
    toggleAuth.textContent = isLoginMode ? "Pas encore de compte ? S'inscrire" : "Déjà un compte ? Se connecter";
    authModal.classList.remove('hidden');
    authModal.classList.add('flex');
}

function closeModal() {
    authModal.classList.add('hidden');
    authModal.classList.remove('flex');
}

btnLogin.addEventListener('click', () => openModal('login'));
btnRegister.addEventListener('click', () => openModal('register'));

toggleAuth.addEventListener('click', () => {
    openModal(isLoginMode ? 'register' : 'login');
});

function openAsaadModal() {
    const modal = document.getElementById('modal-asaad');
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeAsaadModal() {
    const modal = document.getElementById('modal-asaad');
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
}

window.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeAsaadModal();
});