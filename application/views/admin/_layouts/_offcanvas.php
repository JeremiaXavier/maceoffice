<div class="offcanvas offcanvas-size-xl my-offcanvas offcanvas-end" tabindex="-1" id="myOffcanvas" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <button type="button" title="Close" class="close-offcanvas text-reset" data-bs-dismiss="offcanvas" style="background: transparent; border: none;">
            Close <i class="fa fa-long-arrow-right ml-5" aria-hidden="true"></i>
        </button>

        <h3 class="offcanvas-heading" id="offcanvasExampleLabel">Offcanvas</h3>
        <!-- <button type="button" class="btn-close offcanvas-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button> -->
    </div>
    <div class="offcanvas-body">

        <div class="offcanvas-content"></div>

    </div>
</div>







<div class="my-modal modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="translateModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Translate Text</h5>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <!-- <label class="text-dark" for="inputName">Text:</label> -->
                    <textarea class="form-control" id="textToTranslate" autofocus></textarea>
                </div>
               

            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary translate-text" type="button">Translate <i class="fa fa-language ml-5" aria-hidden="true"></i></button>
            </div>
        </div>
    </div>
</div>



<script>
    $(document).on('click', '.translate-modal', function(e) {
        e.preventDefault();
        const textContent = $(this).attr('data-text');

        $('#translateModal').modal('show');
        $("#translateModal").on('shown.bs.modal', function() {
            $(this).find('#textToTranslate').focus();
        });

        if (textContent && textContent.length > 0)
            $("#textToTranslate").val(textContent);
        // init_google_translate(); // not written yet
    });


</script>




<style>
    .offcanvas-size-xl {
        --bs-offcanvas-width: min(95vw, 670px) !important;
    }

    .offcanvas-size-xxl {
        --bs-offcanvas-width: min(95vw, 90vw) !important;
    }

    .offcanvas-size-md {
        /* add Responsivenes to default offcanvas */
        --bs-offcanvas-width: min(95vw, 400px) !important;
    }

    .offcanvas-size-sm {
        --bs-offcanvas-width: min(95vw, 250px) !important;
    }
</style>