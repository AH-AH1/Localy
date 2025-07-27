<style>

    body{

        font-family: Arial, Helvetica, sans-serif;

    }

    .modal-content {
        border: none;
        border-radius: 1rem;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }

    .modal-header {
        border-bottom: none;
        padding: 1.5rem 1.5rem 0.5rem;
        background: #4caf50;
        border-radius: 1rem 1rem 0 0;
        color: white;
    }

    .modal-title {
        font-weight: 600;
        font-size: 1.25rem;
    }

    a {

        text-decoration: none !important;

    }

    .modal-body {
        padding: 2rem 1.5rem;
        font-size: 1.1rem;
        color: #495057;
    }

    .modal-footer {
        border-top: none;
        padding: 1rem 1.5rem 1.5rem;
    }

    .btn {
        padding: 0.6rem 1.5rem;
        border-radius: 0.5rem;
        font-weight: 500;
        transition: all 0.2s;
    }

    .btn-secondary {
        background-color: #e9ecef;
        border: none;
        color: #495057;
    }

    .btn-secondary:hover {
        background-color: #dee2e6;
    }

    .modal.fade .modal-dialog {
        transform: scale(0.95);
    }

    .modal.show .modal-dialog {
        transform: scale(1);
    }
</style>

<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="confirmModalLabel">Order Confirmation</h5>

            </div>

            <div class="modal-body text-center">

                <p class="mb-0"><strong>Thank you for your purchase!</strong><br>Your order has been processed.</p>

            </div>

            <div class="modal-footer">

                <a href="orders.php" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</a>

            </div>

        </div>

    </div>

</div>