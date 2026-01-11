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

    // Login: Form Submission (Dummy Auth)
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            const errorBanner = document.getElementById('loginError');

            // Simple dummy check: admin/password or user/user
            // In a real app, this would be an API call.
            // For this UI demo, we simulate success for non-empty credentials unless specific "fail" keywords are used.

            if (username === 'fail' || password === 'fail') {
                errorBanner.classList.remove('d-none');
            } else {
                errorBanner.classList.add('d-none');
                // Simulate redirect delay
                const btn = loginForm.querySelector('button[type="submit"]');
                const originalText = btn.innerText;
                btn.disabled = true;
                btn.innerText = 'Signing in...';

                setTimeout(() => {
                    window.location.href = 'dashboard.php';
                }, 800);
            }
        });
    }

    // Forgot Password: Flow
    const forgotForm = document.getElementById('forgotForm');
    if (forgotForm) {
        forgotForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const identifier = document.getElementById('identifier').value;

            // Masking logic for demo display
            let masked = identifier;
            if (identifier.includes('@')) {
                const parts = identifier.split('@');
                masked = parts[0].substring(0, 1) + '****@' + parts[1];
            } else {
                // assume phone
                masked = identifier.substring(0, 3) + '****' + identifier.substring(identifier.length - 2);
            }

            document.getElementById('confirmDest').textContent = masked;
            document.getElementById('forgotStep1').classList.add('d-none');
            document.getElementById('forgotStep2').classList.remove('d-none');
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
            const btn = btnConfirm;
            btn.disabled = true;
            btn.innerText = 'Processing...';

            setTimeout(() => {
                // Generate random reference
                const ref = 'TR-' + Math.random().toString(36).substr(2, 8).toUpperCase();
                document.getElementById('successRef').textContent = ref;

                document.getElementById('transferStep2').classList.add('d-none');
                document.getElementById('transferStep3').classList.remove('d-none');
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

});

