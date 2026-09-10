import {
  createContext,
  useContext,
  useEffect,
  useState,
} from "react";

const AuthContext = createContext(null);

const USERS_KEY = "interway-users";
const SESSION_KEY = "interway-user";

export function AuthProvider({ children }) {
  const [usuario, setUsuario] = useState(null);
  const [carregando, setCarregando] = useState(true);

  useEffect(() => {
    const sessaoSalva = localStorage.getItem(SESSION_KEY);

    if (sessaoSalva) {
      try {
        setUsuario(JSON.parse(sessaoSalva));
      } catch {
        localStorage.removeItem(SESSION_KEY);
      }
    }

    setCarregando(false);
  }, []);

  function cadastrar({
    nome,
    email,
    senha,
  }) {
    const usuariosSalvos =
      JSON.parse(
        localStorage.getItem(USERS_KEY)
      ) || [];

    const emailNormalizado =
      email.trim().toLowerCase();

    const jaExiste =
      usuariosSalvos.some(
        (item) =>
          item.email.toLowerCase() ===
          emailNormalizado
      );

    if (jaExiste) {
      return {
        sucesso: false,
        mensagem:
          "Já existe uma conta com esse e-mail.",
      };
    }

    const novoUsuario = {
      id: crypto.randomUUID(),
      nome: nome.trim(),
      email: emailNormalizado,
      senha,
      criadoEm:
        new Date().toISOString(),
      favoritos: [],
    };

    const novosUsuarios = [
      ...usuariosSalvos,
      novoUsuario,
    ];

    localStorage.setItem(
      USERS_KEY,
      JSON.stringify(novosUsuarios)
    );

    const usuarioSessao = {
      id: novoUsuario.id,
      nome: novoUsuario.nome,
      email: novoUsuario.email,
      criadoEm: novoUsuario.criadoEm,
    };

    localStorage.setItem(
      SESSION_KEY,
      JSON.stringify(usuarioSessao)
    );

    setUsuario(usuarioSessao);

    return {
      sucesso: true,
    };
  }

  function entrar({
    email,
    senha,
  }) {
    const usuariosSalvos =
      JSON.parse(
        localStorage.getItem(USERS_KEY)
      ) || [];

    const emailNormalizado =
      email.trim().toLowerCase();

    const encontrado =
      usuariosSalvos.find(
        (item) =>
          item.email.toLowerCase() ===
            emailNormalizado &&
          item.senha === senha
      );

    if (!encontrado) {
      return {
        sucesso: false,
        mensagem:
          "E-mail ou senha incorretos.",
      };
    }

    const usuarioSessao = {
      id: encontrado.id,
      nome: encontrado.nome,
      email: encontrado.email,
      criadoEm: encontrado.criadoEm,
    };

    localStorage.setItem(
      SESSION_KEY,
      JSON.stringify(usuarioSessao)
    );

    setUsuario(usuarioSessao);

    return {
      sucesso: true,
    };
  }

  function sair() {
    localStorage.removeItem(
      SESSION_KEY
    );

    setUsuario(null);
  }

  function atualizarNome(novoNome) {
    if (!usuario) {
      return;
    }

    const usuariosSalvos =
      JSON.parse(
        localStorage.getItem(USERS_KEY)
      ) || [];

    const novosUsuarios =
      usuariosSalvos.map((item) =>
        item.id === usuario.id
          ? {
              ...item,
              nome: novoNome,
            }
          : item
      );

    localStorage.setItem(
      USERS_KEY,
      JSON.stringify(novosUsuarios)
    );

    const novaSessao = {
      ...usuario,
      nome: novoNome,
    };

    localStorage.setItem(
      SESSION_KEY,
      JSON.stringify(novaSessao)
    );

    setUsuario(novaSessao);
  }

  return (
    <AuthContext.Provider
      value={{
        usuario,
        carregando,
        cadastrar,
        entrar,
        sair,
        atualizarNome,
      }}
    >
      {children}
    </AuthContext.Provider>
  );
}

export function useAuth() {
  const contexto =
    useContext(AuthContext);

  if (!contexto) {
    throw new Error(
      "useAuth precisa estar dentro de AuthProvider."
    );
  }

  return contexto;
}