window.deviceType = function(e){
	return window.deviceType = (e >= 997) ? 'pc' : (e <= 996 && e > 600) ? 'tablet' : 'mobile';
}
deviceType(window.innerWidth);
document.querySelectorAll('[data-js]').forEach(item => {
	if(item.textContent.trim().length){
		const msg = {
			  text: 'Ueeeepa!! Chama os programadores e designers, pq exite algum script [data-js] nesta página, sem estar na all.js'
			, tag: item
		}
		console.info(msg);
	}
});
document.querySelectorAll('[data-css]').forEach(item => {
	if(item.sheet.cssRules.length){
		const msg = {
			  text: 'Exite um estilo na tag [data-css] nessa página'
			, tag: item
		}
		console.info(msg);
	}
});
/*
document.querySelector('[data-error-close]').addEventListener('click',function(e){
	var io_error = document.querySelector('.error-box');
	e.preventDefault();
	io_error.style.opacity=1;
	setInterval(function(){
		(io_error.style.opacity<=0) ? io_error.style.display='none' : io_error.style.opacity-=.05;
	},30);
});
*/
window.addEventListener('keyup', (e) => {
	if(e.keyCode===13 && e.ctrlKey===true){
		const url = location.host.replace(/^(www|local|log|dev)\.|\.(com|co|es|edu|gov|info|org|net|uol\.com)(|\.(br|))$/gi,'');
		window.open('http://adm.ibaro.com.br/'+url,'_blank');
	}
});
window.addEventListener('resize', () => {
	deviceType(window.innerWidth);
});
window.addEventListener('load', () => {
	document.querySelectorAll('img').forEach(item => {
		item.addEventListener('error', (img) => {
			img.target.classList.add('__error-img');
		})
	});
});