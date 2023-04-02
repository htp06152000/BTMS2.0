SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*CREATE TABLE*/


CREATE TABLE users (
    user_id bigint(20) PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(1000) NOT NULL,
    role VARCHAR(30) NOT NULL,
    first_name VARCHAR(255) NOT NULL,
    middle_name VARCHAR(255) NULL,
    last_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NULL UNIQUE) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `users` (`username`, `password`, `role`, `first_name`, `last_name`)
VALUES ('admin', '21232f297a57a5a743894a0e4a801fc3', 'ADMINISTRATOR', 'System', 'Administrator');

/*residents*/
CREATE TABLE resident (
  residentID bigint(15) NOT NULL AUTO_INCREMENT,
  user_ID bigint(15) NOT NULL,
  residentLName varchar(30) NOT NULL,
  residentFName varchar(30) NOT NULL,
  residentMName varchar(30) NULL,
  residentBdate Date NOT NULL,
  residentAge int NOT NULL,
  residentCivilStatus varchar(15) NOT NULL,
  residentGender varchar(15) NOT NULL,
  residentZoneNumber varchar(5) NOT NULL,
  residentContactNumber varchar (11) NOT NULL,
  residentOccupation varchar(15) NOT NULL,
  residentImage varchar (255) DEFAULT NULL, 
  primary key (residentID),
  foreign key (user_ID) references users(user_ID))ENGINE=InnoDB DEFAULT CHARSET=latin1;
  

/*blotter*/
CREATE TABLE blotter (
  blotterID bigint(50) primary key NOT NULL AUTO_INCREMENT,
  user_ID bigint(15) NOT NULL,
  date_recorded date NOT NULL,
  complainant varchar(50) NOT NULL,
  c_address varchar(100) NOT NULL,
  c_contact varchar(11) NOT NULL,
  person_to_complain varchar(50) NOT NULL,
  p_address varchar(100) NOT NULL,
  p_contact varchar(11) NOT NULL,
  complaint text(1000) NOT NULL,
  action_taken text(1000) NOT NULL,
  complaint_status varchar(50) NOT NULL,
  location_of_incidence varchar(50) NOT NULL,
  foreign key (user_ID) references users(user_ID))ENGINE=InnoDB DEFAULT CHARSET=latin1;
 
 /*services*/
  CREATE TABLE services (
  servicesID bigint(8) NOT NULL AUTO_INCREMENT,
  services varchar(30) NOT NULL,
  price varchar(4) NOT NULL,
  primary key (servicesID))ENGINE=InnoDB DEFAULT CHARSET=latin1;
  
  INSERT INTO `services` (`servicesID`, `services`, `price`) 
  VALUES ('1', 'Barangay clearance', '25'), ('2', 'Certificate of Indigency', '25'), ('3', 'Business permit', '50');
  
/*transaction*/
CREATE TABLE transaction(
  transactionID bigint(30) NOT NULL AUTO_INCREMENT,
  residentID bigint(50) NOT NULL,
  servicesID bigint(8) NOT NULL,
  type_of_doc varchar(15) NOT NULL,
  business_name varchar(50) NULL,
  business_address varchar(100) NULL,
  type_of_business varchar(50) NULL,
  pickupdate date NOT NULL,
  purpose varchar(30) NULL,
  dateRecorded date NOT NULL,
  amount float NOT NULL,
  email VARCHAR(255) NULL UNIQUE,
  trackingnumber varchar(100) NULL,
  status varchar(20) NOT NULL,
  primary key (transactionID),
  foreign key (residentID) references resident(residentID),
  foreign key (servicesID) references services(servicesID))ENGINE=InnoDB DEFAULT CHARSET=latin1;
  
  ALTER TABLE transaction AUTO_INCREMENT = 1000000001;
COMMIT;