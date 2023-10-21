
 create database farmapp;
 use farmapp;
 show tables;
 create table usuario(
 id_usuario int auto_increment,
 nombre_usuario varchar(45),
 password varchar(45),
 privilegio varchar(45),
 primary key(id_usuario)
 )ENGINE=InnoDB;
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
 )ENGINE=InnoDB;
select *from regente;
drop table regente;

    show tables;
    
  drop table farmacia;
  describe farmacia;
  select *from farmacia;
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
  delivery varchar(2) not null,
  imagen_farm varchar(100),
  regente_id_regente int not null,
  PRIMARY KEY (id_farmacia),
   CONSTRAINT fk_regente_farmacia
    FOREIGN KEY (regente_id_regente)
    REFERENCES regente(id_regente)
  )ENGINE=InnoDB;
  
  drop table farmacia;
  drop table farmaco;
  
  
select count(nombre) from farmacia;

select latitud,longitud from farmacia;
  
drop table farmacia;
select *from farmacia;
show tables;

select *from farmaco;

drop table farmaco;

select *from imagenes;
drop table imagenes;
drop table farmaco;
drop table ventas;
drop table compras;

create table farmaco(
id_farmaco int auto_increment,
nombre_medico varchar(45),
nombre_comercial VARCHAR(45) NOT NULL,
laboratorio VARCHAR(45) NOT NULL,
estado VARCHAR(45) ,
  peso VARCHAR(45) ,
  volumen VARCHAR(45) ,
  fecha_de_vencimiento VARCHAR(45) ,
  tipo VARCHAR(45) ,
  cantidad int,
  precio int not null,
  aplicacion varchar(45) not null,
  precauciones varchar(250) not null,
  reacciones varchar(250) not null,
  interacciones varchar(250) not null,
imagen varchar(45),
farmacia_id_farmacia INT NOT NULL,
primary key(id_farmaco),
 CONSTRAINT fk_farmaco_farmacia1
    FOREIGN KEY (farmacia_id_farmacia)
    REFERENCES farmacia (id_farmacia)
)ENGINE=InnoDB;

drop table farmaco;

select *from farmaco;
select *from farmacia;

select *from compras;

select *from farmaco;
select *from imagenes;
drop table imagenes;
describe compras;

precio,delivery,reacciones(reacciones adversas), modoaplicacion,interacciones,
use farmapp;
drop table compras;
 create table compras(
 id_compras int auto_increment,
 farmaco_id_farmaco int,
 nombre_y_apellido_comprador varchar(250),
 cantidad_compra varchar(45),
 telefono_comprador varchar(12),
 direccion_entrega varchar(45),
 costo float,
 fecha_solicitud date,
 hora_solicitud time,
 imagen varchar(45),
 primary key(id_compras),
     FOREIGN KEY (farmaco_id_farmaco)
    REFERENCES farmaco (id_farmaco)
 )ENGINE=InnoDB;
 select *from farmacia;
 select *from farmaco;
 select *from ventas;
 select sum(monto_venta) from ventas;
  create table ventas(
 id_venta int auto_increment,
 farmaco_id_farmaco int,
 nombre_y_apellido_comprador varchar(250),
 cantidad_vendida varchar(45),
 telefono_comprador varchar(12),
 monto_venta float,
 direccion_entrega varchar(45),
 fecha_solicitud date,
 hora_solicitud time,
 imagen varchar(45),
 primary key(id_venta),
     FOREIGN KEY (farmaco_id_farmaco)
    REFERENCES farmaco (id_farmaco)
 )ENGINE=InnoDB;
 
 
 
 use farmapp;
 drop table compras;
 select *from usuario;
 select *from farmaco inner join farmacia ;
show tables; 
 SELECT *FROM farmaco inner join farmacia on (farmacia_id_farmacia = id_farmacia) where nombre_medico like"%ace%";
 describe compras;
 select *from compras;
delimiter//
create trigger confirmacompra before delete
on compras for each row

insert into ventas (farmaco_id_farmaco,nombre_y_apellido_comprador,cantidad_vendida,telefono_comprador,monto_venta,fecha_solicitud,hora_solicitud,imagen) values (old.farmaco_id_farmaco,old.nombre_y_apellido_comprador,old.cantidad_compra,old.telefono_comprador,old.costo,old.fecha_solicitud,old.hora_solicitud,old.imagen);
select *from compras;
select *from ventas;

create table evento(
  id_evento int not null auto_increment,
  actividad varchar (100) not null,
  direccion Varchar (100) not null,
  fecha varchar(25) not null,
  hora time not null,
  encargado varchar (70) not null,
  imagen_invit varchar(45),
  farmacia_id_farmacia int not null,
  primary key(id_evento),
  constraint fk_evento_farmacia
  foreign key(farmacia_id_farmacia)
  references farmacia(id_farmacia)
  )ENGINE=InnoDB;


delimiter ;
drop trigger confirmacompra;
select *from compras;
select *from ventas;
describe farmaco;
drop table compras;
delete from compras where id_compras=1;
select *from usuario;
select distinct laboratorio from farmaco;

select *from farmaco where nombre_comercial="acetominofen" and laboratorio="prueba" and estado="Solido";
select *from farmacia;

select *from regente;
show tables database farmApp;
use farmapp;
select distinct delivery from farmaco;
select *from farmaco;
show tables;
select *from farmaco ;
select *from compras;
select *from farmaco where nombre_comercial="Acetominofen" and laboratorio="Bayern" and estado="Solido" and delivery="si";