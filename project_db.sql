
CREATE TABLE users(
  users_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  username VARCHAR(45) UNIQUE NOT NULL,
  password VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  isadmin tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (users_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE store (
  store_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  store_name VARCHAR(100) NOT NULL,
  latitude DECIMAL(10, 8) NOT NULL,
  longitude DECIMAL(11, 8) NOT NULL,
  PRIMARY KEY (store_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE category (
  category_id VARCHAR(50),
  category_name VARCHAR(100) NOT NULL,
  PRIMARY KEY (category_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE subcategories (
  subcategory_id VARCHAR(50) PRIMARY KEY,
  subcategory_name VARCHAR(100) NOT NULL,
  category_id VARCHAR(50),
  FOREIGN KEY (category_id) REFERENCES category (category_id) ON DELETE RESTRICT  ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;;



CREATE TABLE product (
  product_id INT UNSIGNED AUTO_INCREMENT,
  product_name VARCHAR(100) NOT NULL,
  subcategory_id VARCHAR(50), 
  PRIMARY KEY (product_id),
  CONSTRAINT `fk_category_product` FOREIGN KEY (subcategory_id) REFERENCES subcategories (subcategory_id) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE offer (
  offer_id INT UNSIGNED AUTO_INCREMENT,
  store_id INT UNSIGNED NOT NULL,
  product_id INT UNSIGNED NOT NULL,
  users_id INT UNSIGNED NOT NULL,
  price DECIMAL(5, 2) NOT NULL,
  stock ENUM('ΝΑΙ', 'ΟΧΙ') NOT NULL DEFAULT 'ΝΑΙ',
  likes SMALLINT DEFAULT 0,
  dislikes SMALLINT DEFAULT 0,
  submission_date TIMESTAMP,
  expiration_date TIMESTAMP,
  active BOOLEAN,
  PRIMARY KEY (offer_id),
  CONSTRAINT `fk_store_offer` FOREIGN KEY (store_id) REFERENCES store (store_id) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `fk_product_offer` FOREIGN KEY (product_id) REFERENCES product (product_id) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `fk_user_offer` FOREIGN KEY (users_id) REFERENCES users (users_id) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE offer_evaluation (
  offer_id INT UNSIGNED ,
  users_id INT UNSIGNED ,
  evaluation ENUM('LIKE', 'DISLIKE') NOT NULL,
  stock_status ENUM('ΕΞΑΝΤΛΗΘΗΚΕ', 'ΣΕ ΑΠΟΘΕΜΑ'),
  PRIMARY KEY (offer_id, users_id),
  CONSTRAINT `fk_offer_evaluation_offer` FOREIGN KEY (offer_id) REFERENCES offer (offer_id) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `fk_offer_evaluation_user` FOREIGN KEY (users_id) REFERENCES users (users_id) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE tokens (
  users_id INT UNSIGNED ,
  tokens_date DATE ,
  tokens_received INT UNSIGNED DEFAULT 0,
  PRIMARY KEY (users_id, tokens_date),
  CONSTRAINT `fk_tokens_user` FOREIGN KEY (users_id) REFERENCES users (users_id) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE scores(
	users_id INT UNSIGNED,
    offer_id INT UNSIGNED,
    offer_date DATETIME NOT NULL,
    score INT UNSIGNED default 0,
    PRIMARY KEY (users_id, offer_id),
    CONSTRAINT `fk_user_scores` FOREIGN KEY (users_id) REFERENCES users (users_id) ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT `fk_offer_scores` FOREIGN KEY (offer_id) REFERENCES offer (offer_id) ON DELETE RESTRICT ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE prices(
	product_id INT UNSIGNED,
    price_date DATE,
    price DECIMAL(5, 2) NOT NULL,
    PRIMARY KEY (product_id, price_date),
    CONSTRAINT `fk_product_prices` FOREIGN KEY (product_id) REFERENCES product (product_id) ON DELETE RESTRICT ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE Images (
  image_id INT PRIMARY KEY AUTO_INCREMENT,
  offer_id INT UNSIGNED,
  image_url VARCHAR(255) NOT NULL,
  FOREIGN KEY (offer_id) REFERENCES Offer(offer_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;