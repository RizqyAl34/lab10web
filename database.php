<?php
class Database {
    protected $host;
    protected $user;
    protected $password;
    protected $db_name;
    protected $conn;

    public function __construct() {
        $this->getConfig();
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->db_name);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    private function getConfig() {
        include_once("config.php");
        $this->host = $config['host'];
        $this->user = $config['username'];
        $this->password = $config['password'];
        $this->db_name = $config['db_name'];
    }

    public function query($sql) {
        return $this->conn->query($sql);
    }

    public function get($table, $where = null) {
        $sql = "SELECT * FROM ".$table;
        if ($where) $sql .= " WHERE ".$where;
        $res = $this->conn->query($sql);
        if ($res === false) return false;
        $rows = [];
        while ($r = $res->fetch_assoc()) {
            $rows[] = $r;
        }
        return $rows;
    }

    public function insert($table, $data) {
        if (!is_array($data) || empty($data)) return false;
        $columns = [];
        $values = [];
        foreach ($data as $k => $v) {
            $columns[] = $k;
            $values[] = "'".$this->conn->real_escape_string($v)."'";
        }
        $sql = "INSERT INTO ".$table." (".implode(",", $columns).") VALUES (".implode(",", $values).")";
        return $this->conn->query($sql);
    }

    public function update($table, $data, $where) {
        if (!is_array($data) || empty($data) || !$where) return false;
        $update_parts = [];
        foreach ($data as $k => $v) {
            $update_parts[] = $k."='".$this->conn->real_escape_string($v)."'";
        }
        $sql = "UPDATE ".$table." SET ".implode(",",$update_parts)." WHERE ".$where;
        return $this->conn->query($sql);
    }

    public function delete($table, $where) {
        if (!$where) return false;
        $sql = "DELETE FROM ".$table." WHERE ".$where;
        return $this->conn->query($sql);
    }
}
