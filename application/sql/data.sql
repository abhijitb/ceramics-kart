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
