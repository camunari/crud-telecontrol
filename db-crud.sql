PGDMP                         {            sistelecontrol    10.23    10.23                 0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                       false                       0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                       false                       0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                       false                       1262    16546    sistelecontrol    DATABASE     �   CREATE DATABASE sistelecontrol WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'Portuguese_Brazil.1252' LC_CTYPE = 'Portuguese_Brazil.1252';
    DROP DATABASE sistelecontrol;
             postgres    false                        2615    2200    public    SCHEMA        CREATE SCHEMA public;
    DROP SCHEMA public;
             postgres    false                       0    0    SCHEMA public    COMMENT     6   COMMENT ON SCHEMA public IS 'standard public schema';
                  postgres    false    3                        3079    12924    plpgsql 	   EXTENSION     ?   CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;
    DROP EXTENSION plpgsql;
                  false                       0    0    EXTENSION plpgsql    COMMENT     @   COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';
                       false    1            �            1259    16581    cliente    TABLE     �   CREATE TABLE public.cliente (
    nome character varying(255) NOT NULL,
    endereco character varying(255) NOT NULL,
    cpf character varying(11) NOT NULL,
    id integer NOT NULL,
    status character varying DEFAULT 'ativo'::character varying
);
    DROP TABLE public.cliente;
       public         postgres    false    3            �            1259    16579    cliente_id_seq    SEQUENCE     �   CREATE SEQUENCE public.cliente_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.cliente_id_seq;
       public       postgres    false    3    198                       0    0    cliente_id_seq    SEQUENCE OWNED BY     A   ALTER SEQUENCE public.cliente_id_seq OWNED BY public.cliente.id;
            public       postgres    false    197            �            1259    16653    ordem_servico    TABLE       CREATE TABLE public.ordem_servico (
    numero_ordem integer NOT NULL,
    data_abertura date NOT NULL,
    nome_cliente character varying(255) NOT NULL,
    cpf_cliente character varying(11) NOT NULL,
    situacao character varying(15),
    id integer NOT NULL,
    produto integer
);
 !   DROP TABLE public.ordem_servico;
       public         postgres    false    3            �            1259    16715    ordem_servico_id_seq    SEQUENCE     �   CREATE SEQUENCE public.ordem_servico_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.ordem_servico_id_seq;
       public       postgres    false    200    3                       0    0    ordem_servico_id_seq    SEQUENCE OWNED BY     M   ALTER SEQUENCE public.ordem_servico_id_seq OWNED BY public.ordem_servico.id;
            public       postgres    false    202            �            1259    16603    produto    TABLE        CREATE TABLE public.produto (
    produto integer NOT NULL,
    codigo character varying(255) NOT NULL,
    descricao character varying(255) NOT NULL,
    tempo_garantia character varying(25),
    id integer NOT NULL,
    situacao character varying(50)
);
    DROP TABLE public.produto;
       public         postgres    false    3            �            1259    16702    produto_id_seq    SEQUENCE     �   CREATE SEQUENCE public.produto_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.produto_id_seq;
       public       postgres    false    199    3                       0    0    produto_id_seq    SEQUENCE OWNED BY     A   ALTER SEQUENCE public.produto_id_seq OWNED BY public.produto.id;
            public       postgres    false    201            �            1259    16563    usuario    TABLE     �   CREATE TABLE public.usuario (
    nome character varying(255) NOT NULL,
    cpf character varying(11) NOT NULL,
    endereco character varying(255) NOT NULL,
    email character varying(100) NOT NULL,
    senha character varying(50) NOT NULL
);
    DROP TABLE public.usuario;
       public         postgres    false    3            �
           2604    16584 
   cliente id    DEFAULT     h   ALTER TABLE ONLY public.cliente ALTER COLUMN id SET DEFAULT nextval('public.cliente_id_seq'::regclass);
 9   ALTER TABLE public.cliente ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    197    198    198            �
           2604    16717    ordem_servico id    DEFAULT     t   ALTER TABLE ONLY public.ordem_servico ALTER COLUMN id SET DEFAULT nextval('public.ordem_servico_id_seq'::regclass);
 ?   ALTER TABLE public.ordem_servico ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    202    200            �
           2604    16704 
   produto id    DEFAULT     h   ALTER TABLE ONLY public.produto ALTER COLUMN id SET DEFAULT nextval('public.produto_id_seq'::regclass);
 9   ALTER TABLE public.produto ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    201    199            	          0    16581    cliente 
   TABLE DATA               B   COPY public.cliente (nome, endereco, cpf, id, status) FROM stdin;
    public       postgres    false    198   l!                 0    16653    ordem_servico 
   TABLE DATA               v   COPY public.ordem_servico (numero_ordem, data_abertura, nome_cliente, cpf_cliente, situacao, id, produto) FROM stdin;
    public       postgres    false    200   �!       
          0    16603    produto 
   TABLE DATA               [   COPY public.produto (produto, codigo, descricao, tempo_garantia, id, situacao) FROM stdin;
    public       postgres    false    199   "                 0    16563    usuario 
   TABLE DATA               D   COPY public.usuario (nome, cpf, endereco, email, senha) FROM stdin;
    public       postgres    false    196   �"                  0    0    cliente_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.cliente_id_seq', 25, true);
            public       postgres    false    197                       0    0    ordem_servico_id_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.ordem_servico_id_seq', 10, true);
            public       postgres    false    202                       0    0    produto_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.produto_id_seq', 30, true);
            public       postgres    false    201            �
           2606    16589    cliente cliente_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.cliente
    ADD CONSTRAINT cliente_pkey PRIMARY KEY (id);
 >   ALTER TABLE ONLY public.cliente DROP CONSTRAINT cliente_pkey;
       public         postgres    false    198            �
           2606    16658     ordem_servico ordem_servico_pkey 
   CONSTRAINT     h   ALTER TABLE ONLY public.ordem_servico
    ADD CONSTRAINT ordem_servico_pkey PRIMARY KEY (numero_ordem);
 J   ALTER TABLE ONLY public.ordem_servico DROP CONSTRAINT ordem_servico_pkey;
       public         postgres    false    200            �
           2606    16610    produto produto_pkey 
   CONSTRAINT     W   ALTER TABLE ONLY public.produto
    ADD CONSTRAINT produto_pkey PRIMARY KEY (produto);
 >   ALTER TABLE ONLY public.produto DROP CONSTRAINT produto_pkey;
       public         postgres    false    199            �
           2606    16570    usuario usuario_pkey 
   CONSTRAINT     U   ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT usuario_pkey PRIMARY KEY (email);
 >   ALTER TABLE ONLY public.usuario DROP CONSTRAINT usuario_pkey;
       public         postgres    false    196            	   5   x�s��L�+IU(I-��A��
���F�&�f����F���%�e�\1z\\\ N8Q         ^   x�m�!�0 @ݾbi;��� ������� P�?լ $)R�T`�{;��y	�.o�Zm,�L�ؼ�'0���� ���p�*�%&\D| ���      
   b   x�-�1@@F���S�	��H@I��L�0a����D�/�^�Mb�-<�;��kcs-��C_CwNz��ы�lT?w�[���rA�D�9�]BCFD�~"B         S   x�-.=��(3_�$��$�����ؘ3�4*
&��^r~.��i�e������q������i����a�a���I�AW� H��     