<?php
/**
 * Interface for Database connections
 */
interface DBConnectionInterface
{
    public function execute();
    public function query($query);
    public function resultSet();
    public function single();
    public function rowCount();

}

