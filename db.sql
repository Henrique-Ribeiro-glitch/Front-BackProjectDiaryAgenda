create table agendas(
    id int not null auto_increment,
    appointment varchar(500),
    date date,
    start_time time(4),
    end_time time(4),
    importance int(1),
    urgency int(1),
    primary key(id)
    );

create table diary(
    id int not null auto_increment,
    date date,
    hour time,
    objective varchar(250),
    goals varchar(250),
    thingsDone varchar(250),
    thingsLeftUndone varchar(250),
    thingsToThanks varchar(250),
    primary key(id)
    );
