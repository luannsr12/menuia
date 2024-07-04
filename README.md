## Biblioteca para usar Api Whatsapp Menuia

Menuia: [menuia.com](https://menuia.com/) <br />

## Funções disponíveis

- Envio de texto


## Instalação composer

```bash
 composer require luannsr12/menuia
```

#### Enviar mensagem
```php
<?php 

    require_once 'vendor/autoload.php';

    use Menuia\Settings;
    use Menuia\Message;

    Settings::debug(false);

    Settings::setEndpoint("https://-------");
    Settings::setAuthkey("");
    Settings::setAppkey("");

    Message::$phone = "551199999999";
    Message::$message = "Mensagem de teste";
    Message::$type = "text";

    Message::send();

```

