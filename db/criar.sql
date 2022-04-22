.mode columns
.headers on
PRAGMA foreign_keys = ON;

drop table if exists Address;
drop table if exists Customer;
drop table if exists RestOwner;
drop table if exists Restaurant;
drop table if exists RestCategory;
drop table if exists Evaluation;
drop table if exists Menu;
drop table if exists MenuItem;
drop table if exists ItemCategory;
drop table if exists ItemFavorite;
drop table if exists RestFavorite;
drop table if exists Orders;
drop table if exists Promotion;
drop table if exists MenuItemCategories;


create table Address (
	idAddress 		INTEGER PRIMARY KEY,
	Street 		VARCHAR NOT NULL,
	City			VARCHAR NOT NULL,
	Country		VARCHAR NOT NULL,
	PostalCode 		INTEGER NOT NULL
);

create table Customer (
	Username		VARCHAR PRIMARY KEY,
	Password		VARCHAR NOT NULL,
	Phone 			INTEGER UNIQUE,
	Name 			VARCHAR NOT NULL,
	EmailAddress		VARCHAR DEFAULT '',
	idAddress		INTEGER		CONSTRAINT fk_customer_idaddress REFERENCES Address (idAddress)
												ON DELETE SET NULL ON UPDATE CASCADE
);

create table RestOwner (
	Username		VARCHAR PRIMARY KEY,
	Password		VARCHAR NOT NULL,
	Phone 			INTEGER UNIQUE,
	Name 			VARCHAR NOT NULL,
	EmailAddress		VARCHAR DEFAULT '',
	idAddress		INTEGER		CONSTRAINT fk_restowner_idaddress REFERENCES Address (idAddress)
												ON DELETE SET NULL ON UPDATE CASCADE
);

create table Restaurant (
	idRestaurant 		INTEGER PRIMARY KEY,
	Name 			VARCHAR NOT NULL,
	idRestOwner		INTEGER NOT NULL	CONSTRAINT fk_restaurant_idrestowner REFERENCES RestOwner (idRestOwner)
												ON DELETE CASCADE ON UPDATE CASCADE,
	idRestCategory		INTEGER NOT NULL	CONSTRAINT fk_restaurant_idrestcategory REFERENCES RestCategory (idRestCategory)
												ON DELETE CASCADE ON UPDATE CASCADE,
	idAddress		INTEGER NOT NULL	CONSTRAINT fk_restaurant_idaddress REFERENCES Address (idAddress)
												ON DELETE CASCADE ON UPDATE CASCADE
);

create table RestCategory (
	idRestCategory		INTEGER PRIMARY KEY,
	Name 			VARCHAR NOT NULL
);

create table Evaluation (
	idEvaluation		INTEGER PRIMARY KEY,
	idCustomer 		INTEGER NOT NULL	CONSTRAINT fk_evaluation_idCustomer REFERENCES Customer (Username) 
												ON DELETE CASCADE ON UPDATE CASCADE,
	idRestaurant	 	INTEGER NOT NULL	CONSTRAINT fk_evaluation_idrestaurant REFERENCES Restaurant (idRestaurant) 
												ON DELETE CASCADE ON UPDATE CASCADE,
	idRestOwner		INTEGER 		CONSTRAINT fk_evaluation_idrestowner REFERENCES RestOwner (idRestOwner)
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
	idMenu			INTEGER NOT NULL	CONSTRAINT fk_menuitem_idmenu	REFERENCES Menu (idMenu)
												ON DELETE CASCADE ON UPDATE CASCADE
);

create table ItemCategory (
	idItemCategory		INTEGER PRIMARY KEY,
	Name 			VARCHAR 	NOT NULL
);

create table ItemFavorite (
	idItemFavorite		INTEGER PRIMARY KEY,
	idCustomer		INTEGER NOT NULL	CONSTRAINT fk_itemfavorite_idcustomer REFERENCES Customer (Username)
												ON DELETE CASCADE ON UPDATE CASCADE,
	idMenuItem		INTEGER NOT NULL	CONSTRAINT fk_itemfavorite_idmenuitem REFERENCES MenuItem (idMenuItem)
												ON DELETE CASCADE ON UPDATE CASCADE
);

create table RestFavorite (
	idRestFavorite		INTEGER PRIMARY KEY,
	idCustomer		INTEGER NOT NULL	CONSTRAINT fk_restfavorite_idcustomer REFERENCES Customer (Username)
												ON DELETE CASCADE ON UPDATE CASCADE,
	idRestaurant		INTEGER NOT NULL	CONSTRAINT fk_restfavorite_idrestaurant REFERENCES Restaurant (idRestaurant)
												ON DELETE CASCADE ON UPDATE CASCADE
);

create table Orders (
	idOrders		INTEGER PRIMARY KEY,
	OrderTime		DATE	NOT NULL,
	PriceTotal		INTEGER,
	idCustomer		INTEGER NOT NULL	CONSTRAINT fk_orders_idcustomer REFERENCES Customer (Username)
												ON DELETE CASCADE ON UPDATE CASCADE,
	idRestaurant		INTEGER NOT NULL	CONSTRAINT fk_orders_idrestaurant REFERENCES Restaurant (idRestaurant)
);

create table Promotion (
	idPromotion		INTEGER PRIMARY KEY,
	idMenuItem		INTEGER NOT NULL	CONSTRAINT fk_promotion_idmenuitem REFERENCES MenuItem (idMenuItem)
												ON DELETE CASCADE ON UPDATE CASCADE,
	idOrders		INTEGER NOT NULL	CONSTRAINT fk_promotion_idorder REFERENCES Orders (idOrders)
												ON DELETE CASCADE ON UPDATE CASCADE,
	PercentageDisc		INTEGER DEFAULT 0
);

create table MenuItemCategories (
	idMenuItemCategories	INTEGER PRIMARY KEY,
	idMenuItem		INTEGER NOT NULL	CONSTRAINT fk_menuitemcategories_idmenuitem REFERENCES MenuItem (idMenuItem)
												ON DELETE CASCADE ON UPDATE CASCADE,
	idItemCategory		INTEGER NOT NULL	CONSTRAINT fk_menuitemcategories_iditemcategory REFERENCES ItemCategory (idItemCategory)
												ON DELETE CASCADE ON UPDATE CASCADE
);

