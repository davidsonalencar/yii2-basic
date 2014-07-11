# Migrations

Este recurso é utilizado para mater um controle das mudanças estruturais do banco de dados.

## Criando migrações

```
    yii migrate/create <name>
```

O parâmetro nome é obrigatório e deve dar uma breve descricao do que será realizado. Por exemplo:

```
    yii migrate/create create_news_table
``` 

O comando acima irá criar um novo arquivo chamado **m101129_185401_create_news_table.php**. Este arquivo será gerado com o seguinte código

```
class m101129_185401_create_news_table extends \yii\db\Migration
{
    public function up()
    {
    }

    public function down()
    {
        echo "m101129_185401_create_news_table cannot be reverted.\n";
        return false;
    }
}
```

O método up() deve conter o código implementando a migração de fato, enquanto o método down() pode conter o código revertendo o que é feito em up().

Algumas vezes, é impossível implementar o método down(). Por exemplo, se nós removemos linhas de uma tabela em up(), nós não poderemos recuperá-las em down(). Neste caso, a migração é chamada irreversível, o que significa que nós não podemos reertê-la para um estado anterior do banco de dados. No código gerado acima, o método down() retorna false para indicar que a migração não pode ser revertida.

```
    **Importante:** se o método up() ou down() retornar false, todas as migrações seguintes serão canceladas
```

## Migrações Transacionais

Para realizar as alterações de uma migração dento de uma transção, deve ser utilizado os métodos **safeUp()** e **safeDown()**

```
use yii\db\Schema;

class m101129_185401_create_news_table extends \yii\db\Migration
{
    public function safeUp()
    {
        $this->createTable('news', [
            'id' => 'pk',
            'title' => Schema::TYPE_STRING . ' NOT NULL',
            'content' => Schema::TYPE_TEXT,
        ]);

        $this->createTable('user', [
            'id' => 'pk',
            'login' => Schema::TYPE_STRING . ' NOT NULL',
            'password' => Schema::TYPE_STRING . ' NOT NULL',
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('news');
        $this->dropTable('user');
    }

}
```

## Aplicação Migrações

Para aplicar todas as novas migrações disponíveis (o que significa deixar o banco de dados local atualizado),execute o seguinte comando:

```
    yii migrate
```

O comando irá mostrar a lista de todas as novas migrações. Se você confirmar a aplicaçao das migrações, ele chamará o método up() em cada nova classe de migração, uma após a outra, na ordem do valor do "timestamp" em cada nome de classe.

Após aplicar a migração, a ferramenta de migração manterá um registro em uma tabela chamada ***migration*** no banco de dados. Isto permite que a ferramenta identifique quais migrações já foram aplicadas e quais não foram. Se a tabela **migration** não existir, a ferramenta a criará automaticamente no banco de dados especificado pelo componente de aplicação db.


Às vezes, nós podemos querer aplicar uma ou algumas novas migrações. Podemos usar o seguinte comando:

```
    yii migrate/up 3
```

Serão aplicadas as 3 últimas migrações


Também é possível migrar o banco de dados para uma versão específica com o seguinte comando:

```
    yii migrate/to 101129_185401
```

Isto é, nós usamos a parte do "timestamp" do nome de uma migração para especificar a versão para a qual nós desejamos migrar o banco de dados. Se há múltiplas migrações entre a última migração aplicada e migração especificada, todas estas migrações serão aplicadas. Se a migração especificada já foi aplicada antes, então todas as migrações aplicadas depois dela serão revertidas.


## Revertendo Migrações

Para reverter a última ou algumas das últimas migrações aplicadas, nós podemos usar o seguinte comando:

```
    yii migrate/down [step]
```

Onde o parâmetro opcional step especifica quantas migrações devem ser revertidas. O padrão é 1, o que significa que a última migração aplicada será revertida.


## Reaplicando Migrações

Reaplicar uma migração significa primeiro reverter e então aplicar a migração especificada. Isto pode ser feito com o comando a seguir:

