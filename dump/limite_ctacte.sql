-- alter table persona
alter table persona add column limite_ctacte double(10,2) default 0;

-- alter procedure

drop procedure sp_personainsert;

-- create procedure
CREATE PROCEDURE `sp_personainsert`(IN tid_tipoper bigint(20),tid_ciudad bigint(20),tid_sexo bigint(20),tid_civil bigint(20),tnom_persona varchar(50),tape_persona varchar(50),truc_persona varchar(20),tdirec_persona varchar(200),ttelf_persona varchar(32),ttelf_persona_2 varchar(32),tcel_persona varchar(32),temail_persona varchar(40),tweb_persona varchar(40),tobs_persona varchar(200),tfec_persona varchar(20),testado_persona varchar(2),tclave_persona varchar(12), tid_condiva int(2), ttiene_ctacte InT(2), tid_listaprecio double(10,2), tganancia double(10,2), tlimite_ctacte double(10,2))
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
telf_persona_2,
cel_persona,
email_persona,
web_persona,
obs_persona,
fec_persona,
estado_persona,
clave_persona,
id_condiva,
tiene_ctacte,
id_listaprecio,
ganancia,
limite_ctacte)VALUES(
tid_tipoper,
tid_ciudad,
tid_sexo,
tid_civil,
tnom_persona,
tape_persona,
truc_persona,
tdirec_persona,
ttelf_persona,
ttelf_persona_2,
tcel_persona,
temail_persona,
tweb_persona,
tobs_persona,
date(now()),
testado_persona,
tclave_persona,
tid_condiva,
ttiene_ctacte,
tid_listaprecio,
tganancia,
tlimite_ctacte);
SELECT LAST_INSERT_ID();
END

-- procedure update
drop procedure sp_personaupdate;




CREATE  PROCEDURE `sp_personaupdate`(IN tid_persona bigint(20),tid_tipoper bigint(20),tid_ciudad bigint(20),tid_sexo bigint(20),tid_civil bigint(20),tnom_persona varchar(50),tape_persona varchar(50),truc_persona varchar(20),tdirec_persona varchar(200),ttelf_persona varchar(32), ttelf_persona_2 varchar(32),tcel_persona varchar(32),temail_persona varchar(40),tweb_persona varchar(40),tobs_persona varchar(200),tfec_persona varchar(20),testado_persona varchar(2),tclave_persona varchar(12), tid_condiva int(2), ttiene_ctacte int(2), tid_listaprecio double(10,2), tganancia double(10,2), tlimite_ctacte double(10,2))
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
telf_persona_2=ttelf_persona_2,
cel_persona=tcel_persona,
email_persona=temail_persona,
web_persona=tweb_persona,
obs_persona=tobs_persona,
clave_persona=tclave_persona,
id_condiva = tid_condiva,
tiene_ctacte = ttiene_ctacte,
id_listaprecio = tid_listaprecio,
ganancia  = tganancia,
limite_ctacte = tlimite_ctacte
WHERE id_persona=tid_persona;
END
