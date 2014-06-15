# YII-BASIC

## Instalação

* Fazer download do NetBeans 8.0 em https://netbeans.org/downloads/ e instale-o.

* Preparar projeto:

** No NetBeans ir no menu **Equipe > Git > Clonar...**

2.2. Informar no campo **URL do Repositório** a seguinte informação: https://github.com/davidsonalencar/yii2-basic.git

2.3. Informe o seu usuário e senha do GitHub. Poderá realizar alterações se for colaborador. Clique no botão **Finalizar**.

2.4. Clique no botão **Criar Projeto**. Em seguida, na categoria **PHP**, clique em **Aplicação PHP com Códigos-fonte Existentes**. 

2.5. No campo **Pasta da Fonte** informe o local onde foi realizado o clone do código fonte. No campo **Versão PHP** seleciona *PHP 5.4* ou superior. Clique em **Finalizar**.

3. Instalando dependências:

3.1. Via command line, acesse o diretório onde foi realizado o clone do código fonte e execute o comando abaixo para criar o arquivo **composer.phar**: 
```
php -r "readfile('https://getcomposer.org/installer');" | php
```

3.2. Execute o comando abaixo para instalar as dependências do projeto. Umar pasta chamada *vendor* será criada:
```
php composer.phar install
```
