### Projeto baseado em Arquitetura limpa para criação de mini serviços de API usando PHP puro

- Projeto de autoria própria `antonio costa dos santos - <costaantonio883@gmail.com>` com licença MIT

### V1.0

### ADDED - Validations - Validações
`01/04/2024`
* Validações permitidas - 6
    * string
    * integer
    * email
    * required
    * cpf
    * cnpj
* Tratamento de erros - usando exceptions
* Roteamento de controllers - integrado direto no arquivo router
* Tratamento de request e response - retornando e coletando json
* Adicionado gestão de models 
* Multibancos

### ADDED - Suporte a Migrations e Seeds com Phinx
`08/04/2024`
* Para começar a usar os models, migrations e seeds, copie o arquivo `phinx.example` e renomeie para `phinx.json` e informe as credenciais de banco de dados
* Crie uma nova migração com `composer new:migration` use PascalCase na nomeclatura da migration
* Subir as migrations com `composer migrate:up`
* Desfazer a migration com `composer migrate:down`
* Verificar status da migração com `composer migrate:status`
* Demais comandos disponíveis no arquivo `composer.json`
* Mais informações sobre os demais métodos do phinx, acessar [[Documentação completa]](https://book.cakephp.org/phinx/0/en/contents.html)