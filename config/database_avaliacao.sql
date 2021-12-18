CREATE DATABASE avaliacao
default charset utf8
default collate utf8_general_ci;

USE avaliacao;

CREATE TABLE fabricante (
    id integer PRIMARY KEY NOT NULL auto_increment,
    nome text,
    site text
);
INSERT INTO fabricante VALUES(default,'Kingston','www.kingston.com');
INSERT INTO fabricante VALUES(default,'Seagate','www.seagate.com');
INSERT INTO fabricante VALUES(default,'Corsair','www.corsair.com');
INSERT INTO fabricante VALUES(default,'Olimpus','www.olimpus.com');
INSERT INTO fabricante VALUES(default,'Samsung','www.samsung.com');
INSERT INTO fabricante VALUES(default,'Sony','www.sony.com');
INSERT INTO fabricante VALUES(default,'Creative','www.creative.com');
INSERT INTO fabricante VALUES(default,'Intel','www.intel.com');
INSERT INTO fabricante VALUES(default,'HP','www.hp.com');
INSERT INTO fabricante VALUES(default,'Satellite','www.satellite.com');

CREATE TABLE unidade (
    id integer PRIMARY KEY NOT NULL,
    sigla text,
    nome text
);

INSERT INTO unidade VALUES(1,'cm','Centímetro');
INSERT INTO unidade VALUES(2,'m','Metro');
INSERT INTO unidade VALUES(3,'cm2','Centímetro quadrado');
INSERT INTO unidade VALUES(4,'m2','Metro quadrado');
INSERT INTO unidade VALUES(5,'cm3','Centímetro cúbico');
INSERT INTO unidade VALUES(6,'m3','Metro cúbico');
INSERT INTO unidade VALUES(7,'Kg','Kilograma');
INSERT INTO unidade VALUES(8,'Gr','Grama');
INSERT INTO unidade VALUES(9,'L','Litro');
INSERT INTO unidade VALUES(10,'PC','Peça');
INSERT INTO unidade VALUES(11,'PCT','Pacote');
INSERT INTO unidade VALUES(12,'CX','Caixa');
INSERT INTO unidade VALUES(13,'SAC','Saco');
INSERT INTO unidade VALUES(14,'TON','Tonelada');
INSERT INTO unidade VALUES(15,'KIT','Kit');
INSERT INTO unidade VALUES(16,'GL','Galão');
INSERT INTO unidade VALUES(17,'FD','Fardo');
INSERT INTO unidade VALUES(18,'BL','Bloco');
INSERT INTO UNIDADE VALUES('19','UN', 'UNIDADE');

CREATE TABLE tipo (
    id integer PRIMARY KEY NOT NULL,
    nome text
);

INSERT INTO tipo VALUES(1,'Máquina');
INSERT INTO tipo VALUES(2,'Acessório');
INSERT INTO tipo VALUES(3,'Insumo');
INSERT INTO tipo VALUES(4,'Componente');
INSERT INTO tipo VALUES(5,'Suprimento');

CREATE TABLE produto (
    id integer PRIMARY KEY NOT NULL auto_increment,
    descricao text,
    estoque float,
    preco_custo float,
    preco_venda float,
    id_fabricante integer,
    id_unidade integer,
    id_tipo integer,
    
    CONSTRAINT `fk_fabricante` FOREIGN KEY ( `id_fabricante`) REFERENCES `fabricante` (`id`),
    CONSTRAINT `fk_unidade` FOREIGN KEY ( `id_unidade`) REFERENCES `unidade` (`id`),
    CONSTRAINT `fk_tipo` FOREIGN KEY ( `id_tipo`) REFERENCES `tipo` (`id`));
    
INSERT INTO produto VALUES(default,'Pendrive 512Mb',10.0,20.0,40.0,1,10,2);
INSERT INTO produto VALUES(default,'HD 120 GB',20.0,100.0,180.0,2,10,4);
INSERT INTO produto VALUES(default,'SD CARD  512MB',4.0,20.0,35.0,3,10,2);
INSERT INTO produto VALUES(default,'SD CARD 1GB MINI',3.0,28.0,40.0,1,10,2);
INSERT INTO produto VALUES(default,'CAM. FOTO I70 PLATA',5.0,600.0,900.0,5,10,1);
INSERT INTO produto VALUES(default,'CAM. FOTO DSC-W50 PLATA',4.0,400.0,700.0,6,10,1);
INSERT INTO produto VALUES(default,'WEBCAM INSTANT VF0040SP',4.0,50.0,80.0,7,10,1);
INSERT INTO produto VALUES(default,'CPU 775 CEL.D 360  3.46 512K 533M',10.0,140.0,300.0,8,10,4);
INSERT INTO produto VALUES(default,'FILMADORA DCR-DVD108',2.0,900.0,1400.0,6,10,1);
INSERT INTO produto VALUES(default,'HD IDE  80G 7.200',8.0,90.0,160.0,5,10,4);
INSERT INTO produto VALUES(default,'IMP LASERJET 1018 USB 2.0',4.0,200.0,300.0,9,10,1);
INSERT INTO produto VALUES(default,'MEM DDR  512MB 400MHZ PC3200',10.0,60.0,100.0,5,10,4);
INSERT INTO produto VALUES(default,'MEM DDR2 1024MB 533MHZ PC4200',5.0,100.0,170.0,3,10,4);
INSERT INTO produto VALUES(default,'MON LCD 19 920N PRETO',2.0,500.0,800.0,5,10,4);
INSERT INTO produto VALUES(default,'MOUSE USB OMC90S OPT.C/LUZ',10.0,20.0,40.0,5,10,2);
INSERT INTO produto VALUES(default,'NB DV6108 CS 1.86/512/80/DVD+RW ',2.0,1400.0,2500.0,9,10,1);
INSERT INTO produto VALUES(default,'NB N220E/B DC 1.6/1/80/DVD+RW ',3.0,1800.0,3400.0,6,10,1);
INSERT INTO produto VALUES(default,'CAM. FOTO DSC-W90 PLATA',5.0,600.0,1200.0,6,10,1);
INSERT INTO produto VALUES(default,'CART. 8767 NEGRO',20.0,30.0,50.0,9,10,3);
INSERT INTO produto VALUES(default,'CD-R TUBO DE 100 52X 700MB',20.0,30.0,60.0,5,10,5);
INSERT INTO produto VALUES(default,'MEM DDR 1024MB 400MHZ PC3200',7.0,80.0,150.0,1,10,4);
INSERT INTO produto VALUES(default,'MOUSE PS2 A7 AZUL/PLATA',20.0,5.0,15.0,10,10,2);
INSERT INTO produto VALUES(default, 'SPEAKER AS-5100 HOME PRATA',5.0,100.0,180.0,10,10,2);
INSERT INTO produto VALUES(default, 'TEC. USB ABNT AK-806',14.0,20.0,40.0,10,10,2);