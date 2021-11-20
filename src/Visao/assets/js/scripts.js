// ===================== MENU ======================
const onLoadMenu = () => {
  const itemsSubMenu = document.getElementsByClassName('submenu_item');

  const currentMenu = window.location.href
    .split('/')[3]
    ?.split('?')[0]
    ||
    'vendas'
  document.getElementById(currentMenu)?.classList.add('active')

  const currentSubMenu = window.location.href
    .split('/')[4]
    ?.split('?')[0]
  for (const item of itemsSubMenu) {
    if (item.id === currentSubMenu) item.classList.add('active')
  }

}

onLoadMenu()


// ===================== INPUT FILTER ======================
const filterInput = document.querySelector('input[name=search]')

const filter = () => {
  const lines = document.querySelectorAll('tr')

  const filters = filterInput.value.toLowerCase().trim().split(' ')

  lines.forEach((line, i) => {
    if (!i) return

    let hasFilter = false

    filters
      .forEach(str => {
        const lineToString = line.getAttribute('string').toLowerCase()
        if (lineToString.indexOf(str) >= 0)
          hasFilter = true
      })

    if (hasFilter)
      line.classList.remove('hidden-tr')
    else
      line.classList.add('hidden-tr')
  })

}
filterInput?.addEventListener('keypress', (e) => {
  if (e.key === 'Enter')
    filter()
})

// ===================== MASKS ======================
const maskPrice = (value) => {
  console.log('value', value)
  const money = parseInt(value.replace(/[\D]+/g, ''))/100
  if (typeof money === "number")
    return Number(money)?.toLocaleString('pt-br', {
      style: 'currency',
      currency: 'BRL',
      maximumFractionDigits: 2
    })
  return value
}

/* const priceInputs = document.querySelectorAll('input[class=price]')
priceInputs.forEach(input => {
  input.addEventListener('keypress', (e) => {
    const { value } = input
    input.value = maskPrice(value)
  })
}) */


// ===================== MODAL DE ERRO ======================
const openModal = (mensagem, uri) => {
  const overlay = document.createElement('div')
  overlay.classList.add("overlay")

  const modal = document.createElement('div')
  modal.classList.add('modal')

  const title = document.createElement('h2')
  title.innerHTML = mensagem.split('.')[0]

  const detail = document.createElement('p')
  detail.innerHTML = mensagem.split('.')[1] ? mensagem.split('.')[1] : ''

  const button = document.createElement('button')
  button.innerHTML = 'Fechar'


  modal.appendChild(title)
  modal.appendChild(detail)
  modal.appendChild(button)

  document.body.appendChild(overlay)
  document.body.appendChild(modal)

  const closeModal = () => {
    window.location.href = uri
  }

  button.addEventListener('click', closeModal)
  overlay.addEventListener('click', closeModal)
}

const hasError = () => {
  const [uri, erro] = decodeURIComponent(window.location.href)
    .split('?')
  const hasError = erro?.indexOf('erro=')
  if (hasError !== undefined && hasError !== -1) {
    const mensagem = erro.split('=')[1]
    openModal(`Erro ao ${mensagem}`, uri)
  }
}

hasError()