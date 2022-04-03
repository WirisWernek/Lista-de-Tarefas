<?php
class TarefaService
{
    private $conexao;
    private $tarefa;

    public function __construct(Conexao $conexao, Tarefa $tarefa)
    {
        $this->conexao = $conexao->conectar();
        $this->tarefa = $tarefa;
    }
    public function inserir()
    {
        $sql = "INSERT INTO tb_tarefas(tarefa) VALUES(?)";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $this->tarefa->__get('tarefa'));
        $stmt->execute();
    }
    public function recuperar()
    {
        $sql = "SELECT t.id, s.status, t.tarefa FROM tb_tarefas AS t LEFT JOIN tb_status AS s ON (t.id_status = s.id)";

        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function atualizar()
    {
        $sql = "UPDATE tb_tarefas set tarefa = ? WHERE id = ?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $this->tarefa->__get('tarefa'));
        $stmt->bindValue(2, $this->tarefa->__get('id'));
        return $stmt->execute();
    }
    public function remover()
    {
        $sql = "DELETE FROM tb_tarefas WHERE id = ?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $this->tarefa->__get('id'));
        return $stmt->execute();
    }
    public function marcarRealizada()
    {
        $sql = "UPDATE tb_tarefas set id_status = ? WHERE id = ?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $this->tarefa->__get('id_status'));
        $stmt->bindValue(2, $this->tarefa->__get('id'));
        return $stmt->execute();
    }
    public function recuperarPendentes()
    {
        $sql = "SELECT t.id, s.status, t.tarefa FROM tb_tarefas AS t LEFT JOIN tb_status AS s ON (t.id_status = s.id) WHERE t.id_status = ?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $this->tarefa->__get("id_status"));
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
