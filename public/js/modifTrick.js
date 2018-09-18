(function () {

    let rmImageBtn = document.querySelectorAll('button#rm-img');

    console.log(rmImageBtn);

    for (let i = 0; i < rmImageBtn.length; i++) {
        console.log(rmImageBtn[i]);

        rmImageBtn[i].addEventListener('click', function (e) {
            console.log(this.parentNode);


            e.preventDefault();
        });
    }


        //indexImg++;
}) ();