create table Musique  
( 
nom_musique  varchar(30) DEFAULT NULL,  
nom_artiste varchar(30) DEFAULT NULL, 
album varchar(30) DEFAULT NULL, 
annee_publication DATE DEFAULT NULL, 
PRIMARY KEY (nom_musique) 
); 
 
 
INSERT INTO Musique ( nom_musique, nom_artiste, album, annee_publication) Values 
('Tokyo', 'Jul','Rien 100 rien', '2020-06-14'), 
('Sous la lune', 'Jul','Rien 100 rien', '2020-06-14'), 
('Parole', 'Dalida','Julien...', '1972-04-04'), 
('another one bite the dust', 'Queen', 'The game', '1980-09-22'), 
('JCVD', 'Jul','Rien 100 rien', '2020-06-14'), 
('crazy frog', 'Daniel Malmedahl','','2005-07-23'); 
 
 
 
select * from musique