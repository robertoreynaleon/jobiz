CREATE TABLE IF NOT EXISTS category (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS job (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    description TEXT NOT NULL,
    salary DECIMAL(10, 2) DEFAULT NULL,
    country_id INT UNSIGNED DEFAULT NULL,
    company_id INT UNSIGNED DEFAULT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO category (name) VALUES
    ('Developpement web'),
    ('Design'),
    ('Marketing'),
    ('Data')
ON DUPLICATE KEY UPDATE name = VALUES(name);

INSERT INTO job (title, description, salary, created_at) VALUES
    ('Developpeur PHP junior', 'Participation au developpement et a la maintenance de sites web en PHP POO avec MySQL.', 32000.00, NOW()),
    ('Integrateur HTML CSS', 'Integration de maquettes responsives en HTML et CSS pour une plateforme de recrutement.', 28000.00, NOW()),
    ('Developpeur fullstack', 'Creation de fonctionnalites front et back pour une application de recherche d emploi.', 42000.00, NOW())
ON DUPLICATE KEY UPDATE title = VALUES(title);
