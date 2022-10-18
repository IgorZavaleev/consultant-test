<?php
declare(strict_types=1);

namespace Igor\ConsultantTest\Migrations;

class CreateTables extends MigrationAbstract
{
    public function migrate()
    {
        $this->database->executeQuery('DROP TABLE IF EXISTS chess_position');
        $this->database->executeQuery(<<<END
CREATE TABLE chess_position (
     id MEDIUMINT NOT NULL AUTO_INCREMENT,
     name CHAR(30) NOT NULL,
     PRIMARY KEY (id)
)
END
        );
        $this->database->executeQuery('DROP TABLE IF EXISTS chess_piece_location');
        $this->database->executeQuery(<<<END
CREATE TABLE chess_piece_location (
     id MEDIUMINT NOT NULL AUTO_INCREMENT,
     x SMALLINT NOT NULL,
     y SMALLINT NOT NULL,
     chess_piece SMALLINT NOT NULL,
     color SMALLINT NOT NULL,
     position_id MEDIUMINT NOT NULL,
     PRIMARY KEY (id)
)
END
        );
    }
}
