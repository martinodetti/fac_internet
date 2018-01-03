/*
SQLyog Ultimate v9.02 
MySQL - 5.1.41-log : Database - marti048_factura
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`marti048_factura` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `marti048_factura`;

/*Table structure for table `acceso_modulo` */

DROP TABLE IF EXISTS `acceso_modulo`;

CREATE TABLE `acceso_modulo` (
  `id_acsmod` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_persona` bigint(20) DEFAULT NULL,
  `id_modulo` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id_acsmod`),
  KEY `FK_acceso_modulo` (`id_persona`),
  KEY `FK_acceso_modulo_MOD` (`id_modulo`),
  CONSTRAINT `FK_acceso_modulo` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`),
  CONSTRAINT `FK_acceso_modulo_MOD` FOREIGN KEY (`id_modulo`) REFERENCES `modulo` (`id_modulo`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=latin1;

/*Data for the table `acceso_modulo` */

insert  into `acceso_modulo`(`id_acsmod`,`id_persona`,`id_modulo`) values (9,1,1),(10,1,18),(11,1,19),(12,1,20),(13,1,21),(14,1,22),(15,1,23),(16,1,24),(17,1,33),(18,1,34),(19,1,35),(20,1,36),(21,1,37),(22,1,38),(23,1,39),(24,1,40),(25,1,41),(26,1,42),(27,1,43),(30,1,44),(33,1,45),(34,1,46),(35,1,47),(36,1,48),(51,1,49),(52,1,50),(54,21,1),(55,21,18),(56,21,19),(57,21,20),(59,21,22),(60,21,23),(61,21,24),(63,21,34),(64,21,35),(65,21,36),(72,21,43),(75,21,46),(76,21,47),(77,21,48),(78,21,49),(79,21,50);

/*Table structure for table `ciudad` */

DROP TABLE IF EXISTS `ciudad`;

CREATE TABLE `ciudad` (
  `id_ciudad` bigint(20) NOT NULL AUTO_INCREMENT,
  `nom_ciudad` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_ciudad`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `ciudad` */

insert  into `ciudad`(`id_ciudad`,`nom_ciudad`) values (1,'CIUDAD'),(2,'GUAYMALLEN'),(3,'GODOY CRUZ'),(4,'LAS HERAS'),(5,'MAIPU'),(6,'LUJAN DE CUYO'),(7,'SAN MARTIN'),(8,'TUNUYAN');

/*Table structure for table `cliente_pago` */

DROP TABLE IF EXISTS `cliente_pago`;

CREATE TABLE `cliente_pago` (
  `id_pago` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_persona` bigint(20) DEFAULT NULL,
  `id_factura` bigint(20) DEFAULT NULL,
  `canti_pago` decimal(10,2) DEFAULT NULL,
  `fecha_pago` date DEFAULT NULL,
  `estado_pago` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id_pago`),
  KEY `FK_cliente_pago_persona` (`id_persona`),
  CONSTRAINT `FK_cliente_pago_persona` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

/*Data for the table `cliente_pago` */

insert  into `cliente_pago`(`id_pago`,`id_persona`,`id_factura`,`canti_pago`,`fecha_pago`,`estado_pago`) values (1,25,1,'40.95','2013-04-01','1'),(2,25,0,'0.00','2013-05-01','0'),(3,19,0,'48.91','0000-00-00','1'),(4,19,0,'0.00',NULL,'0'),(5,19,0,'48.91','0000-00-00','1'),(6,19,0,'0.00',NULL,'0'),(7,18,2,'40.25','0000-00-00','1'),(8,25,3,'67.41','0000-00-00','1'),(9,25,0,'0.00',NULL,'0'),(10,25,4,'78.68','0000-00-00','1'),(11,25,0,'0.00',NULL,'0'),(12,19,5,'28.75','0000-00-00','1'),(13,19,6,'67.55','0000-00-00','1'),(14,19,0,'0.00',NULL,'0'),(15,18,7,'28.75','0000-00-00','1'),(16,18,0,'0.00',NULL,'0'),(17,18,8,'51.75','0000-00-00','1'),(18,18,0,'0.00',NULL,'0'),(19,18,9,'51.75','0000-00-00','1'),(20,18,0,'0.00',NULL,'0'),(21,18,10,'51.75','0000-00-00','1'),(22,18,0,'0.00',NULL,'0'),(23,18,11,'51.75','0000-00-00','1'),(24,18,0,'0.00',NULL,'0'),(25,25,12,'198.35','0000-00-00','1'),(26,25,0,'0.00',NULL,'0'),(27,25,13,'0.98','0000-00-00','1'),(28,25,0,'0.00',NULL,'0');

/*Table structure for table `compra` */

DROP TABLE IF EXISTS `compra`;

CREATE TABLE `compra` (
  `id_compra` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_provd` bigint(20) DEFAULT NULL,
  `guiacod_compra` varchar(20) DEFAULT NULL,
  `total_compra` double(10,2) DEFAULT NULL,
  `obs_compra` text,
  `baseGrava_compra` double(10,2) DEFAULT NULL,
  `fec_compra` date DEFAULT NULL,
  `estado_compra` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id_compra`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `compra` */

insert  into `compra`(`id_compra`,`id_provd`,`guiacod_compra`,`total_compra`,`obs_compra`,`baseGrava_compra`,`fec_compra`,`estado_compra`) values (2,3,'23',403.20,'Mercadería adquirida con cheque',43.20,'0000-00-00','1'),(3,22,'11',42.00,'segundo ingreso de mercaderia',4.50,'0000-00-00','1'),(4,22,'89',73.36,'tercer ingreso de mercaderia',7.86,'0000-00-00','1'),(5,22,'88',224.00,'productos 2',24.00,'0000-00-00','1'),(6,22,'122',336.00,'mas productos 2',36.00,'0000-00-00','1');

/*Table structure for table `descuento_venta` */

DROP TABLE IF EXISTS `descuento_venta`;

CREATE TABLE `descuento_venta` (
  `id_descto` bigint(20) NOT NULL AUTO_INCREMENT,
  `porctj_descto` double(10,2) DEFAULT NULL,
  PRIMARY KEY (`id_descto`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `descuento_venta` */

insert  into `descuento_venta`(`id_descto`,`porctj_descto`) values (1,0.00),(2,0.10),(3,1.00),(4,2.00),(5,3.00);

/*Table structure for table `detalle_cliente` */

DROP TABLE IF EXISTS `detalle_cliente`;

CREATE TABLE `detalle_cliente` (
  `id_detcliente` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_cliente` bigint(20) DEFAULT NULL,
  `id_trabajador` bigint(20) DEFAULT NULL,
  `id_tipoconex` bigint(20) DEFAULT NULL,
  `ip_detcliente` varchar(25) DEFAULT NULL,
  `hora_detcliente` time DEFAULT NULL,
  `fecha_detcliente` date DEFAULT NULL,
  `estado_conex` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id_detcliente`),
  KEY `FK_detalle_cliente` (`id_cliente`),
  KEY `FK_detalle_cliente_tipoconexion` (`id_tipoconex`),
  CONSTRAINT `FK_detalle_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `persona` (`id_persona`) ON DELETE CASCADE,
  CONSTRAINT `FK_detalle_cliente_tipoconexion` FOREIGN KEY (`id_tipoconex`) REFERENCES `tipo_conexion` (`id_tipoconex`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `detalle_cliente` */

/*Table structure for table `detalle_compra` */

DROP TABLE IF EXISTS `detalle_compra`;

CREATE TABLE `detalle_compra` (
  `id_detcompra` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_compra` bigint(20) DEFAULT NULL,
  `id_producto` bigint(20) DEFAULT NULL,
  `costouni_detcompra` double(10,2) DEFAULT NULL,
  `canti_detcompra` int(11) DEFAULT NULL,
  `estado_detcompra` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id_detcompra`),
  KEY `FK_detalle_compra` (`id_compra`),
  KEY `FK_detalle_compra_producto` (`id_producto`),
  CONSTRAINT `FK_detalle_compra` FOREIGN KEY (`id_compra`) REFERENCES `compra` (`id_compra`),
  CONSTRAINT `FK_detalle_compra_producto` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `detalle_compra` */

insert  into `detalle_compra`(`id_detcompra`,`id_compra`,`id_producto`,`costouni_detcompra`,`canti_detcompra`,`estado_detcompra`) values (1,2,1,12.00,30,'1'),(2,3,1,12.50,3,'1'),(3,4,1,13.10,5,'1'),(4,5,2,20.00,10,'1'),(5,6,2,30.00,10,'1');

/*Table structure for table `detalle_devolucion` */

DROP TABLE IF EXISTS `detalle_devolucion`;

CREATE TABLE `detalle_devolucion` (
  `id_detdevo` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_devo` bigint(20) DEFAULT NULL,
  `id_producto` bigint(20) DEFAULT NULL,
  `canti_detdevo` int(11) DEFAULT NULL,
  `precio_detdevo` double(10,2) DEFAULT NULL,
  `estado_detdevo` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id_detdevo`),
  KEY `FK_detalle_devolucion` (`id_devo`),
  CONSTRAINT `FK_detalle_devolucion` FOREIGN KEY (`id_devo`) REFERENCES `devolucion` (`id_devo`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `detalle_devolucion` */

insert  into `detalle_devolucion`(`id_detdevo`,`id_devo`,`id_producto`,`canti_detdevo`,`precio_detdevo`,`estado_detdevo`) values (2,2,1,5,12.19,'1');

/*Table structure for table `detalle_factura` */

DROP TABLE IF EXISTS `detalle_factura`;

CREATE TABLE `detalle_factura` (
  `id_detfact` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_fact` bigint(20) DEFAULT NULL,
  `id_producto` bigint(20) DEFAULT NULL,
  `canti_detfact` double(10,2) DEFAULT NULL,
  `precio_detfact` double(10,2) DEFAULT NULL,
  `estado_detfact` varchar(2) DEFAULT NULL,
  UNIQUE KEY `id_detfact` (`id_detfact`),
  KEY `FK_detalle_factura` (`id_fact`),
  KEY `FK_detalle_factura_prodcuto` (`id_producto`),
  CONSTRAINT `FK_detalle_factura` FOREIGN KEY (`id_fact`) REFERENCES `factura` (`id_fact`) ON DELETE CASCADE,
  CONSTRAINT `FK_detalle_factura_prodcuto` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

/*Data for the table `detalle_factura` */

insert  into `detalle_factura`(`id_detfact`,`id_fact`,`id_producto`,`canti_detfact`,`precio_detfact`,`estado_detfact`) values (25,1,1,3.00,13.65,'1'),(32,2,3,1.00,11.50,'1'),(33,2,2,1.00,28.75,'1'),(34,3,1,1.00,13.65,'1'),(35,3,2,2.00,28.75,'1'),(36,4,1,1.00,13.65,'1'),(37,4,2,2.00,28.75,'1'),(38,4,3,1.00,11.50,'1'),(39,5,2,1.00,28.75,'1'),(40,6,2,1.00,28.75,'1'),(41,7,2,1.00,28.75,'1'),(42,8,2,1.00,28.75,'1'),(43,9,2,1.00,28.75,'1'),(44,10,2,1.00,28.75,'1'),(45,11,2,1.00,28.75,'1'),(46,12,1,4.00,13.65,'1'),(47,13,19,1.00,1.00,'1');

/*Table structure for table `detalle_gastos` */

DROP TABLE IF EXISTS `detalle_gastos`;

CREATE TABLE `detalle_gastos` (
  `id_detgasto` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_gasto` bigint(20) DEFAULT NULL,
  `nombre_produc` varchar(30) DEFAULT NULL,
  `costouni_detgasto` double(10,2) DEFAULT NULL,
  `canti_detgasto` int(11) DEFAULT NULL,
  `estado_detgasto` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id_detgasto`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `detalle_gastos` */

/*Table structure for table `detalle_kardex` */

DROP TABLE IF EXISTS `detalle_kardex`;

CREATE TABLE `detalle_kardex` (
  `id_detkardex` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_kardex` bigint(20) DEFAULT NULL,
  `id_producto` bigint(20) DEFAULT NULL,
  `costo_detkardex` double(10,2) DEFAULT NULL,
  `canti_detkardex` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_detkardex`),
  KEY `FK_detalle_kardex` (`id_kardex`),
  CONSTRAINT `FK_detalle_kardex` FOREIGN KEY (`id_kardex`) REFERENCES `kardex` (`id_kardex`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

/*Data for the table `detalle_kardex` */

insert  into `detalle_kardex`(`id_detkardex`,`id_kardex`,`id_producto`,`costo_detkardex`,`canti_detkardex`) values (1,1,1,12.00,30),(2,2,1,12.50,3),(3,3,1,13.10,5),(4,4,1,13.65,3),(5,5,2,20.00,10),(6,6,2,30.00,10),(7,7,1,12.19,5),(8,8,2,28.75,1),(9,8,1,13.65,1),(10,8,3,11.50,1),(11,9,2,28.75,1),(12,9,1,13.65,1),(13,9,3,11.50,1),(14,10,3,11.50,1),(15,10,2,28.75,1),(16,11,1,13.65,1),(17,11,2,28.75,2),(18,12,1,13.65,1),(19,12,2,28.75,2),(20,12,3,11.50,1),(21,13,2,28.75,1),(22,14,2,28.75,1),(23,15,2,28.75,1),(24,16,2,28.75,1),(25,17,2,28.75,1),(26,18,2,28.75,1),(27,19,2,28.75,1),(28,20,1,13.65,4),(29,21,19,1.00,1);

/*Table structure for table `detalle_ordenreparacion` */

DROP TABLE IF EXISTS `detalle_ordenreparacion`;

CREATE TABLE `detalle_ordenreparacion` (
  `id_detord` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_orden` bigint(20) DEFAULT NULL,
  `id_producto` bigint(20) DEFAULT NULL,
  `canti_detord` double(10,2) DEFAULT NULL,
  `precio_detord` double(10,2) DEFAULT NULL,
  `estado_detord` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id_detord`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `detalle_ordenreparacion` */

/*Table structure for table `detalle_proveedor` */

DROP TABLE IF EXISTS `detalle_proveedor`;

CREATE TABLE `detalle_proveedor` (
  `id_detprovdr` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_proveedor` bigint(20) DEFAULT NULL,
  `ip1_detprovdr` varchar(25) DEFAULT NULL,
  `ip2_detprovdr` varchar(25) DEFAULT NULL,
  `ip3_detprovdr` varchar(25) DEFAULT NULL,
  `mas1_detprovdr` varchar(25) DEFAULT NULL,
  `mas2_detprovdr` varchar(25) DEFAULT NULL,
  `mas3_detprovdr` varchar(25) DEFAULT NULL,
  `obs_detprovdr` text,
  PRIMARY KEY (`id_detprovdr`),
  KEY `FK_detalle_proveedor` (`id_proveedor`),
  CONSTRAINT `FK_detalle_proveedor` FOREIGN KEY (`id_proveedor`) REFERENCES `persona` (`id_persona`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `detalle_proveedor` */

/*Table structure for table `detalle_remito` */

DROP TABLE IF EXISTS `detalle_remito`;

CREATE TABLE `detalle_remito` (
  `id_detremi` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_remito` bigint(20) unsigned NOT NULL,
  `id_producto` bigint(20) DEFAULT NULL,
  `canti_detremi` double(10,2) DEFAULT NULL,
  `precio_detremi` double(10,2) DEFAULT NULL,
  `estado_detremi` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id_detremi`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Data for the table `detalle_remito` */

insert  into `detalle_remito`(`id_detremi`,`id_remito`,`id_producto`,`canti_detremi`,`precio_detremi`,`estado_detremi`) values (1,1,2,1.00,28.75,'1'),(2,1,1,2.00,13.65,'1'),(3,2,1,4.00,13.65,'1'),(4,2,2,5.00,28.75,'1'),(5,3,2,1.00,28.75,'1'),(6,3,3,1.00,11.50,'1'),(7,4,2,1.00,28.75,'1'),(8,5,2,1.00,28.75,'1'),(9,7,2,1.00,28.75,'1'),(10,8,20,2.00,1.00,'1');

/*Table structure for table `devolucion` */

DROP TABLE IF EXISTS `devolucion`;

CREATE TABLE `devolucion` (
  `id_devo` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_factcmp_devo` bigint(20) DEFAULT NULL,
  `tipo_cmpbt_devo` int(11) DEFAULT NULL COMMENT '1:dev. compra 3:dev. venta',
  `descto_devo` double(10,2) DEFAULT NULL,
  `iva12_devo` double(10,2) DEFAULT NULL,
  `total_devo` double(10,2) DEFAULT NULL,
  `obs_devo` text,
  `fecha_devo` date DEFAULT NULL,
  `estado_devo` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id_devo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `devolucion` */

insert  into `devolucion`(`id_devo`,`id_factcmp_devo`,`tipo_cmpbt_devo`,`descto_devo`,`iva12_devo`,`total_devo`,`obs_devo`,`fecha_devo`,`estado_devo`) values (2,0,1,0.00,7.31,68.26,'devolucion','2013-04-01','1');

/*Table structure for table `empresa` */

DROP TABLE IF EXISTS `empresa`;

CREATE TABLE `empresa` (
  `id_empresa` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_contador` bigint(20) DEFAULT NULL,
  `id_representante` bigint(20) DEFAULT NULL,
  `id_ciudad` bigint(20) DEFAULT NULL,
  `razsocial_empresa` varchar(100) DEFAULT NULL,
  `ruc_empresa` varchar(15) DEFAULT NULL,
  `direc_empresa` text,
  `telf_empresa` varchar(12) DEFAULT NULL,
  `cel_empresa` varchar(10) DEFAULT NULL,
  `web_empresa` varchar(50) DEFAULT NULL,
  `correo_empresa` varchar(50) DEFAULT NULL,
  `fecha_empresa` date DEFAULT NULL,
  PRIMARY KEY (`id_empresa`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `empresa` */

insert  into `empresa`(`id_empresa`,`id_contador`,`id_representante`,`id_ciudad`,`razsocial_empresa`,`ruc_empresa`,`direc_empresa`,`telf_empresa`,`cel_empresa`,`web_empresa`,`correo_empresa`,`fecha_empresa`) values (1,5,6,1,'GATO NET','0909808089034','Calle TU DIRECCION','2950450','295045034','www.gato.com','Gato_net134@hotmail.com','2012-02-12');

/*Table structure for table `estado_civil` */

DROP TABLE IF EXISTS `estado_civil`;

CREATE TABLE `estado_civil` (
  `id_civil` bigint(20) NOT NULL AUTO_INCREMENT,
  `estado_civil` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id_civil`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `estado_civil` */

insert  into `estado_civil`(`id_civil`,`estado_civil`) values (1,'SOLTERO(A)'),(2,'CASADO(A)'),(3,'DIVORCIADO(A)'),(4,'VIUDO(A)');

/*Table structure for table `factura` */

DROP TABLE IF EXISTS `factura`;

CREATE TABLE `factura` (
  `id_fact` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_empresa` bigint(20) DEFAULT NULL,
  `id_cliente` bigint(20) DEFAULT NULL,
  `id_vendedor` bigint(20) DEFAULT NULL,
  `tipo_fact` enum('1','2') DEFAULT '1',
  `num_fact` bigint(20) DEFAULT NULL,
  `descto_fact` double(10,2) DEFAULT NULL,
  `obs_fact` text,
  `iva21_fact` double(10,2) DEFAULT NULL,
  `iva105_fact` double(10,2) DEFAULT NULL,
  `total_fact` double(10,2) DEFAULT NULL,
  `fecemi_fact` date DEFAULT NULL,
  `estado_fact` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id_fact`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `factura` */

insert  into `factura`(`id_fact`,`id_empresa`,`id_cliente`,`id_vendedor`,`tipo_fact`,`num_fact`,`descto_fact`,`obs_fact`,`iva21_fact`,`iva105_fact`,`total_fact`,`fecemi_fact`,`estado_fact`) values (1,1,25,1,'1',0,0.00,'VARIOS',0.00,NULL,40.95,'2013-04-01','1'),(2,1,18,1,'1',0,0.00,'',4.99,1.09,40.25,'2013-04-10','1'),(3,1,25,1,'2',9999999,1.42,'',12.10,0.00,67.41,'2013-04-11','1'),(4,1,25,1,'2',9999999,1.65,'Cuarta factura',12.10,1.07,78.68,'2013-04-11','1'),(5,1,19,1,'2',9923,0.00,'conceptillo',0.00,0.00,28.75,'2013-05-08','1'),(6,1,19,1,'1',0,0.00,'',0.00,0.00,67.55,'2013-05-23','1'),(7,1,18,1,'1',0,0.00,'',4.99,0.00,28.75,'2013-05-23','1'),(8,1,18,1,'1',789,0.00,'',0.00,0.00,51.75,'2013-05-23','1'),(9,1,18,1,'1',789,0.00,'',0.00,0.00,51.75,'2013-05-23','1'),(10,1,18,1,'1',789,0.00,'',0.00,0.00,51.75,'2013-05-23','1'),(11,1,18,1,'1',789,0.00,'',0.00,0.00,51.75,'2013-05-23','1'),(12,1,25,1,'1',0,0.00,'remtito seleccionado',0.00,0.00,198.35,'2013-05-23','1'),(13,1,25,1,'1',12345,0.02,'',0.17,0.00,0.98,'2013-05-24','1');

/*Table structure for table `ganancia` */

DROP TABLE IF EXISTS `ganancia`;

CREATE TABLE `ganancia` (
  `id_ganancia` bigint(20) NOT NULL AUTO_INCREMENT,
  `porctj_ganancia` double(10,2) DEFAULT NULL,
  `descrip_ganancia` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_ganancia`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `ganancia` */

insert  into `ganancia`(`id_ganancia`,`porctj_ganancia`,`descrip_ganancia`) values (1,12.00,'POR LA VENTA DE CADA PRODUCTO'),(2,15.00,'PARA LOS CLIENTES TIPO B'),(4,0.00,'0% PARA LOS PLANES');

/*Table structure for table `gastos` */

DROP TABLE IF EXISTS `gastos`;

CREATE TABLE `gastos` (
  `id_gasto` bigint(20) NOT NULL AUTO_INCREMENT,
  `descrip_gast` varchar(300) DEFAULT NULL,
  `cant_gast` double(10,2) DEFAULT NULL,
  `fecha_gast` date DEFAULT NULL,
  `id_factura` varchar(20) DEFAULT NULL,
  `nom_empresa_gast` varchar(50) DEFAULT NULL,
  `nom_comp_gast` varchar(30) DEFAULT NULL,
  `iva_gast` double(10,2) DEFAULT NULL,
  PRIMARY KEY (`id_gasto`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `gastos` */

/*Table structure for table `kardex` */

DROP TABLE IF EXISTS `kardex`;

CREATE TABLE `kardex` (
  `id_kardex` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_factcmp_kardex` bigint(20) DEFAULT NULL COMMENT 'id factura o compra',
  `tipo_entrdsald_kardex` varchar(2) DEFAULT NULL COMMENT '1: compra 2:devolucion de mi cliente 3:ventas 4: devolucion de mercaderia ',
  `tipo_cmpbt_kardex` varchar(2) DEFAULT NULL COMMENT '1: compra 3: factura',
  `cod_factcmp_kardex` varchar(100) DEFAULT NULL COMMENT 'ejempl:1-2-12-19 ;guarda id de los campos para minimizar la busqueda',
  `fecha_kardex` date DEFAULT NULL,
  `estado_kardex` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id_kardex`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

/*Data for the table `kardex` */

insert  into `kardex`(`id_kardex`,`id_factcmp_kardex`,`tipo_entrdsald_kardex`,`tipo_cmpbt_kardex`,`cod_factcmp_kardex`,`fecha_kardex`,`estado_kardex`) values (1,2,'1','1','','2013-04-01','1'),(2,3,'1','1','','2013-04-01','1'),(3,4,'1','1','','2013-04-01','1'),(4,1,'3','3','','2013-04-01','1'),(5,5,'1','1','','2013-04-01','1'),(6,6,'1','1','','2013-04-01','1'),(7,0,'4','1','','2013-04-01','1'),(8,0,'3','3','2-1-3-','2013-04-10','1'),(9,0,'3','3','2-1-3-','2013-04-10','1'),(10,2,'3','3','3-2-','2013-04-10','1'),(11,3,'3','3','1-2-','2013-04-11','1'),(12,4,'3','3','1-2-3-','2013-04-11','1'),(13,5,'3','3','','2013-05-08','1'),(14,6,'3','3','','2013-05-23','1'),(15,7,'3','3','','2013-05-23','1'),(16,8,'3','3','','2013-05-23','1'),(17,9,'3','3','','2013-05-23','1'),(18,10,'3','3','','2013-05-23','1'),(19,11,'3','3','','2013-05-23','1'),(20,12,'3','3','','2013-05-23','1'),(21,13,'3','3','','2013-05-24','1');

/*Table structure for table `marca_producto` */

DROP TABLE IF EXISTS `marca_producto`;

CREATE TABLE `marca_producto` (
  `id_marca` bigint(20) NOT NULL AUTO_INCREMENT,
  `nom_marca` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_marca`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `marca_producto` */

insert  into `marca_producto`(`id_marca`,`nom_marca`) values (1,'NINGUNA'),(2,'TORNILLOS');

/*Table structure for table `modulo` */

DROP TABLE IF EXISTS `modulo`;

CREATE TABLE `modulo` (
  `id_modulo` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_padre` bigint(20) DEFAULT NULL,
  `nom_modulo` varchar(50) DEFAULT NULL,
  `img_modulo` varchar(50) DEFAULT NULL,
  `url_modulo` varchar(50) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id_modulo`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `modulo` */

insert  into `modulo`(`id_modulo`,`id_padre`,`nom_modulo`,`img_modulo`,`url_modulo`,`activo`) values (1,-1,'INVENTARIO',NULL,NULL,1),(18,1,'CATEGORIA','MARCA.png','marca.php',1),(19,1,'UNIDAD DE MEDIDA','UNIDAD.png','medida.php',1),(20,1,'GANANCIA X PRODUCTO','GANANCIA.png','ganancia.php',1),(21,1,'TIPO DE RETENCIÓN','TIPORETEN.png','tiporeten.php',0),(22,1,'PRODUCTO','PRODUCTO.png','producto.php',1),(23,1,'PROVEEDOR','PROVEEDOR.png','proveedor.php',1),(24,1,'INGRESO DE MERCADERÍA','MERCADERIA.png','mercaderia.php',1),(33,1,'KARDEX','KARDEX.png','kardex.php',0),(34,-2,'FACTURACIÓN',NULL,NULL,1),(35,34,'FACTURA','FACTURA.png','factura.php',1),(36,34,'CLIENTE','CLIENTE.png','cliente.php',1),(37,34,'REPORTE DE VENTAS','REVENTA.png','reptventa.php',1),(38,-3,'EMPRESA Y RRHH',NULL,NULL,1),(39,38,'EMPRESA','EMPRESA.png','empresa.php',0),(40,38,'TRABAJADOR','TRABAJADOR.png','trabajador.php',1),(41,-4,'PERMISOS A USUARIOS',NULL,NULL,1),(42,41,'PERMISO','SEGURIDAD.png','permiso.php',1),(43,34,'DEVOLUCIONES','KARDEX.png','devolucion.php',1),(44,1,'DEVOLUCIÓN DE MERCADERÍA','INVENTARIO.png','devomerca.php',0),(45,34,'PAGOS DE INTERNET','PAGOINTERNET.png','pago.php',0),(46,34,'GASTOS','gasto.png','gastos.php',1),(47,34,'REPORTE FINANCIERO','reporte_financiero.png','reptfinanciero.php',1),(48,34,'REPORTE DE COMPRA','reporte_compra.png','reptcompra.php',1),(49,34,'VEHICULOS','VEHICULO.png','vehiculo.php',1),(50,1,'REMITO','REMITO.png','remito.php',1);

/*Table structure for table `orden_reparacion` */

DROP TABLE IF EXISTS `orden_reparacion`;

CREATE TABLE `orden_reparacion` (
  `id_orden` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_cliente` bigint(20) DEFAULT NULL,
  `id_vehiculo` bigint(20) DEFAULT NULL,
  `num_orden` bigint(20) DEFAULT NULL,
  `fecingreso_orden` date DEFAULT NULL,
  `fecegreso_orden` date DEFAULT NULL,
  `observaciones` text,
  `responsable` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_orden`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `orden_reparacion` */

/*Table structure for table `persona` */

DROP TABLE IF EXISTS `persona`;

CREATE TABLE `persona` (
  `id_persona` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_tipoper` bigint(20) DEFAULT NULL COMMENT 'trabajador , cliente , empleado',
  `id_ciudad` bigint(20) DEFAULT NULL,
  `id_sexo` bigint(20) DEFAULT NULL,
  `id_civil` bigint(20) DEFAULT NULL,
  `nom_persona` varchar(50) DEFAULT NULL,
  `ape_persona` varchar(50) DEFAULT NULL,
  `ruc_persona` varchar(20) DEFAULT NULL,
  `direc_persona` text,
  `telf_persona` varchar(10) DEFAULT NULL,
  `cel_persona` varchar(10) DEFAULT NULL,
  `email_persona` varchar(40) DEFAULT NULL,
  `web_persona` varchar(40) DEFAULT NULL,
  `obs_persona` text,
  `fec_persona` date DEFAULT NULL,
  `estado_persona` varchar(2) DEFAULT NULL,
  `clave_persona` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`id_persona`),
  KEY `FK_persona_civil` (`id_civil`),
  KEY `FK_persona_sexo` (`id_sexo`),
  KEY `FK_persona_ciudad` (`id_ciudad`),
  KEY `FK_persona_tipoper` (`id_tipoper`),
  CONSTRAINT `FK_persona_ciudad` FOREIGN KEY (`id_ciudad`) REFERENCES `ciudad` (`id_ciudad`),
  CONSTRAINT `FK_persona_civil` FOREIGN KEY (`id_civil`) REFERENCES `estado_civil` (`id_civil`),
  CONSTRAINT `FK_persona_sexo` FOREIGN KEY (`id_sexo`) REFERENCES `sexo` (`id_sexo`),
  CONSTRAINT `FK_persona_tipoper` FOREIGN KEY (`id_tipoper`) REFERENCES `tipo_persona` (`id_tipoper`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

/*Data for the table `persona` */

insert  into `persona`(`id_persona`,`id_tipoper`,`id_ciudad`,`id_sexo`,`id_civil`,`nom_persona`,`ape_persona`,`ruc_persona`,`direc_persona`,`telf_persona`,`cel_persona`,`email_persona`,`web_persona`,`obs_persona`,`fec_persona`,`estado_persona`,`clave_persona`) values (1,1,1,1,1,'ADMIN','ADMINISTRADOR','0705206597','UTMACH','00000000','00000000','UTMACH@HOTMAIL.COM','UTMACH.COM','NADA','2012-05-30','1','123456'),(3,3,2,1,1,'PROVEEDOR','','429834923','12 DE OCTUBRE Y 24 DE MAYO','9583299000','958953489','PROVEEDOR@HOTMAIL.COM','','VENTA DE PASTILLAS DE FRENOS','2012-06-03','1',''),(18,2,1,1,1,'FERNANDA','JIMENEZ','0967567567','CIUDAD VERDE','6756756','567567567','','','','2012-07-02','1',''),(19,2,4,1,1,'SYLVIA PATRICIA','PRADO ASANZA','0956856556','PASAJE FRENTE AL COLEGIO MADRE DE JESÚS','','055645646','','','','2012-07-01','1',''),(21,1,1,1,1,'vendedor','vendedor','1234567890','direccion','5555555','154000000','','','empleado','2013-03-25','1','1234567890'),(22,3,2,1,1,'PROVEEDOR 1','','2020287122','Davila','','','','','','2013-03-25','1',''),(25,2,5,1,1,'CLIENTE1 S.A.','FERNANDEZ','2099388123','','','','','','','2013-03-26','1','');

/*Table structure for table `producto` */

DROP TABLE IF EXISTS `producto`;

CREATE TABLE `producto` (
  `id_producto` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_tiporeten` bigint(20) DEFAULT NULL,
  `id_marca` bigint(20) DEFAULT NULL,
  `id_unimedida` bigint(20) DEFAULT NULL,
  `id_ganancia` bigint(20) DEFAULT NULL,
  `id_tipoiva` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `codbarra_producto` varchar(100) DEFAULT NULL,
  `nom_producto` varchar(100) DEFAULT NULL,
  `descrip_producto` text,
  `costo_producto` double(10,2) DEFAULT NULL,
  `pvp1_producto` double(10,2) DEFAULT NULL,
  `stock_producto` int(11) DEFAULT NULL,
  `stkmin_producto` int(11) DEFAULT NULL,
  `stkmax_producto` int(11) DEFAULT NULL,
  `img_producto` varchar(100) DEFAULT NULL,
  `fecing_producto` date DEFAULT NULL,
  `fecvenci_producto` date DEFAULT NULL,
  `posicion_producto` varchar(32) DEFAULT NULL,
  `estado_producto` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id_producto`),
  KEY `FK_producto_retencion` (`id_tiporeten`),
  KEY `FK_producto_marca` (`id_marca`),
  KEY `FK_producto_medida` (`id_unimedida`),
  KEY `FK_producto_ganancia` (`id_ganancia`),
  KEY `fk_prodcuto_id_tipoiva` (`id_tipoiva`),
  CONSTRAINT `FK_producto_ganancia` FOREIGN KEY (`id_ganancia`) REFERENCES `ganancia` (`id_ganancia`),
  CONSTRAINT `FK_producto_marca` FOREIGN KEY (`id_marca`) REFERENCES `marca_producto` (`id_marca`),
  CONSTRAINT `FK_producto_medida` FOREIGN KEY (`id_unimedida`) REFERENCES `unidad_medida` (`id_unimedida`),
  CONSTRAINT `FK_producto_retencion` FOREIGN KEY (`id_tiporeten`) REFERENCES `tiporetencion` (`id_tiporeten`),
  CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`id_tipoiva`) REFERENCES `tipoiva` (`id_tipoiva`)
) ENGINE=InnoDB AUTO_INCREMENT=2005 DEFAULT CHARSET=latin1;

/*Data for the table `producto` */

insert  into `producto`(`id_producto`,`id_tiporeten`,`id_marca`,`id_unimedida`,`id_ganancia`,`id_tipoiva`,`codbarra_producto`,`nom_producto`,`descrip_producto`,`costo_producto`,`pvp1_producto`,`stock_producto`,`stkmin_producto`,`stkmax_producto`,`img_producto`,`fecing_producto`,`fecvenci_producto`,`posicion_producto`,`estado_producto`) values (1,1,2,1,1,1,'128301723012938','producto 1','Este es el producto número uno',12.19,13.65,4,20,50,'tornillo.jpg','2013-04-01','2013-04-25','11 2 31','1'),(2,1,1,2,2,1,'908097098098','producto 2','Descripcion del producto 2',25.00,28.75,-9,30,100,'','2013-03-31','2013-05-31',NULL,'1'),(3,1,2,2,2,2,'90809808080809808','producto 3','DESCRIPCION DEL PRODUCTO 3',10.00,11.50,-25,1,35,'','2013-04-09',NULL,NULL,'1'),(16,1,1,1,1,1,'100','W0504','Pulmon Mercedes Benz 3030',0.00,1.00,2,1,99,'','2013-05-15',NULL,'1.1.1','1'),(17,1,1,1,1,1,'185','','Pulmon doble accion Knorr M. Benz ',0.00,1.00,1,1,99,'','2013-05-15',NULL,'1.1.5','1'),(18,1,1,1,1,1,'200200','200200','Pulmo simple 7\" tipo 24',0.00,1.00,8,1,99,'','2013-05-15',NULL,'1.1.3','1'),(19,1,1,1,1,1,'156','186','Pulmon Scania 3024',0.00,1.00,0,1,99,'','2013-05-15',NULL,'1.1.1','1'),(20,1,1,1,1,1,'101','X0525','Pulmon Scania 3024',0.00,1.00,0,1,99,'','2013-05-15',NULL,'1.1.1','1'),(21,1,1,1,1,1,'102','W0526','Pulmon Scania 3030',0.00,1.00,0,1,99,'','2013-05-15',NULL,'1.1.1','1'),(22,1,1,1,1,1,'103','W0505','Pulmon Mercedes Benz 3024',0.00,1.00,1,1,99,'','2013-05-15',NULL,'1.1.1','1'),(23,1,1,1,1,1,'104','W0545','Pulmon Scania 2424',0.00,1.00,5,1,99,'','2013-05-15',NULL,'1.1.1 - 1.1.5','1'),(24,1,1,1,1,1,'105','X0527','Pulmon Mercedes Benz 3024',0.00,1.00,1,1,99,'','2013-05-15',NULL,'1.1.1','1'),(25,1,1,1,1,1,'106','R3100','Pulmon Doble universal',0.00,1.00,19,1,99,'','2013-05-15',NULL,'1.1.2','1'),(26,1,1,1,1,1,'107','R1040','Pulmon simple 3024-3030',0.00,1.00,0,1,99,'','2013-05-15',NULL,'1.1.3','1'),(27,1,1,1,1,1,'157','85381','Pulmon Fiat',0.00,1.00,2,1,99,'','2013-05-15',NULL,'1.1.4','1'),(28,1,1,1,1,1,'158','24204','Pulmon Mercedes Benz',0.00,1.00,0,1,99,'','2013-05-15',NULL,'1.1.4','1'),(29,1,1,1,1,1,'159','200400','Pulmon universal 3030',0.00,1.00,2,1,99,'','2013-05-15',NULL,'1.1.4','1'),(30,1,1,1,1,1,'108','R 1070','Pulmon Acoplado',0.00,1.00,2,1,99,'','2013-05-15',NULL,'1.1.5','1'),(31,1,1,1,1,1,'109','R1030','Pulmon camion o acoplado',0.00,1.00,2,1,99,'','2013-05-15',NULL,'1.1.5','1'),(32,1,1,1,1,1,'160','R1040','Pulmon Simple 3030 Reparado',0.00,1.00,1,1,99,'','2013-05-15',NULL,'1.1.5','1'),(33,1,1,1,1,1,'161','24','Pulmon simple reparado 24\"',0.00,1.00,2,1,99,'','2013-05-15',NULL,'1.1.5','1'),(34,1,1,1,1,1,'162','16','Pulmon simple reparado 16\"',0.00,1.00,1,1,99,'','2013-05-15',NULL,'1.1.5','1'),(35,1,1,1,1,1,'110','3110','Pulmon doble reparado',0.00,1.00,1,1,99,'','2013-05-15',NULL,'1.1.5','1'),(36,1,1,1,1,1,'111','R3130','Pulmon reparado ',0.00,1.00,4,1,99,'','2013-05-15',NULL,'1.1.6','1'),(37,1,1,1,1,1,'112','','Pulmon reparado ',0.00,1.00,1,1,99,'','2013-05-15',NULL,'1.1.6','1'),(38,1,1,1,1,1,'113','8036','Juego de cinta Peugeot 504/505 Std.',0.00,1.00,4,1,99,'','2013-05-15',NULL,'1.2.1','1'),(39,1,1,1,1,1,'114','8036/1','Juego de cinta Peugeot 504/505 1?',0.00,1.00,2,1,99,'','2013-05-15',NULL,'1.2.1','1'),(40,1,1,1,1,1,'115','8036/2','Juego de cinta Peugeot 504/505 2?',0.00,1.00,5,1,99,'','2013-05-15',NULL,'1.2.1','1'),(41,1,1,1,1,1,'116','8036/3','Juego de cinta Peugeot 504/505 3?',0.00,1.00,2,1,99,'','2013-05-15',NULL,'1.2.1','1'),(42,1,1,1,1,1,'117','8040','Juego de cinta Renault 11 / 9 / 19 Std',0.00,1.00,2,1,99,'','2013-05-15',NULL,'1.2.1','1'),(43,1,1,1,1,1,'118','8040/1','Juego de cinta Renault 11 / 9 / 19 1?',0.00,1.00,7,1,99,'','2013-05-15',NULL,'1.2.1','1'),(44,1,1,1,1,1,'119','8040/2','Juego de cinta Renault 11 / 9 / 19 2?',0.00,1.00,4,1,99,'','2013-05-15',NULL,'1.2.1','1'),(45,1,1,1,1,1,'120','2053/1','Juego de cinta',0.00,1.00,5,1,99,'','2013-05-15',NULL,'1.2.1','1'),(46,1,1,1,1,1,'121','2053/2','Juego de cinta',0.00,1.00,4,1,99,'','2013-05-15',NULL,'1.2.1','1'),(47,1,1,1,1,1,'122','8039','Juego de cinta Renault 18 / 21 Std',0.00,1.00,6,1,99,'','2013-05-15',NULL,'1.2.2','1'),(48,1,1,1,1,1,'123','8039/1','Juego de cinta Renault 18 / 21 en 1?',0.00,1.00,1,1,99,'','2013-05-15',NULL,'1.2.2','1'),(49,1,1,1,1,1,'124','8039/2','Juego de cinta Renault 18 / 21 en 2?',0.00,1.00,0,1,99,'','2013-05-15',NULL,'1.2.2','1'),(50,1,1,1,1,1,'125','8018/1','Juego de cinta',0.00,1.00,5,1,99,'','2013-05-15',NULL,'1.2.2','1'),(51,1,1,1,1,1,'20511','2051/1','Jgo Cinta de freno 1? medida ',0.00,1.00,16,1,99,'','2013-05-15',NULL,'13.3.6','1'),(52,1,1,1,1,1,'20512','2051/2','Jgo Cinta de freno ciega 2? medida ',0.00,1.00,2,1,99,'','2013-05-15',NULL,'13.3.5','1'),(53,1,1,1,1,1,'20513','2051/1','Jgo Cinta de freno ciega 1? medida',0.00,1.00,4,1,99,'','2013-05-15',NULL,'13.3.5','1'),(54,1,1,1,1,1,'20531','2053/1','Jgo Cinta de freno 1? medida Ford Ranger ',0.00,1.00,9,1,99,'','2013-05-15',NULL,'13.3.6','1'),(55,1,1,1,1,1,'20532','2053/2','Jgo Cinta de freno 2? media Ford Ranger ',0.00,1.00,3,1,99,'','2013-05-15',NULL,'13.3.6','1'),(56,1,1,1,1,1,'2025','2025/2','Jgo Cinta de freno 2? medida ',0.00,1.00,1,1,99,'','2013-05-15',NULL,'13.3.5','1'),(57,1,1,1,1,1,'2006','206STD','Jgo Cinta de freno ciega estandar ',0.00,1.00,7,1,99,'','2013-05-15',NULL,'13.3.7','1'),(58,1,1,1,1,1,'20060','2006STD','Jgo Cinta de freno ',0.00,1.00,2,1,99,'','2013-05-15',NULL,'13.3.7','1'),(59,1,1,1,1,1,'20061','2006/1 ','Jgo Cinta de freno ? medida ',0.00,1.00,7,1,99,'','2013-05-15',NULL,'13.3.7','1'),(60,1,1,1,1,1,'20062','2006/2','Jgo Cinta de freno 2? medida ',0.00,1.00,2,1,99,'','2013-05-15',NULL,'13.3.7','1'),(61,1,1,1,1,1,'20302','2030/2','Jgo Cinta de freno 2? medida ',0.00,1.00,2,1,99,'','2013-05-15',NULL,'13.3.7','1'),(62,1,1,1,1,1,'20301','2030/1','Jgo Cinta 1? medida ',0.00,1.00,2,1,99,'','2013-05-15',NULL,'13.3.7','1'),(63,1,1,1,1,1,'855','855/1','Jgo Cinta de freno 1? medida 100',0.00,1.00,3,1,99,'','2013-05-15',NULL,'13.3.7','1'),(64,1,1,1,1,1,'2030','2030STD','Jgo Cinta de freno estandar ',0.00,1.00,1,1,99,'','2013-05-15',NULL,'13.3.7','1'),(65,1,1,1,1,1,'20063','2006/1','Jgo Cinta de freno ciega 1? medida ',0.00,1.00,8,1,99,'','2013-05-15',NULL,'13.3.8','1'),(66,1,1,1,1,1,'20064','2006/2','Jgo Cinta de freno ciega 2? medida ',0.00,1.00,4,1,99,'','2013-05-15',NULL,'13.3.8','1'),(67,1,1,1,1,1,'20065','2006/3','Jgo Cinta de feno ciega 3? medida ',0.00,1.00,11,1,99,'','2013-05-15',NULL,'13.3.8','1'),(68,1,1,1,1,1,'20066','20066/3 ','Jgo Cinta de freno 3? medida ',0.00,1.00,17,1,99,'','2013-05-15',NULL,'13.3.8','1'),(69,1,1,1,1,1,'288','','Patin con cinta mediano ',0.00,1.00,7,1,99,'','2013-05-15',NULL,'13.3.9','1'),(70,1,1,1,1,1,'289','','Patin con cinta chico ',0.00,1.00,12,1,99,'','2013-05-15',NULL,'13.3.9','1'),(71,1,1,1,1,1,'603','0603STD ( RN210 )','Jgo Cinta de freno estandar ',0.00,1.00,5,1,99,'','2013-05-15',NULL,'13.4.1','1'),(72,1,1,1,1,1,'290','RN210/1 ','Jgo cinta de freno  1? medida ',0.00,1.00,5,1,99,'','2013-05-15',NULL,'13.4.1','1'),(73,1,1,1,1,1,'291','RN210/2','Jgo cinta defreno 2? medida  ',0.00,1.00,6,1,99,'','2013-05-15',NULL,'13.4.1','1'),(74,1,1,1,1,1,'1219','1219STD','Jgo Cinta de freno estandar ',0.00,1.00,20,1,99,'','2013-05-15',NULL,'13.4.2','1'),(75,1,1,1,1,1,'12191','1219/1','Jgo Cinta de freno 1? medida ',0.00,1.00,11,1,99,'','2013-05-15',NULL,'13.4.2','1'),(76,1,1,1,1,1,'12192','1219/2','Jgo Cinta de reno 2? medida ',0.00,1.00,6,1,99,'','2013-05-15',NULL,'13.4.2','1'),(77,1,1,1,1,1,'12193','1219/3','Jgo Cinta de freno 3? medida ',0.00,1.00,18,1,99,'','2013-05-15',NULL,'13.4.3','1'),(78,1,1,1,1,1,'8020','8020STD','Jgo Cinta de freno estandar Peugeot ',0.00,1.00,10,1,99,'','2013-05-15',NULL,'13.4.3','1'),(79,1,1,1,1,1,'80201','8020/1','Jgo Cinta Peugeot 1? medida',0.00,1.00,8,1,99,'','2013-05-15',NULL,'13.4.3','1'),(80,1,1,1,1,1,'80202','8020/2 ','Jgo Cinta Peugeot 2?medida ',0.00,1.00,6,1,99,'','2013-05-15',NULL,'13.4.3','1'),(81,1,1,1,1,1,'80203','8020/3','Jgo Cinta Peugeot 3? medida ',0.00,1.00,6,1,99,'','2013-05-15',NULL,'13.4.3','1'),(82,1,1,1,1,1,'8081','8081STD','Jgo Cinta de freno estandar ',0.00,1.00,10,1,99,'','2013-05-15',NULL,'13.4.4','1'),(83,1,1,1,1,1,'80811','8081/1','Jgo cinta de freno 1? medida ',0.00,1.00,9,1,99,'','2013-05-15',NULL,'13.4.4','1'),(84,1,1,1,1,1,'80812','8081/2','Jgo cinta de freno 2? medida ',0.00,1.00,5,1,99,'','2013-05-15',NULL,'13.4.4','1'),(85,1,1,1,1,1,'487','0487STD','Jgo Cinta de freno ciega Ford Cierra ',0.00,1.00,1,1,99,'','2013-05-15',NULL,'13.4.4','1'),(86,1,1,1,1,1,'486','0486STD','Jgo Cinta de freno ciega ',0.00,1.00,8,1,99,'','2013-05-15',NULL,'13.4.4','1'),(87,1,1,1,1,1,'887','0887/2','Jgo Cinta de freno 2? medida ',0.00,1.00,2,1,99,'','2013-05-15',NULL,'13.4.4','1'),(88,1,1,1,1,1,'7774','7774/1','Jgco Cinta de freno 1? medida ',0.00,1.00,1,1,99,'','2013-05-15',NULL,'13.4.4','1'),(89,1,1,1,1,1,'2080','2080STD','Jgo Cinta de freno estandar ',0.00,1.00,16,1,99,'','2013-05-15',NULL,'13.4.5','1'),(90,1,1,1,1,1,'20801','2080/1','Jgo Cinta de freno 1? medida',0.00,1.00,2,1,99,'','2013-05-15',NULL,'13.4.5','1'),(91,1,1,1,1,1,'20802','2080/2','Jgo Cincta de freno 2? medida ',0.00,1.00,4,1,99,'','2013-05-15',NULL,'13.4.5','1'),(92,1,1,1,1,1,'20803','2080/3','Jgo Cinta de freno 3? medida ',0.00,1.00,7,1,99,'','2013-05-15',NULL,'13.4.6','1'),(93,1,1,1,1,1,'8032','8032STD','Jgo Cinta de freno estandar ',0.00,1.00,11,1,99,'','2013-05-15',NULL,'13.4.6','1'),(94,1,1,1,1,1,'80321','8032/1','Jgo Cinta de freno 1? medida ',0.00,1.00,14,1,99,'','2013-05-15',NULL,'13.4.6','1'),(95,1,1,1,1,1,'912','912STD','Jgo Cinta de freno Estandar Rastrogero ',0.00,1.00,1,1,99,'','2013-05-15',NULL,'13.4.7','1'),(96,1,1,1,1,1,'9122','912/2','Jgco Cinta de freno 2? medida Rastrogero ',0.00,1.00,1,1,99,'','2013-05-15',NULL,'13.4.7','1'),(97,1,1,1,1,1,'9121','912/1','Jgo Cinta de freno 1? medida Rasrtogero ',0.00,1.00,2,1,99,'','2013-05-15',NULL,'13.4.7','1'),(98,1,1,1,1,1,'8014','8014/1','Jgo Cinta de freno 1? medida',0.00,1.00,5,1,99,'','2013-05-15',NULL,'13.4.7','1'),(99,1,1,1,1,1,'80142','8014/2','Jgo Cinta de freno 2? medida ',0.00,1.00,5,1,99,'','2013-05-15',NULL,'13.4.7','1'),(100,1,1,1,1,1,'80143','8014/3','Jgco Cinta de freno 3? medida ',0.00,1.00,1,1,99,'','2013-05-15',NULL,'13.4.7','1'),(101,1,1,1,1,1,'457','0457STD','Jgo Cinta de freno estandar ',0.00,1.00,6,1,99,'','2013-05-15',NULL,'13.4.8','1'),(102,1,1,1,1,1,'20067','2006/3','Jgo Cinta de freno 3? medida 7,2 mm',0.00,1.00,2,1,99,'','2013-05-15',NULL,'13.4.8','1'),(103,1,1,1,1,1,'4571','0457/1','Jgo Cinta de freno 1? medida ',0.00,1.00,6,1,99,'','2013-05-15',NULL,'13.4.8','1'),(104,1,1,1,1,1,'4572','0457/2','Jgo Cinta de freno 2? medida',0.00,1.00,10,1,99,'','2013-05-15',NULL,'13.4.8','1'),(105,1,1,1,1,1,'8064','8064STD','Jgo Cinta de freno estandar ',0.00,1.00,9,1,99,'','2013-05-15',NULL,'13.4.9','1'),(106,1,1,1,1,1,'80641','8064/1','Jgo cinta de freno 1? medida ',0.00,1.00,12,1,99,'','2013-05-15',NULL,'13.4.9','1'),(107,1,1,1,1,1,'80642','8064/2','Jgo Cinta de freno 2? medida ',0.00,1.00,11,1,99,'','2013-05-15',NULL,'13.4.9','1'),(108,1,1,1,1,1,'80643','8064/3','Jgo Cinta de freno 3? medida ',0.00,1.00,4,1,99,'','2013-05-15',NULL,'13.4.9','1'),(109,1,1,1,1,1,'292','','Cintas varias ',0.00,1.00,17,1,99,'','2013-05-15',NULL,'13.4.9','1'),(110,1,1,1,1,1,'8080','8080STD','Jgo Cinta de freno Estandar Fiat - VW',0.00,1.00,14,1,99,'','2013-05-15',NULL,'13.4.10','1'),(111,1,1,1,1,1,'80801','8080/1','Jgo Cinta de freno 1? medida Fiat -VW',0.00,1.00,20,1,99,'','2013-05-15',NULL,'13.4.10','1'),(112,1,1,1,1,1,'80802','8080/2','Jgo Cinta de freno 2? medida Fiat- VW',0.00,1.00,12,1,99,'','2013-05-15',NULL,'13.4.10','1'),(113,1,1,1,1,1,'690538','','Jgo Pastilla de Freno Fiat duna , Uno , 1500',0.00,1.00,3,1,99,'','2013-05-15',NULL,'13.1.3','1'),(114,1,1,1,1,1,'690318','','Jgo Pastillas Fiat Duna , Spazio , Fiorino ',0.00,1.00,2,1,99,'','2013-05-15',NULL,'12.1.3','1'),(115,1,1,1,1,1,'690478','','Jgo Pastillas de freno Iveco daily 1996',0.00,1.00,4,1,99,'','2013-05-15',NULL,'12.1.4','1'),(116,1,1,1,1,1,'690547','','Jgo Pastillas Palio - Weekend - Estrada 1998',0.00,1.00,6,1,99,'','2013-05-15',NULL,'12.1.4','1'),(117,1,1,1,1,1,'293','PD/332','Jgo Pastillas Ford Ranger - Explorer ',0.00,1.00,2,1,99,'','2013-05-15',NULL,'12.1.5','1'),(118,1,1,1,1,1,'690511','','Jgo Pastillas F-100 , F-250 , F-350 ',0.00,1.00,6,1,99,'','2013-05-15',NULL,'12.1.5','1'),(119,1,1,1,1,1,'690247','','Jgo Pastillas Ford 1000 , Chevrolet C-20',0.00,1.00,0,1,99,'','2013-05-15',NULL,'12.1.5','1'),(120,1,1,1,1,1,'690067','','Jgo Pastillas Chevrolet C-20 , Bronco , Ranger , F-100',0.00,1.00,0,1,99,'','2013-05-15',NULL,'12.1.5','1'),(121,1,1,1,1,1,'690407','','Jgo Pastilla Chevrolet Corsa - VW Gol ',0.00,1.00,7,1,99,'','2013-05-15',NULL,'12.3.2','1'),(122,1,1,1,1,1,'690370','','Jgo Pastilla Polo - Seat cordoba ',0.00,1.00,2,1,99,'','2013-05-15',NULL,'12.1.6','1'),(123,1,1,1,1,1,'690197','','Jgo Pastillas R-21 ',0.00,1.00,1,1,99,'','2013-05-15',NULL,'12.1.7','1'),(124,1,1,1,1,1,'690298','','Jgo Pastilla R-18',0.00,1.00,1,1,99,'','2013-05-15',NULL,'12.1.7','1'),(125,1,1,1,1,1,'690199','','Jgo Pastilla Citroen - Renault ',0.00,1.00,2,1,99,'','2013-05-15',NULL,'12.1.7','1'),(126,1,1,1,1,1,'294','N-436','Jgo Pastilla R-18 ',0.00,1.00,1,1,99,'','2013-05-15',NULL,'12.1.7','1'),(127,1,1,1,1,1,'295','N-439','Jgo Pastilla R-12 , R-18',0.00,1.00,2,1,99,'','2013-05-15',NULL,'12.1.7','1'),(128,1,1,1,1,1,'690365','','Jgo Pastilla Hiunday H-100 ',0.00,1.00,1,1,99,'','2013-05-15',NULL,'12.1.8','1'),(129,1,1,1,1,1,'8,42407E+12','180646','Jgo Pastilla Hinday delantera ',0.00,1.00,1,1,99,'','2013-05-15',NULL,'12.1.8','1'),(130,1,1,1,1,1,'4,00759E+12','','Jgo Pastilla Fiat 242 - Citroen visa ',0.00,1.00,1,1,99,'','2013-05-15',NULL,'12.1.8','1'),(131,1,1,1,1,1,'4,00759E+12','','Jgo Pastilla Fiat Ducato boxer ',0.00,1.00,1,1,99,'','2013-05-15',NULL,'12.1.8','1'),(132,1,1,1,1,1,'297','','Rulemanes usados ',0.00,1.00,27,1,99,'','2013-05-15',NULL,'12.1.9','1'),(133,1,1,1,1,1,'298','','Rulemanes usados ',0.00,1.00,34,1,99,'','2013-05-15',NULL,'12.1.10','1'),(134,1,1,1,1,1,'7,89303E+12','P/111','Jgo Pastilla M.Benz Sprinter ',0.00,1.00,1,1,99,'','2013-05-15',NULL,'12.2.2','1'),(135,1,1,1,1,1,'300','N-712','Jgo Pastilla M.Benz Sprinter ',0.00,1.00,1,1,99,'','2013-05-15',NULL,'12.2.2','1'),(136,1,1,1,1,1,'690519','','Jgo Pastilla M.Benz 712 , 812 , 914 ',0.00,1.00,1,1,99,'','2013-05-15',NULL,'12.2.2','1'),(137,1,1,1,1,1,'7,89303E+12','PD-104','Jgo Pastilla M.Benz 710 ',0.00,1.00,1,1,99,'','2013-05-15',NULL,'12.2.2','1'),(138,1,1,1,1,1,'8,42407E+12','150102','Jgo Pastilla M.Benz Sprinter - Dyane ',0.00,1.00,3,1,99,'','2013-05-15',NULL,'12.2.2','1'),(139,1,1,1,1,1,'690304','','Jgo Pastilla Fiat Duna -1500 -Fiat Uno',0.00,1.00,2,1,99,'','2013-05-15',NULL,'12.2.3','1'),(140,1,1,1,1,1,'690252','','Jgo Pastilla Fiesta - Ford Ka ',0.00,1.00,2,1,99,'','2013-05-15',NULL,'12.2.4','1'),(141,1,1,1,1,1,'690500','','Jgo Pastilla Ford Courier ',0.00,1.00,0,1,99,'','2013-05-15',NULL,'12.2.4','1'),(142,1,1,1,1,1,'8,42407E+12','140854','Jgo Pastilla Ysuzu - Chevrolet Lux ',0.00,1.00,1,1,99,'','2013-05-15',NULL,'12.2.5','1'),(143,1,1,1,1,1,'301','N-227','Jgo Pastilla Santana - Quantum - Gol gti ',0.00,1.00,3,1,99,'','2013-05-15',NULL,'12.2.6','1'),(144,1,1,1,1,1,'8,42407E+12','150524','Jgo Pastilla Peugeot boxer - Fiat ducato ',0.00,1.00,2,1,99,'','2013-05-15',NULL,'12.2.6','1'),(145,1,1,1,1,1,'302','N-421','Jgo Pastilla Renault clio - R-19',0.00,1.00,0,1,99,'','2013-05-15',NULL,'12.2.7','1'),(146,1,1,1,1,1,'4,00759E+13','','Jgo Pastila Renault Clio - Express ',0.00,1.00,0,1,99,'','2013-05-15',NULL,'12.2.7','1'),(147,1,1,1,1,1,'690201','','Jgo Pastilla Trafic',0.00,1.00,2,1,99,'','2013-05-15',NULL,'12.2.7','1'),(148,1,1,1,1,1,'303','15072','Jgo Pastilla VW Gol - Saveiro ',0.00,1.00,1,1,99,'','2013-05-15',NULL,'12.2.7','1'),(149,1,1,1,1,1,'690168','','Jgo Pastilla Nissan Path Finder ',0.00,1.00,2,1,99,'','2013-05-15',NULL,'12.2.7','1'),(150,1,1,1,1,1,'304','','Rulemanes varios ',0.00,1.00,40,1,99,'','2013-05-15',NULL,'12.1.9','1'),(151,1,1,1,1,1,'305','3811-0','Jgo Pastillas Renault Trafic ',0.00,1.00,1,1,99,'','2013-05-15',NULL,'12.2.7','1'),(152,1,1,1,1,1,'690147','','Jgo Pastilla Mitshubishi L-200 - Montero ',0.00,1.00,2,1,99,'','2013-05-15',NULL,'12.2.8','1'),(153,1,1,1,1,1,'690657','','Jgo Pastilla Toyota Hilux 4x2 ',0.00,1.00,1,1,99,'','2013-05-15',NULL,'12.2.8','1'),(154,1,1,1,1,1,'8,42407E+12','140614','Jgo Pastilla Toyota Hilux 4x4',0.00,1.00,2,1,99,'','2013-05-15',NULL,'12.2.8','1'),(155,1,1,1,1,1,'32216','','Ruleman ',0.00,1.00,36,1,99,'','2013-05-15',NULL,'12.2.9-9.3.3','1'),(156,1,1,1,1,1,'32218','','Ruleman ',0.00,1.00,88,1,99,'','2013-05-15',NULL,'12.2.9-9.3.3','1'),(157,1,1,1,1,1,'306','518445/10 ','Ruleman ',0.00,1.00,27,1,99,'','2013-05-15',NULL,'12.2.9-9.3.3','1'),(158,1,1,1,1,1,'32308','','Ruleman de Scania delantero',0.00,1.00,1,1,99,'','2013-05-15',NULL,'12.2.10','1'),(159,1,1,1,1,1,'6212','','Ruleman ',0.00,1.00,1,1,99,'','2013-05-15',NULL,'12.2.10','1'),(160,1,1,1,1,1,'307','','Ruleman usado ',0.00,1.00,1,1,99,'','2013-05-15',NULL,'12.2.10','1'),(161,1,1,1,1,1,'8,42407E+12','190248','Jgo Pastilla Chevrolet - Opel - Asrtra - Zafira ',0.00,1.00,4,1,99,'','2013-05-15',NULL,'12.3.1','1'),(162,1,1,1,1,1,'8,42407E+12','150237','Jgo Pastilla Ssang Yong - Musso ',0.00,1.00,1,1,99,'','2013-05-15',NULL,'12.3.1','1'),(163,1,1,1,1,1,'690687','','Jgo Pastilla Corsa delantera ',0.00,1.00,4,1,99,'','2013-05-15',NULL,'12.3.2','1'),(164,1,1,1,1,1,'690178','','Suzuki Fan - Corsa ',0.00,1.00,0,1,99,'','2013-05-15',NULL,'12.3.2','1'),(165,1,1,1,1,1,'690619','','Jgo Pastilla Ford Fiesta - Courier  ( Delantera ) ',0.00,1.00,2,1,99,'','2013-05-15',NULL,'12.3.4','1'),(166,1,1,1,1,1,'308','N-209-210','Jgo Pastilla VW Gol - Santana ',0.00,1.00,1,1,99,'','2013-05-15',NULL,'12.3.5','1'),(167,1,1,1,1,1,'309','N-319-320 ','Jgo Pastilla Omega ',0.00,1.00,1,1,99,'','2013-05-15',NULL,'12.3.5','1'),(168,1,1,1,1,1,'310','N-232-3','Jgo Pastilla VW Quantum ',0.00,1.00,1,1,99,'','2013-05-15',NULL,'12.3.5','1'),(169,1,1,1,1,1,'311','N-885','Jgo Pastilla Seat Ibiza - Cordoba - VW Caddy ',0.00,1.00,2,1,99,'','2013-05-15',NULL,'12.3.6','1'),(170,1,1,1,1,1,'690296','','Jgo Pastilla Peugeot 504 - 505 - Pick up ',0.00,1.00,2,1,99,'','2013-05-15',NULL,'12.3.6','1'),(171,1,1,1,1,1,'960315','','Jgo Pastilla Peugeot 504 - 505 - Pick up Con censor ',0.00,1.00,1,1,99,'','2013-05-15',NULL,'12.3.6','1'),(172,1,1,1,1,1,'690183','','Jgo Pastilla Peugeot 306 - 405 Mi 16 v',0.00,1.00,1,1,99,'','2013-05-15',NULL,'12.3.6','1'),(173,1,1,1,1,1,'690253','','Jgo Pastilla Peugeot 106 -306 ',0.00,1.00,2,1,99,'','2013-05-15',NULL,'12.3.6','1'),(174,1,1,1,1,1,'312','T-549','Jgo Pastilla Citroen AX- Peugeot 205 ',0.00,1.00,3,1,99,'','2013-05-15',NULL,'12.3.6','1'),(175,1,1,1,1,1,'7,89303E+12','PD-411','Jgo Pastilla Citroen Xahara - Picasso ',0.00,1.00,1,1,99,'','2013-05-15',NULL,'12.3.6','1'),(176,1,1,1,1,1,'313','16-130','Jgo Pastilla Toyota ',0.00,1.00,1,1,99,'','2013-05-15',NULL,'12.3.7','1'),(177,1,1,1,1,1,'690481','','Jgo Pastilla Ranault Kangoo',0.00,1.00,2,1,99,'','2013-05-15',NULL,'12.3.7','1'),(178,1,1,1,1,1,'314','PD-331','Jgo Pastilla Kia ',0.00,1.00,1,1,99,'','2013-05-15',NULL,'12.3.7','1'),(179,1,1,1,1,1,'315','63501-R','Bomba de freno Peugeot 505 ',0.00,1.00,1,1,99,'','2013-05-15',NULL,'13.2.3','1'),(180,1,1,1,1,1,'316','9245-5 ','Jgo Pastilla Renault usadas ',0.00,1.00,0,1,99,'','2013-05-15',NULL,'12.3.10','1'),(181,1,1,1,1,1,'690375','','Jgo Pastilla pick up S-10 , Tpyota , Blazer 4x2 1995',0.00,1.00,1,1,99,'','2013-05-15',NULL,'12.4.2','1'),(182,1,1,1,1,1,'8,42407E+12','190264','Jgo Pastilla Fordo Focus ( Nafta o diesel ) ( Delantera ) ',0.00,1.00,1,1,99,'','2013-05-15',NULL,'12..4.4','1'),(183,1,1,1,1,1,'317','','Jgo Pastilla Polo Classic',0.00,1.00,1,1,99,'','2013-05-15',NULL,'12.4.5','1'),(184,1,1,1,1,1,'690239','N-204','Jgo Pastilla VW-Gol , 1.6 , 1.8 90/94',0.00,1.00,1,1,99,'','2013-05-15',NULL,'12.4.5','1'),(185,1,1,1,1,1,'318','PD/465','Jgo Pastilla Peugeot 206',0.00,1.00,1,1,99,'','2013-05-15',NULL,'12.4.6','1'),(186,1,1,1,1,1,'319','PD/505','Jgo Pastilla Peugeot 307',0.00,1.00,1,1,99,'','2013-05-15',NULL,'12.4.6','1'),(187,1,1,1,1,1,'690588','','Jgo Pastilla Chevrolet Astra - Zafira 98',0.00,1.00,3,1,99,'','2013-05-15',NULL,'12.4.6','1'),(188,1,1,1,1,1,'31086','','Jgo Pastilla Peugeot 206 ( Sistema importado ) ',0.00,1.00,1,1,99,'','2013-05-15',NULL,'12.4.6','1'),(189,1,1,1,1,1,'320','','Jgo Pastilla Peugeot R.Megane , R.19 , R.Clio , Express ',0.00,1.00,2,1,99,'','2013-05-15',NULL,'12.4.6','1'),(190,1,1,1,1,1,'690192','','Jgo Pastilla Peugeot 306, 205, Clio ',0.00,1.00,3,1,99,'','2013-05-15',NULL,'12.1.7','1'),(191,1,1,1,1,1,'321','PD/331','Jgo Pastilla Kia ',0.00,1.00,1,1,99,'','2013-05-15',NULL,'12.4.7','1'),(192,1,1,1,1,1,'7,89748E+12','','Jgo Pastilla Scania ',0.00,1.00,3,1,99,'','2013-05-15',NULL,'12.4.7','1'),(193,1,1,1,1,1,'690974','','Jgo Pastilla Renault ',0.00,1.00,3,1,99,'','2013-05-15',NULL,'12.4.10','1'),(194,1,1,1,1,1,'323','','Campana Toyota ',0.00,1.00,2,1,99,'','2013-05-15',NULL,'12.4.8','1'),(195,1,1,1,1,1,'7,79814E+12','4770-0','Jgo Pastillas ( Litton ) Toyota Hilux 06/08',0.00,1.00,1,1,99,'','2013-05-15',NULL,'12.2.8','1'),(196,1,1,1,1,1,'690191','N-443','Jgo Pastilla Renault , Megane , 19 , 21 , Clio , Express',0.00,1.00,4,1,99,'','2013-05-15',NULL,'12.1.7','1'),(197,1,1,1,1,1,'690202','','Jgo Pastilla Seat Cordoba - VW-Polo 90/',0.00,1.00,2,1,99,'','2013-05-15',NULL,'12.1.6','1'),(198,1,1,1,1,1,'690217','','Jgo Pastilla Land Crusier , Toyota Runer , Hilux ',0.00,1.00,5,1,99,'','2013-05-15',NULL,'12.2.8','1'),(199,1,1,1,1,1,'690471','','Jgo Pastilla Citroen - Berlingo',0.00,1.00,2,1,99,'','2013-05-15',NULL,'12.3.6','1'),(200,1,1,1,1,1,'690478','','Jgo Pastilla Iveco Daily ',0.00,1.00,4,1,99,'','2013-05-15',NULL,'12.1.4','1'),(201,1,1,1,1,1,'690537','','Jgo Pastilla Peugeot 206 ( 1.1 , 1.4 , 1.6 , 1.9 D ) ',0.00,1.00,3,1,99,'','2013-05-15',NULL,'12.3.6','1'),(202,1,1,1,1,1,'690540','','Jgo Pastilla Ford Focus ( Nafta o diesel ) ( Trasera ) ',0.00,1.00,2,1,99,'','2013-05-15',NULL,'12.4.4','1'),(203,1,1,1,1,1,'690687','','Jgo Pastilla Chevrolet Corsa 2000/ ( Delantera ) ',0.00,1.00,4,1,99,'','2013-05-15',NULL,'12.3.2','1'),(204,1,1,1,1,1,'690688','','Jgo Pastilla Citroen Xara , Berlingo , Peugeot 206 , 207 ( Delantera ) ',0.00,1.00,1,1,99,'','2013-05-15',NULL,'12.3.6','1'),(205,1,1,1,1,1,'690064','','Jgo Pastilla Alfa Romeo 145-33- Fiat Regatta - Tipo , Uno , Volvo',0.00,1.00,2,1,99,'','2013-05-15',NULL,'12.1.2','1'),(206,1,1,1,1,1,'690122','','Jgo Pastilla M.Benz 608-710-711 ',0.00,1.00,2,1,99,'','2013-05-15',NULL,'12.2.2','1'),(207,1,1,1,1,1,'690302','','Jgo Pastilla VW Carat -Gasel - Senda - Kia SEPHIA 94',0.00,1.00,4,1,99,'','2013-05-15',NULL,'12.1.6','1'),(208,1,1,1,1,1,'690336','','Jgo Pastilla Peugeot 306 , 405 / Seat ibiza / VW',0.00,1.00,3,1,99,'','2013-05-15',NULL,'12.3.6','1'),(209,1,1,1,1,1,'690349','','Jgo Pastilla Ford Explorer / Kia / Mazda / Mercuri ',0.00,1.00,4,1,99,'','2013-05-15',NULL,'12.1.5','1'),(210,1,1,1,1,1,'897120536','','Diafragma de talco 30 Wabco ',0.00,1.00,44,1,99,'','2013-05-15',NULL,'11.3.3-11.1.1','1'),(211,1,1,1,1,1,'234101','','Diafragma de pulmon ',0.00,1.00,111,1,99,'','2013-05-15',NULL,'11.4.2','1'),(212,1,1,1,1,1,'897120536','','Diafragma talco 24 wabco',0.00,1.00,23,1,99,'','2013-05-15',NULL,'12.3.2','1'),(213,1,1,1,1,1,'20145','','Diafragma de pulmon M.Benz 6 \"1/2\" ( Delantero ) ',0.00,1.00,47,1,99,'','2013-05-15',NULL,'11.4.2-11.1.1','1'),(214,1,1,1,1,1,'234100','','Diafragma de pulmon ( Del . 7\" ) ( Sca-vabis ) ',0.00,1.00,82,1,99,'','2013-05-15',NULL,'11.1.1.','1'),(215,1,1,1,1,1,'897125364','89712536-4','Diafragma de pulmon 24 ( Frepilco ) ',0.00,1.00,36,1,99,'','2013-05-15',NULL,'11.4.2','1'),(216,1,1,1,1,1,'897120520','','Diafragma de Pulmon ( Original wabco ) ',0.00,1.00,27,1,99,'','2013-05-15',NULL,'11.1.2','1'),(217,1,1,1,1,1,'897120516','','Diafragma de pulmon 16 ( Frepilco ) ',0.00,1.00,56,1,99,'','2013-05-15',NULL,'11.1.2','1'),(218,1,1,1,1,1,'897120510','','Diafragma de pulmon ( Wabco )',0.00,1.00,29,1,99,'','2013-05-15',NULL,'11.1.2','1'),(219,1,1,1,1,1,'897121610','','Diafragma de pulmon 14 ',0.00,1.00,55,1,99,'','2013-05-15',NULL,'11.1.2','1'),(220,1,1,1,1,1,'897121615','','Diafragma de pulmon ( Frepilco ) ',0.00,1.00,11,1,99,'','2013-05-15',NULL,'11.1.2','1'),(221,1,1,1,1,1,'8971200505','','Diafragma de pulmon ( Frepilco ) ',0.00,1.00,2,1,99,'','2013-05-15',NULL,'11.1.3','1'),(222,1,1,1,1,1,'234226','','Diafragma de freno ( Frepiloco ) ',0.00,1.00,5,1,99,'','2013-05-15',NULL,'11.1.3','1'),(223,1,1,1,1,1,'324','','Driafragma master Randon ',0.00,1.00,0,0,0,'','2013-05-15',NULL,'11.1.3','1'),(224,1,1,1,1,1,'325','master','Diafragma de pulmon master ( Spring brake ) ( Frepilco ) ',0.00,1.00,45,0,0,'','2013-05-15',NULL,'11.1.3','1'),(225,1,1,1,1,1,'24717','','Flexible Fiat 147 ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'11.1.4','1'),(226,1,1,1,1,1,'53625','','Flexible de freno M.Benz ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'11.1.4','1'),(227,1,1,1,1,1,'22700','','Flexible Falcon ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'11.1.4','1'),(228,1,1,1,1,1,'5784','','Flexible freno ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'11.1.4','1'),(229,1,1,1,1,1,'39983','','Flexible de freno ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'11.1.4','1'),(230,1,1,1,1,1,'2014723','','Flexible de freno Ford 600',0.00,1.00,1,0,0,'','2013-05-15',NULL,'11.1.4','1'),(231,1,1,1,1,1,'362510','','Flexible Fiat 128 ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'11.1.4','1'),(232,1,1,1,1,1,'23237242','','Flexible Fordo F-100',0.00,1.00,2,0,0,'','2013-05-15',NULL,'11.1.4','1'),(233,1,1,1,1,1,'79513','','Flexible de freno Fiat - R.12',0.00,1.00,1,0,0,'','2013-05-15',NULL,'11.1.5','1'),(234,1,1,1,1,1,'326','','Flexible Scania ( Conpresor ) 1/4\"',0.00,1.00,2,0,0,'','2013-05-15',NULL,'11.1.5','1'),(235,1,1,1,1,1,'327','','Flexibles varios usados ',0.00,1.00,13,0,0,'','2013-05-15',NULL,'11.1.5','1'),(236,1,1,1,1,1,'328','','Flexibles varios nuevos ',0.00,1.00,17,0,0,'','2013-05-15',NULL,'11.1.5','1'),(237,1,1,1,1,1,'3281','2390469','Rep. Mayor bomba Kombi , VW 15 / 16 \"',0.00,1.00,2,0,0,'','2013-05-15',NULL,'11.1.6','1'),(238,1,1,1,1,1,'3282','2390454','Rep. Mayor Peugeot 505 ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'11.1.6','1'),(239,1,1,1,1,1,'3283','','Flexible ',0.00,1.00,3,0,0,'','2013-05-15',NULL,'11.1.4','1'),(240,1,1,1,1,1,'3284','2407813','Red . Bomba Torino 7/8 \"',0.00,1.00,2,0,0,'','2013-05-15',NULL,'11.1.6','1'),(241,1,1,1,1,1,'329','R2130','Red . Valvul? estacionamiento ( RG ) ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'11.1.6','1'),(242,1,1,1,1,1,'3291','3338100','Red . Mayor bomba doble sircuito Falcon 22,2 mm ( Varga )',0.00,1.00,1,0,0,'','2013-05-15',NULL,'11.1.6','1'),(243,1,1,1,1,1,'3292','2408560','Red . Mayor bomba Doge 1500 , 5/8 \" ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'11.1.6','1'),(244,1,1,1,1,1,'3293','2407248','Red .mayor bomba Fiat 600 3/4\" ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'11.1.6','1'),(245,1,1,1,1,1,'3294','2390460','Red . Mayor bomba doble tensa ( 20,6 mm ) 13/16\" ( Bendix ) ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'11.1.6','1'),(246,1,1,1,1,1,'3295','2392163','Red . Mayor Ford escort ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'11.1.6','1'),(247,1,1,1,1,1,'330','2390756','Red . Mayor bomba Fiat 1600 ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'11.1.6','1'),(248,1,1,1,1,1,'331','R3320','Platina aluminio spring brake 30\" ( RG )',0.00,1.00,5,0,0,'','2013-05-15',NULL,'11.1.6','1'),(249,1,1,1,1,1,'332','','Platinas usadas ',0.00,1.00,5,0,0,'','2013-05-15',NULL,'11.1.6','1'),(250,1,1,1,1,1,'11503409','','Diafragma de pulmon M.Benz ( Del punto 7 \" ) ( Frepilco ) ',0.00,1.00,36,0,0,'','2013-05-15',NULL,'11.2.2.','1'),(251,1,1,1,1,1,'234433','','Diafragma F-700 del . 5\" ( Frepilco ) ',0.00,1.00,14,0,0,'','2013-05-15',NULL,'11.2.2','1'),(252,1,1,1,1,1,'234362','','Diafragma Scania tras . 9\" ( Fergom - Frepilco ) ',0.00,1.00,34,0,0,'','2013-05-15',NULL,'11.2.2','1'),(253,1,1,1,1,1,'333','W388','Diafragma tristopt / wabco M.Benz 710 ( A disto ) 12\"',0.00,1.00,5,0,0,'','2013-05-15',NULL,'11.2.3','1'),(254,1,1,1,1,1,'334','F5291','Diafragma de pulmon M.Benz volteo 12\" ( Fergom ) ',0.00,1.00,40,0,0,'','2013-05-15',NULL,'11.2.3','1'),(255,1,1,1,1,1,'11504357','','Diafragma M.Benz del . 7\" ( Frepilco ) ',0.00,1.00,33,0,0,'','2013-05-15',NULL,'11.2.3','1'),(256,1,1,1,1,1,'897120526','','Diafragma Talco 20\"',0.00,1.00,24,0,0,'','2013-05-15',NULL,'11.2.3, 1','1'),(257,1,1,1,1,1,'234189','36004','Diafragma Ford 900 del . 6\" ( Metalgum )',0.00,1.00,1,0,0,'','2013-05-15',NULL,'11.2.3','1'),(258,1,1,1,1,1,'234226','','Diafragma de freno ( Frepiloco ) ',0.00,1.00,4,0,0,'','2013-05-15',NULL,'11.2.3','1'),(259,1,1,1,1,1,'483826','483826 I','Fexible izquierdo ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'11.2.4','1'),(260,1,1,1,1,1,'349542','','Flexible Peugeot 306',0.00,1.00,1,0,0,'','2013-05-15',NULL,'11.2.4','1'),(261,1,1,1,1,1,'41028','','Fexible Peugeot 404 ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'11.2.4','1'),(262,1,1,1,1,1,'72153','','Fexible Peugeot 504 ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'11.2.4','1'),(263,1,1,1,1,1,'74813','','Fexible Peugeot 404 ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'11.2.4','1'),(264,1,1,1,1,1,'100044','','Fexible M.Benz 1213',0.00,1.00,1,0,0,'','2013-05-15',NULL,'11.2.4','1'),(265,1,1,1,1,1,'35941','','Fexible M.Benz 1114 ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'11.2.4','1'),(266,1,1,1,1,1,'336','','Fexible M.Benz 180 ( Trasero ) ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'11.2.4','1'),(267,1,1,1,1,1,'337','','Fexible Dogge ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'11.2.4','1'),(268,1,1,1,1,1,'8971216104','','Diafragma 142 ( Pando - Frepilco ) ',0.00,1.00,11,0,0,'','2013-05-15',NULL,'11.1.3','1'),(269,1,1,1,1,1,'8971205054','897120505-4','Diafragma voteo 12\" ( Profundo ) ',0.00,1.00,41,0,0,'','2013-05-15',NULL,'11.2.3','1'),(270,1,1,1,1,1,'1362','R1362','Diafragma master 30\" ( Spring brake ) RG',0.00,1.00,59,0,0,'','2013-05-15',NULL,'11.3.2','1'),(271,1,1,1,1,1,'335','6060009','Jgo Freno de mano ( der . ) ( sistema tensa - chaj? ) ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'11.2.6','1'),(272,1,1,1,1,1,'6060010','6060010','Jgo Freno de mano ( Izq . ) ( sistema tensa - chaj? ) ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'11.2.6','1'),(273,1,1,1,1,1,'338','','Freno de mano M.Benz 608 ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'11.2.6','1'),(274,1,1,1,1,1,'339','','Freno de mano ',0.00,1.00,4,0,0,'','2013-05-15',NULL,'11.2.6','1'),(275,1,1,1,1,1,'340','','Freno de mano ( usado ) ',0.00,1.00,5,0,0,'','2013-05-15',NULL,'11.2.7','1'),(276,1,1,1,1,1,'341','','Kit Freno de mano M.Benz 710 ( Usado ) ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'11.2.7','1'),(277,1,1,1,1,1,'342','K1024','Kit de resorte M.Benz 710 ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'11.2.7','1'),(278,1,1,1,1,1,'343','','Repuestos freno de mano ( Usado ) ',0.00,1.00,80,0,0,'','2013-05-15',NULL,'11.2.7','1'),(279,1,1,1,1,1,'344','','Servo Toyota reparado ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'11.3.1','1'),(280,1,1,1,1,1,'345','','Rep. Servo Peugeot ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'11.3.1','1'),(281,1,1,1,1,1,'346','','Servo reparado R-11 ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'11.3.1','1'),(282,1,1,1,1,1,'347','','Servo reparado Fiat',0.00,1.00,1,0,0,'','2013-05-15',NULL,'11.3.1','1'),(283,1,1,1,1,1,'348','','Servo sierra ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'11.3.1','1'),(284,1,1,1,1,1,'349','','Servo Renoult ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'11.3.1','1'),(285,1,1,1,1,1,'2341012','234101/2','Diafragma ( Fergom ) ',0.00,1.00,14,0,0,'','2013-05-15',NULL,'11.3.2','1'),(286,1,1,1,1,1,'2341011','234101/1','Diafragma de freno ( Random )',0.00,1.00,37,0,0,'','2013-05-15',NULL,'11.3.2','1'),(287,1,1,1,1,1,'200611','','Tornillo estractor ( Cabeza doble ) ',0.00,1.00,38,0,0,'','2013-05-15',NULL,'11.3.4','1'),(288,1,1,1,1,1,'350','W3350','Bul?n retraccion tristopt ( Wabco ) ',0.00,1.00,11,0,0,'','2013-05-15',NULL,'11.3.4','1'),(289,1,1,1,1,1,'2006110','','Tornillo estractor ( Cabeza triple ) ',0.00,1.00,24,0,0,'','2013-05-15',NULL,'11.3.4','1'),(290,1,1,1,1,1,'100907','','Tapon valvul? gobernador ',0.00,1.00,20,0,0,'','2013-05-15',NULL,'11.3.4','1'),(291,1,1,1,1,1,'6018','','Tapa de bomba ',0.00,1.00,18,0,0,'','2013-05-15',NULL,'11.3.5','1'),(292,1,1,1,1,1,'1089','','Reten de servo M.Benz ',0.00,1.00,11,0,0,'','2013-05-15',NULL,'11.3.5','1'),(293,1,1,1,1,1,'351','R4130','Piston y buje reforma servo ( M.Benz 1114 ) ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'11.3.5','1'),(294,1,1,1,1,1,'1074','','Reten delantero Fiat 600 ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'11.3.5','1'),(295,1,1,1,1,1,'352','1875','Reten M.Benz 608',0.00,1.00,1,0,0,'','2013-05-15',NULL,'11.3.5','1'),(296,1,1,1,1,1,'353','1541R/1','Partes de reparacion de servo ',0.00,1.00,10,0,0,'','2013-05-15',NULL,'11.3.5','1'),(297,1,1,1,1,1,'354','R4110','Reparacion servo M.Benz ',0.00,1.00,4,0,0,'','2013-05-15',NULL,'11.3.5','1'),(298,1,1,1,1,1,'1360','R1360','Diafragma 30\" ( RG ) ',0.00,1.00,84,0,0,'','2013-05-15',NULL,'11.3.2','1'),(299,1,1,1,1,1,'234099','','Diafragma M.Benz del .6 1/2 \"',0.00,1.00,46,0,0,'','2013-05-15',NULL,'11.4.2','1'),(300,1,1,1,1,1,'201292','','Arandela tope leva ',0.00,1.00,120,0,0,'','2013-05-15',NULL,'11.4.4','1'),(301,1,1,1,1,1,'201287','','Arandela espaciadora ',0.00,1.00,140,0,0,'','2013-05-15',NULL,'11.4.4.','1'),(302,1,1,1,1,1,'101801','','Reparacion acople Fiat ',0.00,1.00,17,0,0,'','2013-05-15',NULL,'11.4.4','1'),(303,1,1,1,1,1,'103101','','Rep . Menor valvul? 2 lineas ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'11.4.4','1'),(304,1,1,1,1,1,'100511','','Rep. Valvul? descarga rapida ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'11.4.4','1'),(305,1,1,1,1,1,'100451','','Reperacion ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'11.4.4','1'),(306,1,1,1,1,1,'103201','','Jgo de rep . Valvul? relay ( Modelo nuevo ) ',0.00,1.00,4,0,0,'','2013-05-15',NULL,'11.4.4','1'),(307,1,1,1,1,1,'100301','','Rep . Menor valvul? relay c/em . 2 lineas ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'11.4.4','1'),(308,1,1,1,1,1,'87120520420','Frepilco ','Diafragma original',0.00,1.00,8,0,0,'','2013-05-15',NULL,'10.1.2','1'),(309,1,1,1,1,1,'5352','535/2 ','Diafragma ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'10.1.2','1'),(310,1,1,1,1,1,'531914','53191-4','Diafragma ',0.00,1.00,8,0,0,'','2013-05-15',NULL,'10.1.2','1'),(311,1,1,1,1,1,'8971216104','','Diafragma M.Benz volteo 14\" ',0.00,1.00,22,0,0,'','2013-05-15',NULL,'10.1.2','1'),(312,1,1,1,1,1,'355','','Diafragma reforzado 30\" ',0.00,1.00,4,0,0,'','2013-05-15',NULL,'10.1.2','1'),(313,1,1,1,1,1,'2498','','Diagrafma servo freno ',0.00,1.00,4,0,0,'','2013-05-15',NULL,'10.1.3','1'),(314,1,1,1,1,1,'2062','','Diafragma corrugado ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'10.1.3','1'),(315,1,1,1,1,1,'9365','','Diafragma siervo Peugeot 404 -Fiat 128 - F-100 ',0.00,1.00,3,0,0,'','2013-05-15',NULL,'10.1.3','1'),(316,1,1,1,1,1,'2402696','2402696','Diafragma Mvac 225 ',0.00,1.00,16,0,0,'','2013-05-15',NULL,'10.1.3','1'),(317,1,1,1,1,1,'10032','','Diagfragma siervo circuito simple ',0.00,1.00,3,0,0,'','2013-05-15',NULL,'10.1.3','1'),(318,1,1,1,1,1,'356','2402354','Diafragma de servo 6\"',0.00,1.00,2,0,0,'','2013-05-15',NULL,'10.1.3','1'),(319,1,1,1,1,1,'2402659','2402659','Diafragma MVAC 6\" S',0.00,1.00,2,0,0,'','2013-05-15',NULL,'10.1.3','1'),(320,1,1,1,1,1,'2402901','2402901','Diafragma de servo  ',0.00,1.00,3,0,0,'','2013-05-15',NULL,'10.1.3','1'),(321,1,1,1,1,1,'2402352','2402352','Diafragma MVAC 6\" delantero ',0.00,1.00,5,0,0,'','2013-05-15',NULL,'10.1.3','1'),(322,1,1,1,1,1,'2400946','2400946','Diafragma MVAC 8\" S',0.00,1.00,10,0,0,'','2013-05-15',NULL,'10.1.4','1'),(323,1,1,1,1,1,'2405317','','Clavo patin F-100 , C-10 ',0.00,1.00,43,0,0,'','2013-05-15',NULL,'10.1.4','1'),(324,1,1,1,1,1,'479','','Conjutno de anclaje Chevrolet - Dogge ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'10.1.4','1'),(325,1,1,1,1,1,'572','','Clavo patin plato F.608',0.00,1.00,41,0,0,'','2013-05-15',NULL,'10.1.4','1'),(326,1,1,1,1,1,'200305','','Brida pulmon 3629\" ',0.00,1.00,8,0,0,'','2013-05-15',NULL,'10.1.5','1'),(327,1,1,1,1,1,'200303','','Resorte de pulmon ',0.00,1.00,60,0,0,'','2013-05-15',NULL,'10.1.6','1'),(328,1,1,1,1,1,'358','','Placa de compresor ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'10.2.1','1'),(329,1,1,1,1,1,'359','','Placa de compresor usada ',0.00,1.00,5,0,0,'','2013-05-15',NULL,'10.2.1','1'),(330,1,1,1,1,1,'360','','Tapa de compresor ( Usada ) ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'10.2.1','1'),(331,1,1,1,1,1,'361','W1388','Diafragma tristopt wabco ',0.00,1.00,5,0,0,'','2013-05-15',NULL,'10.2.2','1'),(332,1,1,1,1,1,'201271','','Diafragma de pulmon',0.00,1.00,8,0,0,'','2013-05-15',NULL,'10.2.2','1'),(333,1,1,1,1,1,'100033','','Diafragma de pulmon wagner ',0.00,1.00,4,0,0,'','2013-05-15',NULL,'10.2.2','1'),(334,1,1,1,1,1,'897120535','','Diafragma de pulmon ',0.00,1.00,10,0,0,'','2013-05-15',NULL,'10.2.2','1'),(335,1,1,1,1,1,'8078','','Rep . Mordaza Ford ',0.00,1.00,3,0,0,'','2013-05-15',NULL,'10.2.3','1'),(336,1,1,1,1,1,'362','RC301','Rep. Caliper Renault trafic ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'10.2.3','1'),(337,1,1,1,1,1,'363','36','Rep. Caliper  ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'10.2.3','1'),(338,1,1,1,1,1,'364','7853','Rep. Caliper R-12 ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'10.2.3','1'),(339,1,1,1,1,1,'15051','','Jgo rep. Mordaza ',0.00,1.00,6,0,0,'','2013-05-15',NULL,'10.2.3','1'),(340,1,1,1,1,1,'9652','','Rep. Caliper ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'10.2.3','1'),(341,1,1,1,1,1,'357','3428001','Rep. Menor pinza tensa Dodge 1500 ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'10.2.3','1'),(342,1,1,1,1,1,'365','9128','Rep. Caliper Iveco daily ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'10.2.3','1'),(343,1,1,1,1,1,'366','22155','Jgo de fuelles Ford Escort ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'10.2.3','1'),(344,1,1,1,1,1,'367','3428059','Rep. Caliper Fiat uno ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'10.2.3','1'),(345,1,1,1,1,1,'9267','','Rep. Caliper ',0.00,1.00,8,0,0,'','2013-05-15',NULL,'10.2.3','1'),(346,1,1,1,1,1,'91156','','Rep . Mordaza  ',0.00,1.00,4,0,0,'','2013-05-15',NULL,'10.2.3','1'),(347,1,1,1,1,1,'3428061','3428061','Rep. Mordaza ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'10.2.3','1'),(348,1,1,1,1,1,'2406000','2406000','Jgo rep. Mordaza ',0.00,1.00,150,0,0,'','2013-05-15',NULL,'10.2.4','1'),(349,1,1,1,1,1,'3428062','3428062','Rep. Mordaza ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'10.2.4','1'),(350,1,1,1,1,1,'9652','','Rep. Caliper',0.00,1.00,1,0,0,'','2013-05-15',NULL,'10.2.4','1'),(351,1,1,1,1,1,'3027','','Rep. Caliper ',0.00,1.00,4,0,0,'','2013-05-15',NULL,'10.2.4','1'),(352,1,1,1,1,1,'3008','','Jgo rep. Caliper ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'10.2.4','1'),(353,1,1,1,1,1,'2408625','2408625','Rep. Mordaza ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'10.2.4','1'),(354,1,1,1,1,1,'368','','Rep. Caliper Toyota ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'10.2.4','1'),(355,1,1,1,1,1,'4090','','Rep. Mordaza ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'10.2.4','1'),(356,1,1,1,1,1,'9526','','Rep. Mordaza ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'10.1.4','1'),(357,1,1,1,1,1,'2391115','','Rep. Menor mordaza VW Gasel ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'10.2.4','1'),(358,1,1,1,1,1,'369','1558','Rep. Cilindro golf',0.00,1.00,2,0,0,'','2013-05-15',NULL,'10.2.4','1'),(359,1,1,1,1,1,'499','','Cablo patin completo',0.00,1.00,28,0,0,'','2013-05-15',NULL,'10.2.5','1'),(360,1,1,1,1,1,'284','','Regulador Chevrolet-Ford-Dogde',0.00,1.00,5,0,0,'','2013-05-15',NULL,'10.2.5','1'),(361,1,1,1,1,1,'572','','Clavo patin plato',0.00,1.00,39,0,0,'','2013-05-15',NULL,'10.2.5','1'),(362,1,1,1,1,1,'2791','279/1','Regulador de freno',0.00,1.00,5,0,0,'','2013-05-15',NULL,'10.2.5','1'),(363,1,1,1,1,1,'370','R3520','Bastajo empuje servo super',0.00,1.00,7,0,0,'','2013-05-15',NULL,'10.2.5','1'),(364,1,1,1,1,1,'371','R-453','Rep. Tapa compresor',0.00,1.00,20,0,0,'','2013-05-15',NULL,'10.2.5','1'),(365,1,1,1,1,1,'372','','Repuestos varios',0.00,1.00,40,0,0,'','2013-05-15',NULL,'10.2.6','1'),(366,1,1,1,1,1,'373','','Reguladores',0.00,1.00,30,0,0,'','2013-05-15',NULL,'10.2.6','1'),(367,1,1,1,1,1,'101501','','Rep. Menor valvula reguladora M.benz 1517',0.00,1.00,1,0,0,'','2013-05-15',NULL,'10.2.6','1'),(368,1,1,1,1,1,'101503','','Rep. Menor valvula Gobernadora modelo nuevo',0.00,1.00,5,0,0,'','2013-05-15',NULL,'10.2.6','1'),(369,1,1,1,1,1,'101502','','Rep. Intermedio Valvula Gobernadora M. Berz 1517',0.00,1.00,2,0,0,'','2013-05-15',NULL,'10.2.6','1'),(370,1,1,1,1,1,'207100','207100/S','Tapa de pulmon superior',0.00,1.00,12,0,0,'','2013-05-15',NULL,'10.2.7','1'),(371,1,1,1,1,1,'203100','200302','Platina vastago corto',0.00,1.00,7,0,0,'','2013-05-15',NULL,'10.2.7','1'),(372,1,1,1,1,1,'204100','','Platina Vastago largo',0.00,1.00,11,0,0,'','2013-05-15',NULL,'10.2.7','1'),(373,1,1,1,1,1,'66661','6666/1','Valvula de Alta tension 1\"',0.00,1.00,61,0,0,'','2013-05-15',NULL,'10.3.2','1'),(374,1,1,1,1,1,'374','','O?ring Servo M. Benz 608',0.00,1.00,13,0,0,'','2013-05-15',NULL,'10.3.2','1'),(375,1,1,1,1,1,'2969','','Asiento de valvula Liso',0.00,1.00,20,0,0,'','2013-05-15',NULL,'10.3.2','1'),(376,1,1,1,1,1,'15800','','Valvula de bomba tipo M. Benz',0.00,1.00,1,0,0,'','2013-05-15',NULL,'10.3.3','1'),(377,1,1,1,1,1,'11432','','Valvula Retencion 1\"',0.00,1.00,8,0,0,'','2013-05-15',NULL,'10.3.3','1'),(378,1,1,1,1,1,'375','R-66','Hongo de pedalera',0.00,1.00,14,0,0,'','2013-05-15',NULL,'10.3.3','1'),(379,1,1,1,1,1,'2112','','Juego Aros sell. V/pedalera knorr M. Benz',0.00,1.00,2,0,0,'','2013-05-15',NULL,'10.3.3','1'),(380,1,1,1,1,1,'376','521','Placa guia de freno',0.00,1.00,8,0,0,'','2013-05-15',NULL,'10.3.4','1'),(381,1,1,1,1,1,'2115','','Rep. Antiruido Caliper',0.00,1.00,14,0,0,'','2013-05-15',NULL,'10.3.4','1'),(382,1,1,1,1,1,'5752','575/2','Empuje para cilindro rueda del.f 250/350',0.00,1.00,19,0,0,'','2013-05-15',NULL,'10.3.4','1'),(383,1,1,1,1,1,'0748','','Reten servo (silvania)',0.00,1.00,2,0,0,'','2013-05-15',NULL,'10.3.4','1'),(384,1,1,1,1,1,'2101','210/1','Empuje P/cilindro rueda Ford-Chev.',0.00,1.00,10,0,0,'','2013-05-15',NULL,'10.3.4','1'),(385,1,1,1,1,1,'779','','Placa guia patin Faerlan',0.00,1.00,19,0,0,'','2013-05-15',NULL,'10.3.4','1'),(386,1,1,1,1,1,'11432','','Valvula retencion 1 1/16\"',0.00,1.00,9,0,0,'','2013-05-15',NULL,'10.3.4','1'),(387,1,1,1,1,1,'935','','Clip Elaspast C 20/D 20/F-100',0.00,1.00,17,0,0,'','2013-05-15',NULL,'10.3.4','1'),(388,1,1,1,1,1,'3077','','Rep. Caliper',0.00,1.00,1,0,0,'','2013-05-15',NULL,'10.3.5','1'),(389,1,1,1,1,1,'377','DMB087','Nucleo de regulacion ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'10.3.5','1'),(390,1,1,1,1,1,'40704','4070/4','Bulon estreado de reg. Cal M.Benz/Scania',0.00,1.00,3,0,0,'','2013-05-15',NULL,'10.3.5','1'),(391,1,1,1,1,1,'40701','4070/1','Kit Bulon fijador Cal. M.Benz-Scania',0.00,1.00,2,0,0,'','2013-05-15',NULL,'10.3.5','1'),(392,1,1,1,1,1,'40702','4070/2','Bujes de guias P/pernos Caliper',0.00,1.00,2,0,0,'','2013-05-15',NULL,'10.3.5','1'),(393,1,1,1,1,1,'40703','4070/3','Buje interno P/Cal.M. Benz - Scania',0.00,1.00,2,0,0,'','2013-05-15',NULL,'10.3.5','1'),(394,1,1,1,1,1,'378','T8160','Cadena de Caliper M. Benz knorr',0.00,1.00,2,0,0,'','2013-05-15',NULL,'10.3.5','1'),(395,1,1,1,1,1,'379','T8110','Juego Piston y guard. Caliper Knorr',0.00,1.00,1,0,0,'','2013-05-15',NULL,'10.3.5','1'),(396,1,1,1,1,1,'380','R6210','Juego paletas de depresor chicas',0.00,1.00,2,0,0,'','2013-05-15',NULL,'10.3.6','1'),(397,1,1,1,1,1,'60800','','Juego Rep. Servo reforma M. Benz',0.00,1.00,3,0,0,'','2013-05-15',NULL,'10.3.6','1'),(398,1,1,1,1,1,'4070','','Rep. de Mordaza ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'10.3.6','1'),(399,1,1,1,1,1,'3338204','3338204','Rep. Mayor bomba doble',0.00,1.00,3,0,0,'','2013-05-15',NULL,'10.3.6','1'),(400,1,1,1,1,1,'780','R-3600','Valvula de drenaje',0.00,1.00,10,0,0,'','2013-05-15',NULL,'10.3.7','1'),(401,1,1,1,1,1,'781','R4300','Conexion union dible corta M.Benz',0.00,1.00,2,0,0,'','2013-05-15',NULL,'10.3.7','1'),(402,1,1,1,1,1,'782','R4310','Conexion larga M. Benz',0.00,1.00,14,0,0,'','2013-05-15',NULL,'10.3.7','1'),(403,1,1,1,1,1,'209002','209-002','Union gobernadora M.Benz 22 x 1/2\"',0.00,1.00,1,0,0,'','2013-05-15',NULL,'10.3.7','1'),(404,1,1,1,1,1,'783','','Cilindros de piston',0.00,1.00,50,0,0,'','2013-05-15',NULL,'10.3.7','1'),(405,1,1,1,1,1,'13060','','Rep. Valvula de seguridad',0.00,1.00,4,0,0,'','2013-05-15',NULL,'10.3.7','1'),(406,1,1,1,1,1,'784','','Depositos de liquido de freno',0.00,1.00,30,0,0,'','2013-05-15',NULL,'10.4.1','1'),(407,1,1,1,1,1,'785','','Repuestos Compresor',0.00,1.00,4,0,0,'','2013-05-15',NULL,'10.4.1','1'),(408,1,1,1,1,1,'786','','Deposito de valvula de freno Ford 608',0.00,1.00,1,0,0,'','2013-05-15',NULL,'10.4.2','1'),(409,1,1,1,1,1,'2341001','234100-R','Diafragma reforzado',0.00,1.00,13,0,0,'','2013-05-15',NULL,'10.4.2','1'),(410,1,1,1,1,1,'787','','Cilindro Servo super C-60- ford 600',0.00,1.00,1,0,0,'','2013-05-15',NULL,'10.3.7','1'),(411,1,1,1,1,1,'2122489','2122489','Valvula de retencion ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'10.4.3','1'),(412,1,1,1,1,1,'2406934','2406934','Valvula atmosferica',0.00,1.00,3,0,0,'','2013-05-15',NULL,'10.4.3','1'),(413,1,1,1,1,1,'2122488','2122488','Valvula de retencion ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'10.4.3','1'),(414,1,1,1,1,1,'788','43666W.L.','Cubeta secundaria de bomba 13/16\" Citroen-Fiat-Peugeot',0.00,1.00,30,0,0,'','2013-05-15',NULL,'10.4.3','1'),(415,1,1,1,1,1,'2120048','2120048','Vavula de retencion ',0.00,1.00,20,0,0,'','2013-05-15',NULL,'10.4.3','1'),(416,1,1,1,1,1,'2400031','2400031','Tapon de plato de freno',0.00,1.00,10,0,0,'','2013-05-15',NULL,'10.4.3','1'),(417,1,1,1,1,1,'2372','','Sello de goma ',0.00,1.00,4,0,0,'','2013-05-15',NULL,'10.4.3','1'),(418,1,1,1,1,1,'11432','','Valvula de retencion 1\"',0.00,1.00,1,0,0,'','2013-05-15',NULL,'10.4.3','1'),(419,1,1,1,1,1,'29691','2969-1','Asiento de valvula 1\"',0.00,1.00,10,0,0,'','2013-05-15',NULL,'10.4.3','1'),(420,1,1,1,1,1,'2129484','2129484','Valvula Retencion ',0.00,1.00,8,0,0,'','2013-05-15',NULL,'10.4.3','1'),(421,1,1,1,1,1,'2402066','240,2066','Piston hidraulico',0.00,1.00,3,0,0,'','2013-05-15',NULL,'10.4.3','1'),(422,1,1,1,1,1,'789','R3271','Juego rep. Cuerpo interno S. Brake',0.00,1.00,5,0,0,'','2013-05-15',NULL,'10.4.5','1'),(423,1,1,1,1,1,'201273','','Rep. Pulmon Sprig',0.00,1.00,5,0,0,'','2013-05-15',NULL,'10.4.5','1'),(424,1,1,1,1,1,'790','R-3270','Juego rep. Cuerpo Intermedio Spring',0.00,1.00,11,0,0,'','2013-05-15',NULL,'10.4.5','1'),(425,1,1,1,1,1,'791','','Seguros Segger ',0.00,1.00,40,0,0,'','2013-05-15',NULL,'10.4.5','1'),(426,1,1,1,1,1,'1015011','101501-1','Rep. Caliper 504-505',0.00,1.00,1,0,0,'','2013-05-15',NULL,'10.4.7','1'),(427,1,1,1,1,1,'1015012','101501-2','Rep, Caliper Isuzu',0.00,1.00,1,0,0,'','2013-05-15',NULL,'10.4.7','1'),(428,1,1,1,1,1,'1015013','101501-3','Rep. Caliper Fiat (Piston 48mm)',0.00,1.00,1,0,0,'','2013-05-15',NULL,'10.4.7','1'),(429,1,1,1,1,1,'792','','Pistones varios',0.00,1.00,50,0,0,'','2013-05-15',NULL,'10.4.7','1'),(430,1,1,1,1,1,'793','W551','Juego Rep. Esta.tristopt Tipo wabco 30\"',0.00,1.00,3,0,0,'','2013-05-15',NULL,'16.1.1','1'),(431,1,1,1,1,1,'794','W0554','Juego Rep. Esta.tristopt Tipo wabco 24\"',0.00,1.00,6,0,0,'','2013-05-15',NULL,'16.1.1','1'),(432,1,1,1,1,1,'2520','Mayor','Juego Rep. Mayor (Cardi-Tristopt) Knorr 24\"',0.00,1.00,2,0,0,'','2013-05-15',NULL,'16.1.1','1'),(433,1,1,1,1,1,'2533','Mayor','Juego Rep. Mayor (Cardi-Tristopt) Knorr 30\"',0.00,1.00,4,0,0,'','2013-05-15',NULL,'16.1.1','1'),(434,1,1,1,1,1,'795','W0556','Rep. Pulmon wabco 16\"',0.00,1.00,3,0,0,'','2013-05-15',NULL,'16.1.1','1'),(435,1,1,1,1,1,'800','E6335','Rep. Pulmon Iveco Marelli 24\"',0.00,1.00,7,0,0,'','2013-05-15',NULL,'16.1.1','1'),(436,1,1,1,1,1,'16490089','','Rep. Compresor Knorr ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'16.1.1','1'),(437,1,1,1,1,1,'9111559212','155920','Flaper Compresor Wabco Ford',0.00,1.00,3,0,0,'','2013-05-15',NULL,'16.1.1','1'),(438,1,1,1,1,1,'412352002','501625','Piston Completo Compresor Wabco',0.00,1.00,4,0,0,'','2013-05-15',NULL,'16.1.1','1'),(439,1,1,1,1,1,'911539332','153933','Flaper Compresor M.Benz',0.00,1.00,2,0,0,'','2013-05-15',NULL,'16.1.1','1'),(440,1,1,1,1,1,'201718','','Oring de Rep. De Eje central',0.00,1.00,20,0,0,'','2013-05-15',NULL,'10.4.5','1'),(441,1,1,1,1,1,'9700519062','','Rep. Servo Embrajo Wabco ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'16.2.2','1'),(442,1,1,1,1,1,'796','W0555','Rep. Pulmon ',0.00,1.00,11,0,0,'','2013-05-15',NULL,'16.2.2','1'),(443,1,1,1,1,1,'2892','289-2','Rep. Pulmon RT ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'16.2.2','1'),(444,1,1,1,1,1,'797','W0557','Rep. Estacionamiento tristop 24\"',0.00,1.00,10,0,0,'','2013-05-15',NULL,'16.2.2','1'),(445,1,1,1,1,1,'798','W0558','Rep. Estacionamiento tristop 30\"',0.00,1.00,11,0,0,'','2013-05-15',NULL,'16.2.2','1'),(446,1,1,1,1,1,'365928','R7580','Rep. Spring tipo Knorr 24\"',0.00,1.00,6,0,0,'','2013-05-15',NULL,'16.2.2','1'),(447,1,1,1,1,1,'799','R7570','Rep. Spring Brake ',0.00,1.00,6,0,0,'','2013-05-15',NULL,'16.2.2','1'),(448,1,1,1,1,1,'8000','R7520','Rep. Mayor Spring',0.00,1.00,2,0,0,'','2013-05-15',NULL,'16.2.2','1'),(449,1,1,1,1,1,'8845032002','','Tapa Compresor Wabco',0.00,1.00,2,0,0,'','2013-05-15',NULL,'16.2.2','1'),(450,1,1,1,1,1,'801','R4530','Rep. Valvula Compresor M. Benz',0.00,1.00,10,0,0,'','2013-05-15',NULL,'16.2.2','1'),(451,1,1,1,1,1,'802','','Junta Compresor',0.00,1.00,10,0,0,'','2013-05-15',NULL,'16.2.2','1'),(452,1,1,1,1,1,'1657','B280','Rep. Servo Embraje',0.00,1.00,4,0,0,'','2013-05-15',NULL,'16.2.3','1'),(453,1,1,1,1,1,'550455','','Rep. Servo Embraje Scania',0.00,1.00,2,0,0,'','2013-05-15',NULL,'16.2.3','1'),(454,1,1,1,1,1,'70550','','Rep. Gobernadora Marelli',0.00,1.00,2,0,0,'','2013-05-15',NULL,'16.2.3','1'),(455,1,1,1,1,1,'9753000002','','Rep. Valvula Gobernadora Modelo Viejo',0.00,1.00,14,0,0,'','2013-05-15',NULL,'16.2.3','1'),(456,1,1,1,1,1,'9735000032','B320','Rep. Valvula descarga rapida Wabco',0.00,1.00,7,0,0,'','2013-05-15',NULL,'16.2.3','1'),(457,1,1,1,1,1,'925252','92525','Rep. Valvula suspension scania',0.00,1.00,4,0,0,'','2013-05-15',NULL,'16.2.3','1'),(458,1,1,1,1,1,'434014009','14009','Rep. Valvula Retension ',0.00,1.00,3,0,0,'','2013-05-15',NULL,'16.2.3','1'),(459,1,1,1,1,1,'4343000002','30000002','Rep. Valvula Drenaje Automatico Wabco',0.00,1.00,3,0,0,'','2013-05-15',NULL,'16.3.3','1'),(460,1,1,1,1,1,'9324000022','000022','Rep. Valvula Gobernadora APU Wabco',0.00,1.00,6,0,0,'','2013-05-15',NULL,'16.3.3','1'),(461,1,1,1,1,1,'9324000012','000012','Rep. Valvula Secadora Aire Wabco Original',0.00,1.00,6,0,0,'','2013-05-15',NULL,'16.4.3','1'),(462,1,1,1,1,1,'925325002','200022','Rep. Pulmon Wabco 6\"',0.00,1.00,3,0,0,'','2013-05-15',NULL,'16.4.4','1'),(463,1,1,1,1,1,'75043341','300012','Rep. Pulmon Wabco 6\" 30',0.00,1.00,6,0,0,'','2013-05-15',NULL,'16.4.4','1'),(464,1,1,1,1,1,'78700','','Reparacion',0.00,1.00,1,0,0,'','2013-05-15',NULL,'16.4.4','1'),(465,1,1,1,1,1,'7910','R-7910','Rep. Valvula Control Spring',0.00,1.00,6,0,0,'','2013-05-15',NULL,'16.4.4','1'),(466,1,1,1,1,1,'461704004','','Rep. Valvula Freno de Mano Wabco',0.00,1.00,6,0,0,'','2013-05-15',NULL,'16.4.4','1'),(467,1,1,1,1,1,'472900002','500080','Rep. Valvula Suspension Neumatica',0.00,1.00,3,0,0,'','2013-05-15',NULL,'16.4.4','1'),(468,1,1,1,1,1,'9617229032','961722903','Rep. Valvula freno de Mano ',0.00,1.00,3,0,0,'','2013-05-15',NULL,'16.4.4','1'),(469,1,1,1,1,1,'961723008','','Rep. Valvula freno de Mano ',0.00,1.00,10,0,0,'','2013-05-15',NULL,'16.4.4','1'),(470,1,1,1,1,1,'9617230092','','Rep. Valvula freno de Mano Doble',0.00,1.00,5,0,0,'','2013-05-15',NULL,'16.4.4','1'),(471,1,1,1,1,1,'961709012','90000','Rep. Valvula Remolque',0.00,1.00,6,0,0,'','2013-05-15',NULL,'16.4.4','1'),(472,1,1,1,1,1,'953200012','200012','Rep. Pulmon Wabco ABO Tipo F24\"',0.00,1.00,15,0,0,'','2013-05-15',NULL,'16.5.5','1'),(473,1,1,1,1,1,'145043356','','Rep. Pulmon  ',0.00,1.00,3,0,0,'','2013-05-15',NULL,'16.5.5','1'),(474,1,1,1,1,1,'3060','R-3060','Rep. Valvula F14000 Modelo nuevo ',0.00,1.00,6,0,0,'','2013-05-15',NULL,'16.5.5','1'),(475,1,1,1,1,1,'921052','1215','Rep. Pedalera Bosch Scania ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'16.5.5','1'),(476,1,1,1,1,1,'803','','Tapa guia Valvula Frepilco ',0.00,1.00,6,0,0,'','2013-05-15',NULL,'16.5.5','1'),(477,1,1,1,1,1,'9617010002','10002','Rep. Valvula estacionamiento siemple Wabco ',0.00,1.00,20,0,0,'','2013-05-15',NULL,'16.5.5','1'),(478,1,1,1,1,1,'9617229042','722904','Rep. Valvula estacionamiento doble ',0.00,1.00,5,0,0,'','2013-05-15',NULL,'16.5.5','1'),(479,1,1,1,1,1,'9617229022','220022','Rep. Valvula estacionamiento ',0.00,1.00,8,0,0,'','2013-05-15',NULL,'16.5.5','1'),(480,1,1,1,1,1,'9617220022','220022','Rep. Valvula estacionamiento simple ',0.00,1.00,11,0,0,'','2013-05-15',NULL,'16.5.5','1'),(481,1,1,1,1,1,'1655','1655','Rep. Pulmon ',0.00,1.00,4,0,0,'','2013-05-15',NULL,'16.6.6','1'),(482,1,1,1,1,1,'9700519172','','Rep. Servo ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'16.6.6','1'),(483,1,1,1,1,1,'758','R-758','Rep. Pulmon ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'16.6.6','1'),(484,1,1,1,1,1,'4613159132','150022','Rep. Valvula pedalera wabco ',0.00,1.00,0,0,0,'','2013-05-15',NULL,'16.6.6','1'),(485,1,1,1,1,1,'150072','150072','Rep. Valvula pedalera  ',0.00,1.00,10,0,0,'','2013-05-15',NULL,'16.6.6','1'),(486,1,1,1,1,1,'9730110032','110032','Rep. Valvula Relay chata ',0.00,1.00,8,0,0,'','2013-05-15',NULL,'16.6.6','1'),(487,1,1,1,1,1,'97300010042','10002','Rep. Valvula Relay ',0.00,1.00,9,0,0,'','2013-05-15',NULL,'16.6.6','1'),(488,1,1,1,1,1,'9347020062','','Rep. Valvula 4 vidas Modelo viejo ',0.00,1.00,9,0,0,'','2013-05-15',NULL,'16.6.6','1'),(489,1,1,1,1,1,'8845032592','32592','Rep. Valvula 4 vidas modelo nuevo ',0.00,1.00,4,0,0,'','2013-05-15',NULL,'16.6.6','1'),(490,1,1,1,1,1,'9347020042','20042','Rep. Valvula protectora 4 vidas',0.00,1.00,3,0,0,'','2013-05-15',NULL,'16.6.6','1'),(491,1,1,1,1,1,'804','','Jgo Cables ABS',0.00,1.00,3,0,0,'','2013-05-15',NULL,'16.7.7','1'),(492,1,1,1,1,1,'805','','Coronas ABS',0.00,1.00,16,0,0,'','2013-05-15',NULL,'16.7.7','1'),(493,1,1,1,1,1,'4613159072','159072','Rep. Valvula Scania seria 4 ',0.00,1.00,3,0,0,'','2013-05-15',NULL,'16.7.7','1'),(494,1,1,1,1,1,'4613159132','','Rep. Valvula pedalera wabco ',0.00,1.00,3,0,0,'','2013-05-15',NULL,'16.7.7','1'),(495,1,1,1,1,1,'140060002','60002','Rep. Valvula pedalera wabco ',0.00,1.00,3,0,0,'','2013-05-15',NULL,'16.7.7','1'),(496,1,1,1,1,1,'4757100012','100032/1','Rep. Valvula sensible a la carga ',0.00,1.00,12,0,0,'','2013-05-15',NULL,'16.7.7','1'),(497,1,1,1,1,1,'9730020042','2004','Rep. Valvula gobernadora ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'16.7.7','1'),(498,1,1,1,1,1,'9730020032','20032','Rer. Valvula distribuidora ',0.00,1.00,0,0,0,'','2013-05-15',NULL,'16.7.7','1'),(499,1,1,1,1,1,'6143','','Reparacion ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'16.7.7','1'),(500,1,1,1,1,1,'9347050012','5001-2','Rep. Valvula 6 vidas ',0.00,1.00,4,0,0,'','2013-05-15',NULL,'16.7.7','1'),(501,1,1,1,1,1,'9730090002','90002','Rep. Valvula distribuidora ',0.00,1.00,5,0,0,'','2013-05-15',NULL,'16.7.7','1'),(502,1,1,1,1,1,'1264','WOL1264','Reten acoplado salto ',0.00,1.00,4,0,0,'','2013-05-15',NULL,'19.3.3','1'),(503,1,1,1,1,1,'2713','','Reten Ford 14000 trasero ( Sabo ) ',0.00,1.00,8,0,0,'','2013-05-15',NULL,'19.1.1','1'),(504,1,1,1,1,1,'6160','DBH6160','Reten ',0.00,1.00,7,0,0,'','2013-05-15',NULL,'19.1.1','1'),(505,1,1,1,1,1,'2246','','Reten trasero Volvo 950/410',0.00,1.00,5,0,0,'','2013-05-15',NULL,'19.1.1','1'),(506,1,1,1,1,1,'11118','','Juntas randon ',0.00,1.00,26,0,0,'','2013-05-15',NULL,'19.1.1','1'),(507,1,1,1,1,1,'11119','','Juntas de corcho ',0.00,1.00,6,0,0,'','2013-05-15',NULL,'19.1.1','1'),(508,1,1,1,1,1,'806','','Reten ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'19.1.1','1'),(509,1,1,1,1,1,'824','TH0824','Reten trasero M.Benz 6600',0.00,1.00,5,0,0,'','2013-05-15',NULL,'19.1.1','1'),(510,1,1,1,1,1,'310','','Reten Rondon trasero ( Sabo ) ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'19.2.2','1'),(511,1,1,1,1,1,'1340','TH01340','Reten trasero externo Fiat 619 ',0.00,1.00,7,0,0,'','2013-05-15',NULL,'19.2.2','1'),(512,1,1,1,1,1,'547','TH0547','Reten acoplado Golondrina ',0.00,1.00,8,0,0,'','2013-05-15',NULL,'19.2.2','1'),(513,1,1,1,1,1,'1225','TH1225','Reten Helvetica ( Artillera ) ',0.00,1.00,9,0,0,'','2013-05-15',NULL,'19.2.2','1'),(514,1,1,1,1,1,'377','TH0377-5919DBH-W0272','Reten Helvetica ',0.00,1.00,4,0,0,'','2013-05-15',NULL,'19.2.2','1'),(515,1,1,1,1,1,'498','TH0498','Reten Helvetica M-70 ',0.00,1.00,6,0,0,'','2013-05-15',NULL,'19.3.3','1'),(516,1,1,1,1,1,'1832','th1832','Reten rueda Helvetica 8\" ( Nuevo ) ',0.00,1.00,4,0,0,'','2013-05-15',NULL,'19.3.3','1'),(517,1,1,1,1,1,'1184','W01184-S04302','Reten acoplado ( Montenegro , Golondrina , Maldonado , etc. .) Ba?o de aceite ',0.00,1.00,8,0,0,'','2013-05-15',NULL,'19.3.3','1'),(518,1,1,1,1,1,'7281','TH01829','Reten trasero Scania 113',0.00,1.00,2,0,0,'','2013-05-15',NULL,'19.3.3','1'),(519,1,1,1,1,1,'7312','T02004','Reten delantero Scania 112',0.00,1.00,7,0,0,'','2013-05-15',NULL,'19.3.3','1'),(520,1,1,1,1,1,'2093','','Reten trasero Scania 101/111/112/141/142',0.00,1.00,3,0,0,'','2013-05-15',NULL,'19.4.4','1'),(521,1,1,1,1,1,'445','TH0445','Reten delantero Scania 113 ',0.00,1.00,9,0,0,'','2013-05-15',NULL,'19.4.4','1'),(522,1,1,1,1,1,'1780','TH1780','Reten rueda acoplado Astilla ',0.00,1.00,6,0,0,'','2013-05-15',NULL,'19.4.4','1'),(523,1,1,1,1,1,'5463','SO7919','Reten delantero Volvo ',0.00,1.00,7,0,0,'','2013-05-15',NULL,'19.4.4','1'),(524,1,1,1,1,1,'2434','O\'RING GRANDE ','O\'RING GRANDE ',0.00,1.00,0,0,0,'','2013-05-15',NULL,'19.4.4','1'),(525,1,1,1,1,1,'9466','DBH9466','Reten delantero volvo ',0.00,1.00,4,0,0,'','2013-05-15',NULL,'19.4.4','1'),(526,1,1,1,1,1,'2072','294','Reten delantero ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'19.4.4','1'),(527,1,1,1,1,1,'9279','','Reten pista Randon ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'19.5.5','1'),(528,1,1,1,1,1,'1740','','Reten ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'19.5.5','1'),(529,1,1,1,1,1,'816','','Reten ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'19.5.5','1'),(530,1,1,1,1,1,'817','','Reten ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'19.5.5','1'),(531,1,1,1,1,1,'8171','','Reten de Paliar ',0.00,1.00,3,0,0,'','2013-05-15',NULL,'19.5.5','1'),(532,1,1,1,1,1,'269','SO0269-TH1736','Reten Scania 112 - 113 ',0.00,1.00,6,0,0,'','2013-05-15',NULL,'19.5.5','1'),(533,1,1,1,1,1,'463','','Reten Montenrego ',0.00,1.00,8,0,0,'','2013-05-15',NULL,'19.5.5','1'),(534,1,1,1,1,1,'1206','R-2130','Rep. Valvula estacionamiento AD',0.00,1.00,4,0,0,'','2013-05-15',NULL,'17.1.1','1'),(535,1,1,1,1,1,'2180','2180','Rep. Valvula freno de mano simple Knorr D',0.00,1.00,10,0,0,'','2013-05-15',NULL,'17.1.1','1'),(536,1,1,1,1,1,'5126','5126','Rep. Valvula pedalera Scania 111/ 116 AD',0.00,1.00,3,0,0,'','2013-05-15',NULL,'17.1.1','1'),(537,1,1,1,1,1,'102920','102920','Rep. Valvula descarga Aut . Mayor ',0.00,1.00,10,0,0,'','2013-05-15',NULL,'17.1.1','1'),(538,1,1,1,1,1,'2145','2145','Rep. Valvula relay Knorr ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'17.1.1','1'),(539,1,1,1,1,1,'6145','6145','Rep. Valvula relay Fiat Iveco ',0.00,1.00,5,0,0,'','2013-05-15',NULL,'17.1.1','1'),(540,1,1,1,1,1,'807','538-C','Rep. Valvula drenaje parcial P/Despurgue',0.00,1.00,4,0,0,'','2013-05-15',NULL,'17.2.2','1'),(541,1,1,1,1,1,'1171','1171','Rep. Valvula AD',0.00,1.00,1,0,0,'','2013-05-15',NULL,'17.2.2','1'),(542,1,1,1,1,1,'1180','1180','Rep. Valvula AD',0.00,1.00,1,0,0,'','2013-05-15',NULL,'17.2.2','1'),(543,1,1,1,1,1,'3715','3715','Rep. Servo Embrague Gaudi',0.00,1.00,5,0,0,'','2013-05-15',NULL,'17.2.2','1'),(544,1,1,1,1,1,'1181','1181','Rep. Valvula simpple wabco',0.00,1.00,10,0,0,'','2013-05-15',NULL,'17.2.2','1'),(545,1,1,1,1,1,'2891','B289','Rep. Valvula servo embrague Grau RT',0.00,1.00,7,0,0,'','2013-05-15',NULL,'17.2.2','1'),(546,1,1,1,1,1,'808','R-4695','Rep. Valvula limitadora Aut . RG',0.00,1.00,2,0,0,'','2013-05-15',NULL,'17.2.2','1'),(547,1,1,1,1,1,'809','R-5790','Rep. Valvula gobernadora ',0.00,1.00,3,0,0,'','2013-05-15',NULL,'17.2.2','1'),(548,1,1,1,1,1,'810','R-4663','Rep. Valvula sobre carga',0.00,1.00,4,0,0,'','2013-05-15',NULL,'17.2.2','1'),(549,1,1,1,1,1,'811','R-2130','Rep. Valvula de comando ',0.00,1.00,6,0,0,'','2013-05-15',NULL,'17.2.2','1'),(550,1,1,1,1,1,'51660','516-60','Rep. Boton estacionamiento triller ',0.00,1.00,3,0,0,'','2013-05-15',NULL,'17.2.2','1'),(551,1,1,1,1,1,'1130','','Rep. valvula gobernadora AD',0.00,1.00,13,0,0,'','2013-05-15',NULL,'17.2.2','1'),(552,1,1,1,1,1,'11005','','Rep. Guia de valvula',0.00,1.00,1,0,0,'','2013-05-15',NULL,'17.5.5','1'),(553,1,1,1,1,1,'5371','537B','Rep. Valvula despurgue Aut .',0.00,1.00,2,0,0,'','2013-05-15',NULL,'17.3.3','1'),(554,1,1,1,1,1,'812','532-C','Rep. Valvula control de preci?n ',0.00,1.00,11,0,0,'','2013-05-15',NULL,'17.3.3','1'),(555,1,1,1,1,1,'813','R2410','Rep. Valvula relay Bendix ',0.00,1.00,4,0,0,'','2013-05-15',NULL,'17.3.3','1'),(556,1,1,1,1,1,'814','W6015','Rep. Valvula suspension ',0.00,1.00,9,0,0,'','2013-05-15',NULL,'17.3.3','1'),(557,1,1,1,1,1,'815','B385','Rep. Valvula distribuidora Cardi ( 6224 ) ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'17.3.3','1'),(558,1,1,1,1,1,'5151','5151','Rep. Valvula relay Marelli ',0.00,1.00,3,0,0,'','2013-05-15',NULL,'17.3.3','1'),(559,1,1,1,1,1,'2170','2170','Rep. Valvula doble manual Knorr ',0.00,1.00,8,0,0,'','2013-05-15',NULL,'17.3.3','1'),(560,1,1,1,1,1,'424931597','KR7170','Rep. Servo Iveco ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'17.3.3','1'),(561,1,1,1,1,1,'580','580-C','Rep. Valvula control Spring ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'17.3.3','1'),(562,1,1,1,1,1,'2000','2000','Rep. Valvula Gobernadora Knorr ',0.00,1.00,20,0,0,'','2013-05-15',NULL,'17.3.3','1'),(563,1,1,1,1,1,'00081','2483','Reten 12- D400 - F350 ( Sabo ) ',0.00,1.00,3,0,0,'','2013-05-15',NULL,'19.5.5','1'),(564,1,1,1,1,1,'02324','','Reten delantero Scani 140 / 141 / K 111',0.00,1.00,2,0,0,'','2013-05-15',NULL,'19.5.5','1'),(565,1,1,1,1,1,'01740','','Reten M.Benz (11 / 13 / 15 / 22 / 23 Toneladas )',0.00,1.00,8,0,0,'','2013-05-15',NULL,'19.5.5','1'),(566,1,1,1,1,1,'9263','0603-DBH9263-AVS10340','Reten delantero Ford 14000 - Ford cargo - VW ',0.00,1.00,3,0,0,'','2013-05-15',NULL,'19.5.5','1'),(567,1,1,1,1,1,'20828','','Reten de leva Scania ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'19.5.5','1'),(568,1,1,1,1,1,'02972','( Sabo ) ','Reten Ford Fiesta - Cierra - Scort - Taunus ',0.00,1.00,3,0,0,'','2013-05-15',NULL,'19.5.5','1'),(569,1,1,1,1,1,'02483','','Reten delantero Ford Cargo ( 11 / 12 / 13 / T ) ',0.00,1.00,5,0,0,'','2013-05-15',NULL,'19.5.5','1'),(570,1,1,1,1,1,'1656','','Reten Peugeot 505 ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'19.6.6','1'),(571,1,1,1,1,1,'02305','','Reten Ford F-1000 ',0.00,1.00,4,0,0,'','2013-05-15',NULL,'19.6.6','1'),(572,1,1,1,1,1,'821','','Reten ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'19.6.6','1'),(573,1,1,1,1,1,'822','','Junta de goma 5 agujeros ',0.00,1.00,22,0,0,'','2013-05-15',NULL,'19.6.6','1'),(574,1,1,1,1,1,'823','','Junta de goma 6 agujeros ',0.00,1.00,10,0,0,'','2013-05-15',NULL,'19.6.6','1'),(575,1,1,1,1,1,'828','','Junta 4 agujeros ',0.00,1.00,4,0,0,'','2013-05-15',NULL,'19.6.6','1'),(576,1,1,1,1,1,'829','','Reten ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'19.6.6','1'),(577,1,1,1,1,1,'830','','Pista de reten',0.00,1.00,2,0,0,'','2013-05-15',NULL,'19.6.6','1'),(578,1,1,1,1,1,'2395','','Reten trasero C/10 - D/10 - D/20 ',0.00,1.00,4,0,0,'','2013-05-15',NULL,'19.6.6','1'),(579,1,1,1,1,1,'10130','','Reten delantero Duty - F-100',0.00,1.00,6,0,0,'','2013-05-15',NULL,'19.6.6','1'),(580,1,1,1,1,1,'01762','','Reten ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'19.6.6','1'),(581,1,1,1,1,1,'10131','','Reten trasero F-100 ( 2000 / 2004 ) ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'19.6.6','1'),(582,1,1,1,1,1,'1421','SO1740 - TH1421','Reten D.D.1000 M.Benz ( 11/13/15/22/23 Toneladas )',0.00,1.00,6,0,0,'','2013-05-15',NULL,'19.6.6','1'),(583,1,1,1,1,1,'8301','','Reten delantero D.500 - 600 ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'19.6.6','1'),(584,1,1,1,1,1,'0853','','Reten delantero F500 / 600 ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'19.6.6','1'),(585,1,1,1,1,1,'01764','','Reten ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'19.6.6','1'),(586,1,1,1,1,1,'0272','SO272/TH1785','Reten de leva Scania 113',0.00,1.00,8,0,0,'','2013-05-15',NULL,'19.6.6','1'),(587,1,1,1,1,1,'6140','3001','Rep. Gobernadora nuevo Wabco AD',0.00,1.00,5,0,0,'','2013-05-15',NULL,'17.4.4','1'),(588,1,1,1,1,1,'818','10100','Rep. Pedalera Ford 14000 Bendix ',0.00,1.00,6,0,0,'','2013-05-15',NULL,'17.4.4','1'),(589,1,1,1,1,1,'819','519-B','Rep. Parcial para pulsador triller ',0.00,1.00,4,0,0,'','2013-05-15',NULL,'17.4.4','1'),(590,1,1,1,1,1,'2842104','2842104','Rep. Valvula eje neumatico randon ',0.00,1.00,4,0,0,'','2013-05-15',NULL,'17.4.4','1'),(591,1,1,1,1,1,'1810','W1810','Rep. Valvula limitadora wabco ',0.00,1.00,3,0,0,'','2013-05-15',NULL,'17.4.4','1'),(592,1,1,1,1,1,'527','527-C','Rep. Valvula relay C/emergencia y retorno ',0.00,1.00,4,0,0,'','2013-05-15',NULL,'17.4.4','1'),(593,1,1,1,1,1,'526','526-C','Rep. Valvula emergencia relay ',0.00,1.00,5,0,0,'','2013-05-15',NULL,'17.4.4','1'),(594,1,1,1,1,1,'2027','2027','Rep. Valvula Westinghouse ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'17.4.4','1'),(595,1,1,1,1,1,'931611678','6143','Rep. Valvula 4 vidas Fiat 1500 / 1600 ',0.00,1.00,7,0,0,'','2013-05-15',NULL,'17.5.5','1'),(596,1,1,1,1,1,'5121','5121','Rep. Paedalera tipo bendix ',0.00,1.00,6,0,0,'','2013-05-15',NULL,'17.5.5','1'),(597,1,1,1,1,1,'5213','5213','Rep. Valvula manual bendix',0.00,1.00,6,0,0,'','2013-05-15',NULL,'17.5.5','1'),(598,1,1,1,1,1,'820','B109','Rep. Valvula relay chata Knorr',0.00,1.00,2,0,0,'','2013-05-15',NULL,'17.5.5','1'),(599,1,1,1,1,1,'92185','92185','Rep. Valvula distribuidora Bosh P/ Volvo ',0.00,1.00,3,0,0,'','2013-05-15',NULL,'17.5.5','1'),(600,1,1,1,1,1,'515','515/C','Rep. Valvula 2 vidas ',0.00,1.00,5,0,0,'','2013-05-15',NULL,'17.5.5','1'),(601,1,1,1,1,1,'1691','R1691','Rep. Valvula descarga rapida ege elevadiso ',0.00,1.00,5,0,0,'','2013-05-15',NULL,'17.5.5','1'),(602,1,1,1,1,1,'2969','149-19','Asientos Valvula triller ',0.00,1.00,20,0,0,'','2013-05-15',NULL,'17.5.5','1'),(603,1,1,1,1,1,'40002','4000/2','Juego de rep. M.Benz ',0.00,1.00,20,0,0,'','2013-05-15',NULL,'17.5.5','1'),(604,1,1,1,1,1,'30490','30490','Rep. Valvula alcoholera BOSCH',0.00,1.00,1,0,0,'','2013-05-15',NULL,'17.6.6','1'),(605,1,1,1,1,1,'212100096','212100096','Rep. Valvula 5 vias relay ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'17.6.6','1'),(606,1,1,1,1,1,'2121000961','2121000961','Rep. Valvula 3 vias relay ',0.00,1.00,4,0,0,'','2013-05-15',NULL,'17.6.6','1'),(607,1,1,1,1,1,'831','W4130','Rep. Valvula entre tanque ',0.00,1.00,5,0,0,'','2013-05-15',NULL,'17.6.6','1'),(608,1,1,1,1,1,'516','516-C','Rep. Valvula Desbloqueo triller ',0.00,1.00,4,0,0,'','2013-05-15',NULL,'17.6.6','1'),(609,1,1,1,1,1,'832','185-C','Rep. Valvula Decasrga rapida triller ',0.00,1.00,6,0,0,'','2013-05-15',NULL,'17.6.6','1'),(610,1,1,1,1,1,'931612658','I3818','Rep. Valvula Freno de mano',0.00,1.00,2,0,0,'','2013-05-15',NULL,'17.6.6','1'),(611,1,1,1,1,1,'833','2029','Rep. Valvula 4 vidas Knorr galvatec',0.00,1.00,12,0,0,'','2013-05-15',NULL,'17.6.6','1'),(612,1,1,1,1,1,'834','2032','Rep. Valvula galvatec',0.00,1.00,1,0,0,'','2013-05-15',NULL,'17.6.6','1'),(613,1,1,1,1,1,'835','2033','Rep. Valvula relay M.Benz 1218 galvatec',0.00,1.00,1,0,0,'','2013-05-15',NULL,'17.6.6','1'),(614,1,1,1,1,1,'1,50701E+11','','Reparacion valvula N. Knorr',0.00,1.00,3,0,0,'','2013-05-15',NULL,'17.7.7','1'),(615,1,1,1,1,1,'6210','B145','Reparacion valvula manual wabco',0.00,1.00,9,0,0,'','2013-05-15',NULL,'17.7.7','1'),(616,1,1,1,1,1,'1226','1226','Rep. Valvula sobrecarga ',0.00,1.00,11,0,0,'','2013-05-15',NULL,'17.7.7','1'),(617,1,1,1,1,1,'5130','2029','Rep. Valvula 4 vidas Knorr RT',0.00,1.00,7,0,0,'','2013-05-15',NULL,'17.7.7','1'),(618,1,1,1,1,1,'1960','R1960','Rep. Valvula Freno de remolque ',0.00,1.00,13,0,0,'','2013-05-15',NULL,'17.7.7','1'),(619,1,1,1,1,1,'836','535/C','Rep. Valvula triller nueva ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'17.7.7','1'),(620,1,1,1,1,1,'91630','91630','Rep. Pedalera tensa doble ',0.00,1.00,5,0,0,'','2013-05-15',NULL,'17.7.7','1'),(621,1,1,1,1,1,'100901','100901','Rep. Menor Valvula gobernadora M.Benz ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'17.7.7','1'),(622,1,1,1,1,1,'101503','101503','Rep. Mayor valvula gobernadora M.Benz ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'17.7.7','1'),(623,1,1,1,1,1,'102801','102801','Rep. Valvula freno de mano frepilco ',0.00,1.00,5,0,0,'','2013-05-15',NULL,'17.7.7','1'),(624,1,1,1,1,1,'101503','101503','Rep. Gobernadora modelo nuevo frepilco ',0.00,1.00,4,0,0,'','2013-05-15',NULL,'17.7.7','1'),(625,1,1,1,1,1,'5146','5146','Rep. Valvula relay Scani Frepilco ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'17.8.8','1'),(626,1,1,1,1,1,'2358','K2358','Kit reparacion varilla suspension Knorr',0.00,1.00,5,0,0,'','2013-05-15',NULL,'17.8.8','1'),(627,1,1,1,1,1,'1217','1217','Rep. Valvula mando remolque AD',0.00,1.00,7,0,0,'','2013-05-15',NULL,'17.8.8','1'),(628,1,1,1,1,1,'4912','4912/A','Kit de resortes Fiat Mecast ',0.00,1.00,4,0,0,'','2013-05-15',NULL,'17.8.8','1'),(629,1,1,1,1,1,'4908','4908','Rep. Pedalera Fiat Mecast ',0.00,1.00,4,0,0,'','2013-05-15',NULL,'17.8.8','1'),(630,1,1,1,1,1,'4907','4907','Rep. Honguito Fiat Mecast',0.00,1.00,4,0,0,'','2013-05-15',NULL,'17.8.8','1'),(631,1,1,1,1,1,'2265','W2265','Rep. Pedalera chata ',0.00,1.00,3,0,0,'','2013-05-15',NULL,'17.8.8','1'),(632,1,1,1,1,1,'2810','R2810','Rep. Pedalera tensa simple ',0.00,1.00,9,0,0,'','2013-05-15',NULL,'17.8.8','1'),(633,1,1,1,1,1,'6218','6218','Rep. Valvula distribuidora ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'17.9.9','1'),(634,1,1,1,1,1,'5710','W5710','Rep. Valvula sensible a la carga ',0.00,1.00,7,0,0,'','2013-05-15',NULL,'17.9.9','1'),(635,1,1,1,1,1,'1031','1031','Rep. Valvula pedalera RT',0.00,1.00,3,0,0,'','2013-05-15',NULL,'17.9.9','1'),(636,1,1,1,1,1,'2215','2215','Rep. Valvula distribuidora AD',0.00,1.00,4,0,0,'','2013-05-15',NULL,'17.9.9','1'),(637,1,1,1,1,1,'5154','5154','Rep. Valvula relay Canadiense AD',0.00,1.00,4,0,0,'','2013-05-15',NULL,'17.9.9','1'),(638,1,1,1,1,1,'5101','5101','Rep. Valvula pedalera Scania 112 AD',0.00,1.00,1,0,0,'','2013-05-15',NULL,'17.9.9','1'),(639,1,1,1,1,1,'1100','1100','Rep. Vavula pedalera M.Benz AD',0.00,1.00,4,0,0,'','2013-05-15',NULL,'17.9.9','1'),(640,1,1,1,1,1,'1880','B188','Rep. Valvula peda?era wabco RT ',0.00,1.00,3,0,0,'','2013-05-15',NULL,'17.9.9','1'),(641,1,1,1,1,1,'12185','12185','Rep. Valvula pedalera Scania serie 4',0.00,1.00,2,0,0,'','2013-05-15',NULL,'17.9.9','1'),(642,1,1,1,1,1,'1560','W1560','Rep. Valvula retencion Wabco ',0.00,1.00,19,0,0,'','2013-05-15',NULL,'17.10.10','1'),(643,1,1,1,1,1,'1217','1217','Rep. Valvula mando remolque DEG',0.00,1.00,10,0,0,'','2013-05-15',NULL,'17.10.10','1'),(644,1,1,1,1,1,'1215','1215','Rep. Comp . Mando Bras . M.Benz ',0.00,1.00,6,0,0,'','2013-05-15',NULL,'17.10.10','1'),(645,1,1,1,1,1,'1750','B175','Rep. Mayor wabco ',0.00,1.00,4,0,0,'','2013-05-15',NULL,'17.10.10','1'),(646,1,1,1,1,1,'7110','7110','Rep. Pedalera Ford cargo ',0.00,1.00,12,0,0,'','2013-05-15',NULL,'17.10.10','1'),(647,1,1,1,1,1,'3070','B3070','Rep. Pedalera Marelli menor ',0.00,1.00,7,0,0,'','2013-05-15',NULL,'17.10.10','1'),(648,1,1,1,1,1,'837','4000/2','Kit O\'rings M.Benz ',0.00,1.00,9,0,0,'','2013-05-15',NULL,'17.10.10','1'),(649,1,1,1,1,1,'838','06-003','Rep. Valvula suspension Scania 112 ',0.00,1.00,35,0,0,'','2013-05-15',NULL,'17.10.10','1'),(650,1,1,1,1,1,'839','06-0013','Rep. Valvula suspension M.Benz ',0.00,1.00,29,0,0,'','2013-05-15',NULL,'17.10.10','1'),(651,1,1,1,1,1,'840','2033','Rep. Mayor valvula relay M.Benz ',0.00,1.00,23,0,0,'','2013-05-15',NULL,'17.10.10','1'),(652,1,1,1,1,1,'2000','2000','Rep. Completa gobernadora Knorr ',0.00,1.00,21,0,0,'','2013-05-15',NULL,'17.10.20','1'),(653,1,1,1,1,1,'841','','Rep. Valvula gobernadora M.Benz',0.00,1.00,10,0,0,'','2013-05-15',NULL,'17.10.10','1'),(654,1,1,1,1,1,'9709020274','1708','Cuerpo neumatico ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'17.10.10','1'),(655,1,1,1,1,1,'35256','35256','Rep. Valvula 4 vias Knorr ',0.00,1.00,6,0,0,'','2013-05-15',NULL,'18.1.1','1'),(656,1,1,1,1,1,'90210','90210','Rep. Valvula 4 vias ',0.00,1.00,4,0,0,'','2013-05-15',NULL,'18.1.1','1'),(657,1,1,1,1,1,'31378','31378','Rep. Valvula relay modelo nuevo ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'18.1.1','1'),(658,1,1,1,1,1,'31363','31362','Rep. Valvula peda?era Knorr modelo nuevo ',0.00,1.00,4,0,0,'','2013-05-15',NULL,'18.1.1','1'),(659,1,1,1,1,1,'4450','4450','Kit secador de aire Knorr ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'18.1.1','1'),(660,1,1,1,1,1,'90286','90286','Rep. Valvula gobernadora Knorr',0.00,1.00,8,0,0,'','2013-05-15',NULL,'18.1.1','1'),(661,1,1,1,1,1,'2346','K2346','Rep. Valvula secadora Knorr',0.00,1.00,1,0,0,'','2013-05-15',NULL,'18.2.2','1'),(662,1,1,1,1,1,'448','448','Kit componente Knorr ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'18.2.2','1'),(663,1,1,1,1,1,'15162','15162','Rep. Valvula pedalera Knorr ',0.00,1.00,12,0,0,'','2013-05-15',NULL,'18.2.2','1'),(664,1,1,1,1,1,'83570','83570','Rep. Regulador de presion Knorr',0.00,1.00,1,0,0,'','2013-05-15',NULL,'18.2.2','1'),(665,1,1,1,1,1,'15138','151385','Rep. Valvula descarga rapida ',0.00,1.00,9,0,0,'','2013-05-15',NULL,'18.2.2','1'),(666,1,1,1,1,1,'31377','31377','Rep. Valvula manual Knorr ',0.00,1.00,4,0,0,'','2013-05-15',NULL,'18.2.2','1'),(667,1,1,1,1,1,'35253','35253',' Rep. Valvula manual Knorr',0.00,1.00,7,0,0,'','2013-05-15',NULL,'18.2.2','1'),(668,1,1,1,1,1,'35221','35221','Rep. Valvula 2 vidas ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'18.3.3','1'),(669,1,1,1,1,1,'36248008','8008','Rep. Secador de aire ',0.00,1.00,5,0,0,'','2013-05-15',NULL,'18.3.3','1'),(670,1,1,1,1,1,'325810051','100521','Rep. Limitadora presi?n ',0.00,1.00,9,0,0,'','2013-05-15',NULL,'18.3.3','1'),(671,1,1,1,1,1,'842','B3000','Rep. Gobernadora Scania',0.00,1.00,3,0,0,'','2013-05-15',NULL,'18.3.3','1'),(672,1,1,1,1,1,'90285','90285','Rep. Gobernadora modelo nuevo ',0.00,1.00,8,0,0,'','2013-05-15',NULL,'18.3.3','1'),(673,1,1,1,1,1,'83277','83277','Rep. Valvula relay Knorr ',0.00,1.00,3,0,0,'','2013-05-15',NULL,'18.3.3','1'),(674,1,1,1,1,1,'325810051','','Rep. Valvula secador ',0.00,1.00,9,0,0,'','2013-05-15',NULL,'18.3.3','1'),(675,1,1,1,1,1,'311630061','30061','Rep. Valvula protectira ',0.00,1.00,10,0,0,'','2013-05-15',NULL,'18.4.4','1'),(676,1,1,1,1,1,'4910','4910','Rep. Valvula gobernadora Fiat ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'18.4.4','1'),(677,1,1,1,1,1,'311630062','30062','Rep. Valvula 4 vidas Knorr',0.00,1.00,10,0,0,'','2013-05-15',NULL,'18.4.4','1'),(678,1,1,1,1,1,'86237','86237','Rep. Acople americano ',0.00,1.00,5,0,0,'','2013-05-15',NULL,'18.4.4','1'),(679,1,1,1,1,1,'90221','90221','Rep. Valvula freno de mano ',0.00,1.00,6,0,0,'','2013-05-15',NULL,'18.4.4','1'),(680,1,1,1,1,1,'83572','83572','Rep. Valvula manual simple ',0.00,1.00,8,0,0,'','2013-05-15',NULL,'18.4.4','1'),(681,1,1,1,1,1,'155921','155921','Flaper compresor ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'18.5.5','1'),(682,1,1,1,1,1,'351840061','351840061','Rep. Tapa compresor Volvo ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'18.5.5','1'),(683,1,1,1,1,1,'3268700690','K2319','Rep. Tapa compresor',0.00,1.00,1,0,0,'','2013-05-15',NULL,'18.5.5','1'),(684,1,1,1,1,1,'4725','4725','Kit Valvula 4 vidas Knorr',0.00,1.00,3,0,0,'','2013-05-15',NULL,'18.5.5','1'),(685,1,1,1,1,1,'35270','35270','Rep. Valvula distribuidora ',0.00,1.00,11,0,0,'','2013-05-15',NULL,'18.5.5','1'),(686,1,1,1,1,1,'18252','','Rep. Valvula 4 vidas APU Electronica ',0.00,1.00,5,0,0,'','2013-05-15',NULL,'18.5.5','1'),(687,1,1,1,1,1,'844','',' ( Zuncho ) Cinta tejida 85mm x 12mm ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'9.1.1','1'),(688,1,1,1,1,1,'845','','Cinta tejida 90mm x 12mm ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'9.1.1','1'),(689,1,1,1,1,1,'846','','Cinta tejida 50mm x 8mm ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'9.1.1','1'),(690,1,1,1,1,1,'847','','Cinta tejida 80mm x 8 mm ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'9.1.1','1'),(691,1,1,1,1,1,'824','','Cinta tejida 130mm x 15mm ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'9.1.1','1'),(692,1,1,1,1,1,'9232','9232STD','Cinta de freno estandar ',0.00,1.00,4,0,0,'','2013-05-15',NULL,'9.1.2','1'),(693,1,1,1,1,1,'4564','4564X','Cinta de freno 1? medida ',0.00,1.00,17,0,0,'','2013-05-15',NULL,'9.1.2','1'),(694,1,1,1,1,1,'9245','9245STD','Cinta de freno estandar ',0.00,1.00,23,0,0,'','2013-05-15',NULL,'9.1.6','1'),(695,1,1,1,1,1,'92452','9245XX','Cinta de freno 2? medida ',0.00,1.00,4,0,0,'','2013-05-15',NULL,'9.1.6','1'),(696,1,1,1,1,1,'848','GG/83/1 13mm','Cinta de freno 1? medida Ford 700 Trasera (cobreq)',0.00,1.00,24,0,0,'','2013-05-15',NULL,'9.1.2','1'),(697,1,1,1,1,1,'20300','2030X','Cinta de freno ciber en 1? medida',0.00,1.00,48,0,0,'','2013-05-15',NULL,'9.2.3','1'),(698,1,1,1,1,1,'850','GG/83/1 15MM','Cinta de freno 1? medida Ford 700 Trasera (Cobreq)',0.00,1.00,26,0,0,'','2013-05-15',NULL,'9.1.2','1'),(699,1,1,1,1,1,'10116','10116 10mm','Cinta de freno especial Flexofren',0.00,1.00,10,0,0,'','2013-05-15',NULL,'9.2.2','1'),(700,1,1,1,1,1,'2030','2030/1 13mm','Cinta de freno especial ciega 1? medida',0.00,1.00,12,0,0,'','2013-05-15',NULL,'9.2.2','1'),(701,1,1,1,1,1,'45154','4515','Cinta especial ciega ',0.00,1.00,11,0,0,'','2013-05-15',NULL,'9.2.2','1'),(702,1,1,1,1,1,'10185','10185','Cinta de freno delantera M.Benz 6600',0.00,1.00,4,0,0,'','2013-05-15',NULL,'9.2.3','1'),(703,1,1,1,1,1,'101851','10185','Cinta de freno trasera M.Benz 6600 ',0.00,1.00,16,0,0,'','2013-05-15',NULL,'9.2.3','1'),(704,1,1,1,1,1,'20301','2030 12mm ','Cinta de freno especial ciega 1? medida',0.00,1.00,12,0,0,'','2013-05-15',NULL,'9.2.3','1'),(705,1,1,1,1,1,'7,89268E+12','811STD','Cinta de freno estandar ',0.00,1.00,20,0,0,'','2013-05-15',NULL,'4.2.4','1'),(706,1,1,1,1,1,'7,89268E+11','811X','Cinta de freno en 1? medida',0.00,1.00,16,0,0,'','2013-05-15',NULL,'4.2.4','1'),(707,1,1,1,1,1,'7,89268E+12','811XX','Cinta de freno en 2? medida',0.00,1.00,44,0,0,'','2013-05-15',NULL,'4.2.4','1'),(708,1,1,1,1,1,'0422','0422STD','Cinta de freno estandar M. Benz 608 Delantera - Trasera ',0.00,1.00,64,0,0,'','2013-05-15',NULL,'9.2.5','1'),(709,1,1,1,1,1,'04221','0422X','Cinta de freno en 1? medida M. Benz 608 Delantera - Trasera',0.00,1.00,24,0,0,'','2013-05-15',NULL,'9.2.5','1'),(710,1,1,1,1,1,'04222','0422XX','Cinta de freno en 2? medida  M. Benz 608 Delantera - Trasera',0.00,1.00,16,0,0,'','2013-05-15',NULL,'9.2.5','1'),(711,1,1,1,1,1,'2060','2060STD','Cinta de freno estandar F 600 Delantera',0.00,1.00,24,0,0,'','2013-05-15',NULL,'9.2.3','1'),(712,1,1,1,1,1,'20601','2060X','Cinta de freno en 1? medida F 600',0.00,1.00,16,0,0,'','2013-05-15',NULL,'9.2.3','1'),(713,1,1,1,1,1,'20602','2060XX','Cinta de freno en 2? medida F 600',0.00,1.00,72,0,0,'','2013-05-15',NULL,'9.2.3','1'),(714,1,1,1,1,1,'843','','Cinta especial ciega ',0.00,1.00,3,0,0,'','2013-05-15',NULL,'9.2.6','1'),(715,1,1,1,1,1,'46440','Varias medidas','Cinta de freno varias Semi- Acoplado',0.00,1.00,20,0,0,'','2013-05-15',NULL,'9.1.6','1'),(716,1,1,1,1,1,'45150','Varias medidas','Cinta de freno varias Semi- Acoplado',0.00,1.00,30,0,0,'','2013-05-15',NULL,'9.1.6','1'),(717,1,1,1,1,1,'45155','Cinta Gruesa','Cinta especial Tanque Espa?ol ',0.00,1.00,32,0,0,'','2013-05-15',NULL,'9.1.6','1'),(718,1,1,1,1,1,'824','','Cinta especial (Hecha Renault 24MM)',0.00,1.00,9,0,0,'','2013-05-15',NULL,'9.2.5','1'),(719,1,1,1,1,1,'825','FI/119STD','Cinta de freno estandar Fiat modelo nuevo (Frasle)',0.00,1.00,16,0,0,'','2013-05-15',NULL,'9.1.6','1'),(720,1,1,1,1,1,'14192','1419TXX','Cinta de freno en 2? Medida',0.00,1.00,4,0,0,'','2013-05-15',NULL,'9.2.6','1'),(721,1,1,1,1,1,'826','','Cinta varias ciegas',0.00,1.00,4,0,0,'','2013-05-15',NULL,'9.2.6','1'),(722,1,1,1,1,1,'827','89','Cinta Ural Ruso',0.00,1.00,5,0,0,'','2013-05-15',NULL,'9.2.6','1'),(723,1,1,1,1,1,'4524','4524XX','Cinta de freno en 2? medida',0.00,1.00,6,0,0,'','2013-05-15',NULL,'9.2.6','1'),(724,1,1,1,1,1,'983','','Cinta especial interfreno (Del. y Tras.)',0.00,1.00,4,0,0,'','2013-05-15',NULL,'9.2.6','1'),(725,1,1,1,1,1,'984','','Cinta de freno 6mm',0.00,1.00,8,0,0,'','2013-05-15',NULL,'9.2.6','1'),(726,1,1,1,1,1,'2135','2135X','Cinta de freno ciega en 1? medida',0.00,1.00,16,0,0,'','2013-05-15',NULL,'9.2.4','1'),(727,1,1,1,1,1,'986','X','Cinta de freno en 1? medida M. Benz 3500 6mm',0.00,1.00,16,0,0,'','2013-05-15',NULL,'9.2.4','1'),(728,1,1,1,1,1,'985','H2/7STD','Cinta de freno estandar  Acoplado Helvetica 6mm (Bulon 3/8)',0.00,1.00,34,0,0,'','2013-05-15',NULL,'9.3.4','1'),(729,1,1,1,1,1,'987','H2/7X','Cinta de freno en 1? medida Acoplado Helvetica 6mm (Bulon 3/8) ',0.00,1.00,12,0,0,'','2013-05-15',NULL,'9.3.4','1'),(730,1,1,1,1,1,'988','H8STD','Cinta de freno estandar Helvetica 8mm',0.00,1.00,48,0,0,'','2013-05-15',NULL,'9.3.4','1'),(731,1,1,1,1,1,'989','H8STD','Cinta de freno estandar Helvetica 6mm',0.00,1.00,40,0,0,'','2013-05-15',NULL,'9.3.4','1'),(732,1,1,1,1,1,'990','H8X','Cinta de freno Helvetica en 1? medida 6mm',0.00,1.00,48,0,0,'','2013-05-15',NULL,'9.2.4','1'),(733,1,1,1,1,1,'991','H8XX','Cinta de freno Helvetica en 2? medida 8mm',0.00,1.00,8,0,0,'','2013-05-15',NULL,'9.2.4','1'),(734,1,1,1,1,1,'992','AC/16','Cinta de freno Carton 6mm (Frasle)',0.00,1.00,12,0,0,'','2013-05-15',NULL,'9.2.4','1'),(735,1,1,1,1,1,'993','H2/2','Cinta de freno en 2? medida Helvetica vieja 6mm',0.00,1.00,3,0,0,'','2013-05-15',NULL,'9.3.4','1'),(736,1,1,1,1,1,'994','','Cinta de freno Carreton otro modelo 6 mm',0.00,1.00,4,0,0,'','2013-05-15',NULL,'9.2.4','1'),(737,1,1,1,1,1,'4311','4311','Cinta de freno Acoplado Maldonado 13/16\" ',0.00,1.00,20,0,0,'','2013-05-15',NULL,'9.1.3','1'),(738,1,1,1,1,1,'1112','1112STD','Cinta de freno estandar 8mm M. Benz 1112-1114',0.00,1.00,12,0,0,'','2013-05-15',NULL,'9.1.5','1'),(739,1,1,1,1,1,'11121','1112X','Cinta de freno 1? medida M. Benz 1112-1114',0.00,1.00,16,0,0,'','2013-05-15',NULL,'9.1.5','1'),(740,1,1,1,1,1,'11122','1112XX','Cinta de freno 2? medida  M. Benz 1112-1114',0.00,1.00,72,0,0,'','2013-05-15',NULL,'9.1.5','1'),(741,1,1,1,1,1,'1517','1517STD','Cinta de freno estandar M. Benz 1517 Delantera',0.00,1.00,112,0,0,'','2013-05-15',NULL,'9.1.5','1'),(742,1,1,1,1,1,'15171','1517X','Cinta de freno 1? medida M. Benz 1517 Delantera',0.00,1.00,24,0,0,'','2013-05-15',NULL,'9.1.5','1'),(743,1,1,1,1,1,'15172','1517XX','Cinta de freno 2? medida M. Benz 1517 Delantera',0.00,1.00,32,0,0,'','2013-05-15',NULL,'9.1.5','1'),(744,1,1,1,1,1,'0327','0327STD','Cinta de freno estandar M. Benz 1517 Trasera ',0.00,1.00,24,0,0,'','2013-05-15',NULL,'9.1.5','1'),(745,1,1,1,1,1,'03271','0327X','Cinta de freno en 1? medida M. Benz 1517 Trasera',0.00,1.00,16,0,0,'','2013-05-15',NULL,'9.1.5','1'),(746,1,1,1,1,1,'03272','0327XX','Cinta de freno en 2? medida M. Benz 1517 Trasera',0.00,1.00,16,0,0,'','2013-05-15',NULL,'9.1.5','1'),(747,1,1,1,1,1,'4564','','Cinta de freno Ford 600 6mm Trasera ',0.00,1.00,21,0,0,'','2013-05-15',NULL,'9.1.3','1'),(748,1,1,1,1,1,'101161','10116X','Cinta de freno especial en 1? medida 6mm',0.00,1.00,8,0,0,'','2013-05-15',NULL,'9.2.3','1'),(749,1,1,1,1,1,'101162','10116XX','Cinta de freno especial en 2? medida 6mm',0.00,1.00,8,0,0,'','2013-05-15',NULL,'9.2.3','1'),(750,1,1,1,1,1,'995','','Cinta de freno Ford 46 Delantera',0.00,1.00,4,0,0,'','2013-05-15',NULL,'9.2.3','1'),(751,1,1,1,1,1,'996','','Cinta de freno Ford 46 Trasera',0.00,1.00,8,0,0,'','2013-05-15',NULL,'9.2.3','1'),(752,1,1,1,1,1,'997','MB710XXX','Cinta de freno en 3? medida M.Benz 710 6mm',0.00,1.00,12,0,0,'','2013-05-15',NULL,'9.2.5','1'),(753,1,1,1,1,1,'998','FD/58STD','Cinta de freno estandar M. Benz 6mm (Frasle)',0.00,1.00,4,0,0,'','2013-05-15',NULL,'9.2.5','1'),(754,1,1,1,1,1,'999','AC/17STD','Cinta de freno estandar M. Benz 6mm (Micro EG eaton)',0.00,1.00,8,0,0,'','2013-05-15',NULL,'9.2.5','1'),(755,1,1,1,1,1,'1000','AC/17X','Cinta de freno en 1? medida M. Benz 6mm (Micro EG eaton)',0.00,1.00,8,0,0,'','2013-05-15',NULL,'9.2.5','1'),(756,1,1,1,1,1,'849','MB/193XX','Cinta de freno en 2? medida M. Benz 6mm ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'9.2.5','1'),(757,1,1,1,1,1,'1001','','Cinta de freno M.Benz 710 15mm',0.00,1.00,3,0,0,'','2013-05-15',NULL,'9.2.5','1'),(758,1,1,1,1,1,'1002','MB/193STD','Cinta de freno estandar M. Benz 710 6mm',0.00,1.00,6,0,0,'','2013-05-15',NULL,'9.2.5','1'),(759,1,1,1,1,1,'49910','499/10','Cinta de freno especial 6mm',0.00,1.00,10,0,0,'','2013-05-15',NULL,'9.3.6','1'),(760,1,1,1,1,1,'12503','1250/3','Cinta de freno en 3? medida Mack 13/16\"',0.00,1.00,4,0,0,'','2013-05-15',NULL,'9.3.6','1'),(761,1,1,1,1,1,'1003','','Cinta de freno especial ',0.00,1.00,10,0,0,'','2013-05-15',NULL,'9.3.6','1'),(762,1,1,1,1,1,'10146','10146','Cinta de freno especial 15mm',0.00,1.00,4,0,0,'','2013-05-15',NULL,'9.3.6','1'),(763,1,1,1,1,1,'101461','10146','Cinta de freno especial 16mm',0.00,1.00,7,0,0,'','2013-05-15',NULL,'9.3.6','1'),(764,1,1,1,1,1,'10145','10145','Cinta de freno especial 16mm',0.00,1.00,5,0,0,'','2013-05-15',NULL,'9.3.6','1'),(765,1,1,1,1,1,'101451','10145','Cinta de freno especial 15mm',0.00,1.00,15,0,0,'','2013-05-15',NULL,'9.3.6','1'),(766,1,1,1,1,1,'101452','10145','Cnta de freno especial ',0.00,1.00,12,0,0,'','2013-05-15',NULL,'9.3.6','1'),(767,1,1,1,1,1,'101453','10145','Cinta de freno especial 13 mm',0.00,1.00,3,0,0,'','2013-05-15',NULL,'9.3.6','1'),(768,1,1,1,1,1,'1004','','Cinta de freno especial',0.00,1.00,8,0,0,'','2013-05-15',NULL,'9.3.6','1'),(769,1,1,1,1,1,'1005','X','Cinta de freno especial en 1? medida Gaz Trasera',0.00,1.00,16,0,0,'','2013-05-15',NULL,'9.3.6','1'),(770,1,1,1,1,1,'1006','X','Cinta de freno especial en 1? medida Gaz Delantera',0.00,1.00,20,0,0,'','2013-05-15',NULL,'9.3.6','1'),(771,1,1,1,1,1,'1007','STD','Cinta de freno Gaz especial estandar Gaz Trasera ',0.00,1.00,8,0,0,'','2013-05-15',NULL,'9.3.6','1'),(772,1,1,1,1,1,'2504','2504XX/XXX','Cinta de freno especial en 2? y 3? medida Carreton',0.00,1.00,14,0,0,'','2013-05-15',NULL,'9.3.6','1'),(773,1,1,1,1,1,'1009','CO10X','Cinta de freno especial en 1? medida',0.00,1.00,16,0,0,'','2013-05-15',NULL,'9.3.5','1'),(774,1,1,1,1,1,'1010','CO10XX','Cinta de freno especial en 2? medida ',0.00,1.00,16,0,0,'','2013-05-15',NULL,'9.3.5','1'),(775,1,1,1,1,1,'08161','816X','Cinta de freno reforma en 1? medida omnibus (Detalle)',0.00,1.00,16,0,0,'','2013-05-15',NULL,'9.3.5','1'),(776,1,1,1,1,1,'08162','816XX','Cinta de freno reforma en 2? medida omnibus (Detalle)',0.00,1.00,16,0,0,'','2013-05-15',NULL,'9.3.5','1'),(777,1,1,1,1,1,'10194','10194X','Cinta de freno especial Frenos Oeste ( bulon 3/8)',0.00,1.00,32,0,0,'','2013-05-15',NULL,'9.3.5','1'),(778,1,1,1,1,1,'101942','10194XX','Cinta de freno especial Frenos Oeste ( bulon 3/8) 2? medida',0.00,1.00,28,0,0,'','2013-05-15',NULL,'9.3.5','1'),(779,1,1,1,1,1,'4993','499/3(051)','Cinta de freno especial en 3? medida ( bulon 3/8)',0.00,1.00,11,0,0,'','2013-05-15',NULL,'9.3.5','1'),(780,1,1,1,1,1,'10022','10022/2','Cinta de freno especial ciega en 2? medida',0.00,1.00,4,0,0,'','2013-05-15',NULL,'9.2.6','1'),(781,1,1,1,1,1,'1011','','Cinta de freno especial ciega ',0.00,1.00,8,0,0,'','2013-05-15',NULL,'9.2.6','1'),(782,1,1,1,1,1,'1012','','Cinta de freno especial ciega Chiavacci',0.00,1.00,12,0,0,'','2013-05-15',NULL,'9.2.6','1'),(783,1,1,1,1,1,'1013','','Cinta de freno especial ciega 21mm',0.00,1.00,11,0,0,'','2013-05-15',NULL,'9.2.6','1'),(784,1,1,1,1,1,'1014','','Cinta de freno especial ciega ',0.00,1.00,6,0,0,'','2013-05-15',NULL,'9.2.6','1'),(785,1,1,1,1,1,'10500','10500/2','Cinta de freno especial en 2? medida Frenos Oeste (Bulon 3/8)',0.00,1.00,4,0,0,'','2013-05-15',NULL,'9.3.5','1'),(786,1,1,1,1,1,'1521','1521/D','Cinta de freno estandar y 1? medida 8mm',0.00,1.00,30,0,0,'','2013-05-15',NULL,'9.2.6','1'),(787,1,1,1,1,1,'1015','','Cinta de freno especial ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'9.2.6','1'),(788,1,1,1,1,1,'02679','','Reten M. Benz',0.00,1.00,3,0,0,'','2013-05-15',NULL,'14.2.6','1'),(789,1,1,1,1,1,'01818','','Reten Trasero Renault 21- Traffic ',0.00,1.00,3,0,0,'','2013-05-15',NULL,'14.2.6','1'),(790,1,1,1,1,1,'971','','Pista de reten Renault',0.00,1.00,1,0,0,'','2013-05-15',NULL,'14.2.6','1'),(791,1,1,1,1,1,'972','','Reten Derecho M. Benz 1226-1622',0.00,1.00,1,0,0,'','2013-05-15',NULL,'14.2.6','1'),(792,1,1,1,1,1,'0107','TH0107','Reten trasero Ika ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'14.2.6','1'),(793,1,1,1,1,1,'1448','','Reten trasero R4S-R6-R12',0.00,1.00,2,0,0,'','2013-05-15',NULL,'14.2.5','1'),(794,1,1,1,1,1,'01828','','Reten delantero 608/708/709',0.00,1.00,4,0,0,'','2013-05-15',NULL,'14.2.5','1'),(795,1,1,1,1,1,'1275','TH1275','Reten trasero Polar-Coronado',0.00,1.00,2,0,0,'','2013-05-15',NULL,'14.2.7','1'),(796,1,1,1,1,1,'01549','SO01549','Reten delantero M.Benz 1620',0.00,1.00,6,0,0,'','2013-05-15',NULL,'14.2.7','1'),(797,1,1,1,1,1,'0782','TH0782','Reten de leva',0.00,1.00,1,0,0,'','2013-05-15',NULL,'14.2.7','1'),(798,1,1,1,1,1,'0616','TH0616','Reten',0.00,1.00,2,0,0,'','2013-05-15',NULL,'14.2.7','1'),(799,1,1,1,1,1,'1628','TH1628','Reten ',0.00,1.00,6,0,0,'','2013-05-15',NULL,'14.2.8','1'),(800,1,1,1,1,1,'0422','TH0422','Reten Deuz modelo viejo',0.00,1.00,3,0,0,'','2013-05-15',NULL,'14.2.8','1'),(801,1,1,1,1,1,'6152','TH6152','Reten ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'14.2.8','1'),(802,1,1,1,1,1,'51511','5151/1-TH01536','Reten de leva',0.00,1.00,12,0,0,'','2013-05-15',NULL,'14.3.1','1'),(803,1,1,1,1,1,'1169','TH1169-DBH5540','Reten delantero Fiat 1500 (1964)',0.00,1.00,4,0,0,'','2013-05-15',NULL,'14.3.1','1'),(804,1,1,1,1,1,'1448','DBH1448-TH0782','Reten trasero Fiat 600',0.00,1.00,2,0,0,'','2013-05-15',NULL,'14.3.2','1'),(805,1,1,1,1,1,'1237','TH1237','Reten trasero Fiat 133',0.00,1.00,2,0,0,'','2013-05-15',NULL,'14.3.2','1'),(806,1,1,1,1,1,'03161','03161','Reten de leva (Sabo)',0.00,1.00,17,0,0,'','2013-05-15',NULL,'14.3.2','1'),(807,1,1,1,1,1,'9123','DBH9123','Reten ',0.00,1.00,8,0,0,'','2013-05-15',NULL,'14.3.3','1'),(808,1,1,1,1,1,'6090','6090','Reten ',0.00,1.00,9,0,0,'','2013-05-15',NULL,'14.3.4','1'),(809,1,1,1,1,1,'8103','8103','Reten ',0.00,1.00,4,0,0,'','2013-05-15',NULL,'14.3.4','1'),(810,1,1,1,1,1,'1578','TH1578','Reten delantero Fiat 673 ',0.00,1.00,4,0,0,'','2013-05-15',NULL,'14.3.5','1'),(811,1,1,1,1,1,'8997','DBH8997','Reten ',0.00,1.00,4,0,0,'','2013-05-15',NULL,'14.3.5','1'),(812,1,1,1,1,1,'1632','TH1632','Reten Fiat 697',0.00,1.00,2,0,0,'','2013-05-15',NULL,'14.3.5','1'),(813,1,1,1,1,1,'3264','3264','Reten ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'14.3.6','1'),(814,1,1,1,1,1,'0767','TH0767','Reten',0.00,1.00,1,0,0,'','2013-05-15',NULL,'14.3.6','1'),(815,1,1,1,1,1,'1628','TH1628','Reten ',0.00,1.00,3,0,0,'','2013-05-15',NULL,'14.3.6','1'),(816,1,1,1,1,1,'1016','','Reten ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'14.3.6','1'),(817,1,1,1,1,1,'1641','TH1641','Reten Trasero Dogde 1000',0.00,1.00,4,0,0,'','2013-05-15',NULL,'14.3.7','1'),(818,1,1,1,1,1,'1923','01923','Reten ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'14.3.7','1'),(819,1,1,1,1,1,'1627','1627','Reten ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'14.3.8','1'),(820,1,1,1,1,1,'7,79063E+12','151','Bardhal (aditivo caja diferencial)',0.00,1.00,11,0,0,'','2013-05-15',NULL,'6.1.1','1'),(821,1,1,1,1,1,'863','201920/3','Caja reguladora universal (recta)',0.00,1.00,68,0,0,'','2013-05-15',NULL,'6.1.1','1'),(822,1,1,1,1,1,'864','F-2703','Caja reguladora curva derecha',0.00,1.00,4,0,0,'','2013-05-15',NULL,'6.1.1','1'),(823,1,1,1,1,1,'865','F-2704','Caja reguladora curva izquierda',0.00,1.00,2,0,0,'','2013-05-15',NULL,'6.1.1','1'),(824,1,1,1,1,1,'866','F-2730','Caja reguladora remolque (37 eatrias) ',0.00,1.00,3,0,0,'','2013-05-15',NULL,'6.1.1','1'),(825,1,1,1,1,1,'9509','9509','Caja reguladora automatica ',0.00,1.00,3,0,0,'','2013-05-15',NULL,'6.1.1','1'),(826,1,1,1,1,1,'867','F-2813','Caja reguladora M.benz Volteo ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'6.1.1','1'),(827,1,1,1,1,1,'968','F-2817','Caja reguladora Trasera M. benz 1621 L izquierda',0.00,1.00,3,0,0,'','2013-05-15',NULL,'6.1.1','1'),(828,1,1,1,1,1,'969','F-2816','Caja reguladora Trasera M. benz 1621 L Derecha',0.00,1.00,3,0,0,'','2013-05-15',NULL,'6.1.1','1'),(829,1,1,1,1,1,'970','R-5700','Val. Gobernadora Tipo Bendix ',0.00,1.00,13,0,0,'','2013-05-15',NULL,'6.1.2','1'),(830,1,1,1,1,1,'1017','F-2700','Caja reguladora recta',0.00,1.00,1,0,0,'','2013-05-15',NULL,'6.1.1','1'),(831,1,1,1,1,1,'8,97483E+11','103200','Val. Relay S/Emerg. Modelo nuevo ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'6.1.2','1'),(832,1,1,1,1,1,'871','562/1','Val. Relay C/Control S.B.',0.00,1.00,2,0,0,'','2013-05-15',NULL,'6.1.2','1'),(833,1,1,1,1,1,'951400','951400','Val. Relay 3 salidas Randon C/Emerg.',0.00,1.00,2,0,0,'','2013-05-15',NULL,'6.1.2','1'),(834,1,1,1,1,1,'872','C-515','Val. Relay 2 lineas C/Emerg.',0.00,1.00,1,0,0,'','2013-05-15',NULL,'6.1.2','1'),(835,1,1,1,1,1,'873','R1690','Val. Descarga eje elevadizo 3/8\"',0.00,1.00,2,0,0,'','2013-05-15',NULL,'6.1.2','1'),(836,1,1,1,1,1,'874','M-124/1','Bulon F-350 Delantero',0.00,1.00,43,0,0,'','2013-05-15',NULL,'6.1.3','1'),(837,1,1,1,1,1,'875','M-123','Bulon F-350 Trasero',0.00,1.00,14,0,0,'','2013-05-15',NULL,'6.1.3','1'),(838,1,1,1,1,1,'876','','Tornillo rueda freno disco',0.00,1.00,61,0,0,'','2013-05-15',NULL,'6.1.3','1'),(839,1,1,1,1,1,'877','1300/10','Entrerosca de chasis',0.00,1.00,11,0,0,'','2013-05-15',NULL,'6.1.3','1'),(840,1,1,1,1,1,'878','','Bulon 1/2\" de rueda Dogde rosca izquierda ',0.00,1.00,76,0,0,'','2013-05-15',NULL,'6.1.3','1'),(841,1,1,1,1,1,'0049','0049','Seguro caja reguladora',0.00,1.00,8,0,0,'','2013-05-15',NULL,'6.1.3','1'),(842,1,1,1,1,1,'16043','16043','Tuerca de caja reguladora',0.00,1.00,8,0,0,'','2013-05-15',NULL,'6.1.3','1'),(843,1,1,1,1,1,'201918','201918','Chapa seguro de caja ',0.00,1.00,3,0,0,'','2013-05-15',NULL,'6.1.3','1'),(844,1,1,1,1,1,'879','','Tornillo de rueda especiales',0.00,1.00,23,0,0,'','2013-05-15',NULL,'6.1.3','1'),(845,1,1,1,1,1,'880','M-123','Tornillo F-350 Trasero izquierdo',0.00,1.00,3,0,0,'','2013-05-15',NULL,'6.1.3','1'),(846,1,1,1,1,1,'881','153/1','Tuerca F-350 Izquieda',0.00,1.00,16,0,0,'','2013-05-15',NULL,'6.1.3','1'),(847,1,1,1,1,1,'882','','Bulon de rueda Chevrolet',0.00,1.00,49,0,0,'','2013-05-15',NULL,'6.1.3','1'),(848,1,1,1,1,1,'883',' ','Clavo patin M. Benz modelo viejo',0.00,1.00,17,0,0,'','2013-05-15',NULL,'6.1.4','1'),(849,1,1,1,1,1,'884','361','Perno de anclaje M. Benz 911 delantero',0.00,1.00,18,0,0,'','2013-05-15',NULL,'6.1.4','1'),(850,1,1,1,1,1,'885','362','Perno de anclaje M. Benz 911 Trasero',0.00,1.00,9,0,0,'','2013-05-15',NULL,'6.1.4','1'),(851,1,1,1,1,1,'886','492','Clavo de patin M. Benz 1114',0.00,1.00,7,0,0,'','2013-05-15',NULL,'6.1.4','1'),(852,1,1,1,1,1,'887','415','Perno de patin M. Benz 1114',0.00,1.00,10,0,0,'','2013-05-15',NULL,'6.1.4','1'),(853,1,1,1,1,1,'888','629','Perno de anclaje largo delantero y trasero ',0.00,1.00,8,0,0,'','2013-05-15',NULL,'6.1.4','1'),(854,1,1,1,1,1,'889','4331','Regulador M.Benz 1517 Trasero',0.00,1.00,4,0,0,'','2013-05-15',NULL,'6.1.4','1'),(855,1,1,1,1,1,'890','366','Regulador M.Benz 1114 Trasero',0.00,1.00,8,0,0,'','2013-05-15',NULL,'6.1.4','1'),(856,1,1,1,1,1,'891','','Regulador M. Benz 1517 delantero',0.00,1.00,33,0,0,'','2013-05-15',NULL,'6.1.4','1'),(857,1,1,1,1,1,'892','','Regulador M. Benz 1114 delantero',0.00,1.00,7,0,0,'','2013-05-15',NULL,'6.1.4','1'),(858,1,1,1,1,1,'893','672','Traba patin ',0.00,1.00,0,0,0,'','2013-05-15',NULL,'6.1.4','1'),(859,1,1,1,1,1,'11234','11234','Seguro perno de patin ',0.00,1.00,8,0,0,'','2013-05-15',NULL,'6.1.4','1'),(860,1,1,1,1,1,'894','','Tornillos',0.00,1.00,30,0,0,'','2013-05-15',NULL,'6.1.4','1'),(861,1,1,1,1,1,'895','1300/8','Perno de anclaje M. Benz 1517 Super',0.00,1.00,12,0,0,'','2013-05-15',NULL,'6.1.4','1'),(862,1,1,1,1,1,'896','','Piston exterior freno disco ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'6.1.4','1'),(863,1,1,1,1,1,'897','201293','Perno anclaje ',0.00,1.00,4,0,0,'','2013-05-15',NULL,'6.1.4','1'),(864,1,1,1,1,1,'898','1300/1','Perno de anclaje Acoplado',0.00,1.00,13,0,0,'','2013-05-15',NULL,'6.1.4','1'),(865,1,1,1,1,1,'899','','Excentrico de patin ',0.00,1.00,4,0,0,'','2013-05-15',NULL,'6.1.4','1'),(866,1,1,1,1,1,'900','H5084','Resorte patin grande',0.00,1.00,32,0,0,'','2013-05-15',NULL,'6.1.5','1'),(867,1,1,1,1,1,'901','201299','Resorte patin Helvetica',0.00,1.00,46,0,0,'','2013-05-15',NULL,'6.1.5','1'),(868,1,1,1,1,1,'902','201298/1','Resorte retraccion ',0.00,1.00,38,0,0,'','2013-05-15',NULL,'6.1.5','1'),(869,1,1,1,1,1,'903','H5082','Resorte chico',0.00,1.00,49,0,0,'','2013-05-15',NULL,'6.1.5','1'),(870,1,1,1,1,1,'904','607041','Resorte Ford Cargo/Zapata frenos',0.00,1.00,86,0,0,'','2013-05-15',NULL,'6.1.5','1'),(871,1,1,1,1,1,'905','A-3001','Abrazadera aluminio',0.00,1.00,440,0,0,'','2013-05-15',NULL,'6.1.6','1'),(872,1,1,1,1,1,'906','R2020','Valvula de transferencia',0.00,1.00,37,0,0,'','2013-05-15',NULL,'6.1.6','1'),(873,1,1,1,1,1,'907','','Bulones de maza',0.00,1.00,41,0,0,'','2013-05-15',NULL,'6.1.6','1'),(874,1,1,1,1,1,'908','','Bulon de rueda completo',0.00,1.00,15,0,0,'','2013-05-15',NULL,'6.1.6','1'),(875,1,1,1,1,1,'909','','Caja reguladora',0.00,1.00,4,0,0,'','2013-05-15',NULL,'6.2.1','1'),(876,1,1,1,1,1,'910','F2812','Caja reguladora M. Benz Trasera derecha',0.00,1.00,1,0,0,'','2013-05-15',NULL,'6.2.1','1'),(877,1,1,1,1,1,'911','F2808','Caja reguladora M. Benz 1113 Trasera izquierda',0.00,1.00,2,0,0,'','2013-05-15',NULL,'6.2.1','1'),(878,1,1,1,1,1,'912','F2824','Cala reguladora M.Benz 1112-1113 Delantera derecha',0.00,1.00,1,0,0,'','2013-05-15',NULL,'6.2.1','1'),(879,1,1,1,1,1,'2021','','Caja reguladora master',0.00,1.00,3,0,0,'','2013-05-15',NULL,'6.2.1','1'),(880,1,1,1,1,1,'913','1601132','Caja reguladora Galdehs M. Benz 38 aut.',0.00,1.00,1,0,0,'','2013-05-15',NULL,'6.2.1','1'),(881,1,1,1,1,1,'914','F2809','Caja reguladora M. Benz 1113 Trasero derecho',0.00,1.00,1,0,0,'','2013-05-15',NULL,'6.2.1','1'),(882,1,1,1,1,1,'915','','Cajas reguladoras reparadas',0.00,1.00,8,0,0,'','2013-05-15',NULL,'6.2.1','1'),(883,1,1,1,1,1,'916','','Caja reguladora master ( larga)',0.00,1.00,1,0,0,'','2013-05-15',NULL,'6.2.1','1'),(884,1,1,1,1,1,'917','','Caja reguladora',0.00,1.00,1,0,0,'','2013-05-15',NULL,'6.2.1','1'),(885,1,1,1,1,1,'918','','Caja reguladora master ( corta)',0.00,1.00,2,0,0,'','2013-05-15',NULL,'6.2.1','1'),(886,1,1,1,1,1,'919','176','Valvula limitadora',0.00,1.00,4,0,0,'','2013-05-15',NULL,'6.2.2','1'),(887,1,1,1,1,1,'920','','Valvula wistinghouse',0.00,1.00,1,0,0,'','2013-05-15',NULL,'6.2.2','1'),(888,1,1,1,1,1,'1955','R1955','Valvula de freno remolque',0.00,1.00,2,0,0,'','2013-05-15',NULL,'6.2.2','1'),(889,1,1,1,1,1,'5331','','Perno guia resorte',0.00,1.00,5,0,0,'','2013-05-15',NULL,'6.2.3','1'),(890,1,1,1,1,1,'1308','1308','Pi?on registro',0.00,1.00,31,0,0,'','2013-05-15',NULL,'6.2.3','1'),(891,1,1,1,1,1,'921','','Tuerca rueda Ford 350',0.00,1.00,10,0,0,'','2013-05-15',NULL,'6.2.3','1'),(892,1,1,1,1,1,'5445','','Perno de anclaje P/Plato de freno ',0.00,1.00,4,0,0,'','2013-05-15',NULL,'6.2.3','1'),(893,1,1,1,1,1,'922','M-124/1','Bulon rueda completo F-350',0.00,1.00,34,0,0,'','2013-05-15',NULL,'6.2.3','1'),(894,1,1,1,1,1,'923','200320/1','Perno orquilla pulmon ',0.00,1.00,4,0,0,'','2013-05-15',NULL,'6.2.3','1'),(895,1,1,1,1,1,'13335','','Conos de palier 9/16\"',0.00,1.00,16,0,0,'','2013-05-15',NULL,'6.2.3','1'),(896,1,1,1,1,1,'13336','','Conos de palier 5/8\"',0.00,1.00,45,0,0,'','2013-05-15',NULL,'6.2.3','1'),(897,1,1,1,1,1,'924','','Bulon de rueda Ford',0.00,1.00,37,0,0,'','2013-05-15',NULL,'6.2.3','1'),(898,1,1,1,1,1,'925','','Tuerca 7/16\"',0.00,1.00,54,0,0,'','2013-05-15',NULL,'6.2.3','1'),(899,1,1,1,1,1,'9343','','Buje perno de anclaje',0.00,1.00,32,0,0,'','2013-05-15',NULL,'6.2.4','1'),(900,1,1,1,1,1,'926','13000/9','Perno de anclaje',0.00,1.00,41,0,0,'','2013-05-15',NULL,'6.2.4','1'),(901,1,1,1,1,1,'927','','Conexiones varias y pistones de bombas',0.00,1.00,250,0,0,'','2013-05-15',NULL,'3.4.7','1'),(902,1,1,1,1,1,'928','113/6','Tornillo tensor',0.00,1.00,13,0,0,'','2013-05-15',NULL,'6.2.4','1'),(903,1,1,1,1,1,'7685','','Tornillo sujeta campana a masa (completo)',0.00,1.00,35,0,0,'','2013-05-15',NULL,'6.2.5','1'),(904,1,1,1,1,1,'929','','Bulon de rueda completo (A)',0.00,1.00,13,0,0,'','2013-05-15',NULL,'6.2.5','1'),(905,1,1,1,1,1,'930','','Bulon de rueda completo (B)',0.00,1.00,15,0,0,'','2013-05-15',NULL,'6.2.5','1'),(906,1,1,1,1,1,'931','','Bulon de rueda completo (C)',0.00,1.00,8,0,0,'','2013-05-15',NULL,'6.2.5','1'),(907,1,1,1,1,1,'932','M-26/1','Bulon Ford 600',0.00,1.00,8,0,0,'','2013-05-15',NULL,'6.2.5','1'),(908,1,1,1,1,1,'933','M-149/1','Tuerca bulon F-600 rosca izquierda',0.00,1.00,15,0,0,'','2013-05-15',NULL,'6.2.5','1'),(909,1,1,1,1,1,'934','M-173','Tuerca reforma F-600 rosca derecha',0.00,1.00,8,0,0,'','2013-05-15',NULL,'6.2.5','1'),(910,1,1,1,1,1,'935','9043/13','Bulon de rueda ',0.00,1.00,16,0,0,'','2013-05-15',NULL,'6.2.5','1'),(911,1,1,1,1,1,'936','648','Bulon rueda disco 22x80mm ',0.00,1.00,10,0,0,'','2013-05-15',NULL,'6.2.5','1'),(912,1,1,1,1,1,'937','641','Bulon de rueda Randon completo',0.00,1.00,84,0,0,'','2013-05-15',NULL,'6.2.5','1'),(913,1,1,1,1,1,'938','627/1','Bulon rueda disco Scania 7/8x92mm',0.00,1.00,11,0,0,'','2013-05-15',NULL,'6.2.5','1'),(914,1,1,1,1,1,'1055','1055','Bulon de rueda completo',0.00,1.00,57,0,0,'','2013-05-15',NULL,'6.2.5','1'),(915,1,1,1,1,1,'939','','Bulon de rueda',0.00,1.00,11,0,0,'','2013-05-15',NULL,'6.2.5','1'),(916,1,1,1,1,1,'940','306','Regulador patin Berford Tras.',0.00,1.00,7,0,0,'','2013-05-15',NULL,'6.2.5','1'),(917,1,1,1,1,1,'5580','558','Bulon Maldonado ',0.00,1.00,13,0,0,'','2013-05-15',NULL,'6.2.5','1'),(918,1,1,1,1,1,'9052','','Bulon artillero',0.00,1.00,10,0,0,'','2013-05-15',NULL,'6.2.5','1'),(919,1,1,1,1,1,'2420','242','Bulon rueda artillero',0.00,1.00,30,0,0,'','2013-05-15',NULL,'6.2.5','1'),(920,1,1,1,1,1,'948','','Bulon artillero',0.00,1.00,6,0,0,'','2013-05-15',NULL,'6.2.5','1'),(921,1,1,1,1,1,'9016','9016','Bulon artillero 3/4\"',0.00,1.00,11,0,0,'','2013-05-15',NULL,'6.2.5','1'),(922,1,1,1,1,1,'949','','Bulon artillero',0.00,1.00,13,0,0,'','2013-05-15',NULL,'6.2.5','1'),(923,1,1,1,1,1,'950','','Bulon artillero',0.00,1.00,15,0,0,'','2013-05-15',NULL,'6.2.5','1'),(924,1,1,1,1,1,'951','87/B','Bulon artillero Scania',0.00,1.00,39,0,0,'','2013-05-15',NULL,'6.2.5','1'),(925,1,1,1,1,1,'952','87/C','Bulon artillero completo',0.00,1.00,14,0,0,'','2013-05-15',NULL,'6.2.5','1'),(926,1,1,1,1,1,'953','1590/5','Manguera de goma 1/2\"',0.00,1.00,100,0,0,'','2013-05-15',NULL,'6.2.6','1'),(927,1,1,1,1,1,'954','1590/5','Manguera de goma 3/8\"',0.00,1.00,30,0,0,'','2013-05-15',NULL,'6.2.6','1'),(928,1,1,1,1,1,'955','1590/5','Manguera de goma 3/4\"',0.00,1.00,5,0,0,'','2013-05-15',NULL,'6.2.6','1'),(929,1,1,1,1,1,'956','1590/5','Manguera de goma 13mm',0.00,1.00,5,0,0,'','2013-05-15',NULL,'6.2.6','1'),(930,1,1,1,1,1,'957','','Bandeja con bulones completos',0.00,1.00,18,0,0,'','2013-05-15',NULL,'6.2.7','1'),(931,1,1,1,1,1,'958','','Repuestos pedalera',0.00,1.00,50,0,0,'','2013-05-15',NULL,'6.2.7','1'),(932,1,1,1,1,1,'959','P-21','Plato de freno completo R21',0.00,1.00,4,0,0,'','2013-05-15',NULL,'6.3.1','1'),(933,1,1,1,1,1,'960','P-21','Plato de freno ( solo)',0.00,1.00,2,0,0,'','2013-05-15',NULL,'6.3.1','1'),(934,1,1,1,1,1,'961','','Disco de freno Dogde 1500',0.00,1.00,1,0,0,'','2013-05-15',NULL,'6.3.1','1'),(935,1,1,1,1,1,'962','','Disco freno ventilado',0.00,1.00,1,0,0,'','2013-05-15',NULL,'6.3.1','1'),(936,1,1,1,1,1,'963','','Disco freno delantero',0.00,1.00,1,0,0,'','2013-05-15',NULL,'6.3.1','1'),(937,1,1,1,1,1,'9630','','Plato de freno completo ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'6.3.1','1'),(938,1,1,1,1,1,'15600','DM156-B','Valvula protectora sobrepresion',0.00,1.00,11,0,0,'','2013-05-15',NULL,'6.3.2','1'),(939,1,1,1,1,1,'965','526/25','Gatillo',0.00,1.00,1,0,0,'','2013-05-15',NULL,'6.3.2','1'),(940,1,1,1,1,1,'966','','Pico racord 3/4x3/4\"',0.00,1.00,7,0,0,'','2013-05-15',NULL,'6.3.2','1'),(941,1,1,1,1,1,'967','515331','Tapa inferior valvula triller',0.00,1.00,2,0,0,'','2013-05-15',NULL,'6.3.2','1'),(942,1,1,1,1,1,'102016','102016','Hembra 5 vias triller',0.00,1.00,3,0,0,'','2013-05-15',NULL,'6.3.2','1'),(943,1,1,1,1,1,'102015','102015','Macho 5 vias triller',0.00,1.00,1,0,0,'','2013-05-15',NULL,'6.3.2','1'),(944,1,1,1,1,1,'1650','R1650','Valvula de descarga rapida',0.00,1.00,65,0,0,'','2013-05-15',NULL,'6.3.3,4','1'),(945,1,1,1,1,1,'969','','Esparrago Dogde',0.00,1.00,12,0,0,'','2013-05-15',NULL,'6.3.3','1'),(946,1,1,1,1,1,'970','115/1','Esparrago de palier',0.00,1.00,39,0,0,'','2013-05-15',NULL,'6.3.3','1'),(947,1,1,1,1,1,'9261','9261','Cono de esparrago',0.00,1.00,39,0,0,'','2013-05-15',NULL,'6.3.3','1'),(948,1,1,1,1,1,'8392','839','Guia de llantas',0.00,1.00,26,0,0,'','2013-05-15',NULL,'6.3.3','1'),(949,1,1,1,1,1,'973','','Esparrago y tuerca de palier 1114',0.00,1.00,29,0,0,'','2013-05-15',NULL,'6.3.3','1'),(950,1,1,1,1,1,'974','','Esparrago de palier 1114',0.00,1.00,24,0,0,'','2013-05-15',NULL,'6.3.3','1'),(951,1,1,1,1,1,'976','98/5','Bulon 3/4\" completo',0.00,1.00,170,0,0,'','2013-05-15',NULL,'6.3.3','1'),(952,1,1,1,1,1,'975','','Reparacion descarga val. rapida triller',0.00,1.00,4,0,0,'','2013-05-15',NULL,'6.3.3','1'),(953,1,1,1,1,1,'100520','','Reparacion val. Descarga rapida Frepilco',0.00,1.00,35,0,0,'','2013-05-15',NULL,'6.3.3','1'),(954,1,1,1,1,1,'100501','','Reparacion val. Descarga rapida Frepilco',0.00,1.00,27,0,0,'','2013-05-15',NULL,'6.3.3','1'),(955,1,1,1,1,1,'978','1604/B','Eje caja reguladora',0.00,1.00,14,0,0,'','2013-05-15',NULL,'6.3.5','1'),(956,1,1,1,1,1,'977','1604/1','Sinfin Prati',0.00,1.00,37,0,0,'','2013-05-15',NULL,'6.3.5','1'),(957,1,1,1,1,1,'201903','','Sinfin Frepilco',0.00,1.00,11,0,0,'','2013-05-15',NULL,'6.3.5','1'),(958,1,1,1,1,1,'979','','Esparragos y conos varios',0.00,1.00,50,0,0,'','2013-05-15',NULL,'6.3.6','1'),(959,1,1,1,1,1,'980','','Esparragos varios',0.00,1.00,50,0,0,'','2013-05-15',NULL,'6.3.6','1'),(960,1,1,1,1,1,'981','','Reparaciones triller varias',0.00,1.00,30,0,0,'','2013-05-15',NULL,'6.3.6','1'),(961,1,1,1,1,1,'982','2401231','Plato',0.00,1.00,6,0,0,'','2013-05-15',NULL,'6.4.1','1'),(962,1,1,1,1,1,'102100','102100','Acople completo 7 fases triller',0.00,1.00,6,0,0,'','2013-05-15',NULL,'6.4.2','1'),(963,1,1,1,1,1,'102115','102115','Acople macho 7 fases triller',0.00,1.00,1,0,0,'','2013-05-15',NULL,'6.4.2','1'),(964,1,1,1,1,1,'19081','1908/1','Soporte de acople ',0.00,1.00,9,0,0,'','2013-05-15',NULL,'6.4.2','1'),(965,1,1,1,1,1,'1018','','Soporte excentrico plato Maldonado',0.00,1.00,2,0,0,'','2013-05-15',NULL,'6.4.2','1'),(966,1,1,1,1,1,'101820','101820','Soporte acople grande',0.00,1.00,7,0,0,'','2013-05-15',NULL,'6.4.2','1'),(967,1,1,1,1,1,'2410','R-2410','Reparacion valvula',0.00,1.00,2,0,0,'','2013-05-15',NULL,'6.4.2','1'),(968,1,1,1,1,1,'102600','','Valvula retencion',0.00,1.00,2,0,0,'','2013-05-15',NULL,'6.4.2','1'),(969,1,1,1,1,1,'1019','','Soporte',0.00,1.00,2,0,0,'','2013-05-15',NULL,'6.4.2','1'),(970,1,1,1,1,1,'18001','R-1800','Acople americano 1/2\" servicio (NPT)',0.00,1.00,4,0,0,'','2013-05-15',NULL,'6.4.2','1'),(971,1,1,1,1,1,'18701','R-1870','Acople camion c/retencion (amarillo M-16)',0.00,1.00,4,0,0,'','2013-05-15',NULL,'6.4.2','1'),(972,1,1,1,1,1,'18021','R-1802','Acople americano emergencia 1/2\" (NPT)',0.00,1.00,5,0,0,'','2013-05-15',NULL,'6.4.2','1'),(973,1,1,1,1,1,'18721','R-1872','Acople americano camion c/retencion ( rojo M-16)',0.00,1.00,6,0,0,'','2013-05-15',NULL,'6.4.2','1'),(974,1,1,1,1,1,'18101','R-1810','Reparacion acople americano',0.00,1.00,12,0,0,'','2013-05-15',NULL,'6.4.3','1'),(975,1,1,1,1,1,'1028','','Seguros seguer varios',0.00,1.00,19,0,0,'','2013-05-15',NULL,'6.4.3','1'),(976,1,1,1,1,1,'1021','','Repuestos varios ',0.00,1.00,60,0,0,'','2013-05-15',NULL,'6.4.3','1'),(977,1,1,1,1,1,'10772','','Pico racord 1/2x1/2\"',0.00,1.00,32,0,0,'','2013-05-15',NULL,'6.4.5','1'),(978,1,1,1,1,1,'1615','1615','Tornillo de cinta 3/8\"',0.00,1.00,230,0,0,'','2013-05-15',NULL,'6.4.5','1'),(979,1,1,1,1,1,'10777','','Pico racord 3/8x1/2\"',0.00,1.00,140,0,0,'','2013-05-15',NULL,'6.4.5','1'),(980,1,1,1,1,1,'200306','','Tornillo aro pulmon',0.00,1.00,147,0,0,'','2013-05-15',NULL,'6.4.5','1'),(981,1,1,1,1,1,'1208','','Buje nylon Randon',0.00,1.00,11,0,0,'','2013-05-15',NULL,'6.4.5','1'),(982,1,1,1,1,1,'01225','','Buje bronce Randon',0.00,1.00,22,0,0,'','2013-05-15',NULL,'6.4.5','1'),(983,1,1,1,1,1,'0152','','Buje hierro Randon',0.00,1.00,16,0,0,'','2013-05-15',NULL,'6.4.5','1'),(984,1,1,1,1,1,'2012861','201286/1','Buje conico Randon',0.00,1.00,13,0,0,'','2013-05-15',NULL,'6.4.5','1'),(985,1,1,1,1,1,'1022','','Rueda caja reguladora',0.00,1.00,30,0,0,'','2013-05-15',NULL,'6.4.5','1'),(986,1,1,1,1,1,'1035','1035','Tapa grasera F250-F350',0.00,1.00,18,0,0,'','2013-05-15',NULL,'6.4.5','1'),(987,1,1,1,1,1,'0418','0418STD','Cinta de freno Scania 6 mm estandar',0.00,1.00,80,0,0,'','2013-05-15',NULL,'3.3.6','1'),(988,1,1,1,1,1,'04181','0418X','Cinta de freno Scania 6 mm en 1? medida',0.00,1.00,40,0,0,'','2013-05-15',NULL,'3.3.6','1'),(989,1,1,1,1,1,'04182','0418XX (Cobreq)','Cinta de freno Scania 6 mm (SV/226 Frasle) en 2? medida',0.00,1.00,24,0,0,'','2013-05-15',NULL,'3.3.6','1'),(990,1,1,1,1,1,'04183','0418XXX','Cinta de freno Scania 6 mm en 3? medida',0.00,1.00,8,0,0,'','2013-05-15',NULL,'3.3.6','1'),(991,1,1,1,1,1,'04180','0418STD','Cinta de freno Scania 8mm Estandar',0.00,1.00,28,0,0,'','2013-05-15',NULL,'3.4.6','1'),(992,1,1,1,1,1,'04184','0418X','Cinta de freno Scania 8mm en 1? medida',0.00,1.00,40,0,0,'','2013-05-15',NULL,'3.4.6','1'),(993,1,1,1,1,1,'04185','0418XX','Cinta de freno Scania 8mm en 2? medida',0.00,1.00,20,0,0,'','2013-05-15',NULL,'3.4.6','1'),(994,1,1,1,1,1,'0461','0461STD','Cinta de freno Scania 6mm Estandar',0.00,1.00,52,0,0,'','2013-05-15',NULL,'3.2.4','1'),(995,1,1,1,1,1,'04610','0461X','Cinta de freno Scania en 1? medida',0.00,1.00,76,0,0,'','2013-05-15',NULL,'3.2.4','1'),(996,1,1,1,1,1,'04611','0461XX','Cinta de freno Scania en 2 ? medida',0.00,1.00,28,0,0,'','2013-05-15',NULL,'3.2.4','1'),(997,1,1,1,1,1,'04612','0461XXX','Cinta de freno Scania en 3 ? medida',0.00,1.00,48,0,0,'','2013-05-15',NULL,'3.3.4','1'),(998,1,1,1,1,1,'04613','0461STD','Cinta de freno Scania estandar 8mm',0.00,1.00,36,0,0,'','2013-05-15',NULL,'3.3.4','1'),(999,1,1,1,1,1,'04614','0461X','Cinta de freno Scania 1? medida 8mm',0.00,1.00,80,0,0,'','2013-05-15',NULL,'3.3.4','1'),(1000,1,1,1,1,1,'04615','0461XX','Cinta de freno Scania 2? medida 8mm',0.00,1.00,48,0,0,'','2013-05-15',NULL,'4.3.2','1'),(1001,1,1,1,1,1,'04616','0461XXX','Cinta de freno Scania 3? medida 8mm',0.00,1.00,28,0,0,'','2013-05-15',NULL,'4.3.2','1'),(1002,1,1,1,1,1,'47182','4718XX','Cinta de freno en 2? medida 6mm Semi-Acoplado',0.00,1.00,160,0,0,'','2013-05-15',NULL,'4.5.2','1'),(1003,1,1,1,1,1,'47181','4718X','Cinta de freno en 1? medida 6mm Semi-Acoplado',0.00,1.00,176,0,0,'','2013-05-15',NULL,'4.5.2','1'),(1004,1,1,1,1,1,'4718','4718STD','Cinta de freno estandar ',0.00,1.00,96,0,0,'','2013-05-15',NULL,'4.5.2','1'),(1005,1,1,1,1,1,'46444','4644XXXX','Cinta de freno en 4? medida 8mm Acoplado-semi (espesor 25mm)(SA32Frasle)',0.00,1.00,14,0,0,'','2013-05-15',NULL,'4.5.3','1'),(1006,1,1,1,1,1,'46443','4644XXX','Cinta de freno en 3? medida 8mm Acoplado-semi (espesor 23mm)(SA32Frasle)',0.00,1.00,10,0,0,'','2013-05-15',NULL,'4.5.3','1'),(1007,1,1,1,1,1,'46442','4644XX','Cinta de freno en 2?medida8mm Acoplado-semi(espesor 21,8mm)(SA32Frasle)',0.00,1.00,24,0,0,'','2013-05-15',NULL,'4.5.3','1'),(1008,1,1,1,1,1,'46441','4644X','Cinta de freno en 1?medida8mm Acoplado-semi(espesor 20,2mm)(SA32Frasle)',0.00,1.00,88,0,0,'','2013-05-15',NULL,'4.5.3','1'),(1009,1,1,1,1,1,'46445','4644STD','Cinta de freno estandar 8mm Acoplado-Semi (espesor 19mm)(SA32 Frasle)',0.00,1.00,23,0,0,'','2013-05-15',NULL,'4.6.3','1'),(1010,1,1,1,1,1,'46440','4644STD','Cinta de freno estandar 8mm Acoplado-Semi (espesor 18,6mm)(SA32 Frasle)',0.00,1.00,2,0,0,'','2013-05-15',NULL,'4.6.3','1'),(1011,1,1,1,1,1,'4644','4644STD','Cinta de freno estandar 8mm Acoplado-Semi (espesor 17,6mm)(SA32 Frasle)',0.00,1.00,36,0,0,'','2013-05-15',NULL,'4.6.3','1'),(1012,1,1,1,1,1,'46446','4446HSTD(4533T)','Cinta de freno estandar semi-Acoplado 6mm',0.00,1.00,88,0,0,'','2013-05-15',NULL,'4.1.4','1'),(1013,1,1,1,1,1,'06121','0612X','Cinta de freno en 1? medida 6mm ',0.00,1.00,96,0,0,'','2013-05-15',NULL,'4.1.5','1'),(1014,1,1,1,1,1,'06122','0612XX','Cinta de freno en 2? medida 6mm ( espesor 22mm)',0.00,1.00,136,0,0,'','2013-05-15',NULL,'4.1.5','1'),(1015,1,1,1,1,1,'7,89268E+12','0811STD','Cinta de freno estandar 6mm',0.00,1.00,12,0,0,'','2013-05-15',NULL,'4.2.4','1'),(1016,1,1,1,1,1,'0811','0811X-FD/77-X(Frasle)','Cinta de freno 1? medida 6mm',0.00,1.00,32,0,0,'','2013-05-15',NULL,'4.2.4','1'),(1017,1,1,1,1,1,'08112','0811XX','Cinta de freno 2? medida 6mm',0.00,1.00,32,0,0,'','2013-05-15',NULL,'4.2.4','1'),(1018,1,1,1,1,1,'0812','0812STD','Cinta de freno estandar Ford-VW 6mm',0.00,1.00,104,0,0,'','2013-05-15',NULL,'4.2.4','1'),(1019,1,1,1,1,1,'08121','0812X','Cinta de freno 1? medida Ford-VW 6mm',0.00,1.00,72,0,0,'','2013-05-15',NULL,'4.2.4','1'),(1020,1,1,1,1,1,'0811','0811STD','Cinta de freno estandar Ford-VW 6mm',0.00,1.00,12,0,0,'','2013-05-15',NULL,'4.2.4','1'),(1021,1,1,1,1,1,'08111','0811X','Cinta de freno 1? medida Ford-VW 6mm',0.00,1.00,24,0,0,'','2013-05-15',NULL,'4.2.4','1'),(1022,1,1,1,1,1,'07241','0724X','Cinta de freno 1? medida 6mm Volvo',0.00,1.00,48,0,0,'','2013-05-15',NULL,'4.1.3','1'),(1023,1,1,1,1,1,'07240','0724STD','Cinta de freno estandar 6mm Volvo',0.00,1.00,32,0,0,'','2013-05-15',NULL,'4.2.3','1'),(1024,1,1,1,1,1,'07231','0723X','Cinta de freno 1? medida 6mm Volvo',0.00,1.00,88,0,0,'','2013-05-15',NULL,'4.2.3','1'),(1025,1,1,1,1,1,'07230','0723STD','Cinta de freno estandar 8mm Volvo',0.00,1.00,88,0,0,'','2013-05-15',NULL,'4.2.3','1'),(1026,1,1,1,1,1,'07222','0722XX','Cinta de freno en 2? medida 6mm Volvo',0.00,1.00,12,0,0,'','2013-05-15',NULL,'4.3.3','1'),(1027,1,1,1,1,1,'07221','0722X','Cinta de freno en 1? medida 6mm Volvo',0.00,1.00,16,0,0,'','2013-05-15',NULL,'4.2.3','1'),(1028,1,1,1,1,1,'0722','0722STD','Cinta de freno estandar 6mm Volvo',0.00,1.00,48,0,0,'','2013-05-15',NULL,'4.3.3','1'),(1029,1,1,1,1,1,'04722','0472XX','Cinta de freno en 2? medida 6mm Volvo',0.00,1.00,36,0,0,'','2013-05-15',NULL,'4.3.3','1'),(1030,1,1,1,1,1,'04721','0472X','Cinta de freno en 1? medida 6mm Volvo',0.00,1.00,56,0,0,'','2013-05-15',NULL,'4.4.3','1'),(1031,1,1,1,1,1,'04720','0472STD','Cinta de freno estandar 6mm Volvo',0.00,1.00,32,0,0,'','2013-05-15',NULL,'4.4.3','1'),(1032,1,1,1,1,1,'04712','0471XX','Cinta de freno en 2? medida 6mm Volvo',0.00,1.00,16,0,0,'','2013-05-15',NULL,'4.4.3','1'),(1033,1,1,1,1,1,'04711','0471X','Cinta de freno en 1? medida 6mm Volvo',0.00,1.00,16,0,0,'','2013-05-15',NULL,'4.4.3','1'),(1034,1,1,1,1,1,'0471','0471STD','Cinta de freno estandar 6mm Volvo',0.00,1.00,24,0,0,'','2013-05-15',NULL,'4.4.3','1'),(1035,1,1,1,1,1,'07103','0710XXX','Cinta de freno en 3? medida Scania 8mm',0.00,1.00,12,0,0,'','2013-05-15',NULL,'4.1.2','1'),(1036,1,1,1,1,1,'07102','0710XX','Cinta de freno en 2? medida Scania 8mm',0.00,1.00,24,0,0,'','2013-05-15',NULL,'4.1.2','1'),(1037,1,1,1,1,1,'07101','0710X','Cinta de freno en 1? medida Scania 8mm',0.00,1.00,16,0,0,'','2013-05-15',NULL,'4.1.2','1'),(1038,1,1,1,1,1,'0710','0710STD','Cinta de freno estandar Scania 6mm ',0.00,1.00,52,0,0,'','2013-05-15',NULL,'4.1.2','1'),(1039,1,1,1,1,1,'07104','0710XX','Cinta de freno en 2? medida Scania 6mm',0.00,1.00,40,0,0,'','2013-05-15',NULL,'4.1.2','1'),(1040,1,1,1,1,1,'1023','V012STD','Cinta de freno Volvo estandar 6mm',0.00,1.00,8,0,0,'','2013-05-15',NULL,'4.1.3','1'),(1041,1,1,1,1,1,'1024','V012X','Cinta de freno Volvo 1? medida 6mm',0.00,1.00,24,0,0,'','2013-05-15',NULL,'4.1.3','1'),(1042,1,1,1,1,1,'1025','V014STD','Cinta de freno estandar 6mm',0.00,1.00,8,0,0,'','2013-05-15',NULL,'4.1.3','1'),(1043,1,1,1,1,1,'1026','V014X','Cinta de freno en 1? medida 6mm',0.00,1.00,8,0,0,'','2013-05-15',NULL,'4.1.3','1'),(1044,1,1,1,1,1,'7,89268E+13','4707STD','Cinta de freno especial  estandar Scania 6mm',0.00,1.00,20,0,0,'','2013-05-15',NULL,'4.3.2','1'),(1045,1,1,1,1,1,'7,89268E+13','4707X','Cinta de freno en 1? medida Scania 6mm',0.00,1.00,40,0,0,'','2013-05-15',NULL,'4.3.2','1'),(1046,1,1,1,1,1,'7,89268E+13','4707XX','Cinta de freno en 2? medida Scania 6mm',0.00,1.00,24,0,0,'','2013-05-15',NULL,'4.3.2','1'),(1047,1,1,1,1,1,'4707','4707X','Cinta de freno en 1? medida scania 6mm (Tanque espa?ol)',0.00,1.00,4,0,0,'','2013-05-15',NULL,'4.3.2','1'),(1048,1,1,1,1,1,'0612','0612STD','Cinta de freno estandar 8mm ',0.00,1.00,64,0,0,'','2013-05-15',NULL,'4.2.5','1'),(1049,1,1,1,1,1,'07202','0720XX','Cinta de freno en 2? medida 6mm',0.00,1.00,16,0,0,'','2013-05-15',NULL,'4.2.5','1'),(1050,1,1,1,1,1,'07201','0720X','Cinta de freno en 1? medida 6mm',0.00,1.00,16,0,0,'','2013-05-15',NULL,'4.2.5','1'),(1051,1,1,1,1,1,'0720','0720STD','Cinta de freno estandar 6mm',0.00,1.00,8,0,0,'','2013-05-15',NULL,'4.2.5','1'),(1052,1,1,1,1,1,'08152','0815XX','Cinta de freno en 2? medida 6mm',0.00,1.00,72,0,0,'','2013-05-15',NULL,'4.3.4','1'),(1053,1,1,1,1,1,'08151','0815X','Cinta de freno en 1? medida 6mm',0.00,1.00,32,0,0,'','2013-05-15',NULL,'4.3.4','1'),(1054,1,1,1,1,1,'0815','0815STD','Cinta de freno estandar 6mm',0.00,1.00,160,0,0,'','2013-05-15',NULL,'4.3.4','1'),(1055,1,1,1,1,1,'04632','0463XX','Cinta de freno en 2? medida 6mm',0.00,1.00,12,0,0,'','2013-05-15',NULL,'4.3.5','1'),(1056,1,1,1,1,1,'04631','0463X','Cinta de freno en 1? medida 6mm',0.00,1.00,8,0,0,'','2013-05-15',NULL,'4.3.5','1'),(1057,1,1,1,1,1,'0463','0463STD','Cinta de freno estandar 6mm',0.00,1.00,88,0,0,'','2013-05-15',NULL,'4.3.5','1'),(1058,1,1,1,1,1,'1025','','Bolsas Frenos Oeste',0.00,1.00,3,0,0,'','2013-05-15',NULL,'4.1.1','1'),(1059,1,1,1,1,1,'1026','','Cinta de freno especial 6mm (1cm largo-12cm ancho)',0.00,1.00,4,0,0,'','2013-05-15',NULL,'4.3.1','1'),(1060,1,1,1,1,1,'1027','','Cinta de freno especiales ciegas y agujeros 8mm varias',0.00,1.00,10,0,0,'','2013-05-15',NULL,'4.3.1','1'),(1061,1,1,1,1,1,'1028','','Cinta de freno especial ciega 14mm',0.00,1.00,2,0,0,'','2013-05-15',NULL,'4.3.1','1'),(1062,1,1,1,1,1,'1031','','Cinta de freno especial ciega Frenos Oeste 22/13\"',0.00,1.00,3,0,0,'','2013-05-15',NULL,'4.3.1','1'),(1063,1,1,1,1,1,'1033','','Cinta de freno especial varias medidas ',0.00,1.00,40,0,0,'','2013-05-15',NULL,'4.3.1','1'),(1064,1,1,1,1,1,'1034','','Cinta de freno especial (autocar) 6mm',0.00,1.00,7,0,0,'','2013-05-15',NULL,'4.3.1','1'),(1065,1,1,1,1,1,'10199','10199','Cinta de freno delantera Nissan 13mm',0.00,1.00,12,0,0,'','2013-05-15',NULL,'4.3.1','1'),(1066,1,1,1,1,1,'101991','101991','Cinta de freno delantera Nissan 18mm',0.00,1.00,29,0,0,'','2013-05-15',NULL,'4.3.1','1'),(1067,1,1,1,1,1,'1037','X','Cinta de freno especial ciega en 1? medida 7/8\"',0.00,1.00,17,0,0,'','2013-05-15',NULL,'4.4.1','1'),(1068,1,1,1,1,1,'1038','','Cinta de freno especial ciega ',0.00,1.00,3,0,0,'','2013-05-15',NULL,'4.4.1','1'),(1069,1,1,1,1,1,'1040','','Cinta de freno especial c/agujeros',0.00,1.00,7,0,0,'','2013-05-15',NULL,'4.4.1','1'),(1070,1,1,1,1,1,'1041','','Cinta de freno especial ciega ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'4.4.1','1'),(1071,1,1,1,1,1,'1043','','Cinta de freno ciega Fiat importado',0.00,1.00,2,0,0,'','2013-05-15',NULL,'4.4.1','1'),(1072,1,1,1,1,1,'1044','','Cinta de freno especial ciega y c/agujeros (varias medidas)',0.00,1.00,40,0,0,'','2013-05-15',NULL,'4.4.1','1'),(1073,1,1,1,1,1,'1045','','Liquido de freno Varga',0.00,1.00,80,0,0,'','2013-05-15',NULL,'4.6.1','1'),(1074,1,1,1,1,1,'1046','575','Reten M. Benz (15-22-16 T)',0.00,1.00,3,0,0,'','2013-05-15',NULL,'14.3.8','1'),(1075,1,1,1,1,1,'02012','WOL2012','Reten',0.00,1.00,4,0,0,'','2013-05-15',NULL,'14.3.9','1'),(1076,1,1,1,1,1,'1627','TH1627','Reten',0.00,1.00,3,0,0,'','2013-05-15',NULL,'14.3.9','1'),(1077,1,1,1,1,1,'1048','','Reten',0.00,1.00,1,0,0,'','2013-05-15',NULL,'14.3.9','1'),(1078,1,1,1,1,1,'0089','0089','Reten',0.00,1.00,2,0,0,'','2013-05-15',NULL,'14.3.9','1'),(1079,1,1,1,1,1,'1406','TH 1406','Reten',0.00,1.00,2,0,0,'','2013-05-15',NULL,'14.3.9','1'),(1080,1,1,1,1,1,'1678','1678','Reten',0.00,1.00,3,0,0,'','2013-05-15',NULL,'14.3.10','1'),(1081,1,1,1,1,1,'1047','','Reten',0.00,1.00,3,0,0,'','2013-05-15',NULL,'14.3.10','1'),(1082,1,1,1,1,1,'9693','DBH9693','Reten delantero Ford Ranger 4x2 ',0.00,1.00,4,0,0,'','2013-05-15',NULL,'14.4.1','1'),(1083,1,1,1,1,1,'8415','DBH8415','Reten',0.00,1.00,2,0,0,'','2013-05-15',NULL,'14.4.1','1'),(1084,1,1,1,1,1,'01387','SABO0387','Reten Trasero Chev. 400',0.00,1.00,3,0,0,'','2013-05-15',NULL,'14.4.1','1'),(1085,1,1,1,1,1,'01656','SABO01656','Reten delantero Peugeot 504 GR',0.00,1.00,1,0,0,'','2013-05-15',NULL,'14.4.1','1'),(1086,1,1,1,1,1,'02058','SABO02058','Reten estacionamiento zapata M.Benz 1924',0.00,1.00,3,0,0,'','2013-05-15',NULL,'14.4.1','1'),(1087,1,1,1,1,1,'01036','DBH 1036','Reten',0.00,1.00,3,0,0,'','2013-05-15',NULL,'14.4.1','1'),(1088,1,1,1,1,1,'07919','SAB07919-(5463)','Reten delantero Volvo NL10',0.00,1.00,2,0,0,'','2013-05-15',NULL,'14.4.1','1'),(1089,1,1,1,1,1,'1957','DBH1957','Reten',0.00,1.00,1,0,0,'','2013-05-15',NULL,'14.4.1','1'),(1090,1,1,1,1,1,'6072','SAV6072','Reten',0.00,1.00,1,0,0,'','2013-05-15',NULL,'14.4.1','1'),(1091,1,1,1,1,1,'1052','','Retenes varios',0.00,1.00,50,0,0,'','2013-05-15',NULL,'14.4.1','1'),(1092,1,1,1,1,1,'12011417','173320/042','Reten original Corteco',0.00,1.00,2,0,0,'','2013-05-15',NULL,'14.4.1','1'),(1093,1,1,1,1,1,'120110213','33352/042','Reten original Corteco',0.00,1.00,4,0,0,'','2013-05-15',NULL,'14.4.1','1'),(1094,1,1,1,1,1,'07684','07684','Reten delantero M. Benz 370/371',0.00,1.00,3,0,0,'','2013-05-15',NULL,'14.4.2','1'),(1095,1,1,1,1,1,'02385','SABO02385-TH1509','Reten de leva F4000-F1000',0.00,1.00,2,0,0,'','2013-05-15',NULL,'14.4.2','1'),(1096,1,1,1,1,1,'02664','SABO02664','Reten Scania 112',0.00,1.00,2,0,0,'','2013-05-15',NULL,'14.4.2','1'),(1097,1,1,1,1,1,'00188','SABO00188','Reten delantero (masa Ford 4000)',0.00,1.00,4,0,0,'','2013-05-15',NULL,'14.4.2','1'),(1098,1,1,1,1,1,'1049','','Reten',0.00,1.00,1,0,0,'','2013-05-15',NULL,'14.4.2','1'),(1099,1,1,1,1,1,'8474','DBH8474','Reten ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'14.4.2','1'),(1100,1,1,1,1,1,'6073','DBH6073','Reten ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'14.4.2','1'),(1101,1,1,1,1,1,'1907845','','Reten original Scania',0.00,1.00,1,0,0,'','2013-05-15',NULL,'14.4.2','1'),(1102,1,1,1,1,1,'8478','DBH8478','Reten',0.00,1.00,2,0,0,'','2013-05-15',NULL,'14.4.3','1'),(1103,1,1,1,1,1,'7,89125E+12','SABO12219','Reten Scania 110-111',0.00,1.00,1,0,0,'','2013-05-15',NULL,'14.4.3','1'),(1104,1,1,1,1,1,'5470','DBH5470','Reten Ford 600',0.00,1.00,2,0,0,'','2013-05-15',NULL,'14.4.3','1'),(1105,1,1,1,1,1,'1054','','Reten',0.00,1.00,1,0,0,'','2013-05-15',NULL,'14.4.3','1'),(1106,1,1,1,1,1,'01913','1913','Reten ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'14.4.3','1'),(1107,1,1,1,1,1,'02378','SABO02378','Reten',0.00,1.00,1,0,0,'','2013-05-15',NULL,'14.4.3','1'),(1108,1,1,1,1,1,'7,89125E+12','SABO07959','Reten trasero',0.00,1.00,2,0,0,'','2013-05-15',NULL,'14.4.3','1'),(1109,1,1,1,1,1,'1056','','Retenes varios',0.00,1.00,50,0,0,'','2013-05-15',NULL,'14.4.5','1'),(1110,1,1,1,1,1,'01740','SABO01740-TH 1421','Reten delantero M.Benz 1620',0.00,1.00,2,0,0,'','2013-05-15',NULL,'14.4.4','1'),(1111,1,1,1,1,1,'01100316','SABO01100316','Reten trasero Chevrolet C10',0.00,1.00,2,0,0,'','2013-05-15',NULL,'14.4.4','1'),(1112,1,1,1,1,1,'02694','TH2694','Reten ',0.00,1.00,5,0,0,'','2013-05-15',NULL,'14.4.4','1'),(1113,1,1,1,1,1,'01269','TH1269','Reten ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'14.4.4','1'),(1114,1,1,1,1,1,'01870','TH187','Reten ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'14.4.4','1'),(1115,1,1,1,1,1,'7543','SAV7543LX(Nitrilo)','Reten (LX Nitrilo)',0.00,1.00,1,0,0,'','2013-05-15',NULL,'14.4.4','1'),(1116,1,1,1,1,1,'0147','','Reten trasero Ford 1100',0.00,1.00,1,0,0,'','2013-05-15',NULL,'14.1.1','1'),(1117,1,1,1,1,1,'201304','','Reten de leva',0.00,1.00,2,0,0,'','2013-05-15',NULL,'14.1.1','1'),(1118,1,1,1,1,1,'1453','','Reten trasero F350',0.00,1.00,4,0,0,'','2013-05-15',NULL,'14.1.1','1'),(1119,1,1,1,1,1,'0849','','Reten delantero F1100-F Galaxi',0.00,1.00,5,0,0,'','2013-05-15',NULL,'14.1.2','1'),(1120,1,1,1,1,1,'0927','','Reten delantero Peugeot 505',0.00,1.00,5,0,0,'','2013-05-15',NULL,'14.1.2','1'),(1121,1,1,1,1,1,'0479','SO0479','Reten (SABO)',0.00,1.00,4,0,0,'','2013-05-15',NULL,'14.1.2','1'),(1122,1,1,1,1,1,'1594','','Reten trasero F250/350',0.00,1.00,3,0,0,'','2013-05-15',NULL,'14.1.3','1'),(1123,1,1,1,1,1,'01923','','Reten trasero',0.00,1.00,2,0,0,'','2013-05-15',NULL,'14.1.3','1'),(1124,1,1,1,1,1,'01063','','Reten masa semi-Espa?ol',0.00,1.00,10,0,0,'','2013-05-15',NULL,'14.1.4','1'),(1125,1,1,1,1,1,'0853','','Reten delantero F500 / 600 ',0.00,1.00,11,0,0,'','2013-05-15',NULL,'14.1.4','1'),(1126,1,1,1,1,1,'1647','','Reten delantero F350-250 (modelo desde 1976)',0.00,1.00,4,0,0,'','2013-05-15',NULL,'14.1.4','1'),(1127,1,1,1,1,1,'0085','','Reten Ford 600 (SABO)',0.00,1.00,3,0,0,'','2013-05-15',NULL,'14.1.5','1'),(1128,1,1,1,1,1,'01806','','Reten de freno de mano M. Benz',0.00,1.00,3,0,0,'','2013-05-15',NULL,'14.1.5','1'),(1129,1,1,1,1,1,'1498','','Reten delantero F 250/350 61-67',0.00,1.00,7,0,0,'','2013-05-15',NULL,'14.1.5','1'),(1130,1,1,1,1,1,'0824','','Reten trasero M.Benz 6600',0.00,1.00,5,0,0,'','2013-05-15',NULL,'14.1.6','1'),(1131,1,1,1,1,1,'1395','','Reten delantero F-100',0.00,1.00,6,0,0,'','2013-05-15',NULL,'14.1.6','1'),(1132,1,1,1,1,1,'0609','','Reten de palier',0.00,1.00,7,0,0,'','2013-05-15',NULL,'14.1.7','1'),(1133,1,1,1,1,1,'1280','','Reten delantero Falcon',0.00,1.00,1,0,0,'','2013-05-15',NULL,'14.1.7','1'),(1134,1,1,1,1,1,'8954','','Reten ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'14.1.8','1'),(1135,1,1,1,1,1,'0509','','Reten trasero M.Benz 1512',0.00,1.00,7,0,0,'','2013-05-15',NULL,'14.2.1','1'),(1136,1,1,1,1,1,'0544','TH1801','Reten traserro M.Benz 312',0.00,1.00,3,0,0,'','2013-05-15',NULL,'14.2.1','1'),(1137,1,1,1,1,1,'0545','SO2753','Reten delantero M.Benz ',0.00,1.00,4,0,0,'','2013-05-15',NULL,'14.2.1','1'),(1138,1,1,1,1,1,'1906','','Reten M.Benz 1932',0.00,1.00,5,0,0,'','2013-05-15',NULL,'14.2.2','1'),(1139,1,1,1,1,1,'01043','','Reten M.Benz 1517/1112/1114',0.00,1.00,9,0,0,'','2013-05-15',NULL,'14.2.2','1'),(1140,1,1,1,1,1,'01884','','Reten trasero M.Benz 1517 (Todos excepto 1924 a1941-0370/0371)',0.00,1.00,4,0,0,'','2013-05-15',NULL,'14.2.3','1'),(1141,1,1,1,1,1,'02690','','Reten trasero M.Benz (TN.6/7/8/9) ',0.00,1.00,5,0,0,'','2013-05-15',NULL,'14.2.3','1'),(1142,1,1,1,1,1,'01829','','Reten trasero M. Benz 608/609',0.00,1.00,2,0,0,'','2013-05-15',NULL,'14.2.4','1'),(1143,1,1,1,1,1,'02049','','Reten delantero M.Benz 1113/1166/1313',0.00,1.00,5,0,0,'','2013-05-15',NULL,'14.2.4','1'),(1144,1,1,1,1,1,'0516','','Reten M.Benz 1112/1114/1517',0.00,1.00,2,0,0,'','2013-05-15',NULL,'14.2.4','1'),(1145,1,1,1,1,1,'08415','','Reten de leva M.Benz 2423K',0.00,1.00,2,0,0,'','2013-05-15',NULL,'14.2.4','1'),(1146,1,1,1,1,1,'1957','','Reten trasero Scania 112 (doble dif.)',0.00,1.00,5,0,0,'','2013-05-15',NULL,'14.2.5','1'),(1147,1,1,1,1,1,'0464','0464STD','Cinta de freno estandar 6mm',0.00,1.00,88,0,0,'','2013-05-15',NULL,'4.3.5','1'),(1148,1,1,1,1,1,'04662','0466XX','Cinta de freno en 2? medida 6mm',0.00,1.00,88,0,0,'','2013-05-15',NULL,'4.4.4','1'),(1149,1,1,1,1,1,'04642','0464XX','Cinta de freno en 2? medida 6mm',0.00,1.00,32,0,0,'','2013-05-15',NULL,'4.4.4','1'),(1150,1,1,1,1,1,'04641','0464X','Cinta de freno en 1? medida 6mm',0.00,1.00,24,0,0,'','2013-05-15',NULL,'4.4.4','1'),(1151,1,1,1,1,1,'04661','0466X','Cinta de freno en 1? medida 6mm',0.00,1.00,48,0,0,'','2013-05-15',NULL,'4.4.5','1'),(1152,1,1,1,1,1,'0466','0466STD','Cinta de freno estandar 6mm',0.00,1.00,64,0,0,'','2013-05-15',NULL,'4.4.5','1'),(1153,1,1,1,1,1,'08142','0814XX','Cinta de freno en 2? medida 6mm',0.00,1.00,96,0,0,'','2013-05-15',NULL,'4.4.5','1'),(1154,1,1,1,1,1,'08141','0814X-FD/87(Frasle)','Cinta de freno en 1? medida 6mm',0.00,1.00,16,0,0,'','2013-05-15',NULL,'4.4.5','1'),(1155,1,1,1,1,1,'0814','0814STD','Cinta de freno estandar 6mm',0.00,1.00,88,0,0,'','2013-05-15',NULL,'4.4.5','1'),(1156,1,1,1,1,1,'045242','04524','Cinta de freno 8mm (espesor 22,2mm)',0.00,1.00,40,0,0,'','2013-05-15',NULL,'4.5.5','1'),(1157,1,1,1,1,1,'045240','04524','Cinta de freno 8mm (espesor 19 mm)',0.00,1.00,32,0,0,'','2013-05-15',NULL,'4.5.5','1'),(1158,1,1,1,1,1,'04524','04524','Cinta de freno 8mm (espesor 18mm)',0.00,1.00,64,0,0,'','2013-05-15',NULL,'4.5.5','1'),(1159,1,1,1,1,1,'045142','04514XX','Cinta de freno en 2? medida 6mm',0.00,1.00,20,0,0,'','2013-05-15',NULL,'4.6.5','1'),(1160,1,1,1,1,1,'045141','04514X','Cinta de freno en 1? medida 8mm (espesor 20,2mm)',0.00,1.00,80,0,0,'','2013-05-15',NULL,'4.6.5','1'),(1161,1,1,1,1,1,'045140','04514G(Frasle)','Cinta de freno 8mm',0.00,1.00,8,0,0,'','2013-05-15',NULL,'4.6.5','1'),(1162,1,1,1,1,1,'04514','04514STD','Cinta de freno estandar 8 mm (espesor 17,6mm)',0.00,1.00,32,0,0,'','2013-05-15',NULL,'4.6.5','1'),(1163,1,1,1,1,1,'1067','','Cinta de freno especial Frenos Oeste 6mm (F)',0.00,1.00,8,0,0,'','2013-05-15',NULL,'4.6.5','1'),(1164,1,1,1,1,1,'1070','','Cinta de freno especial (G22/18)',0.00,1.00,3,0,0,'','2013-05-15',NULL,'4.6.5','1'),(1165,1,1,1,1,1,'1071','','Cinta de freno especial (F) X25',0.00,1.00,4,0,0,'','2013-05-15',NULL,'4.6.5','1'),(1166,1,1,1,1,1,'1072','','Cinta de freno especial (G)',0.00,1.00,4,0,0,'','2013-05-15',NULL,'4.6.5','1'),(1167,1,1,1,1,1,'1073','','Cinta de freno especial Chiavacci (G) X24',0.00,1.00,4,0,0,'','2013-05-15',NULL,'4.6.5','1'),(1168,1,1,1,1,1,'1076','','Esparragos varios',0.00,1.00,50,0,0,'','2013-05-15',NULL,'6.5.1','1'),(1169,1,1,1,1,1,'1078','','Retenes usados',0.00,1.00,60,0,0,'','2013-05-15',NULL,'6.5.1','1'),(1170,1,1,1,1,1,'101824','','Acople Fiat macho',0.00,1.00,25,0,0,'','2013-05-15',NULL,'6.5.2','1'),(1171,1,1,1,1,1,'1018241','','Acople Fiat macho recto',0.00,1.00,9,0,0,'','2013-05-15',NULL,'6.5.2','1'),(1172,1,1,1,1,1,'101800','','Acople Fiat completo',0.00,1.00,9,0,0,'','2013-05-15',NULL,'6.5.2','1'),(1173,1,1,1,1,1,'2560','N-2560','Tapa grasera ',0.00,1.00,22,0,0,'','2013-05-15',NULL,'6.5.3','1'),(1174,1,1,1,1,1,'1079','','Soporte de pulmon',0.00,1.00,5,0,0,'','2013-05-15',NULL,'6.5.3','1'),(1175,1,1,1,1,1,'2530','N-2530','Tapa grasera Montenegro',0.00,1.00,2,0,0,'','2013-05-15',NULL,'6.5.3','1'),(1176,1,1,1,1,1,'2550','N-2550','Tapa grasera Randon',0.00,1.00,7,0,0,'','2013-05-15',NULL,'6.5.3','1'),(1177,1,1,1,1,1,'2510','N-2510','Tapa grasera Helvetica',0.00,1.00,9,0,0,'','2013-05-15',NULL,'6.5.3','1'),(1178,1,1,1,1,1,'1080','125/1','Soporte rulo de aire',0.00,1.00,9,0,0,'','2013-05-15',NULL,'6.5.3','1'),(1179,1,1,1,1,1,'10233','','Soporte guia de leva S/ buje',0.00,1.00,74,0,0,'','2013-05-15',NULL,'6.5.5','1'),(1180,1,1,1,1,1,'200310','','Orquilla de pulmon ',0.00,1.00,73,0,0,'','2013-05-15',NULL,'6.5.5','1'),(1181,1,1,1,1,1,'2730','N-2730','Tapon de tapa grasera',0.00,1.00,105,0,0,'','2013-05-15',NULL,'6.5.4','1'),(1182,1,1,1,1,1,'2325','2325','O?ring Tapa grasera ',0.00,1.00,14,0,0,'','2013-05-15',NULL,'6.5.4','1'),(1183,1,1,1,1,1,'2640','N-2640','Junta tapa grasera de goma',0.00,1.00,41,0,0,'','2013-05-15',NULL,'6.5.4','1'),(1184,1,1,1,1,1,'201286','201286','Buje conico de leva',0.00,1.00,45,0,0,'','2013-05-15',NULL,'6.5.5','1'),(1185,1,1,1,1,1,'200831','','Buje recto',0.00,1.00,18,0,0,'','2013-05-15',NULL,'6.5.5','1'),(1186,1,1,1,1,1,'201014','','Buje de rodillos (usados)',0.00,1.00,239,0,0,'','2013-05-15',NULL,'6.5.6','1'),(1187,1,1,1,1,1,'1083','','Acople bayoneta 1/4\"',0.00,1.00,5,0,0,'','2013-05-15',NULL,'6.5.6','1'),(1188,1,1,1,1,1,'1087','','Pico racord varios-usados',0.00,1.00,50,0,0,'','2013-05-15',NULL,'6.5.7','1'),(1189,1,1,1,1,1,'1090','','Perno de orquilla (varios)',0.00,1.00,40,0,0,'','2013-05-15',NULL,'6.5.7','1'),(1190,1,1,1,1,1,'1091','','Pernos de anclaje varios-usados',0.00,1.00,105,0,0,'','2013-05-15',NULL,'6.5.6','1'),(1191,1,1,1,1,1,'30382','','Tapa grasera D-100',0.00,1.00,15,0,0,'','2013-05-15',NULL,'6.5.7','1'),(1192,1,1,1,1,1,'1093','','Pulmones reparados',0.00,1.00,19,0,0,'','2013-05-15',NULL,'6.4.4','1'),(1193,1,1,1,1,1,'00130','R-0130','Pulmon auxiliar M.Benz 608',0.00,1.00,0,0,0,'','2013-05-15',NULL,'5.5.5','1'),(1194,1,1,1,1,1,'2005000','','Servos CAFH sin bombas (usados)',0.00,1.00,3,0,0,'','2013-05-15',NULL,'5.5.5','1'),(1195,1,1,1,1,1,'101100','','Pedalera frepilco',0.00,1.00,9,0,0,'','2013-05-15',NULL,'5.5.5','1'),(1196,1,1,1,1,1,'2005001','','Soporte de pedalera',0.00,1.00,3,0,0,'','2013-05-15',NULL,'5.5.5','1'),(1197,1,1,1,1,1,'1095','','Patin de freno 8\" (4644)',0.00,1.00,11,0,0,'','2013-05-15',NULL,'5.5.5','1'),(1198,1,1,1,1,1,'103199','103/199','Valvula relay chata',0.00,1.00,2,0,0,'','2013-05-15',NULL,'15.1.2','1'),(1199,1,1,1,1,1,'75199','75/199','Valvula relay ',0.00,1.00,5,0,0,'','2013-05-15',NULL,'15.1.2','1'),(1200,1,1,1,1,1,'1096','','Valvula relay Fiat 619',0.00,1.00,1,0,0,'','2013-05-15',NULL,'15.1.2','1'),(1201,1,1,1,1,1,'751991','75/199','Valvula relay universal',0.00,1.00,1,0,0,'','2013-05-15',NULL,'15.1.2','1'),(1202,1,1,1,1,1,'83244','83/244','Valvula distribuidora tipo wabco ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'15.2.3','1'),(1203,1,1,1,1,1,'4620','R4620','Valvula 4 vias Knorr',0.00,1.00,7,0,0,'','2013-05-15',NULL,'15.1.2','1'),(1204,1,1,1,1,1,'4001','T4001','Valvula 4 circuitos Wabco',0.00,1.00,6,0,0,'','2013-05-15',NULL,'15.1.2','1'),(1205,1,1,1,1,1,'3702','T3702','Valvula estacionamiento Scania',0.00,1.00,4,0,0,'','2013-05-15',NULL,'15.1.3','1'),(1206,1,1,1,1,1,'1097','','Valvula bloqueo M.Benz ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'15.1.3','1'),(1207,1,1,1,1,1,'9617230210','','Valvula bloqueo wabco',0.00,1.00,2,0,0,'','2013-05-15',NULL,'15.1.3','1'),(1208,1,1,1,1,1,'934705002','','Valvula 6 vias',0.00,1.00,1,0,0,'','2013-05-15',NULL,'15.2.3','1'),(1209,1,1,1,1,1,'1596252','159625/2','Valvula secadora gobernadora c/filtro',0.00,1.00,5,0,0,'','2013-05-15',NULL,'15.1.3','1'),(1210,1,1,1,1,1,'1596252','159625/2','Valvula secador M.Benz',0.00,1.00,0,0,0,'','2013-05-15',NULL,'15.1.3','1'),(1211,1,1,1,1,1,'3528001','3528001','Valvula 4 vias VW Knorr',0.00,1.00,2,0,0,'','2013-05-15',NULL,'15.1.2','1'),(1212,1,1,1,1,1,'2220','T2220','Valvula pedalera Scania serie 4',0.00,1.00,2,0,0,'','2013-05-15',NULL,'15.2.3','1'),(1213,1,1,1,1,1,'1098','4613151580','Valvula pedalera Ford Wabco',0.00,1.00,1,0,0,'','2013-05-15',NULL,'15.2.3','1'),(1214,1,1,1,1,1,'2230','T2230','Pedalera M.Benz',0.00,1.00,1,0,0,'','2013-05-15',NULL,'15.2.3','1'),(1215,1,1,1,1,1,'1099','093/61','Pedalera Fiat modelo nuevo',0.00,1.00,2,0,0,'','2013-05-15',NULL,'15.2.3','1'),(1216,1,1,1,1,1,'7900','R7900','Valvula control Spring',0.00,1.00,2,0,0,'','2013-05-15',NULL,'15.2.3','1'),(1217,1,1,1,1,1,'2420','R-2420','Valvula relay tipo bendix',0.00,1.00,1,0,0,'','2013-05-15',NULL,'15.2.3','1'),(1218,1,1,1,1,1,'2970','R2970','Valvula de pie tipo bendix',0.00,1.00,1,0,0,'','2013-05-15',NULL,'15.2.3','1'),(1219,1,1,1,1,1,'8830','R8830','Valvula eje neumatico (regulador de presion con reloj)',0.00,1.00,1,0,0,'','2013-05-15',NULL,'15.2.1','1'),(1220,1,1,1,1,1,'07261','072/61','Valvula niveladora suspension',0.00,1.00,4,0,0,'','2013-05-15',NULL,'15.2.3','1'),(1221,1,1,1,1,1,'0300','W300','Filtro secador apu',0.00,1.00,6,0,0,'','2013-05-15',NULL,'15.1.1','1'),(1222,1,1,1,1,1,'0250','W250','Filtro secador apu',0.00,1.00,5,0,0,'','2013-05-15',NULL,'15.1.1','1'),(1223,1,1,1,1,1,'1100','','Filtro secador apu rosca izquierda',0.00,1.00,1,0,0,'','2013-05-15',NULL,'15.1.1','1'),(1224,1,1,1,1,1,'13061','130/61','Valvula secadora c/filtro Ford',0.00,1.00,4,0,0,'','2013-05-15',NULL,'15.1.3','1'),(1225,1,1,1,1,1,'2501','250W','Filtro secador original knorr',0.00,1.00,1,0,0,'','2013-05-15',NULL,'15.1.1','1'),(1226,1,1,1,1,1,'3001','300W','Filtro secador original euro bremse',0.00,1.00,1,0,0,'','2013-05-15',NULL,'15.1.1','1'),(1227,1,1,1,1,1,'4501','T4501','Electrovalvula Scania',0.00,1.00,3,0,0,'','2013-05-15',NULL,'15.2.1','1'),(1228,1,1,1,1,1,'301484','301484','Electrovalvula air tac 1/8\"',0.00,1.00,1,0,0,'','2013-05-15',NULL,'15.2.1','1'),(1229,1,1,1,1,1,'3014840','','Electrovalvula air tac 1/4\"',0.00,1.00,0,0,0,'','2013-05-15',NULL,'15.2.1','1'),(1230,1,1,1,1,1,'1101','','Bovina 24 volt Festo',0.00,1.00,3,0,0,'','2013-05-15',NULL,'15.2.1','1'),(1231,1,1,1,1,1,'1103','','Bovina 12 volt Festo',0.00,1.00,1,0,0,'','2013-05-15',NULL,'15.2.1','1'),(1232,1,1,1,1,1,'1104','','Bovina 24 volt Wabco',0.00,1.00,1,0,0,'','2013-05-15',NULL,'15.2.1','1'),(1233,1,1,1,1,1,'62111','6211/1','Electrovalvula festo 1/4\"',0.00,1.00,2,0,0,'','2013-05-15',NULL,'15.2.1','1'),(1234,1,1,1,1,1,'62112','6211/1','Electrovalvula festo 1/8\"',0.00,1.00,1,0,0,'','2013-05-15',NULL,'15.2.1','1'),(1235,1,1,1,1,1,'7950','R7950','Valvula control bendix',0.00,1.00,2,0,0,'','2013-05-15',NULL,'15.2.1','1'),(1236,1,1,1,1,1,'5050','T5050','Valvula drenaje tipo bendix',0.00,1.00,1,0,0,'','2013-05-15',NULL,'15.2.1','1'),(1237,1,1,1,1,1,'26108','26108','Silenciador secador aire apu',0.00,1.00,2,0,0,'','2013-05-15',NULL,'15.2.1','1'),(1238,1,1,1,1,1,'0109','HL-0109','Valvula gobernadora tipo bendix',0.00,1.00,0,0,0,'','2013-05-15',NULL,'15.2.1','1'),(1239,1,1,1,1,1,'01311','HL-0131','Condensador separador',0.00,1.00,1,0,0,'','2013-05-15',NULL,'15.2.1','1'),(1240,1,1,1,1,1,'01221','','Reparacion valvula remolque wabco',0.00,1.00,2,0,0,'','2013-05-15',NULL,'15.2.2','1'),(1241,1,1,1,1,1,'3030891','303089/1','Valvula gobernadora Scania',0.00,1.00,3,0,0,'','2013-05-15',NULL,'15.2.2','1'),(1242,1,1,1,1,1,'20244','20/244','Valvula gobernadora',0.00,1.00,14,0,0,'','2013-05-15',NULL,'15.2.2','1'),(1243,1,1,1,1,1,'103000','103000','Valvula gobernadora',0.00,1.00,1,0,0,'','2013-05-15',NULL,'15.2.2','1'),(1244,1,1,1,1,1,'5116','5116','Reparacion valvula pedalera menor',0.00,1.00,3,0,0,'','2013-05-15',NULL,'15.2.2','1'),(1245,1,1,1,1,1,'5170','5170','Reparacion valvula freno de mano',0.00,1.00,2,0,0,'','2013-05-15',NULL,'15.2.2','1'),(1246,1,1,1,1,1,'5151','5151','Reparacion valvula relay menor Marelli',0.00,1.00,7,0,0,'','2013-05-15',NULL,'15.2.2','1'),(1247,1,1,1,1,1,'4170','4170','Reparacion valvula de freno manual bosch',0.00,1.00,5,0,0,'','2013-05-15',NULL,'15.2.2','1'),(1248,1,1,1,1,1,'5146','5146','Reparacion valvula relay Scania 113 wabco',0.00,1.00,6,0,0,'','2013-05-15',NULL,'15.2.2','1'),(1249,1,1,1,1,1,'02800','R2800','Valvula de pie tipo bendix',0.00,1.00,3,0,0,'','2013-05-15',NULL,'15.2.2','1'),(1250,1,1,1,1,1,'710024','710024','Valvula sensible a la carga (reparada)',0.00,1.00,2,0,0,'','2013-05-15',NULL,'15.1.4','1'),(1251,1,1,1,1,1,'10074','10070','Valvula relay M.Benz original wabco (reparada)',0.00,1.00,1,0,0,'','2013-05-15',NULL,'15.1.4','1'),(1252,1,1,1,1,1,'1105','','Tuerca punta de eje M. Benz 1114 (usada)',0.00,1.00,15,0,0,'','2013-05-15',NULL,'Puntera 1','1'),(1253,1,1,1,1,1,'2028','2028','Arandela punta de eje (usada)',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 1','1'),(1254,1,1,1,1,1,'2027','2027','Arandela punta de eje (usada)',0.00,1.00,2,0,0,'','2013-05-15',NULL,'Puntera 1','1'),(1255,1,1,1,1,1,'1106','','Tueca punta de eje ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'Puntera 1','1'),(1256,1,1,1,1,1,'1107','','Arandela F-350',0.00,1.00,5,0,0,'','2013-05-15',NULL,'Puntera 1','1'),(1257,1,1,1,1,1,'1108','','Tuerca punta de eje',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 1','1'),(1258,1,1,1,1,1,'3166','C-3166','Tueca punta de eje M.Benz 1517',0.00,1.00,3,0,0,'','2013-05-15',NULL,'Puntera 1','1'),(1259,1,1,1,1,1,'1109','','Tuerca punta de eje (usada)',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 1','1'),(1260,1,1,1,1,1,'1110','','Tueca punta de eje',0.00,1.00,4,0,0,'','2013-05-15',NULL,'Puntera 1','1'),(1261,1,1,1,1,1,'1113','','Tuerca Helvetica M/V',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 1','1'),(1262,1,1,1,1,1,'1114','','Tuerca de manga Maldonado',0.00,1.00,15,0,0,'','2013-05-15',NULL,'Puntera 1','1'),(1263,1,1,1,1,1,'1115','','Tuerca punta de eje M.Benz 1114 (usada)',0.00,1.00,2,0,0,'','2013-05-15',NULL,'Puntera 1','1'),(1264,1,1,1,1,1,'1116','','Tuerca de manga Maldonado (con agujeros)',0.00,1.00,4,0,0,'','2013-05-15',NULL,'Puntera 1','1'),(1265,1,1,1,1,1,'1118','','Tuerca punta de eje ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'Puntera 1','1'),(1266,1,1,1,1,1,'1120','','Tuerca punta de eje',0.00,1.00,2,0,0,'','2013-05-15',NULL,'Puntera 1','1'),(1267,1,1,1,1,1,'29690','C-2969','Arandela Maldonado',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 1','1'),(1268,1,1,1,1,1,'1121','','Tuerca de manga ',0.00,1.00,3,0,0,'','2013-05-15',NULL,'Puntera 1','1'),(1269,1,1,1,1,1,'1122','','Tuerca punta de eje ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 1','1'),(1270,1,1,1,1,1,'1123','','Tuerca de manga prati',0.00,1.00,2,0,0,'','2013-05-15',NULL,'Puntera 1','1'),(1271,1,1,1,1,1,'1124','','Tuerca de manga ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 1','1'),(1272,1,1,1,1,1,'1125','','Tuerca de manga',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 1','1'),(1273,1,1,1,1,1,'1126','','Tuerca de manga Volvo',0.00,1.00,2,0,0,'','2013-05-15',NULL,'Puntera 1','1'),(1274,1,1,1,1,1,'5452','C-5452','Arandela ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'Puntera 1','1'),(1275,1,1,1,1,1,'1127','','Arandela punta de eje',0.00,1.00,21,0,0,'','2013-05-15',NULL,'Puntera 1','1'),(1276,1,1,1,1,1,'1128','','Arandela punta de eje',0.00,1.00,2,0,0,'','2013-05-15',NULL,'Puntera 1','1'),(1277,1,1,1,1,1,'1129','','Arandelas',0.00,1.00,9,0,0,'','2013-05-15',NULL,'Puntera 1','1'),(1278,1,1,1,1,1,'1130','','Seguro de manga',0.00,1.00,24,0,0,'','2013-05-15',NULL,'Puntera 1','1'),(1279,1,1,1,1,1,'1131','','Seguro de manga',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 1','1'),(1280,1,1,1,1,1,'5465','C-5465','Seguro de manga M-H',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 1','1'),(1281,1,1,1,1,1,'1132','','Arandela',0.00,1.00,2,0,0,'','2013-05-15',NULL,'Puntera 1','1'),(1282,1,1,1,1,1,'201294','','Patin 7\" 4515',0.00,1.00,2,0,0,'','2013-05-15',NULL,'5.4.4','1'),(1283,1,1,1,1,1,'1133','','Patin 8\" c/cinta 4718XX',0.00,1.00,2,0,0,'','2013-05-15',NULL,'5.4.4','1'),(1284,1,1,1,1,1,'1141','','Patin 8\"4644 ',0.00,1.00,9,0,0,'','2013-05-15',NULL,'5.4.4','1'),(1285,1,1,1,1,1,'3060','F-306','Crucetas',0.00,1.00,9,0,0,'','2013-05-15',NULL,'5.4.4','1'),(1286,1,1,1,1,1,'2013021','','Guardapolvo pando',0.00,1.00,6,0,0,'','2013-05-15',NULL,'5.3.3','1'),(1287,1,1,1,1,1,'2013020','','Guardapolvo semi-profundo',0.00,1.00,10,0,0,'','2013-05-15',NULL,'5.3.3','1'),(1288,1,1,1,1,1,'0330','R-330  ','Ca?o tecalan 6mm',0.00,1.00,1,0,0,'','2013-05-15',NULL,'5.1.1','1'),(1289,1,1,1,1,1,'3301','R-330  ','Ca?o tecalan 1/4\"',0.00,1.00,3,0,0,'','2013-05-15',NULL,'5.1.1','1'),(1290,1,1,1,1,1,'331','R-331','Ca?o tecalan 8mm ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'5.1.1','1'),(1291,1,1,1,1,1,'333','R-333','Ca?o tecalan 12mm ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'5.1.1','1'),(1292,1,1,1,1,1,'3331','R-333','Ca?o tecalan 1/2\"',0.00,1.00,9,0,0,'','2013-05-15',NULL,'5.1.1','1'),(1293,1,1,1,1,1,'332','R-332','Ca?o tecalan 10mm ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'5.2.2','1'),(1294,1,1,1,1,1,'3321','R-332','Ca?o tecalan 3/8\"',0.00,1.00,1,0,0,'','2013-05-15',NULL,'5.2.2','1'),(1295,1,1,1,1,1,'3311','R-331','Ca?o tecalan 5/16\"',0.00,1.00,1,0,0,'','2013-05-15',NULL,'5.2.2','1'),(1296,1,1,1,1,1,'1134','','Manguera celeste 6mm',0.00,1.00,1,0,0,'','2013-05-15',NULL,'5.2.2','1'),(1297,1,1,1,1,1,'1135','','Manguera celeste 10mm ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'5.2.2','1'),(1298,1,1,1,1,1,'1136','','Manguera celeste 4mm ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'5.2.2','1'),(1299,1,1,1,1,1,'1137','','Manguera plastica blanca 3/8\"',0.00,1.00,3,0,0,'','2013-05-15',NULL,'5.2.2','1'),(1300,1,1,1,1,1,'1138','','Manguera plastica blanca 3/4\"',0.00,1.00,2,0,0,'','2013-05-15',NULL,'5.2.2','1'),(1301,1,1,1,1,1,'1139','','Ca?o de cobre 5mm ',0.00,1.00,3,0,0,'','2013-05-15',NULL,'5.2.2','1'),(1302,1,1,1,1,1,'2013023','201302','Guardapolvo Randon',0.00,1.00,3,0,0,'','2013-05-15',NULL,'5.3.3','1'),(1303,1,1,1,1,1,'7390','F-739','Resorte patin superior ( Kombi ) ',0.00,1.00,13,0,0,'','2013-05-15',NULL,'7.1.3','1'),(1304,1,1,1,1,1,'5676','H5676','Resorte largo volteo  M.Benz',0.00,1.00,11,0,0,'','2013-05-15',NULL,'7.1.3','1'),(1305,1,1,1,1,1,'1140','','Resorte grande',0.00,1.00,11,0,0,'','2013-05-15',NULL,'7.1.3','1'),(1306,1,1,1,1,1,'5075','H5075','Resorte zapata salto ',0.00,1.00,19,0,0,'','2013-05-15',NULL,'7.1.3','1'),(1307,1,1,1,1,1,'9750','F-975','Resorte Morris - Siam Ditella ',0.00,1.00,5,0,0,'','2013-05-15',NULL,'7.1.4','1'),(1308,1,1,1,1,1,'9990','F-999-B','Resorte patin trafic ',0.00,1.00,8,0,0,'','2013-05-15',NULL,'7.1.4','1'),(1309,1,1,1,1,1,'9250','F-925-A','Resorte patin Fiat 1500',0.00,1.00,8,0,0,'','2013-05-15',NULL,'7.1.4','1'),(1310,1,1,1,1,1,'0912','F-912-A','Resorte rastrogero ',0.00,1.00,28,0,0,'','2013-05-15',NULL,'7.1.4','1'),(1311,1,1,1,1,1,'7440','F-744','Resorte patin inferior ',0.00,1.00,16,0,0,'','2013-05-15',NULL,'7.1.4','1'),(1312,1,1,1,1,1,'6022','F-602','Resorte F-350 izquierda ',0.00,1.00,40,0,0,'','2013-05-15',NULL,'7.1.4','1'),(1313,1,1,1,1,1,'6010','F-3601','Resorte derecho F-350 ',0.00,1.00,35,0,0,'','2013-05-15',NULL,'7.1.4','1'),(1314,1,1,1,1,1,'6030','f-603','Resorte izquierdo freno de mano Ford Taunus ',0.00,1.00,15,0,0,'','2013-05-15',NULL,'7.1.4','1'),(1315,1,1,1,1,1,'9190','F-919-A','Resorte M.Benz 608 ',0.00,1.00,8,0,0,'','2013-05-15',NULL,'7.1.4','1'),(1316,1,1,1,1,1,'6040','F-604','Resorte derecho Freno de mano Ford Taunus ',0.00,1.00,12,0,0,'','2013-05-15',NULL,'7.1.4','1'),(1317,1,1,1,1,1,'6555','F-655','Resorte Ford Escort leva freno de mano ',0.00,1.00,4,0,0,'','2013-05-15',NULL,'7.1.4','1'),(1318,1,1,1,1,1,'5555','F-555','Resorte Ford 600 ',0.00,1.00,9,0,0,'','2013-05-15',NULL,'7.1.4','1'),(1319,1,1,1,1,1,'3803','F-680','Resorte patin trasero ',0.00,1.00,5,0,0,'','2013-05-15',NULL,'7.1.4','1'),(1320,1,1,1,1,1,'2224','','Resorte patin inferior F-100 ',0.00,1.00,6,0,0,'','2013-05-15',NULL,'7.1.4','1'),(1321,1,1,1,1,1,'3881','f-388','Resorte patin inferior auto ',0.00,1.00,3,0,0,'','2013-05-15',NULL,'7.1.5','1'),(1322,1,1,1,1,1,'3813','F-381','Resorte delantero Dodge ',0.00,1.00,20,0,0,'','2013-05-15',NULL,'7.1.5','1'),(1323,1,1,1,1,1,'8852','F-885','Resorte Scania 111',0.00,1.00,12,0,0,'','2013-05-15',NULL,'7.1.5','1'),(1324,1,1,1,1,1,'9256','F-925-A','Resorte Maldonado ',0.00,1.00,19,0,0,'','2013-05-15',NULL,'7.1.5','1'),(1325,1,1,1,1,1,'6480','F-648','Resorte Sierra - Scort ',0.00,1.00,61,0,0,'','2013-05-15',NULL,'7.1.5','1'),(1326,1,1,1,1,1,'1142','','Resorte ',0.00,1.00,16,0,0,'','2013-05-15',NULL,'7.1.5','1'),(1327,1,1,1,1,1,'1143','2224','Resorte superior Ford - Chevrolet ',0.00,1.00,7,0,0,'','2013-05-15',NULL,'7.1.5','1'),(1328,1,1,1,1,1,'3764','376','Resorte Chevrolet Trans . ',0.00,1.00,19,0,0,'','2013-05-15',NULL,'7.1.5','1'),(1329,1,1,1,1,1,'5675','H-5675','Resorte corto 1114 Volteo ',0.00,1.00,10,0,0,'','2013-05-15',NULL,'7.1.6','1'),(1330,1,1,1,1,1,'9123','F-912-A','Resorte Bedford ',0.00,1.00,9,0,0,'','2013-05-15',NULL,'7.1.6','1'),(1331,1,1,1,1,1,'5980','H-5980','Resorte zapata Scania 113 trasero  ',0.00,1.00,19,0,0,'','2013-05-15',NULL,'7.1.6, 10','1'),(1332,1,1,1,1,1,'1144','','Resorte ',0.00,1.00,27,0,0,'','2013-05-15',NULL,'7.1.6','1'),(1333,1,1,1,1,1,'9115','F-911-B','Resorte Peugeot 504 ',0.00,1.00,57,0,0,'','2013-05-15',NULL,'7.1.6','1'),(1334,1,1,1,1,1,'9148','F-914-A','Resorte pedal R-6',0.00,1.00,5,0,0,'','2013-05-15',NULL,'7.1.6','1'),(1335,1,1,1,1,1,'9387','F-938-A','Resorte pedal R-6',0.00,1.00,4,0,0,'','2013-05-15',NULL,'7.1.6','1'),(1336,1,1,1,1,1,'0997','F-997','Resorte patin inferior R-6 / R-12 ',0.00,1.00,47,0,0,'','2013-05-15',NULL,'7.1.6','1'),(1337,1,1,1,1,1,'0935','F-935-A','Resorte M.Benz 608 ',0.00,1.00,4,0,0,'','2013-05-15',NULL,'7.1.7','1'),(1338,1,1,1,1,1,'0956','F956A','Sosten de rodillo ',0.00,1.00,150,0,0,'','2013-05-15',NULL,'7.1.7','1'),(1339,1,1,1,1,1,'1147','','Resorte Ford 700 -F900',0.00,1.00,13,0,0,'','2013-05-15',NULL,'7.1.7','1'),(1340,1,1,1,1,1,'1206','','Resorte ',0.00,1.00,27,0,0,'','2013-05-15',NULL,'7.1.7','1'),(1341,1,1,1,1,1,'201288','','Seguro leva 54',0.00,1.00,106,0,0,'','2013-05-15',NULL,'7.1.7,6.2.4','1'),(1342,1,1,1,1,1,'25653','','Seguro de Patin ',0.00,1.00,12,0,0,'','2013-05-15',NULL,'7.1.7','1'),(1343,1,1,1,1,1,'5412','H5412','Resorte',0.00,1.00,28,0,0,'','2013-05-15',NULL,'71.1.8','1'),(1344,1,1,1,1,1,'5414','H5414','Resorte sujecion cargo ',0.00,1.00,26,0,0,'','2013-05-15',NULL,'71.1.8','1'),(1345,1,1,1,1,1,'1148','F993B','Resorte Deuz ',0.00,1.00,22,0,0,'','2013-05-15',NULL,'71.1.8','1'),(1346,1,1,1,1,1,'4126','C/412','Resorte 12 - Volkswagen',0.00,1.00,4,0,0,'','2013-05-15',NULL,'71.1.8','1'),(1347,1,1,1,1,1,'1149','F936B','Resorte Scania  ',0.00,1.00,9,0,0,'','2013-05-15',NULL,'71.1.8','1'),(1348,1,1,1,1,1,'5695','H5695','Resorte ',0.00,1.00,5,0,0,'','2013-05-15',NULL,'7.1.9 ','1'),(1349,1,1,1,1,1,'15213','1521','Resorte pulpom Tristopt ( varios )',0.00,1.00,60,0,0,'','2013-05-15',NULL,'7.1.9','1'),(1350,1,1,1,1,1,'5626','H5626','Resortes varios ',0.00,1.00,10,0,0,'','2013-05-15',NULL,'7.1.9','1'),(1351,1,1,1,1,1,'5914','F-591','Resorte izquierdo Ford 350',0.00,1.00,13,0,0,'','2013-05-15',NULL,'7.1.9','1'),(1352,1,1,1,1,1,'5413','H5413','Resorte Ford 14000',0.00,1.00,11,0,0,'','2013-05-15',NULL,'7.1.10','1'),(1353,1,1,1,1,1,'9310','F-931','Resorte M.Benz 312 -911',0.00,1.00,10,0,0,'','2013-05-15',NULL,'7.1.10','1'),(1354,1,1,1,1,1,'3080','F308','Resorte ',0.00,1.00,9,0,0,'','2013-05-15',NULL,'7.1.10','1'),(1355,1,1,1,1,1,'3023','C-3023','Cubeta cilindro - bomba ',0.00,1.00,4460,0,0,'','2013-05-15',NULL,'7.2.1 , 2,3,4,5,6,7','1'),(1356,1,1,1,1,1,'3077','RC3077','Rep. Caliper M.Benz 712 ',0.00,1.00,3,0,0,'','2013-05-15',NULL,'7.2.7','1'),(1357,1,1,1,1,1,'1161','DMB029','Rep. de tapas M.Benz ',0.00,1.00,3,0,0,'','2013-05-15',NULL,'7.2.7','1'),(1358,1,1,1,1,1,'1163','DMB016','Rep. Tapas caliper M.Benz 712 ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'7.2.7','1'),(1359,1,1,1,1,1,'1164','DMB040','Rep. Nucleo de regulacion ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'7.2.7','1'),(1360,1,1,1,1,1,'1167','DMB012','Rep. de rodamientos y cubetas ',0.00,1.00,3,0,0,'','2013-05-15',NULL,'7.2.7','1'),(1361,1,1,1,1,1,'78042','RPC7804','Bulon regulador M.Benz 712 ',0.00,1.00,3,0,0,'','2013-05-15',NULL,'7.2.7','1'),(1362,1,1,1,1,1,'00410','DMB041','Nucleo de regulacion ',0.00,1.00,3,0,0,'','2013-05-15',NULL,'7.2.7','1'),(1363,1,1,1,1,1,'78191','RPC7819','Kit de pernos  guia de caliper ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'7.2.7','1'),(1364,1,1,1,1,1,'99302','AN9930','Jgo. Antiruido. Completo ',0.00,1.00,3,0,0,'','2013-05-15',NULL,'7.2.7','1'),(1365,1,1,1,1,1,'3049','RC3049','Rep. Caliper M.Benz 712 ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'7.2.8','1'),(1366,1,1,1,1,1,'9931','AN9931','Kit antiruido ',0.00,1.00,3,0,0,'','2013-05-15',NULL,'7.2.8','1'),(1367,1,1,1,1,1,'00010','DMB001','Planchuela respaldo M.Benz 712 ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'7.2.8','1'),(1368,1,1,1,1,1,'0007','DMB007','Bulon fijacion M.Benz 712 ',0.00,1.00,3,0,0,'','2013-05-15',NULL,'7.2.8','1'),(1369,1,1,1,1,1,'00510','DMB051','Arandela conica ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'7.2.8','1'),(1370,1,1,1,1,1,'0006','0006','Arandela plana',0.00,1.00,2,0,0,'','2013-05-15',NULL,'7.2.8','1'),(1371,1,1,1,1,1,'7798','7798','Rep. Caliper M.Benz 712 ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'7.2.8','1'),(1372,1,1,1,1,1,'20000','CH2000','Resorte ',0.00,1.00,7,0,0,'','2013-05-15',NULL,'7.2.9','1'),(1373,1,1,1,1,1,'2930','','Fuelle 1 1/8\" ',0.00,1.00,9,0,0,'','2013-05-15',NULL,'7.3.1','1'),(1374,1,1,1,1,1,'1172','Varios ','Resortes cilindros varios ',0.00,1.00,30,0,0,'','2013-05-15',NULL,'7.3.1','1'),(1375,1,1,1,1,1,'1207','Varios ','Reparaciones cilindros varios ',0.00,1.00,50,0,0,'','2013-05-15',NULL,'7.3.1','1'),(1376,1,1,1,1,1,'2407200','2407200','Rep. Bomba Dodge ',0.00,1.00,8,0,0,'','2013-05-15',NULL,'7.4.2','1'),(1377,1,1,1,1,1,'12347','12347','Fuelle ',0.00,1.00,5,0,0,'','2013-05-15',NULL,'7.4.2','1'),(1378,1,1,1,1,1,'40287','40287','Fuelle ',0.00,1.00,14,0,0,'','2013-05-15',NULL,'7.4.2','1'),(1379,1,1,1,1,1,'202554','202554','Campana freno Ford F100 ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'7.4.1','1'),(1380,1,1,1,1,1,'1212','','Campana freno  ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'7.4.1','1'),(1381,1,1,1,1,1,'08100','810','Reten reforma 810 ',0.00,1.00,44,0,0,'','2013-05-15',NULL,'7.4.4','1'),(1382,1,1,1,1,1,'2937','2937','Guardapolvo ',0.00,1.00,665,0,0,'','2013-05-15',NULL,'7.4.2 , 3,4,5,6','1'),(1383,1,1,1,1,1,'00901','F901','Fuelle pulmon ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'7.4.6','1'),(1384,1,1,1,1,1,'1310','','Disco de freno  ',0.00,1.00,5,0,0,'','2013-05-15',NULL,'7.4.7','1'),(1385,1,1,1,1,1,'1311','','Disco de freno Duna - Uno - Regatta ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'7.4.8','1'),(1386,1,1,1,1,1,'1312','','Disco Peugeot 404 - 504 ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'7.4.8','1'),(1387,1,1,1,1,1,'1314','','Disco Ranger Explorer 4 WD ( 95 ) ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'7.4.9','1'),(1388,1,1,1,1,1,'1315','','Disco Freno Ford Escort ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'7.4.9','1'),(1389,1,1,1,1,1,'1316','','Campana ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'7.4.10','1'),(1390,1,1,1,1,1,'1317','','Tuerca punta eje Dodge 800',0.00,1.00,3,0,0,'','2013-05-15',NULL,'Puntera 1','1'),(1391,1,1,1,1,1,'1318','','Arandela tope leva ',0.00,1.00,5,0,0,'','2013-05-15',NULL,'Puntera 1','1'),(1392,1,1,1,1,1,'1319','','Arandela ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 1','1'),(1393,1,1,1,1,1,'1320','','Arandela punta eje ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 1','1'),(1394,1,1,1,1,1,'1321','','O\'ring varios ',0.00,1.00,60,0,0,'','2013-05-15',NULL,'Puntera 2','1'),(1395,1,1,1,1,1,'1322','','Juntas varias ',0.00,1.00,24,0,0,'','2013-05-15',NULL,'Puntera 2','1'),(1396,1,1,1,1,1,'1323','','Resortes ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'Puntera 2','1'),(1397,1,1,1,1,1,'1324','','Tuerca punta eje  ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 2','1'),(1398,1,1,1,1,1,'1325','','Junta palier 1119',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 2','1'),(1399,1,1,1,1,1,'1326','','Seguro ',0.00,1.00,3,0,0,'','2013-05-15',NULL,'Puntera 2','1'),(1400,1,1,1,1,1,'1327','','Flexible ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 2','1'),(1401,1,1,1,1,1,'1328','','Seguro de manga  ',0.00,1.00,3,0,0,'','2013-05-15',NULL,'Puntera 2','1'),(1402,1,1,1,1,1,'1329','','Tuerca punta eje ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 2','1'),(1403,1,1,1,1,1,'1340','','Arandela doble con O\'ring ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 2','1'),(1404,1,1,1,1,1,'1341','','Resorte ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 2','1'),(1405,1,1,1,1,1,'1343','','Resorte reten ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 2','1'),(1406,1,1,1,1,1,'1347','','Seguro manga ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 2','1'),(1407,1,1,1,1,1,'1348','','Junta chica ( papel ) ',0.00,1.00,3,0,0,'','2013-05-15',NULL,'Puntera 2','1'),(1408,1,1,1,1,1,'1349','','Junta chica (carton )',0.00,1.00,16,0,0,'','2013-05-15',NULL,'Puntera 2','1'),(1409,1,1,1,1,1,'1354','','Seguro ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 2','1'),(1410,1,1,1,1,1,'1357','','Arandela ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'Puntera 2','1'),(1411,1,1,1,1,1,'1359','','Resorte ',0.00,1.00,4,0,0,'','2013-05-15',NULL,'Puntera 2','1'),(1412,1,1,1,1,1,'15011','1501/1','Grampa Helvetica 3/4\"',0.00,1.00,8,0,0,'','2013-05-15',NULL,'Puntera 3.2.5','1'),(1413,1,1,1,1,1,'15201','1520','Grampa trasera Fiat ',0.00,1.00,34,0,0,'','2013-05-15',NULL,'Puntera 3.2.1','1'),(1414,1,1,1,1,1,'1370','','Grampa ',0.00,1.00,19,0,0,'','2013-05-15',NULL,'Puntera 3.2.2','1'),(1415,1,1,1,1,1,'15050','1505','Grampa Montenegro',0.00,1.00,10,0,0,'','2013-05-15',NULL,'Puntera 3.2.3','1'),(1416,1,1,1,1,1,'5022','M-502','Grampa Helvetica ',0.00,1.00,19,0,0,'','2013-05-15',NULL,'Puntera 3.2.4','1'),(1417,1,1,1,1,1,'1371','','Grampa Helvetica ',0.00,1.00,14,0,0,'','2013-05-15',NULL,'Punetra 3.2.6','1'),(1418,1,1,1,1,1,'1645','1645','Rodillo de patin 25 , 30 , 32 , 35 , 38 mm',0.00,1.00,190,0,0,'','2013-05-15',NULL,'Puntera 3.3.1 - 3.4.1 , 2 , 4 , ','1'),(1419,1,1,1,1,1,'06500','650','Anclaje zapata M.Benz ',0.00,1.00,36,0,0,'','2013-05-15',NULL,'Puntera 3.3.2 , 3 ','1'),(1420,1,1,1,1,1,'015030','1503','Grampa Helvetica ( grande ) ',0.00,1.00,5,0,0,'','2013-05-15',NULL,'Puntera 3.3.4','1'),(1421,1,1,1,1,1,'013420','1342','Bulon rueda Ford - VW ',0.00,1.00,4,0,0,'','2013-05-15',NULL,'Puntera 3.3.5','1'),(1422,1,1,1,1,1,'05580','558','Bulon Maldonado ',0.00,1.00,464,0,0,'','2013-05-15',NULL,'Puntera 3.5.2 , 3 , 4 , 5 , 8.1.','1'),(1423,1,1,1,1,1,'01968','196/8','Bulon completo sujeta campana ',0.00,1.00,63,0,0,'','2013-05-15',NULL,'Puntera 3.6.5 ','1'),(1424,1,1,1,1,1,'011640','1164','Tuerca para bulon Random / Maldonado ',0.00,1.00,352,0,0,'','2013-05-15',NULL,'Puntera 3.6.3','1'),(1425,1,1,1,1,1,'33500','3350','Bulon para disco Volvo ',0.00,1.00,12,0,0,'','2013-05-15',NULL,'Puntera 3.3.6 - 3.4.6 ','1'),(1426,1,1,1,1,1,'9095','','Bulon completo Montenegro ',0.00,1.00,25,0,0,'','2013-05-15',NULL,'Puntera 3.5.1','1'),(1427,1,1,1,1,1,'4253','','Tornillo artillero ',0.00,1.00,29,0,0,'','2013-05-15',NULL,'Puntera 3.6.1','1'),(1428,1,1,1,1,1,'6232','','Randon',0.00,1.00,52,0,0,'','2013-05-15',NULL,'Puntera 3.6.2 / 3.6.4','1'),(1429,1,1,1,1,1,'0603800','B/6013 , 3 , 4 , 11 , 12 , 5 , 7 , 14 , 8 , 2 ','Cono 3/16\" , 6 mm , 1/4\" , 8 mm , 3/8\" , 10 mm , 12 mm , 1/2\" , 5/16\" , 5/8\"',0.00,1.00,900,0,0,'','2013-05-15',NULL,'Puntera 8.2.4 / 8.3.10 / 8.3.1 -','1'),(1430,1,1,1,1,1,'1763800','B-176/0 , 12 , 6 , 11 , 1 , 3 , 10 , 2 , 7','Inserto 3/16\" , 6 mm , 1/4\" , 8 mm , 3/8\" , 10 mm , 12 mm , 1/2\" , 5/16\" , 5/8\"',0.00,1.00,1120,0,0,'','2013-05-15',NULL,'8.2.4 - 8.3.1 - 8.3.10','1'),(1431,1,1,1,1,1,'6118','B-61/18 ','Tuerca 12mm',0.00,1.00,111,0,0,'','2013-05-15',NULL,'8.2.4 - 8.3.10','1'),(1432,1,1,1,1,1,'6170','B-61/7','Tuerca 1/2\"',0.00,1.00,72,0,0,'','2013-05-15',NULL,'8.2.4','1'),(1433,1,1,1,1,1,'6117','B-61/17','Tuerca 10mm ',0.00,1.00,119,0,0,'','2013-05-15',NULL,'8.2.4','1'),(1434,1,1,1,1,1,'6115','B-61/15','Tuerca 6mm ',0.00,1.00,88,0,0,'','2013-05-15',NULL,'8.2.4','1'),(1435,1,1,1,1,1,'6160','B-61/6','Tuerca 5/16\" ',0.00,1.00,117,0,0,'','2013-05-15',NULL,'8.2.4','1'),(1436,1,1,1,1,1,'6180','B-61/8','Tuerca 3/8\"',0.00,1.00,123,0,0,'','2013-05-15',NULL,'8.2.4','1'),(1437,1,1,1,1,1,'6116','B-61/16','Tuerca 8mm ',0.00,1.00,137,0,0,'','2013-05-15',NULL,'8.2.4','1'),(1438,1,1,1,1,1,'6140','B-61/4','Tuerca 1/4\"',0.00,1.00,194,0,0,'','2013-05-15',NULL,'8.2.4','1'),(1439,1,1,1,1,1,'3113','B-61/13','Tuerca 5/8\"',0.00,1.00,28,0,0,'','2013-05-15',NULL,'8.3.1','1'),(1440,1,1,1,1,1,'6120','B-61/12','Tuerca 3/16\"',0.00,1.00,99,0,0,'','2013-05-15',NULL,'8.3.1','1'),(1441,1,1,1,1,1,'287016','B-60/16-B-60/17-B-60/18-B-60/19-B-60-8-B-60-6-B-60-12-B-60-10','Conos Scania 6,8,10,12mm',0.00,1.00,160,0,0,'','2013-05-15',NULL,'8.3.1','1'),(1442,1,1,1,1,1,'277016','277016/017','Conos de bronce M.Benz 12,14mm',0.00,1.00,80,0,0,'','2013-05-15',NULL,'8.3.1','1'),(1443,1,1,1,1,1,'0680906','B-0680906','Conexion 5/8x3/8\"',0.00,1.00,4,0,0,'','2013-05-15',NULL,'8.3.1','1'),(1444,1,1,1,1,1,'33821','3382/1','Alemite largo',0.00,1.00,50,0,0,'','2013-05-15',NULL,'8.3.1','1'),(1445,1,1,1,1,1,'3382','3382','Alemite corto - Alemite codo',0.00,1.00,120,0,0,'','2013-05-15',NULL,'8.3.1','1'),(1446,1,1,1,1,1,'1372','','Conexiones varias',0.00,1.00,41,0,0,'','2013-05-15',NULL,'8.3.10','1'),(1447,1,1,1,1,1,'11210','B-112/1','Union doble 1/8x1/8\"',0.00,1.00,38,0,0,'','2013-05-15',NULL,'8.3.5','1'),(1448,1,1,1,1,1,'11230','B-112/3','Union doble 1/4x1/8\"',0.00,1.00,30,0,0,'','2013-05-15',NULL,'8.3.5','1'),(1449,1,1,1,1,1,'1120404','B-112/3','Union doble para gas 1/4x1/4\"',0.00,1.00,44,0,0,'','2013-05-15',NULL,'8.3.5','1'),(1450,1,1,1,1,1,'1120808','B-112/9','Union doble para gas 1/2x1/2\"',0.00,1.00,11,0,0,'','2013-05-15',NULL,'8.3.5','1'),(1451,1,1,1,1,1,'1120606','B-112/5','Union doble para gas 3/8x3/8\"',0.00,1.00,13,0,0,'','2013-05-15',NULL,'8.3.5','1'),(1452,1,1,1,1,1,'11200','B-112','Union doble 1/2x1/4\"',0.00,1.00,12,0,0,'','2013-05-15',NULL,'8.3.5','1'),(1453,1,1,1,1,1,'11240','B-112/4','Union doble 3/8x1/4\"',0.00,1.00,20,0,0,'','2013-05-15',NULL,'8.3.5','1'),(1454,1,1,1,1,1,'11241','B-112/4','Union doble 3/8x1/2\"',0.00,1.00,6,0,0,'','2013-05-15',NULL,'8.3.5','1'),(1455,1,1,1,1,1,'1160606','B-116/3','Codo hembra - macho 3/8x3/8\"',0.00,1.00,27,0,0,'','2013-05-15',NULL,'8.3.5','1'),(1456,1,1,1,1,1,'111620','B-116/2','Codo 1/4x1/4\"',0.00,1.00,30,0,0,'','2013-05-15',NULL,'8.3.5','1'),(1457,1,1,1,1,1,'11420','B-114/2','Codo 1/8x1/8\"',0.00,1.00,15,0,0,'','2013-05-15',NULL,'8.3.5','1'),(1458,1,1,1,1,1,'11610','B-116/1','Codo 1/8x1/8\"',0.00,1.00,93,0,0,'','2013-05-15',NULL,'8.3.5 - 8.3.10','1'),(1459,1,1,1,1,1,'694204','B-694204','Codo 12x1/4\"',0.00,1.00,9,0,0,'','2013-05-15',NULL,'8.3.5','1'),(1460,1,1,1,1,1,'694004','B-694004','Codo 10x1/4\"',0.00,1.00,21,0,0,'','2013-05-15',NULL,'8.3.5','1'),(1461,1,1,1,1,1,'0693804','B-0693804','Codo 8x1/4\"',0.00,1.00,28,0,0,'','2013-05-15',NULL,'8.3.5 - 8.3.10','1'),(1462,1,1,1,1,1,'0693604','B-0693604','Codo 6x1/4\"',0.00,1.00,23,0,0,'','2013-05-15',NULL,'8.3.5','1'),(1463,1,1,1,1,1,'1000400','B-100/2','Codo hembra 1/4\" rosca gas',0.00,1.00,24,0,0,'','2013-05-15',NULL,'8.3.5','1'),(1464,1,1,1,1,1,'10310','B-103/10','Acople rosca 1/2\"',0.00,1.00,11,0,0,'','2013-05-15',NULL,'8.3.5','1'),(1465,1,1,1,1,1,'10311','B-103/11','Acople rosca1/4\"',0.00,1.00,17,0,0,'','2013-05-15',NULL,'8.3.5','1'),(1466,1,1,1,1,1,'1373','','Acople rosca 3/8\"',0.00,1.00,15,0,0,'','2013-05-15',NULL,'8.3.5','1'),(1467,1,1,1,1,1,'1374','','Acople rosca 1/8\"',0.00,1.00,33,0,0,'','2013-05-15',NULL,'8.3.5','1'),(1468,1,1,1,1,1,'1300','B-130','Pico racord 1/4\"x1/4\"-1/4\"x5/16\"-1/4x3/8\"-3/8\"x5/16\"',0.00,1.00,45,0,0,'','2013-05-15',NULL,'8.3.5','1'),(1469,1,1,1,1,1,'0620500','B-62/4','Union doble ca?o 5/16x5/16\"',0.00,1.00,35,0,0,'','2013-05-15',NULL,'8.3.5','1'),(1470,1,1,1,1,1,'0620400','B-62/3','Union doble ca?o 1/4x1/4\"',0.00,1.00,28,0,0,'','2013-05-15',NULL,'8.3.5','1'),(1471,1,1,1,1,1,'6220','B-62/2','Union doble 3/16x3/16\"',0.00,1.00,20,0,0,'','2013-05-15',NULL,'8.3.5','1'),(1472,1,1,1,1,1,'0620900','B-62/8','Union doble ajuste 5/8\"',0.00,1.00,13,0,0,'','2013-05-15',NULL,'8.3.5','1'),(1473,1,1,1,1,1,'6270','B-62/7','Union doble 1/2x1/2\"',0.00,1.00,38,0,0,'','2013-05-15',NULL,'8.3.5','1'),(1474,1,1,1,1,1,'6250','B-62/5','Union doble 3/8x3/8\"',0.00,1.00,4,0,0,'','2013-05-15',NULL,'8.3.5','1'),(1475,1,1,1,1,1,'6980','B-69/8','Codo gas ca?o 1/8x1/8\"',0.00,1.00,4,0,0,'','2013-05-15',NULL,'8.3.6','1'),(1476,1,1,1,1,1,'6970','B-69/7','Codo gas ca?o 1/8x3/16\"',0.00,1.00,8,0,0,'','2013-05-15',NULL,'8.3.6','1'),(1477,1,1,1,1,1,'6960','B-69/6','Codo gas ca?o 1/4x3/8\"',0.00,1.00,29,0,0,'','2013-05-15',NULL,'8.3.6','1'),(1478,1,1,1,1,1,'6961','B-69','Codo gas 6x1/4\"',0.00,1.00,18,0,0,'','2013-05-15',NULL,'8.3.6','1'),(1479,1,1,1,1,1,'6940','B-69/4','Codo gas 1/8x5/16\"',0.00,1.00,14,0,0,'','2013-05-15',NULL,'8.3.6','1'),(1480,1,1,1,1,1,'0650400','B-65/4','Codo gas ca?o 1/4x1/4\"',0.00,1.00,21,0,0,'','2013-05-15',NULL,'8.3.6','1'),(1481,1,1,1,1,1,'0650600','B0650600','Codo gas ca?o 3/8x3/8\"',0.00,1.00,44,0,0,'','2013-05-15',NULL,'8.3.6','1'),(1482,1,1,1,1,1,'1593','1593','Rubinete 1/4\"',0.00,1.00,20,0,0,'','2013-05-15',NULL,'8.3.6','1'),(1483,1,1,1,1,1,'1592','1592','Rubinete 1/8\"',0.00,1.00,18,0,0,'','2013-05-15',NULL,'8.3.6','1'),(1484,1,1,1,1,1,'10940','B-109/4','Tapon 1/2\"',0.00,1.00,14,0,0,'','2013-05-15',NULL,'8.3.6','1'),(1485,1,1,1,1,1,'1095200','B1095200','Tapon 22mm',0.00,1.00,33,0,0,'','2013-05-15',NULL,'8.3.6 - 8.3.10','1'),(1486,1,1,1,1,1,'10930','B109/3','Tapon 3/8\"',0.00,1.00,23,0,0,'','2013-05-15',NULL,'8.3.6','1'),(1487,1,1,1,1,1,'10920','B109/2','Tapon 1/4\"',0.00,1.00,6,0,0,'','2013-05-15',NULL,'8.3.6','1'),(1488,1,1,1,1,1,'10910','B109/1','Tapon 1/8\"',0.00,1.00,41,0,0,'','2013-05-15',NULL,'8.3.6','1'),(1489,1,1,1,1,1,'6962','B-69/6','Codo 5/16x1/4\"',0.00,1.00,15,0,0,'','2013-05-15',NULL,'8.3.7','1'),(1490,1,1,1,1,1,'6930','B-69/3','Codo 1/4x1/4\"',0.00,1.00,25,0,0,'','2013-05-15',NULL,'8.3.7','1'),(1491,1,1,1,1,1,'0690604','B-69/8','Codo-ca?o gas 3/8x1/4\"',0.00,1.00,32,0,0,'','2013-05-15',NULL,'8.3.7','1'),(1492,1,1,1,1,1,'6880','B-68/8','Union doble 5/16x1/4\"',0.00,1.00,35,0,0,'','2013-05-15',NULL,'8.3.7','1'),(1493,1,1,1,1,1,'6817','B-68/17','Union doble 1/4x1/4\"',0.00,1.00,39,0,0,'','2013-05-15',NULL,'8.3.7','1'),(1494,1,1,1,1,1,'0680502','B-68/6','Union doble ca?o-gas 5/16x1/8\"',0.00,1.00,19,0,0,'','2013-05-15',NULL,'8.3.7','1'),(1495,1,1,1,1,1,'6830','B-68/3','Union doble 1/4x3/16\"',0.00,1.00,24,0,0,'','2013-05-15',NULL,'8.3.7','1'),(1496,1,1,1,1,1,'6881','B-68/8','Union doble 3/8x1/8\"',0.00,1.00,25,0,0,'','2013-05-15',NULL,'8.3.7','1'),(1497,1,1,1,1,1,'6820','B-68/2','Union doble 3/16x1/8\"',0.00,1.00,27,0,0,'','2013-05-15',NULL,'8.3.7','1'),(1498,1,1,1,1,1,'11010','B-110/1','Tuerca reduccion 1/4x1/8\"',0.00,1.00,33,0,0,'','2013-05-15',NULL,'8.3.7','1'),(1499,1,1,1,1,1,'11020','B-110/2','Tuerca reduccion 3/8x1/8\"',0.00,1.00,29,0,0,'','2013-05-15',NULL,'8.3.7','1'),(1500,1,1,1,1,1,'1100604','B-110/3','Tuerca reduccion 3/8 gas ext. x1/4\" gas int.',0.00,1.00,28,0,0,'','2013-05-15',NULL,'8.3.7','1'),(1501,1,1,1,1,1,'11040','B-110/4','Tuerca reduccion 1/2x1/4\"',0.00,1.00,24,0,0,'','2013-05-15',NULL,'8.3.7','1'),(1502,1,1,1,1,1,'11050','B-110/5','Tuerca reduccion 1/2x3/8\"',0.00,1.00,26,0,0,'','2013-05-15',NULL,'8.3.7','1'),(1503,1,1,1,1,1,'1375','','Conexiones varias',0.00,1.00,15,0,0,'','2013-05-15',NULL,'8.3.7','1'),(1504,1,1,1,1,1,'10130','B-101/3','Conexion T 1/2x1/2\"',0.00,1.00,3,0,0,'','2013-05-15',NULL,'8.3.7','1'),(1505,1,1,1,1,1,'1010600','B-101/3','Conexion T rosca gas 3/8x3/8\"',0.00,1.00,26,0,0,'','2013-05-15',NULL,'8.3.7','1'),(1506,1,1,1,1,1,'10132','B-101/3','Conexion T 1/4x1/4\"',0.00,1.00,12,0,0,'','2013-05-15',NULL,'8.3.7','1'),(1507,1,1,1,1,1,'10133','B-101/3','Conexion T 1/8x1/8\"',0.00,1.00,26,0,0,'','2013-05-15',NULL,'8.3.7','1'),(1508,1,1,1,1,1,'6990','B-69/9','Codo 3/8x3/8\"',0.00,1.00,45,0,0,'','2013-05-15',NULL,'8.3.7','1'),(1509,1,1,1,1,1,'6911','B-69/11','Codo 1/2x3/8\"',0.00,1.00,4,0,0,'','2013-05-15',NULL,'8.3.7','1'),(1510,1,1,1,1,1,'694006','B-694006C','Codo 3/8x10mm',0.00,1.00,47,0,0,'','2013-05-15',NULL,'8.3.7','1'),(1511,1,1,1,1,1,'6912','B-69/12','Codo 1/2x1/2\"',0.00,1.00,5,0,0,'','2013-05-15',NULL,'8.3.7','1'),(1512,1,1,1,1,1,'6870','B-68/7','Conexion gas ca?o 1/8x3/8\"',0.00,1.00,26,0,0,'','2013-05-15',NULL,'8.3.8','1'),(1513,1,1,1,1,1,'6991','B-69/9','Conexion gas ca?o 3/8x1/4\"',0.00,1.00,35,0,0,'','2013-05-15',NULL,'8.3.8','1'),(1514,1,1,1,1,1,'6813','B-68/13','Conexion gas ca?o 1/2x3/8\"',0.00,1.00,6,0,0,'','2013-05-15',NULL,'8.3.8','1'),(1515,1,1,1,1,1,'6910','B-69/10','Codo 1/2x1/4\"',0.00,1.00,38,0,0,'','2013-05-15',NULL,'8.3.8','1'),(1516,1,1,1,1,1,'6812','B-68/12','Conexion ca?o gas 1/2x1/4\"',0.00,1.00,43,0,0,'','2013-05-15',NULL,'8.3.8','1'),(1517,1,1,1,1,1,'6816','B-68/16','Conexion ca?o gas 3/8x1/2\"',0.00,1.00,14,0,0,'','2013-05-15',NULL,'8.3.8','1'),(1518,1,1,1,1,1,'6841','B-68/4','Conexion ca?o gas 1/4x1/8\"',0.00,1.00,7,0,0,'','2013-05-15',NULL,'8.3.8','1'),(1519,1,1,1,1,1,'6811','B-68/11','Conexion ca?o gas 1/8x3/8\"',0.00,1.00,13,0,0,'','2013-05-15',NULL,'8.3.8','1'),(1520,1,1,1,1,1,'6810','B-68/10','Conexion gas ca?o 3/8x3/8\"',0.00,1.00,8,0,0,'','2013-05-15',NULL,'8.3.8','1'),(1521,1,1,1,1,1,'6450','B-64/50','Conexion T ca?o 1/2x1/2\"',0.00,1.00,17,0,0,'','2013-05-15',NULL,'8.3.8','1'),(1522,1,1,1,1,1,'6430','B-64/3','Conexion T ca?o 3/8x3/8\"',0.00,1.00,20,0,0,'','2013-05-15',NULL,'8.3.8','1'),(1523,1,1,1,1,1,'6440','B-64/4','Conexion T ca?o 5/16\"',0.00,1.00,2,0,0,'','2013-05-15',NULL,'8.3.8','1'),(1524,1,1,1,1,1,'6431','B-64/3','Conexion T ca?o 1/4\"',0.00,1.00,35,0,0,'','2013-05-15',NULL,'8.3.8','1'),(1525,1,1,1,1,1,'6432','B-64','Conexion T ca?o varias',0.00,1.00,25,0,0,'','2013-05-15',NULL,'8.3.8','1'),(1526,1,1,1,1,1,'1377','PV12','Codo acople rapido 12mm',0.00,1.00,29,0,0,'','2013-05-15',NULL,'8.3.9','1'),(1527,1,1,1,1,1,'1378','PV10','Codo acople rapido 10mm',0.00,1.00,5,0,0,'','2013-05-15',NULL,'8.3.9','1'),(1528,1,1,1,1,1,'1379','PV6','Codo acople rapido 6mm',0.00,1.00,28,0,0,'','2013-05-15',NULL,'8.3.9','1'),(1529,1,1,1,1,1,'1380','PV4','Codo acople rapido 4mm',0.00,1.00,10,0,0,'','2013-05-15',NULL,'8.3.9','1'),(1530,1,1,1,1,1,'1381','','Reduccion 1/4x10',0.00,1.00,10,0,0,'','2013-05-15',NULL,'8.3.9','1'),(1531,1,1,1,1,1,'11060','B-110/6','Reduccion 22x1/4\"',0.00,1.00,21,0,0,'','2013-05-15',NULL,'8.3.9 - 8.3.10','1'),(1532,1,1,1,1,1,'11070','B-110/7','Reduccion 1/4x12',0.00,1.00,27,0,0,'','2013-05-15',NULL,'8.3.9','1'),(1533,1,1,1,1,1,'207111','207111','Reduccion 14x1/4\"',0.00,1.00,28,0,0,'','2013-05-15',NULL,'8.3.9','1'),(1534,1,1,1,1,1,'1105206','B1105206','Reduccion 22x3/8\"',0.00,1.00,45,0,0,'','2013-05-15',NULL,'8.3.9 - 8.3.10','1'),(1535,1,1,1,1,1,'1200646','B1200646','Reduccion 3/8\" gas hembra x 16mm macho',0.00,1.00,26,0,0,'','2013-05-15',NULL,'8.3.9','1'),(1536,1,1,1,1,1,'11080','B-110/8','Reduccion 16x1/4\"',0.00,1.00,8,0,0,'','2013-05-15',NULL,'8.3.9','1'),(1537,1,1,1,1,1,'0720504','B0720504C','Conexion T 5/16x1/4\"',0.00,1.00,5,0,0,'','2013-05-15',NULL,'8.3.9','1'),(1538,1,1,1,1,1,'0720606','B0720606','Conexion T 3/8x3/8\"',0.00,1.00,5,0,0,'','2013-05-15',NULL,'8.3.9','1'),(1539,1,1,1,1,1,'0720804','B0720804','Conexion T 1/2x1/4\"',0.00,1.00,5,0,0,'','2013-05-15',NULL,'8.3.9','1'),(1540,1,1,1,1,1,'12000','PE-12','Conexion T 12mm',0.00,1.00,5,0,0,'','2013-05-15',NULL,'8.3.9','1'),(1541,1,1,1,1,1,'12001','PE-1/2\"','Conexion T 1/2\"',0.00,1.00,25,0,0,'','2013-05-15',NULL,'8.3.9 - 8.3.10','1'),(1542,1,1,1,1,1,'12002','PE-10','Conexion T 10mm',0.00,1.00,20,0,0,'','2013-05-15',NULL,'8.3.9','1'),(1543,1,1,1,1,1,'6913','B-69/13','Codo 1/2x3/4\"',0.00,1.00,1,0,0,'','2013-05-15',NULL,'8.3.8','1'),(1544,1,1,1,1,1,'7211','B-72/11','Conexion T ca?o gas 1/4x3/8\"',0.00,1.00,10,0,0,'','2013-05-15',NULL,'8.3.8','1'),(1545,1,1,1,1,1,'7210','B-72/10','Conexion T ca?o gas 1/2x3/8\"',0.00,1.00,22,0,0,'','2013-05-15',NULL,'8.3.8','1'),(1546,1,1,1,1,1,'101600','101600','Valvula seguridad 16mm',0.00,1.00,3,0,0,'','2013-05-15',NULL,'8.3.8','1'),(1547,1,1,1,1,1,'101601','101600','Valvula seguridad 14mm',0.00,1.00,3,0,0,'','2013-05-15',NULL,'8.3.8','1'),(1548,1,1,1,1,1,'5001','W5001','Purgador automatico scania (Valvula drenaje)',0.00,1.00,13,0,0,'','2013-05-15',NULL,'8.3.8','1'),(1549,1,1,1,1,1,'0105','B-105','Codo 1/4x1/4\"',0.00,1.00,5,0,0,'','2013-05-15',NULL,'8.3.8','1'),(1550,1,1,1,1,1,'6410','B-64/10','Conexion T ca?o 12mm',0.00,1.00,30,0,0,'','2013-05-15',NULL,'8.3.4','1'),(1551,1,1,1,1,1,'6490','B-64/9','Conexion T ca?o 10mm',0.00,1.00,19,0,0,'','2013-05-15',NULL,'8.3.4','1'),(1552,1,1,1,1,1,'6480','B-64/8','Conexion T ca?o 8mm',0.00,1.00,30,0,0,'','2013-05-15',NULL,'8.3.4','1'),(1553,1,1,1,1,1,'6470','B-64/7','Conexion T ca?o 6mm',0.00,1.00,30,0,0,'','2013-05-15',NULL,'8.3.4','1'),(1554,1,1,1,1,1,'6890','B-68/9','Conexion 6x8mm',0.00,1.00,28,0,0,'','2013-05-15',NULL,'8.3.4','1'),(1555,1,1,1,1,1,'0623840','B0623840','Conexion 8x10mm',0.00,1.00,20,0,0,'','2013-05-15',NULL,'8.3.4','1'),(1556,1,1,1,1,1,'0624042','B0624042','Reduccion ca?o - ca?o 10x12mm',0.00,1.00,12,0,0,'','2013-05-15',NULL,'8.3.4','1'),(1557,1,1,1,1,1,'0624200','B0624200','Conexion ca?o 12mm',0.00,1.00,47,0,0,'','2013-05-15',NULL,'8.3.4','1'),(1558,1,1,1,1,1,'063800','B063800','Conexion 8mm',0.00,1.00,31,0,0,'','2013-05-15',NULL,'8.3.4','1'),(1559,1,1,1,1,1,'0684206','B0684206','Conexion union doble ca?o gas 12x3/8\"',0.00,1.00,49,0,0,'','2013-05-15',NULL,'8.3.4','1'),(1560,1,1,1,1,1,'0623600','B-62/6','Conexion ca?o 6mm',0.00,1.00,47,0,0,'','2013-05-15',NULL,'8.3.4','1'),(1561,1,1,1,1,1,'6882','B-68/8','Conexion 8x1/8\"',0.00,1.00,37,0,0,'','2013-05-15',NULL,'8.3.4','1'),(1562,1,1,1,1,1,'6961','B-69/6','Conexion 1/4x8mm',0.00,1.00,29,0,0,'','2013-05-15',NULL,'8.3.4','1'),(1563,1,1,1,1,1,'6290','B-62/9','Conexion 10mm',0.00,1.00,43,0,0,'','2013-05-15',NULL,'8.3.4','1'),(1564,1,1,1,1,1,'684204','B684204','Conexion 1/2x1/4\"',0.00,1.00,19,0,0,'','2013-05-15',NULL,'8.3.4','1'),(1565,1,1,1,1,1,'6815','B-68/15','Conexion 10x1/4\"',0.00,1.00,25,0,0,'','2013-05-15',NULL,'8.3.4','1'),(1566,1,1,1,1,1,'6810','B-68/10','Conexion 3/8x8mm',0.00,1.00,29,0,0,'','2013-05-15',NULL,'8.3.4','1'),(1567,1,1,1,1,1,'6818','B-68/18','Conexion 8x1/4\"',0.00,1.00,66,0,0,'','2013-05-15',NULL,'8.3.4','1'),(1568,1,1,1,1,1,'683604','B683604','Conexion 10x1/4\"',0.00,1.00,27,0,0,'','2013-05-15',NULL,'8.3.4','1'),(1569,1,1,1,1,1,'6883','B-68/8','Conexion 3/8x6mm',0.00,1.00,8,0,0,'','2013-05-15',NULL,'8.3.4','1'),(1570,1,1,1,1,1,'690512','','Juego de pastilla Fiat palio/Siena/So/sensor(Ara?a grande)',0.00,1.00,2,0,0,'','2013-05-15',NULL,'12.1.4','1'),(1571,1,1,1,1,1,'690539','','Juego de pastilla Ford Focus (nafta o diesel) delanteras',0.00,1.00,2,0,0,'','2013-05-15',NULL,'12.4.4','1'),(1572,1,1,1,1,1,'690728','','Juego de pastillas Peugeot 307 1.6XR-2.0 16V(2.000/)',0.00,1.00,2,0,0,'','2013-05-15',NULL,'12.4.6','1'),(1573,1,1,1,1,1,'690738','','Juego de pastillas Chevrolet Meriva GL1.8 8V (rod.14\")(2.002)',0.00,1.00,2,0,0,'','2013-05-15',NULL,'12.3.2','1'),(1574,1,1,1,1,1,'690753','','Juego de pastillas Mitsubishi Montero V6 90/94 (Trasera)',0.00,1.00,1,0,0,'','2013-05-15',NULL,'12.2.8','1'),(1575,1,1,1,1,1,'690154','','Juego de pastillas Dogde Taloon/Mitsubishi 3.000-Montero',0.00,1.00,1,0,0,'','2013-05-15',NULL,'12.2.8','1'),(1576,1,1,1,1,1,'150104','0409 (Dimac)','Juego de pastillas M.Benz- Vito 96/97',0.00,1.00,2,0,0,'','2013-05-15',NULL,'12.2.2','1'),(1577,1,1,1,1,1,'150163','0604 (Dimac)','Juego de pastillas Renault AE385-520 Premiun/Volvo B10L',0.00,1.00,2,0,0,'','2013-05-15',NULL,'12.4.10','1'),(1578,1,1,1,1,1,'180649','0193 (Dimac)','Juego de pastillas Citroe ZX/Peugeot 306/309/R.Clio',0.00,1.00,4,0,0,'','2013-05-15',NULL,'12.4.6','1'),(1579,1,1,1,1,1,'181606','0796 (Dimac)','Juego de pastillas Kia Sorento 2.4-2.5-3.5 02/(Del.)',0.00,1.00,2,0,0,'','2013-05-15',NULL,'12.4.7','1'),(1580,1,1,1,1,1,'11090','','Codo 10x1/4\"',0.00,1.00,21,0,0,'','2013-05-15',NULL,'8.3.3','1'),(1581,1,1,1,1,1,'6914','B-69/10','Codo 1/4x12',0.00,1.00,21,0,0,'','2013-05-15',NULL,'8.3.3','1'),(1582,1,1,1,1,1,'10950','B-109/5','Tapon 12mm',0.00,1.00,27,0,0,'','2013-05-15',NULL,'8.3.3','1'),(1583,1,1,1,1,1,'11080','B-110/8','Reduccion 22x16\"',0.00,1.00,8,0,0,'','2013-05-15',NULL,'8.3.3','1'),(1584,1,1,1,1,1,'1381','PC10x1/8\"','Conexion rapida 10x1/8\"',0.00,1.00,7,0,0,'','2013-05-15',NULL,'8.3.3','1'),(1585,1,1,1,1,1,'1382','','Codo hembra - macho 1/4x1/8\"',0.00,1.00,7,0,0,'','2013-05-15',NULL,'8.3.3','1'),(1586,1,1,1,1,1,'10960','B-109/6','Tapon 14mm',0.00,1.00,20,0,0,'','2013-05-15',NULL,'8.3.3','1'),(1587,1,1,1,1,1,'69110','B-69/11','Codo 12x3/8\"',0.00,1.00,14,0,0,'','2013-05-15',NULL,'8.3.3','1'),(1588,1,1,1,1,1,'10001','B-100','Codo hembra 3/8\"',0.00,1.00,10,0,0,'','2013-05-15',NULL,'8.3.3','1'),(1589,1,1,1,1,1,'1300011','13000/11','Entrerosca chasis',0.00,1.00,10,0,0,'','2013-05-15',NULL,'8.3.3','1'),(1590,1,1,1,1,1,'8000','PL8','Codo acople rapido 8mm',0.00,1.00,11,0,0,'','2013-05-15',NULL,'8.3.3','1'),(1591,1,1,1,1,1,'10941','B-109/4','Tapon 16mm',0.00,1.00,6,0,0,'','2013-05-15',NULL,'8.3.3','1'),(1592,1,1,1,1,1,'8001','PL8-1/4\"','Codo acople rapido 8x1/4\"',0.00,1.00,16,0,0,'','2013-05-15',NULL,'8.3.3','1'),(1593,1,1,1,1,1,'1383','PC8-1/4\"','Acople rapido a rosca 8x1/4\"',0.00,1.00,17,0,0,'','2013-05-15',NULL,'8.3.3','1'),(1594,1,1,1,1,1,'8002','PL8-1/8\"','Codo rapido 8 1/82',0.00,1.00,8,0,0,'','2013-05-15',NULL,'8.3.3','1'),(1595,1,1,1,1,1,'8003','PL6x14','Codo rapido 6x14\"',0.00,1.00,6,0,0,'','2013-05-15',NULL,'8.3.2','1'),(1596,1,1,1,1,1,'1384','PC6','Conexion T rapida 1/4 x6 ',0.00,1.00,15,0,0,'','2013-05-15',NULL,'8.3.2','1'),(1597,1,1,1,1,1,'1385','PUC6','Acople de rosca 6mm ',0.00,1.00,15,0,0,'','2013-05-15',NULL,'8.3.2','1'),(1598,1,1,1,1,1,'1386','','Acoples varios rosca ',0.00,1.00,21,0,0,'','2013-05-15',NULL,'8.3.2','1'),(1599,1,1,1,1,1,'1387','PC3 3/8','Acople rosca 3/8 ',0.00,1.00,34,0,0,'','2013-05-15',NULL,'8.3.2','1'),(1600,1,1,1,1,1,'1388','PC8 x 1/8','Codo rosca 8x1/8',0.00,1.00,35,0,0,'','2013-05-15',NULL,'8.3.2','1'),(1601,1,1,1,1,1,'1389','PL2','Acople recto y codo 16 ',0.00,1.00,36,0,0,'','2013-05-15',NULL,'8.3.2','1'),(1602,1,1,1,1,1,'1390','PV8 ','Cdo 8mm ',0.00,1.00,6,0,0,'','2013-05-15',NULL,'8.3.2','1'),(1603,1,1,1,1,1,'64125','64125','Rep. Bomba menor 1 1/8 F-100 ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'8.2.1','1'),(1604,1,1,1,1,1,'100075','100075','Rep. Bomba Dodge 1500 ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'8.2.1','1'),(1605,1,1,1,1,1,'85277','85277','Rep. Mayor bomba doble D100 1\"',0.00,1.00,1,0,0,'','2013-05-15',NULL,'8.2.1','1'),(1606,1,1,1,1,1,'77947','','Rep. Bomba 11/8\" F350 ( 69/81 ) ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'8.2.1','1'),(1607,1,1,1,1,1,'64035','64035','Rep. Mayor bomba Saveiro ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'8.2.1','1'),(1608,1,1,1,1,1,'5469','5469','Rep. Mayor bomba Saveiro ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'8.2.1','1'),(1609,1,1,1,1,1,'19430','19430','Rep. Mayor bomba simple F-350 1 1/8\" ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'8.2.1','1'),(1610,1,1,1,1,1,'87823','87823','Rep. Mayor bomba M.Benz 1521 1 3/8\" ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'8.2.1','1'),(1611,1,1,1,1,1,'139014','PUC 1/4\"','Conexion rapida 1/4 ',0.00,1.00,17,0,0,'','2013-05-15',NULL,'8.2.2','1'),(1612,1,1,1,1,1,'139516','PUC 5/16 ','Conexion rapida 5/16\" ',0.00,1.00,47,0,0,'','2013-05-15',NULL,'8.2.2-8.3.10','1'),(1613,1,1,1,1,1,'13904','PU-04','Conexion rapida 4mm',0.00,1.00,24,0,0,'','2013-05-15',NULL,'8.2.2','1'),(1614,1,1,1,1,1,'13906','PU-06','Conexion rapida 6MM ',0.00,1.00,22,0,0,'','2013-05-15',NULL,'8.2.2','1'),(1615,1,1,1,1,1,'13908','PU-08','Conexion rapida 8mm',0.00,1.00,18,0,0,'','2013-05-15',NULL,'8.2.2','1'),(1616,1,1,1,1,1,'139010','PU-10 ','Conexion rapida 10mm',0.00,1.00,13,0,0,'','2013-05-15',NULL,'8.2.2','1'),(1617,1,1,1,1,1,'13938','PU-3/8','Conexion rapida 3/8\"',0.00,1.00,34,0,0,'','2013-05-15',NULL,'8.2.2-8.3.10','1'),(1618,1,1,1,1,1,'139012','PU-1/2\"','Conexion rapida 1/2\" ',0.00,1.00,14,0,0,'','2013-05-15',NULL,'8.2.2','1'),(1619,1,1,1,1,1,'13912','PU-12','Conexion rapida 12mm ',0.00,1.00,3,0,0,'','2013-05-15',NULL,'8.2.2','1'),(1620,1,1,1,1,1,'1392','PPF12','Tapon 12mm ',0.00,1.00,6,0,0,'','2013-05-15',NULL,'8.2.2','1'),(1621,1,1,1,1,1,'1391','PPF10','Tapon 10mm ',0.00,1.00,7,0,0,'','2013-05-15',NULL,'8.2.2','1'),(1622,1,1,1,1,1,'139316','PU-3/16 ','Conexion rapida 3/16\"',0.00,1.00,49,0,0,'','2013-05-15',NULL,'8.2.3','1'),(1623,1,1,1,1,1,'1393','PG6-4','Reduccion rapida 6-4 ',0.00,1.00,34,0,0,'','2013-05-15',NULL,'8.2.3','1'),(1624,1,1,1,1,1,'1394','PG10-8','Reduccion rapida 10-8 ',0.00,1.00,40,0,0,'','2013-05-15',NULL,'8.2.3-8.3.10','1'),(1625,1,1,1,1,1,'1395','PGJ-10-6','Reduccion rapida 10-6 ',0.00,1.00,9,0,0,'','2013-05-15',NULL,'8.2.3','1'),(1626,1,1,1,1,1,'1396','PE/6','Conexion T rapida 6mm ',0.00,1.00,11,0,0,'','2013-05-15',NULL,'8.2.3','1'),(1627,1,1,1,1,1,'1397','PG-12/10','Reduccion rapida 12-10 ',0.00,1.00,7,0,0,'','2013-05-15',NULL,'8.2.3','1'),(1628,1,1,1,1,1,'1398','PE- 1/2 ','Conexion rapida T 1/2\"',0.00,1.00,10,0,0,'','2013-05-15',NULL,'8.2.3','1'),(1629,1,1,1,1,1,'1399','PU-1/4 ','Conexion T rapida 1/4\"',0.00,1.00,13,0,0,'','2013-05-15',NULL,'8.2.3','1'),(1630,1,1,1,1,1,'1402','PG-8-6','Reduccion rapida 8x6 ',0.00,1.00,21,0,0,'','2013-05-15',NULL,'8.2.3','1'),(1631,1,1,1,1,1,'1404','PE-8','Conexion rapida T 8mm ',0.00,1.00,9,0,0,'','2013-05-15',NULL,'8.2.3','1'),(1632,1,1,1,1,1,'1411','PE-10 ','Conexion rapida T 10mm ',0.00,1.00,8,0,0,'','2013-05-15',NULL,'8.2.3','1'),(1633,1,1,1,1,1,'11310','B-113','Conexion 10mm ',0.00,1.00,12,0,0,'','2013-05-15',NULL,'8.2.6','1'),(1634,1,1,1,1,1,'11090','B-110 /2 ','Reduccion 1/8 x 16mm ',0.00,1.00,30,0,0,'','2013-05-15',NULL,'8.2.6','1'),(1635,1,1,1,1,1,'242008','242008','Conexion freno hidraulica ',0.00,1.00,17,0,0,'','2013-05-15',NULL,'8.2.6','1'),(1636,1,1,1,1,1,'03500','N? 350 ','Tuerca n? 350',0.00,1.00,12,0,0,'','2013-05-15',NULL,'8.2.6','1'),(1637,1,1,1,1,1,'1412','','Tuerca paso fino 1/4 ',0.00,1.00,7,0,0,'','2013-05-15',NULL,'8.2.6','1'),(1638,1,1,1,1,1,'1413','','Tornillo paso fino 5/16 ',0.00,1.00,10,0,0,'','2013-05-15',NULL,'8.2.6','1'),(1639,1,1,1,1,1,'0244244','B0244244 ','Salida Hembra M.Benz ',0.00,1.00,18,0,0,'','2013-05-15',NULL,'8.2.6','1'),(1640,1,1,1,1,1,'0234200','B0234200C','Union ca?o M.Benz ',0.00,1.00,22,0,0,'','2013-05-15',NULL,'8.2.6','1'),(1641,1,1,1,1,1,'1414','','Tuerca P/ Doge - Valiant ',0.00,1.00,40,0,0,'','2013-05-15',NULL,'8.2.6','1'),(1642,1,1,1,1,1,'1415','','Conexion 10x22 ',0.00,1.00,13,0,0,'','2013-05-15',NULL,'8.2.6','1'),(1643,1,1,1,1,1,'20500','205','Tuerca freno 1/4 ',0.00,1.00,23,0,0,'','2013-05-15',NULL,'8.2.6','1'),(1644,1,1,1,1,1,'1416','','Tuerca 3/8 paso fino ',0.00,1.00,30,0,0,'','2013-05-15',NULL,'8.2.6','1'),(1645,1,1,1,1,1,'24900','249','Tuerca ca?o M.Benz ',0.00,1.00,36,0,0,'','2013-05-15',NULL,'8.2.6','1'),(1646,1,1,1,1,1,'85088','C-85288','Tuerca freno 13/16',0.00,1.00,17,0,0,'','2013-05-15',NULL,'8.2.6','1'),(1647,1,1,1,1,1,'1417','','Purgador 1/2\" ',0.00,1.00,19,0,0,'','2013-05-15',NULL,'8.2.6','1'),(1648,1,1,1,1,1,'1418','','Purgador cilindro varios ',0.00,1.00,46,0,0,'','2013-05-15',NULL,'8.2.5','1'),(1649,1,1,1,1,1,'51100','511','Purgador Ford ',0.00,1.00,3,0,0,'','2013-05-15',NULL,'8.2.5','1'),(1650,1,1,1,1,1,'32500','325','Purgador ',0.00,1.00,35,0,0,'','2013-05-15',NULL,'8.2.5','1'),(1651,1,1,1,1,1,'35700','357','Purgador ',0.00,1.00,75,0,0,'','2013-05-15',NULL,'8.2.5','1'),(1652,1,1,1,1,1,'35600','356','Purgador ',0.00,1.00,59,0,0,'','2013-05-15',NULL,'8.2.5','1'),(1653,1,1,1,1,1,'20100','201','Purgador M.Benz ',0.00,1.00,3,0,0,'','2013-05-15',NULL,'8.2.5','1'),(1654,1,1,1,1,1,'25900','259','Purgador Ford ',0.00,1.00,12,0,0,'','2013-05-15',NULL,'8.2.5','1'),(1655,1,1,1,1,1,'20501','205','Conexion de tuerca de freno 1/4\"',0.00,1.00,35,0,0,'','2013-05-15',NULL,'8.2.5','1'),(1656,1,1,1,1,1,'22800','228','Conexion de tuerca de freno 3/16 \"',0.00,1.00,28,0,0,'','2013-05-15',NULL,'8.2.5','1'),(1657,1,1,1,1,1,'31701','317','Tuerca Fiat ',0.00,1.00,24,0,0,'','2013-05-15',NULL,'8.2.5','1'),(1658,1,1,1,1,1,'1419','','Tornillo 6mm',0.00,1.00,6,0,0,'','2013-05-15',NULL,'8.2.5','1'),(1659,1,1,1,1,1,'23700','B-23/7','Tuerca ca?o union ',0.00,1.00,6,0,0,'','2013-05-15',NULL,'8.2.5','1'),(1660,1,1,1,1,1,'0240302','B0240302','Tuerca con pico ',0.00,1.00,16,0,0,'','2013-05-15',NULL,'8.2.5','1'),(1661,1,1,1,1,1,'40700','407','Tuerca freno 6mm ',0.00,1.00,33,0,0,'','2013-05-15',NULL,'8.2.5','1'),(1662,1,1,1,1,1,'31401','314','Tuerca freno 1/4 ',0.00,1.00,5,0,0,'','2013-05-15',NULL,'8.2.5','1'),(1663,1,1,1,1,1,'11101','B-110','Tornillo purgador 22x3/8',0.00,1.00,29,0,0,'','2013-05-15',NULL,'8.2.5','1'),(1664,1,1,1,1,1,'1420','T/O ','Tornillo hojal ',0.00,1.00,45,0,0,'','2013-05-15',NULL,'8.1.1','1'),(1665,1,1,1,1,1,'20401','204','Puergador Ford - Doge - Chevrolet ',0.00,1.00,4,0,0,'','2013-05-15',NULL,'8.1.1','1'),(1666,1,1,1,1,1,'27610','M-276/1','conexion M.Benz ',0.00,1.00,8,0,0,'','2013-05-15',NULL,'8.1.1','1'),(1667,1,1,1,1,1,'22922','B-229/2 ','Union flexible 7/16 x 1/4 ',0.00,1.00,12,0,0,'','2013-05-15',NULL,'8.1.1','1'),(1668,1,1,1,1,1,'22921','B-229/1 ','Union flexible 7/16 x3 /16 ',0.00,1.00,9,0,0,'','2013-05-15',NULL,'8.1.1','1'),(1669,1,1,1,1,1,'23020','M-230 /2 ','Union flexible 1/4 x 1/$ ',0.00,1.00,9,0,0,'','2013-05-15',NULL,'8.1.1','1'),(1670,1,1,1,1,1,'23120','M-231/2','Union flexible 1/4 ',0.00,1.00,4,0,0,'','2013-05-15',NULL,'8.1.1','1'),(1671,1,1,1,1,1,'23311','M-233/1','Union flexible 2 bocas 1/4 ',0.00,1.00,11,0,0,'','2013-05-15',NULL,'8.1.1','1'),(1672,1,1,1,1,1,'23212','M-232/1','Union flexible 2 bocas 3/16\" ',0.00,1.00,9,0,0,'','2013-05-15',NULL,'8.1.1','1'),(1673,1,1,1,1,1,'1421','','Conexiones varias ',0.00,1.00,12,0,0,'','2013-05-15',NULL,'8.1.1','1'),(1674,1,1,1,1,1,'23413','M-234/1','Union flexible 19/32 x 1/4 por 3 bocas ',0.00,1.00,4,0,0,'','2013-05-15',NULL,'8.1.1','1'),(1675,1,1,1,1,1,'1422','','Tuerca reduccion varias ',0.00,1.00,20,0,0,'','2013-05-15',NULL,'8.1.1','1'),(1676,1,1,1,1,1,'694206','B0694206C','Conexion codo 12x3/8',0.00,1.00,28,0,0,'','2013-05-15',NULL,'8.1.1','1'),(1677,1,1,1,1,1,'30117','30117','Tornillo completo Helvetica ',0.00,1.00,88,0,0,'','2013-05-15',NULL,'8.1.2','1'),(1678,1,1,1,1,1,'5031','5031','Tornillo completo Helvetica ',0.00,1.00,40,0,0,'','2013-05-15',NULL,'8.1.3','1'),(1679,1,1,1,1,1,'5032','503/1','Tornillo completo  ',0.00,1.00,17,0,0,'','2013-05-15',NULL,'8.1.3','1'),(1680,1,1,1,1,1,'32020','3202','Tornillo derecho ',0.00,1.00,76,0,0,'','2013-05-15',NULL,'8.1.3','1'),(1681,1,1,1,1,1,'10060','100/5-100/6','Conexion de aire M.Benz - Scania ',0.00,1.00,9,0,0,'','2013-05-15',NULL,'8.2.1','1'),(1682,1,1,1,1,1,'1429','','Tornillo milimetrico Fiat ',0.00,1.00,9,0,0,'','2013-05-15',NULL,'8.2.1','1'),(1683,1,1,1,1,1,'1430','','Tuercas ',0.00,1.00,28,0,0,'','2013-05-15',NULL,'8.2.1','1'),(1684,1,1,1,1,1,'1431','','Conos ',0.00,1.00,28,0,0,'','2013-05-15',NULL,'8.2.1','1'),(1685,1,1,1,1,1,'2391551','2391551/C','Rep. Buje y clip chevrolet silverado ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'8.2.1','1'),(1686,1,1,1,1,1,'97600','976','Buje caliper STD P.504/505 ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'8.2.1','1'),(1687,1,1,1,1,1,'7193','IM7193XG ','Rep. Mordaza F 150 ( USA ) ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'8.2.1','1'),(1688,1,1,1,1,1,'2890100','2890/1','Bulon caliper F1000 / C20',0.00,1.00,1,0,0,'','2013-05-15',NULL,'8.2.1','1'),(1689,1,1,1,1,1,'13206','13206','Perno y buje caliper ( Isuzu ) ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'8.2.1','1'),(1690,1,1,1,1,1,'1432','','Kit perno y clip caliper F100 / F-1000 - Chevrolet C-20 / D20 ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'8.2.1','1'),(1691,1,1,1,1,1,'467840311','467840/311','Rep. Kit antiruido Toyota - Isuzu ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'8.2.1','1'),(1692,1,1,1,1,1,'71010','IM7101','Rep. Kit antiruido F-100 ( Mod 96 ) ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'8.2.1','1'),(1693,1,1,1,1,1,'20191','KAM2019','Kit antiruido Chv blazer / S-10 ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'8.2.1','1'),(1694,1,1,1,1,1,'2627','CH2627','Kit antiruido ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'8.2.1','1'),(1695,1,1,1,1,1,'101926','K1019','Kit resorte trafic ( Varga ) ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'8.4.8','1'),(1696,1,1,1,1,1,'101450','K1014','Kit resorte R-19 , Clio ( Girl ) ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'8.4.8','1'),(1697,1,1,1,1,1,'100037','K1000 ','Kit resorte trasero Ford Escort 97',0.00,1.00,1,0,0,'','2013-05-15',NULL,'8.4.8','1'),(1698,1,1,1,1,1,'102840','K1028','Kit resorte P.504/505 ( Girling )',0.00,1.00,1,0,0,'','2013-05-15',NULL,'8.4.8','1'),(1699,1,1,1,1,1,'10052','K1005','Kit resorte VW Gasel - Senda ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'8.4.8','1'),(1700,1,1,1,1,1,'1423','Varias  ','Despiece de compresor ',0.00,1.00,20,0,0,'','2013-05-15',NULL,'8.4.8','1'),(1701,1,1,1,1,1,'1424','','Remaches de aluminio varios ',0.00,1.00,60,0,0,'','2013-05-15',NULL,'8.4.8','1'),(1702,1,1,1,1,1,'1425','','Remaches de bronce varios ',0.00,1.00,80,0,0,'','2013-05-15',NULL,'8.4.8','1'),(1703,1,1,1,1,1,'1433','K1018','Kit de resorte Ranger 11\" 97/ ( 2 ruedas ) ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'8.4.8','1'),(1704,1,1,1,1,1,'1434','K1010','Kit resorte Escort M/V ( 2 Ruedas ) ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'8.4.8','1'),(1705,1,1,1,1,1,'1435','K1001','Kit resorte trasero R-21 ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'8.4.8','1'),(1706,1,1,1,1,1,'1436','K1002','Kit resorte trasero VW saveiro ( 2 ruedas ) ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'8.4.8','1'),(1707,1,1,1,1,1,'1437','K1004','Kit resorte trasero Palio , Siena ( 2 ruedas ) ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'8.4.9','1'),(1708,1,1,1,1,1,'1438','K1037','Kit resorte Chevrolet corsa ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'8.4.9','1'),(1709,1,1,1,1,1,'1439','K1009','Kit resorte R19-R Clio ( Varga ) ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'8.4.8','1'),(1710,1,1,1,1,1,'1440','K1038','Kit resorte chevrolet S-10',0.00,1.00,1,0,0,'','2013-05-15',NULL,'8.4.8','1'),(1711,1,1,1,1,1,'1426','','Repuestos varios usados ',0.00,1.00,40,0,0,'','2013-05-15',NULL,'8.4.10','1'),(1712,1,1,1,1,1,'1427','','Tubo extractor servo ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'8.4.11','1'),(1713,1,1,1,1,1,'1428','','Electrodos varios ',0.00,1.00,60,0,0,'','2013-05-15',NULL,'8.4.11','1'),(1714,1,1,1,1,1,'101331','K1013','Kit registro  izq . F-Ranger 10\" ',0.00,1.00,4,0,0,'','2013-05-15',NULL,'8.4.3','1'),(1715,1,1,1,1,1,'101330','K1013','Kit registro derecho F-Ragner 10\" ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'8.4.3','1'),(1716,1,1,1,1,1,'101420','K1014D','Kit registro derecho F-Ragner 11\" ',0.00,1.00,6,0,0,'','2013-05-15',NULL,'8.4.3','1'),(1717,1,1,1,1,1,'17461','ST1746','Junta de fuelle servo ( X10 ) ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'8.4.3','1'),(1718,1,1,1,1,1,'1502066','1502066','Reten de servo tensa doble ',0.00,1.00,28,0,0,'','2013-05-15',NULL,'8.4.3','1'),(1719,1,1,1,1,1,'1564','','Sello de goma servo tensa ',0.00,1.00,15,0,0,'','2013-05-15',NULL,'8.4.3','1'),(1720,1,1,1,1,1,'1502070','1502070','Reten servo tensa doble ',0.00,1.00,31,0,0,'','2013-05-15',NULL,'8.4.3','1'),(1721,1,1,1,1,1,'2129915','2129915','Estrella servo ',0.00,1.00,5,0,0,'','2013-05-15',NULL,'8.4.3','1'),(1722,1,1,1,1,1,'2402157','2402157','Reten entrada servo ',0.00,1.00,16,0,0,'','2013-05-15',NULL,'8.4.3','1'),(1723,1,1,1,1,1,'2129462','2129462','Conjunto valvula ',0.00,1.00,12,0,0,'','2013-05-15',NULL,'8.4.3','1'),(1724,1,1,1,1,1,'02994','02994','Reten servo Bendix Fiat 128 ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'8.4.3','1'),(1725,1,1,1,1,1,'5937','5937','Reten de DBH 5937 ( Bruce ) ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'8.4.3','1'),(1726,1,1,1,1,1,'2402822','2402822','Anillo Vaquerita servo bendix ( Taunus ) ( Varga ) ',0.00,1.00,12,0,0,'','2013-05-15',NULL,'8.4.3','1'),(1727,1,1,1,1,1,'23720','2372','Sello de servo ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'8.4.3','1'),(1728,1,1,1,1,1,'2407200','2407200','Rep . Bomba 1\" D-100',0.00,1.00,3,0,0,'','2013-05-15',NULL,'8.4.1','1'),(1729,1,1,1,1,1,'1441','','Bidon fluido para frenos durbloc 1lt ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'8.4.1','1'),(1730,1,1,1,1,1,'1506643','1506643','Buje deslizante servo ( Taunus ) ',0.00,1.00,3,0,0,'','2013-05-15',NULL,'8.4.2','1'),(1731,1,1,1,1,1,'1504848','1504848','Buje deslizante corto',0.00,1.00,17,0,0,'','2013-05-15',NULL,'8.4.2','1'),(1732,1,1,1,1,1,'1155026','155026','Soporte compresor Doge 600 ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'8.4.2','1'),(1733,1,1,1,1,1,'6060975','6060975','Jgo. rep. Fijacion P/Caliper F100 ( 1985 ) ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'8.4.2','1'),(1734,1,1,1,1,1,'1442','','Ca?o compresor ',0.00,1.00,12,0,0,'','2013-05-15',NULL,'8.4.2','1'),(1735,1,1,1,1,1,'2402662','2402662','Cuerpo valvula ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'8.4.4','1'),(1736,1,1,1,1,1,'2402664','2402664','Cuerpo valvula ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'8.4.4','1'),(1737,1,1,1,1,1,'2402658','2402658','Cuerpo valvula ',0.00,1.00,3,0,0,'','2013-05-15',NULL,'8.4.4','1'),(1738,1,1,1,1,1,'1504848','1504848','Buje deslizante largo servo ( tensadoble )',0.00,1.00,1,0,0,'','2013-05-15',NULL,'8.4.4','1'),(1739,1,1,1,1,1,'2118003','2118003','Rep. Servo ',0.00,1.00,5,0,0,'','2013-05-15',NULL,'8.4.4','1'),(1740,1,1,1,1,1,'80077','8007/7 ','Reparacion incompleta ',0.00,1.00,4,0,0,'','2013-05-15',NULL,'8.4.5','1'),(1741,1,1,1,1,1,'80071','8007','Rep. Completa ',0.00,1.00,3,0,0,'','2013-05-15',NULL,'8.4.5','1'),(1742,1,1,1,1,1,'75620','7562','Rep. Mayor servo bendix ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'8.4.5','1'),(1743,1,1,1,1,1,'37970','37970','Rep. Servo ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'8.4.5','1'),(1744,1,1,1,1,1,'75310','SIR7531','Rep. Servo 3/4\"',0.00,1.00,1,0,0,'','2013-05-15',NULL,'8.4.5','1'),(1745,1,1,1,1,1,'30081','RC3008','Rep. Caliper  Chevrolet C20 / D20 54mm ( R. Tablada ) ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'8.4.7','1'),(1746,1,1,1,1,1,'30271','RC3027','Rep. Caliper Ford F100 / F150 / Duty 54mm ',0.00,1.00,3,0,0,'','2013-05-15',NULL,'8.4.7','1'),(1747,1,1,1,1,1,'174801','1748','Fuelle servo tensa ',0.00,1.00,15,0,0,'','2013-05-15',NULL,'8.4.6','1'),(1748,1,1,1,1,1,'174601','1746','Arandela servo ',0.00,1.00,27,0,0,'','2013-05-15',NULL,'8.4.6','1'),(1749,1,1,1,1,1,'983002','983','Conjunto de anclaje , zapata frenos Fiat duna ( CHAJ? ) ',0.00,1.00,23,0,0,'','2013-05-15',NULL,'8.4.6','1'),(1750,1,1,1,1,1,'6060975','6060975STD','Jgo. Fijacion P/Caliper STD F-100',0.00,1.00,23,0,0,'','2013-05-15',NULL,'8.4.6','1'),(1751,1,1,1,1,1,'6060976','6060976X','Jgo. de fijacion P/Caliper en primera F-100',0.00,1.00,14,0,0,'','2013-05-15',NULL,'8.4.6','1'),(1752,1,1,1,1,1,'1443','','Conjunto clavo y traba patin Fiat Uno ',0.00,1.00,37,0,0,'','2013-05-15',NULL,'8.4.6','1'),(1753,1,1,1,1,1,'1444','','Tornillo fijacion mordaza Chv . S-10 ',0.00,1.00,4,0,0,'','2013-05-15',NULL,'8.4.6','1'),(1754,1,1,1,1,1,'1447','','Tornillo fijacion mordaza Chv . D-20 ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'8.4.6','1'),(1755,1,1,1,1,1,'1449','','Tornillo fijacion mordaza Isuzu ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'8.4.6','1'),(1756,1,1,1,1,1,'14522','','Chapa mordaza M.Benz 312 ',0.00,1.00,12,0,0,'','2013-05-15',NULL,'8.4.6','1'),(1757,1,1,1,1,1,'1463','','Despiece de mordaza R-12',0.00,1.00,12,0,0,'','2013-05-15',NULL,'8.4.6','1'),(1758,1,1,1,1,1,'1464','','Seguro mordaza VW Gol ',0.00,1.00,7,0,0,'','2013-05-15',NULL,'8.4.6','1'),(1759,1,1,1,1,1,'14711','','Despiece de regulador automatico Ford Ranger ',0.00,1.00,6,0,0,'','2013-05-15',NULL,'8.4.6','1'),(1760,1,1,1,1,1,'24893','24893','Tornillo valvula compensadora R-12 ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'8.4.6','1'),(1761,1,1,1,1,1,'14721','','Despiece Mordaza Fiat 128 ',0.00,1.00,11,0,0,'','2013-05-15',NULL,'8.4.6','1'),(1762,1,1,1,1,1,'1473','','Trompo servo frenos silvania ',0.00,1.00,11,0,0,'','2013-05-15',NULL,'8.4.6','1'),(1763,1,1,1,1,1,'05735','05735','Valvula de retencion bomba universal ( compensadora ) ',0.00,1.00,5,0,0,'','2013-05-15',NULL,'8.4.6','1'),(1764,1,1,1,1,1,'1474','','Chaveta pasante mordaza Dodge 1500 ',0.00,1.00,7,0,0,'','2013-05-15',NULL,'8.4.6','1'),(1765,1,1,1,1,1,'223810','2238','Chapa de cuerpo valvula servo tensa ',0.00,1.00,5,0,0,'','2013-05-15',NULL,'8.4.6','1'),(1766,1,1,1,1,1,'2402139','2402139','Chaveta de fijacion buje servo ',0.00,1.00,12,0,0,'','2013-05-15',NULL,'8.4.6','1'),(1767,1,1,1,1,1,'1476','','Arandela de reaccion servo tensa ',0.00,1.00,10,0,0,'','2013-05-15',NULL,'8.4.6','1'),(1768,1,1,1,1,1,'1477','','Flexible fijacion trasero Fiat 128 ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'8.4.6','1'),(1769,1,1,1,1,1,'1478','','Cono de valvula de retencion de bomba ',0.00,1.00,28,0,0,'','2013-05-15',NULL,'8.4.6','1'),(1770,1,1,1,1,1,'1120806','B-112/7','Union doble para gas 1/2x3/8\"',0.00,1.00,5,0,0,'','2013-05-15',NULL,'8.3.5','1'),(1771,1,1,1,1,1,'12223','12/2','Arandela conica S/medida 20mm',0.00,1.00,20,0,0,'','2013-05-15',NULL,'8.1.5','1'),(1772,1,1,1,1,1,'135510','1355/1','Bulon M.Benz 1517 del. Completo',0.00,1.00,26,0,0,'','2013-05-15',NULL,'8.1.5','1'),(1773,1,1,1,1,1,'1479','','Bulon completo M.Benz',0.00,1.00,32,0,0,'','2013-05-15',NULL,'8.1.6','1'),(1774,1,1,1,1,1,'1480','73/1','Bulon completo de rueda (Nissan)',0.00,1.00,12,0,0,'','2013-05-15',NULL,'8.1.6','1'),(1775,1,1,1,1,1,'1481','73/1','Bulon de rueda M. Benz 1517 Tras. Completo (22x92)',0.00,1.00,21,0,0,'','2013-05-15',NULL,'8.1.6','1'),(1776,1,1,1,1,1,'1483','1196','Bulon trasero completo',0.00,1.00,40,0,0,'','2013-05-15',NULL,'8.1.7','1'),(1777,1,1,1,1,1,'1485','19','Bulon M. Benz 608 tras.',0.00,1.00,18,0,0,'','2013-05-15',NULL,'8.1.7','1'),(1778,1,1,1,1,1,'1487','1381','Bulon rueda completo ',0.00,1.00,52,0,0,'','2013-05-15',NULL,'8.1.7','1'),(1779,1,1,1,1,1,'1488','','Tornillos 3/16x1\" completo',0.00,1.00,25,0,0,'','2013-05-15',NULL,'8.2.7','1'),(1780,1,1,1,1,1,'1489','','Tuerca 3/16\"',0.00,1.00,100,0,0,'','2013-05-15',NULL,'8.2.7','1'),(1781,1,1,1,1,1,'14891','','Arandela grower 3/16\"',0.00,1.00,100,0,0,'','2013-05-15',NULL,'8.2.7','1'),(1782,1,1,1,1,1,'1490','','Tornillos 3/16x11/2\" completo',0.00,1.00,22,0,0,'','2013-05-15',NULL,'8.2.7','1'),(1783,1,1,1,1,1,'1491','','Tornillo 3/16x2\" completo',0.00,1.00,3,0,0,'','2013-05-15',NULL,'8.2.7','1'),(1784,1,1,1,1,1,'1492','','Arandela plana 3/16\"',0.00,1.00,300,0,0,'','2013-05-15',NULL,'8.2.7','1'),(1785,1,1,1,1,1,'1493','','Tornillo c/tuerca 5/32x1\"',0.00,1.00,20,0,0,'','2013-05-15',NULL,'8.2.7','1'),(1786,1,1,1,1,1,'1494','','Tornillo c/tuerca  5/32x33,34mm',0.00,1.00,20,0,0,'','2013-05-15',NULL,'8.2.7','1'),(1787,1,1,1,1,1,'1495','','Tornillo c/tuerca 1/4x1/2\"',0.00,1.00,54,0,0,'','2013-05-15',NULL,'8.2.7','1'),(1788,1,1,1,1,1,'1496','','Tornillo c/tuerca 1/4x1\"',0.00,1.00,16,0,0,'','2013-05-15',NULL,'8.2.7','1'),(1789,1,1,1,1,1,'1497','','Tornillo c/tuerca 1/4x11/2\"',0.00,1.00,24,0,0,'','2013-05-15',NULL,'8.2.7','1'),(1790,1,1,1,1,1,'1498','','Tornillo c/tuerca 1/4x11/4\"',0.00,1.00,8,0,0,'','2013-05-15',NULL,'8.2.7','1'),(1791,1,1,1,1,1,'1499','','Tornillo c/tuerca 3/8x3/4\"',0.00,1.00,26,0,0,'','2013-05-15',NULL,'8.2.7','1'),(1792,1,1,1,1,1,'1503','','Tornillo c/tuerca 3/8x7/8\"',0.00,1.00,18,0,0,'','2013-05-15',NULL,'8.2.7','1'),(1793,1,1,1,1,1,'1504','','Tornillo c/tuerca 3/8x1/4\"',0.00,1.00,44,0,0,'','2013-05-15',NULL,'8.2.7','1'),(1794,1,1,1,1,1,'1505','','Tornillo c/tuerca 3/8x1\"',0.00,1.00,44,0,0,'','2013-05-15',NULL,'8.2.7','1'),(1795,1,1,1,1,1,'1506','','Tornillo c/tuerca 7/16x1\"',0.00,1.00,10,0,0,'','2013-05-15',NULL,'8.2.7','1'),(1796,1,1,1,1,1,'1507','','Tornillo c/tuerca 7/16x11/4\"',0.00,1.00,31,0,0,'','2013-05-15',NULL,'8.2.7','1'),(1797,1,1,1,1,1,'1508','','Tuerca 3/8\"',0.00,1.00,50,0,0,'','2013-05-15',NULL,'8.2.7','1'),(1798,1,1,1,1,1,'1509','','Tuerca 1/4\" ',0.00,1.00,200,0,0,'','2013-05-15',NULL,'8.2.7','1'),(1799,1,1,1,1,1,'1510','','Tuerca 5/16\" ',0.00,1.00,100,0,0,'','2013-05-15',NULL,'8.2.7','1'),(1800,1,1,1,1,1,'1511','','Tornillo 5/16x3/4\"',0.00,1.00,150,0,0,'','2013-05-15',NULL,'8.2.7','1'),(1801,1,1,1,1,1,'1512','','Tornillo 5/16x1\"',0.00,1.00,12,0,0,'','2013-05-15',NULL,'8.2.7','1'),(1802,1,1,1,1,1,'1513','','Tornillo 5/16x11/4\"',0.00,1.00,30,0,0,'','2013-05-15',NULL,'8.2.7','1'),(1803,1,1,1,1,1,'1514','','Tornillo 5/16x11/2\"',0.00,1.00,30,0,0,'','2013-05-15',NULL,'8.2.7','1'),(1804,1,1,1,1,1,'1515','','Tornillo 5/16x13/4\"',0.00,1.00,5,0,0,'','2013-05-15',NULL,'8.2.7','1'),(1805,1,1,1,1,1,'1516','','Tornillo 3/8x2\"',0.00,1.00,4,0,0,'','2013-05-15',NULL,'8.2.8','1'),(1806,1,1,1,1,1,'1517','','Tornillo 5/16x2\"',0.00,1.00,30,0,0,'','2013-05-15',NULL,'8.2.8','1'),(1807,1,1,1,1,1,'1518','','Bulones completos varios (nuevo y usados)',0.00,1.00,1300,0,0,'','2013-05-15',NULL,'8.2.10,11','1'),(1808,1,1,1,1,1,'1519','','Bulones y esparragos varios (usados)',0.00,1.00,200,0,0,'','2013-05-15',NULL,'8.2.11','1'),(1809,1,1,1,1,1,'1520','','Tornillo 1/2x11/2\" rosca fina completo',0.00,1.00,20,0,0,'','2013-05-15',NULL,'8.2.9','1'),(1810,1,1,1,1,1,'1521','','Tornillo 1/2x11/4\" rosca fina completo',0.00,1.00,40,0,0,'','2013-05-15',NULL,'8.2.9','1'),(1811,1,1,1,1,1,'1522','','Tornillo 5/8x13/4\" rosca fina ',0.00,1.00,10,0,0,'','2013-05-15',NULL,'8.2.9','1'),(1812,1,1,1,1,1,'1523','','Tornillo 3/4x32.34 mm completo ',0.00,1.00,6,0,0,'','2013-05-15',NULL,'8.2.9','1'),(1813,1,1,1,1,1,'1528','','Remache hierro ventilado 6x19 ',0.00,1.00,7000,0,0,'','2013-05-15',NULL,'Puntera 4.1.1','1'),(1814,1,1,1,1,1,'1529','','Remache hierro 16x4.5x12',0.00,1.00,100,0,0,'','2013-05-15',NULL,'Puntera 4.2.1','1'),(1815,1,1,1,1,1,'1530','','Remache de cobre 12x4x8',0.00,1.00,1000,0,0,'','2013-05-15',NULL,'Puntera 4.2.1','1'),(1816,1,1,1,1,1,'1531','','Remache de aluminio 11x3.5x8',0.00,1.00,1000,0,0,'','2013-05-15',NULL,'Puntera 4.2.1','1'),(1817,1,1,1,1,1,'1532','','Remache de hierro 5x17x12',0.00,1.00,100,0,0,'','2013-05-15',NULL,'Puntera 4.2.1','1'),(1818,1,1,1,1,1,'1533','','Remache de aluminio 8x3.5x13',0.00,1.00,1000,0,0,'','2013-05-15',NULL,'Puntera 4.2.1','1'),(1819,1,1,1,1,1,'1534','','Remache de hierro 17x5x9',0.00,1.00,100,0,0,'','2013-05-15',NULL,'Puntera 4.2.2','1'),(1820,1,1,1,1,1,'1535','','Remache de aluminio 6-6',0.00,1.00,4000,0,0,'','2013-05-15',NULL,'Puntera 4.2.2','1'),(1821,1,1,1,1,1,'1536','','Remache de cobre 5-7',0.00,1.00,3000,0,0,'','2013-05-15',NULL,'Puntera 4.2.3','1'),(1822,1,1,1,1,1,'1537','','Remache de cobre 9x5x17',0.00,1.00,2300,0,0,'','2013-05-15',NULL,'Puntera 4.3.1','1'),(1823,1,1,1,1,1,'1538','','Remache de aluminio Macizo 31x11x6',0.00,1.00,300,0,0,'','2013-05-15',NULL,'Puntera 4.3.1','1'),(1824,1,1,1,1,1,'1539','','Remache de aluminio 19x12.5x6',0.00,1.00,500,0,0,'','2013-05-15',NULL,'Puntera 4.3.3','1'),(1825,1,1,1,1,1,'1540','','Remache de aluminio 6x22x11',0.00,1.00,1000,0,0,'','2013-05-15',NULL,'Puntera 4.3.4','1'),(1826,1,1,1,1,1,'1541','','Remache de aluminio 6x24x11',0.00,1.00,1000,0,0,'','2013-05-15',NULL,'Puntera 4.3.4','1'),(1827,1,1,1,1,1,'1542','','Remache de aluminio 22x8x13',0.00,1.00,1000,0,0,'','2013-05-15',NULL,'Puntera 4.4.1','1'),(1828,1,1,1,1,1,'1543','','Remache de aluminio 8x22x15',0.00,1.00,3000,0,0,'','2013-05-15',NULL,'Puntera 4.4.2','1'),(1829,1,1,1,1,1,'1544','','Remache de aluminio 8x22x17',0.00,1.00,2400,0,0,'','2013-05-15',NULL,'Puntera 4.4.3,4.5.3','1'),(1830,1,1,1,1,1,'1545','','Remache de aluminio 8x24x15',0.00,1.00,1000,0,0,'','2013-05-15',NULL,'Puntera 4.5.1','1'),(1831,1,1,1,1,1,'1546','','Remache de cobre 14x6x10',0.00,1.00,30,0,0,'','2013-05-15',NULL,'Puntera 4.5.1','1'),(1832,1,1,1,1,1,'1547','','Remache de cobre 10x3.5x8',0.00,1.00,100,0,0,'','2013-05-15',NULL,'Puntera 4.5.1','1'),(1833,1,1,1,1,1,'1548','','Remache de cobre 12x3.5x8',0.00,1.00,100,0,0,'','2013-05-15',NULL,'Puntera 4.5.1','1'),(1834,1,1,1,1,1,'1549','','Remache de aluminio 8x25x15',0.00,1.00,300,0,0,'','2013-05-15',NULL,'Puntera 4.5.2','1'),(1835,1,1,1,1,1,'1560','','Remache de aluminio 25x8x13',0.00,1.00,500,0,0,'','2013-05-15',NULL,'Puntera 4.6.1','1'),(1836,1,1,1,1,1,'1561','','Remache de aluminio fresado 9x32',0.00,1.00,800,0,0,'','2013-05-15',NULL,'Puntera 4.6.1','1'),(1837,1,1,1,1,1,'1562','','Remache de hierro macizo 6x19',0.00,1.00,6300,0,0,'','2013-05-15',NULL,'Puntera 4.6.2','1'),(1838,1,1,1,1,1,'1563','','Remache de hierro 6x22',0.00,1.00,300,0,0,'','2013-05-15',NULL,'Puntera 4.6.3','1'),(1839,1,1,1,1,1,'1564','','Remache de aluminio 8x15x19 fresado',0.00,1.00,60,0,0,'','2013-05-15',NULL,'Puntera 4.7.1','1'),(1840,1,1,1,1,1,'1565','','Remache hierro ventilado 8x16x15 ',0.00,1.00,500,0,0,'','2013-05-15',NULL,'Puntera 4.7.2','1'),(1841,1,1,1,1,1,'1566','','Remache de aluminio 5,35mmx14,87mm',0.00,1.00,2000,0,0,'','2013-05-15',NULL,'Puntera 4.7.3','1'),(1842,1,1,1,1,1,'1567','','Chaveta 5x40',0.00,1.00,60,0,0,'','2013-05-15',NULL,'Puntera 6.8.8','1'),(1843,1,1,1,1,1,'1568','','Chaveta 7x70 pulida',0.00,1.00,10,0,0,'','2013-05-15',NULL,'Puntera 6.3.3','1'),(1844,1,1,1,1,1,'1569','','Chaveta 2x40 pulida',0.00,1.00,100,0,0,'','2013-05-15',NULL,'Puntera 6.3.3','1'),(1845,1,1,1,1,1,'1570','','Chaveta 2x50 pulida',0.00,1.00,150,0,0,'','2013-05-15',NULL,'Puntera 6.4.4','1'),(1846,1,1,1,1,1,'1571','','Chaveta 3,5x50 partida',0.00,1.00,15,0,0,'','2013-05-15',NULL,'Puntera 6.4.4','1'),(1847,1,1,1,1,1,'1572','','Chaveta 2,5x50',0.00,1.00,100,0,0,'','2013-05-15',NULL,'Puntera 6.4.4','1'),(1848,1,1,1,1,1,'1573','','Chaveta 4x30',0.00,1.00,100,0,0,'','2013-05-15',NULL,'Puntera 6.5.5','1'),(1849,1,1,1,1,1,'1574','','Chaveta 4x32',0.00,1.00,100,0,0,'','2013-05-15',NULL,'Puntera 6.5.5','1'),(1850,1,1,1,1,1,'1575','','Chaveta 4x40',0.00,1.00,30,0,0,'','2013-05-15',NULL,'Puntera 6.5.5','1'),(1851,1,1,1,1,1,'1576','','Chaveta 4x38',0.00,1.00,50,0,0,'','2013-05-15',NULL,'Puntera 6.5.5','1'),(1852,1,1,1,1,1,'1577','','Chaveta 4x30',0.00,1.00,100,0,0,'','2013-05-15',NULL,'Puntera 6.5.5','1'),(1853,1,1,1,1,1,'1578','','Chaveta 5x30',0.00,1.00,80,0,0,'','2013-05-15',NULL,'Puntera 6.5.5','1'),(1854,1,1,1,1,1,'1579','','Chaveta 4x50',0.00,1.00,50,0,0,'','2013-05-15',NULL,'Puntera 6.6.6','1'),(1855,1,1,1,1,1,'1580','','Chaveta 5x40',0.00,1.00,260,0,0,'','2013-05-15',NULL,'Puntera 6.6.6','1'),(1856,1,1,1,1,1,'1581','','Chaveta 6x50',0.00,1.00,180,0,0,'','2013-05-15',NULL,'Puntera 6.6.6','1'),(1857,1,1,1,1,1,'1582','','Chaveta 5x90',0.00,1.00,8,0,0,'','2013-05-15',NULL,'Puntera 6.7.7','1'),(1858,1,1,1,1,1,'1583','','Chaveta 6x100',0.00,1.00,50,0,0,'','2013-05-15',NULL,'Puntera 6.7.7','1'),(1859,1,1,1,1,1,'1584','','Chaveta 2x35',0.00,1.00,50,0,0,'','2013-05-15',NULL,'Puntera 6.7.7','1'),(1860,1,1,1,1,1,'1585','','Chaveta 7x70',0.00,1.00,50,0,0,'','2013-05-15',NULL,'Puntera 6.7.7','1'),(1861,1,1,1,1,1,'1586','','Chaveta 8x100',0.00,1.00,100,0,0,'','2013-05-15',NULL,'Puntera 6.7.7','1'),(1862,1,1,1,1,1,'1587','','Chaveta 5x50',0.00,1.00,70,0,0,'','2013-05-15',NULL,'Puntera 6.8.8','1'),(1863,1,1,1,1,1,'20598','D1106','Kit. reparacion Bendix (autofren) 19mm',0.00,1.00,6,0,0,'','2013-05-15',NULL,'Puntera 6.8.8','1'),(1864,1,1,1,1,1,'20198','D1104','Kit reparacion Bendix (autofren) 20,6mm',0.00,1.00,2,0,0,'','2013-05-15',NULL,'Puntera 6.8.8','1'),(1865,1,1,1,1,1,'2390300','','Juego rep. c/cubeta original Ford Falcon 22mm',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 6.9.9','1'),(1866,1,1,1,1,1,'75211','','Juego rep. c/cubeta original Ford Falcon 15/16',0.00,1.00,2,0,0,'','2013-05-15',NULL,'Puntera 6.9.9','1'),(1867,1,1,1,1,1,'120025','','Juego rep. c/cubeta original Fiat 147 (13/16)',0.00,1.00,2,0,0,'','2013-05-15',NULL,'Puntera 6.9.9','1'),(1868,1,1,1,1,1,'1588','','Juego rep. c/cubeta original Fiat Duna (13/16)',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 6.9.9','1'),(1869,1,1,1,1,1,'1589','','Rulemanes usados',0.00,1.00,6,0,0,'','2013-05-15',NULL,'Puntera 6.10.10','1'),(1870,1,1,1,1,1,'1590','','Ruleman Timken (382A) c/cubeta (387A)',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 6.10.10','1'),(1871,1,1,1,1,1,'10294910','M102949/10','Ruleman KBC bearing ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 6.10.10','1'),(1872,1,1,1,1,1,'2678','','Ruleman SKF',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 6.10.10','1'),(1873,1,1,1,1,1,'010396','331459B','Ruleman SKF conico de palier F-100',0.00,1.00,2,0,0,'','2013-05-15',NULL,'Puntera 6.10.10','1'),(1874,1,1,1,1,1,'50134910','LM501349/10','Ruleman MKW-Germany (usado)',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 6.10.10','1'),(1875,1,1,1,1,1,'230494','F-45226','Ruleman Combi-VW',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 6.10.10','1'),(1876,1,1,1,1,1,'1596','','Arandelas tope de leva',0.00,1.00,11,0,0,'','2013-05-15',NULL,'Puntera 7.1.1','1'),(1877,1,1,1,1,1,'1597','','Tuerca manga acoplado',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 7.1.1','1'),(1878,1,1,1,1,1,'1598','','Tuerca punta de eje Ford (camioneta)',0.00,1.00,3,0,0,'','2013-05-15',NULL,'Puntera 7.1.1','1'),(1879,1,1,1,1,1,'391599','A-39','Seguro segger cerrados y abiertos 18,5/25/32/34(espesor3mm)/35/36/40/41/43/52/56/73/111/23,32(abierto)mm',0.00,1.00,239,0,0,'','2013-05-15',NULL,'Puntera 8.1.1,2,3,4','1'),(1880,1,1,1,1,1,'1600','','Tuerca punta de eje',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 8.1.1','1'),(1881,1,1,1,1,1,'1601','','Arandela tope ruleman',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 8.1.1','1'),(1882,1,1,1,1,1,'1602','','Tuerca de manga',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 8.3.3','1'),(1883,1,1,1,1,1,'1603','','Tuerca punta de eje',0.00,1.00,2,0,0,'','2013-05-15',NULL,'Puntera 8.3.3','1'),(1884,1,1,1,1,1,'1604','','Tuerca',0.00,1.00,4,0,0,'','2013-05-15',NULL,'Puntera 9.1.1','1'),(1885,1,1,1,1,1,'1605','','Tuerca',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 9.1.1','1'),(1886,1,1,1,1,1,'1606','','Tuerca',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 9.1.1','1'),(1887,1,1,1,1,1,'1607','','Tuerca',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 9.1.1','1'),(1888,1,1,1,1,1,'16123','','Arandelas de aluminio 10,12,13,14,6,8,32,16,18,9,23,24,20,22mm,2\"',0.00,1.00,1000,0,0,'','2013-05-15',NULL,'Puntera 9.2.2,3,4,5,6','1'),(1889,1,1,1,1,1,'2489265','','Cable de freno de mano del. Pick Up D100 (largo 2857)',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 9.1.1','1'),(1890,1,1,1,1,1,'39078','3-9078','Cable de freno de mano ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 9.1.1','1'),(1891,1,1,1,1,1,'1612','','Cable pare motor Scania 1111',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 9.1.1','1'),(1892,1,1,1,1,1,'3529','3-A081','Cable de freno de mano a disco izq. F-100 (99/-Largo1980mm)',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 9.1.1','1'),(1893,1,1,1,1,1,'1613','','Cable de freno de mano',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 9.1.1','1'),(1894,1,1,1,1,1,'1614','','Seguro',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 9.1.1','1'),(1895,1,1,1,1,1,'84001','840','Cable de freno delantero F-100 (92/96) (largo 2156mm)',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 9.1.1','1'),(1896,1,1,1,1,1,'315002','315','Cable de freno palanca Traffic (largo 720mm)',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 9.1.1','1'),(1897,1,1,1,1,1,'399003','399','Cable de freno entre ruedas T6B-Reforma (largo 2920mm)',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 9.1.1','1'),(1898,1,1,1,1,1,'1615','','Cable de freno',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 9.1.1','1'),(1899,1,1,1,1,1,'424004','424','Cable de freno palanca D-1500/78 (largo 1545mm)',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 9.1.1','1'),(1900,1,1,1,1,1,'43003','43','Cable de freno entreruedas Ford Falcon 82/ (largo 3940mm)',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 9.1.1','1'),(1901,1,1,1,1,1,'49005','49','Cable de freno F-100 izq. 66/73 (largo 1500mm)',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 9.1.1','1'),(1902,1,1,1,1,1,'72609707','730','Cable de freno trasero Ford F-4000 (largo 1645mm)',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 9.1.1','1'),(1903,1,1,1,1,1,'76008','760','Cable de freno izq. a campana Peugeot 405 (largo 850mm)',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 9.1.1','1'),(1904,1,1,1,1,1,'76108','761','Cable de freno derecho a campana Peugeot 405 (largo 770mm)',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 9.1.1','1'),(1905,1,1,1,1,1,'236009','236','Cable de freno palanca F69 hasta 89 (largo 1252mm)',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 9.1.1','1'),(1906,1,1,1,1,1,'1616','','Cable de freno mano ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 9.1.1','1'),(1907,1,1,1,1,1,'1617','','Cable de freno mano ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 9.1.1','1'),(1908,1,1,1,1,1,'16181','','Tuerca punta de eje camioneta',0.00,1.00,3,0,0,'','2013-05-15',NULL,'Puntera 7.1.1','1'),(1909,1,1,1,1,1,'16195','','Arandela espaciadora ',0.00,1.00,14,0,0,'','2013-05-15',NULL,'Puntera 7.1.1','1'),(1910,1,1,1,1,1,'70000','70000','Arandela punta de eje M.Benz 3500-911',0.00,1.00,4,0,0,'','2013-05-15',NULL,'Puntera 7.2.2','1'),(1911,1,1,1,1,1,'70005','70005','Arandela punta de eje M.Benz 608',0.00,1.00,9,0,0,'','2013-05-15',NULL,'Puntera 7.2.2','1'),(1912,1,1,1,1,1,'20002','','Seguro ara?a camioneta',0.00,1.00,2,0,0,'','2013-05-15',NULL,'Puntera 7.2.2','1'),(1913,1,1,1,1,1,'162402','','Junta de palier F-350',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 7.2.3','1'),(1914,1,1,1,1,1,'16203','','Tuerca punta de eje acoplado',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 7.2.2','1'),(1915,1,1,1,1,1,'18625','','Arandela tope ruleman Scania',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 7.4.4','1'),(1916,1,1,1,1,1,'20007','','Tuerca punta de eje camioneta',0.00,1.00,4,0,0,'','2013-05-15',NULL,'Puntera 7.4.4','1'),(1917,1,1,1,1,1,'1627','','Tuerca punta de eje camion',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 7.5.5','1'),(1918,1,1,1,1,1,'1628','','Seguro 8 Scania',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 7.7.7','1'),(1919,1,1,1,1,1,'1650','','Tuerca punta de eje F-350',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 7.7.7','1'),(1920,1,1,1,1,1,'1651','','Tuerca punta de eje Scania',0.00,1.00,2,0,0,'','2013-05-15',NULL,'Puntera 7.7.7','1'),(1921,1,1,1,1,1,'1730','','Seguro punta de eje Ford',0.00,1.00,5,0,0,'','2013-05-15',NULL,'Puntera 8.1.1','1'),(1922,1,1,1,1,1,'1738','','Tuerca punta de eje Scania',0.00,1.00,3,0,0,'','2013-05-15',NULL,'Puntera 8.1.1','1'),(1923,1,1,1,1,1,'1739','','Tuerca de manga',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 8.1.1','1'),(1924,1,1,1,1,1,'1740992','','Arandela tope ruleman Scania',0.00,1.00,2,0,0,'','2013-05-15',NULL,'Puntera 10.8.8','1'),(1925,1,1,1,1,1,'52111','521/1','Tuerca de manga prati',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 10.8.8','1'),(1926,1,1,1,1,1,'16123','','Arandela aluminio 39mm',0.00,1.00,59,0,0,'','2013-05-15',NULL,'Puntera 10.9.9','1'),(1927,1,1,1,1,1,'273024','','Arandela punta de eje Scania 1113',0.00,1.00,2,0,0,'','2013-05-15',NULL,'Puntera 10.6.6','1'),(1928,1,1,1,1,1,'1634','','Tuerca punta de eje acoplado',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 10.10.10','1'),(1929,1,1,1,1,1,'1637','','Tuerca punta de eje M. Benz 1620',0.00,1.00,3,0,0,'','2013-05-15',NULL,'Puntera 10.10.10','1'),(1930,1,1,1,1,1,'1658','','Aro de pulmon ',0.00,1.00,5,0,0,'','2013-05-15',NULL,'Puntera 10.10.10','1'),(1931,1,1,1,1,1,'1729','','Aro de servo',0.00,1.00,3,0,0,'','2013-05-15',NULL,'Puntera 10.10.10','1'),(1932,1,1,1,1,1,'209841','M-2098/A','Seguro ara?a M.Benz 608',0.00,1.00,11,0,0,'','2013-05-15',NULL,'Puntera 10.1.1','1'),(1933,1,1,1,1,1,'2097','M-2097','Seguro ara?a M.Benz 1114/1112',0.00,1.00,5,0,0,'','2013-05-15',NULL,'Puntera 10.1.1','1'),(1934,1,1,1,1,1,'2085','M-2085','Seguro ara?a M.Benz 1517',0.00,1.00,15,0,0,'','2013-05-15',NULL,'Puntera 10.1.1','1'),(1935,1,1,1,1,1,'202018','2018','Seguro de manga acoplado Helvetica vieja (Maldonado viejo)',0.00,1.00,19,0,0,'','2013-05-15',NULL,'Puntera 10.1.1','1'),(1936,1,1,1,1,1,'2168','M-2168','Seguro ara?a Ford 350',0.00,1.00,3,0,0,'','2013-05-15',NULL,'Puntera 10.2.2','1'),(1937,1,1,1,1,1,'20516','M-2051','Seguro ara?a Berdford (reforma)',0.00,1.00,82,0,0,'','2013-05-15',NULL,'Puntera 10.2.2','1'),(1938,1,1,1,1,1,'20984','M-2098/4','Seguro ara?a Ford cargo',0.00,1.00,6,0,0,'','2013-05-15',NULL,'Puntera 10.2.2','1'),(1939,1,1,1,1,1,'2169','','Tuerca de manga F-350',0.00,1.00,3,0,0,'','2013-05-15',NULL,'Puntera 10.2.2','1'),(1940,1,1,1,1,1,'5253','C-5253','Arandela tope ruleman Randon',0.00,1.00,11,0,0,'','2013-05-15',NULL,'Puntera 10.2.2','1'),(1941,1,1,1,1,1,'2170','','Arandela tope ruleman',0.00,1.00,3,0,0,'','2013-05-15',NULL,'Puntera 10.3.3','1'),(1942,1,1,1,1,1,'210111','M-2101/A','Seguro ara?a M.Benz 911',0.00,1.00,14,0,0,'','2013-05-15',NULL,'Puntera 10.3.3','1'),(1943,1,1,1,1,1,'210112','M-2101','Tuerca de manga Berford (usada)',0.00,1.00,13,0,0,'','2013-05-15',NULL,'Puntera 10.3.3','1'),(1944,1,1,1,1,1,'5456','C-5456','Seguro de manga Maldonado ',0.00,1.00,7,0,0,'','2013-05-15',NULL,'Puntera 10.3.3','1'),(1945,1,1,1,1,1,'22022','','Tuerca de manga Dodge 600',0.00,1.00,2,0,0,'','2013-05-15',NULL,'Puntera 10.4.4','1'),(1946,1,1,1,1,1,'2053','M-2053','Seguro ara?a Chevrolet',0.00,1.00,7,0,0,'','2013-05-15',NULL,'Puntera 10.4.4','1'),(1947,1,1,1,1,1,'273023','M-0002','Seguro de manga Scania 112/113/111',0.00,1.00,5,0,0,'','2013-05-15',NULL,'Puntera 10.4.4','1'),(1948,1,1,1,1,1,'287449','M-0001','Arandela seguro punta de eje Scania 111',0.00,1.00,17,0,0,'','2013-05-15',NULL,'Puntera 10.4.4','1'),(1949,1,1,1,1,1,'1629','','Pista de reten M.Benz ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 10.5.5','1'),(1950,1,1,1,1,1,'1630','','Seguro arandela avispero M.Benz 911',0.00,1.00,15,0,0,'','2013-05-15',NULL,'Puntera 10.5.5','1'),(1951,1,1,1,1,1,'2126','M-2426','Pista de reten M.Benz 608',0.00,1.00,3,0,0,'','2013-05-15',NULL,'Puntera 10.5.5','1'),(1952,1,1,1,1,1,'16202','','Seguro punta de eje M. Benz 1620',0.00,1.00,3,0,0,'','2013-05-15',NULL,'Puntera 10.5.5','1'),(1953,1,1,1,1,1,'287450','','Arandela tope ruleman Scania',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 10.6.6','1'),(1954,1,1,1,1,1,'5454','C-5454','Seguro de manga salto',0.00,1.00,8,0,0,'','2013-05-15',NULL,'Puntera 10.7.7','1'),(1955,1,1,1,1,1,'16073','','Seguro segger M.Benz ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'Puntera 10.7.7','1'),(1956,1,1,1,1,1,'16075','','Seguro de tuerca acoplado ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 10.7.7','1'),(1957,1,1,1,1,1,'16080','','Seguro de manga guerra',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 10.7.7','1'),(1958,1,1,1,1,1,'210114','','Tuerca Randon',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 10.7.7','1'),(1959,1,1,1,1,1,'5254','C-5254','Seguro ara?a Randon',0.00,1.00,33,0,0,'','2013-05-15',NULL,'Puntera 10.7.7','1'),(1960,1,1,1,1,1,'2730245','273024/5','Tuerca de masa trasera Scania 111/112',0.00,1.00,1,0,0,'','2013-05-15',NULL,'Puntera 10.8.8','1'),(1961,1,1,1,1,1,'1403619','','Tuerca M.Benz ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'Puntera 10.8.8','1'),(1962,1,1,1,1,1,'964','','Junta de palier carton M.Benz',0.00,1.00,1,0,0,'','2013-05-15',NULL,'19.4.4','1'),(1963,1,1,1,1,1,'315859','','Junta de palier M.Benz 10 agujeros (carton)',0.00,1.00,1,0,0,'','2013-05-15',NULL,'19.4.4','1'),(1964,1,1,1,1,1,'0169974048301','0169974048/301','O?ring grande M. Benz 1633/1938 rueda trasera ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'19.4.4','1'),(1965,1,1,1,1,1,'1654','1654','Cinta Especial (por bloque) 22mm',0.00,1.00,4,0,0,'','2013-05-15',NULL,'9.1.4','1'),(1966,1,1,1,1,1,'11197','','Cinta Frenos Oeste en 2? medida ',0.00,1.00,8,0,0,'','2013-05-15',NULL,'9.2.5','1'),(1967,1,1,1,1,1,'52101','M-52101','Arandela tope ruleman M. Benz 1114',0.00,1.00,8,0,0,'','2013-05-15',NULL,'Puntera 10.6.6','1'),(1968,1,1,1,1,1,'100915','100915','Fuelle Gobernador',0.00,1.00,5,0,0,'','2013-05-15',NULL,'11.2.6','1'),(1969,1,1,1,1,1,'200500','200500','Servo Cafh s/bomba 1 1/2 ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'5.2.4','1'),(1970,1,1,1,1,1,'34192','R-1350','Diafragma de 7\" Americana',0.00,1.00,99,0,0,'','2013-05-15',NULL,'11.4.2','1'),(1971,1,1,1,1,1,'385462004','PAF 0604 -(CHAS 38-546/2004)','Juego de Pastillas Renault - Volvo',0.00,1.00,2,0,0,'','2013-05-15',NULL,'12.3.10','1'),(1972,1,1,1,1,1,'7,89303E+12','PD/63','Juego de Pastillas Ford F-250 XLT (96/)(trasera) Frasle',0.00,1.00,1,0,0,'','2013-05-15',NULL,'12.1.5','1'),(1973,1,1,1,1,1,'7,89251E+12','BP-17','Juego de Pastillas VW GOL 1.0 (92/) , 1.6 (83/94)',0.00,1.00,1,0,0,'','2013-05-15',NULL,'12.4.5','1'),(1974,1,1,1,1,1,'9730010100','B175','Reparacion Relay Mayor Wabco',0.00,1.00,7,0,0,'','2013-05-15',NULL,'17.3.3','1'),(1975,1,1,1,1,1,'4662','R4662','Juego de Reparacion Valvula Sobrecarga',0.00,1.00,1,0,0,'','2013-05-15',NULL,'17.7.7','1'),(1976,1,1,1,1,1,'4005000810','','Valvula ABS Wabco',0.00,1.00,2,0,0,'','2013-05-15',NULL,'12.3.8','1'),(1977,1,1,1,1,1,'4410329222','','Juego de Reparacion Sistema Vehiculo Control Wabco',0.00,1.00,14,0,0,'','2013-05-15',NULL,'12.3.8','1'),(1978,1,1,1,1,1,'4410327270','','Sensor ABS Wabco ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'12.3.8','1'),(1979,1,1,1,1,1,'4463016330','','Software de Diagnostico Wabco (tractor)',0.00,1.00,1,0,0,'','2013-05-15',NULL,'12.4.8','1'),(1980,1,1,1,1,1,'4463015440','','Software de Diagnostico Wabco',0.00,1.00,1,0,0,'','2013-05-15',NULL,'12.4.8','1'),(1981,1,1,1,1,1,'4463015130','','Software de Diagnostico VCSII Wabco',0.00,1.00,1,0,0,'','2013-05-15',NULL,'12.4.8','1'),(1982,1,1,1,1,1,'137032','PRI 137032','Cable ABS Wabco',0.00,1.00,1,0,0,'','2013-05-15',NULL,'12.4.8','1'),(1983,1,1,1,1,1,'4721950180','','Valvula Solenoide con cable ABS HALDEX',0.00,1.00,2,0,0,'','2013-05-15',NULL,'12.4.8','1'),(1984,1,1,1,1,1,'1014404','496','Reparacion Valvula Secador Aire (Apu)(BEL-AR)',0.00,1.00,1,0,0,'','2013-05-15',NULL,'16.3.3','1'),(1985,1,1,1,1,1,'3630','W 3630','Juego de Reparacion Valvula Manual (Electroneumatica) RG',0.00,1.00,1,0,0,'','2013-05-15',NULL,'16.4.4','1'),(1986,1,1,1,1,1,'7,89429E+12','SEB01593','Tapa Compresor (Valvula Lamelas) Knorr',0.00,1.00,1,0,0,'','2013-05-15',NULL,'18.5.5','1'),(1987,1,1,1,1,1,'1432','1432','Reten de Leva delantero (interno)',0.00,1.00,2,0,0,'','2013-05-15',NULL,'14.4.4','1'),(1988,1,1,1,1,1,'2664','2664','Reten de Palier rueda trasera ',0.00,1.00,2,0,0,'','2013-05-15',NULL,'14.4.4','1'),(1989,1,1,1,1,1,'4662','4662','Juego de Rep. Valvula sobrecarga',0.00,1.00,1,0,0,'','2013-05-15',NULL,'17.7.7','1'),(1990,1,1,1,1,1,'5155','5155','Rep. Valvula Retencion Wabco',0.00,1.00,8,0,0,'','2013-05-15',NULL,'17.10.10','1'),(1991,1,1,1,1,1,'200300','200300','Pulmon Simple',0.00,1.00,7,0,0,'','2013-05-15',NULL,'1.1.4','1'),(1992,1,1,1,1,1,'3093','RC 3093/I','Reparacion Caliper M. Benz Sprinter 313/413 delantera (45mm.) Bosch - Rep. Tablada',0.00,1.00,2,0,0,'','2013-05-15',NULL,'ver ubicacion','1'),(1993,1,1,1,1,1,'1740','','valvula plato eje neumatico Festo',0.00,1.00,1,0,0,'','2013-05-15',NULL,'15.2.1','1'),(1994,1,1,1,1,1,'441050008','','Valvula suspension Scania WABCO',0.00,1.00,2,0,0,'','2013-05-15',NULL,'15.2.2','1'),(1995,1,1,1,1,1,'1741','','Valvula suspension ',0.00,1.00,1,0,0,'','2013-05-15',NULL,'15.2.2','1'),(1996,1,1,1,1,1,'1742','T2305','Valvula Gobernadora tipo Iveco',0.00,1.00,3,0,0,'','2013-05-15',NULL,'15.2.2','1'),(1997,1,1,1,1,1,'1743','','Valvula control Spring reparada',0.00,1.00,1,0,0,'','2013-05-15',NULL,'15.1.4','1'),(1998,1,1,1,1,1,'1744','159625/2','valvula secadora aire MB con filtro reparada',0.00,1.00,1,0,0,'','2013-05-15',NULL,'15.2.4','1'),(1999,1,1,1,1,1,'1745','20/244','Valvula gobernadora reparada Fiat',0.00,1.00,1,0,0,'','2013-05-15',NULL,'15.2.4','1'),(2000,1,1,1,1,1,'1746','','Vigote MB reparado',0.00,1.00,1,0,0,'','2013-05-15',NULL,'15.2.4','1'),(2001,1,1,1,1,1,'934705002','934705002','Valvula 6 vias WABCO reparada',0.00,1.00,1,0,0,'','2013-05-15',NULL,'15.2.4','1'),(2002,1,1,1,1,1,'1747','R4620','Valvula 4 vias reparada',0.00,1.00,1,0,0,'','2013-05-15',NULL,'15.2.4','1'),(2003,1,1,1,1,1,'1748','75/199','Valvula Relay reparada',0.00,1.00,1,0,0,'','2013-05-15',NULL,'15.2.4','1'),(2004,1,1,1,1,1,'1749','','Valvula Triler reparada',0.00,1.00,1,0,0,'','2013-05-15',NULL,'15.2.4','1');

/*Table structure for table `producto_proveedor` */

DROP TABLE IF EXISTS `producto_proveedor`;

CREATE TABLE `producto_proveedor` (
  `id_prod_provd` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_producto` bigint(20) DEFAULT NULL,
  `id_proveedor` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id_prod_provd`),
  KEY `FK_producto_proveedor` (`id_producto`),
  KEY `FK_producto_proveedor_persona` (`id_proveedor`),
  CONSTRAINT `FK_producto_proveedor` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE,
  CONSTRAINT `FK_producto_proveedor_persona` FOREIGN KEY (`id_proveedor`) REFERENCES `persona` (`id_persona`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `producto_proveedor` */

insert  into `producto_proveedor`(`id_prod_provd`,`id_producto`,`id_proveedor`) values (2,2,22),(4,1,3),(5,3,3),(6,3,22);

/*Table structure for table `remito` */

DROP TABLE IF EXISTS `remito`;

CREATE TABLE `remito` (
  `id_remito` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_vendedor` bigint(20) DEFAULT NULL,
  `id_orden` bigint(20) DEFAULT NULL,
  `id_vehiculo` bigint(20) unsigned DEFAULT NULL,
  `id_cliente` bigint(20) DEFAULT NULL,
  `num_remi` bigint(20) DEFAULT NULL,
  `obs_remi` text,
  `fecemi_remi` date DEFAULT NULL,
  `total_remi` double(10,2) DEFAULT NULL,
  `estado_remi` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id_remito`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `remito` */

insert  into `remito`(`id_remito`,`id_vendedor`,`id_orden`,`id_vehiculo`,`id_cliente`,`num_remi`,`obs_remi`,`fecemi_remi`,`total_remi`,`estado_remi`) values (1,1,0,1,25,1,'primer remito con vehiculo','2013-05-10',56.05,'1'),(2,1,0,7,25,2,'segundo remito','2013-05-10',198.35,'2'),(3,1,0,3,19,0,'','2013-05-11',40.25,'1'),(4,1,0,3,19,25,'','2013-05-11',28.75,'1'),(5,1,0,0,25,0,'','2013-05-11',28.75,'1'),(6,1,0,0,25,0,'','2013-05-11',0.00,'2'),(7,1,0,0,18,0,'','2013-05-11',28.75,'2'),(8,1,0,7,19,0,'','2013-05-24',2.00,'1');

/*Table structure for table `sexo` */

DROP TABLE IF EXISTS `sexo`;

CREATE TABLE `sexo` (
  `id_sexo` bigint(20) NOT NULL AUTO_INCREMENT,
  `nom_sexo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_sexo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `sexo` */

insert  into `sexo`(`id_sexo`,`nom_sexo`) values (1,'FEMENINO'),(2,'MASCULINO');

/*Table structure for table `tipo_conexion` */

DROP TABLE IF EXISTS `tipo_conexion`;

CREATE TABLE `tipo_conexion` (
  `id_tipoconex` bigint(20) NOT NULL AUTO_INCREMENT,
  `nom_tipoconex` varchar(50) DEFAULT NULL,
  `estado_tipoconex` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id_tipoconex`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `tipo_conexion` */

insert  into `tipo_conexion`(`id_tipoconex`,`nom_tipoconex`,`estado_tipoconex`) values (1,'INALÁMBRICA','1'),(2,'CABLEADA','2');

/*Table structure for table `tipo_persona` */

DROP TABLE IF EXISTS `tipo_persona`;

CREATE TABLE `tipo_persona` (
  `id_tipoper` bigint(20) NOT NULL AUTO_INCREMENT,
  `nom_tipoper` varchar(100) DEFAULT NULL,
  `estado_tipoper` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id_tipoper`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tipo_persona` */

insert  into `tipo_persona`(`id_tipoper`,`nom_tipoper`,`estado_tipoper`) values (1,'TRABAJADOR','1'),(2,'CLIENTE','1'),(3,'PROVEEDOR','1');

/*Table structure for table `tipoiva` */

DROP TABLE IF EXISTS `tipoiva`;

CREATE TABLE `tipoiva` (
  `id_tipoiva` tinyint(1) unsigned NOT NULL AUTO_INCREMENT,
  `nom_tipoiva` varchar(32) NOT NULL DEFAULT '',
  `porcentaje_iva` double(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id_tipoiva`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `tipoiva` */

insert  into `tipoiva`(`id_tipoiva`,`nom_tipoiva`,`porcentaje_iva`) values (1,'Iva 21%',21.00),(2,'Iva 10,5%',10.50);

/*Table structure for table `tiporetencion` */

DROP TABLE IF EXISTS `tiporetencion`;

CREATE TABLE `tiporetencion` (
  `id_tiporeten` bigint(20) NOT NULL AUTO_INCREMENT,
  `cod_codRetAir` varchar(6) DEFAULT NULL COMMENT '340 Otras Retenciones Aplicables el 1%',
  `nom_codRetAir` text,
  `porcentaje_codRetAir` double(10,2) DEFAULT NULL COMMENT 'solo dos decimales',
  PRIMARY KEY (`id_tiporeten`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tiporetencion` */

insert  into `tiporetencion`(`id_tiporeten`,`cod_codRetAir`,`nom_codRetAir`,`porcentaje_codRetAir`) values (1,'0','NINGUNA',0.00);

/*Table structure for table `unidad_medida` */

DROP TABLE IF EXISTS `unidad_medida`;

CREATE TABLE `unidad_medida` (
  `id_unimedida` bigint(20) NOT NULL AUTO_INCREMENT,
  `nom_unimedida` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_unimedida`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `unidad_medida` */

insert  into `unidad_medida`(`id_unimedida`,`nom_unimedida`) values (1,'UNIDAD(S)'),(2,'KILO(S)'),(3,'NADA');

/*Table structure for table `vehiculo` */

DROP TABLE IF EXISTS `vehiculo`;

CREATE TABLE `vehiculo` (
  `id_vehiculo` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `marca` varchar(20) DEFAULT '',
  `modelo` varchar(20) DEFAULT '',
  `anio` int(10) unsigned DEFAULT NULL,
  `dominio` varchar(7) NOT NULL,
  `observacion` text,
  PRIMARY KEY (`id_vehiculo`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `vehiculo` */

insert  into `vehiculo`(`id_vehiculo`,`marca`,`modelo`,`anio`,`dominio`,`observacion`) values (1,'RENAULT','TWINGO',1998,'DAS930','TOCADITO'),(3,'PEUGEOT','',0,'HMI098','SIN OBS'),(7,'RENAULT','TWINGO',1998,'DAS930','jadsjlasjdlajdslasjdlaksdj');

/*Table structure for table `vehiculo_cliente` */

DROP TABLE IF EXISTS `vehiculo_cliente`;

CREATE TABLE `vehiculo_cliente` (
  `id_vehi_cli` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_vehiculo` bigint(20) DEFAULT NULL,
  `id_cliente` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id_vehi_cli`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `vehiculo_cliente` */

insert  into `vehiculo_cliente`(`id_vehi_cli`,`id_vehiculo`,`id_cliente`) values (1,1,18),(2,1,19),(5,7,25),(6,7,18),(7,7,19),(8,3,19);

/* Procedure structure for procedure `sp_acceso_moduloinsert` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_acceso_moduloinsert` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_acceso_moduloinsert`(IN tid_persona bigint(20),tid_modulo bigint(20))
BEGIN 
INSERT INTO acceso_modulo(
id_persona,
id_modulo)VALUES(
tid_persona,
tid_modulo);
SELECT LAST_INSERT_ID();
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_acceso_moduloupdate` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_acceso_moduloupdate` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_acceso_moduloupdate`(IN tid_acsmod bigint(20),tid_persona bigint(20),tid_modulo bigint(20))
BEGIN
UPDATE acceso_modulo SET 
id_persona=tid_persona,
id_modulo=tid_modulo
WHERE id_acsmod=tid_acsmod;
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_cliente_pagoinsert` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_cliente_pagoinsert` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_cliente_pagoinsert`(IN tid_persona bigint(20),tid_factura bigint(20),tcanti_pago decimal(10,2),tfecha_pago varchar(20),testado_pago varchar(2))
BEGIN
DECLARE cont INT;
DECLARE dia INT;
declare fec varchar(20);
DECLARE fec2 VARCHAR(20);
SET dia=(SELECT DAY(tfecha_pago) AS dia_x);
SET cont=(SELECT (COUNT(id_Fact)+1) AS total FROM factura WHERE id_cliente=tid_persona);
IF (cont=2) THEN
	
  if((dia>=25)&&(dia<=30)) then
     SET fec=(SELECT CONCAT(YEAR(tfecha_pago),'-',(MONTH(tfecha_pago)+1),'-',DAY(tfecha_pago)));
     SET fec2=(SELECT CONCAT(YEAR(tfecha_pago),'-',(MONTH(tfecha_pago)+2),'-',DAY(tfecha_pago)));
     INSERT INTO cliente_pago(id_persona,id_factura,canti_pago,fecha_pago,estado_pago)VALUES(tid_persona,tid_factura,tcanti_pago,fec,'1');
     UPDATE factura SET fecemi_fact = fec  WHERE id_fact =tid_factura  ;
     INSERT INTO cliente_pago(id_persona,id_factura,canti_pago,fecha_pago,estado_pago)VALUES(tid_persona,0,0,fec2,'0');
  elseif ((dia>=1)&&(dia<=5)) then
     SET fec=(SELECT CONCAT(YEAR(tfecha_pago),'-',(MONTH(tfecha_pago)+1),'-',DAY(tfecha_pago)));
     INSERT INTO cliente_pago(id_persona,id_factura,canti_pago,fecha_pago,estado_pago)VALUES(tid_persona,tid_factura,tcanti_pago,tfecha_pago,'1');
     INSERT INTO cliente_pago(id_persona,id_factura,canti_pago,fecha_pago,estado_pago)VALUES(tid_persona,0,0,fec,'0');
  else
     INSERT INTO cliente_pago(id_persona,id_factura,canti_pago,fecha_pago,estado_pago)VALUES(tid_persona,tid_factura,tcanti_pago,tfecha_pago,'1');
  end if;   
ELSE
INSERT INTO cliente_pago(id_persona,id_factura,canti_pago,fecha_pago,estado_pago)VALUES(tid_persona,tid_factura,tcanti_pago,tfecha_pago,testado_pago);
set fec=(SELECT CONCAT(YEAR(tfecha_pago),'-',(MONTH(tfecha_pago)+1),'-',DAY(tfecha_pago)));
INSERT INTO cliente_pago(id_persona,id_factura,canti_pago,fecha_pago,estado_pago)VALUES(tid_persona,0,0,fec,'0');
END IF;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_cliente_pagoupdate` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_cliente_pagoupdate` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_cliente_pagoupdate`(IN tid_pago bigint(20),tid_persona bigint(20),tcanti_pago decimal(10,2),tfecha_pago date,testado_pago varchar(2))
BEGIN
UPDATE cliente_pago SET 
id_persona=tid_persona,
canti_pago=tcanti_pago,
fecha_pago=tfecha_pago,
estado_pago=testado_pago
WHERE id_pago=tid_pago;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_comprainsert` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_comprainsert` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_comprainsert`(IN tid_provd bigint(20),tguiacod_compra varchar(20),
ttotal_compra double(10,2),tobs_compra varchar(200),tbaseGrava_compra double(10,2),tfec_compra varchar(20),testado_compra varchar(2))
BEGIN 
INSERT INTO compra(
id_provd,
guiacod_compra,
total_compra,
obs_compra,
baseGrava_compra,
fec_compra,
estado_compra)VALUES(
tid_provd,
tguiacod_compra,
ttotal_compra,
tobs_compra,
tbaseGrava_compra,
tfec_compra,
testado_compra);
SELECT LAST_INSERT_ID();
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_compraupdate` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_compraupdate` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_compraupdate`(IN tid_compra bigint(20),tid_provd bigint(20),tguiacod_compra varchar(20),
    ttotal_compra double(10,2),tobs_compra varchar(200),tbaseGrava_compra double(10,2),tfec_compra varchar(20),testado_compra varchar(2))
BEGIN
    
UPDATE compra SET 
id_provd=tid_provd,
guiacod_compra=tguiacod_compra,
total_compra=ttotal_compra,
obs_compra=tobs_compra,
baseGrava_compra=tbaseGrava_compra,
fec_compra=tfec_compra
WHERE id_compra=tid_compra;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_detalle_clienteinsert` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_detalle_clienteinsert` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_detalle_clienteinsert`(IN tid_cliente bigint(20),tid_trabajador bigint(20),tid_tipoconex bigint(20),tip_detcliente varchar(25),thora_detcliente varchar(15),tfecha_detcliente varchar(15),testado_conex varchar(2))
BEGIN
INSERT INTO detalle_cliente(
id_cliente,
id_trabajador,
id_tipoconex,
ip_detcliente,
hora_detcliente,
fecha_detcliente,
estado_conex)VALUES(
tid_cliente,
tid_trabajador,
tid_tipoconex,
tip_detcliente,
thora_detcliente,
tfecha_detcliente,
testado_conex);
SELECT LAST_INSERT_ID();
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_detalle_clienteupdate` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_detalle_clienteupdate` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_detalle_clienteupdate`(IN tid_detcliente bigint(20),tid_cliente bigint(20),tid_trabajador bigint(20),tid_tipoconex bigint(20),tip_detcliente varchar(25),thora_detcliente varchar(15),tfecha_detcliente varchar(15),testado_conex varchar(2))
BEGIN
UPDATE detalle_cliente SET 
id_cliente=tid_cliente,
id_trabajador=tid_trabajador,
id_tipoconex=tid_tipoconex,
ip_detcliente=tip_detcliente,
hora_detcliente=thora_detcliente,
fecha_detcliente=tfecha_detcliente,
estado_conex=testado_conex
WHERE id_detcliente=tid_detcliente;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_detalle_comprainsert` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_detalle_comprainsert` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_detalle_comprainsert`(IN tid_compra bigint(20),tid_producto bigint(20),tcostouni_detcompra double(10,2),tcanti_detcompra int(11),testado_detcompra varchar(2))
BEGIN
declare tmp_canti int;   
DECLARE tmp_costo double(10,2);     
DECLARE tmp_resultado double(10,2);  
DECLARE tmp_ganancia double(10,2);  
    
set tmp_canti=(select stock_producto from producto where id_producto=tid_producto);
set tmp_costo=(SELECT costo_producto FROM producto WHERE id_producto=tid_producto);   
SET tmp_ganancia=(SELECT porctj_ganancia FROM v_producto WHERE id_producto=tid_producto);
SET tmp_costo=(tmp_costo*tmp_canti+tcostouni_detcompra*tcanti_detcompra);
set tmp_canti=(tmp_canti+tcanti_detcompra);
SET tmp_resultado=(tmp_costo/tmp_canti);
set tmp_ganancia=(tmp_resultado+(tmp_ganancia*tmp_resultado)/100);
update producto  set stock_producto=stock_producto+tcanti_detcompra, costo_producto=tmp_resultado, pvp1_producto=tmp_ganancia where id_producto=tid_producto;
   
INSERT INTO detalle_compra(
id_compra,
id_producto,
costouni_detcompra,
canti_detcompra,
estado_detcompra)VALUES(
tid_compra,
tid_producto,
tcostouni_detcompra,
tcanti_detcompra,
testado_detcompra);
SELECT LAST_INSERT_ID(); 
 
   
   END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_detalle_compraupdate` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_detalle_compraupdate` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_detalle_compraupdate`(IN tid_detcompra bigint(20),tid_compra bigint(20),tid_producto bigint(20),tcostouni_detcompra double(10,2),tcanti_detcompra int(11),testado_detcompra varchar(2))
BEGIN
UPDATE detalle_compra SET 
id_compra=tid_compra,
id_producto=tid_producto,
costouni_detcompra=tcostouni_detcompra,
canti_detcompra=tcanti_detcompra,
estado_detcompra=testado_detcompra
WHERE id_detcompra=tid_detcompra;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_detalle_devolucioninsert` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_detalle_devolucioninsert` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_detalle_devolucioninsert`(IN tid_devo bigint(20),tid_producto bigint(20),
    tcanti_detdevo int(11),tprecio_detdevo double(10,2),testado_detdevo varchar(2))
BEGIN
UPDATE producto  SET stock_producto=stock_producto+tcanti_detdevo WHERE id_producto=tid_producto;
INSERT INTO detalle_devolucion(
id_devo,
id_producto,
canti_detdevo,
precio_detdevo,
estado_detdevo)VALUES(
tid_devo,
tid_producto,
tcanti_detdevo,
tprecio_detdevo,
testado_detdevo);
SELECT LAST_INSERT_ID();
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_detalle_devolucioninsert2` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_detalle_devolucioninsert2` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_detalle_devolucioninsert2`(IN tid_devo BIGINT(20),tid_producto BIGINT(20),
    tcanti_detdevo INT(11),tprecio_detdevo DOUBLE(10,2),testado_detdevo VARCHAR(2))
BEGIN
UPDATE producto  SET stock_producto=stock_producto-tcanti_detdevo WHERE id_producto=tid_producto;
INSERT INTO detalle_devolucion(
id_devo,
id_producto,
canti_detdevo,
precio_detdevo,
estado_detdevo)VALUES(
tid_devo,
tid_producto,
tcanti_detdevo,
tprecio_detdevo,
testado_detdevo);
SELECT LAST_INSERT_ID();
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_detalle_facturainsert` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_detalle_facturainsert` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_detalle_facturainsert`(IN tid_fact bigint(20),tid_producto bigint(20),tcanti_detfact double(10,2),tprecio_detfact double(10,2),testado_detfact varchar(2))
BEGIN
UPDATE producto  SET stock_producto=stock_producto-tcanti_detfact 
WHERE id_producto=tid_producto;
INSERT INTO detalle_factura(
id_fact,
id_producto,
canti_detfact,
precio_detfact,
estado_detfact)VALUES(
tid_fact,
tid_producto,
tcanti_detfact,
tprecio_detfact,
testado_detfact);
SELECT LAST_INSERT_ID();
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_detalle_gastosinsert` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_detalle_gastosinsert` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_detalle_gastosinsert`(IN tid_gasto bigint(20),tnombre_produc varchar(30),tcostouni_detgasto double(10,2),tcanti_detgasto int(11),testado_detgasto varchar(2))
BEGIN 
INSERT INTO detalle_gastos(
id_gasto,
nombre_produc,
costouni_detgasto,
canti_detgasto,
estado_detgasto)VALUES(
tid_gasto,
tnombre_produc,
tcostouni_detgasto,
tcanti_detgasto,
testado_detgasto);
SELECT LAST_INSERT_ID();
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_detalle_gastosupdate` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_detalle_gastosupdate` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_detalle_gastosupdate`(IN tid_detgasto bigint(20),tid_gasto bigint(20),tnombre_produc varchar(30),tcostouni_detgasto double(10,2),tcanti_detgasto int(11),testado_detgasto varchar(2))
BEGIN
UPDATE detalle_gastos SET 
id_gasto=tid_gasto,
nombre_produc=tnombre_produc,
costouni_detgasto=tcostouni_detgasto,
canti_detgasto=tcanti_detgasto,
estado_detgasto=testado_detgasto
WHERE id_detgasto=tid_detgasto;
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_detalle_kardexinsert` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_detalle_kardexinsert` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_detalle_kardexinsert`(IN tid_kardex bigint(20),tid_producto bigint(20),tcosto_detkardex double(10,2),tcanti_detkardex int(11))
BEGIN
INSERT INTO detalle_kardex(
id_kardex,
id_producto,
costo_detkardex,
canti_detkardex)VALUES(
tid_kardex,
tid_producto,
tcosto_detkardex,
tcanti_detkardex);
SELECT LAST_INSERT_ID();
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_detalle_proveedorinsert` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_detalle_proveedorinsert` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_detalle_proveedorinsert`(IN tid_proveedor bigint(20),tip1_detprovdr varchar(25),tip2_detprovdr varchar(25),tip3_detprovdr varchar(25),tmas1_detprovdr varchar(25),tmas2_detprovdr varchar(25),tmas3_detprovdr varchar(25),tobs_detprovdr varchar(200))
BEGIN
INSERT INTO detalle_proveedor(
id_proveedor,
ip1_detprovdr,
ip2_detprovdr,
ip3_detprovdr,
mas1_detprovdr,
mas2_detprovdr,
mas3_detprovdr,
obs_detprovdr)VALUES(
tid_proveedor,
tip1_detprovdr,
tip2_detprovdr,
tip3_detprovdr,
tmas1_detprovdr,
tmas2_detprovdr,
tmas3_detprovdr,
tobs_detprovdr);
SELECT LAST_INSERT_ID();
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_detalle_proveedorupdate` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_detalle_proveedorupdate` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_detalle_proveedorupdate`(IN tid_detprovdr bigint(20),tid_proveedor bigint(20),tip1_detprovdr varchar(25),tip2_detprovdr varchar(25),tip3_detprovdr varchar(25),tmas1_detprovdr varchar(25),tmas2_detprovdr varchar(25),tmas3_detprovdr varchar(25),tobs_detprovdr varchar(200))
BEGIN
UPDATE detalle_proveedor SET 
id_proveedor=tid_proveedor,
ip1_detprovdr=tip1_detprovdr,
ip2_detprovdr=tip2_detprovdr,
ip3_detprovdr=tip3_detprovdr,
mas1_detprovdr=tmas1_detprovdr,
mas2_detprovdr=tmas2_detprovdr,
mas3_detprovdr=tmas3_detprovdr,
obs_detprovdr=tobs_detprovdr
WHERE id_detprovdr=tid_detprovdr;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_detalle_remitoinsert` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_detalle_remitoinsert` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_detalle_remitoinsert`(IN tid_remi BIGINT(20),tid_producto BIGINT(20),tcanti_detremi DOUBLE(10,2),tprecio_detremi DOUBLE(10,2),testado_detremi VARCHAR(2))
BEGIN
UPDATE producto  SET stock_producto=stock_producto-tcanti_detremi 
WHERE id_producto=tid_producto;
INSERT INTO detalle_remito(
id_remito,
id_producto,
canti_detremi,
precio_detremi,
estado_detremi)VALUES(
tid_remi,
tid_producto,
tcanti_detremi,
tprecio_detremi,
testado_detremi);
SELECT LAST_INSERT_ID();
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_devolucioninsert` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_devolucioninsert` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_devolucioninsert`(IN tid_factcmp_devo bigint(20),ttipo_cmpbt_devo int(11),tdescto_devo double(10,2),
    tiva12_devo double(10,2),ttotal_devo double(10,2),tobs_devo varchar(200),tfecha_devo varchar(20),testado_devo varchar(2))
BEGIN
INSERT INTO devolucion(
id_factcmp_devo,
tipo_cmpbt_devo,
descto_devo,
iva12_devo,
total_devo,
obs_devo,
fecha_devo,
estado_devo)VALUES(
tid_factcmp_devo,
ttipo_cmpbt_devo,
tdescto_devo,
tiva12_devo,
ttotal_devo,
tobs_devo,
date(now()),
testado_devo);
SELECT LAST_INSERT_ID();
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_empresaupdate` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_empresaupdate` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_empresaupdate`(IN tid_empresa bigint(20),tid_contador bigint(20),tid_representante bigint(20),
    tid_ciudad bigint(20),trazsocial_empresa varchar(100),truc_empresa varchar(15)
    ,tdirec_empresa varchar(200),ttelf_empresa varchar(12),tcel_empresa varchar(10),tweb_empresa varchar(50)
    ,tcorreo_empresa varchar(50),tfecha_empresa varchar(20))
BEGIN
UPDATE empresa SET 
id_contador=tid_contador,
id_representante=tid_representante,
id_ciudad=tid_ciudad,
razsocial_empresa=trazsocial_empresa,
ruc_empresa=truc_empresa,
direc_empresa=tdirec_empresa,
telf_empresa=ttelf_empresa,
cel_empresa=tcel_empresa,
web_empresa=tweb_empresa,
correo_empresa=tcorreo_empresa
WHERE id_empresa=tid_empresa;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_facturainsert` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_facturainsert` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_facturainsert`(IN tid_empresa bigint(20),tid_cliente bigint(20),
tid_vendedor bigint(20),tdescto_fact double(10,2),tobs_fact varchar(200),tiva21_fact double(10,2),tiva105_fact double(10,2),
tnum_fact bigint(20), ttipo_fact char(1), ttotal_fact double(10,2),tfecemi_fact varchar(20),testado_fact varchar(2))
BEGIN
INSERT INTO factura(
id_empresa,
id_cliente,
id_vendedor,
descto_fact,
obs_fact,
iva21_fact,
iva105_fact,
num_fact,
tipo_fact,
total_fact,
fecemi_fact,
estado_fact)VALUES(
tid_empresa,
tid_cliente,
tid_vendedor,
tdescto_fact,
tobs_fact,
tiva21_fact,
tiva105_fact,
tnum_fact,
ttipo_fact,
ttotal_fact,
date(now()),
testado_fact);
SELECT LAST_INSERT_ID();
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_facturaupdate` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_facturaupdate` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_facturaupdate`(IN tid_fact bigint(20),tid_empresa bigint(20),tid_cliente bigint(20),tid_vendedor bigint(20),tdescto_fact double(10,2),tobs_fact varchar(200),tfecemi_fact varchar(20),testado_fact varchar(2))
BEGIN
UPDATE factura SET 
id_empresa=tid_empresa,
id_cliente=tid_cliente,
id_vendedor=tid_vendedor,
descto_fact=tdescto_fact,
obs_fact=tobs_fact,
fecemi_fact=tfecemi_fact,
estado_fact=testado_fact
WHERE id_fact=tid_fact;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_gananciainsert` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_gananciainsert` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_gananciainsert`(IN tporctj_ganancia double(10,2),tdescrip_ganancia varchar(100))
BEGIN 
INSERT INTO ganancia(
porctj_ganancia,
descrip_ganancia)VALUES(
tporctj_ganancia,
tdescrip_ganancia);
SELECT LAST_INSERT_ID();
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_gananciaupdate` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_gananciaupdate` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_gananciaupdate`(IN tid_ganancia bigint(20),tporctj_ganancia double(10,2),tdescrip_ganancia varchar(100))
BEGIN
UPDATE ganancia SET 
porctj_ganancia=tporctj_ganancia,
descrip_ganancia=tdescrip_ganancia
WHERE id_ganancia=tid_ganancia;
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_gastosinsert` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_gastosinsert` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_gastosinsert`(IN tdescrip_gast varchar(300),tcant_gast double(10,2),tfecha_gast varchar(10),tid_factura varchar(20),tnom_empresa_gast varchar(50),tnom_comp_gast varchar(30),tiva_gast double(10,2))
Begin
INSERT INTO gastos(
descrip_gast,
cant_gast,
fecha_gast,
id_factura,
nom_empresa_gast,
nom_comp_gast,
iva_gast)VALUES(
tdescrip_gast,
tcant_gast,
tfecha_gast,
tid_factura,
tnom_empresa_gast,
tnom_comp_gast,
tiva_gast);
SELECT LAST_INSERT_ID();
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_gastosupdate` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_gastosupdate` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_gastosupdate`(IN tid_gasto bigint(20),tdescrip_gast varchar(300),tcant_gast double(10,2),tfecha_gast VARCHAR(10),tid_factura bigint(20),tnom_empresa_gast varchar(50),tnom_comp_gast varchar(30),tiva_gast double(10,2))
BEGIN
UPDATE gastos SET 
descrip_gast=tdescrip_gast,
cant_gast=tcant_gast,
fecha_gast=tfecha_gast,
id_factura=tid_factura,
nom_empresa_gast=tnom_empresa_gast,
nom_comp_gast=tnom_comp_gast,
iva_gast=tiva_gast
WHERE id_gasto=tid_gasto;
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_kardexinsert` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_kardexinsert` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_kardexinsert`(IN tid_factcmp_kardex bigint(20),ttipo_entrdsald_kardex varchar(2),ttipo_cmpbt_kardex varchar(2),tcod_factcmp_kardex varchar(100),tfecha_kardex varchar(20),testado_kardex varchar(2))
BEGIN
INSERT INTO kardex(
id_factcmp_kardex,
tipo_entrdsald_kardex,
tipo_cmpbt_kardex,
cod_factcmp_kardex,
fecha_kardex,
estado_kardex)VALUES(
tid_factcmp_kardex,
ttipo_entrdsald_kardex,
ttipo_cmpbt_kardex,
tcod_factcmp_kardex,
date(now()),
testado_kardex);
SELECT LAST_INSERT_ID();
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_kardexupdate` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_kardexupdate` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_kardexupdate`(IN tid_kardex bigint(20),tid_factcmp_kardex bigint(20),ttipo_entrdsald_kardex varchar(2),ttipo_cmpbt_kardex varchar(2),tcod_factcmp_kardex varchar(100),tfecha_kardex varchar(20),testado_kardex varchar(2))
BEGIN
UPDATE kardex SET 
cod_factcmp_kardex=tcod_factcmp_kardex
WHERE id_kardex=tid_kardex;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_marca_productoinsert` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_marca_productoinsert` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_marca_productoinsert`(IN tnom_marca varchar(49))
BEGIN 
INSERT INTO marca_producto(
nom_marca)VALUES(
tnom_marca);
SELECT LAST_INSERT_ID();
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_marca_productoupdate` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_marca_productoupdate` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_marca_productoupdate`(IN tid_marca bigint(20),tnom_marca varchar(50))
BEGIN
UPDATE marca_producto SET 
nom_marca=tnom_marca
WHERE id_marca=tid_marca;
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_personainsert` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_personainsert` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_personainsert`(IN tid_tipoper bigint(20),tid_ciudad bigint(20),tid_sexo bigint(20),tid_civil bigint(20),tnom_persona varchar(50),tape_persona varchar(50),truc_persona varchar(20),tdirec_persona varchar(200),ttelf_persona varchar(10),tcel_persona varchar(10),temail_persona varchar(40),tweb_persona varchar(40),tobs_persona varchar(200),tfec_persona varchar(20),testado_persona varchar(2),tclave_persona varchar(12))
BEGIN 
INSERT INTO persona(
id_tipoper,
id_ciudad,
id_sexo,
id_civil,
nom_persona,
ape_persona,
ruc_persona,
direc_persona,
telf_persona,
cel_persona,
email_persona,
web_persona,
obs_persona,
fec_persona,
estado_persona,
clave_persona)VALUES(
tid_tipoper,
tid_ciudad,
tid_sexo,
tid_civil,
tnom_persona,
tape_persona,
truc_persona,
tdirec_persona,
ttelf_persona,
tcel_persona,
temail_persona,
tweb_persona,
tobs_persona,
date(now()),
testado_persona,
tclave_persona);
SELECT LAST_INSERT_ID();
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_personaupdate` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_personaupdate` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_personaupdate`(IN tid_persona bigint(20),tid_tipoper bigint(20),tid_ciudad bigint(20),tid_sexo bigint(20),tid_civil bigint(20),tnom_persona varchar(50),tape_persona varchar(50),truc_persona varchar(20),tdirec_persona varchar(200),ttelf_persona varchar(10),tcel_persona varchar(10),temail_persona varchar(40),tweb_persona varchar(40),tobs_persona varchar(200),tfec_persona varchar(20),testado_persona varchar(2),tclave_persona varchar(12))
BEGIN
UPDATE persona SET 
id_tipoper=tid_tipoper,
id_ciudad=tid_ciudad,
id_sexo=tid_sexo,
id_civil=tid_civil,
nom_persona=tnom_persona,
ape_persona=tape_persona,
ruc_persona=truc_persona,
direc_persona=tdirec_persona,
telf_persona=ttelf_persona,
cel_persona=tcel_persona,
email_persona=temail_persona,
web_persona=tweb_persona,
obs_persona=tobs_persona,
clave_persona=tclave_persona
WHERE id_persona=tid_persona;
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_productoinsert` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_productoinsert` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_productoinsert`(IN tid_tiporeten bigint(20), tid_tipoiva tinyint(1) ,tid_marca bigint(20),tid_unimedida bigint(20),
tid_ganancia bigint(20),tcodbarra_producto varchar(100),tnom_producto varchar(100),
tdescrip_producto varchar(200),tcosto_producto double(10,2),tpvp1_producto double(10,2),
tstock_producto int(11),tstkmin_producto int(11),tstkmax_producto int(11),timg_producto varchar(100),tfecing_producto varchar(20),
tfecvenci_producto varchar(20), tposicion_producto varchar(32),testado_producto varchar(2))
BEGIN 
INSERT INTO producto(
id_tiporeten,
id_tipoiva,
id_marca,
id_unimedida,
id_ganancia,
codbarra_producto,
nom_producto,
descrip_producto,
costo_producto,
pvp1_producto,
stock_producto,
stkmin_producto,
stkmax_producto,
img_producto,
fecing_producto,
fecvenci_producto,
posicion_producto,
estado_producto)VALUES(
tid_tiporeten,
tid_tipoiva,
tid_marca,
tid_unimedida,
tid_ganancia,
tcodbarra_producto,
tnom_producto,
tdescrip_producto,
tcosto_producto,
tpvp1_producto,
tstock_producto,
tstkmin_producto,
tstkmax_producto,
timg_producto,
tfecing_producto,
tfecvenci_producto,
tposicion_producto,
testado_producto);
SELECT LAST_INSERT_ID();
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_productoupdate` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_productoupdate` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_productoupdate`(IN tid_producto bigint(20),tid_tiporeten bigint(20), tid_tipoiva tinyint(1), tid_marca bigint(20),tid_unimedida bigint(20),tid_ganancia bigint(20),tcodbarra_producto varchar(100), tnom_producto varchar(100),tdescrip_producto varchar(200),tcosto_producto double(10,2),tpvp1_producto double(10,2), tstock_producto int(11),tstkmin_producto int(11),tstkmax_producto int(11),timg_producto varchar(100), tfecing_producto varchar(20),tfecvenci_producto varchar(20), tposicion_producto varchar(32),testado_producto varchar(2))
BEGIN UPDATE producto SET  id_tiporeten=tid_tiporeten, id_tipoiva=tid_tipoiva, id_marca=tid_marca, id_unimedida=tid_unimedida, id_ganancia=tid_ganancia, codbarra_producto=tcodbarra_producto, nom_producto=tnom_producto, descrip_producto=tdescrip_producto, costo_producto=tcosto_producto, pvp1_producto=tpvp1_producto, stkmin_producto=tstkmin_producto, stkmax_producto=tstkmax_producto, img_producto=timg_producto, fecing_producto=tfecing_producto, fecvenci_producto=tfecvenci_producto, posicion_producto= tposicion_producto WHERE id_producto=tid_producto; END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_producto_proveedorinsert` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_producto_proveedorinsert` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_producto_proveedorinsert`(IN tid_producto bigint(20),tid_proveedor bigint(20))
BEGIN 
INSERT INTO producto_proveedor(
id_producto,
id_proveedor)VALUES(
tid_producto,
tid_proveedor);
SELECT LAST_INSERT_ID();
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_producto_proveedorupdate` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_producto_proveedorupdate` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_producto_proveedorupdate`(IN tid_prod_provd bigint(20),tid_producto bigint(20),tid_proveedor bigint(20))
BEGIN
UPDATE producto_proveedor SET 
id_producto=tid_producto,
id_proveedor=tid_proveedor
WHERE id_prod_provd=tid_prod_provd;
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_remitoinsert` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_remitoinsert` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_remitoinsert`(IN 
	tid_orden bigint(20),
	tid_vehiculo BIGINT(20),
	tid_vendedor bigint(20),
	tid_cliente bigint(20),
	tobs_remi text,
	tnum_remi bigint(20), 
	ttotal_remi double(10,2),
	tfecemi_remi varchar(20),
	testado_remi varchar(2))
BEGIN
INSERT INTO remito(
id_orden,
id_vehiculo,
id_vendedor,
id_cliente,
obs_remi,
num_remi,
total_remi,
fecemi_remi,
estado_remi)VALUES(
tid_orden,
tid_vehiculo,
tid_vendedor,
tid_cliente,
tobs_remi,
tnum_remi,
ttotal_remi,
date(now()),
testado_remi);
SELECT LAST_INSERT_ID();
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_tester` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_tester` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_tester`(IN fecha varchar(20),id_cli bigint(20))
BEGIN
declare dia int;
declare cont int;
set cont=(SELECT (COUNT(id_Fact)+1) AS total FROM factura WHERE id_cliente=id_cli);
if (cont=1) then
	set dia=(SELECT DAY(fecha) AS dia_x);
	if((dia>=25)&&(dia<=5)) then
	select "dentro del rango paga solo dos meses" as msg;
	else
	select "paga solo tres meses" as msg;
	end if;
else
select "pago normal ",DATE(fecha) AS actual,date(DATE(fecha)+1) AS val;
 
end if;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_tipoivainsert` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_tipoivainsert` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_tipoivainsert`(IN tnom_tipoiva varchar(32) , tporcentaje_iva double(10,2))
BEGIN 
INSERT INTO tipoiva(
nom_tipoiva,
porcentaje_iva)VALUES(
tnom_tipoiva,
tporcentaje_iva);
SELECT LAST_INSERT_ID();
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_tipoivaupdate` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_tipoivaupdate` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_tipoivaupdate`(IN tid_tipoiva tinyint(2),tnom_tipoiva varchar(32),tporcentaje_iva double(10,2))
BEGIN
UPDATE tipoiva SET 
nom_tipoiva=tnom_tipoiva,
porcentaje_iva=tporcentaje_iva
WHERE id_tipoiva=tid_tipoiva;
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_tiporetencioninsert` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_tiporetencioninsert` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_tiporetencioninsert`(IN tcod_codRetAir varchar(6),tnom_codRetAir text,tporcentaje_codRetAir double(10,2))
BEGIN 
INSERT INTO tiporetencion(
cod_codRetAir,
nom_codRetAir,
porcentaje_codRetAir)VALUES(
tcod_codRetAir,
tnom_codRetAir,
tporcentaje_codRetAir);
SELECT LAST_INSERT_ID();
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_tiporetencionupdate` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_tiporetencionupdate` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_tiporetencionupdate`(IN tid_tiporeten bigint(20),tcod_codRetAir varchar(6),tnom_codRetAir text,tporcentaje_codRetAir double(10,2))
BEGIN
UPDATE tiporetencion SET 
cod_codRetAir=tcod_codRetAir,
nom_codRetAir=tnom_codRetAir,
porcentaje_codRetAir=tporcentaje_codRetAir
WHERE id_tiporeten=tid_tiporeten;
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_unidad_medidainsert` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_unidad_medidainsert` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_unidad_medidainsert`(IN tnom_unimedida varchar(50))
BEGIN 
INSERT INTO unidad_medida(
nom_unimedida)VALUES(
tnom_unimedida);
SELECT LAST_INSERT_ID();
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_unidad_medidaupdate` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_unidad_medidaupdate` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_unidad_medidaupdate`(IN tid_unimedida bigint(20),tnom_unimedida varchar(50))
BEGIN
UPDATE unidad_medida SET 
nom_unimedida=tnom_unimedida
WHERE id_unimedida=tid_unimedida;
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_vehiculoinsert` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_vehiculoinsert` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_vehiculoinsert`(IN tmarca varchar(20), tmodelo varchar(20), tanio int(10), tdominio varchar(7), tobservacion text)
BEGIN
INSERT INTO vehiculo(
marca,
modelo,
anio,
dominio,
observacion)VALUES(
tmarca,
tmodelo,
tanio,
tdominio,
tobservacion);
SELECT LAST_INSERT_ID();
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_vehiculoupdate` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_vehiculoupdate` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_vehiculoupdate`(IN tid_vehiculo bigint(20), tmarca varchar(20), tmodelo varchar(20), tanio int(10), tdominio varchar(7), tobservacion text)
BEGIN UPDATE vehiculo SET marca = tmarca, modelo = tmodelo, anio = tanio, dominio = tdominio, observacion = tobservacion WHERE id_vehiculo = tid_vehiculo; END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_vehiculo_clienteinsert` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_vehiculo_clienteinsert` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_vehiculo_clienteinsert`(IN tid_vehiculo BIGINT(20),tid_cliente BIGINT(20))
BEGIN 
INSERT INTO vehiculo_cliente(
id_vehiculo,
id_cliente)VALUES(
tid_vehiculo,
tid_cliente);
SELECT LAST_INSERT_ID();
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_vehiculo_clienteupdate` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_vehiculo_clienteupdate` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_vehiculo_clienteupdate`(IN tid_vehi_cli BIGINT(20),tid_vehiculo BIGINT(20),tid_cliente BIGINT(20))
BEGIN
UPDATE vehiculo_cliente SET 
id_vehiculo=tid_vehiculo,
id_cliente=tid_cliente
WHERE id_vehi_cli=tid_vehi_cli;
END */$$
DELIMITER ;

/*Table structure for table `v_acceso_modulo` */

DROP TABLE IF EXISTS `v_acceso_modulo`;

/*!50001 DROP VIEW IF EXISTS `v_acceso_modulo` */;
/*!50001 DROP TABLE IF EXISTS `v_acceso_modulo` */;

/*!50001 CREATE TABLE  `v_acceso_modulo`(
 `id_persona` bigint(20) ,
 `id_modulo` bigint(20) ,
 `id_padre` bigint(20) ,
 `estado_persona` varchar(2) ,
 `nom_modulo` varchar(50) ,
 `img_modulo` varchar(50) ,
 `url_modulo` varchar(50) 
)*/;

/*Table structure for table `v_cliente_pago` */

DROP TABLE IF EXISTS `v_cliente_pago`;

/*!50001 DROP VIEW IF EXISTS `v_cliente_pago` */;
/*!50001 DROP TABLE IF EXISTS `v_cliente_pago` */;

/*!50001 CREATE TABLE  `v_cliente_pago`(
 `id_persona` bigint(20) ,
 `nom_persona` varchar(50) ,
 `ape_persona` varchar(50) ,
 `ruc_persona` varchar(20) ,
 `direc_persona` text ,
 `telf_persona` varchar(10) ,
 `cel_persona` varchar(10) ,
 `email_persona` varchar(40) ,
 `canti_pago` decimal(10,2) ,
 `fecha_pago` date ,
 `estado_pago` varchar(2) 
)*/;

/*Table structure for table `v_cliente_pendiente` */

DROP TABLE IF EXISTS `v_cliente_pendiente`;

/*!50001 DROP VIEW IF EXISTS `v_cliente_pendiente` */;
/*!50001 DROP TABLE IF EXISTS `v_cliente_pendiente` */;

/*!50001 CREATE TABLE  `v_cliente_pendiente`(
 `id_cliente` bigint(20) ,
 `nom_persona` varchar(50) ,
 `ape_persona` varchar(50) ,
 `ruc_persona` varchar(20) ,
 `telf_persona` varchar(10) ,
 `cel_persona` varchar(10) ,
 `direc_persona` text ,
 `id_trabajador` bigint(20) ,
 `id_tipoconex` bigint(20) ,
 `ip_detcliente` varchar(25) ,
 `hora_detcliente` time ,
 `fecha_detcliente` date ,
 `estado_conex` varchar(2) 
)*/;

/*Table structure for table `v_compra_detalle` */

DROP TABLE IF EXISTS `v_compra_detalle`;

/*!50001 DROP VIEW IF EXISTS `v_compra_detalle` */;
/*!50001 DROP TABLE IF EXISTS `v_compra_detalle` */;

/*!50001 CREATE TABLE  `v_compra_detalle`(
 `id_compra` bigint(20) ,
 `id_producto` bigint(20) ,
 `nom_producto` varchar(100) ,
 `costouni_detcompra` double(10,2) ,
 `canti_detcompra` int(11) 
)*/;

/*Table structure for table `v_factura_detalle` */

DROP TABLE IF EXISTS `v_factura_detalle`;

/*!50001 DROP VIEW IF EXISTS `v_factura_detalle` */;
/*!50001 DROP TABLE IF EXISTS `v_factura_detalle` */;

/*!50001 CREATE TABLE  `v_factura_detalle`(
 `id_fact` bigint(20) ,
 `id_producto` bigint(20) ,
 `nom_producto` varchar(100) ,
 `canti_detfact` double(10,2) ,
 `precio_detfact` double(10,2) 
)*/;

/*Table structure for table `v_producto` */

DROP TABLE IF EXISTS `v_producto`;

/*!50001 DROP VIEW IF EXISTS `v_producto` */;
/*!50001 DROP TABLE IF EXISTS `v_producto` */;

/*!50001 CREATE TABLE  `v_producto`(
 `id_producto` bigint(20) ,
 `id_tiporeten` bigint(20) ,
 `porcentaje_codRetAir` double(10,2) ,
 `id_marca` bigint(20) ,
 `id_unimedida` bigint(20) ,
 `id_ganancia` bigint(20) ,
 `porctj_ganancia` double(10,2) ,
 `codbarra_producto` varchar(100) ,
 `nom_producto` varchar(100) ,
 `descrip_producto` text ,
 `costo_producto` double(10,2) ,
 `pvp1_producto` double(10,2) ,
 `stock_producto` int(11) ,
 `stkmin_producto` int(11) ,
 `stkmax_producto` int(11) ,
 `img_producto` varchar(100) ,
 `fecing_producto` date ,
 `fecvenci_producto` date ,
 `estado_producto` varchar(2) 
)*/;

/*Table structure for table `v_producto_proveedor` */

DROP TABLE IF EXISTS `v_producto_proveedor`;

/*!50001 DROP VIEW IF EXISTS `v_producto_proveedor` */;
/*!50001 DROP TABLE IF EXISTS `v_producto_proveedor` */;

/*!50001 CREATE TABLE  `v_producto_proveedor`(
 `id_proveedor` bigint(20) ,
 `id_producto` bigint(20) ,
 `nom_persona` varchar(50) ,
 `estado_persona` varchar(2) 
)*/;

/*Table structure for table `v_remito` */

DROP TABLE IF EXISTS `v_remito`;

/*!50001 DROP VIEW IF EXISTS `v_remito` */;
/*!50001 DROP TABLE IF EXISTS `v_remito` */;

/*!50001 CREATE TABLE  `v_remito`(
 `id_remito` bigint(20) unsigned ,
 `fecha` varchar(10) ,
 `total` double(10,2) ,
 `numero` bigint(20) ,
 `estado` varchar(9) ,
 `observacion` text ,
 `nom_empleado` varchar(50) ,
 `ape_empleado` varchar(50) ,
 `dominio` varchar(7) ,
 `marca` varchar(20) ,
 `modelo` varchar(20) ,
 `nom_cliente` varchar(50) ,
 `id_cliente` bigint(20) ,
 `ape_cliente` varchar(50) 
)*/;

/*Table structure for table `v_remito_detalle` */

DROP TABLE IF EXISTS `v_remito_detalle`;

/*!50001 DROP VIEW IF EXISTS `v_remito_detalle` */;
/*!50001 DROP TABLE IF EXISTS `v_remito_detalle` */;

/*!50001 CREATE TABLE  `v_remito_detalle`(
 `id_remito` bigint(20) unsigned ,
 `id_producto` bigint(20) ,
 `nom_producto` varchar(100) ,
 `canti_detremi` double(10,2) ,
 `precio_detremi` double(10,2) ,
 `id_tipoiva` tinyint(1) unsigned 
)*/;

/*Table structure for table `v_vehiculo_cliente` */

DROP TABLE IF EXISTS `v_vehiculo_cliente`;

/*!50001 DROP VIEW IF EXISTS `v_vehiculo_cliente` */;
/*!50001 DROP TABLE IF EXISTS `v_vehiculo_cliente` */;

/*!50001 CREATE TABLE  `v_vehiculo_cliente`(
 `id_cliente` bigint(20) ,
 `id_vehiculo` bigint(20) ,
 `nom_persona` varchar(102) ,
 `estado_persona` varchar(2) 
)*/;

/*View structure for view v_acceso_modulo */

/*!50001 DROP TABLE IF EXISTS `v_acceso_modulo` */;
/*!50001 DROP VIEW IF EXISTS `v_acceso_modulo` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_acceso_modulo` AS (select `acceso_modulo`.`id_persona` AS `id_persona`,`acceso_modulo`.`id_modulo` AS `id_modulo`,`modulo`.`id_padre` AS `id_padre`,`persona`.`estado_persona` AS `estado_persona`,`modulo`.`nom_modulo` AS `nom_modulo`,`modulo`.`img_modulo` AS `img_modulo`,`modulo`.`url_modulo` AS `url_modulo` from ((`acceso_modulo` join `modulo` on((`acceso_modulo`.`id_modulo` = `modulo`.`id_modulo`))) join `persona` on((`acceso_modulo`.`id_persona` = `persona`.`id_persona`))) where (`modulo`.`activo` = 1)) */;

/*View structure for view v_cliente_pago */

/*!50001 DROP TABLE IF EXISTS `v_cliente_pago` */;
/*!50001 DROP VIEW IF EXISTS `v_cliente_pago` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_cliente_pago` AS (select `cliente_pago`.`id_persona` AS `id_persona`,`persona`.`nom_persona` AS `nom_persona`,`persona`.`ape_persona` AS `ape_persona`,`persona`.`ruc_persona` AS `ruc_persona`,`persona`.`direc_persona` AS `direc_persona`,`persona`.`telf_persona` AS `telf_persona`,`persona`.`cel_persona` AS `cel_persona`,`persona`.`email_persona` AS `email_persona`,`cliente_pago`.`canti_pago` AS `canti_pago`,`cliente_pago`.`fecha_pago` AS `fecha_pago`,`cliente_pago`.`estado_pago` AS `estado_pago` from (`cliente_pago` join `persona` on((`cliente_pago`.`id_persona` = `persona`.`id_persona`)))) */;

/*View structure for view v_cliente_pendiente */

/*!50001 DROP TABLE IF EXISTS `v_cliente_pendiente` */;
/*!50001 DROP VIEW IF EXISTS `v_cliente_pendiente` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_cliente_pendiente` AS (select `detalle_cliente`.`id_cliente` AS `id_cliente`,`persona`.`nom_persona` AS `nom_persona`,`persona`.`ape_persona` AS `ape_persona`,`persona`.`ruc_persona` AS `ruc_persona`,`persona`.`telf_persona` AS `telf_persona`,`persona`.`cel_persona` AS `cel_persona`,`persona`.`direc_persona` AS `direc_persona`,`detalle_cliente`.`id_trabajador` AS `id_trabajador`,`detalle_cliente`.`id_tipoconex` AS `id_tipoconex`,`detalle_cliente`.`ip_detcliente` AS `ip_detcliente`,`detalle_cliente`.`hora_detcliente` AS `hora_detcliente`,`detalle_cliente`.`fecha_detcliente` AS `fecha_detcliente`,`detalle_cliente`.`estado_conex` AS `estado_conex` from ((`detalle_cliente` join `persona` on((`detalle_cliente`.`id_cliente` = `persona`.`id_persona`))) join `tipo_conexion` on((`detalle_cliente`.`id_tipoconex` = `tipo_conexion`.`id_tipoconex`)))) */;

/*View structure for view v_compra_detalle */

/*!50001 DROP TABLE IF EXISTS `v_compra_detalle` */;
/*!50001 DROP VIEW IF EXISTS `v_compra_detalle` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_compra_detalle` AS (select `detalle_compra`.`id_compra` AS `id_compra`,`detalle_compra`.`id_producto` AS `id_producto`,`producto`.`nom_producto` AS `nom_producto`,`detalle_compra`.`costouni_detcompra` AS `costouni_detcompra`,`detalle_compra`.`canti_detcompra` AS `canti_detcompra` from (`detalle_compra` join `producto` on((`detalle_compra`.`id_producto` = `producto`.`id_producto`)))) */;

/*View structure for view v_factura_detalle */

/*!50001 DROP TABLE IF EXISTS `v_factura_detalle` */;
/*!50001 DROP VIEW IF EXISTS `v_factura_detalle` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_factura_detalle` AS (select `detalle_factura`.`id_fact` AS `id_fact`,`detalle_factura`.`id_producto` AS `id_producto`,`producto`.`nom_producto` AS `nom_producto`,`detalle_factura`.`canti_detfact` AS `canti_detfact`,`detalle_factura`.`precio_detfact` AS `precio_detfact` from (`detalle_factura` join `producto` on((`detalle_factura`.`id_producto` = `producto`.`id_producto`)))) */;

/*View structure for view v_producto */

/*!50001 DROP TABLE IF EXISTS `v_producto` */;
/*!50001 DROP VIEW IF EXISTS `v_producto` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_producto` AS (select `producto`.`id_producto` AS `id_producto`,`producto`.`id_tiporeten` AS `id_tiporeten`,`tiporetencion`.`porcentaje_codRetAir` AS `porcentaje_codRetAir`,`producto`.`id_marca` AS `id_marca`,`producto`.`id_unimedida` AS `id_unimedida`,`producto`.`id_ganancia` AS `id_ganancia`,`ganancia`.`porctj_ganancia` AS `porctj_ganancia`,`producto`.`codbarra_producto` AS `codbarra_producto`,`producto`.`nom_producto` AS `nom_producto`,`producto`.`descrip_producto` AS `descrip_producto`,`producto`.`costo_producto` AS `costo_producto`,`producto`.`pvp1_producto` AS `pvp1_producto`,`producto`.`stock_producto` AS `stock_producto`,`producto`.`stkmin_producto` AS `stkmin_producto`,`producto`.`stkmax_producto` AS `stkmax_producto`,`producto`.`img_producto` AS `img_producto`,`producto`.`fecing_producto` AS `fecing_producto`,`producto`.`fecvenci_producto` AS `fecvenci_producto`,`producto`.`estado_producto` AS `estado_producto` from ((`producto` join `tiporetencion` on((`producto`.`id_tiporeten` = `tiporetencion`.`id_tiporeten`))) join `ganancia` on((`producto`.`id_ganancia` = `ganancia`.`id_ganancia`)))) */;

/*View structure for view v_producto_proveedor */

/*!50001 DROP TABLE IF EXISTS `v_producto_proveedor` */;
/*!50001 DROP VIEW IF EXISTS `v_producto_proveedor` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_producto_proveedor` AS (select `producto_proveedor`.`id_proveedor` AS `id_proveedor`,`producto_proveedor`.`id_producto` AS `id_producto`,`persona`.`nom_persona` AS `nom_persona`,`persona`.`estado_persona` AS `estado_persona` from (`producto_proveedor` join `persona` on((`producto_proveedor`.`id_proveedor` = `persona`.`id_persona`)))) */;

/*View structure for view v_remito */

/*!50001 DROP TABLE IF EXISTS `v_remito` */;
/*!50001 DROP VIEW IF EXISTS `v_remito` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_remito` AS (select `r`.`id_remito` AS `id_remito`,date_format(`r`.`fecemi_remi`,'%d-%m-%Y') AS `fecha`,`r`.`total_remi` AS `total`,`r`.`num_remi` AS `numero`,if((`r`.`estado_remi` = 1),'Pendiente','Cobrado') AS `estado`,`r`.`obs_remi` AS `observacion`,`e`.`nom_persona` AS `nom_empleado`,`e`.`ape_persona` AS `ape_empleado`,`v`.`dominio` AS `dominio`,`v`.`marca` AS `marca`,`v`.`modelo` AS `modelo`,`c`.`nom_persona` AS `nom_cliente`,`c`.`id_persona` AS `id_cliente`,`c`.`ape_persona` AS `ape_cliente` from (((`remito` `r` left join `persona` `e` on((`e`.`id_persona` = `r`.`id_vendedor`))) left join `vehiculo` `v` on((`v`.`id_vehiculo` = `r`.`id_vehiculo`))) left join `persona` `c` on((`c`.`id_persona` = `r`.`id_cliente`)))) */;

/*View structure for view v_remito_detalle */

/*!50001 DROP TABLE IF EXISTS `v_remito_detalle` */;
/*!50001 DROP VIEW IF EXISTS `v_remito_detalle` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_remito_detalle` AS (select `detalle_remito`.`id_remito` AS `id_remito`,`detalle_remito`.`id_producto` AS `id_producto`,`producto`.`nom_producto` AS `nom_producto`,`detalle_remito`.`canti_detremi` AS `canti_detremi`,`detalle_remito`.`precio_detremi` AS `precio_detremi`,`producto`.`id_tipoiva` AS `id_tipoiva` from (`detalle_remito` join `producto` on((`detalle_remito`.`id_producto` = `producto`.`id_producto`)))) */;

/*View structure for view v_vehiculo_cliente */

/*!50001 DROP TABLE IF EXISTS `v_vehiculo_cliente` */;
/*!50001 DROP VIEW IF EXISTS `v_vehiculo_cliente` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_vehiculo_cliente` AS (select `vehiculo_cliente`.`id_cliente` AS `id_cliente`,`vehiculo_cliente`.`id_vehiculo` AS `id_vehiculo`,concat(`persona`.`nom_persona`,'(',`persona`.`ape_persona`,')') AS `nom_persona`,`persona`.`estado_persona` AS `estado_persona` from (`vehiculo_cliente` join `persona` on((`vehiculo_cliente`.`id_cliente` = `persona`.`id_persona`)))) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
