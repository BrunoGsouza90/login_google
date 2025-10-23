# Autenticação Google PHP

Biblioteca PHP que realiza autenticação com o Google utilizando o cliente oficial [`google-api-php-client`](https://github.com/googleapis/google-api-php-client), facilitando o processo de login e integração com os serviços e APIs do Google.

---

## 🚀 Recursos

* Autenticação OAuth2 com o Google
* Suporte ao login via conta Google
* Integração simples com APIs do Google (Drive, Gmail, Calendar, etc.)
* Baseado no cliente oficial da Google para PHP

---

## 📦 Instalação

Instale via [Composer](https://getcomposer.org/):

```bash
composer require brunodev/google-auth-php
```

---

## ⚙️ Configuração

A biblioteca depende de algumas **variáveis de ambiente** para funcionar corretamente. Configure-as no seu `.env` ou no ambiente do servidor:

```dotenv
# Caminho para o certificado CA usado pelo Guzzle (opcional, fallback para padrão do sistema)
GOOGLE_CA_CERT_PATH=/etc/ssl/certs/ca-certificates.crt

# Credenciais do Google em formato JSON (geradas pelo Google Cloud Console)
GOOGLE_CREDENTIALS_JSON='{"type":"service_account","project_id":"...","private_key_id":"...","private_key":"-----BEGIN PRIVATE KEY-----..."}'

# Redirect URI configurado no Google Cloud Console
GOOGLE_REDIRECT_URI=http://localhost:8000/callback

# Scopes da autenticação, em JSON (uma linha)
GOOGLE_SCOPES='["email","profile"]'

# ID do cliente no Google.
GOOGLE_CLIENT_ID=seu_id_aqui

# A chave secreta do cliente.
GOOGLE_CLIENT_SECRET=seu_secret_aqui
```

> Dica: caso `GOOGLE_CA_CERT_PATH` não seja definido, o Guzzle usará o certificado padrão do sistema.
> Scopes podem ser ajustados conforme os serviços que você deseja acessar.

---

## 📝 Uso básico

```php
<?php

use AuthenticationGoogle\Library\GoogleClient;

require "../vendor/autoload.php";

// Cria a instância do cliente Google
$googleClient = new GoogleClient();

// Inicializa o cliente com as variáveis de ambiente
$googleClient->init();

// Verifica se o usuário já autorizou
$authorized = $googleClient->authorized();

if ($authorized["status"]) {

    echo "Usuário autorizado: ";

    print_r($authorized["data"]);

} else {

    // Redireciona ou exibe link de autorização

    echo "Link de autorização: " . $authorized["link"];
    
}
```