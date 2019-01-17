
(function () {
    let inptPicture = document.getElementById('registration_picture');

    inptPicture.setAttribute('onchange', 'previewFile()');

    let divParent = inptPicture.parentNode;

    let labelPicture = divParent.firstChild;

    labelPicture.innerHTML = "<img src=\"https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120\" class=\"avatar\" alt=\"avatar\">"

}) ();

function previewFile() {
    let preview = document.querySelector('img');

    let file    = document.querySelector('input[type=file]').files[0];
    let reader  = new FileReader();

    reader.addEventListener("load", function () {
        preview.src = reader.result;
    }, false);

    if (file) {
        reader.readAsDataURL(file);
    }
}