```
    yii migrate/redo [step]
```

onde o parâmetro opcionalstep especifica quantas migrações serão reaplicadas. O padrão é 1, o que significa que a última migração aplicada será reaplicada.


## Exibindo Informações da Migração

Além de aplicar e reverter migrações, a ferramenta de migrações também pode exibir o histórico de migrações e as novas migrações a serem aplicadas.

```
    yii migrate/history [limit]
    yii migrate/new [limit]
```

Onde o parâmetro opcional limit especifica o número de aplicações a serem exibidas. Se limit não é especificado, todas as migrações disponíveis serão exibidas.

O primeiro comando exibe as migrações que foram aplicadas, enquanto o segundo mostra as migrações que não foram aplicadas.


## Modificando o Histórico de Migrações

Algumas vezes, nós podemos querer modificar o histórico de migrações para uma versão de migração específica sem de fato aplicar ou reverter as migrações relevantes. Isto acontece frequentemente quando estamos criando uma nova migração. Nós podemos usar o comando a seguir para atingir este objetivo.

```
   yii migrate/mark 101129_185401 
```

Este comando é muito similar ao comando **yii migrate/to**, exceto que ele apenas modifica a tabela do histórico de migrações para a migração especificada sem aplicar ou reverter migrações.


## Personalizando o Comando de Migração

Há algumas maneiras de personalizar o comando de migração.

O comando de migração possui cinco opções que podem ser especificadas na linha de comando:

<ul>
   <li>**interactive: boolean**, especifica se as migrações devem ser executadas em modo interativo. O padrão é true, o que significa que o usuário será perguntado quando executar uma migração específica. Você pode alterar esta opção para false desta forma as migrações serão feitas por um processo em background.</li>
   <li>**migrationPath: string**, espeficica o diretório contendo todos os arquivos das classes de migrações. Esta opção deve ser especificada como um path alias (apelido para caminho), e o diretório correspondente deve existir. Se não for especificado, será usado o subdiretório migrations sob o caminho base da aplicação.</li>
   <li>**migrationTable: string**, especifica o nome da tabela do banco de dados para armazenar o histórico de migrações. O padrão é **migration**. A estrutura da tabela é version varchar(255) primary key, apply_time integer.</li>
   <li>**connectionID: string**, especifica o ID do componente de banco de dados da aplicação. O padrão é 'db'.</li>
   <li>**templateFile: string**, especifica o caminho do arquivo que servirá de modelo para a geração das classes de migração. Esta opção deve ser especificada como um path alias (por exemplo application.migrations.template). Se não for configurado, um modelo interno será usado. Dentro do modelo, o símbolo {ClassName} será substituído pelo nome real da classe da migração.</li>
</ul>

Para especificar estas opções, execute o comando de migração com o seguinte formato

```
   yii migrate/up --option1=value1 --option2=value2 ...
```

Por exemplo, se nós queremos migrar para um módulo forum cujos arquivos de migração estejam localizados no diretório migrations do módulo, nós podemos usar o comando abaixo:

```
    yii migrate/up --migrationPath=@app/modules/forum/migrations
```

## Configurar o Comando Globalmente

Enquanto as opções de linha de comando nos permitem configurar o comando de migração dinamicamente, algumas vezes podemos querer configurar o comando uma vez para todas as execuções. Por exemplo, nós podemos querer usar uma tabela diferente para armazenar o histórico de migrações, ou nós podemos querer usar um modelo de migração personalizado. Nós podemos fazer isto modificando o arquivo de configuração da aplicação de console como a seguir,

```
'controllerMap' => [
    'migrate' => [
        'class' => 'yii\console\controllers\MigrateController',
        'migrationTable' => 'my_custom_migrate_table',
    ],
]
```

Agora, se nós executarmos o comando migrate, a configuração acima fará efeito sem ser necessário usar as opções de linha de comando em todas as vezes.

Manual de marcações do README.md http://en.wikipedia.org/wiki/Markdown.
