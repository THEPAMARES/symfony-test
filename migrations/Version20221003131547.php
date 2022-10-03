<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221003131547 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE allergens (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', allergen_code VARCHAR(10) NOT NULL, name VARCHAR(255) NOT NULL, allergen_group VARCHAR(255) NOT NULL, created_date DATETIME NOT NULL, import_id VARCHAR(20) NOT NULL, UNIQUE INDEX UNIQ_67F79FB49F50571C (allergen_code), INDEX allergens_index (allergen_code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ccam (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', group_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', category_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', code VARCHAR(255) NOT NULL, name LONGTEXT NOT NULL, description LONGTEXT DEFAULT NULL, rate1 DOUBLE PRECISION DEFAULT NULL, rate2 DOUBLE PRECISION DEFAULT NULL, modifiers JSON NOT NULL, regroupement_code VARCHAR(4) NOT NULL, created_date DATETIME NOT NULL, import_id VARCHAR(20) NOT NULL, UNIQUE INDEX UNIQ_DA3B58B77153098 (code), INDEX IDX_DA3B58BFE54D947 (group_id), INDEX IDX_DA3B58B12469DE2 (category_id), INDEX ccam_index (code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ccam_group (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', parent_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', code VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, created_date DATETIME NOT NULL, import_id VARCHAR(20) NOT NULL, UNIQUE INDEX UNIQ_1CAEEE9E77153098 (code), INDEX IDX_1CAEEE9E727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE diseases (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', parent_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', group_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', category_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', cim VARCHAR(255) NOT NULL, name LONGTEXT NOT NULL, hierarchy_level SMALLINT NOT NULL, sex SMALLINT DEFAULT NULL, lower_age_limit INT DEFAULT NULL, upper_age_limit INT DEFAULT NULL, created_date DATETIME NOT NULL, import_id VARCHAR(20) NOT NULL, UNIQUE INDEX UNIQ_F762064732EC6160 (cim), INDEX IDX_F7620647727ACA70 (parent_id), INDEX IDX_F7620647FE54D947 (group_id), INDEX IDX_F762064712469DE2 (category_id), INDEX diseases_index (cim), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE diseases_group (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', parent_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', cim VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, created_date DATETIME NOT NULL, import_id VARCHAR(20) NOT NULL, UNIQUE INDEX UNIQ_5B413DF032EC6160 (cim), INDEX IDX_5B413DF0727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE drugs (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', cis_id VARCHAR(255) DEFAULT NULL, name VARCHAR(255) NOT NULL, pharmaceutical_form VARCHAR(255) DEFAULT NULL, administration_forms LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', owner VARCHAR(255) DEFAULT NULL, presentation_label VARCHAR(255) DEFAULT NULL, reimbursement_rates LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', price DOUBLE PRECISION DEFAULT NULL, prescription_conditions VARCHAR(255) DEFAULT NULL, generic_type LONGTEXT DEFAULT NULL, generic_group_id INT DEFAULT NULL, generic_label SMALLINT DEFAULT NULL, security_text LONGTEXT DEFAULT NULL, created_date DATETIME NOT NULL, import_id VARCHAR(20) NOT NULL, UNIQUE INDEX UNIQ_DA2C39DA4B0ADA3B (cis_id), INDEX drugs_index (cis_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ngap (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', code VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, created_date DATETIME NOT NULL, import_id VARCHAR(20) NOT NULL, UNIQUE INDEX UNIQ_9BC6A95377153098 (code), INDEX ngap_index (code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rpps (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', id_rpps VARCHAR(255) DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, first_name VARCHAR(255) DEFAULT NULL, specialty VARCHAR(255) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, zipcode VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, phone_number VARCHAR(35) DEFAULT NULL COMMENT \'(DC2Type:phone_number)\', email VARCHAR(255) DEFAULT NULL, finess_number VARCHAR(255) DEFAULT NULL, cps_number VARCHAR(255) DEFAULT NULL, created_date DATETIME NOT NULL, import_id VARCHAR(20) NOT NULL, UNIQUE INDEX UNIQ_52B0862BD9909A29 (id_rpps), INDEX rpps_index (id_rpps), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ccam ADD CONSTRAINT FK_DA3B58BFE54D947 FOREIGN KEY (group_id) REFERENCES ccam_group (id)');
        $this->addSql('ALTER TABLE ccam ADD CONSTRAINT FK_DA3B58B12469DE2 FOREIGN KEY (category_id) REFERENCES ccam_group (id)');
        $this->addSql('ALTER TABLE ccam_group ADD CONSTRAINT FK_1CAEEE9E727ACA70 FOREIGN KEY (parent_id) REFERENCES ccam_group (id)');
        $this->addSql('ALTER TABLE diseases ADD CONSTRAINT FK_F7620647727ACA70 FOREIGN KEY (parent_id) REFERENCES diseases (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE diseases ADD CONSTRAINT FK_F7620647FE54D947 FOREIGN KEY (group_id) REFERENCES diseases_group (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE diseases ADD CONSTRAINT FK_F762064712469DE2 FOREIGN KEY (category_id) REFERENCES diseases_group (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE diseases_group ADD CONSTRAINT FK_5B413DF0727ACA70 FOREIGN KEY (parent_id) REFERENCES diseases_group (id) ON DELETE SET NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ccam DROP FOREIGN KEY FK_DA3B58BFE54D947');
        $this->addSql('ALTER TABLE ccam DROP FOREIGN KEY FK_DA3B58B12469DE2');
        $this->addSql('ALTER TABLE ccam_group DROP FOREIGN KEY FK_1CAEEE9E727ACA70');
        $this->addSql('ALTER TABLE diseases DROP FOREIGN KEY FK_F7620647727ACA70');
        $this->addSql('ALTER TABLE diseases DROP FOREIGN KEY FK_F7620647FE54D947');
        $this->addSql('ALTER TABLE diseases DROP FOREIGN KEY FK_F762064712469DE2');
        $this->addSql('ALTER TABLE diseases_group DROP FOREIGN KEY FK_5B413DF0727ACA70');
        $this->addSql('DROP TABLE allergens');
        $this->addSql('DROP TABLE ccam');
        $this->addSql('DROP TABLE ccam_group');
        $this->addSql('DROP TABLE diseases');
        $this->addSql('DROP TABLE diseases_group');
        $this->addSql('DROP TABLE drugs');
        $this->addSql('DROP TABLE ngap');
        $this->addSql('DROP TABLE rpps');
        $this->addSql('DROP TABLE user');
    }
}
