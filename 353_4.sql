INSERT INTO Address (civicNumber, street, city, province, country, postalCode)
VALUES (855, 'Rocky Cape', 'Rockland', 'Prince Edward Island', 'Canada', 'C2C-7M5'), (6231, 'Easy Meadow', 'Seascape', 'Prince Edward Island', 'Canada', 'C3V-5V9'), (874, 'Harvest Apple Vista', 'Winter Beach', 'Saskatchewan', 'Canada', 'S8X-2S9'
	), (3720, 'Burning Hollow', 'Neely', 'Alberta', 'Canada', 'T8G-3K8'), (7674, 'Hidden Robin Route', 'Mott', 'Prince Edward Island', 'Canada', 'C9T-3A4'), (2245, 'Gentle Timber Mount', 'Cocalico House', 'Saskatchewan', 'Canada', 'S4M-2R9'
	), (1152, 'Dusty Path', 'Bramblewood', 'Yukon', 'Y0N-0H3', 'Canada', 'CA'), (5863, 'Cotton Nectar Farms', 'Catchall', 'Quebec', 'Canada', 'J7I-3H3'), (960, 'Sunny Terrace', 'Piper', 'Quebec', 'Canada', 'G8Q-4K4'
	), (8768, 'Misty View', 'Thornbrook', 'Britsh Columbia', 'Canada', 'V7Q-5A6'), (3692, 'Noble Point', 'Pennsville', 'Nunavut', 'Canada', 'X7X-9U7'), (8158, 'Jagged Pines', 'Calvary', 'Manitoba', 'Canada', 'R9K-9M8'
	), (3722, 'Lazy Green', 'Mcnary', 'Ontario', 'Canada', 'M8D-9H3'), (7534, 'Umber Turnabout', 'New Sharon', 'Manitoba', 'Canada', 'R7V-4W7'), (6546, 'Lost Brook Avenue', 'Bruner Crossing', 'New Brunswick', 'Canada', 'E9W-0B1'
	), (937, 'Pleasant Cloud Glen', 'Bondsville', 'Quebec', 'Canada', 'G2R-6J2'), (1753, 'Middle Abbey', 'Rosemont', 'Nova Scotia', 'Canada', 'B2W-6K6'), (5159, 'Iron Horse Circle', 'Glen', 'Nova Scotia', 'Canada', 'B9Q-1R5'
	), (2187, 'Silent Dale Manor', 'Big Pine', 'Quebec', 'Canada', 'G4Y-0X2'), (532, 'Round Hickory End', 'Smithfield', 'New Brunswick', 'Canada', 'E2Q-0L3');

INSERT INTO Assigned (taskId, employeeSin, hours)
VALUES (1, 789172194, 45), (2, 731111008, 59), (3, 816246358, 28), (4, 719071995, 44), (5, 238418911, 57), (6, 537611024, 51), (7, 520323339, 64), (8, 212023980, 12), (9, 212724661, 19
	), (10, 278466928, 32), (11, 717753201, 23), (12, 610583414, 16), (13, 202605296, 68), (14, 445337145, 65), (15, 522975110, 73), (16, 629076619, 68), (17, 795119915, 56), (19, 412569594, 75
	), (20, 597248715, 39), (21, 697086514, 62);

INSERT INTO Client (name, businessPhoneNumber, businessAddressId, contactName, contactPhoneNumber, contactAddressId, userName)
VALUES
('kido','(463) 704-3857',1,'Antione Bugg','(251) 673-0200',1,'abugg'),
('bellil','(795) 643-6145',2,'Mitzie Cahn','(610) 742-8667',2,'mcahn'),
('agilium','(825) 532-2250',3,'Royce Colon','(687) 644-0689',3,'rcolon'),
('cisil','(586) 148-7099',4,'Darell Hanneman','(244) 223-8244',4,'dhanneman'),
('bover','(359) 795-1299',5,'Larue Schuck','(718) 216-0664',5,'lschuck'),
('twilium','(690) 554-8974',6,'Cornell Mork','(799) 467-7038',6,'cmork'),
('dominil','(945) 950-0799',7,'Earlie Shankles','(700) 889-8275',7,'eshankles'),
('dente','(628) 138-6302',8,'Angla Reinbold','(182) 648-1472',8,'areinbold'),
('avitri','(285) 784-1616',9,'Toni Boland','(810) 147-8676',9,'tboland'),
('trinte','(838) 639-4339',10,'Ricki Smiddy','(101) 421-4174',10,'rsmiddy'),
('meganti','(596) 693-9393',11,'Yung Tatro','(853) 609-2549',11,'ytatro'),
('leexo','(361) 816-8357',12,'Zella Theroux','(826) 144-9918',12,'ztheroux'),
('rhyize','(366) 172-8518',13,'Deidre Depasquale','(640) 319-0776',13,'ddepasquale'),
('avu','(309) 607-7565',14,'Gil Lozoya','(101) 327-0565',14,'glozoya'),
('corent','(207) 126-9052',15,'Elena Sale','(754) 753-8136',15,'esale'),
('venism','(969) 929-0315',16,'Tashina Henrich','(832) 640-5836',16,'thenrich'),
('medicee','(366) 290-3536',17,'Caridad Albanese','(375) 176-7085',17,'calbanese'),
('autogen','(950) 204-4549',18,'Modesta Birkland','(317) 349-9023',18,'mbirkland'),
('plazio','(262) 136-1265',19,'Nathalie Dunagan','(549) 272-0422',19,'ndunagan'),
('tavu','(697) 289-4376',20,'Williams Valencia','(449) 171-1053',20,'wvalencia'),
('octonoodle','(708) 490-0358',20,'Ema Tea','(915) 222-6281',20,'etea');

