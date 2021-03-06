# YII2-BASIC

## Pré-requisitos do sistema

* PHP 5.4 ou superior
* Extensões do PHP habilitadas:
    * php_mysql
    * openssl
    * mbstring
    * curl
    * gd2
    * intl
    * apc (veja a descrição logo abaixo)

Caso esteja utilizando o PHP 5.4, deverá realizar o [download](http://windows.php.net/downloads/pecl/releases/apc/3.1.13/php_apc-3.1.13-5.4-ts-vc9-x86.zip) do APC Cache. O PHP 5.5 está com o APC Cache nativo. Por fim, em ambas as versões do PHP, acrescentar no arquivo php.ini o parâmetro abaixo para habilitar o cliente do [APC Cache](http://php.net/manual/pt_BR/book.apc.php) no YII2:
```
[apc]
apc.enable_cli = 1
```

Desabilitar [Expose PHP](http://lv1.php.net/manual/en/ini.core.php#ini.expose-php):
```
expose_php = 0
```

Modifique o parâmetro a seguir, a fim de evitar muitas chamadas desnecessárias ao comando `stat()` do sistema:
```
cgi.fix_pathinfo=0
```

## Pré-requisitos para ambiente de desenvolvimento
* JDK 7</li>
* [Node.JS](http://nodejs.org) Package Manager:
    * [less](https://www.npmjs.org/package/less)

No Mac OS, terá que adicionar um caminho no PATH Apache Environment:
* Altere o arquivo **launchd.conf**:
```
sudo vi /etc/launchd.conf
```

* Adicione o conteúdo abaixo no arquivo:
```
setenv PATH /usr/bin:/bin:/usr/sbin:/sbin:/usr/local/bin
```

* Salve o arquivo e reinicie a máquina

## Preparação

Criar uma Alias chamada **/yii2-basic** de **/yii2-basic/web** no arquivo de configuração httpd.conf, como mostro no exemplo abaixo:
```
Alias /yii2-basic "/<webRoot>/yii2-basic/web"
<Directory "/<webRoot>/yii2-basic/web">
   Options Indexes FollowSymLinks Includes
   AllowOverride All
   Order allow,deny
   Allow from all
</Directory>
```

## Instalação

### API de desenvolvimento:

* Fazer download do NetBeans 8.0.1 em https://netbeans.org/downloads/ e instale-o.

### Preparar projeto:

* No NetBeans ir no menu **Equipe > Git > Clonar...**

* Informar no campo **URL do Repositório** a seguinte informação: https://github.com/davidsonalencar/yii2-basic.git

* Informe o seu usuário e senha do GitHub. Poderá realizar alterações se for colaborador. Clique no botão **Finalizar**.

* Clique no botão **Criar Projeto**. Em seguida, na categoria **PHP**, clique em **Aplicação PHP com Códigos-fonte Existentes**. 

* No campo **Pasta da Fonte** informe o local onde foi realizado o clone do código fonte. No campo **Versão PHP** seleciona *PHP 5.4* ou superior. Clique em **Finalizar**.

### 
Para associar as alterações do projeto a sua conta do GitHub, deve realizar as configurações baseadas no tópico "Setting up Git" no link https://help.github.com/articles/set-up-git.

### Instalando dependências:

* LINUX/MAC - Via command line, em um diretório temporário, execute o comando abaixo para criar o arquivo **composer.phar** e colocá-lo no PATH da máquina: 
```
php -r "readfile('https://getcomposer.org/installer');" | php
sudo mv composer.phar /usr/local/bin/composer
```

* WINDOWS - Instale o programa [Composer-Setup.exe](https://getcomposer.org/Composer-Setup.exe). 

* Instalar plugin do Composer para utilizar em conjunto com o Bower:
```
composer global require "fxp/composer-asset-plugin:1.0.0"
```

* Execute o comando abaixo para instalar as dependências do projeto. Umar pasta chamada *vendor* será criada:
```
composer install --prefer-dist
```

Para mais detalhes, [veja aqui](http://www.yiiframework.com/doc-2.0/guide-start-installation.html).

### Direito de escrita nos diretórios:

* Garanta que os arquivos / diretórios estejam com os seguintes direitos:
```
chmod 777 runtime/
chmod 777 web/assets/
chmod 755 yii
```

### Preparando Codeception. Unidades de teste:

Os testes serão desenvolvidos no diretório ```/<webRoot>/yii2-basic/tests/codeception``` utilizando o framework [Codeception PHP Testing Framework](http://codeception.com/).

#### Preparação:

* Caso o Codeception não esteja instalado na máquina, execute os comandos a seguir:
```
composer global require "codeception/codeception=2.0.*"
composer global require "codeception/specify=*"
composer global require "codeception/verify=*"
```

* Caso nunca tenha usado o Composer com pacotes globais, localize a pasta com os pacotes globais pelo comando ```composer global status```. O resultado do comando obterá o diretório:
```
Changed current directory to <directory>
```

* Adicione o diretório ```<directory>/vendor/bin``` no PATH da máquina, permitindo que execute o comando ```codecept``` globalmente.

* No diretório raiz do sistema, execute o comando abaixo para criar o banco de dados dos testes:
```
php tests/codeception/bin/yii migrate
```

* No diretório ```/<webRoot>/yii2-basic/web```, execute o comando a seguir para iniciar o serviço para a rotina de teste:
```
start php -S localhost:8080
```

* No diretório ```/<webRoot>/yii2-basic/tests```, execute o comando a seguir para criar os conjuntos dos testes:
```
codecept build
```

* Agora, poderá executar os testes de acordo com os comandos a seguir:
```
# Executa todos os testes disponíveis
codecept run
# Executa os testes de aceitação
codecept run acceptance
# Executa os testes funcionais
codecept run functional
# Executa os testes unitários
codecept run unit
```

Para mais detalhes, consulte o [tutorial do Codeception](http://codeception.com/docs/01-Introduction) para escrever e executar testes de aceitação, funcionais e unitários.

Veja também o documento do Yii2 de preparação do [Codeception](https://github.com/yiisoft/yii2/blob/master/docs/guide/test-environment-setup.md).

Manual de marcações do README.md http://en.wikipedia.org/wiki/Markdown.
