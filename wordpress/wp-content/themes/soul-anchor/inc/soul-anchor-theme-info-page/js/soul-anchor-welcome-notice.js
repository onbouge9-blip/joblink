(function ($) {
    "use strict";

    // Install + Activate button
    $("#install-activate-button").on("click", function (e) {
        if ( $(this).data("activated") ) {
            return;
        }

        e.preventDefault();

        var button = $(this);
        button.prop("disabled", true)
              .text("Installing & Activating recommended plugins…")
              .addClass("processing-spinner");

        $.post(soul_anchor_localize.ajax_url, {
            action: "soul_anchor_install_and_activate_plugins",
            nonce: soul_anchor_localize.nonce
        }, function (response) {
            if (response.success) {
                window.location.href = soul_anchor_localize.redirect_url;
            } else {
                button.text(response.data?.message || "Installation failed");
            }
        });
    });

})(jQuery);
