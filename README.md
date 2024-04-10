### Projeto baseado em Arquitetura limpa para criação de mini serviços de API usando PHP puro

- Projeto de autoria própria `antonio costa dos santos - <costaantonio883@gmail.com>` com licença MIT

### V1.0

### ADDED - Validations - Validações
`01/04/2024`
* Validações permitidas
    * string  -> Verifica se o valor é um texto
    * integer -> Verifica se o valor é um número
    * email   -> Verifica se o valor é um email válido
    * required -> Verifica se o campo chegou no body da requisição
    * cpf -> Verifica se o campo é um CPF
    * cnpj -> Verifica se o campo é um CNPJ
    * date -> Verifica se valor é uma data válida
    * password -> Verifica se o valor é uma senha válida `> 8 dígitos`;`Caractere especial`;`Uma letra maiúscula`;`Um número`
* Tratamento de erros - usando exceptions
* Roteamento de controllers - integrado direto no arquivo router
* Tratamento de request e response - retornando e coletando json
* Adicionado gestão de models 
* Multibancos


### ADDED - Suporte a Migrations e Seeds com Phinx
`08/04/2024`
* Para começar a usar os models, migrations e seeds, execute `composer db:init` e no arquivo gerado `phinx.json` informe as credenciais de banco de dados
* Crie uma nova migração com `composer migration` use PascalCase na nomeclatura da migration
* Subir as migrations com `composer migrate:up`
* Desfazer a migration com `composer migrate:down`
* Verificar status da migração com `composer migrate:status`
* Demais comandos disponíveis no arquivo `composer.json`
* Mais informações sobre os demais métodos do phinx, acessar [Documentação completa](https://book.cakephp.org/phinx/0/en/migrations.html#custom-column-types-default-values)

### LAUNCH - Versão 0.1.0-alpha
`09/04/2024`
* O usuário já pode usar uma instância do framework

### FIX - Correções de segurança e melhorias
`10/04/2024`
* Ajustado o core da aplicação para lidar com todos os tipos de erros possíveis
* O utilizador poderá criar rotas para o mesmo endpoint, passando métodos http diferentes
* O response foi remodelado, passando `status` no body da response por padrão
* O Handler de exceptions trata todas as exceptions, incluindo as do PDO
* Todos os métodos recebem `Request` e `Response` como injeção de dependência por padrão