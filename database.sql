CREATE DATABASE IF NOT EXISTS laravel_instagram;

USE laravel_instagram;

CREATE TABLE IF NOT EXISTS users(
    id  int(255) auto_increment not null,
    role    varchar(20),
    name    varchar(100),
    surname varchar(200),
    nick    varchar(100),
    email   varchar(255),
    password    varchar(255),
    image   varchar(255),
    created_at  datetime,
    updated_at  datetime,
    remember_token  varchar(255),
    CONSTRAINT pk_users PRIMARY KEY(id)
)ENGINE=InnoDb;

INSERT INTO users VALUES(NULL, 'user', 'Martin', 'Zayas', 'mzayas', 'admin@example.com', 'admin', NULL, CURTIME(), CURTIME(), NULL);
INSERT INTO users VALUES(NULL, 'user', 'Alejandra', 'Parra', 'aleparra', 'alejandra@example.com', 'admin', NULL, CURTIME(), CURTIME(), NULL);
INSERT INTO users VALUES(NULL, 'user', 'Manuel', 'Zayas', 'manuzayas', 'manuel@example.com', 'admin', NULL, CURTIME(), CURTIME(), NULL);

CREATE TABLE IF NOT EXISTS images(
    id  int(255) auto_increment not null,
    user_id    int(255),
    image_path    varchar(255),
    description text,
    created_at  datetime,
    updated_at  datetime,
    CONSTRAINT pk_images PRIMARY KEY(id),
    CONSTRAINT fk_images_users FOREIGN KEY(user_id) REFERENCES users(id)
)ENGINE=InnoDb;

INSERT INTO images VALUES(NULL, 1, 'test.jpg', 'Descripción de prueba', CURTIME(), CURTIME());
INSERT INTO images VALUES(NULL, 1, 'test2.jpg', 'Descripción de prueba2', CURTIME(), CURTIME());
INSERT INTO images VALUES(NULL, 1, 'test3.jpg', 'Descripción de prueba3', CURTIME(), CURTIME());
INSERT INTO images VALUES(NULL, 1, 'test4.jpg', 'Descripción de prueba4', CURTIME(), CURTIME());
INSERT INTO images VALUES(NULL, 3, 'prueba.jpg', 'Descripción de prueba de prueba', CURTIME(), CURTIME());


CREATE TABLE IF NOT EXISTS comments(
    id  int(255) auto_increment not null,
    user_id    int(255),
    image_id    int(255),
    content text,
    created_at  datetime,
    updated_at  datetime,
    CONSTRAINT pk_comments PRIMARY KEY(id),
    CONSTRAINT fk_comments_users FOREIGN KEY(user_id) REFERENCES users(id),
    CONSTRAINT fk_comments_images FOREIGN KEY(image_id) REFERENCES images(id)
)ENGINE=InnoDb;

INSERT INTO comments VALUES(NULL, 1, 4, 'Buena foto de familia', CURTIME(), CURTIME());
INSERT INTO comments VALUES(NULL, 2, 1, 'Buena foto de familia2', CURTIME(), CURTIME());
INSERT INTO comments VALUES(NULL, 2, 4, 'que bueno', CURTIME(), CURTIME());
INSERT INTO comments VALUES(NULL, 1, 4, 'Buena foto de familia3', CURTIME(), CURTIME());


CREATE TABLE IF NOT EXISTS likes(
    id  int(255) auto_increment not null,
    user_id    int(255),
    image_id    int(255),
    created_at  datetime,
    updated_at  datetime,
    CONSTRAINT pk_likes PRIMARY KEY(id),
    CONSTRAINT fk_likes_users FOREIGN KEY(user_id) REFERENCES users(id),
    CONSTRAINT fk_likes_images FOREIGN KEY(image_id) REFERENCES images(id)
)ENGINE=InnoDb;

INSERT INTO likes VALUES(NULL, 1, 1, CURTIME(), CURTIME());
INSERT INTO likes VALUES(NULL, 1, 2, CURTIME(), CURTIME());
INSERT INTO likes VALUES(NULL, 2, 1, CURTIME(), CURTIME());
INSERT INTO likes VALUES(NULL, 3, 1, CURTIME(), CURTIME());
INSERT INTO likes VALUES(NULL, 3, 4, CURTIME(), CURTIME());
