<script src="<?= base_url() ?>assets/admin/js/vendors/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>assets/admin/js/vendors/perfect-scrollbar.js"></script>
<script src="<?= base_url() ?>assets/admin/js/vendors/jquery.fullscreen.min.js"></script>

<!-- Main Script -->
<script src="<?= base_url() ?>assets/admin/js/main.js" type="text/javascript"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />


<script src="<?= base_url() ?>assets/admin/notifyjs/dist/notify.js"></script>
<script src="<?= base_url() ?>assets/admin/js/validation.js"></script>


<script src="<?= base_url() ?>assets/admin/js/jsapi.js"></script>
<script src="<?= base_url() ?>assets/admin/js/transliterationlib.js"></script>



<script>
    // Load all the below after loading the script tag above asynchronously

    google.load("elements", "1", {
        packages: "transliteration"
    });

    function onLoad() {
        var options = {
            sourceLanguage: google.elements.transliteration.LanguageCode.ENGLISH,
            destinationLanguage: [google.elements.transliteration.LanguageCode.MALAYALAM],
            shortcutKey: 'ctrl+g',
            transliterationEnabled: true
        };


        var control = new google.elements.transliteration.TransliterationControl(options);


        control.makeTransliteratable(['textToTranslate']);
    }

    google.setOnLoadCallback(onLoad);
</script>