<div class="login">
  <h1>Toca dos Instrumentos</h1>

  <div>
    <h2>Login</h2>
    <form action="Controle/Controle" method="POST">
      <label for="fUsername">Username: </label>
      <input name="fUsername" type="text" required>

      <label for="fSenha">Senha: </label>
      <input name="fSenha" type="password" minlength="8" required>

      <input type="text" name="classeAcao" value="LoginControle/login" hidden>
      <button>Login</button>
    </form>
  </div>
</div>