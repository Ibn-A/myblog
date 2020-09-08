#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: user
#------------------------------------------------------------

CREATE TABLE user(
        id_user  Int  Auto_increment  NOT NULL ,
        username Varchar (255) NOT NULL ,
        password Varchar (255) NOT NULL,
        CONSTRAINT user_PK PRIMARY KEY (id_user)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: category
#------------------------------------------------------------

CREATE TABLE category(
        id_category   Int  Auto_increment  NOT NULL ,
        name_category Varchar (255) NOT NULL ,
        slug_category Varchar (255) NOT NULL,
        CONSTRAINT category_PK PRIMARY KEY (id_category)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: post
#------------------------------------------------------------

CREATE TABLE post(
        id_post    Int  Auto_increment  NOT NULL ,
        title      Varchar (255) NOT NULL ,
        slug_post  Varchar (255) NOT NULL ,
        content    Text NOT NULL ,
        created_at Datetime NOT NULL ,
        id_user    Int NOT NULL,
        CONSTRAINT post_PK PRIMARY KEY (id_post),
        
        CONSTRAINT post_user_FK FOREIGN KEY (id_user) REFERENCES user(id_user)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: post_category
#------------------------------------------------------------

CREATE TABLE post_category(
        id_post     Int NOT NULL ,
        id_category Int NOT NULL,
        CONSTRAINT post_category_PK PRIMARY KEY (id_post,id_category),
        
        CONSTRAINT post_category_post_FK FOREIGN KEY (id_post) REFERENCES post(id_post) ON DELETE CASCADE ON UPDATE RESTRICT,
        CONSTRAINT post_category_category0_FK 
                FOREIGN KEY (id_category) 
                REFERENCES category(id_category)
                ON DELETE CASCADE 
                ON UPDATE RESTRICT
)ENGINE=InnoDB;

