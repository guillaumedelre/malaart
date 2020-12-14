<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201214090651 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE component_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE jewel_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE material_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE purchase_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE stone_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE supplier_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tag_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE component (id INT NOT NULL, component_id INT NOT NULL, jewel_id INT DEFAULT NULL, units INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_49FEA157E2ABAFFF ON component (component_id)');
        $this->addSql('CREATE INDEX IDX_49FEA15752829185 ON component (jewel_id)');
        $this->addSql('CREATE TABLE jewel (id INT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_146853845E237E06 ON jewel (name)');
        $this->addSql('CREATE TABLE jewel_tag (jewel_id INT NOT NULL, tag_id INT NOT NULL, PRIMARY KEY(jewel_id, tag_id))');
        $this->addSql('CREATE INDEX IDX_F5DD2A2E52829185 ON jewel_tag (jewel_id)');
        $this->addSql('CREATE INDEX IDX_F5DD2A2EBAD26311 ON jewel_tag (tag_id)');
        $this->addSql('CREATE TABLE material (id INT NOT NULL, material_id INT DEFAULT NULL, label VARCHAR(255) NOT NULL, type VARCHAR(255) DEFAULT NULL, size INT DEFAULT NULL, color VARCHAR(255) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, description TEXT DEFAULT NULL, units INT NOT NULL, threshold INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7CBE7595E308AC6F ON material (material_id)');
        $this->addSql('CREATE TABLE material_supplier (material_id INT NOT NULL, supplier_id INT NOT NULL, PRIMARY KEY(material_id, supplier_id))');
        $this->addSql('CREATE INDEX IDX_DDF248DCE308AC6F ON material_supplier (material_id)');
        $this->addSql('CREATE INDEX IDX_DDF248DC2ADD6D8C ON material_supplier (supplier_id)');
        $this->addSql('CREATE TABLE material_tag (material_id INT NOT NULL, tag_id INT NOT NULL, PRIMARY KEY(material_id, tag_id))');
        $this->addSql('CREATE INDEX IDX_B5B3AB75E308AC6F ON material_tag (material_id)');
        $this->addSql('CREATE INDEX IDX_B5B3AB75BAD26311 ON material_tag (tag_id)');
        $this->addSql('CREATE TABLE purchase (id INT NOT NULL, material_id INT DEFAULT NULL, supplier_id INT DEFAULT NULL, purchased_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, units INT NOT NULL, price DOUBLE PRECISION NOT NULL, image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6117D13BE308AC6F ON purchase (material_id)');
        $this->addSql('CREATE INDEX IDX_6117D13B2ADD6D8C ON purchase (supplier_id)');
        $this->addSql('CREATE TABLE stone (id INT NOT NULL, label VARCHAR(255) NOT NULL, chakra VARCHAR(255) NOT NULL, crystal_system VARCHAR(255) NOT NULL, nature VARCHAR(255) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1920052AEA750E8 ON stone (label)');
        $this->addSql('CREATE TABLE supplier (id INT NOT NULL, name VARCHAR(255) NOT NULL, url VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9B2A6C7E5E237E06 ON supplier (name)');
        $this->addSql('CREATE TABLE supplier_tag (supplier_id INT NOT NULL, tag_id INT NOT NULL, PRIMARY KEY(supplier_id, tag_id))');
        $this->addSql('CREATE INDEX IDX_8C79CD762ADD6D8C ON supplier_tag (supplier_id)');
        $this->addSql('CREATE INDEX IDX_8C79CD76BAD26311 ON supplier_tag (tag_id)');
        $this->addSql('CREATE TABLE tag (id INT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_389B783EA750E8 ON tag (label)');
        $this->addSql('ALTER TABLE component ADD CONSTRAINT FK_49FEA157E2ABAFFF FOREIGN KEY (component_id) REFERENCES material (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE component ADD CONSTRAINT FK_49FEA15752829185 FOREIGN KEY (jewel_id) REFERENCES jewel (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE jewel_tag ADD CONSTRAINT FK_F5DD2A2E52829185 FOREIGN KEY (jewel_id) REFERENCES jewel (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE jewel_tag ADD CONSTRAINT FK_F5DD2A2EBAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE material ADD CONSTRAINT FK_7CBE7595E308AC6F FOREIGN KEY (material_id) REFERENCES stone (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE material_supplier ADD CONSTRAINT FK_DDF248DCE308AC6F FOREIGN KEY (material_id) REFERENCES material (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE material_supplier ADD CONSTRAINT FK_DDF248DC2ADD6D8C FOREIGN KEY (supplier_id) REFERENCES supplier (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE material_tag ADD CONSTRAINT FK_B5B3AB75E308AC6F FOREIGN KEY (material_id) REFERENCES material (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE material_tag ADD CONSTRAINT FK_B5B3AB75BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE purchase ADD CONSTRAINT FK_6117D13BE308AC6F FOREIGN KEY (material_id) REFERENCES material (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE purchase ADD CONSTRAINT FK_6117D13B2ADD6D8C FOREIGN KEY (supplier_id) REFERENCES supplier (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE supplier_tag ADD CONSTRAINT FK_8C79CD762ADD6D8C FOREIGN KEY (supplier_id) REFERENCES supplier (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE supplier_tag ADD CONSTRAINT FK_8C79CD76BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE component DROP CONSTRAINT FK_49FEA15752829185');
        $this->addSql('ALTER TABLE jewel_tag DROP CONSTRAINT FK_F5DD2A2E52829185');
        $this->addSql('ALTER TABLE component DROP CONSTRAINT FK_49FEA157E2ABAFFF');
        $this->addSql('ALTER TABLE material_supplier DROP CONSTRAINT FK_DDF248DCE308AC6F');
        $this->addSql('ALTER TABLE material_tag DROP CONSTRAINT FK_B5B3AB75E308AC6F');
        $this->addSql('ALTER TABLE purchase DROP CONSTRAINT FK_6117D13BE308AC6F');
        $this->addSql('ALTER TABLE material DROP CONSTRAINT FK_7CBE7595E308AC6F');
        $this->addSql('ALTER TABLE material_supplier DROP CONSTRAINT FK_DDF248DC2ADD6D8C');
        $this->addSql('ALTER TABLE purchase DROP CONSTRAINT FK_6117D13B2ADD6D8C');
        $this->addSql('ALTER TABLE supplier_tag DROP CONSTRAINT FK_8C79CD762ADD6D8C');
        $this->addSql('ALTER TABLE jewel_tag DROP CONSTRAINT FK_F5DD2A2EBAD26311');
        $this->addSql('ALTER TABLE material_tag DROP CONSTRAINT FK_B5B3AB75BAD26311');
        $this->addSql('ALTER TABLE supplier_tag DROP CONSTRAINT FK_8C79CD76BAD26311');
        $this->addSql('DROP SEQUENCE component_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE jewel_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE material_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE purchase_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE stone_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE supplier_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tag_id_seq CASCADE');
        $this->addSql('DROP TABLE component');
        $this->addSql('DROP TABLE jewel');
        $this->addSql('DROP TABLE jewel_tag');
        $this->addSql('DROP TABLE material');
        $this->addSql('DROP TABLE material_supplier');
        $this->addSql('DROP TABLE material_tag');
        $this->addSql('DROP TABLE purchase');
        $this->addSql('DROP TABLE stone');
        $this->addSql('DROP TABLE supplier');
        $this->addSql('DROP TABLE supplier_tag');
        $this->addSql('DROP TABLE tag');
    }
}
