// ===================== MENU ======================
const onLoadMenu = () => {
  const itemsSubMenu = document.getElementsByClassName('submenu_item');

  const currentMenu = window.location.href.split('/')[3] || 'vendas'
  document.getElementById(currentMenu)?.classList.add('active')

  const currentSubMenu = window.location.href.split('/')[4]
  for(const item of itemsSubMenu){
    if(item.id === currentSubMenu) item.classList.add('active')
  }
  
}

onLoadMenu()

// TODO: implementar filtro de busca geral