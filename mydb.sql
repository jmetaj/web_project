create table users (
    id int   AUTO_INCREMENT,
    username varchar(255) NOT NULL,
    email varchar(255) NOT NULL,
	pass varchar(255) NOT NULL,
    ismod BOOLEAN NOT NULL default 0,
	primary key(id)
    );
	
create table cases (
    id int ,
    dates date,
    PRIMARY key(id, dates),	 
	foreign key(id) references users(id)
	on delete cascade on update cascade 

);	



create table visits (
    u_id int,
	v_id varchar(255) ,
	dates TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	primary key(u_id, v_id),
	foreign key(u_id) references users(id)
	on delete cascade on update cascade ,
	foreign key(v_id) references POI(id)
	on delete cascade on update cascade 
	
);	



create table POI (
	id varchar (255) ,
    name varchar (255) NOT NULL,
    address varchar(255) NOT NULL,
    types varchar(255),
    lat float,
    lng float,
    rating float,
    rating_n int,
    populartimes int,
    Monday varchar (30),
    Tuesday varchar (30),
    Wednesday varchar (30),
    Thursday varchar (30),
    Friday varchar (30),
    Saturday varchar (30),
    Sunday varchar (30),
    PRIMARY KEY (id)
);	