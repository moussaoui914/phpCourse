create database cours;

---------------------------------

create table Course(
	id int primary key AUTO_INCREMENT ,
	title varchar(50),
	description text,
	level varchar(50)CHECK (level IN ('Delivered', 'Cancelled', 'Under Process')),
	created_at DATETIME,
	image varchar(50);
)

---------------------------------------
create table sections(
	id int primary key AUTO_INCREMENT ,
	course_id int,
    FOREIGN KEY (course_id) REFERENCES course(id),
	title varchar(50),
	content text,
    position int,
    created_at datetime
)
---------------------------------------

INSERT INTO Course (title, description, level, created_at) 
VALUES 
('Introduction à SQL', 'Cours sur les bases de SQL', 'Delivered', NOW()),
('Algorithmes avancés', 'Cours sur les structures de données', 'Under Process', NOW()),
('Web Development', 'Cours de développement web fullstack', 'Delivered', NOW());


INSERT INTO sections (course_id, title, content, position, created_at) 
VALUES 
(1, 'Introduction', 'Contenu introductif à SQL', 1, NOW()),
(1, 'Requêtes SELECT', 'Apprendre à sélectionner des données', 2, NOW()),
(1, 'Jointures', 'Comprendre les jointures SQL', 3, NOW()),
(2, 'Complexité', 'Analyse de complexité algorithmique', 1, NOW()),
(2, 'Arbres binaires', 'Structures arborescentes', 2, NOW()),
(3, 'HTML/CSS', 'Bases du frontend', 1, NOW()),
(3, 'JavaScript', 'Langage de programmation frontend', 2, NOW());

-------------------------------------------------

