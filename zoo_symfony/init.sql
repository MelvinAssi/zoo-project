--
-- PostgreSQL database dump
--

-- Dumped from database version 17.4
-- Dumped by pg_dump version 17.4

-- Started on 2025-05-25 00:12:17

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 221 (class 1259 OID 33041)
-- Name: animal; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.animal (
    id_animal uuid DEFAULT gen_random_uuid() NOT NULL,
    name character varying(50) NOT NULL,
    specie character varying(50) NOT NULL,
    age integer NOT NULL,
    description text,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    updated_at timestamp without time zone DEFAULT now() NOT NULL,
    photo text,
    created_by character varying(50) NOT NULL,
    updated_by character varying(50) NOT NULL,
    id_enclosure uuid NOT NULL
);


ALTER TABLE public.animal OWNER TO postgres;

--
-- TOC entry 218 (class 1259 OID 24825)
-- Name: doctrine_migration_versions; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.doctrine_migration_versions (
    version character varying(191) NOT NULL,
    executed_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    execution_time integer
);


ALTER TABLE public.doctrine_migration_versions OWNER TO postgres;

--
-- TOC entry 220 (class 1259 OID 33009)
-- Name: enclosure; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.enclosure (
    id_enclosure uuid DEFAULT gen_random_uuid() NOT NULL,
    name character varying(50) NOT NULL,
    max_capacity integer NOT NULL,
    specie_type character varying(50) NOT NULL,
    localisation integer NOT NULL
);


ALTER TABLE public.enclosure OWNER TO postgres;

--
-- TOC entry 222 (class 1259 OID 33098)
-- Name: message; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.message (
    id_message uuid DEFAULT gen_random_uuid() NOT NULL,
    name character varying(100) NOT NULL,
    email character varying(100) NOT NULL,
    subject character varying(150) NOT NULL,
    content text NOT NULL,
    is_read boolean DEFAULT false,
    is_responded boolean DEFAULT false,
    created_at timestamp without time zone DEFAULT now(),
    processed_by character varying(50)
);


ALTER TABLE public.message OWNER TO postgres;

--
-- TOC entry 219 (class 1259 OID 24847)
-- Name: opening_hours; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.opening_hours (
    id uuid NOT NULL,
    day_ character varying(10) NOT NULL,
    opening_time time without time zone NOT NULL,
    closing_time time without time zone NOT NULL,
    CONSTRAINT opening_hours_check CHECK ((closing_time > opening_time))
);


ALTER TABLE public.opening_hours OWNER TO postgres;

--
-- TOC entry 217 (class 1259 OID 24810)
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    id_users character varying(50) DEFAULT gen_random_uuid() NOT NULL,
    username character varying(50) NOT NULL,
    email character varying(50) NOT NULL,
    password character varying(100) NOT NULL,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    is_active boolean NOT NULL,
    first_login_done boolean NOT NULL,
    roles json NOT NULL
);


ALTER TABLE public.users OWNER TO postgres;

