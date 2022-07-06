<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220706121934 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE jour ADD disponibilite_id INT NOT NULL, ADD jour_fin DATE NOT NULL, CHANGE jour jour_debut DATE NOT NULL');
        $this->addSql('ALTER TABLE jour ADD CONSTRAINT FK_DA17D9C52B9D6493 FOREIGN KEY (disponibilite_id) REFERENCES disponibilites (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_DA17D9C52B9D6493 ON jour (disponibilite_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE jour DROP FOREIGN KEY FK_DA17D9C52B9D6493');
        $this->addSql('DROP INDEX UNIQ_DA17D9C52B9D6493 ON jour');
        $this->addSql('ALTER TABLE jour ADD jour DATE NOT NULL, DROP disponibilite_id, DROP jour_debut, DROP jour_fin');
    }
}
