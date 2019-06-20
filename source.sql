-- we don't know how to generate root <with-no-name> (class Root) :(
create table area_academica
(
	id int auto_increment
		primary key,
	nombre varchar(50) not null
);

create table carreras
(
	id int auto_increment
		primary key,
	nombre varchar(20) not null,
	descripcion varchar(80) not null
);

create table migrations
(
	id int unsigned auto_increment
		primary key,
	migration varchar(255) not null,
	batch int not null
)
collate=utf8mb4_unicode_ci;

create table modalidades
(
	id int auto_increment
		primary key,
	descripcion varchar(50) not null,
	secuencia int not null,
	constraint modalidades_secuencia_uindex
		unique (secuencia)
);

create table password_resets
(
	email varchar(255) not null,
	token varchar(255) not null,
	created_at timestamp null
)
collate=utf8mb4_unicode_ci;

create index password_resets_email_index
	on password_resets (email);

create table role_user
(
	id bigint unsigned auto_increment
		primary key,
	role_id int unsigned not null,
	user_id int unsigned not null,
	created_at timestamp null,
	updated_at timestamp null
)
collate=utf8mb4_unicode_ci;

create table roles
(
	id bigint unsigned auto_increment
		primary key,
	name varchar(255) not null,
	description varchar(255) not null,
	created_at timestamp null,
	updated_at timestamp null
)
collate=utf8mb4_unicode_ci;

create table sustentando
(
	id int auto_increment
		primary key,
	tema text null,
	fecha_alta date not null,
	folio varchar(50) default '' null,
	modalidad int null,
	constraint sustentando_modalidades_id_fk
		foreign key (modalidad) references modalidades (id)
);

create table tipo_dictamen
(
	id int auto_increment
		primary key,
	descripcion varchar(60) not null,
	secuencia int not null,
	constraint tipo_dictamen_secuencia_uindex
		unique (secuencia)
);

create table users
(
	id bigint unsigned auto_increment
		primary key,
	name varchar(255) not null,
	email varchar(255) not null,
	email_verified_at timestamp null,
	password varchar(255) not null,
	remember_token varchar(100) null,
	created_at timestamp null,
	updated_at timestamp null,
	constraint users_email_unique
		unique (email)
)
collate=utf8mb4_unicode_ci;

create table evaluadores
(
	id int auto_increment
		primary key,
	nombre varchar(50) not null,
	paterno varchar(50) not null,
	materno varchar(50) not null,
	usuario bigint unsigned null,
	identificador varchar(30) not null,
	constraint evaluadores_identificador_uindex
		unique (identificador),
	constraint evaluadores_users_id_fk
		foreign key (usuario) references users (id)
			on delete cascade
);

create table aplicacion_conocimiento
(
	id int auto_increment
		primary key,
	titulo text not null,
	asesor int null,
	area int null,
	planteamiento text null,
	justificacion text null,
	objetivo text null,
	metodologia text null,
	referencias text null,
	cronograma text null,
	sustentando int null,
	constraint aplicacion_conocimiento_area_academica_id_fk
		foreign key (area) references area_academica (id),
	constraint aplicacion_conocimiento_evaluadores_id_fk
		foreign key (asesor) references evaluadores (id),
	constraint aplicacion_conocimiento_sustentando_id_fk
		foreign key (sustentando) references sustentando (id)
			on delete cascade
);

create table articulo
(
	id int auto_increment
		primary key,
	titulo_tentativo text null,
	asesor int null,
	coasesor int null,
	revista text null,
	indice text null,
	descripcion text null,
	referencias text null,
	area int null,
	sustentando int null,
	constraint articulo_area_academica_id_fk
		foreign key (area) references area_academica (id),
	constraint articulo_evaluadores_id_fk
		foreign key (asesor) references evaluadores (id),
	constraint articulo_evaluadores_id_fk_2
		foreign key (coasesor) references evaluadores (id),
	constraint articulo_sustentando_id_fk
		foreign key (sustentando) references sustentando (id)
			on delete cascade
);

create table autoempleo
(
	id int auto_increment
		primary key,
	titulo text null,
	inicio date null,
	fin date null,
	asesor int null,
	area int null,
	planteamiento text null,
	justificacion text null,
	objetivo text null,
	referencias text null,
	sustentando int null,
	cronograma text null,
	constraint autoempleao_area_academica_id_fk
		foreign key (area) references area_academica (id),
	constraint autoempleao_evaluadores_id_fk
		foreign key (asesor) references evaluadores (id),
	constraint autoempleao_sustentando_id_fk
		foreign key (sustentando) references sustentando (id)
			on delete cascade
);

