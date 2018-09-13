
/*var imgs = document.querySelectorAll('div#trick_image');

//--------function avec assignation sur var--------- doit etre appelé ensuite

var recupImg = function (imgs) {
    for (var i = 0; i < imgs.length; i++) {
        var img = imgs[i];

        img.classList.toggle('budge');
        console.log(img);
    }
};

//Appel de recupImg
recupImg(imgs);*/

/************* feuille de style pour registration*****************/

let name = document.getElementById('registration_username');

let psswd1 = document.getElementById('registration_password_first'),
    psswd2 = document.getElementById('registration_password_second');


if (psswd1 && psswd2) {
    //psswd1.classList.add('bg-danger');
    psswd1.onkeyup = psswd2.onkeyup = psswd1.onblur = psswd2.onblur = function () {
        var value1 = psswd1.value;
        var value2 = psswd2.value;

        if (value1 && value2) {
            if (value1 === value2) {
                psswd1.className = 'form-control-success';
                psswd2.className = 'form-control-success';
            } else {
                psswd1.className = 'form-control-danger';
                psswd2.className = 'form-control-danger';
            }
        }
    };
}



let newImg = document.createElement('input');//creation d'un element

newImg.id = 'add_input';
newImg.type = 'text';
newImg.className = 'form-control';


let test = document.getElementById('form_input');//recup de la div parent


let cible = document.getElementById('registration_username');//username registration

//cible.value = 'votre nom';


let proto = document.querySelector('div#add_trick_image');

let cpt = document.getElementsByTagName('input');

let addInput = document.createElement('input');

let  cloneImage = ajoutImg.getAttribute('data-prototype');

let buttonAdd = document.getElementById('add_image');

let parser = new DOMParser();

let el = parser.parseFromString(cloneImage, "text/xml").firstChild;

el.id = "add_trick_image_" + 0;

console.log(ajoutImg);
console.log(cloneImage);
console.log(el);
//ajoutImg.setAttribute('dtProto')


buttonAdd.addEventListener('click', function(e) {

    /*el.attr('data_prototype').replace(/__name__label__/g, 'Image n°' + (1))
        .replace(/__name__/g,        1);*/
   // let res = el.getElementsByTagName('legend');
    //res.value = Image;
    ajoutImg.appendChild(el);
    //e.preventDefault();
    //return false;
    //console.log(e);

});



//


//console.log(test.childNodes);

//console.log(cible);



//test.insertAdjacentElement("afterbegin", newImg); // Insertion du nouvel élément juste apres le parent

//test.removeChild(document.getElementById('add_input'));//suppression du noeud ajouté

/*console.log(formGrp);
console.log(link);*/

//name.disabled = true; //rendre le champs intapable
/*
name.addEventListener('focus', function(e) {
    e.target.value = "vous avez le focus";
    //console.log(e);
});

name.addEventListener('blur', function(e) {
    e.target.value = "vous n'avez plus le focus";
    console.log(name.value);
});

/*****************Gestion confirm*******************************/


//onclick="confirm('');

//-----------Function Anonyme--------- s'auto appel

/*(function (imgs) {
    for (var i = 0; i < imgs.length; i++) {
        var img = imgs[i]; //variable isolée car function Anonyme

        console.log(img);
    }
})(imgs);






/*if (confirm('Voulez-vous exécuter le code JavaScript de cette page ?')) {
    alert('Le code a bien été exécuté !');
}*/

/*
var moveImg = function()
{
    for (var i = 0; i < imgs.length; i++) {
        var img = imgs[i];
        img.classList.toggle('budge')
    }

}*/


