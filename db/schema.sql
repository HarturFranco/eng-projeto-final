USE toca_dos_instrumentos;
CREATE TABLE `user` (
    id integer not null,
    is_active boolean ,
    created_date datetime not null,
    name varchar(200)
);
SET character_set_client = utf8;
SET character_set_connection = utf8;
SET character_set_results = utf8;
SET collation_connection = utf8_general_ci;

INSERT INTO user (id, is_active, created_date, name) VALUES (1, 1, "2018-07-21", 'João Fulano');