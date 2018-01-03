-- TABLA PRESUPUESTO
alter table presupuesto add column descto_presupuesto double(10,2) null default 0;

-- STORE PROCEDURE PRESUPUESTO ADD

DROP PROCEDURE `sp_presupuestoinsert`;

DELIMITER $$
CREATE  PROCEDURE `sp_presupuestoinsert`(IN
tid_cliente bigint(20),
tid_vehiculo bigint(20),
tnum_presupuesto bigint(20),
tfecemi_presupuesto varchar(20),
tobs_presupuesto text,
ttotal double(10,2),
testado varchar(2),
tdescrip_vc text,
tid_vozcliente int(10),
tkms_presupuesto decimal(10,0),
tdescto_presupuesto double(10,2)
)
begin
insert into presupuesto(
id_cliente,
id_vehiculo,
num_presupuesto,
fecemi_presupuesto,
observaciones,
total,
estado,
descrip_vc,
id_vozcliente,
kms_presupuesto,
descto_presupuesto)
values (
tid_cliente,
tid_vehiculo,
tnum_presupuesto,
tfecemi_presupuesto,
tobs_presupuesto,
ttotal,
testado,
tdescrip_vc,
tid_vozcliente,
tkms_presupuesto,
tdescto_presupuesto);
SELECT LAST_INSERT_ID();
END
$$

DELIMITER ;


-- STORE PROCEDURE UPDATE PRESUPUESTO

DROP PROCEDURE `sp_presupuestoupdate`;

DELIMITER $$

CREATE PROCEDURE `sp_presupuestoupdate`(IN
tid_presupuesto bigint(20),
tid_cliente bigint(20),
tid_vehiculo bigint(20),
tnum_presupuesto bigint(20),
tfecemi_presupuesto varchar(20),
tobs_presupuesto text,
ttotal double(10,2),
testado varchar(2),
tdescrip_vc text,
tid_vozcliente int(10),
tkms_presupuesto decimal(10,0),
tdescto_presupuesto double(10,2))
begin
update presupuesto set
id_cliente = tid_cliente,
id_vehiculo = tid_vehiculo,
num_presupuesto = tnum_presupuesto,
fecemi_presupuesto= tfecemi_presupuesto,
observaciones = tobs_presupuesto,
total = ttotal,
estado = testado,
descrip_vc = tdescrip_vc,
id_vozcliente = tid_vozcliente,
kms_presupuesto = tkms_presupuesto,
descto_presupuesto = tdescto_presupuesto
where id_presupuesto = tid_presupuesto
;
END
$$

DELIMITER ;

-- vista presupuesto

DROP VIEW v_presupuesto;

CREATE VIEW `v_presupuesto` AS
(
select `o`.`id_presupuesto` AS `id_presupuesto`,`v`.`id_vehiculo` AS `id_vehiculo`,if((`o`.`fecemi_presupuesto` = '0000-00-00'),'',
date_format(`o`.`fecemi_presupuesto`,'%d-%m-%Y')) AS `fecha_emi`,`o`.`total` AS `total`,`o`.`num_presupuesto` AS `numero`,if((`o`.`estado` = 1),'Pendiente',
if((`o`.`estado` = 2),'Vencido',if((`o`.`estado` = 3),'Aceptado','Rechazado'))) AS `estado`,`o`.`observaciones` AS `observacion`,`v`.`dominio` AS `dominio`,
`v`.`marca` AS `marca`,`v`.`modelo` AS `modelo`,`c`.`nom_persona` AS `nom_cliente`,`c`.`id_persona` AS `id_cliente`,`c`.`ape_persona` AS `ape_cliente`,
`o`.`descrip_vc` AS `descrip_vc`,`o`.`id_vozcliente` AS `id_vozcliente`,`o`.`kms_presupuesto` AS `kms_presupuesto` , `o`.`descto_presupuesto` AS `descto_presupuesto`
from ((`presupuesto` `o`
left join `vehiculo` `v` on((`v`.`id_vehiculo` = `o`.`id_vehiculo`)))
left join `persona` `c` on((`c`.`id_persona` = `o`.`id_cliente`))))
