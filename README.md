# migrajoomla
Sistema FormDin para facilitar a migração dados do Joomla antigo para o nova versão do sistema Novo

## Branch
* master = migra Joomla 2.5.8 para 3.9
* m1.5to3.x = migra Joomla 1.5.14 para 3.9


# Como usar ?

Crie um arquivo 
```
ROOT/config/migrajoomla.ini
```

Com o conteúdo
```
[config]
ambiente = "Produção"
nome_sistema_acesso = "migrajoomla"

[ds-j25]
DBMS = "MYSQL"
PORT = "3306"
HOST = "SERVIDOR_MYSQL_JOOMLA25"
DATABASE = "SEU_BANCO"
USERNAME = "SEU_USUARIO"
PASSWORD = "SUA_SENHA"

[ds-j39]
DBMS = "MYSQL"
PORT = "3306"
HOST = "SERVIDOR_MYSQL_JOOMLA39"
DATABASE = "SEU_BANCO"
USERNAME = "SEU_USUARIO"
PASSWORD = "SUA_SENHA"
```
