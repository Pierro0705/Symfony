<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191130115959 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE bien ADD ville_id INT NOT NULL, ADD proprietaire_id INT NOT NULL, ADD typebien_id INT NOT NULL');
        $this->addSql('CREATE INDEX IDX_45EDC386A73F0036 ON bien (ville_id)');
        $this->addSql('CREATE INDEX IDX_45EDC38676C50E4A ON bien (proprietaire_id)');
        $this->addSql('CREATE INDEX IDX_45EDC386677134B4 ON bien (typebien_id)');
        $this->addSql('ALTER TABLE louer ADD client_id INT NOT NULL, ADD bien_id INT NOT NULL');
        $this->addSql('CREATE INDEX IDX_D1EAF4D19EB6921 ON louer (client_id)');
        $this->addSql('CREATE INDEX IDX_D1EAF4DBD95B80F ON louer (bien_id)');
        $this->addSql('ALTER TABLE proprietaire ADD typeproprietaire_id INT NOT NULL');
        $this->addSql('CREATE INDEX IDX_69E399D6FC7F7A51 ON proprietaire (typeproprietaire_id)');
        $this->addSql('ALTER TABLE ville ADD pays_id INT NOT NULL');
        $this->addSql('CREATE INDEX IDX_43C3D9C3A6E44244 ON ville (pays_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE bien DROP FOREIGN KEY FK_45EDC386A73F0036');
        $this->addSql('ALTER TABLE bien DROP FOREIGN KEY FK_45EDC38676C50E4A');
        $this->addSql('ALTER TABLE bien DROP FOREIGN KEY FK_45EDC386677134B4');
        $this->addSql('DROP INDEX IDX_45EDC386A73F0036 ON bien');
        $this->addSql('DROP INDEX IDX_45EDC38676C50E4A ON bien');
        $this->addSql('DROP INDEX IDX_45EDC386677134B4 ON bien');
        $this->addSql('ALTER TABLE bien DROP ville_id, DROP proprietaire_id, DROP typebien_id');
        $this->addSql('ALTER TABLE louer DROP FOREIGN KEY FK_D1EAF4D19EB6921');
        $this->addSql('ALTER TABLE louer DROP FOREIGN KEY FK_D1EAF4DBD95B80F');
        $this->addSql('DROP INDEX IDX_D1EAF4D19EB6921 ON louer');
        $this->addSql('DROP INDEX IDX_D1EAF4DBD95B80F ON louer');
        $this->addSql('ALTER TABLE louer DROP client_id, DROP bien_id');
        $this->addSql('ALTER TABLE proprietaire DROP FOREIGN KEY FK_69E399D6FC7F7A51');
        $this->addSql('DROP INDEX IDX_69E399D6FC7F7A51 ON proprietaire');
        $this->addSql('ALTER TABLE proprietaire DROP typeproprietaire_id');
        $this->addSql('ALTER TABLE ville DROP FOREIGN KEY FK_43C3D9C3A6E44244');
        $this->addSql('DROP INDEX IDX_43C3D9C3A6E44244 ON ville');
        $this->addSql('ALTER TABLE ville DROP pays_id');
    }
}