create table ensayo
(
	id int auto_increment
		primary key,
	tema text not null,
	asesor int not null,
	area int not null,
	descripcion text null,
	justificacion text null,
	cronograma text null,
	sustentando int null,
	referencias text null,
	constraint ensayo_area_academica_id_fk
		foreign key (area) references area_academica (id),
	constraint ensayo_evaluadores_id_fk
		foreign key (asesor) references evaluadores (id),
	constraint ensayo_sustentando_id_fk
		foreign key (sustentando) references sustentando (id)
			on delete cascade
);

create table investigacion
(
	id int auto_increment
		primary key,
	responsable text null,
	asesor int null,
	coasesor int null,
	area int null,
	titulo_proyecto text null,
	descripcion text null,
	titulo_reporte text null,
	objetivo text null,
	cronograma text null,
	sustentando int null,
	clave varchar(30) null,
	inicio date null,
	fin date null,
	constraint investigacion_area_academica_id_fk
		foreign key (area) references area_academica (id),
	constraint investigacion_evaluadores_id_fk
		foreign key (asesor) references evaluadores (id),
	constraint investigacion_evaluadores_id_fk_2
		foreign key (coasesor) references evaluadores (id),
	constraint investigacion_sustentando_id_fk
		foreign key (sustentando) references sustentando (id)
			on delete cascade
);

create table memoria_laboral
(
	id int auto_increment
		primary key,
	inicio date not null,
	fin date not null,
	asesor int null,
	justificacion text null,
	desc_experiencia text null,
	area int not null,
	objetivo text null,
	referencias text null,
	cronograma text null,
	sustentando int null,
	constraint memoria_area_academica_id_fk
		foreign key (area) references area_academica (id),
	constraint memoria_asesores_id_fk
		foreign key (asesor) references evaluadores (id),
	constraint memoria_laboral_sustentando_id_fk
		foreign key (sustentando) references sustentando (id)
			on delete cascade
);

create table revisores_sustentando
(
	id int auto_increment
		primary key,
	evaluador int null,
	evaluando int null,
	constraint revisores_sustentando_evaluadores_id_fk
		foreign key (evaluador) references evaluadores (id)
			on update cascade on delete cascade,
	constraint revisores_sustentando_sustentando_id_fk
		foreign key (evaluando) references sustentando (id)
			on delete cascade
);

create table sustentantes
(
	id int auto_increment
		primary key,
	nombre varchar(50) not null,
	paterno varchar(50) not null,
	materno varchar(50) not null,
	cuenta varchar(20) null,
	usuario bigint unsigned null,
	carrera int null,
	constraint sustentantes_carreras_id_fk
		foreign key (carrera) references carreras (id),
	constraint sustentantes_users_id_fk
		foreign key (usuario) references users (id)
			on delete cascade
);

create table tesina
(
	id int auto_increment
		primary key,
	titulo text null,
	asesor int null,
	area int null,
	planteamiento text null,
	justificacion text null,
	objetivo text null,
	metodologia text null,
	referencias text null,
	cronograma text null,
	sustentando int null,
	constraint tesina_area_academica_id_fk
		foreign key (area) references area_academica (id),
	constraint tesina_evaluadores_id_fk
		foreign key (asesor) references evaluadores (id)
			on update cascade on delete cascade,
	constraint tesina_sustentando_id_fk
		foreign key (sustentando) references sustentando (id)
			on delete cascade
);

create table tesis
(
	id int auto_increment
		primary key,
	titulo text null,
	asesor int null,
	coasesor int null,
	area int null,
	planteamiento text null,
	justificacion text null,
	hipotesis text null,
	objetivo text null,
	metodologia text null,
	referencias text null,
	cronograma text null,
	sustentando int null,
	constraint tesis_area_academica_id_fk
		foreign key (area) references area_academica (id),
	constraint tesis_evaluadores_id_fk
		foreign key (asesor) references evaluadores (id),
	constraint tesis_evaluadores_id_fk_2
		foreign key (coasesor) references evaluadores (id),
	constraint tesis_sustentando_id_fk
		foreign key (sustentando) references sustentando (id)
			on delete cascade
);

create index users_id_index
	on users (id);

