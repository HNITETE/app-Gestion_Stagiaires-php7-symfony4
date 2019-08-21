<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190530113354 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, price INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE stagiaire DROP FOREIGN KEY FK_4F62F731BAD77FA2');
        $this->addSql('ALTER TABLE stagiaire ADD pic VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE stagiaire ADD CONSTRAINT FK_4F62F731BAD77FA2 FOREIGN KEY (CODEGR) REFERENCES groupe (CODEGR)');
        $this->addSql('ALTER TABLE groupe DROP NOMBRE_ST');
        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C242628BAD77FA2');
        $this->addSql('ALTER TABLE module CHANGE DATEMO DATEMO VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C242628BAD77FA2 FOREIGN KEY (CODEGR) REFERENCES groupe (CODEGR)');
        $this->addSql('ALTER TABLE module RENAME INDEX codegr TO IDX_C242628BAD77FA2');
        $this->addSql('ALTER TABLE seance RENAME INDEX codegr TO IDX_DF7DFD0E233EFBF1');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE product');
        $this->addSql('ALTER TABLE groupe ADD NOMBRE_ST INT DEFAULT NULL');
        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C242628BAD77FA2');
        $this->addSql('ALTER TABLE module CHANGE DATEMO DATEMO VARCHAR(100) DEFAULT NULL COLLATE utf8_general_ci');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C242628BAD77FA2 FOREIGN KEY (CODEGR) REFERENCES groupe (CODEGR) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE module RENAME INDEX idx_c242628bad77fa2 TO CODEGR');
        $this->addSql('ALTER TABLE seance RENAME INDEX idx_df7dfd0e233efbf1 TO CODEGR');
        $this->addSql('ALTER TABLE stagiaire DROP FOREIGN KEY FK_4F62F731BAD77FA2');
        $this->addSql('ALTER TABLE stagiaire DROP pic');
        $this->addSql('ALTER TABLE stagiaire ADD CONSTRAINT FK_4F62F731BAD77FA2 FOREIGN KEY (CODEGR) REFERENCES groupe (CODEGR) ON UPDATE CASCADE ON DELETE CASCADE');
    }
}
