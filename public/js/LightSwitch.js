let darkIcn = document.getElementById('dark');
let brightIcn = document.getElementById('bright');
let articleText = document.querySelector('.article_content');
let articleBackground = document.querySelector('.article');
let comment = document.querySelector('.comment');

class LightSwitch {

    darkMode() {
        let light = "dark";
        this.addLocalStorage(light);
        brightIcn.style.display = " block ";
        darkIcn.style.display = " none ";
        articleText.style.color = " white ";
        articleBackground.style.background = " rgb(25, 25, 25) ";
        comment.style.color = " white ";
        comment.style.background = " rgb(25, 25, 25) ";
    }

    brightMode() {
        let light = "bright";
        this.addLocalStorage(light);
        darkIcn.style.display = " block ";
        brightIcn.style.display = " none ";
        articleText.style.color = " black ";
        articleBackground.style.background = " white ";
        comment.style.color = " black ";
        comment.style.background = " white ";
    }

    addLocalStorage(light) {
        localStorage.setItem("lightMode", light);   
    }
}

if (brightIcn || darkIcn ) { 

    let lightSwitch = new LightSwitch();

    brightIcn.addEventListener('click', () => {
        lightSwitch.brightMode();
    })

    darkIcn.addEventListener('click', () => {
        lightSwitch.darkMode();
    })

    if(document.readyState !== 'loading') {
        if ( typeof localStorage !='undefined' && localStorage.lightMode) {
            if ( localStorage.lightMode === "dark" ) {
                lightSwitch.darkMode();
            } 
        }
    }
}
