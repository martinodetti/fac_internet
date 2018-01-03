-- MySQL dump 10.13  Distrib 5.5.29, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: fac_internet
-- ------------------------------------------------------
-- Server version	5.5.29-0ubuntu0.12.10.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `fac_internet`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `fac_internet` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `fac_internet`;

--
-- Table structure for table `acceso_modulo`
--

DROP TABLE IF EXISTS `acceso_modulo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acceso_modulo` (
  `id_acsmod` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_persona` bigint(20) DEFAULT NULL,
  `id_modulo` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id_acsmod`),
  KEY `FK_acceso_modulo` (`id_persona`),
  KEY `FK_acceso_modulo_MOD` (`id_modulo`),
  CONSTRAINT `FK_acceso_modulo` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`),
  CONSTRAINT `FK_acceso_modulo_MOD` FOREIGN KEY (`id_modulo`) REFERENCES `modulo` (`id_modulo`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acceso_modulo`
--

LOCK TABLES `acceso_modulo` WRITE;
/*!40000 ALTER TABLE `acceso_modulo` DISABLE KEYS */;
INSERT INTO `acceso_modulo` VALUES (9,1,1),(10,1,18),(11,1,19),(12,1,20),(13,1,21),(14,1,22),(15,1,23),(16,1,24),(17,1,33),(18,1,34),(19,1,35),(20,1,36),(21,1,37),(22,1,38),(23,1,39),(24,1,40),(25,1,41),(26,1,42),(27,1,43),(30,1,44),(33,1,45),(34,1,46),(35,1,47),(36,1,48),(44,21,1),(45,21,34),(46,21,22),(47,21,23),(48,21,24),(49,21,35),(50,21,36);
/*!40000 ALTER TABLE `acceso_modulo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ciudad`
--

DROP TABLE IF EXISTS `ciudad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ciudad` (
  `id_ciudad` bigint(20) NOT NULL AUTO_INCREMENT,
  `nom_ciudad` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_ciudad`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ciudad`
--

LOCK TABLES `ciudad` WRITE;
/*!40000 ALTER TABLE `ciudad` DISABLE KEYS */;
INSERT INTO `ciudad` VALUES (1,'CIUDAD'),(2,'GUAYMALLEN'),(3,'GODOY CRUZ'),(4,'LAS HERAS'),(5,'MAIPU'),(6,'LUJAN DE CUYO'),(7,'SAN MARTIN'),(8,'TUNUYAN');
/*!40000 ALTER TABLE `ciudad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cliente_pago`
--

DROP TABLE IF EXISTS `cliente_pago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente_pago`
--

LOCK TABLES `cliente_pago` WRITE;
/*!40000 ALTER TABLE `cliente_pago` DISABLE KEYS */;
INSERT INTO `cliente_pago` VALUES (39,19,27,67.20,'2012-08-29','1'),(40,19,0,0.00,'2012-09-29','0');
/*!40000 ALTER TABLE `cliente_pago` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compra`
--

DROP TABLE IF EXISTS `compra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compra`
--

LOCK TABLES `compra` WRITE;
/*!40000 ALTER TABLE `compra` DISABLE KEYS */;
INSERT INTO `compra` VALUES (1,3,'566b',212.80,'vkjhfkjghjdfkghd',22.80,'2012-04-08','1');
/*!40000 ALTER TABLE `compra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `descuento_venta`
--

DROP TABLE IF EXISTS `descuento_venta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `descuento_venta` (
  `id_descto` bigint(20) NOT NULL AUTO_INCREMENT,
  `porctj_descto` double(10,2) DEFAULT NULL,
  PRIMARY KEY (`id_descto`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `descuento_venta`
--

LOCK TABLES `descuento_venta` WRITE;
/*!40000 ALTER TABLE `descuento_venta` DISABLE KEYS */;
INSERT INTO `descuento_venta` VALUES (1,0.00),(2,0.10),(3,1.00),(4,2.00),(5,3.00);
/*!40000 ALTER TABLE `descuento_venta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_cliente`
--

DROP TABLE IF EXISTS `detalle_cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_cliente`
--

LOCK TABLES `detalle_cliente` WRITE;
/*!40000 ALTER TABLE `detalle_cliente` DISABLE KEYS */;
INSERT INTO `detalle_cliente` VALUES (14,18,5,1,'192.168.3.1','14:00:00','2012-07-04','1'),(15,19,2,1,'','17:20:00','2012-07-01','1');
/*!40000 ALTER TABLE `detalle_cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_compra`
--

DROP TABLE IF EXISTS `detalle_compra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_compra`
--

LOCK TABLES `detalle_compra` WRITE;
/*!40000 ALTER TABLE `detalle_compra` DISABLE KEYS */;
INSERT INTO `detalle_compra` VALUES (1,1,5,20.00,2,'1'),(2,1,7,30.00,5,'1');
/*!40000 ALTER TABLE `detalle_compra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_devolucion`
--

DROP TABLE IF EXISTS `detalle_devolucion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_devolucion`
--

LOCK TABLES `detalle_devolucion` WRITE;
/*!40000 ALTER TABLE `detalle_devolucion` DISABLE KEYS */;
INSERT INTO `detalle_devolucion` VALUES (1,1,6,1,25.00,'1');
/*!40000 ALTER TABLE `detalle_devolucion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_factura`
--

DROP TABLE IF EXISTS `detalle_factura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_factura`
--

LOCK TABLES `detalle_factura` WRITE;
/*!40000 ALTER TABLE `detalle_factura` DISABLE KEYS */;
INSERT INTO `detalle_factura` VALUES (24,27,10,1.00,60.00,'1');
/*!40000 ALTER TABLE `detalle_factura` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_gastos`
--

DROP TABLE IF EXISTS `detalle_gastos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalle_gastos` (
  `id_detgasto` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_gasto` bigint(20) DEFAULT NULL,
  `nombre_produc` varchar(30) DEFAULT NULL,
  `costouni_detgasto` double(10,2) DEFAULT NULL,
  `canti_detgasto` int(11) DEFAULT NULL,
  `estado_detgasto` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id_detgasto`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_gastos`
--

LOCK TABLES `detalle_gastos` WRITE;
/*!40000 ALTER TABLE `detalle_gastos` DISABLE KEYS */;
INSERT INTO `detalle_gastos` VALUES (1,4,'hgvghh',12.00,5,'1'),(2,5,'FIDEOS PRECOCINADOS',0.80,2,'1');
/*!40000 ALTER TABLE `detalle_gastos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_kardex`
--

DROP TABLE IF EXISTS `detalle_kardex`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalle_kardex` (
  `id_detkardex` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_kardex` bigint(20) DEFAULT NULL,
  `id_producto` bigint(20) DEFAULT NULL,
  `costo_detkardex` double(10,2) DEFAULT NULL,
  `canti_detkardex` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_detkardex`),
  KEY `FK_detalle_kardex` (`id_kardex`),
  CONSTRAINT `FK_detalle_kardex` FOREIGN KEY (`id_kardex`) REFERENCES `kardex` (`id_kardex`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_kardex`
--

LOCK TABLES `detalle_kardex` WRITE;
/*!40000 ALTER TABLE `detalle_kardex` DISABLE KEYS */;
INSERT INTO `detalle_kardex` VALUES (24,24,10,60.00,1),(25,25,5,20.00,2),(26,25,7,30.00,5),(27,26,6,25.00,1);
/*!40000 ALTER TABLE `detalle_kardex` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_proveedor`
--

DROP TABLE IF EXISTS `detalle_proveedor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_proveedor`
--

LOCK TABLES `detalle_proveedor` WRITE;
/*!40000 ALTER TABLE `detalle_proveedor` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalle_proveedor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `devolucion`
--

DROP TABLE IF EXISTS `devolucion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `devolucion`
--

LOCK TABLES `devolucion` WRITE;
/*!40000 ALTER TABLE `devolucion` DISABLE KEYS */;
INSERT INTO `devolucion` VALUES (1,0,1,0.00,3.00,28.00,'asdasdasd','2013-03-22','1');
/*!40000 ALTER TABLE `devolucion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empresa`
--

DROP TABLE IF EXISTS `empresa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresa`
--

LOCK TABLES `empresa` WRITE;
/*!40000 ALTER TABLE `empresa` DISABLE KEYS */;
INSERT INTO `empresa` VALUES (1,5,6,1,'GATO NET','0909808089034','Calle TU DIRECCION','2950450','295045034','www.gato.com','Gato_net134@hotmail.com','2012-02-12');
/*!40000 ALTER TABLE `empresa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estado_civil`
--

DROP TABLE IF EXISTS `estado_civil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estado_civil` (
  `id_civil` bigint(20) NOT NULL AUTO_INCREMENT,
  `estado_civil` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id_civil`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado_civil`
--

LOCK TABLES `estado_civil` WRITE;
/*!40000 ALTER TABLE `estado_civil` DISABLE KEYS */;
INSERT INTO `estado_civil` VALUES (1,'SOLTERO(A)'),(2,'CASADO(A)'),(3,'DIVORCIADO(A)'),(4,'VIUDO(A)'),(5,'UNIÓN LIBRE');
/*!40000 ALTER TABLE `estado_civil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `factura`
--

DROP TABLE IF EXISTS `factura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `factura` (
  `id_fact` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_empresa` bigint(20) DEFAULT NULL,
  `id_cliente` bigint(20) DEFAULT NULL,
  `id_vendedor` bigint(20) DEFAULT NULL,
  `descto_fact` double(10,2) DEFAULT NULL,
  `obs_fact` text,
  `iva12_fact` double(10,2) DEFAULT NULL,
  `total_fact` double(10,2) DEFAULT NULL,
  `fecemi_fact` date DEFAULT NULL,
  `estado_fact` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id_fact`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `factura`
--

LOCK TABLES `factura` WRITE;
/*!40000 ALTER TABLE `factura` DISABLE KEYS */;
INSERT INTO `factura` VALUES (27,1,19,1,0.00,'INSTALACIÓN + MES GRATIS',7.20,67.20,'2012-08-29','1');
/*!40000 ALTER TABLE `factura` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ganancia`
--

DROP TABLE IF EXISTS `ganancia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ganancia` (
  `id_ganancia` bigint(20) NOT NULL AUTO_INCREMENT,
  `porctj_ganancia` double(10,2) DEFAULT NULL,
  `descrip_ganancia` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_ganancia`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ganancia`
--

LOCK TABLES `ganancia` WRITE;
/*!40000 ALTER TABLE `ganancia` DISABLE KEYS */;
INSERT INTO `ganancia` VALUES (1,12.00,'POR LA VENTA DE CADA PRODUCTO'),(2,15.00,'PARA LOS CLIENTES TIPO B'),(4,0.00,'0% PARA LOS PLANES');
/*!40000 ALTER TABLE `ganancia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gastos`
--

DROP TABLE IF EXISTS `gastos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gastos`
--

LOCK TABLES `gastos` WRITE;
/*!40000 ALTER TABLE `gastos` DISABLE KEYS */;
INSERT INTO `gastos` VALUES (3,'hgvhhhv',2.24,'2012-01-10','3355','ghvfgh','vvhhh',0.24),(4,'jhbhbhbhjh',118.72,'2012-01-09','5677788','jhvhvvhhgh','jhbhhbhjhj',12.72),(5,'ALIMENTACIÓN',15.46,'2012-10-17','091010191','DULSA MORT','ALEJANDRO PEDOR',1.66);
/*!40000 ALTER TABLE `gastos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kardex`
--

DROP TABLE IF EXISTS `kardex`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kardex` (
  `id_kardex` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_factcmp_kardex` bigint(20) DEFAULT NULL COMMENT 'id factura o compra',
  `tipo_entrdsald_kardex` varchar(2) DEFAULT NULL COMMENT '1: compra 2:devolucion de mi cliente 3:ventas 4: devolucion de mercaderia ',
  `tipo_cmpbt_kardex` varchar(2) DEFAULT NULL COMMENT '1: compra 3: factura',
  `cod_factcmp_kardex` varchar(100) DEFAULT NULL COMMENT 'ejempl:1-2-12-19 ;guarda id de los campos para minimizar la busqueda',
  `fecha_kardex` date DEFAULT NULL,
  `estado_kardex` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id_kardex`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kardex`
--

LOCK TABLES `kardex` WRITE;
/*!40000 ALTER TABLE `kardex` DISABLE KEYS */;
INSERT INTO `kardex` VALUES (24,27,'3','3','10-','2012-07-08','1'),(25,1,'1','1','5-7-','2012-10-10','1'),(26,0,'4','1','6-','2013-03-22','1');
/*!40000 ALTER TABLE `kardex` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marca_producto`
--

DROP TABLE IF EXISTS `marca_producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `marca_producto` (
  `id_marca` bigint(20) NOT NULL AUTO_INCREMENT,
  `nom_marca` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_marca`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marca_producto`
--

LOCK TABLES `marca_producto` WRITE;
/*!40000 ALTER TABLE `marca_producto` DISABLE KEYS */;
INSERT INTO `marca_producto` VALUES (1,'NINGUNA'),(2,'TORNILLOS');
/*!40000 ALTER TABLE `marca_producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modulo`
--

DROP TABLE IF EXISTS `modulo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modulo` (
  `id_modulo` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_padre` bigint(20) DEFAULT NULL,
  `nom_modulo` varchar(50) DEFAULT NULL,
  `img_modulo` varchar(50) DEFAULT NULL,
  `url_modulo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_modulo`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modulo`
--

LOCK TABLES `modulo` WRITE;
/*!40000 ALTER TABLE `modulo` DISABLE KEYS */;
INSERT INTO `modulo` VALUES (1,-1,'INVENTARIO',NULL,NULL),(18,1,'CATEGORIA','MARCA.png','marca.php'),(19,1,'UNIDAD DE MEDIDA','UNIDAD.png','medida.php'),(20,1,'GANANCIA X PRODUCTO','GANANCIA.png','ganancia.php'),(21,1,'TIPO DE RETENCIÓN','TIPORETEN.png','tiporeten.php'),(22,1,'PRODUCTO','PRODUCTO.png','producto.php'),(23,1,'PROVEEDOR','PROVEEDOR.png','proveedor.php'),(24,1,'INGRESO DE MERCADERÍA','MERCADERIA.png','mercaderia.php'),(33,1,'KARDEX','KARDEX.png','kardex.php'),(34,-2,'FACTURACIÓN',NULL,NULL),(35,34,'FACTURA','FACTURA.png','factura.php'),(36,34,'CLIENTE','CLIENTE.png','cliente.php'),(37,34,'REPORTE DE VENTAS','REVENTA.png','reptventa.php'),(38,-3,'EMPRESA Y RRHH',NULL,NULL),(39,38,'EMPRESA','EMPRESA.png','empresa.php'),(40,38,'TRABAJADOR','TRABAJADOR.png','trabajador.php'),(41,-4,'PERMISOS A USUARIOS',NULL,NULL),(42,41,'PERMISO','SEGURIDAD.png','permiso.php'),(43,34,'DEVOLUCIONES','KARDEX.png','devolucion.php'),(44,1,'DEVOLUCIÓN DE MERCADERÍA','INVENTARIO.png','devomerca.php'),(45,34,'PAGOS DE INTERNET','PAGOINTERNET.png','pago.php'),(46,34,'GASTOS','gasto.png','gastos.php'),(47,34,'REPORTE FINANCIERO','reporte_financiero.png','reptfinanciero.php'),(48,34,'REPORTE DE COMPRA','reporte_compra.png','reptcompra.php');
/*!40000 ALTER TABLE `modulo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `persona`
--

DROP TABLE IF EXISTS `persona`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `persona`
--

LOCK TABLES `persona` WRITE;
/*!40000 ALTER TABLE `persona` DISABLE KEYS */;
INSERT INTO `persona` VALUES (1,1,1,1,1,'ADMIN','ADMINISTRADOR','0705206597','UTMACH','00000000','00000000','UTMACH@HOTMAIL.COM','UTMACH.COM','NADA','2012-05-30','1','123456'),(3,3,2,1,1,'PROVEEDOR','','429834923','12 DE OCTUBRE Y 24 DE MAYO','9583299000','958953489','PROVEEDOR@HOTMAIL.COM','','VENTA DE PASTILLAS DE FRENOS','2012-06-03','1',''),(18,2,1,1,1,'FERNANDA ELI','JIMENEZ RUIZ','0967567567','CIUDAD VERDE','6756756','567567567','','','','2012-07-02','1',''),(19,2,4,1,1,'SYLVIA PATRICIA','PRADO ASANZA','0956856556','PASAJE FRENTE AL COLEGIO MADRE DE JESÚS','','055645646','','','','2012-07-01','1',''),(21,1,1,1,1,'Martin','Odetti','0030494211','davila 4178','','154708276','','','empleado','2013-03-25','1','123456'),(22,3,2,1,1,'PROVEEDOR 1','','2020287122','Davila','','','','','','2013-03-25','1',''),(25,2,5,1,1,'CLIENTE1 S.A.','CLIENTITO','2099388123','','','','','','','2013-03-26','1','');
/*!40000 ALTER TABLE `persona` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `producto`
--

DROP TABLE IF EXISTS `producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producto`
--

LOCK TABLES `producto` WRITE;
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO `producto` VALUES (5,1,2,1,4,1,'0000000','PLAN DE $20+IVA 300KB','PLAN DE $20 + IVA CON 300KB Y UN MES GRATIS',1.00,1.00,0,0,1,'','2012-07-05','2012-07-05','1'),(6,1,1,3,4,1,'0000000','PLAN DE $25+IVA 400KB','PLAN DE $25 + IVA CON 400KB DE BANDA ANCHA',25.00,25.00,-1,0,1,'','2012-07-05','2012-07-05','1'),(7,1,1,3,4,1,'0000000','PLAN DE $30+IVA 500KB','PLAN DE $30+IVA CON 500KB DE BANDA ANCHA',30.00,30.00,5,0,1,'','2012-07-05','2012-07-05','1'),(8,1,1,3,4,1,'0000000000000','PLAN DE $35+IVA 700KB','PLAN DE $35+IVA CON 700KB DE BANDA ANCHA',35.00,35.00,0,0,1,'','2012-07-05','2012-07-05','1'),(9,1,1,3,4,1,'0000000000','PLAN DE $50+IVA 1MB','PLAN DE $50 + IVA 1MB DE BANDA ANCHA PARA CORPORACIONES O EMPRESAS',50.00,50.00,0,0,1,'','2012-07-05','2012-07-05','1'),(10,1,1,3,4,1,'201012012','INSTALACIÓN ','INSTALACIÓN DE INTERNET Y PRESTAMO DE EQUIPOS DE RED',60.00,60.00,-22,0,1,'','2012-07-07','2012-07-07','1');
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `producto_proveedor`
--

DROP TABLE IF EXISTS `producto_proveedor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `producto_proveedor` (
  `id_prod_provd` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_producto` bigint(20) DEFAULT NULL,
  `id_proveedor` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id_prod_provd`),
  KEY `FK_producto_proveedor` (`id_producto`),
  KEY `FK_producto_proveedor_persona` (`id_proveedor`),
  CONSTRAINT `FK_producto_proveedor` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE,
  CONSTRAINT `FK_producto_proveedor_persona` FOREIGN KEY (`id_proveedor`) REFERENCES `persona` (`id_persona`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producto_proveedor`
--

LOCK TABLES `producto_proveedor` WRITE;
/*!40000 ALTER TABLE `producto_proveedor` DISABLE KEYS */;
/*!40000 ALTER TABLE `producto_proveedor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sexo`
--

DROP TABLE IF EXISTS `sexo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sexo` (
  `id_sexo` bigint(20) NOT NULL AUTO_INCREMENT,
  `nom_sexo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_sexo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sexo`
--

LOCK TABLES `sexo` WRITE;
/*!40000 ALTER TABLE `sexo` DISABLE KEYS */;
INSERT INTO `sexo` VALUES (1,'FEMENINO'),(2,'MASCULINO');
/*!40000 ALTER TABLE `sexo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_conexion`
--

DROP TABLE IF EXISTS `tipo_conexion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_conexion` (
  `id_tipoconex` bigint(20) NOT NULL AUTO_INCREMENT,
  `nom_tipoconex` varchar(50) DEFAULT NULL,
  `estado_tipoconex` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id_tipoconex`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_conexion`
--

LOCK TABLES `tipo_conexion` WRITE;
/*!40000 ALTER TABLE `tipo_conexion` DISABLE KEYS */;
INSERT INTO `tipo_conexion` VALUES (1,'INALÁMBRICA','1'),(2,'CABLEADA','2');
/*!40000 ALTER TABLE `tipo_conexion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_persona`
--

DROP TABLE IF EXISTS `tipo_persona`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_persona` (
  `id_tipoper` bigint(20) NOT NULL AUTO_INCREMENT,
  `nom_tipoper` varchar(100) DEFAULT NULL,
  `estado_tipoper` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id_tipoper`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_persona`
--

LOCK TABLES `tipo_persona` WRITE;
/*!40000 ALTER TABLE `tipo_persona` DISABLE KEYS */;
INSERT INTO `tipo_persona` VALUES (1,'TRABAJADOR','1'),(2,'CLIENTE','1'),(3,'PROVEEDOR','1');
/*!40000 ALTER TABLE `tipo_persona` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipoiva`
--

DROP TABLE IF EXISTS `tipoiva`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipoiva` (
  `id_tipoiva` tinyint(1) unsigned NOT NULL AUTO_INCREMENT,
  `nom_tipoiva` varchar(32) NOT NULL DEFAULT '',
  `porcentaje_iva` double(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id_tipoiva`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipoiva`
--

LOCK TABLES `tipoiva` WRITE;
/*!40000 ALTER TABLE `tipoiva` DISABLE KEYS */;
INSERT INTO `tipoiva` VALUES (1,'Iva 21%',21.00),(2,'Iva 10,5%',10.50);
/*!40000 ALTER TABLE `tipoiva` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tiporetencion`
--

DROP TABLE IF EXISTS `tiporetencion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tiporetencion` (
  `id_tiporeten` bigint(20) NOT NULL AUTO_INCREMENT,
  `cod_codRetAir` varchar(6) DEFAULT NULL COMMENT '340 Otras Retenciones Aplicables el 1%',
  `nom_codRetAir` text,
  `porcentaje_codRetAir` double(10,2) DEFAULT NULL COMMENT 'solo dos decimales',
  PRIMARY KEY (`id_tiporeten`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tiporetencion`
--

LOCK TABLES `tiporetencion` WRITE;
/*!40000 ALTER TABLE `tiporetencion` DISABLE KEYS */;
INSERT INTO `tiporetencion` VALUES (1,'340','Otras Retenciones Aplicables el 1%',1.00);
/*!40000 ALTER TABLE `tiporetencion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unidad_medida`
--

DROP TABLE IF EXISTS `unidad_medida`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unidad_medida` (
  `id_unimedida` bigint(20) NOT NULL AUTO_INCREMENT,
  `nom_unimedida` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_unimedida`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unidad_medida`
--

LOCK TABLES `unidad_medida` WRITE;
/*!40000 ALTER TABLE `unidad_medida` DISABLE KEYS */;
INSERT INTO `unidad_medida` VALUES (1,'UNIDAD(S)'),(2,'KILO(S)'),(3,'NADA');
/*!40000 ALTER TABLE `unidad_medida` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `v_acceso_modulo`
--

DROP TABLE IF EXISTS `v_acceso_modulo`;
/*!50001 DROP VIEW IF EXISTS `v_acceso_modulo`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `v_acceso_modulo` (
  `id_persona` tinyint NOT NULL,
  `id_modulo` tinyint NOT NULL,
  `id_padre` tinyint NOT NULL,
  `estado_persona` tinyint NOT NULL,
  `nom_modulo` tinyint NOT NULL,
  `img_modulo` tinyint NOT NULL,
  `url_modulo` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `v_cliente_pago`
--

DROP TABLE IF EXISTS `v_cliente_pago`;
/*!50001 DROP VIEW IF EXISTS `v_cliente_pago`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `v_cliente_pago` (
  `id_persona` tinyint NOT NULL,
  `nom_persona` tinyint NOT NULL,
  `ape_persona` tinyint NOT NULL,
  `ruc_persona` tinyint NOT NULL,
  `direc_persona` tinyint NOT NULL,
  `telf_persona` tinyint NOT NULL,
  `cel_persona` tinyint NOT NULL,
  `email_persona` tinyint NOT NULL,
  `canti_pago` tinyint NOT NULL,
  `fecha_pago` tinyint NOT NULL,
  `estado_pago` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `v_cliente_pendiente`
--

DROP TABLE IF EXISTS `v_cliente_pendiente`;
/*!50001 DROP VIEW IF EXISTS `v_cliente_pendiente`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `v_cliente_pendiente` (
  `id_cliente` tinyint NOT NULL,
  `nom_persona` tinyint NOT NULL,
  `ape_persona` tinyint NOT NULL,
  `ruc_persona` tinyint NOT NULL,
  `telf_persona` tinyint NOT NULL,
  `cel_persona` tinyint NOT NULL,
  `direc_persona` tinyint NOT NULL,
  `id_trabajador` tinyint NOT NULL,
  `id_tipoconex` tinyint NOT NULL,
  `ip_detcliente` tinyint NOT NULL,
  `hora_detcliente` tinyint NOT NULL,
  `fecha_detcliente` tinyint NOT NULL,
  `estado_conex` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `v_compra_detalle`
--

DROP TABLE IF EXISTS `v_compra_detalle`;
/*!50001 DROP VIEW IF EXISTS `v_compra_detalle`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `v_compra_detalle` (
  `id_compra` tinyint NOT NULL,
  `id_producto` tinyint NOT NULL,
  `nom_producto` tinyint NOT NULL,
  `costouni_detcompra` tinyint NOT NULL,
  `canti_detcompra` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `v_factura_detalle`
--

DROP TABLE IF EXISTS `v_factura_detalle`;
/*!50001 DROP VIEW IF EXISTS `v_factura_detalle`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `v_factura_detalle` (
  `id_fact` tinyint NOT NULL,
  `id_producto` tinyint NOT NULL,
  `nom_producto` tinyint NOT NULL,
  `canti_detfact` tinyint NOT NULL,
  `precio_detfact` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `v_producto`
--

DROP TABLE IF EXISTS `v_producto`;
/*!50001 DROP VIEW IF EXISTS `v_producto`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `v_producto` (
  `id_producto` tinyint NOT NULL,
  `id_tiporeten` tinyint NOT NULL,
  `porcentaje_codRetAir` tinyint NOT NULL,
  `id_marca` tinyint NOT NULL,
  `id_unimedida` tinyint NOT NULL,
  `id_ganancia` tinyint NOT NULL,
  `porctj_ganancia` tinyint NOT NULL,
  `codbarra_producto` tinyint NOT NULL,
  `nom_producto` tinyint NOT NULL,
  `descrip_producto` tinyint NOT NULL,
  `costo_producto` tinyint NOT NULL,
  `pvp1_producto` tinyint NOT NULL,
  `stock_producto` tinyint NOT NULL,
  `stkmin_producto` tinyint NOT NULL,
  `stkmax_producto` tinyint NOT NULL,
  `img_producto` tinyint NOT NULL,
  `fecing_producto` tinyint NOT NULL,
  `fecvenci_producto` tinyint NOT NULL,
  `estado_producto` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `v_producto_proveedor`
--

DROP TABLE IF EXISTS `v_producto_proveedor`;
/*!50001 DROP VIEW IF EXISTS `v_producto_proveedor`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `v_producto_proveedor` (
  `id_proveedor` tinyint NOT NULL,
  `id_producto` tinyint NOT NULL,
  `nom_persona` tinyint NOT NULL,
  `estado_persona` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Current Database: `fac_internet`
--

USE `fac_internet`;

--
-- Final view structure for view `v_acceso_modulo`
--

/*!50001 DROP TABLE IF EXISTS `v_acceso_modulo`*/;
/*!50001 DROP VIEW IF EXISTS `v_acceso_modulo`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_acceso_modulo` AS (select `acceso_modulo`.`id_persona` AS `id_persona`,`acceso_modulo`.`id_modulo` AS `id_modulo`,`modulo`.`id_padre` AS `id_padre`,`persona`.`estado_persona` AS `estado_persona`,`modulo`.`nom_modulo` AS `nom_modulo`,`modulo`.`img_modulo` AS `img_modulo`,`modulo`.`url_modulo` AS `url_modulo` from ((`acceso_modulo` join `modulo` on((`acceso_modulo`.`id_modulo` = `modulo`.`id_modulo`))) join `persona` on((`acceso_modulo`.`id_persona` = `persona`.`id_persona`)))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_cliente_pago`
--

/*!50001 DROP TABLE IF EXISTS `v_cliente_pago`*/;
/*!50001 DROP VIEW IF EXISTS `v_cliente_pago`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_cliente_pago` AS (select `cliente_pago`.`id_persona` AS `id_persona`,`persona`.`nom_persona` AS `nom_persona`,`persona`.`ape_persona` AS `ape_persona`,`persona`.`ruc_persona` AS `ruc_persona`,`persona`.`direc_persona` AS `direc_persona`,`persona`.`telf_persona` AS `telf_persona`,`persona`.`cel_persona` AS `cel_persona`,`persona`.`email_persona` AS `email_persona`,`cliente_pago`.`canti_pago` AS `canti_pago`,`cliente_pago`.`fecha_pago` AS `fecha_pago`,`cliente_pago`.`estado_pago` AS `estado_pago` from (`cliente_pago` join `persona` on((`cliente_pago`.`id_persona` = `persona`.`id_persona`)))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_cliente_pendiente`
--

/*!50001 DROP TABLE IF EXISTS `v_cliente_pendiente`*/;
/*!50001 DROP VIEW IF EXISTS `v_cliente_pendiente`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_cliente_pendiente` AS (select `detalle_cliente`.`id_cliente` AS `id_cliente`,`persona`.`nom_persona` AS `nom_persona`,`persona`.`ape_persona` AS `ape_persona`,`persona`.`ruc_persona` AS `ruc_persona`,`persona`.`telf_persona` AS `telf_persona`,`persona`.`cel_persona` AS `cel_persona`,`persona`.`direc_persona` AS `direc_persona`,`detalle_cliente`.`id_trabajador` AS `id_trabajador`,`detalle_cliente`.`id_tipoconex` AS `id_tipoconex`,`detalle_cliente`.`ip_detcliente` AS `ip_detcliente`,`detalle_cliente`.`hora_detcliente` AS `hora_detcliente`,`detalle_cliente`.`fecha_detcliente` AS `fecha_detcliente`,`detalle_cliente`.`estado_conex` AS `estado_conex` from ((`detalle_cliente` join `persona` on((`detalle_cliente`.`id_cliente` = `persona`.`id_persona`))) join `tipo_conexion` on((`detalle_cliente`.`id_tipoconex` = `tipo_conexion`.`id_tipoconex`)))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_compra_detalle`
--

/*!50001 DROP TABLE IF EXISTS `v_compra_detalle`*/;
/*!50001 DROP VIEW IF EXISTS `v_compra_detalle`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_compra_detalle` AS (select `detalle_compra`.`id_compra` AS `id_compra`,`detalle_compra`.`id_producto` AS `id_producto`,`producto`.`nom_producto` AS `nom_producto`,`detalle_compra`.`costouni_detcompra` AS `costouni_detcompra`,`detalle_compra`.`canti_detcompra` AS `canti_detcompra` from (`detalle_compra` join `producto` on((`detalle_compra`.`id_producto` = `producto`.`id_producto`)))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_factura_detalle`
--

/*!50001 DROP TABLE IF EXISTS `v_factura_detalle`*/;
/*!50001 DROP VIEW IF EXISTS `v_factura_detalle`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_factura_detalle` AS (select `detalle_factura`.`id_fact` AS `id_fact`,`detalle_factura`.`id_producto` AS `id_producto`,`producto`.`nom_producto` AS `nom_producto`,`detalle_factura`.`canti_detfact` AS `canti_detfact`,`detalle_factura`.`precio_detfact` AS `precio_detfact` from (`detalle_factura` join `producto` on((`detalle_factura`.`id_producto` = `producto`.`id_producto`)))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_producto`
--

/*!50001 DROP TABLE IF EXISTS `v_producto`*/;
/*!50001 DROP VIEW IF EXISTS `v_producto`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_producto` AS (select `producto`.`id_producto` AS `id_producto`,`producto`.`id_tiporeten` AS `id_tiporeten`,`tiporetencion`.`porcentaje_codRetAir` AS `porcentaje_codRetAir`,`producto`.`id_marca` AS `id_marca`,`producto`.`id_unimedida` AS `id_unimedida`,`producto`.`id_ganancia` AS `id_ganancia`,`ganancia`.`porctj_ganancia` AS `porctj_ganancia`,`producto`.`codbarra_producto` AS `codbarra_producto`,`producto`.`nom_producto` AS `nom_producto`,`producto`.`descrip_producto` AS `descrip_producto`,`producto`.`costo_producto` AS `costo_producto`,`producto`.`pvp1_producto` AS `pvp1_producto`,`producto`.`stock_producto` AS `stock_producto`,`producto`.`stkmin_producto` AS `stkmin_producto`,`producto`.`stkmax_producto` AS `stkmax_producto`,`producto`.`img_producto` AS `img_producto`,`producto`.`fecing_producto` AS `fecing_producto`,`producto`.`fecvenci_producto` AS `fecvenci_producto`,`producto`.`estado_producto` AS `estado_producto` from ((`producto` join `tiporetencion` on((`producto`.`id_tiporeten` = `tiporetencion`.`id_tiporeten`))) join `ganancia` on((`producto`.`id_ganancia` = `ganancia`.`id_ganancia`)))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_producto_proveedor`
--

/*!50001 DROP TABLE IF EXISTS `v_producto_proveedor`*/;
/*!50001 DROP VIEW IF EXISTS `v_producto_proveedor`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_producto_proveedor` AS (select `producto_proveedor`.`id_proveedor` AS `id_proveedor`,`producto_proveedor`.`id_producto` AS `id_producto`,`persona`.`nom_persona` AS `nom_persona`,`persona`.`estado_persona` AS `estado_persona` from (`producto_proveedor` join `persona` on((`producto_proveedor`.`id_proveedor` = `persona`.`id_persona`)))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-04-01  9:27:08
