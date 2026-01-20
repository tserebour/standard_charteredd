<!-- includes/components/transfer-modal.php -->
<div class="modal fade" id="transferUnavailableModal" tabindex="-1" aria-labelledby="transferUnavailableModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-white border-0 pb-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center p-4 p-md-5 pt-0">
                <div class="mb-4">
                    <div class="bg-light-warning text-warning rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                        style="width: 80px; height: 80px; background-color: #fff3cd;">
                        <i class="bi bi-exclamation-triangle-fill fs-1" style="color: #856404;"></i>
                    </div>
                </div>
                <h3 class="h4 mb-3 fw-bold" id="transferUnavailableModalLabel">Service Unavailable</h3>
                <p class="text-secondary mb-4" style="line-height: 1.6;">
                    We regret to inform you that fund transfers are currently unavailable.
                    Please contact <a href="mailto:pradomildred95@gmail.com"
                        class="text-primary text-decoration-none fw-bold">pradomildred95@gmail.com</a> for further
                    assistance.
                </p>
                <p class="text-muted small mb-4">
                    Thank you for your understanding.
                </p>
                <div class="d-grid">
                    <button type="button" class="btn btn-primary py-2 fw-bold shadow-sm"
                        data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    #transferUnavailableModal .modal-content {
        border-radius: 1.25rem;
    }

    #transferUnavailableModal .btn-primary {
        background-color: #00463c;
        /* Standard Chartered dark green profile */
        border-color: #00463c;
    }

    #transferUnavailableModal .btn-primary:hover {
        background-color: #00332c;
        border-color: #00332c;
    }

    #transferUnavailableModal .text-primary {
        color: #00463c !important;
    }
</style>