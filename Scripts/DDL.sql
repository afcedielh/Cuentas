--USE master
--GO
--DROP DATABASE Cuentas
--GO
CREATE DATABASE Cuentas
GO
USE Cuentas
GO
CREATE SCHEMA Identidades;
GO
CREATE SCHEMA Parametrizacion;
GO
CREATE SCHEMA Canonica;
GO
CREATE SCHEMA Transaccional;
GO
CREATE SCHEMA Qos;
GO

CREATE TABLE Identidades.Usuario (
    Id INTEGER NOT NULL,
    UserName VARCHAR(255) NOT NULL,
    Email VARCHAR(255) NOT NULL,
    Pass VARCHAR(MAX) NOT NULL,
    Estado INTEGER NOT NULL,
    Intentos INTEGER NOT NULL,
    Rol INTEGER NOT NULL,
    Persona INTEGER NOT NULL,
    PRIMARY KEY (Id),
    UNIQUE (UserName, Email)
);

CREATE TABLE Parametrizacion.EstadoUsuario (
    Id INTEGER NOT NULL,
    Descripcion VARCHAR(255) NOT NULL,
    PRIMARY KEY (Id)
);

CREATE TABLE Identidades.Rol (
    Id INTEGER NOT NULL,
    Nombre VARCHAR(150) NOT NULL,
    PRIMARY KEY (Id)
);

CREATE TABLE Parametrizacion.Opcion (
    Id INTEGER NOT NULL,
    Controlador VARCHAR(2500) NOT NULL,
    Accion VARCHAR(255) NOT NULL,
    PRIMARY KEY (Id)
);

CREATE TABLE Parametrizacion.RolOpcion (
    IdRol INTEGER NOT NULL,
    IdOpcion INTEGER NOT NULL,
    PRIMARY KEY (IdRol, IdOpcion)
);

CREATE TABLE Canonica.Persona (
    Id INTEGER NOT NULL,
    TipoDocumento INTEGER NOT NULL,
    Nombres VARCHAR(255) NOT NULL,
    Apellidos VARCHAR(255) NOT NULL,
    Telefono VARCHAR(20),
    FechaNacimiento DATE,
    PRIMARY KEY (Id)
);

CREATE TABLE Parametrizacion.TipoDocumento (
    Id INTEGER NOT NULL,
    Nombre VARCHAR(100) NOT NULL,
    Validacion VARCHAR(255) NOT NULL,
    PRIMARY KEY (Id)
);

CREATE TABLE Transaccional.Categorias (
    Id INTEGER NOT NULL,
    Nombre VARCHAR(255) NOT NULL,
    EsDeSistema BIT NOT NULL,
    Tipo INTEGER NOT NULL,
    Usuario INTEGER,
    PRIMARY KEY (Id)
);

CREATE TABLE Parametrizacion.TipoCategoria (
    Id INTEGER NOT NULL,
    Nombre VARCHAR(255) NOT NULL,
    PRIMARY KEY (Id)
);

CREATE TABLE Qos.Log (
    Id INTEGER NOT NULL,
    Nivel VARCHAR(255) NOT NULL,
    Que VARCHAR(255) NOT NULL,
    Donde VARCHAR(255) NOT NULL,
    Cuando DATETIME NOT NULL,
    Quien INTEGER NOT NULL,
    Resultado VARCHAR(255) NOT NULL,
    PRIMARY KEY (Id)
);

CREATE TABLE Transaccional.transaccion (
    Id INTEGER NOT NULL,
    Usuario INTEGER NOT NULL,
    Monto INTEGER NOT NULL,
    Categoria INTEGER NOT NULL,
    EsDeSistema BIT NOT NULL,
    Estado INTEGER NOT NULL,
    Meta INTEGER NOT NULL,
    PRIMARY KEY (Id)
);

CREATE TABLE Transaccional.Meta (
    Id INTEGER NOT NULL,
    Nombre VARCHAR(255) NOT NULL,
    Descripcion VARCHAR(MAX) NOT NULL,
    Valor INTEGER NOT NULL,
    Estado INTEGER NOT NULL,
    Usuario INTEGER NOT NULL,
    Automatico BIT NOT NULL,
    PRIMARY KEY (Id)
);

CREATE TABLE Parametrizacion.EstadoTransaccion (
    Id INTEGER NOT NULL,
    Nombre VARCHAR(255) NOT NULL,
    PRIMARY KEY (Id)
);

CREATE TABLE Parametrizacion.EstadoMeta (
    Id INTEGER NOT NULL,
    Nombre VARCHAR(255) NOT NULL,
    PRIMARY KEY (Id)
);

ALTER TABLE Identidades.Usuario ADD FOREIGN KEY (Estado) REFERENCES Parametrizacion.EstadoUsuario(Id);
ALTER TABLE Identidades.Usuario ADD FOREIGN KEY (Rol) REFERENCES Identidades.Rol(Id);
ALTER TABLE Identidades.Usuario ADD FOREIGN KEY (Persona) REFERENCES Canonica.Persona(Id);
ALTER TABLE Parametrizacion.RolOpcion ADD FOREIGN KEY (IdRol) REFERENCES Identidades.Rol(Id);
ALTER TABLE Parametrizacion.RolOpcion ADD FOREIGN KEY (IdOpcion) REFERENCES Parametrizacion.Opcion(Id);
ALTER TABLE Canonica.Persona ADD FOREIGN KEY (TipoDocumento) REFERENCES Parametrizacion.TipoDocumento(Id);
ALTER TABLE Transaccional.Categorias ADD FOREIGN KEY (Tipo) REFERENCES Parametrizacion.TipoCategoria(Id);
ALTER TABLE Transaccional.Categorias ADD FOREIGN KEY (Usuario) REFERENCES Identidades.Usuario(Id);
ALTER TABLE Qos.Log ADD FOREIGN KEY (Quien) REFERENCES Identidades.Usuario(Id);
ALTER TABLE Transaccional.transaccion ADD FOREIGN KEY (Usuario) REFERENCES Identidades.Usuario(Id);
ALTER TABLE Transaccional.transaccion ADD FOREIGN KEY (Categoria) REFERENCES Transaccional.Categorias(Id);
ALTER TABLE Transaccional.transaccion ADD FOREIGN KEY (Estado) REFERENCES Parametrizacion.EstadoTransaccion(Id);
ALTER TABLE Transaccional.transaccion ADD FOREIGN KEY (Meta) REFERENCES Transaccional.Meta(Id);
ALTER TABLE Transaccional.Meta ADD FOREIGN KEY (Estado) REFERENCES Parametrizacion.EstadoMeta(Id);
ALTER TABLE Transaccional.Meta ADD FOREIGN KEY (Usuario) REFERENCES Identidades.Usuario(Id);