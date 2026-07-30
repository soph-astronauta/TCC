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