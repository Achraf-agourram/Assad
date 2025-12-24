function openModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
}


function showBookingModal(tourId, title, price) {
    document.getElementById('booking-tour-id').value = tourId;
    document.getElementById('booking-tour-title').textContent = title;
    document.getElementById('booking-tour-price').textContent = price;

    const nbPersonnesInput = document.getElementById('nb_personnes');
    const totalPriceSpan = document.getElementById('total-price');
    nbPersonnesInput.value = 1;
    totalPriceSpan.textContent = `${price}€`;

    nbPersonnesInput.oninput = () => {
        const nb = parseInt(nbPersonnesInput.value) || 0;
        const total = nb * price;
        totalPriceSpan.textContent = `${total}€`;
    };

    openModal('booking-modal');
}

function showCommentModal(tourId, title) {
    document.getElementById('commentBtn').value = tourId;
    document.getElementById('comment-tour-title').textContent = title;

    openModal('comment-modal');
}
