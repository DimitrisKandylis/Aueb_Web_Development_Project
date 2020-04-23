create database airBNB;
use airbnb;

create table airbnb.users (
	username varchar(30),
  pass varchar(30),
  fname varchar(30),
  lname varchar(30),
  image mediumblob, /*MEDIUMBLOB for 16777215 bytes (16 MB)*/
  email varchar(40),
	place varchar(40),
	description varchar(100),
	primary key(username)
);

/*INSERT INTO airbnb.users VALUES ('iron_bullet','12345','Giorgos','Theofilatos','temp.png','3120044@dias','Athens','I play ryu. How are you?');
INSERT INTO airbnb.users VALUES ('Kyuzo15','12345','Dimitris','Kandylis','temp.png','p3120053@dias','Athens','whats good?');
INSERT INTO airbnb.users VALUES ('MasterMind','12345','Xristos','Magoulas','temp.png','p3120099@dias','Space','I enjoy long walks on the beach.');
INSERT INTO airbnb.users VALUES ('test','12','img','test','temp.png','img@test','here','just testing');
INSERT INTO airbnb.users VALUES ('wizzey','12345','Spyros','Tsatsakis','temp.png','p3120190@dias','Kriti','stfu Im raiding');
*/

create table airbnb.houses (
	id int primary key auto_increment,
	title varchar(100),
  image mediumblob, /*MEDIUMBLOB for 16777215 bytes (16 MB)*/
  location varchar(30),
  description varchar(300),
  check_in varchar(100),
  check_out varchar(40),
	type varchar(45),
  visitors varchar(25),
  owner_name varchar(30),
	price double,
  FOREIGN  key(owner_name) references airbnb.users(username)
);

/*INSERT INTO airbnb.houses (title,image,location,description,check_in,check_out,type,visitors)
 VALUES ('Cabin in the Woods','temp.png','Parnitha','Lovely, isolated cabin on the mountain.','00:00','16:00','Communal Room','21');
INSERT INTO airbnb.houses VALUES ('Apartment in the center of New York','temp.png','New York','Newly renovated true two bedroom located in Midtown West. Apartment features king size bedrooms, separate gourmet kitchen with stainless appliances, cherry wood cabinets, bath, huge living room, hardwood floors and tons of closet space.','12:00','15:30','Private Room');
INSERT INTO airbnb.houses VALUES ('Apartment near Akropolis','temp.png','Athens','Beautiful apartment 10 minutes away from the Akropolis museum. The apartment consists of 1 bathroom, 1 kitchen and 1 main room.','10:00','00:00','Whole House');
INSERT INTO airbnb.houses VALUES ('Cabin in the Woods','temp.png','Parnitha','Lovely, isolated cabin on the mountain.','00:00','16:00','Communal Room');
INSERT INTO airbnb.houses VALUES ('Maisonette in Kifisia','temp.png','Kifisia, Athens','2 storey maisonette in the outskirts of Kifisia. 4 bedrooms, 2 bathrooms, 1 kitchen and a large pool.','12:30','16:30','Whole House');
*/

create table airbnb.reservations (
	id int primary key auto_increment,
	username varchar(30),
	house_id int,
  arrival date,
  departure date,
  visitors varchar(30),
  rating int ,
  comment varchar(120),
  foreign key(username) references users(username),
  foreign key(house_id) references houses(id)
);


/*Create the user and GRANT him privileges*/

Create user 'adam'@'localhost' IDENTIFIED BY 'root'; 

GRANT ALL PRIVILEGES ON airBNB.* TO 'adam'@'localhost' 
