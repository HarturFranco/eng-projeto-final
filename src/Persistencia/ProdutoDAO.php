<?php

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

            if ($consulta) {
                $query = "DELETE FROM `Produto` WHERE proCodigo = " . $proCodigo; //TODO - tratar SQLInjection

                $conn->query($query);
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
            echo $e->getMessage();
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
            echo $e->getMessage();
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
            echo $e->getMessage();
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

    public function venderProduto($produto, $quantidadeVendida, $conn){
        if((int)($quantidadeVendida)){
        try{
            $consulta = $this->buscarPorCodigo($produto->getCodigo(), $conn);
            
            if($consulta){
            $novaQuantidade = $produto->getQtdEstoque() - $quantidadeVendida;

            $query = "UPDATE `Produto` SET 
                `proNome`='" . $produto->getNome() . "',
                `proPreco`='" . $produto->getPreco() . "',
                `proQtdEstoque`='" . $novaQuantidade. "',
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