create table versiones
(
	id int auto_increment
		primary key,
	fecha date not null,
	sustentado int null,
	constraint versiones_sustentando_id_fk
		foreign key (sustentado) references sustentando (id)
			on update cascade on delete cascade
);

create table reportes
(
	id int auto_increment
		primary key,
	fecha date not null,
	titulo text null,
	sugerencias text null,
	evaluador int null,
	dictamen int null,
	versiones int null,
	constraint reportes_evaluadores_id_fk
		foreign key (evaluador) references evaluadores (id)
			on update cascade on delete cascade,
	constraint reportes_tipo_dictamen_id_fk
		foreign key (dictamen) references tipo_dictamen (id)
			on update cascade on delete cascade,
	constraint reportes_versiones_id_fk
		foreign key (versiones) references versiones (id)
			on update cascade on delete cascade
);

create table obs_app_conocimiento
(
	id int auto_increment
		primary key,
	titulo text null,
	area text null,
	planteamiento text null,
	justificacion text null,
	objetivo text null,
	metodologia text null,
	referencias text null,
	cronograma text null,
	otras text null,
	sugerencias text null,
	reporte int null,
	constraint obs_app_conocimiento_reportes_id_fk
		foreign key (reporte) references reportes (id)
);

create table obs_articulo
(
	id int auto_increment
		primary key,
	titulo_tentativo text null,
	indice text null,
	revista text null,
	descripcion text null,
	referencias text null,
	area text null,
	otras text null,
	sugerencias text null,
	reporte int null,
	constraint obs_articulo_reportes_id_fk
		foreign key (reporte) references reportes (id)
);

create table obs_autoempleo
(
	id int auto_increment
		primary key,
	titulo text null,
	periodo text null,
	asesor text null,
	area text null,
	planteamiento text null,
	justificacion text null,
	objetivo text null,
	referencias text null,
	otros text null,
	susgerencias text null,
	reporte int null,
	constraint obs_autoempleo_reportes_id_fk
		foreign key (reporte) references reportes (id)
);

create table obs_ensayo
(
	id int auto_increment
		primary key,
	tema text null,
	area text null,
	descripcion text null,
	justificacion text null,
	referencias text null,
	cronograma text null,
	otras text null,
	susgerencias text null,
	reporte int null,
	constraint obs_ensayo_reportes_id_fk
		foreign key (reporte) references reportes (id)
);

create table obs_investigacion
(
	id int auto_increment
		primary key,
	area text null,
	titulo_proyecto text null,
	descripcion text null,
	titulo_reporte text null,
	objetivo text null,
	planificacion text null,
	otras text null,
	sugerencias text null,
	reporte int null,
	constraint obs_investigacion_reportes_id_fk
		foreign key (reporte) references reportes (id)
);

create table obs_memoria
(
	id int auto_increment
		primary key,
	titulo varchar(1000) null,
	periodo varchar(1000) null,
	area varchar(1000) null,
	desc_experiencia varchar(1000) null,
	justificacion varchar(1000) null,
	objetivo varchar(1000) null,
	referencias varchar(1000) null,
	plan varchar(1000) null,
	otras varchar(1000) null,
	sugerencias varchar(1000) null,
	reporte int null,
	constraint obs_memoria_reportes_id_fk
		foreign key (reporte) references reportes (id)
);

create table obs_tesina
(
	id int auto_increment
		primary key,
	titulo text null,
	area text null,
	planteamiento text null,
	justificacion text null,
	objetivo text null,
	metodologia text null,
	referencias text null,
	cronograma text null,
	otros text null,
	sigerencias text null,
	reporte int null,
	constraint obs_tesina_reportes_id_fk
		foreign key (reporte) references reportes (id)
);

create table obs_tesis
(
	id int auto_increment
		primary key,
	titulo text null,
	area text null,
	planteamiento text null,
	justificacion text null,
	hipotesis text null,
	objetivo text null,
	metodologia text null,
	referencias text null,
	cronograma text null,
	otras text null,
	sugerencias text null,
	reporte int null,
	constraint obs_tesis_reportes_id_fk
		foreign key (reporte) references reportes (id)
);

create table sustentantes_sustentando
(
	id int auto_increment
		primary key,
	sustentante int null,
	version int null,
	constraint sustentantes_sustentando_sustentantes_id_fk
		foreign key (sustentante) references sustentantes (id)
			on update cascade on delete cascade,
	constraint sustentantes_sustentando_versiones_id_fk
		foreign key (version) references versiones (id)
			on update cascade on delete cascade
);


