<?php

namespace Uvweb\UvBundle\Forms;


class SearchStatement {
    private $statement;

    /**
     * @param string $statement
     */
    public function setStatement($statement)
    {
        $this->statement = $statement;
    }

    /**
     * @return string
     */
    public function getStatement()
    {
        return $this->statement;
    }


}