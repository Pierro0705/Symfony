<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191130160225 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE bien ADD prixParNuit DOUBLE PRECISION DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE bien DROP FOREIGN KEY FK_45EDC386A73F0036');
        $this->addSql('ALTER TABLE bien DROP FOREIGN KEY FK_45EDC38676C50E4A');
        $this->addSql('ALTER TABLE bien DROP FOREIGN KEY FK_45EDC386677134B4');
        $this->addSql('ALTER TABLE bien DROP prixParNuit');
        $this->addSql('ALTER TABLE louer DROP FOREIGN KEY FK_D1EAF4D19EB6921');
        $this->addSql('ALTER TABLE louer DROP FOREIGN KEY FK_D1EAF4DBD95B80F');
        $this->addSql('ALTER TABLE proprietaire DROP FOREIGN KEY FK_69E399D6FC7F7A51');
        $this->addSql('ALTER TABLE ville DROP FOREIGN KEY FK_43C3D9C3A6E44244');
    }
}
