CREATE DATABASE cursos;
USE cursos;

CREATE TABLE categoria
(
	idcategoria	        INT AUTO_INCREMENT PRIMARY KEY,
    categoria 			VARCHAR(40) 	NOT NULL
)ENGINE = INNODB;

CREATE TABLE cursos
(
	idcursos 		    INT AUTO_INCREMENT PRIMARY KEY,
    titulo 			    VARCHAR(40)         NOT NULL,
    duracionHoras 		INT                 NOT NULL,
    nivel 		        VARCHAR(30)	        NOT NULL,
    precio              DECIMAL(6,2)        NOT NULL,
    fechaInicio         DATE,
    idcategoria         INT,
    
    
CONSTRAINT fk_idcategoria FOREIGN KEY (idcategoria) REFERENCES categoria (idcategoria)
)ENGINE = INNODB;

INSERT INTO categoria (categoria) VALUES
	('Matemáticas'),
    ('Literatura'),
    ('Informática');
    
    


    select * from cursos;
    

INSERT INTO cursos (idcursos, titulo, duracionHoras, nivel,precio ,fechainicio, idcategoria) VALUES
	(1, 'Curso basico de Matempatica', '5', "Basico",23.4,2-3-2025,1),
	(2, 'Curso Intermedi de Literatura', '6', "Intermedio",23.4,2-3-2025,2),
	(3, 'Curso Intermedio de Informática', '6', "Intermedio",23.4,2-3-2025,3);





CREATE VIEW vista_cursos_todos
AS
	SELECT
		CS.idcursos,
        CT.categoria,
        CS.titulo,
        CS.duracionHoras,
        CS.nivel,
        CS.precio,
        CS.fechaInicio
    FROM cursos CS
    INNER JOIN categoria CT ON CS.idcategoria = CT.idcategoria
    ORDER BY CS.idcursos;





CREATE VIEW vista_categoria_todos
AS
	SELECT
		CT.idcategoria,
        CT.categoria
    FROM categoria CT
    ORDER BY CT.idcategoria;


DELIMITER //
CREATE PROCEDURE spu_categoria_registrar(
    IN _categoria 			VARCHAR(40)
)
BEGIN
	INSERT INTO categoria (categoria) 
		VALUES
        (_categoria);
END //






----cursos---



DELIMITER //
CREATE PROCEDURE spu_cursos_registrar(
    IN _titulo 			VARCHAR(40),
    IN _duracionHoras 	INT,
    IN _nivel 			VARCHAR(30),
    IN _precio 		    DECIMAL(6,2),
    IN _fechaInicio 	DATE,
	IN _idcategoria 	INT

)
BEGIN
	INSERT INTO cursos ( titulo, duracionHoras, nivel,precio ,fechaInicio, idcategoria) 
		VALUES
        (_titulo, _duracionHoras, _nivel,_precio ,_fechaInicio, _idcategoria);
END //



DELIMITER //
CREATE TRIGGER cursos_actualizar_fecha_modificacion
BEFORE UPDATE ON cursos
FOR EACH ROW
BEGIN
	SET NEW.modificado = NOW();
END //


