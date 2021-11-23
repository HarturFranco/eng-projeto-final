<?php

require_once 'Persistencia/ItemVendaDAO.php';

class ProdutoDAO
{

    function __construct()
    {
    }

    // Cadastra/Salva novo produto
    function salvar($produto, $conn)
    {
        try {
            $query = "INSERT INTO `Produto`(`proNome`, `proPreco`, `proQtdEstoque`, `proDataCadastro`, `proDescricao`, `Categoria_catCodigo`) 
                    VALUES ('" . $produto->getNome() . "','" .
                $produto->getPreco() . "','" .
                $produto->getQtdEstoque() . "','" .
                $produto->getDataCadastro() . "','" .
                $produto->getDescricao() . "','" .
                $produto->getCategoria()->getCodigo() . "')";

            $res = $conn->query($query);

            if ($res)
                return $res;

            throw new Exception('Erro ao cadastrar produto no banco de dados');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    // Exclui
    function excluir($proCodigo, $conn)
    {
        try {
            $consulta = $this->buscarPorCodigo($proCodigo, $conn);

            $itemVendaDAO = new ItemVendaDAO();

            if ($consulta) {
                $res = $itemVendaDAO->verificaProduto($proCodigo, $conn);
                if (! $res) {
                    $query = "DELETE FROM `Produto` WHERE proCodigo = " . $proCodigo;

                    return $conn->query($query);
                }
                throw new Exception('Produto possui vendas cadastradas');
            } else {
                throw new Exception('Produto não existe no banco de dados');
            }
        } catch (PDOException $e) {
            throw new Exception('Erro ao conectar ao banco de dados.');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    // Retorna todos os produtos
    function listarTodos($conn)
    {
        try {
            $query = "SELECT * FROM Produto";

            $res = $conn->query($query);
            return $res->fetchAll();
        } catch (Exception $e) {
            throw new $e->getMessage();
        }
    }

    // busca um Produto por Codigo
    function buscarPorCodigo($proCodigo, $conn)
    {
        try {
            $query = "SELECT * FROM `Produto` WHERE `proCodigo` = " . $proCodigo;
            $res = $conn->query($query);

            return $res->fetch();
        } catch (Exception $e) {
            throw new $e->getMessage();
        }
    }


    // busca um Produto por Nome
    function buscarPorNome($proNome, $conn)
    {
        try {
            $query = "SELECT * FROM `Produto` WHERE `proNome` = " . $proNome;
            $res = $conn->query($query);

            return $res->fetchAll();
        } catch (Exception $e) {
            throw new $e->getMessage();
        }
    }

    // Edita um Produto
    function editar($produto, $conn)
    {
        try {
            $consulta = $this->buscarPorCodigo($produto->getCodigo(), $conn);

            if ($consulta) {
                $query = "UPDATE `Produto` SET 
                    `proNome`='" . $produto->getNome() . "',
                    `proPreco`='" . $produto->getPreco() . "',
                    `proQtdEstoque`='" . $produto->getQtdEstoque() . "',
                    `proDataCadastro`='" . $produto->getDataCadastro() . "',
                    `proDescricao`='" . $produto->getDescricao() . "',
                    `Categoria_catCodigo`='" . $produto->getCategoria()->getCodigo() . "' WHERE `proCodigo` = " . $produto->getCodigo();

                $res = $conn->query($query);

                return $res;
            } else {
                throw new Exception('Produto não existe no banco de dados');
            }
        } catch (PDOException $e) {
            throw new Exception('Erro ao conectar ao banco de dados.');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function venderProduto($produto, $quantidadeVendida, $conn, $tipo)
    {
        if ((int)($quantidadeVendida)) {
            try {
                $consulta = $this->buscarPorCodigo($produto->getCodigo(), $conn);

                if ($consulta) {
                    $novaQuantidade = 0;
                    if ($tipo === 'devolucao')
                        $novaQuantidade = $produto->getQtdEstoque() + $quantidadeVendida;
                    else
                        $novaQuantidade = $produto->getQtdEstoque() - $quantidadeVendida;

                    $query = "UPDATE `Produto` SET 
                `proNome`='" . $produto->getNome() . "',
                `proPreco`='" . $produto->getPreco() . "',
                `proQtdEstoque`='" . $novaQuantidade . "',
                `proDataCadastro`='" . $produto->getDataCadastro() . "',
                `proDescricao`='" . $produto->getDescricao() . "',
                `Categoria_catCodigo`='" . $produto->getCategoria()->getCodigo() . "' WHERE `proCodigo` = " . $produto->getCodigo();

                    $res = $conn->query($query);

                    return $res;
                } else
                    throw new Exception('Produto não existe no banco de dados');
            } catch (PDOException $e) {
                throw new Exception('Erro ao conectar ao banco de dados.');
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
            }
        }
    }
}
