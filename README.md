# Framework em PHP

## Instalar

```
git clone https://github.com/maurouberti/php-framework.git
cd php-framework
composer dump
```

Subir o servidor local

```
composer server
```

Criar banco de dados

```
composer migrate
```

Recriar banco de dados

```
composer migrate refresh
```

## Rodar em desenvolvimento

Na pasta *php-framework*

```
composer server
```

Na pasta *php-framework/front*

```
npm run dev
```

# Como Criar um módulo

Criar as seguinte estrutura 

appExemplo
    |
    +--config
    |   |
    |   +--containers.php
    |   +--events.php
    |   +--middlewares.php
    |   +--routes.php
    |
    +--src
    |   |
    |   +--Controlles
    |       |
    |       +--ExemplosController.php
    |
    +--Module.php

Registar módulo no arquivo `config/Modules.php`

# Como criar um CRUD

`CrudController.php`: Criado para não precisar reescrever um *controller* de CRUD.

1) Criar rotas no `routes.php`

```
$router->get('/exemplo', '\App\Controllers\ExemplosController::index');
$router->get('/exemplo/{id:(\d+)}', '\App\Controllers\ExemplosController::show');
$router->post('/exemplo', '\App\Controllers\ExemplosController::create');
$router->put('/exemplo/{id:(\d+)}', '\App\Controllers\ExemplosController::update');
$router->delete('/exemplo/{id:(\d+)}', '\App\Controllers\ExemplosController::delete');
```

2) Adicionar no arquivo `containers.php`

```
$container['exemplo_model'] = function ($c) {
    return new \App\Models\Exemplo($c);
};
```

3) Criar *model*

```
<?php

namespace App\Models;

use PHP\Framework\Model;

class Exemplo extends Model
{
    //
}
```

4) Criar *controller*

```
<?php

namespace App\Controllers;

use PHP\Framework\CrudController;

class ExemplosController extends CrudController
{
    protected function getModel(): string
    {
        return 'exemplo_model';
    }
}
```

