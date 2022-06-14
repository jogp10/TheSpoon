.mode columns
.headers on
PRAGMA foreign_keys = ON;

create table if not exists Address (
	idAddress 		INTEGER PRIMARY KEY,
	Street 		VARCHAR NOT NULL,
	City			VARCHAR NOT NULL,
	State			VARCHAR NOT NULL,
	PostalCode 		INTEGER NOT NULL
);

create table if not exists User (
	idUser			INTEGER PRIMARY KEY,
	Email			VARCHAR NOT NULL UNIQUE,
	Password		VARCHAR NOT NULL,
	Phone 			INTEGER UNIQUE,
	Name 			VARCHAR NOT NULL,
	RestOwner       BOOLEAN DEFAULT FALSE,
	idAddress		INTEGER		CONSTRAINT fk_user_idaddress REFERENCES Address (idAddress)
												ON DELETE SET NULL ON UPDATE CASCADE
);

create table if not exists RestCategory (
	idRestCategory		INTEGER PRIMARY KEY,
	Name 			VARCHAR NOT NULL,
	Description		VARCHAR NOT NULL
);


create table if not exists Restaurant (
	idRestaurant 		INTEGER PRIMARY KEY,
	Name 			VARCHAR NOT NULL,
	idUser		INTEGER NOT NULL 	CONSTRAINT fk_restaurant_iduser REFERENCES User (idUser)
												ON DELETE CASCADE ON UPDATE CASCADE,
	idRestCategory		INTEGER NOT NULL 	CONSTRAINT fk_restaurant_idrestcategory REFERENCES RestCategory (idRestCategory)
												ON DELETE CASCADE ON UPDATE CASCADE,
	Photo			VARCHAR	DEFAULT '',
	Description		VARCHAR DEFAULT '',
	Rating 		REAL NOT NULL,
	idAddress		INTEGER NOT NULL 	CONSTRAINT fk_restaurant_idaddress REFERENCES Address (idAddress)
												ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT evaluation_rating CHECK ((Rating >= 0) and (Rating <= 5))
);

create table if not exists Evaluation (
	idEvaluation		INTEGER PRIMARY KEY,
	idUser 		VARCHAR NOT NULL 	CONSTRAINT fk_evaluation_idUser REFERENCES User (idUser) 
												ON DELETE CASCADE ON UPDATE CASCADE,
	idRestaurant	 	INTEGER NOT NULL 	CONSTRAINT fk_evaluation_idrestaurant REFERENCES Restaurant (idRestaurant) 
												ON DELETE CASCADE ON UPDATE CASCADE,
	Rating 		INTEGER NOT NULL,
	Message		VARCHAR DEFAULT '',
	Comments		VARCHAR DEFAULT '',
	CONSTRAINT evaluation_rating CHECK ((Rating >= 0) and (Rating <= 5))					
);

create table if not exists Menu (
	idMenu			INTEGER PRIMARY KEY,
	idRestaurant		INTEGER UNIQUE		CONSTRAINT fk_menu_idrestaurant REFERENCES Restaurant (idRestaurant)
												ON DELETE CASCADE ON UPDATE CASCADE
);

create table if not exists MenuItem (
	idMenuItem	 	INTEGER PRIMARY KEY,
	Name 			VARCHAR 	NOT NULL,
	Price 			INTEGER NOT NULL,
	Photo			VARCHAR	DEFAULT '',
	idMenu			INTEGER NOT NULL 	CONSTRAINT fk_menuitem_idmenu 	REFERENCES Menu (idMenu)
												ON DELETE CASCADE ON UPDATE CASCADE
);

create table if not exists ItemCategory (
	idItemCategory		INTEGER PRIMARY KEY,
	Name 			VARCHAR 	NOT NULL
);

create table if not exists MenuItemCategories (
	idMenuItemCategories	INTEGER PRIMARY KEY,
	idMenuItem		INTEGER NOT NULL 	CONSTRAINT fk_menuitemcategories_idmenuitem REFERENCES MenuItem (idMenuItem)
												ON DELETE CASCADE ON UPDATE CASCADE,
	idItemCategory		INTEGER NOT NULL 	CONSTRAINT fk_menuitemcategories_iditemcategory REFERENCES ItemCategory (idItemCategory)
												ON DELETE CASCADE ON UPDATE CASCADE
);

