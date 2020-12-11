<?php

class Relatorios_ead_model extends CI_Model {

    public function __construct()
    {
        parent::__construct(); 
    }

    public function cursos() {
        $sql = "SELECT title_id AS id, title_name AS nome FROM exam_title ORDER BY title_id;";

        return $this->db->query($sql)->result();        
    }

    public function cargos() {
        $sql = "SELECT idCargo AS id, cargo AS nome FROM cargos ORDER BY idCargo;";

        return $this->db->query($sql)->result(); 
    }

    public function countAvaliados($curso, $cargo, $regiao) {        
        $sql = "SELECT COUNT(avaliados) AS avaliados FROM 
        (SELECT r.user_id AS avaliados, r.user_id FROM result AS r 
        INNER JOIN users AS u on r.user_id = u.user_id 
        WHERE u.regiao = $regiao and u.active = 1 AND u.idCargo = $cargo AND r.exam_id = $curso
        ) AS temp";
        
        return $this->db->query($sql)->row(); 
    }

    public function countAprovados($curso, $cargo, $regiao) {
        $sql = "SELECT COUNT(aprovados) AS aprovados FROM 
        (SELECT r.user_id AS aprovados FROM result AS r
        INNER JOIN users AS u on r.user_id = u.user_id 
        WHERE u.regiao = $regiao AND r.result_percent >= 60 and u.active = 1 AND u.idCargo = $cargo AND r.exam_id = $curso) AS temp";

        return $this->db->query($sql)->row();
    }

    public function countReprovados($curso, $cargo, $regiao) {
        $sql = "SELECT COUNT(reprovados) AS reprovados FROM 
        (SELECT r.user_id AS reprovados FROM result AS r 
        INNER JOIN users AS u on r.user_id = u.user_id 
        WHERE u.regiao = $regiao AND r.result_percent < 60 and u.active = 1 AND u.idCargo = $cargo AND r.exam_id = $curso) AS temp";

        return $this->db->query($sql)->row();
    }

            /* Modal */

    public function naoFizeram($curso, $cargo, $regiao) {
        $sql = "SELECT COUNT(u.user_id) AS naoFizeram                
        FROM users AS u
        WHERE u.active = 1 AND u.idCargo = $cargo AND u.regiao = $regiao AND u.user_id NOT IN (SELECT user_id FROM result WHERE exam_id = $curso)";

        return $this->db->query($sql)->row();
    }

    public function modalNaoFizeram($curso, $cargo, $regiao) {
        $sql = "SELECT user_name AS Nome, (SELECT c.cargo FROM cargos AS c WHERE u.idCargo = c.idCargo) AS Cargo                
        FROM users AS u
        WHERE u.active = 1 AND u.idCargo = $cargo AND u.regiao = $regiao AND u.user_id NOT IN (SELECT user_id FROM result WHERE exam_id = $curso)";

        return $this->db->query($sql)->result();
    }

    public function modalReprovados($curso, $cargo, $regiao) {
        $sql = "SELECT user_name AS Nome, (SELECT c.cargo FROM cargos AS c WHERE u.idCargo = c.idCargo) AS Cargo FROM result AS r
        INNER JOIN users AS u on r.user_id = u.user_id 
        WHERE u.regiao = $regiao AND r.result_percent < 60 and u.active = 1 AND u.idCargo = $cargo AND r.exam_id = $curso";

        return $this->db->query($sql)->result();
    }

    public function modalAprovados($curso, $cargo, $regiao) {
        $sql = "SELECT user_name AS Nome, (SELECT c.cargo FROM cargos AS c WHERE u.idCargo = c.idCargo) AS Cargo FROM result AS r
        INNER JOIN users AS u on r.user_id = u.user_id 
        WHERE u.regiao = $regiao AND r.result_percent >= 60 and u.active = 1 AND u.idCargo = $cargo AND r.exam_id = $curso";

        return $this->db->query($sql)->result();
    }

            /* Tabelas */

    public function relTotal($curso, $cargo, $regiao){
        $sql = "SELECT (SELECT u.user_name FROM users AS u WHERE r.user_id = u.user_id) AS Nome, 
        (SELECT c.cargo FROM cargos AS c WHERE u.idCargo = c.idCargo) AS Cargo,
        (SELECT et.title_name FROM exam_title AS et WHERE et.title_id = r.exam_id) AS Curso, 
        result_percent AS nota, 
        u.regiao AS Regiao
        FROM result AS r 
        INNER JOIN users AS u on r.user_id = u.user_id 
        WHERE u.regiao = $regiao and u.active = 1 AND u.idCargo = $cargo AND r.exam_id = $curso";

        return $this->db->query($sql)->result();
    }
}
