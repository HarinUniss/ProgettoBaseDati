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
alter table Utenti modify foto char(100);

alter table Utenti add dataora datetime;
drop table Animali;
create table Animali(
	id_animale integer not null unique,
    nome char(30) not null,
    razza char(50),
    eta integer not null check(eta>=0),
    sesso char(1) not null check(sesso = 'F' OR sesso = "M"),
    provenienza char(50),
    pedigree boolean,
    foto char(200),
    proprietario integer not null, 
    primary key(id_animale),
    foreign key(razza)references Razze(razza)
    on delete cascade
    on update cascade,
    foreign key(proprietario)references Utenti(id_utente)
    on delete cascade
	on update cascade
);
alter table Animali add dataora datetime;

create table Razze(
	razza char(50) not null unique primary key,
    specie char(50)
);

alter table Animali drop constraint proprietario;
alter table Animali modify proprietario  integer not null;
alter table Animali change età eta integer not null check(età>=0); /*Rinomino la colonna eta*/

create table Credenziali(
	username char(50) not null unique primary key,
    password char(100) not null,
    proprietario integer not null,
    foreign key(proprietario)references Utenti(id_utente)
    on delete cascade
    on update cascade
);
drop table Preferiti;
create table Preferiti(
	animale integer not null,
    utente integer not null,
    primary key(animale, utente),
    foreign key(animale)references Animali(id_animale)
    on delete cascade
    on update cascade,
    foreign key(utente) references Utenti(id_utente)
    on update cascade
    on delete cascade
);
--
-- drop table Credenziali;
-- show tables;
--
-- insert into Utenti(id_utente, cognome, nome, indirizzo, civico, citta, telefono, email, foto, tipo)
-- VALUES(0, 'Pippo', 'Bello', 'via Disney', 5, 'Disneyland', '+09 1531245684', 'p.b@mail.com', null, 'utente');
-- insert into utenti(id_utente, cognome, nome, indirizzo, civico, citta, telefono, email, foto, tipo)
-- VALUES(1, 'Mimmo', 'Bello', 'via Disney', 7, 'Disneyland', '+19 1433275989', 'm.b@mail.com', null, 'allevamento');
-- insert into utenti(id_utente, cognome, nome, indirizzo, civico, citta, telefono, email, foto, tipo)
-- VALUES(2, 'San Petrino ', null, 'via Miguel XXX', 99, 'Milano', '+01 1234567891', 'canilesanpetrino@canili.com', null, 'canile');
-- select * from Utenti;
--
-- insert into Credenziali(username, password, proprietario)
-- VALUES('pippello', '1234', 0);
--
-- insert into Credenziali(username, password, proprietario)
-- VALUES('mimmetto', '1234', 1);
--
-- insert into Credenziali(username, password, proprietario)
-- VALUES('sanPietroCanile00', '1234', 2);
--
-- insert into Animali(id_animale,  nome, razza, specie, età, sesso, provenienza, pedigree, foto, proprietario)
-- VALUES('0', 'Sergione', 'Husky', 'Cane', '2', 'M', 'Sassari', false, null, 0);
-- select * from Animali;
--
-- delete from Animali where Animali.id_animale = 501962;
-- update Razze set razza = "Corso", specie = "Cane" where razza = "Canina";
-- update Animali set razza = "Corso" where razza = "Canina";
--
--
-- /*Query per avere una tabella con nome animale e proprietario, sarebbe più utile invece avere A.id_animale*/
-- select A.nome, U.nome, U.cognome from Animali as A, Utenti as U where A.proprietario = U.id_utente;
--
-- select *
-- from Utenti as u, Credenziali as c
-- where u.id_utente = c.proprietario;
--
-- select * from Utenti;
--
-- insert into Preferito
--
-- select *
-- from Credenziali;
--
-- select C.username, C.password
-- from Credenziali as C
-- where C.username = "UsaiGio" /*and C.password = "36aea3b7f8113b19482015d2c44cd6f603c86a2c"*/;
--
-- /*Query per la modifica di un elemento nella tabella*/
-- update Utenti set indirizzo = "via Cavalier Pietro" where id_utente = 308135;
--
-- delete from Utenti where Utenti.id_utente = 6242329;
-- select * from Utenti, Credenziali where Utenti.id_utente = 6374145 and Credenziali.proprietario = 6374145;
-- delete from Credenziali where Credenziali.proprietario = 5002884;