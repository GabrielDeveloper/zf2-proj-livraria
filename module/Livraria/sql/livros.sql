
CREATE TABLE livros(
liv_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
liv_title VARCHAR(100) NOT NULL,
liv_cat_id INT NOT NULL,
liv_description TEXT,
liv_author VARCHAR(100),
liv_img VARCHAR(30),
liv_img_url VARCHAR(75)
)CHARACTER SET utf8 COLLATE utf8_general_ci;

