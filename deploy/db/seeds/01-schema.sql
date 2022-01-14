--
-- PostgreSQL database dump
--

-- Dumped from database version 11.3 (Debian 11.3-1.pgdg90+1)
-- Dumped by pg_dump version 11.3 (Debian 11.3-1.pgdg90+1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: hady; Type: SCHEMA; Schema: -; Owner: hady
--

CREATE SCHEMA hady;


ALTER SCHEMA hady OWNER TO hady;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: Category; Type: TABLE; Schema: hady; Owner: hady
--

CREATE TABLE hady."Category" (
    id bigint NOT NULL,
    name character varying(128) NOT NULL,
    code character varying(8) NOT NULL,
    description text,
    "isDeleted" boolean DEFAULT false NOT NULL,
    "createdAt" timestamp(0) without time zone,
    "updatedAt" timestamp(0) without time zone,
    "deletedAt" timestamp(0) without time zone
);


ALTER TABLE hady."Category" OWNER TO hady;

--
-- Name: Category_id_seq; Type: SEQUENCE; Schema: hady; Owner: hady
--

CREATE SEQUENCE hady."Category_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE hady."Category_id_seq" OWNER TO hady;

--
-- Name: Category_id_seq; Type: SEQUENCE OWNED BY; Schema: hady; Owner: hady
--

ALTER SEQUENCE hady."Category_id_seq" OWNED BY hady."Category".id;






CREATE TABLE hady."Permission" (
    id bigint NOT NULL,
    module character varying(255) NOT NULL,
    "accessLevel" character varying(255) NOT NULL
);


ALTER TABLE hady."Permission" OWNER TO hady;

--
-- Name: Permission_id_seq; Type: SEQUENCE; Schema: hady; Owner: hady
--

CREATE SEQUENCE hady."Permission_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE hady."Permission_id_seq" OWNER TO hady;

--
-- Name: Permission_id_seq; Type: SEQUENCE OWNED BY; Schema: hady; Owner: hady
--

ALTER SEQUENCE hady."Permission_id_seq" OWNED BY hady."Permission".id;


--
-- Name: Product; Type: TABLE; Schema: hady; Owner: hady
--

CREATE TABLE hady."Product" (
    id bigint NOT NULL,
    "productName" character varying(128) NOT NULL,
    "productCode" character varying(32) NOT NULL,
    image character varying(255) NOT NULL,
    "purchasePrice" integer DEFAULT 0,
    "sellingPrice" integer DEFAULT 0,
    "CategoryId" integer NOT NULL,
    description text,
    "typeUnit" character varying(255) NOT NULL,
    "totalStock" integer DEFAULT 0 NOT NULL,
    "minimumStock" integer DEFAULT 0 NOT NULL,
    "isReminder" boolean DEFAULT false,
    "isDeleted" boolean DEFAULT false,
    "isProductPackage" boolean DEFAULT false NOT NULL,
    "createdAt" timestamp(0) without time zone,
    "updatedAt" timestamp(0) without time zone,
    "deletedAt" timestamp(0) without time zone,
    CONSTRAINT "Product_typeUnit_check" CHECK ((("typeUnit")::text = ANY (ARRAY[('Unit'::character varying)::text, ('Buah'::character varying)::text, ('Pasang'::character varying)::text, ('Lembar'::character varying)::text, ('Keping'::character varying)::text, ('Batang'::character varying)::text, ('Bungkus'::character varying)::text, ('Butir'::character varying)::text, ('Roll'::character varying)::text, ('Dus'::character varying)::text, ('Paket'::character varying)::text])))
);


ALTER TABLE hady."Product" OWNER TO hady;

--
-- Name: ProductImages; Type: TABLE; Schema: hady; Owner: hady
--

CREATE TABLE hady."ProductImages" (
    id bigint NOT NULL,
    path character varying(128) NOT NULL,
    "ProductId" integer NOT NULL,
    "createdAt" timestamp(0) without time zone,
    "updatedAt" timestamp(0) without time zone
);


ALTER TABLE hady."ProductImages" OWNER TO hady;

--
-- Name: ProductImages_id_seq; Type: SEQUENCE; Schema: hady; Owner: hady
--

CREATE SEQUENCE hady."ProductImages_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE hady."ProductImages_id_seq" OWNER TO hady;

--
-- Name: ProductImages_id_seq; Type: SEQUENCE OWNED BY; Schema: hady; Owner: hady
--

ALTER SEQUENCE hady."ProductImages_id_seq" OWNED BY hady."ProductImages".id;


--
-- Name: ProductItem; Type: TABLE; Schema: hady; Owner: hady
--

CREATE TABLE hady."ProductItem" (
    id bigint NOT NULL,
    "ProductPackageId" integer NOT NULL,
    "ProductId" integer NOT NULL,
    "minimumItem" integer,
    "promoPrice" integer DEFAULT 0 NOT NULL,
    "isDeleted" boolean DEFAULT false NOT NULL,
    "createdAt" timestamp(0) without time zone,
    "updatedAt" timestamp(0) without time zone,
    "deletedAt" timestamp(0) without time zone,
    "bonusItem" integer DEFAULT 0
);


ALTER TABLE hady."ProductItem" OWNER TO hady;

--
-- Name: ProductItem_id_seq; Type: SEQUENCE; Schema: hady; Owner: hady
--

CREATE SEQUENCE hady."ProductItem_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE hady."ProductItem_id_seq" OWNER TO hady;

--
-- Name: ProductItem_id_seq; Type: SEQUENCE OWNED BY; Schema: hady; Owner: hady
--

ALTER SEQUENCE hady."ProductItem_id_seq" OWNED BY hady."ProductItem".id;


--
-- Name: ProductPackage; Type: TABLE; Schema: hady; Owner: hady
--

CREATE TABLE hady."ProductPackage" (
    id bigint NOT NULL,
    "ProductId" integer NOT NULL,
    name character varying(255) NOT NULL,
    "totalPrice" integer DEFAULT 0 NOT NULL,
    image character varying(255),
    description text,
    "isDeleted" boolean DEFAULT false NOT NULL,
    "ZoneId" integer NOT NULL,
    "createdAt" timestamp(0) without time zone,
    "updatedAt" timestamp(0) without time zone,
    "deletedAt" timestamp(0) without time zone
);


ALTER TABLE hady."ProductPackage" OWNER TO hady;

--
-- Name: ProductPackage_id_seq; Type: SEQUENCE; Schema: hady; Owner: hady
--

CREATE SEQUENCE hady."ProductPackage_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE hady."ProductPackage_id_seq" OWNER TO hady;

--
-- Name: ProductPackage_id_seq; Type: SEQUENCE OWNED BY; Schema: hady; Owner: hady
--

ALTER SEQUENCE hady."ProductPackage_id_seq" OWNED BY hady."ProductPackage".id;


--
-- Name: ProductPrice; Type: TABLE; Schema: hady; Owner: hady
--

CREATE TABLE hady."ProductPrice" (
    id bigint NOT NULL,
    price integer DEFAULT 0 NOT NULL,
    "ZoneId" integer NOT NULL,
    "ProductId" integer NOT NULL,
    "isDeleted" boolean DEFAULT false NOT NULL,
    "createdAt" timestamp(0) without time zone,
    "updatedAt" timestamp(0) without time zone,
    "deletedAt" timestamp(0) without time zone
);


ALTER TABLE hady."ProductPrice" OWNER TO hady;

--
-- Name: ProductPrice_id_seq; Type: SEQUENCE; Schema: hady; Owner: hady
--

CREATE SEQUENCE hady."ProductPrice_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE hady."ProductPrice_id_seq" OWNER TO hady;

--
-- Name: ProductPrice_id_seq; Type: SEQUENCE OWNED BY; Schema: hady; Owner: hady
--

ALTER SEQUENCE hady."ProductPrice_id_seq" OWNED BY hady."ProductPrice".id;


--
-- Name: Product_id_seq; Type: SEQUENCE; Schema: hady; Owner: hady
--

CREATE SEQUENCE hady."Product_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE hady."Product_id_seq" OWNER TO hady;

--
-- Name: Product_id_seq; Type: SEQUENCE OWNED BY; Schema: hady; Owner: hady
--

ALTER SEQUENCE hady."Product_id_seq" OWNED BY hady."Product".id;






-- Name: Region; Type: TABLE; Schema: hady; Owner: hady
--

CREATE TABLE hady."Region" (
    code character varying(13),
    name character varying(100)
);


ALTER TABLE hady."Region" OWNER TO hady;

--
-- Name: Role; Type: TABLE; Schema: hady; Owner: hady
--

CREATE TABLE hady."Role" (
    id bigint NOT NULL,
    name character varying(45),
    label character varying(45) NOT NULL,
    notes character varying(45),
    group_by character varying(45) NOT NULL,
    "createdAt" timestamp(0) without time zone,
    "updatedAt" timestamp(0) without time zone
);


ALTER TABLE hady."Role" OWNER TO hady;

--
-- Name: RolePermission; Type: TABLE; Schema: hady; Owner: hady
--

CREATE TABLE hady."RolePermission" (
    id bigint NOT NULL,
    "UserId" integer NOT NULL,
    "PermissionId" integer NOT NULL
);


ALTER TABLE hady."RolePermission" OWNER TO hady;

--
-- Name: RolePermission_id_seq; Type: SEQUENCE; Schema: hady; Owner: hady
--

CREATE SEQUENCE hady."RolePermission_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE hady."RolePermission_id_seq" OWNER TO hady;

--
-- Name: RolePermission_id_seq; Type: SEQUENCE OWNED BY; Schema: hady; Owner: hady
--

ALTER SEQUENCE hady."RolePermission_id_seq" OWNED BY hady."RolePermission".id;


--
-- Name: Role_id_seq; Type: SEQUENCE; Schema: hady; Owner: hady
--

CREATE SEQUENCE hady."Role_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE hady."Role_id_seq" OWNER TO hady;

--
-- Name: Role_id_seq; Type: SEQUENCE OWNED BY; Schema: hady; Owner: hady
--

ALTER SEQUENCE hady."Role_id_seq" OWNED BY hady."Role".id;







CREATE TABLE hady."User" (
    id bigint NOT NULL,
    "firstName" character varying(32) NOT NULL,
    "lastName" character varying(32),
    "contactNumber" character varying(20),
    "loginName" character varying(255),
    email character varying(255) NOT NULL,
    "isActive" boolean DEFAULT true NOT NULL,
    email_verified_at timestamp(0) without time zone,
    password character varying(255) NOT NULL,
    remember_token character varying(100),
    "roleId" integer,
    "typeUser" character varying(255),
    "isDeleted" boolean DEFAULT false NOT NULL,
    "createdAt" timestamp(0) without time zone,
    "updatedAt" timestamp(0) without time zone,
    "deletedAt" timestamp(0) without time zone,
    CONSTRAINT "User_typeUser_check" CHECK ((("typeUser")::text = ANY (ARRAY[('ADMIN'::character varying)::text, ('SALES'::character varying)::text])))
);


ALTER TABLE hady."User" OWNER TO hady;

--
-- Name: UserProfileRole; Type: TABLE; Schema: hady; Owner: hady
--

CREATE TABLE hady."UserProfileRole" (
    id bigint NOT NULL,
    "roleId" integer NOT NULL,
    "UserId" integer NOT NULL
);


ALTER TABLE hady."UserProfileRole" OWNER TO hady;

--
-- Name: UserProfileRole_id_seq; Type: SEQUENCE; Schema: hady; Owner: hady
--

CREATE SEQUENCE hady."UserProfileRole_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE hady."UserProfileRole_id_seq" OWNER TO hady;

--
-- Name: UserProfileRole_id_seq; Type: SEQUENCE OWNED BY; Schema: hady; Owner: hady
--

ALTER SEQUENCE hady."UserProfileRole_id_seq" OWNED BY hady."UserProfileRole".id;


--
-- Name: User_id_seq; Type: SEQUENCE; Schema: hady; Owner: hady
--

CREATE SEQUENCE hady."User_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE hady."User_id_seq" OWNER TO hady;

--
-- Name: User_id_seq; Type: SEQUENCE OWNED BY; Schema: hady; Owner: hady
--

ALTER SEQUENCE hady."User_id_seq" OWNED BY hady."User".id;




--
-- Name: Zone; Type: TABLE; Schema: hady; Owner: hady
--

CREATE TABLE hady."Zone" (
    id bigint NOT NULL,
    name character varying(32) NOT NULL,
    description text,
    "isDeleted" boolean DEFAULT false NOT NULL,
    "createdAt" timestamp(0) without time zone,
    "updatedAt" timestamp(0) without time zone,
    "deletedAt" timestamp(0) without time zone
);


ALTER TABLE hady."Zone" OWNER TO hady;

--
-- Name: Zone_id_seq; Type: SEQUENCE; Schema: hady; Owner: hady
--

CREATE SEQUENCE hady."Zone_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE hady."Zone_id_seq" OWNER TO hady;

--
-- Name: Zone_id_seq; Type: SEQUENCE OWNED BY; Schema: hady; Owner: hady
--

ALTER SEQUENCE hady."Zone_id_seq" OWNED BY hady."Zone".id;



-- Name: failed_jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: hady; Owner: hady
--

ALTER SEQUENCE hady.failed_jobs_id_seq OWNED BY hady.failed_jobs.id;


--
-- Name: migrations; Type: TABLE; Schema: hady; Owner: hady
--

CREATE TABLE hady.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE hady.migrations OWNER TO hady;

--
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: hady; Owner: hady
--

CREATE SEQUENCE hady.migrations_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE hady.migrations_id_seq OWNER TO hady;

--
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: hady; Owner: hady
--

ALTER SEQUENCE hady.migrations_id_seq OWNED BY hady.migrations.id;


--
-- Name: Category id; Type: DEFAULT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."Category" ALTER COLUMN id SET DEFAULT nextval('hady."Category_id_seq"'::regclass);


--
-- Name: Commission id; Type: DEFAULT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."Commission" ALTER COLUMN id SET DEFAULT nextval('hady."Commission_id_seq"'::regclass);


--
-- Name: Company id; Type: DEFAULT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."Company" ALTER COLUMN id SET DEFAULT nextval('hady."Company_id_seq1"'::regclass);


--
-- Name: Invoice id; Type: DEFAULT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."Invoice" ALTER COLUMN id SET DEFAULT nextval('hady."Invoice_id_seq"'::regclass);


--
-- Name: InvoiceDate id; Type: DEFAULT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."InvoiceDate" ALTER COLUMN id SET DEFAULT nextval('hady."InvoiceDate_id_seq"'::regclass);


--
-- Name: InvoiceItem id; Type: DEFAULT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."InvoiceItem" ALTER COLUMN id SET DEFAULT nextval('hady."InvoiceItem_id_seq"'::regclass);


--
-- Name: InvoicePayment id; Type: DEFAULT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."InvoicePayment" ALTER COLUMN id SET DEFAULT nextval('hady."InvoicePayment_id_seq"'::regclass);


--
-- Name: InvoiceReturn id; Type: DEFAULT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."InvoiceReturn" ALTER COLUMN id SET DEFAULT nextval('hady."InvoiceReturn_id_seq"'::regclass);


--
-- Name: InvoiceReturnItem id; Type: DEFAULT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."InvoiceReturnItem" ALTER COLUMN id SET DEFAULT nextval('hady."InvoiceReturnItem_id_seq"'::regclass);


--
-- Name: Partner id; Type: DEFAULT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."Partner" ALTER COLUMN id SET DEFAULT nextval('hady."Partner_id_seq"'::regclass);


--
-- Name: Permission id; Type: DEFAULT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."Permission" ALTER COLUMN id SET DEFAULT nextval('hady."Permission_id_seq"'::regclass);


--
-- Name: Product id; Type: DEFAULT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."Product" ALTER COLUMN id SET DEFAULT nextval('hady."Product_id_seq"'::regclass);


--
-- Name: ProductImages id; Type: DEFAULT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."ProductImages" ALTER COLUMN id SET DEFAULT nextval('hady."ProductImages_id_seq"'::regclass);


--
-- Name: ProductItem id; Type: DEFAULT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."ProductItem" ALTER COLUMN id SET DEFAULT nextval('hady."ProductItem_id_seq"'::regclass);


--
-- Name: ProductPackage id; Type: DEFAULT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."ProductPackage" ALTER COLUMN id SET DEFAULT nextval('hady."ProductPackage_id_seq"'::regclass);


--
-- Name: ProductPrice id; Type: DEFAULT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."ProductPrice" ALTER COLUMN id SET DEFAULT nextval('hady."ProductPrice_id_seq"'::regclass);


--
-- Name: PurchaseInvoice id; Type: DEFAULT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."PurchaseInvoice" ALTER COLUMN id SET DEFAULT nextval('hady."PurchaseInvoice_id_seq"'::regclass);


--
-- Name: PurchaseInvoiceItem id; Type: DEFAULT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."PurchaseInvoiceItem" ALTER COLUMN id SET DEFAULT nextval('hady."PurchaseInvoiceItem_id_seq"'::regclass);


--
-- Name: PurchaseOrder id; Type: DEFAULT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."PurchaseOrder" ALTER COLUMN id SET DEFAULT nextval('hady."PurchaseOrder_id_seq"'::regclass);


--
-- Name: PurchaseOrderItem id; Type: DEFAULT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."PurchaseOrderItem" ALTER COLUMN id SET DEFAULT nextval('hady."PurchaseOrderItem_id_seq"'::regclass);


--
-- Name: Role id; Type: DEFAULT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."Role" ALTER COLUMN id SET DEFAULT nextval('hady."Role_id_seq"'::regclass);


--
-- Name: RolePermission id; Type: DEFAULT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."RolePermission" ALTER COLUMN id SET DEFAULT nextval('hady."RolePermission_id_seq"'::regclass);


--
-- Name: SalesOrder id; Type: DEFAULT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."SalesOrder" ALTER COLUMN id SET DEFAULT nextval('hady."SalesOrder_id_seq"'::regclass);


--
-- Name: SalesOrderItem id; Type: DEFAULT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."SalesOrderItem" ALTER COLUMN id SET DEFAULT nextval('hady."SalesOrderItem_id_seq"'::regclass);


--
-- Name: Stock id; Type: DEFAULT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."Stock" ALTER COLUMN id SET DEFAULT nextval('hady."Stock_id_seq"'::regclass);


--
-- Name: StockItem id; Type: DEFAULT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."StockItem" ALTER COLUMN id SET DEFAULT nextval('hady."StockItem_id_seq"'::regclass);


--
-- Name: User id; Type: DEFAULT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."User" ALTER COLUMN id SET DEFAULT nextval('hady."User_id_seq"'::regclass);


--
-- Name: UserProfileRole id; Type: DEFAULT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."UserProfileRole" ALTER COLUMN id SET DEFAULT nextval('hady."UserProfileRole_id_seq"'::regclass);


--
-- Name: WareHouse id; Type: DEFAULT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."WareHouse" ALTER COLUMN id SET DEFAULT nextval('hady."WareHouse_id_seq"'::regclass);


--
-- Name: Zone id; Type: DEFAULT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."Zone" ALTER COLUMN id SET DEFAULT nextval('hady."Zone_id_seq"'::regclass);


--
-- Name: failed_jobs id; Type: DEFAULT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady.failed_jobs ALTER COLUMN id SET DEFAULT nextval('hady.failed_jobs_id_seq'::regclass);


--
-- Name: migrations id; Type: DEFAULT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady.migrations ALTER COLUMN id SET DEFAULT nextval('hady.migrations_id_seq'::regclass);


--
-- Name: Category Category_pkey; Type: CONSTRAINT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."Category"
    ADD CONSTRAINT "Category_pkey" PRIMARY KEY (id);


--
-- Name: Commission Commission_pkey; Type: CONSTRAINT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."Commission"
    ADD CONSTRAINT "Commission_pkey" PRIMARY KEY (id);


--
-- Name: Company Company_pkey; Type: CONSTRAINT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."Company"
    ADD CONSTRAINT "Company_pkey" PRIMARY KEY (id);


--
-- Name: InvoiceDate InvoiceDate_pkey; Type: CONSTRAINT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."InvoiceDate"
    ADD CONSTRAINT "InvoiceDate_pkey" PRIMARY KEY (id);


--
-- Name: InvoiceItem InvoiceItem_pkey; Type: CONSTRAINT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."InvoiceItem"
    ADD CONSTRAINT "InvoiceItem_pkey" PRIMARY KEY (id);


--
-- Name: InvoicePayment InvoicePayment_pkey; Type: CONSTRAINT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."InvoicePayment"
    ADD CONSTRAINT "InvoicePayment_pkey" PRIMARY KEY (id);


--
-- Name: InvoiceReturnItem InvoiceReturnItem_pkey; Type: CONSTRAINT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."InvoiceReturnItem"
    ADD CONSTRAINT "InvoiceReturnItem_pkey" PRIMARY KEY (id);


--
-- Name: InvoiceReturn InvoiceReturn_pkey; Type: CONSTRAINT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."InvoiceReturn"
    ADD CONSTRAINT "InvoiceReturn_pkey" PRIMARY KEY (id);


--
-- Name: Invoice Invoice_pkey; Type: CONSTRAINT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."Invoice"
    ADD CONSTRAINT "Invoice_pkey" PRIMARY KEY (id);


--
-- Name: Partner Partner_pkey; Type: CONSTRAINT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."Partner"
    ADD CONSTRAINT "Partner_pkey" PRIMARY KEY (id);


--
-- Name: Permission Permission_pkey; Type: CONSTRAINT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."Permission"
    ADD CONSTRAINT "Permission_pkey" PRIMARY KEY (id);


--
-- Name: ProductImages ProductImages_pkey; Type: CONSTRAINT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."ProductImages"
    ADD CONSTRAINT "ProductImages_pkey" PRIMARY KEY (id);


--
-- Name: ProductItem ProductItem_pkey; Type: CONSTRAINT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."ProductItem"
    ADD CONSTRAINT "ProductItem_pkey" PRIMARY KEY (id);


--
-- Name: ProductPackage ProductPackage_pkey; Type: CONSTRAINT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."ProductPackage"
    ADD CONSTRAINT "ProductPackage_pkey" PRIMARY KEY (id);


--
-- Name: ProductPrice ProductPrice_pkey; Type: CONSTRAINT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."ProductPrice"
    ADD CONSTRAINT "ProductPrice_pkey" PRIMARY KEY (id);


--
-- Name: Product Product_pkey; Type: CONSTRAINT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."Product"
    ADD CONSTRAINT "Product_pkey" PRIMARY KEY (id);


--
-- Name: PurchaseInvoiceItem PurchaseInvoiceItem_pkey; Type: CONSTRAINT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."PurchaseInvoiceItem"
    ADD CONSTRAINT "PurchaseInvoiceItem_pkey" PRIMARY KEY (id);


--
-- Name: PurchaseInvoice PurchaseInvoice_pkey; Type: CONSTRAINT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."PurchaseInvoice"
    ADD CONSTRAINT "PurchaseInvoice_pkey" PRIMARY KEY (id);


--
-- Name: PurchaseOrderItem PurchaseOrderItem_pkey; Type: CONSTRAINT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."PurchaseOrderItem"
    ADD CONSTRAINT "PurchaseOrderItem_pkey" PRIMARY KEY (id);


--
-- Name: PurchaseOrder PurchaseOrder_pkey; Type: CONSTRAINT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."PurchaseOrder"
    ADD CONSTRAINT "PurchaseOrder_pkey" PRIMARY KEY (id);


--
-- Name: RolePermission RolePermission_pkey; Type: CONSTRAINT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."RolePermission"
    ADD CONSTRAINT "RolePermission_pkey" PRIMARY KEY (id);


--
-- Name: Role Role_pkey; Type: CONSTRAINT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."Role"
    ADD CONSTRAINT "Role_pkey" PRIMARY KEY (id);


--
-- Name: SalesOrderItem SalesOrderItem_pkey; Type: CONSTRAINT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."SalesOrderItem"
    ADD CONSTRAINT "SalesOrderItem_pkey" PRIMARY KEY (id);


--
-- Name: SalesOrder SalesOrder_pkey; Type: CONSTRAINT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."SalesOrder"
    ADD CONSTRAINT "SalesOrder_pkey" PRIMARY KEY (id);


--
-- Name: StockItem StockItem_pkey; Type: CONSTRAINT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."StockItem"
    ADD CONSTRAINT "StockItem_pkey" PRIMARY KEY (id);


--
-- Name: Stock Stock_pkey; Type: CONSTRAINT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."Stock"
    ADD CONSTRAINT "Stock_pkey" PRIMARY KEY (id);


--
-- Name: UserProfileRole UserProfileRole_pkey; Type: CONSTRAINT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."UserProfileRole"
    ADD CONSTRAINT "UserProfileRole_pkey" PRIMARY KEY (id);


--
-- Name: User User_pkey; Type: CONSTRAINT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."User"
    ADD CONSTRAINT "User_pkey" PRIMARY KEY (id);


--
-- Name: WareHouse WareHouse_pkey; Type: CONSTRAINT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."WareHouse"
    ADD CONSTRAINT "WareHouse_pkey" PRIMARY KEY (id);


--
-- Name: Zone Zone_pkey; Type: CONSTRAINT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."Zone"
    ADD CONSTRAINT "Zone_pkey" PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_pkey; Type: CONSTRAINT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);


