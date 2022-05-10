.mode columns
.headers on
PRAGMA foreign_keys = ON;

drop table if exists Address;
drop table if exists User;
drop table if exists Restaurant;
drop table if exists RestCategory;
drop table if exists Evaluation;
drop table if exists Menu;
drop table if exists MenuItem;
drop table if exists ItemCategory;
drop table if exists MenuItemCategories;
drop table if exists ItemFavorite;
drop table if exists RestFavorite;
drop table if exists Orders;
drop table if exists Promotion;


create table Address (
	idAddress 		INTEGER PRIMARY KEY,
	Street 		VARCHAR NOT NULL,
	City			VARCHAR NOT NULL,
	State			VARCHAR NOT NULL,
	PostalCode 		INTEGER NOT NULL
);

create table User (
	Username		VARCHAR PRIMARY KEY,
	Email			VARCHAR NOT NULL UNIQUE,
	Password		VARCHAR NOT NULL,
	Phone 			INTEGER UNIQUE,
	Name 			VARCHAR NOT NULL,
	RestOwner       BOOLEAN DEFAULT FALSE,
	idAddress		INTEGER		CONSTRAINT fk_user_idaddress REFERENCES Address (idAddress)
												ON DELETE SET NULL ON UPDATE CASCADE
);

create table RestCategory (
	idRestCategory		INTEGER PRIMARY KEY,
	Name 			VARCHAR NOT NULL
);


create table Restaurant (
	idRestaurant 		INTEGER PRIMARY KEY,
	Name 			VARCHAR NOT NULL,
	idUser		VARCHAR NOT NULL 	CONSTRAINT fk_restaurant_iduser REFERENCES User (Username)
												ON DELETE CASCADE ON UPDATE CASCADE,
	idRestCategory		INTEGER NOT NULL 	CONSTRAINT fk_restaurant_idrestcategory REFERENCES RestCategory (idRestCategory)
												ON DELETE CASCADE ON UPDATE CASCADE,
	idAddress		INTEGER NOT NULL 	CONSTRAINT fk_restaurant_idaddress REFERENCES Address (idAddress)
												ON DELETE CASCADE ON UPDATE CASCADE
);

create table Evaluation (
	idEvaluation		INTEGER PRIMARY KEY,
	idUser 		VARCHAR NOT NULL 	CONSTRAINT fk_evaluation_idUser REFERENCES User (Username) 
												ON DELETE CASCADE ON UPDATE CASCADE,
	idRestaurant	 	INTEGER NOT NULL 	CONSTRAINT fk_evaluation_idrestaurant REFERENCES Restaurant (idRestaurant) 
												ON DELETE CASCADE ON UPDATE CASCADE,
	Rating 		INTEGER NOT NULL,
	Message		VARCHAR DEFAULT '',
	Comments		VARCHAR DEFAULT '',
	CONSTRAINT evaluation_rating CHECK ((Rating >= 0) and (Rating <= 5))					
);

create table Menu (
	idMenu			INTEGER PRIMARY KEY,
	idRestaurant		INTEGER UNIQUE		CONSTRAINT fk_menu_idrestaurant REFERENCES Restaurant (idRestaurant)
												ON DELETE CASCADE ON UPDATE CASCADE
);

create table MenuItem (
	idMenuItem	 	INTEGER PRIMARY KEY,
	Name 			VARCHAR 	NOT NULL,
	Price 			INTEGER NOT NULL,
	Photo			VARCHAR	DEFAULT '',
	idMenu			INTEGER NOT NULL 	CONSTRAINT fk_menuitem_idmenu 	REFERENCES Menu (idMenu)
												ON DELETE CASCADE ON UPDATE CASCADE
);

create table ItemCategory (
	idItemCategory		INTEGER PRIMARY KEY,
	Name 			VARCHAR 	NOT NULL
);

create table MenuItemCategories (
	idMenuItemCategories	INTEGER PRIMARY KEY,
	idMenuItem		INTEGER NOT NULL 	CONSTRAINT fk_menuitemcategories_idmenuitem REFERENCES MenuItem (idMenuItem)
												ON DELETE CASCADE ON UPDATE CASCADE,
	idItemCategory		INTEGER NOT NULL 	CONSTRAINT fk_menuitemcategories_iditemcategory REFERENCES ItemCategory (idItemCategory)
												ON DELETE CASCADE ON UPDATE CASCADE
);

create table ItemFavorite (
	idItemFavorite		INTEGER PRIMARY KEY,
	idUser		VARCHAR NOT NULL 	CONSTRAINT fk_itemfavorite_iduser REFERENCES User (Username)
												ON DELETE CASCADE ON UPDATE CASCADE,
	idMenuItem		INTEGER NOT NULL 	CONSTRAINT fk_itemfavorite_idmenuitem REFERENCES MenuItem (idMenuItem)
												ON DELETE CASCADE ON UPDATE CASCADE
);

create table RestFavorite (
	idRestFavorite		INTEGER PRIMARY KEY,
	idUser		VARCHAR NOT NULL 	CONSTRAINT fk_restfavorite_iduser REFERENCES User (Username)
												ON DELETE CASCADE ON UPDATE CASCADE,
	idRestaurant		INTEGER NOT NULL 	CONSTRAINT fk_restfavorite_idrestaurant REFERENCES Restaurant (idRestaurant)
												ON DELETE CASCADE ON UPDATE CASCADE
);

create table Orders (
	idOrders		INTEGER PRIMARY KEY,
	OrderTime		DATE	NOT NULL,
	PriceTotal		INTEGER,
	idUser		VARCHAR NOT NULL 	CONSTRAINT fk_orders_iduser REFERENCES User (Username)
												ON DELETE CASCADE ON UPDATE CASCADE,
	idRestaurant		INTEGER NOT NULL 	CONSTRAINT fk_orders_idrestaurant REFERENCES Restaurant (idRestaurant)
);

create table Promotion (
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

INSERT INTO User values ("jas123", "andreneves98@gmail.com", "7110eda4d09e062aa5e4a390b0a572ac0d2c0220", 914989898, "Andre Neves", false, 1);
INSERT INTO User values ("Rsla55", "vascosilva55@gmail.com", "7110eda4d09e062aa5e4a390b0a572ac0d2c0222", 934545445, "Vasco Silva", true, 2);
INSERT INTO User values ("ocon", "ocon@gmail.com", "1234", 934545446, "Vasco Silva", false, 3);

INSERT INTO RestCategory values (5, "Pizzaria");
INSERT INTO Restaurant values (4, "EatRoll", "Rsla55", 5, 3);
INSERT INTO Restaurant values (14, "RockBy", "Rsla55", 5, 2);

INSERT INTO Evaluation values (6, "jas123", 4, 4, null, null);

INSERT INTO Menu values (7, 4);

INSERT INTO MenuItem values (8, "Rojão à bolhão pato", 23, "https://picsum.photos/200?8", 7);
INSERT INTO ItemCategory values (9, "Carne");
INSERT INTO MenuItemCategories values (10, 8, 9);

INSERT INTO MenuItem values (15, "Bacalhau à Braga", 23, "https://picsum.photos/200?15", 7);
INSERT INTO ItemCategory values (16, "Peixe");
INSERT INTO MenuItemCategories values (17, 15, 16);

INSERT INTO ItemFavorite values (11, "jas123", 8);
INSERT INTO RestFavorite values (12, "jas123", 4);

INSERT INTO Orders values (12, '2022-04-22 15:33', 45, "jas123", 4);
INSERT INTO Promotion values (13, 8, 12, null);
