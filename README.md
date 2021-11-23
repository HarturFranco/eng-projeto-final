# eng-projeto-final
Projeto final da disciplina de Engenharia de Software

## Sistema de Gerenciamento de uma loja de instrumentos musicais
O sistema a ser implementado será um sistema de gerenciamento loja de instrumentos musicais com dois tipos de usuário (funcionário e gerente) 
O funcionário poderá gerenciar  produtos, clientes, vendas. 
O gerente poderá fazer as mesmas ações do funcionário e também gerar relatórios.

## Linguagens:
- HTML5
- CSS3
- JavaScript
- PHP 7.4

## Banco de Dados:
- MySQL 5.7

## Servidor:
- Docker 20.10.7
- Docker-Compose 2.0
- Apache 2.4.43

## Configuração de ambiente:
- Instalar na maquina
    - <a href="https://www.docker.com/">Docker</a>
    - <a href="https://docs.docker.com/compose/install/">docker-compose</a>
- Para rodar o projeto
  - Faça o clone em seu ambiente local
  - Execute o comando `docker-compose up` no diretorio raiz do projeto
  - Acesse o <a href="http://localhost/">localhost</a>

## Ambiente de teste:
- Teste Unitario
    - Instalar na maquina
        - <a href="https://getcomposer.org/">Composer 2.1.12</a>
        - <a href="https://phpunit.de/">phpunit ^8</a>
    - Execute os comandos no diretorio raiz do projeto
        - `composer install`
        - `vendor/bin/phpunit`
- Teste de Validação
    - Instalar na maquina 
        - <a href="https://www.python.org/">Python ^3</a>
        - <a href="https://selenium-python.readthedocs.io/">Selenium 4.0.0</a>    
        - <a href="https://pypi.org/project/beautifulsoup4/">beautifulsoup4 4.9</a> 
    - Acesse o notebook em tests/teste/Selenium/Testes Selenium.ipynb
    - Execute as cedulas dos testes desejados

## Commits e Branches
- Regras de commit
  - ``feat:`` Uma nova feature
 
  - ``fix:`` Correções de bugs
    
  - ``docs:`` Alteração na documentção
    
  - ``refactor:`` Refatorações que não são feature, nem melhoria
    
    
- Regras de uso de branch
  - Todas features são commitadas em develop. Quando aprovadas, é criado um Pull Request para master

- Pull Request
  -  Todos Pull Requests devem ser linkados com uma issue antes de ser aprovados. 


## Estrutura de Pastas
```
raiz/
├── db (Banco de dados)
└── docs (Documentação)
└── src (Códigos)
```

- db (Banco de dados)
- docs (Documentação)
- src (Códigos)
    
    
    