--
-- TOC entry 4898 (class 0 OID 33041)
-- Dependencies: 221
-- Data for Name: animal; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.animal (id_animal, name, specie, age, description, created_at, updated_at, photo, created_by, updated_by, id_enclosure) FROM stdin;
7c824e4c-5f47-49f3-ad94-f1a62c351d71	Simba	Lion	5	Lion mâle né en captivité, très sociable.	2025-05-11 22:20:36.709373	2025-05-11 22:20:36.709373	lion.jpg	682105401a30f	682105401a30f	da17e8ba-93cf-4c1e-822b-b5d2a4580277
92dc34e1-57a7-46ae-a32e-7cfabaf60a7b	Kaa	Python réticulé	4	Serpent géant non venimeux.	2025-05-11 22:20:36.709373	2025-05-11 22:20:36.709373	python.jpg	682105401a30f	682105401a30f	284ceb32-03f1-4a51-b56d-f4f4781cafb7
c287d5c9-af10-4901-8833-c1bef8815827	Rio	Ara bleu	2	Perroquet curieux et intelligent.	2025-05-11 22:20:36.709373	2025-05-11 22:20:36.709373	ara.jpg	682105401a30f	682105401a30f	3b836a2a-e6b3-4b40-b53f-7f5cce27d018
cec85987-2d32-461c-9b81-a0ea9a9d5049	Slimy	Axolotl	1	Amphibien mexicain très rare.	2025-05-11 22:20:36.709373	2025-05-11 22:20:36.709373	axolotl.jpg	682105401a30f	682105401a30f	93bbb1e0-b290-4482-9156-30e370e6c9e0
9dd714a6-827b-4786-b9be-f0a2ba1cd372	Spike	Iguane du désert	3	Reptile herbivore, adore le soleil.	2025-05-11 22:20:36.709373	2025-05-11 22:20:36.709373	iguana.jpg	682105401a30f	682105401a30f	f1dddc51-a2db-441a-b364-cf532394ab64
d6cc9c1c-ac96-4b60-9484-e88c7ef7de6e	Splash	Carpe Koï	2	Poisson japonais coloré, paisible.	2025-05-11 22:20:36.709373	2025-05-11 22:20:36.709373	koi.jpg	682105401a30f	682105401a30f	90f02897-727d-4247-b241-08c3dfc24951
ddcd97c5-d837-4aab-b39e-a0e330aaa208	Bruno	Sanglier	6	Espèce locale, adore fouiller le sol.	2025-05-11 22:20:36.709373	2025-05-11 22:20:36.709373	boar.jpg	682105401a30f	682105401a30f	3a320441-a809-4f47-8baf-b3bf4f8674a3
0776548f-cc17-4f45-ac3b-69adfbcb3890	Nanook	Ours polaire	8	Adulte solitaire, actif en matinée.	2025-05-11 22:20:36.709373	2025-05-16 20:41:17	polar_bear.jpg	682105401a30f	682105401a30f	ef0efb25-0c68-4bea-ba87-09079dfd5822
0197043c-4d94-79ae-90bd-696c3cea05d6	Leo	girafe	12	grande	2025-05-24 23:39:10.356742	2025-05-24 21:40:27	6232f2d406de6ffd2301572d067fb42de2de21e1.jpg	682105401a30f	682105401a30f	3b836a2a-e6b3-4b40-b53f-7f5cce27d018
\.


--
-- TOC entry 4895 (class 0 OID 24825)
-- Dependencies: 218
-- Data for Name: doctrine_migration_versions; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.doctrine_migration_versions (version, executed_at, execution_time) FROM stdin;
DoctrineMigrations\\Version20250507104256	2025-05-07 10:43:20	4
DoctrineMigrations\\Version20250509131021	2025-05-09 13:26:26	4
DoctrineMigrations\\Version20250509132619	2025-05-09 13:26:26	9
\.


--
-- TOC entry 4897 (class 0 OID 33009)
-- Dependencies: 220
-- Data for Name: enclosure; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.enclosure (id_enclosure, name, max_capacity, specie_type, localisation) FROM stdin;
da17e8ba-93cf-4c1e-822b-b5d2a4580277	Savane africaine	10	Mammifères	1
284ceb32-03f1-4a51-b56d-f4f4781cafb7	Forêt tropicale	8	Reptiles	2
3b836a2a-e6b3-4b40-b53f-7f5cce27d018	Aviary tropical	15	Oiseaux	3
ef0efb25-0c68-4bea-ba87-09079dfd5822	Zone Arctique	5	Mammifères polaires	4
93bbb1e0-b290-4482-9156-30e370e6c9e0	Terra Terra	12	Amphibiens	5
f1dddc51-a2db-441a-b364-cf532394ab64	Zone désertique	7	Reptiles	6
90f02897-727d-4247-b241-08c3dfc24951	Étang naturel	6	Poissons et amphibiens	7
3a320441-a809-4f47-8baf-b3bf4f8674a3	Forêt européenne	9	Mammifères forestiers	8
\.


--
-- TOC entry 4899 (class 0 OID 33098)
-- Dependencies: 222
-- Data for Name: message; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.message (id_message, name, email, subject, content, is_read, is_responded, created_at, processed_by) FROM stdin;
e54eb848-b04d-48ec-9297-a4e291ee343f	melvin	melvin@example.com	les horraires	Est ce que le zoo est ouvert le 01/05 ? Si oui, les horraires normaux sont t'ils appliqués ? 	f	f	2025-05-12 13:32:26	\N
8c2a6950-abff-44b9-a144-d995cb6e93c7	melvin	melvin@example.com	les horraires	Est ce que le zoo est ouvert le 01/05 ? Si oui, les horraires normaux sont t'ils appliqués ? 	f	f	2025-05-12 13:50:52	\N
91bf16df-731b-4762-90b3-dba8978c8329	Dupont	test6@example.com	prix du parking	Est ce que le parking est gratuit pour les visiteur?	f	f	2025-05-12 13:56:09	\N
a1734f95-898d-4da7-a612-8ab4c086663c	melvin	melvin@example.com	les horraires	Est ce que le zoo est ouvert le 01/05 ? Si oui, les horraires normaux sont t'ils appliqués ? 	f	f	2025-05-12 13:58:49	\N
81cc20fa-be33-4dff-a6b0-5e8e2dd5b2ec	Dupont	test6@example.com	prix du parking	Est ce que le parking est gratuit pour les visiteur?	f	f	2025-05-12 13:58:59	\N
453ae0d7-aea9-44d3-a6b3-529c91820378	melvin	melvin@example.com	les horraires	Est ce que le zoo est ouvert le 01/05 ? Si oui, les horraires normaux sont t'ils appliqués ?	t	t	2025-05-12 13:11:23	682105401a30f
\.


