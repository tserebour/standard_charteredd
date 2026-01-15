// Main application logic

document.addEventListener('DOMContentLoaded', () => {

    // Login: Password Toggle
    const togglePasswordBtn = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');

    if (togglePasswordBtn && passwordInput) {
        togglePasswordBtn.addEventListener('click', () => {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            togglePasswordBtn.querySelector('i').classList.toggle('bi-eye');
            togglePasswordBtn.querySelector('i').classList.toggle('bi-eye-slash');
        });
    }


    // Forgot Password: Flow
    const forgotForm = document.getElementById('forgotForm');
    if (forgotForm) {
        forgotForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const identifierEl = document.getElementById('identifier');
            if (!identifierEl) return;

            const identifier = identifierEl.value;
            let masked = identifier;
            if (identifier.includes('@')) {
                const parts = identifier.split('@');
                masked = parts[0].substring(0, 1) + '****@' + parts[1];
            } else {
                masked = identifier.substring(0, 3) + '****' + identifier.substring(identifier.length - 2);
            }

            const confirmDest = document.getElementById('confirmDest');
            if (confirmDest) confirmDest.textContent = masked;

            const step1 = document.getElementById('forgotStep1');
            const step2 = document.getElementById('forgotStep2');

            if (step1) step1.classList.add('d-none');
            if (step2) step2.classList.remove('d-none');
        });
    }


    // Transfers Wizard
    const btnToReview = document.getElementById('btnToReview');
    if (btnToReview) {
        btnToReview.addEventListener('click', () => {
            const amountInput = document.getElementById('amount');
            const amount = parseFloat(amountInput.value);
            const fromSelect = document.getElementById('fromAccount');
            const selectedOpt = fromSelect.selectedOptions[0];
            const balance = parseFloat(selectedOpt.getAttribute('data-bal'));

            // Validation
            if (isNaN(amount) || amount <= 0) {
                alert("Please enter a valid amount.");
                return;
            }

            if (amount > balance) {
                document.getElementById('amountError').classList.remove('d-none');
                return;
            } else {
                document.getElementById('amountError').classList.add('d-none');
            }

            // Populate Review
            const toSelect = document.getElementById('toPayee');
            const toText = toSelect.selectedOptions[0].text;

            document.getElementById('reviewFrom').textContent = selectedOpt.getAttribute('data-name') + ' (' + selectedOpt.getAttribute('data-num') + ')';
            document.getElementById('reviewTo').textContent = toText;
            document.getElementById('reviewAmount').textContent = '$' + amount.toFixed(2);
            document.getElementById('reviewDate').textContent = document.getElementById('date').value;

            // Warning for large amounts
            if (amount >= 1000) {
                document.getElementById('largeTransferWarning').classList.remove('d-none');
            } else {
                document.getElementById('largeTransferWarning').classList.add('d-none');
            }

            // Switch Steps
            document.getElementById('transferStep1').classList.add('d-none');
            document.getElementById('transferStep2').classList.remove('d-none');
        });
    }

    const btnBackToStep1 = document.getElementById('btnBackToStep1');
    if (btnBackToStep1) {
        btnBackToStep1.addEventListener('click', () => {
            document.getElementById('transferStep2').classList.add('d-none');
            document.getElementById('transferStep1').classList.remove('d-none');
        });
    }

    const btnConfirm = document.getElementById('btnConfirm');
    if (btnConfirm) {
        btnConfirm.addEventListener('click', () => {
            btnConfirm.disabled = true;
            btnConfirm.innerText = 'Processing...';

            setTimeout(() => {
                const ref = 'TR-' + Math.random().toString(36).substr(2, 8).toUpperCase();
                const successRef = document.getElementById('successRef');
                if (successRef) successRef.textContent = ref;

                const step2 = document.getElementById('transferStep2');
                const step3 = document.getElementById('transferStep3');
                if (step2) step2.classList.add('d-none');
                if (step3) step3.classList.remove('d-none');
            }, 1000);
        });
    }

    // Toggle Payee Fields
    const toPayee = document.getElementById('toPayee');
    if (toPayee) {
        toPayee.addEventListener('change', function () {
            const newFields = document.getElementById('newPayeeFields');
            if (this.value === 'new') {
                newFields.classList.remove('d-none');
            } else {
                newFields.classList.add('d-none');
            }
        });
    }

    // Card Locking
    const lockToggles = document.querySelectorAll('.card-lock-toggle');
    lockToggles.forEach(toggle => {
        toggle.addEventListener('change', function () {
            const toastEl = document.getElementById('cardIoast');
            const toastBody = toastEl.querySelector('.toast-body');

            if (this.checked) {
                toastBody.textContent = 'Card locked successfully.';
            } else {
                toastBody.textContent = 'Card unlocked.';
            }

            const toast = new bootstrap.Toast(toastEl);
            toast.show();
        });
    });


    // Sidebar Toggle
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebarClose = document.getElementById('sidebarClose');
    const sidebar = document.getElementById('sidebar');
    let overlay = document.querySelector('.sidebar-overlay');

    if (sidebarToggle && sidebar) {
        // Create overlay if it doesn't exist
        if (!overlay) {
            overlay = document.createElement('div');
            overlay.className = 'sidebar-overlay';
            document.body.appendChild(overlay);
        }

        function toggleSidebar() {
            sidebar.classList.toggle('show');
            overlay.classList.toggle('show');
        }

        sidebarToggle.addEventListener('click', toggleSidebar);

        if (sidebarClose) {
            sidebarClose.addEventListener('click', toggleSidebar);
        }

        overlay.addEventListener('click', function () {
            sidebar.classList.remove('show');
            overlay.classList.remove('show');
        });
    }

});