create table if not exists ItemFavorite (
	idItemFavorite		INTEGER PRIMARY KEY,
	idUser		VARCHAR NOT NULL 	CONSTRAINT fk_itemfavorite_iduser REFERENCES User (idUser)
												ON DELETE CASCADE ON UPDATE CASCADE,
	idMenuItem		INTEGER NOT NULL 	CONSTRAINT fk_itemfavorite_idmenuitem REFERENCES MenuItem (idMenuItem)
												ON DELETE CASCADE ON UPDATE CASCADE
);

create table if not exists RestFavorite (
	idRestFavorite		INTEGER PRIMARY KEY,
	idUser		VARCHAR NOT NULL 	CONSTRAINT fk_restfavorite_iduser REFERENCES User (idUser)
												ON DELETE CASCADE ON UPDATE CASCADE,
	idRestaurant		INTEGER NOT NULL 	CONSTRAINT fk_restfavorite_idrestaurant REFERENCES Restaurant (idRestaurant)
												ON DELETE CASCADE ON UPDATE CASCADE
);

create table if not exists Orders (
	idOrders		INTEGER PRIMARY KEY,
	OrderTime		DATE	NOT NULL,
	PriceTotal		INTEGER,
	idUser		VARCHAR NOT NULL 	CONSTRAINT fk_orders_iduser REFERENCES User (idUser)
												ON DELETE CASCADE ON UPDATE CASCADE,
	idRestaurant		INTEGER NOT NULL 	CONSTRAINT fk_orders_idrestaurant REFERENCES Restaurant (idRestaurant),
	State 			VARCHAR 	NOT NULL
);


--- povoar

-- Address (id, Street, City, State, PostalCode)
INSERT INTO Address values (1, "Rua da Constituicao 143 R/C", "Porto", "Porto", 4250341);
INSERT INTO Address values (2, "Rua da Circunvalacao 9430 1ª esq", "Porto", "Porto",  4250120);
INSERT INTO Address values (3, "Avenida D Joao II 2 2ª frt", "Gaia", "Porto",  4200140);
INSERT INTO Address values (4, "Rua 5 de Outubro 3ª frt", "Porto", "Porto",  4250140);
INSERT INTO Address values (5, "Rua S. Victor", "Porto", "Porto",  4450530);
INSERT INTO Address values (6, "Rua do Meida", "Estela", "Povoa",  4270207);
INSERT INTO Address values (7, "Rua de Camoes", "Rio Tinto", "Porto",  4435530);
INSERT INTO Address values (8, "Rua de Camoes", "Rio Tinto", "Porto",  4435530);
INSERT INTO Address values (9, "Rua de Camoes", "Rio Tinto", "Porto",  4435530);
INSERT INTO Address values (10, "Rua de Camoes", "Rio Tinto", "Porto",  4435530);
INSERT INTO Address values (11, "Rua de Camoes", "Rio Tinto", "Porto",  4435530);
INSERT INTO Address values (12, "Rua de Camoes", "Rio Tinto", "Porto",  4435530);
INSERT INTO Address values (13, "Rua de Camoes", "Rio Tinto", "Porto",  4435530);
INSERT INTO Address values (14, "Rua de Camoes", "Rio Tinto", "Porto",  4435530);
INSERT INTO Address values (15, "Rua de Camoes", "Rio Tinto", "Porto",  4435530);
INSERT INTO Address values (16, "Rua de Camoes", "Rio Tinto", "Porto",  4435530);
INSERT INTO Address values (17, "Rua da Constituicao 143 R/C", "Porto", "Porto", 4250341);
INSERT INTO Address values (18, "Rua da Circunvalacao 9430 1ª esq", "Porto", "Porto",  4250120);
INSERT INTO Address values (19, "Avenida D Joao II 2 2ª frt", "Gaia", "Porto",  4200140);
INSERT INTO Address values (20, "Rua 5 de Outubro 3ª frt", "Porto", "Porto",  4250140);
INSERT INTO Address values (21, "Rua S. Victor", "Porto", "Porto",  4450530);
INSERT INTO Address values (22, "Rua do Meida", "Estela", "Povoa",  4270207);
INSERT INTO Address values (23, "Rua de Camoes", "Rio Tinto", "Porto",  4435530);
INSERT INTO Address values (24, "Rua de Camoes", "Rio Tinto", "Porto",  4435530);
INSERT INTO Address values (25, "Rua de Camoes", "Rio Tinto", "Porto",  4435530);
INSERT INTO Address values (26, "Rua de Camoes", "Rio Tinto", "Porto",  4435530);
INSERT INTO Address values (27, "Rua de Camoes", "Rio Tinto", "Porto",  4435530);
INSERT INTO Address values (28, "Rua de Camoes", "Rio Tinto", "Porto",  4435530);
INSERT INTO Address values (29, "Rua de Camoes", "Rio Tinto", "Porto",  4435530);
INSERT INTO Address values (30, "Rua de Camoes", "Rio Tinto", "Porto",  4435530);
INSERT INTO Address values (31, "Rua de Camoes", "Rio Tinto", "Porto",  4435530);
INSERT INTO Address values (32, "Rua de Camoes", "Rio Tinto", "Porto",  4435530);

