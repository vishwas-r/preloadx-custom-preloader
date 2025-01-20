jQuery(document).ready(function($) {
    function updatePreview() {
        var selectedPreloader = $("#preloadify_selected").val();
        var previewHtml = "";
        if (selectedPreloader === "spinner") {
            previewHtml = "<div class=\"loader spinner\"><div></div><div></div><div></div><div></div></div>";
        } else if (selectedPreloader === "loading-text") {
            previewHtml = "<div class=\"p-preloader\"><div class=\"loader loading-text\"></div></div>";
        } else if (selectedPreloader === "rounded-progress") {
            previewHtml = "<div class=\"loader rounded-progress\"></div>";
        } else if (selectedPreloader === "square") {
            previewHtml = "<div class=\"loader square\"></div>";
        } else if (selectedPreloader === "hourglass") {
            previewHtml = "<div class=\"loader hourglass\"></div>";
        } else if (selectedPreloader === "clock-loader") {
            previewHtml = "<div class=\"loader clock-loader\"></div>";
        } else if (selectedPreloader === "roller") {
            previewHtml = "<div class=\"loader roller\"><div></div><div></div></div>";
        } else if (selectedPreloader === "wave") {
            previewHtml = "<div class=\"loader wave\"></div>";
        } else if (selectedPreloader === "pulsar") {
            previewHtml = "<div class=\"loader pulsar\"></div>";
        } else {
            previewHtml = "";
        }

        $("#preloader-preview").html(previewHtml);
    }

    $("#preloadify_selected").on("change", function() {
        updatePreview();
    });

    // Initial preview update
    updatePreview();
});
