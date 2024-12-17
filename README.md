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

```php
require 'vendor/autoload.php';

use PHPay\Gateways\Asaas\AsaasGateway;
use PHPay\PHPay;

$phpay = PHPay::getInstance(new AsaasGateway(TOKEN_ASAAS_SANDBOX))
    ->getGateway();
```

## Customer

```php
$customerCreated = $phpay
    ->customer($customer)
    ->create();

$phpay
    ->customer()
    ->getAll();

$phpay
    ->customer()
    ->setFilter([
        'cpfCnpj' => $customerCreated['cpfCnpj'],
    ])
    ->getAll();

$phpay
    ->customer()
    ->find($customerCreated['id']);

$phpay
    ->customer([
        'name' => 'Mário Lucas Updated',
    ])
    ->update($customerCreated['id']);

$phpay
    ->customer()
    ->destroy($customerCreated['id']);

$phpay
    ->customer()
    ->restore($customerCreated['id']);

$phpay
    ->customer()
    ->getNotifications($customerCreated['id']);
```

## 🤑 Charges

```php
$customerCreated = $phpay
    ->customer($customer)
    ->create();

$phpay
    ->charge($charge)
    ->setCustomer($customerCreated['id'])
    ->create();

$phpay
    ->charge()
    ->find($chargeCreated['id']);

$phpay
    ->charge()
    ->getAll();

$phpay
    ->charge()
    ->update($chargeCreated['id'], [
        'description' => 'Teste de fatura atualizado',
    ]);

$phpay
    ->charge()
    ->destroy($chargeCreated['id']);

$phpay
    ->charge()
    ->restore($chargeCreated['id']);

$phpay
    ->charge()
    ->getStatus($chargeCreated['id']);

$phpay
    ->charge()
    ->getDigitableLine($chargeCreated['id']);

$phpay
    ->charge()
    ->getQrCodePix($chargeCreated['id']);

$phpay
    ->charge()
    ->confirmReceipt($chargeCreated['id'], [
        'paymentDate'    => date('Y-m-d'),
        'value'          => 100.00,
        'notifyCustomer' => true,
    ]);

$phpay
    ->charge()
    ->undoConfirmReceipt($chargeCreated['id']);
```

## WebHooks

```php
$webhook = $phpay
    ->webhook($webhook)
    ->create();

$phpay
    ->webhook()
    ->getAll();

$phpay
    ->webhook()
    ->find($webhook['id']);

$phpay
    ->webhook()
    ->update($webhook['id'], [
        'name' => 'Webhook de Teste Atualizado',
        'url'  => 'https://mariolucas.me/webhook/atualizado',
    ]);

$phpay
    ->webhook()
    ->destroy($webhook['id']);
```

## 📝 Roadmap

- Integração com Asaas.

  - Cobranças ✅
  - Clientes ✅
  - Webhook ✅
  - Pix 🕥

- Integração com Efí.

  - Cobranças 🕥
  - Clientes 🕥
  - Webhook 🕥
  - Pix 🕥

- Lançamento v1.0.0 🚀

## 🌟 Contribuindo

Contribuições são muito bem-vindas!
Para começar:

- Faça um fork do projeto.
- Crie uma branch para sua feature (git checkout -b feature/nova-feature).
- Faça commit das alterações (git commit -m 'Adicionei nova feature').
- Envie sua branch (git push origin feature/nova-feature).
- Abra um pull request para análise.

## 📄 Licença

Este projeto está licenciado sob a MIT License. Consulte o arquivo LICENSE para mais detalhes.

🤝 Contato
💻 GitHub: mariolucasdev
📧 Email: mariolucasdev@gmail.com

🎉 Comece a usar o PHPay e simplifique suas integrações com gateways de pagamento!