-- User (id, Email, pw, phone, name, restaurant owner, idAddress)
INSERT INTO User values (1, "andreneves98@gmail.com", "$2y$10$pxrNKb/Kmg/kYtjpTNodfOYYRYU/pC1XJclUGmUlwb7nTRLNy1DhO", 914989898, "Andre Neves", false, 1);
INSERT INTO User values (2, "vascosilva55@gmail.com", "$2y$10$pxrNKb/Kmg/kYtjpTNodfOYYRYU/pC1XJclUGmUlwb7nTRLNy1DhO", 934545445, "Vasco Silva", true, 2);
INSERT INTO User values (3, "dinis@macaca.co", "$2y$10$pxrNKb/Kmg/kYtjpTNodfOYYRYU/pC1XJclUGmUlwb7nTRLNy1DhO", 938888888, "Dinis Sousa", true, 3);
INSERT INTO User values (4, "ocon@gmail.com", "$2y$10$pxrNKb/Kmg/kYtjpTNodfOYYRYU/pC1XJclUGmUlwb7nTRLNy1DhO", 938888885, "Estebán Gutierrez", false, 4);
  
-- RestCategory (id, Name, Description)
INSERT INTO RestCategory values (1, "Pizzaria", "The best Pizza");
INSERT INTO RestCategory values (2, "Sushi", "The best Sushi");
INSERT INTO RestCategory values (3, "Chinês", "The best Chinese");
INSERT INTO RestCategory values (4, "Hamburgaria", "The best Hamburgers");
INSERT INTO RestCategory values (5, "Gelataria", "The best Icecreams");
INSERT INTO RestCategory values (6, "Tasca", "The best Tavern");
INSERT INTO RestCategory values (7, "Tailandês", "The best Thai");
INSERT INTO RestCategory values (8, "Churrasqueira", "The best Barbecue");
INSERT INTO RestCategory values (9, "Marisqueira", "The best Seafood");
INSERT INTO RestCategory values (10, "Tradicional", "The best Traditional food");

