import mysql.connector

def conectar_banco():
    banco = mysql.connector.connect(
        host="localhost",
        user="root",
        password="SUA_SENHA",
        database="NOME_DO_BANCO"
    )

    return banco

    from flask import Flask, jsonify
from flask_cors import CORS

from banco import conectar_banco

app = Flask(__name__)
CORS(app)

@app.route("/")
def inicio():
    return jsonify({
        "mensagem": "API funcionando!"
    })

@app.route("/usuarios")
def usuarios():

    banco = conectar_banco()
    cursor = banco.cursor(dictionary=True)

    cursor.execute("SELECT * FROM usuarios")

    resultado = cursor.fetchall()

    cursor.close()
    banco.close()

    return jsonify(resultado)

if __name__ == "__main__":
    app.run(debug=True)