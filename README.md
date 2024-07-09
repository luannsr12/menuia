## Biblioteca para usar Api Whatsapp Menuia

Menuia: [menuia.com](https://menuia.com/) <br />

## Funções disponíveis

- Envio de texto


## Instalação composer

```bash
 composer require luannsr12/menuia
```

#### Criar dispositivo
Use a mesma função para recupear o qrcode

```php
    <?php 

    require_once 'vendor/autoload.php';

    use Menuia\Settings;
    use Menuia\Device;
 
    Settings::setEndpoint("https://-------");
    Settings::setAuthkey("");
    
    Device::$appKey = "NEW_APPKEY";
    
    $create = Device::create();

    var_dump($create);

    /*
     * if(isset($create->status)){
     *  if($create->status == 200){
     *    $id     =  $create->message->id; // id do dispositivo  
     *    $qrcode =  $create->message->qr; // qrcode base64
     *  }
     * }
     * 
     */

```



#### Enviar mensagem de texto
```php
<?php 

    require_once 'vendor/autoload.php';

    use Menuia\Settings;
    use Menuia\Message;

    Settings::setEndpoint("https://-------");
    Settings::setAuthkey("");
    Settings::setAppkey("");

    Message::$phone = "551199999999";
    Message::$message = "Mensagem de teste";
    Message::$type = "text";

    $send = Message::send();

    var_dump($send);

```

