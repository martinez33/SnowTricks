/**Add image**/
(function () {
    let addImageBtn = document.getElementById('add_image');

    let indexImg = document.getElementById('images').getAttribute('data-index');

    addImageBtn.addEventListener('click', function(e) {
        e.preventDefault();

        let prototype = document.getElementById('images').getAttribute('data-prototype');

        let newImage = prototype.replace(/__name__/g, indexImg);

        let rmImageBtn = document.createElement('button');
        rmImageBtn.id = 'remove_image';
        rmImageBtn.type = 'button';
        rmImageBtn.textContent = 'Suprimer';
        rmImageBtn.className = 'btn btn-danger';

        addImageBtn.insertAdjacentHTML('beforebegin', newImage);

        let image = addImageBtn.parentElement.querySelector('div#add_trick_image_'+indexImg);

        image.appendChild(rmImageBtn);

        rmImageBtn.addEventListener('click', function (e) {
            let parentImage = addImageBtn.parentElement;

            parentImage.removeChild(image);
            indexImg--;
        });
        indexImg++;
    });
}) ();

/**
 * Ajout de video
 */
(function () {
    let addVideoBtn = document.getElementById('add_video');
    let indexVideo = document.getElementById('videos').getAttribute('data-index');

    addVideoBtn.addEventListener('click', function(e) {
        e.preventDefault();

        let prototype = document.getElementById('videos').getAttribute('data-prototype');
        let newVideo = prototype.replace(/__name__/g, indexVideo);

        let videoDiv = document.createElement('div');
        videoDiv.id = 'video_'+indexVideo;

        let videos = document.getElementById('videos');

        let rmVideoBtn = document.createElement('button');
        rmVideoBtn.id = 'remove_video';
        rmVideoBtn.type = 'button';
        rmVideoBtn.textContent = 'Suprimer';
        rmVideoBtn.className = 'btn btn-danger';

        videos.appendChild(videoDiv);

        videoDiv.insertAdjacentHTML('afterbegin', newVideo);
        videoDiv.appendChild(rmVideoBtn);

        rmVideoBtn.addEventListener('click', function (e) {

            videos.removeChild(videoDiv);
            indexVideo--;
        });
        indexVideo++;
    });
}) ();