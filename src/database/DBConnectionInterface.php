<?php
/**
 * Interface for Database connections . The client should should implement these to communication to the
 * appropriate database
 */
interface DBConnectionInterface
{
    public function execute();
    public function query($query);
    public function resultSet();
    public function single();
    public function rowCount();

}

