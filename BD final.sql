 drop database farmapp;
 create database farmapp;
 use farmapp;
 show tables;
 create table usuario(
 id_usuario int auto_increment,
 nombre_usuario varchar(45),
 password varchar(45),
 privilegio varchar(45),
 primary key(id_usuario)
 );
 select *from usuario;

CREATE TABLE regente (
  id_regente INT NOT NULL auto_increment,
  nombres VARCHAR(45) NOT NULL,
  apellidos VARCHAR(45) NOT NULL,
  sexo VARCHAR(45) NULL,
  telefono VARCHAR(45) NOT NULL,
  correo VARCHAR(45) NOT NULL,
  nombre_usuario varchar(45) not null,
  clave VARCHAR(45) NOT NULL,
  PRIMARY KEY (id_regente)
 );
select *from regente;
drop table regente;

    show tables;
    
CREATE TABLE farmacia (
  id_farmacia INT NOT NULL auto_increment,
  nombre varchar (45) not null,
  registro VARCHAR(45) NOT NULL,
  direccion VARCHAR(45) NOT NULL,
  latitud double not null,
  longitud double not null,
  telefono varchar(8) NOT NULL,
  hora_abre time NOT NULL,
  hora_cierre time NOT NULL,
  regente_id_regente int not null,
  PRIMARY KEY (id_farmacia),
   CONSTRAINT fk_regente_farmacia
    FOREIGN KEY (regente_id_regente)
    REFERENCES farmapp.regente(id_regente)
  );
  
select count(nombre) from farmacia;

select latitud,longitud from farmacia;
  
drop table farmacia;
select *from farmacia;
show tables;


CREATE TABLE farmaco (
  id_farmaco INT NOT NULL auto_increment,
  nombre_medico VARCHAR(45) NOT NULL,
  nombre_comercial VARCHAR(45) NOT NULL,
  laboratorio VARCHAR(45) NOT NULL,
  estado VARCHAR(45) NOT NULL,
  peso VARCHAR(45) NOT NULL,
  volumen VARCHAR(45) NOT NULL,
  fecha_de_vencimiento VARCHAR(45) NOT NULL,
  tipo VARCHAR(45) NOT NULL,
  precio int not null,
  aplicacion varchar(45) not null,
  delivery varchar(10) not null,
  precauciones varchar(250) not null,
  reacciones varchar(250) not null,
  interacciones varchar(250) not null,
  farmacia_id_farmacia INT NOT NULL,
  PRIMARY KEY (id_farmaco),
  CONSTRAINT fk_farmaco_farmacia1
    FOREIGN KEY (farmacia_id_farmacia)
    REFERENCES mydb.farmacia (id_farmacia)
);

select *from farmaco;
drop table farmaco


precio,delivery,reacciones(reacciones adversas), modoaplicacion,interacciones,


