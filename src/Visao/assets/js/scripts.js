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

// TODO: implementar filtro de busca geral


// ===================== MODAL DE ERRO ======================
const openModal = (mensagem, uri) => {
  const overlay = document.createElement('div')
  overlay.classList.add("overlay")

  const modal = document.createElement('div')
  modal.classList.add('modal')

  const title = document.createElement('h2')
  title.innerHTML = mensagem

  const button = document.createElement('button')
  button.innerHTML = 'Fechar'


  modal.appendChild(title)
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