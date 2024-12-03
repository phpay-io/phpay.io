# 💳 PHPay

Uma biblioteca PHP para integração simplificada com gateways de pagamento. Atualmente com suporte para o Asaas, com novas integrações em desenvolvimento.

## 🛠️ O que é o PHPay?

O PHPay é uma biblioteca que ajuda desenvolvedores e empresas a integrarem facilmente gateways de pagamento em suas aplicações PHP. Com foco na simplicidade e flexibilidade, o PHPay oferece uma interface unificada para realizar operações como emissão de cobranças, gestão de clientes e mais.

## 🚀 Principais Recursos

Integração com o Asaas para:
Gerenciamento de clientes.
Criação e envio de cobranças.
Consultas de pagamentos e QR Codes.
Fácil de usar: configuração mínima para começar.
Extensível: suporte para novos gateways será adicionado em breve.
📦 Instalação
Instale via Composer:

```php
composer require phpay-io/phpay
```

## ⚙️ Como usar o PHPay?

```php
require 'vendor/autoload.php';

use PHPay\PHPay;

$asaas = PHPay::asaas('SUA_CHAVE_API');

$client = [
    'name' => 'João da Silva',
    'cpf_cnpj' => '99999999999' // valid
];

$invoice = [
    'value' => 100.00,
    'dueDate' => '2024-12-01',
    'description' => 'Pagamento de teste',
];

$response = $asaas
    ->client($client)
    ->invoice($invoice)
    ->qrCodePix();

print_r($response);
```

## 📝 Roadmap

- [] Integração com o Asaas.
- [] Suporte para outros gateways (ex.: Mercado Pago, Stripe).
- [] Melhorias na documentação.
- [] Testes unitários e exemplos de uso avançado.

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
