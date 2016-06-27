CREATE TABLE region(
    codigo INT PRIMARY KEY, 
    nombre VARCHAR(50) NOT NULL 
);

CREATE TABLE provincia(
    codigo INT PRIMARY KEY, 
    nombre VARCHAR(30) NOT NULL, 
    region INT, 
    CONSTRAINT FK_REGION FOREIGN KEY (region) REFERENCES region(codigo)
);

CREATE TABLE comuna(
    codigo INT PRIMARY KEY, 
    nombre VARCHAR(30) NOT NULL, 
    provincia INT, 
    CONSTRAINT FK_PROVINCIA FOREIGN KEY (provincia) REFERENCES provincia(codigo)
);

CREATE TABLE usuario(
    rut INT PRIMARY KEY,  
    nombre VARCHAR(50) NOT NULL,
    apellido_paterno  VARCHAR(50) NOT NULL,
    apellido_materno  VARCHAR(50) NOT NULL,
    clave VARCHAR(60) NOT NULL, 
    email VARCHAR(300) NOT NULL, 
    fecha_nacimiento DATE NOT NULL,
    sexo TINYINT NOT NULL DEFAULT 0,
    comuna INT NOT NULL,
    perfil VARCHAR(10) NOT NULL,
    CONSTRAINT FK_COMUNA_USUARIO FOREIGN KEY(comuna) REFERENCES comuna(codigo)
);

CREATE TABLE evento (
    id INT AUTO_INCREMENT PRIMARY KEY, 
    nombre VARCHAR(50) NOT NULL, 
    fecha DATE NOT NULL,
    hora TIME NOT NULL,
    lugar VARCHAR(300) NOT NULL,
    comuna INT NOT NULL,
    cupos INT NOT NULL,
    CONSTRAINT FK_COMUNA_EVENTO FOREIGN KEY(comuna) REFERENCES comuna(codigo)
);

CREATE TABLE participante ( 
    id_evento INT NOT NULL,
    rut_participante INT NOT NULL,  
    nombre VARCHAR(50) NOT NULL,
    apellido_paterno  VARCHAR(50) NOT NULL,
    apellido_materno  VARCHAR(50),
    email VARCHAR(300) NOT NULL, 
    telefono VARCHAR(20),
    fecha_nacimiento DATE NOT NULL,
    sexo TINYINT NOT NULL DEFAULT 0,    
    CONSTRAINT PK_PARTICIPANTE PRIMARY KEY(rut_participante, id_evento),
    CONSTRAINT FK_ID_EVENTO  FOREIGN KEY(id_evento) REFERENCES evento(id)
);

INSERT INTO region VALUES(15,'Región de Arica y Parinacota');
INSERT INTO region VALUES(01,'Región de Tarapacá');
INSERT INTO region VALUES(02,'Región de Antofagasta');
INSERT INTO region VALUES(03,'Región de Atacama');
INSERT INTO region VALUES(04,'Región de Coquimbo');
INSERT INTO region VALUES(05,'Región de Valparaíso');
INSERT INTO region VALUES(06,'Región del Libertador Gral. Bernardo O’Higgins');
INSERT INTO region VALUES(07,'Región del Maule');
INSERT INTO region VALUES(08,'Región del Biobío');
INSERT INTO region VALUES(09,'Región de La Araucanía');
INSERT INTO region VALUES(14,'Región de Los Ríos');
INSERT INTO region VALUES(10,'Región de Los Lagos');
INSERT INTO region VALUES(11,'Región de Aysén del Gral. Carlos Ibáñez del Campo');
INSERT INTO region VALUES(12,'Región de Magallanes y de la Antártica Chilena');
INSERT INTO region VALUES(13,'Región Metropolitana de Santiago');

