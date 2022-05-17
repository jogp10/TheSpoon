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
	Name 			VARCHAR NOT NULL
);


create table if not exists Restaurant (
	idRestaurant 		INTEGER PRIMARY KEY,
	Name 			VARCHAR NOT NULL,
	idUser		INTEGER NOT NULL 	CONSTRAINT fk_restaurant_iduser REFERENCES User (idUser)
												ON DELETE CASCADE ON UPDATE CASCADE,
	idRestCategory		INTEGER NOT NULL 	CONSTRAINT fk_restaurant_idrestcategory REFERENCES RestCategory (idRestCategory)
												ON DELETE CASCADE ON UPDATE CASCADE,
	idAddress		INTEGER NOT NULL 	CONSTRAINT fk_restaurant_idaddress REFERENCES Address (idAddress)
												ON DELETE CASCADE ON UPDATE CASCADE
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

create table RestFavorite (
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
	idRestaurant		INTEGER NOT NULL 	CONSTRAINT fk_orders_idrestaurant REFERENCES Restaurant (idRestaurant)
);

create table if not exists Promotion (
	idPromotion		INTEGER PRIMARY KEY,
	idMenuItem		INTEGER NOT NULL 	CONSTRAINT fk_promotion_idmenuitem REFERENCES MenuItem (idMenuItem)
												ON DELETE CASCADE ON UPDATE CASCADE,
	idOrders		INTEGER NOT NULL 	CONSTRAINT fk_promotion_idorder REFERENCES Orders (idOrders)
												ON DELETE CASCADE ON UPDATE CASCADE,
	PercentageDisc		INTEGER DEFAULT 0
);


--- povoar

INSERT INTO Address values (1, "Rua da Constituicao 143 R/C", "Porto", "Porto", 4250341);
INSERT INTO Address values (2, "Rua da Circunvalacao 9430 1ª esq", "Porto", "Porto",  4250120);
INSERT INTO Address values (3, "Avenida D Joao II 2 2ª frt", "Gaia", "Porto",  4200140);

INSERT INTO User values (6, "andreneves98@gmail.com", "7110eda4d09e062aa5e4a390b0a572ac0d2c0220", 914989898, "Andre Neves", false, 1);
INSERT INTO User values (7, "vascosilva55@gmail.com", "7110eda4d09e062aa5e4a390b0a572ac0d2c0222", 934545445, "Vasco Silva", true, 2);

INSERT INTO RestCategory values (5, "Pizzaria");
INSERT INTO Restaurant values (4, "EatRoll", 7, 5, 3);
INSERT INTO Restaurant values (14, "RockBy", 7, 5, 2);

INSERT INTO Evaluation values (6, 6, 4, 4, 'Mo bamba', 'Gratos pela sua escolha!!!');

INSERT INTO Menu values (7, 4);

INSERT INTO MenuItem values (8, "Rojão à bolhão pato", 23, "https://picsum.photos/200?8", 7);
INSERT INTO ItemCategory values (9, "Carne");
INSERT INTO MenuItemCategories values (10, 8, 9);

INSERT INTO MenuItem values (15, "Bacalhau à Braga", 23, "https://picsum.photos/200?15", 7);
INSERT INTO ItemCategory values (16, "Peixe");
INSERT INTO MenuItemCategories values (17, 15, 16);

INSERT INTO ItemFavorite values (11, 6, 8);
INSERT INTO RestFavorite values (12, 6, 4);

INSERT INTO Orders values (12, '2022-04-22 15:33', 45, 6, 4);
INSERT INTO Promotion values (13, 8, 12, null);
