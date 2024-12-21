# 💳 PHPay

Uma biblioteca PHP para integração simplificada com gateways de pagamento. Atualmente com suporte para o Asaas, com novas integrações em desenvolvimento.

## 🛠️ O que é o PHPay?

O PHPay é uma biblioteca que ajuda desenvolvedores e empresas a integrarem facilmente gateways de pagamento em suas aplicações PHP. Com foco na simplicidade e flexibilidade, o PHPay oferece uma interface unificada para realizar operações como emissão de cobranças, gestão de clientes e mais.

## 🚀 Principais Recursos

Integração com o Asaas para:

- Gerenciamento de clientes.
- Criação e envio de cobranças.
- Consultas de pagamentos e QR Codes.
- Fácil de usar: configuração mínima para começar.
- Extensível: suporte para novos gateways será adicionado em breve.

📦 Instalação
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

Contribuições são muito bem-vindas!
Para começar:

- 🍴 Faça um fork do projeto.
- 🎋 Crie uma branch para sua feature (git checkout -b feature/nova-feature).
- 🗒️ Faça commit das alterações (git commit -m 'Adicionei nova feature').
- ✏️ Envie sua branch (git push origin feature/nova-feature).
- ✈️ Abra um pull request para análise.

## 📄 Licença

Este projeto está licenciado sob a MIT License. Consulte o arquivo [LICENSE](./LICENSE) para mais detalhes.

🤝 Contato
💻 GitHub: [Mário Lucas](https://github.com/mariolucasdev)
📧 Email: mariolucasdev@gmail.com

🎉 Comece a usar o PHPay e simplifique suas integrações com gateways de pagamento!