INSERT INTO provincia VALUES(151,'Arica',15);
INSERT INTO provincia VALUES(152,'Parinacota',15);
INSERT INTO provincia VALUES(011,'Iquique',01);
INSERT INTO provincia VALUES(014,'Tamarugal',01);
INSERT INTO provincia VALUES(021,'Antofagasta',02);
INSERT INTO provincia VALUES(022,'El Loa',02);
INSERT INTO provincia VALUES(023,'Tocopilla',02);
INSERT INTO provincia VALUES(031,'Copiapó',03);
INSERT INTO provincia VALUES(032,'Chañaral',03);
INSERT INTO provincia VALUES(033,'Huasco',03);
INSERT INTO provincia VALUES(041,'Elqui',04);
INSERT INTO provincia VALUES(042,'Choapa',04);
INSERT INTO provincia VALUES(043,'Limarí',04);
INSERT INTO provincia VALUES(051,'Valparaíso',05);
INSERT INTO provincia VALUES(052,'Isla de Pascua',05);
INSERT INTO provincia VALUES(053,'Los Andes',05);
INSERT INTO provincia VALUES(054,'Petorca',05);
INSERT INTO provincia VALUES(055,'Quillota',05);
INSERT INTO provincia VALUES(056,'San Antonio',05);
INSERT INTO provincia VALUES(057,'San Felipe de Aconcagua',05);
INSERT INTO provincia VALUES(058,'Marga Marga',05);
INSERT INTO provincia VALUES(061,'Cachapoal',06);
INSERT INTO provincia VALUES(062,'Cardenal Caro',06);
INSERT INTO provincia VALUES(063,'Colchagua',06);
INSERT INTO provincia VALUES(071,'Talca',07);
INSERT INTO provincia VALUES(072,'Cauquenes',07);
INSERT INTO provincia VALUES(073,'Curicó',07);
INSERT INTO provincia VALUES(074,'Linares',07);
INSERT INTO provincia VALUES(081,'Concepción',08);
INSERT INTO provincia VALUES(082,'Arauco',08);
INSERT INTO provincia VALUES(083,'Biobío',08);
INSERT INTO provincia VALUES(084,'Ñuble',08);
INSERT INTO provincia VALUES(091,'Cautín',09);
INSERT INTO provincia VALUES(092,'Malleco',09);
INSERT INTO provincia VALUES(141,'Valdivia',14);
INSERT INTO provincia VALUES(142,'Ranco',14);
INSERT INTO provincia VALUES(101,'Llanquihue',10);
INSERT INTO provincia VALUES(102,'Chiloé',10);
INSERT INTO provincia VALUES(103,'Osorno',10);
INSERT INTO provincia VALUES(104,'Palena',10);
INSERT INTO provincia VALUES(111,'Coyhaique',11);
INSERT INTO provincia VALUES(112,'Aysén',11);
INSERT INTO provincia VALUES(113,'Capitán Prat',11);
INSERT INTO provincia VALUES(114,'General Carrera',11);
INSERT INTO provincia VALUES(121,'Magallanes',12);
INSERT INTO provincia VALUES(122,'Antártica Chilena',12);
INSERT INTO provincia VALUES(123,'Tierra del Fuego',12);
INSERT INTO provincia VALUES(124,'Última Esperanza',12);
INSERT INTO provincia VALUES(131,'Santiago',13);
INSERT INTO provincia VALUES(132,'Cordillera',13);
INSERT INTO provincia VALUES(133,'Chacabuco',13);
INSERT INTO provincia VALUES(134,'Maipo',13);
INSERT INTO provincia VALUES(135,'Melipilla',13);
INSERT INTO provincia VALUES(136,'Talagante',13);