--
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- Name: Partner partner_partnerid_unique; Type: CONSTRAINT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."Partner"
    ADD CONSTRAINT partner_partnerid_unique UNIQUE ("partnerId");


--
-- Name: User user_email_unique; Type: CONSTRAINT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."User"
    ADD CONSTRAINT user_email_unique UNIQUE (email);


--
-- Name: Product Category; Type: FK CONSTRAINT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."Product"
    ADD CONSTRAINT "Category" FOREIGN KEY ("CategoryId") REFERENCES hady."Category"(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: InvoiceDate Invoice; Type: FK CONSTRAINT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."InvoiceDate"
    ADD CONSTRAINT "Invoice" FOREIGN KEY ("InvoiceId") REFERENCES hady."Invoice"(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: InvoiceItem Invoice; Type: FK CONSTRAINT; Schema: hady; Owner: hady
--





ALTER TABLE ONLY hady."ProductItem"
    ADD CONSTRAINT "ProductPackage" FOREIGN KEY ("ProductPackageId") REFERENCES hady."ProductPackage"(id) ON UPDATE CASCADE ON DELETE CASCADE;





ALTER TABLE ONLY hady."UserProfileRole"
    ADD CONSTRAINT "Role" FOREIGN KEY ("roleId") REFERENCES hady."Role"(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: RolePermission RolePermission_permissionId_fkey; Type: FK CONSTRAINT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."RolePermission"
    ADD CONSTRAINT "RolePermission_permissionId_fkey" FOREIGN KEY ("PermissionId") REFERENCES hady."Permission"(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: RolePermission RolePermission_userId_fkey; Type: FK CONSTRAINT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."RolePermission"
    ADD CONSTRAINT "RolePermission_userId_fkey" FOREIGN KEY ("UserId") REFERENCES hady."User"(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: Commission Sales; Type: FK CONSTRAINT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."Commission"
    ADD CONSTRAINT "Sales" FOREIGN KEY ("SalesId") REFERENCES hady."User"(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: Invoice Sales; Type: FK CONSTRAINT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."Invoice"
    ADD CONSTRAINT "Sales" FOREIGN KEY ("SalesId") REFERENCES hady."User"(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: InvoiceReturn Sales; Type: FK CONSTRAINT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."InvoiceReturn"
    ADD CONSTRAINT "Sales" FOREIGN KEY ("SalesId") REFERENCES hady."User"(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: SalesOrder Sales; Type: FK CONSTRAINT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."SalesOrder"
    ADD CONSTRAINT "Sales" FOREIGN KEY ("SalesId") REFERENCES hady."User"(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: Invoice SalesOrder; Type: FK CONSTRAINT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."Invoice"
    ADD CONSTRAINT "SalesOrder" FOREIGN KEY ("SalesOrderId") REFERENCES hady."SalesOrder"(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: SalesOrderItem SalesOrder; Type: FK CONSTRAINT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."SalesOrderItem"
    ADD CONSTRAINT "SalesOrder" FOREIGN KEY ("SalesOrderId") REFERENCES hady."SalesOrder"(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: StockItem Stock; Type: FK CONSTRAINT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."StockItem"
    ADD CONSTRAINT "Stock" FOREIGN KEY ("StockId") REFERENCES hady."Stock"(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: InvoiceDate User; Type: FK CONSTRAINT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."InvoiceDate"
    ADD CONSTRAINT "User" FOREIGN KEY ("updatedBy") REFERENCES hady."User"(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: Stock User; Type: FK CONSTRAINT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."Stock"
    ADD CONSTRAINT "User" FOREIGN KEY ("createdBy") REFERENCES hady."User"(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: UserProfileRole User; Type: FK CONSTRAINT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."UserProfileRole"
    ADD CONSTRAINT "User" FOREIGN KEY ("UserId") REFERENCES hady."User"(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: Stock WareHouse; Type: FK CONSTRAINT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."Stock"
    ADD CONSTRAINT "WareHouse" FOREIGN KEY ("WareHouseId") REFERENCES hady."WareHouse"(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: Partner Zone; Type: FK CONSTRAINT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."Partner"
    ADD CONSTRAINT "Zone" FOREIGN KEY ("ZoneId") REFERENCES hady."Zone"(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: ProductPackage Zone; Type: FK CONSTRAINT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."ProductPackage"
    ADD CONSTRAINT "Zone" FOREIGN KEY ("ZoneId") REFERENCES hady."Zone"(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: ProductPrice Zone; Type: FK CONSTRAINT; Schema: hady; Owner: hady
--

ALTER TABLE ONLY hady."ProductPrice"
    ADD CONSTRAINT "Zone" FOREIGN KEY ("ZoneId") REFERENCES hady."Zone"(id) ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

