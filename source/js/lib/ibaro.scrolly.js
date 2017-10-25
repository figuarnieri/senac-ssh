class Scrolly{
	constructor(obj) {
		let tag;
		if(typeof obj === 'object'){
			tag = obj.tag;
			this.scrollAfter = obj.scrollAfter || null;
		} else {
			tag = obj;
		}
		document.querySelectorAll(tag).forEach( item => {
			this.init(item);
		});
	}
	init(tag) {
		tag.addEventListener('click', event => {
			event.preventDefault();
			let hash = tag.hash.replace('#','')
			, target = window[hash]
			, targetTop = target.offsetTop
			, hasParent = target.parentElement
			;
			for(let i=0;i < document.all.length;i++){
				if(hasParent!==null && window.getComputedStyle(target.parentNode).position!=='static'){
					targetTop += hasParent.offsetTop;
					hasParent = hasParent.parentElement;
				} else {
					break;
				}
			}
			sessionStorage.setItem('scrolly', `{
				  "target": "${hash}"
				, "side": ${window.scrollY > targetTop ? true : false}
				, "to": ${targetTop}
				, "speed": ${Math.abs(window.scrollY - targetTop) / 90}
			}`);
			if(this.scrollAfter){
				tag.dataset.scrollyClick='';
			}
			this.scroll();
		});
	}
	scroll(){
		const JSONScrolly = JSON.parse(sessionStorage.getItem('scrolly'))
		, y = window.scrollY
		;
		if(JSONScrolly.side ? (y - JSONScrolly.speed > JSONScrolly.to) : (y + JSONScrolly.speed < JSONScrolly.to)){
			window.scroll(0, JSONScrolly.side ? (y - JSONScrolly.speed) : (y + JSONScrolly.speed));
			setTimeout(() => {
				this.scroll();
			}, 0);
		} else {
			window.scroll(0, JSONScrolly.to);
			setTimeout(() => {
				if(this.scrollAfter){
					this.after();
				}
			}, 0);
		}
	}
	after(){
		const click = document.querySelector('[data-scrolly-click]')
		, target = JSON.parse(sessionStorage.getItem('scrolly')).target
		;
		click.removeAttribute('data-scrolly-click');
		this.scrollAfter(click, window[target])
	}
}