# Punta Cana para Brasileiros

Sistema de agendamento de passeios e transfers em Punta Cana, com site institucional, painel administrativo e programa de afiliados.

## Requisitos

- PHP 8.0+
- MySQL 5.7+ / MariaDB 10.3+
- Apache com mod_rewrite habilitado

## Instalação

1. Clone o repositório na raiz do seu servidor web (htdocs, www, etc.)
2. Configure as credenciais do banco de dados em `app/core/Database.php`
3. Execute os scripts SQL na ordem:
   - `database/001_create_database.sql`
   - `database/002_seed_initial_data.sql`
4. Acesse o admin: `/admin/login`
   - Email: `admin@puntacanaparabrasileiros.com`
   - Senha: `password` (mude após primeiro login!)

## Estrutura do Projeto

```
├── index.php                    # Front controller
├── .htaccess                    # URL rewriting
├── app/
│   ├── core/                    # Classes base (Database, Router, Controller)
│   ├── controllers/             # Controllers públicos
│   ├── controllers/admin/       # Controllers do painel admin
│   ├── models/                  # Models (acesso ao banco)
│   ├── helpers/                 # Funções auxiliares
│   └── views/                   # Views (templates)
│       ├── layouts/             # Layouts base (site e admin)
│       ├── partials/            # Componentes reutilizáveis
│       ├── site/                # Views do site público
│       ├── admin/               # Views do painel admin
│       └── errors/              # Páginas de erro
├── public/
│   ├── css/                     # Estilos
│   ├── js/                      # Scripts
│   ├── img/                     # Imagens estáticas
│   └── uploads/                 # Uploads de usuários
└── database/                    # Migrations SQL
```

## Funcionalidades

### Site Público
- Homepage institucional
- Listagem e detalhes de passeios com filtros
- Sistema de transfer (ida e volta, somente ida, múltiplos)
- Carrinho de compras
- Checkout com PayPal
- Voucher/ticket de confirmação
- Blog com categorias
- Busca
- Lista de desejos
- Programa de afiliados
- Páginas de contato, sobre nós, políticas

### Painel Admin
- Dashboard com métricas
- Gerenciamento de passeios (pacotes, faixas etárias, FAQ, documentos)
- Gerenciamento de transfers (veículos, rotas, locais)
- Gerenciamento de blog
- Gerenciamento de pedidos
- Gerenciamento de afiliados
- Gerenciamento de usuários
- **Tela de configurações** (SuperAdmin) - todas as APIs, SMTP, aparência, checkout

### Níveis de Permissão
- **superadmin**: Acesso total + configurações do sistema
- **admin**: Gerencia passeios, transfers, blog, pedidos, afiliados
- **support**: Acesso a pedidos e suporte
- **affiliate**: Painel de afiliado
- **client**: Conta do cliente, pedidos, vouchers

## Configurações

Todas as configurações do sistema ficam no banco de dados (tabela `system_configs`) e são gerenciadas pela tela de configurações do SuperAdmin em `/admin/configuracoes`. Não há arquivo `.env`.

## Moeda

O site opera em USD (Dólar Americano).

## Pagamento

PayPal é o método de pagamento principal, tanto para checkout quanto para repasse de afiliados.
