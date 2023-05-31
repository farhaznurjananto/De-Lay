$(document).ready(function () {
    $('[data-dismiss="alert"]').on("click", function () {
        $(this).closest("#alert").remove();
    });
});

function previewImage() {
    const image = document.querySelector(".image_path");
    const imgPreview = document.querySelector("#img-preview");

    const oFReader = new FileReader();
    try {
        oFReader.readAsDataURL(image.files[0]);
        oFReader.onload = function (oFREvent) {
            imgPreview.src = oFREvent.target.result;
        };
    } catch (error) {
        imgPreview.src = "/img/display-img.png";
    }
}
