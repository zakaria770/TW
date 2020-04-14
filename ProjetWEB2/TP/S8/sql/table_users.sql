SET client_encoding = 'UTF8';
CREATE TABLE s8_users (
    login character varying(40) NOT NULL,
    password character varying(100) NOT NULL,
    nom character varying(40) NOT NULL,
    prenom character varying(40) NOT NULL,
    CONSTRAINT login_non_vide CHECK (((login)::text <> ''::text)),
    CONSTRAINT nom_non_vide CHECK (((nom)::text <> ''::text)),
    CONSTRAINT password_non_vide CHECK (((password)::text <> ''::text)),
    CONSTRAINT prenom_non_vide CHECK (((prenom)::text <> ''::text))
);
ALTER TABLE ONLY s8_users
    ADD CONSTRAINT s8_users_pkey PRIMARY KEY (login);

COMMENT ON TABLE s8_users IS 'table des utilisateurs';

--
-- Data for Name: s8_users;
--

INSERT INTO s8_users (login, password, nom, prenom) VALUES ('mallani', 'animal', 'Malle', 'Annie');
INSERT INTO s8_users (login, password, nom, prenom) VALUES ('aporation', 'vapo', 'Aporation', 'Ève');
