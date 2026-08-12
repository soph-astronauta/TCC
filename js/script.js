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

// QUIZ

// 1. Definição das perguntas e pontuações
const perguntas = [
  {
    pergunta: "Qual é o seu principal objetivo no intercâmbio?",
    opcoes: [
      { texto: "Aprender ou aperfeiçoar um idioma rapidamente", tipo: "idioma" },
      { texto: "Ganhar experiência profissional e dinheiro", tipo: "trabalho" },
      { texto: "Impactar uma comunidade e viver uma imersão cultural", tipo: "voluntariado" },
      { texto: "Estudar em uma universidade ou fazer pós-graduação", tipo: "academico" }
    ]
  },
  {
    pergunta: "Quanto tempo você pretende ficar fora?",
    opcoes: [
      { texto: "De 2 a 4 semanas (férias)", tipo: "idioma" },
      { texto: "De 3 a 6 meses", tipo: "voluntariado" },
      { texto: "De 6 meses a 1 ano", tipo: "trabalho" },
      { texto: "Mais de 1 ano", tipo: "academico" }
    ]
  },
  {
    pergunta: "Como você prefere gerenciar seu orçamento?",
    opcoes: [
      { texto: "Quero economizar trocando trabalho por hospedagem", tipo: "voluntariado" },
      { texto: "Preciso trabalhar legalmente no país para pagar as contas", tipo: "trabalho" },
      { texto: "Tenho um orçamento reservado focado apenas em estudos", tipo: "idioma" },
      { texto: "Pretendo buscar uma bolsa de estudos", tipo: "academico" }
    ]
  }
];

// 2. Mapeamento de pontuação acumulada
let pontuacao = {
  idioma: 0,
  trabalho: 0,
  voluntariado: 0,
  academico: 0
};

let indicePerguntaAtual = 0;

// 3. Função para carregar a pergunta na tela
function carregarPergunta() {
  const perguntaAtual = perguntas[indicePerguntaAtual];
  const elementoPergunta = document.getElementById("pergunta");
  const elementoOpcoes = document.getElementById("opcoes");

  elementoPergunta.innerText = perguntaAtual.pergunta;
  elementoOpcoes.innerHTML = "";

  perguntaAtual.opcoes.forEach(opcao => {
    const botao = document.createElement("button");
    botao.innerText = opcao.texto;
    botao.onclick = () => selecionarResposta(opcao.tipo);
    elementoOpcoes.appendChild(botao);
  });
}

// 4. Função para somar os pontos e avançar
function selecionarResposta(tipo) {
  pontuacao[tipo]++;
  indicePerguntaAtual++;

  if (indicePerguntaAtual < perguntas.length) {
    carregarPergunta();
  } else {
    mostrarResultado();
  }
}

// 5. Função para calcular e exibir o resultado
function mostrarResultado() {
  document.getElementById("pergunta").style.display = "none";
  document.getElementById("opcoes").style.display = "none";

  // Descobre qual tipo teve mais pontos
  let tipoVencedor = Object.keys(pontuacao).reduce((a, b) => 
    pontuacao[a] > pontuacao[b] ? a : b
  );

  const mensagens = {
    idioma: " ideal para você é o **Intercâmbio de Idiomas**! Focado em imersão rápida e aprendizado da língua.",
    trabalho: " ideal para você é o **Intercâmbio de Estudo e Trabalho**! Perfeito para ganhar experiência e se sustentar no exterior.",
    voluntariado: " ideal para você é o **Voluntariado Internacional**! Uma experiência rica em trocas culturais e baixo custo.",
    academico: " ideal para você é o **Intercâmbio Acadêmico** (Graduação/Pós)! Focado na sua carreira e formação de alto nível."
  };

  const elementoResultado = document.getElementById("resultado");
  elementoResultado.classList.remove("escondido");
  elementoResultado.innerHTML = `<h3>Seu Resultado:</h3><p>O perfil${mensagens[tipoVencedor]}</p>`;
}

// Inicializa o quiz
carregarPergunta();