/**
 * Modification image
 */
(function () {

    let indexImg = document.getElementById('images').getAttribute('data-index');

    let modifExtImgBtn = document.getElementsByName('modify');

    let rmExtImgBtn = document.querySelectorAll('button#remove_ext_image');

    let addImageBtn = document.getElementById('add_image');


    // Modif image
    for (let j = 0; j < modifExtImgBtn.length; j++) {

        modifExtImgBtn[j].parentNode.querySelector('input').style.display = "none";

        modifExtImgBtn[j].addEventListener('click', function (e) {

            let parentExtImageTemp = modifExtImgBtn[j].parentNode.firstElementChild.nextElementSibling;

            let reg = /[0-9]/gi;

            let currentIndex = parentExtImageTemp.id.match(reg);

            let inptExtImg = document.getElementById('modify_trick_image_'+currentIndex+'_file');

            console.log(inptExtImg);

            inptExtImg.style.display = "block";

            e.preventDefault();
        });
    }

    // Remove image
    for (let i = 0; i < rmExtImgBtn.length; i++) {

        rmExtImgBtn[i].addEventListener('click', function (e) {

            let parentExtImage = rmExtImgBtn[i].parentElement.parentElement.parentElement.parentNode;

            let parentExtImageTemp = rmExtImgBtn[i].parentNode.firstElementChild.nextElementSibling;

            let reg = /[0-9]/gi;

            let currentIndex = parentExtImageTemp.id.match(reg);

            let extImg = document.getElementById('modify_trick_image_' + currentIndex);

            console.log(parentExtImage);
            console.log(currentIndex);
            console.log(parentExtImageTemp);
            console.log(extImg.parentNode);

            parentExtImage.removeChild(extImg.parentNode);

            indexImg--;
            e.preventDefault();
        });
    }
    addImageBtn.addEventListener('click', function(e) {
        e.preventDefault();

        let prototype = document.getElementById('images').getAttribute('data-prototype');

        let newImage = prototype.replace(/__name__/g, indexImg);

        let rmImageBtn = document.createElement('button');
        rmImageBtn.id = 'remove_image';
        rmImageBtn.type = 'button';
        rmImageBtn.textContent = 'Suprimer';
        rmImageBtn.className = 'btn btn-danger';

        let elmntFielsedt = document.createElement('fieldset');
        elmntFielsedt.className = 'form-group';

        let blockParent = document.getElementById('modify_trick_image');

        elmntFielsedt.insertAdjacentHTML('afterbegin',newImage);
        console.log(elmntFielsedt);

        console.log(blockParent);

        blockParent.appendChild(elmntFielsedt);

        let image = addImageBtn.parentElement.querySelector('div#modify_trick_image_'+indexImg);

        image.appendChild(rmImageBtn);

        rmImageBtn.addEventListener('click', function (e) {

            let parentImage = document.getElementById('modify_trick_image');
            let rmBlock = rmImageBtn.parentElement.parentElement;

            parentImage.removeChild(rmBlock);
            indexImg--;
        });
        indexImg++;
    });
}) ();