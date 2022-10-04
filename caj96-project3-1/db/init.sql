

CREATE TABLE tags(
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    tag TEXT NOT NULL UNIQUE
);

INSERT INTO
    tags(id, tag)
VALUES
    (1,'exploratroy constructive play');

INSERT INTO
    tags(id, tag)
VALUES
    (2,'exploratroy sensory play');

INSERT INTO
    tags(id, tag)
VALUES
    (3,'physical play');

INSERT INTO
    tags(id, tag)
VALUES
    (4,'imaginative play');

INSERT INTO
    tags(id, tag)
VALUES
    (5,'restorative play');

INSERT INTO
    tags(id, tag)
VALUES
    (6,'expressive play');

INSERT INTO
    tags(id, tag)
VALUES
    (7,'play with rules');

INSERT INTO
    tags(id, tag)
VALUES
    (8,'bio play');

INSERT INTO
    tags(id, tag)
VALUES
    (9,'pernnial');

INSERT INTO
    tags(id, tag)
VALUES
    (10,'annual');

INSERT INTO
    tags(id, tag)
VALUES
    (11, 'full sun');

INSERT INTO
    tags(id, tag)
VALUES
    (12,'partial shade');

INSERT INTO
    tags(id, tag)
VALUES
    (13,'full shade');
INSERT INTO
    tags(id, tag)
VALUES
    (14,'shrub');

INSERT INTO
    tags(id, tag)
VALUES
    (15,'grass');

INSERT INTO
    tags(id, tag)
VALUES
    (16,'vine');

INSERT INTO
    tags(id, tag)
VALUES
    (17,'tree');

INSERT INTO
    tags(id, tag)
VALUES
    (18,'flower');

INSERT INTO
    tags(id, tag)
VALUES
    (19,'ground cover');



CREATE TABLE plants(
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    playful_plant_id TEXT NOT NULL UNIQUE,
    c_name TEXT NOT NULL,
    s_name TEXT NOT NULL UNIQUE,
    file_extension TEXT
);

INSERT INTO plants
(id, playful_plant_id, c_name, s_name , file_extension)
VALUES
(1,'GA_15', 'Giant Iron Weed', 'Veroninia gigantea', NULL);

INSERT INTO plants
(id, playful_plant_id, c_name, s_name, file_extension)
VALUES(
    2, "FL_26" , "Lady's Mantle", "Alchemillia Mollis", 'jpg' );

INSERT INTO plants
(id, playful_plant_id, c_name, s_name, file_extension)
VALUES(
    3, "GR_03" , "American Cranberry", "Vaccinium macrocarpon", NULL );

INSERT INTO plants
(id, playful_plant_id, c_name, s_name, file_extension)
VALUES
(4, "SH_19" , "Jostaberry", "Ribes x nidgrolaria" , NULL);

INSERT INTO plants
(id, playful_plant_id, c_name, s_name, file_extension)
VALUES
(5, "TR_30" , "Camperdown Elm", "Ulmus galbra 'Camperdownill" , NULL);


INSERT INTO plants
(id, playful_plant_id,  c_name, s_name, file_extension)
VALUES
(6, "GR_09" , "Houseleek 'Mahogany'" , "Sempervivum rubellum Mahogony'" , NULL );

INSERT INTO plants
(id, playful_plant_id, c_name, s_name, file_extension)
VALUES
(7, "GR_07" , "Ham & Chicks 'Red Lion'" , "Sempervivum'Red Lion'" , NULL );

INSERT INTO plants
(id, playful_plant_id, c_name, s_name, file_extension)
VALUES
(8, "SH_01" , "Silky Willow" , "Salix sericea"  , NULL);

INSERT INTO plants
(id, playful_plant_id, c_name, s_name, file_extension)
VALUES
(9, "SH_29" , "Red Osier Dogwood (Red Twig Dogwood)" , "Cornus sericea" , "jpg" );

