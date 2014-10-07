# YII2-BASIC

## Pré-requisitos do sistema

<ul>
    <li>PHP 5.4 ou superior</li>
    <li>Extensões do PHP habilitadas:
        <ul>
            <li>php_mysql</li>
            <li>openssl</li>
            <li>mbstring</li>
            <li>curl</li>
            <li>gd2</li>
            <li>intl</li>
            <li>apc (veja a descrição logo abaixo)</li>
        </ul>
    </li>
</ul>

Caso esteja utilizando o PHP 5.4, deverá realizar o [download](http://windows.php.net/downloads/pecl/releases/apc/3.1.13/php_apc-3.1.13-5.4-ts-vc9-x86.zip) do APC Cache. O PHP 5.5 está com o APC Cache nativo. Por fim, em ambas as versões do PHP, acrescentar no arquivo php.ini o parâmetro abaixo para habilitar o cliente do [APC Cache](http://php.net/manual/pt_BR/book.apc.php) no YII2:
```
[apc]
apc.enable_cli = 1
```

Desabilitar [Expose PHP](http://lv1.php.net/manual/en/ini.core.php#ini.expose-php):
```
expose_php = 0
```

## Pré-requisitos para ambiente de desenvolvimento
<ul>
    <li>JDK 7</li>
    <li><a href="http://nodejs.org">Node.JS</a> Package Manager:
        <ul>
            <li><a href="https://www.npmjs.org/package/less">less</a></l>
        </ul>
    </li>
</ul>

## Preparação

Criar uma Alias chamada **/yii2-basic** de **/yii2-basic/web** no arquivo de configuração httpd.conf, como mostro no exemplo abaixo:
```
Alias /yii2-basic "/webRoot/yii2-basic/web"
<Directory "/webRoot/yii2-basic/web">
   Options Indexes FollowSymLinks Includes
   AllowOverride All
   Order allow,deny
   Allow from all
</Directory>
```

Altere em **<Directory "webRoot">**, AllowOverride None para AllowOverride All
```
<Directory "D:/Webserver/apache/htdocs">
    ...
    AllowOverride All
    ...
</Directory>
```

## Instalação

### API de desenvolvimento:

* Fazer download do NetBeans 8.0 em https://netbeans.org/downloads/ e instale-o.

### Preparar projeto:

* No NetBeans ir no menu **Equipe > Git > Clonar...**

* Informar no campo **URL do Repositório** a seguinte informação: https://github.com/davidsonalencar/yii2-basic.git

* Informe o seu usuário e senha do GitHub. Poderá realizar alterações se for colaborador. Clique no botão **Finalizar**.

* Clique no botão **Criar Projeto**. Em seguida, na categoria **PHP**, clique em **Aplicação PHP com Códigos-fonte Existentes**. 

* No campo **Pasta da Fonte** informe o local onde foi realizado o clone do código fonte. No campo **Versão PHP** seleciona *PHP 5.4* ou superior. Clique em **Finalizar**.

### 
Para associar as alterações do projeto a sua conta do GitHub, deve realizar as configurações baseadas no tópico "Setting up Git" no link https://help.github.com/articles/set-up-git.

### Instalando dependências:

* Via command line, acesse o diretório base da aplicação e execute o comando abaixo para criar o arquivo **composer.phar**: 
```
php -r "readfile('https://getcomposer.org/installer');" | php
```

* Instalar plugin do Composer para utilizar em conjunto com o Bower:
```
php composer.phar global require "fxp/composer-asset-plugin:1.0.0-beta2"
```

* Execute o comando abaixo para instalar as dependências do projeto. Umar pasta chamada *vendor* será criada:
```
php composer.phar install --prefer-dist 
```

### Direito de escrita nos diretórios:

* Garanta que os arquivos / diretórios estejam com os seguintes direitos:
```
chmod 777 runtime/
chmod 777 web/assets/
chmod 755 yii
```

### Preparando Codeception. Unidades de teste:

#### Preparação:

* Execute o comando abaixo para construir os conjuntos de testes:
```
vendor/bin/codecept build
```

* Acrescentar o código abaixo como primeira instrução PHP do arquivo **vendor/codeception/codeception/codecept**:
```
if (!ini_get('date.timezone')) {
    date_default_timezone_set('America/Sao_Paulo');
}
```

#### Configuração da URL

Garantir que a linha abaixo do arquivo **tests/_bootstrap.php** esteja referenciando o caminho correto do projeto:
```
defined('TEST_ENTRY_URL') or define('TEST_ENTRY_URL', '/yii2-basic/web/index-test.php');
```

Também garantir que a linha abaixo do arquivo **tests/acceptance.suite.yml** esteja referenciando o domínio correto do projeto. Indicar a porta de existir.
```
    PhpBrowser:
        url: 'http://localhost'
```

Manual de marcações do README.md http://en.wikipedia.org/wiki/Markdown.
