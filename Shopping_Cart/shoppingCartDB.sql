



-- ---
-- Globals
-- ---

-- SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
-- SET FOREIGN_KEY_CHECKS=0;

-- ---
-- Table users
-- customers, who may or may not yet have provided their details.
-- ---

		
CREATE TABLE users (
  id INTEGER NOT NULL AUTO_INCREMENT,
  full_name VARCHAR(255) NULL DEFAULT NULL,
  street_address VARCHAR(255) NULL DEFAULT NULL,
  city VARCHAR(255) NULL DEFAULT NULL,
  post_code VARCHAR(255) NULL DEFAULT NULL,
  country VARCHAR(255) NULL DEFAULT NULL,
  username VARCHAR(255) NULL DEFAULT NULL,
  password VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (id)
) COMMENT 'customers, who may or may not yet have provided their detail';

-- ---
-- Table items
-- The items that are available for sale
-- ---

DROP TABLE IF EXISTS items;
		
CREATE TABLE items (
  id INTEGER NOT NULL AUTO_INCREMENT,
  item_name VARCHAR(255) NOT NULL,
  item_desciption VARCHAR(255) NOT NULL,
  unit_price DECIMAL(11,2) NOT NULL,
  picture_file_name VARCHAR(255) NOT NULL,
  PRIMARY KEY (id)
) COMMENT 'The items that are available for sale';

-- ---
-- Table orders
-- an open shopping cart or a completed order. Possible states are open, in progress and shipped.
-- ---

DROP TABLE IF EXISTS orders;
		
CREATE TABLE orders (
  id INTEGER NOT NULL AUTO_INCREMENT,
  order_state VARCHAR(255) NOT NULL,
  order_total_value DECIMAL(11,2) NULL DEFAULT NULL COMMENT 'NULL until order is submitted(IN_PROGRESS)',
  user_id INTEGER NOT NULL COMMENT 'The customer who owns this order.',
  PRIMARY KEY (id)
) COMMENT 'an open shopping cart or a completed order. Possible states ';

-- ---
-- Table items_orders
-- A many to many relationship between orders and items.
-- ---

DROP TABLE IF EXISTS items_orders;
		
CREATE TABLE items_orders (
  id INTEGER NOT NULL AUTO_INCREMENT,
  order_id INTEGER NOT NULL,
  item_id INTEGER NOT NULL,
  PRIMARY KEY (id)
) COMMENT 'A many to many relationship between orders and items.';

-- ---
-- Foreign Keys 
-- ---

ALTER TABLE orders ADD FOREIGN KEY (user_id) REFERENCES users (id);
ALTER TABLE items_orders ADD FOREIGN KEY (order_id) REFERENCES orders (id);
ALTER TABLE items_orders ADD FOREIGN KEY (item_id) REFERENCES items (id);

-- ---
-- Table Properties
-- ---

-- ALTER TABLE users ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE items ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE orders ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE items_orders ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ---
-- Test Data
-- ---

-- INSERT INTO users (id,full_name,street_address,city,post_code,country,username,password) VALUES
-- (,,,,,,,);
-- INSERT INTO items (id,item_name,item_desciption,unit_price,picture_file_name) VALUES
-- (,,,,);
-- INSERT INTO orders (id,order_state,order_total_value,user_id) VALUES
-- (,,,);
-- INSERT INTO items_orders (id,order_id,item_id) VALUES
-- (,,);

