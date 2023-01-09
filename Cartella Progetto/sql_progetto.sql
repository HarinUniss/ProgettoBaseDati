create database db_progetto;
drop database db_progetto;
show databases;
use db_progetto;
drop table  Utenti;
create table Utenti(
	id_utente integer not null unique primary key,
    cognome char(50),
    nome char(50),
    indirizzo char(100) default 'via nome_via',
    civico smallint(5) default 00000,
    citta char(100) not null,
    telefono char(20) not null,
    email char(50) not null,
    foto blob,
    tipo char(12) not null check(tipo = 'canile' OR tipo = 'allevamento' OR tipo = 'utente')
);

alter table Utenti modify tipo integer not null;
drop table Animali;
create table Animali(
	id_animale integer not null unique,
    nome char(20) not null,
    razza char(25),
    specie char(50),
    età integer not null check(età>=0),
    sesso char(1) not null check(sesso = 'F' OR sesso = "M"),
    provenienza char(50),
    pedigree boolean,
    foto blob,
    proprietario integer not null, 
    primary key(id_animale),
    foreign key(proprietario)references Utenti(id_utente)
    on delete cascade
	on update cascade
);
create table Credenziali(
	username char(50) not null unique primary key,
    password char(100) not null,
    proprietario integer not null,
    foreign key(proprietario)references Utenti(id_utente)
    on delete cascade
    on update cascade
);

drop table Credenziali;
show tables;

insert into Utenti(id_utente, cognome, nome, indirizzo, civico, citta, telefono, email, foto, tipo)
VALUES(0, 'Pippo', 'Bello', 'via Disney', 5, 'Disneyland', '+09 1531245684', 'p.b@mail.com', null, 'utente');
insert into utenti(id_utente, cognome, nome, indirizzo, civico, citta, telefono, email, foto, tipo)
VALUES(1, 'Mimmo', 'Bello', 'via Disney', 7, 'Disneyland', '+19 1433275989', 'm.b@mail.com', null, 'allevamento');
insert into utenti(id_utente, cognome, nome, indirizzo, civico, citta, telefono, email, foto, tipo)
VALUES(2, 'San Petrino ', null, 'via Miguel XXX', 99, 'Milano', '+01 1234567891', 'canilesanpetrino@canili.com', null, 'canile');
select * from Utenti;

insert into Credenziali(username, password, proprietario)
VALUES('pippello', '1234', 0);

insert into Credenziali(username, password, proprietario)
VALUES('mimmetto', '1234', 1);

insert into Credenziali(username, password, proprietario)
VALUES('sanPietroCanile00', '1234', 2);

insert into Animali(id_animale,  nome, razza, specie, età, sesso, provenienza, pedigree, foto, proprietario)
VALUES('0', 'Sergione', 'Husky', 'Cane', '2', 'M', 'Sassari', false, null, 0);
select * from Animali;

/*Query per avere una tabella con nome animale e proprietario, sarebbe più utile invece avere A.id_animale*/
select A.nome, U.nome, U.cognome from Animali as A, Utenti as U where A.proprietario = U.id_utente;

select *
from Utenti as u, Credenziali as c
where u.id_utente = c.proprietario;

select * from Utenti;

select *
from Utenti, Credenziali;

select cognome, nome
from Utenti;

select C.username, C.password
from Credenziali as C
where C.username = "pp" and C.password = "36aea3b7f8113b19482015d2c44cd6f603c86a2c";