-- Restaurant (id, Name, idUser, idRestCategory, Photo, Description, Rating, idAddress)
INSERT INTO Restaurant values (1, "EatRoll", 3, 2, "https://picsum.photos/200?1", "All you can eat", 3, 5);
INSERT INTO Restaurant values (2, "RockBy", 2, 2, "https://picsum.photos/200?2", "Rocks that crack your teeth", 0, 6);
INSERT INTO Restaurant values (3, "MCAlfredos", 2, 4, "https://picsum.photos/200?3", "Eat so much, get so fat, dont run, keep eating, eat more and continue eating, there is no possible limit to how much you can eat.", 0, 7);
INSERT INTO Restaurant values (4, "Tasca do tio Quim", 2, 6, "https://picsum.photos/200?4", "All you can eat", 0, 8);
INSERT INTO Restaurant values (5, "Churrasqueira Portuguesa", 2, 8, "https://picsum.photos/200?5", "All you can eat", 0, 9);
INSERT INTO Restaurant values (6, "Tasca do Toni", 2, 6, "https://picsum.photos/200?6", "All you can eat", 0, 10);
INSERT INTO Restaurant values (7, "Churrasqueira Toni Torpedo", 2, 8, "https://picsum.photos/200?7", "All you can eat", 4, 11);
INSERT INTO Restaurant values (8, "Camelo", 2, 10, "https://picsum.photos/200?8", "All you can eat", 0, 12);
INSERT INTO Restaurant values (9, "Stramontana", 2, 10, "https://picsum.photos/200?9", "All you can eat", 0, 13);
INSERT INTO Restaurant values (10, "Transmontano", 2, 10, "https://picsum.photos/200?10", "All you can eat", 0, 14);
INSERT INTO Restaurant values (11, "Thai Food", 2, 7, "https://picsum.photos/200?11", "All you can eat", 0, 15);
INSERT INTO Restaurant values (12, "Restaurante Amizade", 2, 3, "https://picsum.photos/200?12", "All you can eat", 0, 16);
INSERT INTO Restaurant values (13, "Restaurante Grão D'Ouro", 2, 10, "https://picsum.photos/200?13", "All you can eat", 0, 17);
INSERT INTO Restaurant values (14, "Assim Assado", 2, 8, "https://picsum.photos/200?14", "All you can eat", 0, 18);
INSERT INTO Restaurant values (15, "Ramirinho 1", 2, 6, "https://picsum.photos/200?15", "All you can eat", 0, 19);
INSERT INTO Restaurant values (16, "Ramirinho 2", 2, 6, "https://picsum.photos/200?16", "All you can eat", 0, 20);
INSERT INTO Restaurant values (17, "Ramirinho 3", 2, 6, "https://picsum.photos/200?17", "All you can eat", 0, 21);
INSERT INTO Restaurant values (18, "Lado B", 2, 10, "https://picsum.photos/200?18", "All you can eat", 0, 22);
INSERT INTO Restaurant values (19, "Santiago", 2, 10, "https://picsum.photos/200?19", "All you can eat", 0, 23);
INSERT INTO Restaurant values (20, "Venham mais 5!", 2, 4, "https://picsum.photos/200?20", "All you can eat", 0, 24);
INSERT INTO Restaurant values (21, "Mr Pizza", 2, 1, "https://picsum.photos/200?21", "All you can eat", 0, 25);
INSERT INTO Restaurant values (22, "Las Bichas", 2, 6, "https://picsum.photos/200?22", "All you can eat", 0, 26);
INSERT INTO Restaurant values (23, "Sincello", 2, 5, "https://picsum.photos/200?23", "All you can eat", 0, 27);
INSERT INTO Restaurant values (24, "Marisqueira João Camarão", 2, 9, "https://picsum.photos/200?24", "All you can eat", 0, 28);
INSERT INTO Restaurant values (25, "Madureira's", 2, 8, "https://picsum.photos/200?25", "All you can eat", 0, 29);

-- Evaluation (id, idUser, idRestaurant, Rating, Message, Comments)
INSERT INTO Evaluation values (1, 1, 7, 4, 'Mo bamba', 'Gratos pela sua escolha!!!');
INSERT INTO Evaluation values (2, 4, 1, 3, 'Meh, serviço muito lento', '');

-- Menu (id, idRestaurant)
INSERT INTO Menu values (1, 1);
INSERT INTO Menu values (2, 2);
INSERT INTO Menu values (3, 3);
INSERT INTO Menu values (4, 4);
INSERT INTO Menu values (5, 5);
INSERT INTO Menu values (6, 6);
INSERT INTO Menu values (7, 7);
INSERT INTO Menu values (8, 8);
INSERT INTO Menu values (9, 9);
INSERT INTO Menu values (10, 10);
INSERT INTO Menu values (11, 11);
INSERT INTO Menu values (12, 12);
INSERT INTO Menu values (13, 13);
INSERT INTO Menu values (14, 14);
INSERT INTO Menu values (15, 15);
INSERT INTO Menu values (16, 16);
INSERT INTO Menu values (17, 17);
INSERT INTO Menu values (18, 18);
INSERT INTO Menu values (19, 19);
INSERT INTO Menu values (20, 20);
INSERT INTO Menu values (21, 21);
INSERT INTO Menu values (22, 22);
INSERT INTO Menu values (23, 23);
INSERT INTO Menu values (24, 24);
INSERT INTO Menu values (25, 25);

-- ItemCategory (id, Name)
INSERT INTO ItemCategory values (1, "Meat");
INSERT INTO ItemCategory values (2, "Fish");
INSERT INTO ItemCategory values (3, "Vegetarian");
INSERT INTO ItemCategory values (4, "Vegan");
INSERT INTO ItemCategory values (5, "GlutenFree");
INSERT INTO ItemCategory values (6, "Pizza");
INSERT INTO ItemCategory values (7, "Pasta");
INSERT INTO ItemCategory values (8, "Hamburger");
INSERT INTO ItemCategory values (9, "LactoseFree");
INSERT INTO ItemCategory values (10, "Drink");
INSERT INTO ItemCategory values (11, "Wine");

