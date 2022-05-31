

CREATE TABLE public.parroquias (
                id_parroquia INTEGER NOT NULL,
                id_municipio INTEGER NOT NULL,
                id_estado INTEGER NOT NULL,
                parroquia VARCHAR NOT NULL,
                CONSTRAINT id_parroquia PRIMARY KEY (id_parroquia)
);


CREATE TABLE public.municipios (
                id_municipio VARCHAR NOT NULL,
                id_estado INTEGER NOT NULL,
                municipio VARCHAR NOT NULL,
                CONSTRAINT id_municipio PRIMARY KEY (id_municipio)
);


CREATE TABLE public.estado (
                id_estado INTEGER NOT NULL,
                estado VARCHAR NOT NULL,
                CONSTRAINT id_estado PRIMARY KEY (id_estado)
);


CREATE SEQUENCE public.ubicacion_geografica_id_ubicacion_geografica_seq;

CREATE TABLE public.ubicacion_geografica (
                id_ubicacion_geografica INTEGER NOT NULL DEFAULT nextval('public.ubicacion_geografica_id_ubicacion_geografica_seq'),
                id_estado INTEGER NOT NULL,
                municipios_id_municipio VARCHAR NOT NULL,
                id_parroquia INTEGER NOT NULL,
                id_municipio INTEGER NOT NULL,
                cod_postal INTEGER NOT NULL,
                direccion VARCHAR NOT NULL,
                activo BOOLEAN NOT NULL,
                activo_1 BOOLEAN NOT NULL,
                CONSTRAINT id_ubicacion_geografica PRIMARY KEY (id_ubicacion_geografica)
);


ALTER SEQUENCE public.ubicacion_geografica_id_ubicacion_geografica_seq OWNED BY public.ubicacion_geografica.id_ubicacion_geografica;

CREATE SEQUENCE public.categorias_id_categoria_seq;

CREATE TABLE public.categorias (
                id_categoria INTEGER NOT NULL DEFAULT nextval('public.categorias_id_categoria_seq'),
                categoria VARCHAR NOT NULL,
                activo BOOLEAN NOT NULL,
                CONSTRAINT id_categoria PRIMARY KEY (id_categoria)
);


ALTER SEQUENCE public.categorias_id_categoria_seq OWNED BY public.categorias.id_categoria;

CREATE SEQUENCE public.movimientos_id_movimiento_seq;

CREATE TABLE public.movimientos (
                id_movimiento INTEGER NOT NULL DEFAULT nextval('public.movimientos_id_movimiento_seq'),
                tipo_movimiento VARCHAR NOT NULL,
                id_almacen_origen INTEGER NOT NULL,
                id_almacen_destino INTEGER NOT NULL,
                CONSTRAINT id_movimiento PRIMARY KEY (id_movimiento)
);


ALTER SEQUENCE public.movimientos_id_movimiento_seq OWNED BY public.movimientos.id_movimiento;

CREATE SEQUENCE public.logs_id_log_seq;

CREATE TABLE public.logs (
                id_log INTEGER NOT NULL DEFAULT nextval('public.logs_id_log_seq'),
                id_usuario INTEGER NOT NULL,
                fecha_accion DATE NOT NULL,
                accion VARCHAR NOT NULL,
                CONSTRAINT id_log PRIMARY KEY (id_log)
);


ALTER SEQUENCE public.logs_id_log_seq OWNED BY public.logs.id_log;

CREATE SEQUENCE public.tipo_salida_id_tipo_salida_seq;

CREATE TABLE public.tipo_salida (
                id_tipo_salida INTEGER NOT NULL DEFAULT nextval('public.tipo_salida_id_tipo_salida_seq'),
                desc_tipo_salida VARCHAR NOT NULL,
                activo BOOLEAN NOT NULL,
                CONSTRAINT id_tipo_salida PRIMARY KEY (id_tipo_salida)
);


ALTER SEQUENCE public.tipo_salida_id_tipo_salida_seq OWNED BY public.tipo_salida.id_tipo_salida;

CREATE SEQUENCE public.tipo_entrada_id_tipo_entrada_seq;

