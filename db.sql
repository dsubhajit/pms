CREATE TABLE user_type (
	type_id	int(4)	primary key auto_increment,
	type_name	varchar(16)
);

insert into user_type values (1,"TPO");
insert into user_type values (2,"STUDENTS");
insert into user_type values (3,"COORDINATOR");
insert into user_type values (4,"COMPANY");


CREATE TABLE degree (
    degree_id     int(8) primary key auto_increment,
    degree_name   varchar(64)
);



CREATE TABLE department (
    dep_id      int(8) primary key auto_increment,
    dep_name    varchar(64)
);

CREATE TABLE branch (
    branch_id     int(8) primary key auto_increment,
    branch_name   varchar(64),
    dep_id        int(8) references department(dep_id)
);

CREATE TABLE  students_links	(
	link_id		int(8)	primary key auto_increment,
	fb		varchar(128),
	linkedin	varchar(128),
	tweeter		varchar(128),
	github		varchar(128),
	blog		varchar(128),
	website		varchar(128)
);

CREATE TABLE achievements (
	achiev_id			int(8)	primary key auto_increment,
	achiev_title			varchar(128),
	achiev_date			date,
	achiev_description		text,
	profile_id			int(8) references students_profile(profile_id)
);

CREATE TABLE students_edu (
	edu_id			int(8)	primary key auto_increment,
	edu_inst_name	varchar(128),
	edu_degree		varchar(64),
	edu_major		varchar(64),
	edu_date_form	date,
	edu_date_to		date,
	edu_percentage	double,
	edu_cgpa		double,
	edu_desc		text,
	edu_skill		text,
	edu_courses		text,
	profile_id		int(8) references students_profile(profile_id)
);

CREATE TABLE students_tech	(
	tech_id				int(8)	primary key auto_increment,
	tech_langs			text,
	tech_tools			text,
	tech_frameworks		text
);

CREATE TABLE students_pubs	(
	pub_id		int(8)	primary key auto_increment,
	pub_title	varchar(128),
	pub_date	date,
	pub_name	varchar(64),
	pub_desc	text,
	pub_skills	text,
	profile_id		int(8) references students_profile(profile_id)
);



CREATE TABLE students_projects	(
	pj_id		int(8)	primary key auto_increment,
	pj_name		varchar(128),
	pj_from		date,
	pj_to		date,
	pj_working	int(1),
	pj_desc		text,
	pj_skills	text,
	profile_id		int(8) references students_profile(profile_id)

);

CREATE TABLE students_profile (
	profile_id		int(8)	primary key auto_increment,
        enroll_no               varchar(64),
	name			varchar(128),
	email			varchar(32),
	phone			varchar(16),
	add1			varchar(128),
	add2			varchar(128),
	city			varchar(64),
	pin			varchar(16),
	c_state			varchar(18),
        deparment               int(8) references department(dep_id),
        branch                  int(8) references branch(branch_id),
        degree                  int(8) references degree(degree_id),
        adm_yr_start            int(8),
        adm_yr_end              int(8),
        cgpa                    double,
        job_status              int(1),
        job_id                  int(8) references job_list(job_id),
        multiple_job_allow      int(1),
	father_name		varchar(128),
	dob			date,
	hobbies			varchar(256),
	about			text,
	pic			text,
        prof_interest           text,
        languages               text,
	tech_id			int(8)	references	students_tech(tech_id),
	link_id			int(8)	references	students_links(link_id)

);

CREATE TABLE students_login (
	user_id		int(8)		primary key		auto_increment,
	username	varchar(64),
	password	varchar(64),
	verified	int(1),
	activated	int(1),
        iscordinator    int(1),
	profile_id	int(8)
);

