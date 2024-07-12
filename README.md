## Biblioteca para usar Api Whatsapp Menuia

Menuia: [menuia.com](https://menuia.com/) <br />

## Funções disponíveis

- Envio de texto
- Envio de Imagem, Vídeo, Áudio e Docs
- Criar Dispositivos
- Remover Dispositivos
- Desconectar Dispositivos
- Recuperar QrCode
- Verificar Status de conexão


## Instalação composer

```bash
 composer require luannsr12/menuia
```

#### Criar dispositivo ou recuperar Qrcode
Caso o dispositivo não exista, ele é criado automaticamente
Importante checkar se esta conectado antes, se ja estiver conectado, irá criar um novo dispositivo.

```php
    <?php 

    require_once 'vendor/autoload.php';

    use Menuia\Settings;
    use Menuia\Device;

    Settings::setEndpoint("https://-------");
    Settings::setAuthkey("");
    Settings::setAppkey("NEW_TOKEN"); // novo appkey ou token existente
    
    $qrcode = Device::qrcode(); // irá criar o dispositivo ou buscar o qrcode do dispositivo de 'Settings::setAppkey()'

    var_dump($qrcode);

    /*
     * if(isset($qrcode->status)){
     *  if($qrcode->status == 200){
     *    $id   =  $qrcode->message->id; // id do dispositivo  
     *    $qr   =  $qrcode->message->qr; // qrcode base64
     *  }
     * }
     * 
     */

```

#### Apagar um dispositivo

```php
    <?php 

    require_once 'vendor/autoload.php';

    use Menuia\Settings;
    use Menuia\Device;

    Settings::setEndpoint("https://-------");
    Settings::setAuthkey("");
    Settings::setAppkey("DEVICE_1"); // id ou appKey do dispositivo a ser removido
    
    $remove = Device::remove();

    var_dump($remove);

    /*
     * if(isset($remove->status)){
     *  if($remove->status == 200){
     *     echo 'Removido com sucesso!';
     *  }
     * }
     * 
     */

```

#### Desconectar um dispositivo

```php
    <?php 

    require_once 'vendor/autoload.php';

    use Menuia\Settings;
    use Menuia\Device;

    Settings::setEndpoint("https://-------");
    Settings::setAuthkey("");
    Settings::setAppkey("DEVICE_1"); // id ou appKey do dispositivo a ser desconectado
    
    $disconnect = Device::disconnect();

    var_dump($disconnect);

    /*
     * if(isset($disconnect->status)){
     *  if($disconnect->status == 200){
     *     echo 'Desconectado com sucesso!';
     *  }
     * }
     * 
     */

```

#### Status de um dispositivo

```php
    <?php 

    require_once 'vendor/autoload.php';

    use Menuia\Settings;
    use Menuia\Device;

    Settings::setEndpoint("https://-------");
    Settings::setAuthkey("");
    Settings::setAppkey("DEVICE_1"); // id ou appKey do dispositivo a ser checkado
    
    $status = Device::status(); // case return 'false' is disconnected

    var_dump($status);

    /*
     * if(isset($status->status)){
     *  if($status->status == 200){
     *     echo 'Conectado!';
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


#### Enviar arquivo de midia
```php
<?php 

    require_once 'vendor/autoload.php';

    use Menuia\Settings;
    use Menuia\Message;

    Settings::setEndpoint("https://-------");
    Settings::setAuthkey("");
    Settings::setAppkey("");

    Message::$phone     = "551199999999";
    Message::$message   = "Mensagem de teste"; // optional for media. Use as caption
    Message::$type      = "media";
    Message::$file_url  = "https://site.com/img.png"; // doc, image, audio and videos

    $send = Message::send();

    var_dump($send);

```