CREATE TABLE public.tipo_entrada (
                id_tipo_entrada INTEGER NOT NULL DEFAULT nextval('public.tipo_entrada_id_tipo_entrada_seq'),
                descrip_tipo_entrada VARCHAR NOT NULL,
                activo BOOLEAN NOT NULL,
                CONSTRAINT id_tipo_entrada PRIMARY KEY (id_tipo_entrada)
);


ALTER SEQUENCE public.tipo_entrada_id_tipo_entrada_seq OWNED BY public.tipo_entrada.id_tipo_entrada;

CREATE SEQUENCE public.roles_id_rol_seq;

CREATE TABLE public.roles (
                id_rol INTEGER NOT NULL DEFAULT nextval('public.roles_id_rol_seq'),
                nombre_rol VARCHAR NOT NULL,
                descrip_rol VARCHAR NOT NULL,
                activo BOOLEAN NOT NULL,
                CONSTRAINT id_rol PRIMARY KEY (id_rol)
);


ALTER SEQUENCE public.roles_id_rol_seq OWNED BY public.roles.id_rol;

CREATE SEQUENCE public.condicion_materiales_id_condicion_material_seq;

CREATE TABLE public.condicion_materiales (
                id_condicion_material INTEGER NOT NULL DEFAULT nextval('public.condicion_materiales_id_condicion_material_seq'),
                descrip_condicion_material VARCHAR NOT NULL,
                activo BOOLEAN NOT NULL,
                CONSTRAINT id_condicion_material PRIMARY KEY (id_condicion_material)
);


ALTER SEQUENCE public.condicion_materiales_id_condicion_material_seq OWNED BY public.condicion_materiales.id_condicion_material;

CREATE SEQUENCE public.usuarios_id_usuario_seq;

CREATE TABLE public.usuarios (
                id_usuario INTEGER NOT NULL DEFAULT nextval('public.usuarios_id_usuario_seq'),
                usuario VARCHAR(50) NOT NULL,
                clave VARCHAR(100) NOT NULL,
                activo BIT NOT NULL,
                id_rol INTEGER NOT NULL,
                CONSTRAINT id_usuario PRIMARY KEY (id_usuario)
);


ALTER SEQUENCE public.usuarios_id_usuario_seq OWNED BY public.usuarios.id_usuario;

CREATE SEQUENCE public.status_material_id_estatus_material_seq;

CREATE TABLE public.status_material (
                id_estatus_material INTEGER NOT NULL DEFAULT nextval('public.status_material_id_estatus_material_seq'),
                desc_estatus_material VARCHAR NOT NULL,
                activo BOOLEAN NOT NULL,
                CONSTRAINT status_material_pk PRIMARY KEY (id_estatus_material)
);


ALTER SEQUENCE public.status_material_id_estatus_material_seq OWNED BY public.status_material.id_estatus_material;

CREATE SEQUENCE public.proveedor_id_proveedor_seq;

CREATE TABLE public.proveedor (
                id_proveedor INTEGER NOT NULL DEFAULT nextval('public.proveedor_id_proveedor_seq'),
                nombre_proveedor VARCHAR(100) NOT NULL,
                telefono_proveedor VARCHAR(20) NOT NULL,
                correo_proveedor VARCHAR(100) NOT NULL,
                activo BOOLEAN NOT NULL,
                rif VARCHAR NOT NULL,
                CONSTRAINT proveedor_pkey PRIMARY KEY (id_proveedor)
);


ALTER SEQUENCE public.proveedor_id_proveedor_seq OWNED BY public.proveedor.id_proveedor;

CREATE SEQUENCE public.almacen_id_almacen_seq;

CREATE TABLE public.almacen (
                id_almacen INTEGER NOT NULL DEFAULT nextval('public.almacen_id_almacen_seq'),
                nombre_alamcen VARCHAR(100) NOT NULL,
                ubicacion_almacen INTEGER NOT NULL,
                descripcion_almacen VARCHAR(70) NOT NULL,
                tipo_almacen VARCHAR NOT NULL,
                activo BOOLEAN NOT NULL,
                id_ubicacion_geografica INTEGER NOT NULL,
                CONSTRAINT almacen_pkey PRIMARY KEY (id_almacen)
);