INSERT INTO Employee (sin, name, title, wage)
VALUES
(769350193,'Kristy Willis','Product Optimization Coordinator',16.5)
(579673803,'Mario Logan','Senior Paradigm Specialist',67.40)
(709838588,'Lucille Owen','Investor Data Technician',24.60)
(270784917,'Erica Sherman','Principal Functionality Officer',45.20)
(577895133,'Carmen Vega','Corporate Accountability Developer',33.10)
(588952503,'Vera Goodman','Global Paradigm Orchestrator',44.60)
(417912161,'Israel Davis','Product Usability Analyst',42.80)
(386878327,'Krystal Bass','Product Quality Producer',51.90)
(628290323,'Lorena Harvey','Legacy Directives Orchestrator',45.00)
(345488155,'Kathleen Hill','Customer Response Agent',17.00)
(487085417,'Melissa Bryant','Direct Accountability Manager',43.00)
(638754355,'Frederick Ballard','Human Data Executive',48.00)
(401046938,'Sheila Tucker','Product Metrics Coordinator',46.40)
(433537996,'Francis Martinez','Dynamic Metrics Assistant',42.50)
(241366385,'Woodrow Jensen','National Paradigm Director',30.60)
(591526192,'Ignacio Dixon','National Research Manager',56.80)
(479888573,'Darren Fitzgerald','Direct Marketing Designer',20.70)
(338501523,'Forrest Bush','Chief Markets Associate',53.40)
(280638262,'Susan Thornton','District Accountability Engineer',22.30)
(224334295,'Lydia Hicks','Internal Brand Officer',29.40)
(544383505,'Annie Burke','Chief Applications Planner',22.50);

INSERT INTO Payments (purchaseId, date, amount)
VALUES
(,,),
(,,),
(,,),
(,,),
(,,),
(,,),
(,,),
(,,),
(,,),
(,,),
(,,),
(,,),
(,,),
(,,),
(,,),
(,,),
(,,),
(,,),
(,,),
(,,),
(,,);


INSERT INTO Permits (taskId,type, dateValidStart, dateValidEnd,cost)
VALUES
(1,'building','2007-06-08','2018-04-20',1500.00),
(2,'building','2007-06-28','2018-05-05',150.00),
(3,'building','2007-07-20','2018-04-27',1800.00),
(4,'building','2007-09-07','2018-01-08',1540.00),
(5,'building','2007-10-30','2018-02-15',110.00),
(6,'building','2007-11-13','2018-02-27',120.00),
(7,'construction','2008-02-25','2018-03-02',500.00),
(8,'construction','2008-03-10','2018-03-06',500.00),
(9,'construction','2008-08-05','2018-03-22',700.00),
(10,'construction','2009-03-19','2018-03-28',900.00),
(11,'construction','2009-04-07','2018-04-05',16000.00),
(12,'building','2009-05-27','2018-04-13',180.00),
(13,'building','2009-06-22','2018-05-11',2000.00),
(14,'building','2009-07-02','2018-06-11',3500.00),
(15,'building','2009-09-21','2018-07-05',1000.00),
(16,'construction','2009-12-09','2018-08-14',12500.00),
(17,'construction','2010-01-13','2018-09-05',1690.00),
(18,'building','2010-04-29','2018-12-04',1560.00),
(19,'building','2010-06-03','2018-12-18',1740.00),
(20,'building','2010-08-19','2018-12-24',1600.00),
(221,'building','2010-12-22','2018-09-05',2400.00);

INSERT INTO PreReq (taskPredessorId,taskSuccessorId)
VALUES

INSERT INTO Project (name,startDate,endDate,deadLine,budget,clientId,supervisorSin)
VALUES

INSERT INTO Purchase (item, quantity, unitType, purchaseDate, deliveryDate, supplierName, price)
VALUES

INSERT INTO PurchasedFor (purchaseId, taskId)
VALUES

INSERT INTO Task (name, estimateTime, estimatedCost, startDate, endDate, description, projectId)
VALUES

INSERT INTO Users (userName, password, permission)
VALUES
('abugg','123456','manager'),
('mcahn','123456','client'),
('rcolon','123456','client'),
('dhanneman','123456','client'),
('lschuck','123456','manager'),
('cmork','123456','client'),
('eshankles','123456','client'),
('areinbold','123456','client'),
('tboland','123456','client'),
('rsmiddy','123456','manager'),
('ytatro','123456','client'),
('ztheroux','123456','client'),
('ddepasquale','123456','manager'),
('glozoya','123456','client'),
('esale','123456','client'),
('thenrich','123456','manager'),
('calbanese','123456','client'),
('mbirkland','123456','manager'),
('ndunagan','123456','client'),
('wvalencia','123456','client'),
('etea','123456','manager');

