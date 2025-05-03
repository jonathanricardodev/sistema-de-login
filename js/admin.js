window.onload = () => {
  fetch("php/listar_usuarios.php")
    .then(res => res.json())
    .then(usuarios => {
      const tbody = document.querySelector("#tabelaUsuarios tbody");
      usuarios.forEach(u => {
        const tr = document.createElement("tr");
        tr.innerHTML = `
          <td><input id="nome-${u.id}" value="${u.nome}"/></td>
          <td><input id="email-${u.id}" value="${u.email}"/></td>
          <td><button onclick="confirmarReset(${u.id})">Resetar Senha</button></td>
          <td>
            <button onclick="aplicarAlteracoes(${u.id})">Aplicar alterações</button>
            <button onclick="removerUsuario(${u.id})">Deletar Usuário</button>
          </td>
        `;
        tbody.appendChild(tr);
      });
    });
};

function aplicarAlteracoes(id) {
  const nome = document.getElementById(`nome-${id}`).value;
  const email = document.getElementById(`email-${id}`).value;

  const confirmar = confirm("Deseja aplicar as alterações para este usuário?");
  if (!confirmar) return;

  editarCampo(id, "nome", nome);
  editarCampo(id, "email", email);
}

function editarCampo(id, campo, valor) {
  fetch("php/editar_usuario.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ id, campo, valor })
  })
    .then(res => res.json())
    .then(res => {
      if (res.status === "ok") {
        console.log(`✅ ${campo} atualizado com sucesso.`);
        if (campo === "senha") {
          alert("Senha redefinida com sucesso.");
        } else {
          alert(`O campo ${campo} foi atualizado com sucesso.`);
        }
      } else {
        console.log(`⚠️ Nenhuma alteração no campo ${campo}.`);
        alert(`Nenhuma alteração foi feita no campo ${campo}.`);
      }
    })
    .catch(() => {
      alert("Erro ao comunicar com o servidor.");
    });
}




function confirmarReset(id) {
  const ok = confirm("Deseja realmente redefinir a senha deste usuário?");
  if (!ok) return;

  const novaSenha = prompt("Digite a nova senha:");
  if (novaSenha)
    editarCampo(id, "senha", novaSenha);
}


function removerUsuario(id) {
  const confirmar = confirm("Tem certeza que deseja remover este usuário? Essa ação não poderá ser desfeita.");
  if (!confirmar) return;

  fetch("php/remover_usuario.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ id })
  })
    .then(res => res.json())
    .then(res => {
      if (res.status === "ok") {
        alert("Usuário removido com sucesso.");
        location.reload();
      } else {
        alert("Erro ao remover usuário.");
      }
    })
    .catch(() => {
      alert("Erro ao comunicar com o servidor.");
    });
}


