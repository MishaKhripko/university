CREATE DATABASE university; USE university; 
CREATE TABLE universities(idUniver int NOT NULL AUTO_INCREMENT,nameUniver varchar(64) NOT NULL,cityUniver varchar(32),siteUniver varchar(64),PRIMARY KEY (idUniver)); 
CREATE TABLE chairs (idChairs int NOT NULL AUTO_INCREMENT,idUniver int NOT NULL,nameChairs varchar(64),PRIMARY KEY (idChairs),FOREIGN KEY (idUniver) REFERENCES universities(idUniver)); 
CREATE TABLE students (idStudent int NOT NULL AUTO_INCREMENT,idChairs int NOT NULL,firstnameStudent varchar(16) NOT NULL,lastNameStudent varchar(16) NOT NULL,numberphoneStudent varchar(12),PRIMARY KEY (idStudent),FOREIGN KEY (idChairs) REFERENCES chairs(idChairs)); 
CREATE TABLE teacher (idTeacher int NOT NULL AUTO_INCREMENT,idChairs int NOT NULL,firstnameTeacher varchar(16) NOT NULL,lastnameTeacher varchar(16) NOT NULL,PRIMARY KEY (idTeacher),FOREIGN KEY (idChairs) REFERENCES chairs(idChairs)); 
CREATE TABLE discipline (idDiscipline int NOT NULL AUTO_INCREMENT,idChairs int NOT NULL,nameDiscipline varchar(64) NOT NULL,PRIMARY KEY (idDiscipline),FOREIGN KEY (idChairs) REFERENCES chairs(idChairs)); 
CREATE TABLE teacherToDiscipline (idTeacher int NOT NULL,idDiscipline int NOT NULL,FOREIGN KEY (idTeacher) REFERENCES teacher(idTeacher),FOREIGN KEY (idDiscipline) REFERENCES discipline(idDiscipline),UNIQUE (idTeacher, idDiscipline));
