import {
  useState,
} from "react";

import {
  Link,
  Navigate,
  useLocation,
  useNavigate,
} from "react-router-dom";

import {
  ArrowLeft,
  ArrowRight,
  Eye,
  EyeOff,
  LockKeyhole,
  Mail,
  Plane,
} from "lucide-react";

import { motion } from "framer-motion";

import {
  useAuth,
} from "../context/AuthContext";

import "../styles/Auth.css";

function Login() {
  const {
    entrar,
    usuario,
  } = useAuth();

  const navigate =
    useNavigate();

  const location =
    useLocation();

  const [email, setEmail] =
    useState("");

  const [senha, setSenha] =
    useState("");

  const [
    mostrarSenha,
    setMostrarSenha,
  ] = useState(false);

  const [erro, setErro] =
    useState("");

  const [enviando, setEnviando] =
    useState(false);

  if (usuario) {
    return (
      <Navigate
        to="/perfil"
        replace
      />
    );
  }

  function enviar(event) {
    event.preventDefault();

    setErro("");

    if (!email || !senha) {
      setErro(
        "Preencha seu e-mail e sua senha."
      );

      return;
    }

    setEnviando(true);

    const resultado =
      entrar({
        email,
        senha,
      });

    setEnviando(false);

    if (!resultado.sucesso) {
      setErro(
        resultado.mensagem
      );

      return;
    }

    const destino =
      location.state?.from ||
      "/perfil";

    navigate(
      destino,
      {
        replace: true,
      }
    );
  }

  return (
    <main className="auth-page">
      <section className="auth-visual">
        <div className="auth-visual-overlay" />

        <Link
          to="/"
          className="auth-logo"
        >
          <div>
            <Plane size={20} />
          </div>

          <span>
            Inter
            <strong>Way</strong>
          </span>
        </Link>

        <motion.div
          className="auth-visual-content"
          initial={{
            opacity: 0,
            y: 30,
          }}
          animate={{
            opacity: 1,
            y: 0,
          }}
          transition={{
            duration: 0.7,
          }}
        >
          <span>
            SUA JORNADA CONTINUA
          </span>

          <h1>
            O mundo ainda tem
            muita coisa esperando
            por você.
          </h1>

          <p>
            Entre na sua conta para
            continuar planejando sua
            experiência internacional.
          </p>
        </motion.div>

        <div className="auth-place">
          <span>📍</span>

          <div>
            <strong>Dublin</strong>
            <p>Irlanda</p>
          </div>
        </div>
      </section>

      <section className="auth-form-area">
        <div className="auth-mobile-top">
          <Link to="/">
            <ArrowLeft size={18} />
          </Link>

          <span>InterWay</span>
        </div>

        <motion.div
          className="auth-form-container"
          initial={{
            opacity: 0,
            x: 25,
          }}
          animate={{
            opacity: 1,
            x: 0,
          }}
          transition={{
            duration: 0.55,
          }}
        >
          <div className="auth-heading">
            <span>
              BEM-VINDO DE VOLTA
            </span>

            <h2>
              Entre na sua conta.
            </h2>

            <p>
              Continue de onde você
              parou.
            </p>
          </div>

          <form
            onSubmit={enviar}
            className="auth-form"
          >
            {erro && (
              <div className="auth-error">
                {erro}
              </div>
            )}

            <div className="auth-field">
              <label>
                E-mail
              </label>

              <div className="auth-input">
                <Mail size={19} />

                <input
                  type="email"
                  placeholder="seu@email.com"
                  value={email}
                  onChange={(event) =>
                    setEmail(
                      event.target.value
                    )
                  }
                />
              </div>
            </div>

            <div className="auth-field">
              <div className="auth-label-row">
                <label>
                  Senha
                </label>

                <button
                  type="button"
                  className="forgot-password"
                >
                  Esqueci minha senha
                </button>
              </div>

              <div className="auth-input">
                <LockKeyhole
                  size={19}
                />

                <input
                  type={
                    mostrarSenha
                      ? "text"
                      : "password"
                  }
                  placeholder="Sua senha"
                  value={senha}
                  onChange={(event) =>
                    setSenha(
                      event.target.value
                    )
                  }
                />

                <button
                  type="button"
                  className="show-password"
                  onClick={() =>
                    setMostrarSenha(
                      !mostrarSenha
                    )
                  }
                >
                  {mostrarSenha ? (
                    <EyeOff
                      size={19}
                    />
                  ) : (
                    <Eye
                      size={19}
                    />
                  )}
                </button>
              </div>
            </div>

            <button
              type="submit"
              className="auth-submit"
              disabled={enviando}
            >
              {enviando
                ? "Entrando..."
                : "Entrar"}

              <ArrowRight
                size={18}
              />
            </button>
          </form>

          <div className="auth-register">
            Ainda não tem uma conta?

            <Link to="/cadastro">
              Criar conta
            </Link>
          </div>
        </motion.div>
      </section>
    </main>
  );
}

export default Login;