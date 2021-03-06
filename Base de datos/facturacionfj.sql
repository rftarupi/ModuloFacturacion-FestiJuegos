/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     25/8/2017 19:19:38                           */
/*==============================================================*/


drop table if exists TAB_FAC_CAB_FACTURAS;

drop table if exists TAB_FAC_CLIENTES;

drop table if exists TAB_FAC_DET_FACTURAS;

drop table if exists TAB_FAC_SERVICIOS;

drop table if exists TAB_FAC_TIPO_USU;

drop table if exists TAB_FAC_USUARIOS;

/*==============================================================*/
/* Table: TAB_FAC_CAB_FACTURAS                                  */
/*==============================================================*/
create table TAB_FAC_CAB_FACTURAS
(
   COD_CAB_FACT         char(9) not null,
   COD_CLI              char(9) not null,
   FECHA_CAB_FACT       datetime not null default CURRENT_TIMESTAMP,
   primary key (COD_CAB_FACT)
);

/*==============================================================*/
/* Table: TAB_FAC_CLIENTES                                      */
/*==============================================================*/
create table TAB_FAC_CLIENTES
(
   COD_CLI              char(9) not null,
   CEDULA_CLI           varchar(13) not null,
   NOMBRES_CLI          varchar(50) not null,
   APELLIDOS_CLI        varchar(50) not null,
   FECHA_NAC_CLI        date not null,
   DIRECCION_CLI        varchar(100) not null,
   FONO_CLI             varchar(10),
   E_MAIL_CLI           varchar(50),
   primary key (COD_CLI)
);

/*==============================================================*/
/* Table: TAB_FAC_DET_FACTURAS                                  */
/*==============================================================*/
create table TAB_FAC_DET_FACTURAS
(
   COD_DET_FACT         char(9) not null,
   COD_SERV             char(9) not null,
   COD_CAB_FACT         char(9) not null,
   TIEMPO_DET_FACT      decimal(10,2) not null,
   COSTO_HORA_DET_FACT  decimal(10,2) not null,
   COSTO_TOT_DET_FACT   decimal(10,2) not null,
   primary key (COD_DET_FACT)
);

/*==============================================================*/
/* Table: TAB_FAC_SERVICIOS                                     */
/*==============================================================*/
create table TAB_FAC_SERVICIOS
(
   COD_SERV             char(9) not null,
   NOMBRE_SERV          varchar(50) not null,
   DESCRIPCION_SERV     varchar(100),
   COSTO_SERV           decimal(10,2) not null,
   primary key (COD_SERV)
);

/*==============================================================*/
/* Table: TAB_FAC_TIPO_USU                                      */
/*==============================================================*/
create table TAB_FAC_TIPO_USU
(
   COD_TIPO_USU         char(9) not null,
   DESCRIPCION_TIPO_USU varchar(13) not null,
   primary key (COD_TIPO_USU)
);

/*==============================================================*/
/* Table: TAB_FAC_USUARIOS                                      */
/*==============================================================*/
create table TAB_FAC_USUARIOS
(
   COD_USU              char(9) not null,
   COD_TIPO_USU         char(9) not null,
   CEDULA_USU           varchar(13) not null,
   NOMBRES_USU          varchar(50) not null,
   APELLIDOS_USU        varchar(50) not null,
   FECHA_NAC_USU        date not null,
   DIRECCION_USU        varchar(100) not null,
   FONO_USU             varchar(10) not null,
   E_MAIL_USU           varchar(50) not null,
   ESTADO_USU           varchar(1) not null default 'A',
   CLAVE_USU            varchar(50) not null,
   primary key (COD_USU)
);

ALTER TABLE `tab_fac_usuarios`
  ADD UNIQUE KEY `unique_usu` (`CEDULA_USU`) USING BTREE;

alter table TAB_FAC_CAB_FACTURAS add constraint FK_REFERENCE_2 foreign key (COD_CLI)
      references TAB_FAC_CLIENTES (COD_CLI) on delete restrict on update restrict;

alter table TAB_FAC_DET_FACTURAS add constraint FK_REFERENCE_3 foreign key (COD_SERV)
      references TAB_FAC_SERVICIOS (COD_SERV) on delete restrict on update restrict;

alter table TAB_FAC_DET_FACTURAS add constraint FK_REFERENCE_4 foreign key (COD_CAB_FACT)
      references TAB_FAC_CAB_FACTURAS (COD_CAB_FACT) on delete restrict on update restrict;

alter table TAB_FAC_USUARIOS add constraint FK_REFERENCE_1 foreign key (COD_TIPO_USU)
      references TAB_FAC_TIPO_USU (COD_TIPO_USU) on delete restrict on update restrict;

-- Datos

INSERT INTO `tab_fac_tipo_usu` (`COD_TIPO_USU`, `DESCRIPCION_TIPO_USU`) VALUES
('TUSU-0001', 'Administrador'),
('TUSU-0002', 'Cajero');

INSERT INTO `tab_fac_usuarios` (`COD_USU`, `COD_TIPO_USU`, `CEDULA_USU`, `NOMBRES_USU`, `APELLIDOS_USU`, `FECHA_NAC_USU`, `DIRECCION_USU`, `FONO_USU`, `E_MAIL_USU`, `ESTADO_USU`, `CLAVE_USU`) VALUES
('USUA-0001', 'TUSU-0001', '0401734041', 'Richard Fernando', 'Tarupí Calán', '1993-10-29', 'Barrio San Francisco', '0984905901', 'rick030gp@hotmail.com', 'A', '12345678'),
('USUA-0002', 'TUSU-0001', '1003292826', 'Emerson Gabriel', 'Haro Flores', '1996-10-10', 'Barrio San Francisco', '0987876546', 'emerson.f@h.com', 'A', 'emerson.gabriel'),
('USUA-0003', 'TUSU-0002', '1003457049', 'Aguas Chesa', 'Maria del Rocío', '1997-04-05', 'Ibarra Barrio Los Olivos', '0984563347', 'mari_roc@hotmail.com', 'A', 'maria.rocio'),
('USUA-0004', 'TUSU-0002', '1002754669', 'Almeida Suárez', 'Estefano Israel', '1992-11-12', 'Ibarra Barrio Los Olivos', '0944838857', 'estefano_is@gmail.com', 'A', 'estefano.israel');

