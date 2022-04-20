.mode columns
.headers on
PRAGMA foreign_keys = ON;

drop table if exists Customer;
drop table if exists RestOwner;
drop table if exists Address;
drop table if exists Restaurant;
drop table if exists RestCategory;
drop table if exists Evaluation;
drop table if exists MenuItem;
drop table if exists ItemCategory;
drop table if exists ItemFavorite;
drop table if exists RestFavorite;
drop table if exists Orders; //
drop table if exists Promotion; //
drop table if exists Menu; //
# between menuitem and itemcategory


create table Customer (
	idCustomer 		INTEGER PRIMARY KEY,
	Phone 			INTEGER UNIQUE,
	Username		TEXT	UNIQUE,
	Password		TEXT	NOT NULL,
	Name 			TEXT 	NOT NULL,
	EmailAddress		TEXT 	DEFAULT '',
	idAddress		INTEGER		CONSTRAINT fk_customer_idaddress REFERENCES Address (idAddress)
												ON DELETE SET NULL ON UPDATE CASCADE
);

create table RestOwner (
	idRestOwner 		INTEGER PRIMARY KEY,
	Phone 			INTEGER UNIQUE,
	Username		TEXT	UNIQUE,
	Password		TEXT	NOT NULL,
	Name 			TEXT 	NOT NULL,
	EmailAddress		TEXT 	DEFAULT '',
	idAddress		INTEGER		CONSTRAINT fk_customer_idaddress REFERENCES Address (idAddress)
												ON DELETE SET NULL ON UPDATE CASCADE
);

create table Address (
	idAddress 		INTEGER PRIMARY KEY,
	Street 		TEXT 	NOT NULL,
	City			TEXT	NOT NULL,
	State			TEXT	NOT NULL,
	PostalCode 		INTEGER NOT NULL
);

create table Evaluation (
	idEvaluation		INTEGER PRIMARY KEY,
	idCustomer 		INTEGER 		CONSTRAINT fk_evaluation_idCustomer REFERENCES Customer (idCustomer) 
												ON DELETE CASCADE ON UPDATE CASCADE,
	idRestaurant	 	INTEGER 		CONSTRAINT fk_evaluation_idrestaurant REFERENCES Restaurant (idRestaurant) 
												ON DELETE CASCADE ON UPDATE CASCADE,
	idRestOwner		INTEGER		CONSTRAINT fk_evaluation_idrestowner REFERENCES RestOwner (idRestOwner)
												ON DELETE CASCADE ON UPDATE CASCADE,
	Rating 		INTEGER NOT NULL,
	Message		TEXT	DEFAULT '',
	Commets		TEXT	DEFAULT '',
	
	CONSTRAINT evaluation_rating CHECK ((Rating > -1) and (Rating <6))												  	
													  				
);

create table Restaurant (
	idRestaurant 		INTEGER PRIMARY KEY,
	Name 			TEXT 	NOT NULL,
	idRestOwner		INTEGER NOT NULL	CONSTRAINT fk_restaurant_idrestowner REFERENCES RestOwner (idRestOwner)
												ON DELETE CASCADE ON UPDATE CASCADE,
	idRestCategory		INTEGER NOT NULL	CONSTRAINT fk_restaurant_idrestcategory REFERENCES RestCategory (idRestCategory)
												ON DELETE CASCADE ON UPDATE CASCADE,
);

create table RestCategory (
	idRestCategory		INTEGER PRIMARY KEY,
	Nome 			TEXT 	NOT NULL,

);

create table MenuItem (
	idMenuItem	 	INTEGER PRIMARY KEY,
	Name 			TEXT 	NOT NULL,
	Price 			DATE 	NOT NULL,
	Photo			TEXT	DEFAULT '',
	idMenu			INTEGER NOT NULL	CONSTRAINT fk_menuitem_idmenu	REFERENCES Menu (idMenu)
												ON DELETE CASCADE ON UPDATE CASCADE
);

create table ItemCategory (
	idItemCategory		INTEGER PRIMARY KEY,
	Name 			TEXT 	NOT NULL
);

create table ItemFavorite (
	idItemFavorite		INTEGER PRIMARY KEY,
	idCustomer		INTEGER NOT NULL	CONSTRAINT fk_itemfavorite_idcustomer REFERENCES Customer (idCustomer)
												ON DELETE CASCADE ON UPDATE CASCADE,
	idMenuItem		INTEGER NOT NULL	CONSTRAINT fk_itemfavorite_idmenuitem REFERENCES MenuItem (idMenuItem)
												ON DELETE CASCADE ON UPDATE CASCADE,
);

create table RestFavorite (
	idRestFavorite		INTEGER PRIMARY KEY,
	idCustomer		INTEGER NOT NULL	CONSTRAINT fk_restfavorite_idcustomer REFERENCES Customer (idCustomer)
												ON DELETE CASCADE ON UPDATE CASCADE,
	idRestaurant		INTEGER NOT NULL	CONSTRAINT fk_restfavorite_idrestaurant REFERENCES Restaurant (idRestaurant)
												ON DELETE CASCADE ON UPDATE CASCADE,
);

create table Menu (
	idMenu			INTEGER PRIMARY KEY
);