--
-- TOC entry 4896 (class 0 OID 24847)
-- Dependencies: 219
-- Data for Name: opening_hours; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.opening_hours (id, day_, opening_time, closing_time) FROM stdin;
23d2bfcb-ff95-4684-b4f9-6eccc0b1ea8b	Monday	10:00:00	18:00:00
e4727a39-940f-47b6-8a44-7d73e78f798e	Tuesday	10:00:00	18:00:00
7a9fdabd-2bce-46c7-97ad-1c4fc1ef3f60	Wednesday	10:00:00	19:00:00
75786f88-90b1-4e97-8a98-6185b07fdac6	Thursday	10:00:00	18:00:00
d353d19c-ae7b-454e-af5f-60b87240c210	Friday	10:00:00	18:00:00
9880cbc4-820f-4d60-b94f-70c13b2e8c4b	Saturday	10:00:00	19:00:00
010941e6-0b99-430a-bccc-86d1a64b1c27	Sunday	10:00:00	19:00:00
\.


--
-- TOC entry 4894 (class 0 OID 24810)
-- Dependencies: 217
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (id_users, username, email, password, created_at, is_active, first_login_done, roles) FROM stdin;
682105401a30f	melvin	melvin@example.com	$argon2id$v=19$m=65536,t=4,p=1$ZXJSLjQ2Z3M3eEdhVW1Ndw$tEitqyADPDPvIHHt5iOqhaepiyfZIrBM5phKQmOzGdc	2025-05-11 20:14:56	t	t	["ROLE_USER","ROLE_ADMIN"]
681bc0f87fbd7	test4	test4@example.com	$argon2id$v=19$m=65536,t=4,p=1$R2FwS0k4MzNoQUE4bFNhWA$lV9ODNlfKe/5L+LdwyYCAdBWf7NjCZb/XsAbPvItuzs	2025-05-07 20:22:16	t	f	["ROLE_USER"]
0196cdfc-d572-7abc-a5de-bc075ef4fb98	test7	test7@example.com	$argon2id$v=19$m=65536,t=4,p=1$aqpYSn92GPhUJc9Ielqtww$9ec8vyBlrE11uEesmqbniApeYVQeL6HqrvQnNiLNEdk	2025-05-14 10:50:21.17119	f	f	[]
0196ce29-9ce4-727d-81bc-32fbd8decc46	test2	test2@example.com	$argon2id$v=19$m=65536,t=4,p=1$Tjwhyl4uImtnDUwKGf/2NA$YjtujtfOUP6WImYyMkFuE63viYw5lgL/ANozleCrS30	2025-05-14 11:39:15.812944	f	f	[]
0196ce37-e680-743a-9959-c7422880e056	test3	test3@example.com	$argon2id$v=19$m=65536,t=4,p=1$TW0YApWNCswUO2XUUfVkUQ$7/2ZPyBWS+6YyFmtKfHdsH10DtMzvRs87JvgAG5udpI	2025-05-14 11:54:52.160511	f	f	[]
0196ce38-1989-7c15-9a82-5fea4f8ef84d	test5	test5@example.com	$argon2id$v=19$m=65536,t=4,p=1$X9IFjBdv4LaC5Vt+CSnhKA$Aspjf/JrHwbE6RozlGW6qFqIWJQisb7qhfZv7KzsCIg	2025-05-14 11:55:05.225688	f	f	[]
0196ce38-964c-7272-bf4a-fbc764bac479	test6	test6@example.com	$argon2id$v=19$m=65536,t=4,p=1$Rt1PAGT+CuadrASjRbvCTg$kEVCbPzX2lK+PDRWy7OSxYcJ80MWmNyTM01a+ZDBGAI	2025-05-14 11:55:37.164564	f	f	[]
0196ce38-decf-77f9-8095-5f04943b8505	test8	test8@example.com	$argon2id$v=19$m=65536,t=4,p=1$YrVCQNoJT15D2PQ+UHlzhA$7m/JqAmGP3SnID49/41tzCDkuha8Wi5oJRu+sOhiA1s	2025-05-14 11:55:55.727478	f	f	[]
0196ce39-7510-7e24-9321-b6b36aafd1d1	test9	test9@example.com	$argon2id$v=19$m=65536,t=4,p=1$3Q6x8p/0p8HDJGcTZ6hfXw$WQ4R2I9uGoooAJNwrVQp78iqN77l04WDyLpzm+v/WOw	2025-05-14 11:56:34.192893	f	f	[]
0196ce39-98ec-7ea0-aa20-319e8fafd99c	test10	test10@example.com	$argon2id$v=19$m=65536,t=4,p=1$QSZW4vtlzCYUagfNVzO5TA$k1/JjaIxam6ntXhCu3fL+hPlgIqEAlDhBthGd2hWBlk	2025-05-14 11:56:43.372348	f	f	[]
0196ce29-505b-7d83-ac5f-9a1463a94636	test1	test1@example.com	$argon2id$v=19$m=65536,t=4,p=1$M+VGN1P9WyFhHhsGBT35jg$YDOgfiMpRpNzdCN8csibokBIy/KHsjmPiHPkqkrpSfc	2025-05-14 11:38:56.219925	t	t	[]
\.


