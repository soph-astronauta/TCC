import {
  BrowserRouter,
  Route,
  Routes,
} from "react-router-dom";

import {
  AuthProvider,
} from "./context/AuthContext";

import ProtectedRoute
  from "./components/ProtectedRoute";

import Home from "./pages/Home";
import Destinos from "./pages/Destinos";
import DestinoDetalhes
  from "./pages/DestinoDetalhes";
import Match from "./pages/Match";
import Login from "./pages/Login";
import Cadastro
  from "./pages/Cadastro";
import Perfil from "./pages/Perfil";

function App() {
  return (
    <BrowserRouter>
      <AuthProvider>
        <Routes>
          <Route
            path="/"
            element={<Home />}
          />

          <Route
            path="/destinos"
            element={<Destinos />}
          />

          <Route
            path="/destinos/:slug"
            element={
              <DestinoDetalhes />
            }
          />

          <Route
            path="/match"
            element={<Match />}
          />

          <Route
            path="/login"
            element={<Login />}
          />

          <Route
            path="/cadastro"
            element={<Cadastro />}
          />

          <Route
            path="/perfil"
            element={
              <ProtectedRoute>
                <Perfil />
              </ProtectedRoute>
            }
          />
        </Routes>
      </AuthProvider>
    </BrowserRouter>
  );
}

export default App;