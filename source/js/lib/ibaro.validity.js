class Validity {
  constructor (element) {
    const _this = this
    _this.element = document.querySelectorAll(element)
    _this.validityCustom = {
      cpf: {
        fn: function (input) {
          const value = input.value,
            valueNumber = value.replace(/[^\d]+/g, '')

          var add, i, rev
          if (valueNumber.length !== 11 || /(0{11}|1{11}|2{11}|3{11}|4{11}|5{11}|6{11}|7{11}|8{11}|9{11})/.test(valueNumber)) {
            _this.validityAddClass(input)
            return false
          }
          add = 0
          for (i = 0; i < 9; i++) {
            add += parseInt(valueNumber[i]) * (10 - i)
          }
          rev = 11 - (add % 11)
          if (rev === 10 || rev === 11) {
            rev = 0
          }
          if (rev !== parseInt(valueNumber[9])) {
            _this.validityAddClass(input)
            return false
          }
          add = 0
          for (i = 0; i < 10; i++) {
            add += parseInt(valueNumber[i]) * (11 - i)
          }
          rev = 11 - (add % 11)
          if (rev === 10 || rev === 11) {
            rev = 0
          }
          if (rev !== parseInt(valueNumber[10])) {
            _this.validityAddClass(input)
            return false
          }
          _this.validityRemoveClass(input)
          return true
        },
        msgError: 'Número de CPF inválido'
      },
      cnpj: {
        fn: function (input) {
          const value = input.value,
            valueNumber = value.replace(/[^\d]+/g, '')

          var resultado,
            tamanho,
            numeros,
            digitos,
            soma,
            pos,
            i

          if (valueNumber.length !== 14 || /(0{14}|1{14}|2{14}|3{14}|4{14}|5{14}|6{14}|7{14}|8{14}|9{14})/.test(valueNumber)) {
            _this.validityAddClass(input)
            return false
          }
          tamanho = valueNumber.length - 2
          numeros = valueNumber.substring(0, tamanho)
          digitos = valueNumber.substring(tamanho)
          soma = 0
          pos = tamanho - 7
          for (i = tamanho; i >= 1; i--) {
            soma += numeros[tamanho - i] * pos--
            if (pos < 2) {
              pos = 9
            }
          }
          resultado = soma % 11 < 2 ? 0 : 11 - soma % 11
          if (resultado != digitos[0]) {
            _this.validityAddClass(input)
            return false
          }

          tamanho = tamanho + 1
          numeros = valueNumber.substring(0, tamanho)
          soma = 0
          pos = tamanho - 7
          for (i = tamanho; i >= 1; i--) {
            soma += numeros[tamanho - i] * pos--
            if (pos < 2) {
              pos = 9
            }
          }
          resultado = soma % 11 < 2 ? 0 : 11 - soma % 11
          if (resultado != digitos[1]) {
            _this.validityAddClass(input)
            return false
          }
          _this.validityRemoveClass(input)
          return true
        },
        msgError: 'Número de CNPJ inválido'
      },
      letters: {
        fn: function (input) {
          const value = input.value
          if (/\d/.test(value)) {
            _this.validityAddClass(input)
          } else {
            _this.validityRemoveClass(input)
          }
        },
        msgError: 'Campo não pode conter números'
      }
    }
    this.init()
  }
  init () {
    const _this = this
    _this.element.forEach(tag => {
      tag.querySelectorAll('input, textarea, select').forEach(input => {
        _this.attributes(input)
      })
      tag.addEventListener('submit', (e) => {
        e.preventDefault()
        _this.validity(tag)
      })
    })
  }
  attributes (input) {
    const attributes = ['min', 'max'],
      inputs = ['email', 'url', 'date', 'number', 'tel']

    if (input.required) {
      input.dataset.validityRequired = ''
      input.removeAttribute('required')
    }
    if (input.accept) {
      input.setAttribute('data-validity-accept', input.accept)
    }
    attributes.map(item => {
      const attr = input[item]
      if (attr) {
        const datacustom = item[0].toUpperCase() + item.slice(1)
        input.setAttribute('data-validity-' + item, input[item])
        input.removeAttribute(item)
      }
    })
    inputs.map(item => {
      if (input.type === item) {
        input.dataset.validityType = item
        input.type = 'text'
      }
    })
  }
  validityAddClass (input) {
    input.classList.add('validity--input-failed')
  }
  validityRemoveClass (input) {
    input.classList.remove('validity--input-failed')
  }
  validity (tag) {
    const _this = this
    tag.querySelectorAll('input, textarea, select').forEach(input => {
      const type = input.getAttribute('data-validity-type') || input.type,
        value = input.type === 'file' ? input.value : input.value = input.value.trim(),
        msgError = []

      _this.validityRemoveClass(input)
      input.removeAttribute('data-validity-error')
      if (input.hasAttribute('data-validity-required') && value === '') {
        _this.validityAddClass(input)
        msgError.push('Campo Obrigatório')
      }
      if (type) {
        switch (type) {
          case 'email':
            if (!/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(value)) {
              _this.validityAddClass(input)
              msgError.push('E-mail Inválido')
            }
            break
          case 'url':
            if (!/^[(f|ht)tp?s].+.\D$/.test(value)) {
              _this.validityAddClass(input)
              msgError.push('URL inválida. Inicie a url com "http://"')
            }
            break
          case 'date':
            if (!/^\d{1,2}[-|\/]\d{1,2}[-|\/]\d{2,4}$/.test(value) && value.length > 0) {
              _this.validityAddClass(input)
              msgError.push('Data Inválida. Formato deve ser DD/MM/AAAA')
            }
            break
          case 'number':
            if (isNaN(value)) {
              _this.validityAddClass(input)
              msgError.push('Número Inválido')
            }
            break
          case 'tel':
            if (!/^[\(|\d]+\d(\)|\) | )(\d{3,5}(|-| )\d{4,5})$/.test(value)) {
              _this.validityAddClass(input)
              msgError.push('Telefone Inválido. Ex.: (99) 9999-99999')
            }
            break
        }
      }
      if (input.hasAttribute('data-validity-max')) {
        const max = parseFloat(input.getAttribute('data-validity-max'))
        if (input.type === 'file' && input.files.length > 0) {
          Object.keys(input.files).map(item => {
            if (max < input.files[item].size / 1024) {
              _this.validityAddClass(input)
              msgError.push(`Arquivo deve ter até ${max} Kb`)
            }
          })
        } else {
          if (max < parseFloat(value)) {
            _this.validityAddClass(input)
            msgError.push(`Valor máximo até ${max}`)
          }
        }
      }
      if (input.hasAttribute('data-validity-min')) {
        const min = parseFloat(input.getAttribute('data-validity-min'))
        if (input.type === 'file' && input.files.length > 0) {
          Object.keys(input.files).map(item => {
            if (min > input.files[item].size / 1024) {
              _this.validityAddClass(input)
              msgError.push(`Arquivo deve ter no mínimo ${min} Kb`)
            }
          })
        } else {
          if (min > parseFloat(value)) {
            _this.validityAddClass(input)
            msgError.push(`Valor mínimo de ${min}`)
          }
        }
      }
      if (input.hasAttribute('data-validity-custom')) {
        try {
          const custom = _this.validityCustom[input.getAttribute('data-validity-custom')]
          custom.fn(input)
          msgError.push(custom.msgError)
        } catch (e) {
          console.log(`Create custom function: ${input.getAttribute('data-validity-custom')} in validityCustom`)
        }
      }
      if (input.hasAttribute('data-validity-accept') && input.files.length > 0) {
        const accept = input.getAttribute('data-validity-accept').replace(/,/g, '|'),
          regex = new RegExp(`(${accept})$`)

        Object.keys(input.files).map(() => {
          if (!regex.test(value)) {
            _this.validityAddClass(input)
            msgError.push(`Permitido apenas arquivos (${accept.replace(/\|/g, '&#44; ')})`)
          }
        })
      }
      _this.setMensage(msgError, input)
    })
    _this.validityCheck(tag)
  }
  setMensage (msgArray, input) {
    if (input.classList.value.split(' ').includes('validity--input-failed')) {
      input.setAttribute('data-validity-error', msgArray.join(','))
    }
  }
  validityCheck (form) {
    const _this = this
    if (!form.querySelector('.validity--input-failed')) {
      _this.send(form)
    } else {
      document.querySelectorAll('.validity--notice').forEach(item => {
        item.remove()
      })
      form.querySelectorAll('.validity--input-failed').forEach((input, i) => {
        var getRect = input.getBoundingClientRect(),
          top = getRect.top + 2 + window.scrollY,
          height = input.tagName === 'TEXTAREA' ? 19 : getRect.height - 4,
          right = getRect.right - height - 2,
          error = input.getAttribute('data-validity-error').split(',')

        console.log(getRect)
        document.body.insertAdjacentHTML('beforeend', `<label class="validity--notice" style="left:${right}px; top:${top}px; width:${height}px; height:${height}px; line-height:${height}px;"></label>`)
        var alertbox = document.body.lastElementChild
        alertbox.insertAdjacentHTML('beforeend', `<input class="validity--alertinput" type="checkbox" /><div class="validity--alertbox"><div class="validity--alert"><ul class="validity--list"></ul></div></div>`)
        for (var msg of error) {
          alertbox.querySelector('.validity--list').insertAdjacentHTML('beforeend', `<li class="validity--item">${msg}</li>`)
        }
        alertbox.addEventListener('mouseover', (event) => {
          const tag = event.target,
            eventY = event.y,
            windowHeight = window.innerHeight

          if (eventY < windowHeight / 2) {
            tag.classList.add('validity--notice-bottom')
          }
        })
      })
    }
  }
  send (form) {
    const formData = new FormData(form),
      xhr = new XMLHttpRequest(),
      button = form.querySelector('[type="submit"], button:not([type])')

    var status = document.querySelector('.validity--status'),
      message = document.querySelector('.validity--message')

    xhr.open('POST', form.action, true)
    xhr.addEventListener('loadstart', (e) => {
      button.setAttribute('data-validity-button', button.textContent)
      button.disabled = 'disabled'
      button.textContent = 'Enviando...'
      if (status === null) {
        form.insertAdjacentHTML('beforeend', '<div class="validity--status"><div class="validity--message"></div><button type="button" class="validity--close"></button></div>')
        status = document.querySelector('.validity--status')
        message = document.querySelector('.validity--message')
      }
    })
    xhr.addEventListener('loadend', (e) => {
      button.textContent = button.getAttribute('data-validity-button')
      button.removeAttribute('disabled')
      status.classList.add('validity--status-complete')
      const close = document.querySelector('.validity--close'),
        closeEvent = setTimeout(() => {
          const eventTrigger = new MouseEvent('click')
          close.dispatchEvent(eventTrigger)
        }, 3000)
      close.addEventListener('click', (event) => {
        status.classList.add('validity--status-remove')
        const remove = document.querySelector('.validity--status-remove'),
          animationduration = window.getComputedStyle(remove).animationDuration,
          timeduration = parseFloat(animationduration.replace('s', '')) * 1000

        setTimeout(() => {
          status.remove()
          clearTimeout(closeEvent)
        }, timeduration)
      })
    })
    xhr.addEventListener('load', (e) => {
      button.textContent = button.getAttribute('data-validity-button')
      button.removeAttribute('disabled')

      switch (xhr.status) {
        case 200 :
          status.classList.add('validity--status-ok')
          message.textContent = (form.dataset.validitySuccess || 'Sua Mensagem foi enviada com sucesso!')
          form.querySelectorAll('input, select, textarea').forEach(tag => {
            tag.value = ''
          })
          break
        case 404 :
          status.classList.add('validity--status-error')
          message.textContent = 'Form Action URI: 404 Error'
        case 500 :
          status.classList.add('validity--status-error')
          message.textContent = 'Form Action URI: 500 Error'

          break
      }
    })
    xhr.send(formData)
  }
}
