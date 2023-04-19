DROP TABLE IF EXISTS reservacion;
DROP TABLE IF EXISTS factura;
DROP TABLE IF EXISTS reserva;
DROP TABLE IF EXISTS usuario;

create table reserva(
id_reserva serial,
tipo varchar(100),
descripcion varchar(200),
precioxhora real,
estado varchar(1),

constraint pk_reserva primary key (id_reserva)

);

create table usuario(
id_usuario serial,
nombre varchar(100),
apellido varchar(100),
correo varchar(100) unique,
clave varchar(100),
roles json,
estado varchar(1),
constraint pk_usuario primary key (id_usuario)
);

create table reservacion(
id_reservacion serial,
id_usuario int,
id_reserva int,
precioextra real,
estado varchar(1),

constraint pk_reservacion primary key (id_reservacion),

constraint fk_factura_usuario foreign key (id_usuario)
    references usuario(id_usuario),
constraint fk_factura_reserva foreign key (id_reserva)
    references reserva(id_reserva)    
);


create table factura(
id_factura serial,
id_usuario int,
id_reserva int,
total real,
estado varchar(1),

constraint pk_factura primary key (id_factura),

constraint fk_factura_usuario foreign key (id_usuario)
    references usuario(id_usuario),
constraint fk_factura_reservacion foreign key (id_reservacion)
    references reservacion(id_reservacion)    
);


INSERT INTO usuario(
nombre, apellido, correo, clave, roles, estado)
VALUES
(
'Josthin', 'Ayon', 'oswayon9@hotmail.com',
'$2y$13$yE9EI8TQZ04C9HWWmcpWOuLQbm8l/zAHa2SKr.EpkyQLhengUBMuS',
'["ROLE_ADMIN"]', 'A' 
);
