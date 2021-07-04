-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.17-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for database-1931815
CREATE DATABASE IF NOT EXISTS `database-1931815` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `database-1931815`;

-- Dumping structure for table database-1931815.customers
CREATE TABLE IF NOT EXISTS `customers` (
  `customerID` char(36) NOT NULL DEFAULT uuid(),
  `c_firstname` varchar(20) NOT NULL,
  `c_lastname` varchar(20) NOT NULL,
  `c_address` varchar(25) DEFAULT NULL,
  `c_city` varchar(25) DEFAULT NULL,
  `c_province` varchar(25) DEFAULT NULL,
  `c_postalcode` varchar(7) DEFAULT NULL,
  `c_username` varchar(12) NOT NULL,
  `c_userpassword` varchar(255) NOT NULL,
  `c_date_creation` datetime NOT NULL DEFAULT curtime(),
  `c_date_modification` datetime NOT NULL DEFAULT curtime(),
  PRIMARY KEY (`customerID`),
  UNIQUE KEY `c_username` (`c_username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table database-1931815.customers: ~5 rows (approximately)
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` (`customerID`, `c_firstname`, `c_lastname`, `c_address`, `c_city`, `c_province`, `c_postalcode`, `c_username`, `c_userpassword`, `c_date_creation`, `c_date_modification`) VALUES
	('35673545-ab70-11eb-a7f8-244bfeba3290', 'Billy', 'Gates', '1144 DRAYMORE CT', 'hummelstown', 'PENNSYLVANIA', '17036', 'BillMicro', '$2y$10$WZj1ViSdOpZYgugVdw.Hp.Ai8zKpO1FkM433b6YFmy0mUhVNhgPF.', '2021-05-02 13:59:58', '2021-05-03 02:39:39'),
	('568f26db-aaef-11eb-8c9a-244bfeba3290', 'Andres', 'Restrepo', 'Restrepo', 'Montreal', 'Restrepo', 'H4E2T8', 'cami9411', '$2y$10$MoYRATLVv0UVlCv3q2hkTuMXJsU5qrL5NIU9XGcglBUs9NP.v5pU2', '2021-05-01 22:37:26', '2021-05-01 11:12:58'),
	('6b7ebb97-ab64-11eb-a7f8-244bfeba3290', 'Steve', 'Jobs', '343 Avenuee', 'Silicon Valley', 'California', 'G5D5F6', 'steve', '$2y$10$7EcufWufbCnXasT53gVT8uV/w6ipVhslqs.9nVTqhfmURyh1s1SCW', '2021-05-02 12:35:35', '2021-05-03 12:09:22'),
	('80641d9a-abc5-11eb-a7f8-244bfeba3290', 'Juan p.', 'Restrepo', 'Av Verdun', 'Montrèal', 'Quebec', 'h3r56d', 'juan', '$2y$10$eyw0KCyLy6r3dLq4fZuQJulyJo.tSMLJhazqR4oXMHVUVC6RidJJq', '2021-05-03 00:10:28', '2021-05-03 12:10:45'),
	('d7969603-abb1-11eb-a7f8-244bfeba3290', 'Linux', 'Torvals', 'Torvals', 'Montreal', 'Torvals', 'h4e2t8', 'linux', '$2y$10$IK.1bDdjiN3Ihf9.wbPdJ.5FXJm9d5AWGgSZvObUbrsr1KBQrfnyy', '2021-05-02 21:49:45', '2021-05-02 09:51:03');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;

-- Dumping structure for procedure database-1931815.customers_delete
DELIMITER //
CREATE PROCEDURE `customers_delete`(
	IN `input_CustomerID` VARCHAR(50)
)
BEGIN
-- Revision History:
-- DEVELOPER				DATE					COMMENTS
-- Camilo Restrepo 		2021-04-20			Created procedure to delete one data on the customers


-- This stored procedure is to delete one data on the products table with a custumer id input
	DELETE FROM customers WHERE customers.customerID = input_CustomerID;
	COMMIT;
END//
DELIMITER ;

-- Dumping structure for procedure database-1931815.customers_insert
DELIMITER //
CREATE PROCEDURE `customers_insert`(
	IN `firstname` VARCHAR(20),
	IN `lastname` VARCHAR(20),
	IN `address` VARCHAR(25),
	IN `city` VARCHAR(25),
	IN `province` VARCHAR(25),
	IN `postalcode` VARCHAR(7),
	IN `username` VARCHAR(12),
	IN `userpassword` VARCHAR(255)
)
BEGIN
-- Revision History:
-- DEVELOPER				DATE					COMMENTS
-- Camilo Restrepo 		2021-04-20 			Created procedure to insert one data on the customers


-- This stored procedure is to insert one data on the customers table
	INSERT INTO customers (c_firstname, c_lastname, c_address, c_city, c_province, c_postalcode, c_username, c_userpassword)
	VALUES (firstname, lastname, address, city, province, postalcode, username, userpassword);
END//
DELIMITER ;

-- Dumping structure for procedure database-1931815.customers_select_all
DELIMITER //
CREATE PROCEDURE `customers_select_all`()
BEGIN
-- Revision History:
-- DEVELOPER				DATE					COMMENTS
-- Camilo Restrepo 		2021-04-20 			Created procedure to get all rows in the table customers


-- This stored procedure to get all rows in the table customers
	SELECT 
		customers.customerID, customers.c_firstname, customers.c_lastname,
		customers.c_address, customers.c_city, customers.c_province, 
		customers.c_postalcode, customers.c_username, customers.c_userpassword
	FROM customers ORDER BY c_lastname;
END//
DELIMITER ;

-- Dumping structure for procedure database-1931815.customers_select_one
DELIMITER //
CREATE PROCEDURE `customers_select_one`(
	IN `input_customerID` VARCHAR(50)
)
BEGIN
-- Revision History:
-- DEVELOPER				DATE					COMMENTS
-- Camilo Restrepo 		2021-04-20 			Created procedure to get one row on the table customers
-- Camilo Restrepo 		2021-04-25 			Addition of field c_date_creation


-- This stored procedure is to retrieve one row from the table customers depenting on the customer id
		SELECT 
		customers.customerID, customers.c_firstname, customers.c_lastname,
		customers.c_address, customers.c_city, customers.c_province, 
		customers.c_postalcode, customers.c_username, customers.c_userpassword, customers.c_date_creation,
		customers.c_date_modification
	FROM customers WHERE customers.customerID = input_customerID;
END//
DELIMITER ;

-- Dumping structure for procedure database-1931815.customers_update
DELIMITER //
CREATE PROCEDURE `customers_update`(
	IN `input_CustomerID` VARCHAR(50),
	IN `firstname` VARCHAR(20),
	IN `lastname` VARCHAR(20),
	IN `address` VARCHAR(25),
	IN `city` VARCHAR(25),
	IN `province` VARCHAR(25),
	IN `postalcode` VARCHAR(7),
	IN `username` VARCHAR(12),
	IN `userpassword` VARCHAR(255)
)
BEGIN
-- Revision History:
-- DEVELOPER				DATE					COMMENTS
-- Camilo Restrepo 		2021-04-21 			Created procedure to update a row on the table customers


-- This stored procedure is to update one row on the table customers depending on a customer id
	UPDATE customers
	SET c_firstname = firstname, c_lastname = lastname, c_address = address, 
				c_city = city , c_province = province , c_postalcode= postalcode, 
				c_username = username, c_userpassword = userpassword, c_date_modification = NOW()
	WHERE CustomerID = input_CustomerID;
	COMMIT;
END//
DELIMITER ;

-- Dumping structure for procedure database-1931815.filter_by_date
DELIMITER //
CREATE PROCEDURE `filter_by_date`(
	IN `input_CustomerID` VARCHAR(50),
	IN `filter_date` DATETIME
)
BEGIN
-- Revision History:
-- DEVELOPER				DATE					COMMENTS
-- Camilo Restrepo 		2021-04-23 			Created procedure to retrive data from the purchase view  depending on a date


-- This stored procedure return the rows depending on the date and customerID
	IF ISNULL(filter_date) THEN
		SELECT 
				purchaseID, p_code, p_description, c_firstname, c_lastname, c_city, p_price, p_quantity,
				p_subtotal, p_taxes_amount, p_grand_total , p_comments, p_date_creation
		FROM purchases_fulldate_view
		WHERE purchases_fulldate_view.customerID = input_CustomerID
		ORDER BY purchases_fulldate_view.p_date_creation DESC;
	ELSE
		SELECT 
				purchaseID, p_code, p_description, c_firstname, c_lastname, c_city, p_price, p_quantity,
				p_subtotal, p_taxes_amount, p_grand_total , p_comments, p_date_creation
		FROM purchases_fulldate_view
		WHERE purchases_fulldate_view.customerID = input_CustomerID AND (p_date_creation >= filter_date)
		ORDER BY purchases_fulldate_view.p_date_creation DESC;
	END IF;
END//
DELIMITER ;

-- Dumping structure for procedure database-1931815.login
DELIMITER //
CREATE PROCEDURE `login`(
	IN `input_username` VARCHAR(12)
)
BEGIN
-- Revision History:
-- DEVELOPER				DATE					COMMENTS
-- Camilo Restrepo 		2021-04-19 			Created procedure to get the password hash depending on the username input by the customer


-- This stored procedure get the password hash depending on the username input by the customer
	SELECT c_userpassword, customerID
	FROM customers 
	WHERE customers.c_username = input_username;
END//
DELIMITER ;

-- Dumping structure for table database-1931815.products
CREATE TABLE IF NOT EXISTS `products` (
  `productID` varchar(36) NOT NULL DEFAULT uuid(),
  `p_code` varchar(12) NOT NULL,
  `p_description` varchar(100) DEFAULT NULL,
  `p_price` decimal(4,2) NOT NULL,
  `p_cost` decimal(4,2) DEFAULT NULL,
  `p_date_creation` datetime NOT NULL DEFAULT curtime(),
  `p_date_modification` datetime NOT NULL DEFAULT curtime(),
  PRIMARY KEY (`productID`),
  UNIQUE KEY `p_code` (`p_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table database-1931815.products: ~4 rows (approximately)
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`productID`, `p_code`, `p_description`, `p_price`, `p_cost`, `p_date_creation`, `p_date_modification`) VALUES
	('3896243d-aab1-11eb-8c9a-244bfeba3290', 'P2021QC', 'PHP - T-Shirt', 60.00, 20.00, '2021-05-01 15:12:45', '2021-05-01 15:12:46'),
	('5719fa6a-aab1-11eb-8c9a-244bfeba3290', 'P2023DC', 'JAVA - T-Shirt', 55.99, 30.00, '2021-05-01 15:13:39', '2021-05-01 15:13:40'),
	('6ca1baf1-aab1-11eb-8c9a-244bfeba3290', 'P2345DF', 'HTML- T-Shirt', 34.99, 10.00, '2021-05-01 15:14:14', '2021-05-01 15:14:15'),
	('7ed46059-aab1-11eb-8c9a-244bfeba3290', 'P3456DF', 'AJAX -T-Shirt', 56.99, 31.00, '2021-05-01 15:14:46', '2021-05-01 15:14:46');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

-- Dumping structure for procedure database-1931815.products_delete
DELIMITER //
CREATE PROCEDURE `products_delete`(
	IN `input_productID` VARCHAR(36)
)
BEGIN
-- Revision History:
-- DEVELOPER				DATE					COMMENTS
-- Camilo Restrepo 		2021-04-22 			Created procedure to delete one row on the table products


-- This stored procedure is to delete one row on table products
	DELETE FROM products WHERE productID = input_productID;
	COMMIT;

END//
DELIMITER ;

-- Dumping structure for procedure database-1931815.products_insert
DELIMITER //
CREATE PROCEDURE `products_insert`(
	IN `p_code` VARCHAR(12),
	IN `p_description` VARCHAR(100),
	IN `p_price` DECIMAL(4,2),
	IN `p_cost` DECIMAL(4,2)
)
BEGIN
-- Revision History:
-- DEVELOPER				DATE					COMMENTS
-- Camilo Restrepo 		2021-04-22 			Created procedure to insert one row on the table products


-- This stored procedure is to insert one row on table products
	INSERT INTO products(products.p_code, products.p_description, products.p_price, products.p_cost)
	VALUES(p_code,p_description,p_price,p_cost);

END//
DELIMITER ;

-- Dumping structure for procedure database-1931815.products_select_all
DELIMITER //
CREATE PROCEDURE `products_select_all`()
BEGIN
-- Revision History:
-- DEVELOPER				DATE					COMMENTS
-- Camilo Restrepo 		2021-04-21 			Created procedure to get all rows in the table products


-- This stored procedure to get all rows in the table products
	SELECT 
		 products.productID, products.p_code, products.p_description,
		 products.p_price, products.p_cost, products.p_date_creation
	FROM products;
END//
DELIMITER ;

-- Dumping structure for procedure database-1931815.products_select_one
DELIMITER //
CREATE PROCEDURE `products_select_one`(
	IN `input_productID` VARCHAR(50)
)
BEGIN
-- Revision History:
-- DEVELOPER				DATE					COMMENTS
-- Camilo Restrepo 		2021-04-21 			Created procedure to get one row on the table products
-- Camilo Restrepo 		2021-04-24 			Addition of field c_date_creation


-- This stored procedure is to retrieve one row from the table products depenting on the product id
	SELECT 
		products.productID, products.p_code, products.p_description, products.p_price,
		products.p_cost, products.p_date_creation
	FROM products WHERE products.productID = input_productID;
END//
DELIMITER ;

-- Dumping structure for procedure database-1931815.products_update
DELIMITER //
CREATE PROCEDURE `products_update`(
	IN `input_productID` VARCHAR(36),
	IN `pcode` VARCHAR(12),
	IN `description` VARCHAR(100),
	IN `price` DECIMAL(4,2),
	IN `cost` DECIMAL(4,2)
)
BEGIN
-- Revision History:
-- DEVELOPER				DATE					COMMENTS
-- Camilo Restrepo 		2021-04-22 			Created procedure to update a row on the table products


-- This stored procedure is to update one row on the table products depending on a product id
	UPDATE products
	SET p_code = pcode, p_description = description, p_price = price, 
				p_cost = cost , p_date_modification = NOW()
	WHERE productID = input_productID;
	COMMIT;
END//
DELIMITER ;

-- Dumping structure for table database-1931815.purchases
CREATE TABLE IF NOT EXISTS `purchases` (
  `purchaseID` varchar(36) NOT NULL DEFAULT uuid(),
  `productID` varchar(36) NOT NULL,
  `customerID` varchar(36) NOT NULL,
  `p_quantity` smallint(6) NOT NULL DEFAULT 1,
  `p_price` decimal(4,2) NOT NULL,
  `p_comments` varchar(200) DEFAULT NULL,
  `p_subtotal` decimal(7,2) NOT NULL,
  `p_taxes_amount` decimal(7,2) NOT NULL,
  `p_grand_total` decimal(7,2) NOT NULL,
  `p_date_creation` datetime NOT NULL DEFAULT curtime(),
  `p_date_modification` datetime NOT NULL DEFAULT curtime(),
  PRIMARY KEY (`purchaseID`),
  KEY `FK2_purchases_customers` (`customerID`),
  KEY `FK1_purchases_products` (`productID`),
  CONSTRAINT `FK1_purchases_products` FOREIGN KEY (`productID`) REFERENCES `products` (`productID`),
  CONSTRAINT `FK2_purchases_customers` FOREIGN KEY (`customerID`) REFERENCES `customers` (`customerID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table database-1931815.purchases: ~17 rows (approximately)
/*!40000 ALTER TABLE `purchases` DISABLE KEYS */;
INSERT INTO `purchases` (`purchaseID`, `productID`, `customerID`, `p_quantity`, `p_price`, `p_comments`, `p_subtotal`, `p_taxes_amount`, `p_grand_total`, `p_date_creation`, `p_date_modification`) VALUES
	('0489d8cb-abca-11eb-a7f8-244bfeba3290', '5719fa6a-aab1-11eb-8c9a-244bfeba3290', '35673545-ab70-11eb-a7f8-244bfeba3290', 1, 55.99, 'Amazing', 55.99, 8.51, 64.50, '2021-05-03 00:42:48', '2021-05-03 00:42:48'),
	('34d9c8c7-abbe-11eb-a7f8-244bfeba3290', '6ca1baf1-aab1-11eb-8c9a-244bfeba3290', '6b7ebb97-ab64-11eb-a7f8-244bfeba3290', 2, 34.99, '', 69.98, 10.64, 80.62, '2021-05-02 23:18:15', '2021-05-02 23:18:15'),
	('78681b75-ab04-11eb-8c9a-244bfeba3290', '5719fa6a-aab1-11eb-8c9a-244bfeba3290', '568f26db-aaef-11eb-8c9a-244bfeba3290', 2, 55.99, '', 111.98, 17.02, 129.00, '2021-05-02 01:08:42', '2021-05-02 01:08:42'),
	('792c0b90-ab7a-11eb-a7f8-244bfeba3290', '7ed46059-aab1-11eb-8c9a-244bfeba3290', '35673545-ab70-11eb-a7f8-244bfeba3290', 2, 56.99, '', 113.98, 17.32, 131.30, '2021-05-02 15:13:27', '2021-05-02 15:13:27'),
	('7debb97d-abc4-11eb-a7f8-244bfeba3290', '6ca1baf1-aab1-11eb-8c9a-244bfeba3290', '35673545-ab70-11eb-a7f8-244bfeba3290', 1, 34.99, 'Amazing', 34.99, 5.32, 40.31, '2021-05-03 00:03:15', '2021-05-03 00:03:15'),
	('8eeedc59-abba-11eb-a7f8-244bfeba3290', '7ed46059-aab1-11eb-8c9a-244bfeba3290', 'd7969603-abb1-11eb-a7f8-244bfeba3290', 1, 56.99, '', 56.99, 8.66, 65.65, '2021-05-02 22:52:08', '2021-05-02 22:52:08'),
	('91bfbfd3-abba-11eb-a7f8-244bfeba3290', '6ca1baf1-aab1-11eb-8c9a-244bfeba3290', 'd7969603-abb1-11eb-a7f8-244bfeba3290', 3, 34.99, '', 104.97, 15.96, 120.93, '2021-05-02 22:52:13', '2021-05-02 22:52:13'),
	('93380f01-abb1-11eb-a7f8-244bfeba3290', '5719fa6a-aab1-11eb-8c9a-244bfeba3290', '35673545-ab70-11eb-a7f8-244bfeba3290', 1, 55.99, 'For my family', 55.99, 8.51, 64.50, '2021-05-02 21:47:50', '2021-05-02 21:47:50'),
	('96be382b-abba-11eb-a7f8-244bfeba3290', '5719fa6a-aab1-11eb-8c9a-244bfeba3290', 'd7969603-abb1-11eb-a7f8-244bfeba3290', 4, 55.99, 'Amazing 2', 223.96, 34.04, 258.00, '2021-05-02 22:52:21', '2021-05-02 22:52:21'),
	('9804bfc8-abc5-11eb-a7f8-244bfeba3290', '7ed46059-aab1-11eb-8c9a-244bfeba3290', '80641d9a-abc5-11eb-a7f8-244bfeba3290', 2, 56.99, '', 113.98, 17.32, 131.30, '2021-05-03 00:11:08', '2021-05-03 00:11:08'),
	('9c1aba01-abba-11eb-a7f8-244bfeba3290', '3896243d-aab1-11eb-8c9a-244bfeba3290', 'd7969603-abb1-11eb-a7f8-244bfeba3290', 1, 60.00, '', 60.00, 9.12, 69.12, '2021-05-02 22:52:30', '2021-05-02 22:52:30'),
	('9cedbbd9-abc5-11eb-a7f8-244bfeba3290', '6ca1baf1-aab1-11eb-8c9a-244bfeba3290', '80641d9a-abc5-11eb-a7f8-244bfeba3290', 3, 34.99, 'Buying on Sale', 104.97, 15.96, 120.93, '2021-05-03 00:11:16', '2021-05-03 00:11:16'),
	('d281372e-ab0c-11eb-8c9a-244bfeba3290', '7ed46059-aab1-11eb-8c9a-244bfeba3290', '568f26db-aaef-11eb-8c9a-244bfeba3290', 1, 56.99, 'Amazing', 56.99, 8.66, 65.65, '2021-05-02 02:08:29', '2021-05-02 02:08:29'),
	('dbc69e55-ab0c-11eb-8c9a-244bfeba3290', '3896243d-aab1-11eb-8c9a-244bfeba3290', '568f26db-aaef-11eb-8c9a-244bfeba3290', 1, 60.00, 'Amazing', 60.00, 9.12, 69.12, '2021-05-02 02:08:45', '2021-05-02 02:08:45'),
	('e22c0ac5-abc0-11eb-a7f8-244bfeba3290', '3896243d-aab1-11eb-8c9a-244bfeba3290', '35673545-ab70-11eb-a7f8-244bfeba3290', 2, 60.00, 'Amazing', 120.00, 18.24, 138.24, '2021-05-02 23:37:25', '2021-05-02 23:37:25'),
	('fa164bac-abca-11eb-a7f8-244bfeba3290', '6ca1baf1-aab1-11eb-8c9a-244bfeba3290', '6b7ebb97-ab64-11eb-a7f8-244bfeba3290', 1, 34.99, '', 34.99, 5.32, 40.31, '2021-05-03 00:49:40', '2021-05-03 00:49:40');
/*!40000 ALTER TABLE `purchases` ENABLE KEYS */;

-- Dumping structure for procedure database-1931815.purchases_delete
DELIMITER //
CREATE PROCEDURE `purchases_delete`(
	IN `input_purchaseID` VARCHAR(36)
)
BEGIN
-- Revision History:
-- DEVELOPER				DATE					COMMENTS
-- Camilo Restrepo 		2021-04-23 			Created procedure to delete one row on the table purchases


-- This stored procedure is to delete one row on table purchases
	DELETE FROM purchases WHERE purchaseID = input_purchaseID;
	COMMIT;
END//
DELIMITER ;

-- Dumping structure for view database-1931815.purchases_fulldate_view
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `purchases_fulldate_view` (
	`purchaseID` VARCHAR(36) NOT NULL COLLATE 'utf8mb4_general_ci',
	`customerID` VARCHAR(36) NOT NULL COLLATE 'utf8mb4_general_ci',
	`c_username` VARCHAR(12) NOT NULL COLLATE 'utf8mb4_general_ci',
	`c_lastname` VARCHAR(20) NOT NULL COLLATE 'utf8mb4_general_ci',
	`c_firstname` VARCHAR(20) NOT NULL COLLATE 'utf8mb4_general_ci',
	`c_city` VARCHAR(25) NULL COLLATE 'utf8mb4_general_ci',
	`productID` VARCHAR(36) NOT NULL COLLATE 'utf8mb4_general_ci',
	`p_code` VARCHAR(12) NOT NULL COLLATE 'utf8mb4_general_ci',
	`p_price` DECIMAL(4,2) NOT NULL,
	`p_quantity` SMALLINT(6) NOT NULL,
	`p_subtotal` DECIMAL(7,2) NOT NULL,
	`p_taxes_amount` DECIMAL(7,2) NOT NULL,
	`p_grand_total` DECIMAL(7,2) NOT NULL,
	`p_description` VARCHAR(100) NULL COLLATE 'utf8mb4_general_ci',
	`p_comments` VARCHAR(200) NULL COLLATE 'utf8mb4_general_ci',
	`p_date_creation` DATETIME NOT NULL
) ENGINE=MyISAM;

-- Dumping structure for procedure database-1931815.purchases_insert
DELIMITER //
CREATE PROCEDURE `purchases_insert`(
	IN `productID` VARCHAR(36),
	IN `customerID` VARCHAR(36),
	IN `quantity` SMALLINT,
	IN `price` DECIMAL(4,2),
	IN `comments` VARCHAR(200),
	IN `subtotal` DECIMAL(7,2),
	IN `taxes` DECIMAL(7,2),
	IN `total` DECIMAL(7,2)
)
BEGIN
-- Revision History:
-- DEVELOPER				DATE					COMMENTS
-- Camilo Restrepo 		2021-04-23 			Created procedure to insert one row on the table purchases


-- This stored procedure is to insert one row on table purchases
	INSERT INTO purchases (productID, customerID, p_quantity, p_price, p_comments, p_subtotal, p_taxes_amount, p_grand_total)
	VALUES (productID, customerID, quantity, price, comments, subtotal, taxes, total);
END//
DELIMITER ;

-- Dumping structure for procedure database-1931815.purchases_select_all
DELIMITER //
CREATE PROCEDURE `purchases_select_all`()
BEGIN
-- Revision History:
-- DEVELOPER				DATE					COMMENTS
-- Camilo Restrepo 		2021-04-23 			Created procedure to get all rows in the table purchases


-- This stored procedure to get all rows in the table purchases
	SELECT purchaseID, productID, customerID, p_quantity, p_price,
			 p_comments, p_subtotal, p_taxes_amount, p_grand_total
	FROM purchases;
END//
DELIMITER ;

-- Dumping structure for procedure database-1931815.purchases_select_one
DELIMITER //
CREATE PROCEDURE `purchases_select_one`(
	IN `input_purchaseID` VARCHAR(36)
)
BEGIN
-- Revision History:
-- DEVELOPER				DATE					COMMENTS
-- Camilo Restrepo 		2021-04-23 			Created procedure to get one row on the table purchases
-- Camilo Restrepo 		2021-04-24 			Addition of field c_date_creation


-- This stored procedure is to retrieve one row from the table purchases depenting on the purchase id
	SELECT 
			purchases.purchaseID, purchases.productID, purchases.customerID, purchases.p_quantity, purchases.p_price,
			purchases.p_comments, purchases.p_subtotal, purchases.p_taxes_amount, purchases.p_grand_total, purchases.p_date_creation
	FROM purchases WHERE purchases.purchaseID = input_purchaseID;
END//
DELIMITER ;

-- Dumping structure for procedure database-1931815.purchases_update
DELIMITER //
CREATE PROCEDURE `purchases_update`(
	IN `input_productID` VARCHAR(36),
	IN `input_customerID` VARCHAR(36),
	IN `quantity` SMALLINT,
	IN `price` DECIMAL(4,2),
	IN `subtotal` DECIMAL(7,2),
	IN `taxes_amount` DECIMAL(7,2),
	IN `grand_total` DECIMAL(7,2),
	IN `date_modification` DATETIME
)
BEGIN
-- Revision History:
-- DEVELOPER				DATE					COMMENTS
-- Camilo Restrepo 		2021-04-22 			Created procedure to update a row on the table purchases


-- This stored procedure is to update one row on the table purchases depending on a purchase id
	UPDATE purchases
	SET productID = input_productID, customerID = input_customerID, p_quantity = quantity, 
				p_price = price , p_comments = comments , p_subtotal= subtotal, 
				p_taxes_amount = taxes_amount, p_grand_total = grand_total, p_date_modification= date_modification
	WHERE purchaseID = input_purchaseID;
	COMMIT;
END//
DELIMITER ;

-- Dumping structure for view database-1931815.purchases_fulldate_view
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `purchases_fulldate_view`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `purchases_fulldate_view` AS select `purchases`.`purchaseID` AS `purchaseID`,`purchases`.`customerID` AS `customerID`,`customers`.`c_username` AS `c_username`,`customers`.`c_lastname` AS `c_lastname`,`customers`.`c_firstname` AS `c_firstname`,`customers`.`c_city` AS `c_city`,`purchases`.`productID` AS `productID`,`products`.`p_code` AS `p_code`,`purchases`.`p_price` AS `p_price`,`purchases`.`p_quantity` AS `p_quantity`,`purchases`.`p_subtotal` AS `p_subtotal`,`purchases`.`p_taxes_amount` AS `p_taxes_amount`,`purchases`.`p_grand_total` AS `p_grand_total`,`products`.`p_description` AS `p_description`,`purchases`.`p_comments` AS `p_comments`,`purchases`.`p_date_creation` AS `p_date_creation` from ((`purchases` join `customers` on(`purchases`.`customerID` = `customers`.`customerID`)) join `products` on(`purchases`.`productID` = `products`.`productID`));

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
