CREATE DATABASE incidentmonitor;
use incidentmonitor;

CREATE TABLE incidents (
  id int PRIMARY KEY ,
  image_name VARCHAR(20),
  computer_name varchar(20),
  log_date datetime  
);

INSERT INTO incidents (id,image_name, computer_name, log_date)
VALUES
(1,'abc.jpeg','laptop123','2022-04-12 3:15:15'),
(2,'xyz.jpeg','laptop126','2022-04-15 5:15:15'),
(3,'abc.jpg','laptop135','2022-04-18 9:15:15'),
(4,'xyz.jpg','laptop12','2022-04-20 12:15:15');


delete  from incidents where id=4;

INSERT INTO incidents (id,image_name, computer_name, log_date)
VALUES
(5,'xyz.jpg','laptop12','2022-04-20 12:15:15');


CREATE TABLE keywordtable (
  number int PRIMARY KEY ,
  keyword VARCHAR(20)
);

INSERT INTO keywordtable (number,keyword)
VALUES
(1,'xyz');