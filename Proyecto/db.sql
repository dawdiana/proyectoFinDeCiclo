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
    fk_idRestaurante int not null,
    nombre varchar (30) not null,
    apellido1 varchar (40) not null,
    apellido2 varchar (40),
    correoE varchar(50),
    FOREIGN KEY (fk_idRestaurante) REFERENCES restaurante(idRestaurante)
);

create table plato(
    idPlato int not null auto_increment primary key,
    fk_idRestaurante int not null,
    nombre varchar (70) not null,
    precio decimal (4,2) not null,
    descripcion varchar (200) not null,
    imagen varchar(40),
    tipo varchar(40) not null,
    FOREIGN KEY (fk_idRestaurante) REFERENCES restaurante(idRestaurante)
);

CREATE TABLE pedido (
    idPedido INT PRIMARY KEY AUTO_INCREMENT,
    fk_idCliente int not null,
    fechaPedido datetime not null,
    estadoPedido varchar(50) not null DEFAULT 'Pendiente',
    precioPedido decimal(4,2) not null,
    tipoEntrega varchar(30) not null,
    direccion varchar (100) null,
    codPostal int null default null, -- en caso de que el pedido sea a domicilio
    poblacion varchar (100) null,
    FOREIGN KEY (fk_idCliente) REFERENCES cliente(idCliente)
);

CREATE TABLE lineaPedido (
    idLineaPedido INT PRIMARY KEY AUTO_INCREMENT,
    fk_idPedido INT not null,
    cantidad INT not null,
    nombrePlato varchar (70) not null, -- Se repiten los datos por si hay futuros cambios en los precios o nombres de los productos--
    descripcionPlato varchar (200) not null,
    precioUnidad decimal(4,2) not null,
    FOREIGN KEY (fk_idPedido) REFERENCES pedido(idPedido)
);


/* --------------------------- Inserciones -------------  */


/* Tabla restaurante */
/*(ID del Restaurante, Dirección, Nombre del Restaurante, Usuario, Contraseña)*/
insert into restaurante values (1,'Calle del Marqués de Amboage, 25, 15006 A Coruña, España', 'Pups Pantry', 'pyp', 'abc123.');


/* Tabla cliente */
/*(ID del Cliente, Nombre, Apellido1, Apellido2, Correo Electrónico)*/
insert into cliente values (1, 1, 'María', 'García', 'López', 'maria28309@gmail.com');
insert into cliente values (2, 1, 'Pedro', 'Martínez', 'Fernández', 'pedromartifer@gmail.com');
insert into cliente values (3, 1, 'Ana', 'López', 'Pérez', 'analopi@gmail.com');
insert into cliente values (4, 1, 'Javier', 'Rodríguez', 'Sánchez', 'javirodchez@gmail.com');

/* Tabla plato */
/*(ID del Plato, Nombre, Precio, Descripción, Imagen, Tipo)*/
insert into plato values (1, 1, 'Menú de Salmón', 11.99, 'Delicioso menú casero para perros que incluye salmón fresco, arroz integral y zanahorias al vapor.', 'salmon.jpg','menu');
insert into plato values (2, 1, 'Menú de Pollo', 9.99, 'Sabroso menú casero para perros que incluye pechuga de pollo a la parrilla y batatas asadas.', 'polloPerros2.jpg','menu');
insert into plato values (3, 1, 'Menú de Buey', 12.99, 'Exquisito menú casero para perros que incluye jugosa carne de buey a la brasa y puré de batatas.','buey.png','menu');
insert into plato values (4, 1, 'Menú de Pavo', 11.99, 'Delicioso menú casero para perros que incluye pechuga de pavo a la plancha y arroz integral.','pavo2.jpg','menu');
insert into plato values (5, 1, 'Cuellos y patitas de pollo', 2.99, 'Deliciosos cuellos y patitas de pollo cocidos al horno, ideales como snack para perros.', 'patasPollo2.jpg','snack');
INSERT INTO plato VALUES (6, 1,  'Snack de buey', 3.99, 'Delicioso snack de buey deshidratado, ideal como premio o refrigerio para perros.', 'snackBuey.jpg','snack');
INSERT INTO plato VALUES (7, 1, 'Heladitos caseros sin azúcares', 2.99, 'Delicioso helado casero para perros hecho con plátanos maduros, yogur natural sin azúcar y bayas frescas.', 'heladitosCaseros.jpg','postre');

/* Tabla pedido */
/* (ID del Pedido, ID del Cliente, Fecha del Pedido, Estado del Pedido, Precio del Pedido, Tipo de Entrega, Dirección, Código Postal, Población)*/
INSERT INTO pedido VALUES (1, 1, '2024-04-25 12:37:00', 'pendiente', 25.98, 'domicilio', 'Calle del Marqués de Amboage, 25', 15006, 'A Coruña, España');
INSERT INTO pedido VALUES (2, 2, '2024-04-26 13:37:00', 'pendiente', 5.98, 'recoger', '','','');
INSERT INTO pedido VALUES (3, 3, '2024-04-27 14:30:00', 'pendiente', 32.96, 'domicilio', 'Avenida de la Marina, 40', 15002, 'A Coruña, España'); 
INSERT INTO pedido VALUES (4, 4, '2024-04-28 15:45:00', 'pendiente', 31.96, 'recoger', '','','');


/* Tabla línea de pedido */
/* (ID de la Línea de Pedido, ID del Pedido, Cantidad, Nombre del Plato, Descripción del plato, Precio Unitario)*/
INSERT INTO LineaPedido VALUES (1, 1, 2, 'Menú de buey', 'Exquisito menú casero para perros que incluye jugosa carne de buey a la brasa y puré de batatas.', 12.99);

INSERT INTO LineaPedido VALUES (2, 2, 1, 'Cuellos y patitas de pollo', 'Deliciosos cuellos y patitas de pollo cocidos al horno, ideales como snack para perros.', 2.99);
INSERT INTO LineaPedido VALUES (3, 2, 1, 'Menú de Salmón', 'Delicioso menú casero para perros que incluye salmón fresco, arroz integral y zanahorias al vapor.', 2.99);

INSERT INTO LineaPedido VALUES (4, 3, 1, 'Menú de Pollo', 'Sabroso menú casero para perros que incluye pechuga de pollo a la parrilla y batatas asadas.', 9.99);
INSERT INTO LineaPedido VALUES (5, 3, 1, 'Heladitos caseros sin azúcares', 'Delicioso helado casero para perros hecho con plátanos maduros, yogur natural sin azúcar y bayas frescas.', 2.99);

INSERT INTO LineaPedido VALUES (6, 3, 2, 'Menú de Pollo', 'Sabroso menú casero para perros que incluye pechuga de pollo a la parrilla y batatas asadas.', 9.99);
INSERT INTO LineaPedido VALUES (7, 4, 1, 'Menú de Pavo', 'Delicioso menú casero para perros que incluye pechuga de pavo a la plancha y arroz integral.', 11.99);

INSERT INTO LineaPedido VALUES (8, 4, 1, 'Snack de buey', 'Delicioso snack de buey deshidratado, ideal como premio o refrigerio para perros.', 3.99);
INSERT INTO LineaPedido VALUES (9, 4, 1, 'Menú de buey', 'Exquisito menú casero para perros que incluye jugosa carne de buey a la brasa y puré de batatas.', 12.99);
INSERT INTO LineaPedido VALUES (10, 4, 1, 'Heladitos caseros sin azúcares', 'Delicioso helado casero para perros hecho con plátanos maduros, yogur natural sin azúcar y bayas frescas.', 2.99);
