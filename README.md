![capa-redes](https://github.com/user-attachments/assets/20051d3a-ecbf-4d01-8c29-50c43b8d3af4)

O PHPay é uma biblioteca PHP que tem o objetivo tornar o trabalho de integrações com gateways de pagamento mais simples e descomplicadas, facilitando a conexão entre tecnologia e negócios em produtos de software.

## 💸 Gateways

- Asaas (cobranças, gestão de clientes e webhooks)
- Efí (cobranças)

## 📦 Instalação

Instale via Composer:

```php
composer require phpay-io/phpay
```

## ⚙️ Como usar o PHPay?

### Asaas

```php
/**
 * @var AsaasGateway $phpay
 */
$phpay = new PHPay(new AsaasGateway(TOKEN_ASAAS_SANDBOX));
```

### Efí

```php
/**
 * @var EfiGateway $phpay
 */
$phpay = new PHPay(new EfiGateway(CLIENT_ID, CLIENT_SECRET));
```

## Gerando uma Cobrança

```php
$phpay
    ->charge($charge)
    ->setCustomer($customer)
    ->create();
```

## 📝 Roadmap

- Definições de Arquitetura ✅
- Domínios ✅
- Documentação 🕑
- Site 🕛
- Gateways ✍️

  - Asaas.

  - Cobranças ✅
  - Clientes ✅
  - Webhook ✅
  - Pix 🕥

  - Efí.

  - Autorização ✅
  - Cobranças ✅
  - Clientes 🕥
  - Webhook 🕥
  - Pix 🕥

- Lançamento v1.0.0 🚀

## 🌟 Contribuindo

Para contribuir com o PHPay, implementando melhorias e novos gateways de pagamento,
leia nosso manual de contribuição. [MANUAL DE CONTRIBUIÇÃO PHPAY](./CONTRIBUTING.md)

## 📄 Licença

Este projeto está licenciado sob a MIT License. Consulte o arquivo [LICENSE](./LICENSE.md) para mais detalhes.

## 🤝 Contato

💻 GitHub: [Mário Lucas](https://github.com/mariolucasdev)

📧 Email: fale@phpay.io

🎉 Comece a usar o PHPay e simplifique suas integrações com gateways de pagamento!
