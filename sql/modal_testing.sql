CREATE TABLE users (
    userid INT AUTO_INCREMENT NOT NULL,
    username VARCHAR(25) NOT NULL,
    userpass TEXT NOT NULL,
    user_created_date DATETIME NOT NULL DEFAULT(CURRENT_TIMESTAMP),
    PRIMARY KEY(userid)
);

INSERT INTO users VALUES
    (1,'testuser1','$2y$10$SLYZoQpDWRlPV86sLX8yCuU.SyhQebHlkCIo2cuqjs6OWDylE6vWG','2023-01-01'),
    (2,'testuser2','$2y$10$YMifdykswbH9sxJ9jknMtOBQFwZRIVIe9cEC.Mo8F7mXWkaIyQYea','2023-01-02'),
    (3,'testuser3','$2y$10$am.C3OzQ6CvHShY97xN2JeLPXm6EcecShe9XZApWefaQqheEqXTzO','2023-01-03'),
    (4,'testuser4','$2y$10$JwrPECvQ0WWlCu0yL.xxAOcOKm9O0Yizq39zqB9FkpV6JyQWiLbP6','2023-01-04'),
    (5,'testuser5','$2y$10$ZkVUhBdYBsaYUw0lawXRaOAd5anCdyRQI4HLkxAn7SVNwCgIUw4Ny','2023-01-05');