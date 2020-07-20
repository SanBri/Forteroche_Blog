let deleteIcn = document.getElementById('deletePostImgIcn');
let image = document.getElementById('actualPostImage');
let imageText = document.getElementById('actualImageText');
let imageCheckbox = document.getElementById('deletedImageCheck')

class PostImage {

    hideImage() {
        image.style.display = " none ";
        deleteIcn.style.display = " none ";
        imageText.style.display = " none ";
        imageCheckbox.checked = true;
        alert("N'oubliez pas de valider la supression d'image !");
    }
}

let deleteImg = new PostImage;
if ( deleteIcn ) {
    deleteIcn.addEventListener('click', () => {
        deleteImg.hideImage();
    })
}