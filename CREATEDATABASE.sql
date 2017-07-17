CREATE DATABASE University;

use University;

-- Університети
CREATE TABLE Universities( 
	idUniver int NOT NULL AUTO_INCREMENT,
	nameUniver varchar(64) NOT NULL,
	cityUniver varchar(32),
	siteUniver varchar(64),
	PRIMARY KEY (idUniver)
);

-- Кафедри
CREATE TABLE Chairs ( 
	idChairs int NOT NULL AUTO_INCREMENT,
	nameChairs varchar(64),
	PRIMARY KEY (idChairs),
	FOREIGN KEY (idUniver) REFERENCES Universities(idUniver)
);

-- Студенти
CREATE TABLE Students (
	idStudent int NOT NULL AUTO_INCREMENT,
	firstnameStudent varchar(16) NOT NULL,
	lastNameStudent varchar(16) NOT NULL,
	numberphoneStudent varchar(12),
	PRIMARY KEY (idStudents),
	FOREIGN KEY (idChairs) REFERENCES Chairs(idChairs)
);

-- Викладачі
CREATE TABLE Teacher (
	idTeacher int NOT NULL AUTO_INCREMENT,
	firstnameTeacher varchar(16) NOT NULL,
	lastnameTeacher varchar(16) NOT NULL,
	PRIMARY KEY (idTeacher),
	FOREIGN KEY (idChairs) REFERENCES Chairs(idChairs)
);

-- Для зв'язку багато для багатьох. Один вчитель може мати багато дисциплін. Одну дисципліну можуть викладати багато вчителів.
CREATE TABLE TeacherToDiscipline (
	teacher_id int,
	discipline_id int,
	FOREIGN KEY (idTeacher) REFERENCES Teacher(idTeacher),
	FOREIGN KEY (idDiscipline) REFERENCES Discipline(idDiscipline)
);

-- Дисципліни
CREATE TABLE Discipline (
	idDiscipline int NOT NULL AUTO_INCREMENT,
	nameDiscipline varchar(64) NOT NULL,
	PRIMARY KEY (idDiscipline),
	FOREIGN KEY (idChairs) REFERENCES Chairs(idCharis)
);
