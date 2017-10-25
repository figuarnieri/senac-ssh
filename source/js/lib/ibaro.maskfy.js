class Maskfy {
    constructor(object) {
        this.objectTag = typeof object==='string' ? object : object.tag;
        this.objectSize = object.size;
        this.objectMask = object.mask;
        this.objectReverse = object.reverse;
        this.init(this.objectTag);
    }
    init(input) {
        const _this = this;
        document.querySelectorAll(input).forEach((tag) => {
            _this.paste(tag);
            _this.input(tag);
            _this.format(tag);
        });
    }
    input(input) {
        const _this = this;
        input.addEventListener('input', (e) => {
            const inputValue =  input.value
            , inputLength =  inputValue.length
            , mask = _this.objectMask || input.dataset.mask
            , maskLength = mask.length
            , maskSize = ( _this.objectSize || input.dataset.maskSize )
            , value = inputValue.replace(/\D/g, '')
            , valueFinal = value.split('')
            , objectReverse = _this.objectReverse || input.hasAttribute('data-mask-reverse')
            ;
            var i;
            if( inputLength > maskLength ) {
                valueFinal.pop();
            }
            if( objectReverse ) {
                if( /\d/.test(valueFinal[0]) && valueFinal.length>maskSize && valueFinal[0]==='0') {
                    valueFinal.shift();
                }
                for( i in inputValue.split('') ) {
                    if( /\D/.test(mask[maskLength-i-1]) ) {
                        valueFinal.splice(valueFinal.length-i, 0, mask[maskLength-i-1]);
                    }
                }
                if( (e.inputType==='deleteContentBackward') ) {
                    if( (value.length<maskSize) ) {
                        valueFinal.unshift(0);
                    }
                    if( (/\D/.test(valueFinal[0])) ) {
                        valueFinal.shift();
                    }
                }
            } else {
                for( i in inputValue.split('') ) {
                    if( /\D/.test(mask[i]) ) {
                        valueFinal.splice(i, 0, mask[i]);
                    }
                }
                if( e.inputType==='deleteContentBackward' ) {
                    for( i=valueFinal.length-1; i>=0 ; i-- ) {
                        (/\D/.test(valueFinal[i])) ? valueFinal.pop() : i=-1;
                    }
                }
            }
            input.value = valueFinal.join('');
            if(deviceType()==='mobile'||deviceType()==='tablet') {
                _this.responsive(input);
            }
        });
    }
    paste(input) {
        input.addEventListener('paste', (e) => e.preventDefault());
    }
    format(input) {
        const inputTrigger = input.value.split('')
        , inputLength = inputTrigger.length
        , objectSize = ( this.objectSize || input.dataset.maskSize || 0 )
        ;
        for( var i=objectSize; i>inputLength; i-- ) {
            inputTrigger.unshift(0);
        }
        input.value = '';
        inputTrigger.map((item) => {
            input.value += item;
            const eventTrigger = new MouseEvent('input');
            input.dispatchEvent(eventTrigger);
        });
    }
    responsive(input) {
        setTimeout(() => {
            input.selectionStart = input.selectionEnd = input.value.length;
            input.focus();
        }, 0);
    }
}