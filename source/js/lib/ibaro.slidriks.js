class Slidriks{
  constructor(tag){
    document.querySelectorAll(tag).forEach((item, i) => {
      const json = {"id": `slidriks${i}`,"views": 4,"width": item.offsetWidth,"navigate": true,"paginate": true,"childSize": item.children.length,"childWidth": item.offsetWidth/4};
      item.dataset.slidriksId = json.id;
      window.sessionStorage.setItem(`slidriks${i}`, JSON.stringify(json));
      this.init(item);
    });
  }
  init(item){
    const contentHTML = item.innerHTML
    , json = JSON.parse(window.sessionStorage.getItem(item.dataset.slidriksId))
    ;

    item.classList.add('slidriks--main');
    item.innerHTML = `<div class="slidriks--slider" id="${json.id}"><div class="slidriks--wrapper"><div class="slidriks--content" style="width: ${json.childWidth * json.childSize}px;transform: translateX(0px);" data-slidriks-x="0">${contentHTML}</div></div><div class="slidriks--controls"><div class="slidriks--navigation"></div><div class="slidriks--paginate"></div></div>`;
    item.querySelectorAll('.slidriks--content > *').forEach( li => {
      li.outerHTML= `<div class="slidriks--children" style="width: ${json.childWidth}px;">${li.outerHTML}</div>`;
    });

    if(json.navigate) this.navigate(json);
    if(json.paginate) this.paginate(json);

    this.animation = null;
    this.mousedown(json);
    this.mousemove(json);
    this.mouseup(json);
  }
  navigate(json){
    const item = window[json.id];

    item.querySelector('.slidriks--navigation').insertAdjacentHTML('beforeend','<div class="slidriks--side slidriks--side-prev">&#8249;</div><div class="slidriks--side slidriks--side-next">&#8250;</div>');
    item.querySelectorAll('.slidriks--side').forEach(side => {
      side.addEventListener('click', event => {
        const contentX = parseFloat(item.querySelector('.slidriks--content').style.transform.replace(/translateX\(|px\)/g,'')) 
        if(side.classList.contains('slidriks--side-prev')){
          if(contentX >= 0) return;
          this.slide(json, contentX + json.childWidth);
        } else {
          if(-(json.childWidth * json.childSize - json.width) >= contentX) return;
          this.slide(json, contentX - json.childWidth);
        }
      });
    });
  }
  paginate(json){
    const pageLoop = Math.floor(json.childSize/json.views) + (json.childSize%json.views!==0 ? 1 : 0)
    , item = window[json.id]
    , content = item.querySelector('.slidriks--content')
    ;

    for(let i=0; i<pageLoop; i++){
      item.querySelector('.slidriks--paginate').insertAdjacentHTML('beforeend',`<span class="slidriks--page">${i}</span>`);
    }
    item.querySelectorAll('.slidriks--page').forEach( page => {
      page.addEventListener('click', event => {
        const index = json.views * parseInt(page.textContent)
        , indexChild = content.children[index+json.views-1] ? content.children[index] : content.children[index - (json.views-json.childSize%json.views)]
        , itemLeft = indexChild.offsetLeft
        ;
        this.slide(json, -itemLeft)
      });
    });
  }
  slide(json, value){
    const content = window[json.id].querySelector('.slidriks--content');
    content.classList.add('slidriks--animation');
    content.dataset.slidriksX = value;
    content.style.transform = `translateX(${value}px)`;
    clearTimeout(this.animation);
    this.animation = setTimeout(() => {
      content.classList.remove('slidriks--animation');
    }, 310);
  }
  mousedown(json){
    const item = window[json.id]
    , content = item.querySelector('.slidriks--content')
    ;
    item.addEventListener('mousedown', event => {
      content.classList.add('slidriks--mousemove');
      content.dataset.slidriksClick = event.screenX;
    });
  }
  mousemove(json){
    const item = window[json.id]
    , content = item.querySelector('.slidriks--content')
    ;
    document.addEventListener('mousemove', event => {
      if(content.classList.contains('slidriks--mousemove')){
        let current = parseFloat(content.dataset.slidriksX)
        , click = content.dataset.slidriksClick
        , move = click - event.screenX
        ;
        if(current - move > 0){
          content.style.transform = `translateX(0px)`;
          return;
        }
        if(current - move < -(json.childWidth * json.childSize - json.width)){
          return;
        }
        content.style.transform = `translateX(${current - move}px)`;
      }
    });
  }
  mouseup(json){
    const item = window[json.id]
    , content = item.querySelector('.slidriks--content')
    ;
    'mouseleave mouseup'.split(' ').map( event => {
      document.addEventListener(event, () => {
        if(content.classList.contains('slidriks--mousemove')){
          const current = parseFloat(content.style.transform.replace(/translateX\(|px\)/g,''))
          , currentX = Math.abs(current)
          , itemOffset = Math.floor(currentX / json.childWidth)
          , itemIndex = currentX - (itemOffset * json.childWidth) > (json.childWidth/2) ? itemOffset + 1 : itemOffset
          , itemLeft = content.children[itemIndex].offsetLeft
          ;
          content.classList.remove('slidriks--mousemove');
          this.slide(json, -itemLeft);
        }
      });
    });
  }
}