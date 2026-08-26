import mysql.connector


def conectar_banco():
    banco = mysql.connector.connect(
        host="localhost",
        user="root",
        password="SUA_SENHA",
        database="NOME_DO_BANCO"
    )

    return banco