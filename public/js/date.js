

const reservationDateInput = document.getElementById('reservation_date_input');
const reservationTimeInput = document.getElementById('reservation_time_input');
const numberInput = document.getElementById('quantity_input');

const reservationDateConfirm = document.getElementById('reservation_date_confirm');
const reservationTimeConfirm = document.getElementById('reservation_time_confirm');
const numberConfirm = document.getElementById('number_confirm');

reservationDateInput.addEventListener('input', function() {
    reservationDateConfirm.textContent = reservationDateInput.value;
});

reservationTimeInput.addEventListener('input', function() {
    reservationTimeConfirm.textContent = reservationTimeInput.value;
});

numberInput.addEventListener('input', function() {
    numberConfirm.textContent = numberInput.value;
});