ALTER SEQUENCE public.almacen_id_almacen_seq OWNED BY public.almacen.id_almacen;

CREATE SEQUENCE public.material_id_material_seq;

CREATE TABLE public.material (
                id_material INTEGER NOT NULL DEFAULT nextval('public.material_id_material_seq'),
                nombre_material VARCHAR(50) NOT NULL,
                descripcion_material VARCHAR(100) NOT NULL,
                unidad_medida INTEGER NOT NULL,
                activo BOOLEAN NOT NULL,
                stock INTEGER NOT NULL,
                id_estatus_material INTEGER NOT NULL,
                id_almacen INTEGER NOT NULL,
                id_categoria INTEGER NOT NULL,
                id_condicion_material INTEGER NOT NULL,
                id_ingreso_material INTEGER NOT NULL,
                id_tipo_salida INTEGER NOT NULL,
                id_tipo_entrada INTEGER NOT NULL,
                CONSTRAINT material_pkey PRIMARY KEY (id_material)
);


ALTER SEQUENCE public.material_id_material_seq OWNED BY public.material.id_material;

CREATE SEQUENCE public.material_proveedor_id_material_proveedor_seq;

CREATE TABLE public.material_proveedor (
                id_material_proveedor INTEGER NOT NULL DEFAULT nextval('public.material_proveedor_id_material_proveedor_seq'),
                id_material INTEGER NOT NULL,
                id_proveedor INTEGER NOT NULL,
                CONSTRAINT id_material_proveedor PRIMARY KEY (id_material_proveedor)
);


ALTER SEQUENCE public.material_proveedor_id_material_proveedor_seq OWNED BY public.material_proveedor.id_material_proveedor;

ALTER TABLE public.ubicacion_geografica ADD CONSTRAINT parroquias_ubicacion_geografica_fk
FOREIGN KEY (id_parroquia)
REFERENCES public.parroquias (id_parroquia)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.ubicacion_geografica ADD CONSTRAINT municipios_ubicacion_geografica_fk
FOREIGN KEY (municipios_id_municipio)
REFERENCES public.municipios (id_municipio)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.ubicacion_geografica ADD CONSTRAINT estado_ubicacion_geografica_fk
FOREIGN KEY (id_estado)
REFERENCES public.estado (id_estado)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.almacen ADD CONSTRAINT ubicacion_geografica_almacen_fk
FOREIGN KEY (id_ubicacion_geografica)
REFERENCES public.ubicacion_geografica (id_ubicacion_geografica)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.material ADD CONSTRAINT categorias_material_fk
FOREIGN KEY (id_categoria)
REFERENCES public.categorias (id_categoria)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.material ADD CONSTRAINT tipo_salida_material_fk
FOREIGN KEY (id_tipo_salida)
REFERENCES public.tipo_salida (id_tipo_salida)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.material ADD CONSTRAINT tipo_entrada_material_fk
FOREIGN KEY (id_tipo_entrada)
REFERENCES public.tipo_entrada (id_tipo_entrada)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.usuarios ADD CONSTRAINT roles_usuarios_fk
FOREIGN KEY (id_rol)
REFERENCES public.roles (id_rol)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.material ADD CONSTRAINT condicion_materiales_material_fk
FOREIGN KEY (id_condicion_material)
REFERENCES public.condicion_materiales (id_condicion_material)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.material ADD CONSTRAINT status_material_material_fk
FOREIGN KEY (id_estatus_material)
REFERENCES public.status_material (id_estatus_material)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.material_proveedor ADD CONSTRAINT proveedor_material_proveedor_fk
FOREIGN KEY (id_proveedor)
REFERENCES public.proveedor (id_proveedor)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.material ADD CONSTRAINT almacen_material_fk
FOREIGN KEY (id_almacen)
REFERENCES public.almacen (id_almacen)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.material_proveedor ADD CONSTRAINT material_material_proveedor_fk
FOREIGN KEY (id_material)
REFERENCES public.material (id_material)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;