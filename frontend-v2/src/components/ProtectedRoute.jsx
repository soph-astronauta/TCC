import { Navigate } from "react-router-dom";

import { useAuth } from "../context/AuthContext";

function ProtectedRoute({
  children,
}) {
  const {
    usuario,
    carregando,
  } = useAuth();

  if (carregando) {
    return (
      <main className="auth-loading">
        <div className="auth-spinner" />
      </main>
    );
  }

  if (!usuario) {
    return (
      <Navigate
        to="/login"
        replace
      />
    );
  }

  return children;
}

export default ProtectedRoute;