INSERT INTO plants
(id, playful_plant_id, c_name, s_name, file_extension)
VALUES
(10, "TR_23" , "River Birch" , "Betula nigra" , "jpg" );

INSERT INTO plants
(id, playful_plant_id, c_name, s_name, file_extension)
VALUES
(11, "SH_33" , "Flowering Rasperry" , "Rubus odoratus", "jpg" );


INSERT INTO
plants(id, playful_plant_id, c_name, s_name, file_extension)
VALUES
(12, "FL_05" , "Spiked Gray-Feather" , "Liatris spicata" , "jpg" );


CREATE TABLE plants_tags (
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    plant_id INTEGER  NOT NULL,
    tag_id INTEGER NOT NULL,
    FOREIGN KEY (plant_id) REFERENCES  plants(id),
    FOREIGN KEY (tag_id) REFERENCES tags(id)
);

INSERT INTO
plants_tags(id, plant_id, tag_id)
VALUES
(1, 1, 1);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (2, 1, 2);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (3, 1, 4);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (4, 1, 5);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (5, 1, 7);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (6, 1, 8);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (7, 1, 8);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (8, 1, 9);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (9, 1, 11);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (10, 1, 12);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (11, 2, 2);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (12, 2, 3);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (13, 2, 4);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (14, 2, 7);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (15, 2, 9);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (16, 2, 11);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (17, 2, 12);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (18, 3, 2);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (19, 3, 3);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (20, 3, 4);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (21, 3, 8);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (22, 3, 11);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (23, 4, 2);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (24, 4, 3);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (25, 4, 8);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (26, 4, 11);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (27, 4, 12);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (28, 5, 1);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (29, 5, 2);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (30, 5, 3);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (31, 5, 5);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (32, 5, 9);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (33, 5, 11);


INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (34, 6, 2);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (35, 6, 4);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (36, 6, 8);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (37, 6, 9);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (38, 6, 11);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (39, 6, 12);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (40, 7, 2);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (41, 7, 4);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (42, 7, 8);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (43, 7, 9);


INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (44, 7, 11);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (45, 7, 12);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (46, 8, 1);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (47, 8, 2);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (48, 8, 3);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (49, 8, 5);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (50, 8, 8);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (51, 8, 9);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (52, 8, 11);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (53, 8, 12);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (55, 9, 2);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (56, 9, 3);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (57, 9, 7);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (58, 9, 8);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (59, 9, 9);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (60, 9, 11);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (61, 9, 12);


INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (62, 10, 1);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (63, 10, 2);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (64, 10, 3);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (65, 10, 9);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (66, 10, 11);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (67, 10, 12);


INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (68, 11, 1);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (69, 11, 2);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (70, 11, 3);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (71, 11, 4);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (72, 11, 8);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (73, 11, 9);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (74, 11, 11);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (75, 11, 12);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (76, 12, 2);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (77, 12, 3);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (78, 12, 8);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (80, 12, 9);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (81, 12, 11);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (82, 12, 12);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (83, 1, 14);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (84, 2, 18);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (85, 3, 19);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (86, 4, 14);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (87, 4, 14);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (88, 5, 17);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (89, 6, 19);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (90, 7, 19);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (91, 8, 14);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (92, 9, 14);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (93, 10, 17);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (94, 11, 14);

INSERT INTO plants_tags(id, plant_id, tag_id)
VALUES (95, 12, 18);


CREATE TABLE users(
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    username TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL
);

INSERT INTO users(id, username, password)
VALUES (1, "Caitlyn", "$2y$10$QtCybkpkzh7x5VN11APHned4J8fu78.eFXlyAMmahuAaNcbwZ7FH.");

CREATE TABLE sessions(
    id INTEGER NOT NULL PRIMARY KEY  AUTOINCREMENT UNIQUE,
    user_id INTEGER NOT NULL,
    session TEXT NOT NULL UNIQUE,
    last_login TEXT NOT NULL,
    FOREIGN KEY(user_id) REFERENCES user(id)

);
