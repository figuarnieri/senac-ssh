class Icons {
    constructor(){
        const url = [{
            "family" : "FontAwesome",
            "name": "Font Awesome",
            "url": "/source/scss/lib/ibaro-icons/_font-awesome.scss",
        }, {
            "family" : "Material Icons",
            "name": "Material Icons",
            "url": "/source/scss/lib/ibaro-icons/_material-icons.scss",
        }, {
            "family" : "Hawcons Stroke",
            "name": "Hawcons Stroke",
            "url": "/source/scss/lib/ibaro-icons/_hawcons-stroke.scss",
        }, {
            "family" : "Ionicons",
            "name": "Ion Icons",
            "url": "/source/scss/lib/ibaro-icons/_ionicons.scss",
        }];
        url.map((item, i) => {
            fetch(item.url).then(
                res => res.text()
            ).then(res => {
                var array = res.split('}')
                , iconWrap = document.getElementById('icon-box').content
                , iconItem = document.getElementById('icon-item').content
                , iconCount = document.getElementById('icon-count')
                , iconCountText = parseInt(document.getElementById('icon-count').innerText)
                , iconArray = [];
                ;
                array.pop();
                iconWrap.querySelector('.font-title').innerText = item.name;
                iconWrap.querySelector('.fonts-grid').id = 'font-grid-'+i;
                document.getElementById('main-icons').insertAdjacentHTML('beforeend', iconWrap.children[0].outerHTML);

                array.forEach(icon => iconArray.push(icon.replace(/\s/g,'').split(':before{content:')));


                const grid = document.getElementById('font-grid-'+i);
                for(var icon of iconArray){
                    const name = icon[0].replace('.','').replace(/:before\,\./g,', ')
                    , ico = icon[1].replace('"\\','\&#x').replace('";',';')
                    ;
                    grid.style.fontFamily = item.family;
                    iconItem.querySelector('.io-icon-ico').innerHTML = ico;
                    iconItem.querySelector('.io-icon-bgname').textContent = name;
                    iconItem.querySelector('.io-icon-code').textContent = icon[1].replace('"','').replace('";','');
                    grid.insertAdjacentHTML('beforeend', iconItem.children[0].outerHTML);
                }
                iconCount.textContent = (iconArray.length + iconCountText);
            });
        });
        document.querySelectorAll('[data-color]').forEach(item => {
            item.addEventListener('click', (event) => {
                document.body.removeAttribute('class');
                document.body.classList.add(event.target.dataset.color);
            });
        });
        document.querySelector('[data-search]').addEventListener('input', (event) => {
            var regex = new RegExp(event.target.value, 'g');
            document.querySelectorAll('.io-icon-item').forEach(item => {
                var txt = item.querySelector('.io-icon-name').textContent;
                regex.test(txt) ? item.classList.remove('d-n') : item.classList.add('d-n');
            });
            var iconSize = document.querySelectorAll('.io-icon-item:not(.d-n)').length;
            document.getElementById('icon-count').textContent = IconSize;
        });
    }
}