CREATE TABLE company_profile (
	profile_id		int(8)	primary key auto_increment,
	company_name            varchar(64),
        company_website		varchar(64),
        cp_name                 varchar(64),
	cp_email                varchar(32),
	cp_phone		varchar(16),
        cp_desg                 varchar(256),
        post_add                varchar(256),
        cmp_type                varchar(128),
	about                   text,
        mission                 text,
        culture                 text,
        banner                  text
);

CREATE TABLE company_login (
    cmp_id  int(8)  primary key		auto_increment,
    username	varchar(64),
    password	varchar(64),
    verified	int(1),
    activated	int(1),
    profile_id	int(8) references company_profile(profile_id)
);





CREATE TABLE admin (
    user_id     int(8) primary key auto_increment,
    username	varchar(64),
    password	varchar(64),
    fullname    varchar(128),
    email       varchar(128),
    phone       varchar(16)
);

INSERT INTO admin values(1,'admin','21232f297a57a5a743894a0e4a801fc3','Administrator','','');




CREATE TABLE students_notif (
    notif_id    int(8) primary key auto_increment,
    notif_title       varchar(256),
    notif_desc        text,
    notif_date        timestamp,
    severity          int(1),
    degree            varchar(1024),
    department        varchar(1024),
    branch            varchar(1024)
);

CREATE TABLE company_notif (
    notif_id    int(8) primary key auto_increment,
    notif_title       varchar(256),
    notif_desc        text,
    notif_date        timestamp,
    severity          int(1)


);



CREATE table  students_exp (
    exp_id  int(8) primary key auto_increment,
    exp_type    text,
    designation text,
    organization text,
    start_date  date,
    end_date    date,
    description text,
    profile_id  int(8) references students_profile(profile_id)
);

CREATE table    students_prof_dev (
    id      int(8) primary key auto_increment,
    dev_type    text,
    dev_name    text,
    start_date  date,
    end_date    date,
    description text,
    profile_id  int(8) references students_profile(profile_id)
);

CREATE TABLE students_leadership (
    id      int(8) primary key auto_increment,
    designation text,
    organization text,
    start_date  date,
    end_date    date,
    description text,
    profile_id  int(8) references students_profile(profile_id)
);

CREATE TABLE students_ref (
    id      int(8) primary key auto_increment,
    ref_name    varchar(64),
    designation text,
    organization text,
    email        varchar(64),
    phone    varchar(32),

    profile_id  int(8) references students_profile(profile_id)
);


create table jobs (
    job_id  int(8) primary key auto_increment,
    desg    text,
    description text,
    loc     text,
    num_of_off  text,
    num_rounds  int(8),
    criteria    text,
    degree      varchar(256),
    department  varchar(256),
    branch      varchar(256),
    create_date date,
    last_date   date,
    profile_id  int(8) references company_profile(profile_id),
    verified    int(1),
    publish     int(1)
);

create table job_salary_details (
    sd_id   int(8) primary key auto_increment,
    degree  varchar(256),
    ctc     varchar(256),
    gross   varchar(256),
    bonus   varchar(256),
    bond    varchar(256),
    job_id  int(8) references jobs(job_id)
);

create table job_round_details (
    round_id    int(8) primary key auto_increment,
    round_name  text,
    round_details   text,
    job_id  int(8) references jobs(job_id)
);

CREATE TABLE job_application (
    job_app_id  int(8) primary key auto_increment,
    job_id      int(8) references job_list(job_id),
    student_profile_id  int(8) references students_profile(profile_id),
    company_profile_id  int(8) references company_profile(profile_id),
    application_status  int(1),
    doa         date

);

create table schedule_list(
    id  int(8) primary key auto_increment,
    company_id   int(8) references company_profile(profile_id),
    start_date  date,
    end_date    date,
    status      int(1),
    num_of_mem  int(8),
    num_of_rooms int(8),
    req         text
);

create table job_offer(
    id  int(8) primary key auto_increment,
    job_id  int(8) references jobs(job_id),
    student_id  int(8),
    status  int(1),
    offered_text    text
);