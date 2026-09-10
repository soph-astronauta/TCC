import {
  useState,
} from "react";

import {
  Link,
  useNavigate,
} from "react-router-dom";

import {
  ArrowLeft,
  ArrowRight,
  CalendarDays,
  Compass,
  Edit3,
  Globe2,
  Heart,
  LogOut,
  Mail,
  Map,
  Plane,
  Save,
  User,
  X,
} from "lucide-react";

import { motion } from "framer-motion";

import {
  useAuth,
} from "../context/AuthContext";

import "../styles/Auth.css";

function Perfil() {
  const {
    usuario,
    sair,
    atualizarNome,
  } = useAuth();

  const navigate =
    useNavigate();

  const [
    editando,
    setEditando,
  ] = useState(false);

  const [
    novoNome,
    setNovoNome,
  ] = useState(
    usuario?.nome || ""
  );

  function fazerLogout() {
    sair();

    navigate("/");
  }

  function salvarNome() {
    if (
      novoNome.trim().length < 3
    ) {
      return;
    }

    atualizarNome(
      novoNome.trim()
    );

    setEditando(false);
  }

  function pegarIniciais() {
    return usuario.nome
      .split(" ")
      .slice(0, 2)
      .map((parte) =>
        parte[0]?.toUpperCase()
      )
      .join("");
  }

  function formatarData() {
    if (!usuario.criadoEm) {
      return "Hoje";
    }

    return new Intl.DateTimeFormat(
      "pt-BR",
      {
        month: "long",
        year: "numeric",
      }
    ).format(
      new Date(
        usuario.criadoEm
      )
    );
  }

  return (
    <main className="profile-page">
      <header className="profile-navbar">
        <Link
          to="/"
          className="profile-logo"
        >
          <div>
            <Plane size={19} />
          </div>

          <span>
            Inter
            <strong>Way</strong>
          </span>
        </Link>

        <nav>
          <Link to="/">
            Início
          </Link>

          <Link to="/destinos">
            Destinos
          </Link>

          <Link to="/match">
            InterWay Match
          </Link>
        </nav>

        <button
          onClick={fazerLogout}
          className="profile-logout"
        >
          <LogOut size={17} />
          Sair
        </button>
      </header>

      <section className="profile-hero">
        <div className="profile-hero-bg" />

        <motion.div
          className="profile-hero-content"
          initial={{
            opacity: 0,
            y: 25,
          }}
          animate={{
            opacity: 1,
            y: 0,
          }}
        >
          <Link
            to="/"
            className="profile-back"
          >
            <ArrowLeft size={17} />
            Voltar para o início
          </Link>

          <div className="profile-user">
            <div className="profile-avatar">
              {pegarIniciais()}
            </div>

            <div>
              <span>
                MEU INTERWAY
              </span>

              <h1>
                Olá,{" "}
                {
                  usuario.nome.split(
                    " "
                  )[0]
                }
                . 👋
              </h1>

              <p>
                Continue planejando sua
                próxima experiência.
              </p>
            </div>
          </div>
        </motion.div>
      </section>

      <section className="profile-content">
        <div className="profile-main">
          <div className="profile-section-title">
            <div>
              <span>
                SUA JORNADA
              </span>

              <h2>
                Continue explorando.
              </h2>
            </div>
          </div>

          <div className="profile-actions-grid">
            <Link
              to="/match"
              className="profile-action-card featured"
            >
              <div className="profile-action-icon">
                <Compass size={25} />
              </div>

              <div>
                <span>
                  INTERWAY MATCH
                </span>

                <h3>
                  Encontre seu destino
                  ideal
                </h3>

                <p>
                  Descubra quais países
                  mais combinam com seu
                  perfil.
                </p>
              </div>

              <ArrowRight
                className="profile-arrow"
              />
            </Link>

            <Link
              to="/destinos"
              className="profile-action-card"
            >
              <div className="profile-action-icon">
                <Globe2 size={25} />
              </div>

              <div>
                <span>
                  EXPLORAR
                </span>

                <h3>
                  Ver destinos
                </h3>

                <p>
                  Conheça países,
                  cidades e possibilidades.
                </p>
              </div>

              <ArrowRight
                className="profile-arrow"
              />
            </Link>

            <div className="profile-action-card">
              <div className="profile-action-icon">
                <Heart size={25} />
              </div>

              <div>
                <span>
                  FAVORITOS
                </span>

                <h3>
                  Seus favoritos
                </h3>

                <p>
                  Você ainda não salvou
                  nenhum destino.
                </p>
              </div>
            </div>

            <div className="profile-action-card">
              <div className="profile-action-icon">
                <Map size={25} />
              </div>

              <div>
                <span>
                  PLANEJAMENTO
                </span>

                <h3>
                  Minha viagem
                </h3>

                <p>
                  Em breve você poderá
                  montar seu planejamento.
                </p>
              </div>
            </div>
          </div>
        </div>

        <aside className="profile-sidebar">
          <div className="profile-card">
            <div className="profile-card-header">
              <div>
                <span>
                  MINHA CONTA
                </span>

                <h3>
                  Informações pessoais
                </h3>
              </div>

              {!editando ? (
                <button
                  onClick={() =>
                    setEditando(true)
                  }
                >
                  <Edit3 size={17} />
                </button>
              ) : (
                <button
                  onClick={() => {
                    setNovoNome(
                      usuario.nome
                    );

                    setEditando(false);
                  }}
                >
                  <X size={17} />
                </button>
              )}
            </div>

            <div className="profile-info-list">
              <div>
                <div className="profile-info-icon">
                  <User size={18} />
                </div>

                <div>
                  <span>Nome</span>

                  {editando ? (
                    <input
                      value={novoNome}
                      onChange={(event) =>
                        setNovoNome(
                          event.target.value
                        )
                      }
                    />
                  ) : (
                    <strong>
                      {usuario.nome}
                    </strong>
                  )}
                </div>
              </div>

              <div>
                <div className="profile-info-icon">
                  <Mail size={18} />
                </div>

                <div>
                  <span>E-mail</span>

                  <strong>
                    {usuario.email}
                  </strong>
                </div>
              </div>

              <div>
                <div className="profile-info-icon">
                  <CalendarDays
                    size={18}
                  />
                </div>

                <div>
                  <span>
                    Membro desde
                  </span>

                  <strong>
                    {formatarData()}
                  </strong>
                </div>
              </div>
            </div>

            {editando && (
              <button
                className="profile-save"
                onClick={salvarNome}
              >
                <Save size={17} />
                Salvar alterações
              </button>
            )}
          </div>

          <div className="profile-tip">
            <span>✨</span>

            <div>
              <strong>
                Complete seu Match
              </strong>

              <p>
                Quanto mais conhecemos
                seu perfil, melhores
                ficam as recomendações.
              </p>

              <Link to="/match">
                Fazer Match
                <ArrowRight
                  size={15}
                />
              </Link>
            </div>
          </div>
        </aside>
      </section>
    </main>
  );
}

export default Perfil;