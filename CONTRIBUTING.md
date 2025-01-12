# PHPay - Manual de Contribuição

Seja bem-vindo(a) à nossa área de contribuição para o projeto PHPay! Estamos felizes por você estar interessado(a) em colaborar com nosso projeto open source. Suas contribuições são extremamente importantes para o crescimento e evolução do PHPay.

## ❓ Como contribuir?

1. Antes de começar
   Leia a documentação: Familiarize-se com o código e os objetivos do projeto.
   Respeite o Código de Conduta: Certifique-se de seguir as diretrizes de comportamento, promovendo um ambiente colaborativo e inclusivo.
   Verifique as Issues: Dê uma olhada nas issues abertas para encontrar algo que você possa resolver ou melhorar.
2. Passo a passo para contribuir
   🍴 Faça um fork do repositório

   No repositório do PHPay, clique no botão Fork no canto superior direito.
   🎋 Clone o repositório para sua máquina local

   ```bash
   git clone https://github.com/seu-usuario/phppay.git
   cd phpay
   ```

   🎋 Crie uma branch para sua contribuição

   Use um nome descritivo para a branch que reflete a feature ou correção que você está implementando:

   ```bash
   git checkout -b feature/nome-da-feature
   ```

   🗒️ Implemente sua contribuição

   Mantenha o código limpo e organizado.
   Siga as convenções de código do projeto.
   Escreva testes para validar suas alterações sempre que possível.

   🗒️ Faça commit das suas alterações

   Escreva mensagens de commit claras e descritivas:

   ```bash
   git commit -m "feat: [descrição da feature]"
   ```

   ✏️ Envie suas alterações para o repositório do fork

   ```bash
   git push origin feature/nome-da-feature
   ```

   ✈️ Abra um Pull Request

   No repositório original do PHPay, clique em Pull Requests e, em seguida, clique em New Pull Request.
   Escolha a branch que você criou no seu fork e compare-a com a branch principal do repositório original.
   Adicione uma descrição detalhada do que sua contribuição resolve ou melhora.

## 3. Revisão e Feedback

Sua contribuição será revisada por um dos mantenedores do projeto.
Caso necessário, serão solicitadas alterações ou melhorias antes da aprovação.
Após a aprovação, sua contribuição será integrada ao projeto principal.

    🎉Diretrizes de Contribuição

    - Certifique-se de que seu código seja compatível com as versões do PHP suportadas pelo projeto.

    - Escreva testes unitários para novas funcionalidades ou correções de bugs.

    - Mantenha uma boa documentação do código, incluindo comentários e exemplos de uso.

    - Evite commits grandes e difíceis de revisar.

    - Divida suas alterações em partes menores e mais específicas.

## 💻 Ambiente de Desenvolvimento

Certifique-se de configurar corretamente o ambiente de desenvolvimento local:

Requisitos básicos:

- PHP ^8.1
- Composer.

## 🏗️ Instalando as dependências:

```bash
composer install
```

## 💻 Ambiente de Desenvolvimento com Lando

Para desenvolvimento com Lando, siga os passos abaixo:

Requisitos básicos:

- Docker Engine ou Desktop
- Lando (https://lando.dev/).

## 🏗️ Gerando os containers usando o Lando:

```bash
lando start
```

## 🖥️ Configuração do ambiente:

Renomeie o arquivo credentials.example.php para credentials.php e configure suas chaves de do seu gateways.

## Rodando os testes:

```bash
composer tests
```

## ✉️ Entre em contato

Caso tenha dúvidas ou precise de ajuda, sinta-se à vontade para abrir uma issue ou entrar em contato com a equipe de mantenedores.

Agradecemos desde já por suas contribuições. 💙
Juntos podemos tornar o PHPay ainda melhor!
