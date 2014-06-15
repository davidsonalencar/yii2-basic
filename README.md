# YII-BASIC

## Instalação

### API de desenvolvimento:

* Fazer download do NetBeans 8.0 em https://netbeans.org/downloads/ e instale-o.

### Preparar projeto:

* No NetBeans ir no menu **Equipe > Git > Clonar...**

* Informar no campo **URL do Repositório** a seguinte informação: https://github.com/davidsonalencar/yii2-basic.git

* Informe o seu usuário e senha do GitHub. Poderá realizar alterações se for colaborador. Clique no botão **Finalizar**.

* Clique no botão **Criar Projeto**. Em seguida, na categoria **PHP**, clique em **Aplicação PHP com Códigos-fonte Existentes**. 

* No campo **Pasta da Fonte** informe o local onde foi realizado o clone do código fonte. No campo **Versão PHP** seleciona *PHP 5.4* ou superior. Clique em **Finalizar**.

### Instalando dependências:

* Via command line, acesse o diretório base da aplicação e execute o comando abaixo para criar o arquivo **composer.phar**: 
```
php -r "readfile('https://getcomposer.org/installer');" | php
```

* Execute o comando abaixo para instalar as dependências do projeto. Umar pasta chamada *vendor* será criada:
```
php composer.phar install
```

### Direito de escrita nos diretórios:

* Dê direito de escrita nos seguintes diretórios:
```
chmod 777 runtime/
chmod 777 web/assets/
```

### Preparando Codeception. Unidades de teste:

* Execute o comando abaixo para adicionar o Codeception e suas dependências:
```
php composer.phar require --dev "codeception/codeception: 1.8.*@dev" "codeception/specify: *" "codeception/verify: *"
```

* Execute o comando abaixo para construir os conjuntos de testes:
```
vendor/bin/codecept build
```
