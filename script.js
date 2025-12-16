const authModal = document.getElementById('auth-modal');
const btnLogin = document.getElementById('btn-login');
const btnRegister = document.getElementById('btn-register');
const modalTitle = document.getElementById('modal-title');
const roleField = document.getElementById('role-field');
const toggleAuth = document.getElementById('toggle-auth');
let isLoginMode = true;

// Fonction pour ouvrir la modale
function openModal(mode) {
    isLoginMode = (mode === 'login');
    modalTitle.textContent = isLoginMode ? 'Connexion' : 'Inscription';
    roleField.classList.toggle('hidden', isLoginMode);
    toggleAuth.textContent = isLoginMode ? "Pas encore de compte ? S'inscrire" : "Déjà un compte ? Se connecter";
    authModal.classList.remove('hidden');
    authModal.classList.add('flex');
}

// Fonction pour fermer la modale
function closeModal() {
    authModal.classList.add('hidden');
    authModal.classList.remove('flex');
}

// Événements des boutons
btnLogin.addEventListener('click', () => openModal('login'));
btnRegister.addEventListener('click', () => openModal('register'));

// Basculer entre Connexion et Inscription
toggleAuth.addEventListener('click', () => {
    openModal(isLoginMode ? 'register' : 'login');
});

// Gestion de la soumission du formulaire (à connecter au Backend)
document.getElementById('auth-form').addEventListener('submit', (e) => {
    e.preventDefault();
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    if (isLoginMode) {
        console.log('Tentative de connexion avec:', email, '...', password);
        // TODO: Envoyer les données au backend pour vérifier l'authentification
        alert('Connexion en cours...');
    } else {
        const role = document.getElementById('role').value;
        console.log('Tentative d\'inscription avec:', email, 'Rôle:', role);
        // TODO: Envoyer les données au backend pour l'inscription et la hachage/cryptage du mot de passe
        alert(`Inscription en cours comme ${role}.`);
        if (role === 'GUIDE') {
            alert('Votre compte Guide est soumis à approbation par l\'Administrateur.');
        }
    }
    closeModal();
    // Réinitialiser le formulaire
    document.getElementById('auth-form').reset();
});

// Fonction pour la réservation (nécessite une modale dédiée ou une redirection)
function showBookingModal() {
    // Logique de vérification de la connexion avant d'afficher la modale de réservation
    if (false /* Remplacer par la vérification de l'état de connexion */) {
        // Afficher la modale de réservation
        console.log("Afficher la modale de réservation");
    } else {
        alert("Veuillez vous connecter pour effectuer une réservation.");
        openModal('login');
    }
}