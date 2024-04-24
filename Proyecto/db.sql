DROP DATABASE IF EXISTS proyectoPFC;
create database proyectoPFC;
use proyectoPFC;

create table restaurante(
    idRestaurante int not null primary key,
    direccion varchar (100) not null,
    nombreRestaurante varchar (50) not null,
    usuario varchar (50) not null,
    contrasena varchar(100) not null
);

create table cliente(
    idCliente int not null auto_increment primary key,
    nombre varchar (30) not null,
    apellido1 varchar (40) not null,
    apellido2 varchar (40),
    direccion varchar (100) not null
);

create table plato(
    idPlato int not null auto_increment primary key,
    nombre varchar (70) not null,
    precio decimal (4,2) not null,
    descripcion varchar (200) not null,
    imagen varchar(40) not null,
    tipo varchar(40) not null
);

CREATE TABLE pedido (
    idPedido INT PRIMARY KEY AUTO_INCREMENT,
    fk_idCliente int not null,
    fk_idPlato int not null,
    fechaPedido datetime not null,
    estadoPedido varchar(50),
    precioPedido decimal(4,2),
    tipoEntrega varchar(30),
    FOREIGN KEY (fk_idCliente) REFERENCES cliente(idCliente), 
    FOREIGN KEY (fk_idPlato) REFERENCES plato(idPlato)
);

CREATE TABLE LineaPedido (
    idLineaPedido INT PRIMARY KEY AUTO_INCREMENT,
    fk_idPedido INT not null,
    fk_idPlato INT not null,
    cantidad INT not null,
    nombrePdto varchar (70) not null, -- Se repiten los datos por si hay futuros cambios en los precios o nombres de los productos--
    precioUnidad int not null,
    FOREIGN KEY (fk_idPedido) REFERENCES pedido(idPedido),
    FOREIGN KEY (fk_idPlato) REFERENCES plato(idPlato)
);


/* --------------------------- Inserciones -------------  */


/* Tabla restaurante */
insert into restaurante values (1,'Calle del Marqués de Amboage, 25, 15006 A Coruña, España', 'Pups Pantry', 'pupspan', 'abc123.');


/* Tabla cliente */
insert into cliente values (1, 'María', 'García', 'López', 'Calle del Marqués de Amboage, 25, 15006 A Coruña, España');
insert into cliente values (2,'Pedro', 'Martínez', 'Fernández', 'Calle Real, 12, 15001 A Coruña, España');
insert into cliente values (3,'Ana', 'López', 'Pérez', 'Avenida de la Marina, 40, 15002 A Coruña, España');
insert into cliente values (4,'Javier', 'Rodríguez', 'Sánchez', 'Rua San Andrés, 8, 15003 A Coruña, España');

/* Tabla plato */
insert into plato values (1,'Menú de Salmón', 11.99, 'Delicioso menú casero para perros que incluye salmón fresco, arroz integral y zanahorias al vapor.', 'salmon.jpg','menu');
insert into plato values (2,'Menú de Pollo', 9.99, 'Sabroso menú casero para perros que incluye pechuga de pollo a la parrilla y batatas asadas.', 'polloPerros2.jpg','menu');
insert into plato values (3,'Menú de Buey', 12.99, 'Exquisito menú casero para perros que incluye jugosa carne de buey a la brasa y puré de batatas.','buey.png','menu');
insert into plato values (4,'Menú de Pavo', 11.99, 'Delicioso menú casero para perros que incluye pechuga de pavo a la plancha y arroz integral.','pavo2.jpg','menu');
insert into plato values (5,'Cuellos y patitas de pollo', 2.99, 'Deliciosos cuellos y patitas de pollo cocidos al horno, ideales como snack para perros.', 'patasPollo2.jpg','snack');
INSERT INTO plato VALUES (6, 'Snack de buey', 3.99, 'Delicioso snack de buey deshidratado, ideal como premio o refrigerio para perros.', 'snackBuey.jpg','snack');
INSERT INTO plato VALUES (7,'Heladitos caseros sin azúcares', 2.99, 'Delicioso helado casero para perros hecho con plátanos maduros, yogur natural sin azúcar y bayas frescas.', 'heladitosCaseros.jpg','postre');

/* Tabla pedido */
INSERT INTO pedido VALUES (1, 1, 1, 2, '2024-04-25', 'pendiente', 25.98, 'domicilio');
INSERT INTO pedido VALUES (2, 2, 3, 1, '2024-04-26', 'pendiente', 14.99, 'recoger');
INSERT INTO pedido VALUES (3, 3, 2, 2, '2024-04-27 14:30:00', 'pendiente', 21.98, 'domicilio'); 
INSERT INTO pedido VALUES (4, 4, 4, 1, '2024-04-28 13:45:00', 'pendiente', 11.99, 'recoger');


/* Tabla línea de pedido */

-- Línea de pedido para el pedido con ID 2, que incluye una unidad del plato con ID 1
INSERT INTO LineaPedido VALUES (1, 2, 1, 1);

-- Línea de pedido para el pedido con ID 2, que incluye una unidad del plato con ID 3
INSERT INTO LineaPedido VALUES (2, 2, 3, 1);

-- Línea de pedido para el pedido con ID 2, que incluye una unidad del plato con ID 4
INSERT INTO LineaPedido VALUES (3, 2, 4, 1);

INSERT INTO LineaPedido VALUES (4, 3, 2, 2);
INSERT INTO LineaPedido VALUES (5, 4, 4, 1);

/* los pedidos pueden tener una serie de estados, cuando un pedido es entregado, se elimina de la tabla de pedidos y va a otra
tabla de pedidos terminados?*/

/* añadir tipo comida */