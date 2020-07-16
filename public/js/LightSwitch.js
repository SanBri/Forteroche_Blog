let darkIcn = document.getElementById('dark');
let brightIcn = document.getElementById('bright');
let articleText = document.querySelector('.article_content');
let articleBackground = document.querySelector('.article')

class LightSwitch {

    brightMode() {
        brightIcn.style.display = " block ";
        darkIcn.style.display = " none ";
        articleText.style.color = " white ";
        articleBackground.style.background = " black ";
    }

    darkMode() {
        darkIcn.style.display = " block ";
        brightIcn.style.display = " none ";
        articleText.style.color = " black ";
        articleBackground.style.background = " white ";
    }
}

let light = new LightSwitch;

brightIcn.addEventListener('click', () => {
    light.darkMode();
})

darkIcn.addEventListener('click', () => {
    light.brightMode();
})