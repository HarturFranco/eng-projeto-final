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
  const money = parseInt(value.replace(/[\D]+/g, '')) / 100
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
    if(uri) window.location.href = uri

    document.body.removeChild(overlay)
    document.body.removeChild(modal)
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
    openModal(mensagem, uri)
  }
}

hasError()

// ===================== CADASTRO DE VENDA ======================
const adicionarProduto = () => {
  const selectProduto = document.querySelector('select[name=pProduto]')
  const { selectedIndex } = selectProduto

  const produtoSelecionado = selectProduto.options[selectedIndex]

  const produtoValido = produtoSelecionado.disabled === false && produtoSelecionado


  if (produtoValido) {
    const quantidadeSelecionada = Number(document.querySelector('input[name=pQtd]').value)
    const codigo = Number(produtoSelecionado.value)
    const nome = produtoSelecionado.text
    const valor = Number(produtoSelecionado.getAttribute('preco'))
    const qtdEstoque = Number(produtoSelecionado.getAttribute('qtd'))
    const produto = { codigo, nome, valor, qtdEstoque }

    const inputProdutos = document.querySelector('input[name=vProdutos]')
    const inputPreco = document.querySelector('input[name=vValor]')

    if(
      quantidadeSelecionada !== '' && 
      quantidadeSelecionada <= produto.qtdEstoque &&
      quantidadeSelecionada > 0
      ){
      // adiciona produto no HTML
      const div = document.querySelector('.prodtucts-selected')
      div.innerHTML += `
        <div class="product">
          <div>${quantidadeSelecionada}</div>
          <div>${produto.nome}</div>
          <div>${Number(produto.valor).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'})}</div>
          <div>${Number(produto.valor * quantidadeSelecionada).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'})}</div>
        </div>
      `
      // diminui quantidade do estoque no HTML
      produtoSelecionado.setAttribute('qtd', qtdEstoque - quantidadeSelecionada)

      // coloca no 'carrinho'
      let carrinho

      if(inputProdutos.value)
        carrinho = JSON.parse(inputProdutos.value)
      else
        carrinho = []

      //item no carrinho, apenas edita
      if(carrinho.find(item => item.proCodigo === produto.codigo)){
        carrinho = carrinho.map(item => {
          if(item.proCodigo === produto.codigo){
            return {
              ...item,
              proQuantidade: Number(item.proQuantidade) + Number(quantidadeSelecionada)
            }
          }
          return item
        })
      }else {
        carrinho = [...carrinho, {
          proCodigo: produto.codigo,
          proQuantidade: quantidadeSelecionada,
          proValor: produto.valor
        }]
      }

      inputProdutos.value = JSON.stringify(carrinho)

      const totalDiv = document.querySelector('.value_total')
      
      const total = carrinho.reduce((acc, item) => {
        return (item.proQuantidade * item.proValor) + acc
      }, 0)

      totalDiv.innerHTML = total.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'})
      inputPreco.value = total
    } else {
      openModal('Quantidade indisponivel no estoque')
    }
  }

}


const buttonAddVenda = document.getElementById('button-adicionar_venda')
buttonAddVenda?.addEventListener('click', adicionarProduto)

// ===================== SUBMIT DE VENDA ======================

const submitVenda = document.querySelector('.submit_venda')

submitVenda?.addEventListener('click', () => {
  const inputProdutos = document.querySelector('input[name=vProdutos]')
  if(inputProdutos.value === ''){
    openModal('Selecione ao menos um produto')
  }
})