-- MenuItem (id, Name, Price, Photo, idMenu)
-- MenuItemCategories (id, idMenuItem, idItemCategory)
INSERT INTO MenuItem values (1, "Rojão à bolhão pato", 12, "https://picsum.photos/200?1111", 7);
INSERT INTO MenuItemCategories values (1, 1, 1);

INSERT INTO MenuItem values (2, "Bacalhau à Braga", 12, "https://picsum.photos/200?1112", 13);
INSERT INTO MenuItemCategories values (2, 2, 2);

INSERT INTO MenuItem values (3, "Bacalhau à Braz", 15, "https://picsum.photos/200?11119", 13);
INSERT INTO MenuItemCategories values (3, 3, 2);

INSERT INTO MenuItem values (4, "Bacalhau com Natas", 10, "https://picsum.photos/200?1113", 13);
INSERT INTO MenuItemCategories values (4, 4, 2);

INSERT INTO MenuItem values (5, "Temaki", 8, "https://picsum.photos/200?1114", 1);
INSERT INTO MenuItemCategories values (5, 5, 2);

INSERT INTO MenuItem values (6, "Prego no Prato", 20, "https://picsum.photos/200?1115", 19);
INSERT INTO MenuItemCategories values (6, 6, 1);

INSERT INTO MenuItem values (7, "Francesinha Especial", 11, "https://picsum.photos/200?1116", 19);
INSERT INTO MenuItemCategories values (7, 7, 1);

INSERT INTO MenuItem values (8, "Pure de batata", 15, "https://picsum.photos/200?1117", 25);
INSERT INTO MenuItemCategories values (8, 8, 3);
INSERT INTO MenuItemCategories values (9, 8, 4);

INSERT INTO MenuItem values (9, "Entrecosto", 13, "https://picsum.photos/200?1118", 25);
INSERT INTO MenuItemCategories values (10, 9, 1);

INSERT INTO MenuItem values (10, "Strogonoff", 12, "https://picsum.photos/200?1119", 25);
INSERT INTO MenuItemCategories values (11, 10, 1);

INSERT INTO MenuItem values (11, "Rissol Misto", 5, "https://picsum.photos/200?11110", 7);
INSERT INTO MenuItemCategories values (12, 11, 1);

INSERT INTO MenuItem values (12, "Mexilhoes", 24, "https://picsum.photos/200?11111", 7);
INSERT INTO MenuItemCategories values (13, 12, 2);

INSERT INTO MenuItem values (13, "Ovas", 10, "https://picsum.photos/200?11112", 7);
INSERT INTO MenuItemCategories values (14, 13, 2);

INSERT INTO MenuItem values (14, "Tremocos", 3, "https://picsum.photos/200?11113", 7);
INSERT INTO MenuItemCategories values (15, 14, 3);
INSERT INTO MenuItemCategories values (16, 14, 4);

INSERT INTO MenuItem values (15, "Mixórdia Marisco", 45, "https://picsum.photos/200?11114", 24);
INSERT INTO MenuItemCategories values (17, 15, 2);

INSERT INTO MenuItem values (16, "TomaHawk", 30, "https://picsum.photos/200?11115", 20);
INSERT INTO MenuItemCategories values (18, 16, 1);

INSERT INTO MenuItem values (17, "Lagosta", 20, "https://picsum.photos/200?11116", 24);
INSERT INTO MenuItemCategories values (19, 17, 2);

INSERT INTO MenuItem values (18, "Ameijoas", 12, "https://picsum.photos/200?11117", 7);
INSERT INTO MenuItemCategories values (20, 18, 2);

INSERT INTO MenuItem values (19, "Salada de Pimentos", 12, "https://picsum.photos/200?11118", 7);
INSERT INTO MenuItemCategories values (21, 19, 3);
INSERT INTO MenuItemCategories values (22, 19, 4);


-- ItemFavorite (id, idUser, idMenuItem)
INSERT INTO ItemFavorite values (1, 1, 1);

-- RestFavorite (id, idUser, idRestaurant)
INSERT INTO RestFavorite values (1, 1, 7);
INSERT INTO RestFavorite values (2, 1, 25);

-- Orders (id, ordertime, pricetotal, idUser, idRestaurant, status)
INSERT INTO Orders values (1, '2022-04-22 15:33', 36, 1, 7, "Delivered");
INSERT INTO Orders values (2, '2022-05-15 03:33', 12, 1, 7, "Delivered");
