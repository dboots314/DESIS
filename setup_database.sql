CREATE DATABASE DESIS;

USE DESIS;

CREATE TABLE candidatos (
  id INT PRIMARY KEY,
  nombre VARCHAR(50)
);

INSERT INTO candidatos (id, nombre)
VALUES
  (1, 'Gabriel Boric'),
  (2, 'Sebastián Sichel'),
  (3, 'Yasna Provoste'),
  (4, 'José Antonio Kast'),
  (5, 'Eduardo Artés'),
  (6, 'Marco Enríquez-Ominami'),
  (7, 'Franco Parisi'),
  (8, 'Roxana Miranda'),
  (9, 'Eduardo Artes');

CREATE TABLE regiones (
  id_region INT PRIMARY KEY,
  nombre_region VARCHAR(50)
);

CREATE TABLE comunas (
  id_comuna INT PRIMARY KEY,
  nombre_comuna VARCHAR(50),
  id_region INT,
  FOREIGN KEY (id_region) REFERENCES regiones(id_region)
);

INSERT INTO regiones (id_region, nombre_region)
VALUES (1, 'Tarapacá'),
       (2, 'Antofagasta'),
       (3, 'Atacama'),
       (4, 'Coquimbo'),
       (5, 'Valparaíso'),
       (6, 'O''Higgins'),
       (7, 'Maule'),
       (8, 'Biobío'),
       (9, 'Araucanía'),
       (10, 'Los Lagos'),
       (11, 'Aysén'),
       (12, 'Magallanes'),
       (13, 'Metropolitana'),
       (14, 'Los Ríos'),
       (15, 'Arica y Parinacota'),
       (16, 'Ñuble');

INSERT INTO comunas (id_comuna, nombre_comuna, id_region)
VALUES (1101, 'Iquique', 1),
       (1107, 'Alto Hospicio', 1),
       (1401, 'Antofagasta', 2),
       (1402, 'Mejillones', 2),
       (2201, 'La Serena', 4),
       (2202, 'Coquimbo', 4),
       (5501, 'Valparaíso', 5),
       (5502, 'Viña del Mar', 5),
       (6201, 'Rancagua', 6),
       (6202, 'Machalí', 6),
       (7401, 'Talca', 7),
       (7402, 'San Clemente', 7),
       (8201, 'Concepción', 8),
       (8202, 'Talcahuano', 8),
       (9201, 'Temuco', 9),
       (9202, 'Padre Las Casas', 9),
       (10301, 'Puerto Montt', 10),
       (10302, 'Puerto Varas', 10),
       (11201, 'Coyhaique', 11),
       (12201, 'Punta Arenas', 12),
       (12202, 'Natales', 12),
       (13101, 'Santiago', 13),
       (13102, 'La Reina', 13),
       (14201, 'Valdivia', 14),
       (14202, 'Los Lagos', 14),
       (15101, 'Arica', 15),
       (15102, 'Putre', 15),
       (16301, 'Chillán', 16),
       (16302, 'Yungay', 16);

CREATE TABLE votaciones (
  id_votacion INT PRIMARY KEY AUTO_INCREMENT,
  nombre VARCHAR(50),
  alias VARCHAR(50),
  rut VARCHAR(15),
  email VARCHAR(50),
  region VARCHAR(50),
  comuna VARCHAR(50),
  candidato VARCHAR(50),
  opcion_web BOOLEAN, 
  opcion_tv BOOLEAN,
  opcion_redes_sociales BOOLEAN,
  opcion_amigo BOOLEAN
);