--
-- TOC entry 4742 (class 2606 OID 33048)
-- Name: animal animal_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.animal
    ADD CONSTRAINT animal_pkey PRIMARY KEY (id_animal);


--
-- TOC entry 4732 (class 2606 OID 24830)
-- Name: doctrine_migration_versions doctrine_migration_versions_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.doctrine_migration_versions
    ADD CONSTRAINT doctrine_migration_versions_pkey PRIMARY KEY (version);


--
-- TOC entry 4738 (class 2606 OID 33016)
-- Name: enclosure enclosure_name_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.enclosure
    ADD CONSTRAINT enclosure_name_key UNIQUE (name);


--
-- TOC entry 4740 (class 2606 OID 33014)
-- Name: enclosure enclosure_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.enclosure
    ADD CONSTRAINT enclosure_pkey PRIMARY KEY (id_enclosure);


--
-- TOC entry 4744 (class 2606 OID 33108)
-- Name: message message_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.message
    ADD CONSTRAINT message_pkey PRIMARY KEY (id_message);


--
-- TOC entry 4734 (class 2606 OID 24853)
-- Name: opening_hours opening_hours_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.opening_hours
    ADD CONSTRAINT opening_hours_pkey PRIMARY KEY (id);


--
-- TOC entry 4728 (class 2606 OID 24816)
-- Name: users uniq_1483a5e9f85e0677; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT uniq_1483a5e9f85e0677 UNIQUE (username);


--
-- TOC entry 4736 (class 2606 OID 24855)
-- Name: opening_hours uniq_2640c10bd93c9085; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.opening_hours
    ADD CONSTRAINT uniq_2640c10bd93c9085 UNIQUE (day_);


--
-- TOC entry 4730 (class 2606 OID 24814)
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id_users);


--
-- TOC entry 4726 (class 1259 OID 24831)
-- Name: uniq_1483a5e9e7927c74; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX uniq_1483a5e9e7927c74 ON public.users USING btree (email);


--
-- TOC entry 4745 (class 2606 OID 33049)
-- Name: animal animal_created_by_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.animal
    ADD CONSTRAINT animal_created_by_fkey FOREIGN KEY (created_by) REFERENCES public.users(id_users);


--
-- TOC entry 4746 (class 2606 OID 33059)
-- Name: animal animal_id_enclosure_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.animal
    ADD CONSTRAINT animal_id_enclosure_fkey FOREIGN KEY (id_enclosure) REFERENCES public.enclosure(id_enclosure);


--
-- TOC entry 4747 (class 2606 OID 33054)
-- Name: animal animal_updated_by_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.animal
    ADD CONSTRAINT animal_updated_by_fkey FOREIGN KEY (updated_by) REFERENCES public.users(id_users);


--
-- TOC entry 4748 (class 2606 OID 33109)
-- Name: message message_processed_by_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.message
    ADD CONSTRAINT message_processed_by_fkey FOREIGN KEY (processed_by) REFERENCES public.users(id_users);


-- Completed on 2025-05-25 00:12:17

--
-- PostgreSQL database dump complete
--

