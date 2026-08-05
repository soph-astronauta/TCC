fetch("backend/api/login.php", {
    method: "POST",
    headers: {
        "Content-Type": "application/json"
    },
    body: JSON.stringify({
        email: email,
        senha: senha
    })
})
.then(res => res.json())
.then(dados => {
    console.log(dados);
});


//quiz
let pontos = {
    curso:0,
    trabalho:0,
    faculdade:0,
    aupair:0,
    highschool:0
};

switch(resposta){

    case "curso":
        pontos.curso += 3;
        break;
    
    case "trabalho":
        pontos.trabalho += 3;
        break;
    
    case "faculdade":
        pontos.faculdade += 3;
        break;
    
    }

    let resultado = "";

let maior = 0;

for(let tipo in pontos){

    if(pontos[tipo] > maior){

        maior = pontos[tipo];
        resultado = tipo;

    }

}

document.getElementById("resultado").value = resultado;