INSERT INTO comuna VALUES(15101,'Arica',151);
INSERT INTO comuna VALUES(15102,'Camarones',151);
INSERT INTO comuna VALUES(15201,'Putre',152);
INSERT INTO comuna VALUES(15202,'General Lagos',152);
INSERT INTO comuna VALUES(01101,'Iquique',011);
INSERT INTO comuna VALUES(01107,'Alto Hospicio',011);
INSERT INTO comuna VALUES(01401,'Pozo Almonte',014);
INSERT INTO comuna VALUES(01402,'Camiña',014);
INSERT INTO comuna VALUES(01403,'Colchane',014);
INSERT INTO comuna VALUES(01404,'Huara',014);
INSERT INTO comuna VALUES(01405,'Pica',014);
INSERT INTO comuna VALUES(02101,'Antofagasta',021);
INSERT INTO comuna VALUES(02102,'Mejillones',021);
INSERT INTO comuna VALUES(02103,'Sierra Gorda',021);
INSERT INTO comuna VALUES(02104,'Taltal',021);
INSERT INTO comuna VALUES(02201,'Calama',022);
INSERT INTO comuna VALUES(02202,'Ollagüe',022);
INSERT INTO comuna VALUES(02203,'San Pedro de Atacama',022);
INSERT INTO comuna VALUES(02301,'Tocopilla',023);
INSERT INTO comuna VALUES(02302,'María Elena',023);
INSERT INTO comuna VALUES(03101,'Copiapó',031);
INSERT INTO comuna VALUES(03102,'Caldera',031);
INSERT INTO comuna VALUES(03103,'Tierra Amarilla',031);
INSERT INTO comuna VALUES(03201,'Chañaral',032);
INSERT INTO comuna VALUES(03202,'Diego de Almagro',032);
INSERT INTO comuna VALUES(03301,'Vallenar',033);
INSERT INTO comuna VALUES(03302,'Alto del Carmen',033);
INSERT INTO comuna VALUES(03303,'Freirina',033);
INSERT INTO comuna VALUES(03304,'Huasco',033);
INSERT INTO comuna VALUES(04101,'La Serena',041);
INSERT INTO comuna VALUES(04102,'Coquimbo',041);
INSERT INTO comuna VALUES(04103,'Andacollo',041);
INSERT INTO comuna VALUES(04104,'La Higuera',041);
INSERT INTO comuna VALUES(04105,'Paiguano',041);
INSERT INTO comuna VALUES(04106,'Vicuña',041);
INSERT INTO comuna VALUES(04201,'Illapel',042);
INSERT INTO comuna VALUES(04202,'Canela',042);
INSERT INTO comuna VALUES(04203,'Los Vilos',042);
INSERT INTO comuna VALUES(04204,'Salamanca',042);
INSERT INTO comuna VALUES(04301,'Ovalle',043);
INSERT INTO comuna VALUES(04302,'Combarbalá',043);
INSERT INTO comuna VALUES(04303,'Monte Patria',043);
INSERT INTO comuna VALUES(04304,'Punitaqui',043);
INSERT INTO comuna VALUES(04305,'Río Hurtado',043);
INSERT INTO comuna VALUES(05101,'Valparaíso',051);
INSERT INTO comuna VALUES(05102,'Casablanca',051);
INSERT INTO comuna VALUES(05103,'Concón',051);
INSERT INTO comuna VALUES(05104,'Juan Fernández',051);
INSERT INTO comuna VALUES(05105,'Puchuncaví',051);
INSERT INTO comuna VALUES(05801,'Quilpué',058);
INSERT INTO comuna VALUES(05107,'Quintero',051);
INSERT INTO comuna VALUES(05804,'Villa Alemana',058);
INSERT INTO comuna VALUES(05109,'Viña del Mar',051);
INSERT INTO comuna VALUES(05201,'Isla de Pascua',052);
INSERT INTO comuna VALUES(05301,'Los Andes',053);
INSERT INTO comuna VALUES(05302,'Calle Larga',053);
INSERT INTO comuna VALUES(05303,'Rinconada',053);
INSERT INTO comuna VALUES(05304,'San Esteban',053);
INSERT INTO comuna VALUES(05401,'La Ligua',054);
INSERT INTO comuna VALUES(05402,'Cabildo',054);
INSERT INTO comuna VALUES(05403,'Papudo',054);
INSERT INTO comuna VALUES(05404,'Petorca',054);
INSERT INTO comuna VALUES(05405,'Zapallar',054);
INSERT INTO comuna VALUES(05501,'Quillota',055);
INSERT INTO comuna VALUES(05502,'Calera',055);
INSERT INTO comuna VALUES(05503,'Hijuelas',055);
INSERT INTO comuna VALUES(05504,'La Cruz',055);
INSERT INTO comuna VALUES(05802,'Limache',058);
INSERT INTO comuna VALUES(05506,'Nogales',055);
INSERT INTO comuna VALUES(05803,'Olmué',058);
INSERT INTO comuna VALUES(05601,'San Antonio',056);
INSERT INTO comuna VALUES(05602,'Algarrobo',056);
INSERT INTO comuna VALUES(05603,'Cartagena',056);
INSERT INTO comuna VALUES(05604,'El Quisco',056);
INSERT INTO comuna VALUES(05605,'El Tabo',056);
INSERT INTO comuna VALUES(05606,'Santo Domingo',056);
INSERT INTO comuna VALUES(05701,'San Felipe',057);
INSERT INTO comuna VALUES(05702,'Catemu',057);
INSERT INTO comuna VALUES(05703,'Llaillay',057);
INSERT INTO comuna VALUES(05704,'Panquehue',057);
INSERT INTO comuna VALUES(05705,'Putaendo',057);
INSERT INTO comuna VALUES(05706,'Santa María',057);
INSERT INTO comuna VALUES(06101,'Rancagua',061);
INSERT INTO comuna VALUES(06102,'Codegua',061);
INSERT INTO comuna VALUES(06103,'Coinco',061);
INSERT INTO comuna VALUES(06104,'Coltauco',061);
INSERT INTO comuna VALUES(06105,'Doñihue',061);
INSERT INTO comuna VALUES(06106,'Graneros',061);
INSERT INTO comuna VALUES(06107,'Las Cabras',061);
INSERT INTO comuna VALUES(06108,'Machalí',061);
INSERT INTO comuna VALUES(06109,'Malloa',061);
INSERT INTO comuna VALUES(06110,'Mostazal',061);
INSERT INTO comuna VALUES(06111,'Olivar',061);
INSERT INTO comuna VALUES(06112,'Peumo',061);
INSERT INTO comuna VALUES(06113,'Pichidegua',061);
INSERT INTO comuna VALUES(06114,'Quinta de Tilcoco',061);
INSERT INTO comuna VALUES(06115,'Rengo',061);
INSERT INTO comuna VALUES(06116,'Requínoa',061);
INSERT INTO comuna VALUES(06117,'San Vicente',061);
INSERT INTO comuna VALUES(06201,'Pichilemu',062);
INSERT INTO comuna VALUES(06202,'La Estrella',062);
INSERT INTO comuna VALUES(06203,'Litueche',062);
INSERT INTO comuna VALUES(06204,'Marchihue',062);
INSERT INTO comuna VALUES(06205,'Navidad',062);
INSERT INTO comuna VALUES(06206,'Paredones',062);
INSERT INTO comuna VALUES(06301,'San Fernando',063);
INSERT INTO comuna VALUES(06302,'Chépica',063);
INSERT INTO comuna VALUES(06303,'Chimbarongo',063);
INSERT INTO comuna VALUES(06304,'Lolol',063);
INSERT INTO comuna VALUES(06305,'Nancagua',063);
INSERT INTO comuna VALUES(06306,'Palmilla',063);
INSERT INTO comuna VALUES(06307,'Peralillo',063);
INSERT INTO comuna VALUES(06308,'Placilla',063);
INSERT INTO comuna VALUES(06309,'Pumanque',063);
INSERT INTO comuna VALUES(06310,'Santa Cruz',063);
INSERT INTO comuna VALUES(07101,'Talca',071);
INSERT INTO comuna VALUES(07102,'Constitución',071);
INSERT INTO comuna VALUES(07103,'Curepto',071);
INSERT INTO comuna VALUES(07104,'Empedrado',071);
INSERT INTO comuna VALUES(07105,'Maule',071);
INSERT INTO comuna VALUES(07106,'Pelarco',071);
INSERT INTO comuna VALUES(07107,'Pencahue',071);
INSERT INTO comuna VALUES(07108,'Río Claro',071);
INSERT INTO comuna VALUES(07109,'San Clemente',071);
INSERT INTO comuna VALUES(07110,'San Rafael',071);
INSERT INTO comuna VALUES(07201,'Cauquenes',072);
INSERT INTO comuna VALUES(07202,'Chanco',072);
INSERT INTO comuna VALUES(07203,'Pelluhue',072);
INSERT INTO comuna VALUES(07301,'Curicó',073);
INSERT INTO comuna VALUES(07302,'Hualañé',073);
INSERT INTO comuna VALUES(07303,'Licantén',073);
INSERT INTO comuna VALUES(07304,'Molina',073);
INSERT INTO comuna VALUES(07305,'Rauco',073);
INSERT INTO comuna VALUES(07306,'Romeral',073);
INSERT INTO comuna VALUES(07307,'Sagrada Familia',073);
INSERT INTO comuna VALUES(07308,'Teno',073);
INSERT INTO comuna VALUES(07309,'Vichuquén',073);
INSERT INTO comuna VALUES(07401,'Linares',074);
INSERT INTO comuna VALUES(07402,'Colbún',074);
INSERT INTO comuna VALUES(07403,'Longaví',074);
INSERT INTO comuna VALUES(07404,'Parral',074);
INSERT INTO comuna VALUES(07405,'Retiro',074);
INSERT INTO comuna VALUES(07406,'San Javier',074);
INSERT INTO comuna VALUES(07407,'Villa Alegre',074);
INSERT INTO comuna VALUES(07408,'Yerbas Buenas',074);
INSERT INTO comuna VALUES(08101,'Concepción',081);
INSERT INTO comuna VALUES(08102,'Coronel',081);
INSERT INTO comuna VALUES(08103,'Chiguayante',081);
INSERT INTO comuna VALUES(08104,'Florida',081);
INSERT INTO comuna VALUES(08105,'Hualqui',081);
INSERT INTO comuna VALUES(08106,'Lota',081);
INSERT INTO comuna VALUES(08107,'Penco',081);
INSERT INTO comuna VALUES(08108,'San Pedro de la Paz',081);
INSERT INTO comuna VALUES(08109,'Santa Juana',081);
INSERT INTO comuna VALUES(08110,'Talcahuano',081);
INSERT INTO comuna VALUES(08111,'Tomé',081);
INSERT INTO comuna VALUES(08112,'Hualpén',081);
INSERT INTO comuna VALUES(08201,'Lebu',082);
INSERT INTO comuna VALUES(08202,'Arauco',082);
INSERT INTO comuna VALUES(08203,'Cañete',082);
INSERT INTO comuna VALUES(08204,'Contulmo',082);
INSERT INTO comuna VALUES(08205,'Curanilahue',082);
INSERT INTO comuna VALUES(08206,'Los Álamos',082);
INSERT INTO comuna VALUES(08207,'Tirúa',082);
INSERT INTO comuna VALUES(08301,'Los Ángeles',083);
INSERT INTO comuna VALUES(08302,'Antuco',083);
INSERT INTO comuna VALUES(08303,'Cabrero',083);
INSERT INTO comuna VALUES(08304,'Laja',083);
INSERT INTO comuna VALUES(08305,'Mulchén',083);
INSERT INTO comuna VALUES(08306,'Nacimiento',083);
INSERT INTO comuna VALUES(08307,'Negrete',083);
INSERT INTO comuna VALUES(08308,'Quilaco',083);
INSERT INTO comuna VALUES(08309,'Quilleco',083);
INSERT INTO comuna VALUES(08310,'San Rosendo',083);
INSERT INTO comuna VALUES(08311,'Santa Bárbara',083);
INSERT INTO comuna VALUES(08312,'Tucapel',083);
INSERT INTO comuna VALUES(08313,'Yumbel',083);
INSERT INTO comuna VALUES(08314,'Alto Biobío',083);
INSERT INTO comuna VALUES(08401,'Chillán',084);
INSERT INTO comuna VALUES(08402,'Bulnes',084);
INSERT INTO comuna VALUES(08403,'Cobquecura',084);
INSERT INTO comuna VALUES(08404,'Coelemu',084);
INSERT INTO comuna VALUES(08405,'Coihueco',084);
INSERT INTO comuna VALUES(08406,'Chillán Viejo',084);
INSERT INTO comuna VALUES(08407,'El Carmen',084);
INSERT INTO comuna VALUES(08408,'Ninhue',084);
INSERT INTO comuna VALUES(08409,'Ñiquén',084);
INSERT INTO comuna VALUES(08410,'Pemuco',084);
INSERT INTO comuna VALUES(08411,'Pinto',084);
INSERT INTO comuna VALUES(08412,'Portezuelo',084);
INSERT INTO comuna VALUES(08413,'Quillón',084);
INSERT INTO comuna VALUES(08414,'Quirihue',084);
INSERT INTO comuna VALUES(08415,'Ránquil',084);
INSERT INTO comuna VALUES(08416,'San Carlos',084);
INSERT INTO comuna VALUES(08417,'San Fabián',084);
INSERT INTO comuna VALUES(08418,'San Ignacio',084);
INSERT INTO comuna VALUES(08419,'San Nicolás',084);
INSERT INTO comuna VALUES(08420,'Treguaco',084);
INSERT INTO comuna VALUES(08421,'Yungay',084);
INSERT INTO comuna VALUES(09101,'Temuco',091);
INSERT INTO comuna VALUES(09102,'Carahue',091);
INSERT INTO comuna VALUES(09103,'Cunco',091);
INSERT INTO comuna VALUES(09104,'Curarrehue',091);
INSERT INTO comuna VALUES(09105,'Freire',091);
INSERT INTO comuna VALUES(09106,'Galvarino',091);
INSERT INTO comuna VALUES(09107,'Gorbea',091);
INSERT INTO comuna VALUES(09108,'Lautaro',091);
INSERT INTO comuna VALUES(09109,'Loncoche',091);
INSERT INTO comuna VALUES(09110,'Melipeuco',091);
INSERT INTO comuna VALUES(09111,'Nueva Imperial',091);
INSERT INTO comuna VALUES(09112,'Padre Las Casas',091);
INSERT INTO comuna VALUES(09113,'Perquenco',091);
INSERT INTO comuna VALUES(09114,'Pitrufquén',091);
INSERT INTO comuna VALUES(09115,'Pucón',091);
INSERT INTO comuna VALUES(09116,'Saavedra',091);
INSERT INTO comuna VALUES(09117,'Teodoro Schmidt',091);
INSERT INTO comuna VALUES(09118,'Toltén',091);
INSERT INTO comuna VALUES(09119,'Vilcún',091);
INSERT INTO comuna VALUES(09120,'Villarrica',091);
INSERT INTO comuna VALUES(09121,'Cholchol',091);
INSERT INTO comuna VALUES(09201,'Angol',092);
INSERT INTO comuna VALUES(09202,'Collipulli',092);
INSERT INTO comuna VALUES(09203,'Curacautín',092);
INSERT INTO comuna VALUES(09204,'Ercilla',092);
INSERT INTO comuna VALUES(09205,'Lonquimay',092);
INSERT INTO comuna VALUES(09206,'Los Sauces',092);
INSERT INTO comuna VALUES(09207,'Lumaco',092);
INSERT INTO comuna VALUES(09208,'Purén',092);
INSERT INTO comuna VALUES(09209,'Renaico',092);
INSERT INTO comuna VALUES(09210,'Traiguén',092);
INSERT INTO comuna VALUES(09211,'Victoria',092);
INSERT INTO comuna VALUES(14101,'Valdivia',141);
INSERT INTO comuna VALUES(14102,'Corral',141);
INSERT INTO comuna VALUES(14103,'Lanco',141);
INSERT INTO comuna VALUES(14104,'Los Lagos',141);
INSERT INTO comuna VALUES(14105,'Máfil',141);
INSERT INTO comuna VALUES(14106,'Mariquina',141);
INSERT INTO comuna VALUES(14107,'Paillaco',141);
INSERT INTO comuna VALUES(14108,'Panguipulli',141);
INSERT INTO comuna VALUES(14201,'La Unión',142);
INSERT INTO comuna VALUES(14202,'Futrono',142);
INSERT INTO comuna VALUES(14203,'Lago Ranco',142);
INSERT INTO comuna VALUES(14204,'Río Bueno',142);
INSERT INTO comuna VALUES(10101,'Puerto Montt',101);
INSERT INTO comuna VALUES(10102,'Calbuco',101);
INSERT INTO comuna VALUES(10103,'Cochamó',101);
INSERT INTO comuna VALUES(10104,'Fresia',101);
INSERT INTO comuna VALUES(10105,'Frutillar',101);
INSERT INTO comuna VALUES(10106,'Los Muermos',101);
INSERT INTO comuna VALUES(10107,'Llanquihue',101);
INSERT INTO comuna VALUES(10108,'Maullín',101);
INSERT INTO comuna VALUES(10109,'Puerto Varas',101);
INSERT INTO comuna VALUES(10201,'Castro',102);
INSERT INTO comuna VALUES(10202,'Ancud',102);
INSERT INTO comuna VALUES(10203,'Chonchi',102);
INSERT INTO comuna VALUES(10204,'Curaco de Vélez',102);
INSERT INTO comuna VALUES(10205,'Dalcahue',102);
INSERT INTO comuna VALUES(10206,'Puqueldón',102);
INSERT INTO comuna VALUES(10207,'Queilén',102);
INSERT INTO comuna VALUES(10208,'Quellón',102);
INSERT INTO comuna VALUES(10209,'Quemchi',102);
INSERT INTO comuna VALUES(10210,'Quinchao',102);
INSERT INTO comuna VALUES(10301,'Osorno',103);
INSERT INTO comuna VALUES(10302,'Puerto Octay',103);
INSERT INTO comuna VALUES(10303,'Purranque',103);
INSERT INTO comuna VALUES(10304,'Puyehue',103);
INSERT INTO comuna VALUES(10305,'Río Negro',103);
INSERT INTO comuna VALUES(10306,'San Juan de la Costa',103);
INSERT INTO comuna VALUES(10307,'San Pablo',103);
INSERT INTO comuna VALUES(10401,'Chaitén',104);
INSERT INTO comuna VALUES(10402,'Futaleufú',104);
INSERT INTO comuna VALUES(10403,'Hualaihué',104);
INSERT INTO comuna VALUES(10404,'Palena',104);
INSERT INTO comuna VALUES(11101,'Coyhaique',111);
INSERT INTO comuna VALUES(11102,'Lago Verde',111);
INSERT INTO comuna VALUES(11201,'Aysén',112);
INSERT INTO comuna VALUES(11202,'Cisnes',112);
INSERT INTO comuna VALUES(11203,'Guaitecas',112);
INSERT INTO comuna VALUES(11301,'Cochrane',113);
INSERT INTO comuna VALUES(11302,'O’Higgins',113);
INSERT INTO comuna VALUES(11303,'Tortel',113);
INSERT INTO comuna VALUES(11401,'Chile Chico',114);
INSERT INTO comuna VALUES(11402,'Río Ibáñez',114);
INSERT INTO comuna VALUES(12101,'Punta Arenas',121);
INSERT INTO comuna VALUES(12102,'Laguna Blanca',121);
INSERT INTO comuna VALUES(12103,'Río Verde',121);
INSERT INTO comuna VALUES(12104,'San Gregorio',121);
INSERT INTO comuna VALUES(12201,'Cabo de Hornos (Ex - Navarino)',122);
INSERT INTO comuna VALUES(12202,'Antártica',122);
INSERT INTO comuna VALUES(12301,'Porvenir',123);
INSERT INTO comuna VALUES(12302,'Primavera',123);
INSERT INTO comuna VALUES(12303,'Timaukel',123);
INSERT INTO comuna VALUES(12401,'Natales',124);
INSERT INTO comuna VALUES(12402,'Torres del Paine',124);
INSERT INTO comuna VALUES(13101,'Santiago',131);
INSERT INTO comuna VALUES(13102,'Cerrillos',131);
INSERT INTO comuna VALUES(13103,'Cerro Navia',131);
INSERT INTO comuna VALUES(13104,'Conchalí',131);
INSERT INTO comuna VALUES(13105,'El Bosque',131);
INSERT INTO comuna VALUES(13106,'Estación Central',131);
INSERT INTO comuna VALUES(13107,'Huechuraba',131);
INSERT INTO comuna VALUES(13108,'Independencia',131);
INSERT INTO comuna VALUES(13109,'La Cisterna',131);
INSERT INTO comuna VALUES(13110,'La Florida',131);
INSERT INTO comuna VALUES(13111,'La Granja',131);
INSERT INTO comuna VALUES(13112,'La Pintana',131);
INSERT INTO comuna VALUES(13113,'La Reina',131);
INSERT INTO comuna VALUES(13114,'Las Condes',131);
INSERT INTO comuna VALUES(13115,'Lo Barnechea',131);
INSERT INTO comuna VALUES(13116,'Lo Espejo',131);
INSERT INTO comuna VALUES(13117,'Lo Prado',131);
INSERT INTO comuna VALUES(13118,'Macul',131);
INSERT INTO comuna VALUES(13119,'Maipú',131);
INSERT INTO comuna VALUES(13120,'Ñuñoa',131);
INSERT INTO comuna VALUES(13121,'Pedro Aguirre Cerda',131);
INSERT INTO comuna VALUES(13122,'Peñalolén',131);
INSERT INTO comuna VALUES(13123,'Providencia',131);
INSERT INTO comuna VALUES(13124,'Pudahuel',131);
INSERT INTO comuna VALUES(13125,'Quilicura',131);
INSERT INTO comuna VALUES(13126,'Quinta Normal',131);
INSERT INTO comuna VALUES(13127,'Recoleta',131);
INSERT INTO comuna VALUES(13128,'Renca',131);
INSERT INTO comuna VALUES(13129,'San Joaquín',131);
INSERT INTO comuna VALUES(13130,'San Miguel',131);
INSERT INTO comuna VALUES(13131,'San Ramón',131);
INSERT INTO comuna VALUES(13132,'Vitacura',131);
INSERT INTO comuna VALUES(13201,'Puente Alto',132);
INSERT INTO comuna VALUES(13202,'Pirque',132);
INSERT INTO comuna VALUES(13203,'San José de Maipo',132);
INSERT INTO comuna VALUES(13301,'Colina',133);
INSERT INTO comuna VALUES(13302,'Lampa ',133);
INSERT INTO comuna VALUES(13303,'Tiltil',133);
INSERT INTO comuna VALUES(13401,'San Bernardo',134);
INSERT INTO comuna VALUES(13402,'Buin',134);
INSERT INTO comuna VALUES(13403,'Calera de Tango',134);
INSERT INTO comuna VALUES(13404,'Paine',134);
INSERT INTO comuna VALUES(13501,'Melipilla',135);
INSERT INTO comuna VALUES(13502,'Alhué',135);
INSERT INTO comuna VALUES(13503,'Curacaví',135);
INSERT INTO comuna VALUES(13504,'María Pinto',135);
INSERT INTO comuna VALUES(13505,'San Pedro',135);
INSERT INTO comuna VALUES(13601,'Talagante',136);
INSERT INTO comuna VALUES(13602,'El Monte',136);
INSERT INTO comuna VALUES(13603,'Isla de Maipo',136);
INSERT INTO comuna VALUES(13604,'Padre Hurtado',136);
INSERT INTO comuna VALUES(13605,'Peñaflor',136);