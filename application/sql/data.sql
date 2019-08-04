create table lists (
  id int NOT NULL AUTO_INCREMENT,
  group_id int(11),
  first_name varchar(255),
  last_name varchar(255),
  mobile_number varchar(255),
  amount varchar(255),
  code varchar(20),
  created_date int(11),
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


create table tracking (
    id int NOT NULL AUTO_INCREMENT,
    ip varchar(255),
    code varchar(255),
    useragent varchar(255),
    created_date int(11),
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE sms_reports (
  id int(11) NOT NULL AUTO_INCREMENT,
  message_id VARCHAR(255) DEFAULT NULL,
  message text,
  code VARCHAR(255),
  mobile_number VARCHAR(255),
  status VARCHAR(255),
  errorcode VARCHAR(255),
  vars VARCHAR(255),
  created_date int(11),
  updated_date int(11),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE tracking_info (
    id int(11) NOT NULL AUTO_INCREMENT,
    first_name varchar(255),
    last_name varchar(255),
    mobile_number varchar(255),
    amount varchar(255),
    code varchar(20),
    ip varchar(255),
    user_agent varchar(255),
    created_date int(11),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


create user 'shorturl'@'localhost' identified by '5h0rturl';

CREATE TABLE `list_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `rest_api_logs` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `uri` VARCHAR(255) NOT NULL,
  `method` VARCHAR(6) NOT NULL,
  `params` TEXT DEFAULT NULL,
  `api_key` VARCHAR(40) NOT NULL,
  `ip_address` VARCHAR(45) NOT NULL,
  `time` INT(11) NOT NULL,
  `rtime` FLOAT DEFAULT NULL,
  `authorized` VARCHAR(1) NOT NULL,
  `response_code` smallint(3) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `rest_api_keys` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NOT NULL,
  `key` VARCHAR(40) NOT NULL,
  `level` INT(2) NOT NULL,
  `ignore_limits` TINYINT(1) NOT NULL DEFAULT '0',
  `is_private_key` TINYINT(1)  NOT NULL DEFAULT '0',
  `ip_addresses` TEXT NULL DEFAULT NULL,
  `date_created` INT(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


create table item_master (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  item_number_internal int(15),
  manufacturer_item_number varchar(40),
  description_01 varchar(40),
  description_02 varchar(40),
  description_03 varchar(40),
  manufacturer_number	int(5),
  line_of_business_1 varchar(10),
  line_of_business_2 varchar(10),
  line_of_business_3 varchar(10),
  item_type varchar(10),
  product_category varchar(10),
  line_of_business varchar(40),
  product_status varchar(10),
  length_in_mm int(12),
  width_in_mm int(12),
  height_in_mm int(12),
  length_in_cm int(12),
  width_in_cm int(12),
  height_in_cm int(12),
  length_in_ft int(12),
  width_in_ft int(12),
  height_in_ft int(12),
  amount_sale int(15),
  amount_cost int(15),
  amount_discount int(15),
  future_field_string_01 varchar(10),
  future_field_string_02 varchar(10),
  future_field_string_03 varchar(20),
  future_field_string_04 varchar(30),
  future_field_string_05 varchar(30),
  future_field_string_06 varchar(40),
  future_field_numeric_01 int(15),
  future_field_numeric_02 int(15),
  future_field_numeric_03 int(15),
  future_field_numeric_04 int(15),
  date_01 date,
  date_02 date,
  date_03 date,
  date_04 date,
  time_updated time,
  date_updated date,
  user_id varchar(10),
  PRIMARY KEY (id, item_number_internal, manufacturer_item_number, manufacturer_number)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table manufacturer_master (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  manufacturer_number int(10),
  manufacturer_name varchar(40),
  address_01 varchar(40),
  address_02 varchar(40),
  address_03 varchar(40),
  address_04 varchar(40),
  city varchar(40),
  state varchar(2),
  country varchar(40),
  time_updated time,
  date_updated date,
  user_id varchar(10),
  PRIMARY KEY (id, manufacturer_number)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


create table dealer_master_list (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  dealer_number int(15),
  manufacturer_number int(15),
  dealer_name varchar(40),
  address_01 varchar(40),
  address_02 varchar(40),
  address_03 varchar(40),
  address_04 varchar(40),
  city varchar(40),
  state varchar(2),
  country varchar(40),
  land_line_phone_1 int(15),
  land_line_phone_2 int(15),
  mobile_1 int(15),
  mobile_2 int(15),
  dealer_email varchar(40),
  dealer_website varchar(40),
  time_open time,
  time_close time,
  day_close varchar(40),
  time_updated time,
  date_updated date,
  user_id varchar(10),
  PRIMARY KEY (id, dealer_name, dealer_number, city)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table retailer_master_list (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  retailer_number int(15),
  retailer_name varchar(40),
  dealer_number varchar(40),
  manufacturer_number varchar(40),
  address_01 varchar(40),
  address_02 varchar(40),
  address_03 varchar(40),
  address_04 varchar(40),
  city varchar(40),
  state varchar(2),
  country varchar(40),
  land_line_phone_1 int(15),
  land_line_phone_2 int(15),
  mobile_1 int(15),
  mobile_2 int(15),
  dealer_email varchar(40),
  dealer_website varchar(40),
  time_open time,
  time_close time,
  day_close varchar(40),
  time_updated time,
  date_updated date,
  user_id varchar(10),
  PRIMARY KEY (id, retailer_number, retailer_name, dealer_number, manufacturer_number, city)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


create table item_retailer_mapping (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  item_number_internal int(15),
  supplier_item_number varchar(40),
  manufacturer_number int(15),
  retailer_number int(15),
  dealer_number int(15),
  nearest_location varchar(40),
  city varchar(40),
  state varchar(2),
  country varchar(40),
  time_updated time,
  date_updated date,
  user_id varchar(10),
  PRIMARY KEY (id, item_number_internal, supplier_item_number, manufacturer_number, retailer_number, dealer_number, city)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


create table application_list (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  application_id int(15),
  application_name varchar(40),
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

insert into application_list (application_id, application_name) values (1, 'Bathroom'),(2, 'Bedroom'),(3, 'Drawing Room'),(4, 'Kitchen'),(5, 'Outdoor'),(6, 'Office');

create table product_by_application (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  item_number_internal int(15),
  supplier_item_number varchar(40),
  application varchar(40),
  time_updated time,
  date_updated date,
  user_id varchar(10),
  PRIMARY KEY (id, item_number_internal, supplier_item_number, application)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table item_by_application_and_colour (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  sl_no int(10),
  size varchar(40),
  retailer_number int(15),
  dealer_number int(15),
  manufacturer_number int(15),
  city varchar(40),
  product_id int(10),
  product_name varchar(100),
  product_type varchar(40),
  product_group varchar(40),
  application varchar(40),
  colour varchar(40),
  finish varchar(40),
  length_in_mm int(12),
  width_in_mm int(12),
  height_in_mm int(12),
  length_in_cm int(12),
  width_in_cm int(12),
  height_in_cm int(12),
  length_in_ft int(12),
  width_in_ft int(12),
  height_in_ft int(12),
  time_updated time,
  date_updated date,
  user_id varchar(10),
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


create table city_master (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  code int(15),
  city_name varchar(40),
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

insert into city_master (code, city_name) values (1, 'Mumbai'),(2, 'Thane');

create table colour_master (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  code int(15),
  name varchar(40),
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

insert into colour_master (code, name) values (1, 'White'),(2, 'Black');

CREATE TABLE csv_data (
  id int(11) NOT NULL AUTO_INCREMENT,
  csv_filename varchar(255),
  csv_header varchar(255),
  csv_data longtext,
  created_at int(11),
  updated_at int(11),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE ci_sessions (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned DEFAULT 0 NOT NULL,
  `data` blob NOT NULL,
  KEY `ci_sessions_timestamp` (`timestamp`),
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE user_location (
	id INT(11) NOT NULL AUTO_INCREMENT,
	session_id varchar(128),
	country_code VARCHAR(5),
	country_name VARCHAR(100),
	city VARCHAR(150),
	postal VARCHAR(10),
  state VARCHAR(50),
	latitude VARCHAR(10),
	longitude VARCHAR(10),
	ip_address VARCHAR(50),
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE city_locations (
	id INT(11) NOT NULL AUTO_INCREMENT,
	geoname_id int(20),
	locale_code VARCHAR(255),
	continent_code VARCHAR(255),
	continent_name VARCHAR(255),
	country_iso_code VARCHAR(255),
	country_name VARCHAR(255),
	subdivision_1_iso_code VARCHAR(255),
	subdivision_1_name VARCHAR(255),
	subdivision_2_iso_code VARCHAR(255),
	subdivision_2_name VARCHAR(255),
	city_name VARCHAR(255),
	metro_code VARCHAR(255),
	time_zone VARCHAR(255),
	is_in_european_union VARCHAR(255),
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE blocks_ipv4 (
	id INT(11) NOT NULL AUTO_INCREMENT,
	network VARCHAR(255),
  geoname_id VARCHAR(255),
  registered_country_geoname_id VARCHAR(255),
  represented_country_geoname_id VARCHAR(255),
  is_anonymous_proxy VARCHAR(255),
  is_satellite_provider VARCHAR(255),
  postal_code VARCHAR(255),
  latitude VARCHAR(255),
  longitude VARCHAR(255),
  accuracy_radius VARCHAR(255),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE reviews (
  id int(11) NOT NULL AUTO_INCREMENT,
  tile_code varchar(255),
  name varchar(255),
  email varchar(255),
  rating int(1),
  status varchar(15),
  message longtext,
  created_at int(11),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


create table retailers (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  retailer_number int(15),
  retailer_name varchar(40),
  dealer_number varchar(40),
  manufacturer_number varchar(40),
  address_01 varchar(40),
  address_02 varchar(40),
  address_03 varchar(40),
  address_04 varchar(40),
  city varchar(40),
  state varchar(2),
  country varchar(40),
  land_line_phone_1 int(15),
  land_line_phone_2 int(15),
  mobile_1 int(15),
  mobile_2 int(15),
  dealer_email varchar(40),
  dealer_website varchar(40),
  time_open time,
  time_close time,
  day_close varchar(40),
  time_updated time,
  date_updated date,
  user_id varchar(10),
  PRIMARY KEY (id, retailer_number, retailer_name, dealer_number, manufacturer_number, city)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table tile_views (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  no_of_views int(10), 
  sl_no int(10),
  size varchar(40),
  retailer_number int(15),
  dealer_number int(15),
  manufacturer_number int(15),
  city varchar(40),
  product_id int(10),
  product_name varchar(100),
  product_type varchar(40),
  product_group varchar(40),
  application varchar(40),
  colour varchar(40),
  finish varchar(40),
  length_in_mm int(12),
  width_in_mm int(12),
  height_in_mm int(12),
  length_in_cm int(12),
  width_in_cm int(12),
  height_in_cm int(12),
  length_in_ft int(12),
  width_in_ft int(12),
  height_in_ft int(12),
  time_updated time,
  date_updated date,
  user_id varchar(10),
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
