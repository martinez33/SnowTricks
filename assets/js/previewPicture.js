
(function () {
    let inptPicture = document.getElementById('registration_picture');


    inptPicture.setAttribute('onchange', 'previewFile()');
    console.log(inptPicture);
    let divParent = inptPicture.parentNode;

    let labelPicture = divParent.firstChild;

    console.log(divParent);
    console.log(labelPicture);

    labelPicture.innerHTML = "<img src=\"https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120\" class=\"avatar\" alt=\"avatar\">"

    console.log(labelPicture);

    previewFile();

}) ();



