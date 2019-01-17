
/**
 * Modification image
 */
(function () {

    let indexImg = document.getElementById('images').getAttribute('data-index');

    let modifExtImgBtn = document.getElementsByName('modify_image');

    let rmExtImgBtn = document.querySelectorAll('button#remove_ext_image');

    let addImageBtn = document.getElementById('add_image');


    // Modif image
    for (let j = 0; j < modifExtImgBtn.length; j++) {

        modifExtImgBtn[j].parentNode.querySelector('input').style.display = "none";

        modifExtImgBtn[j].addEventListener('click', function (e) {

            let parentExtImgageTemp = this.parentNode.firstChild.nextSibling.nextSibling;

            parentExtImgageTemp.style.display = "block";

            e.preventDefault();
        });
    }

    // Remove image
    for (let i = 0; i < rmExtImgBtn.length; i++) {

        rmExtImgBtn[i].addEventListener('click', function (e) {

            let parentImgExt = rmExtImgBtn[i].parentNode.parentNode;

            let parentImg = parentImgExt.parentNode.parentNode;

            let indexImg = document.getElementById('images').getAttribute('data-index');

            let regex = /[0-9]/gi;

            let currentIndex = parentImgExt.id.match(regex);

            let extImg = document.getElementById('modify_trick_image_' + currentIndex);

            let extImgUpNode = extImg.parentNode;

            parentImg.removeChild(extImgUpNode);

            e.preventDefault();
        });
    }
    // Add image
    addImageBtn.addEventListener('click', function(e) {

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
        console.log(blockParent);

        elmntFielsedt.insertAdjacentHTML('afterbegin',newImage);
        console.log(elmntFielsedt);

        console.log(blockParent);

        blockParent.appendChild(elmntFielsedt);

        let image = addImageBtn.parentElement.querySelector('div#modify_trick_image_'+indexImg);
        indexImg++;
        console.log(image);
        console.log(indexImg);

        image.appendChild(rmImageBtn);

        e.preventDefault();
        rmImageBtn.addEventListener('click', function (e) {

            let parentImage = document.getElementById('modify_trick_image');
            let rmBlock = rmImageBtn.parentElement.parentElement;
            parentImage.removeChild(rmBlock);
        });

    });
}) ();


/**Modification video**/
(function () {
    let indexVideo = document.getElementById('videos').getAttribute('data-index');
    console.log(indexVideo);
    let modifExtVideoBtn = document.getElementsByName('modify_video');
    console.log(modifExtVideoBtn);
    let rmExtVideoBtn = document.querySelectorAll('button#remove_ext_video');
    console.log(rmExtVideoBtn);
    let addVideoBtn = document.getElementById('add_video');
    console.log(addVideoBtn);

    // Modif video
    for (let j = 0; j < modifExtVideoBtn.length; j++) {

        modifExtVideoBtn[j].parentNode.querySelector('input').style.display = "none";

        modifExtVideoBtn[j].addEventListener('click', function (e) {

            let parentExtVideoTemp = this.parentNode.firstChild.nextSibling.nextSibling;

            parentExtVideoTemp.style.display = "block";

            e.preventDefault();
        });
    }


    // Remove video
    for (let i = 0; i < rmExtVideoBtn.length; i++) {

        rmExtVideoBtn[i].addEventListener('click', function (e) {

            console.log(rmExtVideoBtn[i]);

            let parentVideoExt = rmExtVideoBtn[i].parentNode.parentNode.parentNode;

            let parentVideo = parentVideoExt.parentNode;

            console.log(parentVideoExt);

            console.log(parentVideo);

            parentVideo.removeChild(parentVideoExt);

            e.preventDefault();
        });
    }

    // Add video
    addVideoBtn.addEventListener('click', function(e) {

        let prototype = document.getElementById('videos').getAttribute('data-prototype');

        let newVideo = prototype.replace(/__name__/g, indexVideo);

        let rmVideoBtn = document.createElement('button');
        rmVideoBtn.id = 'remove_image';
        rmVideoBtn.type = 'button';
        rmVideoBtn.textContent = 'Suprimer';
        rmVideoBtn.className = 'btn btn-danger';

        let elmntFielsedt = document.createElement('fieldset');
        elmntFielsedt.className = 'form-group';

        let blockParent = document.getElementById('modify_trick_video');

        elmntFielsedt.insertAdjacentHTML('afterbegin',newVideo);

        blockParent.appendChild(elmntFielsedt);

        let video = addVideoBtn.parentElement.querySelector('div#modify_trick_video_'+indexVideo);
        indexVideo++;
        console.log(video);
        console.log(indexVideo);

        video.appendChild(rmVideoBtn);

        e.preventDefault();
        rmVideoBtn.addEventListener('click', function (e) {

            let parentVideo = document.getElementById('modify_trick_video');
            let rmBlock = rmVideoBtn.parentElement.parentElement;
            parentVideo.removeChild(rmBlock);
        });

    });
}) ();