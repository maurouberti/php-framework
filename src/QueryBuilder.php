<?php

namespace PHP\Framework;

class QueryBuilder
{
    protected $sql = '';
    protected $bind = [];
    public $where = '';
    public $bindWhere = [];
    public $orderBy = '';
    
    public function sqlSelect(string $table)
    {
        $this->sql = "select * from $table";
        return $this;
    }

    public function sqlInsert(string $table, array $data)
    {
        $sql = "insert into $table (%s) values (%s)";

        $columns = array_keys($data);
        $values = array_fill(0, count($columns), '?');
        $this->bind = array_values($data);

        $this->sql = sprintf($sql, implode(', ', $columns), implode(', ', $values));

        return $this;
    }

    public function sqlUpdate(string $table, array $data)
    {
        $sql = "update $table SET %s";

        $columns = array_keys($data);

        foreach ($columns as &$column) {
            $column = $column . '=?';
        }

        $this->bind = array_values($data);
        $this->sql = sprintf($sql, implode(', ', $columns));

        return $this;
    }

    public function sqlDelete(string $table)
    {
        $this->sql = "delete from $table";
        return $this;
    }

    public function where(string $column, string $operator, $value)
    {
        $condition = $this->where == '' ? ' where ' : ' and ';
        $this->where .= $condition . $column . $operator . '?';
        $this->bindWhere[] = $value;
        return $this;
    }

    public function orWhere(string $column, string $operator, $value)
    {
        $where = $this->where == '' ? ' where ' : ' or ';
        $this->where .= $where . $column . $operator . '?';
        $this->bindWhere[] = $value;
        return $this;
    }

    public function orderBy(string $column, string $classification)
    {
        $orderBy = $this->orderBy == '' ? ' order by ' : ', ';
        $this->orderBy .= $orderBy . $column . (strtolower($classification) == 'desc' ? ' desc' : '');
        return $this;
    }

    public function getData() :\stdClass
    {
        $query = new \stdClass;
        $query->sql = $this->sql . $this->where . $this->orderBy;
        $query->bind = array_merge($this->bind, $this->bindWhere);

        // $this->sql = '';
        // $this->bind = [];
        // $this->where = '';
        // $this->bindWhere = [];
        // $this->orderBy = '';

        return $query;
    }
}
